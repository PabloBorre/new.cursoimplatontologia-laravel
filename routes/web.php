<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contacto', [HomeController::class, 'contacto']);
Route::get('/docentes', [HomeController::class, 'docentes']);
Route::get('/cursos', [HomeController::class, 'cursos']);
Route::get('/cursos/{slug}', [HomeController::class, 'cursoDetalle']);
Route::get('/docente/{slug}', [HomeController::class, 'docente']);
Route::get('/testimonios', [HomeController::class, 'testimonios']);

Route::post('/contacto/enviar', [ContactController::class, 'enviar']);

Route::prefix('api')->group(function () {
    Route::get('calendar/events', [CalendarController::class, 'getEvents']);
    Route::get('calendar/locations', [CalendarController::class, 'getLocations']);
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



// ── Rutas autenticadas (cualquier usuario logueado) ─────────
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard: redirige según el rol
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('student.dashboard');
    })->name('dashboard');

});


// ── Rutas del estudiante ────────────────────────────────────
Route::middleware(['auth', 'verified'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');

        // Aquí irán las rutas de compra de cursos (Fase 2-3)
        // Route::get('/courses', ...)->name('courses.index');
        // Route::post('/courses/{course}/checkout', ...)->name('courses.checkout');

    });


// ── Rutas del admin ─────────────────────────────────────────
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // CRUD de inscripciones (Fase 5)
        // Route::resource('enrollments', EnrollmentController::class);

    });

require __DIR__.'/settings.php';
