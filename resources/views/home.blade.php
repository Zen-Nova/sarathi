@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'नागरिक सारथी' : 'Nagarik Sarthi')

@section('content')
<div class="max-w-xl mx-auto">
    <section class="bg-white rounded-3xl border border-slate-200 shadow-soft p-6 sm:p-10 text-center overflow-hidden relative">
        <div class="absolute -top-16 -right-16 w-40 h-40 rounded-full bg-blue-500/5 blur-2xl"></div>
        <div class="absolute -bottom-16 -left-16 w-40 h-40 rounded-full bg-rose-500/5 blur-2xl"></div>

        <div class="relative flex flex-col items-center">
            <div class="w-28 h-28 rounded-full bg-gradient-to-tr from-rose-50 to-blue-50 border border-slate-100 flex items-center justify-center relative mb-7">
                <div class="text-6xl leading-none text-slate-900">⌗</div>
                <div class="absolute inset-0 rounded-full border-4 border-dashed border-rose-500 animate-spin" style="animation-duration: 14s"></div>
            </div>

            <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-950">
                {{ $ne ? 'राहदानी विभागमा यहाँलाई स्वागत छ!' : 'Welcome to Passport Department!' }}
            </h2>
            <p class="mt-3 text-sm leading-7 text-slate-500">
                {{ $ne ? 'राहदानी सेवाका लागि सजिलो, पारदर्शी र चरणबद्ध मार्गदर्शन। आफ्नो सेवा सुरु गर्न प्रवेश विन्दुको QR स्क्यान गर्नुहोस्।' : 'Simple, transparent and step-by-step guidance for passport services. Scan the entry QR to start your citizen workflow.' }}
            </p>

            <div class="mt-8 w-full rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-4">
                <p class="text-xs font-black uppercase tracking-widest text-slate-500 mb-3">
                    {{ $ne ? 'सुरु गर्न प्रवेश क्यूआर स्क्यान गर्नुहोस्' : 'Scan Entry QR to Check In' }}
                </p>
                <a href="{{ route('workflow.scan') }}" class="tap w-full rounded-2xl bg-slate-950 hover:bg-slate-800 text-white font-black text-sm flex items-center justify-center gap-2 px-6 py-4 shadow-lg">
                    <span class="text-emerald-400">⌗</span>
                    <span>{{ $ne ? 'प्रवेश विन्दुको क्यूआर स्क्यान गर्नुहोस्' : 'Scan Entry QR at Passport Department' }}</span>
                </a>
                <p class="mt-3 text-[11px] text-slate-400">
                    {{ $ne ? 'वास्तविक कार्यालयमा मोबाइल क्यामेराले QR स्क्यान गर्दा यही पेज खुल्छ।' : 'In real offices, the mobile camera QR scan opens this portal automatically.' }}
                </p>
            </div>

            <div class="mt-6 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs font-bold text-emerald-700">
                ✅ {{ $ne ? 'लगइन आवश्यक छैन · मोबाइलमै सजिलो' : 'No login required · Mobile friendly' }}
            </div>
        </div>
    </section>

    <section class="mt-5 grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-4">
            <p class="text-2xl">📍</p>
            <h3 class="mt-2 text-sm font-black">{{ $ne ? 'काउन्टर मार्गदर्शन' : 'Counter Guide' }}</h3>
            <p class="mt-1 text-xs text-slate-500">{{ $ne ? 'कुन कोठा/काउन्टर जाने स्पष्ट देखिन्छ।' : 'Shows which room or counter to visit.' }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-4">
            <p class="text-2xl">📄</p>
            <h3 class="mt-2 text-sm font-black">{{ $ne ? 'कागजात सूची' : 'Document List' }}</h3>
            <p class="mt-1 text-xs text-slate-500">{{ $ne ? 'प्रत्येक चरणका आवश्यक कागजातहरू।' : 'Required documents for every step.' }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-4">
            <p class="text-2xl">🗣️</p>
            <h3 class="mt-2 text-sm font-black">{{ $ne ? 'प्रतिक्रिया' : 'Feedback' }}</h3>
            <p class="mt-1 text-xs text-slate-500">{{ $ne ? 'काम भयो/भएन र कारण दर्ता गर्नुहोस्।' : 'Submit whether work was completed or not.' }}</p>
        </div>
    </section>
</div>
@endsection
