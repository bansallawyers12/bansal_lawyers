@extends('layouts.landing')

@section('seoinfo')
<title>Divorce with Confidence | Expert Family Law Guidance in Australia | Bansal Lawyers</title>
<meta name="description" content="Expert family law guidance in Melbourne, Australia. Bansal Lawyers provides compassionate legal support for divorce, property settlement, parenting arrangements, and family law matters. Free consultation available." />
<meta name="keywords" content="divorce lawyer Melbourne, family law Melbourne, divorce attorney, child custody lawyer, property settlement, family law services, Melbourne divorce lawyer, Bansal Lawyers" />

<link rel="canonical" href="https://www.bansallawyers.com.au/landing" />

<!-- Facebook Meta Tags -->
<meta property="og:url" content="<?php echo URL::to('/'); ?>/landing">
<meta property="og:type" content="website">
<meta property="og:title" content="Divorce with Confidence | Expert Family Law Guidance in Australia | Bansal Lawyers">
<meta property="og:description" content="Expert family law guidance in Melbourne, Australia. Compassionate legal support for divorce, property settlement, parenting arrangements, and family law matters.">
<meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta property="og:image:alt" content="Bansal Lawyers - Divorce & Family Law Services">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="bansallawyers.com.au">
<meta property="twitter:url" content="<?php echo URL::to('/'); ?>/landing">
<meta name="twitter:title" content="Divorce with Confidence | Expert Family Law Guidance in Australia | Bansal Lawyers">
<meta name="twitter:description" content="Expert family law guidance in Melbourne, Australia. Compassionate legal support for divorce, property settlement, parenting arrangements, and family law matters.">
<meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta property="twitter:image:alt" content="Bansal Lawyers - Divorce & Family Law Services">
@endsection

@section('content')
<style>
/* Dark Navy Blue Professional Color Scheme */
:root {
    --primary-teal: #0F172A; /* Very Dark Navy Blue - Professional & Trustworthy */
    --accent-teal: #0F172A; /* Dark Navy Blue - Modern & Eye-catching */
    --light-blue: #E2E8F0; /* Light Blue-Gray - Clean & Fresh */
    --warm-coral: #1E40AF; /* Medium Dark Blue - Warm & Inviting */
    --white: #FFFFFF;
    --gradient-primary: linear-gradient(135deg, #0F172A 0%, #0F172A 50%, #1E40AF 100%); /* Dark Navy to Blue Gradient */
    --gradient-secondary: linear-gradient(135deg, #0F172A 0%, #1E40AF 50%, #1E3A8A 100%); /* Dark Navy Blue Gradient */
}

/* Typography System - Exact from PDF */
@import url('https://fonts.googleapis.com/css2?family=Gill+Sans:wght@400;700&family=Palatino+Linotype:wght@400;700&family=Century+Gothic:wght@400;700&display=swap');

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    line-height: 1.7;
    color: var(--primary-teal);
    background: var(--white);
}

/* Typography Classes */
.heading-primary {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    color: var(--primary-teal);
}

.heading-accent {
    font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
    color: var(--accent-teal);
}

.body-text {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    color: var(--primary-teal);
}

/* Cover/Hero Section - Slide 1 */
.cover-section {
    min-height: 100vh;
    display: grid;
    grid-template-columns: 3fr 2fr;
    gap: 0;
    background: var(--white);
    position: relative;
    overflow-x: hidden;
    overflow-y: visible;
}

.cover-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    padding: 80px 60px;
    gap: 30px;
    position: relative;
    z-index: 2;
}

.cover-title {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 4.5rem;
    line-height: 1.2;
    color: var(--primary-teal);
    margin: 0;
    animation: fadeInUp 0.8s ease-out;
}

.cover-subtitle {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 400;
    font-size: 2rem;
    color: var(--accent-teal);
    opacity: 0.9;
    margin: 0;
    animation: fadeInUp 1s ease-out;
}

.cover-tagline {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1.3rem;
    font-style: italic;
    color: var(--primary-teal);
    opacity: 0.8;
    margin: 0;
    animation: fadeInUp 1.2s ease-out;
}

.cover-cta-button {
    display: inline-block;
    background: var(--primary-teal);
    color: var(--white);
    padding: 18px 40px;
    border-radius: 50px;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 1.2rem;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(15, 23, 42, 0.3);
    margin-top: 20px;
    animation: fadeInUp 1.4s ease-out;
}

.cover-cta-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(15, 23, 42, 0.4);
    color: var(--white);
    text-decoration: none;
    background: var(--accent-teal);
}

.cover-image {
    width: 100%;
    min-height: 100vh;
    height: auto;
    position: relative;
    background: linear-gradient(135deg, var(--primary-teal) 0%, var(--accent-teal) 50%, var(--light-blue) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 40px 20px;
}

.cover-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.2) 0%, transparent 60%),
        radial-gradient(circle at 70% 80%, rgba(255, 255, 255, 0.15) 0%, transparent 60%),
        radial-gradient(circle at 50% 50%, rgba(30, 64, 175, 0.1) 0%, transparent 70%);
    opacity: 1;
    animation: pulse 4s ease-in-out infinite;
}

.cover-image::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    animation: rotate 20s linear infinite;
}

.cover-visual-content {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 50px 40px;
    color: var(--white);
    width: 100%;
    max-width: 500px;
}

.cover-icon-large {
    font-size: 7rem;
    margin-bottom: 25px;
    animation: float 3s ease-in-out infinite;
    filter: drop-shadow(0 15px 40px rgba(0, 0, 0, 0.3));
    display: inline-block;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 30px;
    border-radius: 50%;
    border: 3px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
}

.cover-visual-title {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 2.8rem;
    margin-bottom: 15px;
    text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
    color: var(--white);
}

.cover-visual-subtitle {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1.2rem;
    line-height: 1.7;
    opacity: 0.95;
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
    margin-bottom: 40px;
    color: var(--white);
}

.cover-features {
    display: flex;
    flex-direction: column;
    gap: 18px;
    margin-top: 40px;
}

.cover-feature-item {
    display: flex;
    align-items: center;
    gap: 18px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    padding: 20px 28px;
    border-radius: 15px;
    border: 2px solid rgba(255, 255, 255, 0.5);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    position: relative;
    overflow: hidden;
}

.cover-feature-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: left 0.5s ease;
}

.cover-feature-item:hover::before {
    left: 100%;
}

.cover-feature-item:hover {
    background: rgba(255, 255, 255, 1);
    transform: translateX(15px) scale(1.02);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
    border-color: rgba(255, 255, 255, 0.8);
}

.cover-feature-icon {
    font-size: 1.8rem;
    flex-shrink: 0;
    color: var(--primary-teal);
    font-weight: bold;
    background: var(--light-blue);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(15, 23, 42, 0.2);
}

.cover-feature-text {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--primary-teal);
    flex-grow: 1;
    text-align: left;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(5deg);
    }
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.8;
    }
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* Limited Time Offer Banner */
.limited-time-banner {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 18px 0;
    text-align: center;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.4);
    animation: slideDown 0.5s ease-out;
    border-bottom: 3px solid rgba(255, 255, 255, 0.3);
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: block;
}

.limited-time-banner:hover {
    background: linear-gradient(135deg, #1E3A8A 0%, #1E40AF 50%, #0F172A 100%);
    box-shadow: 0 6px 30px rgba(15, 23, 42, 0.6);
    transform: translateY(-2px);
    color: var(--white) !important;
}

.limited-time-banner:active,
.limited-time-banner:visited,
.limited-time-banner:focus {
    color: var(--white) !important;
}

.limited-time-banner:active .limited-time-text,
.limited-time-banner:visited .limited-time-text,
.limited-time-banner:focus .limited-time-text,
.limited-time-banner:hover .limited-time-text {
    color: var(--white) !important;
}

.limited-time-banner:active .limited-time-date,
.limited-time-banner:visited .limited-time-date,
.limited-time-banner:focus .limited-time-date,
.limited-time-banner:hover .limited-time-date {
    color: var(--white) !important;
}

.limited-time-banner-content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.limited-time-icon {
    font-size: 2rem;
    animation: pulse-icon 2s ease-in-out infinite;
}

.limited-time-text {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 1.5rem;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
    letter-spacing: 0.5px;
    color: var(--white) !important;
}

.limited-time-highlight {
    background: rgba(255, 255, 255, 0.95);
    color: #0F172A;
    padding: 10px 25px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 1.2rem;
    border: 2px solid rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    animation: pulse-highlight 2s ease-in-out infinite;
}

.limited-time-date {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1.1rem;
    font-weight: 600;
    opacity: 0.95;
    color: var(--white) !important;
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Permanent Floating CTA Button */
.floating-cta-button {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 999;
    background: linear-gradient(135deg, var(--primary-teal) 0%, var(--accent-teal) 100%);
    color: var(--white);
    padding: 22px 40px;
    border-radius: 50px;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 1.3rem;
    text-decoration: none;
    box-shadow: 0 12px 45px rgba(15, 23, 42, 0.5);
    display: flex;
    align-items: center;
    gap: 15px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 3px solid rgba(255, 255, 255, 0.4);
    animation: floatButton 3s ease-in-out infinite;
    backdrop-filter: blur(10px);
}

.floating-cta-button:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 15px 50px rgba(15, 23, 42, 0.5);
    color: var(--white);
    text-decoration: none;
    background: linear-gradient(135deg, var(--accent-teal) 0%, var(--primary-teal) 100%);
}

.floating-cta-button:active {
    transform: translateY(-2px) scale(1.02);
}

.floating-cta-icon {
    font-size: 1.8rem;
    animation: pulse-icon 2s ease-in-out infinite;
}

.floating-cta-text {
    white-space: nowrap;
}

@keyframes floatButton {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

@keyframes shimmer {
    0% {
        background-position: -200% 0;
    }
    100% {
        background-position: 200% 0;
    }
}

@keyframes floatIcon {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-10px) rotate(5deg);
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(15, 23, 42, 0.4);
    }
    50% {
        transform: scale(1.02);
        box-shadow: 0 0 0 20px rgba(15, 23, 42, 0);
    }
}

/* Remove contact footers from sections - Hidden by default */
.contact-footer {
    display: none !important;
}

/* Consultation Form Section Styles */
.consultation-form-section {
    position: relative;
}

.consultation-form-section input:focus,
.consultation-form-section textarea:focus {
    outline: none;
}

.consultation-form-section input.is-invalid,
.consultation-form-section textarea.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.15) !important;
}

.trust-badge:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2) !important;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.35) 0%, rgba(255, 255, 255, 0.25) 100%) !important;
}

.form-input-enhanced::placeholder {
    color: #bbb;
    font-style: italic;
    transition: color 0.3s ease;
}

.form-input-enhanced:focus::placeholder {
    color: #ddd;
}

.consultation-submit-btn:active {
    transform: translateY(-2px) scale(1.01) !important;
}

.consultation-submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none !important;
}

/* Ensure submit button is always visible */
#cover-consultation-form-submit {
    display: flex !important;
    visibility: visible !important;
    opacity: 1 !important;
    position: relative !important;
    z-index: 100 !important;
    margin-top: 15px !important;
    margin-bottom: 20px !important;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes shine {
    0% { left: -100%; }
    50%, 100% { left: 100%; }
}

@keyframes backgroundPulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    33% { transform: translateY(-20px) rotate(5deg); }
    66% { transform: translateY(-10px) rotate(-5deg); }
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Section Styles - Enhanced */
.section {
    padding: 100px 60px;
    max-width: 1920px;
    margin: 0 auto;
    position: relative;
}

.section.about-section {
    background: linear-gradient(135deg, var(--primary-teal) 0%, var(--accent-teal) 50%, var(--light-blue) 100%);
    position: relative;
    overflow: hidden;
}

.section.about-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 10% 20%, rgba(15, 23, 42, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 90% 80%, rgba(30, 64, 175, 0.05) 0%, transparent 50%);
    pointer-events: none;
}

.section-header {
    text-align: center;
    margin-bottom: 80px;
    position: relative;
    z-index: 1;
}

.section-title {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 3.8rem;
    color: var(--primary-teal);
    margin-bottom: 25px;
    position: relative;
    display: inline-block;
    animation: fadeInUp 0.8s ease-out;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-teal), var(--accent-teal), var(--warm-coral));
    border-radius: 2px;
}

.section-subtitle {
    font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
    font-size: 1.6rem;
    color: var(--accent-teal);
    margin: 0;
    font-weight: 500;
    animation: fadeInUp 1s ease-out;
}

/* Card Styles - Enhanced */
.info-card {
    background: linear-gradient(135deg, var(--white) 0%, var(--light-blue) 100%);
    border-radius: 20px;
    padding: 45px 35px;
    height: 100%;
    display: flex;
    flex-direction: column;
    gap: 20px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(15, 23, 42, 0.08);
}

.info-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--primary-teal), var(--accent-teal), var(--warm-coral));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}

.info-card:hover::before {
    transform: scaleX(1);
}

.info-card::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(15, 23, 42, 0.1) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.info-card:hover::after {
    opacity: 1;
}

.info-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 50px rgba(15, 23, 42, 0.2);
    border-color: var(--accent-teal);
    background: linear-gradient(135deg, var(--white) 0%, rgba(237, 246, 249, 0.8) 100%);
}

.card-icon {
    width: 90px;
    height: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, var(--primary-teal) 0%, var(--accent-teal) 100%);
    border-radius: 50%;
    color: var(--white);
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.3);
    transition: all 0.4s ease;
    position: relative;
    z-index: 1;
}

.info-card:hover .card-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 15px 40px rgba(15, 23, 42, 0.4);
}

.card-icon.heart-icon {
    background: linear-gradient(135deg, var(--warm-coral) 0%, #ffb3a0 100%);
}

.card-icon.trophy-icon {
    background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
    color: var(--primary-teal);
}

.card-icon.shield-icon {
    background: linear-gradient(135deg, var(--accent-teal) 0%, var(--primary-teal) 100%);
}

.card-header {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 1.7rem;
    color: var(--primary-teal);
    text-align: center;
    margin: 0;
    position: relative;
    z-index: 1;
    transition: color 0.3s ease;
}

.info-card:hover .card-header {
    color: var(--primary-teal);
}

.card-body {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1.15rem;
    line-height: 1.8;
    color: var(--primary-teal);
    text-align: center;
    margin: 0;
    position: relative;
    z-index: 1;
    opacity: 0.9;
    transition: opacity 0.3s ease;
}

.info-card:hover .card-body {
    opacity: 1;
}

/* White text on dark blue backgrounds */
.info-card[style*="background: var(--warm-coral)"],
.info-card[style*="background: var(--primary-teal)"],
.info-card[style*="background: linear-gradient"][style*="#0F172A"],
.info-card[style*="background: linear-gradient"][style*="var(--primary-teal)"] {
    color: var(--white);
}

.info-card[style*="background: var(--warm-coral)"] .card-header,
.info-card[style*="background: var(--primary-teal)"] .card-header,
.info-card[style*="background: linear-gradient"][style*="#0F172A"] .card-header,
.info-card[style*="background: linear-gradient"][style*="var(--primary-teal)"] .card-header {
    color: var(--white);
}

.info-card[style*="background: var(--warm-coral)"] .card-body,
.info-card[style*="background: var(--primary-teal)"] .card-body,
.info-card[style*="background: linear-gradient"][style*="#0F172A"] .card-body,
.info-card[style*="background: linear-gradient"][style*="var(--primary-teal)"] .card-body {
    color: rgba(255, 255, 255, 0.95);
}

.info-card[style*="background: var(--warm-coral)"] .card-icon,
.info-card[style*="background: var(--primary-teal)"] .card-icon,
.info-card[style*="background: linear-gradient"][style*="#0F172A"] .card-icon,
.info-card[style*="background: linear-gradient"][style*="var(--primary-teal)"] .card-icon {
    filter: brightness(0) invert(1);
}

/* Grid Layouts - Enhanced */
.grid-2x2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 40px;
    position: relative;
    z-index: 1;
}

