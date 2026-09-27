@php
    $variant = $variant ?? 'enquiry';
    $lead = match ($variant) {
        'booking' => 'Paying for this consultation engages us for that consultation only. It does not mean we have agreed to act in your wider matter.',
        'payment' => 'Card payments are processed by Stripe. We keep the payment status and a record that can include the card brand and last four digits, not the full card number.',
        default => 'Sending this form does not create a solicitor-client relationship.',
    };
@endphp
<p class="form-legal-notice" style="font-size:0.85rem;line-height:1.5;margin:0 0 12px;color:#64748b;">
    {{ $lead }} We handle your details under our
    <a href="{{ url('/privacy-policy') }}" style="color:#1e40af;">Privacy Policy</a>.
    Website content is general information only — see our
    <a href="{{ url('/disclaimer') }}" style="color:#1e40af;">Disclaimer</a>.
</p>
