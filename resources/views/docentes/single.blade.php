@extends('layouts.public')

@section('title', $doctor->full_name . ' - Instructor | Implantex Academy')
@section('meta_description', 'Learn about ' . $doctor->full_name . ($doctor->role_title ? ', ' . $doctor->role_title : '') . ' at Implantex Academy. Expert in dental implantology and oral surgery training.')
@section('og_title', $doctor->full_name . ' | Implantex Academy Instructor')
@section('og_description', 'Meet ' . $doctor->full_name . ', expert dental implantology instructor at Implantex Academy.')
@section('og_type', 'profile')

@php
$schema = [
  '@context' => 'https://schema.org',
  '@type' => 'Person',
  'name' => $doctor->full_name,
  'worksFor' => [
    '@type' => 'EducationalOrganization',
    'name' => 'Implantex Academy',
    'url' => url('/'),
  ],
  'url' => url()->current(),
  'knowsAbout' => ['Dental Implantology', 'Oral Surgery', 'Dental Education'],
];

if (!empty($doctor->role_title)) {
  $schema['jobTitle'] = $doctor->role_title;
}

if (!empty($doctor->image_path)) {
  $schema['image'] = asset($doctor->image_path);
}
@endphp

@push('schema')
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

@section('content')
<!-- HERO PÁGINA INTERIOR -->
<section class="page-hero">
    <div class="page-hero__background">
        <img src="{{ asset('images/fondo-docentes-interior.webp') }}" alt="{{ $doctor->full_name }}" class="page-hero__image">
        <div class="page-hero__overlay"></div>
        <img src="{{ asset('images/flecha-blanca.svg') }}" alt="" class="hero-arrow">
    </div>
    <div class="page-hero__content">
        <h1 class="page-hero__title">{{ $doctor->full_name }}</h1>
    </div>
</section>

<!-- CONTENIDO DEL DOCENTE -->
<section class="doctor-detail">
    <div class="doctor-detail__bg-stripe"></div>

    <div class="doctor-detail__container">
        <!-- Columna izquierda: Información del doctor -->
        <div class="doctor-detail__info">

            @php
                $sections = [
                    'studies' => 'Studies',
                    'other_studies' => 'Other Studies',
                    'titles' => 'Titles',
                    'teaching_activity' => 'Teaching Activity',
                    'teaching_category' => 'Teaching Category',
                    'clinical_research' => 'Clinical Research',
                    'patents' => 'Patents',
                    'publications' => 'Publications',
                    'presentations' => 'Presentations',
                    'courses_taught' => 'Programs Taught',
                    'courses_received' => 'Programs Received',
                    'professional_experience' => 'Professional Experience',
                    'positions_held' => 'Positions Held',
                    'abroad_stays' => 'Abroad Stays',
                    'scholarships_research_groups' => 'Scholarships & Research Groups',
                    'notes' => 'Additional Notes',
                ];
            @endphp

            @foreach($sections as $field => $title)
                @if(!empty($doctor->$field))
                    <div class="doctor-detail__block">
                        <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="doctor-detail__block-arrow">
                        <div class="doctor-detail__block-content">
                            <h3>{{ $title }}</h3>
                            <div>{!! $doctor->$field !!}</div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>

        <!-- Columna derecha: Imagen del doctor -->
        <div class="doctor-detail__sidebar">
            <div class="doctor-detail__image-box">
                <img src="{{ asset($doctor->image_path) }}" alt="{{ $doctor->full_name }}" class="doctor-detail__image">
            </div>
            @if($doctor->role_title)
                <div class="doctor-detail__role-box">
                    <span class="doctor-detail__role">{{ $doctor->role_title }}</span>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- BOTÓN VOLVER -->
<section class="doctor-back">
    <div class="doctor-back__container">
        <div class="doctor-back__content">
            <a href="{{ url('instructors') }}" class="doctor-back__btn">← Back to teachers</a>
        </div>
    </div>
</section>
@endsection