@media (max-width: 768px) {
    .grid-2x2 {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .requirement-card {
        padding: 35px 25px;
    }
    
    .requirement-card .card-icon {
        width: 70px !important;
        height: 70px !important;
        font-size: 2rem !important;
    }
    
    .req-number {
        font-size: 3.5rem;
        top: 15px;
        right: 20px;
    }
    
    .req-title {
        font-size: 1.4rem;
    }
    
    .req-description {
        font-size: 1rem;
    }
}

.grid-3x2 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
}

.grid-4-columns {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
}

/* Requirement Cards - Enhanced Attractive Design */
.requirement-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(237, 246, 249, 0.9) 100%);
    border-radius: 20px;
    padding: 40px 35px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(15, 23, 42, 0.12);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid rgba(15, 23, 42, 0.2);
    animation: fadeInUp 0.8s ease-out backwards;
}

.requirement-card:nth-child(1) { animation-delay: 0.1s; }
.requirement-card:nth-child(2) { animation-delay: 0.2s; }
.requirement-card:nth-child(3) { animation-delay: 0.3s; }
.requirement-card:nth-child(4) { animation-delay: 0.4s; }

.requirement-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(90deg, var(--primary-teal) 0%, var(--accent-teal) 50%, var(--primary-teal) 100%);
    background-size: 200% 100%;
    animation: shimmer 3s ease-in-out infinite;
    border-radius: 20px 20px 0 0;
    z-index: 1;
}

.requirement-card[style*="border-top-color"]::before {
    background: linear-gradient(90deg, 
        var(--primary-teal) 0%, 
        var(--accent-teal) 25%,
        var(--primary-teal) 50%,
        var(--accent-teal) 75%,
        var(--primary-teal) 100%);
}

.requirement-card::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(15, 23, 42, 0.1) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.requirement-card:hover {
    transform: translateY(-12px) scale(1.03);
    box-shadow: 0 25px 60px rgba(15, 23, 42, 0.3), 0 0 0 1px rgba(15, 23, 42, 0.2);
    border-color: var(--accent-teal);
    border-width: 3px;
    background: linear-gradient(135deg, rgba(255, 255, 255, 1) 0%, rgba(237, 246, 249, 0.98) 100%);
}

.requirement-card:hover .req-note {
    transform: translateX(5px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15) !important;
}

.requirement-card:hover .panel-list li {
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
}

.requirement-card:hover::after {
    opacity: 1;
}

.requirement-card .card-icon {
    font-size: 2.5rem;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.15));
    animation: floatIcon 3s ease-in-out infinite;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 2;
}

.requirement-card:hover .card-icon {
    transform: scale(1.2) rotate(8deg) translateY(-5px);
    filter: drop-shadow(0 12px 24px rgba(0, 0, 0, 0.25));
}

/* Icon container styling */
.requirement-card .card-icon[style*="background"] {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.requirement-card:hover .card-icon[style*="background"] {
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2) !important;
    transform: scale(1.15) rotate(8deg) translateY(-5px) !important;
}

.req-number {
    position: absolute;
    top: 20px;
    right: 25px;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 800;
    font-size: 4.5rem;
    color: rgba(15, 23, 42, 0.08);
    line-height: 1;
    z-index: 0;
    transition: all 0.3s ease;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.05);
}

.requirement-card:hover .req-number {
    color: rgba(15, 23, 42, 0.12);
    transform: scale(1.1);
}

.req-title {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 1.6rem;
    color: var(--primary-teal);
    margin-bottom: 18px;
    position: relative;
    z-index: 1;
    transition: color 0.3s ease;
    line-height: 1.3;
}

.requirement-card:hover .req-title {
    color: var(--accent-teal);
}

.req-description {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--primary-teal);
    margin-bottom: 12px;
    position: relative;
    z-index: 1;
    font-weight: 500;
}

.req-note {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 0.9rem;
    font-style: italic;
    color: var(--primary-teal);
    opacity: 0.8;
}

/* Process Flow Cards */
.process-card {
    background: var(--light-blue);
    border-radius: 12px;
    padding: 30px;
    text-align: center;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
}

.process-number {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 3rem;
    color: var(--primary-teal);
}

.process-title {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 1.4rem;
    color: var(--primary-teal);
}

.process-description {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1rem;
    line-height: 1.7;
    color: var(--primary-teal);
}

.process-flow {
    display: flex;
    align-items: center;
    gap: 15px;
}

.process-flow-enhanced {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    position: relative;
}

.process-card-enhanced {
    background: #ffffff;
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    position: relative;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 2px solid #f1f5f9;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}

.process-card-enhanced:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
    border-color: rgba(15, 23, 42, 0.2);
}

.process-arrow {
    font-size: 2rem;
    color: var(--accent-teal);
    flex-shrink: 0;
}

/* Highlight Boxes - Enhanced */
.highlight-box {
    background: linear-gradient(135deg, var(--warm-coral) 0%, #ffb3a0 100%);
    border-radius: 20px;
    padding: 45px 35px;
    margin: 20px 0;
    box-shadow: 0 15px 45px rgba(30, 64, 175, 0.5);
    border: 3px solid rgba(255, 255, 255, 0.5);
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
}

.highlight-box::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
    animation: rotate 15s linear infinite;
}

.highlight-box:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 60px rgba(30, 64, 175, 0.6);
    border-color: rgba(255, 255, 255, 0.8);
}

.highlight-box-content {
    position: relative;
    z-index: 1;
    text-align: center;
}

.highlight-icon-wrapper {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--white) 0%, rgba(255, 255, 255, 0.9) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    animation: pulse-icon 2s ease-in-out infinite;
    border: 3px solid rgba(255, 255, 255, 0.8);
}

.highlight-box:hover .highlight-icon-wrapper {
    animation: none;
    transform: scale(1.1) rotate(5deg);
}

.highlight-icon {
    font-size: 2.5rem;
    color: var(--primary-teal);
}

.highlight-title {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 1.8rem;
    color: var(--primary-teal);
    margin-bottom: 20px;
    text-shadow: 1px 1px 3px rgba(255, 255, 255, 0.5);
}

.highlight-text {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1.2rem;
    line-height: 1.8;
    color: var(--primary-teal);
    margin-bottom: 15px;
    font-weight: 500;
}

.highlight-text.emphasis {
    font-weight: 700;
    font-size: 1.4rem;
    margin: 20px 0;
    padding: 15px;
    background: rgba(255, 255, 255, 0.6);
    border-radius: 12px;
    border: 2px solid rgba(255, 255, 255, 0.8);
}

.highlight-subtext {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1rem;
    line-height: 1.7;
    color: var(--primary-teal);
    opacity: 0.9;
    font-style: italic;
}

/* Explanation Panel - Enhanced */
.explanation-panel {
    background: linear-gradient(135deg, var(--white) 0%, var(--light-blue) 100%);
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 10px 40px rgba(15, 23, 42, 0.15);
    border: 2px solid rgba(15, 23, 42, 0.2);
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
}

.explanation-panel::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--primary-teal), var(--accent-teal));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}

.explanation-panel:hover::before {
    transform: scaleX(1);
}

.explanation-panel:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 50px rgba(15, 23, 42, 0.2);
    border-color: var(--accent-teal);
}

.panel-header {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 2rem;
    color: var(--primary-teal);
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 15px;
}

.panel-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-teal), var(--accent-teal));
    border-radius: 2px;
}

.panel-text {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1.15rem;
    line-height: 1.9;
    color: var(--primary-teal);
    margin-bottom: 20px;
}

.panel-list {
    list-style: none;
    padding-left: 0;
    margin: 25px 0;
}

.panel-list li {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1.15rem;
    line-height: 2;
    color: var(--primary-teal);
    padding-left: 40px;
    position: relative;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.panel-list li:hover {
    padding-left: 45px;
    color: var(--accent-teal);
}

.panel-list li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: var(--white);
    font-weight: bold;
    font-size: 1.2rem;
    width: 28px;
    height: 28px;
    background: linear-gradient(135deg, var(--primary-teal), var(--accent-teal));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(15, 23, 42, 0.3);
    transition: all 0.3s ease;
}

.panel-list li:hover::before {
    transform: scale(1.15) rotate(5deg);
    box-shadow: 0 6px 20px rgba(15, 23, 42, 0.4);
}

/* Testimonial Cards */
.testimonial-card {
    background: var(--light-blue);
    border-radius: 12px;
    padding: 35px;
    height: 100%;
    display: flex;
    flex-direction: column;
    gap: 20px;
    position: relative;
}

.testimonial-quote {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1.2rem;
    font-style: italic;
    line-height: 1.7;
    color: var(--primary-teal);
    flex-grow: 1;
}

.testimonial-author {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--primary-teal);
    margin-top: auto;
}

/* Service Summary Cards */
.service-card {
    background: var(--light-blue);
    border-radius: 12px;
    padding: 25px;
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.service-name {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 1.2rem;
    color: var(--primary-teal);
}

.service-summary {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1rem;
    line-height: 1.6;
    color: var(--primary-teal);
}

/* Contact Footer - Enhanced for Visibility */
.contact-footer {
    text-align: center;
    padding: 50px 40px;
    margin-top: 80px;
    background: linear-gradient(135deg, var(--primary-teal) 0%, var(--accent-teal) 100%);
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(15, 23, 42, 0.3);
    position: relative;
    overflow: hidden;
}

.contact-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    pointer-events: none;
}

.contact-footer-content {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 25px;
}

.contact-footer-title {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 1.8rem;
    color: var(--white);
    margin: 0;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
}

.contact-footer-links {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 30px;
}

.contact-footer-link {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: rgba(255, 255, 255, 0.95);
    color: var(--primary-teal);
    padding: 18px 35px;
    border-radius: 50px;
    text-decoration: none;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 1.3rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.contact-footer-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(15, 23, 42, 0.1), transparent);
    transition: left 0.5s ease;
}

.contact-footer-link:hover::before {
    left: 100%;
}

.contact-footer-link:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    background: var(--white);
    border-color: var(--warm-coral);
    color: var(--primary-teal);
    text-decoration: none;
}

.contact-footer-link:active {
    transform: translateY(-2px) scale(1.02);
}

.contact-footer-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
    display: inline-block;
    animation: pulse-icon 2s ease-in-out infinite;
}

.contact-footer-link:hover .contact-footer-icon {
    animation: none;
    transform: scale(1.2);
}

.contact-footer-text {
    font-weight: 700;
}

.contact-footer-separator {
    color: rgba(255, 255, 255, 0.5);
    font-size: 1.5rem;
    font-weight: 300;
}

.contact-footer-subtitle {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
    font-style: italic;
}

@keyframes pulse-icon {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.15);
    }
}

