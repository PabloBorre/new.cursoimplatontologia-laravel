<x-layouts::app :title="__('Enrollments')">
    <div class="space-y-6">

        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ __('Enrollments') }}</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('See how many students are enrolled in each course.') }}</p>
        </div>

        {{-- Courses grid --}}
        @if($courses->isEmpty())
            <div class="rounded-lg border border-dashed border-zinc-300 bg-zinc-50 p-8 text-center dark:border-zinc-600 dark:bg-zinc-800/50">
                <flux:icon.academic-cap class="mx-auto size-10 text-zinc-400" />
                <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">{{ __('No courses found.') }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($courses as $course)
                    <a href="{{ route('admin.enrollments.show', $course) }}"
                       class="group rounded-lg border border-zinc-200 bg-white p-6 transition hover:border-blue-300 hover:shadow-md dark:border-zinc-700 dark:bg-zinc-800 dark:hover:border-blue-600">

                        {{-- Course title & level --}}
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="font-semibold text-zinc-900 group-hover:text-blue-600 dark:text-zinc-100 dark:group-hover:text-blue-400">
                                    {{ $course->title }}
                                </h3>
                                @if($course->level)
                                    <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">
                                        {{ \App\Models\Course::getLevelName($course->level) }}
                                    </p>
                                @endif
                            </div>
                            @if($course->is_active)
                                <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">{{ __('Active') }}</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-zinc-100 px-2 py-0.5 text-xs font-medium text-zinc-600 dark:bg-zinc-700 dark:text-zinc-400">{{ __('Inactive') }}</span>
                            @endif
                        </div>

                        {{-- Price --}}
                        <p class="mt-3 text-lg font-bold text-zinc-900 dark:text-zinc-100">
                            {{ \App\Models\Course::formatPrice($course->price, $course->currency) }}
                        </p>

                        {{-- Enrollment stats --}}
                        <div class="mt-4 flex items-center gap-4 border-t border-zinc-100 pt-4 dark:border-zinc-700">
                            <div class="flex items-center gap-1.5">
                                <flux:icon.users variant="mini" class="size-4 text-green-500" />
                                <span class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">{{ $course->paid_enrollments_count }}</span>
                                <span class="text-xs text-zinc-500 dark:text-zinc-400">{{ __('paid') }}</span>
                            </div>
                            @if($course->pending_enrollments_count > 0)
                                <div class="flex items-center gap-1.5">
                                    <flux:icon.clock variant="mini" class="size-4 text-amber-500" />
                                    <span class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">{{ $course->pending_enrollments_count }}</span>
                                    <span class="text-xs text-zinc-500 dark:text-zinc-400">{{ __('pending') }}</span>
                                </div>
                            @endif
                            @if($course->cancelled_enrollments_count > 0)
                                <div class="flex items-center gap-1.5">
                                    <flux:icon.x-circle variant="mini" class="size-4 text-red-500" />
                                    <span class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">{{ $course->cancelled_enrollments_count }}</span>
                                    <span class="text-xs text-zinc-500 dark:text-zinc-400">{{ __('cancelled') }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Arrow hint --}}
                        <div class="mt-3 flex items-center gap-1 text-xs font-medium text-zinc-400 group-hover:text-blue-500 dark:group-hover:text-blue-400">
                            {{ __('View enrollees') }}
                            <flux:icon.arrow-right variant="micro" class="size-3.5" />
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts::app>