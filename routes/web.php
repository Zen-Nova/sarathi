<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Nagarik Sarthi - Web Routing & Service Engine
|--------------------------------------------------------------------------
|
| Clean, predictable routing architecture designed for zero-friction citizen 
| tracking interactions. Powered by pure PHP closures for direct execution.
|
*/

/**
 * Repository Dataset for Departmental Services
 */
$servicesData = function () {
    return [
        [
            'id' => 'new_passport',
            'name_ne' => 'नयाँ ई-राहदानी दरखास्त दर्ता',
            'name_en' => 'New e-Passport Application',
            'desc_ne' => 'पहिलो पटक राहदानी बनाउन आवश्यक कागजात, दस्तुर र झ्यालगत विवरण सहितको चरणबद्ध मार्गदर्शन।',
            'desc_en' => 'Step-by-step guidance for first-time biometric passport applications, verification desks, and fees.',
            'est_ne' => '४५–६० मिनेट',
            'est_en' => '45–60 mins',
            'steps' => [
                [
                    'title_ne' => 'टोकन गेट तथा फारम रुजु',
                    'title_en' => 'Token Gate & Form Pre-check',
                    'location_ne' => 'काउन्टर नं. १ — मुख्य प्रवेश द्वार',
                    'location_en' => 'Counter No. 1 — Main Entrance Gate',
                    'instruction_ne' => 'अनलाइन आवेदन फारमको प्रिन्ट, नागरिकताको प्रमाणपत्र र राष्ट्रिय परिचयपत्र नम्बर रुजु गराउनुहोस्।',
                    'instruction_en' => 'Verify online application printout, original Nepali citizenship certificate and NID number printout.',
                    'requirements_ne' => ['अनलाइन आवेदन फारम प्रिन्ट', 'नागरिकताको सक्कल प्रमाणपत्र', 'राष्ट्रिय परिचयपत्र नम्बर प्रिन्ट'],
                    'requirements_en' => ['Online application form printout', 'Original Nepali citizenship certificate', 'National Identity Number printout'],
                ],
                [
                    'title_ne' => 'बायोमेट्रिक्स तथा फोटो',
                    'title_en' => 'Biometrics & Photography',
                    'location_ne' => 'कोठा नं. १०२ — पहिलो तल्ला',
                    'location_en' => 'Room No. 102 — First Floor',
                    'instruction_ne' => 'डिजिटल फोटो, औंठाछाप र डिजिटल दस्तखत रेकर्ड गराउनुहोस्।',
                    'instruction_en' => 'Capture digital passport photo, fingerprints and digital signature.',
                    'requirements_ne' => ['टोकन कार्ड', 'रुजु भएको आवेदन फाइल'],
                    'requirements_en' => ['Token card', 'Checked application file'],
                ],
                [
                    'title_ne' => 'सक्कल कागजात प्रमाणीकरण',
                    'title_en' => 'Original Document Verification',
                    'location_ne' => 'काउन्टर ए-३ — पश्चिम शाखा',
                    'location_en' => 'Counter A-3 — West Wing',
                    'instruction_ne' => 'अधिकृतले नागरिकता, राष्ट्रिय परिचयपत्र र बायोमेट्रिक स्लिप भिडाएर अन्तिम स्वीकृति दिनुहुन्छ।',
                    'instruction_en' => 'Officer verifies citizenship, NID and biometric slip before final approval.',
                    'requirements_ne' => ['सक्कल नागरिकता प्रमाणपत्र', 'बायोमेट्रिक स्लिप'],
                    'requirements_en' => ['Original citizenship certificate', 'Biometric confirmation slip'],
                ],
                [
                    'title_ne' => 'अन्तिम रसिद तथा संकलन मिति',
                    'title_en' => 'Final Receipt & Collection Date',
                    'location_ne' => 'काउन्टर नं. १४ — संकलन विन्डो',
                    'location_en' => 'Counter No. 14 — Collection Window',
                    'instruction_ne' => 'प्रणालीमा अन्तिम विवरण मिलान गरी राहदानी संकलन गर्ने मिति सहितको रसिद लिनुहोस्।',
                    'instruction_en' => 'Confirm final records and collect the passport collection-date slip.',
                    'requirements_ne' => ['बैंक भौचर / कनेक्ट आईपीएस रसिद', 'अधिकृत स्वीकृत फाइल'],
                    'requirements_en' => ['Bank voucher / ConnectIPS receipt', 'Officer-approved dossier'],
                ],
            ],
        ],
        [
            'id' => 'passport_renewal',
            'name_ne' => 'राहदानी नवीकरण वा नयाँ प्रतिस्थापन',
            'name_en' => 'Passport Renewal / Replacement',
            'desc_ne' => 'म्याद सकिएको, पाना सकिएको, वा बिग्रिएको राहदानीको नवीकरण/प्रतिस्थापन प्रक्रिया।',
            'desc_en' => 'Official replacement sequence for expired, fully-stamped, or physically damaged passports.',
            'est_ne' => '३०–४५ मिनेट',
            'est_en' => '30–45 mins',
            'steps' => [
                [
                    'title_ne' => 'पुरानो राहदानी जाँच',
                    'title_en' => 'Previous Passport Check',
                    'location_ne' => 'काउन्टर नं. ४ — केन्द्रीय हल',
                    'location_en' => 'Counter No. 4 — Central Hall',
                    'instruction_ne' => 'पुरानो राहदानी, विवरण पाना र राष्ट्रिय परिचयपत्र प्रतिलिपि रुजु गराउनुहोस्।',
                    'instruction_en' => 'Verify old passport, bio-page copy and NID copy.',
                    'requirements_ne' => ['पुरानो/बिग्रिएको राहदानी', 'राहदानी विवरण पानाको प्रतिलिपि', 'राष्ट्रिय परिचयपत्र प्रतिलिपि'],
                    'requirements_en' => ['Old/damaged passport', 'Passport bio-page photocopy', 'NID copy'],
                ],
                [
                    'title_ne' => 'बायोमेट्रिक्स अद्यावधिक',
                    'title_en' => 'Biometrics Update',
                    'location_ne' => 'कोठा नं. 105 — पहिलो तल्ला',
                    'location_en' => 'Room No. 105 — First Floor',
                    'instruction_ne' => 'नयाँ फोटो, औंठाछाप र दस्तखत अद्यावधिक गराउनुहोस्।',
                    'instruction_en' => 'Update new photo, fingerprints and signature.',
                    'requirements_ne' => ['टोकन कार्ड', 'रुजु भौचर'],
                    'requirements_en' => ['Token card', 'Verification slip'],
                ],
                [
                    'title_ne' => 'रसिद तथा संकलन मिति',
                    'title_en' => 'Receipt & Collection Date',
                    'location_ne' => 'काउन्टर नं. ९ — पूर्वी शाखा',
                    'location_en' => 'Counter No. 9 — East Wing',
                    'instruction_ne' => 'नवीकरण स्वीकृत गराई संकलन मिति सहितको बारकोड रसिद लिनुहोस्।',
                    'instruction_en' => 'Confirm renewal approval and collect the barcoded collection slip.',
                    'requirements_ne' => ['बायोमेट्रिक भौचर', 'रद्द गर्न पुरानो राहदानी'],
                    'requirements_en' => ['Biometric slip', 'Old passport for cancellation'],
                ],
            ],
        ],
        [
            'id' => 'urgent_passport',
            'name_ne' => 'द्रुत सेवा राहदानी (Fast Track)',
            'name_en' => 'Urgent Passport / Fast Track',
            'desc_ne' => 'विशेष वा अत्यावश्यक कामका लागि द्रुत गतिमा राहदानी जारी गर्ने प्राथमिकता प्रक्रिया।',
            'desc_en' => 'Priority operational fast-track passport processing engineered for time-critical travel needs.',
            'est_ne' => '२०–३५ मिनेट',
            'est_en' => '20–35 mins',
            'steps' => [
                [
                    'title_ne' => 'विशेष प्राथमिकता जाँच',
                    'title_en' => 'Priority Screening Desk',
                    'location_ne' => 'प्राथमिकता डेस्क — काउन्टर नं. ११',
                    'location_en' => 'Priority Desk — Counter No. 11',
                    'instruction_ne' => 'द्रुत सेवा शुल्क र अत्यावश्यकता प्रमाणित गर्ने कागजात रुजु गराउनुहोस्।',
                    'instruction_en' => 'Verify fast-track payment and urgency justification documents.',
                    'requirements_ne' => ['द्रुत सेवा भौचर', 'अत्यावश्यकताको प्रमाण', 'सक्कल नागरिकता'],
                    'requirements_en' => ['Fast-track voucher', 'Urgency justification document', 'Original citizenship'],
                ],
                [
                    'title_ne' => 'एक्सप्रेस बायोमेट्रिक्स',
                    'title_en' => 'Express Biometrics',
                    'location_ne' => 'एक्सप्रेस बुथ ७A — भुइँ तल्ला',
                    'location_en' => 'Express Booth 7A — Ground Floor',
                    'instruction_ne' => 'द्रुत लाइनबाट फोटो, औंठाछाप र दस्तखत रेकर्ड गराउनुहोस्।',
                    'instruction_en' => 'Use the priority queue to capture photo, fingerprint and signature.',
                    'requirements_ne' => ['प्राथमिकता टोकन'],
                    'requirements_en' => ['Priority token'],
                ],
                [
                    'title_ne' => 'अन्तिम स्वीकृति तथा रसिद',
                    'title_en' => 'Final Approval & Dispatch Slip',
                    'location_ne' => 'काउन्टर नं. १२ — एक्सप्रेस वितरण च्यानल',
                    'location_en' => 'Counter No. 12 — Express Dispatch Hub',
                    'instruction_ne' => 'अधिकृत स्वीकृति पछि सोही दिन वा अर्को दिन संकलन मिति सहितको रसिद लिनुहोस्।',
                    'instruction_en' => 'After officer approval, collect same-day/next-day dispatch slip.',
                    'requirements_ne' => ['द्रुत प्रक्रिया स्वीकृत फाइल'],
                    'requirements_en' => ['Fast-track approved dossier'],
                ],
            ],
        ],
    ];
};

