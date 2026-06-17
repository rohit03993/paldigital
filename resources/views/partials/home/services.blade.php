<section id="services" class="section-padding">
    <div class="container-pal">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-14">
            <div>
                <span class="section-label">{{ $setting('section_services_label', 'The Stack We Ship') }}</span>
                <h2 class="heading-lg mt-4">{{ $setting('section_services_heading', "We Don't Do Generic") }}</h2>
                <p class="text-pal-muted mt-3 max-w-lg">{{ $setting('section_services_subheading', 'ERP, CRM, apps, automations — whatever your ops need, we build it from scratch.') }}</p>
            </div>
            <p class="text-sm text-pal-yellow/80 font-medium max-w-xs lg:text-right">
                {{ $setting('section_services_tagline', 'Every line of code → your workflow, your rules.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 lg:gap-6">
            @foreach($services as $category => $items)
                <div class="card card-glow group">
                    @include('partials.service-icon-box', ['category' => $category])
                    <h3 class="heading-md text-pal-yellow mb-5 !text-lg">{{ $category }}</h3>
                    <ul class="space-y-2.5">
                        @foreach($items as $service)
                            <li class="flex items-center gap-2.5 text-sm text-pal-muted group-hover:text-white/80 transition-colors">
                                <span class="w-1.5 h-1.5 rounded-full bg-pal-yellow shrink-0"></span>
                                {{ $service->title }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('services') }}" class="btn-outline">{{ $setting('section_services_btn', 'See the Full Arsenal →') }}</a>
        </div>
    </div>
</section>
