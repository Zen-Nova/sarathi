<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('messages.title'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased min-h-screen flex flex-col">

    <!-- Global Responsive Header Base Structure from brave_screenshot_chatgpt.com.jpg -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                
                <!-- Left Side: Brand Identity & Government Emblem Emblem Placeholder -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-sm shrink-0">
                        🇳🇵
                    </div>
                    <a href="/" class="flex flex-col">
                        <span class="text-lg font-black text-blue-900 tracking-tight leading-tight">Citizen Service</span>
                        <span class="text-md font-extrabold text-red-600 tracking-tight leading-none">Tracker Nepal</span>
                        <span class="text-[10px] text-slate-500 font-medium mt-0.5">सेवा सरल, सरकार पारदर्शी</span>
                    </a>
                </div>

                <!-- Center: Primary Platform Navigation Links -->
                <nav class="hidden md:flex space-x-6 lg:space-x-8 items-center">
                    <a href="#" class="text-sm font-semibold text-slate-600 hover:text-blue-900 flex flex-col items-center">
                        <span>{{ __('messages.nav_services') }}</span>
                        <span class="text-[11px] font-medium text-slate-400 -mt-0.5">सेवाहरू</span>
                    </a>
                    <a href="#" class="text-sm font-semibold text-slate-600 hover:text-blue-900 flex flex-col items-center">
                        <span>{{ __('messages.nav_track') }}</span>
                        <span class="text-[11px] font-medium text-slate-400 -mt-0.5">भ्रमण ट्र्याक</span>
                    </a>
                    <a href="#" class="text-sm font-semibold text-slate-600 hover:text-blue-900 flex flex-col items-center">
                        <span>{{ __('messages.nav_feedback') }}</span>
                        <span class="text-[11px] font-medium text-slate-400 -mt-0.5">प्रतिक्रिया</span>
                    </a>
                    <a href="#" class="text-sm font-semibold text-slate-600 hover:text-blue-900 flex flex-col items-center">
                        <span>{{ __('messages.nav_complaints') }}</span>
                        <span class="text-[11px] font-medium text-slate-400 -mt-0.5">गुनासो</span>
                    </a>
                    <a href="#" class="text-sm font-semibold text-slate-600 hover:text-blue-900 flex flex-col items-center">
                        <span>{{ __('messages.nav_stats') }}</span>
                        <span class="text-[11px] font-medium text-slate-400 -mt-0.5">तथ्याङ्क</span>
                    </a>
                </nav>

                <!-- Right Side: Session Actions, Language, and Authentication Button -->
                <div class="flex items-center space-x-4">
                    <!-- Dynamic Ongoing Tracking Exit Action Button -->
                    @if(request()->cookie('active_visit_token') && !Route::is('workflow.thanks') && !Route::is('workflow.checkout'))
                        <a href="{{ route('workflow.checkout', ['token' => request()->cookie('active_visit_token')]) }}" 
                           class="hidden sm:inline-flex text-xs font-bold bg-rose-50 text-rose-700 px-3 py-1.5 rounded-lg border border-rose-200 hover:bg-rose-100 transition-colors">
                            🔔 Exit Office
                        </a>
                    @endif

                    <!-- Language Switcher Element -->
                    <a href="{{ route('lang.switch', app()->getLocale() === 'en' ? 'np' : 'en') }}" 
                       class="inline-flex items-center text-xs font-bold text-slate-700 hover:text-blue-900 px-2 py-1 border border-slate-200 rounded bg-slate-50">
                        🌐 {{ app()->getLocale() === 'en' ? 'EN' : 'नेपाली' }}
                    </a>

                    <!-- Prominent Login Action Button from Mockup -->
                    <a href="/admin" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-bold rounded-lg text-white bg-blue-900 hover:bg-blue-800 shadow-sm transition-colors flex-col">
                        <span>{{ __('messages.login') }}</span>
                        <span class="text-[10px] font-normal opacity-80 -mt-0.5">लग इन</span>
                    </a>
                </div>

            </div>
        </div>
    </header>

    <!-- Contextual Information Banner Bar -->
    @if(request()->cookie('active_visit_token') && !Route::is('workflow.thanks') && !Route::is('citizen.welcome'))
        <div class="bg-blue-900 text-white py-2.5 shadow-inner">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center text-xs font-medium">
                <div class="flex items-center space-x-2">
                    <span class="animate-pulse h-2 w-2 rounded-full bg-emerald-400"></span>
                    <span>⏱️ Active Office Tracking Session Ongoing</span>
                </div>
                @if(!Route::is('workflow.roadmap') && !Route::is('workflow.select-service'))
                    <a href="{{ route('workflow.roadmap', ['token' => request()->cookie('active_visit_token')]) }}" class="underline font-bold text-amber-300 hover:text-amber-200 transition-colors">
                        View Roadmap Dashboard &rarr;
                    </a>
                @endif
            </div>
        </div>
    @endif

    <!-- Main Dynamic Content Region — Broad max-width configuration to adapt well to dashboard layouts -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Unified Public Sector Footer -->
    <footer class="bg-white border-t border-slate-200 py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs font-medium text-slate-500">
            <div class="flex flex-wrap justify-center gap-x-6 gap-y-2">
                <a href="/" class="hover:text-blue-900 transition-colors">Home</a>
                <a href="#" class="hover:text-blue-900 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-blue-900 transition-colors">Terms of Service</a>
                <a href="/admin" class="hover:text-blue-900 transition-colors">Admin Station</a>
            </div>
            <div class="text-center sm:text-right text-slate-400 text-[11px]">
                &copy; {{ date('Y') }} Digital Governance Initiative (Sarathi Platform). Built for transparency.
            </div>
        </div>
    </footer>

</body>
</html>