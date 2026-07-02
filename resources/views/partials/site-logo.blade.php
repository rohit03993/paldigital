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
        width="200"
        height="56"
        decoding="async"
        fetchpriority="high"
    >
@endif
