@extends('emails.layouts.master')

@section('content')
    <h1>Appointment Confirmation</h1>
    
    <p>Dear {{ $details['fullname'] ?? 'Valued Client' }},</p>
    
    @if(isset($details['payment_status']) && $details['payment_status'] == 'pending')
        <div class="highlight-box" style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0;">
            <p style="margin: 0; color: #856404;"><strong>⚠️ Payment Pending:</strong> Your appointment has been scheduled, but payment is still pending. Please complete the payment to confirm your appointment. You will receive a payment link separately.</p>
        </div>
    @elseif(isset($details['payment_status']) && $details['payment_status'] == 'failed')
        <div class="highlight-box" style="background-color: #f8d7da; border-left: 4px solid #dc3545; padding: 15px; margin: 20px 0;">
            <p style="margin: 0; color: #721c24;"><strong>❌ Payment Failed:</strong> Your appointment has been scheduled, but the payment could not be processed. Please contact us or try completing the payment again using the payment link provided.</p>
        </div>
    @endif
    
    <p>Thank you for choosing Bansal Lawyers for your legal needs. We are pleased to confirm your appointment with us.</p>
    
    <div class="highlight-box">
        <p><strong>Important:</strong> Please arrive 10 minutes before your scheduled appointment time. If you need to reschedule or cancel, please contact us at least 24 hours in advance.</p>
    </div>
    
    <div class="appointment-details">
        <h2>Appointment Details</h2>
        
        <div class="detail-row">
            <span class="detail-label">Client Name:</span>
            <span class="detail-value">{{ $details['fullname'] ?? 'Not provided' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Email:</span>
            <span class="detail-value">{{ $details['email'] ?? 'Not provided' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Phone:</span>
            <span class="detail-value">{{ $details['phone'] ?? 'Not provided' }}</span>
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
            <span class="detail-label">Nature of Enquiry:</span>
            <span class="detail-value">{{ $details['NatureOfEnquiry'] ?? 'Not specified' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Appointment Type:</span>
            <span class="detail-value">{{ $details['appointment_details'] ?? 'Not specified' }}</span>
        </div>
    </div>
    
    <h2>What to Bring</h2>
    <p>To make the most of your consultation, please bring:</p>
    <ul>
        <li>Valid photo identification</li>
        <li>Any relevant documents related to your case</li>
        <li>List of questions you'd like to discuss</li>
        <li>Any correspondence or legal documents you've received</li>
    </ul>
    
    <h2>Location & Directions</h2>
    <p>Our office is conveniently located in Melbourne. Detailed directions and parking information will be sent separately.</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ URL::to('/contact') }}" class="button">View Office Location</a>
    </div>
    
    <p>If you have any questions or need to make changes to your appointment, please don't hesitate to contact us.</p>
    
    <p>We look forward to meeting with you and providing you with the professional legal assistance you need.</p>
    
    <p>Best regards,<br>
    <strong>The Bansal Lawyers Team</strong></p>
@endsection
