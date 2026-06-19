<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.appName')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans">

    <div class="h-1.5 w-full bg-gradient-to-r from-red-600 via-white to-blue-700"></div>

    <header class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between flex-wrap gap-2">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="bg-rose-50 text-red-600 font-extrabold text-[10px] w-12 h-12 rounded-full border border-red-100 flex items-center justify-center tracking-tighter leading-none">
                    GoN<br>नेपाल
                </div>
                <div>
                    <h1 class="text-lg font-black text-slate-900 tracking-tight">@lang('messages.appName')</h1>
                    <p class="text-xs text-slate-500 font-medium">@lang('messages.passportDept')</p>
                </div>
            </a>

            <div class="flex items-center gap-2">
                <a href="{{ url('/') }}" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-lg border border-slate-200 transition-all">
                    🏠 Home
                </a>
                
                @if(app()->getLocale() === 'en')
                    <a href="{{ route('lang.switch', 'np') }}" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-lg transition-all shadow-xs">नेपाली</a>
                @else
                    <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-lg transition-all shadow-xs">English</a>
                @endif
            </div>
        </div>
    </header>

    <div class="bg-slate-900 text-slate-100 px-4 py-2.5 text-xs border-b border-slate-950 shadow-inner">
        <div class="max-w-4xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
            <span class="text-slate-400 font-medium">📲 <b>QR Code Simulator Corner:</b> Simulate citizen physical phone actions:</span>
            <div class="flex gap-2">
                <a href="{{ route('workflow.scan') }}" class="px-2.5 py-1 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded text-[11px] shadow-xs">
                    [1] Scan Office Entry QR
                </a>
                @if(isset($token))
                    <a href="{{ route('workflow.checkout', $token) }}" class="px-2.5 py-1 bg-rose-600 hover:bg-rose-500 text-white font-bold rounded text-[11px] shadow-xs">
                        [2] Scan Office Exit QR
                    </a>
                @endif
            </div>
        </div>
    </div>

    <main class="max-w-2xl mx-auto p-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 py-6 mt-12 text-center text-slate-400 text-[10px] font-extrabold tracking-widest">
        <p>🇳🇵 @lang('messages.appName') &bull; DIGITAL NEPAL ACCOUNTABILITY PROJECT 🇳🇵</p>
    </footer>
</body>
</html>