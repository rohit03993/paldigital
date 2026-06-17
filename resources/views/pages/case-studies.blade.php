@extends('layouts.app')

@section('content')
<section class="pt-28 section-padding">
    <div class="container-pal">
        @include('partials.inner-page-header', [
            'labelKey' => 'inner_case_studies_label',
            'headingKey' => 'inner_case_studies_heading',
            'subheadingKey' => 'inner_case_studies_subheading',
            'defaultLabel' => 'Success Stories',
            'defaultHeading' => 'Case Studies',
            'defaultSubheading' => "How we've helped businesses transform with custom software.",
        ])

        @if($caseStudies->count())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($caseStudies as $study)
                    <a href="{{ route('case-studies.show', $study->slug) }}" class="card group block hover:border-pal-yellow/40">
                        @if($study->imageUrl())
                            <div class="aspect-video rounded-lg overflow-hidden mb-4 -mx-2 -mt-2">
                                <img src="{{ $study->imageUrl() }}" alt="{{ $study->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                            </div>
                        @endif
                        <span class="text-xs text-pal-yellow font-medium">{{ $study->industry }}</span>
                        <h2 class="font-semibold text-lg mt-2 group-hover:text-pal-yellow transition-colors">{{ $study->title }}</h2>
                        <p class="text-sm text-pal-muted mt-2">{{ $study->excerpt }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <div class="card text-center py-16">
                <p class="text-pal-muted">{{ $setting('inner_case_studies_empty', 'Case studies coming soon.') }}</p>
            </div>
        @endif
    </div>
</section>
@endsection
