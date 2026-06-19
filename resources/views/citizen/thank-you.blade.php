@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'धन्यवाद' : 'Thank You')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8 sm:py-16 selection:bg-blue-600 selection:text-white">
    
    <!-- Premium Core Card Container -->
    <main class="relative bg-white rounded-[2rem] border border-slate-100 shadow-[0_20px_50px_rgba(15,23,42,0.04)] overflow-hidden transition-all duration-300">
        
        <!-- National Identity Accent Line at Top -->
        <div class="absolute top-0 left-0 right-0 h-1.5 flex">
            <div class="w-1/2 bg-red-600"></div>
            <div class="w-1/2 bg-blue-700"></div>
        </div>
        
        <div class="p-6 sm:p-12 text-center">
            
            <!-- Minimalist Modern Success Badge Indicator -->
            <div class="mx-auto w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-3xl mb-6 shadow-sm">
                ✓
            </div>
            
            <!-- Main Acknowledgement Header -->
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                {{ $ne ? 'धन्यवाद!' : 'Thank You!' }}
            </h2>
            
            <!-- Informative Citizen Description -->
            <p class="mt-4 text-xs sm:text-sm text-slate-500 leading-relaxed max-w-md mx-auto font-medium">
                {{ $ne ? 'तपाईंको कार्यसम्पादन विवरण र प्रतिक्रिया सुरक्षित रूपमा प्रणालीमा दर्ता भएको छ। नागरिकको प्रत्यक्ष प्रतिक्रियाले सार्वजनिक सेवाको गुणस्तर र पारदर्शिता बढाउन मद्दत गर्दछ।' : 'Your workflow tracking details and civic feedback have been securely recorded. Direct public feedback helps systematically enhance government service delivery and operational transparency.' }}
            </p>
            
            <!-- Clean Operational Audit Status Card -->
            <div class="mt-8 rounded-2xl border border-slate-200/80 bg-slate-50/50 p-5 shadow-inner">
                <span class="block text-[10px] font-black uppercase tracking-widest text-slate-400">
                    {{ $ne ? 'अडिट स्थिति / Audit Status' : 'System Audit Status' }}
                </span>
                
                <div class="mt-2">
                    <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700 shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        {{ $ne ? 'सफलतापूर्वक दर्ता भयो' : 'Logged Successfully' }}
                    </span>
                </div>
                
                @if(session('last_submitted_at'))
                    <div class="mt-3 pt-3 border-t border-slate-200/60 text-[11px] font-mono font-bold text-slate-400 flex items-center justify-center gap-1.5">
                        <span>📅</span>
                        <span>{{ session('last_submitted_at') }}</span>
                    </div>
                @endif
            </div>
            
            <!-- High-End Action Call to Action Button -->
            <div class="mt-8 pt-2">
                <a href="{{ route('portal.home') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-black text-xs uppercase tracking-wider px-6 py-3.5 transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 cursor-pointer focus:outline-none focus:ring-2 focus:ring-slate-900/10">
                    <span>{{ $ne ? 'नयाँ सेवा ट्र्याक गर्नुहोस्' : 'Check in Another Task' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>
            </div>

        </div>
    </main>
</div>
@endsection