<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO: Title & Description --}}
    <title>@yield('title', 'Implantex Academy - Dental Implantology Courses & Training Programs')</title>
    <meta name="description" content="@yield('meta_description', 'Dental implantology courses and oral surgery training for dentists. Over 30 years of experience training professionals worldwide. Hands-on programs in Havana & Lima.')">

    {{-- SEO: Canonical URL --}}
    <link rel="canonical" href="@yield('canonical', url()->current())">

    {{-- SEO: Open Graph (Facebook, LinkedIn, WhatsApp) --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', 'Implantex Academy - Dental Implantology Courses')">
    <meta property="og:description" content="@yield('og_description', 'Dental implantology courses and oral surgery training for dentists. Over 30 years of experience training professionals worldwide.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:site_name" content="Implantex Academy">
    <meta property="og:locale" content="en_US">

    {{-- SEO: Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Implantex Academy - Dental Implantology Courses')">
    <meta name="twitter:description" content="@yield('og_description', 'Dental implantology courses and oral surgery training for dentists. Over 30 years of experience.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    {{-- SEO: Robots --}}
    <meta name="robots" content="@yield('robots', 'index, follow')">

    {{-- SEO: Structured Data (JSON-LD) --}}
    @if(View::hasSection('schema'))
        @yield('schema')
    @else
        @php
        $defaultSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'EducationalOrganization',
        'name' => 'Implantex Academy',
        'description' => 'Dental implantology courses and oral surgery training programs for dentists worldwide.',
        'url' => url('/'),
        'logo' => asset('images/logo-implantex-blanco.png'),
        'telephone' => '+1-786-382-7805',
        'email' => 'info@cursodeimplantologia.com',
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Miami',
            'addressRegion' => 'FL',
            'addressCountry' => 'US',
        ],
        'sameAs' => [],
        ];
        @endphp

        <script type="application/ld+json">{!! json_encode($defaultSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    @endif

    @stack('schema_extra')

    {{-- Stylesheets --}}
    <link rel="stylesheet" href="{{ asset('styles/style.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/calendar.css') }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('icon/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('icon/apple-touch-icon.png') }}">

    {{-- External CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">

    {{-- Preconnect for performance --}}
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">

    @stack('styles')

    {{-- Google Analytics 4 --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-J93B0GL4PF"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-J93B0GL4PF');
    </script>
</head>
<body>

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    @stack('scripts')

</body>
</html>