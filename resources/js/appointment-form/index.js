import '../lucide-init.js';
import Alpine from 'alpinejs';
import axios from 'axios';
import { bookingForm } from './booking-form.js';

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
if (csrfToken) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
}
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['Accept'] = 'application/json';

Alpine.data('bookingForm', bookingForm);
window.Alpine = Alpine;
Alpine.start();
