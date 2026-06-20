@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
    $reasons = [
        'missing_doc' => $ne ? 'आवश्यक कागजात/प्रमाण नपुगेको' : 'Missing required documents / credentials',
        'server_down' => $ne ? 'सरकारी सर्भर डाउन वा नेटवर्क समस्या' : 'System/server down or network issue',
        'long_queue' => $ne ? 'अत्यधिक भिडभाड / समय सकिएको' : 'Long queue / timed out for the day',
        'visit_tomorrow' => $ne ? 'कर्मचारीले अर्को दिन आउन भनेको' : 'Officer asked to visit another date',
        'staff_unhelpful' => $ne ? 'कर्मचारीको रुखो व्यवहार वा ढिलासुस्ती' : 'Unhelpful or hostile staff behavior',
        'bribe_request' => $ne ? 'घुस/थप रकम मागिएको वा बिचौलिया' : 'Bribery attempt / middlemen solicitation',
        'other' => $ne ? 'अन्य कारणहरू' : 'Other reasons',
    ];
@endphp

@section('title', $ne ? 'निकास प्रतिक्रिया' : 'Checkout Feedback')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6 selection:bg-blue-600 selection:text-white font-sans">
    <section class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6 sm:p-8 lg:p-10 transition-all duration-300">
        
        <form method="POST" action="{{ route('portal.submit-checkout') }}" class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
            @csrf
            <input type="hidden" name="is_successful" id="is_successful" value="1">
            <input type="hidden" name="rating" id="rating_value" value="5">
            <input type="hidden" name="unsuccessful_reason" id="reason_value" value="missing_doc">

            <div class="lg:col-span-6 flex flex-col justify-start space-y-6 lg:border-r lg:border-slate-200 lg:pr-10">
                
                <div class="space-y-3">
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded border border-blue-200 bg-blue-50/50 text-[11px] font-semibold text-blue-700 shadow-sm">
                            {{ $ne ? 'नागरिक पृष्ठपोषण डेस्क' : 'Citizen Feedback Desk' }}
                        </span>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900">
                        {{ $ne ? 'सेवा प्रवाह मूल्याङ्कन फारम' : 'Service Delivery Assessment' }}
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-normal">
                        {{ $ne ? 'नेपाल सरकारका administrative सेवाहरूलाई थप पारदर्शी र जवाफदेही बनाउन आफ्नो अनुभव साझा गर्नुहोस्। तपाईंको विवरण पूर्ण रूपमा सुरक्षित रहनेछ।' : 'Help optimize public utility infrastructure by sharing your experience. Your verification audit is highly secured.' }}
                    </p>
                    
                    @if(isset($selectedService))
                        <div class="inline-flex items-center gap-2 rounded-lg bg-slate-50 border border-slate-200 px-3 py-1.5 text-xs text-slate-600 font-medium">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span>{{ $ne ? 'सेवा सन्दर्भ:' : 'Service Reference:' }}</span>
                            <span class="text-slate-900 font-semibold">{{ $ne ? $selectedService->name_ne : $selectedService->name_en }}</span>
                        </div>
                    @endif
                </div>

                <div class="border-t border-slate-100 pt-5 space-y-6">
                    <div class="space-y-3">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide">
                            Q1. {{ $ne ? 'के तपाईंको अभिप्रेत कार्य आज सम्पन्न भयो?' : 'Was your intended workflow completed today?' }} 
                            <span class="text-rose-500">*</span>
                        </label>
                        <div class="grid grid-cols-2 gap-4">
                            <button type="button" id="yes-btn" class="group flex items-center justify-center gap-2.5 py-3 rounded-xl border border-slate-200 bg-white text-slate-700 font-medium text-sm transition-all duration-150 shadow-sm hover:border-slate-350 focus:outline-none">
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-emerald-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ $ne ? 'हो, सम्पन्न भयो' : 'Yes, Completed' }}</span>
                            </button>
                            
                            <button type="button" id="no-btn" class="group flex items-center justify-center gap-2.5 py-3 rounded-xl border border-slate-200 bg-white text-slate-700 font-medium text-sm transition-all duration-150 shadow-sm hover:border-slate-350 focus:outline-none">
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-rose-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span>{{ $ne ? 'होइन, भएन' : 'No, Incomplete' }}</span>
                            </button>
                        </div>
                    </div>

                    <div id="success-section" class="rounded-xl border border-slate-200 bg-slate-50/40 p-4 transition-all duration-300 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="sm:max-w-[220px] text-left">
                            <label class="block text-xs font-semibold text-slate-500 leading-normal uppercase tracking-wide">
                                Q2. {{ $ne ? 'समग्र सेवा सन्तुष्टि स्तर निर्धारण गर्नुहोस्:' : 'Rate your overall satisfaction level:' }} 
                                <span class="text-rose-500">*</span>
                            </label>
                        </div>
                        <div class="flex flex-col items-center gap-1 shrink-0">
                            <div class="flex items-center justify-center gap-0.5 bg-white px-2.5 py-1.5 rounded-lg border border-slate-200 shadow-xs">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" data-rating="{{ $i }}" class="rating-star-btn text-slate-200 hover:text-amber-400 transition-all focus:outline-none p-0.5" aria-label="Rate {{ $i }} star">
                                        <svg class="w-6 h-6 fill-current transition-colors" viewBox="0 0 24 24">
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                        </svg>
                                    </button>
                                @endfor
                            </div>
                            <div class="w-full flex justify-between text-[10px] font-semibold text-slate-400 px-1">
                                <span>{{ $ne ? 'कमजोर' : 'Poor' }}</span>
                                <span>{{ $ne ? 'उत्कृष्ट' : 'Excellent' }}</span>
                            </div>
                        </div>
                    </div>

                    <div id="failure-section" class="hidden rounded-xl border border-slate-200 bg-slate-50/40 p-4 transition-all duration-300">
                        <label class="block text-xs font-semibold text-slate-500 mb-3 uppercase tracking-wide">
                            Q2. {{ $ne ? 'कार्य सम्पन्न नहुनुको प्राथमिक कारण छनोट गर्नुहोस्:' : 'Select primary operational bottleneck:' }} 
                            <span class="text-rose-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 gap-2">
                            @foreach($reasons as $key => $label)
                                <button type="button" data-reason="{{ $key }}" class="reason-btn w-full rounded-lg border border-slate-200 bg-white p-3 text-left text-xs font-medium transition-all flex items-center justify-between gap-3 text-slate-700 hover:bg-slate-50 focus:outline-none">
                                    <span class="leading-normal font-medium">{{ $label }}</span>
                                    <span class="reason-dot w-3.5 h-3.5 rounded-full border border-slate-300 bg-slate-50 flex items-center justify-center shrink-0 transition-all">
                                        <span class="inner-dot w-1.5 h-1.5 rounded-full bg-transparent scale-50 transition-all"></span>
                                    </span>
                                </button>
                            @endforeach
                        </div>
                        
                        <div id="bribe-warning" class="hidden mt-3 rounded-lg border border-red-200 bg-red-50/40 p-3 text-red-900 border-l-4 border-l-red-600 animate-fadeIn">
                            <div class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-red-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <div>
                                    <p class="text-[10px] font-bold text-red-700 uppercase tracking-wide">{{ $ne ? 'अख्तियार/सदाचार अनुगमन सतर्कता' : 'Oversight Compliance Protocol' }}</p>
                                    <p class="mt-0.5 text-xs leading-relaxed text-red-800 font-normal">{{ $ne ? 'यो विवरण administrative निगरानी र सुशासन अडिटका लागि गृह मन्त्रालयको विशेष सदाचार शाखामा प्रत्यक्ष दर्ता हुनेछ।' : 'This feedback token is securely queued directly into internal anti-corruption compliance matrices.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-6 flex flex-col justify-between space-y-6">
                
                <div class="space-y-2">
                    <label class="flex justify-between text-xs font-semibold text-slate-500 uppercase tracking-wide">
                        <span>{{ $ne ? 'थप गुणात्मक टिप्पणी वा सुझाव' : 'Qualitative Evaluation / Remarks' }}</span>
                        <span class="text-[10px] text-slate-400 lowercase italic font-normal">{{ $ne ? '(ऐच्छिक)' : '(Optional)' }}</span>
                    </label>
                    <textarea name="comments" rows="5" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs sm:text-sm font-normal focus:border-blue-600 focus:ring-1 focus:ring-blue-600 focus:outline-none transition-all placeholder-slate-300 shadow-xs" placeholder="{{ $ne ? 'कार्यालयमा भोग्नुभएका विशिष्ट समस्या, ढिलासुस्ती वा सुधारका क्षेत्रहरू उल्लेख गर्नुहोस्...' : 'Specify parameter anomalies, structural counter delays or infrastructural optimization advice...' }}"></textarea>
                </div>

                <div class="space-y-4">
                    <label class="flex items-center justify-between cursor-pointer p-3.5 rounded-xl bg-slate-50/50 border border-slate-200 hover:bg-slate-50 transition-all select-none shadow-xs">
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-white rounded-lg border border-slate-200 text-slate-500 shrink-0 shadow-2xs">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <span class="block text-xs sm:text-sm font-bold text-slate-800 leading-none">{{ $ne ? 'पहिचान पूर्ण गोप्य राख्नुहोस्' : 'Strict Anonymity Routing' }}</span>
                                <span class="block text-[10px] sm:text-[11px] text-slate-400 font-normal mt-1.5 leading-normal">{{ $ne ? 'तपाईंको नाम र फोन नम्बर डेटाबेसमा इन्क्रिप्ट गरिनेछ।' : 'Biometric profile linkage and metadata identifiers are entirely scrubbed.' }}</span>
                            </div>
                        </div>
                        <div class="relative inline-flex items-center shrink-0 ml-4">
                            <input type="checkbox" name="is_anonymous" id="anonymous" value="1" class="sr-only peer">
                            <div class="w-9 h-5 bg-slate-200 rounded-full peer peer-focus:outline-none peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600 transition-colors"></div>
                        </div>
                    </label>

                    <div id="identity-fields" class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-slate-100 pt-4 transition-all duration-300">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wide mb-1.5">{{ $ne ? 'पूरा नाम' : 'Full Name' }}</label>
                            <input type="text" name="citizen_name" class="w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-xs sm:text-sm font-normal focus:border-blue-600 focus:ring-1 focus:ring-blue-600 focus:outline-none transition-all shadow-xs" placeholder="Ram Bahadur">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wide mb-1.5">{{ $ne ? 'मोबाइल नम्बर' : 'Mobile Number' }}</label>
                            <input type="tel" name="citizen_phone" class="w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-xs sm:text-sm font-normal focus:border-blue-600 focus:ring-1 focus:ring-blue-600 focus:outline-none transition-all shadow-xs" placeholder="984XXXXXXX">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <a href="{{ route('portal.active-guide') }}" class="inline-flex items-center justify-center rounded-lg bg-slate-50 hover:bg-slate-100 border border-slate-200 px-4 py-2.5 text-xs font-semibold text-slate-600 transition-all shadow-xs shrink-0">
                        {{ $ne ? 'पछाडि जानुहोस्' : 'Cancel' }}
                    </a>
                    
                    <button type="submit" class="flex-1 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm shadow-sm transition-all py-2.5 flex items-center justify-center tracking-wide active:scale-[0.995]">
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
    const isSuccessful = document.getElementById('is_successful');
    const ratingValue = document.getElementById('rating_value');
    const reasonValue = document.getElementById('reason_value');
    
    const yesBtn = document.getElementById('yes-btn');
    const noBtn = document.getElementById('no-btn');
    const successSection = document.getElementById('success-section');
    const failureSection = document.getElementById('failure-section');
    const bribeWarning = document.getElementById('bribe-warning');
    const anonymous = document.getElementById('anonymous');
    const identityFields = document.getElementById('identity-fields');
    
    // Clean Dynamic Visual States Engine
    function setStatus(success) {
        isSuccessful.value = success ? '1' : '0';
        
        if (success) {
            yesBtn.classList.remove('border-slate-200', 'bg-white', 'text-slate-700');
            yesBtn.classList.add('bg-emerald-50/40', 'border-emerald-600', 'text-emerald-900', 'ring-1', 'ring-emerald-600/10');
            
            noBtn.classList.add('border-slate-200', 'bg-white', 'text-slate-700');
            noBtn.classList.remove('bg-rose-50/40', 'border-rose-600', 'text-rose-900', 'ring-1', 'ring-rose-600/10');
            
            successSection.classList.remove('hidden');
            failureSection.classList.add('hidden');
            setRating(5);
        } else {
            yesBtn.classList.add('border-slate-200', 'bg-white', 'text-slate-700');
            yesBtn.classList.remove('bg-emerald-50/40', 'border-emerald-600', 'text-emerald-900', 'ring-1', 'ring-emerald-600/10');
            
            noBtn.classList.remove('border-slate-200', 'bg-white', 'text-slate-700');
            noBtn.classList.add('bg-rose-50/40', 'border-rose-600', 'text-rose-900', 'ring-1', 'ring-rose-600/10');
            
            successSection.classList.add('hidden');
            failureSection.classList.remove('hidden');
            setReason('missing_doc');
        }
    }
    
    function setRating(val) {
        ratingValue.value = val;
        document.querySelectorAll('[data-rating]').forEach((btn) => {
            const index = Number(btn.dataset.rating);
            if (index <= val) {
                btn.classList.remove('text-slate-200');
                btn.classList.add('text-amber-400');
            } else {
                btn.classList.remove('text-amber-400');
                btn.classList.add('text-slate-200');
            }
        });
    }
    
    function setReason(val) {
        reasonValue.value = val;
        bribeWarning.classList.toggle('hidden', val !== 'bribe_request');
        
        document.querySelectorAll('[data-reason]').forEach((btn) => {
            const active = btn.dataset.reason === val;
            const dot = btn.querySelector('.reason-dot');
            const inner = btn.querySelector('.inner-dot');
            
            if (active) {
                btn.classList.remove('bg-white', 'border-slate-200');
                btn.classList.add('bg-blue-50/40', 'border-blue-600', 'ring-1', 'ring-blue-600/10');
                dot.classList.remove('border-slate-300', 'bg-slate-50');
                dot.classList.add('border-blue-600', 'bg-white');
                inner.classList.remove('bg-transparent', 'scale-50');
                inner.classList.add('bg-blue-600', 'scale-100');
            } else {
                btn.classList.add('bg-white', 'border-slate-200');
                btn.classList.remove('bg-blue-50/40', 'border-blue-600', 'ring-1', 'ring-blue-600/10');
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
        
        btn.addEventListener('mouseenter', () => {
            const val = Number(btn.dataset.rating);
            document.querySelectorAll('[data-rating]').forEach((s) => {
                if (Number(s.dataset.rating) <= val) {
                    s.classList.add('text-amber-400');
                    s.classList.remove('text-slate-200');
                }
            });
        });
        
        btn.addEventListener('mouseleave', () => {
            setRating(Number(ratingValue.value));
        });
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
        from { opacity: 0; transform: translateY(2px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.18s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>