@extends('layouts.frontend_appointment')

@section('seoinfo')
    <title>Book Appointment with Top Law Firm in Melbourne</title>
    <meta name="description" content="Book an appointment with Bansal Lawyers, one of the top law firms in Melbourne, Australia. Schedule a consultation for expert legal guidance in divorce, visa matters, property disputes, and more." />
    <link rel="canonical" href="https://www.bansallawyers.com.au/book-an-appointment" />
    <meta property="og:url" content="{{ url('/book-an-appointment') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Book an Appointment | Schedule a Consultation with Top Law Firm Bansal Lawyers Melbourne">
    <meta property="og:description" content="Book an appointment with Bansal Lawyers, one of the top law firms in Melbourne, Australia.">
    <meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/book-an-appointment') }}">
    <meta name="twitter:title" content="Book an Appointment | Bansal Lawyers Melbourne">
    <meta name="twitter:description" content="Book an appointment with Bansal Lawyers in Melbourne.">
    <meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
@endsection

@push('head')
    @vite(['resources/css/pages/appointment-form.css', 'resources/js/appointment-form/index.js'])
@endpush

@section('content')
@php
    $servicesKeyed = collect($consultationServices ?? [])->keyBy('id');
@endphp

<script type="application/json" id="booking-config">{!! json_encode([
    'baseUrl' => rtrim(url('/'), '/'),
    'services' => $servicesKeyed->toArray(),
    'timeSlotLabels' => $bookingTimeSlotLabels ?? [],
    'endpoints' => [
        'storepaid' => url('/book-an-appointment/storepaid'),
        'promoCheck' => url('/promo-code/check'),
        'getdatetime' => url('/getdatetime'),
        'getdisableddatetime' => url('/getdisableddatetime'),
    ],
], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}</script>

<div class="appointment-form-page" x-data="bookingForm" x-cloak>
    <section class="booking-hero">
        <h1>Book Your Legal Consultation</h1>
        <p>Expert legal advice from Melbourne's trusted law firm. Choose your consultation duration, preferred method, and a time that suits you.</p>
        <div class="booking-hero-price">
            <strong>From $150 AUD</strong>
            <span>30-minute consultations • Free 10-min intro for new clients</span>
        </div>
    </section>

    <div class="booking-shell">
        <div class="booking-card">
            <nav class="booking-steps" aria-label="Booking progress">
                <template x-for="tab in tabOrder" :key="tab">
                    <button type="button"
                        class="booking-step"
                        :class="{ 'active': currentStep === tab, 'disabled': !isTabEnabled(tab) }"
                        @click="switchTab(tab)"
                        :disabled="!isTabEnabled(tab)">
                        <i :data-lucide="tab === 'consultation_duration' ? 'clock' : tab === 'consultation_type' ? 'calendar' : tab === 'appointment_details' ? 'calendar-check' : tab === 'info' ? 'user' : 'circle-check'"></i>
                        <span x-text="tab === 'consultation_duration' ? 'Duration' : tab === 'consultation_type' ? 'Type' : tab === 'appointment_details' ? 'Date & Time' : tab === 'info' ? 'Your Info' : 'Confirm'"></span>
                    </button>
                </template>
            </nav>

            <form id="appointment-form" class="booking-panel-wrap" @submit.prevent>
                {{-- Honeypot --}}
                <div style="position:absolute;left:-9999px;top:-9999px;opacity:0;height:0;overflow:hidden;" aria-hidden="true">
                    <input type="text" name="website_url" tabindex="-1" autocomplete="off" value="">
                </div>

                <div class="step-error-list" x-show="stepErrors.length" x-cloak>
                    <strong>Please complete the following:</strong>
                    <ul>
                        <template x-for="msg in stepErrors" :key="msg">
                            <li x-text="msg"></li>
                        </template>
                    </ul>
                </div>

                {{-- Step 1: Duration --}}
                <div class="booking-panel" :class="{ 'hidden': currentStep !== 'consultation_duration' }">
                    <h2 class="booking-panel-title"><i data-lucide="clock"></i> Choose Your Consultation Duration</h2>
                    <p class="booking-panel-subtitle">Select how much time you need. All options include expert legal advice from our Melbourne team.</p>
                    <div class="option-grid">
                        @foreach($consultationServices ?? [] as $svc)
                        <div class="option-card"
                             :class="{ 'selected': serviceId === {{ $svc['id'] }} }"
                             @click="selectDuration({{ $svc['id'] }}, {{ $svc['is_free'] ? 'true' : 'false' }})">
                            <div class="option-card-header">
                                <div class="option-icon">
                                    <i data-lucide="{{ $svc['is_free'] ? 'gift' : ($svc['duration'] >= 60 ? 'hourglass' : 'clock') }}"></i>
                                </div>
                                <div>
                                    <div class="option-title">{{ $svc['duration_label'] }} Consultation</div>
                                    @if($svc['is_free'])
                                        <span class="option-badge">First time only</span>
                                    @elseif($svc['duration'] >= 60)
                                        <span class="option-badge">Extended session</span>
                                    @else
                                        <span class="option-badge">Most popular</span>
                                    @endif
                                </div>
                                <div class="option-price">{{ $svc['price_label'] }}</div>
                            </div>
                            <p class="option-desc">
                                @if($svc['is_free'])
                                    A complimentary 10-minute introduction for first-time clients.
                                @elseif($svc['duration'] >= 60)
                                    Up to one hour for complex matters, document review, and a clear action plan.
                                @else
                                    30 minutes of focused legal advice — ideal for most immigration, family, and business matters.
                                @endif
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Step 2: Consultation type --}}
                <div class="booking-panel" :class="{ 'hidden': currentStep !== 'consultation_type' }">
                    <h2 class="booking-panel-title"><i data-lucide="calendar-plus"></i> Choose Your Consultation Type</h2>
                    <p class="booking-panel-subtitle">Selected duration: <strong x-text="durationSummary"></strong></p>
                    <div class="option-grid">
                        @foreach([
                            ['value' => 'In-person', 'id' => 'inperson', 'icon' => 'building-2', 'title' => 'In-Person Consultation', 'badge' => 'Most Popular', 'desc' => 'Meet face-to-face at our Melbourne office.'],
                            ['value' => 'Phone', 'id' => 'phone', 'icon' => 'phone', 'title' => 'Phone Consultation', 'badge' => 'Quick & Easy', 'desc' => 'Get expert advice from anywhere in Australia.'],
                            ['value' => 'Zoom / Google Meeting', 'id' => 'video', 'icon' => 'video', 'title' => 'Video Consultation', 'badge' => 'Modern Choice', 'desc' => 'Secure video calls via Zoom or Google Meet.'],
                        ] as $method)
                        <div class="option-card"
                             :class="{ 'selected': consultationType === '{{ $method['value'] }}' }"
                             @click="selectConsultationType('{{ $method['value'] }}')">
                            <div class="option-card-header">
                                <div class="option-icon"><i data-lucide="{{ $method['icon'] }}"></i></div>
                                <div>
                                    <div class="option-title">{{ $method['title'] }}</div>
                                    <span class="option-badge">{{ $method['badge'] }}</span>
                                </div>
                            </div>
                            <p class="option-desc">{{ $method['desc'] }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="booking-actions">
                        <button type="button" class="booking-btn booking-btn-secondary" @click="goBack()">Back</button>
                    </div>
                </div>

                {{-- Step 3: Date & time --}}
                <div class="booking-panel" :class="{ 'hidden': currentStep !== 'appointment_details' }">
                    <h2 class="booking-panel-title"><i data-lucide="calendar"></i> Select Date & Time</h2>
                    <p class="booking-panel-subtitle"><i data-lucide="clock" class="inline-icon"></i> All times are Melbourne, Australia (AEST/AEDT)</p>
                    <div class="alert-banner" x-show="dateTimeError" x-cloak>
                        <i data-lucide="triangle-alert"></i> Please select both a date and time for your consultation.
                    </div>
                    <div class="calendar-layout">
                        <div class="calendar-widget">
                            <input type="text" id="booking-calendar" data-flatpickr-mode="inline-date" aria-label="Select appointment date">
                        </div>
                        <div class="time-slots-panel">
                            <h3 class="option-title" x-text="selectedDateLabel ? 'Available times for ' + selectedDateLabel : 'Select a date first'"></h3>
                            <p class="booking-panel-subtitle" x-show="slotsLoading">Loading time slots...</p>
                            <div class="time-slots-grid" x-show="!slotsLoading && timeSlots.length">
                                <template x-for="slot in timeSlots" :key="slot.time">
                                    <button type="button"
                                        class="time-slot-btn"
                                        :class="{ 'selected': selectedTime === slot.time }"
                                        :disabled="!slot.available"
                                        @click="selectTimeSlot(slot)"
                                        x-text="slot.time"></button>
                                </template>
                            </div>
                            <p class="booking-panel-subtitle" x-show="!slotsLoading && selectedDateLabel && !timeSlots.length">No slots available for this date.</p>
                        </div>
                    </div>
                    <div class="booking-actions">
                        <button type="button" class="booking-btn booking-btn-secondary" @click="goBack()">Back</button>
                        <button type="button" class="booking-btn booking-btn-primary" @click="goNext()">Next Step</button>
                    </div>
                </div>

                {{-- Step 4: Info --}}
                <div class="booking-panel" :class="{ 'hidden': currentStep !== 'info' }">
                    <div class="summary-box">
                        <h3 class="option-title">Your Selection Summary</h3>
                        <div class="summary-row"><span>Duration</span><strong x-text="durationSummary"></strong></div>
                        <div class="summary-row"><span>Consultation Type</span><strong x-text="consultationSummary"></strong></div>
                        <div class="summary-row"><span>Date & Time</span><strong x-text="datetimeSummary"></strong></div>
                    </div>

                    <div class="booking-form-group">
                        <label class="booking-label" for="noe_id">Type of Legal Matter</label>
                        <select id="noe_id" name="noe_id" data-enhanced-select data-enhanced-select-placeholder="Select the type of legal matter" x-model="noeId" required>
                            <option value="">Select the type of legal matter</option>
                            @foreach(\App\Models\NatureOfEnquiry::active()->orderBy('id')->get() as $enquiry)
                                <option value="{{ $enquiry->id }}">{{ $enquiry->title }}</option>
                            @endforeach
                        </select>
                        <p class="field-error-text" x-show="fieldErrors.noe_id" x-text="fieldErrors.noe_id"></p>
                    </div>
                    <div class="booking-form-group">
                        <label class="booking-label" for="fullname">Full Name</label>
                        <input type="text" id="fullname" class="booking-input" :class="{ 'error': fieldErrors.fullname }" x-model="fullname" placeholder="Enter your full name" required>
                        <p class="field-error-text" x-show="fieldErrors.fullname" x-text="fieldErrors.fullname"></p>
                    </div>
                    <div class="booking-form-group">
                        <label class="booking-label" for="email">Email</label>
                        <input type="email" id="email" class="booking-input" :class="{ 'error': fieldErrors.email }" x-model="email" placeholder="Enter your email address" required>
                        <p class="field-error-text" x-show="fieldErrors.email" x-text="fieldErrors.email"></p>
                    </div>
                    <div class="booking-form-group">
                        <label class="booking-label" for="phone">Phone</label>
                        <input type="text" id="phone" class="booking-input" :class="{ 'error': fieldErrors.phone }" x-model="phone" placeholder="Enter your phone number" required>
                        <p class="field-error-text" x-show="fieldErrors.phone" x-text="fieldErrors.phone"></p>
                    </div>
                    <div class="booking-form-group">
                        <label class="booking-label" for="description">Details Of Enquiry</label>
                        <textarea id="description" class="booking-textarea" :class="{ 'error': fieldErrors.description }" x-model="description" placeholder="Please provide details about your legal matter" required></textarea>
                        <p class="field-error-text" x-show="fieldErrors.description" x-text="fieldErrors.description"></p>
                    </div>
                    <div class="booking-actions">
                        <button type="button" class="booking-btn booking-btn-secondary" @click="goBack()">Back</button>
                        <button type="button" class="booking-btn booking-btn-primary" @click="goNext()">Review & Confirm</button>
                    </div>
                </div>

                {{-- Step 5: Confirm --}}
                <div class="booking-panel" :class="{ 'hidden': currentStep !== 'confirm' }">
                    <h2 class="booking-panel-title">Confirm Your Appointment</h2>
                    <div class="confirm-table-wrap">
                        <table class="confirm-table">
                            <thead>
                                <tr>
                                    <th>Duration</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td x-text="durationSummary"></td>
                                    <td x-text="consultationSummary"></td>
                                    <td x-text="fullname"></td>
                                    <td x-text="email"></td>
                                    <td x-text="phone"></td>
                                    <td x-text="selectedDateLabel"></td>
                                    <td x-text="selectedTime"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div x-show="allowsPromo">
                        <h3 class="option-title"><i data-lucide="ticket"></i> Have a Promo Code?</h3>
                        <div class="promo-row">
                            <input type="text" class="booking-input" x-model="promoCode" placeholder="Enter your promo code" :disabled="promoApplied">
                            <button type="button" class="booking-btn booking-btn-primary" @click="applyPromo()" :disabled="applyingPromo || promoApplied">
                                <span x-text="applyingPromo ? 'Checking...' : (promoApplied ? 'Applied' : 'Apply')"></span>
                            </button>
                            <button type="button" class="booking-btn booking-btn-secondary" x-show="promoApplied" @click="resetPromo()">Reset</button>
                        </div>
                        <p class="promo-message" :class="promoMessageType" x-show="promoMessage" x-text="promoMessage"></p>
                    </div>

                    <div class="payment-summary">
                        <div class="payment-line"><span>Consultation Fee:</span><span x-text="pricing.baseLabel"></span></div>
                        <div class="payment-line" x-show="pricing.discount > 0"><span>Discount:</span><span x-text="'-' + pricing.discountLabel"></span></div>
                        <div class="payment-line total"><span>Total:</span><span x-text="pricing.finalLabel"></span></div>
                    </div>

                    <p class="field-error-text" x-show="turnstileError" x-text="turnstileError"></p>

                    <div class="booking-actions">
                        <button type="button" class="booking-btn booking-btn-secondary" @click="goBack()">Back</button>
                        <button type="button" class="booking-btn booking-btn-primary" @click="requestSubmit()">
                            <i data-lucide="credit-card"></i>
                            <span>Complete Booking</span>
                            <span x-text="pricing.finalLabel"></span>
                        </button>
                    </div>

                    <div id="booking-turnstile" class="cf-turnstile"
                         data-sitekey="{{ config('services.turnstile.key') }}"
                         data-execution="execute"
                         data-appearance="interaction-only"
                         data-callback="onBookingTurnstileSuccess"
                         data-error-callback="onBookingTurnstileError"></div>
                </div>
            </form>
        </div>
    </div>

    {{-- Free consult modal --}}
    <div class="booking-modal-overlay" x-show="showFreeModal" x-cloak @click.self="cancelFreeConsult()" @keydown.escape.window="cancelFreeConsult()">
        <div class="booking-modal">
            <h3><i data-lucide="info"></i> Free 10-Minute Consultation</h3>
            <p>Please read and confirm the following before continuing:</p>
            <ul>
                <li><strong>First-time clients only</strong> — available once per client.</li>
                <li><strong>Eligibility review</strong> — your matter must be suitable for discussion within 10 minutes.</li>
                <li><strong>Complete your details</strong> — provide thorough enquiry details.</li>
                <li><strong>Overrun policy</strong> — time exceeding 10 minutes may be charged with prior notice.</li>
            </ul>
            <label class="ack-row">
                <input type="checkbox" x-model="freeConsultAcknowledged">
                <span>I understand and accept these terms for the free 10-minute consultation.</span>
            </label>
            <div class="booking-actions">
                <button type="button" class="booking-btn booking-btn-secondary" @click="cancelFreeConsult()">Choose Another Option</button>
                <button type="button" class="booking-btn booking-btn-primary" @click="confirmFreeConsult()" :disabled="!freeConsultAcknowledged">I Understand & Continue</button>
            </div>
        </div>
    </div>

    {{-- Floating nav --}}
    <div class="floating-nav" x-show="showFloatingNav" x-cloak>
        <button type="button" class="booking-btn booking-btn-secondary" @click="goBack()">
            <i data-lucide="arrow-left"></i> Back
        </button>
        <button type="button" class="booking-btn booking-btn-primary" x-show="canShowFloatingNext" @click="goNext()">
            <span x-text="floatingNextLabel"></span>
            <i data-lucide="arrow-right"></i>
        </button>
    </div>

    {{-- Loading --}}
    <div class="booking-loading" :class="{ 'hidden': !loading }">
        <div class="booking-loading-inner">
            <div class="booking-spinner"></div>
            <p>Processing your appointment...</p>
        </div>
    </div>
</div>

<style>[x-cloak] { display: none !important; }</style>
@endsection
