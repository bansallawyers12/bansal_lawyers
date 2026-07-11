import axios from 'axios';
import { formatAud, parseBookingConfig } from './config.js';
import { toastMsg, showOverlay } from '../shared/ui.js';

export async function checkPromoCode(serviceId, code) {
    const config = parseBookingConfig();
    const formData = new URLSearchParams();
    formData.append('promo_code', code);
    formData.append('service_id', String(serviceId));
    const { data } = await axios.post(config.endpoints.promoCheck, formData, {
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    });
    return data;
}

export async function submitBooking(payload) {
    const config = parseBookingConfig();
    const formData = new URLSearchParams();
    Object.entries(payload).forEach(([key, value]) => {
        if (value !== null && value !== undefined) {
            formData.append(key, String(value));
        }
    });
    const { data } = await axios.post(config.endpoints.storepaid, formData, {
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    });
    return data;
}

export function handleSubmitResponse(response, finalAmount, config) {
    if (!response.success) {
        showOverlay('error', response.message || 'An error occurred while booking your appointment.');
        return;
    }

    if (finalAmount <= 0) {
        showOverlay('success', response.message || 'Appointment booked successfully!');
        setTimeout(() => {
            if (response.redirect) {
                window.location.href = response.redirect;
            } else if (response.appointment_id) {
                window.location.href = `${config.baseUrl}/payment-thankyou/${response.appointment_id}`;
            } else {
                window.location.reload();
            }
        }, 1500);
        return;
    }

    if (response.payment_url) {
        window.location.href = response.payment_url;
        return;
    }

    if (response.redirect) {
        window.location.href = response.redirect;
        return;
    }

    toastMsg(response.message || 'Appointment booked successfully!', 'success');
}

export function buildPricing(serviceMeta, discountAmount = 0) {
    const baseFee = serviceMeta ? parseFloat(serviceMeta.price_aud) || 0 : 0;
    const discount = Math.max(0, parseFloat(discountAmount) || 0);
    const finalAmount = Math.max(0, baseFee - discount);
    return {
        baseFee,
        discount,
        finalAmount,
        baseLabel: formatAud(baseFee),
        finalLabel: formatAud(finalAmount),
        discountLabel: formatAud(discount),
    };
}
