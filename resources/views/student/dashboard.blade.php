<x-layouts::app :title="__('My Dashboard')">
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ __('Welcome') }}, {{ $user->full_name }}</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('Manage your courses and profile.') }}</p>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-900/20">
                <p class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="rounded-lg border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/20">
                <p class="text-sm text-red-700 dark:text-red-300">{{ session('error') }}</p>
            </div>
        @endif

        {{-- Profile Summary --}}
        <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
            <h2 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">{{ __('Your Profile') }}</h2>
            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Email') }}</p>
                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Phone') }}</p>
                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $user->phone ?? '—' }}</p>
                </div>
                @if($user->dental_clinic_name)
                <div>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Dental Clinic') }}</p>
                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $user->dental_clinic_name }}</p>
                </div>
                @endif
                @if($user->position)
                <div>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Position') }}</p>
                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $user->position }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- My Courses --}}
        <div>
            <h2 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">{{ __('My Courses') }}</h2>

            @if($enrollments->isEmpty())
                <div class="mt-4 rounded-lg border border-dashed border-zinc-300 bg-zinc-50 p-8 text-center dark:border-zinc-600 dark:bg-zinc-800/50">
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __("You haven't enrolled in any courses yet.") }}</p>
                    <a href="{{ route('cursos') }}" class="mt-3 inline-flex items-center gap-1 text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400">
                        {{ __('Browse available courses') }} →
                    </a>
                </div>
            @else
                <div class="mt-4 space-y-3">
                    @foreach($enrollments as $enrollment)
                        <div class="flex items-center justify-between rounded-lg border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-800">
                            <div>
                                <p class="font-medium text-zinc-900 dark:text-zinc-100">{{ $enrollment->course->title }}</p>
                                @if($enrollment->enrolled_at)
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                        {{ __('Enrolled') }}: {{ $enrollment->enrolled_at->format('M d, Y') }}
                                    </p>
                                @else
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                        {{ __('Payment pending') }}
                                    </p>
                                @endif
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
</x-layouts::app>