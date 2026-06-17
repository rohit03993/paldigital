@extends('layouts.app')

@section('content')
<section class="pt-28 section-padding">
    <div class="container-pal">
        @include('partials.inner-page-header', [
            'labelKey' => 'inner_portfolio_label',
            'headingKey' => 'inner_portfolio_heading',
            'subheadingKey' => 'inner_portfolio_subheading',
            'defaultLabel' => 'Our Work',
            'defaultHeading' => 'Portfolio',
            'defaultSubheading' => "Projects we've delivered across industries.",
        ])

        @if($portfolios->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($portfolios as $item)
                    <div class="card group">
                        <div class="aspect-video bg-pal-dark rounded-lg mb-4 overflow-hidden flex items-center justify-center">
                            @if($item->imageUrl())
                                <img src="{{ $item->imageUrl() }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                            @else
                                <span class="text-pal-muted">{{ $item->industry ?? 'Project' }}</span>
                            @endif
                        </div>
                        <h2 class="font-semibold text-lg group-hover:text-pal-yellow transition-colors">{{ $item->title }}</h2>
                        @if($item->client)<p class="text-sm text-pal-yellow">{{ $item->client }}</p>@endif
                        <p class="text-sm text-pal-muted mt-2">{{ Str::limit($item->description, 120) }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card text-center py-16">
                <p class="text-pal-muted">
                    {{ $setting('inner_portfolio_empty', 'Portfolio items coming soon. Contact us to see our work.') }}
                    <a href="{{ route('contact') }}" class="text-pal-yellow hover:underline ml-1">Contact us</a>
                </p>
            </div>
        @endif
    </div>
</section>
@endsection
