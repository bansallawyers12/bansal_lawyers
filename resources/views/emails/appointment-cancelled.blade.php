@extends('emails.layouts.master')

@section('content')
    <h1>Appointment Cancelled</h1>
    
    <p>Dear {{ $details['fullname'] ?? 'Valued Client' }},</p>
    
    <p>We have received your request to cancel your appointment scheduled for {{ $details['date'] ?? 'TBD' }} at {{ $details['time'] ?? 'TBD' }}.</p>
    
    <div class="highlight-box">
        <p><strong>Confirmation:</strong> Your appointment has been successfully cancelled. If you need to reschedule, please contact us to book a new appointment.</p>
    </div>
    
    <div class="appointment-details">
        <h2>Cancelled Appointment Details</h2>
        
        <div class="detail-row">
            <span class="detail-label">Client Name:</span>
            <span class="detail-value">{{ $details['fullname'] ?? 'Not provided' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Original Date:</span>
            <span class="detail-value">{{ $details['date'] ?? 'To be confirmed' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Original Time:</span>
            <span class="detail-value">{{ $details['time'] ?? 'To be confirmed' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Service Type:</span>
            <span class="detail-value">{{ $details['service'] ?? 'Not specified' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Cancellation Date:</span>
            <span class="detail-value">{{ date('Y-m-d H:i:s') }}</span>
        </div>
    </div>
    
    <h2>Next Steps</h2>
    <p>If you would like to reschedule your appointment or book a new one, we're here to help:</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ URL::to('/book-appointment') }}" class="button">Book New Appointment</a>
        <a href="tel:+61312345678" class="button" style="margin-left: 10px;">Call Us</a>
    </div>
    
    <h2>Refund Information</h2>
    <p>If you paid for this appointment, any applicable refunds will be processed within 3-5 business days to your original payment method.</p>
    
    <p>We understand that circumstances change, and we're always here to assist you with your legal needs when you're ready.</p>
    
    <p>Thank you for considering Bansal Lawyers for your legal services.</p>
    
    <p>Best regards,<br>
    <strong>The Bansal Lawyers Team</strong></p>
@endsection
