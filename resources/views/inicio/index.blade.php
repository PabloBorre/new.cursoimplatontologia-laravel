@extends('layouts.public')

@section('title', 'Implantex Academy - Dental Implant & Implantology Training Programs')
@section('meta_description', 'Join Implantex Academy for hands-on dental implantology courses in Havana and Lima. Over 30 years training 5,000+ dentists worldwide. PACE & ADA CERP accredited programs with live patient practice.')
@section('canonical', url('/'))
@section('og_title', 'Implantex Academy - Dental Implant & Implantology Training Programs')
@section('og_description', 'Hands-on dental implantology courses with live patient training. PACE & ADA CERP accredited programs in Havana and Lima. Over 30 years of experience.')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "EducationalOrganization",
    "name": "Implantex Academy",
    "description": "Dental implantology courses and oral surgery training programs for dentists worldwide. Over 30 years of experience training professionals.",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('images/logo-implantex-blanco.png') }}",
    "telephone": "+1-786-382-7805",
    "email": "info@cursodeimplantologia.com",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "Miami",
        "addressRegion": "FL",
        "addressCountry": "US"
    },
    "hasCredential": [
        {
            "@type": "EducationalOccupationalCredential",
            "credentialCategory": "Accreditation",
            "recognizedBy": {
                "@type": "Organization",
                "name": "PACE - Academy of General Dentistry"
            }
        },
        {
            "@type": "EducationalOccupationalCredential",
            "credentialCategory": "Accreditation",
            "recognizedBy": {
                "@type": "Organization",
                "name": "ADA CERP"
            }
        }
    ],
    "sameAs": []
}
</script>
@endsection

@section('content')
<main>
    <!-- HERO -->
    <section class="hero hero--video">
        <div class="hero-background">
            <img src="{{ asset('images/hero-bg.webp') }}" alt="Dental implantology training session at Implantex Academy" class="hero-bg-image hero-bg-fallback">
            <div class="hero-video-container" id="hero-video-container">
                <div id="hero-video-player"></div>
            </div>
            <div class="hero-overlay"></div>
            <img src="{{ asset('images/flecha-blanca.svg') }}" alt="" class="hero-arrow">
        </div>
        <div class="hero-content">
            <h1><span>Dental Implant</span> <br>Programs &<br><span>Implantology</span> Programs</h1>
            <div class="hero-logos">
                <img src="{{ asset('images/logo-pace.png') }}" alt="PACE - Academy of General Dentistry">
                <img src="{{ asset('images/logo-adi.png') }}" alt="ADI - Association of Dental Implantology">
                <img src="{{ asset('images/logo-ada-cerp.png') }}" alt="ADA CERP">
            </div>
        </div>
    </section>

    <!-- UBICACIÓN - LA HABANA -->
    <section class="location">
        <div class="location-image-container">
            <div class="location-image-wrapper">
                <img src="{{ asset('images/habana.webp') }}" alt="La Habana, Cuba" class="location-image">
            </div>
            <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="location-arrow location-arrow-filled">
            <img src="{{ asset('images/flecha-blanca.svg') }}" alt="" class="location-arrow location-arrow-outline">
        </div>
        <div class="location-content">
            <p class="location-subtitle">You will take the course in<br> a paradisiacal environment</p>
            <h2 class="location-title">Havana</h2>
        </div>
    </section>

    <!-- UBICACIÓN INVERTIDA -->
    <section class="location location--reversed">
        <div class="location-content">
            <p class="location-subtitle">You will take the course in<br> a paradisiacal environment</p>
            <h2 class="location-title">Lima</h2>
        </div>
        <div class="location-image-container">
            <div class="location-image-wrapper">
                <img src="{{ asset('images/lima.webp') }}" alt="Lima" class="location-image">
            </div>
            <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="location-arrow location-arrow-filled">
            <img src="{{ asset('images/flecha-blanca.svg') }}" alt="" class="location-arrow location-arrow-outline">
        </div>
    </section>

    <!-- ESTADÍSTICAS -->
    <section class="stats">
        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-arrows">
                    <img src="{{ asset('images/flecha-oscura-rellena.svg') }}" alt="" class="stat-arrow">
                </div>
                <span class="stat-number">+200</span>
                <span class="stat-text">Programs<br>delivered</span>
            </div>
            <div class="stat-item">
                <div class="stat-arrows">
                    <img src="{{ asset('images/flecha-oscura-rellena.svg') }}" alt="" class="stat-arrow">
                </div>
                <span class="stat-number">30</span>
                <span class="stat-text">years<br>training</span>
            </div>
            <div class="stat-item">
                <div class="stat-arrows">
                    <img src="{{ asset('images/flecha-oscura-rellena.svg') }}" alt="" class="stat-arrow">
                </div>
                <span class="stat-number">+2000</span>
                <span class="stat-text">trained<br>professionals</span>
            </div>
            <div class="stat-item">
                <div class="stat-arrows">
                    <img src="{{ asset('images/flecha-oscura-rellena.svg') }}" alt="" class="stat-arrow">
                </div>
                <span class="stat-number">15</span>
                <span class="stat-text">qualified<br>instructors</span>
            </div>
        </div>
    </section>

    <!-- EQUIPO DOCENTE -->
    <section class="team">
        <div class="team-container">
            <div class="team-content">
                <p class="team-text">
                    <strong>Programs that transfer the extensive experience of the teaching team:</strong>
                    you will learn from the successes and mistakes of industry leaders to
                    start your own path to success
                    with the strongest foundation.
                </p>
                <a href="{{ url('docentes') }}" class="team-btn">Meet your<br>future instructors</a>
            </div>
            <div class="team-image">
                <img src="{{ asset('images/equipo-docente.webp') }}" alt="Implantex Academy teaching team during a training session">
            </div>
        </div>
    </section>

    <!-- CURSOS DE IMPLANTOLOGÍA -->
    <section class="courses">
        <div class="courses-bg"></div>
        <div class="courses-container">
            <div class="courses-left">
                <h2 class="courses-title">Implantology Programs
                <div class="courses-image-1">
                    <img src="{{ asset('images/curso-implantologia-1.webp') }}" alt="Dental implantology course - hands-on surgical training">
                </div>
                <ul class="courses-list">
                    <li>
                        <span>Place 20 implants and assist in the placement of another 20, in all areas of the mouth</span>
                        <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="courses-list-arrow">
                    </li>
                    <li>
                        <span>Learn how to diagnose, plan, and treat all types of patients</span>
                        <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="courses-list-arrow">
                    </li>
                    <li>
                        <span>Work with patients with single, partial, and total edentulism</span>
                        <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="courses-list-arrow">
                    </li>
                    <li>
                        <span>We train you in cases with different degrees of bone resorption and varying <br>levels of difficulty</span>
                        <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="courses-list-arrow">
                    </li>
                </ul>
            </div>
            <div class="courses-right">
                <div class="courses-text-block">
                    <p class="courses-text">
                        You will attend <strong>highly practical programs</strong> where you will learn to diagnose, plan, and treat implantology and oral surgery cases of varying levels of complexity.
                    </p>
                    <p class="courses-text">
                        You will gain <strong>confidence and the ability to independently solve</strong> all types of cases in your clinic.
                    </p>
                </div>
                <div class="courses-image-2">
                    <img src="{{ asset('images/curso-implantologia-2.webp') }}" alt="Students practicing dental implant placement">
                </div>
                <a href="{{ url('contacto') }}" class="courses-btn">More information</a>
            </div>
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
                <strong>Don't waste your time</strong><br>
                on the many theoretical programs<br>
                in implantology or oral <br>
                surgery that are offered,<br>
                where you don't place<br>
                a single implant
            </p>
        </div>
    </section>

    <!-- FORMULARIO DE CONTACTO -->
    <section class="contact-form-section">
        <div class="contact-form-section__container">
            <div class="contact-form-section__left">
                <h2 class="contact-form-section__title">Any questions?</h2>
                <livewire:contact-form />
            </div>

            <div class="contact-form-section__right">
                <div class="contact-form-section__image-wrapper">
                    <img src="{{ asset('images/lima-contacto.webp') }}" alt="Lima, Peru - Implantex Academy course location" class="contact-form-section__image contacto-home">
                </div>
                <p class="contact-form-section__caption">
                    Interested in taking our implantology programs,<br>
                    but can't attend in person?
                </p>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<!-- YouTube IFrame API -->
