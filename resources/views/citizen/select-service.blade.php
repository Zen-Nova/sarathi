@extends('layouts.citizen')

@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
@endphp

@section('title', $ne ? 'सेवा चयन गर्नुहोस्' : 'Select Service')

@section('content')
<div class="max-w-2xl mx-auto">
    <section class="rounded-3xl border border-slate-200 bg-white shadow-soft p-5 sm:p-8">
        <div class="border-b border-slate-100 pb-5 mb-5">
            <p class="text-xs font-black uppercase tracking-widest text-rose-600">{{ $ne ? 'राहदानी विभाग' : 'Department of Passports' }}</p>
            <h2 class="mt-1 text-2xl font-black tracking-tight text-slate-950">{{ $ne ? 'आफ्नो अपेक्षित सेवा चयन गर्नुहोस्' : 'Select Your Requested Service' }}</h2>
            <p class="mt-2 text-sm text-slate-500">{{ $ne ? 'तपाईं कुन कामका लागि आउनुभएको हो? हामी तपाईंलाई कोठा, काउन्टर र कागजात सहित मार्गदर्शन गर्छौं।' : 'Choose why you came here. We will guide you room-by-room with required documents.' }}</p>
        </div>

        <div class="space-y-3">
            @foreach($services as $service)
                <form method="POST" action="{{ route('start-tracking') }}">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <button type="submit" class="tap w-full text-left rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 hover:border-blue-200 p-4 sm:p-5 transition flex items-center justify-between gap-4 group">
                        <span class="min-w-0">
                            <span class="block text-base sm:text-lg font-black text-slate-950 group-hover:text-blue-700">
                                {{ $ne ? $service->name_ne : $service->name_en }}
                            </span>
                            <span class="block mt-1 text-xs leading-5 text-slate-500">
                                ⏱ {{ $ne ? $service->est_ne : $service->est_en }} · {{ count($service->steps) }} {{ $ne ? 'चरण' : 'steps' }}
                            </span>
                            <span class="block mt-1 text-xs leading-5 text-slate-500">
                                {{ $ne ? $service->desc_ne : $service->desc_en }}
                            </span>
                        </span>
                        <span class="shrink-0 w-10 h-10 rounded-xl bg-slate-100 group-hover:bg-blue-50 text-slate-400 group-hover:text-blue-600 flex items-center justify-center font-black">›</span>
                    </button>
                </form>
            @endforeach
        </div>

        <div class="mt-6 pt-5 border-t border-slate-100">
            <a href="{{ route('portal.home') }}" class="tap inline-flex items-center justify-center rounded-xl bg-slate-100 hover:bg-slate-200 px-4 py-2 text-xs font-black text-slate-600">
                ← {{ $ne ? 'पछि फर्कनुहोस्' : 'Go Back' }}
            </a>
        </div>
    </section>
</div>
@endsection
