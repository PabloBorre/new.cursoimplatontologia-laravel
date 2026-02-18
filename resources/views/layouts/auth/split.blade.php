<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')

        <style>
            /* ── Auth branded background overrides ────────────────── */
            .auth-branded {
                background-color: #042734 !important;
            }

            /* All headings and titles - bright white */
            .auth-branded h1,
            .auth-branded h2,
            .auth-branded h3,
            .auth-branded [class*="text-zinc-950"],
            .auth-branded [class*="text-zinc-900"],
            .auth-branded [class*="text-zinc-800"],
            .auth-branded [class*="text-zinc-700"] {
                color: #ffffff !important;
            }

            /* Labels */
            .auth-branded label,
            .auth-branded .font-medium {
                color: #e2ecf1 !important;
            }

            /* Descriptions and muted text */
            .auth-branded p,
            .auth-branded span,
            .auth-branded [class*="text-zinc-600"],
            .auth-branded [class*="text-zinc-500"],
            .auth-branded [class*="text-zinc-400"] {
                color: #94b8c9 !important;
            }

            /* Form inputs */
            .auth-branded input[type="email"],
            .auth-branded input[type="password"],
            .auth-branded input[type="text"],
            .auth-branded textarea,
            .auth-branded select {
                background-color: rgba(255, 255, 255, 0.1) !important;
                border-color: rgba(255, 255, 255, 0.25) !important;
                color: #ffffff !important;
            }

            .auth-branded input::placeholder,
            .auth-branded textarea::placeholder {
                color: rgba(255, 255, 255, 0.45) !important;
            }

            .auth-branded input:focus,
            .auth-branded textarea:focus,
            .auth-branded select:focus {
                border-color: rgba(255, 255, 255, 0.5) !important;
                box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1) !important;
            }

            /* Checkbox */
            .auth-branded [type="checkbox"] {
                background-color: rgba(255, 255, 255, 0.1) !important;
                border-color: rgba(255, 255, 255, 0.35) !important;
            }

            /* "Remember me" label specifically */
            .auth-branded [type="checkbox"] + label,
            .auth-branded [type="checkbox"] ~ span,
            .auth-branded [data-flux-control] span {
                color: #c8dce6 !important;
            }

            /* Links */
            .auth-branded a {
                color: #7dd3fc !important;
            }
            .auth-branded a:hover {
                color: #bae6fd !important;
            }
            /* Keep logo link white */
            .auth-branded a.flex,
            .auth-branded .auth-logo-link {
                color: #ffffff !important;
            }

            /* Primary button - white on brand */
            .auth-branded button[type="submit"] {
                background-color: #ffffff !important;
                color: #042734 !important;
                font-weight: 600 !important;
            }
            .auth-branded button[type="submit"]:hover {
                background-color: #e2ecf1 !important;
            }

            /* Password toggle icon */
            .auth-branded [data-flux-input-show-password],
            .auth-branded [data-flux-input-hide-password],
            .auth-branded button[class*="absolute"] svg {
                color: rgba(255, 255, 255, 0.6) !important;
            }

            /* File inputs (register page) */
            .auth-branded input[type="file"] {
                color: rgba(255, 255, 255, 0.7) !important;
            }
            .auth-branded input[type="file"]::file-selector-button {
                background-color: rgba(255, 255, 255, 0.12) !important;
                color: #e2ecf1 !important;
                border: none !important;
            }
            .auth-branded input[type="file"]::file-selector-button:hover {
                background-color: rgba(255, 255, 255, 0.2) !important;
            }

            /* Error messages */
            .auth-branded .text-red-600,
            .auth-branded .text-red-500,
            .auth-branded [class*="text-red"] {
                color: #fca5a5 !important;
            }

            /* Flux overrides - catch-all for any Flux-generated dark mode styles */
            .auth-branded [class*="dark:text-"] {
                color: inherit;
            }
        </style>
    </head>
    <body class="auth-branded min-h-screen antialiased">
        <div class="relative grid min-h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <div class="relative hidden h-full flex-col p-10 text-white lg:flex">
                {{-- Background image --}}
                <div class="absolute inset-0">
                    <img src="{{ asset('images/login-bg.webp') }}" alt="" class="h-full w-full object-cover object-left">
                    <div class="absolute inset-0 bg-neutral-900/60"></div>
                </div>

                <a href="{{ route('home') }}" class="relative z-20 flex items-center text-lg font-medium" wire:navigate>
                    <span class="flex h-10 w-10 items-center justify-center rounded-md">
                        <x-app-logo-icon class="me-2 h-7 fill-current text-white" />
                    </span>
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div class="relative z-20 mt-auto">
                    <blockquote class="space-y-2">
                        <flux:heading size="lg" class="!text-white">&ldquo;Training today's dentists for tomorrow's challenges.&rdquo;</flux:heading>
                        <footer><flux:heading class="!text-white/70">Implantex Academy</flux:heading></footer>
                    </blockquote>
                </div>
            </div>
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                    {{-- Logo above form --}}
                    <div class="flex w-full items-center justify-center">
                        <a href="{{ route('home') }}" class="auth-logo-link" wire:navigate>
                            <img src="{{ asset('images/imagotipo-2.svg') }}" alt="Implantex Academy" class="mx-auto h-12 w-auto">
                        </a>
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>

        @fluxScripts
    </body>
</html>