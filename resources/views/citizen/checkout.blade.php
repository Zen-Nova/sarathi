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
<div class="max-w-2xl mx-auto">
    <section class="rounded-3xl border border-slate-200 bg-white shadow-soft p-5 sm:p-8">
        <div class="border-b border-slate-100 pb-5 mb-5">
            <p class="text-xs font-black uppercase tracking-widest text-rose-600">{{ $ne ? 'राहदानी विभाग' : 'Department of Passports' }}</p>
            <h2 class="mt-1 text-2xl font-black tracking-tight text-slate-950">{{ $ne ? 'नागरिक निकास तथा प्रतिक्रिया' : 'Citizen Checkout & Feedback' }}</h2>
            <p class="mt-2 text-sm text-slate-500">{{ $ne ? 'सरकारी निकायलाई पारदर्शी, छिटो र जवाफदेही बनाउन मद्दत गर्नुहोस्।' : 'Help keep government agencies transparent, fast and accountable.' }}</p>
            @if($selectedService)
                <p class="mt-3 rounded-xl bg-slate-50 border border-slate-200 px-3 py-2 text-xs font-bold text-slate-600">
                    {{ $ne ? 'सेवा' : 'Service' }}: {{ $ne ? $selectedService->name_ne : $selectedService->name_en }}
                </p>
            @endif
        </div>

        <form method="POST" action="{{ route('portal.submit-checkout') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="is_successful" id="is_successful" value="1">
            <input type="hidden" name="rating" id="rating_value" value="5">
            <input type="hidden" name="unsuccessful_reason" id="reason_value" value="missing_doc">

            <div>
                <label class="block text-sm font-black text-slate-950 mb-3">Q1. {{ $ne ? 'के तपाईंको काम आज सफल रूपमा सम्पन्न भयो?' : 'Was your task successfully completed today?' }} <span class="text-rose-600">*</span></label>
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" id="yes-btn" class="tap rounded-2xl border p-4 text-center font-black text-sm transition"><span class="block text-2xl mb-1">👍</span>{{ $ne ? 'हो, पूरा भयो' : 'Yes, completed' }}</button>
                    <button type="button" id="no-btn" class="tap rounded-2xl border p-4 text-center font-black text-sm transition"><span class="block text-2xl mb-1">✕</span>{{ $ne ? 'होइन, भएन' : 'No, not completed' }}</button>
                </div>
            </div>

            <div id="success-section" class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <label class="block text-sm font-black text-slate-950 mb-3">Q2. {{ $ne ? 'तपाईं सेवा अनुभवप्रति कत्तिको सन्तुष्ट हुनुहुन्छ?' : 'How satisfied were you with the service experience?' }} <span class="text-rose-600">*</span></label>
                <div class="grid grid-cols-5 gap-2">
                    @for($i = 1; $i <= 5; $i++)
                        <button type="button" data-rating="{{ $i }}" class="rating-btn tap rounded-xl border py-3 text-sm font-black transition">⭐ {{ $i }}</button>
                    @endfor
                </div>
                <div class="mt-2 flex justify-between text-[11px] font-bold text-slate-400"><span>{{ $ne ? 'कम' : 'Poor' }}</span><span>{{ $ne ? 'उत्कृष्ट' : 'Excellent' }}</span></div>
            </div>

            <div id="failure-section" class="hidden rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <label class="block text-sm font-black text-slate-950 mb-3">Q2. {{ $ne ? 'काम पूरा नहुनुको मुख्य कारण के थियो?' : 'What is the primary reason your work was not completed?' }} <span class="text-rose-600">*</span></label>
                <div class="space-y-2">
                    @foreach($reasons as $key => $label)
                        <button type="button" data-reason="{{ $key }}" class="reason-btn tap w-full rounded-xl border px-4 py-3 text-left text-xs font-black transition flex items-center justify-between gap-3">
                            <span>{{ $label }}</span><span class="reason-dot w-3 h-3 rounded-full bg-transparent"></span>
                        </button>
                    @endforeach
                </div>
                <div id="bribe-warning" class="hidden mt-4 rounded-2xl border border-red-200 bg-red-50 p-4 text-red-800">
                    <p class="text-xs font-black uppercase tracking-widest">🚨 {{ $ne ? 'भ्रष्टाचार/घुस सम्बन्धी सचेतक' : 'Anti-Bribery Reporting Active' }}</p>
                    <p class="mt-2 text-xs leading-6 font-semibold">{{ $ne ? 'यो रिपोर्ट प्रशासनिक निगरानी र सदाचार अडिटका लागि गम्भीर उजुरीको रूपमा देखाइनेछ।' : 'This report will be highlighted as a high-integrity alert for monitoring and audit.' }}</p>
                </div>
            </div>

            <div>
                <label class="flex justify-between text-sm font-black text-slate-950 mb-2"><span>{{ $ne ? 'तपाईंको प्रतिक्रिया/गुनासो' : 'Your feedback/comments' }}</span><span class="text-xs font-semibold text-slate-400">{{ $ne ? 'ऐच्छिक' : 'Optional' }}</span></label>
                <textarea name="comments" rows="4" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm focus:border-slate-900 focus:ring-1 focus:ring-slate-900" placeholder="{{ $ne ? 'कार्यालयमा भोगेका अनुभव, ढिलासुस्ती वा सुझाव लेख्नुहोस्...' : 'Write feedback, suggestion, delays or anything you experienced...' }}"></textarea>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <label class="flex items-center gap-3 text-sm font-black text-slate-700"><input type="checkbox" name="is_anonymous" id="anonymous" value="1" class="w-5 h-5 rounded border-slate-300 text-rose-600"><span>🕵️ {{ $ne ? 'मेरो पहिचान गोप्य राख्नुहोस्' : 'Keep my feedback anonymous' }}</span></label>
                <div id="identity-fields" class="mt-4 grid sm:grid-cols-2 gap-3 border-t border-slate-200 pt-4">
                    <div><label class="block text-xs font-bold text-slate-500 mb-1">{{ $ne ? 'पूरा नाम (ऐच्छिक)' : 'Full Name (optional)' }}</label><input type="text" name="citizen_name" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm" placeholder="Ram Bahadur"></div>
                    <div><label class="block text-xs font-bold text-slate-500 mb-1">{{ $ne ? 'मोबाइल नम्बर (ऐच्छिक)' : 'Mobile Number (optional)' }}</label><input type="tel" name="citizen_phone" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm" placeholder="984XXXXXXX"></div>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <a href="{{ route('portal.active-guide') }}" class="tap rounded-xl bg-slate-100 hover:bg-slate-200 px-4 py-3 text-xs font-black text-slate-600 flex items-center">{{ $ne ? 'पछि' : 'Back' }}</a>
                <button type="submit" class="tap flex-1 rounded-2xl bg-rose-600 hover:bg-rose-500 px-5 py-3 text-sm font-black text-white shadow-lg">{{ $ne ? 'प्रतिक्रिया र विवरण बुझाउनुहोस्' : 'Submit Secure Feedback Report' }}</button>
            </div>
        </form>
    </section>
