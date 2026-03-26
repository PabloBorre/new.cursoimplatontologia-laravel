@extends('layouts.public')

@section('title', $course->title . ' - Implantex Academy')
@section('meta_description', $course->meta_description ?? 'Enroll in ' . $course->title . ' at Implantex Academy. Hands-on dental implantology training with live patients, expert instructors, and accredited certification.')
@section('og_title', $course->title . ' | Implantex Academy')
@section('og_description', $course->meta_description ?? 'Enroll in ' . $course->title . '. Hands-on dental implantology training with live patients and accredited certification.')
@section('og_type', 'product')

@php
$schema = [
  '@context' => 'https://schema.org',
  '@type' => 'Course',
  'name' => $course->title,
  'description' => $course->meta_description
    ?? $course->subtitle
    ?? 'Dental implantology training course at Implantex Academy',
  'provider' => [
    '@type' => 'EducationalOrganization',
    'name' => 'Implantex Academy',
    'url' => url('/'),
  ],
  'url' => url()->current(),
  'educationalLevel' => 'Professional',
  'inLanguage' => 'en',
];

if (!empty($course->price)) {
  $schema['offers'] = [
    '@type' => 'Offer',
    'price' => (string) $course->price,
    'priceCurrency' => 'EUR',
    'availability' => 'https://schema.org/InStock',
    'url' => url()->current(),
  ];
}

$instances = [];
foreach ($courseDates->flatten() as $date) {
  $instance = [
    '@type' => 'CourseInstance',
    'courseMode' => 'onsite',
    'location' => [
      '@type' => 'Place',
      'name' => (string) ($date->location ?? ''),
    ],
  ];

  if (!empty($date->start_date)) {
    $instance['startDate'] = $date->start_date->toDateString();
  }
  if (!empty($date->end_date)) {
    $instance['endDate'] = $date->end_date->toDateString();
  }

  $instances[] = $instance;
}

$schema['hasCourseInstance'] = $instances;
@endphp

@push('schema')
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

@section('content')
<!-- HERO PÁGINA INTERIOR -->
<section class="page-hero">
    <div class="page-hero__background">
        <img src="{{ asset($course->hero_image ?? 'images/operacion-fondo-nuestros-cursos.webp') }}" alt="{{ $course->title }} - Implantex Academy" class="page-hero__image">
        <div class="page-hero__overlay"></div>
        <img src="{{ asset('images/flecha-blanca.svg') }}" alt="" class="hero-arrow">
    </div>
    <div class="page-hero__content">
        <h1 class="page-hero__title">{!! $course->title !!}</h1>    
    </div>
</section>

<!-- CONTENIDO DEL CURSO -->
<section class="course-detail">
    <div class="course-detail__bg-stripe"></div>

    <div class="course-detail__container">
        <!-- Columna izquierda: Información del curso -->
        <div class="course-detail__info">

            @if(!empty($course->features))
            <div class="course-detail__block">
                <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="course-detail__block-arrow">
                <div class="course-detail__block-content">
                    <p>{{ implode(', ', array_map('lcfirst', $course->features)) }}.</p>
                </div>
            </div>
            @endif

            @if(!empty($course->includes))
            <div class="course-detail__block">
                <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="course-detail__block-arrow">
                <div class="course-detail__block-content">
                    <p>Additionally, you will have access to {{ strtolower(implode(', ', $course->includes)) }}.</p>
                </div>
            </div>
            @endif

            <div class="course-detail__block">
                <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="course-detail__block-arrow">
                <div class="course-detail__block-content">
                    <p>The course lasts {{ $course->duration_days ?? 5 }} days and includes all necessary materials and certifications.</p>
                </div>
            </div>

            <div class="course-detail__block">
                <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="course-detail__block-arrow">
                <div class="course-detail__block-content">
                    <p>Hands-on training with live patients: perform and assist in real clinical cases under close faculty supervision, covering surgical extractions, flap & suture techniques, and pre-/post-op clinical sessions across a 5-day program (materials + certification included).</p>
                </div>
            </div>

        </div>

        <!-- Columna derecha: Imagen + Precio -->

        <div class="course-detail__sidebar">
            <div class="course-detail__image-box">
                <img src="{{ asset($course->content_image ?? 'images/operacion-imagen-docentes.webp') }}" alt="{{ $course->title }}" class="course-detail__image">
            </div>

            @auth
                @if(auth()->user()->isStudent() && auth()->user()->isEnrolledIn($course->id))
                    <div class="course-detail__price-box course-detail__price-box--enrolled">
                        <span class="course-detail__price">Already Enrolled</span>
                    </div>
                @else
                    <form action="{{ route('student.checkout', $course) }}" method="POST">
                        @csrf
                        <button type="submit" class="course-detail__price-box course-detail__price-box--btn">
                            <span class="course-detail__price">{{ \App\Models\Course::formatPrice($course->price, $course->currency) }} Reserve</span>
                        </button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}" class="course-detail__price-box course-detail__price-box--btn">
                    <span class="course-detail__price">Check Price</span>
                </a>
            @endauth
        </div>
    </div>
