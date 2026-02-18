<x-layouts::app :title="__('Admin Dashboard')">
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ __('Admin Dashboard') }}</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('Overview of your academy.') }}</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Total Students') }}</p>
                <p class="mt-2 text-3xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $totalStudents }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Total Courses') }}</p>
                <p class="mt-2 text-3xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $totalCourses }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Paid Enrollments') }}</p>
                <p class="mt-2 text-3xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $totalEnrollments }}</p>
            </div>
        </div>

        {{-- Students List --}}
        <div>
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">{{ __('Registered Students') }}</h2>
                <div class="flex gap-2">
                    @php
                        $sortButtons = [
                            'newest'    => __('Newest'),
                            'oldest'    => __('Oldest'),
                            'name_asc'  => 'A → Z',
                            'name_desc' => 'Z → A',
                        ];
                    @endphp
                    @foreach($sortButtons as $key => $label)
                        <a href="{{ route('admin.dashboard', ['sort' => $key]) }}"
                           class="inline-block rounded-md border px-3 py-1.5 text-xs font-medium transition
                                  {{ $currentSort === $key
                                      ? 'border-blue-500 bg-blue-600 text-white'
                                      : 'border-zinc-300 text-zinc-500 hover:border-zinc-400 hover:text-zinc-700 dark:border-zinc-600 dark:text-zinc-400 dark:hover:border-zinc-500 dark:hover:text-zinc-300' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

            @if($students->isEmpty())
                <div class="mt-4 rounded-lg border border-dashed border-zinc-300 bg-zinc-50 p-8 text-center dark:border-zinc-600 dark:bg-zinc-800/50">
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('No students registered yet.') }}</p>
                </div>
            @else
                <div class="mt-4 overflow-x-auto rounded-lg border border-zinc-200 dark:border-zinc-700">
                    <table class="admin-table w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-zinc-200 bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800">
                                <th class="px-6 py-4 font-semibold text-zinc-700 dark:text-zinc-200">{{ __('Name') }}</th>
                                <th class="px-6 py-4 font-semibold text-zinc-700 dark:text-zinc-200">{{ __('Email') }}</th>
                                <th class="px-6 py-4 font-semibold text-zinc-700 dark:text-zinc-200">{{ __('Registered') }}</th>
                                <th class="px-6 py-4 text-center font-semibold text-zinc-700 dark:text-zinc-200">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr class="border-b border-zinc-100 dark:border-zinc-800">
                                    <td class="px-6 py-4 font-medium text-zinc-900 dark:text-zinc-100">{{ $student->full_name }}</td>
                                    <td class="px-6 py-4 text-zinc-600 dark:text-zinc-300">{{ $student->email }}</td>
                                    <td class="px-6 py-4 text-zinc-600 dark:text-zinc-300">{{ $student->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="{{ route('admin.students.show', $student) }}" title="{{ __('View details') }}"
                                               class="rounded-md p-1.5 text-zinc-400 transition hover:bg-zinc-100 hover:text-blue-600 dark:hover:bg-zinc-700 dark:hover:text-blue-400">
                                                <flux:icon.eye variant="mini" class="size-5" />
                                            </a>
                                            <a href="{{ route('admin.students.edit', $student) }}" title="{{ __('Edit student') }}"
                                               class="rounded-md p-1.5 text-zinc-400 transition hover:bg-zinc-100 hover:text-amber-600 dark:hover:bg-zinc-700 dark:hover:text-amber-400">
                                                <flux:icon.pencil-square variant="mini" class="size-5" />
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
    </div>
</x-layouts::app>