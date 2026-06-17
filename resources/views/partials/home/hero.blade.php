<section class="relative min-h-[85vh] lg:min-h-[92vh] flex items-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-pal-black via-pal-dark to-pal-black"></div>
    <div class="absolute inset-0 hero-grid opacity-60"></div>
    <div class="absolute top-20 right-0 w-[500px] h-[500px] bg-pal-yellow/8 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-pal-yellow/5 rounded-full blur-[100px]"></div>

    <div class="container-pal relative z-10 section-padding !pb-16 w-full">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div class="animate-fade-up">
                <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full border border-pal-yellow/25 bg-pal-yellow/5 text-pal-yellow text-xs font-medium tracking-wide mb-8">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pal-yellow opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-pal-yellow"></span>
                    </span>
                    {{ $setting('tagline', 'Custom software that actually gets your business — not the other way around') }}
                </div>

                <h1 class="heading-xl mb-6">
                    {{ $setting('hero_heading', 'Software That Actually Fits How You Work') }}
                </h1>

                <p class="text-body-lg mb-10 max-w-xl text-white/70">
                    {{ $setting('hero_subheading', 'ERP, CRM, mobile apps, automations — we build the tools your business deserves.') }}
                </p>

                <div class="flex flex-col sm:flex-row flex-wrap gap-3 mb-12">
                    <button type="button" @click="demoOpen = true" class="btn-primary gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        See It Live
                    </button>
                    <a href="{{ route('contact') }}?type=consultation" class="btn-outline">Free Consult</a>
                    <a href="{{ route('contact') }}?type=project" class="btn-ghost">I Have a Project →</a>
                </div>

                <div class="grid grid-cols-3 gap-4 max-w-md">
                    <div class="stat-card">
                        <div class="stat-value">{{ $setting('hero_stat_1_value', '25+') }}</div>
                        <div class="stat-label">{{ $setting('hero_stat_1_label', 'Modules Shipped') }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $setting('hero_stat_2_value', '8+') }}</div>
                        <div class="stat-label">{{ $setting('hero_stat_2_label', 'Industries Cracked') }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $setting('hero_stat_3_value', '0') }}</div>
                        <div class="stat-label">{{ $setting('hero_stat_3_label', 'Templates Used') }}</div>
                    </div>
                </div>
            </div>

            <div class="hidden lg:block relative animate-float">
                <div class="absolute -inset-4 bg-gradient-to-r from-pal-yellow/20 to-transparent rounded-3xl blur-2xl"></div>
                <div class="relative bg-pal-card border border-white/10 rounded-2xl p-6 shadow-2xl">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                        <span class="ml-2 text-xs text-pal-muted font-mono">pal-digital.app</span>
                    </div>
                    <div class="space-y-3 font-mono text-sm">
                        <div class="flex gap-3"><span class="text-pal-yellow">→</span><span class="text-pal-muted">Admission Management</span><span class="text-green-400 ml-auto">✓</span></div>
                        <div class="flex gap-3"><span class="text-pal-yellow">→</span><span class="text-pal-muted">Student CRM & Portal</span><span class="text-green-400 ml-auto">✓</span></div>
                        <div class="flex gap-3"><span class="text-pal-yellow">→</span><span class="text-pal-muted">Fee & Attendance</span><span class="text-green-400 ml-auto">✓</span></div>
                        <div class="flex gap-3"><span class="text-pal-yellow">→</span><span class="text-pal-muted">WhatsApp Automation</span><span class="text-green-400 ml-auto">✓</span></div>
                        <div class="flex gap-3"><span class="text-pal-yellow">→</span><span class="text-pal-muted">Custom Workflow Engine</span><span class="text-pal-yellow ml-auto">●</span></div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-white/5">
                        <p class="text-xs text-pal-muted">your workflow → our code → <span class="text-pal-yellow">chef's kiss</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
