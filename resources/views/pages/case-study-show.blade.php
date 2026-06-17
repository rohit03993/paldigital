@extends('layouts.app')

@section('content')
<article class="pt-28 section-padding">
    <div class="container-pal max-w-3xl">
        <span class="text-pal-yellow text-sm font-medium">{{ $caseStudy->industry }}</span>
        <h1 class="heading-lg mt-2 mb-6">{{ $caseStudy->title }}</h1>
        @if($caseStudy->client)<p class="text-pal-muted mb-8">Client: {{ $caseStudy->client }}</p>@endif
        @if($caseStudy->imageUrl())
            <img src="{{ $caseStudy->imageUrl() }}" alt="{{ $caseStudy->title }}" class="w-full rounded-2xl mb-8 object-cover max-h-96" loading="eager">
        @endif
        <div class="prose prose-invert max-w-none text-pal-muted leading-relaxed">
            {!! nl2br(e($caseStudy->content)) !!}
        </div>
        <div class="mt-10">
            <a href="{{ route('case-studies') }}" class="btn-ghost">← Back to Case Studies</a>
        </div>
    </div>
</article>
@endsection
