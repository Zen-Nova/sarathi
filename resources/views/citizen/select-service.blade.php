@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'सेवा चयन गर्नुहोस्' : 'Select Service')

@section('content')
<div class="max-w-6xl mx-auto sm:py-8 selection:bg-blue-600 selection:text-white">
    
    <!-- Hero Service Header Card (Matches Document Checklist Theme) -->
    <div class="relative rounded-3xl bg-[#003B93] p-6 sm:p-8 text-white shadow-xl overflow-hidden mb-8">
        <!-- Accent circles inside banner -->
        <div class="absolute -right-8 -bottom-8 w-36 h-36 rounded-full bg-white/10 blur-xl"></div>
        <div class="absolute right-12 top-4 w-20 h-20 rounded-full bg-white/10 blur-lg"></div>
        
        <div class="p-6 sm:p-12">
            <header class="mb-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-50 border border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-4">
                   {{ $ne ? 'राहदानी विभाग' : 'Department of Passports' }}
                </div>
                
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    {{ $ne ? 'आफ्नो अपेक्षित सेवा चयन गर्नुहोस्' : 'Select Your Requested Service' }}
                </h1>
                <p class="mt-2 text-xs sm:text-sm text-white/90 leading-relaxed font-medium">
                    {{ $ne ? 'तपाईं कुन कामका लागि आउनुभएको हो? मार्गदर्शन प्राप्त गर्न उपयुक्त विकल्प रोज्नुहोस्।' : 'Select the primary purpose of your visit today. We will provide clear, counter-by-counter directions.' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Services Section Layout -->
    <div class="space-y-6">
        <h2 class="text-base sm:text-lg font-black text-slate-800 tracking-tight flex items-center gap-2 px-1">
            {{ $ne ? 'उपलब्ध डिजिटल सेवाहरू' : 'Available Digital Services' }}
        </h2>

        <div class="space-y-3.5">
            @foreach($services as $service)
                <form method="POST" action="{{ route('start-tracking') }}" class="m-0 group">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    
                    <button type="submit" class="w-full text-left rounded-2xl border border-slate-200/80 bg-white p-5 transition-all duration-300 flex items-center justify-between gap-6 hover:shadow-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-600/10">
                        
                        <div class="min-w-0 flex-1">
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 tracking-tight group-hover:text-blue-700 transition-colors duration-200">
                                {{ $ne ? $service->name_ne : $service->name_en }}
                            </h3>
                            
                            <!-- Badges transformed to match Document Checklist style -->
                            <div class="flex flex-wrap items-center gap-2 mt-2">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-slate-50 border border-slate-100 text-[10px] font-black text-slate-600 uppercase">
                                    ⏱ {{ $ne ? $service->est_ne : $service->est_en }}
                                </span>
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-blue-50 border border-blue-100 text-[10px] font-black text-blue-700 uppercase">
                                    📋 {{ count($service->steps) }} {{ $ne ? 'चरण' : 'steps' }}
                                </span>
                            </div>

                            <p class="mt-3 text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">
                                {{ $ne ? $service->desc_ne : $service->desc_en }}
                            </p>
                        </div>
                        
                        <!-- Arrow indicator built to match premium action triggers -->
                        <div class="shrink-0 w-10 h-10 rounded-xl bg-slate-50 border border-slate-200 text-slate-400 flex items-center justify-center group-hover:bg-blue-700 group-hover:text-white group-hover:border-blue-700 transition-all duration-300 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform duration-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>
                        
                    </button>
                </form>
            @endforeach
        </div>
    </div>

    <!-- Bottom Actions Row (Matches Document Checklist Structure) -->
    <div class="mt-12 pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
        <a href="{{ route('portal.home') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200/80 bg-white hover:bg-slate-50 px-5 py-3 text-xs font-bold text-slate-600 transition-all duration-200 shadow-sm w-full sm:w-auto justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            <span>{{ $ne ? 'पछि फर्कनुहोस्' : 'Go Back' }}</span>
        </a>
        
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-50 border border-slate-200 text-[10px] font-black text-slate-400 uppercase tracking-wider">
            🔒 {{ $ne ? 'सुरक्षित नागरिक सेसन' : 'Secure Session' }}
        </span>
    </div>

</div>
@endsection