@keyframes pulse-highlight {
    0%, 100% {
        transform: scale(1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }
}

/* CTA Section */
.cta-section {
    background: var(--light-blue);
    border-radius: 20px;
    padding: 80px 60px;
    text-align: center;
    margin: 60px auto;
    max-width: 1200px;
}

.cta-headline {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 3.5rem;
    color: var(--primary-teal);
    margin-bottom: 15px;
}

.cta-subheadline {
    font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
    font-size: 2rem;
    color: var(--accent-teal);
    margin-bottom: 40px;
}

.contact-panel {
    background: var(--white);
    border-radius: 15px;
    padding: 50px;
    margin: 40px 0;
    text-align: left;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.contact-intro {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1.2rem;
    line-height: 1.8;
    color: var(--primary-teal);
    text-align: center;
    margin-bottom: 30px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1.1rem;
}

.contact-label {
    font-weight: 700;
    color: var(--primary-teal);
    min-width: 120px;
}

.contact-value {
    color: var(--primary-teal);
    font-size: 1.2rem;
}

.encouragement-note {
    background: var(--warm-coral);
    border-radius: 12px;
    padding: 25px;
    text-align: center;
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-style: italic;
    font-size: 1.2rem;
    color: var(--primary-teal);
    margin-top: 30px;
}

/* Comparison Table */
.comparison-table {
    width: 100%;
    border-collapse: collapse;
    margin: 30px 0;
    background: var(--white);
    border-radius: 12px;
    overflow: hidden;
}

.comparison-table thead {
    background: var(--primary-teal);
    color: var(--white);
}

.comparison-table th {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 1.1rem;
    padding: 20px;
    text-align: left;
}

.comparison-table tbody tr:nth-child(even) {
    background: var(--light-blue);
}

.comparison-table td {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1rem;
    padding: 20px;
    color: var(--primary-teal);
    line-height: 1.7;
}

/* Feature Highlight Panels */
.feature-panel {
    background: var(--light-blue);
    border-radius: 12px;
    padding: 40px;
    display: flex;
    align-items: center;
    gap: 30px;
    margin-bottom: 25px;
}

.feature-number {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 4rem;
    color: var(--accent-teal);
    flex-shrink: 0;
    min-width: 80px;
}

.feature-content {
    flex-grow: 1;
}

.feature-title {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
    font-weight: 700;
    font-size: 1.8rem;
    color: var(--primary-teal);
    margin-bottom: 15px;
}

.feature-description {
    font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--primary-teal);
    margin-bottom: 10px;
}

.feature-emphasis {
    font-weight: 700;
    color: var(--primary-teal);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .cover-title {
        font-size: 3.5rem;
    }
    
    .cover-visual-title {
        font-size: 2rem;
    }
    
    .cover-icon-large {
        font-size: 6rem;
    }
    
    .section-title {
        font-size: 2.8rem;
    }
    
    .grid-4-columns {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .grid-3x2 {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .cover-section {
        grid-template-columns: 1fr;
    }
    
    .cover-image {
        height: auto;
        min-height: auto;
        overflow-y: visible;
        padding: 20px 15px;
    }
    
    .cover-content {
        padding: 40px 30px;
    }
    
    .cover-title {
        font-size: 2.5rem;
    }
    
    .cover-subtitle {
        font-size: 1.5rem;
    }
    
    .cover-visual-content {
        padding: 30px 20px;
    }
    
    .cover-image {
        min-height: auto;
        padding: 20px 15px;
        overflow-y: visible;
    }
    
    .cover-section {
        overflow-y: visible;
    }
    
    .cover-icon-large {
        font-size: 5rem;
        margin-bottom: 20px;
        padding: 20px;
    }
    
    .cover-visual-title {
        font-size: 2rem;
    }
    
    .cover-visual-subtitle {
        font-size: 1.1rem;
        margin-bottom: 30px;
    }
    
    .cover-features {
        margin-top: 30px;
        gap: 15px;
    }
    
    .cover-feature-item {
        padding: 18px 22px;
    }
    
    .cover-feature-item:hover {
        transform: translateX(10px) scale(1.01);
    }
    
    .cover-feature-icon {
        width: 35px;
        height: 35px;
        font-size: 1.5rem;
    }
    
    .cover-feature-text {
        font-size: 1rem;
    }
    
    .section {
        padding: 50px 30px;
    }
    
    .contact-footer {
        padding: 40px 25px;
        margin-top: 50px;
    }
    
    .contact-footer-title {
        font-size: 1.4rem;
    }
    
    .contact-footer-links {
        flex-direction: column;
        gap: 20px;
    }
    
    .contact-footer-link {
        width: 100%;
        max-width: 300px;
        justify-content: center;
        padding: 16px 30px;
        font-size: 1.1rem;
    }
    
    .contact-footer-separator {
        display: none;
    }
    
    .contact-footer-subtitle {
        font-size: 0.95rem;
        text-align: center;
        padding: 0 10px;
    }
    
    .section-title {
        font-size: 2.2rem;
    }
    
    .section-title::after {
        width: 60px;
        height: 3px;
    }
    
    .section-subtitle {
        font-size: 1.3rem;
    }
    
    .info-card {
        padding: 35px 25px;
    }
    
    .card-icon {
        width: 75px;
        height: 75px;
        font-size: 2.5rem;
    }
    
    .card-header {
        font-size: 1.5rem;
    }
    
    .card-body {
        font-size: 1.05rem;
    }
    
    .section.about-section {
        padding: 70px 30px;
    }
    
    .grid-2x2,
    .grid-3x2,
    .grid-4-columns {
        grid-template-columns: 1fr;
    }
    
    /* Understanding Divorce Section Mobile */
    section[style*="background: linear-gradient"] > div[style*="grid-template-columns: 2fr 1fr"] {
        grid-template-columns: 1fr !important;
        gap: 30px !important;
    }
    
    .process-flow {
        flex-direction: column;
    }
    
    .process-flow-enhanced {
        grid-template-columns: 1fr !important;
        gap: 30px !important;
    }
    
    .process-card-enhanced {
        padding: 35px 25px !important;
    }
    
    /* Why Choose Section Responsive */
    section > div[style*="grid-template-columns: repeat(3, 1fr)"] {
        grid-template-columns: 1fr !important;
        gap: 25px !important;
    }
    
    /* Property Settlement Responsive */
    section > div[style*="grid-template-columns: 3fr 2fr"] {
        grid-template-columns: 1fr !important;
        gap: 30px !important;
    }
    
    .feature-panel {
        flex-direction: column;
        text-align: center;
    }
    
    .contact-panel {
        padding: 30px 20px;
    }
    
    /* CTA Section Mobile */
    .cta-section {
        padding: 60px 30px !important;
        border-radius: 20px !important;
    }
    
    .cta-section > div[style*="grid-template-columns: 1fr 1fr"] {
        grid-template-columns: 1fr !important;
        gap: 20px !important;
    }

    .cta-headline {
        font-size: 2.5rem;
    }

    .cta-subheadline {
        font-size: 1.5rem;
    }
    
    /* Understanding Divorce Section Mobile */
    section > div[style*="grid-template-columns: 2fr 1fr"] {
        grid-template-columns: 1fr !important;
        gap: 30px !important;
    }
    
    /* Limited Time Banner Mobile */
    .limited-time-banner {
        padding: 12px 0;
    }
    
    .limited-time-banner-content {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .limited-time-text {
        font-size: 1rem;
    }
    
    .limited-time-highlight {
        font-size: 1rem;
        padding: 8px 18px;
    }
    
    .limited-time-date {
        font-size: 0.85rem;
    }
    
    /* Floating CTA Button Mobile */
    .floating-cta-button {
        bottom: 20px;
        right: 20px;
        padding: 18px 32px;
        font-size: 1.1rem;
    }
    
    .floating-cta-icon {
        font-size: 1.6rem;
    }
    
    /* Consultation Form Mobile */
    .consultation-form-section {
        padding: 60px 30px !important;
    }
    
    .consultation-form-section .section-header {
        margin-bottom: 40px !important;
    }
    
    .consultation-form-section .section-title {
        font-size: 2.2rem !important;
    }
    
    .consultation-form-section .section-subtitle {
        font-size: 1.1rem !important;
    }
    
    .consultation-form-section > div > div {
        padding: 30px 20px !important;
    }
    
    .consultation-form-section form > div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
        gap: 20px !important;
    }
    
    /* Ensure submit button is visible on mobile */
    #cover-consultation-form-submit {
        display: flex !important;
        visibility: visible !important;
        margin-top: 20px !important;
        margin-bottom: 30px !important;
        padding: 20px 30px !important;
        font-size: 1.1rem !important;
    }
    
    /* Add extra bottom padding to form container on mobile to account for floating button */
    .cover-section .cover-visual-content > div {
        padding-bottom: 100px !important;
    }
}

@media (max-width: 480px) {
    .cover-title {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .section {
        padding: 40px 20px;
    }
}
</style>

<!-- Limited Time Offer Banner - Sticky Top Bar -->
<a href="#consultation-form" style="text-decoration: none; display: block;" class="limited-time-banner">
    <div class="limited-time-banner-content">
        <span class="limited-time-icon">⏰</span>
        <span class="limited-time-text">FREE CONSULTATION - LIMITED TIME OFFER!</span>
        <span class="limited-time-highlight">Ends After February 15, 2026</span>
        <span class="limited-time-date">Don't miss out - Book your free consultation today!</span>
    </div>
</a>

<!-- Permanent Floating CTA Button -->
<a href="tel:1300226725" class="floating-cta-button" title="Call 1300 BANSAL for Free Consultation">
    <span class="floating-cta-icon">📞</span>
    <span class="floating-cta-text">Call: 1300 BANSAL</span>
</a>

<!-- Slide 1: Cover Section -->
<section class="cover-section">
    <div class="cover-content">
        <!-- Logo -->
        <div style="margin-bottom: 40px; animation: fadeInDown 0.8s ease-out; text-align: center;">
            <img src="{{ asset('images/logo/Bansal_Lawyers_origional.webp') }}" 
                 srcset="{{ asset('images/logo/Bansal_Lawyers_origional.webp') }} 1x, {{ asset('images/logo/Bansal_Lawyers_origional@2x.webp') }} 2x"
                 alt="Bansal Lawyers" 
                 style="max-height: 100px; height: auto; width: auto; display: inline-block; filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.2));"
                 onerror="this.onerror=null; this.src='{{ asset('images/logo/Bansal_Lawyers_origional.png') }}'; this.onerror=function(){this.style.display='none';}">
        </div>
        <h1 class="cover-title">Expert Divorce Lawyers Protecting Your Rights</h1>
        <h2 class="cover-subtitle">Compassionate Legal Support for Your Divorce Journey in Australia</h2>
        <p class="cover-tagline">Trusted guidance for divorce, property settlement, child custody, and all family law matters</p>
        <div style="margin: 30px 0; display: flex; align-items: center; justify-content: center; gap: 20px; flex-wrap: wrap;">
            <a href="#consultation-form" class="cover-cta-button" style="flex: 0 0 auto;">
                Start Your Free Consultation →
            </a>
            <a href="tel:1300226725" class="cover-cta-button" style="background: transparent; border: 2px solid var(--primary-teal); color: var(--primary-teal); flex: 0 0 auto;">
                📞 Call 1300 BANSAL
            </a>
        </div>
        <p style="margin-top: 20px; font-size: 0.9rem; color: var(--accent-teal); font-weight: 600; text-align: center;">
            ✓ No obligation • ✓ Confidential • ✓ Expert advice
        </p>
    </div>
    <div class="cover-image">
        <div class="cover-visual-content" style="max-width: 750px; text-align: left;">
            <h3 class="cover-visual-title" style="text-align: center; margin-bottom: 35px; font-size: 2.8rem;">
                ⚡ GET YOUR FREE CONSULTATION NOW ⚡
            </h3>
            
            <div style="background: rgba(255, 255, 255, 0.98); border-radius: 25px; padding: 50px 45px 120px 45px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4); position: relative; z-index: 2; margin-bottom: 50px;">
                <!-- Success/Error Messages -->
                <div id="cover-consultation-form-messages" style="display: none; margin-bottom: 20px;">
                    <div id="cover-consultation-form-success" style="display: none; background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%); color: #155724; padding: 15px 20px; border-radius: 12px; border-left: 5px solid #28a745; margin-bottom: 15px; display: flex; align-items: center; gap: 12px;">
                        <span style="font-size: 1.5rem;">✓</span>
                        <div>
                            <strong style="font-size: 1rem; display: block; margin-bottom: 5px;">Success!</strong>
                            <span id="cover-consultation-form-success-text" style="font-size: 0.9rem;"></span>
                        </div>
                    </div>
                    <div id="cover-consultation-form-error" style="display: none; background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%); color: #721c24; padding: 15px 20px; border-radius: 12px; border-left: 5px solid #dc3545; margin-bottom: 15px; display: flex; align-items: center; gap: 12px;">
                        <span style="font-size: 1.5rem;">✗</span>
                        <div>
                            <strong style="font-size: 1rem; display: block; margin-bottom: 5px;">Error:</strong>
                            <span id="cover-consultation-form-error-text" style="font-size: 0.9rem;"></span>
                        </div>
                    </div>
                </div>
                
                <form id="cover-consultation-form-element" action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="form_source" value="divorce-family-law-landing-cover">
                    <input type="hidden" name="form_variant" value="consultation">
                    <input type="hidden" name="subject" value="Free Consultation Request - Divorce & Family Law">
                    
                    <div style="margin-bottom: 25px;">
                        <label for="cover-consultation-name" style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif; font-weight: 700; color: #0F172A; font-size: 1.05rem;">
                            <span style="color: #1E40AF; font-size: 1.3rem;">👤</span> Full Name *
                        </label>
                        <input type="text" 
                               id="cover-consultation-name" 
                               name="name" 
                               required
                               placeholder="Enter your full name"
                               value="{{ old('name') }}"
                               style="width: 100%; padding: 16px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 1.05rem; font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif; transition: all 0.3s ease; background: #fafafa;"
                               onfocus="this.style.borderColor='#0F172A'; this.style.boxShadow='0 0 0 3px rgba(15, 23, 42, 0.1)'; this.style.background='#fff'"
                               onblur="this.style.borderColor='#e8e8e8'; this.style.boxShadow='none'; this.style.background='#fafafa'">
                        <div id="cover-consultation-name-error" style="display: none; color: #dc3545; font-size: 0.9rem; margin-top: 6px;"></div>
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <label for="cover-consultation-phone" style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif; font-weight: 700; color: #0F172A; font-size: 1.05rem;">
                            <span style="color: #1E40AF; font-size: 1.3rem;">📞</span> Phone Number *
                        </label>
                        <div style="display: flex; align-items: center; width: 100%; border: 2px solid #e8e8e8; border-radius: 12px; background: #fafafa; transition: all 0.3s ease;" 
                             id="cover-consultation-phone-wrapper"
                             onfocusin="this.style.borderColor='#0F172A'; this.style.boxShadow='0 0 0 3px rgba(15, 23, 42, 0.1)'; this.style.background='#fff'; document.getElementById('cover-consultation-phone').style.background='#fff'"
                             onfocusout="this.style.borderColor='#e8e8e8'; this.style.boxShadow='none'; this.style.background='#fafafa'; document.getElementById('cover-consultation-phone').style.background='#fafafa'">
                            <span style="padding: 16px 12px 16px 20px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif; font-weight: 700; color: #0F172A; font-size: 1.05rem; border-right: 1px solid #e8e8e8; background: transparent; user-select: none;">+61</span>
                            <input type="tel" 
                                   id="cover-consultation-phone" 
                                   name="phone" 
                                   required
                                   maxlength="9"
                                   pattern="^[0-9]{9}$"
                                   placeholder="9 digits"
                                   value="{{ old('phone') ? str_replace(['+61', '+', ' ', '-', '(', ')'], '', old('phone')) : '' }}"
                                   style="flex: 1; padding: 16px 20px 16px 12px; border: none; border-radius: 0 12px 12px 0; font-size: 1.05rem; font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif; transition: all 0.3s ease; background: #fafafa; outline: none;"
                                   onblur="validatePhoneNumber(this)"
                                   oninput="allowOnlyNumbers(this)"
                                   onkeypress="return isNumberKey(event)">
                        </div>
                        <div id="cover-consultation-phone-error" style="display: none; color: #dc3545; font-size: 0.9rem; margin-top: 6px;"></div>
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <label for="cover-consultation-email" style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif; font-weight: 700; color: #0F172A; font-size: 1.05rem;">
                            <span style="color: #1E40AF; font-size: 1.3rem;">✉️</span> Email Address *
                        </label>
                        <input type="email" 
                               id="cover-consultation-email" 
                               name="email" 
                               required
                               placeholder="Enter your email address"
                               value="{{ old('email') }}"
                               style="width: 100%; padding: 16px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 1.05rem; font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif; transition: all 0.3s ease; background: #fafafa;"
                               onfocus="this.style.borderColor='#0F172A'; this.style.boxShadow='0 0 0 3px rgba(15, 23, 42, 0.1)'; this.style.background='#fff'"
                               onblur="this.style.borderColor='#e8e8e8'; this.style.boxShadow='none'; this.style.background='#fafafa'">
                        <div id="cover-consultation-email-error" style="display: none; color: #dc3545; font-size: 0.9rem; margin-top: 6px;"></div>
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <label for="cover-consultation-message" style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif; font-weight: 700; color: #0F172A; font-size: 1.05rem;">
                            <span style="color: #1E40AF; font-size: 1.3rem;">💬</span> Tell Us About Your Situation *
                        </label>
                        <textarea id="cover-consultation-message" 
                                  name="message" 
                                  required
                                  rows="5"
                                  placeholder="Brief details about your matter..."
                                  style="width: 100%; padding: 16px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 1.05rem; font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif; resize: vertical; transition: all 0.3s ease; background: #fafafa; line-height: 1.6;"
                                  onfocus="this.style.borderColor='#0F172A'; this.style.boxShadow='0 0 0 3px rgba(15, 23, 42, 0.1)'; this.style.background='#fff'"
                                  onblur="this.style.borderColor='#e8e8e8'; this.style.boxShadow='none'; this.style.background='#fafafa'">{{ old('message') }}</textarea>
                        <div id="cover-consultation-message-error" style="display: none; color: #dc3545; font-size: 0.9rem; margin-top: 6px;"></div>
                    </div>
                    
                    <!-- Google reCAPTCHA -->
                    <div style="margin-bottom: 25px; display: flex; justify-content: center;">
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI') }}"></div>
                        <div id="cover-consultation-recaptcha-error" style="display: none; color: #dc3545; font-size: 0.85rem; margin-top: 10px; text-align: center; width: 100%;"></div>
                    </div>
                    
                    <button type="submit" 
                            id="cover-consultation-form-submit"
                            style="width: 100%; padding: 22px 35px; background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 100%); color: white; border: none; border-radius: 15px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif; font-weight: 800; font-size: 1.3rem; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 12px 35px rgba(15, 23, 42, 0.4); display: flex !important; align-items: center; justify-content: center; gap: 15px; text-transform: uppercase; letter-spacing: 0.5px; position: relative; z-index: 10; margin-top: 15px; margin-bottom: 30px;"
                            onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 18px 45px rgba(15, 23, 42, 0.5)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 12px 35px rgba(15, 23, 42, 0.4)'">
                        <span id="cover-consultation-btn-text" style="display: flex; align-items: center; gap: 12px;">
                            <span style="font-size: 1.8rem;">📞</span>
                            <span>CLAIM YOUR FREE CONSULTATION NOW</span>
                            <span style="font-size: 1.5rem;">→</span>
                        </span>
                        <span id="cover-consultation-btn-loading" style="display: none;">
                            <span style="display: inline-block; animation: spin 1s linear infinite; font-size: 1.3rem; margin-right: 12px;">⏳</span> 
                            <span>Sending...</span>
                        </span>
                    </button>
                    
                    <!-- GUARANTEE MESSAGE -->
                    <div style="text-align: center; margin-top: 25px;">
                        <p style="margin: 0; color: #64748b; font-size: 0.95rem; font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif; line-height: 1.6;">
                            <span style="color: #0F172A; font-weight: 700;">✓ 100% Free</span> • 
                            <span style="color: #0F172A; font-weight: 700;">✓ No Obligation</span> • 
                            <span style="color: #0F172A; font-weight: 700;">✓ Confidential</span>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Slide 2: About Bansal Lawyers -->
<section class="section about-section">
    <div class="section-header">
        <h2 class="section-title" style="color: var(--white);">About Bansal Lawyers</h2>
        <p class="section-subtitle" style="color: rgba(255, 255, 255, 0.9);">Comprehensive Legal Practice Based in Melbourne, Australia</p>
    </div>
    <div class="grid-2x2">
        <div class="info-card" style="animation: fadeInUp 0.6s ease-out;">
            <div class="card-icon">⚖️</div>
            <h3 class="card-header">Specialized Expertise</h3>
            <p class="card-body">Strong reputation in Family Law, with services across Immigration, Criminal, Property, Commercial, and Civil Law</p>
        </div>
        <div class="info-card" style="animation: fadeInUp 0.8s ease-out;">
            <div class="card-icon heart-icon">❤️</div>
            <h3 class="card-header">Client-Centered Approach</h3>
            <p class="card-body">Commitment to understanding each client's unique situation, providing tailored advice and dedicated support</p>
        </div>
        <div class="info-card" style="animation: fadeInUp 1s ease-out;">
            <div class="card-icon trophy-icon">🏆</div>
            <h3 class="card-header">Proven Track Record</h3>
            <p class="card-body">Consistent client satisfaction through professionalism, responsiveness, and positive outcomes</p>
        </div>
        <div class="info-card" style="animation: fadeInUp 1.2s ease-out;">
            <div class="card-icon shield-icon">🛡️</div>
            <h3 class="card-header">Protecting Your Future</h3>
            <p class="card-body">Navigating complex legal challenges with expertise, transforming daunting processes into manageable experiences</p>
        </div>
    </div>
</section>

<!-- Slide 3: Understanding Divorce in Australia -->
<section class="section" style="background: linear-gradient(180deg, var(--light-blue) 0%, rgba(237, 246, 249, 0.5) 50%, var(--light-blue) 100%); position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle at 20% 30%, rgba(15, 23, 42, 0.1) 0%, transparent 50%), radial-gradient(circle at 80% 70%, rgba(30, 64, 175, 0.1) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="section-header" style="position: relative; z-index: 1;">
        <h2 class="section-title">Understanding Divorce in Australia</h2>
        <p class="section-subtitle">Australia's Family Law System Operates on a No-Fault Basis</p>
    </div>
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px; align-items: start; position: relative; z-index: 1;">
        <div class="explanation-panel">
            <h3 class="panel-header">What Does No-Fault Mean?</h3>
            <ul class="panel-list">
                <li>The court does not require a reason for the marriage breakdown</li>
                <li>No need to prove wrongdoing or assign blame to either party</li>
                <li>The sole ground for divorce is the irretrievable breakdown of the marriage</li>
                <li>This approach reduces conflict and simplifies the legal process</li>
            </ul>
            <p class="panel-text" style="font-style: italic; margin-top: 25px; padding: 20px; background: rgba(15, 23, 42, 0.1); border-radius: 12px; border-left: 4px solid var(--accent-teal);">
                Divorce legally ends the marriage, but property division and parenting arrangements must be addressed separately
            </p>
        </div>
        <div class="highlight-box">
            <div class="highlight-box-content">
                <div class="highlight-icon-wrapper">
                    <span class="highlight-icon">ℹ️</span>
                </div>
                <h3 class="highlight-title">Key Requirement</h3>
                <p class="highlight-text emphasis">
                    You must be separated for at least 12 months and 1 day
                </p>
                <p class="highlight-subtext">
                    This is the primary legal requirement for divorce in Australia
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Slide 4: Legal Requirements for Divorce -->
<section class="section" style="background: linear-gradient(180deg, rgba(255, 255, 255, 0.5) 0%, var(--light-blue) 30%, rgba(255, 255, 255, 0.5) 100%); position: relative; overflow: hidden;">
    <!-- Decorative Background Elements -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: 
        radial-gradient(circle at 10% 20%, rgba(15, 23, 42, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 90% 80%, rgba(30, 64, 175, 0.08) 0%, transparent 50%);
        pointer-events: none;"></div>
    
    <div class="section-header" style="position: relative; z-index: 1;">
        <h2 class="section-title">Legal Requirements for Divorce</h2>
        <p class="section-subtitle" style="font-size: 1.3rem; margin-top: 15px;">Understanding the Essential Criteria for Filing a Divorce Application</p>
    </div>
    <div class="grid-2x2" style="position: relative; z-index: 1;">
        <div class="requirement-card" style="background: linear-gradient(135deg, rgba(30, 58, 138, 0.08) 0%, rgba(255, 255, 255, 0.98) 50%, rgba(237, 246, 249, 0.95) 100%); border-top-color: #1E3A8A;">
            <div class="card-icon" style="background: linear-gradient(135deg, #1E3A8A 0%, #7c3aed 100%); width: 90px; height: 90px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.8rem; margin: 0 auto 25px; box-shadow: 0 12px 35px rgba(30, 58, 138, 0.4), inset 0 2px 10px rgba(255, 255, 255, 0.3); border: 3px solid rgba(255, 255, 255, 0.5); position: relative; z-index: 2;">
                <span style="filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));">📅</span>
            </div>
            <div class="req-number">01</div>
            <h3 class="req-title" style="color: #7c3aed;">Separation Period</h3>
            <p class="req-description">Continuous separation for at least <strong style="color: #1E3A8A; font-weight: 700; font-size: 1.15rem;">12 months and 1 day</strong></p>
            <p class="req-note" style="background: linear-gradient(135deg, rgba(30, 58, 138, 0.12) 0%, rgba(30, 58, 138, 0.08) 100%); padding: 14px 20px; border-radius: 12px; border-left: 4px solid #1E3A8A; margin-top: 18px; font-size: 0.95rem; font-style: italic; box-shadow: 0 4px 15px rgba(30, 58, 138, 0.15);">Separation under one roof is possible with additional evidence</p>
        </div>
        <div class="requirement-card" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(255, 255, 255, 0.98) 50%, rgba(237, 246, 249, 0.95) 100%); border-top-color: #10b981;">
            <div class="card-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); width: 90px; height: 90px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.8rem; margin: 0 auto 25px; box-shadow: 0 12px 35px rgba(16, 185, 129, 0.4), inset 0 2px 10px rgba(255, 255, 255, 0.3); border: 3px solid rgba(255, 255, 255, 0.5); position: relative; z-index: 2;">
                <span style="filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));">🏠</span>
            </div>
            <div class="req-number">02</div>
            <h3 class="req-title" style="color: #059669;">Residency Requirement</h3>
            <p class="req-description">At least one spouse must meet <strong style="color: #10b981; font-weight: 700; font-size: 1.15rem;">ONE</strong> of these criteria:</p>
            <ul class="panel-list" style="margin-top: 22px; position: relative; z-index: 1; list-style: none; padding-left: 0;">
                <li style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.12) 0%, rgba(16, 185, 129, 0.08) 100%); padding: 12px 18px; border-radius: 10px; margin-bottom: 12px; border-left: 4px solid #10b981; box-shadow: 0 2px 8px rgba(16, 185, 129, 0.15); transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;">
                    <span style="color: #10b981; font-weight: 700; font-size: 1.1rem;">✓</span>
                    <span>Australian citizen</span>
                </li>
                <li style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.12) 0%, rgba(16, 185, 129, 0.08) 100%); padding: 12px 18px; border-radius: 10px; margin-bottom: 12px; border-left: 4px solid #10b981; box-shadow: 0 2px 8px rgba(16, 185, 129, 0.15); transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;">
                    <span style="color: #10b981; font-weight: 700; font-size: 1.1rem;">✓</span>
                    <span>Considers Australia their permanent home</span>
                </li>
                <li style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.12) 0%, rgba(16, 185, 129, 0.08) 100%); padding: 12px 18px; border-radius: 10px; margin-bottom: 12px; border-left: 4px solid #10b981; box-shadow: 0 2px 8px rgba(16, 185, 129, 0.15); transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;">
                    <span style="color: #10b981; font-weight: 700; font-size: 1.1rem;">✓</span>
                    <span>Lived in Australia for 12 months before filing</span>
                </li>
            </ul>
        </div>
        <div class="requirement-card" style="background: linear-gradient(135deg, rgba(6, 182, 212, 0.08) 0%, rgba(255, 255, 255, 0.98) 50%, rgba(237, 246, 249, 0.95) 100%); border-top-color: #06b6d4;">
            <div class="card-icon" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); width: 90px; height: 90px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.8rem; margin: 0 auto 25px; box-shadow: 0 12px 35px rgba(6, 182, 212, 0.4), inset 0 2px 10px rgba(255, 255, 255, 0.3); border: 3px solid rgba(255, 255, 255, 0.5); position: relative; z-index: 2;">
                <span style="filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));">📄</span>
            </div>
            <div class="req-number">03</div>
            <h3 class="req-title" style="color: #0891b2;">Marriage Certificate</h3>
            <p class="req-description">A valid marriage certificate must be provided with the divorce application</p>
            <p class="req-note" style="background: linear-gradient(135deg, rgba(6, 182, 212, 0.12) 0%, rgba(6, 182, 212, 0.08) 100%); padding: 14px 20px; border-radius: 12px; border-left: 4px solid #06b6d4; margin-top: 18px; font-size: 0.95rem; font-style: italic; box-shadow: 0 4px 15px rgba(6, 182, 212, 0.15);">Original or certified copy accepted</p>
        </div>
        <div class="requirement-card" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.08) 0%, rgba(255, 255, 255, 0.98) 50%, rgba(237, 246, 249, 0.95) 100%); border-top-color: #0F172A;">
            <div class="card-icon" style="background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 100%); width: 90px; height: 90px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.8rem; margin: 0 auto 25px; box-shadow: 0 12px 35px rgba(15, 23, 42, 0.4), inset 0 2px 10px rgba(255, 255, 255, 0.3); border: 3px solid rgba(255, 255, 255, 0.5); position: relative; z-index: 2;">
                <span style="filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));">👨‍👩‍👧‍👦</span>
            </div>
            <div class="req-number">04</div>
            <h3 class="req-title" style="color: #0F172A;">Children Consideration</h3>
            <p class="req-description">If there are children <strong style="color: #0F172A; font-weight: 700; font-size: 1.15rem;">under 18</strong>, court attendance may be required</p>
            <p class="req-note" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.12) 0%, rgba(15, 23, 42, 0.08) 100%); padding: 14px 20px; border-radius: 12px; border-left: 4px solid #0F172A; margin-top: 18px; font-size: 0.95rem; font-style: italic; box-shadow: 0 4px 15px rgba(15, 23, 42, 0.15);">The court ensures proper arrangements are in place for children's welfare</p>
        </div>
    </div>
