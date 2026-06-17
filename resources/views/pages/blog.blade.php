@extends('layouts.app')

@section('content')
<section class="pt-28 section-padding">
    <div class="container-pal">
        @include('partials.inner-page-header', [
            'labelKey' => 'inner_blog_label',
            'headingKey' => 'inner_blog_heading',
            'subheadingKey' => 'inner_blog_subheading',
            'defaultLabel' => 'Insights',
            'defaultHeading' => 'Blog',
            'defaultSubheading' => 'Insights on custom software, automation, and digital transformation.',
        ])

        @if($posts->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    <a href="{{ route('blog.show', $post->slug) }}" class="card group block hover:border-pal-yellow/40">
                        @if($post->imageUrl())
                            <div class="aspect-video rounded-lg overflow-hidden mb-4 -mx-2 -mt-2 sm:mx-0 sm:mt-0">
                                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                            </div>
                        @endif
                        <time class="text-xs text-pal-muted">{{ $post->published_at?->format('M d, Y') }}</time>
                        <h2 class="font-semibold text-lg mt-2 group-hover:text-pal-yellow transition-colors">{{ $post->title }}</h2>
                        <p class="text-sm text-pal-muted mt-2">{{ $post->excerpt }}</p>
                    </a>
                @endforeach
            </div>
            <div class="mt-10">{{ $posts->links() }}</div>
        @else
            <div class="card text-center py-16">
                <p class="text-pal-muted">{{ $setting('inner_blog_empty', 'Blog posts coming soon.') }}</p>
            </div>
        @endif
    </div>
</section>
@endsection
