@extends('layouts.public')

@section('title', 'Our Programs - Dental Implantology Courses | Implantex Academy')
@section('meta_description', 'Browse Implantex Academy dental implantology programs from beginner to advanced. Hands-on training with live patients in Havana and Lima. Accredited certifications included.')
@section('og_title', 'Dental Implantology Programs | Implantex Academy')
@section('og_description', 'Dental implantology programs from beginner to advanced. Hands-on training with live patients and accredited certifications included.')



@section('content')
<!-- HERO PÁGINA INTERIOR -->
<section class="page-hero">
    <div class="page-hero__background">
        <img src="{{ asset('images/operacion-fondo-nuestros-cursos.webp') }}" alt="Dental implantology programs at Implantex Academy" class="page-hero__image">
        <div class="page-hero__overlay"></div>
        <img src="{{ asset('images/flecha-blanca.svg') }}" alt="" class="hero-arrow">
    </div>
    <div class="page-hero__content">
        <h1 class="page-hero__title">Our Programs</h1>
    </div>
</section>

<!-- LISTADO DE CURSOS -->
<section class="courses-list">

    @foreach($courses as $index => $course)
        @php
            $isLeftLayout = ($index % 2 === 0);
            $layoutClass = $isLeftLayout ? 'course-card--left' : 'course-card--right';

            $titleParts = explode(' - ', $course->title);
            $mainTitle = $titleParts[0] ?? $course->title;

            $titleWords = explode(' ', $mainTitle);
            $formattedTitle = count($titleWords) > 1
                ? $titleWords[0] . '<br>' . implode(' ', array_slice($titleWords, 1))
                : $mainTitle;
        @endphp

        @if($isLeftLayout)
        <!-- Curso: Imagen izquierda, texto derecha -->
        <article class="course-card {{ $layoutClass }}">
            <div class="course-card__bg course-card__bg--white"></div>
            <div class="course-card__bg course-card__bg--light"></div>

            <div class="course-card__wrapper">
                <div class="course-card__image-side">
                    <div class="course-card__image-box">
                        <img src="{{ asset($course->content_image ?? 'images/operacion-imagen-docentes.webp') }}" alt="{{ $course->title }}" class="course-card__image">
                    </div>
                    <div class="course-card__arrows">
                        <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="course-card__arrow course-card__arrow--filled">
                        <img src="{{ asset('images/flecha-azul-claro.svg') }}" alt="" class="course-card__arrow course-card__arrow--outline">
                    </div>
                </div>
                <div class="course-card__content">
                    <span class="course-card__level">Level {{ $course->level }}</span>
                    <h2 class="course-card__title">{!! $formattedTitle !!}</h2>
                    <p class="course-card__subtitle">{{ $course->subtitle ?? 'Course' }}</p>
                    <a href="{{ url('courses/' . $course->slug) }}" class="course-card__btn">More information</a>
                </div>
            </div>
        </article>

        @else
        <!-- Curso: Texto izquierda, imagen derecha -->
        <article class="course-card {{ $layoutClass }}">
            <div class="course-card__bg course-card__bg--white"></div>
            <div class="course-card__bg course-card__bg--light"></div>

            <div class="course-card__wrapper">
                <div class="course-card__content">
                    <span class="course-card__level">Level {{ $course->level }}</span>
                    <h2 class="course-card__title">{!! $formattedTitle !!}</h2>
                    <p class="course-card__subtitle">{{ $course->subtitle ?? 'Course' }}</p>
                    <a href="{{ url('courses/' . $course->slug) }}" class="course-card__btn">More information</a>
                </div>
                <div class="course-card__image-side">
                    <div class="course-card__arrows" style="z-index: 2;">
                        <img src="{{ asset('images/flecha-azul-claro.svg') }}" alt="" class="course-card__arrow course-card__arrow--outline">
                        <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="course-card__arrow course-card__arrow--filled">
                    </div>
                    <div class="course-card__image-box" style="z-index: 1;">
                        <img src="{{ asset($course->content_image ?? 'images/sala-2-curso.webp') }}" alt="{{ $course->title }}" class="course-card__image">
                    </div>
                </div>
            </div>
        </article>
        @endif

    @endforeach