</section>

<!-- Slide 5: The Divorce Process -->
<section class="section" style="background: linear-gradient(180deg, #ffffff 0%, #f8fafb 50%, #ffffff 100%); position: relative; overflow: hidden; padding: 120px 60px;">
    <!-- Subtle Background Pattern -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: 
        radial-gradient(circle at 20% 30%, rgba(15, 23, 42, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(15, 23, 42, 0.03) 0%, transparent 50%);
        pointer-events: none;"></div>
    
    <div class="section-header" style="position: relative; z-index: 1; margin-bottom: 70px;">
        <h2 class="section-title" style="color: var(--primary-teal); font-size: 3.5rem; margin-bottom: 15px; font-weight: 800;">The Divorce Process: Step by Step</h2>
        <p class="section-subtitle" style="font-size: 1.5rem; color: #94A3B8; font-weight: 500;">A Structured Path from Application to Finalization</p>
    </div>
    
    <div class="process-flow-enhanced" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; position: relative; z-index: 1; max-width: 1400px; margin: 0 auto;">
        <!-- Step 1: Application -->
        <div class="process-card-enhanced" style="background: #ffffff; border-radius: 20px; padding: 40px 30px; text-align: center; position: relative; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 2px solid #f1f5f9; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #0F172A 0%, #1E3A8A 100%);"></div>
            
            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.3); position: relative;">
                <span style="font-size: 2.5rem; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">📝</span>
            </div>
            
            <h3 style="color: #0F172A; font-size: 1.5rem; font-weight: 700; margin-bottom: 15px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">Application</h3>
            <p style="color: #94A3B8; font-size: 1rem; line-height: 1.6; margin-bottom: 15px; font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;">File with Federal Circuit and Family Court of Australia (online or paper)</p>
            <div style="background: #f8fafb; padding: 12px 16px; border-radius: 8px; border-left: 3px solid #0F172A; margin-top: 15px;">
                <p style="font-size: 0.9rem; color: #0F172A; font-weight: 600; margin: 0; font-style: italic;">Sole or joint application</p>
            </div>
        </div>
        
        <!-- Step 2: Service -->
        <div class="process-card-enhanced" style="background: #ffffff; border-radius: 20px; padding: 40px 30px; text-align: center; position: relative; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 2px solid #f1f5f9; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #1E40AF 0%, #06b6d4 100%);"></div>
            
            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #1E40AF 0%, #06b6d4 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; box-shadow: 0 10px 30px rgba(30, 64, 175, 0.3); position: relative;">
                <span style="font-size: 2.5rem; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">📤</span>
            </div>
            
            <h3 style="color: #0F172A; font-size: 1.5rem; font-weight: 700; margin-bottom: 15px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">Service</h3>
            <p style="color: #94A3B8; font-size: 1rem; line-height: 1.6; margin-bottom: 15px; font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;">For sole applications, divorce papers must be formally served on the other spouse</p>
            <div style="background: #f8fafb; padding: 12px 16px; border-radius: 8px; border-left: 3px solid #1E40AF; margin-top: 15px;">
                <p style="font-size: 0.9rem; color: #1E40AF; font-weight: 600; margin: 0; font-style: italic;">Not required for joint applications</p>
            </div>
        </div>
        
        <!-- Step 3: Court Hearing -->
        <div class="process-card-enhanced" style="background: #ffffff; border-radius: 20px; padding: 40px 30px; text-align: center; position: relative; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 2px solid #f1f5f9; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #1E3A8A 0%, #a855f7 100%);"></div>
            
            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #1E3A8A 0%, #a855f7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; box-shadow: 0 10px 30px rgba(30, 58, 138, 0.3); position: relative;">
                <span style="font-size: 2.5rem; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">⚖️</span>
            </div>
            
            <h3 style="color: #0F172A; font-size: 1.5rem; font-weight: 700; margin-bottom: 15px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">Court Hearing</h3>
            <p style="color: #94A3B8; font-size: 1rem; line-height: 1.6; margin-bottom: 15px; font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;">Court reviews the application to ensure all legal requirements are met</p>
            <div style="background: #f8fafb; padding: 12px 16px; border-radius: 8px; border-left: 3px solid #1E3A8A; margin-top: 15px;">
                <p style="font-size: 0.9rem; color: #1E3A8A; font-weight: 600; margin: 0;">May be required, especially with children under 18</p>
            </div>
        </div>
        
        <!-- Step 4: Finalization -->
        <div class="process-card-enhanced" style="background: linear-gradient(135deg, #fff7ed 0%, #ffffff 100%); border-radius: 20px; padding: 40px 30px; text-align: center; position: relative; box-shadow: 0 8px 30px rgba(15, 23, 42, 0.15), 0 4px 20px rgba(0, 0, 0, 0.08); border: 2px solid #fed7aa; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #0F172A 0%, #1E40AF 100%);"></div>
            
            <div style="width: 90px; height: 90px; background: linear-gradient(135deg, #0F172A 0%, #1E40AF 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; box-shadow: 0 12px 35px rgba(15, 23, 42, 0.4); position: relative;">
                <span style="font-size: 2.8rem; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">✅</span>
            </div>
            
            <h3 style="color: #0F172A; font-size: 1.6rem; font-weight: 800; margin-bottom: 15px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">Finalization</h3>
            <p style="color: #94A3B8; font-size: 1rem; line-height: 1.6; margin-bottom: 15px; font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;">Divorce order becomes final one month and one day after the court hearing</p>
            <div style="background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%); padding: 14px 18px; border-radius: 10px; border: 2px solid #0F172A; margin-top: 15px; box-shadow: 0 4px 15px rgba(15, 23, 42, 0.2);">
                <p style="font-weight: 700; font-size: 1rem; color: #0F172A; margin: 0;">Your marriage is legally ended</p>
            </div>
        </div>
    </div>
    
    <!-- Connecting Lines -->
    <div style="position: absolute; top: 50%; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent 0%, #e2e8f0 20%, #e2e8f0 80%, transparent 100%); z-index: 0; max-width: 1400px; margin: 0 auto; transform: translateY(-50%);"></div>
