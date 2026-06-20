@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'लाइभ विभाग निर्देशिका' : 'Live Department Guide')

@section('content')
<div class="max-w-6xl mx-auto  sm:py-8 selection:bg-blue-600 selection:text-white">
    
    <section id="guide-wrap" class="relative bg-white rounded-[2rem] border border-slate-100 shadow-[0_20px_50px_rgba(15,23,42,0.04)] overflow-hidden transition-all duration-300">

        <div class="p-6 sm:p-8">
            <header class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-6">
                    <div class="min-w-0">
                        <h2 class="text-2xl sm:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight">
                            {{ $ne ? $selectedService->name_ne : $selectedService->name_en }}
                        </h2>
                    </div>
                    
                  <span id="step-count-pill" class="w-fit self-start sm:self-center shrink-0 rounded-full bg-slate-900 px-3 py-1 sm:px-4 sm:py-1.5 text-[11px] sm:text-xs font-bold text-white tracking-tight shadow-sm"></span>
                </div>
            </header>

            <div class="mb-8 pb-4 border-b border-slate-100">
                <div class="flex flex-col sm:flex-row sm:flex-wrap gap-2 pb-2" id="step-tabs">
                    @foreach($steps as $step)
                        <button type="button" data-go-step="{{ $loop->index }}" class="step-tab w-full sm:w-auto shrink-0 rounded-xl border px-4 py-2.5 text-xs font-bold transition-all duration-200 cursor-pointer focus:outline-none text-left sm:text-center">
                            {{ $loop->iteration }}. {{ $ne ? \Illuminate\Support\Str::limit($step->title_ne, 30) : \Illuminate\Support\Str::limit($step->title_en, 30) }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="space-y-6">
                @foreach($steps as $step)
                    <article data-step-panel="{{ $loop->index }}" class="step-panel hidden transition-opacity duration-200">
                        
                        <div class="space-y-6 max-w-6xl mx-auto">
                            <div>
                                <span class="inline-flex px-2.5 py-0.5 rounded-md bg-blue-50 text-[10px] font-black text-blue-700 border border-blue-100/70 uppercase tracking-wider">
                                    {{ $ne ? 'चरण' : 'Step' }} {{ $loop->iteration }}
                                </span>
                                <h3 class="mt-2 text-xl font-extrabold text-slate-900 tracking-tight leading-tight">
                                    {{ $ne ? $step->title_ne : $step->title_en }}
                                </h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-stretch">
                                <div class="rounded-2xl border border-slate-100 bg-white p-4 flex gap-4 items-center shadow-sm h-full">
                                    
                                    <div class="min-w-0">
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 leading-none">{{ $ne ? 'गन्तव्य स्थान / कोठा / काउन्टर' : 'Target Destination / Counter' }}</p>
                                        <p class="mt-1.5 text-base font-bold text-slate-900 truncate tracking-tight">{{ $ne ? $step->location_ne : $step->location_en }}</p>
                                    </div>
                                </div>

                                <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm h-full">
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-blue-600 flex items-center gap-1.5 mb-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600 shrink-0"></span>
                                        {{ $ne ? 'कार्यविधि निर्देशन' : 'Operational Instructions' }}
                                    </p>
                                    <p class="text-xs sm:text-sm leading-relaxed text-slate-500 font-normal">
                                        {{ $ne ? $step->instruction_ne : $step->instruction_en }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </article>
                @endforeach
            </div>

            <footer class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-between gap-4">
                <button type="button" id="back-step" class="rounded-xl border border-slate-200 bg-white hover:bg-slate-50 px-4 py-2.5 text-xs font-bold text-slate-600 transition-all cursor-pointer shadow-sm flex items-center gap-2 hover:border-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                    <span>{{ $ne ? 'पछि फर्कनुहोस्' : 'Go Back' }}</span>
                </button>
                
                <button type="button" id="next-step" class="rounded-xl bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 text-xs font-bold transition-all cursor-pointer shadow-sm flex items-center gap-2 hover:shadow-md">
                    <span id="next-btn-text"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                </button>
            </footer>
        </div>
    </section>

   <section id="exit-prompt" class="hidden bg-white rounded-[2rem] border border-slate-100 p-6 sm:p-10 md:p-12 text-center shadow-[0_20px_50px_rgba(15,23,42,0.04)] relative overflow-hidden transition-all duration-300 w-full max-w-2xl mx-auto">
    <!-- Top Accent Line -->
    <div class="absolute top-0 left-0 right-0 h-1.5 flex">
        <div class="w-1/2 bg-red-600"></div>
        <div class="w-1/2 bg-blue-700"></div>
    </div>
    
    <!-- Success Icon (Scales from 56px to 64px on larger screens) -->
    <div class="mx-auto w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-2xl sm:text-3xl mb-5 sm:mb-6 shadow-sm">
        ✓
    </div>
    
    <!-- Heading (Scales from text-2xl to text-3xl) -->
    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight px-2">
        {{ $ne ? 'बधाई छ! सबै प्रक्रियाहरू पूरा भए।' : 'Success! All Counter Sequences Completed' }}
    </h2>
    
    <!-- Subtext (Scales from text-sm to text-base, max-width keeps it readable) -->
    <p class="mt-3 sm:mt-4 text-sm sm:text-base text-slate-500 max-w-md mx-auto leading-relaxed px-2 sm:px-4">
        {{ $ne ? 'कार्यालय भित्रका सम्पूर्ण चरण सफलतापूर्वक सम्पन्न भएका छन्। अब निकास गेटमा पुगेर QR कोड स्क्यान गरी आफ्नो अमूल्य प्रतिक्रिया दर्ता गर्नुहोस्।' : 'You have successfully routed through all processing windows. Please scan the QR code located near the terminal gate to submit your feedback.' }}
    </p>
    
    <!-- CTA Button Wrapper (Adjusts margins and padding for breathing room) -->
    <div class="mt-8 sm:mt-10 pt-6 sm:pt-8 border-t border-slate-100 max-w-[16rem] sm:max-w-sm mx-auto">
        <a href="{{ route('portal.checkout') }}" class="w-full inline-flex items-center justify-center rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs sm:text-sm uppercase tracking-wider px-5 py-3.5 sm:py-4 transition-all duration-300 shadow-md shadow-blue-600/20 cursor-pointer hover:-translate-y-0.5 active:scale-[0.98]">
            {{ $ne ? 'प्रतिक्रिया' : 'Provide Feedback' }}
        </a>
    </div>
</section>
</div>
@endsection

@push('scripts')
<script>
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
            tab.className = 'step-tab w-full sm:w-auto shrink-0 rounded-xl border px-4 py-2.5 text-xs font-bold transition-all duration-200 cursor-pointer text-left sm:text-center ' +
                (index === currentStep
                    ? 'bg-blue-600 text-white border-blue-600 shadow-sm shadow-blue-600/10'
                    : completed[index]
                        ? 'bg-emerald-50 text-emerald-700 border-emerald-200/80'
                        : 'bg-white text-slate-500 border-slate-200 hover:bg-slate-50 hover:text-slate-800 hover:border-slate-300');
        });

        stepPill.textContent = `${text.step} ${currentStep + 1} ${text.of} ${totalSteps}`;
        nextBtnText.textContent = currentStep === totalSteps - 1 ? text.finish : text.next;
    }

    tabs.forEach((tab) => tab.addEventListener('click', () => {
        currentStep = Number(tab.dataset.goStep);
        renderGuide();
    }));

    nextBtn.addEventListener('click', () => {
        // Automatically mark current step as completed when proceeding
        completed[currentStep] = true;
        
        if (currentStep < totalSteps - 1) {
            currentStep++;
            renderGuide();
            return;
        }
        
        // Finalize sequence
        completed = completed.map(() => true);
        renderGuide();
        document.getElementById('guide-wrap').classList.add('hidden');
        document.getElementById('exit-prompt').classList.remove('hidden');
        window.scrollTo({ top: 0, behavior: 'smooth' });
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
</script>
@endpush