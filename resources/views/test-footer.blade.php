<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bansal Lawyers - New Footer Test</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Arsenal:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #1B4D89;
            --secondary-color: #2c5aa0;
            --accent-color: #FF6B35;
            --text-light: #ffffff;
            --text-muted: #e2e8f0;
            --text-dark: #2c3e50;
            --bg-light: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
            --gradient-accent: linear-gradient(135deg, #FF6B35 0%, #FF8E53 100%);
            --shadow: 0 10px 30px rgba(0,0,0,0.1);
            --shadow-hover: 0 20px 40px rgba(0,0,0,0.15);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            margin: 0;
            padding: 0;
        }

        .hero-section {
            background: var(--gradient-primary);
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* NEW MODERN FOOTER STYLES */
        .modern-footer {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            color: var(--text-light);
            position: relative;
            overflow: hidden;
        }

        .modern-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(27, 77, 137, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 107, 53, 0.1) 0%, transparent 50%);
            z-index: 1;
        }

        .footer-content {
            position: relative;
            z-index: 2;
            padding: 4rem 0 2rem;
        }

        .footer-brand {
            margin-bottom: 2rem;
        }

        .footer-logo {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-light);
            text-decoration: none;
            margin-bottom: 10px;
            display: block;
            transition: all 0.3s ease;
        }

        .footer-logo:hover {
            color: var(--accent-color);
            text-decoration: none;
            transform: translateY(-2px);
        }

        .footer-tagline {
            color: var(--accent-color);
            font-size: 1.1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .footer-description {
            color: var(--text-muted);
            line-height: 1.6;
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .footer-section-title {
            color: var(--text-light);
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .footer-section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--gradient-accent);
            border-radius: 2px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            padding: 8px 0;
            position: relative;
        }

        .footer-links a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 2px;
            background: var(--accent-color);
            transition: width 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--accent-color);
            transform: translateX(10px);
            text-decoration: none;
        }

        .footer-links a:hover::before {
            width: 20px;
        }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            color: var(--text-muted);
        }

        .footer-contact-icon {
            margin-right: 15px;
            margin-top: 5px;
            color: var(--accent-color);
            font-size: 1.2rem;
            flex-shrink: 0;
            width: 20px;
            text-align: center;
        }

        .footer-contact-item a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.3s ease;
            line-height: 1.5;
        }

        .footer-contact-item a:hover {
            color: var(--accent-color);
            text-decoration: none;
        }

        .footer-social {
            display: flex;
            gap: 15px;
            margin-top: 2rem;
        }

        .footer-social a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-light);
            font-size: 1.3rem;
            transition: all 0.3s ease;
            text-decoration: none;
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .footer-social a:hover {
            background: var(--gradient-accent);
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(255, 107, 53, 0.4);
            text-decoration: none;
        }

        .footer-hours {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-hours h4 {
            color: var(--text-light);
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .footer-hours p {
            color: var(--text-muted);
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem 0;
            text-align: center;
            margin-top: 3rem;
            position: relative;
        }

        .footer-bottom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 2px;
            background: var(--gradient-accent);
        }

        .footer-bottom p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.95rem;
            opacity: 0.8;
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-content {
                padding: 3rem 0 2rem;
            }
            
            .footer-logo {
                font-size: 2rem;
            }
            
            .footer-section-title {
                font-size: 1.2rem;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
            
            .footer-social {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .footer-logo {
                font-size: 1.8rem;
            }
            
            .footer-social a {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
            }
        }

        /* Animation Classes */
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
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

        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
    </style>
</head>
<body>
    <!-- Hero Section for Testing -->
    <section class="hero-section">
        <div class="container">
            <h1>New Footer Design Test</h1>
            <p>Scroll down to see the modern, dynamic footer design</p>
        </div>
    </section>

    <!-- Content Section -->
    <section style="padding: 80px 0; background: white;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 style="color: var(--primary-color); margin-bottom: 30px;">Test Content</h2>
                    <p style="font-size: 1.1rem; color: #666; max-width: 600px; margin: 0 auto;">
                        This is a test page to showcase the new modern footer design. The footer below features:
                    </p>
                    <ul style="text-align: left; max-width: 500px; margin: 30px auto;">
                        <li>Modern gradient background with subtle animations</li>
                        <li>Improved typography and spacing</li>
                        <li>Interactive hover effects</li>
                        <li>Newsletter subscription section</li>
                        <li>Better mobile responsiveness</li>
                        <li>Professional legal services theme</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- NEW MODERN FOOTER -->
    <footer class="modern-footer" role="contentinfo" itemscope itemtype="https://schema.org/LegalService">
        <div class="container">
            <!-- Hidden structured data for SEO -->
            <div style="display: none;" itemscope itemtype="https://schema.org/Organization">
                <span itemprop="name">Bansal Lawyers</span>
                <span itemprop="legalName">Bansal Lawyers</span>
                <span itemprop="foundingDate">2015</span>
                <span itemprop="areaServed">Melbourne, Victoria, Australia</span>
                <span itemprop="serviceType">Legal Services</span>
                <span itemprop="priceRange">$$</span>
                <span itemprop="paymentAccepted">Cash, Credit Card, Bank Transfer</span>
                <span itemprop="currenciesAccepted">AUD</span>
                <div itemprop="founder" itemscope itemtype="https://schema.org/Person">
                    <span itemprop="name">Ajay Bansal</span>
                    <span itemprop="jobTitle">Director</span>
                    <span itemprop="worksFor" itemscope itemtype="https://schema.org/Organization">
                        <span itemprop="name">Bansal Lawyers</span>
                    </span>
                </div>
                <div itemprop="sameAs">
                    <a href="https://www.facebook.com/profile.php?id=61562008576642">Facebook</a>
                    <a href="https://www.instagram.com/bansallawyers?igsh=N21ubnVkeDhibjVw">Instagram</a>
                    <a href="https://www.linkedin.com/company/bansallawyers">LinkedIn</a>
                    <a href="https://twitter.com/BansalLawyers">Twitter</a>
                    <a href="https://www.youtube.com/@BansalLawyers">YouTube</a>
                </div>
            </div>

            <div class="footer-content">
                <div class="row">
                    <!-- Brand Section -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="footer-brand fade-in-up">
                            <a href="/" class="footer-logo" itemprop="url">
                                <span itemprop="legalName">Bansal Lawyers</span>
                            </a>
                            <div class="footer-tagline">A Law Firm</div>
                            <p class="footer-description" itemprop="description">
                                Professional legal services provided with expertise and care in Melbourne and beyond. 
                                Specializing in Immigration Law, Family Law, Property Law, Commercial Law, and Criminal Law.
                            </p>
                            
                            <!-- Social Media Links -->
                            <div class="footer-social">
                                <a href="https://www.facebook.com/profile.php?id=61562008576642" 
                                   aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://www.instagram.com/bansallawyers?igsh=N21ubnVkeDhibjVw" 
                                   aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="https://www.linkedin.com/company/bansallawyers" 
                                   aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="https://twitter.com/BansalLawyers" 
                                   aria-label="Twitter" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.youtube.com/@BansalLawyers" 
                                   aria-label="YouTube" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Practice Areas -->
                    <div class="col-lg-2 col-md-6 mb-4">
                        <div class="fade-in-up stagger-1">
                            <h3 class="footer-section-title">Practice Areas</h3>
                            <ul class="footer-links">
                                <li><a href="/family-law"><i class="fas fa-arrow-right"></i> Family Law</a></li>
                                <li><a href="/migration-law"><i class="fas fa-arrow-right"></i> Migration Law</a></li>
                                <li><a href="/criminal-law"><i class="fas fa-arrow-right"></i> Criminal Law</a></li>
                                <li><a href="/commercial-law"><i class="fas fa-arrow-right"></i> Commercial Law</a></li>
                                <li><a href="/property-law"><i class="fas fa-arrow-right"></i> Property Law</a></li>
                            </ul>
                        </div>
                    </div>


                    <!-- Contact Information -->
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="fade-in-up stagger-3">
                            <h3 class="footer-section-title">Contact Information</h3>
                            <div class="footer-contact-item">
                                <i class="fas fa-map-marker-alt footer-contact-icon"></i>
                                <a href="https://g.co/kgs/Hw16bN8" 
                                   target="_blank" 
                                   rel="noopener noreferrer" 
                                   itemprop="url">
                                    Level 8/278 Collins St, Melbourne VIC 3000, Australia
                                </a>
                            </div>
                            <div class="footer-contact-item">
                                <i class="fas fa-phone footer-contact-icon"></i>
                                <a href="tel:+61422905860" itemprop="telephone">
                                    (+61) 0422 905 860
                                </a>
                            </div>
                            <div class="footer-contact-item">
                                <i class="fas fa-phone footer-contact-icon"></i>
                                <span itemprop="telephone">1300 BANSAL (1300 226 725)</span>
                            </div>
                            <div class="footer-contact-item">
                                <i class="fas fa-envelope footer-contact-icon"></i>
                                <a href="mailto:Info@bansallawyers.com.au" itemprop="email">
                                    Info@bansallawyers.com.au
                                </a>
                            </div>

                            <!-- Business Hours -->
                            <div class="footer-hours">
                                <h4>Business Hours</h4>
                                <p><strong>Monday – Friday:</strong> 10:00 AM to 5:30 PM</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Copyright Notice -->
            <div class="footer-bottom">
                <p>
                    &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | Bansal Lawyers
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript for animations -->
    <script>
        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all fade-in elements
        document.querySelectorAll('.fade-in-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });


        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
