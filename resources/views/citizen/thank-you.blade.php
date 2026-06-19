@extends('layouts.citizen')

@section('content')
<div class="max-w-md mx-auto px-4 py-12 text-center">
    <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner animate-bounce">
        <span class="text-4xl">🎉</span>
    </div>

    <h2 class="text-2xl font-black text-slate-900 tracking-tight">धन्यवाद / Submission Received!</h2>
    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
        Your dynamic telemetry log loop data transaction execution sequence has been safely saved. Your responses help build public sector accountability monitors in Nepal.
    </p>

    <div class="mt-10">
        <a href="{{ route('portal.home') }}" class="inline-flex items-center gap-2 py-3.5 px-8 bg-slate-950 hover:bg-slate-900 text-white font-extrabold text-xs rounded-xl transition-all shadow-md transform hover:scale-[1.01]">
            🏠 मुख्य गृहपृष्ठ / Back to Dashboard Home
        </a>
    </div>
</div>
@endsection