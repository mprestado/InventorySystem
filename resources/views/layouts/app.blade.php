<!DOCTYPE html>
<html lang="en" x-data="{ dark: localStorage.getItem('theme') === 'dark' }" :class="{ 'dark': dark }" x-init="$watch('dark', v => localStorage.setItem('theme', v ? 'dark' : 'light'))">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') · {{ $shopName }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: {
                fontFamily: {
                    sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    display: ['Inter', 'sans-serif'],
                    mono: ['ui-monospace', 'SFMono-Regular', 'Menlo', 'monospace'],
                },
                fontWeight: { 400:'400', 500:'500', 600:'600', 700:'700' },
                colors: {
                    // ONE muted primary — steel blue. Used only for primary actions & active nav.
                    brand: { 50:'#eef2f8',100:'#d9e2ef',200:'#b6c7de',300:'#8aa4c6',400:'#5f80a8',500:'#3f608a',600:'#324c6e',700:'#2b3f59',800:'#26364b',900:'#222f40' },
                    // Neutral surface scale for the dark sidebar / dark mode (true slate, no blue cast)
                    ink: { 50:'#f8fafc',100:'#f1f5f9',200:'#e2e8f0',300:'#cbd5e1',400:'#94a3b8',500:'#64748b',600:'#475569',700:'#334155',800:'#1e293b',900:'#0f172a',950:'#020617' },
                },
                borderRadius: { DEFAULT:'6px', md:'6px', lg:'8px', xl:'10px', '2xl':'12px' },
                boxShadow: {
                    'card': '0 1px 2px rgba(15,23,42,.04)',
                    'pop':  '0 4px 12px rgba(15,23,42,.08), 0 1px 3px rgba(15,23,42,.06)',
                },
                transitionDuration: { DEFAULT:'150ms' },
                keyframes: { fade: { '0%':{opacity:0,transform:'translateY(4px)'}, '100%':{opacity:1,transform:'translateY(0)'} } },
                animation: { fade: 'fade .15s ease both' },
            }}
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        [x-cloak]{display:none!important}
        html{ font-feature-settings:'cv11','ss01'; }
        body{ -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale; }
        /* tabular figures for all quantities, prices, SKUs so columns align */
        .tnum,table td,table th,.font-mono{ font-variant-numeric:tabular-nums lining-nums; }
        ::selection{ background:rgba(63,96,138,.18); }
        ::-webkit-scrollbar{width:10px;height:10px}
        ::-webkit-scrollbar-track{background:transparent}
        ::-webkit-scrollbar-thumb{background:#cbd5e1;border-radius:8px;border:2px solid transparent;background-clip:padding-box}
        ::-webkit-scrollbar-thumb:hover{background:#94a3b8;background-clip:padding-box}
        .dark ::-webkit-scrollbar-thumb{background:#334155;background-clip:padding-box}
        .glass{background:rgba(255,255,255,.85);backdrop-filter:blur(8px)}
        .dark .glass{background:rgba(15,23,42,.85)}
        a,button{ -webkit-tap-highlight-color:transparent; }
        [data-lucide]{ width:1em; height:1em; stroke-width:2; }
    </style>
</head>
<body class="font-sans bg-slate-50 dark:bg-ink-950 text-slate-700 dark:text-slate-300 antialiased text-[14px] leading-normal">
<div x-data="{ sidebar: window.innerWidth >= 1024 }" class="min-h-screen lg:flex">

    @include('layouts.sidebar')

    <!-- Main -->
    <div class="flex-1 min-w-0 flex flex-col">
        @include('layouts.topbar')

        <main class="flex-1 p-4 sm:p-6 max-w-[1600px] w-full mx-auto animate-fade">
            @if (session('success'))
                <div x-data="{show:true}" x-show="show" x-transition x-init="setTimeout(()=>show=false,4000)"
                     class="mb-4 flex items-center gap-2.5 rounded-md bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-900 px-3.5 py-2.5 text-sm text-emerald-700 dark:text-emerald-300">
                    <i data-lucide="check-circle-2" class="w-4 h-4 shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div x-data="{show:true}" x-show="show" x-transition x-init="setTimeout(()=>show=false,5000)"
                     class="mb-4 flex items-center gap-2.5 rounded-md bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-900 px-3.5 py-2.5 text-sm text-rose-700 dark:text-rose-300">
                    <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 rounded-md bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-900 px-3.5 py-2.5 text-rose-700 dark:text-rose-300">
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
        <footer class="px-6 py-4 text-center text-xs text-slate-400 dark:text-slate-600 border-t border-slate-200/70 dark:border-slate-800">
            {{ $shopName }} · Inventory Management System &copy; {{ date('Y') }}
        </footer>
    </div>
</div>
<script>
    // Render Lucide icons; re-render after Alpine swaps in dynamic content.
    const renderIcons = () => window.lucide && window.lucide.createIcons();
    document.addEventListener('DOMContentLoaded', renderIcons);
    document.addEventListener('alpine:initialized', renderIcons);
</script>
@stack('scripts')
</body>
</html>
