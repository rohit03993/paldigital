@php
    $siteName = \App\Models\SiteSetting::get('site_name', 'Pal Digital');
@endphp

@if($seoData->author)
    <meta name="author" content="{{ $seoData->author }}">
@endif

<link rel="canonical" href="{{ $seoData->canonical }}">
<meta name="robots" content="{{ $seoData->noindex ? 'noindex,nofollow' : 'index,follow,max-image-preview:large' }}">

@if($seoData->keywords)
    <meta name="keywords" content="{{ $seoData->keywords }}">
@endif

<meta property="og:locale" content="en_IN">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:type" content="{{ $seoData->type }}">
<meta property="og:title" content="{{ $seoData->title }}">
<meta property="og:description" content="{{ $seoData->description }}">
<meta property="og:url" content="{{ $seoData->canonical }}">
@if($seoData->image)
    <meta property="og:image" content="{{ $seoData->image }}">
    <meta property="og:image:alt" content="{{ $seoData->imageAlt ?? $seoData->title }}">
@endif

<meta name="twitter:card" content="{{ $seoData->image ? 'summary_large_image' : 'summary' }}">
<meta name="twitter:title" content="{{ $seoData->title }}">
<meta name="twitter:description" content="{{ $seoData->description }}">
@if($seoData->image)
    <meta name="twitter:image" content="{{ $seoData->image }}">
@endif

@if($seoData->jsonLd)
    <script type="application/ld+json">{!! json_encode($seoData->jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif
