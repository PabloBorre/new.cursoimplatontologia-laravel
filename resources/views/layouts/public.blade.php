<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Implantex Academy - Cursos de Implantología')</title>
    <meta name="description" content="@yield('meta_description', 'Cursos de implantología y cirugía oral para odontólogos. Más de 30 años de experiencia formando profesionales.')">
    <link rel="stylesheet" href="{{ asset('styles/style.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/calendar.css') }}">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('icon/favicon.ico') }}">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <!-- GLightbox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
    @stack('styles')
</head>
<body>

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    @stack('scripts')

</body>
</html>