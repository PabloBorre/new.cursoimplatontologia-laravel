<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\StripeWebhookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\EnrollmentController as AdminEnrollmentController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CheckoutController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\SitemapController;


// ── Public Routes ──────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contacto']);
Route::get('/instructors', [HomeController::class, 'docentes']);
Route::get('/courses', [HomeController::class, 'cursos'])->name('cursos');
Route::get('/courses/{slug}', [HomeController::class, 'cursoDetalle']);
Route::get('/instructor/{slug}', [HomeController::class, 'docente'])->name('docente');
Route::get('/testimonials', [HomeController::class, 'testimonios']);
Route::get('/legal-notice', [HomeController::class, 'legalNotice']);
Route::get('/cookie-policy', [HomeController::class, 'cookiePolicy']);
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy']);

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

Route::post('/contact/send', [ContactController::class, 'enviar']);

Route::prefix('api')->group(function () {
    Route::get('calendar/events', [CalendarController::class, 'getEvents']);
    Route::get('calendar/locations', [CalendarController::class, 'getLocations']);
});

// ── Stripe Webhook (sin CSRF) ───────────────────────────────
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle'])
    ->name('stripe.webhook');


// ── Dashboard: redirige según el rol ────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {
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

        // Profile
        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        // Checkout con Stripe
        Route::post('/courses/{course}/checkout', [CheckoutController::class, 'checkout'])
            ->name('checkout');
        Route::get('/checkout/success', [CheckoutController::class, 'success'])
            ->name('checkout.success');
        Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])
            ->name('checkout.cancel');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
            ->name('profile.password');
    });


// ── Rutas del admin ─────────────────────────────────────────
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Students management
        Route::get('/students/{student}', [AdminStudentController::class, 'show'])
            ->name('students.show');
        Route::get('/students/{student}/edit', [AdminStudentController::class, 'edit'])
            ->name('students.edit');
        Route::put('/students/{student}', [AdminStudentController::class, 'update'])
            ->name('students.update');

        // Enrollments management
        Route::get('/enrollments', [AdminEnrollmentController::class, 'index'])
            ->name('enrollments.index');
        Route::get('/enrollments/{course}', [AdminEnrollmentController::class, 'show'])
            ->name('enrollments.show');
    });


require __DIR__.'/settings.php';