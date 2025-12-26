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
    <title>Payment Successful - Bansal Lawyers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
        .btn-book-again {
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
        .btn-book-again:hover {
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
            .btn-book-again {
                width: 100%;
            }
        }
        .appointment-details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;
            text-align: left;
        }
        .appointment-details h3 {
            color: #1B4D89;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        .appointment-details p {
            margin: 10px 0;
            color: #495057;
        }
        .appointment-details strong {
            color: #1B4D89;
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
            Your payment is Completed.
        </div>
        
        <p>Your appointment has been successfully confirmed. You will receive a confirmation email shortly with all the details.</p>
        
        @if(isset($appointment) && $appointment)
        <div class="appointment-details">
            <h3>Appointment Details</h3>
            <p><strong>Name:</strong> {{ $appointment->full_name ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ $appointment->date ?? 'N/A' }}</p>
            <p><strong>Time:</strong> {{ $appointment->timeslot_full ?? $appointment->time ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $appointment->email ?? 'N/A' }}</p>
            <p><strong>Phone:</strong> {{ $appointment->phone ?? 'N/A' }}</p>
        </div>
        @endif
        
        <div class="button-group">
            <a href="{{ url('/book-an-appointment') }}" class="btn-book-again">
                Book Another Appointment
            </a>
            <a href="{{ url('/') }}" class="btn-home">
                Back To Home
            </a>
        </div>
    </div>
</div>

</body>
</html>

