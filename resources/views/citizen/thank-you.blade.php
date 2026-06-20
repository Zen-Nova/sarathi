@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'धन्यवाद' : 'Thank You')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8 sm:py-4 selection:bg-blue-600 selection:text-white font-sans">
    
    <main class="relative bg-white rounded-[2rem] border border-slate-100 shadow-[0_20px_50px_rgba(15,23,42,0.04)] overflow-hidden transition-all duration-300">
        
        <div class="absolute top-0 left-0 right-0 h-1.5 flex">
            <div class="w-1/2 bg-red-600"></div>
            <div class="w-1/2 bg-blue-700"></div>
        </div>
        
        <div class="p-6 sm:p-12 text-center flex flex-col items-center">
            
            <div id="tick-box" class="relative mx-auto w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center mb-5 sm:mb-6 shadow-2xs opacity-0">
                <div id="tick-ripple" class="absolute inset-0 rounded-2xl bg-emerald-400/30 opacity-0"></div>
                
                <svg class="relative z-10 w-6 h-6 sm:w-8 sm:h-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.8">
                    <path id="tick-path" stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                {{ $ne ? 'धन्यवाद!' : 'Thank You!' }}
            </h2>
            
            <p class="mt-3 sm:mt-4 text-sm text-slate-500 leading-relaxed max-w-md mx-auto font-medium">
                {{ $ne ? 'तपाईंको कार्यसम्पादन विवरण र प्रतिक्रिया सुरक्षित रूपमा प्रणालीमा दर्ता भएको छ। नागरिकको प्रत्यक्ष प्रतिक्रियाले सार्वजनिक सेवाको गुणस्तर र पारदर्शिता बढाउन मद्दत गर्दछ।' : 'Your workflow tracking details and civic feedback have been securely recorded. Direct public feedback helps systematically enhance government service delivery and operational transparency.' }}
            </p>
            
          
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Select components safely
    const tickBox = document.getElementById('tick-box');
    const tickPath = document.getElementById('tick-path');
    const tickRipple = document.getElementById('tick-ripple');

    if (tickBox && tickPath) {
        // 1. Pop the green container box into view with elastic bounce (100ms delayed for smoother feel)
        setTimeout(() => {
            tickBox.classList.remove('opacity-0');
            tickBox.classList.add('animate-popIn');

            // 2. Trigger Ambient Success Ripple Wave outward
            if (tickRipple) {
                tickRipple.classList.add('animate-rippleOut');
            }

            // 3. Smoothly draw vector tick line sequentially from left to right
            const pathLength = tickPath.getTotalLength();
            tickPath.style.strokeDasharray = pathLength;
            tickPath.style.strokeDashoffset = pathLength;
            
            tickPath.getBoundingClientRect(); // hardware force browser layout reflow
            
            // Set transitions to 0.75s with beautiful signature bezier timing curve
            tickPath.style.transition = 'stroke-dashoffset 0.75s cubic-bezier(0.22, 1, 0.36, 1) 0.25s';
            tickPath.style.strokeDashoffset = '0';
        }, 100);
    }
});
</script>
@endpush

<style>
    /* Premium Elastic Bouncing Overshoot Keyframe */
    @keyframes popIn {
        0% { opacity: 0; transform: scale(0.5); }
        60% { transform: scale(1.12); }
        100% { opacity: 1; transform: scale(1); }
    }
    
    .animate-popIn {
        animation: popIn 0.52s cubic-bezier(0.25, 1, 0.5, 1) forwards;
    }

    /* Eye Catching Outward Ambient Success Ripple Wave */
    @keyframes rippleOut {
        0% { transform: scale(0.95); opacity: 1; }
        100% { transform: scale(1.7); opacity: 0; }
    }

    .animate-rippleOut {
        animation: rippleOut 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.15s forwards;
    }
</style>