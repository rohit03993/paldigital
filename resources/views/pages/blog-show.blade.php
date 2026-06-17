@extends('layouts.app')

@section('content')
<article class="pt-28 section-padding">
    <div class="container-pal max-w-3xl">
        @if($post->imageUrl())
            <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="w-full rounded-2xl mb-8 object-cover max-h-96" loading="eager">
        @endif
        <time class="text-pal-muted text-sm">{{ $post->published_at?->format('F d, Y') }}</time>
        <h1 class="heading-lg mt-2 mb-6">{{ $post->title }}</h1>
        @if($post->author)<p class="text-pal-yellow text-sm mb-8">By {{ $post->author }}</p>@endif
        <div class="prose prose-invert max-w-none text-pal-muted leading-relaxed">
            {!! $post->content !!}
        </div>
        <div class="mt-10">
            <a href="{{ route('blog') }}" class="btn-ghost">← Back to Blog</a>
        </div>
    </div>
</article>
@endsection
