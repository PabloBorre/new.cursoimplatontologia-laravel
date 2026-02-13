<x-layouts::auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf

            {{-- ── Personal Information ──────────────────────── --}}
            <div class="space-y-1">
                <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('Personal Information') }}</h3>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <!-- First Name -->
                <flux:input
                    name="name"
                    :label="__('First Name')"
                    :value="old('name')"
                    type="text"
                    required
                    autofocus
                    autocomplete="given-name"
                    :placeholder="__('John')"
                />

                <!-- Last Name -->
                <flux:input
                    name="last_name"
                    :label="__('Last Name')"
                    :value="old('last_name')"
                    type="text"
                    required
                    autocomplete="family-name"
                    :placeholder="__('Doe')"
                />
            </div>

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Email address')"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Phone -->
            <flux:input
                name="phone"
                :label="__('Phone')"
                :value="old('phone')"
                type="tel"
                required
                autocomplete="tel"
                placeholder="+34 600 000 000"
            />

            {{-- ── Professional Background ───────────────────── --}}
            <div class="mt-2 space-y-1">
                <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('Professional Background') }}</h3>
            </div>

            <!-- Previous Experience -->
            <flux:textarea
                name="previous_experience"
                :label="__('Previous Experience')"
                required
                rows="4"
                :placeholder="__('Describe your experience in dental implantology...')"
            >{{ old('previous_experience') }}</flux:textarea>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <!-- Dental Clinic Name (optional) -->
                <flux:input
                    name="dental_clinic_name"
                    :label="__('Dental Clinic Name')"
                    :value="old('dental_clinic_name')"
                    type="text"
                    :placeholder="__('Optional')"
                />

                <!-- Position (optional) -->
                <flux:input
                    name="position"
                    :label="__('Position')"
                    :value="old('position')"
                    type="text"
                    :placeholder="__('Optional')"
                />
            </div>

            {{-- ── Documentation ─────────────────────────────── --}}
            <div class="mt-2 space-y-1">
                <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('Documentation') }}</h3>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                    {{ __('Upload your documents in PDF, JPG or PNG format (max 10MB each).') }}
                </p>
            </div>

            <!-- Documentation -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                    {{ __('Documentation') }} <span class="text-red-500">*</span>
                </label>
                <input
                    name="documentation"
                    type="file"
                    accept=".pdf,.jpg,.jpeg,.png"
                    required
                    class="block w-full text-sm text-zinc-500 dark:text-zinc-400
                           file:mr-4 file:rounded-md file:border-0
                           file:bg-zinc-100 file:px-4 file:py-2
                           file:text-sm file:font-medium file:text-zinc-700
                           hover:file:bg-zinc-200
                           dark:file:bg-zinc-700 dark:file:text-zinc-300
                           dark:hover:file:bg-zinc-600"
                />
                @error('documentation')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Diploma -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                    {{ __('Diploma') }} <span class="text-red-500">*</span>
                </label>
                <input
                    name="diploma"
                    type="file"
                    accept=".pdf,.jpg,.jpeg,.png"
                    required
                    class="block w-full text-sm text-zinc-500 dark:text-zinc-400
                           file:mr-4 file:rounded-md file:border-0
                           file:bg-zinc-100 file:px-4 file:py-2
                           file:text-sm file:font-medium file:text-zinc-700
                           hover:file:bg-zinc-200
                           dark:file:bg-zinc-700 dark:file:text-zinc-300
                           dark:hover:file:bg-zinc-600"
                />
                @error('diploma')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Dental License -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                    {{ __('Dental License') }} <span class="text-red-500">*</span>
                </label>
                <input
                    name="dental_license"
                    type="file"
                    accept=".pdf,.jpg,.jpeg,.png"
                    required
                    class="block w-full text-sm text-zinc-500 dark:text-zinc-400
                           file:mr-4 file:rounded-md file:border-0
                           file:bg-zinc-100 file:px-4 file:py-2
                           file:text-sm file:font-medium file:text-zinc-700
                           hover:file:bg-zinc-200
                           dark:file:bg-zinc-700 dark:file:text-zinc-300
                           dark:hover:file:bg-zinc-600"
                />
                @error('dental_license')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- ── Account Security ──────────────────────────── --}}
            <div class="mt-2 space-y-1">
                <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('Account Security') }}</h3>
            </div>

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Password')"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="__('Confirm password')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Confirm password')"
                viewable
            />

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                    {{ __('Create account') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Already have an account?') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>