@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'लाइभ विभाग निर्देशिका' : 'Live Department Guide')

@section('content')
<div class="max-w-3xl mx-auto">
    <section id="guide-wrap" class="rounded-3xl border border-slate-200 bg-white shadow-soft overflow-hidden">
        <div class="bg-slate-950 text-white p-5 sm:p-6">
            <div class="flex items-start justify-between gap-4">
                <div class="min-w-0">
                    <p class="text-[11px] uppercase tracking-widest font-black text-rose-300">{{ $ne ? 'तपाईंको लाइभ विभाग निर्देशिका' : 'Your Live Department Roadmap' }}</p>
                    <h2 class="mt-1 text-xl sm:text-2xl font-black tracking-tight">{{ $ne ? $selectedService->name_ne : $selectedService->name_en }}</h2>
                    <p class="mt-1 text-xs text-slate-400">{{ $ne ? 'ट्र्याकिङ टोकन' : 'Tracking Token' }}: <span class="font-mono text-slate-200">{{ session('tracking_token') }}</span></p>
                </div>
                <span id="step-count-pill" class="shrink-0 rounded-full bg-slate-800 border border-slate-700 px-3 py-1.5 text-xs font-bold"></span>
            </div>

            <div class="mt-5">
                <div class="flex items-center justify-between text-[11px] font-bold text-slate-400 mb-1">
                    <span>{{ $ne ? 'कुल प्रगति' : 'Overall Progress' }}</span>
                    <span id="progress-label">0%</span>
                </div>
                <div class="h-2 rounded-full bg-slate-800 overflow-hidden">
                    <div id="progress-bar" class="h-full bg-gradient-to-r from-red-500 to-rose-400 transition-all" style="width:0%"></div>
                </div>
            </div>
        </div>

        <div class="p-4 sm:p-6">
            <div class="flex gap-2 overflow-x-auto pb-4 border-b border-slate-100" id="step-tabs">
                @foreach($steps as $step)
                    <button type="button" data-go-step="{{ $loop->index }}" class="step-tab tap shrink-0 rounded-xl border px-3 py-2 text-xs font-black transition">
                        {{ $loop->iteration }}. {{ $ne ? \Illuminate\Support\Str::limit($step->title_ne, 14) : \Illuminate\Support\Str::limit($step->title_en, 16) }}
                    </button>
                @endforeach
            </div>

            <div class="mt-5 space-y-4">
                @foreach($steps as $step)
                    <article data-step-panel="{{ $loop->index }}" class="step-panel hidden">
                        <div class="grid gap-5 lg:grid-cols-12">
                            <div class="lg:col-span-8 space-y-4">
                                <div>
                                    <p class="text-[11px] font-black uppercase tracking-widest text-rose-600">
                                        {{ $ne ? 'चरण' : 'Step' }} {{ $loop->iteration }} · {{ $ne ? $step->title_ne : $step->title_en }}
                                    </p>
                                    <h3 class="mt-1 text-xl font-black text-slate-950">{{ $ne ? $step->title_ne : $step->title_en }}</h3>
                                </div>

                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                    <p class="text-xs font-black uppercase tracking-widest text-slate-400">📍 {{ $ne ? 'स्थान / काउन्टर' : 'Location / Counter' }}</p>
                                    <p class="mt-1 text-base font-black text-slate-950">{{ $ne ? $step->location_ne : $step->location_en }}</p>
                                </div>

                                <div class="rounded-2xl border border-blue-100 bg-blue-50/40 p-4">
                                    <p class="text-xs font-black uppercase tracking-widest text-blue-700">📖 {{ $ne ? 'निर्देशन' : 'Instructions' }}</p>
                                    <p class="mt-2 text-sm leading-7 text-slate-700">{{ $ne ? $step->instruction_ne : $step->instruction_en }}</p>
                                </div>

                                <button type="button" data-complete-step="{{ $loop->index }}" class="complete-step-btn tap w-full rounded-2xl border px-4 py-3 text-sm font-black transition flex items-center justify-center gap-2">
                                    <span class="complete-box w-5 h-5 rounded-md border flex items-center justify-center text-xs"></span>
                                    <span class="complete-text">{{ $ne ? 'यो चरणको काम भयो' : 'I completed this step' }}</span>
                                </button>
                            </div>

                            <aside class="lg:col-span-4 rounded-2xl border border-slate-200 bg-slate-50 p-4 flex flex-col justify-between">
                                <div>
                                    <p class="text-xs font-black uppercase tracking-widest text-slate-500 border-b border-slate-200 pb-2">📋 {{ $ne ? 'आवश्यक कागजातहरू' : 'Required Documents' }}</p>
                                    <ul class="mt-3 space-y-2 text-xs leading-5 text-slate-600 font-semibold">
                                        @foreach($ne ? $step->requirements_ne : $step->requirements_en as $req)
                                            <li class="flex gap-2"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-600 shrink-0"></span><span>{{ $req }}</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <p class="mt-6 border-t border-slate-200 pt-3 text-[11px] italic text-slate-400">{{ $ne ? 'समस्या हुन नदिन सक्कल कागजात देखाउनुहोस्।' : 'Show original copies to avoid setbacks.' }}</p>
                            </aside>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <div class="bg-slate-50 border-t border-slate-100 p-4 flex items-center justify-between gap-3">
            <button type="button" id="back-step" class="tap rounded-xl bg-slate-100 hover:bg-slate-200 px-4 py-2 text-xs font-black text-slate-600">
                ← {{ $ne ? 'पछि फर्कनुहोस्' : 'Go Back' }}
            </button>
            <button type="button" id="next-step" class="tap rounded-xl bg-slate-950 hover:bg-slate-800 px-4 py-2 text-xs font-black text-white">
                {{ $ne ? 'अर्को चरणमा जानुहोस्' : 'Go to Next Step' }} →
            </button>
        </div>
    </section>

    <section id="exit-prompt" class="hidden rounded-3xl border border-slate-200 bg-white shadow-soft p-6 sm:p-10 text-center">
        <div class="mx-auto w-24 h-24 rounded-full bg-rose-50 border border-rose-100 flex items-center justify-center text-5xl mb-6">✅</div>
        <h2 class="text-2xl font-black text-slate-950">{{ $ne ? 'बधाई छ! कार्यालय भित्रका सबै चरण पूरा भयो।' : 'Great! All office steps are completed.' }}</h2>
        <p class="mt-3 text-sm leading-7 text-slate-500">{{ $ne ? 'अब निकास गेटमा पुगेर QR स्क्यान गर्नुहोस् र आफ्नो प्रतिक्रिया दिनुहोस्।' : 'Now scan the Exit QR at the exit gate and submit your feedback.' }}</p>
        <div class="mt-7 rounded-2xl bg-slate-950 p-4">
            <p class="text-xs font-black uppercase tracking-widest text-rose-300 mb-3">{{ $ne ? 'निकास QR स्क्यान' : 'Exit QR Scan' }}</p>
            <a href="{{ route('portal.checkout') }}" class="tap w-full rounded-2xl bg-rose-600 hover:bg-rose-500 text-white font-black text-sm flex items-center justify-center px-6 py-4">
                {{ $ne ? 'निकास विन्दुको क्यूआर स्क्यान गर्नुहोस्' : 'Scan Exit QR & Give Feedback' }}
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
        completed: @json($ne ? 'सकियो!' : 'Completed!'),
        mark: @json($ne ? 'यो चरणको काम भयो' : 'I completed this step'),
        next: @json($ne ? 'अर्को चरणमा जानुहोस्' : 'Go to Next Step'),
        finish: @json($ne ? 'कार्यालय प्रक्रिया समाप्त गर्नुहोस्' : 'Finish Office Sequence')
    };

    let currentStep = 0;
    let completed = Array(totalSteps).fill(false);

    const panels = Array.from(document.querySelectorAll('[data-step-panel]'));
    const tabs = Array.from(document.querySelectorAll('[data-go-step]'));
    const progressBar = document.getElementById('progress-bar');
    const progressLabel = document.getElementById('progress-label');
    const stepPill = document.getElementById('step-count-pill');
    const nextBtn = document.getElementById('next-step');
    const backBtn = document.getElementById('back-step');

    function renderGuide() {
        panels.forEach((panel, index) => panel.classList.toggle('hidden', index !== currentStep));

        tabs.forEach((tab, index) => {
            tab.className = 'step-tab tap shrink-0 rounded-xl border px-3 py-2 text-xs font-black transition ' +
                (index === currentStep
                    ? 'bg-rose-50 text-rose-700 border-rose-200'
                    : completed[index]
                        ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                        : 'bg-white text-slate-400 border-slate-200');
        });

        document.querySelectorAll('[data-complete-step]').forEach((btn) => {
            const index = Number(btn.dataset.completeStep);
            const box = btn.querySelector('.complete-box');
            const label = btn.querySelector('.complete-text');
            btn.className = 'complete-step-btn tap w-full rounded-2xl border px-4 py-3 text-sm font-black transition flex items-center justify-center gap-2 ' +
                (completed[index] ? 'bg-emerald-50 text-emerald-800 border-emerald-300' : 'bg-white hover:bg-slate-50 text-slate-700 border-slate-300');
            box.className = 'complete-box w-5 h-5 rounded-md border flex items-center justify-center text-xs ' +
                (completed[index] ? 'bg-emerald-600 border-emerald-600 text-white' : 'bg-white border-slate-300');
            box.textContent = completed[index] ? '✓' : '';
            label.textContent = completed[index] ? text.completed : text.mark;
        });

        const doneCount = completed.filter(Boolean).length;
        const percent = Math.round((doneCount / totalSteps) * 100);
        progressBar.style.width = percent + '%';
        progressLabel.textContent = percent + '%';
        stepPill.textContent = `${text.step} ${currentStep + 1} ${text.of} ${totalSteps}`;
        nextBtn.textContent = currentStep === totalSteps - 1 ? `${text.finish} →` : `${text.next} →`;
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