</div>
@endsection

@push('scripts')
<script>
const isSuccessful=document.getElementById('is_successful'),ratingValue=document.getElementById('rating_value'),reasonValue=document.getElementById('reason_value'),yesBtn=document.getElementById('yes-btn'),noBtn=document.getElementById('no-btn'),successSection=document.getElementById('success-section'),failureSection=document.getElementById('failure-section'),bribeWarning=document.getElementById('bribe-warning'),anonymous=document.getElementById('anonymous'),identityFields=document.getElementById('identity-fields');
let currentRating=5,currentReason='missing_doc';
function setStatus(success){isSuccessful.value=success?'1':'0';successSection.classList.toggle('hidden',!success);failureSection.classList.toggle('hidden',success);yesBtn.className='tap rounded-2xl border p-4 text-center font-black text-sm transition '+(success?'bg-rose-50 text-rose-700 border-rose-300 ring-1 ring-rose-200':'bg-white text-slate-500 border-slate-200');noBtn.className='tap rounded-2xl border p-4 text-center font-black text-sm transition '+(!success?'bg-rose-50 text-rose-700 border-rose-300 ring-1 ring-rose-200':'bg-white text-slate-500 border-slate-200');setRating(success?5:1)}
function setRating(value){currentRating=value;ratingValue.value=value;document.querySelectorAll('[data-rating]').forEach(btn=>{const active=Number(btn.dataset.rating)<=currentRating;btn.className='rating-btn tap rounded-xl border py-3 text-sm font-black transition '+(active?'bg-amber-100 text-amber-900 border-amber-300':'bg-white text-slate-400 border-slate-200')})}
function setReason(value){currentReason=value;reasonValue.value=value;bribeWarning.classList.toggle('hidden',value!=='bribe_request');document.querySelectorAll('[data-reason]').forEach(btn=>{const active=btn.dataset.reason===currentReason;btn.className='reason-btn tap w-full rounded-xl border px-4 py-3 text-left text-xs font-black transition flex items-center justify-between gap-3 '+(active?'bg-rose-100 text-rose-900 border-rose-300':'bg-white text-slate-700 border-slate-200 hover:bg-slate-100');btn.querySelector('.reason-dot').className='reason-dot w-3 h-3 rounded-full '+(active?'bg-rose-600 animate-pulse':'bg-transparent')})}
yesBtn.addEventListener('click',()=>setStatus(true));noBtn.addEventListener('click',()=>setStatus(false));document.querySelectorAll('[data-rating]').forEach(btn=>btn.addEventListener('click',()=>setRating(Number(btn.dataset.rating))));document.querySelectorAll('[data-reason]').forEach(btn=>btn.addEventListener('click',()=>setReason(btn.dataset.reason)));anonymous.addEventListener('change',()=>identityFields.classList.toggle('hidden',anonymous.checked));setStatus(true);setReason('missing_doc');
</script>
@endpush
