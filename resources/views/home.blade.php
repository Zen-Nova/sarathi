@extends('layouts.citizen')

@section('content')
<div class="space-y-8 max-w-5xl mx-auto px-4 py-6">
    
    <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-xl p-4 flex items-start gap-3 shadow-sm">
        <span class="text-xl mt-0.5">📢</span>
        <div>
            <h4 class="font-bold text-amber-950 text-sm">सूचना / Notice Board:</h4>
            <p class="text-xs text-amber-800 mt-0.5 leading-relaxed">
                राहदानी वितरण शाखा बिहान ८:०० बजे देखि बेलुका ६:०० बजे सम्म खुल्ला रहनेछ। (The Passport Distribution Branch is now open from 8:00 AM to 6:00 PM).
            </p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-10 text-center relative overflow-hidden">
        <div class="absolute top-0 right-0 w-40 h-40 bg-blue-500/5 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-40 h-40 bg-rose-500/5 rounded-full blur-2xl"></div>

        <div class="max-w-xl mx-auto flex flex-col items-center">
            <div class="bg-gradient-to-tr from-rose-50 to-blue-50 p-5 rounded-full mb-5 border border-slate-100 flex items-center justify-center shadow-inner">
                <span class="text-4xl">🏛️</span>
            </div>

            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                राहदानी विभाग नागरिक मार्गदर्शक पोर्टल
            </h2>
            <p class="text-xs sm:text-sm font-medium text-slate-400 mt-1 tracking-wide uppercase">
                Department of Passports • Citizen Navigation Dashboard
            </p>
            <p class="text-sm text-slate-500 mt-3 leading-relaxed max-w-md">
                @lang('messages.chooseServiceDesc')
            </p>

            <div class="mt-8 p-1 bg-slate-100/80 rounded-2xl border border-slate-200/60 w-full max-w-sm shadow-inner">
                <a href="{{ route('portal.select-service') }}" 
                   class="py-3.5 px-6 bg-slate-950 hover:bg-slate-900 text-white font-extrabold text-sm rounded-xl transition-all shadow-md flex items-center justify-center gap-3 transform hover:scale-[1.01] hover:shadow-lg">
                    <span>➡️ नयाँ सेवा सुरु गर्नुहोस् / Start Service Flow</span>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <h3 class="text-sm font-bold text-slate-900 tracking-tight mb-6 flex items-center gap-2">
            <span>📊</span> तपाईंको यात्राको चरण / Live Guide Progress Breakdown
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
            
            <div class="relative flex flex-col items-center text-center p-3 rounded-xl bg-slate-50/50 border border-slate-100">
                <div class="w-8 h-8 rounded-full bg-slate-200 font-bold text-xs flex items-center justify-center text-slate-700 mb-2">1</div>
                <span class="font-bold text-xs text-slate-800">सेवा छनौट</span>
                <span class="text-[11px] text-slate-400 mt-0.5">Select Service</span>
            </div>

            <div class="relative flex flex-col items-center text-center p-3 rounded-xl bg-slate-50/50 border border-slate-100">
                <div class="w-8 h-8 rounded-full bg-slate-200 font-bold text-xs flex items-center justify-center text-slate-700 mb-2">2</div>
                <span class="font-bold text-xs text-slate-800">लाइभ मार्गदर्शक</span>
                <span class="text-[11px] text-slate-400 mt-0.5">Active Station Guide</span>
            </div>

            <div class="relative flex flex-col items-center text-center p-3 rounded-xl bg-slate-50/50 border border-slate-100">
                <div class="w-8 h-8 rounded-full bg-slate-200 font-bold text-xs flex items-center justify-center text-slate-700 mb-2">3</div>
                <span class="font-bold text-xs text-slate-800">काउन्टर भुक्तानी</span>
                <span class="text-[11px] text-slate-400 mt-0.5">Checkout Fee</span>
            </div>

            <div class="relative flex flex-col items-center text-center p-3 rounded-xl bg-slate-50/50 border border-slate-100">
                <div class="w-8 h-8 rounded-full bg-slate-200 font-bold text-xs flex items-center justify-center text-slate-700 mb-2">4</div>
                <span class="font-bold text-xs text-slate-800">प्रतिक्रिया फारम</span>
                <span class="text-[11px] text-slate-400 mt-0.5">Feedback & Exit</span>
            </div>
            
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        
        <a href="{{ route('portal.roadmap') }}" class="group bg-white p-5 rounded-2xl border border-slate-200 hover:border-blue-500 transition-all hover:shadow-sm text-left">
            <div class="w-10 h-10 rounded-xl bg-blue-50 group-hover:bg-blue-100 text-blue-600 flex items-center justify-center text-lg transition-colors">
                📄
            </div>
            <h4 class="font-bold text-slate-900 text-sm mt-4">आवश्यक कागजातहरू</h4>
            <p class="text-xs text-slate-400 mt-1 leading-relaxed">Required identity documentation verification guidelines check-list.</p>
        </a>

        <a href="#" class="group bg-white p-5 rounded-2xl border border-slate-200 hover:border-indigo-500 transition-all hover:shadow-sm text-left">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 group-hover:bg-indigo-100 text-indigo-600 flex items-center justify-center text-lg transition-colors">
                🗺️
            </div>
            <h4 class="font-bold text-slate-900 text-sm mt-4">विभागको नक्सा</h4>
            <p class="text-xs text-slate-400 mt-1 leading-relaxed">Explore full building maps highlighting counter groupings layout.</p>
        </a>

        <a href="#" class="group bg-white p-5 rounded-2xl border border-slate-200 hover:border-rose-500 transition-all hover:shadow-sm text-left">
            <div class="w-10 h-10 rounded-xl bg-rose-50 group-hover:bg-rose-100 text-rose-600 flex items-center justify-center text-lg transition-colors">
                🙋‍♂️
            </div>
            <h4 class="font-bold text-slate-900 text-sm mt-4">मद्दत डेस्क सहायता</h4>
            <p class="text-xs text-slate-400 mt-1 leading-relaxed">Get swift contextual answers regarding pending passport hold codes.</p>
        </a>

    </div>

</div>
@endsection