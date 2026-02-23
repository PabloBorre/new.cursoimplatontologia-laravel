@extends('layouts.public')

@section('title', 'Contact - Implantex Academy')

@section('content')
<!-- HERO PÁGINA INTERIOR -->
<section class="page-hero">
    <div class="page-hero__background">
        <img src="{{ asset('images/operacion-imagen-contacto.webp') }}" alt="" class="page-hero__image">
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
        <a href="mailto:info@cursodeimplantologia.com" class="contact-bar__item">
            <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="contact-bar__arrow">
            <span>info@cursodeimplantologia.com</span>
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
                <img src="{{ asset('images/lima-contacto-contacto.webp') }}" alt="Lima" class="contact-form-section__image">
            </div>
            <p class="contact-form-section__caption">
                Interested in taking our implantology programs,<br>
                but can't attend in person?
            </p>
        </div>
    </div>
</section>
@endsection
