@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? $checklist['name_ne'] : $checklist['name_en'])

@push('styles')
<style>
    @media print {
        header, nav, footer, .no-print {
            display: none !important;
        }
        body {
            background-color: #fff !important;
            color: #000 !important;
        }
        .print-card {
            border: 1px solid #cbd5e1 !important;
            box-shadow: none !important;
            break-inside: avoid;
        }
    }
</style>
@endpush

@section('content')
<div class="max-w-6xl mx-auto px-4 py-4 sm:py-8 selection:bg-blue-600 selection:text-white">
    
    <!-- Top Nav Action Row (no-print) -->
    <div class="flex items-center justify-between mb-6 no-print">
        <a href="{{ route('portal.home') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs transition-all duration-200 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            <span>{{ $ne ? 'गृहपृष्ठमा फर्कनुहोस्' : 'Back to Home' }}</span>
        </a>
        
        <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition-all duration-200 shadow-sm">
            <span>🖨️</span>
            <span>{{ $ne ? 'चेकलिस्ट प्रिन्ट गर्नुहोस्' : 'Print Checklist' }}</span>
        </button>
    </div>

    <!-- Hero Service Header Card -->
    <div class="relative rounded-3xl bg-gradient-to-r {{ $checklist['bg_gradient'] }} p-6 sm:p-8 text-white shadow-xl overflow-hidden mb-8">
        <!-- Accent circles inside banner -->
        <div class="absolute -right-8 -bottom-8 w-36 h-36 rounded-full bg-white/10 blur-xl"></div>
        <div class="absolute right-12 top-4 w-20 h-20 rounded-full bg-white/10 blur-lg"></div>
        
        <div class="relative flex flex-col sm:flex-row sm:items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-3xl shrink-0 shadow-inner">
                {{ $checklist['icon'] }}
            </div>
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-[10px] sm:text-xs font-black uppercase tracking-wider">
                    <span>🏛️</span>
                    <span>{{ $ne ? 'अधिकारीक कागजात सूची' : 'Official Requirements' }}</span>
                </span>
                <h1 class="mt-2.5 text-xl sm:text-3xl font-extrabold tracking-tight">
                    {{ $ne ? $checklist['name_ne'] : $checklist['name_en'] }}
                </h1>
                <p class="mt-2 text-xs sm:text-sm text-white/90 leading-relaxed font-medium">
                    {{ $ne ? 'यो सेवा प्राप्त गर्न आवश्यक पर्ने सम्पूर्ण कागजातहरूको सूची तल दिइएको छ। कृपया आफूसँग भएका कागजातहरू जाँच्नुहोस्।' : 'Official checklist of documents needed before submitting your request. Check off each item to ensure your office visit is hassle-free.' }}
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 items-start">
        
        <!-- Checklist Interactive Elements (Cols 2/3) -->
        <div class="md:col-span-2 space-y-4">
            <h2 class="text-base sm:text-lg font-black text-slate-800 tracking-tight mb-2 flex items-center gap-2 px-1">
                <span>📋</span>
                <span>{{ $ne ? 'कागजातहरूको सूची' : 'Required Documents' }}</span>
            </h2>

            @foreach($checklist['docs'] as $idx => $doc)
                <div class="print-card group bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition-all duration-300 flex items-start gap-4 cursor-pointer relative" onclick="toggleCheckbox('doc-{{ $idx }}')">
                    
                    <!-- Checkbox container (no-print) -->
                    <div class="shrink-0 pt-0.5 no-print" onclick="event.stopPropagation();">
                        <input type="checkbox" id="doc-{{ $idx }}" class="w-5 h-5 rounded-md border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer" onchange="updateProgress()">
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-3 flex-wrap">
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 tracking-tight group-hover:text-blue-700 transition-colors duration-200">
                                {{ $ne ? $doc['title_ne'] : $doc['title_en'] }}
                            </h3>
                            @if($doc['required'])
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-rose-50 border border-rose-100 text-[10px] font-black text-rose-700 uppercase">
                                    {{ $ne ? 'अनिवार्य' : 'Required' }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-50 border border-amber-100 text-[10px] font-black text-amber-700 uppercase">
                                    {{ $ne ? 'ऐच्छिक' : 'Optional' }}
                                </span>
                            @endif
                        </div>
                        
                        <p class="mt-2 text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">
                            {{ $ne ? $doc['desc_ne'] : $doc['desc_en'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Sidebar Guidelines (Col 1) -->
        <div class="space-y-6">
            
            <!-- Progress Tracker Card (no-print) -->
            <div id="progress-card" class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm no-print">
                <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider mb-3">
                    {{ $ne ? 'तपाईंको तयारी स्थिति' : 'Preparation Progress' }}
                </h3>
                <div class="flex items-center justify-between mb-2">
                    <span id="progress-text" class="text-sm font-bold text-slate-700">0%</span>
                    <span id="progress-count" class="text-xs font-semibold text-slate-400">0 / {{ count($checklist['docs']) }}</span>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div id="progress-bar" class="bg-blue-600 h-full w-0 transition-all duration-300"></div>
                </div>
            </div>

            <!-- Pre-visit preparation recommendations -->
            <div class="print-card bg-slate-900 text-white rounded-2xl p-5 shadow-sm relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-20 h-20 rounded-full bg-white/5 blur-lg"></div>
                
                <h3 class="text-xs font-black text-white/70 uppercase tracking-wider mb-4 flex items-center gap-1.5">
                    <span>💡</span>
                    <span>{{ $ne ? 'महत्त्वपूर्ण निर्देशनहरू' : 'Pre-visit Guidelines' }}</span>
                </h3>
                
                <ul class="space-y-3.5">
                    @php
                        $guidelines = $ne ? $checklist['general_guidelines_ne'] : $checklist['general_guidelines_en'];
                    @endphp
                    @foreach($guidelines as $guideline)
                        <li class="flex items-start gap-2.5 text-xs text-slate-300 leading-relaxed font-medium">
                            <span class="text-blue-400 shrink-0 text-sm mt-0.5">✓</span>
                            <span>{{ $guideline }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            
        </div>
    </div>

    <!-- Bottom Actions Row (no-print) -->
    <div class="mt-12 pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4 no-print">
        <a href="{{ route('portal.home') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200/80 bg-white hover:bg-slate-50 px-5 py-3 text-xs font-bold text-slate-600 transition-all duration-200 shadow-sm w-full sm:w-auto justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            <span>{{ $ne ? 'गृहपृष्ठमा फर्कनुहोस्' : 'Go Back to Home' }}</span>
        </a>
        
        <a href="{{ route('portal.select-service') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 text-xs font-black transition-all duration-200 shadow-md hover:scale-[1.02] w-full sm:w-auto justify-center">
            <span>{{ $ne ? 'आवेदन प्रक्रिया सुरु गर्नुहोस्' : 'Proceed to Application' }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </a>
    </div>

</div>

<script>
    function toggleCheckbox(id) {
        const checkbox = document.getElementById(id);
        if (checkbox) {
            checkbox.checked = !checkbox.checked;
            updateProgress();
        }
    }

    function updateProgress() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
        const totalCount = checkboxes.length;
        
        const progressPercentage = Math.round((checkedCount / totalCount) * 100);
        
        const progressText = document.getElementById('progress-text');
        const progressCount = document.getElementById('progress-count');
        const progressBar = document.getElementById('progress-bar');
        
        if (progressText) progressText.innerText = progressPercentage + '%';
        if (progressCount) progressCount.innerText = checkedCount + ' / ' + totalCount;
        if (progressBar) progressBar.style.width = progressPercentage + '%';
    }
</script>
@endsection
