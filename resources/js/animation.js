document.addEventListener('DOMContentLoaded', () => {
    const config = window.SarathiConfig;
    if (!config) return;

    const totalSteps = config.totalSteps;
    const text = config.text;

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
            tab.className = 'step-tab w-full sm:w-auto shrink-0 rounded-xl border px-4 py-2.5 text-xs font-semibold transition-all duration-150 cursor-pointer text-left sm:text-center ';
            if (index === currentStep) {
                tab.classList.add('bg-white', 'text-blue-700', 'border-blue-600', 'ring-1', 'ring-blue-600/10');
            } else if (completed[index]) {
                tab.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-200');
            } else {
                tab.classList.add('bg-white', 'text-slate-500', 'border-slate-200', 'hover:bg-slate-50', 'hover:text-slate-800');
            }
        });

        if (stepPill) stepPill.textContent = `${text.step} ${currentStep + 1} ${text.of} ${totalSteps}`;
        if (nextBtnText) nextBtnText.textContent = currentStep === totalSteps - 1 ? text.finish : text.next;
    }

    tabs.forEach((tab) => tab.addEventListener('click', () => {
        currentStep = Number(tab.dataset.goStep);
        renderGuide();
    }));

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            completed[currentStep] = true;
            
            if (currentStep < totalSteps - 1) {
                currentStep++;
                renderGuide();
                return;
            }
            
            completed = completed.map(() => true);
            renderGuide();
            
            const guideWrap = document.getElementById('guide-wrap');
            const exitPrompt = document.getElementById('exit-prompt');
            if (guideWrap) guideWrap.classList.add('hidden');
            if (exitPrompt) exitPrompt.classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });

            // Premium eSewa Style Vector Checkmark Drawing Trigger
            const tickBox = document.getElementById('tick-box');
            const tickPath = document.getElementById('tick-path');
            const tickRipple = document.getElementById('tick-ripple');

            if (tickBox && tickPath) {
                tickBox.classList.remove('opacity-0');
                tickBox.classList.add('animate-popIn');

                if (tickRipple) tickRipple.classList.add('animate-rippleOut');

                const pathLength = tickPath.getTotalLength();
                tickPath.style.strokeDasharray = pathLength;
                tickPath.style.strokeDashoffset = pathLength;
                
                tickPath.getBoundingClientRect(); // hardware force browser reflow
                
                tickPath.style.transition = 'stroke-dashoffset 0.75s cubic-bezier(0.22, 1, 0.36, 1) 0.25s';
                tickPath.style.strokeDashoffset = '0';
            }
        });
    }

    if (backBtn) {
        backBtn.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                renderGuide();
            } else {
                window.location.href = config.routes.selectService;
            }
        });
    }

    renderGuide();
});