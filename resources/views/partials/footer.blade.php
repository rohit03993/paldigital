@php
    $setting = fn($key, $default = '') => \App\Models\SiteSetting::get($key, $default);
    $logo = \App\Models\SiteSetting::asset('site_logo');
    $whatsapp = preg_replace('/[^0-9]/', '', $setting('whatsapp', ''));
@endphp

<footer class="hidden lg:block relative bg-pal-black border-t border-white/5 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-pal-yellow/[0.03] to-transparent pointer-events-none"></div>

    {{-- CTA band --}}
    <div class="relative border-b border-white/5">
        <div class="container-pal section-padding !py-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8 rounded-2xl border border-pal-yellow/20 bg-pal-card/80 p-8 lg:p-10">
                <div class="text-center lg:text-left">
                    <p class="text-pal-yellow text-sm font-semibold uppercase tracking-widest mb-2">No templates. No compromises.</p>
                    <h3 class="font-display text-2xl lg:text-3xl font-bold">Got a workflow that doesn't fit off-the-shelf software?</h3>
                    <p class="text-pal-muted mt-2 text-sm">Perfect. That's literally our thing.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                    <button type="button" @click="demoOpen = true" class="btn-primary">Grab a Demo</button>
                    <a href="{{ route('contact') }}?type=consultation" class="btn-outline">Let's Talk</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Main footer --}}
    <div class="relative section-padding !py-14">
        <div class="container-pal">
            <div class="grid grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8">
                <div class="col-span-2 lg:col-span-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-5">
                        @if($logo)
                            @include('partials.site-logo', ['variant' => 'footer', 'logo' => $logo])
                        @else
                            <div class="w-10 h-10 bg-pal-yellow rounded-xl flex items-center justify-center font-extrabold text-pal-black">P</div>
                            <span class="font-display font-bold text-xl"><span class="text-pal-yellow">Pal</span> Digital</span>
                        @endif
                    </a>
                    <p class="text-pal-muted text-sm leading-relaxed max-w-xs">
                        {{ $setting('tagline', 'We build software that actually gets how your business runs — for schools, hospitals, factories, startups, everyone.') }}
                    </p>
                    @if($whatsapp)
                        <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 mt-5 text-sm text-[#25D366] hover:text-[#2ee072] transition-colors font-medium">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            Slide into our DMs on WhatsApp
                        </a>
                    @endif
                </div>

                <div class="lg:col-span-2">
                    <h4 class="font-display font-bold text-white mb-4 text-sm uppercase tracking-wider">Build</h4>
                    <ul class="space-y-2.5 text-sm text-pal-muted">
                        <li><a href="{{ route('services') }}" class="hover:text-pal-yellow transition-colors">Services</a></li>
                        <li><a href="{{ route('solutions') }}" class="hover:text-pal-yellow transition-colors">Solutions</a></li>
                        <li><a href="{{ route('portfolio') }}" class="hover:text-pal-yellow transition-colors">Portfolio</a></li>
                        <li><a href="{{ route('industries') }}" class="hover:text-pal-yellow transition-colors">Industries</a></li>
                    </ul>
                </div>

                <div class="lg:col-span-2">
                    <h4 class="font-display font-bold text-white mb-4 text-sm uppercase tracking-wider">Company</h4>
                    <ul class="space-y-2.5 text-sm text-pal-muted">
                        <li><a href="{{ route('about') }}" class="hover:text-pal-yellow transition-colors">About</a></li>
                        <li><a href="{{ route('case-studies') }}" class="hover:text-pal-yellow transition-colors">Case Studies</a></li>
                        <li><a href="{{ route('blog') }}" class="hover:text-pal-yellow transition-colors">Blog</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-pal-yellow transition-colors">Contact</a></li>
                    </ul>
                </div>

                <div class="col-span-2 lg:col-span-4">
                    <h4 class="font-display font-bold text-white mb-4 text-sm uppercase tracking-wider">Hit Us Up</h4>
                    <ul class="space-y-3 text-sm">
                        @if($setting('contact_email'))
                            <li>
                                <a href="mailto:{{ $setting('contact_email') }}" class="flex items-center gap-3 text-pal-muted hover:text-white transition-colors group">
                                    <span class="w-9 h-9 rounded-lg bg-pal-card border border-white/5 flex items-center justify-center group-hover:border-pal-yellow/30">
                                        <svg class="w-4 h-4 text-pal-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </span>
                                    {{ $setting('contact_email') }}
                                </a>
                            </li>
                        @endif
                        @if($setting('contact_phone'))
                            <li>
                                <a href="tel:{{ $setting('contact_phone') }}" class="flex items-center gap-3 text-pal-muted hover:text-white transition-colors group">
                                    <span class="w-9 h-9 rounded-lg bg-pal-card border border-white/5 flex items-center justify-center group-hover:border-pal-yellow/30">
                                        <svg class="w-4 h-4 text-pal-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </span>
                                    {{ $setting('contact_phone') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="mt-14 pt-8 border-t border-white/5 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sm text-pal-muted">&copy; {{ date('Y') }} Pal Digital. Built different — on purpose.</p>
                <p class="text-sm text-pal-muted">Custom software for <span class="text-pal-yellow font-semibold">literally any industry</span> 🔥</p>
            </div>
        </div>
    </div>
</footer>
