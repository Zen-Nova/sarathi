<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support5\Str;

class CitizenWorkflowController extends Controller
{
    /**
     * Handles the initial QR code entry gate scan.
     * Generates a new tracking token if not present, logs entry, and redirects.
     */
    public function handleScan(Request $request)
    {
        $token = $request->query('token');

        // If the token already exists, check if they completed their steps or are checking out
        if ($token && $visit = Visit::where('tracking_token', $token)->first()) {
            if ($visit->is_completed || $visit->failure_reason) {
                return redirect()->route('workflow.thanks', ['token' => $token]);
            }
            return redirect()->route('workflow.checkout', ['token' => $token]);
        }

        // New citizen arrival workflow initiation
        $newToken = 'TRK-' . strtoupper(Str::random(12));

        return redirect()->route('workflow.select-service', ['token' => $newToken]);
    }

    public function showServiceSelection($token)
    {
        $services = Service::where('is_active', true)->with('department')->get();
        return view('citizen.select-service', compact('token', 'services'));
    }

    public function startService(Request $request, $token)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
        ]);

        $service = Service::findOrFail($request->service_id);

        // Store active tracker sequence in database visits registry
        Visit::create([
            'tracking_token' => $token,
            'department_id'  => $service->department_id,
            'service_id'     => $service->id,
            'entered_at'     => now(),
            'is_completed'   => false,
        ]);

        return redirect()->route('workflow.roadmap', ['token' => $token]);
    }

    public function showRoadmap($token)
    {
        $visit = Visit::where('tracking_token', $token)->with('service.steps')->firstOrFail();
        $service = $visit->service;

        return view('citizen.roadmap', compact('token', 'visit', 'service'));
    }

    public function showCheckout($token)
    {
        $visit = Visit::where('tracking_token', $token)->with('service')->firstOrFail();
        return view('citizen.checkout', compact('token', 'visit'));
    }

    public function processFeedback(Request $request, $token)
    {
        $visit = Visit::where('tracking_token', $token)->firstOrFail();

        $request->validate([
            'is_completed'     => 'required|boolean',
            'rating'           => 'nullable|integer|min:1|max:5',
            'failure_reason'   => 'nullable|string',
            'citizen_comments' => 'nullable|string',
            'citizen_name'     => 'nullable|string|max:255',
            'citizen_phone'    => 'nullable|string|max:20',
        ]);

        $isCompleted = (bool) $request->is_completed;

        $visit->update([
            'is_completed'     => $isCompleted,
            'rating'           => $isCompleted ? $request->rating : 1, // Auto lock low rating for incomplete work
            'failure_reason'   => $isCompleted ? null : $request->failure_reason,
            'citizen_comments' => $request->citizen_comments,
            'citizen_name'     => $request->has('is_anonymous') ? null : $request->citizen_name,
            'citizen_phone'    => $request->has('is_anonymous') ? null : $request->citizen_phone,
            'exited_at'        => now(),
        ]);

        return redirect()->route('workflow.thanks', ['token' => $token]);
    }

    public function thankYou($token)
    {
        return view('citizen.thank-you', compact('token'));
    }
}