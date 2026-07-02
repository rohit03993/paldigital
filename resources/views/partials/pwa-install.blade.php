@php
    $siteName = \App\Models\SiteSetting::get('site_name', 'Pal Digital');
    $appIcon = \App\Models\SiteSetting::asset('site_favicon') ?: \App\Models\SiteSetting::asset('site_logo');
@endphp

{{-- Mobile install banner --}}
<div x-cloak
     x-show="$store.pwa.showBanner"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-4"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 translate-y-4"
     class="lg:hidden fixed left-4 right-4 bottom-[4.75rem] z-[45]"
     role="dialog"
     aria-label="Install app">
    <div class="flex items-center gap-3 rounded-2xl border border-pal-yellow/25 bg-pal-card/95 backdrop-blur-xl p-4 shadow-2xl shadow-black/40">
        @if($appIcon)
            <img src="{{ $appIcon }}" alt="" class="w-11 h-11 rounded-xl shrink-0 object-cover bg-pal-dark">
        @else
            <div class="w-11 h-11 rounded-xl bg-pal-yellow flex items-center justify-center shrink-0 font-extrabold text-pal-black">P</div>
        @endif
        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-white truncate">Install {{ $siteName }}</p>
            <p class="text-xs text-pal-muted mt-0.5">Quick access from your home screen</p>
        </div>
        <div class="flex flex-col gap-1.5 shrink-0">
            <button type="button"
                    @click="$store.pwa.openInstall()"
                    class="px-3 py-1.5 rounded-lg bg-pal-yellow text-pal-black text-xs font-bold active:scale-95 transition-transform">
                Install
            </button>
            <button type="button"
                    @click="$store.pwa.dismissBanner()"
                    class="px-3 py-1 text-pal-muted text-[11px] hover:text-white transition-colors">
                Not now
            </button>
        </div>
    </div>
</div>

{{-- iOS install instructions --}}
<div x-cloak
     x-show="$store.pwa.showInstructions"
     class="fixed inset-0 z-[100] flex items-end sm:items-center justify-center p-4"
     role="dialog"
     aria-modal="true"
     aria-label="How to install on iPhone">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" @click="$store.pwa.closeInstructions()"></div>

    <div class="relative w-full max-w-sm rounded-2xl border border-white/10 bg-pal-card p-6 safe-bottom"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-8"
         x-transition:enter-end="opacity-100 translate-y-0"
         @click.stop>
        <button type="button"
                @click="$store.pwa.closeInstructions()"
                class="absolute top-4 right-4 text-pal-muted hover:text-white transition-colors"
                aria-label="Close">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="flex items-center gap-3 mb-5">
            @if($appIcon)
                <img src="{{ $appIcon }}" alt="" class="w-12 h-12 rounded-xl object-cover bg-pal-dark">
            @else
                <div class="w-12 h-12 rounded-xl bg-pal-yellow flex items-center justify-center font-extrabold text-pal-black">P</div>
            @endif
            <div>
                <h3 class="font-display font-bold text-lg">Add to Home Screen</h3>
                <p class="text-sm text-pal-muted">Install {{ $siteName }} on your iPhone</p>
            </div>
        </div>

        <ol class="space-y-4 text-sm text-pal-muted">
            <li class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-pal-yellow/15 text-pal-yellow text-xs font-bold flex items-center justify-center shrink-0">1</span>
                <span>Tap the <strong class="text-white">Share</strong> button in Safari's toolbar (square with arrow up).</span>
            </li>
            <li class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-pal-yellow/15 text-pal-yellow text-xs font-bold flex items-center justify-center shrink-0">2</span>
                <span>Scroll down and tap <strong class="text-white">Add to Home Screen</strong>.</span>
            </li>
            <li class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-pal-yellow/15 text-pal-yellow text-xs font-bold flex items-center justify-center shrink-0">3</span>
                <span>Tap <strong class="text-white">Add</strong> — {{ $siteName }} will appear on your home screen.</span>
            </li>
        </ol>

        <button type="button"
                @click="$store.pwa.closeInstructions()"
                class="btn-primary w-full mt-6">
            Got it
        </button>
    </div>
</div>
