@extends('layouts.app')

@section('content')
<section class="pt-28 section-padding">
    <div class="container-pal">
        @include('partials.inner-page-header', [
            'labelKey' => 'inner_services_label',
            'headingKey' => 'inner_services_heading',
            'subheadingKey' => 'inner_services_subheading',
            'defaultLabel' => 'The Arsenal',
            'defaultHeading' => 'Everything We Build',
            'defaultSubheading' => 'From ERPs to WhatsApp bots — if your business needs it, we code it. No off-the-shelf nonsense.',
        ])

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($services as $category => $items)
                <div class="card group">
                    @include('partials.service-icon-box', ['category' => $category])
                    <h2 class="heading-md text-pal-yellow mb-6 !text-xl">{{ $category }}</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($items as $service)
                            <div class="flex items-center gap-2 p-3 rounded-lg bg-pal-dark border border-white/5">
                                <svg class="w-4 h-4 text-pal-yellow shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-sm">{{ $service->title }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('contact') }}?type=project" class="btn-primary">
                {{ $setting('inner_services_cta', 'Got Something Wild in Mind? Tell Us →') }}
            </a>
        </div>
    </div>
</section>
@endsection
