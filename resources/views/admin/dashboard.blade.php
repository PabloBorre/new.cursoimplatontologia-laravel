<x-layouts::app :title="__('Admin Dashboard')">
    <style>
        .admin-table tbody tr:hover {
            background-color: #e4e4e7 !important;
        }
        .admin-table tbody tr:hover td,
        .admin-table tbody tr:hover td * {
            color: #18181b !important;
        }
        .sort-btn {
            display: inline-block;
            padding: 0.4rem 0.85rem;
            font-size: 0.8rem;
            border-radius: 6px;
            border: 1px solid #3f3f46;
            color: #a1a1aa;
            background: transparent;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .sort-btn:hover {
            border-color: #71717a;
            color: #e4e4e7;
        }
        .sort-btn--active {
            background-color: #3f3f46;
            color: #ffffff;
            border-color: #52525b;
        }
    </style>

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
                    <a href="{{ route('admin.dashboard', ['sort' => 'newest']) }}" class="sort-btn {{ $currentSort === 'newest' ? 'sort-btn--active' : '' }}">Newest</a>
                    <a href="{{ route('admin.dashboard', ['sort' => 'oldest']) }}" class="sort-btn {{ $currentSort === 'oldest' ? 'sort-btn--active' : '' }}">Oldest</a>
                    <a href="{{ route('admin.dashboard', ['sort' => 'name_asc']) }}" class="sort-btn {{ $currentSort === 'name_asc' ? 'sort-btn--active' : '' }}">A → Z</a>
                    <a href="{{ route('admin.dashboard', ['sort' => 'name_desc']) }}" class="sort-btn {{ $currentSort === 'name_desc' ? 'sort-btn--active' : '' }}">Z → A</a>
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
                                <th class="px-6 py-4 font-semibold text-zinc-700 dark:text-zinc-200">{{ __('Phone') }}</th>
                                <th class="px-6 py-4 font-semibold text-zinc-700 dark:text-zinc-200">{{ __('Clinic') }}</th>
                                <th class="px-6 py-4 font-semibold text-zinc-700 dark:text-zinc-200">{{ __('Registered') }}</th>
                                <th class="px-6 py-4 font-semibold text-zinc-700 dark:text-zinc-200">{{ __('Documents') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr class="border-b border-zinc-100 dark:border-zinc-800">
                                    <td class="px-6 py-4 font-medium text-zinc-900 dark:text-zinc-100">{{ $student->full_name }}</td>
                                    <td class="px-6 py-4 text-zinc-600 dark:text-zinc-300">{{ $student->email }}</td>
                                    <td class="px-6 py-4 text-zinc-600 dark:text-zinc-300">{{ $student->phone ?? '—' }}</td>
                                    <td class="px-6 py-4 text-zinc-600 dark:text-zinc-300">{{ $student->dental_clinic_name ?? '—' }}</td>
                                    <td class="px-6 py-4 text-zinc-600 dark:text-zinc-300">{{ $student->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-3">
                                            @if($student->documentation)
                                                <a href="{{ asset('storage/' . $student->documentation) }}" target="_blank" class="rounded bg-blue-600 px-2 py-1 text-xs font-medium text-white hover:bg-blue-500">Doc</a>
                                            @endif
                                            @if($student->diploma)
                                                <a href="{{ asset('storage/' . $student->diploma) }}" target="_blank" class="rounded bg-blue-600 px-2 py-1 text-xs font-medium text-white hover:bg-blue-500">Dip</a>
                                            @endif
                                            @if($student->dental_license)
                                                <a href="{{ asset('storage/' . $student->dental_license) }}" target="_blank" class="rounded bg-blue-600 px-2 py-1 text-xs font-medium text-white hover:bg-blue-500">Lic</a>
                                            @endif
                                            @if(!$student->documentation && !$student->diploma && !$student->dental_license)
                                                <span class="text-zinc-400">—</span>
                                            @endif
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