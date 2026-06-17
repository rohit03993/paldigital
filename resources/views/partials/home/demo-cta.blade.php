<section id="demo" class="section-padding bg-gradient-to-b from-pal-dark to-pal-black border-y border-white/5">
    <div class="container-pal">
        <div class="relative overflow-hidden rounded-3xl border border-pal-yellow/20 bg-pal-card">
            <div class="absolute top-0 right-0 w-96 h-96 bg-pal-yellow/10 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-pal-yellow/5 rounded-full blur-[80px]"></div>

            <div class="relative grid lg:grid-cols-2 gap-10 lg:gap-12 p-8 sm:p-10 lg:p-14 items-stretch">
                {{-- Left: pitch --}}
                <div class="flex flex-col justify-center">
                    <span class="section-label">{{ $setting('section_demo_label', 'Try Before You Commit') }}</span>
                    <h2 class="heading-lg mt-4 mb-4">{{ $setting('section_demo_heading', '30 Mins. Full Demo. Zero Sales Pressure.') }}</h2>
                    <p class="text-pal-muted leading-relaxed mb-6">
                        {{ $setting('section_demo_text', "We'll walk you through the Education ERP, a CRM build, or sketch out something custom for your industry.") }}
                    </p>

                    <ul class="space-y-3 mb-8">
                        @foreach($settingJson('demo_bullets', [
                            ['text' => 'Live walkthrough — not a slideshow'],
                            ['text' => 'Features picked for YOUR business'],
                            ['text' => 'Dev team on the call, not just sales'],
                        ]) as $item)
                            <li class="flex items-start gap-3 text-sm text-white/80">
                                <span class="flex-shrink-0 w-5 h-5 mt-0.5 rounded-full bg-pal-yellow/20 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-pal-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </span>
                                {{ $item['text'] ?? '' }}
                            </li>
                        @endforeach
                    </ul>

                    <button type="button" @click="demoOpen = true" class="btn-primary gap-2 w-full sm:w-auto self-start">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Book My Demo
                    </button>
                </div>

                {{-- Right: informational panel --}}
                @php
                    $defaultCards = [
                        ['title' => 'Education ERP', 'subtitle' => '11 modules', 'detail' => 'Admissions · Fees · Attendance · CRM', 'icon' => 'erp'],
                        ['title' => 'CRM Platform', 'subtitle' => 'Lead → Close', 'detail' => 'Pipeline · Follow-ups · Reports', 'icon' => 'crm'],
                        ['title' => 'Mobile Apps', 'subtitle' => 'iOS + Android', 'detail' => 'Portals · Field apps · Notifications', 'icon' => 'mobile'],
                        ['title' => 'Automation', 'subtitle' => 'WhatsApp & more', 'detail' => 'Workflows · Alerts · Integrations', 'icon' => 'automation'],
                    ];
                    $demoCards = collect($settingJson('demo_cards', []))
                        ->filter(fn ($c) => ! empty($c['title']))
                        ->values();
                    if ($demoCards->count() < 4) {
                        $demoCards = collect($defaultCards);
                    }
                    $agenda = $settingJson('demo_agenda', [
                        ['time' => '0–10 min', 'step' => 'Your goals & workflow — we listen first'],
                        ['time' => '10–25 min', 'step' => 'Live demo tailored to your industry'],
                        ['time' => '25–30 min', 'step' => 'Q&A with the dev team — no sales script'],
                    ]);
                @endphp

                <div class="rounded-2xl border border-white/10 bg-pal-dark/80 p-5 sm:p-6 flex flex-col gap-5">
                    <div class="flex items-center justify-between gap-3 flex-wrap">
                        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-pal-muted">
                            {{ $setting('section_demo_panel_title', 'What You Can Explore') }}
                        </p>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-green-500/15 border border-green-500/30 text-green-400 text-[10px] font-semibold uppercase tracking-wide">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                            Live demos
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        @foreach($demoCards->take(4) as $card)
                            @php
                                $icon = $card['icon'] ?? 'erp';
                            @endphp
                            <div class="group p-4 rounded-xl bg-pal-card border border-white/5 hover:border-pal-yellow/25 transition-all duration-300">
                                <div class="w-9 h-9 rounded-lg bg-pal-yellow/15 flex items-center justify-center mb-3 group-hover:bg-pal-yellow/25 transition-colors">
                                    @include('partials.demo-card-icon', ['icon' => $icon])
                                </div>
                                <div class="font-display font-bold text-sm text-pal-yellow leading-tight">{{ $card['title'] ?? '' }}</div>
                                <div class="text-[11px] text-white/70 mt-0.5 font-medium">{{ $card['subtitle'] ?? '' }}</div>
                                @if(!empty($card['detail']))
                                    <div class="text-[10px] text-pal-muted mt-2 leading-relaxed line-clamp-2">{{ $card['detail'] }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="rounded-xl border border-white/5 bg-pal-black/50 p-4">
                        <p class="text-[10px] font-semibold uppercase tracking-widest text-pal-yellow mb-3">Your 30-min session</p>
                        <div class="space-y-2.5">
                            @foreach($agenda as $row)
                                <div class="flex gap-3 text-xs">
                                    <span class="shrink-0 w-16 text-pal-yellow/90 font-mono font-medium">{{ $row['time'] ?? '' }}</span>
                                    <span class="text-pal-muted leading-relaxed">{{ $row['step'] ?? '' }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 pt-1">
                        <span class="px-3 py-1.5 rounded-lg bg-pal-yellow/10 border border-pal-yellow/20 text-pal-yellow text-xs font-semibold">30 minutes</span>
                        <span class="px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-white/70 text-xs font-medium">100% free</span>
                        <span class="px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-white/70 text-xs font-medium">No hard sell</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
