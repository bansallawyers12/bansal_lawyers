<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\AppointmentPayment;
use Illuminate\Support\Facades\Log;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\StripeClient;

class StripePaymentService
{
    private StripeClient $client;

    public function __construct(?StripeClient $client = null)
    {
        $config = [
            'api_key' => config('services.stripe.secret') ?? env('STRIPE_SECRET'),
        ];

        $apiVersion = config('services.stripe.api_version');
        if ($apiVersion) {
            $config['stripe_version'] = $apiVersion;
        }

        $this->client = $client ?? new StripeClient($config);
    }

    public function getAppointmentPaymentAmount(Appointment $appointment): float
    {
        if ($appointment->order_hash) {
            $recordAmount = AppointmentPayment::where('order_hash', $appointment->order_hash)->value('amount');
            if ($recordAmount !== null && (float) $recordAmount > 0) {
                return (float) $recordAmount;
            }
        }

        return 150.0;
    }

    public function findOrCreateCustomer(string $email, string $name): Customer
    {
        $customers = $this->client->customers->all([
            'email' => $email,
            'limit' => 1,
        ]);

        if (!empty($customers->data)) {
            $customer = $customers->data[0];

            if ($name !== '' && ($customer->name ?? '') !== $name) {
                return $this->client->customers->update($customer->id, ['name' => $name]);
            }

            return $customer;
        }

        return $this->client->customers->create([
            'email' => $email,
            'name' => $name,
        ]);
    }

    public function retrievePaymentIntent(string $paymentIntentId): PaymentIntent
    {
        return $this->client->paymentIntents->retrieve($paymentIntentId);
    }

    /**
     * @return string|null Error message if invalid, null if valid.
     */
    public function validatePaymentIntentForAppointment(
        PaymentIntent $paymentIntent,
        int $appointmentId,
        float $amount
    ): ?string {
        if (($paymentIntent->metadata['appointment_id'] ?? null) != (string) $appointmentId) {
            return 'Payment could not be verified.';
        }

        $expectedCents = (int) round($amount * 100);
        if ((int) $paymentIntent->amount !== $expectedCents) {
            Log::warning('stripePost amount mismatch', [
                'appointment_id' => $appointmentId,
                'expected_cents' => $expectedCents,
                'actual_cents' => $paymentIntent->amount,
            ]);

            return 'Payment amount mismatch.';
        }

        if ($paymentIntent->status !== 'succeeded') {
            return 'Payment was not completed. Please try again.';
        }

        return null;
    }

    public function createAppointmentPaymentIntent(
        int $appointmentId,
        string $customerId,
        string $paymentMethodId,
        float $amount,
        string $cardName,
        string $currency = 'aud'
    ): PaymentIntent {
        return $this->client->paymentIntents->create([
            'amount' => (int) round($amount * 100),
            'currency' => $currency,
            'customer' => $customerId,
            'payment_method' => $paymentMethodId,
            'confirmation_method' => 'automatic',
            'confirm' => true,
            'description' => "Appointment Payment - Bansal Lawyers - $cardName",
            'metadata' => [
                'appointment_id' => (string) $appointmentId,
            ],
        ], [
            'idempotency_key' => 'appt_' . $appointmentId . '_' . $paymentMethodId,
        ]);
    }
}