</section>

<!-- NO PIERDAS TU TIEMPO -->
<section class="no-time">
    <div class="no-time-container">
        <div class="no-time-arrow">
            <img src="{{ asset('images/flecha-azul-claro.svg') }}" alt="" class="no-time-arrow-filled">
            <img src="{{ asset('images/flecha-azul-claro.svg') }}" alt="" class="no-time-arrow-outline">
        </div>
        <p class="no-time-text">
            We tailor the program to each participant’s needs.        
        </p>
    </div>
</section>

<!-- GALLERY - OUR PRACTICAL CLASSES -->
<section class="gallery-section">
    <div class="gallery-container">
        <h2 class="gallery-title">Our practical classes</h2>

        <div class="swiper gallery-slider">
            <div class="swiper-wrapper">
                @php
                    $gallery = [
                        ['image' => 'fiesta-del-curso.webp', 'alt' => 'Course celebration'],
                        ['image' => 'equipo-docente.webp', 'alt' => 'Teaching team'],
                        ['image' => 'diplomas-durante-la-fiesta.webp', 'alt' => 'Diploma ceremony'],
                        ['image' => 'charla-implantex.webp', 'alt' => 'Implantex lecture'],
                        ['image' => 'sala-2-curso.webp', 'alt' => 'Course classroom'],
                        ['image' => 'operacion-implantex-curso.webp', 'alt' => 'Implant surgery practice'],
                        ['image' => 'operacion-implantex-curso-3.webp', 'alt' => 'Hands-on surgical training'],
                    ];
                @endphp

                @foreach($gallery as $item)
                    <div class="swiper-slide">
                        <a href="{{ asset('images/' . $item['image']) }}" class="gallery-link glightbox" data-gallery="gallery1" data-description="{{ $item['alt'] }}">
                            <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['alt'] }}" class="gallery-image">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="gallery-pagination"></div>
    </div>
</section>

<!-- NO PIERDAS TU TIEMPO -->
<section class="no-time">
    <div class="no-time-container">
        <div class="no-time-arrow">
            <img src="{{ asset('images/flecha-azul-claro.svg') }}" alt="" class="no-time-arrow-filled">
            <img src="{{ asset('images/flecha-azul-claro.svg') }}" alt="" class="no-time-arrow-outline">
        </div>
        <p class="no-time-text">
            With our Implantology programs, you will have access to the knowledge of a teaching team with more than 30 years of experience, who will train you both theoretically and practically so you can apply what you've learned with complete autonomy.
        </p>
    </div>
</section>

<!-- CALENDARIO -->
@include('cursos.calendar')

<!-- FORMULARIO DE CONTACTO -->
<section class="contact-form-section">
    <div class="contact-form-section__container">
        <div class="contact-form-section__left">
            <h2 class="contact-form-section__title">Any questions?</h2>
            <livewire:contact-form />
        </div>

        <div class="contact-form-section__right">
            <div class="contact-form-section__image-wrapper">
                <img src="{{ asset('images/habana-contacto.webp') }}" alt="Havana, Cuba" class="contact-form-section__image">
            </div>
            <p class="contact-form-section__caption">
                Interested in taking our implantology programs,<br>
                but can't attend in person?
            </p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const gallerySlider = new Swiper('.gallery-slider', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        grabCursor: true,
        centeredSlides: false,
        navigation: {
            nextEl: '.gallery-nav-next',
            prevEl: '.gallery-nav-prev',
        },
        pagination: {
            el: '.gallery-pagination',
            clickable: true,
        },
        breakpoints: {
            480: { slidesPerView: 2, spaceBetween: 15 },
            768: { slidesPerView: 3, spaceBetween: 20 },
            1024: { slidesPerView: 4, spaceBetween: 25 },
            1400: { slidesPerView: 4, spaceBetween: 30 },
        },
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
    });

    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        closeButton: true,
    });
});
</script>
@endpush