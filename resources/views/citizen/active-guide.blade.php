@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? $selectedService->name_ne : $selectedService->name_en)

@section('content')
<div class="max-w-6xl mx-auto sm:py-8 selection:bg-blue-600 selection:text-white font-sans">
    
    <section id="guide-wrap" class="relative bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden transition-all duration-300">
        
        <div class="absolute top-0 left-0 right-0 h-1.5 flex">
            <div class="w-1/2 bg-red-600"></div>
            <div class="w-1/2 bg-blue-700"></div>
        </div>

        <div class="p-6 sm:p-8">
            <header class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-6">
                    <div class="min-w-0">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight leading-tight">
                            {{ $ne ? $selectedService->name_ne : $selectedService->name_en }}
                        </h2>
                    </div>
                    
                    <span id="step-count-pill" class="w-fit self-start sm:self-center shrink-0 rounded-lg bg-slate-900 px-3.5 py-1.5 text-xs font-bold text-white tracking-tight shadow-sm"></span>
                </div>
            </header>

            <div class="mb-8 pb-4 border-b border-slate-100">
                <div class="flex flex-col sm:flex-row sm:flex-wrap gap-2 pb-2" id="step-tabs">
                    @foreach($steps as $step)
                        <button type="button" data-go-step="{{ $loop->index }}" class="step-tab w-full sm:w-auto shrink-0 rounded-xl border border-slate-200 px-4 py-2.5 text-xs font-semibold transition-all duration-150 cursor-pointer focus:outline-none text-left sm:text-center">
                            {{ $loop->iteration }}. {{ $ne ? \Illuminate\Support\Str::limit($step->title_ne, 30) : \Illuminate\Support\Str::limit($step->title_en, 30) }}
                        </button>
                    @endforeach
                </div>
            </div>

          <div class="space-y-6">
    @foreach($steps as $step)
        <article data-step-panel="{{ $loop->index }}" class="step-panel hidden transition-opacity duration-200">
            
            <div class="space-y-5 max-w-6xl mx-auto">
                <div class="flex flex-col gap-1.5 border-l-2 border-blue-600 pl-4 py-0.5">
                    <span class="w-fit inline-flex px-2.5 py-0.5 rounded border border-blue-100 bg-blue-50 text-[10px] font-bold text-blue-700 uppercase tracking-wide">
                        {{ $ne ? 'चरण' : 'Step' }} {{ $loop->iteration }}
                    </span>
                    <h3 class="text-lg font-bold text-slate-900 tracking-tight leading-snug">
                        {{ $ne ? $step->title_ne : $step->title_en }}
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-stretch">
                    
                    <div class="group rounded-xl border border-slate-200 bg-white p-5 flex items-start gap-4 shadow-xs hover:border-slate-350 hover:shadow-sm transition-all duration-200 h-full">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 text-slate-500 flex items-center justify-center shrink-0 group-hover:bg-blue-50 group-hover:text-blue-600 group-hover:border-blue-100 transition-colors duration-200">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-500 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1 pt-0.5">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 leading-none">
                                {{ $ne ? 'गन्तव्य स्थान / कोठा / काउन्टर' : 'Target Destination / Counter' }}
                            </p>
                            <p class="mt-2 text-sm sm:text-base font-semibold text-slate-900 tracking-tight break-words">
                                {{ $ne ? $step->location_ne : $step->location_en }}
                            </p>
                        </div>
                    </div>

                    <div class="group rounded-xl border border-slate-200 bg-white p-5 flex items-start gap-4 shadow-xs hover:border-slate-350 hover:shadow-sm transition-all duration-200 h-full">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 text-slate-500 flex items-center justify-center shrink-0 group-hover:bg-blue-50 group-hover:text-blue-600 group-hover:border-blue-100 transition-colors duration-200">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-500 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1 pt-0.5">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-blue-600 leading-none">
                                {{ $ne ? 'कार्यविधि निर्देशन' : 'Operational Instructions' }}
                            </p>
                            <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-600 font-normal break-words">
                                {{ $ne ? $step->instruction_ne : $step->instruction_en }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </article>
    @endforeach
</div>
            <footer class="mt-10 pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                <button type="button" id="back-step" class="rounded-lg border border-slate-200 bg-white hover:bg-slate-50 px-4 py-2 w-full sm:w-auto text-xs font-semibold text-slate-600 transition-all cursor-pointer shadow-2xs flex items-center justify-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                    <span>{{ $ne ? 'पछि फर्कनुहोस्' : 'Go Back' }}</span>
                </button>
                
                <button type="button" id="next-step" class="rounded-lg bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 w-full sm:w-auto text-xs font-bold transition-all cursor-pointer shadow-xs flex items-center justify-center gap-2">
                    <span id="next-btn-text"></span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                </button>
            </footer>
        </div>
    </section>

    <section id="exit-prompt" class="hidden bg-white rounded-2xl border border-slate-200 p-6 sm:p-10 text-center shadow-sm relative overflow-hidden transition-all duration-300 w-full max-w-2xl mx-auto">
        <div class="absolute top-0 left-0 right-0 h-1.5 flex">
            <div class="w-1/2 bg-red-600"></div>
            <div class="w-1/2 bg-blue-700"></div>
        </div>
        
        <div class="relative bg-slate-50 rounded-xl p-6 border border-slate-200">
            <div id="tick-box" class="relative mx-auto w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center mb-5 shadow-2xs opacity-0">
                <div id="tick-ripple" class="absolute inset-0 rounded-2xl bg-emerald-400/30 opacity-0"></div>
                
                <svg class="relative z-10 w-6 h-6 sm:w-8 sm:h-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.8">
                    <path id="tick-path" stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            
            <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight leading-tight px-2">
                {{ $ne ? 'बधाई छ! सबै प्रक्रियाहरू पूरा भए।' : 'Success! All Counter Sequences Completed' }}
            </h2>
            
            <p class="mt-3 text-xs sm:text-sm text-slate-500 max-w-md mx-auto leading-relaxed px-2 sm:px-4 font-normal">
                {{ $ne ? 'कार्यालय भित्रका सम्पूर्ण चरण सफलतापूर्वक सम्पन्न भएका छन्। अब निकास गेटमा पुगेर QR कोड स्क्यान गरी आफ्नो अमूल्य प्रतिक्रिया दर्ता गर्नुहोस्।' : 'You have successfully routed through all processing windows. Please scan the QR code located near the terminal gate to submit your feedback.' }}
            </p>
            
            <div class="mt-6 pt-5 border-t border-slate-200 max-w-xs mx-auto">
                <a href="{{ route('portal.checkout') }}" class="w-full inline-flex items-center justify-center rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase tracking-wide px-5 py-3 transition-all duration-150 shadow-sm active:scale-[0.995]">
                    {{ $ne ? 'प्रतिक्रिया' : 'Provide Feedback' }}
                </a>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const totalSteps = {{ count($steps) }};
    const text = {
        step: @json($ne ? 'चरण' : 'Step'),
        of: @json($ne ? 'मध्ये' : 'of'),
        next: @json($ne ? 'अर्को चरणमा जानुहोस्' : 'Continue to Next Step'),
        finish: @json($ne ? 'प्रक्रिया समाप्त गर्नुहोस्' : 'Finish Sequence')
    };

    let currentStep = 0;
    let completed = Array(totalSteps).fill(false);

    const panels = Array.from(document.querySelectorAll('[data-step-panel]'));
    const tabs = Array.from(document.querySelectorAll('[data-go-step]'));
    const stepPill = document.getElementById('step-count-pill');
    const nextBtn = document.getElementById('next-step');
    const nextBtnText = document.getElementById('next-btn-text');
    const backBtn = document.getElementById('back-step');

    function renderGuide() {
        panels.forEach((panel, index) => panel.classList.toggle('hidden', index !== currentStep));

        tabs.forEach((tab, index) => {
            tab.className = 'step-tab w-full sm:w-auto shrink-0 rounded-xl border px-4 py-2.5 text-xs font-semibold transition-all duration-150 cursor-pointer text-left sm:text-center ' +
                (index === currentStep
                    ? 'bg-white text-blue-700 border-blue-600 ring-1 ring-blue-600/10'
                    : completed[index]
                        ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                        : 'bg-white text-slate-500 border-slate-200 hover:bg-slate-50 hover:text-slate-800');
        });

        if (stepPill) stepPill.textContent = `${text.step} ${currentStep + 1} ${text.of} ${totalSteps}`;
        if (nextBtnText) nextBtnText.textContent = currentStep === totalSteps - 1 ? text.finish : text.next;
    }

    tabs.forEach((tab) => tab.addEventListener('click', () => {
        currentStep = Number(tab.dataset.goStep);
        renderGuide();
    }));

    nextBtn.addEventListener('click', () => {
        completed[currentStep] = true;
        
        if (currentStep < totalSteps - 1) {
            currentStep++;
            renderGuide();
            return;
        }
        
        completed = completed.map(() => true);
        renderGuide();
        document.getElementById('guide-wrap').classList.add('hidden');
        document.getElementById('exit-prompt').classList.remove('hidden');
        window.scrollTo({ top: 0, behavior: 'smooth' });

        // Trigger highly optimized premium checkmark stroke path drawing sequence
        const tickBox = document.getElementById('tick-box');
        const tickPath = document.getElementById('tick-path');
        const tickRipple = document.getElementById('tick-ripple');

        if (tickBox && tickPath) {
            // 1. Pop the Container box into view with elastic bounce
            tickBox.classList.remove('opacity-0');
            tickBox.classList.add('animate-popIn');

            // 2. Trigger Ambient Wallet Style Success Ripple Wave
            if (tickRipple) {
                tickRipple.classList.add('animate-rippleOut');
            }

            // 3. Deliberately draw vector lines sequentially
            const pathLength = tickPath.getTotalLength();
            tickPath.style.strokeDasharray = pathLength;
            tickPath.style.strokeDashoffset = pathLength;
            
            tickPath.getBoundingClientRect(); // hardware force browser reflow
            
            // Time extended to 0.75s with an eye-pleasing signature bezier curve
            tickPath.style.transition = 'stroke-dashoffset 0.75s cubic-bezier(0.22, 1, 0.36, 1) 0.25s';
            tickPath.style.strokeDashoffset = '0';
        }
    });

    backBtn.addEventListener('click', () => {
        if (currentStep > 0) {
            currentStep--;
            renderGuide();
        } else {
            window.location.href = @json(route('portal.select-service'));
        }
    });

    renderGuide();
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

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(2px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.18s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>