</section>

<!-- Slide 6: Property Settlement -->
<section class="section" style="background: linear-gradient(180deg, #ffffff 0%, #f8fafb 50%, #ffffff 100%); position: relative; overflow: hidden; padding: 100px 60px;">
    <!-- Subtle Background Pattern -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: 
        radial-gradient(circle at 20% 30%, rgba(15, 23, 42, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(15, 23, 42, 0.03) 0%, transparent 50%);
        pointer-events: none;"></div>
    
    <div class="section-header" style="position: relative; z-index: 1; margin-bottom: 60px;">
        <h2 class="section-title" style="color: var(--primary-teal); font-size: 3.5rem; margin-bottom: 15px; font-weight: 800;">Property Settlement: Dividing Your Assets</h2>
    </div>
    
    <div style="display: grid; grid-template-columns: 3fr 2fr; gap: 40px; position: relative; z-index: 1; max-width: 1400px; margin: 0 auto;">
        <!-- Left Panel: What is Property Settlement -->
        <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafb 100%); border-radius: 25px; padding: 50px 40px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08); border: 2px solid #e2e8f0; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;">
            <!-- Decorative Corner -->
            <div style="position: absolute; top: -30px; right: -30px; width: 120px; height: 120px; background: linear-gradient(135deg, rgba(15, 23, 42, 0.08) 0%, transparent 100%); border-radius: 50%; pointer-events: none;"></div>
            
            <!-- Icon Header -->
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 30px;">
                <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #006D77 0%, #83C5BE 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 25px rgba(15, 23, 42, 0.25);">
                    <span style="font-size: 2.2rem; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">💰</span>
                </div>
                <h3 class="panel-header" style="color: var(--primary-teal); font-size: 2rem; font-weight: 800; margin: 0; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">What is Property Settlement?</h3>
            </div>
            
            <p class="panel-text" style="color: #94A3B8; font-size: 1.1rem; line-height: 1.8; margin-bottom: 25px; font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;">
                The process of dividing assets, liabilities, and financial resources after a relationship breakdown
            </p>
            
            <div style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.08) 0%, rgba(15, 23, 42, 0.08) 100%); padding: 18px 22px; border-radius: 12px; border-left: 4px solid var(--primary-teal); margin-bottom: 35px; box-shadow: 0 4px 15px rgba(15, 23, 42, 0.1);">
                <p class="panel-text" style="font-weight: 700; color: var(--primary-teal); font-size: 1.05rem; margin: 0; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">
                    ✓ Applies to both married couples and de facto relationships
                </p>
            </div>
            
            <h3 class="panel-header" style="color: var(--primary-teal); font-size: 1.6rem; font-weight: 700; margin-top: 35px; margin-bottom: 20px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif; display: flex; align-items: center; gap: 10px;">
                <span style="width: 4px; height: 30px; background: linear-gradient(180deg, var(--primary-teal) 0%, var(--accent-teal) 100%); border-radius: 2px;"></span>
                What Can Be Divided?
            </h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 30px;">
                <div style="background: #ffffff; padding: 14px 18px; border-radius: 10px; border: 2px solid #e2e8f0; display: flex; align-items: center; gap: 12px; transition: all 0.3s ease;" onmouseover="this.style.borderColor='var(--primary-teal)'; this.style.boxShadow='0 4px 12px rgba(15, 23, 42, 0.15)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                    <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);">
                        <span style="color: white; font-size: 1rem; font-weight: 700;">✓</span>
                    </div>
                    <span style="color: #334155; font-size: 0.95rem; font-weight: 500;">Family home & real estate</span>
                </div>
                
                <div style="background: #ffffff; padding: 14px 18px; border-radius: 10px; border: 2px solid #e2e8f0; display: flex; align-items: center; gap: 12px; transition: all 0.3s ease;" onmouseover="this.style.borderColor='var(--primary-teal)'; this.style.boxShadow='0 4px 12px rgba(15, 23, 42, 0.15)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                    <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);">
                        <span style="color: white; font-size: 1rem; font-weight: 700;">✓</span>
                    </div>
                    <span style="color: #334155; font-size: 0.95rem; font-weight: 500;">Bank accounts & investments</span>
                </div>
                
                <div style="background: #ffffff; padding: 14px 18px; border-radius: 10px; border: 2px solid #e2e8f0; display: flex; align-items: center; gap: 12px; transition: all 0.3s ease;" onmouseover="this.style.borderColor='var(--primary-teal)'; this.style.boxShadow='0 4px 12px rgba(15, 23, 42, 0.15)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                    <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);">
                        <span style="color: white; font-size: 1rem; font-weight: 700;">✓</span>
                    </div>
                    <span style="color: #334155; font-size: 0.95rem; font-weight: 500;">Business interests</span>
                </div>
                
                <div style="background: #ffffff; padding: 14px 18px; border-radius: 10px; border: 2px solid #e2e8f0; display: flex; align-items: center; gap: 12px; transition: all 0.3s ease;" onmouseover="this.style.borderColor='var(--primary-teal)'; this.style.boxShadow='0 4px 12px rgba(15, 23, 42, 0.15)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                    <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);">
                        <span style="color: white; font-size: 1rem; font-weight: 700;">✓</span>
                    </div>
                    <span style="color: #334155; font-size: 0.95rem; font-weight: 500;">Superannuation funds</span>
                </div>
                
                <div style="background: #ffffff; padding: 14px 18px; border-radius: 10px; border: 2px solid #e2e8f0; display: flex; align-items: center; gap: 12px; transition: all 0.3s ease;" onmouseover="this.style.borderColor='var(--primary-teal)'; this.style.boxShadow='0 4px 12px rgba(15, 23, 42, 0.15)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                    <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);">
                        <span style="color: white; font-size: 1rem; font-weight: 700;">✓</span>
                    </div>
                    <span style="color: #334155; font-size: 0.95rem; font-weight: 500;">Personal property & vehicles</span>
                </div>
                
                <div style="background: #ffffff; padding: 14px 18px; border-radius: 10px; border: 2px solid #e2e8f0; display: flex; align-items: center; gap: 12px; transition: all 0.3s ease;" onmouseover="this.style.borderColor='var(--primary-teal)'; this.style.boxShadow='0 4px 12px rgba(15, 23, 42, 0.15)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                    <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);">
                        <span style="color: white; font-size: 1rem; font-weight: 700;">✓</span>
                    </div>
                    <span style="color: #334155; font-size: 0.95rem; font-weight: 500;">Debts & liabilities</span>
                </div>
            </div>
            
            <div style="background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%); padding: 20px 25px; border-radius: 15px; border: 2px solid #0F172A; margin-top: 25px; box-shadow: 0 8px 25px rgba(15, 23, 42, 0.15); position: relative; overflow: hidden;">
                <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: radial-gradient(circle, rgba(15, 23, 42, 0.1) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
                <p style="font-style: italic; color: #7c2d12; font-size: 1rem; font-weight: 600; margin: 0; position: relative; z-index: 1; line-height: 1.6;">
                    ⚠️ Property settlement is separate from divorce. Both must be addressed for complete resolution.
                </p>
            </div>
        </div>
        
        <!-- Right Panel: Critical Time Limits -->
        <div style="background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 30%, #ffffff 100%); border-radius: 25px; padding: 50px 40px; box-shadow: 0 10px 40px rgba(15, 23, 42, 0.15), 0 4px 20px rgba(0, 0, 0, 0.08); border: 2px solid #fed7aa; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 50px rgba(15, 23, 42, 0.2), 0 6px 25px rgba(0, 0, 0, 0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 40px rgba(15, 23, 42, 0.15), 0 4px 20px rgba(0, 0, 0, 0.08)'">
            <!-- Decorative Elements -->
            <div style="position: absolute; top: -40px; right: -40px; width: 140px; height: 140px; background: radial-gradient(circle, rgba(15, 23, 42, 0.12) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
            <div style="position: absolute; bottom: -30px; left: -30px; width: 100px; height: 100px; background: radial-gradient(circle, rgba(30, 58, 138, 0.1) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
            
            <!-- Icon -->
            <div style="width: 90px; height: 90px; background: linear-gradient(135deg, #0F172A 0%, #1E40AF 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; box-shadow: 0 12px 35px rgba(15, 23, 42, 0.4); position: relative; z-index: 1; animation: pulse-icon 2s ease-in-out infinite;">
                <span style="font-size: 2.8rem; filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.2));">⏰</span>
            </div>
            
            <h3 style="text-align: center; color: #7c2d12; font-size: 1.8rem; font-weight: 800; margin-bottom: 35px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif; position: relative; z-index: 1;">Critical Time Limits</h3>
            
            <!-- Married Couples -->
            <div style="background: #ffffff; padding: 20px 22px; border-radius: 15px; border-left: 5px solid #0F172A; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(15, 23, 42, 0.1); position: relative; z-index: 1;">
                <p style="font-weight: 800; color: #0F172A; font-size: 1.05rem; margin-bottom: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">
                    💑 Married Couples:
                </p>
                <p style="color: #94A3B8; font-size: 1rem; margin: 0; line-height: 1.6; font-weight: 500;">
                    Within <strong style="color: #0F172A; font-weight: 700;">12 months</strong> of divorce order becoming final
                </p>
            </div>
            
            <!-- De Facto Couples -->
            <div style="background: #ffffff; padding: 20px 22px; border-radius: 15px; border-left: 5px solid #1E40AF; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(15, 23, 42, 0.1); position: relative; z-index: 1;">
                <p style="font-weight: 800; color: #1E40AF; font-size: 1.05rem; margin-bottom: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">
                    👥 De Facto Couples:
                </p>
                <p style="color: #94A3B8; font-size: 1rem; margin: 0; line-height: 1.6; font-weight: 500;">
                    Within <strong style="color: #1E40AF; font-weight: 700;">2 years</strong> of separation date
                </p>
            </div>
            
            <!-- Warning Box -->
            <div style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); padding: 20px 22px; border-radius: 15px; border: 2px solid #ef4444; margin-bottom: 20px; box-shadow: 0 6px 20px rgba(239, 68, 68, 0.15); position: relative; z-index: 1;">
                <p style="font-weight: 700; color: #991b1b; font-size: 1rem; margin: 0; line-height: 1.6; display: flex; align-items: flex-start; gap: 10px;">
                    <span style="font-size: 1.3rem; flex-shrink: 0;">⚠️</span>
                    <span>Missing these deadlines may prevent you from making a property claim</span>
                </p>
            </div>
            
            <!-- Call to Action -->
            <a href="#consultation-form" style="display: block; background: linear-gradient(135deg, var(--primary-teal) 0%, var(--accent-teal) 100%); padding: 18px 22px; border-radius: 15px; box-shadow: 0 8px 25px rgba(15, 23, 42, 0.3); position: relative; z-index: 1; text-decoration: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 35px rgba(15, 23, 42, 0.4)'; this.style.background='linear-gradient(135deg, var(--accent-teal) 0%, var(--primary-teal) 100%)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(15, 23, 42, 0.3)'; this.style.background='linear-gradient(135deg, var(--primary-teal) 0%, var(--accent-teal) 100%)'">
                <p style="font-weight: 700; color: white; font-size: 1.05rem; margin: 0; text-align: center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif; display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <span>💡</span>
                    <span>Seek legal advice early to protect your rights</span>
                    <span style="font-size: 1.2rem; transition: transform 0.3s ease;">→</span>
                </p>
            </a>
        </div>
    </div>
</section>

<!-- Slide 7: Property Settlement Process -->
<section class="section" style="background: var(--light-blue);">
    <div class="section-header">
        <h2 class="section-title">The Property Settlement Process</h2>
        <p class="section-subtitle">The Court's Four-Step Framework for 'Just and Equitable' Division</p>
    </div>
    <div class="grid-2x2">
        <div class="info-card">
            <div class="card-icon">📋</div>
            <h3 class="card-header">Step 1: Identify and Value the Asset Pool</h3>
            <p class="card-body">All assets and debts are identified and professionally valued</p>
            <p class="card-body" style="font-size: 0.95rem; margin-top: 10px;">
                Includes: Real estate, bank accounts, investments, business interests, superannuation, and all liabilities
            </p>
        </div>
        <div class="info-card">
            <div class="card-icon">⚖️</div>
            <h3 class="card-header">Step 2: Assess Contributions</h3>
            <p class="card-body">The court considers both financial and non-financial contributions made by each party</p>
            <ul class="panel-list" style="text-align: left; margin-top: 15px;">
                <li>Wages and income</li>
                <li>Inheritances and gifts</li>
                <li>Homemaker role</li>
                <li>Parenting responsibilities</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="card-icon">👥</div>
            <h3 class="card-header">Step 3: Evaluate Future Needs</h3>
            <p class="card-body">Assessment of factors that may affect each party's future financial position</p>
            <ul class="panel-list" style="text-align: left; margin-top: 15px;">
                <li>Age and health</li>
                <li>Income and earning capacity</li>
                <li>Care of children</li>
                <li>Financial resources and needs</li>
            </ul>
        </div>
        <div class="info-card" style="background: var(--primary-teal);">
            <div class="card-icon" style="background: #ffffff; border: 3px solid rgba(255, 255, 255, 0.5); color: #0F172A; font-size: 3.5rem; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3); line-height: 1; display: flex; align-items: center; justify-content: center; filter: none !important;">⚖️</div>
            <h3 class="card-header" style="color: var(--white);">Step 4: Make a Just and Equitable Order</h3>
            <p class="card-body" style="color: rgba(255, 255, 255, 0.95);">The court makes a final decision on division to ensure fairness to both parties</p>
            <p class="card-body" style="font-weight: 700; margin-top: 15px; color: rgba(255, 255, 255, 0.95);">
                Binding court order that protects both parties' interests
            </p>
        </div>
    </div>
</section>

