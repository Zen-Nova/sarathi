@extends('layouts.citizen')

@php
    // Instantly catch the language switch click and save it to the session right here
    if (request()->has('locale')) {
        $targetLocale = request()->query('locale');
        if (in_array($targetLocale, ['ne', 'en'])) {
            session(['locale' => $targetLocale]);
            app()->setLocale($targetLocale);
        }
    }

    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'नागरिक सारथी' : 'Nagarik Sarthi')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6 selection:bg-blue-600 selection:text-white font-sans">
    
    <!-- Professional Enterprise Header Section -->
    <header class="text-center mb-10 space-y-3">
        <div>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded border border-blue-200 bg-blue-50/50 text-[10px] font-bold uppercase tracking-widest text-blue-700 shadow-sm">
                {{ $ne ? 'आधिकारिक डिजिटल पोर्टल' : 'Official Digital Portal' }}
            </span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">
            {{ $ne ? 'नागरिक सेवा केन्द्र' : 'Citizen Service Hub' }}
        </h1>
        <p class="text-xs sm:text-sm text-slate-500 max-w-2xl mx-auto leading-relaxed font-normal">
            {{ $ne ? 'नेपाल सरकारका विभिन्न प्रशासनिक सेवाहरूको सहज, आधिकारिक र चरणबद्ध डिजिटल मार्गदर्शन। आफूलाई आवश्यक सेवा चयन गर्नुहोस्।' : 'Official step-by-step administrative workflow guidance for public services under the Government of Nepal. Please select your required service context below.' }}
        </p>
    </header>

    <!-- Services Dynamic Grid Layout (Perfect Alignment & Micro-interactions) -->
    <main>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
            
            <!-- Card 1: Passport Department -->
            <div class="group bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-xs hover:shadow-md hover:-translate-y-0.5 hover:border-blue-600 transition-all duration-200 flex flex-col justify-between cursor-pointer">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 p-2 flex items-center justify-center transition-colors duration-200 group-hover:bg-blue-50/50 group-hover:border-blue-200 shadow-2xs">
                        <img src="{{ asset('images/passport.png') }}" alt="Passport Icon" class="w-full h-full object-contain">
                    </div>
                    <div class="space-y-1.5">
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-blue-700 transition-colors duration-200 tracking-tight">
                            {{ $ne ? 'राहदानी विभाग (e-Passport)' : 'Passport Department' }}
                        </h3>
                        <p class="hidden sm:block text-xs text-slate-500 leading-relaxed font-normal">
                            {{ $ne ? 'नयाँ राहदानी आवेदन, नवीकरण, दस्तुर विवरण तथा आवश्यक कागजातहरूको पूर्ण सूची।' : 'Comprehensive workflow guidance for new biometric passport issuance, fees, and checklists.' }}
                        </p>
                    </div>
                </div>
                <div class="mt-5 pt-3 border-t border-slate-100">
                    <a href="{{ route('portal.document-checklist', ['service' => 'passport']) }}" class="w-full inline-flex items-center justify-center gap-1.5 py-2 rounded-xl bg-slate-50 border border-slate-200 group-hover:bg-blue-600 group-hover:border-blue-600 text-slate-700 group-hover:text-white font-semibold text-xs transition-all duration-200 shadow-2xs">
                        <span>{{ $ne ? 'कागजात र विवरण' : 'View Details' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 transform group-hover:translate-x-0.5 transition-transform duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Card 2: District Administration -->
            <div class="group bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-xs hover:shadow-md hover:-translate-y-0.5 hover:border-blue-600 transition-all duration-200 flex flex-col justify-between cursor-pointer">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 p-2 flex items-center justify-center transition-colors duration-200 group-hover:bg-blue-50/50 group-hover:border-blue-200 shadow-2xs">
                        <img src="{{ asset('images/Admin.png') }}" alt="District Administration Icon" class="w-full h-full object-contain">
                    </div>
                    <div class="space-y-1.5">
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-blue-700 transition-colors duration-200 tracking-tight">
                            {{ $ne ? 'जिल्ला प्रशासन (नागरिकता)' : 'District Administration' }}
                        </h3>
                        <p class="hidden sm:block text-xs text-slate-500 leading-relaxed font-normal">
                            {{ $ne ? 'नयाँ नागरिकता प्रमाणपत्र प्रमाणपत्र प्राप्ति, प्रतिलिपि वा आधिकारिक विवरण सच्याउने प्रक्रिया।' : 'Detailed process routing for acquiring new citizenship documentation, duplicates, or updates.' }}
                        </p>
                    </div>
                </div>
                <div class="mt-5 pt-3 border-t border-slate-100">
                    <a href="{{ route('portal.document-checklist', ['service' => 'citizenship']) }}" class="w-full inline-flex items-center justify-center gap-1.5 py-2 rounded-xl bg-slate-50 border border-slate-200 group-hover:bg-blue-600 group-hover:border-blue-600 text-slate-700 group-hover:text-white font-semibold text-xs transition-all duration-200 shadow-2xs">
                        <span>{{ $ne ? 'कागजात र विवरण' : 'View Details' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 transform group-hover:translate-x-0.5 transition-transform duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Card 3: National ID -->
            <div class="group bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-xs hover:shadow-md hover:-translate-y-0.5 hover:border-blue-600 transition-all duration-200 flex flex-col justify-between cursor-pointer">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 p-2 flex items-center justify-center transition-colors duration-200 group-hover:bg-blue-50/50 group-hover:border-blue-200 shadow-2xs">
                        <img src="{{ asset('images/nid.png') }}" alt="National ID Icon" class="w-full h-full object-contain">
                    </div>
                    <div class="space-y-1.5">
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-blue-700 transition-colors duration-200 tracking-tight">
                            {{ $ne ? 'राष्ट्रिय परिचयपत्र (NID)' : 'National ID & Registration' }}
                        </h3>
                        <p class="hidden sm:block text-xs text-slate-500 leading-relaxed font-normal">
                            {{ $ne ? 'राष्ट्रिय परिचयपत्रको अनलाइन दर्ता फारम, जैविक (Biometric) विवरण संकलन केन्द्रहरू र वितरणको अवस्था।' : 'Online registration workflows, operational biometric collection desk data, and status tracking.' }}
                        </p>
                    </div>
                </div>
                <div class="mt-5 pt-3 border-t border-slate-100">
                    <a href="{{ route('portal.document-checklist', ['service' => 'nid']) }}" class="w-full inline-flex items-center justify-center gap-1.5 py-2 rounded-xl bg-slate-50 border border-slate-200 group-hover:bg-blue-600 group-hover:border-blue-600 text-slate-700 group-hover:text-white font-semibold text-xs transition-all duration-200 shadow-2xs">
                        <span>{{ $ne ? 'कागजात र विवरण' : 'View Details' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 transform group-hover:translate-x-0.5 transition-transform duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Card 4: Driving License -->
            <div class="group bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-xs hover:shadow-md hover:-translate-y-0.5 hover:border-blue-600 transition-all duration-200 flex flex-col justify-between cursor-pointer">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 p-2 flex items-center justify-center transition-colors duration-200 group-hover:bg-blue-50/50 group-hover:border-blue-200 shadow-2xs">
                        <img src="{{ asset('images/transport.png') }}" alt="Driving License Icon" class="w-full h-full object-contain">
                    </div>
                    <div class="space-y-1.5">
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-blue-700 transition-colors duration-200 tracking-tight">
                            {{ $ne ? 'यातायात व्यवस्था (लाइसेन्स)' : 'Transport Management' }}
                        </h3>
                        <p class="hidden sm:block text-xs text-slate-500 leading-relaxed font-normal">
                            {{ $ne ? 'नयाँ सवारी चालक अनुमति पत्र आवेदन, वर्ग थप, लिखित तथा प्रयोगात्मक परीक्षा निर्देशिका।' : 'New driving license schedules, biometric workflows, category additions, and renewal systems.' }}
                        </p>
                    </div>
                </div>
                <div class="mt-5 pt-3 border-t border-slate-100">
                    <a href="{{ route('portal.document-checklist', ['service' => 'license']) }}" class="w-full inline-flex items-center justify-center gap-1.5 py-2 rounded-xl bg-slate-50 border border-slate-200 group-hover:bg-blue-600 group-hover:border-blue-600 text-slate-700 group-hover:text-white font-semibold text-xs transition-all duration-200 shadow-2xs">
                        <span>{{ $ne ? 'कागजात र विवरण' : 'View Details' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 transform group-hover:translate-x-0.5 transition-transform duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </main>

    <!-- Refactored Minimalist Footer Section -->
    <footer class="mt-12 pt-6 border-t border-slate-200/60 flex flex-col items-center justify-center">
        <!-- Secure Badge Grid Placement -->
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 border border-emerald-200 text-xs text-emerald-800 font-semibold shadow-2xs tracking-wide">
            <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            <span>{{ $ne ? 'कुनै लगइन आवश्यक छैन • नागरिक सहजताका लागि सुरक्षित सेवा' : 'No Login Required • Secure Routing Engineered for Public Utility' }}</span>
        </div>
    </footer>
</div>
@endsection