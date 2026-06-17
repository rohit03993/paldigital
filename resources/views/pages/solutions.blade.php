@extends('layouts.app')

@section('content')
<section class="pt-28 section-padding">
    <div class="container-pal">
        @include('partials.inner-page-header', [
            'labelKey' => 'inner_solutions_label',
            'headingKey' => 'inner_solutions_heading',
            'subheadingKey' => 'inner_solutions_subheading',
            'defaultLabel' => 'What We Ship',
            'defaultHeading' => "Proven Solutions We've Built",
            'defaultSubheading' => 'Real software, real results — customized for your industry.',
        ])

        @if($flagship)
            @include('partials.home.flagship', ['flagship' => $flagship])
        @endif

        @if($solutions->where('is_flagship', false)->count())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12">
                @foreach($solutions->where('is_flagship', false) as $solution)
                    <div class="card">
                        @if($solution->imageUrl())
                            <img src="{{ $solution->imageUrl() }}" alt="{{ $solution->title }}" class="w-full rounded-lg mb-4 object-cover max-h-48" loading="lazy">
                        @endif
                        <h2 class="heading-md mb-3">{{ $solution->title }}</h2>
                        <p class="text-pal-muted text-sm mb-4">{{ $solution->description }}</p>
                        @if($solution->features)
                            <ul class="space-y-1">
                                @foreach(array_slice($solution->features, 0, 5) as $feature)
                                    <li class="text-sm flex items-center gap-2">
                                        <span class="text-pal-yellow">•</span> {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
