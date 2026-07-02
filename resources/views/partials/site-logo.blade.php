@php
    $variant = $variant ?? 'header';
    $logo = $logo ?? \App\Models\SiteSetting::asset('site_logo');
    $siteName = $siteName ?? \App\Models\SiteSetting::get('site_name', 'Pal Digital');
@endphp

@if($logo)
    @if($variant === 'header')
        <span class="site-logo-wrap site-logo-wrap--header">
            <img
                src="{{ $logo }}"
                alt="{{ $siteName }}"
                class="site-logo site-logo--header"
                width="64"
                height="64"
                decoding="async"
                fetchpriority="high"
            >
        </span>
    @else
        <img
            src="{{ $logo }}"
            alt="{{ $siteName }}"
            class="site-logo site-logo--{{ $variant }}"
            width="200"
            height="56"
            decoding="async"
        >
    @endif
@endif
