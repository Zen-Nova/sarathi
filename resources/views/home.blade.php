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
                        <span class="text-[10px] text-slate-500 font-medium mt-0.5">Service Simple, Government Transparent</span>
                    </a>
                </div>

                <!-- Center: Primary Platform Navigation Links -->
                <nav class="hidden md:flex space-x-6 lg:space-x-8 items-center">
                    <a href="#" class="text-sm font-semibold text-slate-600 hover:text-blue-900">
                        {{ __('messages.nav_services') }}
                    </a>
                    <a href="#" class="text-sm font-semibold text-slate-600 hover:text-blue-900">
                        {{ __('messages.nav_track') }}
                    </a>
                    <a href="#" class="text-sm font-semibold text-slate-600 hover:text-blue-900">
                        {{ __('messages.nav_feedback') }}
                    </a>
                    <a href="#" class="text-sm font-semibold text-slate-600 hover:text-blue-900">
                        {{ __('messages.nav_complaints') }}
                    </a>
                    <a href="#" class="text-sm font-semibold text-slate-600 hover:text-blue-900">
                        {{ __('messages.nav_stats') }}
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

                    <!-- Prominent Login Action Button from Mockup -->
                    <a href="/admin" class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-bold rounded-lg text-white bg-blue-900 hover:bg-blue-800 shadow-sm transition-colors">
                        {{ __('messages.login') }}
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
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex flex-col justify-between">
        
        <!-- Hero section with 2-column layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center my-auto">
            <!-- Left Column: Copywriting and Buttons -->
            <div class="lg:col-span-5 space-y-6 text-left">
                <div class="space-y-3">
                    <h1 class="text-4xl md:text-[44px] font-black text-slate-900 tracking-tight leading-[1.1] font-sans">
                        Public Service.<br>
                        Transparent. Accountable.<br>
                        For Every Nepali.
                    </h1>
                </div>

                <div class="space-y-3 text-slate-600 text-sm md:text-base leading-relaxed">
                    <p class="font-medium">
                        Track your visits, get real-time updates, submit feedback and help us build a better, more accountable government.
                    </p>
                </div>

                <div class="flex flex-wrap gap-4 pt-2">
                    <!-- Start Service -->
                    <a href="/scan?office=district-administration-office-kathmandu" class="inline-flex items-center justify-center bg-blue-900 hover:bg-blue-800 text-white px-6 py-3 rounded-lg font-bold text-sm transition-colors shadow-sm min-w-[180px] text-center">
                        Start Service
                    </a>
                    
                    <!-- Track My Visit -->
                    <a href="#" class="inline-flex items-center justify-center border border-blue-900 hover:bg-blue-50 text-blue-900 bg-white px-6 py-3 rounded-lg font-bold text-sm transition-colors min-w-[180px] text-center">
                        Track My Visit
                    </a>
                </div>
            </div>

            <!-- Right Column: Vector Illustration -->
            <div class="lg:col-span-7 flex justify-center">
                <div class="relative w-full max-w-2xl bg-white p-1 rounded-2xl shadow-xs border border-slate-200/40">
                    <img src="{{ asset('images/citizen_service_hub.png') }}" alt="Citizen Service Hub Illustration" class="w-full h-auto rounded-xl object-cover">
                </div>
            </div>
        </div>

        <!-- Real-time Stats Grid at the bottom -->
        <div class="border-t border-slate-200/80 pt-8 mt-12 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6 text-center">
            <!-- Stat 1 -->
            <div class="flex items-center justify-start space-x-3 text-left">
                <div class="w-10 h-10 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                    👥
                </div>
                <div>
                    <div class="text-lg font-black text-slate-800 leading-tight">2.8M+</div>
                    <div class="text-[10px] font-bold text-slate-400 leading-none mt-1">Services Provided</div>
                </div>
            </div>

            <!-- Stat 2 -->
            <div class="flex items-center justify-start space-x-3 text-left">
                <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                    🪪
                </div>
                <div>
                    <div class="text-lg font-black text-slate-800 leading-tight">1.6M+</div>
                    <div class="text-[10px] font-bold text-slate-400 leading-none mt-1">Citizen Registrations</div>
                </div>
            </div>

            <!-- Stat 3 -->
            <div class="flex items-center justify-start space-x-3 text-left">
                <div class="w-10 h-10 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                    ⏱️
                </div>
                <div>
                    <div class="text-lg font-black text-slate-800 leading-tight">98.2%</div>
                    <div class="text-[10px] font-bold text-slate-400 leading-none mt-1">On-time Service</div>
                </div>
            </div>

            <!-- Stat 4 -->
            <div class="flex items-center justify-start space-x-3 text-left">
                <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                    ⬇️
                </div>
                <div>
                    <div class="text-lg font-black text-slate-800 leading-tight">4.7/5</div>
                    <div class="text-[10px] font-bold text-slate-400 leading-none mt-1">Satisfaction Score</div>
                </div>
            </div>

            <!-- Stat 5 -->
            <div class="flex items-center justify-start space-x-3 text-left">
                <div class="w-10 h-10 bg-blue-50 text-blue-900 rounded-xl flex items-center justify-center text-xl shrink-0">
                    🏫
                </div>
                <div>
                    <div class="text-lg font-black text-slate-800 leading-tight">7,532</div>
                    <div class="text-[10px] font-bold text-slate-400 leading-none mt-1">Offices Covered</div>
                </div>
            </div>

            <!-- Stat 6 -->
            <div class="flex items-center justify-start space-x-3 text-left">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                    📍
                </div>
                <div>
                    <div class="text-lg font-black text-slate-800 leading-tight">77</div>
                    <div class="text-[10px] font-bold text-slate-400 leading-none mt-1">Districts Covered</div>
                </div>
            </div>
        </div>

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