</section>

<!-- FECHAS DEL CURSO -->
@if($courseDates->isNotEmpty())
<section class="course-dates">
    <div class="course-dates__container">
        <h2 class="course-dates__title">Upcoming Dates</h2>

        <div class="course-dates__grid">
            @foreach($courseDates as $location => $dates)
            <div class="course-dates__location">
                <h3 class="course-dates__location-name">
                    <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="course-dates__arrow">
                    {{ $location }}
                </h3>
                <ul class="course-dates__list">
                    @foreach($dates as $date)
                    <li class="course-dates__item">
                        <span class="course-dates__date">
                            {{ \App\Models\CourseDate::formatDateRange($date->start_date, $date->end_date) }}
                        </span>
                        @if($date->spots_available > 0)
                            <span class="course-dates__spots">SPOTS AVAILABLE</span>
                        @else
                            <span class="course-dates__spots course-dates__spots--full">Full</span>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>

        <div class="course-dates__cta">
            <a href="{{ url('contact') }}" class="course-dates__btn">Reserve your spot</a>
        </div>
    </div>
</section>
@endif

<!-- CURSO PARA AUXILIARES -->
@if($auxiliaryCourse)
<section class="auxiliary-course">
    <div class="auxiliary-course__container">
        <div class="auxiliary-course__arrows">
            <img src="{{ asset('images/flecha-azul-muy-claro-rellena.svg') }}" alt="" class="auxiliary-course__arrow auxiliary-course__arrow--light">
            <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="auxiliary-course__arrow auxiliary-course__arrow--main">
        </div>

        <div class="auxiliary-course__content">
            <h2 class="auxiliary-course__title">{{ $auxiliaryCourse->title }}</h2>
            <p class="auxiliary-course__text">{{ $auxiliaryCourse->description }}</p>
            <a href="{{ url('contact') }}" class="auxiliary-course__btn">Any questions?</a>
        </div>
    </div>
</section>
@endif

<!-- GALLERY - TESTIMONIAL VIDEOS -->
<section class="gallery-section">
    <div class="gallery-container">
        <h2 class="gallery-title">Testimonials</h2>

        <div class="swiper gallery-slider">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="gallery-video-card" data-video="{{ asset($testimonial->video_path) }}">
                            <div class="gallery-video-card__thumbnail">
                                <img
                                    src="{{ asset($testimonial->image_path) }}"
                                    alt="Testimonio de {{ $testimonial->name }}"
                                    class="gallery-image"
                                    loading="lazy"
                                >
                                <div class="gallery-video-card__play">
                                    <svg width="50" height="50" viewBox="0 0 60 60" fill="none">
                                        <circle cx="30" cy="30" r="30" fill="rgba(255,255,255,0.85)"/>
                                        <path d="M42 30L24 40.3923V19.6077L42 30Z" fill="#1a1a2e"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="gallery-video-card__info">
                                <span class="gallery-video-card__name">{{ $testimonial->name }}</span>
                                <span class="gallery-video-card__country">{{ $testimonial->country }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="gallery-pagination"></div>
    </div>
</section>

<!-- Video Modal -->
<div id="gallery-video-modal" class="video-modal" style="display: none;">
    <div class="video-modal__overlay"></div>
    <div class="video-modal__content">
        <button class="video-modal__close" aria-label="Close video">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M18 6L6 18M6 6L18 18" stroke="white" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
        <video id="gallery-modal-video" controls>
            <source src="" type="video/mp4">
        </video>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const gallerySlider = new Swiper('.gallery-slider', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        grabCursor: true,
        pagination: {
            el: '.gallery-pagination',
            clickable: true,
        },
        breakpoints: {
            480: { slidesPerView: 2, spaceBetween: 15 },
            768: { slidesPerView: 3, spaceBetween: 20 },
            1024: { slidesPerView: 4, spaceBetween: 25 },
        },
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
    });

    // Video modal
    const modal = document.getElementById('gallery-video-modal');
    const modalVideo = document.getElementById('gallery-modal-video');
    const videoCards = document.querySelectorAll('.gallery-video-card');

    videoCards.forEach(card => {
        card.addEventListener('click', function() {
            const videoSrc = this.dataset.video;
            modalVideo.querySelector('source').src = videoSrc;
            modalVideo.load();
            modal.style.display = 'flex';
            modalVideo.play();
        });
    });

    // Cerrar modal
    modal.querySelector('.video-modal__overlay').addEventListener('click', closeModal);
    modal.querySelector('.video-modal__close').addEventListener('click', closeModal);

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });

    function closeModal() {
        modalVideo.pause();
        modalVideo.currentTime = 0;
        modal.style.display = 'none';
    }
});
</script>
@endpush