@extends('layouts.citizen')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-10 text-center relative overflow-hidden">
    <div class="max-w-md mx-auto flex flex-col items-center">
        <div class="bg-gradient-to-tr from-purple-50 to-pink-50 p-5 rounded-full mb-6 border border-slate-100 flex items-center justify-center">
            <span class="text-4xl">💬</span>
        </div>

        <h2 class="text-2xl font-black text-slate-900 tracking-tight">प्रतिक्रिया फारम / Feedback Form</h2>
        <p class="text-sm text-slate-500 mt-2 leading-relaxed">Help us improve. How was your experience using our tracking portal?</p>

        <textarea rows="3" class="mt-6 w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-blue-500" placeholder="Write your thoughts here..."></textarea>

        <div class="mt-8 flex w-full gap-4">
            <a href="{{ route('portal.thank-you') }}" class="w-1/2 py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-sm rounded-xl transition-all text-center">Skip Feedback</a>
            <a href="{{ route('portal.thank-you') }}" class="w-1/2 py-3 px-4 bg-purple-600 hover:bg-purple-700 text-white font-bold text-sm rounded-xl transition-all text-center shadow-md">Submit Feedback</a>
        </div>
    </div>
</div>
@endsection