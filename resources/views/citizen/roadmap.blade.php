@extends('layouts.citizen')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-10 relative overflow-hidden">
    <div class="max-w-md mx-auto">
        <h2 class="text-2xl font-black text-slate-900 tracking-tight text-center mb-6">🗺️ Portal Architecture Map</h2>
        
        <ul class="space-y-4 text-sm text-slate-600">
            <li class="flex items-center gap-3"><span class="text-emerald-500">✔</span> Home Page Dashboard</li>
            <li class="flex items-center gap-3"><span class="text-emerald-500">✔</span> Service Type Selector</li>
            <li class="flex items-center gap-3"><span class="text-emerald-500">✔</span> Live Station Workflow Instruction Guide</li>
            <li class="flex items-center gap-3"><span class="text-emerald-500">✔</span> Checkout Simulation Fee Calculation</li>
            <li class="flex items-center gap-3"><span class="text-emerald-500">✔</span> User Feedback Metrics Collector</li>
            <li class="flex items-center gap-3"><span class="text-emerald-500">✔</span> Success Completion Landing Page</li>
        </ul>

        <div class="mt-8 text-center">
            <a href="{{ route('portal.home') }}" class="text-xs text-blue-500 font-bold hover:underline">← Go Back Home</a>
        </div>
    </div>
</div>
@endsection