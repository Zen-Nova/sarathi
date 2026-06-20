<?php

use App\Http\Controllers\CitizenWorkflowController;
use App\Models\Department;
use App\Models\Service;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Nagarik Sarthi - Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('portal.home');

Route::get('/contact', function () {
    return view('contact');
})->name('portal.contact');

/*
|--------------------------------------------------------------------------
| Service Selection
|--------------------------------------------------------------------------
*/

Route::get('/select-service', function (Request $request) {
    $deptParam = $request->query('department');

    $slugMap = [
        'passport'    => 'passport-visa',
        'citizenship' => 'administration',
        'nid'         => 'national-id',
        'license'     => 'transport',

        // New departments
        'ird'         => 'inland-revenue-department',
        'police'      => 'nepal-police',
    ];

    $department = null;

    if ($deptParam) {
        $slug = $slugMap[$deptParam] ?? $deptParam;

        $department = Department::where('slug', $slug)->first();
    }

    $services = Service::query()
        ->where('is_active', true)
        ->when($department, function ($query) use ($department) {
            $query->where('department_id', $department->id);
        })
        ->with(['steps', 'requiredDocuments'])
        ->get();

    return view('citizen.select-service', compact('services', 'department'));
})->name('portal.select-service');

/*
|--------------------------------------------------------------------------
| Citizen Workflow - Old Portal Flow
|--------------------------------------------------------------------------
*/

Route::post('/pick-service', function (Request $request) {
    $request->validate([
        'service_id' => ['required', 'exists:services,id'],
    ]);

    $service = Service::with(['department', 'steps', 'requiredDocuments'])
        ->findOrFail($request->input('service_id'));

    $slugToChecklist = [
        'passport-visa'             => 'passport',
        'administration'            => 'citizenship',
        'national-id'               => 'nid',
        'transport'                 => 'license',

        // New departments
        'inland-revenue-department' => 'ird',
        'nepal-police'              => 'police',
    ];

    $deptSlug = $service->department?->slug;
    $checklistKey = $slugToChecklist[$deptSlug] ?? null;

    session([
        'service_id' => $service->id,
    ]);

    if (! $checklistKey) {
        return redirect()->route('portal.active-guide');
    }

    return redirect()->route('portal.document-checklist', [
        'service' => $checklistKey,
    ]);
})->name('portal.pick-service');

Route::post('/start-tracking', function (Request $request) {
    $request->validate([
        'service_id' => ['required', 'exists:services,id'],
    ]);

    $service = Service::findOrFail($request->input('service_id'));

    session([
        'tracking_token' => 'TRK-' . strtoupper(Str::random(12)),
        'service_id'     => $service->id,
        'checked_in_at'  => now()->toDateTimeString(),
    ]);

    return redirect()->route('portal.active-guide');
})->name('start-tracking');

Route::get('/active-guide', function () {
    $serviceId = session('service_id');

    if (! $serviceId) {
        return redirect()->route('portal.select-service');
    }

    $selectedService = Service::with(['steps', 'requiredDocuments'])
        ->find($serviceId);

    if (! $selectedService) {
        session()->forget([
            'tracking_token',
            'service_id',
            'checked_in_at',
        ]);

        return redirect()->route('portal.select-service');
    }

    return view('citizen.active-guide', [
        'selectedService' => $selectedService,
        'steps'           => $selectedService->steps,
    ]);
})->name('portal.active-guide');

/*
|--------------------------------------------------------------------------
| Dynamic Visit Workflow
|--------------------------------------------------------------------------
*/

Route::get('/entry-scan', [CitizenWorkflowController::class, 'handleScan'])
    ->name('workflow.scan');

Route::get('/workflow/{token}/select-service', [CitizenWorkflowController::class, 'showServiceSelection'])
    ->name('workflow.select-service');

Route::post('/workflow/{token}/start-service', [CitizenWorkflowController::class, 'startService'])
    ->name('workflow.start-service');

