@extends('layouts.citizen')

@section('content')
<div class="max-w-md mx-auto px-4 py-6">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 text-center">
        
        <div class="w-16 h-16 bg-gradient-to-tr from-blue-50 to-indigo-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
            <span class="text-3xl">🏁</span>
        </div>

        <h2 class="text-xl font-black text-slate-900 tracking-tight">कार्य समापन स्थिति / Operational Milestone Status</h2>
        <p class="text-xs text-slate-400 mt-1">Help us track institutional accountability. Did your tasks get completed today?</p>

        <!-- Core Split Status Evaluation Selection Buttons -->
        <div class="mt-8 grid grid-cols-2 gap-4" id="status-selection-box">
            <button onclick="handleStatus(true)" class="p-5 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 hover:border-emerald-400 rounded-2xl transition-all flex flex-col items-center group">
                <span class="text-3xl group-hover:scale-110 transition-transform">👍</span>
                <span class="font-black text-xs text-emerald-900 mt-2">भयो / YES</span>
                <span class="text-[10px] text-emerald-600 mt-0.5">Success Completion</span>
            </button>

            <button onclick="handleStatus(false)" class="p-5 bg-rose-50 hover:bg-rose-100 border border-rose-200 hover:border-rose-400 rounded-2xl transition-all flex flex-col items-center group">
                <span class="text-3xl group-hover:scale-110 transition-transform">👎</span>
                <span class="font-black text-xs text-rose-900 mt-2">भएन / NO</span>
                <span class="text-[10px] text-rose-600 mt-0.5">Encountered Issues</span>
            </button>
        </div>

        <!-- Dynamic Content Processing Sub-Area -->
        <div id="dynamic-form-area" class="mt-8 text-left hidden border-t border-slate-100 pt-6">
            
            <!-- Contextual Option Block A: Success Feedback -->
            <div id="success-feedback-subform" class="hidden space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">सन्तुष्टि स्तर / Rate Experience (1-5):</label>
                    <select class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs font-medium focus:outline-blue-500">
                        <option>⭐⭐⭐⭐⭐ Excellent (उत्कृष्ट)</option>
                        <option>⭐⭐⭐⭐ Good (राम्रो)</option>
                        <option>⭐⭐⭐ Average (सामान्य)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">प्रतिक्रिया / Suggestions:</label>
                    <textarea rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs focus:outline-blue-500" placeholder="Type observations here..."></textarea>
                </div>
            </div>

            <!-- Contextual Option Block B: Failure Accountability Logging -->
            <div id="failure-complaint-subform" class="hidden space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">काम पूरा नहुनुको मुख्य कारण / Failure Reason:</label>
                    <select class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs font-medium text-slate-800 focus:outline-blue-500">
                        <option>अर्को दिन आउन भनियो / Officer requested to visit another date</option>
                        <option>प्रणाली वा सर्भर चलेन / Structural Server/Network Down</option>
                        <option>सम्बन्धित कर्मचारी सिटमा भेटिएन / Desk Officer Absent</option>
                        <option>कागजात पुगेन / Rejected due to incomplete documentation</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">गुनासो विवरण / Log Official Complain Details:</label>
                    <textarea rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs focus:outline-blue-500" placeholder="Describe context details safely..."></textarea>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('portal.thank-you') }}" class="block w-full py-3.5 bg-slate-950 hover:bg-slate-900 text-white font-extrabold text-xs rounded-xl shadow-md transition-all text-center">
                    विवरण बुझाउनुहोस् / Submit Summary Record
                </a>
            </div>
        </div>

    </div>
</div>

<script>
function handleStatus(isSuccess) {
    document.getElementById('status-selection-box').classList.add('opacity-40', 'pointer-events-none');
    document.getElementById('dynamic-form-area').classList.remove('hidden');

    if(isSuccess) {
        document.getElementById('success-feedback-subform').classList.remove('hidden');
        document.getElementById('failure-complaint-subform').classList.add('hidden');
    } else {
        document.getElementById('failure-complaint-subform').classList.remove('hidden');
        document.getElementById('success-feedback-subform').classList.add('hidden');
    }
}
</script>
@endsection