<script>
const heroVideoConfig = {
    videoId: 'ZvTQKws9JM0',
    startSeconds: 0,
    endSeconds: 0
};

let tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
let firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

let heroPlayer;

function onYouTubeIframeAPIReady() {
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent);

    if (isIOS) {
        document.querySelector('.hero-bg-fallback').style.display = 'block';
        return;
    }

    heroPlayer = new YT.Player('hero-video-player', {
        videoId: heroVideoConfig.videoId,
        playerVars: {
            'autoplay': 1,
            'mute': 1,
            'controls': 0,
            'showinfo': 0,
            'rel': 0,
            'loop': 1,
            'playlist': heroVideoConfig.videoId,
            'playsinline': 1,
            'disablekb': 1,
            'modestbranding': 1,
            'iv_load_policy': 3,
            'fs': 0,
            'start': heroVideoConfig.startSeconds || 0
        },
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange,
            'onError': onPlayerError
        }
    });
}

function onPlayerReady(event) {
    event.target.mute();
    event.target.playVideo();

    setTimeout(function() {
        const fallback = document.querySelector('.hero-bg-fallback');
        const videoContainer = document.getElementById('hero-video-container');

        if (fallback && videoContainer) {
            fallback.style.opacity = '0';
            videoContainer.classList.add('video-ready');
            setTimeout(function() {
                fallback.style.display = 'none';
            }, 500);
        }
    }, 1000);
}

function onPlayerStateChange(event) {
    if (event.data === YT.PlayerState.ENDED) {
        event.target.playVideo();
    }
    if (event.data === YT.PlayerState.PAUSED) {
        event.target.playVideo();
    }
}

function onPlayerError(event) {
    console.log('Error en video de YouTube:', event.data);
    const fallback = document.querySelector('.hero-bg-fallback');
    if (fallback) {
        fallback.style.display = 'block';
        fallback.style.opacity = '1';
    }
}

document.addEventListener('visibilitychange', function() {
    if (heroPlayer && heroPlayer.getPlayerState) {
        if (document.hidden) {
            heroPlayer.pauseVideo();
        } else {
            heroPlayer.playVideo();
        }
    }
});
</script>
@endpush