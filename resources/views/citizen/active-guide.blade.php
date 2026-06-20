@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'लाइभ विभाग निर्देशिका' : 'Live Department Guide')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6 selection:bg-blue-600 selection:text-white font-sans">
    
    <!-- Main Interactive Guide Container -->
    <section id="guide-wrap" class="relative bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden transition-all duration-300">
        
        <!-- Hero Service Header Card (Matches Premium Theme) -->
        <div class="relative bg-[#003B93] p-6 sm:p-8 text-white overflow-hidden">
            <!-- Accent circles inside banner -->
            <div class="absolute -right-8 -bottom-8 w-36 h-36 rounded-full bg-white/10 blur-xl"></div>
            <div class="absolute right-12 top-4 w-20 h-20 rounded-full bg-white/10 blur-lg"></div>
            
            <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="min-w-0">
                    <div class="inline-flex items-center gap-1.5 py-1 rounded-full text-[10px] sm:text-xs font-semibold uppercase tracking-wide text-white/80">
                        <svg class="w-3.5 h-3.5 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 01.553-.894L9 2m0 18l6-3m-6 3V2m6 15l5.447 2.724A1 1 0 0021 18.882V8.118a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 2" />
                        </svg>
                        <span>{{ $ne ? 'लाइभ विभाग निर्देशिका' : 'Live Office Roadmap' }}</span>
                    </div>
                    <h1 class="mt-2 text-xl sm:text-2xl font-bold tracking-tight">
                        {{ $ne ? $selectedService->name_ne : $selectedService->name_en }}
                    </h1>
                    <p class="mt-2 text-xs text-white/80 flex items-center gap-1.5">
                        <span>{{ $ne ? 'संकेत नम्बर:' : 'Tracking Token:' }}</span>
                        <span class="font-mono bg-white/15 text-white px-2 py-0.5 rounded border border-white/10 font-semibold shadow-xs">{{ session('tracking_token') }}</span>
                    </p>
                </div>
                
                <!-- Dynamic Pill Badge -->
                <span id="step-count-pill" class="sm:self-center shrink-0 rounded-lg bg-white text-slate-900 px-3.5 py-1.5 text-xs font-bold shadow-sm border border-white/20"></span>
            </div>

            <!-- Sleek Minimalist Progress Tracker inside Hero -->
            <div class="mt-6 pt-4 border-t border-white/10">
                <div class="flex items-center justify-between text-[11px] font-semibold text-white/80 mb-1.5">
                    <span class="tracking-wide uppercase">{{ $ne ? 'कुल प्रगति विवरण' : 'Overall Progress Status' }}</span>
                    <span id="progress-label" class="font-mono text-white font-bold">0%</span>
                </div>
                <div class="h-2 rounded-full bg-white/20 overflow-hidden shadow-inner">
                    <div id="progress-bar" class="h-full bg-white rounded-full transition-all duration-500 ease-out" style="width:0%"></div>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-8">
            <!-- Step Navigation Carousel Tabs -->
            <div class="mb-6 pb-4 border-b border-slate-100">
                <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-none snap-x" id="step-tabs">
                    @foreach($steps as $step)
                        <button type="button" data-go-step="{{ $loop->index }}" class="step-tab shrink-0 rounded-xl border px-4 py-2 text-xs font-semibold transition-all duration-150 cursor-pointer snap-start focus:outline-none">
                            {{ $loop->iteration }}. {{ $ne ? \Illuminate\Support\Str::limit($step->title_ne, 16) : \Illuminate\Support\Str::limit($step->title_en, 18) }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Main Workspace Presentation Panels -->
            <div class="space-y-6">
                @foreach($steps as $step)
                    <article data-step-panel="{{ $loop->index }}" class="step-panel hidden transition-opacity duration-200">
                        <div class="grid gap-6 md:grid-cols-12">
                            
                            <!-- Left: Interactive Workflow Context -->
                            <div class="md:col-span-7 space-y-4">
                                <div>
                                    <span class="inline-flex px-2.5 py-0.5 rounded border border-blue-100 bg-blue-50 text-[10px] font-bold text-blue-700 uppercase tracking-wide">
                                        {{ $ne ? 'चरण' : 'Step' }} {{ $loop->iteration }}
                                    </span>
                                    <h3 class="mt-2 text-lg font-bold text-slate-900 leading-tight">
                                        {{ $ne ? $step->title_ne : $step->title_en }}
                                    </h3>
                                </div>

                                <!-- Card Element: Physical Target Counter -->
                                <div class="rounded-xl border border-slate-200 bg-white p-4 flex gap-3.5 items-center shadow-2xs">
                                    <div class="w-10 h-10 rounded-lg bg-slate-50 border border-slate-100 text-slate-500 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 leading-none">{{ $ne ? 'गन्तव्य स्थान / कोठा / काउन्टर' : 'Target Destination / Counter' }}</p>
                                        <p class="mt-1.5 text-sm font-semibold text-slate-900 truncate tracking-tight">{{ $ne ? $step->location_ne : $step->location_en }}</p>
                                    </div>
                                </div>

                                <!-- Card Element: Instructions Body -->
                                <div class="rounded-xl border border-slate-200 bg-white p-4.5 shadow-2xs">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-blue-600 flex items-center gap-1.5 mb-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                                        {{ $ne ? 'कार्यविधि निर्देशन' : 'Operational Instructions' }}
                                    </p>
                                    <p class="text-xs sm:text-sm leading-relaxed text-slate-600 font-normal">
                                        {{ $ne ? $step->instruction_ne : $step->instruction_en }}
                                    </p>
                                </div>

                                <!-- Checkbox Action Button -->
                                <button type="button" data-complete-step="{{ $loop->index }}" class="complete-step-btn w-full rounded-xl border border-slate-200 bg-white p-3.5 text-xs font-semibold transition-all duration-150 flex items-center justify-center gap-2.5 cursor-pointer focus:outline-none hover:bg-slate-50 group/btn">
                                    <span class="complete-box w-4 h-4 rounded border border-slate-300 bg-white flex items-center justify-center text-[10px] shadow-2xs transition-colors duration-150"></span>
                                    <span class="complete-text text-slate-700 font-bold uppercase tracking-wide"></span>
                                </button>
                            </div>

                            <!-- Right: Side Documentation Verification -->
                            <aside class="md:col-span-5 rounded-xl border border-slate-200 bg-slate-50/40 p-4.5 flex flex-col justify-between shadow-2xs">
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-200 pb-2 flex items-center gap-2">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span>{{ $ne ? 'आवश्यक कागजात सूची' : 'Required Documentation' }}</span>
                                    </p>
                                    
                                    <ul class="mt-3.5 space-y-2.5 text-xs text-slate-600 font-normal leading-relaxed">
                                        @foreach($ne ? $step->requirements_ne : $step->requirements_en as $req)
                                            <li class="flex items-start gap-2">
                                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-blue-500 shrink-0"></span>
                                                <span class="text-slate-600 font-medium">{{ $req }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <div class="mt-5 pt-3 border-t border-slate-200/60 text-[11px] text-slate-400 font-normal flex items-center gap-1.5">
                                    <span>💡</span>
                                    <p class="italic leading-normal">{{ $ne ? 'सक्कल कागजातहरू साथमा राख्न नबिर्सिनुहोला।' : 'Present original file copies to ensure rapid authentication.' }}</p>
                                </div>
                            </aside>

                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Master Workflow Controls Footer -->
            <footer class="mt-8 pt-5 border-t border-slate-200 flex items-center justify-between gap-4">
                <button type="button" id="back-step" class="rounded-lg border border-slate-200 bg-white hover:bg-slate-50 px-4 py-2 text-xs font-semibold text-slate-600 transition-all cursor-pointer shadow-2xs flex items-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                    <span>{{ $ne ? 'पछाडि जानुहोस्' : 'Go Back' }}</span>
                </button>
                
                <button type="button" id="next-step" class="rounded-lg bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 text-xs font-bold transition-all cursor-pointer shadow-xs flex items-center gap-2">
                    <span id="next-btn-text"></span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                </button>
            </footer>
        </div>
    </section>

    <!-- Post-Completion Check-out Notification Prompt -->
    <section id="exit-prompt" class="hidden bg-white rounded-2xl border border-slate-200 p-6 sm:p-10 text-center shadow-sm relative overflow-hidden transition-all duration-300">
        <div class="relative bg-slate-50 rounded-xl p-6 border border-slate-200">
            <div class="mx-auto w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-xl mb-4 shadow-2xs">
                ✓
            </div>
            
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">
                {{ $ne ? 'बधाई छ! सबै प्रक्रियाहरू पूरा भए।' : 'Success! All Counter Sequences Completed' }}
            </h2>
            <p class="mt-2 text-xs sm:text-sm text-slate-500 max-w-md mx-auto leading-relaxed font-normal">
                {{ $ne ? 'कार्यालय भित्रका सम्पूर्ण चरण सफलतापूर्वक सम्पन्न भएका छन्। अब निकास गेटमा पुगेर QR कोड स्क्यान गरी आफ्नो अमूल्य प्रतिक्रिया दर्ता गर्नुहोस्।' : 'You have successfully routed through all processing windows. Please scan the QR code located near the terminal gate to submit your feedback.' }}
            </p>
            
            <div class="mt-6 pt-5 border-t border-slate-200 max-w-xs mx-auto">
                <a href="{{ route('portal.checkout') }}" class="w-full inline-flex items-center justify-center rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase tracking-wide px-5 py-3 transition-all duration-150 shadow-sm active:scale-[0.995]">
                    {{ $ne ? 'निकास र प्रतिक्रिया दर्ता' : 'Proceed to Exit & Feedback' }}
                </a>
            </div>
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
        completed: @json($ne ? 'चरण सम्पन्न भयो' : 'Step Completed'),
        mark: @json($ne ? 'यो चरणको काम पूरा भयो' : 'Mark Step as Completed'),
        next: @json($ne ? 'अर्को चरणमा जानुहोस्' : 'Continue to Next Step'),
        finish: @json($ne ? 'प्रक्रिया समाप्त गर्नुहोस्' : 'Finish Sequence')
    };

    let currentStep = 0;
    let completed = Array(totalSteps).fill(false);

    const panels = Array.from(document.querySelectorAll('[data-step-panel]'));
    const tabs = Array.from(document.querySelectorAll('[data-go-step]'));
    const progressBar = document.getElementById('progress-bar');
    const progressLabel = document.getElementById('progress-label');
    const stepPill = document.getElementById('step-count-pill');
    const nextBtn = document.getElementById('next-step');
    const nextBtnText = document.getElementById('next-btn-text');
    const backBtn = document.getElementById('back-step');

    function renderGuide() {
        panels.forEach((panel, index) => panel.classList.toggle('hidden', index !== currentStep));

        tabs.forEach((tab, index) => {
            tab.className = 'step-tab shrink-0 rounded-xl border px-4 py-2 text-xs font-semibold transition-all duration-150 cursor-pointer snap-start ';
            if (index === currentStep) {
                tab.classList.add('bg-white', 'text-blue-700', 'border-blue-600', 'ring-1', 'ring-blue-600/10');
            } else if (completed[index]) {
                tab.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-200');
            } else {
                tab.classList.add('bg-white', 'text-slate-500', 'border-slate-200', 'hover:bg-slate-50', 'hover:text-slate-800');
            }
        });

        document.querySelectorAll('[data-complete-step]').forEach((btn) => {
            const index = Number(btn.dataset.completeStep);
            const box = btn.querySelector('.complete-box');
            const label = btn.querySelector('.complete-text');
            
            btn.className = 'complete-step-btn w-full rounded-xl border p-3.5 text-xs font-semibold transition-all duration-150 flex items-center justify-center gap-2.5 cursor-pointer ';
            box.className = 'complete-box w-4 h-4 rounded border flex items-center justify-center text-[10px] shadow-2xs transition-colors duration-150 ';

            if (completed[index]) {
                btn.classList.add('bg-emerald-50/40', 'text-emerald-800', 'border-emerald-500');
                box.classList.add('bg-emerald-600', 'border-emerald-600', 'text-white', 'font-bold');
                box.textContent = '✓';
                label.textContent = text.completed;
            } else {
                btn.classList.add('bg-white', 'hover:bg-slate-50', 'text-slate-700', 'border-slate-200');
                box.classList.add('bg-white', 'border-slate-300');
                box.textContent = '';
                label.textContent = text.mark;
            }
        });

        const doneCount = completed.filter(Boolean).length;
        const percent = Math.round((doneCount / totalSteps) * 100);
        progressBar.style.width = percent + '%';
        progressLabel.textContent = percent + '%';
        stepPill.textContent = `${text.step} ${currentStep + 1} ${text.of} ${totalSteps}`;
        nextBtnText.textContent = currentStep === totalSteps - 1 ? text.finish : text.next;
    }

    tabs.forEach((tab) => tab.addEventListener('click', () => {
        currentStep = Number(tab.dataset.goStep);
        renderGuide();
    }));

    document.querySelectorAll('[data-complete-step]').forEach((btn) => btn.addEventListener('click', () => {
        const index = Number(btn.dataset.completeStep);
        completed[index] = !completed[index];
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
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(2px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.18s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>