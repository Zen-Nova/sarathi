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
<div class="max-w-6xl mx-auto sm:py-8 selection:bg-blue-600 selection:text-white">

    <!-- Hero Service Header Card -->
    <div class="relative rounded-3xl bg-[#003B93] p-6 sm:p-8 text-white shadow-xl overflow-hidden mb-8">
        <!-- Accent circles inside banner -->
        <div class="absolute -right-8 -bottom-8 w-36 h-36 rounded-full bg-white/10 blur-xl"></div>
        <div class="absolute right-12 top-4 w-20 h-20 rounded-full bg-white/10 blur-lg"></div>
        
        <div class="relative flex flex-col sm:flex-row sm:items-center gap-5">
            <!-- <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center shrink-0 shadow-inner overflow-hidden p-2">
                @if(Str::endsWith($checklist['icon'], ['.png', '.svg']))
                    <img src="{{ asset('images/' . $checklist['icon']) }}" alt="Icon" class="w-full h-full object-contain">
                @else
                    <span class="text-3xl">{{ $checklist['icon'] }}</span>
                @endif
            </div> -->
            <div>
                <span class="inline-flex items-center gap-1.5 py-1 rounded-full  text-[10px] sm:text-xs font-black uppercase tracking-wider">
                    
                    {{ $ne ? 'अधिकारीक कागजात सूची' : 'Official Requirements' }}
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

    <!-- Checklist Cards Grid Layout (2 by 2 on desktop view) -->
    <div class="space-y-6">
        <h2 class="text-base sm:text-lg font-black text-slate-800 tracking-tight flex items-center gap-2 px-1">
            {{ $ne ? 'कागजातहरूको सूची' : 'Required Documents' }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @foreach($checklist['docs'] as $idx => $doc)
                <div class="print-card group bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition-all duration-300 flex items-start gap-4 relative">

                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 tracking-tight break-words flex-1">
                                {{ $ne ? $doc['title_ne'] : $doc['title_en'] }}
                            </h3>
                            <div class="shrink-0 pt-0.5">
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
                        </div>
                        
                        <p class="mt-2 text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">
                            {{ $ne ? $doc['desc_ne'] : $doc['desc_en'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bottom Actions Row (no-print) -->
    <div class="mt-12 pt-6 border-t border-slate-200 flex items-center justify-start no-print">
        <a href="{{ route('portal.home') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200/80 bg-white hover:bg-slate-50 px-5 py-3 text-xs font-bold text-slate-600 transition-all duration-200 shadow-sm w-full sm:w-auto justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            <span>{{ $ne ? 'गृहपृष्ठमा फर्कनुहोस्' : 'Go Back to Home' }}</span>
        </a>
        
        <a href="{{ route('portal.select-service', ['department' => $serviceKey]) }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 text-xs font-black transition-all duration-200 shadow-md hover:scale-[1.02] w-full sm:w-auto justify-center">
            <span>{{ $ne ? 'आवेदन प्रक्रिया सुरु गर्नुहोस्' : 'Proceed to Application' }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </a>
    </div>

</div>


@endsection
