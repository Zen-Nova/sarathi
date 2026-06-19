@php
    $locale = session('locale', 'ne');
    $ne = $locale === 'ne';
    $nav = [
        'app' => $ne ? 'नागरिक सारथी' : 'Nagarik Sarthi',
        'gov' => $ne ? 'नेपाल सरकार' : 'Government of Nepal',
        'dept' => $ne ? 'राहदानी विभाग' : 'Department of Passports',
        'slogan' => $ne ? 'जनताको सेवा नै धर्म हो' : 'Service to Citizens is our Utmost Duty',
        'citizen' => $ne ? 'नागरिक सेवा पोर्टल' : 'Citizen Portal',
        'admin' => $ne ? 'प्रशासनिक ड्यासबोर्ड' : 'Admin Dashboard',
        'entry' => $ne ? '[1] प्रवेश विन्दुको क्यूआर स्क्यान गर्नुहोस्' : '[1] Scan Entry QR',
        'exit' => $ne ? '[2] निकास विन्दुको क्यूआर स्क्यान गर्नुहोस्' : '[2] Scan Exit QR',
        'simTitle' => $ne ? 'क्यूआर स्क्यानर सिमुलेटर' : 'Workflow Scanner Simulator',
        'simDesc' => $ne ? 'कार्यालयमा राखिएको प्रवेश/निकास QR स्क्यान गरेपछि यही पोर्टल खुल्छ।' : 'Scan entry and exit QR codes posted in the office to open this portal.',
        'language' => $ne ? 'English' : 'नेपाली',
    ];
@endphp
<!doctype html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $nav['app'])</title>

    {{-- Quick frontend setup. For production, move this to resources/css/app.css and use @vite. --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        govnavy: '#0f172a',
                        govrose: '#e11d48',
                        govblue: '#2563eb'
                    },
                    boxShadow: {
                        soft: '0 10px 35px rgba(15, 23, 42, 0.08)'
                    }
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; }
        .tap { min-height: 44px; }
        .safe-bottom { padding-bottom: env(safe-area-inset-bottom); }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white border-b border-slate-200 sticky top-0 z-40">
            <div class="h-1.5 bg-gradient-to-r from-red-600 via-white to-blue-700"></div>
            <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between gap-3">
                <a href="{{ route('portal.home') }}" class="flex items-center gap-3 min-w-0">
                    <div class="relative shrink-0 w-11 h-11 rounded-full bg-rose-50 border border-rose-100 flex items-center justify-center text-red-600 font-black text-[10px] leading-none">
                        GoN<br>नेपाल
                        <span class="absolute -top-1 -right-1 bg-blue-600 text-white text-[8px] px-1 rounded">NID</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] uppercase tracking-widest text-red-600 font-black truncate">🇳🇵 {{ $nav['gov'] }}</p>
                        <div class="flex items-center gap-2 min-w-0">
                            <h1 class="text-lg sm:text-2xl font-black tracking-tight truncate">{{ $nav['app'] }}</h1>
                            <span class="hidden sm:inline-flex text-[10px] px-2 py-0.5 rounded-full border border-blue-100 bg-blue-50 text-blue-700 font-bold">v1.2 BETA</span>
                        </div>
                        <p class="hidden sm:block text-xs text-slate-500">{{ $nav['dept'] }} · <span class="italic text-rose-600 font-semibold">“{{ $nav['slogan'] }}”</span></p>
                    </div>
                </a>

                <nav class="flex items-center gap-2 shrink-0">
                    <a href="{{ route('lang.switch', $ne ? 'en' : 'ne') }}" class="tap px-3 rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-200 text-xs font-bold flex items-center gap-1">
                        🌐 <span class="hidden xs:inline">{{ $nav['language'] }}</span>
                    </a>
                    <a href="{{ route('portal.home') }}" class="hidden sm:flex tap px-3 rounded-xl bg-white hover:bg-slate-100 border border-slate-200 text-xs font-bold items-center gap-1">
                        👥 {{ $nav['citizen'] }}
                    </a>
                    <a href="{{ url('/admin') }}" class="hidden sm:flex tap px-3 rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-200 text-xs font-bold items-center gap-1 text-slate-600">
                        📈 {{ $nav['admin'] }}
                    </a>
                </nav>
            </div>
        </header>

        <section class="bg-govnavy text-white border-b border-slate-950">
            <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start gap-3">
                    <div class="text-3xl leading-none text-rose-400">⌗</div>
                    <div>
                        <p class="text-xs font-black uppercase tracking-widest text-rose-300">{{ $nav['simTitle'] }}</p>
                        <p class="text-xs text-slate-300 max-w-xl">{{ $nav['simDesc'] }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 md:flex md:justify-end">
                    <a href="{{ route('workflow.scan') }}" class="tap px-3 sm:px-4 rounded-xl bg-blue-600 hover:bg-blue-500 border border-blue-500 text-white text-[11px] sm:text-xs font-black flex items-center justify-center text-center">
                        {{ $nav['entry'] }}
                    </a>
                    <a href="{{ route('portal.checkout') }}" class="tap px-3 sm:px-4 rounded-xl bg-rose-600 hover:bg-rose-500 border border-rose-500 text-white text-[11px] sm:text-xs font-black flex items-center justify-center text-center">
                        {{ $nav['exit'] }}
                    </a>
                </div>
            </div>
        </section>

        @if(session('error'))
            <div class="max-w-xl mx-auto w-full px-4 pt-4">
                <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700">{{ session('error') }}</div>
            </div>
        @endif

        <main class="flex-1 w-full max-w-6xl mx-auto px-4 py-6 sm:py-8">
            @yield('content')
        </main>

        <footer class="mt-8 bg-white border-t border-slate-200 py-6 text-center text-xs text-slate-500">
            <p class="font-black uppercase tracking-widest text-slate-400">{{ $nav['app'] }} · Digital Nepal Framework Project</p>
            <p class="mt-2"><span class="text-red-600 font-bold">नेपाल सरकार</span> · Practical Citizen Accountability & Real-Time Redirection</p>
            <p class="mt-2 text-[10px] text-slate-400 px-4">This platform simulates QR-based government workflow tracking, service guidance, feedback logs, and citizen accountability dashboards.</p>
        </footer>

        <div class="md:hidden fixed bottom-0 inset-x-0 z-50 bg-white/95 backdrop-blur border-t border-slate-200 p-2 safe-bottom">
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('workflow.scan') }}" class="tap rounded-xl bg-blue-600 text-white text-xs font-black flex items-center justify-center text-center px-2">{{ $ne ? 'प्रवेश QR' : 'Entry QR' }}</a>
                <a href="{{ route('portal.checkout') }}" class="tap rounded-xl bg-rose-600 text-white text-xs font-black flex items-center justify-center text-center px-2">{{ $ne ? 'निकास QR' : 'Exit QR' }}</a>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
