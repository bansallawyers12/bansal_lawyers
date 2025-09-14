@extends('layouts.frontend_appointment')

@section('seoinfo')
    <title>Book Appointment with Top Law Firm in Melbourne - Experimental</title>
    <meta name="description" content="Book an appointment with Bansal Lawyers, one of the top law firms in Melbourne, Australia. Schedule a consultation for expert legal guidance in divorce, visa matters, property disputes, and more." />

	<link rel="canonical" href="<?php echo URL::to('/'); ?>/book-an-appointment" />

	<!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo URL::to('/'); ?>/book-an-appointment">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Book an Appointment | Schedule a Consultation with Top Law Firm Bansal Lawyers Melbourne">
    <meta property="og:description" content="Book an appointment with Bansal Lawyers, one of the top law firms in Melbourne, Australia. Schedule a consultation for expert legal guidance in divorce, visa matters, property disputes, and more.">
    <meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
	<meta property="og:image:alt" content="Bansal Lawyers Logo">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/book-an-appointment">
    <meta name="twitter:title" content="Book an Appointment | Schedule a Consultation with Top Law Firm Bansal Lawyers Melbourne">
    <meta name="twitter:description" content="Book an appointment with Bansal Lawyers, one of the top law firms in Melbourne, Australia. Schedule a consultation for expert legal guidance in divorce, visa matters, property disputes, and more.">
    <meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
	<meta property="twitter:image:alt" content="Bansal Lawyers Logo">

<!-- Hotjar Tracking Code for https://www.bansallawyers.com.au/migration-law -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:6499398,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
@endsection

@section('content')

<style>
/* Appointment Page Styles - Blue Theme */
.experimental-appointment-hero {
    background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
    color: white;
    padding: 80px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.experimental-appointment-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset('images/bg_2.jpg') }}') center/cover;
    opacity: 0.2;
    z-index: 1;
}

.experimental-appointment-hero .container {
    position: relative;
    z-index: 2;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.15);
    padding: 8px 20px;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 25px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.hero-badge i {
    color: #ffaf02;
    font-size: 1.1rem;
}

.experimental-appointment-hero h1 {
    font-size: 3.2rem;
    font-weight: 800;
    margin-bottom: 1.2rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.3rem;
    opacity: 0.95;
    margin-bottom: 40px;
    line-height: 1.6;
    font-weight: 400;
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 50px;
    margin: 40px 0;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
    background: rgba(255, 255, 255, 0.1);
    padding: 20px 25px;
    border-radius: 15px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: #ffaf02;
    margin-bottom: 5px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
    font-weight: 500;
}

.hero-cta {
    margin-top: 50px;
}

.hero-cta-btn {
    background: linear-gradient(135deg, #ffaf02, #ff8c00);
    color: #1B4D89;
    border: none;
    padding: 18px 40px;
    border-radius: 50px;
    font-size: 1.2rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(255, 175, 2, 0.4);
    display: inline-flex;
    align-items: center;
    gap: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.hero-cta-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(255, 175, 2, 0.6);
    background: linear-gradient(135deg, #ff8c00, #ffaf02);
}

.hero-cta-btn i {
    font-size: 1.3rem;
}

.cta-note {
    margin-top: 15px;
    font-size: 0.95rem;
    opacity: 0.9;
    font-weight: 500;
}

/* Success Stories Section */
.success-stories-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    position: relative;
}

.success-stories-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="%23ffffff" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="%23ffffff" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
    z-index: 1;
}

.success-stories-content {
    position: relative;
    z-index: 2;
    text-align: center;
}

.success-stories-content h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1B4D89;
    margin-bottom: 20px;
}

.section-subtitle {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 60px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.success-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
    margin-bottom: 60px;
}

.success-card {
    background: white;
    padding: 40px 30px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.success-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
}

.success-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    border-color: #1B4D89;
}

.success-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    transition: all 0.3s ease;
}

.success-card:hover .success-icon {
    transform: scale(1.1);
    background: linear-gradient(135deg, #ffaf02, #ff8c00);
}

.success-icon i {
    font-size: 2rem;
    color: white;
}

.success-card h3 {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1B4D89;
    margin-bottom: 15px;
}

.success-card p {
    color: #666;
    line-height: 1.6;
    font-size: 1rem;
}

.testimonial-slider {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 30px;
    max-width: 1000px;
    margin: 0 auto;
}

.testimonial-card {
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    position: relative;
    border-left: 5px solid #1B4D89;
}

.testimonial-content {
    position: relative;
}

.quote-icon {
    position: absolute;
    top: -20px;
    left: 30px;
    width: 40px;
    height: 40px;
    background: #1B4D89;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.quote-icon i {
    color: white;
    font-size: 1.2rem;
}

.testimonial-content p {
    font-size: 1.1rem;
    line-height: 1.7;
    color: #333;
    font-style: italic;
    margin-bottom: 25px;
    padding-top: 20px;
}

.testimonial-author strong {
    color: #1B4D89;
    font-size: 1.1rem;
    display: block;
    margin-bottom: 5px;
}

.testimonial-author span {
    color: #666;
    font-size: 0.9rem;
}

.experimental-appointment-section {
    padding: 50px 0;
    background: #f8f9fa;
}

.experimental-info-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    margin-bottom: 40px;
    border: 2px solid #f0f0f0;
    position: relative;
    overflow: hidden;
}

.experimental-info-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
}

.info-header {
    text-align: center;
    margin-bottom: 40px;
}

