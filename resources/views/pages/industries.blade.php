@extends('layouts.app')

@section('content')
<section class="pt-28 section-padding">
    <div class="container-pal">
        @include('partials.inner-page-header', [
            'labelKey' => 'inner_industries_label',
            'headingKey' => 'inner_industries_heading',
            'subheadingKey' => 'inner_industries_subheading',
            'defaultLabel' => 'Who We Serve',
            'defaultHeading' => 'Industries We Serve',
            'defaultSubheading' => 'Pal Digital builds custom software for any industry.',
        ])

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($industries as $industry)
                <div class="card group hover:border-pal-yellow/40 transition-all duration-300">
                    <div class="flex items-start gap-4">
                        @include('partials.industry-icon-box', ['industry' => $industry, 'inline' => true])
                        <div class="flex-1 text-left !mb-0">
                            <h2 class="heading-md mb-2 !text-lg">{{ $industry->title }}</h2>
                            <p class="text-pal-yellow text-sm font-medium mb-2">{{ $industry->subtitle }}</p>
                            @if($industry->description)
                                <p class="text-sm text-pal-muted">{{ $industry->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
