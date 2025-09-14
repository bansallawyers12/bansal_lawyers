@extends('layouts.frontend')

@section('seoinfo')
<title>Experimental Design Pages - Bansal Lawyers</title>
<meta name="description" content="Access experimental design versions of Bansal Lawyers website pages for testing and comparison.">
@endsection

@section('content')

<style>
.experimental-nav {
    padding: 80px 0;
    background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
    color: white;
    text-align: center;
}

.experimental-nav h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 2rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.experimental-nav p {
    font-size: 1.2rem;
    margin-bottom: 3rem;
    opacity: 0.9;
}

.experimental-cards {
    padding: 80px 0;
    background: #f8f9fa;
}

.experimental-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
}

.experimental-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.experimental-card .icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px;
    font-size: 2rem;
    color: white;
}

.experimental-card h3 {
    color: #1B4D89;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 20px;
}

.experimental-card p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 30px;
}

.experimental-btn {
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(27, 77, 137, 0.3);
    margin: 5px;
}

.experimental-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(27, 77, 137, 0.4);
    color: white;
    text-decoration: none;
}

.experimental-btn.secondary {
    background: linear-gradient(135deg, #6c757d, #495057);
}

.experimental-btn.secondary:hover {
    color: white;
    text-decoration: none;
}

.comparison-section {
    padding: 80px 0;
    background: white;
}

.comparison-table {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    overflow-x: auto;
}

.comparison-table table {
    width: 100%;
    border-collapse: collapse;
}

.comparison-table th {
    background: #1B4D89;
    color: white;
    padding: 20px;
    text-align: left;
    font-weight: 600;
}

.comparison-table td {
    padding: 20px;
    border-bottom: 1px solid #e9ecef;
}

.comparison-table tr:hover {
    background: #f8f9fa;
}

@media (max-width: 768px) {
    .experimental-nav h1 {
        font-size: 2.5rem;
    }
    
    .experimental-card {
        padding: 30px 20px;
    }
    
    .comparison-table {
        padding: 20px;
    }
}
</style>

<!-- Navigation Header -->
<section class="experimental-nav">
    <div class="container">
        <h1>Experimental Design Pages</h1>
        <p>Test and compare the new modern designs for Bansal Lawyers website pages</p>
    </div>
</section>

<!-- Page Cards -->
<section class="experimental-cards">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="experimental-card">
                    <div class="icon">
                        <i class="fa fa-home"></i>
                    </div>
                    <h3>Home Page</h3>
                    <p>Modern hero section with gradient backgrounds, improved typography, and enhanced visual hierarchy. Features redesigned service cards and testimonial sections.</p>
                    <a href="/experimental" class="experimental-btn">View Experimental</a>
                    <a href="/" class="experimental-btn secondary">View Original</a>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="experimental-card">
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <h3>Contact Page</h3>
                    <p>Redesigned contact form with better visual appeal, improved contact information layout, and enhanced user experience with modern styling.</p>
                    <a href="/experimental/contact" class="experimental-btn">View Experimental</a>
                    <a href="/contact" class="experimental-btn secondary">View Original</a>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="experimental-card">
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <h3>Appointment Page</h3>
                    <p>Streamlined appointment booking process with modern tabbed interface, improved form styling, and better visual feedback for user interactions.</p>
                    <a href="/experimental/book-an-appointment" class="experimental-btn">View Experimental</a>
                    <a href="/book-an-appointment" class="experimental-btn secondary">View Original</a>
                </div>
            </div>
        </div>
        
        <!-- Practice Areas Section -->
        <div class="row mt-5">
            <div class="col-12">
                <h2 style="color: #1B4D89; font-size: 2.5rem; font-weight: 700; margin-bottom: 3rem; text-align: center;">Practice Areas - Experimental Pages</h2>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="experimental-card">
                    <div class="icon">
                        <i class="fa fa-gavel"></i>
                    </div>
                    <h3>Practice Areas Overview</h3>
                    <p>Modern grid layout showcasing all practice areas with enhanced visual appeal, improved cards design, and better user experience.</p>
                    <a href="/practice-areas-experimental" class="experimental-btn">View Experimental</a>
                    <a href="/practice-areas" class="experimental-btn secondary">View Original</a>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="experimental-card">
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <h3>Family Law</h3>
                    <p>Redesigned family law page with modern hero section, improved content layout, and enhanced sidebar with related pages and contact form.</p>
                    <a href="/family-law-experimental" class="experimental-btn">View Experimental</a>
                    <a href="/family-law" class="experimental-btn secondary">View Original</a>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="experimental-card">
                    <div class="icon">
                        <i class="fa fa-plane"></i>
                    </div>
                    <h3>Migration Law</h3>
                    <p>Enhanced migration law page with modern design, improved content structure, and better visual hierarchy for immigration services.</p>
                    <a href="/migration-law-experimental" class="experimental-btn">View Experimental</a>
                    <a href="/migration-law" class="experimental-btn secondary">View Original</a>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="experimental-card">
                    <div class="icon">
                        <i class="fa fa-shield"></i>
                    </div>
                    <h3>Criminal Law</h3>
                    <p>Modern criminal law page with enhanced content presentation, improved readability, and better visual appeal for legal services.</p>
                    <a href="/criminal-law-experimental" class="experimental-btn">View Experimental</a>
                    <a href="/criminal-law" class="experimental-btn secondary">View Original</a>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="experimental-card">
                    <div class="icon">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <h3>Commercial Law</h3>
                    <p>Redesigned commercial law page with modern business-focused design, improved content structure, and enhanced user experience.</p>
                    <a href="/commercial-law-experimental" class="experimental-btn">View Experimental</a>
                    <a href="/commercial-law" class="experimental-btn secondary">View Original</a>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="experimental-card">
                    <div class="icon">
                        <i class="fa fa-home"></i>
                    </div>
                    <h3>Property Law</h3>
                    <p>Enhanced property law page with modern real estate-focused design, improved content layout, and better visual presentation.</p>
                    <a href="/property-law-experimental" class="experimental-btn">View Experimental</a>
                    <a href="/property-law" class="experimental-btn secondary">View Original</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Comparison Section -->
<section class="comparison-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <h2 style="color: #1B4D89; font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">Design Improvements</h2>
                <p style="color: #666; font-size: 1.1rem;">Key enhancements made to the experimental designs</p>
            </div>
        </div>
        
        <div class="comparison-table">
            <table>
                <thead>
                    <tr>
                        <th>Feature</th>
                        <th>Original Design</th>
                        <th>Experimental Design</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Color Scheme</strong></td>
                        <td>Basic blue (#1B4D89) with minimal gradients</td>
                        <td>Modern gradient backgrounds with enhanced visual appeal</td>
                    </tr>
                    <tr>
                        <td><strong>Typography</strong></td>
                        <td>Standard font sizes and spacing</td>
                        <td>Improved hierarchy with better font weights and spacing</td>
                    </tr>
                    <tr>
                        <td><strong>Cards & Components</strong></td>
                        <td>Basic styling with minimal shadows</td>
                        <td>Modern cards with rounded corners, shadows, and hover effects</td>
                    </tr>
                    <tr>
                        <td><strong>Forms</strong></td>
                        <td>Standard form styling</td>
                        <td>Enhanced form controls with better focus states and validation</td>
                    </tr>
                    <tr>
                        <td><strong>Layout</strong></td>
                        <td>Traditional grid layout</td>
                        <td>Improved spacing, padding, and responsive design</td>
                    </tr>
                    <tr>
                        <td><strong>User Experience</strong></td>
                        <td>Basic navigation and interactions</td>
                        <td>Enhanced interactions with smooth transitions and animations</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="text-center mt-5">
            <h3 style="color: #1B4D89; margin-bottom: 2rem;">Ready to Implement?</h3>
            <p style="color: #666; margin-bottom: 2rem;">Once you're satisfied with the experimental designs, we can replace the original pages with the improved versions.</p>
            <a href="/" class="experimental-btn">Back to Main Site</a>
        </div>
    </div>
</section>

@endsection

@section('scripts')
@endsection
