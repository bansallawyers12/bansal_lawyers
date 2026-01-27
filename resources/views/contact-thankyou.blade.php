<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17598989873"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'AW-17598989873');
      
      // Track thank you page view
      gtag('event', 'thank_you_page_view', {
          'event_category': 'Lead Generation',
          'event_label': 'Thank You Page Viewed'
      });
    </script>
    <!-- End Google Tag Manager -->
    <title>Thank You - Bansal Lawyers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gill+Sans:wght@400;700&family=Palatino+Linotype:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Palatino Linotype', Palatino, 'Book Antiqua', serif;
            background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 50%, #0F172A 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.08) 0%, transparent 50%);
            pointer-events: none;
            animation: pulse 4s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
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
        
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .thankyou-container {
            max-width: 700px;
            width: 100%;
            padding: 60px 50px;
            border-radius: 25px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.1);
            background: linear-gradient(135deg, #ffffff 0%, #f8fafb 100%);
            text-align: center;
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.8s ease-out;
        }
        
        .success-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            color: white;
            box-shadow: 0 15px 40px rgba(16, 185, 129, 0.4);
            animation: scaleIn 0.6s ease-out 0.2s both;
            position: relative;
        }
        
        .success-icon::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid rgba(16, 185, 129, 0.3);
            animation: ripple 2s ease-out infinite;
        }
        
        @keyframes ripple {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(1.5);
                opacity: 0;
            }
        }
        
        .thankyou-container h1 {
            color: #0F172A;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            animation: fadeInUp 0.8s ease-out 0.3s both;
        }
        
        .success-message {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border: 2px solid #28a745;
            color: #155724;
            padding: 20px 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            font-size: 1.3rem;
            font-weight: 700;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.2);
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }
        
        .thankyou-container p {
            color: #334155;
            font-size: 1.15rem;
            line-height: 1.8;
            margin-bottom: 30px;
            animation: fadeInUp 0.8s ease-out 0.5s both;
        }
        
        .info-box {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.05) 0%, rgba(15, 23, 42, 0.03) 100%);
            border-left: 4px solid #0F172A;
            padding: 20px 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            text-align: left;
            animation: fadeInUp 0.8s ease-out 0.6s both;
        }
        
        .info-box p {
            margin: 0;
            color: #0F172A;
            font-weight: 600;
            font-size: 1rem;
        }
        
        .info-box p:first-child {
            margin-bottom: 10px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
            font-size: 1.1rem;
        }
        
        .info-box ul {
            list-style: none;
            padding-left: 0;
            margin-top: 15px;
        }
        
        .info-box li {
            color: #64748b;
            padding: 8px 0;
            padding-left: 25px;
            position: relative;
        }
        
        .info-box li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #10b981;
            font-weight: 700;
        }
        
        .button-group {
            margin-top: 40px;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease-out 0.7s both;
        }
        
        .btn-contact-again {
            padding: 18px 45px;
            background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.3);
        }
        
        .btn-contact-again:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(15, 23, 42, 0.4);
            color: white;
            text-decoration: none;
        }
        
        .btn-home {
            padding: 18px 45px;
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(100, 116, 139, 0.3);
        }
        
        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(100, 116, 139, 0.4);
            color: white;
            text-decoration: none;
        }
        
        @if(session('success'))
        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border: 2px solid #28a745;
            color: #155724;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-weight: 600;
        }
        @endif
        
        @media (max-width: 576px) {
            .thankyou-container {
                padding: 40px 30px;
            }
            
            .thankyou-container h1 {
                font-size: 2.2rem;
            }
            
            .success-icon {
                width: 100px;
                height: 100px;
                font-size: 50px;
            }
            
            .btn-home {
                margin-left: 0;
                margin-top: 15px;
                width: 100%;
            }
            
            .btn-contact-again {
                width: 100%;
            }
            
            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="thankyou-container">
        <div class="success-icon">
            ✓
        </div>
        
        <h1>Thank You!</h1>
        
        <div class="success-message">
            Your consultation request has been submitted successfully.
        </div>
        
        <p>We have received your inquiry and our expert team will review your message and contact you within <strong style="color: #0F172A;">24 hours</strong>.</p>
        
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="info-box">
            <p style="font-weight: 700; color: #0F172A; margin-bottom: 15px;">What happens next?</p>
            <ul>
                <li>Our team will review your consultation request</li>
                <li>We'll contact you within 24 hours via phone or email</li>
                <li>We'll schedule your free consultation at your convenience</li>
                <li>All information is kept confidential and secure</li>
            </ul>
        </div>
        
        <div class="button-group">
            <a href="{{ url('/landing') }}" class="btn-contact-again">
                <span>📝</span>
                <span>Submit Another Request</span>
            </a>
            <a href="{{ url('/') }}" class="btn-home">
                <span>🏠</span>
                <span>Back To Home</span>
            </a>
        </div>
        
        <div style="margin-top: 40px; padding-top: 30px; border-top: 2px solid #e2e8f0;">
            <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 10px;">
                Need immediate assistance?
            </p>
            <p style="color: #0F172A; font-weight: 700; font-size: 1.2rem; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, sans-serif;">
                📞 Call us at <a href="tel:1300226725" style="color: #1E40AF; text-decoration: none;">1300 BANSAL</a>
            </p>
        </div>
    </div>
</div>

</body>
</html>
