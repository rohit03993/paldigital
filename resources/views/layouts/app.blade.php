<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <meta name="theme-color" content="#050505">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="{{ \App\Models\SiteSetting::get('site_name', 'Pal Digital') }}">
    <meta name="format-detection" content="telephone=no">

    <title>{{ $seoData->title }}</title>
    <meta name="description" content="{{ $seoData->description }}">

    @include('partials.seo-head')

    <link rel="manifest" href="/manifest.json">

    @php $favicon = \App\Models\SiteSetting::asset('site_favicon'); @endphp
    @if($favicon)
        <link rel="icon" href="{{ $favicon }}" type="image/png">
        <link rel="apple-touch-icon" href="{{ $favicon }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Inter:ital,opsz,wght@0,14..32,400;0,14..32,500;0,14..32,600;0,14..32,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen flex flex-col mobile-app"
      x-data="{ mobileMenu: false, mobileSheet: false, demoOpen: {{ session('demo_success') || $errors->any() ? 'true' : 'false' }} }">

    @include('partials.header')

    <main class="flex-1 mobile-main">
        @if(session('success'))
            <div class="fixed top-16 lg:top-20 right-4 z-50 bg-pal-yellow text-pal-black px-5 py-3 rounded-xl shadow-lg font-medium text-sm safe-top" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.mobile-bottom-nav')
    @include('partials.mobile-menu-sheet')
    @include('partials.whatsapp-button')
    @include('partials.pwa-install')
    @include('partials.demo-modal')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
