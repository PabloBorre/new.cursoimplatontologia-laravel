<?php

namespace App\Http\Controllers;

use App\Mail\PaymentConfirmation;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\UnexpectedValueException $e) {
            Log::error('Stripe Webhook: Invalid payload');
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Stripe Webhook: Invalid signature');
            return response('Invalid signature', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $this->handleCheckoutCompleted($event->data->object);
                break;

            case 'checkout.session.expired':
                $this->handleCheckoutExpired($event->data->object);
                break;

            default:
                Log::info("Stripe Webhook: Unhandled event type {$event->type}");
        }

        return response('OK', 200);
    }

    /**
     * Payment completed successfully.
     */
    private function handleCheckoutCompleted($session): void
    {
        $enrollment = Enrollment::where('stripe_session_id', $session->id)->first();

        if (! $enrollment) {
            Log::warning("Stripe Webhook: No enrollment found for session {$session->id}");
            return;
        }

        if ($session->payment_status === 'paid' && ! $enrollment->isPaid()) {
            $enrollment->update([
                'status'                    => 'paid',
                'stripe_payment_intent_id'  => $session->payment_intent,
                'enrolled_at'               => now(),
            ]);

            Log::info("Stripe Webhook: Enrollment #{$enrollment->id} marked as paid");

            // Send confirmation email
            $this->sendConfirmationEmail($enrollment);
        }
    }

    /**
     * Checkout session expired without payment.
     */
    private function handleCheckoutExpired($session): void
    {
        $enrollment = Enrollment::where('stripe_session_id', $session->id)
            ->where('status', 'pending')
            ->first();

        if ($enrollment) {
            $enrollment->update(['status' => 'cancelled']);
            Log::info("Stripe Webhook: Enrollment #{$enrollment->id} cancelled (session expired)");
        }
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

            Log::info("Payment confirmation email sent for Enrollment #{$enrollment->id}");
        } catch (\Exception $e) {
            // Don't fail the webhook if email fails
            Log::error("Failed to send payment confirmation email for Enrollment #{$enrollment->id}: " . $e->getMessage());
        }
    }
}