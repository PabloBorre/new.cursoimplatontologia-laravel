<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'newest');

        $query = User::where('role', 'student');

        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc')->orderBy('last_name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc')->orderBy('last_name', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $students = $query->get();

        return view('admin.dashboard', [
            'students'         => $students,
            'totalStudents'    => $students->count(),
            'totalCourses'     => Course::count(),
            'totalEnrollments' => Enrollment::where('status', 'paid')->count(),
            'currentSort'      => $sort,
        ]);
    }
}