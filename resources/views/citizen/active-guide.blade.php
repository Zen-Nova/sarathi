@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'लाइभ विभाग निर्देशिका' : 'Live Department Guide')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6 sm:py-10 selection:bg-blue-600 selection:text-white">
    
    <!-- Main Interactive Guide Container -->
    <section id="guide-wrap" class="bg-white rounded-[2rem] border border-slate-200/80 shadow-[0_20px_50px_rgba(15,23,42,0.02)] overflow-hidden transition-all duration-300">
        
        <!-- Premium Core Dashboard Header -->
        <div class="bg-slate-900 text-white p-6 sm:p-8 relative">
            <!-- Subtle identity accent line -->
            <div class="absolute top-0 left-0 right-0 h-1 flex">
                <div class="w-1/2 bg-red-600"></div>
                <div class="w-1/2 bg-blue-600"></div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="min-w-0">
                    <p class="text-[10px] uppercase tracking-widest font-bold text-slate-400">
                        {{ $ne ? 'लाइभ विभाग निर्देशिका' : 'Live Office Roadmap' }}
                    </p>
                    <h2 class="mt-1 text-xl sm:text-2xl font-black tracking-tight text-white leading-tight">
                        {{ $ne ? $selectedService->name_ne : $selectedService->name_en }}
                    </h2>
                    <p class="mt-1.5 text-xs text-slate-400 flex items-center gap-1.5">
                        <span>{{ $ne ? 'टोकन नम्बर:' : 'Tracking Token:' }}</span>
                        <span class="font-mono bg-slate-800 text-slate-200 px-2 py-0.5 rounded border border-slate-700/60 font-bold">{{ session('tracking_token') }}</span>
                    </p>
                </div>
                
                <!-- Dynamic Pill Badge -->
                <span id="step-count-pill" class="sm:self-center shrink-0 rounded-full bg-slate-800 border border-slate-700 px-3.5 py-1.5 text-xs font-black text-slate-200 tracking-tight shadow-inner"></span>
            </div>

            <!-- Sleek Minimalist Progress Tracker -->
            <div class="mt-6 pt-4 border-t border-slate-800/80">
                <div class="flex items-center justify-between text-[11px] font-bold text-slate-400 mb-2">
                    <span class="tracking-wide uppercase">{{ $ne ? 'कुल प्रगति विवरण' : 'Overall Progress Status' }}</span>
                    <span id="progress-label" class="font-mono text-white text-xs">0%</span>
                </div>
                <div class="h-2 rounded-full bg-slate-800 p-[2px] overflow-hidden">
                    <div id="progress-bar" class="h-full bg-blue-500 rounded-full transition-all duration-500 ease-out shadow-sm" style="width:0%"></div>
                </div>
            </div>
        </div>

        <!-- Step Navigation Carousel Tabs -->
        <div class="p-4 sm:p-6 bg-slate-50 border-b border-slate-200/60">
            <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-none snap-x" id="step-tabs">
                @foreach($steps as $step)
                    <button type="button" data-go-step="{{ $loop->index }}" class="step-tab shrink-0 rounded-xl border px-4 py-2.5 text-xs font-black transition-all duration-200 cursor-pointer snap-start focus:outline-none">
                        {{ $loop->iteration }}. {{ $ne ? \Illuminate\Support\Str::limit($step->title_ne, 16) : \Illuminate\Support\Str::limit($step->title_en, 18) }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Main Workspace Presentation Panels -->
        <div class="p-6 sm:p-8">
            <div class="space-y-6">
                @foreach($steps as $step)
                    <article data-step-panel="{{ $loop->index }}" class="step-panel hidden transition-opacity duration-200">
                        <div class="grid gap-6 md:grid-cols-12">
                            
                            <!-- Left: Interactive Workflow Context -->
                            <div class="md:col-span-7 space-y-5">
                                <div>
                                    <span class="inline-flex px-2.5 py-0.5 rounded-md bg-blue-50 text-[10px] font-black text-blue-700 border border-blue-100 uppercase tracking-wider">
                                        {{ $ne ? 'चरण' : 'Step' }} {{ $loop->iteration }}
                                    </span>
                                    <h3 class="mt-2 text-xl font-extrabold text-slate-900 tracking-tight leading-tight">
                                        {{ $ne ? $step->title_ne : $step->title_en }}
                                    </h3>
                                </div>

                                <!-- Card Element: Physical Target Counter -->
                                <div class="rounded-xl border border-slate-200/80 bg-white p-4 shadow-sm flex gap-3.5 items-center">
                                    <div class="w-10 h-10 rounded-lg bg-slate-50 text-slate-600 border border-slate-100 flex items-center justify-center text-lg shrink-0">
                                        📍
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">{{ $ne ? 'गन्तव्य स्थान / कोठा / काउन्टर' : 'Target Destination / Counter' }}</p>
                                        <p class="mt-0.5 text-base font-black text-slate-900 truncate">{{ $ne ? $step->location_ne : $step->location_en }}</p>
                                    </div>
                                </div>

                                <!-- Card Element: Instructions Body -->
                                <div class="rounded-xl border border-slate-200/80 bg-white p-5 shadow-sm">
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-blue-600 flex items-center gap-1.5 mb-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                        {{ $ne ? 'कार्यविधि निर्देशन' : 'Operational Instructions' }}
                                    </p>
                                    <p class="text-xs sm:text-sm leading-relaxed text-slate-600 font-medium">
                                        {{ $ne ? $step->instruction_ne : $step->instruction_en }}
                                    </p>
                                </div>

                                <!-- Checkbox Action Button -->
                                <button type="button" data-complete-step="{{ $loop->index }}" class="complete-step-btn w-full rounded-xl border p-4 text-xs font-black transition-all duration-200 flex items-center justify-center gap-2.5 cursor-pointer focus:outline-none">
                                    <span class="complete-box w-4.5 h-4.5 rounded border flex items-center justify-center text-[10px] shadow-sm transition-all duration-250"></span>
                                    <span class="complete-text tracking-wide uppercase"></span>
                                </button>
                            </div>

                            <!-- Right: Side Documentation Verification -->
                            <aside class="md:col-span-5 rounded-xl border border-slate-200/80 bg-slate-50/50 p-5 flex flex-col justify-between shadow-inner">
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-500 border-b border-slate-200 pb-2 flex items-center gap-1.5">
                                        <span>📋</span>
                                        <span>{{ $ne ? 'आवश्यक कागजात सूची' : 'Required Documentation' }}</span>
                                    </p>
                                    
                                    <ul class="mt-4 space-y-3 text-xs text-slate-600 font-semibold leading-relaxed">
                                        @foreach($ne ? $step->requirements_ne : $step->requirements_en as $req)
                                            <li class="flex items-start gap-2.5">
                                                <span class="mt-1 w-1.5 h-1.5 rounded-full bg-blue-500 shrink-0"></span>
                                                <span class="text-slate-700 font-medium">{{ $req }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <div class="mt-6 pt-3 border-t border-slate-200/60 text-[11px] text-slate-400 font-medium flex items-center gap-1.5">
                                    <span>💡</span>
                                    <p class="italic leading-normal">{{ $ne ? 'विलम्ब हुन नदिन सक्कल कागजात साथमा राख्नुहोस्।' : 'Present original file copies to prevent service rejection.' }}</p>
                                </div>
                            </aside>

                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <!-- Master Workflow Controls Footer -->
        <div class="bg-slate-50 border-t border-slate-200/60 p-4 sm:p-5 flex items-center justify-between gap-4">
            <button type="button" id="back-step" class="rounded-xl border border-slate-200 bg-white hover:bg-slate-50 px-4 py-2.5 text-xs font-bold text-slate-600 transition-all cursor-pointer shadow-sm flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                <span>{{ $ne ? 'पछि फर्कनुहोस्' : 'Go Back' }}</span>
            </button>
            
            <button type="button" id="next-step" class="rounded-xl bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 text-xs font-black transition-all cursor-pointer shadow-sm flex items-center gap-1">
                <span id="next-btn-text"></span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
            </button>
        </div>
    </section>

    <!-- Post-Completion Check-out Notification Prompt -->
    <section id="exit-prompt" class="hidden bg-white rounded-[2rem] border border-slate-200 p-6 sm:p-12 text-center shadow-[0_20px_50px_rgba(15,23,42,0.02)] relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-emerald-500"></div>
        
        <div class="mx-auto w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-3xl mb-5 shadow-sm">
            ✓
        </div>
        
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">
            {{ $ne ? 'बधाई छ! सबै प्रक्रियाहरू पूरा भए।' : 'Success! All Counter Sequences Completed' }}
        </h2>
        <p class="mt-2 text-sm text-slate-500 max-w-md mx-auto leading-relaxed">
            {{ $ne ? 'कार्यालय भित्रका सम्पूर्ण चरण सफलतापूर्वक सम्पन्न भएका छन्। अब निकास गेटमा पुगेर QR कोड स्क्यान गरी आफ्नो अमूल्य प्रतिक्रिया दर्ता गर्नुहोस्।' : 'You have successfully routed through all processing windows. Please scan the QR code located near the terminal gate to submit your feedback.' }}
        </p>
        
        <div class="mt-8 pt-6 border-t border-slate-100 max-w-sm mx-auto">
            <a href="{{ route('portal.checkout') }}" class="w-full inline-flex items-center justify-center rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase tracking-wide px-5 py-3.5 transition-colors shadow-md shadow-blue-600/10 cursor-pointer">
                {{ $ne ? 'निकास विन्दुको क्यूआर स्क्यान र प्रतिक्रिया' : 'Scan Exit QR & Provide Feedback' }}
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
            tab.className = 'step-tab shrink-0 rounded-xl border px-4 py-2.5 text-xs font-black transition-all duration-200 cursor-pointer snap-start ' +
                (index === currentStep
                    ? 'bg-blue-600 text-white border-blue-600 shadow-sm shadow-blue-600/10'
                    : completed[index]
                        ? 'bg-emerald-50 text-emerald-700 border-emerald-200/80'
                        : 'bg-white text-slate-500 border-slate-200 hover:bg-slate-100 hover:text-slate-800');
        });

        document.querySelectorAll('[data-complete-step]').forEach((btn) => {
            const index = Number(btn.dataset.completeStep);
            const box = btn.querySelector('.complete-box');
            const label = btn.querySelector('.complete-text');
            
            btn.className = 'complete-step-btn w-full rounded-xl border p-4 text-xs font-black transition-all duration-200 flex items-center justify-center gap-2.5 cursor-pointer ' +
                (completed[index] 
                    ? 'bg-emerald-50 text-emerald-800 border-emerald-200/80' 
                    : 'bg-white hover:bg-slate-50 text-slate-700 border-slate-200');
            
            box.className = 'complete-box w-4.5 h-4.5 rounded border flex items-center justify-center text-[10px] shadow-sm transition-all duration-200 ' +
                (completed[index] ? 'bg-emerald-600 border-emerald-600 text-white font-bold' : 'bg-white border-slate-300');
            box.textContent = completed[index] ? '✓' : '';
            label.textContent = completed[index] ? text.completed : text.mark;
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
</script>
@endpush