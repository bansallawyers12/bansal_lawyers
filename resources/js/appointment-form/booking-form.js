import {
    TAB_ORDER,
    consultationTypeLabel,
    formatAud,
    formatDateForApi,
    parseBookingConfig,
} from './config.js';
import { validateAll, validateStep } from './validators.js';
import { createCalendarController } from './calendar.js';
import { buildPricing, checkPromoCode, handleSubmitResponse, submitBooking } from './submission.js';
import { enhanceSelect } from '../shared/tom-select-init.js';
import { showOverlay } from '../shared/ui.js';

export function bookingForm() {
    const config = parseBookingConfig();
    const services = config.services || {};
    let calendarController = null;
    let tomSelectInstance = null;
    let calendarInitedForService = null;

    return {
        currentStep: 'consultation_duration',
        maxReachedIndex: 0,
        tabOrder: TAB_ORDER,

        serviceId: null,
        consultationType: '',
        appointmentDetails: '',
        freeConsultAcknowledged: false,
        showFreeModal: false,

        selectedDate: null,
        selectedDateLabel: '',
        selectedTime: null,
        timeSlots: [],
        slotsLoading: false,
        dateTimeError: false,

        fullname: '',
        email: '',
        phone: '',
        description: '',
        noeId: '',

        promoCode: '',
        promoApplied: false,
        promoMessage: '',
        promoMessageType: '',
        discountAmount: 0,
        discountPercentage: 0,
        applyingPromo: false,

        fieldErrors: {},
        stepErrors: [],
        loading: false,
        turnstileError: '',

        pricing: buildPricing(null),

        init() {
            calendarController = createCalendarController({
                onSlotsLoading: () => {
                    this.slotsLoading = true;
                },
                onSlotsLoaded: (slots) => {
                    this.timeSlots = slots;
                    this.slotsLoading = false;
                    this.$nextTick(() => this.refreshIcons());
                },
            });

            this.$nextTick(() => this.refreshIcons());

            window.onBookingTurnstileSuccess = (token) => this.submitWithToken(token);
            window.onBookingTurnstileError = () => {
                this.turnstileError = 'Security verification failed. Please try again.';
            };

            this.$watch('currentStep', (step) => {
                this.$nextTick(() => {
                    this.refreshIcons();
                    if (step === 'appointment_details') {
                        this.initCalendar();
                    }
                    if (step === 'info') {
                        this.initTomSelect();
                    }
                });
            });
        },

        get serviceMeta() {
            if (!this.serviceId) {
                return null;
            }
            return services[this.serviceId] || services[String(this.serviceId)] || null;
        },

        get durationSummary() {
            const meta = this.serviceMeta;
            return meta ? `${meta.duration_label} (${meta.price_label})` : 'Not selected';
        },

        get consultationSummary() {
            return consultationTypeLabel(this.consultationType) || 'Not selected';
        },

        get datetimeSummary() {
            if (this.selectedDateLabel && this.selectedTime) {
                return `${this.selectedDateLabel} at ${this.selectedTime}`;
            }
            if (this.selectedDateLabel) {
                return `${this.selectedDateLabel} (time not selected)`;
            }
            return 'Not selected';
        },

        get allowsPromo() {
            return !!(this.serviceMeta && this.serviceMeta.allows_promo);
        },

        get showFloatingNav() {
            return this.currentStep !== 'consultation_duration';
        },

        get floatingNextLabel() {
            if (this.currentStep === 'info') {
                return 'Review & Confirm';
            }
            if (this.currentStep === 'confirm') {
                return this.pricing.finalAmount <= 0 ? 'Complete Booking' : 'Pay & Submit';
            }
            return 'Next';
        },

        get canShowFloatingNext() {
            if (this.currentStep === 'info' || this.currentStep === 'confirm') {
                return true;
            }
            return validateStep(this.snapshot(), this.currentStep).length === 0;
        },

        snapshot() {
            return {
                serviceId: this.serviceId,
                consultationType: this.consultationType,
                selectedDate: this.selectedDate,
                selectedTime: this.selectedTime,
                fullname: this.fullname,
                email: this.email,
                phone: this.phone,
                description: this.description,
                noeId: this.noeId,
            };
        },

        refreshIcons() {
            if (typeof window.refreshLucideIcons === 'function') {
                window.refreshLucideIcons(this.$root);
            }
        },

        clearErrors() {
            this.fieldErrors = {};
            this.stepErrors = [];
            this.dateTimeError = false;
            this.turnstileError = '';
        },

        applyErrors(errors) {
            const mapped = {};
            errors.forEach((error) => {
                mapped[error.field] = error.message;
            });
            this.fieldErrors = mapped;
            this.stepErrors = errors.map((e) => e.message);
        },

        isTabEnabled(tabId) {
            const tabIndex = TAB_ORDER.indexOf(tabId);
            return tabIndex >= 0 && tabIndex <= this.maxReachedIndex;
        },

        /**
         * @param {string} tabId
         * @param {{ force?: boolean }} [options] force=true for programmatic next/auto-advance
         */
        switchTab(tabId, options = {}) {
            const tabIndex = TAB_ORDER.indexOf(tabId);
            if (tabIndex < 0) {
                return;
            }
            if (!options.force && tabIndex > this.maxReachedIndex) {
                return;
            }
            this.clearErrors();
            this.currentStep = tabId;
            this.maxReachedIndex = Math.max(this.maxReachedIndex, tabIndex);
            if (tabId === 'confirm') {
                this.recalculatePricing();
            }
        },

        goNext() {
            if (this.currentStep === 'confirm') {
                this.requestSubmit();
                return;
            }

            if (this.currentStep === 'info') {
                const errors = validateStep(this.snapshot(), 'info');
                if (errors.length) {
                    this.applyErrors(errors);
                    return;
                }
                this.switchTab('confirm', { force: true });
                return;
            }

            const errors = validateStep(this.snapshot(), this.currentStep);
            if (errors.length) {
                this.applyErrors(errors);
                if (this.currentStep === 'appointment_details') {
                    this.dateTimeError = true;
                }
                return;
            }

            const idx = TAB_ORDER.indexOf(this.currentStep);
            if (idx < TAB_ORDER.length - 1) {
                this.switchTab(TAB_ORDER[idx + 1], { force: true });
            }
        },

        goBack() {
            const idx = TAB_ORDER.indexOf(this.currentStep);
            if (idx > 0) {
                this.switchTab(TAB_ORDER[idx - 1], { force: true });
            }
        },

        selectDuration(id, isFree) {
            this.serviceId = id;
            this.freeConsultAcknowledged = false;
            this.resetPromo();
            this.recalculatePricing();
            calendarInitedForService = null;
            calendarController?.refreshForService(id);

            if (isFree) {
                this.showFreeModal = true;
                this.$nextTick(() => this.refreshIcons());
                return;
            }

            this.autoAdvance('consultation_type');
        },

        confirmFreeConsult() {
            if (!this.freeConsultAcknowledged) {
                return;
            }
            this.showFreeModal = false;
            this.autoAdvance('consultation_type');
        },

        cancelFreeConsult() {
            this.showFreeModal = false;
            this.serviceId = null;
            this.freeConsultAcknowledged = false;
            this.recalculatePricing();
        },

        selectConsultationType(type) {
            this.consultationType = type;
            this.appointmentDetails = type;
            this.clearDateTime();
            this.autoAdvance('appointment_details');
        },

        clearDateTime() {
            this.selectedDate = null;
            this.selectedDateLabel = '';
            this.selectedTime = null;
            this.timeSlots = [];
            calendarController?.clear();
        },

        selectTimeSlot(slot) {
            if (!slot.available) {
                return;
            }
            this.selectedTime = slot.time;
            this.dateTimeError = false;
            this.autoAdvance('info');
        },

        initCalendar() {
            const container = document.getElementById('booking-calendar');
            if (!container || !this.serviceId) {
                return;
            }

            const needsInit = calendarInitedForService !== this.serviceId;
            if (needsInit) {
                calendarController?.init(container, this.serviceId, (date) => {
                    this.selectedDate = date;
                    this.selectedDateLabel = formatDateForApi(date);
                    this.selectedTime = null;
                    this.dateTimeError = false;
                });
                calendarInitedForService = this.serviceId;
            }

            if (this.selectedDate) {
                calendarController?.setSelectedDate(this.selectedDate);
                calendarController?.loadTimeSlots(this.selectedDate, this.serviceId);
            }
        },

        initTomSelect() {
            const select = document.getElementById('noe_id');
            if (!select || select.tomselect) {
                return;
            }
            tomSelectInstance = enhanceSelect(select);
            if (tomSelectInstance) {
                tomSelectInstance.on('change', (value) => {
                    this.noeId = value;
                    if (this.fieldErrors.noe_id) {
                        const next = { ...this.fieldErrors };
                        delete next.noe_id;
                        this.fieldErrors = next;
                    }
                });
                if (this.noeId) {
                    tomSelectInstance.setValue(this.noeId, true);
                }
            }
        },

        recalculatePricing() {
            this.pricing = buildPricing(this.serviceMeta, this.discountAmount);
        },

        resetPromo() {
            this.promoCode = '';
            this.promoApplied = false;
            this.discountAmount = 0;
            this.discountPercentage = 0;
            this.promoMessage = '';
            this.promoMessageType = '';
            this.recalculatePricing();
        },

        async applyPromo() {
            if (!this.allowsPromo) {
                this.promoMessage = 'Promo codes are not available for this consultation type.';
                this.promoMessageType = 'error';
                return;
            }

            const code = this.promoCode.trim();
            if (!code) {
                this.promoMessage = 'Please enter a promo code';
                this.promoMessageType = 'error';
                return;
            }

            this.applyingPromo = true;
            try {
                const response = await checkPromoCode(this.serviceId, code);
                if (response.success) {
                    const listPrice = parseFloat(this.serviceMeta?.price_aud) || 0;
                    this.discountAmount = (listPrice * response.discount_percentage) / 100;
                    this.discountPercentage = response.discount_percentage;
                    this.promoApplied = true;
                    const finalAfterPromo = Math.max(0, listPrice - this.discountAmount);
                    this.promoMessage =
                        finalAfterPromo <= 0
                            ? 'Promo code applied! Free consultation!'
                            : `Promo code applied! You saved ${formatAud(this.discountAmount)}`;
                    this.promoMessageType = 'success';
                    this.recalculatePricing();
                } else {
                    this.promoMessage = response.msg || 'Invalid promo code.';
                    this.promoMessageType = 'error';
                }
            } catch (error) {
                const status = error.response?.status;
                this.promoMessage =
                    status === 429
                        ? 'Too many attempts. Please wait before trying again.'
                        : error.response?.data?.msg || 'Invalid promo code.';
                this.promoMessageType = 'error';
            } finally {
                this.applyingPromo = false;
            }
        },

        requestSubmit() {
            const errors = validateAll(this.snapshot());
            if (errors.length) {
                this.applyErrors(errors);
                return;
            }

            this.turnstileError = '';
            if (typeof turnstile === 'undefined') {
                this.turnstileError =
                    'Security verification is not loaded. Please refresh the page.';
                return;
            }
            turnstile.execute('#booking-turnstile');
        },

        async submitWithToken(token) {
            this.loading = true;
            try {
                const payload = {
                    service_id: this.serviceId,
                    noe_id: this.noeId,
                    fullname: this.fullname,
                    email: this.email,
                    phone: this.phone,
                    date: this.selectedDateLabel,
                    time: this.selectedTime,
                    description: this.description,
                    appointment_details: this.appointmentDetails,
                    promo_code: this.promoApplied ? this.promoCode : '',
                    discount_amount: this.discountAmount,
                    discount_percentage: this.discountPercentage,
                    free_consult_acknowledged: this.serviceMeta?.is_free
                        ? this.freeConsultAcknowledged
                            ? '1'
                            : '0'
                        : '0',
                    cardName: this.fullname,
                    stripeToken: `booking_${Date.now()}`,
                    'cf-turnstile-response': token,
                    website_url: '',
                };

                const response = await submitBooking(payload);
                handleSubmitResponse(response, this.pricing.finalAmount, config);
            } catch (error) {
                const status = error.response?.status;
                let message =
                    'An error occurred while booking your appointment.';
                if (status === 429) {
                    message = 'Too many booking attempts. Please wait a moment before trying again.';
                } else if (error.response?.data?.message) {
                    message = error.response.data.message;
                } else if (error.response?.data?.errors) {
                    const errs = error.response.data.errors;
                    message = Object.values(errs).flat().join(' ');
                }
                showOverlay('error', message);
                if (typeof turnstile !== 'undefined') {
                    turnstile.reset('#booking-turnstile');
                }
            } finally {
                this.loading = false;
            }
        },

        autoAdvance(step) {
            setTimeout(() => {
                const errors = validateStep(this.snapshot(), this.currentStep);
                if (!errors.length) {
                    this.switchTab(step, { force: true });
                }
            }, 400);
        },
    };
}
