<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Mail\PaymentConfirmation;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a Stripe Checkout Session and redirect the user.
     */
    public function checkout(Request $request, Course $course)
    {
        $user = $request->user();

        // Check if already paid
        if ($user->isEnrolledIn($course->id)) {
            return redirect()->route('student.dashboard')
                ->with('error', 'You are already enrolled in this course.');
        }

        // Reuse any existing enrollment or create new one
        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($enrollment) {
            // Reset to pending for a new checkout attempt
            $enrollment->update([
                'status'     => 'pending',
                'amount_paid' => $course->price,
                'currency'   => strtolower($course->currency),
            ]);
        } else {
            $enrollment = Enrollment::create([
                'user_id'    => $user->id,
                'course_id'  => $course->id,
                'status'     => 'pending',
                'amount_paid' => $course->price,
                'currency'   => strtolower($course->currency),
            ]);
        }

        // Create Stripe Checkout Session
        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'customer_email'       => $user->email,
            'line_items' => [[
                'price_data' => [
                    'currency'     => strtolower($course->currency),
                    'product_data' => [
                        'name'        => $course->title,
                        'description' => $course->short_description ?? "Enrollment in {$course->title}",
                    ],
                    'unit_amount' => (int) ($course->price * 100), // Stripe uses cents
                ],
                'quantity' => 1,
            ]],
            'mode'        => 'payment',
            'success_url' => route('student.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('student.checkout.cancel'),
            'metadata'    => [
                'enrollment_id' => $enrollment->id,
                'user_id'       => $user->id,
                'course_id'     => $course->id,
            ],
        ]);

        // Save Stripe session ID
        $enrollment->update(['stripe_session_id' => $session->id]);

        return redirect($session->url);
    }

    /**
     * Handle successful payment return from Stripe.
     */
    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');

        if (! $sessionId) {
            return redirect()->route('student.dashboard');
        }

        try {
            $session = StripeSession::retrieve($sessionId);

            if ($session->payment_status === 'paid') {
                $enrollment = Enrollment::where('stripe_session_id', $sessionId)->first();

                if ($enrollment && ! $enrollment->isPaid()) {
                    $enrollment->update([
                        'status'                    => 'paid',
                        'stripe_payment_intent_id'  => $session->payment_intent,
                        'enrolled_at'               => now(),
                    ]);

                    // Send confirmation email
                    $this->sendConfirmationEmail($enrollment);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Stripe session retrieve failed: ' . $e->getMessage());
        }

        return redirect()->route('student.dashboard')
            ->with('success', 'Payment successful! You are now enrolled.');
    }

    /**
     * Handle cancelled payment return from Stripe.
     */
    public function cancel()
    {
        return redirect()->route('student.dashboard')
            ->with('error', 'Payment was cancelled. You can try again anytime.');
    }

    /**
     * Send payment confirmation email to the student.
     */
    private function sendConfirmationEmail(Enrollment $enrollment): void
    {
        try {
            $enrollment->load(['user', 'course']);

            Mail::to($enrollment->user->email)
                ->send(new PaymentConfirmation($enrollment));

        } catch (\Exception $e) {
            \Log::error("Failed to send payment confirmation email for Enrollment #{$enrollment->id}: " . $e->getMessage());
        }
    }
}