/**
 * Standard Helper Operations
 */
$services = function () use ($servicesData) {
    return json_decode(json_encode($servicesData()), false);
};

$getServiceById = function ($id) use ($services) {
    return collect($services())->firstWhere('id', $id);
};

/*
|--------------------------------------------------------------------------
| Portal General Web Core Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('portal.home');

Route::get('/select-service', function () use ($services) {
    return view('citizen.select-service', ['services' => $services()]);
})->name('portal.select-service');

Route::get('/contact', function () {
    return view('contact');
})->name('portal.contact');

/*
|--------------------------------------------------------------------------
| Active Citizen Workflow Tracking Pipeline
|--------------------------------------------------------------------------
*/

Route::post('/start-tracking', function (Request $request) use ($getServiceById) {
    $request->validate(['service_id' => ['required', 'string']]);

    if (!$getServiceById($request->input('service_id'))) {
        return redirect()->route('portal.select-service')->with('error', 'Invalid service selected.');
    }

    session([
        'tracking_token' => 'NEP-' . strtoupper(Str::random(4)) . '-' . rand(100, 999),
        'service_id' => $request->input('service_id'),
        'checked_in_at' => now()->toDateTimeString(),
    ]);

    return redirect()->route('portal.active-guide');
})->name('start-tracking');

