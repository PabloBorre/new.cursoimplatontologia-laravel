@extends('layouts.public')

@section('title', __('My Dashboard') . ' - Implantex Academy')

@push('styles')
<style>
    /* ===== DASHBOARD STYLES ===== */
    .dashboard {
        padding: 4rem 0;
        background-color: var(--color-white);
    }

    .dashboard__container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .dashboard__welcome {
        margin-bottom: 2.5rem;
    }

    .dashboard__welcome-title {
        font-family: var(--font-primary);
        font-weight: 500;
        font-size: 2rem;
        color: var(--color-depth);
        margin: 0;
    }

    .dashboard__welcome-sub {
        font-family: var(--font-secondary);
        font-size: 1rem;
        color: var(--color-advance);
        margin: 0.25rem 0 0;
    }

    /* Flash messages */
    .dashboard__flash {
        padding: 1rem 1.25rem;
        border-radius: 10px;
        font-family: var(--font-secondary);
        font-size: 0.9rem;
        margin-bottom: 2rem;
    }

    .dashboard__flash--success {
        background-color: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
    }

    .dashboard__flash--error {
        background-color: #ffebee;
        color: #c62828;
        border: 1px solid #ffcdd2;
    }

    /* Section card */
    .dashboard__card {
        background-color: var(--color-white);
        border: 1px solid var(--color-clarity);
        border-radius: 14px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .dashboard__card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    .dashboard__card-title {
        font-family: var(--font-primary);
        font-weight: 500;
        font-size: 1.35rem;
        color: var(--color-depth);
        margin: 0;
    }

    .dashboard__edit-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-family: var(--font-secondary);
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--color-white);
        background-color: var(--color-advance);
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .dashboard__edit-btn:hover {
        background-color: var(--color-anchor);
    }

    .dashboard__edit-btn svg {
        width: 16px;
        height: 16px;
    }

    /* Profile grid */
    .dashboard__profile-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    .dashboard__field {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
    }

    .dashboard__field-label {
        font-family: var(--font-secondary);
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--color-advance);
        margin: 0;
    }

    .dashboard__field-value {
        font-family: var(--font-secondary);
        font-size: 0.95rem;
        color: var(--color-depth);
        margin: 0;
    }

    /* Documents */
    .dashboard__documents {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 0.5rem;
    }

    .dashboard__doc-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        background-color: var(--color-clarity);
        border-radius: 8px;
    }

    .dashboard__doc-icon {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    .dashboard__doc-icon--ok {
        color: #2e7d32;
    }

    .dashboard__doc-icon--missing {
        color: #bbb;
    }

    .dashboard__doc-name {
        font-family: var(--font-secondary);
        font-size: 0.9rem;
        color: var(--color-depth);
        font-weight: 600;
    }

    .dashboard__doc-link {
        margin-left: auto;
        font-family: var(--font-secondary);
        font-size: 0.8rem;
        color: var(--color-advance);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .dashboard__doc-link:hover {
        color: var(--color-anchor);
    }

    .dashboard__doc-status {
        margin-left: auto;
        font-family: var(--font-secondary);
        font-size: 0.8rem;
        color: #999;
    }

    /* Courses */
    .dashboard__courses-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .dashboard__course-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.25rem 1.5rem;
        background-color: var(--color-clarity);
        border-radius: 10px;
        transition: transform 0.2s ease;
    }

    .dashboard__course-item:hover {
        transform: translateY(-1px);
    }

    .dashboard__course-name {
        font-family: var(--font-secondary);
        font-size: 1rem;
        font-weight: 600;
        color: var(--color-depth);
        margin: 0;
    }

    .dashboard__course-date {
        font-family: var(--font-secondary);
        font-size: 0.85rem;
        color: var(--color-advance);
        margin: 0.15rem 0 0;
    }

    .dashboard__course-badge {
        font-family: var(--font-secondary);
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.3rem 0.9rem;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        flex-shrink: 0;
    }

    .dashboard__course-badge--paid {
        background-color: #e8f5e9;
        color: #2e7d32;
    }

    .dashboard__course-badge--pending {
        background-color: #fff3e0;
        color: #e65100;
    }

    .dashboard__course-badge--cancelled {
        background-color: #ffebee;
        color: #c62828;
    }

    .dashboard__course-badge--refunded {
        background-color: #f5f5f5;
        color: #616161;
    }

    /* Empty state */
    .dashboard__empty {
        text-align: center;
        padding: 3rem 1rem;
    }

    .dashboard__empty-text {
        font-family: var(--font-secondary);
        font-size: 0.95rem;
        color: #999;
        margin: 0 0 1rem;
    }

    .dashboard__empty-link {
        display: inline-block;
        font-family: var(--font-secondary);
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--color-white);
        background-color: var(--color-advance);
        padding: 0.6rem 1.5rem;
        border-radius: 50px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .dashboard__empty-link:hover {
        background-color: var(--color-anchor);
    }

    /* Actions row */
    .dashboard__actions {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .dashboard__action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-family: var(--font-secondary);
        font-size: 0.85rem;
        font-weight: 600;
        padding: 0.6rem 1.3rem;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .dashboard__action-btn--outline {
        color: var(--color-advance);
        border: 2px solid var(--color-advance);
        background: transparent;
    }

    .dashboard__action-btn--outline:hover {
        background-color: var(--color-advance);
        color: var(--color-white);
    }

    /* Logout form */
    .dashboard__logout-btn {
        font-family: var(--font-secondary);
        font-size: 0.85rem;
        font-weight: 600;
        padding: 0.6rem 1.3rem;
        border-radius: 50px;
        border: 2px solid #c62828;
        color: #c62828;
        background: transparent;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dashboard__logout-btn:hover {
        background-color: #c62828;
        color: var(--color-white);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .dashboard {
            padding: 2.5rem 0;
        }

        .dashboard__welcome-title {
            font-size: 1.6rem;
        }

        .dashboard__profile-grid {
            grid-template-columns: 1fr;
        }

        .dashboard__card {
            padding: 1.5rem;
        }

        .dashboard__card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .dashboard__course-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .dashboard__actions {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<!-- HERO PÁGINA INTERIOR -->
<section class="page-hero">
    <div class="page-hero__background">
        <img src="{{ asset('images/operacion-imagen-contacto.webp') }}" alt="" class="page-hero__image">
        <div class="page-hero__overlay"></div>
        <img src="{{ asset('images/flecha-blanca.svg') }}" alt="" class="hero-arrow">
    </div>
    <div class="page-hero__content">
        <h1 class="page-hero__title">{{ __('My Dashboard') }}</h1>
    </div>
</section>

<!-- DASHBOARD CONTENT -->
<section class="dashboard">
    <div class="dashboard__container">

        {{-- Welcome --}}
        <div class="dashboard__welcome">
            <h2 class="dashboard__welcome-title">{{ __('Welcome') }}, {{ $user->full_name }}</h2>
            <p class="dashboard__welcome-sub">{{ __('Manage your courses and profile.') }}</p>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="dashboard__flash dashboard__flash--success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="dashboard__flash dashboard__flash--error">{{ session('error') }}</div>
        @endif

        {{-- Profile Card --}}
        <div class="dashboard__card">
            <div class="dashboard__card-header">
                <h3 class="dashboard__card-title">{{ __('Your Profile') }}</h3>
                <a href="{{ route('student.profile.edit') }}" class="dashboard__edit-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/></svg>
                    {{ __('Edit Profile') }}
                </a>
            </div>

            <div class="dashboard__profile-grid">
                <div class="dashboard__field">
                    <p class="dashboard__field-label">{{ __('Email') }}</p>
                    <p class="dashboard__field-value">{{ $user->email }}</p>
                </div>
                <div class="dashboard__field">
                    <p class="dashboard__field-label">{{ __('Phone') }}</p>
                    <p class="dashboard__field-value">{{ $user->phone ?? '—' }}</p>
                </div>
                @if($user->dental_clinic_name)
                <div class="dashboard__field">
                    <p class="dashboard__field-label">{{ __('Dental Clinic') }}</p>
                    <p class="dashboard__field-value">{{ $user->dental_clinic_name }}</p>
                </div>
                @endif
                @if($user->position)
                <div class="dashboard__field">
                    <p class="dashboard__field-label">{{ __('Position') }}</p>
                    <p class="dashboard__field-value">{{ $user->position }}</p>
                </div>
                @endif
            </div>

            {{-- Documents --}}
            <h4 class="dashboard__card-title" style="margin-top: 1.5rem; font-size: 1.1rem;">{{ __('Documents') }}</h4>
            <div class="dashboard__documents">
                @php
                    $docs = [
                        ['field' => 'documentation',  'label' => __('Documentation')],
                        ['field' => 'diploma',        'label' => __('Diploma')],
                        ['field' => 'dental_license', 'label' => __('Dental License')],
                    ];
                @endphp

                @foreach($docs as $doc)
                    <div class="dashboard__doc-item">
                        @if($user->{$doc['field']})
                            <svg class="dashboard__doc-icon dashboard__doc-icon--ok" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                            <span class="dashboard__doc-name">{{ $doc['label'] }}</span>
                            <a href="{{ asset('storage/' . $user->{$doc['field']}) }}" target="_blank" class="dashboard__doc-link">{{ __('View') }} →</a>
                        @else
                            <svg class="dashboard__doc-icon dashboard__doc-icon--missing" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                            <span class="dashboard__doc-name">{{ $doc['label'] }}</span>
                            <span class="dashboard__doc-status">{{ __('Not uploaded') }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        {{-- My Courses --}}
        <div class="dashboard__card">
            <div class="dashboard__card-header">
                <h3 class="dashboard__card-title">{{ __('My Courses') }}</h3>
            </div>

            @if($enrollments->isEmpty())
                <div class="dashboard__empty">
                    <p class="dashboard__empty-text">{{ __("You haven't enrolled in any courses yet.") }}</p>
                    <a href="{{ route('cursos') }}" class="dashboard__empty-link">{{ __('Browse available courses') }} →</a>
                </div>
            @else
                <div class="dashboard__courses-list">
                    @foreach($enrollments as $enrollment)
                        <div class="dashboard__course-item">
                            <div>
                                <p class="dashboard__course-name">{{ $enrollment->course->title }}</p>
                                @if($enrollment->enrolled_at)
                                    <p class="dashboard__course-date">{{ __('Enrolled') }}: {{ $enrollment->enrolled_at->format('M d, Y') }}</p>
                                @else
                                    <p class="dashboard__course-date">{{ __('Payment pending') }}</p>
                                @endif
                            </div>
                            <span class="dashboard__course-badge dashboard__course-badge--{{ $enrollment->status }}">
                                {{ ucfirst($enrollment->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Actions --}}
        <div class="dashboard__actions">
            <a href="{{ route('cursos') }}" class="dashboard__action-btn dashboard__action-btn--outline">
                {{ __('Browse Programs') }} →
            </a>
            <a href="{{ route('student.profile.edit') }}" class="dashboard__action-btn dashboard__action-btn--outline">
                {{ __('Edit Profile') }}
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dashboard__logout-btn">{{ __('Log Out') }}</button>
            </form>
        </div>

    </div>
</section>
@endsection