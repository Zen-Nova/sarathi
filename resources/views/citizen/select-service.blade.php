@extends('layouts.citizen')

@section('content')
<div class="max-w-md mx-auto px-4 py-6">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 text-center relative overflow-hidden">
        <div class="bg-gradient-to-tr from-blue-50 to-indigo-50 w-16 h-16 rounded-full mb-4 border border-slate-100 flex items-center justify-center mx-auto">
            <span class="text-3xl">📋</span>
        </div>

        <h2 class="text-xl font-black text-slate-900 tracking-tight">
            {{ __('messages.select_service_title') ?? 'सेवा छनोट गर्नुहोस् / Select Service' }}
        </h2>
        <p class="text-xs text-slate-400 mt-1">
            {{ __('messages.select_service_subtitle') ?? 'Please select the service you came for today.' }}
        </p>

        <form action="{{ route('start-tracking') }}" method="POST" class="mt-6 text-left space-y-3">
            @csrf
            
            @forelse($services ?? [] as $service)
                <label class="block p-4 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:border-blue-500 transition-all relative flex items-center gap-3">
                    <input type="radio" name="service_id" value="{{ $service->id }}" class="w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500" {{ $loop->first ? 'checked' : '' }}>
                    <div>
                        <span class="block font-bold text-sm text-slate-800">
                            {{ App::getLocale() == 'ne' ? $service->name_ne : $service->name_en }}
                        </span>
                        <span class="block text-[11px] text-slate-400">
                            {{ App::getLocale() == 'ne' ? $service->desc_ne : $service->desc_en }}
                        </span>
                    </div>
                </label>
            @empty
                <label class="block p-4 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:border-blue-500 transition-all flex items-center gap-3">
                    <input type="radio" name="service_id" value="1" checked class="w-4 h-4 text-blue-600">
                    <div>
                        <span class="block font-bold text-sm text-slate-800">नयाँ राहदानी (New Passport)</span>
                    </div>
                </label>
                <label class="block p-4 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:border-blue-500 transition-all flex items-center gap-3">
                    <input type="radio" name="service_id" value="2" class="w-4 h-4 text-blue-600">
                    <div>
                        <span class="block font-bold text-sm text-slate-800">राहदानी नवीकरण (Passport Renewal)</span>
                    </div>
                </label>
            @endforelse

            <div class="mt-8 pt-4 flex gap-3">
                <a href="{{ route('portal.home') }}" class="w-1/2 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-all text-center">
                    {{ __('messages.back') ?? 'पछाडि फर्कनुहोस्' }}
                </a>
                <button type="submit" class="w-1/2 py-3 bg-slate-950 hover:bg-slate-900 text-white font-extrabold text-xs rounded-xl transition-all text-center shadow-md">
                    {{ __('messages.next') ?? 'अगाडि बढ्नुहोस्' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection