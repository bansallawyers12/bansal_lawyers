<!-- START: Footer Section -->
<style>
/* Professional dark footer - SEO optimized and lightweight */
:root {
    --footer-bg-primary: #2c5282;
    --footer-bg-secondary: #4a5568;
    --footer-text-primary: #ffffff;
    --footer-text-secondary: #e2e8f0;
    --footer-text-muted: #a0aec0;
    --footer-accent: #ff6b35;
    --footer-border: rgba(255, 255, 255, 0.1);
}
.footer-section {
    background: linear-gradient(135deg, var(--footer-bg-primary) 0%, var(--footer-bg-secondary) 100%);
    color: var(--footer-text-primary);
    padding: 3rem 0 1.5rem;
    position: relative;
    overflow: hidden;
}

.footer-section .container {
    position: relative;
    z-index: 2;
}

.footer-logo {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--footer-text-primary);
    text-decoration: none;
    margin-bottom: 10px;
    line-height: 1.2;
    display: block;
    letter-spacing: -0.5px;
}

.footer-logo:hover {
    color: var(--footer-text-primary);
    text-decoration: none;
}

.footer-subtitle {
    color: var(--footer-text-primary);
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
    opacity: 0.9;
}

.footer-heading {
    color: var(--footer-text-primary);
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 25px;
    position: relative;
}

.footer-heading::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 40px;
    height: 3px;
    background: var(--footer-accent);
    border-radius: 2px;
}

.footer-text {
    color: var(--footer-text-secondary);
    line-height: 1.6;
    font-size: 1rem;
    margin-bottom: 25px;
    opacity: 0.9;
}

.footer-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-list li {
    margin-bottom: 8px;
}

.footer-list a {
    color: var(--footer-text-secondary);
    text-decoration: none;
    font-size: 1rem;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    padding: 8px 0;
    font-weight: 400;
    opacity: 0.9;
}

.footer-list a:hover {
    color: var(--footer-accent);
    transform: translateX(5px);
    text-decoration: none;
    opacity: 1;
}

.footer-contact-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 15px;
    color: var(--footer-text-secondary);
}

.footer-contact-icon {
    margin-right: 12px;
    margin-top: 2px;
    color: var(--footer-accent);
    font-size: 1.1rem;
    flex-shrink: 0;
}

.footer-contact-item a {
    color: var(--footer-text-secondary);
    text-decoration: none;
    transition: color 0.3s ease;
    line-height: 1.5;
    font-size: 1rem;
    font-weight: 400;
    opacity: 0.9;
}

.footer-contact-item a:hover {
    color: var(--footer-accent);
    text-decoration: none;
    opacity: 1;
}

.footer-contact-item span {
    line-height: 1.5;
    font-size: 1rem;
    font-weight: 400;
    opacity: 0.9;
}

.footer-hours h4 {
    color: var(--footer-text-primary);
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 8px;
}

.footer-hours p {
    color: var(--footer-text-secondary);
    margin-bottom: 8px;
    font-size: 1rem;
    line-height: 1.5;
    font-weight: 400;
    opacity: 0.9;
}

.footer-widget {
    margin-bottom: 1.5rem;
}

.footer-social {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-social li {
    display: inline-block;
    margin-right: 8px;
}

.footer-social li a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    color: var(--footer-text-primary);
    font-size: 1.2rem;
    transition: all 0.3s ease;
    text-decoration: none;
    border: 1px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
}

.footer-social li a:hover {
    background: var(--footer-accent);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    text-decoration: none;
}

.footer-social li a.icon-x svg {
    width: 16px;
    height: 16px;
    fill: currentColor;
    transition: all 0.2s ease;
}

.footer-bottom {
    border-top: 1px solid var(--footer-border);
    padding-top: 20px;
    text-align: center;
    margin-top: 40px;
}

.footer-bottom p {
    margin: 0;
    color: var(--footer-text-muted);
    font-size: 0.9rem;
    opacity: 0.8;
}

@media (max-width: 768px) {
    .footer-section {
        padding: 2.5rem 0 1.5rem;
    }
    
    .footer-heading {
        font-size: 1.3rem;
    }
    
    .footer-logo {
        font-size: 2rem;
    }
    
    .footer-social {
        justify-content: center;
        margin-top: 2rem;
    }
}

@media (max-width: 480px) {
    .footer-section {
        padding: 2rem 0 1rem;
    }
    
    .footer-logo {
        font-size: 1.8rem;
    }
    
    .footer-subtitle {
        font-size: 1rem;
    }
    
    .footer-social li a {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
    
    .footer-heading {
        font-size: 1.2rem;
    }
}
</style>

<footer class="footer-section" role="contentinfo" itemscope itemtype="https://schema.org/LegalService"> 
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
    
    <div class="row mb-4">
      <div class="col-md"> 
        <div class="footer-widget" itemprop="name"> 
          <h2 class="footer-logo">
            <a href="/" itemprop="url"> 
              <span itemprop="legalName">Bansal Lawyers</span> <span class="footer-subtitle">A Law Firm</span> 
            </a> 
          </h2> 
          <p class="footer-text" itemprop="description">Professional legal services provided with expertise and care in Melbourne and beyond. Specializing in Immigration Law, Family Law, Property Law, Commercial Law, and Criminal Law.</p> 

          <ul class="footer-social list-unstyled"> 
            
            <!-- Facebook -->
            <li class="ftco-animate"> 
              <a href="https://www.facebook.com/profile.php?id=61562008576642" 
                 aria-label="Facebook" target="_blank" rel="noopener noreferrer" class="icon-fb"> 
                <span class="icon-facebook"></span>
              </a> 
            </li> 

            <!-- Instagram -->
            <li class="ftco-animate"> 
              <a href="https://www.instagram.com/bansallawyers?igsh=N21ubnVkeDhibjVw" 
                 aria-label="Instagram" target="_blank" rel="noopener noreferrer" class="icon-ig"> 
                <span class="icon-instagram"></span>
              </a> 
            </li> 

            <!-- LinkedIn -->
            <li class="ftco-animate"> 
              <a href="https://www.linkedin.com/company/bansallawyers" 
                 aria-label="LinkedIn" target="_blank" rel="noopener noreferrer" class="icon-ln"> 
                <span class="icon-linkedin"></span>
              </a> 
            </li> 

            <!-- X (Twitter) -->
<li class="ftco-animate">
  <a href="https://twitter.com/BansalLawyers" 
     target="_blank" 
     rel="noopener noreferrer" 
     aria-label="Follow Bansal Lawyers on X (formerly Twitter)" 
     class="icon-x">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
      <path d="M18.244 2.25h3.308l-7.227 8.26 
               8.502 11.24H17.28l-5.356-7.002-6.13 
               7.002H2.486l7.73-8.834L2 2.25h6.92
               l4.818 6.413 4.506-6.413z"/>
    </svg>
  </a>
</li>
<script> document.addEventListener("DOMContentLoaded", function() { const twitterLink = document.querySelector(".twitter-link"); if (twitterLink) { twitterLink.setAttribute("href", "https://x.com/BansalLawyers"); twitterLink.setAttribute("target", "_blank"); twitterLink.setAttribute("rel", "noopener noreferrer"); } }); </script> 
 </li> 
 <li class="ftco-animate"> 
   <a href="https://www.youtube.com/@BansalLawyers" aria-label="YouTube"> 
     <span class="icon-youtube-play"></span>
   </a> 
 </li> 
</ul> 
  </div> 
 </div>
            <!-- Practice Areas Links -->
            <div class="col-md">
                <div class="footer-widget">
                    <h2 class="footer-heading">Practice Areas</h2>
                    <ul class="footer-list">
                        <li><a href="/family-law" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Family Law</a></li>
                        <li><a href="/migration-law" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Migration Law</a></li>
                        <li><a href="/criminal-law" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Criminal Law</a></li>
                        <li><a href="/commercial-law" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Commercial Law</a></li>
                        <li><a href="/property-law" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Property Law</a></li>
                    </ul>
                </div>
            </div>

            <!-- Legal Services Links -->
            <div class="col-md">
                <div class="footer-widget">
                    <h2 class="footer-heading">Legal Services</h2>
                    <ul class="footer-list">
                        <li><a href="/divorce" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Divorce Services</a></li>
                        <li><a href="/child-custody" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Child Custody</a></li>
                        <li><a href="/property-settlement" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Property Settlement</a></li>
                        <li><a href="/business-law" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Business Law</a></li>
                        <li><a href="/leasing-or-selling-a-business" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Business Leasing</a></li>
                        <li><a href="/contracts-or-business-agreements" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Business Contracts</a></li>
                    </ul>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-md">
                <div class="footer-widget">
                    <h2 class="footer-heading">Have a Question?</h2>
                    <div class="block-23" itemscope itemtype="https://schema.org/PostalAddress">
                        <!-- Hidden geo coordinates for local SEO -->
                        <div style="display: none;" itemscope itemtype="https://schema.org/GeoCoordinates">
                            <meta itemprop="latitude" content="-37.8136">
                            <meta itemprop="longitude" content="144.9631">
                        </div>
                        <ul>
                            <li class="footer-contact-item">
                                <span class="icon icon-map-marker footer-contact-icon"></span>
                                <a href="https://g.co/kgs/Hw16bN8" 
                                   target="_blank" 
                                   rel="noopener noreferrer" 
                                   itemprop="url">
                                    <span itemprop="streetAddress">Level 8/278 Collins St</span>, 
                                    <span itemprop="addressLocality">Melbourne</span> 
                                    <span itemprop="addressRegion">VIC</span> 
                                    <span itemprop="postalCode">3000</span>, 
                                    <span itemprop="addressCountry">Australia</span>
                                </a>
                            </li>
                            <li class="footer-contact-item">
                                <span class="icon icon-phone footer-contact-icon"></span>
                                <a href="tel:+61422905860" itemprop="telephone">
                                    (+61) 0422 905 860
                                </a>
                            </li>
                            <li class="footer-contact-item">
                                <span class="icon icon-phone footer-contact-icon"></span>
                                <span itemprop="telephone">1300 BANSAL (1300 226 725)</span>
                            </li>
                            <li class="footer-contact-item">
                                <span class="icon icon-envelope footer-contact-icon"></span>
                                <a href="mailto:Info@bansallawyers.com.au" itemprop="email">
                                    Info@bansallawyers.com.au
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Business Hours -->
            <div class="col-md">
                <div class="footer-widget">
                    <h2 class="footer-heading">Business Hours</h2>
                    <div class="footer-hours" itemscope itemtype="https://schema.org/OpeningHoursSpecification">
                        <h4>Opening Hours:</h4>
                        <p itemprop="dayOfWeek" content="Monday,Tuesday,Wednesday,Thursday,Friday">
                          <span>Monday – Friday: <time itemprop="opens" content="10:00">10:00 AM</time> to <time itemprop="closes" content="17:30">5:30 PM</time></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright Notice -->
        <div class="footer-bottom">
            <p>
                &copy;
                <script>document.write(new Date().getFullYear());</script> All rights reserved | Bansal Lawyers
            </p>
        </div>
    </div>
</footer>
