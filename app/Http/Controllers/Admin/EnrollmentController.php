<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    /**
     * List all courses with their enrollment counts.
     */
    public function index()
    {
        $courses = Course::withCount([
            'enrollments',
            'enrollments as paid_enrollments_count' => function ($query) {
                $query->where('status', 'paid');
            },
            'enrollments as pending_enrollments_count' => function ($query) {
                $query->where('status', 'pending');
            },
            'enrollments as cancelled_enrollments_count' => function ($query) {
                $query->where('status', 'cancelled');
            },
        ])->orderBy('sort_order')->get();

        return view('admin.enrollments.index', compact('courses'));
    }

    /**
     * Show all students enrolled in a specific course.
     */
    public function show(Course $course)
    {
        $enrollments = Enrollment::where('course_id', $course->id)
            ->with('user')
            ->orderByDesc('created_at')
            ->get();

        $stats = [
            'total'     => $enrollments->count(),
            'paid'      => $enrollments->where('status', 'paid')->count(),
            'pending'   => $enrollments->where('status', 'pending')->count(),
            'cancelled' => $enrollments->where('status', 'cancelled')->count(),
            'refunded'  => $enrollments->where('status', 'refunded')->count(),
            'revenue'   => $enrollments->where('status', 'paid')->sum('amount_paid'),
        ];

        return view('admin.enrollments.show', compact('course', 'enrollments', 'stats'));
    }
}