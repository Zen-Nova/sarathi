@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'धन्यवाद' : 'Thank You')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8 sm:py-4 selection:bg-blue-600 selection:text-white font-sans">
    
    <!-- Premium Core Card Container -->
    <main class="relative bg-white rounded-[2rem] border border-slate-100 shadow-[0_20px_50px_rgba(15,23,42,0.04)] overflow-hidden transition-all duration-300">
        
        <!-- National Identity Accent Line at Top -->
        <div class="absolute top-0 left-0 right-0 h-1.5 flex">
            <div class="w-1/2 bg-red-600"></div>
            <div class="w-1/2 bg-blue-700"></div>
        </div>
        
        <div class="p-6 sm:p-12 text-center flex flex-col items-center">
            
            <!-- Minimalist Modern Success Badge Indicator -->
            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-2xl sm:text-3xl mb-5 sm:mb-6 shadow-sm">
                ✓
            </div>
            
            <!-- Main Acknowledgement Header -->
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                {{ $ne ? 'धन्यवाद!' : 'Thank You!' }}
            </h2>
            
            <!-- Informative Citizen Description -->
            <p class="mt-3 sm:mt-4 text-sm text-slate-500 leading-relaxed max-w-md mx-auto font-medium">
                {{ $ne ? 'तपाईंको कार्यसम्पादन विवरण र प्रतिक्रिया सुरक्षित रूपमा प्रणालीमा दर्ता भएको छ। नागरिकको प्रत्यक्ष प्रतिक्रियाले सार्वजनिक सेवाको गुणस्तर र पारदर्शिता बढाउन मद्दत गर्दछ।' : 'Your workflow tracking details and civic feedback have been securely recorded. Direct public feedback helps systematically enhance government service delivery and operational transparency.' }}
            </p>
            
            <!-- High-End Action Call to Action Button -->
            <div class="mt-8 sm:mt-10 w-full sm:w-auto">
                <a href="{{ route('portal.home') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm uppercase tracking-wider px-6 py-3.5 sm:py-4 transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 cursor-pointer focus:outline-none focus:ring-2 focus:ring-slate-900/20 active:scale-[0.98]">
                    <span>{{ $ne ? 'नयाँ सेवा ट्र्याक गर्नुहोस्' : 'Check in Another Task' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>
            </div>

        </div>
    </main>
</div>
@endsection