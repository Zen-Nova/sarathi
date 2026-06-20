@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'सेवा चयन गर्नुहोस्' : 'Select Service')

@section('content')
<div class="max-w-8xl lg:max-w-6xl py-2 sm:py-4 selection:bg-blue-600 selection:text-white">
    
    <main class="relative bg-white rounded-[2rem] border border-slate-100 shadow-[0_20px_50px_rgba(15,23,42,0.04)] overflow-hidden transition-all duration-300">
        
        <div class="p-6 sm:p-12">
            <header class="mb-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-50 border border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-4">
                   {{ $ne ? 'राहदानी विभाग' : 'Department of Passports' }}
                </div>
                
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    {{ $ne ? 'आफ्नो अपेक्षित सेवा चयन गर्नुहोस्' : 'Select Your Requested Service' }}
                </h2>
                
                <p class="mt-3 text-sm text-slate-500 leading-relaxed max-w-xl">
                    {{ $ne ? 'तपाईं कुन कामका लागि आउनुभएको हो? मार्गदर्शन प्राप्त गर्न उपयुक्त विकल्प रोज्नुहोस्।' : 'Select the primary purpose of your visit today. We will provide clear, counter-by-counter directions.' }}
                </p>
            </header>

            <div class="space-y-3.5">
                @foreach($services as $service)
                    <form method="POST" action="{{ route('start-tracking') }}" class="m-0 group">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        
                        <button type="submit" class="w-full text-left rounded-2xl border border-slate-100 bg-white p-5 transition-all duration-300 ease-in-out flex items-center justify-between gap-6 hover:border-blue-600 hover:shadow-[0_12px_30px_rgba(37,99,235,0.06)] hover:-translate-y-0.5 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-600/10">
                            
                            <div class="min-w-0 flex-1">
                                <span class="block text-base sm:text-lg font-bold text-slate-900 group-hover:text-blue-600 transition-colors duration-200 tracking-tight">
                                    {{ $ne ? $service->name_ne : $service->name_en }}
                                </span>
                                
                                <div class="flex flex-wrap items-center gap-2 mt-2">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-slate-50 border border-slate-200/60 text-[11px] font-semibold text-slate-500 group-hover:bg-blue-50/50 group-hover:text-blue-700 group-hover:border-blue-100 transition-all duration-200">
                                        ⏱ {{ $ne ? $service->est_ne : $service->est_en }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-slate-50 border border-slate-200/60 text-[11px] font-semibold text-slate-500 group-hover:bg-blue-50/50 group-hover:text-blue-700 group-hover:border-blue-100 transition-all duration-200">
                                        📋 {{ count($service->steps) }} {{ $ne ? 'चरण' : 'steps' }}
                                    </span>
                                </div>

                                <span class="block mt-3 text-xs sm:text-sm text-slate-400 group-hover:text-slate-500 transition-colors duration-200 leading-relaxed font-normal">
                                    {{ $ne ? $service->desc_ne : $service->desc_en }}
                                </span>
                            </div>
                            
                            <div class="shrink-0 w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 text-slate-400 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 group-hover:shadow-md group-hover:shadow-blue-600/10 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4 transform group-hover:translate-x-0.5 transition-transform duration-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                            
                        </button>
                    </form>
                @endforeach
            </div>

            <footer class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('portal.home') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200/80 bg-white hover:bg-slate-50 px-4 py-2.5 text-xs font-bold text-slate-600 transition-all duration-200 cursor-pointer shadow-sm hover:border-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    <span>{{ $ne ? 'पछि फर्कनुहोस्' : 'Go Back' }}</span>
                </a>
                
                <span class="text-[11px] text-slate-400 font-medium flex items-center gap-1">
                    {{ $ne ? 'सुरक्षित नागरिक सेसन' : 'Secure Session' }}
                </span>
            </footer>
        </div>
    </main>
</div>
@endsection