<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $enrollments = $user->enrollments()
            ->with('course')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.dashboard', [
            'user'        => $user,
            'enrollments' => $enrollments,
        ]);
    }
}