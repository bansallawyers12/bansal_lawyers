# Appointment Frontend Design Documentation

## Design System Overview

This document outlines the design patterns and styling approach for the appointment booking frontend, based on the existing Bansal Lawyers design system.

## Color Palette

### Primary Colors
- **Primary Blue**: `#1B4D89` - Main brand color for headings, links, and CTAs
- **Primary Blue Light**: `#2c5aa0` - Used for gradient effects
- **Dark Blue**: `#0a1a2e` - Hero section background
- **Medium Blue**: `#16213e` - Hero section gradient
- **Deep Blue**: `#1B4D89` - Hero section gradient endpoint

### Neutral Colors
- **White**: `#fff` - Card backgrounds and main content areas
- **Light Gray**: `#f8f9fa` - Section backgrounds
- **Border Gray**: `#f0f0f0` - Card borders and subtle dividers
- **Text Gray**: `#333` - Primary text color
- **Light Text**: `#666` - Secondary text color
- **Hero Text**: `#f1f3f4` - Text on dark backgrounds

## Typography

### Font Family
```css
font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Helvetica Neue", Arial, sans-serif;
```

### Font Sizes & Weights
- **Base Font**: 17px, line-height: 1.7
- **H1**: 2.8rem (45px), font-weight: 700
- **H2**: 1.65rem (28px), font-weight: 700, color: #1B4D89
- **H3**: 1.3rem (22px), font-weight: 700, color: #1B4D89
- **H4**: Standard weight, color: #1B4D89
- **Body Text**: 17px, line-height: 1.8, color: #333
- **Button Text**: Uppercase, font-weight: 700

## Layout Structure

### Container System
```css
.pae-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}
```

### Grid Layout
```css
.pae-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
}
.pae-left {
    flex: 1 1 680px;
    min-width: 0;
}
.pae-right {
    flex: 0 0 340px;
}
```

## Component Styles

### Hero Section
```css
.pae-hero {
    background: linear-gradient(135deg, #0a1a2e 0%, #16213e 50%, #1B4D89 100%);
    color: #fff;
    padding: 70px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.pae-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url('hero-bg.jpg') center/cover no-repeat;
    opacity: 0.18;
    z-index: 1;
}
```

### Cards
```css
.pae-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: 1px solid #f0f0f0;
    overflow: hidden;
}
.pae-card-body {
    padding: 30px;
}
```

### Buttons
```css
.pae-btn {
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    color: #fff;
    border: 0;
    border-radius: 25px;
    padding: 10px 18px;
    text-transform: uppercase;
    font-weight: 700;
}
```

### Form Elements
```css
/* Input fields */
.form-input {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}
.form-input:focus {
    outline: none;
    border-color: #1B4D89;
    box-shadow: 0 0 0 3px rgba(27, 77, 137, 0.1);
}

/* Select dropdowns */
.form-select {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 16px;
    background-color: #fff;
    cursor: pointer;
}

/* Textarea */
.form-textarea {
    width: 100%;
    min-height: 120px;
    padding: 12px 16px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 16px;
    resize: vertical;
    font-family: inherit;
}
```

## Appointment Page Structure

### Header Section
```html
<div class="appointment-hero">
    <div class="container">
        <h1>Book Your Legal Consultation</h1>
        <p>Schedule a confidential consultation with our experienced legal team.</p>
    </div>
</div>
```

### Main Content Layout
```html
<section class="appointment-section">
    <div class="appointment-container">
        <div class="appointment-grid">
            <div class="appointment-left">
                <!-- Main booking form -->
                <div class="appointment-card">
                    <div class="appointment-card-body">
                        <!-- Form content -->
                    </div>
                </div>
            </div>
            
            <aside class="appointment-right">
                <!-- Contact info sidebar -->
                <div class="appointment-card">
                    <div class="appointment-card-body">
                        <!-- Sidebar content -->
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
```

## Form Design Patterns

### Step-by-Step Booking Form
```css
.appointment-steps {
    display: flex;
    justify-content: center;
    margin-bottom: 30px;
}
.step {
    display: flex;
    align-items: center;
    margin: 0 15px;
}
.step-number {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #e0e0e0;
    color: #666;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin-right: 8px;
}
.step.active .step-number {
    background: #1B4D89;
    color: #fff;
}
```

### Time Slot Selection
```css
.time-slots {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 12px;
    margin: 20px 0;
}
.time-slot {
    padding: 12px 16px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fff;
}
.time-slot:hover {
    border-color: #1B4D89;
    background: rgba(27, 77, 137, 0.05);
}
.time-slot.selected {
    border-color: #1B4D89;
    background: #1B4D89;
    color: #fff;
}
.time-slot.unavailable {
    opacity: 0.5;
    cursor: not-allowed;
    background: #f5f5f5;
}
```

### Calendar Widget
```css
.calendar-widget {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.calendar-header {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 20px;
}
.calendar-nav {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    color: #1B4D89;
}
.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 4px;
}
.calendar-day {
    padding: 8px;
    text-align: center;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}
.calendar-day:hover {
    background: rgba(27, 77, 137, 0.1);
}
.calendar-day.selected {
    background: #1B4D89;
    color: #fff;
}
.calendar-day.unavailable {
    opacity: 0.3;
    cursor: not-allowed;
}
```

## Responsive Design

### Mobile Breakpoints
```css
@media (max-width: 900px) {
    .appointment-grid {
        flex-direction: column;
    }
    .appointment-right {
        flex: 1 1 auto;
    }
    .appointment-hero h1 {
        font-size: 2.2rem;
    }
    .appointment-hero p {
        font-size: 1rem;
    }
    .appointment-container {
        padding: 0 12px;
    }
    .time-slots {
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    }
}
```

## Animation & Transitions

### Smooth Transitions
```css
.smooth-transition {
    transition: all 0.3s ease;
}
.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(27, 77, 137, 0.15);
}
```

### Loading States
```css
.loading-spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 2px solid #f3f3f3;
    border-top: 2px solid #1B4D89;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
```

## Accessibility Features

### Focus States
```css
.focusable:focus {
    outline: 2px solid #1B4D89;
    outline-offset: 2px;
}
```

### Screen Reader Support
```html
<!-- Use proper ARIA labels -->
<button aria-label="Select appointment time">10:00 AM</button>
<div role="alert" aria-live="polite">Appointment booked successfully</div>
```

## Implementation Notes

1. **Consistent Spacing**: Use multiples of 8px for consistent spacing (8px, 16px, 24px, 32px, etc.)

2. **Shadow System**: 
   - Light: `0 4px 12px rgba(0,0,0,0.1)`
   - Medium: `0 8px 24px rgba(0,0,0,0.12)`
   - Heavy: `0 12px 36px rgba(0,0,0,0.15)`

3. **Border Radius**:
   - Small elements: 6-8px
   - Cards: 12-20px
   - Buttons: 25px (pill shape)

4. **Color Usage**:
   - Primary blue for interactive elements
   - Gray tones for non-interactive content
   - White backgrounds for content areas
   - Light gray backgrounds for sections

This design system ensures consistency with the existing Bansal Lawyers brand while providing a professional, accessible, and user-friendly appointment booking experience.
