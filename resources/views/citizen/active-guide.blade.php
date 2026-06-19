@extends('layouts.citizen')

@section('content')
<div class="max-w-md mx-auto px-4 py-6 space-y-6">
    
    <div class="bg-blue-950 text-white rounded-xl p-4 flex justify-between items-center shadow-sm">
        <div>
            <span class="text-[10px] uppercase font-bold tracking-wider text-blue-300 block">सक्रिय टोकन / Token Token</span>
            <span class="font-mono font-black text-sm">{{ session('tracking_token') ?? 'N/A' }}</span>
        </div>
        <span class="text-xs bg-blue-800 px-2.5 py-1 rounded-full font-bold animate-pulse text-blue-100">● Live Tracking</span>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
        <h3 class="text-sm font-black text-slate-900 mb-4 flex items-center gap-2">
            <span>🗺️</span> काउन्टर मार्गनिर्देशन / Counter Sequence Roadmap
        </h3>

        <div class="relative pl-6 border-l-2 border-slate-100 space-y-6 ml-2">
            @forelse($steps ?? [] as $index => $step)
                <div class="relative">
                    <div class="absolute -left-[31px] top-0 w-4 h-4 rounded-full bg-blue-600 border-4 border-white ring-1 ring-blue-600 flex items-center justify-center"></div>
                    
                    <h4 class="font-black text-slate-800 text-xs">
                        {{ __('messages.step') ?? 'चरण' }} {{ $index + 1 }}: {{ App::getLocale() == 'ne' ? $step->location_ne : $step->location_en }}
                    </h4>
                    <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">
                        {{ App::getLocale() == 'ne' ? $step->instruction_ne : $step->instruction_en }}
                    </p>
                </div>
            @empty
                <div class="relative">
                    <div class="absolute -left-[31px] top-0 w-4 h-4 rounded-full bg-blue-600 border-4 border-white ring-1 ring-blue-600"></div>
                    <h4 class="font-bold text-slate-800 text-xs">काउन्टर नं. ३: कागजात प्रमाणीकरण (Counter 3: Verification)</h4>
                    <p class="text-[11px] text-slate-400 mt-0.5">Present your original citizenship certificate and pre-enrollment form here.</p>
                </div>
                <div class="relative">
                    <div class="absolute -left-[31px] top-0 w-4 h-4 rounded-full bg-slate-200 border-4 border-white ring-1 ring-slate-300"></div>
                    <h4 class="font-bold text-slate-600 text-xs">कोठा नं. १२: बायोमेट्रिक संकलन (Room 12: Biometrics)</h4>
                    <p class="text-[11px] text-slate-400 mt-0.5">Proceed here next for your digital photograph signature, and fingerprint capture.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="bg-amber-50/50 border border-amber-200 rounded-xl p-4">
        <h4 class="font-bold text-xs text-amber-900 flex items-center gap-1.5 mb-2">
            ⚠️ आवश्यक कागजात चेकलिस्ट / Mandatory Checklists:
        </h4>
        <ul class="text-[11px] text-amber-800 space-y-1 pl-4 list-disc">
            <li>Original Nepali Citizenship Certificate (नेपाली नागरिकताको प्रमाणपत्र)</li>
            <li>Printed Online Pre-Enrollment Receipt Form with Barcode</li>
            <li>Old Passport Document (If applying for a Renewal track)</li>
        </ul>
    </div>

    <p class="text-center text-[10px] text-slate-400 leading-normal bg-slate-50 p-3 rounded-xl border border-dashed border-slate-200">
        📢 Once you completely finish all operations inside the building, proceed back to the main exit gate area and scan the barcode QR endpoint again to submit your workflow logging exit timestamp.
    </p>
</div>
@endsection