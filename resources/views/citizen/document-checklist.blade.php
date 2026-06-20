@extends('layouts.citizen')

@php
    use Illuminate\Support\Str;

    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';

    $service = $selectedService ?? $services->first();

    $departmentName = $ne
        ? ($department->name_ne ?? $department->name ?? 'सेवा')
        : ($department->name_en ?? $department->name ?? 'Service');

    $serviceName = $service
        ? ($ne ? ($service->name_ne ?? $service->name ?? '') : ($service->name_en ?? $service->name ?? ''))
        : $departmentName;

    $serviceDesc = $service
        ? ($ne
            ? ($service->desc_ne ?? $service->description_ne ?? $service->description ?? '')
            : ($service->desc_en ?? $service->description_en ?? $service->description ?? '')
        )
        : '';

    $normalizeList = function ($value) {
        if (is_array($value)) {
            return $value;
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }

            return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $value))));
        }

        return [];
    };

    $documents = collect();

    if ($service && $service->steps) {
        foreach ($service->steps as $step) {
            $items = $ne
                ? $normalizeList($step->requirements_ne ?? $step->requirements ?? null)
                : $normalizeList($step->requirements_en ?? $step->requirements ?? null);

            foreach ($items as $item) {
                $documents->push([
                    'title' => $item,
                    'step' => $ne
                        ? ($step->title_ne ?? $step->title ?? '')
                        : ($step->title_en ?? $step->title ?? ''),
                    'location' => $ne
                        ? ($step->location_ne ?? $step->location ?? '')
                        : ($step->location_en ?? $step->location ?? ''),
                ]);
            }
        }
    }

    $documents = $documents->unique('title')->values();
@endphp

@section('title', $serviceName)

@push('styles')
<style>
    @media print {
        header, nav, footer, .no-print {
            display: none !important;
        }

        body {
            background-color: #fff !important;
            color: #000 !important;
        }

        .print-card {
            border: 1px solid #cbd5e1 !important;
            box-shadow: none !important;
            break-inside: avoid;
        }
    }
</style>
@endpush

@section('content')
<div class="max-w-6xl mx-auto sm:py-8 selection:bg-blue-600 selection:text-white">

    <div class="relative rounded-3xl bg-[#003B93] p-6 sm:p-8 text-white shadow-xl overflow-hidden mb-8">
        <div class="absolute -right-8 -bottom-8 w-36 h-36 rounded-full bg-white/10 blur-xl"></div>
        <div class="absolute right-12 top-4 w-20 h-20 rounded-full bg-white/10 blur-lg"></div>

        <div class="relative">
            <span class="inline-flex items-center py-1 rounded-full text-[10px] sm:text-xs font-black uppercase tracking-wider">
                {{ $ne ? 'अधिकारीक कागजात सूची' : 'Official Requirements' }}
            </span>

            <h1 class="mt-2.5 text-xl sm:text-3xl font-extrabold tracking-tight">
                {{ $serviceName }}
            </h1>

            @if($serviceDesc)
                <p class="mt-2 text-xs sm:text-sm text-white/90 leading-relaxed font-medium">
                    {{ $serviceDesc }}
                </p>
            @else
                <p class="mt-2 text-xs sm:text-sm text-white/90 leading-relaxed font-medium">
                    {{ $ne ? 'यो सेवा सुरु गर्नु अघि आवश्यक कागजातहरू जाँच गर्नुहोस्।' : 'Check the required documents before starting this service.' }}
                </p>
            @endif
        </div>
    </div>

    @if($services->count() > 1)
        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm no-print">
            <form method="POST" action="{{ route('portal.pick-service') }}">
                @csrf

                <label class="mb-2 block text-sm font-bold text-slate-800">
                    {{ $ne ? 'सेवा छान्नुहोस्' : 'Choose Service' }}
                </label>

                <select
                    name="service_id"
                    onchange="this.form.submit()"
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-800 outline-none focus:border-blue-700"
                >
                    @foreach($services as $item)
                        <option value="{{ $item->id }}" @selected($service && $service->id === $item->id)>
                            {{ $ne ? ($item->name_ne ?? $item->name) : ($item->name_en ?? $item->name) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    @endif

    <div class="space-y-6">
        <h2 class="text-base sm:text-lg font-black text-slate-800 tracking-tight px-1">
            {{ $ne ? 'कागजातहरूको सूची' : 'Required Documents' }}
        </h2>

        @if($documents->count())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach($documents as $doc)
                    <div class="print-card bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm transition-all duration-300">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 tracking-tight break-words flex-1">
                                {{ $doc['title'] }}
                            </h3>

                            <span class="shrink-0 inline-flex items-center px-2.5 py-0.5 rounded-full bg-rose-50 border border-rose-100 text-[10px] font-black text-rose-700 uppercase">
                                {{ $ne ? 'अनिवार्य' : 'Required' }}
                            </span>
                        </div>

                        @if($doc['step'])
                            <p class="mt-2 text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">
                                {{ $ne ? 'चरण:' : 'Step:' }} {{ $doc['step'] }}
                            </p>
                        @endif

                        @if($doc['location'])
                            <p class="mt-1 text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">
                                {{ $ne ? 'स्थान:' : 'Location:' }} {{ $doc['location'] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-600">
                    {{ $ne ? 'यस सेवाका लागि कागजात सूची हाल उपलब्ध छैन।' : 'Document checklist is not available for this service yet.' }}
                </p>
            </div>
        @endif
    </div>

    <div class="mt-12 pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4 no-print">
        <a
            href="{{ route('portal.select-service', isset($departmentParam) ? ['department' => $departmentParam] : []) }}"
            class="rounded-xl border border-slate-200/80 bg-white hover:bg-slate-50 px-5 py-3 text-xs font-bold text-slate-600 transition-all duration-200 shadow-sm w-full sm:w-auto text-center"
        >
            {{ $ne ? 'सेवा चयनमा फर्कनुहोस्' : 'Back to Service Selection' }}
        </a>

        @if($service)
            <form method="POST" action="{{ route('start-tracking') }}" class="w-full sm:w-auto">
                @csrf

                <input type="hidden" name="service_id" value="{{ $service->id }}">

                <button
                    type="submit"
                    class="rounded-xl bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 text-xs font-black transition-all duration-200 shadow-md w-full sm:w-auto"
                >
                    {{ $ne ? 'आवेदन प्रक्रिया सुरु गर्नुहोस्' : 'Proceed to Application' }}
                </button>
            </form>
        @endif
    </div>

</div>
@endsection