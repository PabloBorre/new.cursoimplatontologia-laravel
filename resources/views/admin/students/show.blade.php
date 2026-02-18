<x-layouts::app :title="$student->full_name">
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}" class="rounded-md p-1.5 text-zinc-400 transition hover:bg-zinc-100 hover:text-zinc-600 dark:hover:bg-zinc-700 dark:hover:text-zinc-300">
                    <flux:icon.arrow-left variant="mini" class="size-5" />
                </a>
                <div>
                    <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $student->full_name }}</h1>
                    <p class="mt-0.5 text-sm text-zinc-500 dark:text-zinc-400">{{ $student->email }}</p>
                </div>
            </div>
            <a href="{{ route('admin.students.edit', $student) }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-500">
                <flux:icon.pencil-square variant="mini" class="size-4" />
                {{ __('Edit') }}
            </a>
        </div>

        {{-- Flash --}}
        @if(session('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800 dark:bg-green-900/20 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- Left column: personal info --}}
            <div class="space-y-4 lg:col-span-2">

                {{-- Personal Data --}}
                <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">{{ __('Personal Information') }}</h2>

                    <dl class="mt-4 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ __('First Name') }}</dt>
                            <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">{{ $student->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ __('Last Name') }}</dt>
                            <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">{{ $student->last_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ __('Email') }}</dt>
                            <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">{{ $student->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ __('Phone') }}</dt>
                            <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">{{ $student->phone ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ __('Dental Clinic') }}</dt>
                            <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">{{ $student->dental_clinic_name ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ __('Position') }}</dt>
                            <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">{{ $student->position ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ __('Registered') }}</dt>
                            <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">{{ $student->created_at->format('M d, Y — H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ __('Email Verified') }}</dt>
                            <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">
                                @if($student->email_verified_at)
                                    <span class="inline-flex items-center gap-1 text-green-600 dark:text-green-400">
                                        <flux:icon.check-circle variant="mini" class="size-4" />
                                        {{ $student->email_verified_at->format('M d, Y') }}
                                    </span>
                                @else
                                    <span class="text-amber-600 dark:text-amber-400">{{ __('Not verified') }}</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>

                {{-- Previous Experience --}}
                @if($student->previous_experience)
                    <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                        <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">{{ __('Previous Experience') }}</h2>
                        <p class="mt-3 whitespace-pre-line text-sm text-zinc-700 dark:text-zinc-300">{{ $student->previous_experience }}</p>
                    </div>
                @endif

                {{-- Enrollments --}}
                <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">{{ __('Enrollments') }}</h2>

                    @if($student->enrollments->isEmpty())
                        <p class="mt-3 text-sm text-zinc-500 dark:text-zinc-400">{{ __('This student has no enrollments yet.') }}</p>
                    @else
                        <div class="mt-4 space-y-3">
                            @foreach($student->enrollments as $enrollment)
                                <div class="flex items-center justify-between rounded-lg border border-zinc-100 p-4 dark:border-zinc-700">
                                    <div>
                                        <p class="font-medium text-zinc-900 dark:text-zinc-100">{{ $enrollment->course->title ?? __('Unknown Course') }}</p>
                                        <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">
                                            {{ $enrollment->amount_paid ? number_format($enrollment->amount_paid, 2) . ' ' . strtoupper($enrollment->currency) : '—' }}
                                            @if($enrollment->enrolled_at)
                                                · {{ __('Enrolled') }}: {{ $enrollment->enrolled_at->format('M d, Y') }}
                                            @endif
                                        </p>
                                    </div>
                                    <span @class([
                                        'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium',
                                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' => $enrollment->status === 'paid',
                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' => $enrollment->status === 'pending',
                                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' => $enrollment->status === 'cancelled',
                                        'bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300' => $enrollment->status === 'refunded',
                                    ])>
                                        {{ ucfirst($enrollment->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right column: documents --}}
            <div class="space-y-4">
                <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">{{ __('Documents') }}</h2>

                    <div class="mt-4 space-y-3">
                        @php
                            $documents = [
                                ['field' => 'documentation',  'label' => 'Documentation'],
                                ['field' => 'diploma',        'label' => 'Diploma'],
                                ['field' => 'dental_license', 'label' => 'Dental License'],
                            ];
                        @endphp

                        @foreach($documents as $doc)
                            <div class="flex items-center justify-between rounded-lg border border-zinc-100 p-3 dark:border-zinc-700">
                                <div class="flex items-center gap-3">
                                    <div class="flex size-9 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-700">
                                        <flux:icon.document-text variant="mini" class="size-5 text-zinc-500" />
                                    </div>
                                    <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __($doc['label']) }}</span>
                                </div>
                                @if($student->{$doc['field']})
                                    <a href="{{ asset('storage/' . $student->{$doc['field']}) }}" target="_blank"
                                       class="inline-flex items-center gap-1 rounded-md bg-blue-600 px-2.5 py-1 text-xs font-medium text-white transition hover:bg-blue-500">
                                        <flux:icon.arrow-down-tray variant="micro" class="size-3.5" />
                                        {{ __('View') }}
                                    </a>
                                @else
                                    <span class="text-xs text-zinc-400">{{ __('Not uploaded') }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layouts::app>