<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\StripeWebhookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CheckoutController;

// ── Rutas públicas ──────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contacto', [HomeController::class, 'contacto']);
Route::get('/docentes', [HomeController::class, 'docentes']);
Route::get('/cursos', [HomeController::class, 'cursos'])->name('cursos');
Route::get('/cursos/{slug}', [HomeController::class, 'cursoDetalle']);
Route::get('/docente/{slug}', [HomeController::class, 'docente']);
Route::get('/testimonios', [HomeController::class, 'testimonios']);

Route::post('/contacto/enviar', [ContactController::class, 'enviar']);

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

        // Checkout con Stripe
        Route::post('/courses/{course}/checkout', [CheckoutController::class, 'checkout'])
            ->name('checkout');
        Route::get('/checkout/success', [CheckoutController::class, 'success'])
            ->name('checkout.success');
        Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])
            ->name('checkout.cancel');
    });


// ── Rutas del admin ─────────────────────────────────────────
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
    });


require __DIR__.'/settings.php';