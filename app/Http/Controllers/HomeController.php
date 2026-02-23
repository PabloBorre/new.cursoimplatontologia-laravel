<?php

namespace App\Http\Controllers;

use App\Models\AuxiliaryCourse;
use App\Models\Course;
use App\Models\CourseDate;
use App\Models\Doctor;
use App\Models\Local;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        return view('inicio.index');
    }

    public function contacto()
    {
        return view('contacto.index');
    }

    public function docentes()
    {
        $doctors = Doctor::where('is_active', true)->orderBy('sort_order')->get();
        $locals = Local::all();

        return view('docentes.index', compact('doctors', 'locals'));
    }

    public function cursos()
    {
        $courses = Course::active()->get();

        return view('cursos.index', compact('courses'));
    }

    public function cursoDetalle(string $slug)
    {
        $course = Course::bySlug($slug)->firstOrFail();
        $auxiliaryCourse = AuxiliaryCourse::active()->first();
        $courseDates = CourseDate::forCourse($course->id)->get()->groupBy('location');
        $testimonials = Testimonial::active()->get();

        return view('cursos.single', compact('course', 'auxiliaryCourse', 'courseDates', 'testimonials'));
    }

    public function docente(string $slug)
    {
        $doctor = Doctor::where('slug', $slug)->where('is_active', true)->firstOrFail();

        return view('docentes.single', compact('doctor'));
    }

    public function testimonios()
    {
        $testimonials = Testimonial::active()->get();

        return view('testimonios.index', compact('testimonials'));
    }


    public function legalNotice()
    {
        return view('legal.legal-notice');
    }

    public function cookiePolicy()
    {
        return view('legal.cookie-policy');
    }

    public function privacyPolicy()
    {
        return view('legal.privacy-policy');
    }
}

