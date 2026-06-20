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
            {{ $ne ? 'विभागीय नागरिक सेवा केन्द्र' : 'Departmental Citizen Service Hub' }}
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
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 flex items-center justify-center text-lg sm:text-xl font-semibold group-hover:bg-blue-600 group-hover:border-blue-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        🛂
                    </div>
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
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 flex items-center justify-center text-lg sm:text-xl font-semibold group-hover:bg-blue-600 group-hover:border-blue-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        📜
                    </div>
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
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 flex items-center justify-center text-lg sm:text-xl font-semibold group-hover:bg-blue-600 group-hover:border-blue-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        🪪
                    </div>
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
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 flex items-center justify-center text-lg sm:text-xl font-semibold group-hover:bg-blue-600 group-hover:border-blue-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        🚗
                    </div>
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
        <!-- Interactive Trigger Cards with Perfect Grid Alignment -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 auto-rows-stretch">
            
            <!-- Feature Card 1: Counter Routing -->
            <button type="button" onclick="switchTab('counter')" id="btn-counter" class="info-card text-left w-full h-full group bg-white rounded-xl border border-slate-200 p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 hover:border-blue-600 transition-all duration-300 flex items-start gap-3 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 group-hover:bg-blue-50 group-hover:text-blue-700 flex items-center justify-center text-lg shrink-0 transition-colors duration-300 icon-box">
                    📍
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider group-hover:text-blue-700 transition-colors duration-300 truncate">
                        {{ $ne ? 'काउन्टर मार्गदर्शन' : 'Counter Routing' }}
                    </h4>
                    <p class="mt-1 text-xs text-slate-500 leading-normal font-medium break-words">
                        {{ $ne ? 'कार्यालयभित्र कुन कोठा वा झ्यालमा जाने स्पष्ट देखाउँछ।' : 'Get precise information on specific office window interactions.' }}
                    </p>
                </div>
            </button>

            <!-- Feature Card 2: Document Checklists -->
            <button type="button" onclick="switchTab('documents')" id="btn-documents" class="info-card text-left w-full h-full group bg-white rounded-xl border border-slate-200 p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 hover:border-blue-600 transition-all duration-300 flex items-start gap-3 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 group-hover:bg-blue-50 group-hover:text-blue-700 flex items-center justify-center text-lg shrink-0 transition-colors duration-300 icon-box">
                    📄
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider group-hover:text-blue-700 transition-colors duration-300 truncate">
                        {{ $ne ? 'कागजात सूची' : 'Document Checklists' }}
                    </h4>
                    <p class="mt-1 text-xs text-slate-500 leading-normal font-medium break-words">
                        {{ $ne ? 'प्रक्रिया सुरु गर्नु अगाडि चाहिने सम्पूर्ण सक्कल प्रमाण पत्रहरू।' : 'Verify exact criteria requirements before arriving at fields.' }}
                    </p>
                </div>
            </button>

            <!-- Feature Card 3: Citizen Feedback -->
            <button type="button" onclick="switchTab('feedback')" id="btn-feedback" class="info-card text-left w-full h-full group bg-white rounded-xl border border-slate-200 p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 hover:border-blue-600 transition-all duration-300 flex items-start gap-3 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 group-hover:bg-blue-50 group-hover:text-blue-700 flex items-center justify-center text-lg shrink-0 transition-colors duration-300 icon-box">
                    🗣️
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider group-hover:text-blue-700 transition-colors duration-300 truncate">
                        {{ $ne ? 'नागरिक प्रतिक्रिया' : 'Citizen Feedback' }}
                    </h4>
                    <p class="mt-1 text-xs text-slate-500 leading-normal font-medium break-words">
                        {{ $ne ? 'काम सम्पन्न भए/नभएको जानकारी गराई सेवा सुधारमा मद्दत गर्नुहोस्।' : 'Directly register tracking delays or workflow success conditions.' }}
                    </p>
                </div>
            </button>

        </div>

        <!-- Dynamic Information Panel Content -->
        <div class="mt-4 bg-slate-50 border border-slate-200/80 rounded-2xl p-5 shadow-inner">
            
            <!-- Counter Content -->
            <div id="pane-counter" class="info-pane hidden animate-fadeIn">
                <h5 class="text-sm font-bold text-slate-900 mb-3 flex items-center gap-2">
                    🏢 {{ $ne ? 'डिजिटल काउन्टर दिशानिर्देश' : 'Digital Counter Routing Matrix' }}
                </h5>
                <ul class="space-y-2 text-xs text-slate-600 font-medium">
                    <li class="flex items-center gap-2 bg-white p-2.5 rounded-lg border border-slate-100 shadow-sm">
                        <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-[10px] shrink-0">१</span>
                        <span>{{ $ne ? 'झ्याल नं. १: प्रारम्भिक कागजात रुजु तथा टोकन सङ्कलन।' : 'Window 1: Preliminary document verification & token collection.' }}</span>
                    </li>
                    <li class="flex items-center gap-2 bg-white p-2.5 rounded-lg border border-slate-100 shadow-sm">
                        <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-[10px] shrink-0">२</span>
                        <span>{{ $ne ? 'झ्याल नं. ३: जैविक विवरण (Biometrics) र फोटो खिच्ने कक्ष।' : 'Window 3: Biometric enrollment & live photograph capture suite.' }}</span>
                    </li>
                    <li class="flex items-center gap-2 bg-white p-2.5 rounded-lg border border-slate-100 shadow-sm">
                        <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-[10px] shrink-0">३</span>
                        <span>{{ $ne ? 'झ्याल नं. ५: सरकारी राजस्व/दस्तुर भुक्तानी काउन्टर।' : 'Window 5: Government fee & revenue settlement desk.' }}</span>
                    </li>
                </ul>
            </div>

            <!-- Documents Content -->
            <div id="pane-documents" class="info-pane hidden animate-fadeIn">
                <h5 class="text-sm font-bold text-slate-900 mb-3 flex items-center gap-2">
                    📁 {{ $ne ? 'अनिवार्य साधारण कागजातहरू' : 'Standard Mandatory Documents' }}
                </h5>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs text-slate-600 font-medium">
                    <div class="bg-white p-3 rounded-lg border border-slate-100 shadow-sm flex items-start gap-2.5">
                        <span class="text-emerald-600 font-bold shrink-0">✓</span>
                        <div>
                            <p class="font-bold text-slate-800">{{ $ne ? 'नागरिकता प्रमाणपत्र' : 'Citizenship Certificate' }}</p>
                            <p class="mt-0.5 text-[11px] text-slate-400 leading-normal">{{ $ne ? 'सक्कल प्रमाणपत्र र २ प्रति प्रतिलिपि' : 'Original copy along with 2 photocopies.' }}</p>
                        </div>
                    </div>
                    <div class="bg-white p-3 rounded-lg border border-slate-100 shadow-sm flex items-start gap-2.5">
                        <span class="text-emerald-600 font-bold shrink-0">✓</span>
                        <div>
                            <p class="font-bold text-slate-800">{{ $ne ? 'अनलाइन आवेदन फारम' : 'Online Form Printout' }}</p>
                            <p class="mt-0.5 text-[11px] text-slate-400 leading-normal">{{ $ne ? 'सफल दर्ता पछि प्राप्त भएको बारकोड सहितको प्रिन्ट' : 'Downloaded submission sheet featuring the validation barcode.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feedback Content -->
            <div id="pane-feedback" class="info-pane hidden animate-fadeIn">
                <h5 class="text-sm font-bold text-slate-900 mb-3 flex items-center gap-2">
                    📢 {{ $ne ? 'नागरिक सुनुवाइ तथा गुनासो व्यवस्थापन' : 'Public Grievance & Systemic Feedback' }}
                </h5>
                <p class="text-xs text-slate-600 font-medium leading-relaxed bg-white p-3.5 rounded-lg border border-slate-100 shadow-sm">
                    {{ $ne ? 'यदि तपाईंले सेवा प्रवाहमा अनावश्यक ढिलाइ भोग्नुभएको छ वा कुनै सुधारको सुझाव दिन चाहनुहुन्छ भने, मुख्य ढोका नजिकै रहेको "सल्लाह तथा सुझाव पेटिका" प्रयोग गर्न सक्नुहुन्छ वा हेलो सरकार (११११) मा सिधै सम्पर्क गरी आफ्नो गुनासो दर्ता गराउन सक्नुहुन्छ।' : 'If you witness operational anomalies or processing bottlenecks, please deploy the physical suggestion unit located inside the main lobby, or scale the issue directly to Hello Sarkar via emergency shortcode 1111.' }}
                </p>
            </div>

        </div>
        
        <!-- Eye-catching Security Badge -->
        <div class="mt-5 flex justify-center">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-full bg-emerald-50 border border-emerald-200 text-[11px] sm:text-xs text-emerald-800 font-bold shadow-sm tracking-wide">
                🔒 {{ $ne ? 'कुनै लगइन आवश्यक छैन • नागरिक सहजताका लागि सुरक्षित सेवा' : 'No Login Required • Secure Routing Engineered for Public Utility' }}
            </span>
        </div>
    </footer>
</div>

<!-- Interactive Tabs Logic -->
<script>
    function switchTab(tabId) {
        // 1. Hide all text panes
        document.querySelectorAll('.info-pane').forEach(pane => {
            pane.classList.add('hidden');
        });
        
        // 2. Reset all card borders and background colors safely
        document.querySelectorAll('.info-card').forEach(card => {
            card.classList.remove('border-blue-600', 'bg-blue-50/20');
            card.classList.add('border-slate-200', 'bg-white');
            
            const iconBox = card.querySelector('.icon-box');
            if (iconBox) {
                iconBox.classList.remove('bg-blue-600', 'text-white');
                iconBox.classList.add('bg-slate-100', 'text-slate-700');
            }
        });

        // 3. Reveal target info pane
        const activePane = document.getElementById('pane-' + tabId);
        if (activePane) {
            activePane.classList.remove('hidden');
        }

        // 4. Highlight current selected card
        const activeCard = document.getElementById('btn-' + tabId);
        if (activeCard) {
            activeCard.classList.remove('border-slate-200', 'bg-white');
            activeCard.classList.add('border-blue-600', 'bg-blue-50/20');
            
            const activeIconBox = activeCard.querySelector('.icon-box');
            if (activeIconBox) {
                activeIconBox.classList.remove('bg-slate-100', 'text-slate-700');
                activeIconBox.classList.add('bg-blue-600', 'text-white');
            }
        }
    }

    // Initialize by opening the first tab automatically when page mounts
    document.addEventListener("DOMContentLoaded", function() {
        switchTab('counter');
    });
</script>

<!-- Tailwind CSS Custom Animation Injector -->
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(2px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>
@endsection