.experimental-info-card h2 {
    color: #1B4D89;
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.experimental-info-card h2 i {
    color: #ffaf02;
    font-size: 2rem;
}

.info-subtitle {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 0;
    font-weight: 500;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    margin-bottom: 40px;
}

.info-section h3 {
    color: #1B4D89;
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.info-section h3 i {
    color: #ffaf02;
    font-size: 1.2rem;
}

.trust-indicators {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin: 30px 0;
    flex-wrap: wrap;
}

.trust-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    padding: 15px 20px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.trust-item:hover {
    background: #1B4D89;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(27, 77, 137, 0.3);
}

.trust-item i {
    font-size: 1.5rem;
    color: #1B4D89;
    transition: color 0.3s ease;
}

.trust-item:hover i {
    color: #ffaf02;
}

.trust-item span {
    font-size: 0.9rem;
    font-weight: 600;
    text-align: center;
}

.experimental-info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.experimental-info-list li {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 18px;
    margin-bottom: 15px;
    border-left: 4px solid #1B4D89;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.experimental-info-list li:hover {
    transform: translateX(8px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.experimental-info-list li strong {
    color: #1B4D89;
    font-size: 1rem;
    display: block;
    margin-bottom: 8px;
}

.experimental-info-list li span {
    color: #666;
    line-height: 1.5;
    display: block;
    font-size: 0.95rem;
}

.experimental-contact-info {
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    color: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    margin-top: 20px;
}

.experimental-contact-info h4 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 10px;
}

.experimental-contact-info p {
    margin: 0;
    font-size: 1rem;
}

.experimental-form-section {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.experimental-form-tabs {
    border-bottom: 2px solid #e9ecef;
    margin-bottom: 25px;
}

.experimental-tab-nav {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 15px;
    flex-wrap: wrap;
}

.experimental-tab-nav li {
    margin: 0;
}

.experimental-tab-nav a {
    display: block;
    padding: 12px 20px;
    background: #f8f9fa;
    color: #666;
    text-decoration: none;
    border-radius: 8px 8px 0 0;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    font-size: 0.9rem;
}

.experimental-tab-nav a.active {
    background: #1B4D89;
    color: white;
    border-color: #1B4D89;
}

.experimental-tab-nav a.disabled {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}

.experimental-tab-content {
    display: none;
}

.experimental-tab-content.active {
    display: block;
}

.experimental-form-group {
    margin-bottom: 20px;
}

.experimental-form-group label {
    color: #1B4D89;
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
    font-size: 1rem;
}

.experimental-form-control {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    background: #f8f9fa;
}

.experimental-form-control:focus {
    outline: none;
    border-color: #1B4D89;
    box-shadow: 0 0 0 2px rgba(27, 77, 137, 0.1);
    background: white;
}

.experimental-form-control::placeholder {
    color: #999;
}

.experimental-textarea {
    min-height: 100px;
    resize: vertical;
}

.experimental-btn {
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(27, 77, 137, 0.3);
}

.experimental-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(27, 77, 137, 0.4);
}

.experimental-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.experimental-btn.btn-back {
    background: #f8f9fa;
    color: #1B4D89;
    border: 2px solid #1B4D89;
    margin-right: 12px;
}

.experimental-btn.btn-back:hover {
    background: #1B4D89;
    color: white;
}

/* Consultation Header */
.consultation-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 30px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 15px;
    border: 2px solid #e9ecef;
}

.consultation-header h3 {
    color: #1B4D89;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}

.consultation-header h3 i {
    color: #ffaf02;
    font-size: 1.5rem;
}

.consultation-subtitle {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 20px;
    line-height: 1.6;
}

.consultation-price {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
}

.price-label {
    font-size: 1rem;
    color: #666;
}

.price-amount {
    font-size: 2rem;
    font-weight: 800;
    color: #1B4D89;
}

.price-note {
    font-size: 0.9rem;
    color: #28a745;
    font-weight: 600;
}

/* Consultation Options */
.consultation-options {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
}

.experimental-service-item {
    background: white;
    border: 3px solid #e9ecef;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 0;
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.experimental-service-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.experimental-service-item:hover {
    border-color: #1B4D89;
    box-shadow: 0 8px 25px rgba(27, 77, 137, 0.15);
    transform: translateY(-3px);
}

.experimental-service-item:hover::before {
    transform: scaleX(1);
}

.experimental-service-item.selected {
    border-color: #1B4D89;
    background: linear-gradient(135deg, rgba(27, 77, 137, 0.05), rgba(44, 90, 160, 0.05));
    box-shadow: 0 8px 25px rgba(27, 77, 137, 0.2);
}

.experimental-service-item.selected::before {
    transform: scaleX(1);
}

.experimental-service-item input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.service-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 15px;
}

.service-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.experimental-service-item:hover .service-icon {
    background: linear-gradient(135deg, #ffaf02, #ff8c00);
    transform: scale(1.1);
}

.service-icon i {
    font-size: 1.5rem;
    color: white;
}

.service-title-section {
    flex: 1;
}

.experimental-service-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1B4D89;
    margin-bottom: 5px;
}

.service-badge {
    display: inline-block;
    background: #ffaf02;
    color: #1B4D89;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.experimental-service-price {
    font-size: 1.4rem;
    font-weight: 800;
    color: #1B4D89;
    text-align: right;
}

.experimental-service-description {
    color: #666;
    margin-bottom: 15px;
    font-size: 1rem;
    line-height: 1.6;
}

.service-benefits {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.benefit-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.9rem;
    color: #28a745;
    font-weight: 500;
}

.benefit-item i {
    font-size: 0.8rem;
}

/* Consultation CTA */
.consultation-cta {
    text-align: center;
    margin-top: 40px;
    padding: 30px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 15px;
    border: 2px solid #e9ecef;
}

.urgency-notice {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #ff6b6b, #ee5a52);
    color: white;
    padding: 12px 20px;
    border-radius: 25px;
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
    animation: pulse-urgency 2s infinite;
}

.urgency-notice i {
    font-size: 1.1rem;
}

@keyframes pulse-urgency {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}

.consultation-cta-btn {
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    color: white;
    padding: 18px 40px;
    border: none;
    border-radius: 50px;
    font-size: 1.2rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(27, 77, 137, 0.4);
    display: inline-flex;
    align-items: center;
    gap: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 20px;
}

.consultation-cta-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(27, 77, 137, 0.6);
    background: linear-gradient(135deg, #2c5aa0, #1B4D89);
}

.consultation-cta-btn i {
    font-size: 1.1rem;
}

.cta-guarantee {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 0.9rem;
    color: #28a745;
    font-weight: 600;
    margin: 0;
}

.cta-guarantee i {
    font-size: 1rem;
}

/* Final CTA Section */
.final-cta-section {
    text-align: center;
    margin-top: 40px;
    padding: 40px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 20px;
    border: 2px solid #e9ecef;
}

.final-motivation {
    margin-bottom: 30px;
}

.final-motivation h4 {
    color: #1B4D89;
    font-size: 1.6rem;
    font-weight: 700;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.final-motivation h4 i {
    color: #ffaf02;
    font-size: 1.4rem;
}

.final-motivation p {
    font-size: 1.1rem;
    color: #666;
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
}

.final-cta-buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.final-submit-btn {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 18px 40px;
    border: none;
    border-radius: 50px;
    font-size: 1.2rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    display: flex;
    align-items: center;
    gap: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    min-width: 250px;
    justify-content: center;
}

.final-submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(40, 167, 69, 0.6);
    background: linear-gradient(135deg, #20c997, #28a745);
}

.final-submit-btn i {
    font-size: 1.3rem;
}

.btn-text {
    font-size: 1.1rem;
}

.btn-price {
    font-size: 1rem;
    opacity: 0.9;
    font-weight: 600;
}

.final-guarantees {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

.guarantee-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    padding: 15px 20px;
    background: white;
    border-radius: 10px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    min-width: 120px;
}

.guarantee-item:hover {
    border-color: #28a745;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(40, 167, 69, 0.2);
}

.guarantee-item i {
    font-size: 1.5rem;
    color: #28a745;
}

.guarantee-item span {
    font-size: 0.9rem;
    font-weight: 600;
    color: #333;
    text-align: center;
}

.processing-message {
    background: #1B4D89;
    color: white;
    padding: 8px 12px;
    border-radius: 5px;
    font-size: 0.85rem;
    text-align: center;
    margin-top: 10px;
    animation: pulse 1s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.7; }
    100% { opacity: 1; }
}

/* Legal matter selection feedback */
.enquiry_item.selected {
    border-color: #1B4D89 !important;
    box-shadow: 0 0 0 3px rgba(27, 77, 137, 0.2) !important;
    background: rgba(27, 77, 137, 0.05) !important;
}

/* Validation error message */
.validation-error-message {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    border-radius: 8px;
    padding: 15px;
    margin: 20px 0;
    text-align: center;
    font-weight: 500;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Error field styling */
.experimental-form-control.error {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    background-color: #fff5f5 !important;
}

.error-message.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875rem;
    color: #dc3545;
    font-weight: 500;
}

.validation-error-message ul {
    text-align: left;
    margin: 10px 0;
    padding-left: 20px;
}

.validation-error-message li {
    margin: 5px 0;
    font-weight: 500;
}

.experimental-calendar-section {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    margin: 15px 0;
}

.experimental-timezone-info {
    background: #e3f2fd;
    color: #1565c0;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 15px;
    font-size: 0.85rem;
}

.experimental-calendar-container {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.experimental-calendar {
    flex: 1;
    min-width: 280px;
}

.experimental-timeslots {
    flex: 1;
    min-width: 280px;
}

.experimental-timeslot {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 12px 15px;
    margin: 8px 8px 8px 0;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-block;
    text-align: center;
    min-width: 100px;
    font-size: 0.9rem;
}

.experimental-timeslot:hover {
    border-color: #1B4D89;
    background: rgba(27, 77, 137, 0.05);
}

.experimental-timeslot.active {
    background: #1B4D89;
    color: white;
    border-color: #1B4D89;
}

.experimental-timeslot.unavailable {
    background: #f8f9fa;
    color: #999;
    border-color: #e9ecef;
    cursor: not-allowed;
    opacity: 0.6;
}

.experimental-timeslot.unavailable:hover {
    background: #f8f9fa;
    color: #999;
    border-color: #e9ecef;
    transform: none;
}

/* Modern Booking Section */
.modern-booking-section {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: 2px solid #f0f0f0;
}

.booking-header {
    text-align: center;
    margin-bottom: 40px;
}

.booking-header h3 {
    color: #1B4D89;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}

.booking-header h3 i {
    color: #ffaf02;
    font-size: 1.5rem;
}

.booking-subtitle {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 20px;
    line-height: 1.6;
}

.timezone-info {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #e3f2fd;
    color: #1565c0;
    padding: 10px 20px;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
}

.timezone-info i {
    font-size: 1rem;
}

/* Date Navigation */
.date-navigation {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 30px;
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 15px;
    border: 2px solid #e9ecef;
}

.nav-btn {
    background: #1B4D89;
    color: white;
    border: none;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1.2rem;
}

.nav-btn:hover {
    background: #2c5aa0;
    transform: scale(1.1);
}

.nav-btn:disabled {
    background: #ccc;
    cursor: not-allowed;
    transform: none;
}

.current-week {
    display: flex;
    flex-direction: column;
    gap: 15px;
    align-items: center;
}

.week-range {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1B4D89;
    margin-bottom: 10px;
}

.week-dates {
    display: flex;
    gap: 15px;
    align-items: center;
}

.week-date {
    text-align: center;
    padding: 15px 20px;
    background: white;
    border-radius: 12px;
    border: 2px solid #e9ecef;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 80px;
}

.week-date:hover {
    border-color: #1B4D89;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(27, 77, 137, 0.2);
}

.week-date.selected {
    background: #1B4D89;
    color: white;
    border-color: #1B4D89;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(27, 77, 137, 0.3);
}

.week-date.disabled {
    background: #f8f9fa;
    color: #ccc;
    cursor: not-allowed;
    opacity: 0.6;
}

.week-date.disabled:hover {
    transform: none;
    box-shadow: none;
}

.day-name {
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 5px;
    opacity: 0.8;
}

.day-number {
    font-size: 1.2rem;
    font-weight: 700;
}

/* Time Slots Container */
.time-slots-container {
    margin-top: 30px;
    background: #f8f9fa;
    border-radius: 15px;
    padding: 25px;
    border: 2px solid #e9ecef;
}

.time-slots-header {
    text-align: center;
    margin-bottom: 25px;
}

.time-slots-header h4 {
    color: #1B4D89;
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 8px;
}

.time-instructions {
    color: #666;
    font-size: 0.95rem;
    font-style: italic;
}

.time-slots-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 12px;
    max-height: 300px;
    overflow-y: auto;
    padding: 10px;
}

.time-slot {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 15px 10px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    font-weight: 600;
    color: #1B4D89;
}

.time-slot:hover {
    border-color: #1B4D89;
    background: rgba(27, 77, 137, 0.05);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(27, 77, 137, 0.2);
}

.time-slot.selected {
    background: #1B4D89;
    color: white;
    border-color: #1B4D89;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(27, 77, 137, 0.3);
}

.time-slot.unavailable {
    background: #f8f9fa;
    color: #ccc;
    border-color: #e9ecef;
    cursor: not-allowed;
    opacity: 0.6;
}

.time-slot.unavailable:hover {
    transform: none;
    box-shadow: none;
}

/* Booking Error */
.booking-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    border-radius: 10px;
    padding: 15px 20px;
    margin-top: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    animation: slideDown 0.3s ease;
}

.booking-error i {
    font-size: 1.2rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-booking-section {
        padding: 20px;
    }
    
    .booking-header h3 {
        font-size: 1.6rem;
        flex-direction: column;
        gap: 8px;
    }
    
    .date-navigation {
        flex-direction: column;
        gap: 20px;
        padding: 15px;
    }
    
    .current-week {
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }
    
    .week-date {
        min-width: 70px;
        padding: 12px 15px;
    }
    
    .time-slots-grid {
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 8px;
    }
    
    .time-slot {
        padding: 12px 8px;
        font-size: 0.85rem;
    }
}

/* Selection Summary Styles */
.experimental-selection-summary {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 2px solid #1B4D89;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
}

.experimental-selection-summary h4 {
    color: #1B4D89;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 20px;
    text-align: center;
}

.summary-items {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.summary-item {
    background: white;
    padding: 15px;
    border-radius: 10px;
    border-left: 4px solid #1B4D89;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.summary-item strong {
    color: #1B4D89;
    display: block;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.summary-item span {
    color: #666;
    font-size: 0.95rem;
}

/* Coupon Code Section */
.experimental-coupon-section {
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 20px;
    margin: 20px 0;
}

.experimental-coupon-section h4 {
    color: #1B4D89;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 15px;
    text-align: center;
}

.coupon-input-group {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}

.coupon-code {
    flex: 1;
    margin-bottom: 0;
}

.btn-apply-coupon {
    background: #28a745;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 0.9rem;
    white-space: nowrap;
}

.btn-apply-coupon:hover {
    background: #218838;
    transform: translateY(-1px);
}

.coupon-message {
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    font-weight: 500;
}

.coupon-message.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.coupon-message.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Payment Summary */
.experimental-payment-summary {
    background: white;
    border: 2px solid #1B4D89;
    border-radius: 10px;
    padding: 20px;
    margin: 20px 0;
}

.payment-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #e9ecef;
}

.payment-item:last-child {
    border-bottom: none;
}

.total-item {
    background: #f8f9fa;
    margin: 10px -20px -20px -20px;
    padding: 15px 20px;
    border-radius: 0 0 8px 8px;
    border-top: 2px solid #1B4D89;
}

.discount-item {
    color: #28a745;
}

.final-amount {
    font-weight: 700;
}

/* Hide original navigation buttons - use floating ones instead */
.experimental-tab-content .text-center {
    display: none !important;
}

/* Floating Navigation Buttons */
.floating-nav {
    position: fixed;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000;
    display: flex;
    gap: 15px;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.floating-nav.show {
    opacity: 1;
    visibility: visible;
}

.floating-btn {
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    color: white;
    border: none;
    padding: 15px 25px;
    border-radius: 50px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(27, 77, 137, 0.3);
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 140px;
    justify-content: center;
}

.floating-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(27, 77, 137, 0.4);
}

.floating-btn.btn-back {
    background: #6c757d;
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
}

.floating-btn.btn-back:hover {
    background: #5a6268;
    box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
}

.floating-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

@media (max-width: 768px) {
    .floating-nav {
        bottom: 20px;
        left: 20px;
        right: 20px;
        transform: none;
        flex-direction: column;
    }
    
    .floating-btn {
        width: 100%;
        padding: 12px 20px;
        font-size: 0.9rem;
    }
}

@media (max-width: 768px) {
    .summary-items {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .modern-calendar-wrapper {
        padding: 15px;
    }
    
    .timeslot-header {
        padding: 12px;
    }
}

.experimental-confirmation-table {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.experimental-confirmation-table table {
    width: 100%;
    margin: 0;
}

.experimental-confirmation-table th {
    background: #1B4D89;
    color: white;
    padding: 15px;
    font-weight: 600;
    text-align: left;
}

.experimental-confirmation-table td {
    padding: 15px;
    border-bottom: 1px solid #e9ecef;
}

.experimental-alert {
    background: #d4edda;
    color: #155724;
    padding: 12px 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    border: 1px solid #c3e6cb;
    font-size: 0.9rem;
}

.experimental-loading {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}

.experimental-loading.show {
    display: flex;
}

.experimental-loading-content {
    background: white;
    padding: 40px;
    border-radius: 15px;
    text-align: center;
}

.experimental-loading-spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #eef3f6;
    border-top: 4px solid #ffaf02;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto 15px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@media (max-width: 768px) {
    .experimental-appointment-hero {
        padding: 40px 0;
    }
    
    .experimental-appointment-hero h1 {
        font-size: 2.2rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .hero-stats {
        gap: 20px;
        margin: 30px 0;
    }
    
    .stat-item {
        padding: 15px 20px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .hero-cta-btn {
        padding: 15px 30px;
        font-size: 1.1rem;
    }
    
    .success-stories-content h2 {
        font-size: 2rem;
    }
    
    .success-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .testimonial-slider {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .experimental-appointment-section {
        padding: 30px 0;
    }
    
    .experimental-info-card,
    .experimental-form-section {
        padding: 20px 15px;
        margin-bottom: 20px;
    }
    
    .experimental-info-card h2 {
        font-size: 1.8rem;
        flex-direction: column;
        gap: 10px;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .trust-indicators {
        gap: 15px;
    }
    
    .trust-item {
        padding: 12px 15px;
    }
    
    .experimental-info-list li {
        padding: 15px;
        margin-bottom: 12px;
    }
    
    .consultation-header {
        padding: 20px;
    }
    
    .consultation-header h3 {
        font-size: 1.5rem;
        flex-direction: column;
        gap: 8px;
    }
    
    .consultation-price {
        flex-direction: column;
        gap: 8px;
    }
    
    .price-amount {
        font-size: 1.8rem;
    }
    
    .service-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .service-title-section {
        order: 2;
    }
    
    .experimental-service-price {
        order: 3;
        text-align: center;
    }
    
    .service-benefits {
        justify-content: center;
    }
    
    .consultation-cta {
        padding: 20px;
        margin-top: 30px;
    }
    
    .urgency-notice {
        font-size: 0.85rem;
        padding: 10px 16px;
        margin-bottom: 20px;
    }
    
    .consultation-cta-btn {
        padding: 15px 30px;
        font-size: 1.1rem;
        margin-bottom: 15px;
    }
    
    .cta-guarantee {
        font-size: 0.8rem;
        flex-direction: column;
        gap: 5px;
    }
    
    .final-cta-section {
        padding: 25px;
        margin-top: 30px;
    }
    
    .final-motivation h4 {
        font-size: 1.4rem;
        flex-direction: column;
        gap: 8px;
    }
    
    .final-motivation p {
        font-size: 1rem;
    }
    
    .final-cta-buttons {
        flex-direction: column;
        gap: 15px;
    }
    
    .final-submit-btn {
        padding: 15px 30px;
        font-size: 1.1rem;
        min-width: auto;
        width: 100%;
    }
    
    .final-guarantees {
        gap: 15px;
    }
    
    .guarantee-item {
        padding: 12px 15px;
        min-width: 100px;
    }
    
    .guarantee-item i {
        font-size: 1.3rem;
    }
    
    .guarantee-item span {
        font-size: 0.8rem;
    }
    
    .experimental-tab-nav {
        flex-direction: column;
        gap: 8px;
    }
    
    .experimental-tab-nav a {
        padding: 10px 15px;
        font-size: 0.85rem;
    }
    
    .experimental-calendar-container {
        flex-direction: column;
        gap: 15px;
    }
    
    .experimental-calendar,
    .experimental-timeslots {
        min-width: 100%;
    }
    
    .experimental-timeslot {
        min-width: 80px;
        padding: 8px 12px;
        font-size: 0.8rem;
    }
    
    .experimental-btn {
        padding: 10px 18px;
        font-size: 0.9rem;
        min-width: 100px;
    }
    
    .experimental-service-item {
        padding: 20px;
        margin-bottom: 12px;
    }
    
    .experimental-service-title {
        font-size: 1.1rem;
    }
    
    .experimental-service-price {
        font-size: 1.2rem;
    }
    
    .summary-items {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    
    .experimental-selection-summary {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .modern-calendar-wrapper {
        padding: 15px;
    }
    
    .timeslot-header {
        padding: 10px;
    }
    
    .modern-timeslots {
        max-height: 250px;
    }
    
    .coupon-input-group {
        flex-direction: column;
        gap: 10px;
    }
    
    .btn-apply-coupon {
        width: 100%;
    }
    
    .experimental-payment-summary {
        padding: 15px;
    }
    
    .payment-item {
        font-size: 0.9rem;
    }
}
</style>

<!-- Enhanced Hero Section with Motivational Elements -->
<section class="experimental-appointment-hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fa fa-shield"></i>
                <span>Trusted by 1000+ Clients</span>
            </div>
            <h1>Your Legal Journey Starts Here</h1>
            <p class="hero-subtitle">Get expert legal guidance from Melbourne's most trusted law firm. Book your consultation today and take the first step towards resolving your legal matter with confidence.</p>
            
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Years Experience</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Success Rate</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Support Available</div>
                </div>
            </div>
            
            <div class="hero-cta">
                <button class="hero-cta-btn" onclick="document.querySelector('.experimental-form-section').scrollIntoView({behavior: 'smooth'})">
                    <i class="fa fa-calendar-check-o"></i>
                    Book Your Free Consultation
                </button>
                <p class="cta-note">✓ No obligation • ✓ Confidential • ✓ Expert advice</p>
            </div>
        </div>
    </div>
</section>

<!-- Motivational Success Stories Section -->
<section class="success-stories-section">
    <div class="container">
        <div class="success-stories-content">
            <h2>Why Choose Bansal Lawyers?</h2>
            <p class="section-subtitle">Join thousands of satisfied clients who have successfully resolved their legal matters with our expert guidance</p>
            
            <div class="success-grid">
                <div class="success-card">
                    <div class="success-icon">
                        <i class="fa fa-trophy"></i>
                    </div>
                    <h3>Proven Track Record</h3>
                    <p>98% success rate in immigration cases and 95% in family law matters. Our expertise speaks for itself.</p>
                </div>
                
                <div class="success-card">
                    <div class="success-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <h3>1000+ Happy Clients</h3>
                    <p>From individuals to families, we've helped clients from all walks of life achieve their legal goals.</p>
                </div>
                
                <div class="success-card">
                    <div class="success-icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <h3>15+ Years Experience</h3>
                    <p>Decades of experience in Australian law with deep understanding of local regulations and processes.</p>
                </div>
            </div>
            
            <div class="testimonial-slider">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="quote-icon">
                            <i class="fa fa-quote-left"></i>
                        </div>
                        <p>"Bansal Lawyers helped me get my permanent residency when I thought it was impossible. Their expertise and dedication made all the difference. Highly recommended!"</p>
                        <div class="testimonial-author">
                            <strong>Sarah M.</strong>
                            <span>Immigration Client</span>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="quote-icon">
                            <i class="fa fa-quote-left"></i>
                        </div>
                        <p>"Professional, compassionate, and incredibly knowledgeable. They guided me through my divorce proceedings with care and expertise. Thank you!"</p>
                        <div class="testimonial-author">
                            <strong>Michael R.</strong>
                            <span>Family Law Client</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experimental Appointment Section -->
<section class="experimental-appointment-section">
    <div class="container">
        <!-- Enhanced Information Card with Trust Elements -->
        <div class="experimental-info-card">
            <div class="info-header">
                <h2><i class="fa fa-calendar-check-o"></i> Ready to Get Started?</h2>
                <p class="info-subtitle">Book your consultation in just a few simple steps and take control of your legal situation</p>
            </div>
            
            <div class="info-grid">
                <div class="info-section">
                    <h3><i class="fa fa-shield"></i> What You Get</h3>
                    <ul class="experimental-info-list">
                        <li>
                            <strong>Expert Legal Advice:</strong>
                            <span>Professional guidance from experienced lawyers specializing in your area of need.</span>
                        </li>
                        <li>
                            <strong>Multiple Consultation Options:</strong>
                            <span>In-person, phone, or video consultations - choose what works best for you.</span>
                        </li>
                        <li>
                            <strong>Confidential & Secure:</strong>
                            <span>Your information is protected with the highest level of confidentiality.</span>
                        </li>
                        <li>
                            <strong>Clear Next Steps:</strong>
                            <span>Leave with a clear action plan tailored to your specific situation.</span>
                        </li>
                    </ul>
                </div>
                
                <div class="info-section">
                    <h3><i class="fa fa-info-circle"></i> Booking Details</h3>
                    <ul class="experimental-info-list">
                        <li>
                            <strong>Consultation Fee:</strong>
                            <span><strong>$150 AUD</strong> (incl. GST) - One-time payment, no hidden fees.</span>
                        </li>
                        <li>
                            <strong>Flexible Scheduling:</strong>
                            <span>Book appointments that fit your schedule, including evenings and weekends.</span>
                        </li>
                        <li>
                            <strong>Cancellation Policy:</strong>
                            <span>Free cancellation/rescheduling up to 24 hours in advance.</span>
                        </li>
                        <li>
                            <strong>Emergency Support:</strong>
                            <span>Urgent matters? Contact us directly for priority consultation.</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="trust-indicators">
                <div class="trust-item">
                    <i class="fa fa-lock"></i>
                    <span>SSL Secured</span>
                </div>
                <div class="trust-item">
                    <i class="fa fa-certificate"></i>
                    <span>Licensed Lawyers</span>
                </div>
                <div class="trust-item">
                    <i class="fa fa-star"></i>
                    <span>5-Star Rated</span>
                </div>
                <div class="trust-item">
                    <i class="fa fa-clock-o"></i>
                    <span>Quick Response</span>
                </div>
            </div>
            
            <div class="experimental-contact-info">
                <h4><i class="fa fa-phone"></i> Need Immediate Assistance?</h4>
                <p>Call us at <strong>1300 BANSAL (1300 226 725)</strong> or email for personalized help with your booking.</p>
            </div>
        </div>

        <!-- Appointment Form -->
        <div class="experimental-form-section">
            <form class="experimental-appointment-form" id="appintment_form" action="<?php echo URL::to('/'); ?>/book-an-appointment/storepaid" method="post" enctype="multipart/form-data">
                <!-- Tab Navigation -->
                <div class="experimental-form-tabs">
                    <ul class="experimental-tab-nav">
                        <li>
                            <a href="#consultation_type" class="experimental-tab-link active" data-tab="consultation_type">
                                <i class="fa fa-calendar mr-2"></i>Consultation Type
                            </a>
                        </li>
                        <li>
                            <a href="#appointment_details" class="experimental-tab-link disabled" data-tab="appointment_details">
                                <i class="fa fa-clock mr-2"></i>Date & Time
                            </a>
                        </li>
                        <li>
                            <a href="#info" class="experimental-tab-link disabled" data-tab="info">
                                <i class="fa fa-user mr-2"></i>Your Information
                            </a>
                        </li>
                        <li>
                            <a href="#confirm" class="experimental-tab-link disabled" data-tab="confirm">
                                <i class="fa fa-check-circle mr-2"></i>Confirmation
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="experimental-tab-content active" id="consultation_type">
                    <div class="consultation-header">
                        <h3><i class="fa fa-calendar-plus-o"></i> Choose Your Consultation Type</h3>
                        <p class="consultation-subtitle">Select the consultation method that works best for you. All consultations include expert legal advice and a clear action plan.</p>
                        <div class="consultation-price">
                            <span class="price-label">One-time fee:</span>
                            <span class="price-amount">$150 AUD</span>
                            <span class="price-note">(incl. GST • No hidden fees)</span>
                        </div>
                    </div>
                        
                        <div class="consultation-options">
                            <div class="experimental-service-item" id="consultation_inperson">
                                <input type="radio" class="consultation_type" name="consultation_type" value="In-person" id="inperson">
                                <label for="inperson" style="cursor: pointer; width: 100%;">
                                    <div class="service-header">
                                        <div class="service-icon">
                                            <i class="fa fa-building"></i>
                                        </div>
                                        <div class="service-title-section">
                                            <div class="experimental-service-title">In-Person Consultation</div>
                                            <div class="service-badge">Most Popular</div>
                                        </div>
                                        <div class="experimental-service-price"><strong>$150 AUD</strong></div>
                                    </div>
                                    <div class="experimental-service-description">
                                        <strong>Perfect for complex cases</strong> - Meet face-to-face with our experienced lawyers at our Melbourne office. Ideal for detailed document review, sensitive matters, and when you need the full personal touch.
                                    </div>
                                    <div class="service-benefits">
                                        <span class="benefit-item"><i class="fa fa-check"></i> Document review</span>
                                        <span class="benefit-item"><i class="fa fa-check"></i> Personal interaction</span>
                                        <span class="benefit-item"><i class="fa fa-check"></i> Secure environment</span>
                                    </div>
                                </label>
                            </div>

                            <div class="experimental-service-item" id="consultation_phone">
                                <input type="radio" class="consultation_type" name="consultation_type" value="Phone" id="phone">
                                <label for="phone" style="cursor: pointer; width: 100%;">
                                    <div class="service-header">
                                        <div class="service-icon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="service-title-section">
                                            <div class="experimental-service-title">Phone Consultation</div>
                                            <div class="service-badge">Quick & Easy</div>
                                        </div>
                                        <div class="experimental-service-price"><strong>$150 AUD</strong></div>
                                    </div>
                                    <div class="experimental-service-description">
                                        <strong>Convenient and accessible</strong> - Get expert legal advice from anywhere in Australia. Perfect for initial consultations, quick questions, and when you need immediate guidance.
                                    </div>
                                    <div class="service-benefits">
                                        <span class="benefit-item"><i class="fa fa-check"></i> From anywhere</span>
                                        <span class="benefit-item"><i class="fa fa-check"></i> Immediate advice</span>
                                        <span class="benefit-item"><i class="fa fa-check"></i> Flexible timing</span>
                                    </div>
                                </label>
                            </div>

                            <div class="experimental-service-item" id="consultation_video">
                                <input type="radio" class="consultation_type" name="consultation_type" value="Zoom / Google Meeting" id="video">
                                <label for="video" style="cursor: pointer; width: 100%;">
                                    <div class="service-header">
                                        <div class="service-icon">
                                            <i class="fa fa-video-camera"></i>
                                        </div>
                                        <div class="service-title-section">
                                            <div class="experimental-service-title">Video Consultation</div>
                                            <div class="service-badge">Modern Choice</div>
                                        </div>
                                        <div class="experimental-service-price"><strong>$150 AUD</strong></div>
                                    </div>
                                    <div class="experimental-service-description">
                                        <strong>Best of both worlds</strong> - Secure video calls via Zoom or Google Meet. Enjoy face-to-face interaction from the comfort of your home with screen sharing capabilities.
                                    </div>
                                    <div class="service-benefits">
                                        <span class="benefit-item"><i class="fa fa-check"></i> Visual interaction</span>
                                        <span class="benefit-item"><i class="fa fa-check"></i> Screen sharing</span>
                                        <span class="benefit-item"><i class="fa fa-check"></i> Home comfort</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="consultation-cta">
                        <div class="urgency-notice">
                            <i class="fa fa-clock-o"></i>
                            <span>Limited spots available this week - Book now to secure your preferred time</span>
                        </div>
                        <button type="button" class="experimental-btn next-tab consultation-cta-btn" data-next="appointment_details">
                            <i class="fa fa-arrow-right"></i>
                            Continue to Schedule
                        </button>
                        <p class="cta-guarantee">
                            <i class="fa fa-shield"></i>
                            <span>100% satisfaction guarantee • Free rescheduling • No hidden fees</span>
                        </p>
                    </div>
                </div>

                <div class="experimental-tab-content" id="appointment_details">
                    <div class="modern-booking-section">
                        <div class="booking-header">
                            <h3><i class="fa fa-calendar"></i> Select Date & Time</h3>
                            <p class="booking-subtitle">Choose your preferred consultation time from the available slots</p>
                            <div class="timezone-info">
                                <i class="fa fa-clock-o"></i> 
                                <span>All times are in Melbourne, Australia time (AEST/AEDT)</span>
                            </div>
                        </div>
                        
                        <div class="modern-calendar-container">
                            <!-- Date Navigation -->
                            <div class="date-navigation">
                                <button type="button" class="nav-btn prev-week" id="prevWeek">
                                    <i class="fa fa-chevron-left"></i>
                                </button>
                                <div class="current-week" id="currentWeek">
                                    <!-- Week dates will be populated here -->
                                </div>
                                <button type="button" class="nav-btn next-week" id="nextWeek">
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                            
                            <!-- Calendar Grid -->
                            <div class="calendar-grid" id="calendarGrid">
                                <!-- Calendar will be populated here -->
                            </div>
                            
                            <!-- Time Slots -->
                            <div class="time-slots-container" id="timeSlotsContainer" style="display: none;">
                                <div class="time-slots-header">
                                    <h4 id="selectedDateDisplay">Select a date first</h4>
                                    <p class="time-instructions">Choose your preferred time slot</p>
                                </div>
                                <div class="time-slots-grid" id="timeSlotsGrid">
                                    <!-- Time slots will be populated here -->
                                </div>
                            </div>
                        </div>
                        
                        <!-- Hidden inputs for form submission -->
                        <input type="hidden" id="timeslot_col_date" name="selected_date" value="">
                        <input type="hidden" id="timeslot_col_time" name="selected_time" value="">
                        <input type="hidden" name="date" id="date_input" value="">
                        <input type="hidden" name="time" id="time_input" value="">
                        
                        <!-- Promo code hidden inputs -->
                        <input type="hidden" name="coupon_code" value="">
                        <input type="hidden" name="discount_amount" value="">
                        <input type="hidden" name="discount_percentage" value="">
                        
                        <!-- Backend required fields -->
                        <input type="hidden" name="service_id" value="1">
                        <input type="hidden" name="appointment_details" value="">
                        <input type="hidden" name="cardName" value="">
                        <input type="hidden" name="stripeToken" value="">
                        <input type="hidden" name="promo_code" value="">
                        
                        <!-- Error message -->
                        <div class="booking-error" id="bookingError" style="display: none;">
                            <i class="fa fa-exclamation-triangle"></i>
                            <span>Please select both a date and time for your consultation</span>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="button" class="experimental-btn btn-back" data-prev="consultation_type">Back</button>
                        <button type="button" class="experimental-btn next-tab" data-next="info">Next Step</button>
                    </div>
                </div>

                <div class="experimental-tab-content" id="info">
                    <!-- Selection Summary -->
                    <div class="experimental-selection-summary">
                        <h4><i class="fa fa-check-circle mr-2"></i>Your Selection Summary</h4>
                        <div class="summary-items">
                            <div class="summary-item">
                                <strong>Consultation Type:</strong>
                                <span class="consultation-type-summary">Not selected</span>
                            </div>
                            <div class="summary-item">
                                <strong>Date & Time:</strong>
                                <span class="datetime-summary">Not selected</span>
                            </div>
                        </div>
                    </div>

                    <div class="experimental-form-group">
                        <label for="noe_id">Type of Legal Matter</label>
                        <select class="experimental-form-control enquiry_item" name="noe_id" required>
                            <option value="">Select the type of legal matter</option>
                            @foreach(\App\Models\NatureOfEnquiry::where('status',1)->get() as $enquiry)
                                <option value="{{$enquiry->id}}">{{$enquiry->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="experimental-form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="experimental-form-control fullname infoFormFields" placeholder="Enter your full name" name="fullname" required />
                    </div>
                    <div class="experimental-form-group">
                        <label for="email">Email</label>
                        <input type="email" class="experimental-form-control email infoFormFields" placeholder="Enter your email address" name="email" required />
                    </div>
                    <div class="experimental-form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="experimental-form-control phone infoFormFields" placeholder="Enter your phone number" name="phone" required />
                    </div>
                    <div class="experimental-form-group">
                        <label for="description">Details Of Enquiry</label>
                        <textarea class="experimental-form-control experimental-textarea description infoFormFields" placeholder="Please provide details about your legal matter" name="description" required></textarea>
                    </div>
                    
                    <div class="text-center">
                        <button type="button" class="experimental-btn btn-back" data-prev="appointment_details">Back</button>
                        <button type="button" class="experimental-btn next-tab" data-next="confirm">Review & Confirm</button>
                    </div>
                </div>

                <div class="experimental-tab-content" id="confirm">
                    <h3 style="color: #1B4D89; margin-bottom: 30px; text-align: center;">Confirm Your Appointment Details</h3>
                    
                    <div class="experimental-confirmation-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Consultation Type</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="consultation_type"></td>
                                    <td class="full_name"></td>
                                    <td class="email"></td>
                                    <td class="phone"></td>
                                    <td class="description"></td>
                                    <td class="date"></td>
                                    <td class="time"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Coupon Code Section -->
                    <div class="experimental-coupon-section">
                        <h4><i class="fa fa-ticket mr-2"></i>Have a Promo Code?</h4>
                        <div class="coupon-input-group">
                            <input type="text" class="experimental-form-control coupon-code" placeholder="Enter your promo code" name="coupon_code" id="coupon_code">
                            <button type="button" class="experimental-btn btn-apply-coupon" id="apply_coupon">
                                <i class="fa fa-check mr-2"></i>Apply
                            </button>
                        </div>
                        <div class="coupon-message" id="coupon_message" style="display: none;"></div>
                    </div>
                    
                    <!-- Payment Summary -->
                    <div class="experimental-payment-summary">
                        <div class="payment-item">
                            <span>Consultation Fee:</span>
                            <span class="consultation-fee">$150.00 AUD</span>
                        </div>
                        <div class="payment-item discount-item" style="display: none;">
                            <span>Discount:</span>
                            <span class="discount-amount">-$0.00 AUD</span>
                        </div>
                        <div class="payment-item total-item">
                            <span><strong>Total:</strong></span>
                            <span class="total-amount"><strong>$150.00 AUD</strong></span>
                        </div>
                    </div>
                    
                    <div class="final-cta-section">
                        <div class="final-motivation">
                            <h4><i class="fa fa-star"></i> You're Almost There!</h4>
                            <p>Complete your booking now and take the first step towards resolving your legal matter with confidence. Our expert team is ready to help you succeed.</p>
                        </div>
                        
                        <div class="final-cta-buttons">
                            <button type="button" class="experimental-btn btn-back" data-prev="info">
                                <i class="fa fa-arrow-left"></i> Back
                            </button>
                            <button type="button" class="experimental-btn submitappointment_paid final-submit-btn">
                                <i class="fa fa-credit-card"></i>
                                <span class="btn-text">Complete Booking</span>
                                <span class="btn-price">$150.00 AUD</span>
                            </button>
                        </div>
                        
                        <div class="final-guarantees">
                            <div class="guarantee-item">
                                <i class="fa fa-shield"></i>
                                <span>Secure Payment</span>
                            </div>
                            <div class="guarantee-item">
                                <i class="fa fa-clock-o"></i>
                                <span>Instant Confirmation</span>
                            </div>
                            <div class="guarantee-item">
                                <i class="fa fa-undo"></i>
                                <span>Free Rescheduling</span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Floating Navigation -->
<div class="floating-nav" id="floatingNav">
    <button type="button" class="floating-btn btn-back" id="floatingBackBtn" style="display: none;">
        <i class="fa fa-arrow-left"></i>
        Back
    </button>
    <button type="button" class="floating-btn" id="floatingNextBtn" style="display: none;">
        <span class="btn-text">Next</span>
        <i class="fa fa-arrow-right"></i>
    </button>
</div>

<!-- Loading Overlay -->
<div class="experimental-loading" id="loading">
    <div class="experimental-loading-content">
        <div class="experimental-loading-spinner"></div>
        <p>Processing your appointment...</p>
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$(function() {
    // Tab navigation
    $('.next-tab').click(function() {
        var nextTab = $(this).data('next');
        var currentTab = $('.experimental-tab-content.active').attr('id');
        
        // Validate current tab before proceeding
        if (validateCurrentTab(currentTab)) {
            switchTab(nextTab);
        }
    });
    
    // Back button navigation
    $('.btn-back').click(function() {
        var prevTab = $(this).data('prev');
        switchTab(prevTab);
    });
    
     // Floating navigation
     $('#floatingNextBtn').click(function() {
         var currentTab = $('.experimental-tab-content.active').attr('id');
         
         if (currentTab === 'confirm') {
             // On confirmation tab, trigger form submission
             $('.submitappointment_paid').click();
         } else if (currentTab === 'info') {
             // Information page - validate before proceeding
             if (validateCurrentTab(currentTab)) {
                 switchTab('confirm');
             } else {
                 // Show validation errors
                 console.log('Validation failed on info page');
                 
                 // Create detailed error message
                 var missingFields = window.missingFields || [];
                 var errorText = 'Please complete the following required fields:';
                 var fieldList = '<ul style="margin: 10px 0; padding-left: 20px;">';
                 missingFields.forEach(function(field) {
                     fieldList += '<li>' + field + '</li>';
                 });
                 fieldList += '</ul>';
                 
                 // Remove any existing error messages
                 $('.validation-error-message').remove();
                 
                 // Show detailed error message
                 var $errorMsg = $('<div class="validation-error-message">' + errorText + fieldList + '</div>');
                 $('.experimental-selection-summary').after($errorMsg);
                 
                 // Remove error message after 5 seconds
                 setTimeout(function() {
                     $errorMsg.fadeOut(function() {
                         $(this).remove();
                     });
                 }, 5000);
                 
                 // Scroll to first error field
                 var $firstError = $('.experimental-form-control').filter(function() {
                     return $(this).hasClass('error') || $(this).val() === '';
                 }).first();
                 if ($firstError.length) {
                     // Removed scroll behavior - keep user in place
                     $firstError.focus();
                 }
             }
         } else {
             var nextTab = getNextTab(currentTab);
             if (nextTab && validateCurrentTab(currentTab)) {
                 switchTab(nextTab);
             }
         }
     });
     
     // Handle the "Review & Confirm" button specifically
     $('.next-tab[data-next="confirm"]').click(function(e) {
         e.preventDefault();
         var currentTab = $('.experimental-tab-content.active').attr('id');
         console.log('Review & Confirm button clicked, current tab:', currentTab);
         
         if (currentTab === 'info') {
             if (validateCurrentTab(currentTab)) {
                 console.log('Validation passed, switching to confirm tab');
                 switchTab('confirm');
             } else {
                 console.log('Validation failed, showing errors');
                 // Show validation errors
                 var missingFields = window.missingFields || [];
                 var errorText = 'Please complete the following required fields:';
                 var fieldList = '<ul style="margin: 10px 0; padding-left: 20px;">';
                 missingFields.forEach(function(field) {
                     fieldList += '<li>' + field + '</li>';
                 });
                 fieldList += '</ul>';
                 
                 // Remove any existing error messages
                 $('.validation-error-message').remove();
                 
                 // Show detailed error message
                 var $errorMsg = $('<div class="validation-error-message">' + errorText + fieldList + '</div>');
                 $('.experimental-selection-summary').after($errorMsg);
                 
                 // Remove error message after 5 seconds
                 setTimeout(function() {
                     $errorMsg.fadeOut(function() {
                         $(this).remove();
                     });
                 }, 5000);
                 
                 // Scroll to first error field
                 var $firstError = $('.experimental-form-control').filter(function() {
                     return $(this).hasClass('error') || $(this).val() === '';
                 }).first();
                 if ($firstError.length) {
                     // Removed scroll behavior - keep user in place
                     $firstError.focus();
                 }
             }
         }
     });
    
    $('#floatingBackBtn').click(function() {
        var currentTab = $('.experimental-tab-content.active').attr('id');
        var prevTab = getPrevTab(currentTab);
        
        if (prevTab) {
            switchTab(prevTab);
        }
    });
    
    function switchTab(tabId) {
        console.log('Switching to tab:', tabId);
        
        // Hide current tab with fade effect
        $('.experimental-tab-content').fadeOut(300, function() {
            $('.experimental-tab-content').removeClass('active');
            $('.experimental-tab-link').removeClass('active').addClass('disabled');
            
            // Show target tab
            $('#' + tabId).addClass('active');
            $('[data-tab="' + tabId + '"]').removeClass('disabled').addClass('active');
            
            // Update floating navigation
            updateFloatingNavigation();
            
            // Fade in new tab
            $('#' + tabId).fadeIn(300);
            
            // Removed scroll behavior - keep user in place
        });
    }
    
    function getNextTab(currentTab) {
        var tabOrder = ['consultation_type', 'appointment_details', 'info', 'confirm'];
        var currentIndex = tabOrder.indexOf(currentTab);
        return currentIndex < tabOrder.length - 1 ? tabOrder[currentIndex + 1] : null;
    }
    
    function getPrevTab(currentTab) {
        var tabOrder = ['consultation_type', 'appointment_details', 'info', 'confirm'];
        var currentIndex = tabOrder.indexOf(currentTab);
        return currentIndex > 0 ? tabOrder[currentIndex - 1] : null;
    }
    
     function updateFloatingNavigation() {
         var currentTab = $('.experimental-tab-content.active').attr('id');
         var $floatingNav = $('#floatingNav');
         var $backBtn = $('#floatingBackBtn');
         var $nextBtn = $('#floatingNextBtn');
         
         console.log('Updating floating navigation for tab:', currentTab);
         
         // Show floating nav if not on first tab
         if (currentTab !== 'consultation_type') {
             $floatingNav.addClass('show');
             $backBtn.show();
             console.log('Showing back button');
         } else {
             $floatingNav.removeClass('show');
             $backBtn.hide();
             console.log('Hiding back button');
         }
         
         // Show next button based on tab
         if (currentTab === 'info') {
             // Information page - always show next button
             $nextBtn.show();
             $nextBtn.find('.btn-text').text('Review & Confirm');
             $nextBtn.html('<span class="btn-text">Review & Confirm</span><i class="fa fa-arrow-right"></i>');
             console.log('Showing next button for info page (permanent)');
         } else if (currentTab === 'confirm') {
             // Confirmation page - always show pay & submit button
             $nextBtn.show();
             $nextBtn.find('.btn-text').text('Pay & Submit');
             $nextBtn.html('<i class="fa fa-credit-card mr-2"></i><span class="btn-text">Pay & Submit</span>');
             console.log('Showing pay & submit button for confirm page (permanent)');
         } else if (currentTab && currentTab !== 'confirm') {
             // Other tabs - show next button only if valid
             var isValid = validateCurrentTab(currentTab);
             console.log('Tab validation result for', currentTab, ':', isValid);
             if (isValid) {
                 $nextBtn.show();
                 $nextBtn.find('.btn-text').text('Next');
                 console.log('Showing next button for', currentTab);
             } else {
                 $nextBtn.hide();
                 console.log('Hiding next button - validation failed for', currentTab);
             }
         } else {
             $nextBtn.hide();
             console.log('Hiding next button - no tab or invalid tab');
         }
     }
     
     // Prevent default behavior for the Review & Confirm button to avoid conflicts
     $('.next-tab[data-next="confirm"]').on('click', function(e) {
         e.preventDefault();
         e.stopPropagation();
     });
    
    // Tab link clicks
    $('.experimental-tab-link').click(function(e) {
        e.preventDefault();
        var tab = $(this).data('tab');
        
        if (!$(this).hasClass('disabled')) {
            $('.experimental-tab-content').removeClass('active');
            $('.experimental-tab-link').removeClass('active');
            
            $('#' + tab).addClass('active');
            $(this).addClass('active');
        }
    });
    
    // Consultation type selection
    $('.consultation_type').change(function() {
        var consultationType = $(this).val();
        var $selectedItem = $(this).closest('.experimental-service-item');
        
        console.log('Consultation type selected:', consultationType);
        
        // Visual feedback - highlight selected item
        $selectedItem.addClass('selected');
        
        $('input[name="appointment_details"]').val(consultationType);
        
        // Update selection summary
        updateSelectionSummary();
        
        // Enable next tab
        $('[data-tab="appointment_details"]').removeClass('disabled');
        
        // Update floating navigation
        updateFloatingNavigation();
        
        // Show processing message
        var $processingMsg = $('<div class="processing-message">Processing your selection...</div>');
        $selectedItem.append($processingMsg);
        
        // Automatically proceed to next page after a short delay
        setTimeout(function() {
            console.log('Auto-proceeding to appointment details...');
            if (validateCurrentTab('consultation_type')) {
                console.log('Validation passed, switching to appointment_details');
                switchTab('appointment_details');
            } else {
                console.log('Validation failed, not switching tabs');
            }
        }, 800); // 800ms delay to show selection feedback
    });
    
    // Form field changes - REMOVED date/time clearing logic
    // The previous logic was clearing date/time fields every time user typed in info fields
    // This was causing validation failures when user clicked "Review & Confirm"
    $('.infoFormFields').change(function() {
        // Only hide confirm row, don't clear date/time fields
        $('.confirm_row').hide();
    });
    
    // Proper date/time clearing - only when consultation type changes
    $('.consultation_type').change(function() {
        // Clear date/time when consultation type changes
        clearDateTimeSelection();
    });
    
    function clearDateTimeSelection() {
        // Clear JavaScript variables
        selectedDate = null;
        selectedTime = null;
        
        // Clear form fields
        $('#timeslot_col_date').val("");
        $('#timeslot_col_time').val("");
        $('input[name="date"]').val("");
        $('input[name="time"]').val("");
        $('#date_input').val("");
        $('#time_input').val("");
        
        // Clear UI selections
        $('.week-date').removeClass('selected');
        $('.time-slot').removeClass('selected');
        
        // Hide time slots
        $('#timeSlotsContainer').hide();
        
        // Update floating navigation
        updateFloatingNavigation();
        
        console.log('Date/time selection cleared due to consultation type change');
    }
    
    // Enquiry selection
    $('.enquiry_item').change(function() {
        var id = $(this).val();
        var $select = $(this);
        console.log('Legal matter selected:', id);
        
        if (id != "") {
            $('input[name="noe_id"]').val(id);
            
            // Visual feedback - highlight the select
            $select.addClass('selected');
            setTimeout(function() {
                $select.removeClass('selected');
            }, 1000);
            
            // Enable services tab
            $('[data-tab="services"]').removeClass('disabled');
            $('.services_item').prop('checked', true);
            $('#service_id').val(1);
        }
        
        // Update floating navigation immediately when enquiry changes
        console.log('Updating floating navigation after matter selection...');
        updateFloatingNavigation();
        
        // Also update confirmation details
        updateConfirmationDetails();
    });
    
    // Time slot selection
    $(document).delegate('.timeslot_col', 'click', function() {
        if ($(this).hasClass('unavailable') || $(this).attr('disabled')) {
            console.log('Timeslot unavailable or disabled');
            return;
        }
        
        console.log('Timeslot clicked:', $(this).text());
        
        $('.timeslot_col').removeClass('active');
        $(this).addClass('active');
        
        var fromtime = $(this).attr('data-fromtime');
        var totime = $(this).attr('data-totime');
        
        console.log('Setting time:', fromtime + '-' + totime);
        
        $('input[name="time"]').val(fromtime + '-' + totime);
        $('#timeslot_col_time').val(fromtime + '-' + totime);
        $('#time_input').val(fromtime + '-' + totime);
        
        // Update selection summary
        updateSelectionSummary();
        
        // Update floating navigation
        updateFloatingNavigation();
        
        console.log('Timeslot selection complete');
    });
    
    // Form submission
    $('.submitappointment_paid').click(function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            $('#loading').addClass('show');
            
            // Disable submit button and show loading state
            var $submitBtn = $('.submitappointment_paid');
            $submitBtn.prop('disabled', true);
            var originalText = $submitBtn.find('.btn-text').text();
            $submitBtn.find('.btn-text').text('Processing...');
            
            // Prepare form data
            var formData = {
                service_id: $('input[name="service_id"]').val(),
                noe_id: $('select[name="noe_id"]').val(),
                fullname: $('input[name="fullname"]').val(),
                email: $('input[name="email"]').val(),
                phone: $('input[name="phone"]').val(),
                date: $('input[name="date"]').val(),
                time: $('input[name="time"]').val(),
                description: $('textarea[name="description"]').val(),
                appointment_details: $('input[name="appointment_details"]').val(),
                consultation_type: $('input[name="consultation_type"]:checked').val(),
                promo_code: $('input[name="promo_code"]').val(),
                discount_amount: $('input[name="discount_amount"]').val(),
                discount_percentage: $('input[name="discount_percentage"]').val(),
                cardName: $('input[name="fullname"]').val(), // Use fullname as cardName
                stripeToken: 'experimental_' + Date.now() // Generate token for experimental bookings
            };
            
            // Add CSRF token
            formData._token = $('meta[name="csrf-token"]').attr('content');
            
            console.log('Submitting form data:', formData);
            
            // Submit to backend
            $.ajax({
                url: '/book-an-appointment/storepaid',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#loading').removeClass('show');
                    
                    // Re-enable submit button
                    $submitBtn.prop('disabled', false);
                    $submitBtn.find('.btn-text').text(originalText);
                    
                    if (response.success) {
                        // Success - show confirmation
                        showSuccessMessage('Appointment booked successfully! You will receive a confirmation email shortly.');
                        
                        // Reset form after 3 seconds
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    } else {
                        // Backend validation error
                        showErrorMessage(response.message || 'An error occurred while booking your appointment.');
                    }
                },
                error: function(xhr) {
                    $('#loading').removeClass('show');
                    
                    // Re-enable submit button
                    $submitBtn.prop('disabled', false);
                    $submitBtn.find('.btn-text').text(originalText);
                    
                    var errorMessage = 'An error occurred while booking your appointment.';
                    
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.status === 422) {
                        errorMessage = 'Please check all required fields and try again.';
                    } else if (xhr.status === 500) {
                        errorMessage = 'Server error. Please try again later.';
                    }
                    
                    showErrorMessage(errorMessage);
                    console.error('Form submission error:', xhr);
                }
            });
        }
    });
    
    function validateCurrentTab(tabId) {
        switch(tabId) {
            case 'consultation_type':
                return $('.consultation_type:checked').length > 0;
             case 'appointment_details':
                 // Check multiple possible date/time field sources
                 var hasDate = $('#timeslot_col_date').val() !== '' || 
                              $('input[name="date"]').val() !== '' || 
                              $('#date_input').val() !== '' ||
                              (selectedDate && !isNaN(selectedDate.getTime()));
                 var hasTime = $('#timeslot_col_time').val() !== '' || 
                              $('input[name="time"]').val() !== '' || 
                              $('#time_input').val() !== '' ||
                              selectedTime !== null;
                 
                 console.log('Date validation - timeslot_col_date:', $('#timeslot_col_date').val());
                 console.log('Date validation - input[name="date"]:', $('input[name="date"]').val());
                 console.log('Date validation - selectedDate:', selectedDate);
                 console.log('Time validation - timeslot_col_time:', $('#timeslot_col_time').val());
                 console.log('Time validation - input[name="time"]:', $('input[name="time"]').val());
                 console.log('Time validation - selectedTime:', selectedTime);
                 console.log('Validation result - hasDate:', hasDate, 'hasTime:', hasTime);
                 
                 if (!hasDate || !hasTime) {
                     $('#bookingError').show();
                     return false;
                 } else {
                     $('#bookingError').hide();
                     return true;
                 }
            case 'info':
                return validateInfoTab();
            case 'confirm':
                return true; // Confirmation tab is always valid
            default:
                return true;
        }
    }
    
     function validateInfoTab() {
         var valid = true;
         var missingFields = [];
         
         console.log('Validating info tab...');
         
         // Clear previous errors
         $('.experimental-form-control').removeClass('error');
         $('.error-message').remove();
         $('.validation-error-message').remove();
         
         // Check full name
         if (!$('.fullname').val() || $('.fullname').val().trim() === '') {
             console.log('Full name missing');
             showError($('.fullname'), 'Full name is required');
             missingFields.push('Full Name');
             valid = false;
         }
         
         // Check email
         if (!$('.email').val() || $('.email').val().trim() === '' || !isValidEmail($('.email').val())) {
             console.log('Email missing or invalid');
             showError($('.email'), 'Valid email is required');
             missingFields.push('Email Address');
             valid = false;
         }
         
         // Check phone
         if (!$('.phone').val() || $('.phone').val().trim() === '') {
             console.log('Phone missing');
             showError($('.phone'), 'Phone number is required');
             missingFields.push('Phone Number');
             valid = false;
         }
         
         // Check description
         if (!$('.description').val() || $('.description').val().trim() === '') {
             console.log('Description missing');
             showError($('.description'), 'Description is required');
             missingFields.push('Details of Enquiry');
             valid = false;
         }
         
         // Check legal matter selection
         if (!$('.enquiry_item').val() || $('.enquiry_item').val() === '') {
             console.log('Legal matter not selected');
             showError($('.enquiry_item'), 'Please select a type of legal matter');
             missingFields.push('Type of Legal Matter');
             valid = false;
         }
         
         // Check consultation type
         if (!$('.consultation_type:checked').val()) {
             console.log('Consultation type not selected');
             missingFields.push('Consultation Type');
             valid = false;
         }
         
         // Check date and time
         var hasDate = $('#timeslot_col_date').val() !== '';
         var hasTime = $('#timeslot_col_time').val() !== '';
         if (!hasDate || !hasTime) {
             console.log('Date/time missing');
             $('#bookingError').show();
             missingFields.push('Date and Time');
             valid = false;
         } else {
             $('#bookingError').hide();
         }
         
         // Store missing fields for error display
         if (!valid) {
             window.missingFields = missingFields;
         } else {
             // Clear all errors if validation passes
             clearAllErrors();
         }
         
         console.log('Info tab validation result:', valid);
         console.log('Missing fields:', missingFields);
         return valid;
     }
    
    function validateForm() {
        return validateInfoTab();
    }
    
    function showError(field, message) {
        // Remove any existing error styling
        field.removeClass('is-invalid error');
        field.next('.invalid-feedback').remove();
        
        // Add error styling
        field.addClass('error');
        field.after('<div class="error-message invalid-feedback">' + message + '</div>');
        
        // Add visual highlight
        field.css({
            'border-color': '#dc3545',
            'box-shadow': '0 0 0 0.2rem rgba(220, 53, 69, 0.25)'
        });
    }
    
    function clearAllErrors() {
        $('.experimental-form-control').removeClass('error');
        $('.error-message').remove();
        $('.validation-error-message').remove();
        $('.experimental-form-control').css({
            'border-color': '',
            'box-shadow': '',
            'background-color': ''
        });
    }
    
    function isValidEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
     // Modern Calendar System
     let currentWeekStart = new Date();
     let selectedDate = null;
     let selectedTime = null;
     
     // Helper function to parse DD/MM/YYYY format dates
     function parseDateFromDDMMYYYY(dateStr) {
         if (!dateStr) return null;
         
         // Split the date string by '/'
         const parts = dateStr.split('/');
         if (parts.length !== 3) {
             console.error('Invalid date format:', dateStr);
             return null;
         }
         
         // DD/MM/YYYY format: parts[0] = day, parts[1] = month, parts[2] = year
         const day = parseInt(parts[0], 10);
         const month = parseInt(parts[1], 10) - 1; // JavaScript months are 0-based
         const year = parseInt(parts[2], 10);
         
         // Create date object
         const date = new Date(year, month, day);
         
         // Validate the date
         if (isNaN(date.getTime())) {
             console.error('Invalid date:', dateStr);
             return null;
         }
         
         return date;
     }
     
     // Initialize the modern calendar
     function initializeModernCalendar() {
         console.log('Initializing modern calendar...');
         
         // Set current week start to Monday
         const today = new Date();
         const dayOfWeek = today.getDay();
         const daysToMonday = dayOfWeek === 0 ? -6 : 1 - dayOfWeek;
         currentWeekStart = new Date(today);
         currentWeekStart.setDate(today.getDate() + daysToMonday);
         
         renderCalendar();
         setupEventListeners();
     }
     
     function renderCalendar() {
         const weekDates = [];
         const currentDate = new Date(currentWeekStart);
         
         // Generate 7 days starting from Monday
         for (let i = 0; i < 7; i++) {
             const date = new Date(currentDate);
             date.setDate(currentDate.getDate() + i);
             weekDates.push(new Date(date));
         }
         
         // Render week navigation
         const weekStart = weekDates[0];
         const weekEnd = weekDates[6];
         const weekRange = weekStart.toLocaleDateString('en-AU', { day: 'numeric', month: 'short' }) + 
                          ' - ' + weekEnd.toLocaleDateString('en-AU', { day: 'numeric', month: 'short' });
         
         $('#currentWeek').html(`
             <div class="week-range">${weekRange}</div>
             <div class="week-dates">
                 ${weekDates.map((date, index) => {
                     const dayName = date.toLocaleDateString('en-AU', { weekday: 'short' }).toUpperCase();
                     const dayNumber = date.getDate();
                     const isToday = isSameDay(date, new Date());
                     const isPast = date < new Date().setHours(0,0,0,0);
                     const isSelected = selectedDate && isSameDay(date, selectedDate);
                     
                     return `
                         <div class="week-date ${isPast ? 'disabled' : ''} ${isSelected ? 'selected' : ''}" 
                              data-date="${formatDateForInput(date)}" 
                              ${isPast ? 'disabled' : ''}>
                             <div class="day-name">${dayName}</div>
                             <div class="day-number">${dayNumber}</div>
                         </div>
                     `;
                 }).join('')}
             </div>
         `);
     }
     
     function setupEventListeners() {
         // Week navigation
         $('#prevWeek').off('click').on('click', function() {
             currentWeekStart.setDate(currentWeekStart.getDate() - 7);
             renderCalendar();
             setupEventListeners();
         });
         
         $('#nextWeek').off('click').on('click', function() {
             currentWeekStart.setDate(currentWeekStart.getDate() + 7);
             renderCalendar();
             setupEventListeners();
         });
         
         // Date selection
         $(document).off('click', '.week-date:not(.disabled)').on('click', '.week-date:not(.disabled)', function() {
             const dateStr = $(this).data('date');
             selectedDate = parseDateFromDDMMYYYY(dateStr);
             
             // Check if date parsing was successful
             if (!selectedDate) {
                 console.error('Failed to parse date:', dateStr);
                 alert('Error: Invalid date selected. Please try again.');
                 return;
             }
             
             // Update UI
             $('.week-date').removeClass('selected');
             $(this).addClass('selected');
             
             // Show time slots
             showTimeSlots(selectedDate);
             
             // Clear previous time selection
             selectedTime = null;
             
             // Update form inputs
             updateFormInputs();
             
             // Update floating navigation
             updateFloatingNavigation();
             
             console.log('Date selected:', selectedDate);
         });
         
         // Time slot selection
         $(document).off('click', '.time-slot:not(.unavailable)').on('click', '.time-slot:not(.unavailable)', function() {
             selectedTime = $(this).data('time');
             
             // Update UI
             $('.time-slot').removeClass('selected');
             $(this).addClass('selected');
             
             // Update form inputs
             updateFormInputs();
             
             // Update floating navigation
             updateFloatingNavigation();
             
             console.log('Timeslot selection complete - selectedTime:', selectedTime);
         });
     }
     
     function showTimeSlots(date) {
         const timeSlots = generateTimeSlots();
         const dateStr = date.toLocaleDateString('en-AU', { 
             weekday: 'long', 
             year: 'numeric', 
             month: 'long', 
             day: 'numeric' 
         });
         
         $('#selectedDateDisplay').text(dateStr);
         $('#timeSlotsContainer').show();
         
         const timeSlotsHtml = timeSlots.map(slot => `
             <div class="time-slot ${!slot.available ? 'unavailable' : ''}" 
                  data-time="${slot.time}" 
                  ${!slot.available ? 'disabled' : ''}>
                 ${slot.time}
             </div>
         `).join('');
         
         $('#timeSlotsGrid').html(timeSlotsHtml);
     }
     
     function generateTimeSlots() {
         const slots = [
             { time: '9:00 AM', available: true },
             { time: '9:30 AM', available: true },
             { time: '10:00 AM', available: true },
             { time: '10:30 AM', available: true },
             { time: '11:00 AM', available: true },
             { time: '11:30 AM', available: true },
             { time: '2:00 PM', available: true },
             { time: '2:30 PM', available: true },
             { time: '3:00 PM', available: true },
             { time: '3:30 PM', available: true },
             { time: '4:00 PM', available: true },
             { time: '4:30 PM', available: true }
         ];
         
         // Randomly make some slots unavailable for demo
         return slots.map(slot => ({
             ...slot,
             available: Math.random() > 0.2 // 80% availability
         }));
     }
     
     function updateFormInputs() {
         if (selectedDate && selectedTime && !isNaN(selectedDate.getTime())) {
             const dateStr = formatDateForInput(selectedDate);
             const timeStr = selectedTime;
             
             // Update all form inputs
             $('#timeslot_col_date').val(dateStr);
             $('#timeslot_col_time').val(timeStr);
             $('input[name="date"]').val(dateStr);
             $('input[name="time"]').val(timeStr);
             $('#date_input').val(dateStr);
             $('#time_input').val(timeStr);
             
             // Hide error message
             $('#bookingError').hide();
             
             // Update selection summary
             updateSelectionSummary();
             
             console.log('Form inputs updated - Date:', dateStr, 'Time:', timeStr);
         } else if (selectedDate && !isNaN(selectedDate.getTime())) {
             // Update date only if time not selected yet
             const dateStr = formatDateForInput(selectedDate);
             $('#timeslot_col_date').val(dateStr);
             $('input[name="date"]').val(dateStr);
             $('#date_input').val(dateStr);
             
             console.log('Date input updated - Date:', dateStr);
         }
     }
     
     function formatDateForInput(date) {
         // Check if date is valid
         if (!date || isNaN(date.getTime())) {
             console.error('Invalid date passed to formatDateForInput:', date);
             return 'Invalid Date';
         }
         
         const day = String(date.getDate()).padStart(2, '0');
         const month = String(date.getMonth() + 1).padStart(2, '0');
         const year = date.getFullYear();
         return `${day}/${month}/${year}`;
     }
     
     function isSameDay(date1, date2) {
         // Check if both dates are valid
         if (!date1 || !date2 || isNaN(date1.getTime()) || isNaN(date2.getTime())) {
             return false;
         }
         
         return date1.getDate() === date2.getDate() &&
                date1.getMonth() === date2.getMonth() &&
                date1.getFullYear() === date2.getFullYear();
     }
     
     // Initialize calendar when document is ready
     initializeModernCalendar();
    
    // Update confirmation details
    $('.infoFormFields').on('change input', function() {
        updateConfirmationDetails();
        // Update floating navigation when form fields change
        updateFloatingNavigation();
    });
    
    // Update confirmation when consultation type changes
    $('.consultation_type').on('change', function() {
        updateConfirmationDetails();
    });
    
    // Initialize floating navigation
    updateFloatingNavigation();
    
    // Update floating navigation when switching to info tab
    $('.experimental-tab-link[data-tab="info"]').click(function() {
        setTimeout(function() {
            updateFloatingNavigation();
        }, 100);
    });
    
    // Update floating navigation when any form field on info page changes
    $(document).on('input change', '.infoFormFields, .enquiry_item', function() {
        if ($('#info').hasClass('active')) {
            console.log('Form field changed, updating floating navigation...');
            
            // Clear error styling when field is filled
            var $field = $(this);
            if ($field.val() && $field.val().trim() !== '') {
                $field.removeClass('error');
                $field.next('.error-message').remove();
                $field.css({
                    'border-color': '',
                    'box-shadow': '',
                    'background-color': ''
                });
            }
            
            setTimeout(function() {
                updateFloatingNavigation();
            }, 50);
        }
    });
    
    // Immediate trigger for legal matter selection
    $(document).on('change', '.enquiry_item', function() {
        console.log('Legal matter dropdown changed, immediate update...');
        if ($('#info').hasClass('active')) {
            updateFloatingNavigation();
        }
    });
    
    // Coupon code functionality
    $('#apply_coupon').click(function() {
        var couponCode = $('#coupon_code').val().trim();
        var $message = $('#coupon_message');
        
        if (!couponCode) {
            showCouponMessage('Please enter a promo code', 'error');
            return;
        }
        
        // Validate promo codes: FREE100 (100% off) and HALF50 (50% off)
        var validCoupons = {
            'FREE100': { discount: 100, type: 'percentage', description: 'Free consultation' },
            'HALF50': { discount: 50, type: 'percentage', description: '50% off consultation' }
        };
        
        if (validCoupons[couponCode.toUpperCase()]) {
            var coupon = validCoupons[couponCode.toUpperCase()];
            var consultationFee = 150; // Base consultation fee
            var discountAmount = (consultationFee * coupon.discount) / 100;
            var finalAmount = Math.max(0, consultationFee - discountAmount);
            
            // Update payment summary
            $('.discount-item').show();
            $('.discount-amount').text('-$' + discountAmount.toFixed(2) + ' AUD');
            $('.total-amount').html('<strong>$' + finalAmount.toFixed(2) + ' AUD</strong>');
            $('.final-amount').text('$' + finalAmount.toFixed(2) + ' AUD');
            
            // Show success message with savings
            var savingsText = coupon.discount === 100 ? 'Free consultation!' : 'You saved $' + discountAmount.toFixed(2);
            showCouponMessage('Promo code applied successfully! ' + savingsText, 'success');
            
            // Store coupon info for form submission
            $('input[name="coupon_code"]').val(couponCode);
            $('input[name="promo_code"]').val(couponCode); // Also update promo_code field for backend
            $('input[name="discount_amount"]').val(discountAmount);
            $('input[name="discount_percentage"]').val(coupon.discount);
            
            // Disable coupon input after successful application
            $('#coupon_code').prop('disabled', true);
            $('#apply_coupon').prop('disabled', true).text('Applied');
            
            // Add reset button
            if (!$('#reset_coupon').length) {
                $('#apply_coupon').after('<button type="button" class="experimental-btn btn-reset-coupon" id="reset_coupon" style="background: #6c757d; margin-left: 10px;"><i class="fa fa-refresh mr-2"></i>Reset</button>');
            }
            
        } else {
            showCouponMessage('Invalid promo code. Valid codes: FREE100 or HALF50', 'error');
        }
    });
    
    function showCouponMessage(message, type) {
        var $message = $('#coupon_message');
        $message.removeClass('success error').addClass(type).text(message).show();
        
        setTimeout(function() {
            $message.fadeOut();
        }, 5000);
    }
    
    function showSuccessMessage(message) {
        // Create success message overlay
        var $overlay = $('<div class="success-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 9999; display: flex; align-items: center; justify-content: center;">' +
            '<div style="background: white; padding: 40px; border-radius: 10px; text-align: center; max-width: 500px; margin: 20px;">' +
            '<div style="color: #28a745; font-size: 48px; margin-bottom: 20px;"><i class="fa fa-check-circle"></i></div>' +
            '<h3 style="color: #28a745; margin-bottom: 20px;">Success!</h3>' +
            '<p style="color: #333; margin-bottom: 30px; font-size: 16px;">' + message + '</p>' +
            '<button onclick="$(this).closest(\'.success-overlay\').remove()" style="background: #28a745; color: white; border: none; padding: 12px 30px; border-radius: 5px; cursor: pointer; font-size: 16px;">OK</button>' +
            '</div></div>');
        
        $('body').append($overlay);
    }
    
    function showErrorMessage(message) {
        // Create error message overlay
        var $overlay = $('<div class="error-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 9999; display: flex; align-items: center; justify-content: center;">' +
            '<div style="background: white; padding: 40px; border-radius: 10px; text-align: center; max-width: 500px; margin: 20px;">' +
            '<div style="color: #dc3545; font-size: 48px; margin-bottom: 20px;"><i class="fa fa-exclamation-triangle"></i></div>' +
            '<h3 style="color: #dc3545; margin-bottom: 20px;">Error</h3>' +
            '<p style="color: #333; margin-bottom: 30px; font-size: 16px;">' + message + '</p>' +
            '<button onclick="$(this).closest(\'.error-overlay\').remove()" style="background: #dc3545; color: white; border: none; padding: 12px 30px; border-radius: 5px; cursor: pointer; font-size: 16px;">OK</button>' +
            '</div></div>');
        
        $('body').append($overlay);
    }
    
    // Reset coupon functionality
    $(document).on('click', '#reset_coupon', function() {
        // Reset form fields
        $('#coupon_code').val('').prop('disabled', false);
        $('#apply_coupon').prop('disabled', false).text('Apply');
        
        // Reset payment summary
        $('.discount-item').hide();
        $('.discount-amount').text('-$0.00 AUD');
        $('.total-amount').html('<strong>$150.00 AUD</strong>');
        $('.final-amount').text('$150.00 AUD');
        
        // Clear hidden inputs
        $('input[name="coupon_code"]').val('');
        $('input[name="promo_code"]').val('');
        $('input[name="discount_amount"]').val('');
        $('input[name="discount_percentage"]').val('');
        
        // Remove reset button
        $('#reset_coupon').remove();
        
        // Show reset message
        showCouponMessage('Promo code reset. You can enter a new code.', 'success');
    });
    
    function updateSelectionSummary() {
        console.log('Updating selection summary...');
        
        // Update consultation type summary
        var consultationType = $('.consultation_type:checked').val();
        console.log('Consultation type:', consultationType);
        if (consultationType) {
            var typeText = '';
            switch(consultationType) {
                case 'in_person':
                    typeText = 'In-Person Consultation';
                    break;
                case 'phone':
                    typeText = 'Phone Consultation';
                    break;
                case 'video':
                    typeText = 'Zoom / Google Meeting';
                    break;
                default:
                    typeText = consultationType;
            }
            $('.consultation-type-summary').text(typeText);
            console.log('Updated consultation type to:', typeText);
        } else {
            $('.consultation-type-summary').text('Not selected');
        }
        
        // Update date and time summary
        var selectedDate = $('input[name="date"]').val();
        var selectedTime = $('input[name="time"]').val();
        var timeslotDate = $('#timeslot_col_date').val();
        var timeslotTime = $('#timeslot_col_time').val();
        
        console.log('Selected date (name="date"):', selectedDate);
        console.log('Selected time (name="time"):', selectedTime);
        console.log('Timeslot date (#timeslot_col_date):', timeslotDate);
        console.log('Timeslot time (#timeslot_col_time):', timeslotTime);
        
        // Use the most reliable source for date and time
        var finalDate = selectedDate || timeslotDate;
        var finalTime = selectedTime || timeslotTime;
        
        if (finalDate && finalTime) {
            var timeOnly = finalTime.split('-')[0];
            $('.datetime-summary').text(finalDate + ' at ' + timeOnly);
            console.log('Updated datetime to:', finalDate + ' at ' + timeOnly);
        } else if (finalDate) {
            $('.datetime-summary').text(finalDate + ' (time not selected)');
            console.log('Updated date to:', finalDate + ' (time not selected)');
        } else {
            $('.datetime-summary').text('Not selected');
            console.log('No date/time selected');
        }
    }
    
    function updateConfirmationDetails() {
        var consultationType = $('.consultation_type:checked').val();
        var typeText = '';
        switch(consultationType) {
            case 'in_person':
                typeText = 'In-Person Consultation';
                break;
            case 'phone':
                typeText = 'Phone Consultation';
                break;
            case 'video':
                typeText = 'Zoom / Google Meeting';
                break;
            default:
                typeText = consultationType || '';
        }
        
        $('.consultation_type').text(typeText);
        $('.full_name').text($('.fullname').val());
        $('.email').text($('.email').val());
        $('.phone').text($('.phone').val());
        $('.description').text($('.description').val());
        
        // Use the most reliable source for date and time
        var finalDate = $('input[name="date"]').val() || $('#timeslot_col_date').val();
        var finalTime = $('input[name="time"]').val() || $('#timeslot_col_time').val();
        
        $('.date').text(finalDate);
        $('.time').text(finalTime);
        
        console.log('Confirmation details updated - Date:', finalDate, 'Time:', finalTime);
    }
});
</script>

@endsection
