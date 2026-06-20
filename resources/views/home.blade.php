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
<div class="max-w-6xl mx-auto px-4 py-2 sm:py-4 selection:bg-blue-600 selection:text-white">
    
    <!-- Main Core Header Section -->
    <header class="text-center mb-8">
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
            {{ $ne ? 'नागरिक सेवा केन्द्र' :  'Citizen Service Hub' }}
        </h1>
        <p class="mt-3 text-sm sm:text-base text-slate-500 max-w-2xl mx-auto leading-relaxed font-medium">
            {{ $ne ? 'नेपाल सरकारका विभिन्न प्रशासनिक सेवाहरूको सहज, आधिकारिक र चरणबद्ध डिजिटल मार्गदर्शन। आफूलाई आवश्यक सेवा चयन गर्नुहोस्।' : 'Official step-by-step administrative workflow guidance for public services under the Government of Nepal. Please select your required service context below.' }}
        </p>
    </header>

    <!-- Services Dynamic Grid Layout (4 Cards in a single line on desktop) -->
    <main>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
            
            <!-- Card 1: Passport Department -->
            <div class="group bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-sm hover:shadow-[0_20px_40px_rgba(15,23,42,0.06)] hover:-translate-y-1 hover:border-blue-600 hover:bg-gradient-to-b hover:from-white hover:to-blue-50/20 transition-all duration-300 flex flex-col justify-between cursor-pointer">
                <div>
                    <img src="{{ asset('images/passport.png') }}" alt="Passport Icon" class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 flex items-center justify-center text-lg sm:text-xl font-semibold group-hover:bg-blue-600 group-hover:border-blue-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        
                    <h3 class="mt-4 text-sm sm:text-base font-bold text-slate-900 group-hover:text-blue-700 transition-colors duration-300 tracking-tight">
                        {{ $ne ? 'राहदानी विभाग (e-Passport)' : 'Passport Department' }}
                    </h3>
                    <p class="hidden sm:block mt-2 text-xs md:text-sm leading-relaxed text-slate-500 font-medium">
                        {{ $ne ? 'नयाँ राहदानी आवेदन, नवीकरण, दस्तुर विवरण तथा आवश्यक कागजातहरूको पूर्ण सूची।' : 'Comprehensive workflow guidance for new biometric passport issuance, fees, and checklists.' }}
                    </p>
                </div>
                <div class="mt-5 pt-4 border-t border-slate-100">
                    <a href="{{ route('portal.document-checklist', ['service' => 'passport']) }}" class="w-full inline-flex items-center justify-center gap-1.5 py-2.5 rounded-xl bg-slate-50 group-hover:bg-blue-600 text-slate-700 group-hover:text-white font-bold text-xs border border-slate-200 group-hover:border-blue-600 transition-all duration-300 shadow-sm">
                        <span>{{ $ne ? 'कागजात र विवरण' : 'View Details' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3 transform group-hover:translate-x-0.5 transition-transform duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Card 2: District Administration -->
            <div class="group bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-sm hover:shadow-[0_20px_40px_rgba(15,23,42,0.06)] hover:-translate-y-1 hover:border-blue-600 hover:bg-gradient-to-b hover:from-white hover:to-blue-50/20 transition-all duration-300 flex flex-col justify-between cursor-pointer">
                <div>
                    <img src="{{ asset('images/Admin.png') }}" alt="District Administration Icon" class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 flex items-center justify-center text-lg sm:text-xl font-semibold group-hover:bg-blue-600 group-hover:border-blue-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        
                    <h3 class="mt-4 text-sm sm:text-base font-bold text-slate-900 group-hover:text-blue-700 transition-colors duration-300 tracking-tight">
                        {{ $ne ? 'जिल्ला प्रशासन (नागरिकता)' : 'District Administration' }}
                    </h3>
                    <p class="hidden sm:block mt-2 text-xs md:text-sm leading-relaxed text-slate-500 font-medium">
                        {{ $ne ? 'नयाँ नागरिकता प्रमाणपत्र प्रमाणपत्र प्राप्ति, प्रतिलिपि वा आधिकारिक विवरण सच्याउने प्रक्रिया।' : 'Detailed process routing for acquiring new citizenship documentation, duplicates, or updates.' }}
                    </p>
                </div>
                <div class="mt-5 pt-4 border-t border-slate-100">
                    <a href="{{ route('portal.document-checklist', ['service' => 'citizenship']) }}" class="w-full inline-flex items-center justify-center gap-1.5 py-2.5 rounded-xl bg-slate-50 group-hover:bg-blue-600 text-slate-700 group-hover:text-white font-bold text-xs border border-slate-200 group-hover:border-blue-600 transition-all duration-300 shadow-sm">
                        <span>{{ $ne ? 'कागजात र विवरण' : 'View Details' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3 transform group-hover:translate-x-0.5 transition-transform duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Card 3: National ID -->
            <div class="group bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-sm hover:shadow-[0_20px_40px_rgba(15,23,42,0.06)] hover:-translate-y-1 hover:border-blue-600 hover:bg-gradient-to-b hover:from-white hover:to-blue-50/20 transition-all duration-300 flex flex-col justify-between cursor-pointer">
                <div>
                    <img src="{{ asset('images/nid.png') }}" alt="National ID Icon" class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 flex items-center justify-center text-lg sm:text-xl font-semibold group-hover:bg-blue-600 group-hover:border-blue-600 group-hover:text-white transition-all duration-300 shadow-sm">
                    <h3 class="mt-4 text-sm sm:text-base font-bold text-slate-900 group-hover:text-blue-700 transition-colors duration-300 tracking-tight">
                        {{ $ne ? 'राष्ट्रिय परिचयपत्र (NID)' : 'National ID & Registration' }}
                    </h3>
                    <p class="hidden sm:block mt-2 text-xs md:text-sm leading-relaxed text-slate-500 font-medium">
                        {{ $ne ? 'राष्ट्रिय परिचयपत्रको अनलाइन दर्ता फारम, जैविक (Biometric) विवरण संकलन केन्द्रहरू र वितरणको अवस्था।' : 'Online registration workflows, operational biometric collection desk data, and status tracking.' }}
                    </p>
                </div>
                <div class="mt-5 pt-4 border-t border-slate-100">
                    <a href="{{ route('portal.document-checklist', ['service' => 'nid']) }}" class="w-full inline-flex items-center justify-center gap-1.5 py-2.5 rounded-xl bg-slate-50 group-hover:bg-blue-600 text-slate-700 group-hover:text-white font-bold text-xs border border-slate-200 group-hover:border-blue-600 transition-all duration-300 shadow-sm">
                        <span>{{ $ne ? 'कागजात र विवरण' : 'View Details' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3 transform group-hover:translate-x-0.5 transition-transform duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Card 4: Driving License -->
            <div class="group bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-sm hover:shadow-[0_20px_40px_rgba(15,23,42,0.06)] hover:-translate-y-1 hover:border-blue-600 hover:bg-gradient-to-b hover:from-white hover:to-blue-50/20 transition-all duration-300 flex flex-col justify-between cursor-pointer">
                <div>
                    <img src="{{ asset('images/transport.png') }}" alt="Driving License Icon" class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 flex items-center justify-center text-lg sm:text-xl font-semibold group-hover:bg-blue-600 group-hover:border-blue-600 group-hover:text-white transition-all duration-300 shadow-sm">
                    <h3 class="mt-4 text-sm sm:text-base font-bold text-slate-900 group-hover:text-blue-700 transition-colors duration-300 tracking-tight">
                        {{ $ne ? 'यातायात व्यवस्था (लाइसेन्स)' : 'Transport Management' }}
                    </h3>
                    <p class="hidden sm:block mt-2 text-xs md:text-sm leading-relaxed text-slate-500 font-medium">
                        {{ $ne ? 'नयाँ सवारी चालक अनुमति पत्र आवेदन, वर्ग थप, लिखित तथा प्रयोगात्मक परीक्षा निर्देशिका।' : 'New driving license schedules, biometric workflows, category additions, and renewal systems.' }}
                    </p>
                </div>
                <div class="mt-5 pt-4 border-t border-slate-100">
                    <a href="{{ route('portal.document-checklist', ['service' => 'license']) }}" class="w-full inline-flex items-center justify-center gap-1.5 py-2.5 rounded-xl bg-slate-50 group-hover:bg-blue-600 text-slate-700 group-hover:text-white font-bold text-xs border border-slate-200 group-hover:border-blue-600 transition-all duration-300 shadow-sm">
                        <span>{{ $ne ? 'कागजात र विवरण' : 'View Details' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3 transform group-hover:translate-x-0.5 transition-transform duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </main>

    <!-- Clear, Functional Bottom Meta Information Section -->
    <footer class="mt-10 pt-6 border-t border-slate-200">
        <!-- Eye-catching Security Badge -->
        <div class="mt-5 flex justify-center">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-full bg-emerald-50 border border-emerald-200 text-[11px] sm:text-xs text-emerald-800 font-bold shadow-sm tracking-wide">
                🔒 {{ $ne ? 'कुनै लगइन आवश्यक छैन • नागरिक सहजताका लागि सुरक्षित सेवा' : 'No Login Required • Secure Routing Engineered for Public Utility' }}
            </span>
        </div>
    </footer>
</div>
@endsection