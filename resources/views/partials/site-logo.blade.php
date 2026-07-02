@php
    $variant = $variant ?? 'header';
    $logo = $logo ?? \App\Models\SiteSetting::asset('site_logo');
    $siteName = $siteName ?? \App\Models\SiteSetting::get('site_name', 'Pal Digital');
@endphp

@if($logo)
    <img
        src="{{ $logo }}"
        alt="{{ $siteName }}"
        class="site-logo site-logo--{{ $variant }}"
        decoding="async"
        @if($variant === 'header') fetchpriority="high" @endif
    >
@endif
