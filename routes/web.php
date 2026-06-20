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
/*
|--------------------------------------------------------------------------
| Portal General Web Core Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('portal.home');

Route::get('/select-service', function (Request $request) {
    $deptParam = $request->query('department');
    
    $slugMap = [
        'passport' => 'passport-visa',
        'citizenship' => 'administration',
        'nid' => 'national-id',
        'license' => 'transport',
    ];
    
    $slug = $slugMap[$deptParam] ?? $deptParam;
    
    $department = \App\Models\Department::where('slug', $slug)->first();
    
    if ($department) {
        $services = \App\Models\Service::where('department_id', $department->id)
            ->where('is_active', true)
            ->with('steps')
            ->get();
    } else {
        $services = \App\Models\Service::where('is_active', true)
            ->with('steps')
            ->get();
    }
    
    return view('citizen.select-service', compact('services', 'department'));
})->name('portal.select-service');

Route::get('/contact', function () {
    return view('contact');
})->name('portal.contact');

/*
|--------------------------------------------------------------------------
| Active Citizen Workflow Tracking Pipeline
|--------------------------------------------------------------------------
*/

Route::post('/start-tracking', function (Request $request) {
    $request->validate(['service_id' => ['required', 'exists:services,id']]);

    $service = \App\Models\Service::findOrFail($request->input('service_id'));

    session([
        'tracking_token' => 'NEP-' . strtoupper(Str::random(4)) . '-' . rand(100, 999),
        'service_id' => $service->id,
        'checked_in_at' => now()->toDateTimeString(),
    ]);

    return redirect()->route('portal.active-guide');
})->name('start-tracking');

Route::get('/active-guide', function () {
    $serviceId = session('service_id');
    if (!$serviceId) {
        return redirect()->route('portal.select-service');
    }

    $selectedService = \App\Models\Service::with('steps')->find($serviceId);
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

Route::get('/checkout', function () {
    $selectedService = session('service_id') ? \App\Models\Service::find(session('service_id')) : null;
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

Route::get('/document-checklist/{service}', function ($service) {
    $checklistData = [
        'passport' => [
            'name_ne' => 'राहदानी (Passport) - कागजात चेकलिस्ट',
            'name_en' => 'Passport - Document Checklist',
            'icon' => 'passport.png',
            'bg_gradient' => 'from-blue-600 to-indigo-700',
            'docs' => [
                [
                    'title_ne' => 'राष्ट्रिय परिचयपत्र (NID) नम्बर',
                    'title_en' => 'National Identity Card (NID) Number',
                    'desc_ne' => 'राष्ट्रिय परिचयपत्रको सक्कल कार्ड वा व्यक्तिगत जैविक विवरण संकलन पछि प्राप्त भएको रुजु नम्बर भएको पाना (NID confirmation sheet)।',
                    'desc_en' => 'Original NID card or the barcoded confirmation sheet containing the NID validation number.',
                    'required' => true
                ],
                [
                    'title_ne' => 'सक्कल नेपाली नागरिकता प्रमाणपत्र',
                    'title_en' => 'Original Nepali Citizenship',
                    'desc_ne' => 'सक्कल नेपाली नागरिकताको प्रमाणपत्र। फोटो, हस्ताक्षर र जारी गर्ने अधिकृतको छाप स्पष्ट बुझिने हुनुपर्नेछ।',
                    'desc_en' => 'Original Nepali citizenship certificate. All information, stamp and signatures must be clearly legible.',
                    'required' => true
                ],
                [
                    'title_ne' => 'अनलाइन आवेदन फारम (Printout)',
                    'title_en' => 'Online Application Form Printout',
                    'desc_ne' => 'राहदानी विभागको अनलाइन प्रणालीबाट भरिएको र सफलतापुर्वक पेश गरिएको फारमको प्रिन्ट।',
                    'desc_en' => 'The printed copy of the e-Passport pre-enrollment form submitted online through the passport portal.',
                    'required' => true
                ],
                [
                    'title_ne' => 'पुरानो राहदानी (नवीकरणको हकमा)',
                    'title_en' => 'Old Passport (For Renewals)',
                    'desc_ne' => 'नवीकरण वा प्रतिस्थापन गर्ने भएमा पहिलेको राहदानीको सक्कल र मुख्य पृष्ठहरूको प्रतिलिपि।',
                    'desc_en' => 'If renewing or replacement, bring the original previous passport and photocopies of its main pages.',
                    'required' => false
                ],
                [
                    'title_ne' => 'विवाह/बसाँइसराइ दर्ता (आवश्यकता अनुसार)',
                    'title_en' => 'Marriage/Migration Certificate (If Applicable)',
                    'desc_ne' => 'यदि राहदानीमा थर वा ठेगाना नागरिकता भन्दा फरक राख्नु परेमा नाता प्रमाणित वा आधिकारिक विवाह/बसाँइसराइ प्रमाणपत्र।',
                    'desc_en' => 'Official certificates for marriage or migration if you are changing your surname or address from the citizenship records.',
                    'required' => false
                ]
            ],
            'general_guidelines_ne' => [
                'राजस्व दस्तुर बुझाएको बैंक भौचर वा अनलाइन भुक्तानी रसिद (जस्तै ConnectIPS) अनिवार्य साथमा राख्नुहोस्।',
                'नागरिकता र राष्ट्रिय परिचयपत्रको स्पष्ट प्रतिलिपि १–१ प्रति बोक्नुहोला।',
                'राहदानीको अनलाइन आवेदन गर्दा तोकिएको सक्कल बारकोड स्पष्ट हुनुपर्छ।'
            ],
            'general_guidelines_en' => [
                'Keep the bank revenue voucher or ConnectIPS payment receipt printed and ready.',
                'Bring 1 photocopy of both your Citizenship certificate and NID confirmation sheet.',
                'Ensure the barcode printed on your online pre-enrollment form is clean and unscannable.'
            ]
        ],
        'citizenship' => [
            'name_ne' => 'जिल्ला प्रशासन (नागरिकता) - कागजात चेकलिस्ट',
            'name_en' => 'District Administration (Citizenship) - Document Checklist',
            'icon' => 'Admin.png',
            'bg_gradient' => 'from-amber-600 to-red-700',
            'docs' => [
                [
                    'title_ne' => 'स्थानीय वडा कार्यालयको सिफारिस',
                    'title_en' => 'Local Ward Office Recommendation',
                    'desc_ne' => 'सम्बन्धित स्थानीय तह (वडा कार्यालय) बाट नागरिकता जारी गर्नका लागि प्रमाणित गरिएको सक्कल सिफारिस पत्र।',
                    'desc_en' => 'Original official recommendation letter signed by the local ward authority recommending citizenship issuance.',
                    'required' => true
                ],
                [
                    'title_ne' => 'जन्म दर्ता प्रमाणपत्र',
                    'title_en' => 'Birth Registration Certificate',
                    'desc_ne' => 'स्थानीय पञ्जिकाधिकारीको कार्यालयबाट जारी भएको जन्म दर्ताको सक्कल प्रमाणपत्र।',
                    'desc_en' => 'Original birth registration certificate issued by the local registrar or ward office.',
                    'required' => true
                ],
                [
                    'title_ne' => 'बाबु वा आमाको नागरिकता प्रमाणपत्र',
                    'title_en' => 'Father or Mother\'s Citizenship Certificate',
                    'desc_ne' => 'बाबु वा आमाको सक्कल नेपाली नागरिकता प्रमाणपत्र र सोको प्रतिलिपि। नाता प्रमाणितका लागि यो अनिवार्य छ।',
                    'desc_en' => 'Original citizenship certificate of either father or mother, along with 1 photocopy for relationship verification.',
                    'required' => true
                ],
                [
                    'title_ne' => 'शैक्षिक योग्यताको प्रमाणपत्र (यदि आवश्यक भएमा)',
                    'title_en' => 'Academic Certificates (Optional)',
                    'desc_ne' => 'उमेर तथा जन्म मिति थप पुष्टि गर्न ८ कक्षा वा एसईई (SEE) उत्तीर्ण गरेको प्रमाणपत्र।',
                    'desc_en' => 'School-leaving certificates (Class 8 or SEE/SLC) if birth date needs further corroboration or clarification.',
                    'required' => false
                ],
                [
                    'title_ne' => 'वंशज/सम्बन्ध प्रमाणीकरण पत्र',
                    'title_en' => 'Lineage / Relationship Certificate',
                    'desc_ne' => 'वडा कार्यालयबाट जारी नाता प्रमाणित प्रमाणपत्र जसले आमाबाबु र निवेदकको सम्बन्ध पुष्टि गर्छ।',
                    'desc_en' => 'Official family relationship declaration certificate issued by the ward office.',
                    'required' => true
                ]
            ],
            'general_guidelines_ne' => [
                'नागरिकता बनाउँदा आमा/बाबु वा संरक्षक (नातेदार) मध्ये एकजना सनाखतका लागि जिल्ला प्रशासन कार्यालयमा उपस्थित हुनुपर्नेछ।',
                'तोकिएको साइजको हालसालै खिचिएको सेतो पृष्ठभूमि भएको ३ प्रति पासपोर्ट साइज फोटो साथमा ल्याउनुहोस्।',
                'सबै सक्कल कागजातहरू सहित रुजुका लागि तयार रहनुहोला।'
            ],
            'general_guidelines_en' => [
                'Either father, mother, or close relative must visit the district administration office to witness/authenticate details.',
                'Bring 3 recent passport-size photos with a solid white background.',
                'Ensure all original documents are systematically filed for quick verification.'
            ]
        ],
        'nid' => [
            'name_ne' => 'राष्ट्रिय परिचयपत्र (NID) - कागजात चेकलिस्ट',
            'name_en' => 'National ID (NID) - Document Checklist',
            'icon' => 'nid.png',
            'bg_gradient' => 'from-emerald-600 to-teal-700',
            'docs' => [
                [
                    'title_ne' => 'सक्कल नेपाली नागरिकता प्रमाणपत्र',
                    'title_en' => 'Original Nepali Citizenship',
                    'desc_ne' => 'राष्ट्रिय परिचयपत्र अनलाइन दर्ता र रुजुका लागि नेपाली नागरिकताको सक्कल प्रमाणपत्र अनिवार्य छ।',
                    'desc_en' => 'Original Nepali citizenship certificate. It is the primary credential required for biometric validation.',
                    'required' => true
                ],
                [
                    'title_ne' => 'अनलाइन प्रि-एनरोलमेन्ट फारम र बारकोड',
                    'title_en' => 'Pre-Enrollment Form & Barcode',
                    'desc_ne' => 'राष्ट्रिय परिचयपत्रको अनलाइन पोर्टलमा विवरण भरेर प्राप्त भएको अनलाइन दर्ता आवेदन रसिदको प्रिन्ट।',
                    'desc_en' => 'Printed confirmation copy of the pre-enrollment form containing the registration date and barcode.',
                    'required' => true
                ],
                [
                    'title_ne' => 'विवाह दर्ता प्रमाणपत्र (विवाहितको हकमा)',
                    'title_en' => 'Marriage Registration Certificate',
                    'desc_ne' => 'विवाहित महिलाको हकमा नागरिकतामा पतिको नाम वा ठेगाना उल्लेख नभएमा विवाह दर्ताको सक्कल प्रमाणपत्र।',
                    'desc_en' => 'For married applicants if the surname or spouse information differs from their original citizenship certificate.',
                    'required' => false
                ],
                [
                    'title_ne' => 'बसाँइसराइ दर्ता प्रमाणपत्र (ठेगाना फरक भएमा)',
                    'title_en' => 'Migration Certificate (If Address Changed)',
                    'desc_ne' => 'साविकको ठेगाना परिवर्तन भई हालको ठेगानाबाट राष्ट्रिय परिचयपत्र लिनु परेमा बसाँइसराइको सक्कल प्रमाणपत्र।',
                    'desc_en' => 'Original migration certificate if applying from a district/municipality different from the citizenship issuer district.',
                    'required' => false
                ]
            ],
            'general_guidelines_ne' => [
                'राष्ट्रिय परिचयपत्रका लागि बायोमेट्रिक (औंठाछाप, आँखाको नानी र फोटो) संकलन केन्द्रमा भौतिक रूपमा स्वयं उपस्थित हुनुपर्छ।',
                'हातमा मेहन्दी वा रङ नलगाउनुहोस् ता कि बायोमेट्रिक मेसिनले सजिलै औंठाछाप स्क्यान गर्न सकोस्।',
                'यो सेवा हाललाई निःशुल्क छ, कुनै अतिरिक्त शुल्क लाग्ने छैन।'
            ],
            'general_guidelines_en' => [
                'Applicant must be physically present at the enrollment center for biometrics (fingerprints, iris, and digital photo).',
                'Do not apply mehndi or colors on fingers prior to scanning, to ensure fingerprint readers function correctly.',
                'The enrollment process is currently free of charge.'
            ]
        ],
        'license' => [
            'name_ne' => 'यातायात व्यवस्था (लाइसेन्स) - कागजात चेकलिस्ट',
            'name_en' => 'Transport Management (License) - Document Checklist',
            'icon' => 'transport.png',
            'bg_gradient' => 'from-slate-700 to-blue-800',
            'docs' => [
                [
                    'title_ne' => 'अनलाइन आवेदन फारम प्रिन्ट',
                    'title_en' => 'Online Application Form Printout',
                    'desc_ne' => 'यातायात व्यवस्था विभागको अनलाइन लाइसेन्स दर्ता प्रणालीबाट भरेको आवेदन फारमको प्रिन्ट।',
                    'desc_en' => 'Printed copy of the online driving license application registration receipt.',
                    'required' => true
                ],
                [
                    'title_ne' => 'सक्कल नेपाली नागरिकता प्रमाणपत्र',
                    'title_en' => 'Original Nepali Citizenship',
                    'desc_ne' => 'सक्कल नागरिकता प्रमाणपत्र र सोको स्पष्ट देखिने १ प्रति फोटोकपी।',
                    'desc_en' => 'Original Nepali citizenship certificate (or valid passport) along with 1 photocopy.',
                    'required' => true
                ],
                [
                    'title_ne' => 'निरोगिताको प्रमाणपत्र (Medical Report)',
                    'title_en' => 'Medical Fitness Certificate',
                    'desc_ne' => 'स्वीकृत सरकारी वा तोकिएको चिकित्सकबाट आँखा परीक्षण र रगत समूह (Blood Group) प्रमाणित गरिएको रिपोर्ट।',
                    'desc_en' => 'Official physical fitness certificate certifying color-blindness check and blood group confirmation.',
                    'required' => true
                ],
                [
                    'title_ne' => 'सवारी चालक अनुमति पत्र (नयाँ वर्ग थपको हकमा)',
                    'title_en' => 'Existing License (For Category Additions)',
                    'desc_ne' => 'सवारी चालक अनुमति पत्रमा थप वर्ग आवेदन गर्ने भएमा पुरानो लाइसेन्सको सक्कल प्रमाणपत्र।',
                    'desc_en' => 'Original active driving license certificate if applying for category extension (e.g. adding Car to Motorbike).',
                    'required' => false
                ]
            ],
            'general_guidelines_ne' => [
                'बायोमेट्रिक्स र कागजात बुझाउन जाँदा रसिद र नागरिकता अनिवार्य बोक्नुहोस्।',
                'लिखित तथा प्रयोगात्मक (Trial) परीक्षाका लागि तोकिएको मिति र केन्द्रमा समयमै उपस्थित हुनुहोला।',
                'लाइसेन्स दस्तुर र परीक्षा शुल्क तोकिएको दरमा बुझाउनुपर्नेछ।'
            ],
            'general_guidelines_en' => [
                'Always bring your printed application receipt and original citizenship for documentation checks.',
                'Ensure you arrive early on written and trial exam days at the allocated center.',
                'Keep application and trial evaluation fees prepared in cash or via valid payment vouchers.'
            ]
        ]
    ];

    if (!array_key_exists($service, $checklistData)) {
        abort(404, 'Service checklist not found.');
    }

    return view('citizen.document-checklist', [
        'serviceKey' => $service,
        'checklist' => $checklistData[$service],
        'services' => \App\Models\Service::where('is_active', true)->get()
    ]);
})->name('portal.document-checklist');

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