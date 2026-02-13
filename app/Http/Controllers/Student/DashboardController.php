<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Cargar los cursos del estudiante con su estado de inscripción
        $enrollments = $user->enrollments()
            ->withPivot(['status', 'amount_paid', 'enrolled_at'])
            ->orderByPivot('enrolled_at', 'desc')
            ->get();

        return view('student.dashboard', [
            'user'        => $user,
            'enrollments' => $enrollments,
        ]);
    }
}