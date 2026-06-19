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
<div class="max-w-6xl mx-auto px-2">
    <section class="rounded-[2rem] border border-slate-200/80 bg-white/90 backdrop-blur-md shadow-[0_20px_50px_rgba(15,23,42,0.04)] p-6 sm:p-10 transition-all duration-300">
        
        <form method="POST" action="{{ route('portal.submit-checkout') }}" class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-10">
            @csrf
            <input type="hidden" name="is_successful" id="is_successful" value="1">
            <input type="hidden" name="rating" id="rating_value" value="5">
            <input type="hidden" name="unsuccessful_reason" id="reason_value" value="missing_doc">

            <!-- Left Column: Header / Q1 / Q2 Details -->
            <div class="md:col-span-6 flex flex-col justify-start space-y-6 text-left border-b md:border-b-0 md:border-r border-slate-100 pb-6 md:pb-0 md:pr-8">
                <!-- Header details -->
                <div class="space-y-4">
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-rose-50 text-rose-600 border border-rose-100">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                            {{ $ne ? 'नागरिक पृष्ठपोषण' : 'Citizen Feedback' }}
                        </span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-900 leading-tight">
                        {{ $ne ? 'निकास तथा सेवा प्रतिक्रिया' : 'Checkout & Feedback' }}
                    </h2>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        {{ $ne ? 'नेपाल सरकारका सेवाहरूलाई पारदर्शी, छिटो र जवाफदेही बनाउन मद्दत गर्नुहोस्। तपाईंको अमूल्य पृष्ठपोषण गोप्य र सुरक्षित रहनेछ।' : 'Help keep public services transparent, fast, and accountable. Your feedback is securely logged and fully protected.' }}
                    </p>
                    
                    @if($selectedService)
                        <div class="inline-flex items-center gap-2 rounded-xl bg-slate-50 border border-slate-200/80 px-3 py-2 text-xs font-bold text-slate-650 self-start">
                            <span class="text-slate-400">📋</span>
                            <span>{{ $ne ? 'सेवा:' : 'Service:' }}</span>
                            <span class="text-blue-700">{{ $ne ? $selectedService->name_ne : $selectedService->name_en }}</span>
                        </div>
                    @endif
                </div>

                <div class="border-t border-slate-100 pt-6 space-y-6">
                    <!-- Question 1: Task Completion -->
                    <div class="space-y-3">
                        <label class="block text-sm font-black text-slate-800">
                            Q1. {{ $ne ? 'के तपाईंको काम आज सफल रूपमा सम्पन्न भयो?' : 'Was your task successfully completed today?' }} 
                            <span class="text-rose-600 font-bold">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <button type="button" id="yes-btn" class="tap flex items-center justify-center p-4 rounded-2xl border text-center transition-all duration-300 font-black text-sm text-slate-900">
                                {{ $ne ? 'हो, पूरा भयो' : 'Yes, completed' }}
                            </button>
                            
                            <button type="button" id="no-btn" class="tap flex items-center justify-center p-4 rounded-2xl border text-center transition-all duration-300 font-black text-sm text-slate-900">
                                {{ $ne ? 'होइन, भएन' : 'No, not completed' }}
                            </button>
                        </div>
                    </div>

                    <!-- Question 2: Satisfaction Rating (Success state) -->
                    <div id="success-section" class="rounded-2xl border border-slate-200/80 bg-slate-50/50 p-5 transition-all duration-300 flex flex-col sm:flex-row sm:items-center sm:justify-between sm:gap-4">
                        <div class="sm:max-w-xs text-left">
                            <label class="block text-sm font-black text-slate-800 leading-normal">
                                Q2. {{ $ne ? 'तपाईं सेवा अनुभवप्रति कत्तिको सन्तुष्ट हुनुहुन्छ?' : 'How satisfied were you with the service experience?' }} 
                                <span class="text-rose-600 font-bold">*</span>
                            </label>
                        </div>
                        <div class="flex flex-col items-center gap-1 shrink-0 mt-3 sm:mt-0">
                            <div class="flex items-center justify-center gap-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" data-rating="{{ $i }}" class="rating-star-btn text-slate-250 hover:text-amber-400 hover:scale-115 active:scale-95 transition-all duration-150 focus:outline-none" aria-label="Rate {{ $i }} star">
                                        <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                        </svg>
                                    </button>
                                @endfor
                            </div>
                            <div class="w-full flex justify-between text-[10px] font-extrabold text-slate-400 uppercase tracking-wider px-1">
                                <span>{{ $ne ? 'न्यूनतम' : 'Poor' }}</span>
                                <span>{{ $ne ? 'उत्कृष्ट' : 'Excellent' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Question 2: Reasons of failure (Failure state) -->
                    <div id="failure-section" class="hidden rounded-2xl border border-slate-200/80 bg-slate-50/50 p-5 transition-all duration-300">
                        <label class="block text-sm font-black text-slate-800 mb-4">
                            Q2. {{ $ne ? 'काम पूरा नहुनुको मुख्य कारण के थियो?' : 'What is the primary reason your work was not completed?' }} 
                            <span class="text-rose-600 font-bold">*</span>
                        </label>
                        <div class="grid grid-cols-1 gap-2.5">
                            @foreach($reasons as $key => $label)
                                <button type="button" data-reason="{{ $key }}" class="reason-btn w-full rounded-xl border p-3.5 text-left text-xs font-black transition-all flex items-center justify-between gap-3 bg-white border-slate-200/80 hover:bg-slate-50 hover:border-slate-350 focus:outline-none">
                                    <span class="text-slate-700 font-black leading-normal">{{ $label }}</span>
                                    <span class="reason-dot w-4 h-4 rounded-full border border-slate-300 flex items-center justify-center shrink-0 transition-colors">
                                        <span class="inner-dot w-2 h-2 rounded-full bg-transparent transition-all"></span>
                                    </span>
                                </button>
                            @endforeach
                        </div>
                        
                        <!-- Bribery Warning Alert Banner -->
                        <div id="bribe-warning" class="hidden mt-4 rounded-2xl border border-red-200 bg-gradient-to-r from-red-50 to-rose-50/30 p-4 text-red-900 border-l-4 border-l-red-600 animate-fadeIn">
                            <div class="flex items-start gap-3">
                                <span class="text-lg">🚨</span>
                                <div>
                                    <p class="text-xs font-black uppercase tracking-widest text-red-700">{{ $ne ? 'भ्रष्टाचार/घुस सम्बन्धी सचेतक' : 'Anti-Bribery Alert Active' }}</p>
                                    <p class="mt-1 text-xs leading-relaxed text-red-800 font-semibold">{{ $ne ? 'तपाईंको यो विवरण प्रशासनिक निगरानी र सदाचार अडिटका लागि गृह मन्त्रालयको विशेष उजुरी डेस्कमा पठाइनेछ।' : 'This feedback will be instantly flagged to high-integrity compliance officers for integrity audit.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Comments / Privacy / Action buttons -->
            <div class="md:col-span-6 space-y-6">
                <!-- Comments Area -->
                <div class="space-y-2">
                    <label class="flex justify-between text-sm font-black text-slate-800">
                        <span>{{ $ne ? 'तपाईंको प्रतिक्रिया/गुनासो' : 'Your feedback/comments' }}</span>
                        <span class="text-xs font-bold text-slate-400 italic">{{ $ne ? 'ऐच्छिक' : 'Optional' }}</span>
                    </label>
                    <textarea name="comments" rows="5" class="w-full rounded-2xl border border-slate-250 bg-white px-4 py-3 text-sm font-medium focus:border-slate-900 focus:ring-1 focus:ring-slate-900 focus:outline-none transition-all placeholder-slate-300" placeholder="{{ $ne ? 'कार्यालयमा भोगेका अनुभव, ढिलासुस्ती वा सुधारका सुझाव लेख्नुहोस्...' : 'Describe your experience, delay spots, or suggestion detail...' }}"></textarea>
                </div>

                <!-- Anonymity Toggle & Identity Wrapper -->
                <div class="space-y-4">
                    <label class="flex items-center justify-between cursor-pointer p-4 rounded-2xl bg-slate-50 border border-slate-200/80 hover:bg-slate-100/50 transition-all select-none">
                        <div class="flex items-center gap-3">
                            <span class="text-lg">🕵️</span>
                            <div class="text-left">
                                <span class="block text-sm font-black text-slate-800 leading-none">{{ $ne ? 'मेरो पहिचान गोप्य राख्नुहोस्' : 'Keep my feedback anonymous' }}</span>
                                <span class="block text-[10px] text-slate-400 font-bold mt-1.5 leading-none">{{ $ne ? 'प्रणालीमा तपाईंको व्यक्तिगत विवरणहरू सेभ गरिने छैन।' : 'No profile metrics or contact credentials will be logged.' }}</span>
                            </div>
                        </div>
                        <div class="relative inline-flex items-center">
                            <input type="checkbox" name="is_anonymous" id="anonymous" value="1" class="sr-only peer">
                            <div class="w-10 h-6 bg-slate-200 rounded-full peer peer-focus:outline-none peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 transition-colors"></div>
                        </div>
                    </label>

                    <!-- Identity inputs container -->
                    <div id="identity-fields" class="grid sm:grid-cols-2 gap-4 border-t border-slate-100 pt-4 transition-all duration-300">
                        <div>
                            <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-wider mb-1.5">{{ $ne ? 'पूरा नाम' : 'Full Name' }}</label>
                            <input type="text" name="citizen_name" class="w-full rounded-xl border border-slate-250 bg-white px-4 py-2.5 text-sm font-semibold focus:border-slate-900 focus:ring-1 focus:ring-slate-900 focus:outline-none transition-all" placeholder="Ram Bahadur">
                        </div>
                        <div>
                            <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-wider mb-1.5">{{ $ne ? 'मोबाइल नम्बर' : 'Mobile Number' }}</label>
                            <input type="tel" name="citizen_phone" class="w-full rounded-xl border border-slate-250 bg-white px-4 py-2.5 text-sm font-semibold focus:border-slate-900 focus:ring-1 focus:ring-slate-900 focus:outline-none transition-all" placeholder="984XXXXXXX">
                        </div>
                    </div>
                </div>

                <!-- Submit & Cancel Buttons -->
                <div class="flex items-center gap-3 pt-4">
                    <a href="{{ route('portal.active-guide') }}" class="tap rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-200 px-5 py-3.5 text-xs font-black text-slate-600 transition-all flex items-center justify-center shrink-0">
                        {{ $ne ? 'पछि फर्कनुहोस्' : 'Back' }}
                    </a>
                    
                    <button type="submit" class="tap flex-1 rounded-2xl bg-gradient-to-r from-blue-700 to-indigo-800 hover:from-blue-800 hover:to-indigo-900 text-white font-black text-sm shadow-md hover:shadow-indigo-500/10 active:scale-[0.99] transition-all py-3.5 flex items-center justify-center">
                        {{ $ne ? 'प्रतिक्रिया सुरक्षित बुझाउनुहोस्' : 'Submit Secure Feedback' }}
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
    
    // Status State Handler
    function setStatus(success) {
        isSuccessful.value = success ? '1' : '0';
        successSection.classList.toggle('hidden', !success);
        failureSection.classList.toggle('hidden', success);
        
        if (success) {
            yesBtn.className = 'tap flex items-center justify-center p-4 rounded-2xl border text-center transition-all duration-300 font-black text-sm bg-emerald-50/50 border-emerald-300 ring-2 ring-emerald-100/50 text-emerald-800';
            noBtn.className = 'tap flex items-center justify-center p-4 rounded-2xl border text-center transition-all duration-300 font-black text-sm bg-white border-slate-200 hover:bg-slate-50 hover:border-slate-350 text-slate-500';
            setRating(5);
        } else {
            yesBtn.className = 'tap flex items-center justify-center p-4 rounded-2xl border text-center transition-all duration-300 font-black text-sm bg-white border-slate-200 hover:bg-slate-50 hover:border-slate-350 text-slate-500';
            noBtn.className = 'tap flex items-center justify-center p-4 rounded-2xl border text-center transition-all duration-300 font-black text-sm bg-rose-50/50 border-rose-300 ring-2 ring-rose-100/50 text-rose-800';
            setReason('missing_doc');
        }
    }
    
    // Rating Stars Handler
    function setRating(val) {
        ratingValue.value = val;
        document.querySelectorAll('[data-rating]').forEach((btn) => {
            const index = Number(btn.dataset.rating);
            if (index <= val) {
                btn.className = 'rating-star-btn text-amber-400 scale-105 transition-all duration-150 focus:outline-none';
            } else {
                btn.className = 'rating-star-btn text-slate-250 hover:text-amber-300 transition-all duration-150 focus:outline-none';
            }
        });
    }
    
    // Reason Selection Handler
    function setReason(val) {
        reasonValue.value = val;
        bribeWarning.classList.toggle('hidden', val !== 'bribe_request');
        
        document.querySelectorAll('[data-reason]').forEach((btn) => {
            const active = btn.dataset.reason === val;
            const dot = btn.querySelector('.reason-dot');
            const inner = btn.querySelector('.inner-dot');
            
            if (active) {
                btn.className = 'reason-btn w-full rounded-xl border p-3.5 text-left text-xs font-black transition-all flex items-center justify-between gap-3 bg-rose-50/30 border-rose-300 ring-1 ring-rose-100/50 focus:outline-none';
                dot.className = 'reason-dot w-4 h-4 rounded-full border border-rose-450 bg-rose-50 flex items-center justify-center shrink-0 transition-colors';
                inner.className = 'inner-dot w-2 h-2 rounded-full bg-rose-600 transition-all scale-100';
            } else {
                btn.className = 'reason-btn w-full rounded-xl border p-3.5 text-left text-xs font-black transition-all flex items-center justify-between gap-3 bg-white border-slate-200/80 hover:bg-slate-50 hover:border-slate-350 focus:outline-none';
                dot.className = 'reason-dot w-4 h-4 rounded-full border border-slate-300 bg-transparent flex items-center justify-center shrink-0 transition-colors';
                inner.className = 'inner-dot w-2 h-2 rounded-full bg-transparent transition-all scale-50';
            }
        });
    }
    
    // Event listeners binding
    yesBtn.addEventListener('click', () => setStatus(true));
    noBtn.addEventListener('click', () => setStatus(false));
    
    document.querySelectorAll('[data-rating]').forEach((btn) => {
        btn.addEventListener('click', () => setRating(Number(btn.dataset.rating)));
        
        // Star hover preview effect
        btn.addEventListener('mouseenter', () => {
            const val = Number(btn.dataset.rating);
            document.querySelectorAll('[data-rating]').forEach((s) => {
                const index = Number(s.dataset.rating);
                if (index <= val) {
                    s.classList.add('text-amber-300');
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
    
    // Initial states binding
    setStatus(true);
});
</script>
@endpush
