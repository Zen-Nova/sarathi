document.addEventListener('DOMContentLoaded', () => {
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
        if (progressBar) progressBar.style.width = percent + '%';
        if (progressLabel) progressLabel.textContent = percent + '%';
        if (stepPill) stepPill.textContent = `${text.step} ${currentStep + 1} ${text.of} ${totalSteps}`;
        if (nextBtnText) nextBtnText.textContent = currentStep === totalSteps - 1 ? text.finish : text.next;
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

        // eSewa style tick line drawing trigger logic
        const tickBox = document.getElementById('tick-box');
        const tickPath = document.getElementById('tick-path');

        if (tickBox && tickPath) {
            tickBox.classList.remove('opacity-0');
            tickBox.classList.add('animate-popIn');

            const pathLength = tickPath.getTotalLength();
            tickPath.style.strokeDasharray = pathLength;
            tickPath.style.strokeDashoffset = pathLength;
            
            tickPath.getBoundingClientRect(); // hardware force reflow
            
            tickPath.style.transition = 'stroke-dashoffset 0.45s cubic-bezier(0.16, 1, 0.3, 1) 0.15s';
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