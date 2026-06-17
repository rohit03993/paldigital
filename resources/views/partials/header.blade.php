@php
    $setting = fn($key, $default = '') => \App\Models\SiteSetting::get($key, $default);
    $logo = \App\Models\SiteSetting::asset('site_logo');
@endphp

<header class="fixed top-0 left-0 right-0 z-50 bg-pal-black/90 backdrop-blur-xl border-b border-white/5 safe-top">
    <div class="container-pal mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14 lg:h-[72px]">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0">
                @if($logo)
                    <img src="{{ $logo }}" alt="{{ $setting('site_name', 'Pal Digital') }}" class="h-8 lg:h-9 w-auto max-w-[120px] object-contain">
                @else
                    <div class="w-9 h-9 lg:w-10 lg:h-10 bg-gradient-to-br from-pal-yellow to-yellow-400 rounded-xl flex items-center justify-center font-extrabold text-pal-black text-base lg:text-lg shadow-lg shadow-pal-yellow/20">P</div>
                    <span class="font-bold text-base lg:text-xl tracking-tight hidden xs:inline">
                        <span class="text-pal-yellow">Pal</span> Digital
                    </span>
                @endif
            </a>

            <p class="lg:hidden absolute left-1/2 -translate-x-1/2 font-display font-semibold text-sm tracking-tight text-white/95 pointer-events-none">
                {{ $setting('site_name', 'Pal Digital') }}
            </p>

            <nav class="hidden lg:flex items-center gap-0.5">
                @foreach([
                    ['home', 'Home'], ['services', 'Services'], ['industries', 'Industries'],
                    ['solutions', 'Solutions'], ['portfolio', 'Portfolio'], ['about', 'About'], ['contact', 'Contact'],
                ] as [$route, $label])
                    <a href="{{ route($route) }}"
                       class="px-3.5 py-2 text-sm font-medium rounded-lg transition-all duration-200
                              {{ request()->routeIs($route) || request()->routeIs($route.'.*') ? 'text-pal-yellow bg-pal-yellow/10' : 'text-pal-muted hover:text-white hover:bg-white/5' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>

            <div class="hidden lg:flex items-center gap-3">
                <button type="button" @click="demoOpen = true" class="btn-outline text-sm !py-2.5 !px-5">Grab a Demo</button>
                <a href="{{ route('contact') }}?type=consultation" class="btn-primary text-sm !py-2.5 !px-5 shadow-lg shadow-pal-yellow/20">Let's Talk</a>
            </div>

            <div class="lg:hidden w-9"></div>
        </div>
    </div>
</header>

<style>[x-cloak] { display: none !important; }</style>