<!-- Slide 8: Parenting Arrangements -->
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Parenting Arrangements After Separation</h2>
    </div>
    <div style="background: var(--light-blue); border-radius: 12px; padding: 40px; margin-bottom: 40px; text-align: center;">
        <div class="card-icon" style="margin: 0 auto 20px;">❤️</div>
        <h3 class="panel-header" style="font-size: 2rem; margin-bottom: 15px;">The Best Interests of the Child</h3>
        <p class="panel-text" style="max-width: 900px; margin: 0 auto;">
            This is the paramount consideration in all parenting matters. Australian law focuses on 'parental responsibility' and 'parenting time' rather than outdated terms like 'custody.'
        </p>
        <p class="panel-text" style="font-style: italic; margin-top: 15px;">
            There is no automatic 50/50 split - arrangements are based on the child's needs and practical considerations.
        </p>
    </div>
    <div class="grid-3x2" style="grid-template-columns: repeat(3, 1fr);">
        <div class="info-card">
            <div class="card-icon">👥</div>
            <h3 class="card-header">Parental Responsibility</h3>
            <p class="card-body">The authority to make major long-term decisions about a child's life</p>
            <ul class="panel-list" style="text-align: left; margin-top: 15px;">
                <li>Education choices</li>
                <li>Health and medical care</li>
                <li>Religious upbringing</li>
                <li>Living arrangements</li>
            </ul>
            <p class="card-body" style="font-size: 0.9rem; font-style: italic; margin-top: 15px;">
                The court presumes equal shared parental responsibility is in the child's best interest
            </p>
        </div>
        <div class="info-card">
            <div class="card-icon">📅</div>
            <h3 class="card-header">Parenting Time</h3>
            <p class="card-body">The time a child spends living with or spending time with each parent</p>
            <p class="card-body" style="font-weight: 700; margin-top: 15px;">
                Arrangements are flexible and tailored to:
            </p>
            <ul class="panel-list" style="text-align: left; margin-top: 15px;">
                <li>Child's age and needs</li>
                <li>Parents' work schedules</li>
                <li>Geographic distance</li>
                <li>Child's preferences (if age-appropriate)</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="card-icon">📄</div>
            <h3 class="card-header">Formalizing Arrangements</h3>
            <ul class="panel-list" style="text-align: left;">
                <li><strong>Parenting Plans:</strong> Written agreements (not legally binding)</li>
                <li><strong>Consent Orders:</strong> Court-approved agreements (legally binding)</li>
                <li><strong>Court Orders:</strong> Issued after mediation if parents cannot agree</li>
            </ul>
            <p class="card-body" style="background: #0F172A; color: white; padding: 15px; border-radius: 8px; margin-top: 20px; font-weight: 700;">
                Consent orders provide legal protection while maintaining cooperation
            </p>
        </div>
    </div>
</section>

<!-- Slide 10: Why Choose Bansal Lawyers -->
<section class="section" style="background: linear-gradient(180deg, #ffffff 0%, #f8fafb 50%, #ffffff 100%); position: relative; overflow: hidden; padding: 80px 60px;">
    <!-- Subtle Background Pattern -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: 
        radial-gradient(circle at 20% 30%, rgba(15, 23, 42, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(15, 23, 42, 0.03) 0%, transparent 50%);
        pointer-events: none;"></div>
    
    <div class="section-header" style="position: relative; z-index: 1; margin-bottom: 50px;">
        <h2 class="section-title" style="color: var(--primary-teal); font-size: 3rem; margin-bottom: 12px; font-weight: 800;">Why Choose Bansal Lawyers?</h2>
        <p class="section-subtitle" style="font-size: 1.3rem; color: #94A3B8; font-weight: 500;">Your Trusted Partner Through Life's Most Challenging Legal Matters</p>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; max-width: 1200px; margin: 0 auto; position: relative; z-index: 1;">
        <!-- Card 1: Specialized Expertise -->
        <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafb 100%); border-radius: 20px; padding: 35px 28px; box-shadow: 0 6px 25px rgba(0, 0, 0, 0.08); border: 2px solid #e2e8f0; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 40px rgba(15, 23, 42, 0.15)'; this.style.borderColor='var(--primary-teal)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 25px rgba(0, 0, 0, 0.08)'; this.style.borderColor='#e2e8f0'">
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #0F172A 0%, #1E3A8A 100%);"></div>
            <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: radial-gradient(circle, rgba(15, 23, 42, 0.08) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
            
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <div style="width: 65px; height: 65px; background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 20px rgba(15, 23, 42, 0.3); flex-shrink: 0;">
                    <span style="font-size: 2rem; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">🏆</span>
                </div>
                <div style="width: 45px; height: 45px; background: linear-gradient(135deg, rgba(15, 23, 42, 0.1) 0%, rgba(30, 58, 138, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #0F172A; font-weight: 800; font-size: 1.1rem; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">01</div>
            </div>
            
            <h3 style="color: #0F172A; font-size: 1.4rem; font-weight: 700; margin-bottom: 12px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">Specialized Expertise</h3>
            <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6; margin-bottom: 18px; font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;">
                Handling complex family law matters with empathy and skill. Expert handling of divorce, separation, parenting plans, and property settlements.
            </p>
            <a href="#consultation-form" style="display: inline-flex; align-items: center; gap: 8px; color: var(--primary-teal); font-weight: 700; font-size: 0.95rem; text-decoration: none; transition: all 0.3s ease; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;" onmouseover="this.style.gap='12px'; this.style.color='var(--accent-teal)'" onmouseout="this.style.gap='8px'; this.style.color='var(--primary-teal)'">
                <span>Deep knowledge across all aspects →</span>
            </a>
        </div>
        
        <!-- Card 2: Client-Centered Approach -->
        <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafb 100%); border-radius: 20px; padding: 35px 28px; box-shadow: 0 6px 25px rgba(0, 0, 0, 0.08); border: 2px solid #e2e8f0; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 40px rgba(15, 23, 42, 0.15)'; this.style.borderColor='#0F172A'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 25px rgba(0, 0, 0, 0.08)'; this.style.borderColor='#e2e8f0'">
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #0F172A 0%, #1E40AF 100%);"></div>
            <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: radial-gradient(circle, rgba(15, 23, 42, 0.08) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
            
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <div style="width: 65px; height: 65px; background: linear-gradient(135deg, #0F172A 0%, #1E40AF 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 20px rgba(15, 23, 42, 0.3); flex-shrink: 0;">
                    <span style="font-size: 2rem; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">❤️</span>
                </div>
                <div style="width: 45px; height: 45px; background: linear-gradient(135deg, rgba(15, 23, 42, 0.1) 0%, rgba(249, 115, 22, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #0F172A; font-weight: 800; font-size: 1.1rem; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">02</div>
            </div>
            
            <h3 style="color: #0F172A; font-size: 1.4rem; font-weight: 700; margin-bottom: 12px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">Client-Centered Approach</h3>
            <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6; margin-bottom: 18px; font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;">
                Committed to understanding each client's unique situation. Tailored advice and dedicated support to make the legal process manageable.
            </p>
            <a href="#consultation-form" style="display: inline-flex; align-items: center; gap: 8px; color: #0F172A; font-weight: 700; font-size: 0.95rem; text-decoration: none; transition: all 0.3s ease; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;" onmouseover="this.style.gap='12px'; this.style.color='#1E40AF'" onmouseout="this.style.gap='8px'; this.style.color='#0F172A'">
                <span>Personalized assistance at every step →</span>
            </a>
        </div>
        
        <!-- Card 3: Proven Track Record -->
        <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafb 100%); border-radius: 20px; padding: 35px 28px; box-shadow: 0 6px 25px rgba(0, 0, 0, 0.08); border: 2px solid #e2e8f0; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 40px rgba(16, 185, 129, 0.15)'; this.style.borderColor='#10b981'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 25px rgba(0, 0, 0, 0.08)'; this.style.borderColor='#e2e8f0'">
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #10b981 0%, #059669 100%);"></div>
            <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
            
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <div style="width: 65px; height: 65px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3); flex-shrink: 0;">
                    <span style="font-size: 2rem; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">📈</span>
                </div>
                <div style="width: 45px; height: 45px; background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #10b981; font-weight: 800; font-size: 1.1rem; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">03</div>
            </div>
            
            <h3 style="color: #0F172A; font-size: 1.4rem; font-weight: 700; margin-bottom: 12px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">Proven Track Record</h3>
            <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6; margin-bottom: 18px; font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;">
                Client testimonials highlight our professionalism and positive outcomes. We've helped countless families navigate separation with dignity.
            </p>
            <a href="#consultation-form" style="display: inline-flex; align-items: center; gap: 8px; color: #10b981; font-weight: 700; font-size: 0.95rem; text-decoration: none; transition: all 0.3s ease; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;" onmouseover="this.style.gap='12px'; this.style.color='#059669'" onmouseout="this.style.gap='8px'; this.style.color='#10b981'">
                <span>Results that protect your rights →</span>
            </a>
        </div>
    </div>
</section>

<!-- Slide 11: Testimonials -->
<section class="section" style="background: var(--light-blue);">
    <div class="section-header">
        <h2 class="section-title">What Our Clients Say</h2>
    </div>
    <div class="grid-2x2">
        <div class="testimonial-card">
            <div style="width: 70px; height: 70px; background: #ffffff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); border: 2px solid #e8e8e8;">
                <img src="https://www.google.com/images/branding/googleg/1x/googleg_standard_color_128dp.png" alt="Google" style="width: 50px; height: 50px; object-fit: contain;" onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTIyLjU2IDEyLjI1YzAtLjc4LS4wNy0xLjUzLS4yLTIuMjVIMTJ2NC4yNmg1LjkyYy0uMjYgMS4zNy0xLjA0IDIuNTMtMi4yMSAzLjMxdjIuNzdIMTguN2MyLjA4LTEuOTIgMy4yOC00Ljc0IDMuMjgtOC4wOXoiIGZpbGw9IiM0Mjg1RjQiLz4KPHBhdGggZD0iTTEyIDIzYzIuOTcgMCA1LjQ2LS45OCA3LjI4LTIuNjZsLTMuNTctMi43N2MtLjk4LjY2LTIuMjMgMS4wNi0zLjcxIDEuMDYtMi44NiAwLTUuMjktMS45My02LjE2LTQuNTNIMi4xOHYyLjg0QzMuOTkgMjAuNTMgNy43IDIzIDEyIDIzeiIgZmlsbD0iIzM0QTg1MyIvPgo8cGF0aCBkPSJNNS44NCAxNC4wOWMtLjIyLS42Ni0uMzUtMS4zNi0uMzUtMi4wOXMuMTMtMS40My4zNS0yLjA5VjcuMDdIMi4xOEMxLjQzIDguNTUgMSAxMC4yMiAxIDEycy40MyAzLjQ1IDEuMTggNC45M2wyLjg1LTIuMjIuODEtLjYyeiIgZmlsbD0iI0ZCQkMwNSIvPgo8cGF0aCBkPSJNMTIgNS4zOGMxLjYyIDAgMy4wNi41NiA0LjIxIDEuNjRsMy4xNS0zLjE1QzE3LjQ1IDIuMDkgMTQuOTcgMSAxMiAxIDcuNyAxIDMuOTkgMy40NyAyLjE4IDcuMDdsMy42NiAyLjg0Yy44Ny0yLjYgMy4zLTQuNTMgNi4xNi00LjUzeiIgZmlsbD0iI0VBNDMzNSIvPgo8L3N2Zz4K';">
            </div>
            <div style="display: flex; justify-content: center; gap: 4px; margin-bottom: 15px;">
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
            </div>
            <p class="testimonial-quote">
                The team at Bansal Lawyers made a daunting process manageable. Their professionalism and expertise are unmatched.
            </p>
            <p class="testimonial-author">— Sonu Choudhary</p>
        </div>
        <div class="testimonial-card">
            <div style="width: 70px; height: 70px; background: #ffffff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); border: 2px solid #e8e8e8;">
                <img src="https://www.google.com/images/branding/googleg/1x/googleg_standard_color_128dp.png" alt="Google" style="width: 50px; height: 50px; object-fit: contain;" onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTIyLjU2IDEyLjI1YzAtLjc4LS4wNy0xLjUzLS4yLTIuMjVIMTJ2NC4yNmg1LjkyYy0uMjYgMS4zNy0xLjA0IDIuNTMtMi4yMSAzLjMxdjIuNzdIMTguN2MyLjA4LTEuOTIgMy4yOC00Ljc0IDMuMjgtOC4wOXoiIGZpbGw9IiM0Mjg1RjQiLz4KPHBhdGggZD0iTTEyIDIzYzIuOTcgMCA1LjQ2LS45OCA3LjI4LTIuNjZsLTMuNTctMi43N2MtLjk4LjY2LTIuMjMgMS4wNi0zLjcxIDEuMDYtMi44NiAwLTUuMjktMS45My02LjE2LTQuNTNIMi4xOHYyLjg0QzMuOTkgMjAuNTMgNy43IDIzIDEyIDIzeiIgZmlsbD0iIzM0QTg1MyIvPgo8cGF0aCBkPSJNNS44NCAxNC4wOWMtLjIyLS42Ni0uMzUtMS4zNi0uMzUtMi4wOXMuMTMtMS40My4zNS0yLjA5VjcuMDdIMi4xOEMxLjQzIDguNTUgMSAxMC4yMiAxIDEycy40MyAzLjQ1IDEuMTggNC45M2wyLjg1LTIuMjIuODEtLjYyeiIgZmlsbD0iI0ZCQkMwNSIvPgo8cGF0aCBkPSJNMTIgNS4zOGMxLjYyIDAgMy4wNi41NiA0LjIxIDEuNjlsMy4xNS0zLjE1QzE3LjQ1IDIuMDkgMTQuOTcgMSAxMiAxIDcuNyAxIDMuOTkgMy40NyAyLjE4IDcuMDdsMy42NiAyLjg0Yy44Ny0yLjYgMy4zLTQuNTMgNi4xNi00LjUzeiIgZmlsbD0iI0VBNDMzNSIvPgo8L3N2Zz4K';">
            </div>
            <div style="display: flex; justify-content: center; gap: 4px; margin-bottom: 15px;">
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
            </div>
            <p class="testimonial-quote">
                I was impressed by their honest advice and careful handling of my case. They transformed legal challenges into a seamless experience.
            </p>
            <p class="testimonial-author">— Ruhi Bagga</p>
        </div>
        <div class="testimonial-card">
            <div style="width: 70px; height: 70px; background: #ffffff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); border: 2px solid #e8e8e8;">
                <img src="https://www.google.com/images/branding/googleg/1x/googleg_standard_color_128dp.png" alt="Google" style="width: 50px; height: 50px; object-fit: contain;" onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTIyLjU2IDEyLjI1YzAtLjc4LS4wNy0xLjUzLS4yLTIuMjVIMTJ2NC4yNmg1LjkyYy0uMjYgMS4zNy0xLjA0IDIuNTMtMi4yMSAzLjMxdjIuNzdIMTguN2MyLjA4LTEuOTIgMy4yOC00Ljc0IDMuMjgtOC4wOXoiIGZpbGw9IiM0Mjg1RjQiLz4KPHBhdGggZD0iTTEyIDIzYzIuOTcgMCA1LjQ2LS45OCA3LjI4LTIuNjZsLTMuNTctMi43N2MtLjk4LjY2LTIuMjMgMS4wNi0zLjcxIDEuMDYtMi44NiAwLTUuMjktMS45My02LjE2LTQuNTNIMi4xOHYyLjg0QzMuOTkgMjAuNTMgNy43IDIzIDEyIDIzeiIgZmlsbD0iIzM0QTg1MyIvPgo8cGF0aCBkPSJNNS44NCAxNC4wOWMtLjIyLS42Ni0uMzUtMS4zNi0uMzUtMi4wOXMuMTMtMS40My4zNS0yLjA5VjcuMDdIMi4xOEMxLjQzIDguNTUgMSAxMC4yMiAxIDEycy40MyAzLjQ1IDEuMTggNC45M2wyLjg1LTIuMjIuODEtLjYyeiIgZmlsbD0iI0ZCQkMwNSIvPgo8cGF0aCBkPSJNMTIgNS4zOGMxLjYyIDAgMy4wNi41NiA0LjIxIDEuNjRsMy4xNS0zLjE1QzE3LjQ1IDIuMDkgMTQuOTcgMSAxMiAxIDcuNyAxIDMuOTkgMy40NyAyLjE4IDcuMDdsMy42NiAyLjg0Yy44Ny0yLjYgMy4zLTQuNTMgNi4xNi00LjUzeiIgZmlsbD0iI0VBNDMzNSIvPgo8L3N2Zz4K';">
            </div>
            <div style="display: flex; justify-content: center; gap: 4px; margin-bottom: 15px;">
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
            </div>
            <p class="testimonial-quote">
                The team was attentive, thorough, and committed to understanding my situation and delivering the best possible outcome.
            </p>
            <p class="testimonial-author">— Prabhjot Kaur</p>
        </div>
        <div class="testimonial-card">
            <div style="width: 70px; height: 70px; background: #ffffff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); border: 2px solid #e8e8e8;">
                <img src="https://www.google.com/images/branding/googleg/1x/googleg_standard_color_128dp.png" alt="Google" style="width: 50px; height: 50px; object-fit: contain;" onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTIyLjU2IDEyLjI1YzAtLjc4LS4wNy0xLjUzLS4yLTIuMjVIMTJ2NC4yNmg1LjkyYy0uMjYgMS4zNy0xLjA0IDIuNTMtMi4yMSAzLjMxdjIuNzdIMTguN2MyLjA4LTEuOTIgMy4yOC00Ljc0IDMuMjgtOC4wOXoiIGZpbGw9IiM0Mjg1RjQiLz4KPHBhdGggZD0iTTEyIDIzYzIuOTcgMCA1LjQ2LS45OCA3LjI4LTIuNjZsLTMuNTctMi43N2MtLjk4LjY2LTIuMjMgMS4wNi0zLjcxIDEuMDYtMi44NiAwLTUuMjktMS45My02LjE2LTQuNTNIMi4xOHYyLjg0QzMuOTkgMjAuNTMgNy43IDIzIDEyIDIzeiIgZmlsbD0iIzM0QTg1MyIvPgo8cGF0aCBkPSJNNS44NCAxNC4wOWMtLjIyLS42Ni0uMzUtMS4zNi0uMzUtMi4wOXMuMTMtMS40My4zNS0yLjA5VjcuMDdIMi4xOEMxLjQzIDguNTUgMSAxMC4yMiAxIDEycy40MyAzLjQ1IDEuMTggNC45M2wyLjg1LTIuMjIuODEtLjYyeiIgZmlsbD0iI0ZCQkMwNSIvPgo8cGF0aCBkPSJNMTIgNS4zOGMxLjYyIDAgMy4wNi41NiA0LjIxIDEuNjRsMy4xNS0zLjE1QzE3LjQ1IDIuMDkgMTQuOTcgMSAxMiAxIDcuNyAxIDMuOTkgMy40NyAyLjE4IDcuMDdsMy42NiAyLjg0Yy44Ny0yLjYgMy4zLTQuNTMgNi4xNi00LjUzeiIgZmlsbD0iI0VBNDMzNSIvPgo8L3N2Zz4K';">
            </div>
            <div style="display: flex; justify-content: center; gap: 4px; margin-bottom: 15px;">
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
                <span style="color: #FFD700; font-size: 1.3rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">⭐</span>
            </div>
            <p class="testimonial-quote">
                Exceptional team who listened to my concerns, explained processes clearly, and delivered results that made a difference in my legal journey.
            </p>
            <p class="testimonial-author">— Parminder Ghill</p>
        </div>
    </div>
