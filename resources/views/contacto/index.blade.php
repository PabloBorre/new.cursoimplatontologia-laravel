@extends('layouts.public')

@section('title', 'Contact Us - Get in Touch | Implantex Academy')
@section('meta_description', 'Contact Implantex Academy for information about dental implantology courses. Call 786 382 78 05, email info@cursodeimplantologia.com. Located in Miami, FL.')
@section('og_title', 'Contact Implantex Academy')
@section('og_description', 'Get in touch with Implantex Academy. Call 786 382 78 05 or email info@cursodeimplantologia.com for course information.')

@php
$schema = [
  '@context' => 'https://schema.org',
  '@type' => 'ContactPage',
  'name' => 'Contact Implantex Academy',
  'description' => 'Get in touch with Implantex Academy for dental implantology course information.',
  'url' => url()->current(),
  'mainEntity' => [
    '@type' => 'EducationalOrganization',
    'name' => 'Implantex Academy',
    'telephone' => '+1-786-382-7805',
    'email' => 'info@cursodeimplantologia.com',
    'address' => [
      '@type' => 'PostalAddress',
      'addressLocality' => 'Miami',
      'addressRegion' => 'FL',
      'addressCountry' => 'US',
    ],
  ],
];
@endphp

@push('schema')
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

@section('content')
<!-- HERO PÁGINA INTERIOR -->
<section class="page-hero">
    <div class="page-hero__background">
        <img src="{{ asset('images/operacion-imagen-contacto.webp') }}" alt="Contact Implantex Academy for course information" class="page-hero__image">
        <div class="page-hero__overlay"></div>
        <img src="{{ asset('images/flecha-blanca.svg') }}" alt="" class="hero-arrow">
    </div>
    <div class="page-hero__content">
        <h1 class="page-hero__title">Contact</h1>
    </div>
</section>

<!-- BARRA DE CONTACTO -->
<section class="contact-bar">
    <div class="contact-bar__container">
        <a href="tel:+347863827805" class="contact-bar__item">
            <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="contact-bar__arrow">
            <span>786 382 78 05</span>
        </a>
        <a href="mailto:info@implantexacademy.com" class="contact-bar__item">
            <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="contact-bar__arrow">
            <span>info@implantexacademy.com</span>
        </a>
        <div class="contact-bar__item">
            <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="contact-bar__arrow">
            <span>Miami, FL</span>
        </div>
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
            <div class="contact-form-section__image-wrapper contacto-contacto">
                <img src="{{ asset('images/lima-contacto-contacto.webp') }}" alt="Lima, Peru - Implantex Academy course destination" class="contact-form-section__image">
            </div>
            <p class="contact-form-section__caption">
                Interested in taking our implantology programs,<br>
                but can't attend in person?
            </p>
        </div>
    </div>
</section>
@endsection
