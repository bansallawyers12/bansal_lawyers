<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $subject ?? 'Bansal Lawyers' }}</title>
    
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    
    <style>
        /* Reset styles */
        body, table, td, div, h1, h2, h3, p, a, li, blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        
        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        
        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }
        
        /* Main styles */
        body {
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        
        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            padding: 30px 20px;
            text-align: center;
        }
        
        .logo {
            max-width: 200px;
            height: auto;
        }
        
        .header-title {
            color: #ffffff;
            font-size: 24px;
            font-weight: 600;
            margin: 15px 0 5px 0;
        }
        
        .header-subtitle {
            color: #e2e8f0;
            font-size: 14px;
            margin: 0;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .content h1 {
            color: #1e293b;
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 20px 0;
            line-height: 1.3;
        }
        
        .content h2 {
            color: #334155;
            font-size: 20px;
            font-weight: 600;
            margin: 25px 0 15px 0;
        }
        
        .content p {
            color: #475569;
            font-size: 16px;
            line-height: 1.6;
            margin: 0 0 15px 0;
        }
        
        .highlight-box {
            background-color: #f1f5f9;
            border-left: 4px solid #3b82f6;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        
        .appointment-details {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #374151;
            min-width: 120px;
        }
        
        .detail-value {
            color: #6b7280;
            text-align: right;
        }
        
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            text-align: center;
        }
        
        .button:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        }
        
        .footer {
            background-color: #1e293b;
            color: #94a3b8;
            padding: 30px 20px;
            text-align: center;
        }
        
        .footer p {
            margin: 0 0 10px 0;
            font-size: 14px;
        }
        
        .social-links {
            margin: 20px 0;
        }
        
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #94a3b8;
            text-decoration: none;
        }
        
        .social-links a:hover {
            color: #ffffff;
        }
        
        .contact-info {
            background-color: #f1f5f9;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        
        .contact-info h3 {
            color: #1e293b;
            font-size: 18px;
            margin: 0 0 15px 0;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            margin: 8px 0;
        }
        
        .contact-icon {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            color: #3b82f6;
        }
        
        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
            }
            
            .content {
                padding: 20px 15px !important;
            }
            
            .detail-row {
                flex-direction: column;
            }
            
            .detail-value {
                text-align: left;
                margin-top: 5px;
            }
            
            .header {
                padding: 20px 15px !important;
            }
            
            .header-title {
                font-size: 20px !important;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <img src="{{ asset('images/logo/Bansal_Lawyers.png') }}" alt="Bansal Lawyers" class="logo">
            <h1 class="header-title">{{ $headerTitle ?? 'Bansal Lawyers' }}</h1>
            <p class="header-subtitle">{{ $headerSubtitle ?? 'Professional Legal Services' }}</p>
        </div>
        
        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="contact-info">
                <h3>Contact Information</h3>
                <div class="contact-item">
                    <span class="contact-icon">📧</span>
                    <span>Email: info@bansallawyers.com.au</span>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">📞</span>
                    <span>Phone: +61 3 1234 5678</span>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">📍</span>
                    <span>Address: Melbourne, Australia</span>
                </div>
            </div>
            
            <div class="social-links">
                <a href="https://www.facebook.com/profile.php?id=61562008576642" target="_blank">Facebook</a>
                <a href="https://www.instagram.com/bansallawyers?igsh=N21ubnVkeDhibjVw" target="_blank">Instagram</a>
                <a href="#" target="_blank">LinkedIn</a>
            </div>
            
            <p>&copy; {{ date('Y') }} Bansal Lawyers. All rights reserved.</p>
            <p>This email was sent from Bansal Lawyers. If you have any questions, please contact us.</p>
        </div>
    </div>
</body>
</html>
