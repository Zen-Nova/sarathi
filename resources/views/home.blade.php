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
<div class="max-w-5xl mx-auto px-4 py-6 sm:py-10 selection:bg-blue-500 selection:text-white">
    
    <header class="text-center mb-12">
        <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-slate-900">
            {{ $ne ? 'विभागीय नागरिक सेवा केन्द्र' : 'Departmental Citizen Service Hub' }}
        </h1>
        <p class="mt-3 text-sm sm:text-base text-slate-600 max-w-2xl mx-auto leading-relaxed">
            {{ $ne ? 'नेपाल सरकारका विभिन्न प्रशासनिक सेवाहरूको सहज, आधिकारिक र चरणबद्ध डिजिटल मार्गदर्शन। आफूलाई आवश्यक सेवा चयन गर्नुहोस्।' : 'Official step-by-step administrative workflow guidance for public services under the Government of Nepal. Please select your required service context below.' }}
        </p>
    </header>

    <main>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="group bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-blue-600 transition-all duration-300 flex flex-col justify-between cursor-pointer">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 flex items-center justify-center text-xl font-semibold group-hover:bg-blue-50 group-hover:border-blue-100 group-hover:text-blue-700 transition-all duration-300">
                        🛂
                    </div>
                    <h3 class="mt-4 text-lg font-black text-slate-900 group-hover:text-blue-700 transition-colors duration-300">
                        {{ $ne ? 'राहदानी विभाग (e-Passport)' : 'Passport Department (e-Passport)' }}
                    </h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-500">
                        {{ $ne ? 'नयाँ राहदानी आवेदन, नवीकरण, दस्तुर विवरण तथा आवश्यक कागजातहरूको पूर्ण प्रमाणिकरण सूची।' : 'Comprehensive workflow guidance for new biometric passport issuance, official fees, and verified document checklists.' }}
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400 group-hover:text-slate-500 transition-colors duration-300">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        {{ $ne ? 'प्रवेश क्यूआर उपलब्ध' : 'Entry QR Integrated' }}
                    </span>
                    <a href="{{ route('workflow.scan', ['service' => 'passport']) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-900 group-hover:bg-blue-700 text-white font-black text-xs transition-all duration-300 shadow-sm">
                        <span>{{ $ne ? 'अगाडि बढ्नुहोस्' : 'Proceed' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 transform group-hover:translate-x-0.5 transition-transform duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="group bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-blue-600 transition-all duration-300 flex flex-col justify-between cursor-pointer">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 flex items-center justify-center text-xl font-semibold group-hover:bg-blue-50 group-hover:border-blue-100 group-hover:text-blue-700 transition-all duration-300">
                        📜
                    </div>
                    <h3 class="mt-4 text-lg font-black text-slate-900 group-hover:text-blue-700 transition-colors duration-300">
                        {{ $ne ? 'जिल्ला प्रशासन कार्यालय (नागरिकता)' : 'District Administration (Citizenship)' }}
                    </h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-500">
                        {{ $ne ? 'नयाँ नागरिकता प्रमाणपत्र प्रमाणपत्र प्राप्ति, प्रतिलिपि (सिफारिस) वा आधिकारिक विवरण सच्याउने प्रक्रिया।' : 'Detailed process routing for acquiring new citizenship documentation, official duplicates (Pratilipi), or data updates.' }}
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400 group-hover:text-slate-500 transition-colors duration-300">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        {{ $ne ? 'प्रवेश क्यूआर उपलब्ध' : 'Entry QR Integrated' }}
                    </span>
                    <a href="{{ route('workflow.scan', ['service' => 'citizenship']) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-900 group-hover:bg-blue-700 text-white font-black text-xs transition-all duration-300 shadow-sm">
                        <span>{{ $ne ? 'अगाडि बढ्नुहोस्' : 'Proceed' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 transform group-hover:translate-x-0.5 transition-transform duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="group bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-blue-600 transition-all duration-300 flex flex-col justify-between cursor-pointer">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 flex items-center justify-center text-xl font-semibold group-hover:bg-blue-50 group-hover:border-blue-100 group-hover:text-blue-700 transition-all duration-300">
                        🪪
                    </div>
                    <h3 class="mt-4 text-lg font-black text-slate-900 group-hover:text-blue-700 transition-colors duration-300">
                        {{ $ne ? 'राष्ट्रिय परिचयपत्र (National ID)' : 'National ID & Registration' }}
                    </h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-500">
                        {{ $ne ? 'राष्ट्रिय परिचयपत्रको अनलाइन दर्ता फारम, जैविक (Biometric) विवरण संकलन केन्द्रहरू र वितरणको अवस्था।' : 'Online registration workflows, operational biometric collection desk data, and status tracking updates.' }}
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400 group-hover:text-slate-500 transition-colors duration-300">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        {{ $ne ? 'प्रवेश क्यूआर उपलब्ध' : 'Entry QR Integrated' }}
                    </span>
                    <a href="{{ route('workflow.scan', ['service' => 'nid']) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-900 group-hover:bg-blue-700 text-white font-black text-xs transition-all duration-300 shadow-sm">
                        <span>{{ $ne ? 'अगाडि बढ्नुहोस्' : 'Proceed' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 transform group-hover:translate-x-0.5 transition-transform duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="group bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-blue-600 transition-all duration-300 flex flex-col justify-between cursor-pointer">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 flex items-center justify-center text-xl font-semibold group-hover:bg-blue-50 group-hover:border-blue-100 group-hover:text-blue-700 transition-all duration-300">
                        🚗
                    </div>
                    <h3 class="mt-4 text-lg font-black text-slate-900 group-hover:text-blue-700 transition-colors duration-300">
                        {{ $ne ? 'यातायात व्यवस्था विभाग (लाइसेन्स)' : 'Transport Management (License)' }}
                    </h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-500">
                        {{ $ne ? 'नयाँ सवारी चालक अनुमति पत्र आवेदन, वर्ग थप (Category Add), लिखित तथा प्रयोगात्मक परीक्षा निर्देशिका।' : 'New driving license schedules, biometric check-in workflows, category additions, and renewal systems.' }}
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400 group-hover:text-slate-500 transition-colors duration-300">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        {{ $ne ? 'प्रवेश क्यूआर उपलब्ध' : 'Entry QR Integrated' }}
                    </span>
                    <a href="{{ route('workflow.scan', ['service' => 'license']) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-900 group-hover:bg-blue-700 text-white font-black text-xs transition-all duration-300 shadow-sm">
                        <span>{{ $ne ? 'अगाडि बढ्नुहोस्' : 'Proceed' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 transform group-hover:translate-x-0.5 transition-transform duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </main>

  <footer class="mt-12 pt-8 border-t border-slate-200">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        
        <!-- Feature Card 1: Counter Routing -->
        <div class="group bg-white rounded-xl border border-slate-200 p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 hover:border-blue-600 transition-all duration-300 cursor-pointer flex items-start gap-3">
            <div class="text-xl p-2 rounded-xl bg-slate-100 text-slate-700 group-hover:bg-blue-50 group-hover:text-blue-700 transition-colors duration-300 shrink-0">
                📍
            </div>
            <div>
                <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider group-hover:text-blue-700 transition-colors duration-300">
                    {{ $ne ? 'काउन्टर मार्गदर्शन' : 'Counter Routing' }}
                </h4>
                <p class="mt-1 text-xs text-slate-500 leading-normal">
                    {{ $ne ? 'कार्यालयभित्र कुन कोठा वा झ्यालमा जाने स्पष्ट देखाउँछ।' : 'Get precise information on specific office window interactions.' }}
                </p>
            </div>
        </div>

        <!-- Feature Card 2: Document Checklists -->
        <div class="group bg-white rounded-xl border border-slate-200 p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 hover:border-blue-600 transition-all duration-300 cursor-pointer flex items-start gap-3">
            <div class="text-xl p-2 rounded-xl bg-slate-100 text-slate-700 group-hover:bg-blue-50 group-hover:text-blue-700 transition-colors duration-300 shrink-0">
                📄
            </div>
            <div>
                <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider group-hover:text-blue-700 transition-colors duration-300">
                    {{ $ne ? 'कागजात सूची' : 'Document Checklists' }}
                </h4>
                <p class="mt-1 text-xs text-slate-500 leading-normal">
                    {{ $ne ? 'प्रक्रिया सुरु गर्नु अगाडि चाहिने सम्पूर्ण सक्कल प्रमाण पत्रहरू।' : 'Verify exact criteria requirements before arriving at fields.' }}
                </p>
            </div>
        </div>

        <!-- Feature Card 3: Citizen Feedback -->
        <div class="group bg-white rounded-xl border border-slate-200 p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 hover:border-blue-600 transition-all duration-300 cursor-pointer flex items-start gap-3">
            <div class="text-xl p-2 rounded-xl bg-slate-100 text-slate-700 group-hover:bg-blue-50 group-hover:text-blue-700 transition-colors duration-300 shrink-0">
                🗣️
            </div>
            <div>
                <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider group-hover:text-blue-700 transition-colors duration-300">
                    {{ $ne ? 'नागरिक प्रतिक्रिया' : 'Citizen Feedback' }}
                </h4>
                <p class="mt-1 text-xs text-slate-500 leading-normal">
                    {{ $ne ? 'काम सम्पन्न भए/नभएको जानकारी गराई सेवा सुधारमा मद्दत गर्नुहोस्।' : 'Directly register tracking delays or workflow success conditions.' }}
                </p>
            </div>
        </div>

    </div>
    
    <p class="mt-8 text-center text-[11px] text-slate-400 font-medium">
        🔒 {{ $ne ? 'कुनै लगइन आवश्यक छैन • नागरिक सहजताका लागि सुरक्षित सेवा' : 'No login required • Secure routing engineered for public utility' }}
    </p>
</footer>
</div>
@endsection 