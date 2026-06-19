<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes - Citizen Tracking Application Flow
|--------------------------------------------------------------------------
*/

// 1. Citizen Portal Home Dashboard
Route::get('/', function () { 
    return view('home'); 
})->name('portal.home');

// 2. Select Service Screen
Route::get('/select-service', function () { 
    $services = [
        (object)['id' => 1, 'name_ne' => 'नयाँ राहदानी', 'name_en' => 'New Passport', 'desc_ne' => 'नयाँ राहदानी जारी गर्ने प्रक्रिया', 'desc_en' => 'First-time passport issuance track'],
        (object)['id' => 2, 'name_ne' => 'राहदानी नवीकरण', 'name_en' => 'Passport Renewal', 'desc_ne' => 'म्याद समाप्त भएको राहदानी नवीकरण', 'desc_en' => 'Renew an expired or expiring passport document']
    ];
    return view('citizen.select-service', compact('services')); 
})->name('portal.select-service');

// ➔ 3. Process Selected Service Form Submission (FIXES THE ROUTE NOT FOUND EXCEPTION)
Route::post('/start-tracking', function (Request $request) {
    session([
        'tracking_token' => 'NEP-' . strtoupper(Str::random(4)) . '-' . rand(100, 999),
        'service_id' => $request->input('service_id')
    ]);
    return redirect()->route('portal.active-guide');
})->name('start-tracking');

// 4. Active Workflow Station Guide Roadmap
Route::get('/active-guide', function () { 
    $steps = [
        (object)['location_ne' => 'काउन्टर नं. ३: कागजात प्रमाणीकरण', 'location_en' => 'Counter 3: Verification', 'instruction_ne' => 'सक्कल नागरिकता प्रमाणपत्र बुझाउनुहोस्।', 'instruction_en' => 'Present your original citizenship certificate.'],
        (object)['location_ne' => 'कोठा नं. १२: बायोमेट्रिक संकलन', 'location_en' => 'Room 12: Biometrics', 'instruction_ne' => 'डिजिटल फोटो र औंठाछाप दिनुहोस्।', 'instruction_en' => 'Capture digital photograph and fingerprints.']
    ];
    return view('citizen.active-guide', compact('steps')); 
})->name('portal.active-guide');

// 5. Checkout Status Milestone Evaluation (Second QR Scan Endpoint)
Route::get('/checkout', function () { 
    return view('citizen.checkout'); 
})->name('portal.checkout');

// 6. Submit Checkout Status Form (Feedback / Accountability Complaints Logs)
Route::post('/submit-checkout', function (Request $request) {
    session()->forget(['tracking_token', 'service_id']);
    return redirect()->route('portal.thank-you');
})->name('portal.submit-checkout');

// 7. Final Success Milestone Landing Page
Route::get('/thank-you', function () { 
    return view('citizen.thank-you'); 
})->name('portal.thank-you');

// 8. Static Overview Map Framework Roadmap
Route::get('/roadmap', function () { 
    return view('citizen.roadmap'); 
})->name('portal.roadmap');


/*
|--------------------------------------------------------------------------
| Master Layout Component Fallbacks
|--------------------------------------------------------------------------
*/
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ne'])) { session(['locale' => $locale]); }
    return redirect()->back();
})->name('lang.switch');

Route::get('/entry-scan', function () {
    return redirect()->route('portal.select-service');
})->name('workflow.scan');