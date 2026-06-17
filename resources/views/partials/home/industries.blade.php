<section id="industries" class="section-padding bg-pal-dark/50">
    <div class="container-pal">
        <div class="text-center mb-14">
            <span class="section-label justify-center">{{ $setting('section_industries_label', 'Who We Build For') }}</span>
            <h2 class="heading-lg mt-4">{{ $setting('section_industries_heading', 'Every Industry. Zero Limits.') }}</h2>
            <p class="text-pal-muted mt-4 max-w-2xl mx-auto">
                {{ $setting('section_industries_subheading', 'Schools, hospitals, factories, NGOs — if you have a workflow, we can build software around it.') }}
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            @foreach($industries as $industry)
                <div class="card group text-center hover:-translate-y-1 hover:shadow-xl hover:shadow-pal-yellow/5 transition-all duration-300 !p-4 sm:!p-6">
                    @include('partials.industry-icon-box', ['industry' => $industry])
                    <h3 class="font-display font-bold text-sm sm:text-base mb-1">{{ $industry->title }}</h3>
                    <p class="text-[11px] sm:text-xs text-pal-muted leading-relaxed line-clamp-2">{{ $industry->subtitle }}</p>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('industries') }}" class="btn-ghost">{{ $setting('section_industries_link', 'Your industry not listed? We still got you →') }}</a>
        </div>
    </div>
</section>
