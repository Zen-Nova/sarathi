<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Department;
use App\Models\Service;

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
        ->with('steps')
        ->get();

    return view('citizen.select-service', compact('services', 'department'));
})->name('portal.select-service');

/*
|--------------------------------------------------------------------------
| Citizen Workflow
|--------------------------------------------------------------------------
*/

Route::post('/pick-service', function (Request $request) {
    $request->validate([
        'service_id' => ['required', 'exists:services,id'],
    ]);

    $service = Service::with('department')->findOrFail($request->input('service_id'));

    $slugToChecklist = [
        'passport-visa'  => 'passport',
        'administration' => 'citizenship',
        'national-id'    => 'nid',
        'transport'      => 'license',
    ];

    $deptSlug = $service->department?->slug;
    $checklistKey = $slugToChecklist[$deptSlug] ?? null;

    session([
        'service_id' => $service->id,
    ]);

    if (!$checklistKey) {
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
        'tracking_token' => 'NEP-' . strtoupper(Str::random(4)) . '-' . rand(100, 999),
        'service_id'     => $service->id,
        'checked_in_at'  => now()->toDateTimeString(),
    ]);

    return redirect()->route('portal.active-guide');
})->name('start-tracking');

Route::get('/active-guide', function () {
    $serviceId = session('service_id');

    if (!$serviceId) {
        return redirect()->route('portal.select-service');
    }

    $selectedService = Service::with('steps')->find($serviceId);

    if (!$selectedService) {
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
| Document Checklist
|--------------------------------------------------------------------------
*/

Route::get('/document-checklist/{service}', function ($service) {
    $serviceToDepartmentSlug = [
        'passport'    => 'passport-visa',
        'citizenship' => 'administration',
        'nid'         => 'national-id',
        'license'     => 'transport',
    ];

    if (!array_key_exists($service, $serviceToDepartmentSlug)) {
        abort(404, 'Service checklist not found.');
    }

    $department = Department::where('slug', $serviceToDepartmentSlug[$service])->firstOrFail();

    $services = Service::query()
        ->where('department_id', $department->id)
        ->where('is_active', true)
        ->with('steps')
        ->get();

    $selectedService = null;

    if (session('service_id')) {
        $selectedService = Service::query()
            ->where('department_id', $department->id)
            ->where('is_active', true)
            ->with('steps')
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
    $selectedService = session('service_id')
        ? Service::find(session('service_id'))
        : null;

    return view('citizen.checkout', [
        'selectedService' => $selectedService,
    ]);
})->name('portal.checkout');

Route::post('/submit-checkout', function (Request $request) {
    session([
        'last_feedback' => $request->only([
            'is_successful',
            'rating',
            'unsuccessful_reason',
            'comments',
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

Route::get('/entry-scan', function () {
    return redirect()->route('portal.select-service');
})->name('workflow.scan');