Route::get('/workflow/{token}/roadmap', [CitizenWorkflowController::class, 'showRoadmap'])
    ->name('workflow.roadmap');

Route::get('/workflow/{token}/checkout', [CitizenWorkflowController::class, 'showCheckout'])
    ->name('workflow.checkout');

Route::post('/workflow/{token}/feedback', [CitizenWorkflowController::class, 'processFeedback'])
    ->name('workflow.process-feedback');

Route::get('/workflow/{token}/thanks', [CitizenWorkflowController::class, 'thankYou'])
    ->name('workflow.thanks');

/*
|--------------------------------------------------------------------------
| Document Checklist
|--------------------------------------------------------------------------
*/

Route::get('/document-checklist/{service}', function ($service) {
    $serviceToDepartmentSlug = [
        'passport'    => 'passport-visa',
        'citizenship' => 'administration',
        'nid'         => 'national-id',
        'license'     => 'transport',

        // New departments
        'ird'         => 'inland-revenue-department',
        'police'      => 'nepal-police',
    ];

    if (! array_key_exists($service, $serviceToDepartmentSlug)) {
        abort(404, 'Service checklist not found.');
    }

    $department = Department::where('slug', $serviceToDepartmentSlug[$service])
        ->firstOrFail();

    $services = Service::query()
        ->where('department_id', $department->id)
        ->where('is_active', true)
        ->with(['steps', 'requiredDocuments'])
        ->get();

    $selectedService = null;

    if (session('service_id')) {
        $selectedService = Service::query()
            ->where('department_id', $department->id)
            ->where('is_active', true)
            ->with(['steps', 'requiredDocuments'])
            ->find(session('service_id'));
    }

    return view('citizen.document-checklist', [
        'serviceKey'      => $service,
        'department'      => $department,
        'departmentParam' => $service,
        'services'        => $services,
        'selectedService' => $selectedService,
    ]);
})->name('portal.document-checklist');

/*
|--------------------------------------------------------------------------
| Checkout & Feedback
|--------------------------------------------------------------------------
*/

Route::get('/checkout', function () {
    $serviceId = session('service_id');

    if (! $serviceId) {
        return redirect()->route('portal.select-service');
    }

    $service = Service::with('department')->find($serviceId);

    if (! $service) {
        session()->forget([
            'tracking_token',
            'service_id',
            'checked_in_at',
        ]);

        return redirect()->route('portal.select-service');
    }

    $token = session('tracking_token');

    if (! $token) {
        $token = 'TRK-' . strtoupper(Str::random(12));

        session([
            'tracking_token' => $token,
        ]);
    }

    $visit = Visit::firstOrNew([
        'tracking_token' => $token,
    ]);

    if (! $visit->exists) {
        $visit->entered_at = session('checked_in_at')
            ? Carbon::parse(session('checked_in_at'))
            : now();
    }

    $visit->fill([
        'department_id' => $service->department_id,
        'service_id'    => $service->id,
    ]);

    $visit->save();

    return redirect()->route('workflow.checkout', [
        'token' => $token,
    ]);
})->name('portal.checkout');

Route::post('/submit-checkout', function (Request $request) {
    session([
        'last_feedback' => $request->only([
            'is_completed',
            'rating',
            'failure_reason',
            'citizen_comments',
            'is_anonymous',
            'citizen_name',
            'citizen_phone',
        ]),
        'last_submitted_at' => now()->toDateTimeString(),
    ]);

    session()->forget([
        'tracking_token',
        'service_id',
        'checked_in_at',
    ]);

    return redirect()->route('portal.thank-you');
})->name('portal.submit-checkout');

Route::get('/thank-you', function () {
    return view('citizen.thank-you');
})->name('portal.thank-you');

Route::get('/roadmap', function () {
    return view('citizen.roadmap');
})->name('portal.roadmap');

/*
|--------------------------------------------------------------------------
| Language & Utilities
|--------------------------------------------------------------------------
*/

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ne'])) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('lang.switch');