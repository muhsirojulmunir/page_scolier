@php
    use App\Support\Locales;

    $locale = Locales::current();
    $meta = Locales::meta($locale);
@endphp
<!DOCTYPE html>
<html lang="{{ $meta['html'] }}" dir="{{ $meta['dir'] }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <title>@yield('title', __('site.meta.title'))</title>
    <meta name="description" content="@yield('description', __('site.meta.description'))">
    <meta name="theme-color" content="#0d2036">
    <link rel="canonical" href="{{ Locales::url($locale) }}">

    {{-- Beri tahu mesin pencari versi bahasa lain dari halaman yang sama --}}
    @foreach (Locales::options() as $alt)
        <link rel="alternate" hreflang="{{ $alt['code'] }}" href="{{ $alt['url'] }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ Locales::url(Locales::DEFAULT) }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:locale" content="{{ str_replace('-', '_', $meta['html']) }}">
    <meta property="og:site_name" content="{{ config('scolier.brand.name') }}">
    <meta property="og:title" content="@yield('title', __('site.meta.title'))">
    <meta property="og:description" content="{{ __('site.meta.og_description') }}">
    <meta property="og:url" content="{{ Locales::url($locale) }}">
    <meta property="og:image" content="{{ asset('img/og-image.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Logo Scolier — Where Students Become Global">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ asset('img/og-image.png') }}">

    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" sizes="512x512">
    <link rel="apple-touch-icon" href="{{ asset('img/favicon.png') }}">

    {{-- Font: preconnect + display=swap agar teks tidak tak terlihat saat memuat --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >
    @if ($locale === 'ja')
        {{-- Hanya dimuat untuk bahasa Jepang: font Latin di atas tidak punya glif CJK --}}
        <link
            href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Noto+Serif+JP:wght@500;600;700&display=swap"
            rel="stylesheet"
        >
    @endif

    {{-- Tandai bahwa JS aktif sebelum paint pertama, supaya keadaan awal
         animasi hanya dipasang bila animasi memang akan dijalankan. --}}
    <script>document.documentElement.classList.add('js');</script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>

<body class="min-h-dvh bg-paper text-ink antialiased">
    <a
        href="#konten"
        class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-full focus:bg-navy-900 focus:px-5 focus:py-3 focus:text-sm focus:font-semibold focus:text-white"
    >{{ __('site.a11y.skip') }}</a>

    {{-- Indikator progres baca --}}
    <div class="pointer-events-none fixed inset-x-0 top-0 z-[90] h-[3px]" aria-hidden="true">
        <div
            data-scroll-progress
            class="h-full origin-left scale-x-0 bg-gradient-to-r from-gold-600 via-gold-400 to-gold-300"
        ></div>
    </div>

    @include('partials.nav')

    <main id="konten">
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.wa-float')
    @include('partials.lightbox')

    @stack('scripts')
</body>
</html>
