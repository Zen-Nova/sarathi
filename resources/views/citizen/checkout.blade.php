@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';

    $service = $visit->service ?? null;

    $serviceName = $service
        ? ($ne ? ($service->name_ne ?? $service->name_np ?? $service->name_en) : $service->name_en)
        : '';

    $reasons = collect(config('visits.failure_reasons'))
        ->mapWithKeys(fn ($item, $key) => [
            $key => $ne ? $item['ne'] : $item['en']
        ])
        ->all();
@endphp

@section('title', $ne ? 'निकास प्रतिक्रिया' : 'Checkout Feedback')

@section('content')
<div class="max-w-6xl mx-auto sm:py-8 selection:bg-blue-600 selection:text-white font-sans">
    <section class="rounded-2xl border border-slate-200 bg-white shadow-sm p-5 sm:p-8 lg:p-12 transition-all duration-300">

        <form method="POST" action="{{ route('workflow.process-feedback', ['token' => $token]) }}" class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14">
            @csrf

            <input type="hidden" name="is_completed" id="is_completed" value="1">
            <input type="hidden" name="rating" id="rating_value" value="5">
            <input type="hidden" name="failure_reason" id="reason_value" value="">

            <!-- LEFT COLUMN: Questions & Status -->
            <div class="lg:col-span-6 flex flex-col justify-start space-y-6 lg:border-r lg:border-slate-200 lg:pr-10">

                <div class="space-y-3">
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded border border-blue-200 bg-blue-50/50 text-[10px] sm:text-[11px] font-semibold text-blue-700 shadow-sm uppercase tracking-wider">
                            {{ $ne ? 'नागरिक पृष्ठपोषण डेस्क' : 'Citizen Feedback Desk' }}
                        </span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ $ne ? 'सेवा प्रवाह मूल्याङ्कन फारम' : 'Service Delivery Assessment' }}
                    </h2>

                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-normal">
                        {{ $ne ? 'नेपाल सरकारका administrative सेवाहरूलाई थप पारदर्शी र जवाफदेही बनाउन आफ्नो अनुभव साझा गर्नुहोस्। तपाईंको विवरण पूर्ण रूपमा सुरक्षित रहनेछ।' : 'Help optimize public utility infrastructure by sharing your experience. Your verification audit is highly secured.' }}
                    </p>

                    @if($service)
                        <div class="inline-flex items-center gap-2 rounded-lg bg-slate-50 border border-slate-200 px-3 py-2 text-xs text-slate-600 font-medium mt-2 w-full sm:w-auto">
                            <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>

                            <span class="truncate">
                                <span>{{ $ne ? 'सन्दर्भ:' : 'Reference:' }}</span>
                                <span class="text-slate-900 font-bold ml-1">{{ $serviceName }}</span>
                            </span>
                        </div>
                    @endif
                </div>

                <div class="border-t border-slate-100 pt-6 space-y-6">
                    <!-- Q1: Status Toggle -->
                    <div class="space-y-3">
                        <label class="block text-[11px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Q1. {{ $ne ? 'के तपाईंको अभिप्रेत कार्य आज सम्पन्न भयो?' : 'Was your intended workflow completed today?' }}
                            <span class="text-rose-500">*</span>
                        </label>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            <button type="button" id="yes-btn" class="group flex items-center justify-center gap-2.5 py-3.5 sm:py-3 rounded-xl border border-slate-200 bg-white text-slate-700 font-bold text-xs sm:text-sm transition-all duration-200 shadow-sm hover:border-blue-400 focus:outline-none">
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-emerald-600 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ $ne ? 'हो, सम्पन्न भयो' : 'Yes, Completed' }}</span>
                            </button>

                            <button type="button" id="no-btn" class="group flex items-center justify-center gap-2.5 py-3.5 sm:py-3 rounded-xl border border-slate-200 bg-white text-slate-700 font-bold text-xs sm:text-sm transition-all duration-200 shadow-sm hover:border-rose-400 focus:outline-none">
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-rose-600 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span>{{ $ne ? 'होइन, भएन' : 'No, Incomplete' }}</span>
                            </button>
                        </div>
                    </div>

                    <!-- Q2: Success Rating Section -->
                    <div id="success-section" class="rounded-xl border border-slate-200 bg-slate-50/50 p-4 sm:p-5 transition-all duration-300 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="sm:max-w-[220px] text-left">
                            <label class="block text-[11px] sm:text-xs font-bold text-slate-500 leading-relaxed uppercase tracking-wider">
                                Q2. {{ $ne ? 'समग्र सेवा सन्तुष्टि स्तर निर्धारण गर्नुहोस्:' : 'Rate your overall satisfaction level:' }}
                                <span class="text-rose-500">*</span>
                            </label>
                        </div>

                        <div class="flex flex-col items-center gap-1.5 shrink-0">
                            <div class="flex items-center justify-center gap-1 sm:gap-0.5 bg-white px-3 py-2 rounded-xl border border-slate-200 shadow-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" data-rating="{{ $i }}" class="rating-star-btn text-slate-200 hover:text-amber-400 transition-all focus:outline-none p-1 sm:p-0.5" aria-label="Rate {{ $i }} star">
                                        <svg class="w-7 h-7 sm:w-6 sm:h-6 fill-current transition-colors" viewBox="0 0 24 24">
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                        </svg>
                                    </button>
                                @endfor
                            </div>

                            <div class="w-full flex justify-between text-[10px] font-bold text-slate-400 px-1 uppercase tracking-wider">
                                <span>{{ $ne ? 'कमजोर' : 'Poor' }}</span>
                                <span>{{ $ne ? 'उत्कृष्ट' : 'Excellent' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Q2: Failure Reason Section -->
                    <div id="failure-section" class="hidden rounded-xl border border-slate-200 bg-slate-50/50 p-4 sm:p-5 transition-all duration-300">
                        <label class="block text-[11px] sm:text-xs font-bold text-slate-500 mb-3 uppercase tracking-wider">
                            Q2. {{ $ne ? 'कार्य सम्पन्न नहुनुको प्राथमिक कारण छनोट गर्नुहोस्:' : 'Select primary operational bottleneck:' }}
                            <span class="text-rose-500">*</span>
                        </label>

                        <div class="grid grid-cols-1 gap-2.5">
                            @foreach($reasons as $key => $label)
                                <button type="button" data-reason="{{ $key }}" class="reason-btn w-full rounded-xl border border-slate-200 bg-white p-3.5 text-left text-xs sm:text-sm font-medium transition-all flex items-center justify-between gap-3 text-slate-700 hover:border-blue-300 focus:outline-none shadow-sm">
                                    <span class="leading-relaxed">{{ $label }}</span>

                                    <span class="reason-dot w-4 h-4 rounded-full border border-slate-300 bg-slate-50 flex items-center justify-center shrink-0 transition-all">
                                        <span class="inner-dot w-2 h-2 rounded-full bg-transparent scale-50 transition-all"></span>
                                    </span>
                                </button>
                            @endforeach
                        </div>

                        <div id="bribe-warning" class="hidden mt-4 rounded-xl border border-red-200 bg-red-50/60 p-4 text-red-900 border-l-4 border-l-red-600 animate-fadeIn shadow-sm">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-red-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>

                                <div>
                                    <p class="text-[11px] font-extrabold text-red-700 uppercase tracking-widest">
                                        {{ $ne ? 'अख्तियार/सदाचार अनुगमन सतर्कता' : 'Oversight Compliance Protocol' }}
                                    </p>

                                    <p class="mt-1 text-xs leading-relaxed text-red-800 font-medium">
                                        {{ $ne ? 'यो विवरण administrative निगरानी र सुशासन अडिटका लागि गृह मन्त्रालयको विशेष सदाचार शाखामा प्रत्यक्ष दर्ता हुनेछ।' : 'This feedback token is securely queued directly into internal anti-corruption compliance matrices.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Optional Details & Submit -->
            <div class="lg:col-span-6 flex flex-col justify-between space-y-6">

                <div class="space-y-6">
                    <!-- Textarea -->
                    <div class="space-y-2">
                        <label class="flex justify-between text-[11px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <span>{{ $ne ? 'थप गुणात्मक टिप्पणी वा सुझाव' : 'Qualitative Evaluation / Remarks' }}</span>
                            <span class="text-[10px] text-slate-400 lowercase italic font-normal">{{ $ne ? '(ऐच्छिक)' : '(Optional)' }}</span>
                        </label>

                        <textarea name="citizen_comments" rows="4" class="w-full rounded-xl border border-slate-200 bg-slate-50/30 px-4 py-3.5 text-xs sm:text-sm font-normal focus:bg-white focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 focus:outline-none transition-all placeholder-slate-400 shadow-sm" placeholder="{{ $ne ? 'कार्यालयमा भोग्नुभएका विशिष्ट समस्या, ढिलासुस्ती वा सुधारका क्षेत्रहरू उल्लेख गर्नुहोस्...' : 'Specify parameter anomalies, structural counter delays or infrastructural optimization advice...' }}"></textarea>
                    </div>

                    <!-- Anonymity Toggle -->
                    <div class="space-y-4">
                        <label class="flex items-center justify-between cursor-pointer p-4 rounded-xl bg-slate-50/80 border border-slate-200 hover:bg-slate-100 hover:border-slate-300 transition-all select-none shadow-sm group">
                            <div class="flex items-start gap-3.5 pr-4">
                                <div class="p-2 bg-white rounded-lg border border-slate-200 text-slate-500 shrink-0 shadow-sm group-hover:text-blue-600 transition-colors">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>

                                <div class="text-left">
                                    <span class="block text-xs sm:text-sm font-extrabold text-slate-800 leading-none">
                                        {{ $ne ? 'पहिचान पूर्ण गोप्य राख्नुहोस्' : 'Strict Anonymity Routing' }}
                                    </span>

                                    <span class="block text-[10px] sm:text-xs text-slate-500 font-medium mt-1.5 leading-relaxed">
                                        {{ $ne ? 'यो विकल्प छानेमा तपाईंको नाम र फोन नम्बर सुरक्षित गरिने छैन।' : 'If enabled, your name and phone number will not be stored.' }}
                                    </span>
                                </div>
                            </div>

                            <div class="relative inline-flex items-center shrink-0">
                                <input type="checkbox" name="is_anonymous" id="anonymous" value="1" class="sr-only peer">

                                <div class="w-10 h-6 bg-slate-200 rounded-full peer peer-focus:outline-none peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 transition-colors shadow-inner"></div>
                            </div>
                        </label>

                        <!-- Identity Fields -->
                        <div id="identity-fields" class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-slate-100 pt-4 transition-all duration-300">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">
                                    {{ $ne ? 'पूरा नाम' : 'Full Name' }}
                                </label>

                                <input type="text" name="citizen_name" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs sm:text-sm font-medium focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 focus:outline-none transition-all shadow-sm" placeholder="Ram Bahadur">
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">
                                    {{ $ne ? 'मोबाइल नम्बर' : 'Mobile Number' }}
                                </label>

                                <input type="tel" name="citizen_phone" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs sm:text-sm font-medium focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 focus:outline-none transition-all shadow-sm" placeholder="984XXXXXXX">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center gap-3 pt-4 sm:pt-2 border-t sm:border-t-0 border-slate-100 mt-6 sm:mt-0">
                    <a href="{{ route('workflow.roadmap', ['token' => $token]) }}" class="inline-flex items-center justify-center rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 px-5 py-3.5 sm:py-3 text-xs sm:text-sm font-bold text-slate-600 transition-all shadow-sm sm:shrink-0 text-center">
                        {{ $ne ? 'पछाडि जानुहोस्' : 'Cancel' }}
                    </a>

                    <button type="submit" class="flex-1 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-blue-600/20 transition-all py-3.5 sm:py-3 flex items-center justify-center tracking-wide active:scale-[0.98]">
                        {{ $ne ? 'विवरण सुरक्षित रूपमा बुझाउनुहोस्' : 'Submit Authentication Feedback' }}
                    </button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const isCompleted = document.getElementById('is_completed');
    const ratingValue = document.getElementById('rating_value');
    const reasonValue = document.getElementById('reason_value');

    const yesBtn = document.getElementById('yes-btn');
    const noBtn = document.getElementById('no-btn');
    const successSection = document.getElementById('success-section');
    const failureSection = document.getElementById('failure-section');
    const bribeWarning = document.getElementById('bribe-warning');
    const anonymous = document.getElementById('anonymous');
    const identityFields = document.getElementById('identity-fields');

    function setStatus(success) {
        isCompleted.value = success ? '1' : '0';

        if (success) {
            yesBtn.classList.remove('border-slate-200', 'bg-white', 'text-slate-700');
            yesBtn.classList.add('bg-emerald-50/40', 'border-emerald-500', 'text-emerald-800', 'ring-2', 'ring-emerald-500/20');

            noBtn.classList.add('border-slate-200', 'bg-white', 'text-slate-700');
            noBtn.classList.remove('bg-rose-50/40', 'border-rose-500', 'text-rose-800', 'ring-2', 'ring-rose-500/20');

            successSection.classList.remove('hidden');
            failureSection.classList.add('hidden');

            reasonValue.value = '';
            setRating(Number(ratingValue.value || 5));
        } else {
            yesBtn.classList.add('border-slate-200', 'bg-white', 'text-slate-700');
            yesBtn.classList.remove('bg-emerald-50/40', 'border-emerald-500', 'text-emerald-800', 'ring-2', 'ring-emerald-500/20');

            noBtn.classList.remove('border-slate-200', 'bg-white', 'text-slate-700');
            noBtn.classList.add('bg-rose-50/40', 'border-rose-500', 'text-rose-800', 'ring-2', 'ring-rose-500/20');

            successSection.classList.add('hidden');
            failureSection.classList.remove('hidden');

            setReason(reasonValue.value || 'missing_doc');
        }
    }

    function setRating(val) {
        ratingValue.value = val;

        document.querySelectorAll('[data-rating]').forEach((btn) => {
            const index = Number(btn.dataset.rating);

            if (index <= val) {
                btn.classList.remove('text-slate-200');
                btn.classList.add('text-amber-400', 'scale-110');
            } else {
                btn.classList.remove('text-amber-400', 'scale-110');
                btn.classList.add('text-slate-200');
            }
        });
    }

    function previewRating(val) {
        document.querySelectorAll('[data-rating]').forEach((btn) => {
            const index = Number(btn.dataset.rating);

            if (index <= val) {
                btn.classList.add('text-amber-400');
                btn.classList.remove('text-slate-200');
            } else {
                btn.classList.remove('text-amber-400');
                btn.classList.add('text-slate-200');
            }
        });
    }

    function setReason(val) {
        reasonValue.value = val;

        if (bribeWarning) {
            bribeWarning.classList.toggle('hidden', val !== 'bribe_request');
        }

        document.querySelectorAll('[data-reason]').forEach((btn) => {
            const active = btn.dataset.reason === val;
            const dot = btn.querySelector('.reason-dot');
            const inner = btn.querySelector('.inner-dot');

            if (active) {
                btn.classList.remove('bg-white', 'border-slate-200');
                btn.classList.add('bg-blue-50/40', 'border-blue-500', 'ring-2', 'ring-blue-500/20');

                dot.classList.remove('border-slate-300', 'bg-slate-50');
                dot.classList.add('border-blue-600', 'bg-white');

                inner.classList.remove('bg-transparent', 'scale-50');
                inner.classList.add('bg-blue-600', 'scale-100');
            } else {
                btn.classList.add('bg-white', 'border-slate-200');
                btn.classList.remove('bg-blue-50/40', 'border-blue-500', 'ring-2', 'ring-blue-500/20');

                dot.classList.add('border-slate-300', 'bg-slate-50');
                dot.classList.remove('border-blue-600', 'bg-white');

                inner.classList.add('bg-transparent', 'scale-50');
                inner.classList.remove('bg-blue-600', 'scale-100');
            }
        });
    }

    yesBtn.addEventListener('click', () => setStatus(true));
    noBtn.addEventListener('click', () => setStatus(false));

    document.querySelectorAll('[data-rating]').forEach((btn) => {
        btn.addEventListener('click', () => setRating(Number(btn.dataset.rating)));
        btn.addEventListener('mouseenter', () => previewRating(Number(btn.dataset.rating)));
        btn.addEventListener('mouseleave', () => setRating(Number(ratingValue.value)));
    });

    document.querySelectorAll('[data-reason]').forEach((btn) => {
        btn.addEventListener('click', () => setReason(btn.dataset.reason));
    });

    anonymous.addEventListener('change', () => {
        if (anonymous.checked) {
            identityFields.style.opacity = '0';

            setTimeout(() => {
                identityFields.classList.add('hidden');
            }, 200);
        } else {
            identityFields.classList.remove('hidden');

            setTimeout(() => {
                identityFields.style.opacity = '1';
            }, 10);
        }
    });

    setStatus(true);
});
</script>
@endpush

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(4px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.2s ease-out forwards;
    }
</style>