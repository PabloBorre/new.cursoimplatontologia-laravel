<x-layouts::app :title="__('Edit Student') . ' — ' . $student->full_name">
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.students.show', $student) }}" class="rounded-md p-1.5 text-zinc-400 transition hover:bg-zinc-100 hover:text-zinc-600 dark:hover:bg-zinc-700 dark:hover:text-zinc-300">
                <flux:icon.arrow-left variant="mini" class="size-5" />
            </a>
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ __('Edit Student') }}</h1>
                <p class="mt-0.5 text-sm text-zinc-500 dark:text-zinc-400">{{ $student->full_name }}</p>
            </div>
        </div>

        <form action="{{ route('admin.students.update', $student) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Personal Data --}}
            <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">{{ __('Personal Information') }}</h2>

                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('First Name') }} *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" required
                               class="mt-1 block w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100">
                        @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('Last Name') }} *</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $student->last_name) }}" required
                               class="mt-1 block w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100">
                        @error('last_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('Email') }} *</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}" required
                               class="mt-1 block w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100">
                        @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('Phone') }}</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $student->phone) }}"
                               class="mt-1 block w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100">
                        @error('phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="dental_clinic_name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('Dental Clinic') }}</label>
                        <input type="text" name="dental_clinic_name" id="dental_clinic_name" value="{{ old('dental_clinic_name', $student->dental_clinic_name) }}"
                               class="mt-1 block w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100">
                        @error('dental_clinic_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="position" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('Position') }}</label>
                        <input type="text" name="position" id="position" value="{{ old('position', $student->position) }}"
                               class="mt-1 block w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100">
                        @error('position') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label for="previous_experience" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('Previous Experience') }}</label>
                    <textarea name="previous_experience" id="previous_experience" rows="4"
                              class="mt-1 block w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100">{{ old('previous_experience', $student->previous_experience) }}</textarea>
                    @error('previous_experience') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Documents --}}
            <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">{{ __('Documents') }}</h2>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">{{ __('Upload new files to replace existing ones. Leave empty to keep current files.') }}</p>

                <div class="mt-4 space-y-4">
                    @php
                        $fileFields = [
                            ['name' => 'documentation',  'label' => 'Documentation'],
                            ['name' => 'diploma',        'label' => 'Diploma'],
                            ['name' => 'dental_license', 'label' => 'Dental License'],
                        ];
                    @endphp

                    @foreach($fileFields as $file)
                        <div>
                            <label for="{{ $file['name'] }}" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __($file['label']) }}</label>
                            @if($student->{$file['name']})
                                <div class="mt-1 flex items-center gap-2">
                                    <flux:icon.check-circle variant="mini" class="size-4 text-green-500" />
                                    <a href="{{ asset('storage/' . $student->{$file['name']}) }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-500 dark:text-blue-400">
                                        {{ __('View current file') }}
                                    </a>
                                </div>
                            @else
                                <p class="mt-1 text-xs text-zinc-400">{{ __('No file uploaded') }}</p>
                            @endif
                            <input type="file" name="{{ $file['name'] }}" id="{{ $file['name'] }}" accept=".pdf,.jpg,.jpeg,.png"
                                   class="mt-2 block w-full text-sm text-zinc-500 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-blue-600 hover:file:bg-blue-100 dark:text-zinc-400 dark:file:bg-zinc-700 dark:file:text-zinc-300">
                            @error($file['name']) <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.students.show', $student) }}" class="rounded-lg border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-800">
                    {{ __('Cancel') }}
                </a>
                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-500">
                    <flux:icon.check variant="mini" class="size-4" />
                    {{ __('Save Changes') }}
                </button>
            </div>
        </form>
    </div>
</x-layouts::app>