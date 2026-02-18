<x-layouts::app :title="$course->title . ' — ' . __('Enrollments')">
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.enrollments.index') }}" class="rounded-md p-1.5 text-zinc-400 transition hover:bg-zinc-100 hover:text-zinc-600 dark:hover:bg-zinc-700 dark:hover:text-zinc-300">
                    <flux:icon.arrow-left variant="mini" class="size-5" />
                </a>
                <div>
                    <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $course->title }}</h1>
                    <p class="mt-0.5 text-sm text-zinc-500 dark:text-zinc-400">
                        {{ \App\Models\Course::formatPrice($course->price, $course->currency) }}
                        @if($course->level)
                            · {{ \App\Models\Course::getLevelName($course->level) }}
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
            <div class="rounded-lg border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-800">
                <p class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ __('Total') }}</p>
                <p class="mt-1 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $stats['total'] }}</p>
            </div>
            <div class="rounded-lg border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-900/20">
                <p class="text-xs font-medium uppercase tracking-wide text-green-600 dark:text-green-400">{{ __('Paid') }}</p>
                <p class="mt-1 text-2xl font-semibold text-green-700 dark:text-green-300">{{ $stats['paid'] }}</p>
            </div>
            <div class="rounded-lg border border-amber-200 bg-amber-50 p-4 dark:border-amber-800 dark:bg-amber-900/20">
                <p class="text-xs font-medium uppercase tracking-wide text-amber-600 dark:text-amber-400">{{ __('Pending') }}</p>
                <p class="mt-1 text-2xl font-semibold text-amber-700 dark:text-amber-300">{{ $stats['pending'] }}</p>
            </div>
            <div class="rounded-lg border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/20">
                <p class="text-xs font-medium uppercase tracking-wide text-red-600 dark:text-red-400">{{ __('Cancelled') }}</p>
                <p class="mt-1 text-2xl font-semibold text-red-700 dark:text-red-300">{{ $stats['cancelled'] }}</p>
            </div>
            <div class="rounded-lg border border-blue-200 bg-blue-50 p-4 dark:border-blue-800 dark:bg-blue-900/20">
                <p class="text-xs font-medium uppercase tracking-wide text-blue-600 dark:text-blue-400">{{ __('Revenue') }}</p>
                <p class="mt-1 text-2xl font-semibold text-blue-700 dark:text-blue-300">
                    {{ \App\Models\Course::formatPrice($stats['revenue'], $course->currency) }}
                </p>
            </div>
        </div>

        {{-- Enrollments Table --}}
        @if($enrollments->isEmpty())
            <div class="rounded-lg border border-dashed border-zinc-300 bg-zinc-50 p-8 text-center dark:border-zinc-600 dark:bg-zinc-800/50">
                <flux:icon.users class="mx-auto size-10 text-zinc-400" />
                <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">{{ __('No students enrolled in this course yet.') }}</p>
            </div>
        @else
            <div class="overflow-x-auto rounded-lg border border-zinc-200 dark:border-zinc-700">
                <table class="admin-table w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-zinc-200 bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800">
                            <th class="px-6 py-4 font-semibold text-zinc-700 dark:text-zinc-200">{{ __('Student') }}</th>
                            <th class="px-6 py-4 font-semibold text-zinc-700 dark:text-zinc-200">{{ __('Email') }}</th>
                            <th class="px-6 py-4 font-semibold text-zinc-700 dark:text-zinc-200">{{ __('Status') }}</th>
                            <th class="px-6 py-4 font-semibold text-zinc-700 dark:text-zinc-200">{{ __('Amount') }}</th>
                            <th class="px-6 py-4 font-semibold text-zinc-700 dark:text-zinc-200">{{ __('Enrolled At') }}</th>
                            <th class="px-6 py-4 text-center font-semibold text-zinc-700 dark:text-zinc-200">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enrollment)
                            <tr class="border-b border-zinc-100 dark:border-zinc-800">
                                <td class="px-6 py-4 font-medium text-zinc-900 dark:text-zinc-100">
                                    {{ $enrollment->user->full_name ?? __('Unknown') }}
                                </td>
                                <td class="px-6 py-4 text-zinc-600 dark:text-zinc-300">
                                    {{ $enrollment->user->email ?? '—' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span @class([
                                        'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium',
                                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' => $enrollment->status === 'paid',
                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' => $enrollment->status === 'pending',
                                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' => $enrollment->status === 'cancelled',
                                        'bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300' => $enrollment->status === 'refunded',
                                    ])>
                                        {{ ucfirst($enrollment->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-zinc-600 dark:text-zinc-300">
                                    {{ $enrollment->amount_paid ? number_format($enrollment->amount_paid, 2) . ' ' . strtoupper($enrollment->currency) : '—' }}
                                </td>
                                <td class="px-6 py-4 text-zinc-600 dark:text-zinc-300">
                                    {{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('M d, Y') : '—' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('admin.students.show', $enrollment->user) }}" title="{{ __('View student') }}"
                                           class="rounded-md p-1.5 text-zinc-400 transition hover:bg-zinc-100 hover:text-blue-600 dark:hover:bg-zinc-700 dark:hover:text-blue-400">
                                            <flux:icon.eye variant="mini" class="size-5" />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layouts::app>