</section>

<!-- Slide 14: CTA Section -->
<section class="cta-section" id="contact-form" style="background: linear-gradient(135deg, #0F172A 0%, #0F172A 50%, #E2E8F0 100%); position: relative; overflow: hidden; padding: 100px 60px; margin: 80px auto; max-width: 1400px; border-radius: 30px; box-shadow: 0 20px 60px rgba(15, 23, 42, 0.3);">
    <!-- Animated Background Elements -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: 
        radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        pointer-events: none; animation: backgroundPulse 8s ease-in-out infinite;"></div>
    
    <!-- Floating Decorative Elements -->
    <div style="position: absolute; top: 10%; left: 5%; width: 100px; height: 100px; background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%); border-radius: 50%; animation: floatIcon 6s ease-in-out infinite; pointer-events: none;"></div>
    <div style="position: absolute; bottom: 15%; right: 8%; width: 80px; height: 80px; background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%); border-radius: 50%; animation: floatIcon 8s ease-in-out infinite 2s; pointer-events: none;"></div>
    
    <div style="position: relative; z-index: 1;">
        <!-- Logo -->
        <div style="margin-bottom: 30px; animation: fadeInDown 0.8s ease-out; text-align: center;">
            <div style="display: inline-block; background: rgba(255, 255, 255, 0.95); padding: 15px 25px; border-radius: 12px; box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);">
                <img src="{{ asset('images/logo/Bansal_Lawyers_origional.webp') }}" 
                     srcset="{{ asset('images/logo/Bansal_Lawyers_origional.webp') }} 1x, {{ asset('images/logo/Bansal_Lawyers_origional@2x.webp') }} 2x"
                     alt="Bansal Lawyers" 
                     style="max-height: 80px; height: auto; width: auto; display: block;"
                     onerror="this.onerror=null; this.src='{{ asset('images/logo/Bansal_Lawyers_origional.png') }}'; this.onerror=function(){this.style.display='none';}">
            </div>
        </div>
        
        <h2 class="cta-headline" style="color: white; font-size: 3.5rem; margin-bottom: 15px; text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); font-weight: 800; animation: fadeInUp 0.8s ease-out;">
            Ready to Take the Next Step?
        </h2>
        <p class="cta-subheadline" style="color: rgba(255, 255, 255, 0.95); font-size: 1.6rem; margin-bottom: 50px; font-weight: 600; animation: fadeInUp 1s ease-out;">
            Schedule Your Consultation Today
        </p>
        
        <div class="contact-panel" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.95) 100%); border-radius: 25px; padding: 50px 45px; margin: 40px auto; max-width: 900px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2), 0 0 0 1px rgba(255, 255, 255, 0.3); backdrop-filter: blur(10px); position: relative; overflow: hidden; animation: fadeInUp 1.2s ease-out;">
            <!-- Decorative Corner -->
            <div style="position: absolute; top: -30px; right: -30px; width: 120px; height: 120px; background: radial-gradient(circle, rgba(15, 23, 42, 0.1) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
            
            <p class="contact-intro" style="text-align: center; font-size: 1.2rem; color: var(--primary-teal); font-weight: 600; margin-bottom: 35px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif; line-height: 1.6;">
                Our expert team is ready to provide compassionate, professional guidance for your family law matter.
            </p>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 30px;">
                <div class="contact-item-enhanced" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.05) 0%, rgba(15, 23, 42, 0.05) 100%); padding: 20px 22px; border-radius: 15px; border-left: 4px solid var(--primary-teal); transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 8px 25px rgba(15, 23, 42, 0.15)'; this.style.background='linear-gradient(135deg, rgba(15, 23, 42, 0.1) 0%, rgba(15, 23, 42, 0.1) 100%)'" onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='none'; this.style.background='linear-gradient(135deg, rgba(15, 23, 42, 0.05) 0%, rgba(15, 23, 42, 0.05) 100%)'">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                        <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #0F172A 0%, #1E40AF 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 20px rgba(15, 23, 42, 0.3); flex-shrink: 0;">
                            <span style="font-size: 1.5rem; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">📞</span>
                        </div>
                        <span class="contact-label" style="font-weight: 700; color: var(--primary-teal); font-size: 1.05rem; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">Call us</span>
                    </div>
                    <div style="padding-left: 57px;">
                        <span class="contact-value" style="color: #0F172A; font-size: 1.1rem; font-weight: 600; display: block; margin-bottom: 5px;">1300 BANSAL</span>
                        <span class="contact-value" style="color: #94A3B8; font-size: 0.95rem;">(1300 226 725)</span>
                        <span class="contact-value" style="color: #94A3B8; font-size: 0.95rem; display: block; margin-top: 5px;">(+61) 0422 905 860</span>
                    </div>
                </div>
                
                <div class="contact-item-enhanced" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.05) 0%, rgba(15, 23, 42, 0.05) 100%); padding: 20px 22px; border-radius: 15px; border-left: 4px solid var(--accent-teal); transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 8px 25px rgba(15, 23, 42, 0.15)'; this.style.background='linear-gradient(135deg, rgba(15, 23, 42, 0.1) 0%, rgba(15, 23, 42, 0.1) 100%)'" onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='none'; this.style.background='linear-gradient(135deg, rgba(15, 23, 42, 0.05) 0%, rgba(15, 23, 42, 0.05) 100%)'">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                        <div style="width: 45px; height: 45px; background: linear-gradient(135deg, var(--primary-teal) 0%, var(--accent-teal) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 20px rgba(15, 23, 42, 0.3); flex-shrink: 0;">
                            <span style="font-size: 1.5rem; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">✉️</span>
                        </div>
                        <span class="contact-label" style="font-weight: 700; color: var(--primary-teal); font-size: 1.05rem; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">Email us</span>
                    </div>
                    <div style="padding-left: 57px;">
                        <span class="contact-value" style="color: #0F172A; font-size: 1rem; font-weight: 600;">info@bansallawyers.com.au</span>
                    </div>
                </div>
                
                <div class="contact-item-enhanced" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.05) 0%, rgba(15, 23, 42, 0.05) 100%); padding: 20px 22px; border-radius: 15px; border-left: 4px solid #10b981; transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 8px 25px rgba(15, 23, 42, 0.15)'; this.style.background='linear-gradient(135deg, rgba(15, 23, 42, 0.1) 0%, rgba(15, 23, 42, 0.1) 100%)'" onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='none'; this.style.background='linear-gradient(135deg, rgba(15, 23, 42, 0.05) 0%, rgba(15, 23, 42, 0.05) 100%)'">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                        <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3); flex-shrink: 0;">
                            <span style="font-size: 1.5rem; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">📍</span>
                        </div>
                        <span class="contact-label" style="font-weight: 700; color: var(--primary-teal); font-size: 1.05rem; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">Visit us</span>
                    </div>
                    <div style="padding-left: 57px;">
                        <span class="contact-value" style="color: #0F172A; font-size: 0.95rem; font-weight: 500; line-height: 1.5;">Level 8/278 Collins St<br>Melbourne VIC 3000, Australia</span>
                    </div>
                </div>
                
                <div class="contact-item-enhanced" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.05) 0%, rgba(15, 23, 42, 0.05) 100%); padding: 20px 22px; border-radius: 15px; border-left: 4px solid #1E3A8A; transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 8px 25px rgba(15, 23, 42, 0.15)'; this.style.background='linear-gradient(135deg, rgba(15, 23, 42, 0.1) 0%, rgba(15, 23, 42, 0.1) 100%)'" onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='none'; this.style.background='linear-gradient(135deg, rgba(15, 23, 42, 0.05) 0%, rgba(15, 23, 42, 0.05) 100%)'">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                        <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #1E3A8A 0%, #7c3aed 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 20px rgba(30, 58, 138, 0.3); flex-shrink: 0;">
                            <span style="font-size: 1.5rem; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">🕐</span>
                        </div>
                        <span class="contact-label" style="font-weight: 700; color: var(--primary-teal); font-size: 1.05rem; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">Business Hours</span>
                    </div>
                    <div style="padding-left: 57px;">
                        <span class="contact-value" style="color: #0F172A; font-size: 0.95rem; font-weight: 500;">Monday – Friday<br>10:00 AM – 5:30 PM</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="encouragement-note" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0.15) 100%); backdrop-filter: blur(15px); padding: 25px 35px; border-radius: 20px; margin: 35px auto; max-width: 800px; border: 2px solid rgba(255, 255, 255, 0.4); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); position: relative; z-index: 1; animation: fadeInUp 1.4s ease-out;">
            <p style="margin: 0; color: white; font-size: 1.2rem; font-style: italic; font-weight: 600; text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;">
                ✨ Take the first step toward resolution and peace of mind. We're here to help. ✨
            </p>
        </div>
        
        <div style="text-align: center; margin-top: 45px; position: relative; z-index: 1; animation: fadeInUp 1.6s ease-out;">
            <a href="#consultation-form" class="cover-cta-button" style="display: inline-flex; align-items: center; gap: 15px; padding: 22px 50px; font-size: 1.4rem; background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 50%, #0F172A 100%); background-size: 200% 100%; color: white; border: none; border-radius: 50px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif; font-weight: 800; text-decoration: none; box-shadow: 0 15px 50px rgba(15, 23, 42, 0.5), 0 0 0 0 rgba(15, 23, 42, 0.7); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); text-transform: uppercase; letter-spacing: 1px; position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-6px) scale(1.05)'; this.style.boxShadow='0 20px 60px rgba(15, 23, 42, 0.6), 0 0 0 6px rgba(15, 23, 42, 0.3)'; this.style.backgroundPosition='100% 0'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 15px 50px rgba(15, 23, 42, 0.5), 0 0 0 0 rgba(15, 23, 42, 0.7)'; this.style.backgroundPosition='0% 0'">
                <span style="font-size: 1.8rem; animation: pulse-icon 1.5s ease-in-out infinite; filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.8));">📝</span>
                <span style="text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);">Fill Out Consultation Form</span>
                <span style="font-size: 1.6rem; animation: bounce 1s ease-in-out infinite;">→</span>
                <!-- Shine effect -->
                <span style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent); animation: shine 2.5s infinite;"></span>
            </a>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<!-- Google reCAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
// Smooth scroll for anchor links - Enhanced
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const target = document.querySelector(targetId);
        if (target) {
            // Calculate offset for sticky header
            const headerOffset = 100;
            const elementPosition = target.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
            
            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
            
            // If it's the consultation form, highlight it briefly
            if (targetId === '#consultation-form') {
                setTimeout(() => {
                    target.style.animation = 'pulse 1s ease-in-out';
                    setTimeout(() => {
                        target.style.animation = '';
                    }, 1000);
                }, 500);
            }
        }
    });
});

// Track page views for Google Ads
if (typeof gtag !== 'undefined') {
    gtag('event', 'page_view', {
        'event_category': 'Landing Page',
        'event_label': 'Divorce Family Law Landing Page'
    });
}

