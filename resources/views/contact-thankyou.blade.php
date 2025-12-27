<!DOCTYPE html>
<html>
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17598989873"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'AW-17598989873');
    </script>
    <!-- End Google Tag Manager -->
    <title>Thank You - Bansal Lawyers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .thankyou-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            background: white;
            text-align: center;
        }
        .success-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            background: #28a745;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: white;
        }
        .thankyou-container h1 {
            color: #1B4D89;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .thankyou-container p {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }
        .success-message {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            font-size: 1.2rem;
            font-weight: 600;
        }
        .btn-contact-again {
            padding: 15px 40px;
            background: linear-gradient(135deg, #1B4D89, #2c5aa0);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-contact-again:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(27, 77, 137, 0.3);
            color: white;
            text-decoration: none;
        }
        .btn-home {
            padding: 15px 40px;
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-left: 15px;
        }
        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
            color: white;
            text-decoration: none;
        }
        .button-group {
            margin-top: 20px;
        }
        @media (max-width: 576px) {
            .btn-home {
                margin-left: 0;
                margin-top: 15px;
                display: block;
                width: 100%;
            }
            .btn-contact-again {
                width: 100%;
            }
        }
    </style>
</head>
<body style="background: #f8f9fa;">

<div class="container">
    <div class="thankyou-container">
        <div class="success-icon">
            ✓
        </div>
        
        <h1>Thank You!</h1>
        
        <div class="success-message">
            Your message has been sent successfully.
        </div>
        
        <p>We have received your inquiry and will get back to you within 24 hours. Our team will review your message and contact you as soon as possible.</p>
        
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="button-group">
            <a href="{{ url('/contact') }}" class="btn-contact-again">
                Send Another Message
            </a>
            <a href="{{ url('/') }}" class="btn-home">
                Back To Home
            </a>
        </div>
    </div>
</div>

</body>
</html>

