<x-layouts::app :title="__('Admin Dashboard')">
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ __('Admin Dashboard') }}</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('Overview of your academy.') }}</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {{-- Total Students --}}
            <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Total Students') }}</p>
                <p class="mt-2 text-3xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $totalStudents }}</p>
            </div>

            {{-- Total Courses --}}
            <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Total Courses') }}</p>
                <p class="mt-2 text-3xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $totalCourses }}</p>
            </div>

            {{-- Placeholder for enrollments (Phase 3) --}}
            <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Enrollments') }}</p>
                <p class="mt-2 text-3xl font-semibold text-zinc-900 dark:text-zinc-100">—</p>
                <p class="mt-1 text-xs text-zinc-400">{{ __('Coming in Phase 3') }}</p>
            </div>
        </div>
    </div>
</x-layouts::app>