<section class="section-padding relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-pal-yellow/10 via-transparent to-pal-yellow/5"></div>
    <div class="container-pal relative">
        <div class="card !p-10 sm:!p-16 text-center border-pal-yellow/30 max-w-4xl mx-auto">
            <p class="text-pal-yellow text-sm font-semibold uppercase tracking-widest mb-3">{{ $setting('section_cta_label', 'Real talk') }}</p>
            <h2 class="heading-lg mb-4">{{ $setting('section_cta_heading', 'Still Running Your Business on Spreadsheets & WhatsApp Groups?') }}</h2>
            <p class="text-pal-muted mb-8 max-w-xl mx-auto">
                {{ $setting('section_cta_subheading', "Yeah, we should fix that. School, hospital, factory, startup — doesn't matter. Let's build something that works.") }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}?type=consultation" class="btn-primary">{{ $setting('section_cta_btn_primary', 'Free Consult — Zero Awkwardness') }}</a>
                <button type="button" @click="demoOpen = true" class="btn-outline">{{ $setting('section_cta_btn_secondary', 'Show Me a Demo First') }}</button>
            </div>
        </div>
    </div>
</section>
