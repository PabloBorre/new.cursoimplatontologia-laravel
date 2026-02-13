<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalStudents'   => User::where('role', 'student')->count(),
            'totalCourses'    => Course::count(),
            // Las métricas de inscripciones se añadirán en la Fase 3
            // 'totalEnrollments' => Enrollment::count(),
            // 'totalRevenue'     => Enrollment::where('status', 'paid')->sum('amount_paid'),
        ]);
    }
}