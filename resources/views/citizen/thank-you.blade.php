@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'धन्यवाद' : 'Thank You')

@section('content')
<div class="max-w-xl mx-auto">
    <section class="rounded-3xl border border-slate-200 bg-white shadow-soft p-8 sm:p-12 text-center">
        <div class="mx-auto w-24 h-24 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center text-5xl mb-6">✓</div>
        <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-950">{{ $ne ? 'धन्यवाद!' : 'Dhanyabaad! Thank you' }}</h2>
        <p class="mt-3 text-sm leading-7 text-slate-500">{{ $ne ? 'तपाईंको कार्यसम्पादन विवरण सुरक्षित रूपमा प्रणालीमा दर्ता भएको छ। नागरिकको प्रत्यक्ष प्रतिक्रियाले कार्यालयको सुधार र जवाफदेहिता बढाउन मद्दत गर्छ।' : 'Your workflow tracking and feedback has been securely submitted. Citizen feedback helps improve service quality and accountability.' }}</p>
        <div class="mt-8 rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <p class="text-[11px] font-black uppercase tracking-widest text-slate-400">{{ $ne ? 'अडिट स्थिति' : 'Audit Status' }}</p>
            <p class="mt-2 inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-black text-emerald-700">{{ $ne ? 'सफलतापूर्वक दर्ता भयो' : 'Logged Successfully' }}</p>
            @if(session('last_submitted_at'))<p class="mt-2 text-[11px] text-slate-400">{{ session('last_submitted_at') }}</p>@endif
        </div>
        <a href="{{ route('portal.home') }}" class="tap mt-8 inline-flex rounded-2xl bg-slate-950 hover:bg-slate-800 px-7 py-3 text-xs font-black text-white">{{ $ne ? 'नयाँ सेवा ट्र्याक गर्नुहोस्' : 'Check in Another Task' }}</a>
    </section>
</div>
@endsection
