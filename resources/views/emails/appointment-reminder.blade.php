@extends('emails.layouts.master')

@section('content')
    <h1>Appointment Reminder</h1>
    
    <p>Dear {{ $details['fullname'] ?? 'Valued Client' }},</p>
    
    <p>This is a friendly reminder about your upcoming appointment with Bansal Lawyers.</p>
    
    <div class="highlight-box">
        <p><strong>Reminder:</strong> Your appointment is scheduled for {{ $details['date'] ?? 'TBD' }} at {{ $details['time'] ?? 'TBD' }}. Please arrive 10 minutes early.</p>
    </div>
    
    <div class="appointment-details">
        <h2>Appointment Summary</h2>
        
        <div class="detail-row">
            <span class="detail-label">Client Name:</span>
            <span class="detail-value">{{ $details['fullname'] ?? 'Not provided' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Appointment Date:</span>
            <span class="detail-value">{{ $details['date'] ?? 'To be confirmed' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Appointment Time:</span>
            <span class="detail-value">{{ $details['time'] ?? 'To be confirmed' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Service Type:</span>
            <span class="detail-value">{{ $details['service'] ?? 'Not specified' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Duration:</span>
            <span class="detail-value">{{ $details['duration'] ?? '60 minutes' }}</span>
        </div>
    </div>
    
    <h2>Preparation Checklist</h2>
    <p>To ensure a productive consultation, please:</p>
    <ul>
        <li>✅ Bring valid photo identification</li>
        <li>✅ Prepare any relevant documents</li>
        <li>✅ Write down your questions in advance</li>
        <li>✅ Arrive 10 minutes early</li>
    </ul>
    
    <h2>Need to Reschedule?</h2>
    <p>If you need to reschedule or cancel your appointment, please contact us as soon as possible:</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="tel:+61312345678" class="button">Call Us Now</a>
        <a href="mailto:info@bansallawyers.com.au" class="button" style="margin-left: 10px;">Email Us</a>
    </div>
    
    <p>We look forward to seeing you soon!</p>
    
    <p>Best regards,<br>
    <strong>The Bansal Lawyers Team</strong></p>
@endsection
