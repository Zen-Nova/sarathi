<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Service;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CitizenWorkflowController extends Controller
{
    /**
     * Entry Point: Triggered by scanning QR code matching `/scan?office=slug`
     */
    public function handleScan(Request $request)
    {
        $slug = $request->query('office');
        $department = Department::where('slug', $slug)->where('is_active', true)->firstOrFail();

        // Check if citizen already has an active ongoing tracking session in their cookie/session
        $existingToken = $request->cookie('active_visit_token');

        if ($existingToken) {
            $activeVisit = Visit::where('tracking_token', $existingToken)
                                ->whereNull('exited_at')
                                ->first();

            if ($activeVisit && $activeVisit->department_id === $department->id) {
                // If they scanned the same QR code again while active inside, send them straight to Checkout!
                return redirect()->route('workflow.checkout', ['token' => $existingToken]);
            }
        }

        // Fresh Entry Journey: Generate tracking token & create fresh initial visit record
        $token = Str::random(40);
        
        Visit::create([
            'tracking_token' => $token,
            'department_id' => $department->id,
            'entered_at' => now(),
        ]);

        // Put the token on a long-lived cookie session valid for 1 day
        return redirect()->route('workflow.select-service', ['token' => $token])
                         ->withCookie(cookie('active_visit_token', $token, 1440));
    }

    /**
     * Display Service options available for selection
     */
    public function showServiceSelection($token)
    {
        $visit = Visit::where('tracking_token', $token)->firstOrFail();
        $services = Service::where('department_id', $visit->department_id)->where('is_active', true)->get();

        return view('citizen.select-service', compact('visit', 'services', 'token'));
    }

    /**
     * Assign service and forward to workflow roadmap
     */
    public function startService(Request $request, $token)
    {
        $request->validate(['service_id' => 'required|exists:services,id']);
        
        $visit = Visit::where('tracking_token', $token)->firstOrFail();
        $visit->update(['service_id' => $request->service_id]);

        return redirect()->route('workflow.roadmap', ['token' => $token]);
    }

    /**
     * Render the step-by-step roadmap to the citizen
     */
    public function showRoadmap($token)
    {
        $visit = Visit::where('tracking_token', $token)->with('service.steps', 'department')->firstOrFail();
        
        return view('citizen.roadmap', compact('visit'));
    }

    /**
     * Checkout point (Phase 2 landing page)
     */
    public function showCheckout($token)
    {
        $visit = Visit::where('tracking_token', $token)->with('department', 'service')->firstOrFail();
        return view('citizen.checkout', compact('visit', 'token'));
    }

    /**
     * Process user feedback/failure modes on check out
     */
    public function processFeedback(Request $request, $token)
    {
        $visit = Visit::where('tracking_token', $token)->firstOrFail();

        $request->validate([
            'is_completed' => 'required|boolean',
            'rating' => 'required_if:is_completed,1|nullable|integer|min:1|max:5',
            'failure_reason' => 'required_if:is_completed,0|nullable|string',
            'citizen_comments' => 'nullable|string|max:1000'
        ]);

        $visit->update([
            'exited_at' => now(),
            'is_completed' => $request->is_completed,
            'rating' => $request->is_completed ? $request->rating : null,
            'failure_reason' => !$request->is_completed ? $request->failure_reason : null,
            'citizen_comments' => $request->citizen_comments,
        ]);

        // Forget the tracking cookie token upon completion
        return redirect()->route('workflow.thanks', ['token' => $token])
                         ->withoutCookie('active_visit_token');
    }

    /**
     * Thank You Screen
     */
    public function thankYou($token)
    {
        return view('citizen.thanks');
    }
}