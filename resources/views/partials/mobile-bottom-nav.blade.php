<nav class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-pal-dark/95 backdrop-blur-xl border-t border-white/10 safe-bottom"
     aria-label="Mobile navigation">
    <div class="grid grid-cols-5 h-16 max-w-lg mx-auto">
        <a href="{{ route('home') }}"
           class="flex flex-col items-center justify-center gap-1 transition-colors active:scale-95
                  {{ request()->routeIs('home') ? 'text-pal-yellow' : 'text-pal-muted' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span class="text-[10px] font-medium">Home</span>
        </a>

        <a href="{{ route('services') }}"
           class="flex flex-col items-center justify-center gap-1 transition-colors active:scale-95
                  {{ request()->routeIs('services') ? 'text-pal-yellow' : 'text-pal-muted' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
            <span class="text-[10px] font-medium">Services</span>
        </a>

        <button type="button" @click="demoOpen = true"
                class="flex flex-col items-center justify-center gap-1 text-pal-muted active:scale-95 transition-transform">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="text-[10px] font-medium">Demo</span>
        </button>

        <a href="{{ route('contact') }}"
           class="flex flex-col items-center justify-center gap-1 transition-colors active:scale-95
                  {{ request()->routeIs('contact') ? 'text-pal-yellow' : 'text-pal-muted' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span class="text-[10px] font-medium">Contact</span>
        </a>

        <button type="button" @click="mobileSheet = true"
                class="flex flex-col items-center justify-center gap-1 transition-colors active:scale-95
                       {{ request()->routeIs('about') || request()->routeIs('industries') || request()->routeIs('solutions') || request()->routeIs('portfolio') || request()->routeIs('blog') || request()->routeIs('case-studies*') ? 'text-pal-yellow' : 'text-pal-muted' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6h16M4 12h16M4 18h16"/></svg>
            <span class="text-[10px] font-medium">More</span>
        </button>
    </div>
</nav>
