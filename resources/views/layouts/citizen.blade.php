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
        <div class="h-1.5 bg-gradient-to-r from-red-600 via-white to-blue-700"></div>
        <header class="sticky top-0 z-40 bg-transparent py-4 transition-all duration-300">
            <div class="max-w-6xl mx-auto px-4">
                <nav class="bg-white/75 backdrop-blur-md border border-white/50 rounded-full px-5 py-2 flex items-center justify-between shadow-md hover:shadow-lg transition-all duration-300">
                    <!-- Left: Emblem of Nepal & Title -->
                    <a href="{{ route('portal.home') }}" class="flex items-center gap-3 min-w-0">
                        <img src="{{ asset('images/emblem.svg') }}" alt="Emblem of Nepal" class="h-14 w-auto hover:scale-105 transition-transform duration-300">
                        <div class="hidden sm:block leading-none text-left">
                            <span class="text-lg font-bold text-slate-900 tracking-tight block">{{ $ne ? 'नागरिक सारथी' : 'Nagarik Sarthi' }}</span>
                        </div>
                    </a>



                    <!-- Right: Language switch, Register button, Mobile toggle -->
                    <div class="flex items-center gap-3">
                        <!-- Language Changer (Desktop) -->
                        <div class="hidden md:inline-flex rounded-full bg-slate-100 p-0.5 border border-slate-200/80">
                            <a href="{{ route('lang.switch', 'ne') }}" class="px-3 py-1 rounded-full text-xs font-black transition-all flex items-center gap-1 {{ $ne ? 'bg-white text-blue-700 shadow-sm' : 'text-slate-500 hover:text-slate-800' }}">
                                नेपाली
                            </a>
                            <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-1 rounded-full text-xs font-black transition-all flex items-center gap-1 {{ !$ne ? 'bg-white text-blue-700 shadow-sm' : 'text-slate-500 hover:text-slate-800' }}">
                                EN
                            </a>
                        </div>

                        <!-- Language Changer (Mobile) -->
                        <a href="{{ route('lang.switch', $ne ? 'en' : 'ne') }}" class="md:hidden px-3 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 border border-slate-200/80 text-xs font-black flex items-center gap-1 transition-all">
                            🌐 {{ $ne ? 'EN' : 'नेपाली' }}
                        </a>

                        <!-- Register Button -->
                       <a href="{{ route('filament.admin.auth.login') }}" class="hidden sm:inline-block px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs transition-all shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20">
    {{ $ne ? 'प्रवेश' : 'Login' }}
</a>

                        <!-- Mobile Hamburger Button -->
                        <button id="menu-toggle-btn" class="md:hidden p-1 text-slate-600 hover:text-blue-650 focus:outline-none" aria-label="Toggle menu">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                </nav>

                <!-- Mobile Menu Dropdown -->
                <div id="mobile-dropdown-menu" class="hidden md:hidden mt-2 animate-fadeIn">
                    <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-lg flex flex-col gap-2.5">

                        
                        <div class="border-t border-slate-100 pt-2.5 sm:hidden">
                            <a href="{{ route('portal.select-service') }}" class="text-center px-4 py-2.5 rounded-full bg-blue-700 hover:bg-blue-800 text-white font-black text-xs transition-all shadow-sm block w-full">
                                {{ $ne ? 'दर्ता गर्नुहोस्' : 'Register' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>



        @if(session('error'))
            <div class="max-w-xl mx-auto w-full px-4 pt-4">
                <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700">{{ session('error') }}</div>
            </div>
        @endif

        <main class="flex-1 w-full max-w-6xl mx-auto px-4 py-6 sm:py-8">
            @yield('content')
        </main>

        <footer id="contact" class="mt-auto bg-white border-t border-slate-100">
            <div class="max-w-6xl mx-auto px-4 pt-8 pb-6">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-0 sm:gap-8">
                    <div class="flex flex-col items-center sm:items-start text-center sm:text-left py-5 sm:py-0 border-b sm:border-b-0 border-slate-100">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center mb-3 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm mb-1.5">{{ $ne ? 'सम्पर्क ठेगाना' : 'Office Address' }}</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $ne ? 'राहदानी विभाग, त्रिपुरेश्वर, काठमाडौं, नेपाल' : 'Dept. of Passports, Tripureshwor, Kathmandu' }}</p>
                    </div>
                    <div class="flex flex-col items-center sm:items-start text-center sm:text-left py-5 sm:py-0 border-b sm:border-b-0 border-slate-100">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center mb-3 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm mb-1.5">{{ $ne ? 'सम्पर्क विवरण' : 'Contact Details' }}</h4>
                        <p class="text-xs text-slate-500">{{ $ne ? '+९७७-१-४२६३६१९' : '+977-1-4263619' }}</p>
                        <p class="text-xs text-slate-500 mt-1">info@nepalpassport.gov.np</p>
                    </div>
                    <div class="flex flex-col items-center sm:items-start text-center sm:text-left py-5 sm:py-0">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center mb-3 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/></svg>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm mb-1.5">{{ $ne ? 'सहायता केन्द्र' : 'Support Desk' }}</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $ne ? 'राहदानी सहजीकरण कक्ष, काउन्टर नं. १' : 'Passport guidance booth, Counter No. 1.' }}</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-100 py-5 px-4 text-center">
                <p class="text-[11px] font-black uppercase tracking-widest text-slate-400">{{ $nav['app'] }} · Digital Nepal Framework</p>
                <p class="mt-1.5 text-[11px] text-slate-400">
                    <span class="text-red-600 font-bold">{{ $ne ? 'नेपाल सरकार' : 'Nepal Government' }}</span>
                    <span class="mx-1 text-slate-300">·</span>
                    <span>Citizen Accountability &amp; Real-Time Redirection</span>
                </p>
                <p class="mt-1.5 text-[10px] text-slate-300 max-w-md mx-auto leading-relaxed">QR-based workflow tracking, service guidance &amp; citizen dashboards.</p>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuToggleBtn = document.getElementById('menu-toggle-btn');
            const mobileDropdownMenu = document.getElementById('mobile-dropdown-menu');
            if (menuToggleBtn && mobileDropdownMenu) {
                menuToggleBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    mobileDropdownMenu.classList.toggle('hidden');
                });
                document.addEventListener('click', (e) => {
                    if (!mobileDropdownMenu.contains(e.target) && e.target !== menuToggleBtn) {
                        mobileDropdownMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