Route::get('/active-guide', function () use ($getServiceById) {
    $serviceId = session('service_id');
    if (!$serviceId) {
        return redirect()->route('portal.select-service');
    }

    $selectedService = $getServiceById($serviceId);
    if (!$selectedService) {
        session()->forget(['tracking_token', 'service_id']);
        return redirect()->route('portal.select-service');
    }

    return view('citizen.active-guide', [
        'selectedService' => $selectedService,
        'steps' => $selectedService->steps,
    ]);
})->name('portal.active-guide');

/*
|--------------------------------------------------------------------------
| Checkout, Audits, and Evaluation Sequences
|--------------------------------------------------------------------------
*/

Route::get('/checkout', function () use ($getServiceById) {
    $selectedService = session('service_id') ? $getServiceById(session('service_id')) : null;
    return view('citizen.checkout', ['selectedService' => $selectedService]);
})->name('portal.checkout');

Route::post('/submit-checkout', function (Request $request) {
    session([
        'last_feedback' => $request->only([
            'is_successful', 'rating', 'unsuccessful_reason', 'comments', 'is_anonymous', 'citizen_name', 'citizen_phone'
        ]),
        'last_submitted_at' => now()->toDateTimeString(),
    ]);

    session()->forget(['tracking_token', 'service_id', 'checked_in_at']);

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
| Global Context Switches & Utilities
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