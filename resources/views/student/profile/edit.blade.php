@extends('layouts.public')

@section('title', __('Edit My Profile') . ' - Implantex Academy')

@push('styles')
<style>
    /* ===== PROFILE EDIT STYLES ===== */
    .profile-edit {
        padding: 4rem 0;
        background-color: var(--color-white);
    }

    .profile-edit__container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .profile-edit__header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .profile-edit__back {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--color-clarity);
        color: var(--color-depth);
        text-decoration: none;
        transition: background-color 0.3s ease;
        flex-shrink: 0;
    }

    .profile-edit__back:hover {
        background-color: var(--color-reflect);
    }

    .profile-edit__back svg {
        width: 20px;
        height: 20px;
    }

    .profile-edit__title {
        font-family: var(--font-primary);
        font-weight: 500;
        font-size: 2rem;
        color: var(--color-depth);
        margin: 0;
    }

    .profile-edit__sub {
        font-family: var(--font-secondary);
        font-size: 0.9rem;
        color: var(--color-advance);
        margin: 0.15rem 0 0;
    }

    /* Flash */
    .profile-edit__flash {
        padding: 1rem 1.25rem;
        border-radius: 10px;
        font-family: var(--font-secondary);
        font-size: 0.9rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .profile-edit__flash--success {
        background-color: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
    }

    .profile-edit__flash--error {
        background-color: #ffebee;
        color: #c62828;
        border: 1px solid #ffcdd2;
    }

    /* Card */
    .profile-edit__card {
        background-color: var(--color-white);
        border: 1px solid var(--color-clarity);
        border-radius: 14px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .profile-edit__card-title {
        font-family: var(--font-primary);
        font-weight: 500;
        font-size: 1.2rem;
        color: var(--color-depth);
        margin: 0 0 1.25rem;
    }

    .profile-edit__card-desc {
        font-family: var(--font-secondary);
        font-size: 0.8rem;
        color: var(--color-advance);
        margin: -0.75rem 0 1.25rem;
    }

    /* Form grid */
    .profile-edit__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    .profile-edit__field {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .profile-edit__field--full {
        grid-column: 1 / -1;
    }

    .profile-edit__label {
        font-family: var(--font-secondary);
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--color-depth);
    }

    .profile-edit__label span {
        color: #c62828;
    }

    .profile-edit__input {
        font-family: var(--font-secondary);
        font-size: 0.9rem;
        padding: 0.65rem 0.9rem;
        border: 1px solid #d4dee3;
        border-radius: 8px;
        color: var(--color-depth);
        background-color: var(--color-white);
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        outline: none;
        width: 100%;
    }

    .profile-edit__input:focus {
        border-color: var(--color-advance);
        box-shadow: 0 0 0 3px rgba(84, 151, 175, 0.15);
    }

    textarea.profile-edit__input {
        resize: vertical;
        min-height: 100px;
    }

    .profile-edit__error {
        font-family: var(--font-secondary);
        font-size: 0.75rem;
        color: #c62828;
        margin: 0;
    }

    /* File fields */
    .profile-edit__files {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .profile-edit__file-current {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.25rem;
    }

    .profile-edit__file-current svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }

    .profile-edit__file-current--ok svg {
        color: #2e7d32;
    }

    .profile-edit__file-current--missing svg {
        color: #bbb;
    }

    .profile-edit__file-link {
        font-family: var(--font-secondary);
        font-size: 0.8rem;
        color: var(--color-advance);
        text-decoration: none;
        font-weight: 600;
    }

    .profile-edit__file-link:hover {
        color: var(--color-anchor);
    }

    .profile-edit__file-status {
        font-family: var(--font-secondary);
        font-size: 0.8rem;
        color: #999;
    }

    .profile-edit__file-input {
        font-family: var(--font-secondary);
        font-size: 0.85rem;
        color: var(--color-depth);
    }

    .profile-edit__file-input::file-selector-button {
        font-family: var(--font-secondary);
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.45rem 1rem;
        margin-right: 0.75rem;
        border: none;
        border-radius: 6px;
        background-color: var(--color-clarity);
        color: var(--color-depth);
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .profile-edit__file-input::file-selector-button:hover {
        background-color: var(--color-reflect);
    }

    /* Buttons */
    .profile-edit__buttons {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .profile-edit__cancel {
        font-family: var(--font-secondary);
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--color-advance);
        border: 2px solid var(--color-advance);
        background: transparent;
        padding: 0.6rem 1.5rem;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .profile-edit__cancel:hover {
        background-color: var(--color-advance);
        color: var(--color-white);
    }

    .profile-edit__submit {
        font-family: var(--font-secondary);
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--color-white);
        background-color: var(--color-advance);
        padding: 0.65rem 2rem;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .profile-edit__submit:hover {
        background-color: var(--color-anchor);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .profile-edit {
            padding: 2.5rem 0;
        }

        .profile-edit__title {
            font-size: 1.5rem;
        }

        .profile-edit__grid {
            grid-template-columns: 1fr;
        }

        .profile-edit__card {
            padding: 1.5rem;
        }

        .profile-edit__buttons {
            flex-direction: column;
        }

        .profile-edit__cancel,
        .profile-edit__submit {
            width: 100%;
            text-align: center;
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
        <h1 class="page-hero__title">{{ __('Edit Profile') }}</h1>
    </div>
</section>

<!-- PROFILE EDIT CONTENT -->
<section class="profile-edit">
    <div class="profile-edit__container">

        {{-- Header --}}
        <div class="profile-edit__header">
            <a href="{{ route('student.dashboard') }}" class="profile-edit__back">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
            </a>
            <div>
                <h2 class="profile-edit__title">{{ __('Edit My Profile') }}</h2>
                <p class="profile-edit__sub">{{ __('Update your personal information and documents.') }}</p>
            </div>
        </div>

        {{-- Flash --}}
        @if(session('success'))
            <div class="profile-edit__flash profile-edit__flash--success">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="profile-edit__flash profile-edit__flash--error">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126Z"/></svg>
                {{ __('Please correct the errors below.') }}
            </div>
        @endif

        <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Personal Information --}}
            <div class="profile-edit__card">
                <h3 class="profile-edit__card-title">{{ __('Personal Information') }}</h3>

                <div class="profile-edit__grid">
                    <div class="profile-edit__field">
                        <label for="name" class="profile-edit__label">{{ __('First Name') }} <span>*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="profile-edit__input">
                        @error('name') <p class="profile-edit__error">{{ $message }}</p> @enderror
                    </div>
                    <div class="profile-edit__field">
                        <label for="last_name" class="profile-edit__label">{{ __('Last Name') }} <span>*</span></label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" required class="profile-edit__input">
                        @error('last_name') <p class="profile-edit__error">{{ $message }}</p> @enderror
                    </div>
                    <div class="profile-edit__field">
                        <label for="email" class="profile-edit__label">{{ __('Email') }} <span>*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="profile-edit__input">
                        @error('email') <p class="profile-edit__error">{{ $message }}</p> @enderror
                    </div>
                    <div class="profile-edit__field">
                        <label for="phone" class="profile-edit__label">{{ __('Phone') }}</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="profile-edit__input">
                        @error('phone') <p class="profile-edit__error">{{ $message }}</p> @enderror
                    </div>
                    <div class="profile-edit__field">
                        <label for="dental_clinic_name" class="profile-edit__label">{{ __('Dental Clinic') }}</label>
                        <input type="text" name="dental_clinic_name" id="dental_clinic_name" value="{{ old('dental_clinic_name', $user->dental_clinic_name) }}" class="profile-edit__input">
                        @error('dental_clinic_name') <p class="profile-edit__error">{{ $message }}</p> @enderror
                    </div>
                    <div class="profile-edit__field">
                        <label for="position" class="profile-edit__label">{{ __('Position') }}</label>
                        <input type="text" name="position" id="position" value="{{ old('position', $user->position) }}" class="profile-edit__input">
                        @error('position') <p class="profile-edit__error">{{ $message }}</p> @enderror
                    </div>
                    <div class="profile-edit__field profile-edit__field--full">
                        <label for="previous_experience" class="profile-edit__label">{{ __('Previous Experience') }}</label>
                        <textarea name="previous_experience" id="previous_experience" rows="4" class="profile-edit__input">{{ old('previous_experience', $user->previous_experience) }}</textarea>
                        @error('previous_experience') <p class="profile-edit__error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Documents --}}
            <div class="profile-edit__card">
                <h3 class="profile-edit__card-title">{{ __('Documents') }}</h3>
                <p class="profile-edit__card-desc">{{ __('Upload new files to replace existing ones. Leave empty to keep current files. Accepted: PDF, JPG, PNG (max 10MB).') }}</p>

                <div class="profile-edit__files">
                    @php
                        $fileFields = [
                            ['name' => 'documentation',  'label' => __('Documentation')],
                            ['name' => 'diploma',        'label' => __('Diploma')],
                            ['name' => 'dental_license', 'label' => __('Dental License')],
                        ];
                    @endphp

                    @foreach($fileFields as $file)
                        <div class="profile-edit__field">
                            <label for="{{ $file['name'] }}" class="profile-edit__label">{{ $file['label'] }}</label>

                            @if($user->{$file['name']})
                                <div class="profile-edit__file-current profile-edit__file-current--ok">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    <a href="{{ asset('storage/' . $user->{$file['name']}) }}" target="_blank" class="profile-edit__file-link">{{ __('View current file') }} →</a>
                                </div>
                            @else
                                <div class="profile-edit__file-current profile-edit__file-current--missing">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    <span class="profile-edit__file-status">{{ __('No file uploaded') }}</span>
                                </div>
                            @endif

                            <input type="file" name="{{ $file['name'] }}" id="{{ $file['name'] }}" accept=".pdf,.jpg,.jpeg,.png" class="profile-edit__file-input">
                            @error($file['name']) <p class="profile-edit__error">{{ $message }}</p> @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Buttons --}}
            <div class="profile-edit__buttons">
                <a href="{{ route('student.dashboard') }}" class="profile-edit__cancel">{{ __('Cancel') }}</a>
                <button type="submit" class="profile-edit__submit">{{ __('Save Changes') }}</button>
            </div>
        </form>

    </div>
</section>
@endsection