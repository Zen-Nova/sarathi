@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'प्रणाली रोडम्याप' : 'System Roadmap')

@section('content')
<div class="max-w-3xl mx-auto">
    <section class="rounded-3xl border border-slate-200 bg-white shadow-soft p-5 sm:p-8">
        <p class="text-xs font-black uppercase tracking-widest text-blue-600">{{ $ne ? 'कसरी काम गर्छ?' : 'How it works' }}</p>
        <h2 class="mt-1 text-2xl font-black tracking-tight text-slate-950">{{ $ne ? 'नागरिक सारथी सेवा प्रवाह' : 'Nagarik Sarthi Workflow' }}</h2>
        <div class="mt-6 grid gap-4">
            @foreach([
                ['1', $ne ? 'प्रवेश QR स्क्यान' : 'Scan Entry QR', $ne ? 'नागरिक कार्यालय प्रवेश गर्दा QR स्क्यान गर्छ।' : 'Citizen scans QR at office entry.'],
                ['2', $ne ? 'सेवा चयन' : 'Select Service', $ne ? 'आफ्नो काम जस्तै नयाँ राहदानी/नवीकरण छान्छ।' : 'Selects work type like new passport or renewal.'],
                ['3', $ne ? 'चरणबद्ध मार्गदर्शन' : 'Step Guide', $ne ? 'काउन्टर, कोठा र कागजातको जानकारी पाउँछ।' : 'Gets counter, room and document guidance.'],
                ['4', $ne ? 'निकास प्रतिक्रिया' : 'Exit Feedback', $ne ? 'काम भयो/भएन र कारण दर्ता गर्छ।' : 'Submits completion status and reason.'],
            ] as [$num, $title, $desc])
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 flex gap-4 items-start">
                    <div class="w-10 h-10 rounded-xl bg-slate-950 text-white flex items-center justify-center font-black shrink-0">{{ $num }}</div>
                    <div><h3 class="font-black text-slate-950">{{ $title }}</h3><p class="mt-1 text-sm text-slate-500">{{ $desc }}</p></div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('portal.home') }}" class="tap mt-6 inline-flex rounded-xl bg-slate-100 hover:bg-slate-200 px-4 py-2 text-xs font-black text-slate-600">← {{ $ne ? 'मुख्य पेज' : 'Home' }}</a>
    </section>
</div>
@endsection
