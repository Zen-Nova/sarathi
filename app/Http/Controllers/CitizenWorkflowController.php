<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CitizenWorkflowController extends Controller
{
    /**
     * Handles the initial QR code entry gate scan.
     * Generates a new tracking token if not present, logs entry, and redirects.
     */
    public function handleScan(Request $request)
    {
        $token = $request->query('token');

        if ($token) {
            $visit = Visit::where('tracking_token', $token)->first();

            if ($visit) {
                if ($visit->exited_at) {
                    return redirect()->route('workflow.thanks', ['token' => $token]);
                }

                if ($visit->service_id) {
                    return redirect()->route('workflow.checkout', ['token' => $token]);
                }

                return redirect()->route('workflow.select-service', ['token' => $token]);
            }
        }

        $newToken = 'TRK-' . strtoupper(Str::random(12));

        return redirect()->route('workflow.select-service', ['token' => $newToken]);
    }

    public function showServiceSelection($token)
    {
        $services = Service::where('is_active', true)
            ->with('department')
            ->get();

        return view('citizen.select-service', compact('token', 'services'));
    }

    public function startService(Request $request, $token)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
        ]);

        $service = Service::findOrFail($validated['service_id']);

        $visit = Visit::firstOrNew([
            'tracking_token' => $token,
        ]);

        if (! $visit->exists) {
            $visit->entered_at = now();
        }

        $visit->fill([
            'department_id' => $service->department_id,
            'service_id' => $service->id,
            'is_completed' => null,
            'rating' => null,
            'failure_reason' => null,
            'citizen_comments' => null,
            'citizen_name' => null,
            'citizen_phone' => null,
            'exited_at' => null,
        ]);

        $visit->save();

        return redirect()->route('workflow.roadmap', ['token' => $token]);
    }

    public function showRoadmap($token)
    {
        $visit = Visit::where('tracking_token', $token)
            ->with(['service.steps', 'service.department'])
            ->firstOrFail();

        $service = $visit->service;

        return view('citizen.roadmap', compact('token', 'visit', 'service'));
    }

    public function showCheckout($token)
    {
        $visit = Visit::where('tracking_token', $token)
            ->with(['service', 'department'])
            ->firstOrFail();

        return view('citizen.checkout', compact('token', 'visit'));
    }

    public function processFeedback(Request $request, $token)
    {
        $visit = Visit::where('tracking_token', $token)->firstOrFail();

        $validReasons = implode(',', array_keys(config('visits.failure_reasons')));

        $validated = $request->validate([
            'is_completed' => 'required|boolean',
            'rating' => 'required_if:is_completed,1|nullable|integer|min:1|max:5',
            'failure_reason' => 'required_if:is_completed,0|nullable|string|in:' . $validReasons,
            'citizen_comments' => 'nullable|string|max:2000',
            'citizen_name' => 'nullable|string|max:255',
            'citizen_phone' => 'nullable|string|max:20',
            'is_anonymous' => 'nullable|boolean',
        ]);

        $isCompleted = $request->boolean('is_completed');
        $isAnonymous = $request->boolean('is_anonymous');

        $visit->update([
            'is_completed' => $isCompleted,
            'rating' => $isCompleted ? (int) $validated['rating'] : null,
            'failure_reason' => $isCompleted ? null : $validated['failure_reason'],
            'citizen_comments' => $validated['citizen_comments'] ?? null,
            'citizen_name' => $isAnonymous ? null : ($validated['citizen_name'] ?? null),
            'citizen_phone' => $isAnonymous ? null : ($validated['citizen_phone'] ?? null),
            'exited_at' => now(),
        ]);

        return redirect()->route('workflow.thanks', ['token' => $token]);
    }

    public function thankYou($token)
    {
        return view('citizen.thank-you', compact('token'));
    }
}