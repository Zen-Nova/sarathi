@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'सेवा चयन गर्नुहोस्' : 'Select Service')

@section('content')
<div class="max-w-6xl mx-auto sm:py-8 selection:bg-blue-600 selection:text-white">

    <div class="relative rounded-3xl bg-[#003B93] p-6 sm:p-8 text-white shadow-xl overflow-hidden mb-8">
        <div class="absolute -right-8 -bottom-8 w-36 h-36 rounded-full bg-white/10 blur-xl"></div>
        <div class="absolute right-12 top-4 w-20 h-20 rounded-full bg-white/10 blur-lg"></div>
        
        <div class="relative flex flex-col sm:flex-row sm:items-center gap-5">
            <div>
                <span class="inline-flex items-center gap-1.5 py-1 rounded-full text-[10px] sm:text-xs font-black uppercase tracking-wider">
                    {{ $department ? ($ne ? $department->name_np : $department->name_en) : ($ne ? 'राहदानी विभाग' : 'Department of Passports') }}
                </span>
                <h1 class="mt-2.5 text-xl sm:text-3xl font-extrabold tracking-tight">
                    {{ $ne ? 'आफ्नो अपेक्षित सेवा चयन गर्नुहोस्' : 'Select Your Requested Service' }}
                </h1>
                <p class="mt-2 text-xs sm:text-sm text-white/90 leading-relaxed font-medium">
                    {{ $ne ? 'तपाईं कुन कामका लागि आउनुभएको हो? मार्गदर्शन प्राप्त गर्न उपयुक्त विकल्प रोज्नुहोस्।' : 'Select the primary purpose of your visit today. We will provide clear, counter-by-counter directions.' }}
                </p>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <h2 class="text-base sm:text-lg font-black text-slate-800 tracking-tight flex items-center gap-2 px-1">
            {{ $ne ? 'उपलब्ध सेवाहरूको सूची' : 'Available Service Options' }}
        </h2>

        <div class="space-y-4">
            @foreach($services as $service)
                <form method="POST" action="{{ route('start-tracking') }}" class="m-0 group">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    
                    <button type="submit" class="print-card w-full text-left bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition-all duration-300 flex items-start justify-between gap-6 cursor-pointer relative focus:outline-none focus:ring-2 focus:ring-blue-600/10">
                        
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-3 flex-wrap">
                                <h3 class="text-sm sm:text-base font-bold text-slate-900 tracking-tight break-words flex-1 group-hover:text-blue-700 transition-colors duration-200">
                                    {{ $ne ? $service->name_ne : $service->name_en }}
                                </h3>
                                
                                <div class="flex items-center gap-2 shrink-0 pt-0.5">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-slate-50 border border-slate-200/60 text-[10px] font-black text-slate-600 uppercase">
                                        ⏱ {{ $ne ? $service->est_ne : $service->est_en }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-blue-50 border border-blue-100 text-[10px] font-black text-blue-700 uppercase">
                                        📋 {{ count($service->steps) }} {{ $ne ? 'चरण' : 'steps' }}
                                    </span>
                                </div>
                            </div>
                            
                            <p class="mt-2 text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">
                                {{ $ne ? $service->desc_ne : $service->desc_en }}
                            </p>
                        </div>

                        <div class="shrink-0 w-9 h-9 rounded-xl bg-slate-50 border border-slate-200 text-slate-400 flex items-center justify-center group-hover:bg-blue-700 group-hover:text-white group-hover:border-blue-700 transition-all duration-300 shadow-xs mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform duration-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>
                        
                    </button>
                </form>
            @endforeach
        </div>
    </div>

    <div class="mt-12 pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4 no-print">
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