// Consultation Form Submission Handler
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('consultation-form-element') || document.querySelector('form#consultation-form-element');
    if (!form || !(form instanceof HTMLFormElement)) {
        // Form not found - this is expected if the page doesn't have a consultation-form-element
        // The cover-consultation-form-element is handled separately
        return;
    }
    
    const submitBtn = document.getElementById('consultation-form-submit');
    const btnText = document.getElementById('consultation-btn-text');
    const btnLoading = document.getElementById('consultation-btn-loading');
    const messagesContainer = document.getElementById('consultation-form-messages');
    const successAlert = document.getElementById('consultation-form-success');
    const errorAlert = document.getElementById('consultation-form-error');
    const successText = document.getElementById('consultation-form-success-text');
    const errorText = document.getElementById('consultation-form-error-text');
    
    // Clear validation errors
    function clearValidationErrors() {
        const invalidFields = form.querySelectorAll('.is-invalid');
        invalidFields.forEach(field => field.classList.remove('is-invalid'));
        
        const errorMessages = form.querySelectorAll('[id$="-error"]');
        errorMessages.forEach(msg => {
            msg.style.display = 'none';
            msg.textContent = '';
        });
    }
    
    // Show field error
    function showFieldError(fieldName, message) {
        const field = document.getElementById('consultation-' + fieldName);
        const errorDiv = document.getElementById('consultation-' + fieldName + '-error');
        
        if (field && errorDiv) {
            field.classList.add('is-invalid');
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
        }
    }
    
    // Show success message
    function showSuccess(message) {
        clearValidationErrors();
        successText.textContent = message;
        successAlert.style.display = 'block';
        errorAlert.style.display = 'none';
        messagesContainer.style.display = 'block';
        form.reset();
        
        // Scroll to messages
        messagesContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
    
    // Show error message
    function showError(message) {
        clearValidationErrors();
        errorText.textContent = message;
        errorAlert.style.display = 'block';
        successAlert.style.display = 'none';
        messagesContainer.style.display = 'block';
        
        // Scroll to messages
        messagesContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Clear previous messages
        messagesContainer.style.display = 'none';
        clearValidationErrors();
        
        // Show loading state
        submitBtn.disabled = true;
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-block';
        
        // Update loading text periodically to show it's working (faster updates)
        let loadingCounter = 0;
        const loadingInterval = setInterval(() => {
            loadingCounter++;
            const loadingText = btnLoading.querySelector('span:last-child');
            if (loadingText) {
                if (loadingCounter === 1) {
                    loadingText.textContent = 'Processing...';
                } else if (loadingCounter === 2) {
                    loadingText.textContent = 'Almost done...';
                }
            }
        }, 1500); // Faster updates every 1.5 seconds
        
        // Skip reCAPTCHA validation on frontend for speed (backend will handle if needed)
        // Just check if reCAPTCHA element exists, don't validate
        const recaptchaElement = document.querySelector('.g-recaptcha');
        if (recaptchaElement && typeof grecaptcha !== 'undefined') {
            // reCAPTCHA exists but we don't wait for validation
            try {
                grecaptcha.getResponse(); // Just to ensure it's loaded, don't block
            } catch(e) {
                // Ignore errors - proceed anyway
            }
        }
        
        // Get form data - ensure form exists
        if (!form || !(form instanceof HTMLFormElement)) {
            console.error('Form element not found or invalid');
            submitBtn.disabled = false;
            btnText.style.display = 'inline-block';
            btnLoading.style.display = 'none';
            clearInterval(loadingInterval);
            showError('Form error: Please refresh the page and try again.');
            return;
        }
        
        const formData = new FormData(form);
        const csrfToken = form.querySelector('input[name="_token"]')?.value || 
                         document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        
        // Use AbortController for proper timeout handling
        const controller = new AbortController();
        const timeoutId = setTimeout(() => {
            console.warn('Request timeout - aborting after 5 seconds');
            controller.abort();
        }, 5000); // 5 second timeout - increased to allow for network latency
        
        // Log start time for debugging
        const startTime = performance.now();
        console.log('Form submission started at:', startTime);
        
        // Submit via AJAX with timeout
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            },
            credentials: 'same-origin',
            signal: controller.signal
        })
        .then(response => {
            const responseTime = performance.now() - startTime;
            console.log('Response received in:', responseTime.toFixed(2), 'ms');
            clearTimeout(timeoutId);
            clearInterval(loadingInterval);
            if (!response || !response.ok) {
                throw new Error('Server error: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            const totalTime = performance.now() - startTime;
            console.log('Total form submission time:', totalTime.toFixed(2), 'ms');
            
            if (data.success) {
                console.log('Form submitted successfully!');
                // Track successful form submission
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'consultation_form_submit', {
                        'event_category': 'Lead Generation',
                        'event_label': 'Consultation Form Success',
                        'value': 1
                    });
                }
                
                showSuccess(data.message || 'Thank you! Your consultation request has been sent successfully. We\'ll get back to you within 24 hours.');
                
                // Reset form
                form.reset();
                if (typeof grecaptcha !== 'undefined') {
                    grecaptcha.reset();
                }
                
                // Redirect to thank you page after a brief delay to show success message
                const redirectUrl = data.redirect || '{{ route("contact.thankyou") }}';
                console.log('Redirecting to thank you page:', redirectUrl);
                
                // Show success message briefly, then redirect
                setTimeout(function() {
                    // Use window.location.replace to prevent back button issues
                    window.location.replace(redirectUrl);
                }, 1500); // 1.5 second delay to show success message
            } else {
                // Track form submission error
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'consultation_form_error', {
                        'event_category': 'Lead Generation',
                        'event_label': 'Consultation Form Error',
                        'value': 0
                    });
                }
                
                if (data.errors) {
                    // Handle validation errors
                    Object.keys(data.errors).forEach(field => {
                        const fieldName = field.replace('g-recaptcha-response', 'recaptcha');
                        showFieldError(fieldName, data.errors[field][0]);
                    });
                } else {
                    showError(data.message || 'Sorry, there was an error sending your request. Please try again.');
                }
            }
        })
        .catch(error => {
            clearTimeout(timeoutId);
            clearInterval(loadingInterval);
            console.error('Error:', error);
            
            // Track form submission error
            if (typeof gtag !== 'undefined') {
                gtag('event', 'consultation_form_error', {
                    'event_category': 'Lead Generation',
                    'event_label': 'Consultation Form Network Error',
                    'value': 0
                });
            }
            
            // Show specific error message for timeout/abort
            if (error.name === 'AbortError' || error.message && (error.message.includes('timeout') || error.message.includes('aborted'))) {
                // On timeout, assume success (data might have been saved)
                showSuccess('Your form may have been submitted successfully. If you don\'t receive a confirmation, please contact us at 1300 BANSAL or try again.');
                form.reset();
                if (typeof grecaptcha !== 'undefined') {
                    grecaptcha.reset();
                }
                // Don't show error - assume it worked
            } else {
                showError('Sorry, there was an error sending your request. Please check your connection and try again, or call us at 1300 BANSAL.');
            }
        })
        .finally(() => {
            // Clear loading interval
            if (typeof loadingInterval !== 'undefined') {
                clearInterval(loadingInterval);
            }
            // Reset button state
            submitBtn.disabled = false;
            btnText.style.display = 'inline-block';
            btnLoading.style.display = 'none';
        });
    });
    
    // Track form view
    if (typeof gtag !== 'undefined') {
        gtag('event', 'consultation_form_view', {
            'event_category': 'Lead Generation',
            'event_label': 'Consultation Form Displayed'
        });
    }
    
    // Animate spots counter (create urgency)
    const spotsElement = document.getElementById('spots-left');
    if (spotsElement) {
        let spots = 12;
        setInterval(() => {
            if (spots > 5) {
                spots = Math.max(5, spots - Math.floor(Math.random() * 2));
                spotsElement.textContent = spots;
                if (spots <= 7) {
                    spotsElement.style.color = '#0F172A';
                    spotsElement.style.animation = 'pulse-icon 1s ease-in-out infinite';
                }
            }
        }, 30000); // Update every 30 seconds
    }
    
    // Add scroll-triggered animation for form visibility
    const formSection = document.querySelector('.consultation-form-section');
    if (formSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeInUp 1s ease-out';
                    // Track form visibility
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'consultation_form_visible', {
                            'event_category': 'Engagement',
                            'event_label': 'Form Scrolled Into View'
                        });
                    }
                }
            });
        }, { threshold: 0.2 });
        
        observer.observe(formSection);
    }
    
    // Cover Consultation Form Submission Handler
    const coverForm = document.getElementById('cover-consultation-form-element');
    if (coverForm) {
        const coverSubmitBtn = document.getElementById('cover-consultation-form-submit');
        const coverBtnText = document.getElementById('cover-consultation-btn-text');
        const coverBtnLoading = document.getElementById('cover-consultation-btn-loading');
        const coverMessagesContainer = document.getElementById('cover-consultation-form-messages');
        const coverSuccessAlert = document.getElementById('cover-consultation-form-success');
        const coverErrorAlert = document.getElementById('cover-consultation-form-error');
        const coverSuccessText = document.getElementById('cover-consultation-form-success-text');
        const coverErrorText = document.getElementById('cover-consultation-form-error-text');
        
        function clearCoverValidationErrors() {
            const errorMessages = coverForm.querySelectorAll('[id^="cover-consultation-"][id$="-error"]');
            errorMessages.forEach(msg => {
                msg.style.display = 'none';
                msg.textContent = '';
            });
        }
        
        function showCoverFieldError(fieldName, message) {
            const errorDiv = document.getElementById('cover-consultation-' + fieldName + '-error');
            if (errorDiv) {
                errorDiv.textContent = message;
                errorDiv.style.display = 'block';
            }
        }
        
        function showCoverSuccess(message) {
            clearCoverValidationErrors();
            coverSuccessText.textContent = message;
            coverSuccessAlert.style.display = 'block';
            coverErrorAlert.style.display = 'none';
            coverMessagesContainer.style.display = 'block';
            coverForm.reset();
            coverMessagesContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        
        function showCoverError(message) {
            clearCoverValidationErrors();
            coverErrorText.textContent = message;
            coverErrorAlert.style.display = 'block';
            coverSuccessAlert.style.display = 'none';
            coverMessagesContainer.style.display = 'block';
            coverMessagesContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        
        // Phone Number Validation Functions - Only 9 digits, no letters (globally accessible)
        window.isNumberKey = function(evt) {
            const charCode = (evt.which) ? evt.which : evt.keyCode;
            // Allow: backspace, delete, tab, escape, enter, and numbers (0-9)
            if (charCode === 8 || charCode === 9 || charCode === 27 || charCode === 13 || charCode === 46 ||
                (charCode >= 35 && charCode <= 40) || // arrow keys
                (charCode >= 48 && charCode <= 57)) { // numbers 0-9
                return true;
            }
            evt.preventDefault();
            return false;
        }
        
        window.allowOnlyNumbers = function(input) {
            // Remove any non-numeric characters
            let value = input.value.replace(/\D/g, '');
            
            // Limit to 9 digits
            if (value.length > 9) {
                value = value.substring(0, 9);
            }
            
            input.value = value;
        }
        
        window.validatePhoneNumber = function(input) {
            const phoneError = document.getElementById('cover-consultation-phone-error');
            const phoneWrapper = document.getElementById('cover-consultation-phone-wrapper');
            let value = input.value.replace(/\D/g, ''); // Remove any non-digits
            
            // Reset styling
            if (phoneWrapper) {
                phoneWrapper.style.borderColor = '#e8e8e8';
                phoneWrapper.style.boxShadow = 'none';
            }
            
            if (!value || value.length === 0) {
                phoneError.style.display = 'none';
                return true; // Required validation will handle empty
            }
            
            // Must be exactly 9 digits
            if (value.length !== 9) {
                phoneError.textContent = 'Phone number must be exactly 9 digits (e.g., +61 4XX XXX XXX)';
                phoneError.style.display = 'block';
                if (phoneWrapper) {
                    phoneWrapper.style.borderColor = '#dc3545';
                    phoneWrapper.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.1)';
                }
                return false;
            }
            
            // Check if contains only numbers
            if (!/^[0-9]{9}$/.test(value)) {
                phoneError.textContent = 'Phone number must contain only numbers (no letters or special characters)';
                phoneError.style.display = 'block';
                if (phoneWrapper) {
                    phoneWrapper.style.borderColor = '#dc3545';
                    phoneWrapper.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.1)';
                }
                return false;
            }
            
            // Valid phone number
            phoneError.style.display = 'none';
            if (phoneWrapper) {
                phoneWrapper.style.borderColor = '#28a745';
                phoneWrapper.style.boxShadow = '0 0 0 3px rgba(40, 167, 69, 0.1)';
            }
            return true;
        }
        
        // Clean initial phone value on page load (remove +61 and non-digits, limit to 9)
        const initialPhoneInput = document.getElementById('cover-consultation-phone');
        if (initialPhoneInput && initialPhoneInput.value) {
            let cleanedValue = initialPhoneInput.value.replace(/\D/g, '').replace(/^61/, '');
            if (cleanedValue.length > 9) {
                cleanedValue = cleanedValue.substring(cleanedValue.length - 9);
            }
            initialPhoneInput.value = cleanedValue;
        }
        
        coverForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            coverMessagesContainer.style.display = 'none';
            clearCoverValidationErrors();
            
            // Validate phone number before submission
            const phoneInput = document.getElementById('cover-consultation-phone');
            if (phoneInput && !validatePhoneNumber(phoneInput)) {
                coverSubmitBtn.disabled = false;
                coverBtnText.style.display = 'flex';
                coverBtnLoading.style.display = 'none';
                return;
            }
            
            coverSubmitBtn.disabled = true;
            coverBtnText.style.display = 'none';
            coverBtnLoading.style.display = 'inline-block';
            
            const formData = new FormData(coverForm);
            
            // Prepend +61 to phone number if it's not already there
            const phoneValue = formData.get('phone');
            if (phoneValue && !phoneValue.startsWith('+61')) {
                formData.set('phone', '+61' + phoneValue.replace(/\D/g, ''));
            }
            const csrfToken = coverForm.querySelector('input[name="_token"]')?.value || 
                             document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            
            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 5000);
            
            fetch(coverForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                credentials: 'same-origin',
                signal: controller.signal
            })
            .then(response => {
                clearTimeout(timeoutId);
                if (!response.ok) {
                    return response.json().then(data => Promise.reject(data));
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'cover_consultation_form_submit', {
                            'event_category': 'Lead Generation',
                            'event_label': 'Cover Consultation Form Success',
                            'value': 1
                        });
                    }
                    
                    showCoverSuccess(data.message || 'Thank you! Your consultation request has been sent successfully.');
                    
                    coverForm.reset();
                    if (typeof grecaptcha !== 'undefined') {
                        grecaptcha.reset();
                    }
                    
                    const redirectUrl = data.redirect || '{{ route("contact.thankyou") }}';
                    setTimeout(function() {
                        window.location.replace(redirectUrl);
                    }, 1500);
                } else {
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'cover_consultation_form_error', {
                            'event_category': 'Lead Generation',
                            'event_label': 'Cover Consultation Form Error',
                            'value': 0
                        });
                    }
                    
                    if (data.errors) {
                        Object.keys(data.errors).forEach(field => {
                            const fieldName = field.replace('g-recaptcha-response', 'recaptcha');
                            showCoverFieldError(fieldName, data.errors[field][0]);
                        });
                    } else {
                        showCoverError(data.message || 'Sorry, there was an error sending your request. Please try again.');
                    }
                }
            })
            .catch(error => {
                clearTimeout(timeoutId);
                console.error('Error:', error);
                
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'cover_consultation_form_error', {
                        'event_category': 'Lead Generation',
                        'event_label': 'Cover Consultation Form Network Error',
                        'value': 0
                    });
                }
                
                if (error.name === 'AbortError' || (error.message && (error.message.includes('timeout') || error.message.includes('aborted')))) {
                    showCoverSuccess('Your form may have been submitted successfully. If you don\'t receive a confirmation, please contact us at 1300 BANSAL or try again.');
                    coverForm.reset();
                    if (typeof grecaptcha !== 'undefined') {
                        grecaptcha.reset();
                    }
                } else {
                    showCoverError('Sorry, there was an error sending your request. Please check your connection and try again, or call us at 1300 BANSAL.');
                }
            })
            .finally(() => {
                coverSubmitBtn.disabled = false;
                coverBtnText.style.display = 'inline-block';
                coverBtnLoading.style.display = 'none';
            });
        });
    }
});
</script>
@endsection
