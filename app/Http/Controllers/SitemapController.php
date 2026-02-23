<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Doctor;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        // Static pages
        $staticPages = [
            ['url' => url('/'), 'lastmod' => now()->toDateString(), 'changefreq' => 'weekly', 'priority' => '1.0'],
            ['url' => url('/cursos'), 'lastmod' => now()->toDateString(), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['url' => url('/docentes'), 'lastmod' => now()->toDateString(), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['url' => url('/testimonios'), 'lastmod' => now()->toDateString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['url' => url('/contacto'), 'lastmod' => now()->toDateString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['url' => url('/legal-notice'), 'lastmod' => now()->toDateString(), 'changefreq' => 'yearly', 'priority' => '0.2'],
            ['url' => url('/cookie-policy'), 'lastmod' => now()->toDateString(), 'changefreq' => 'yearly', 'priority' => '0.2'],
            ['url' => url('/privacy-policy'), 'lastmod' => now()->toDateString(), 'changefreq' => 'yearly', 'priority' => '0.2'],
        ];

        // Dynamic course pages
        $courses = Course::active()->get();
        $coursePages = $courses->map(function ($course) {
            return [
                'url' => url('/cursos/' . $course->slug),
                'lastmod' => $course->updated_at?->toDateString() ?? now()->toDateString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        })->toArray();

        // Dynamic instructor pages
        $doctors = Doctor::where('is_active', true)->get();
        $doctorPages = $doctors->map(function ($doctor) {
            return [
                'url' => url('/docente/' . $doctor->slug),
                'lastmod' => $doctor->updated_at?->toDateString() ?? now()->toDateString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        })->toArray();

        $pages = array_merge($staticPages, $coursePages, $doctorPages);

        $content = view('sitemap.index', compact('pages'));

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}