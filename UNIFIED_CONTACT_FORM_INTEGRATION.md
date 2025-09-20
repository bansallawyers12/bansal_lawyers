## Unified Contact Form – Integration Guide

This guide explains how to reuse the unified Contact Us form from this project in another Laravel application. It is framework‑light (Blade + vanilla JS; no Vue/React) and supports AJAX, server‑side validation, Google reCAPTCHA, database persistence, and email notification.

### Features
- Single POST endpoint with JSON responses for AJAX and redirect+flash for non‑AJAX
- Server‑side validation and Google reCAPTCHA verification
- Persists inquiries into `contacts` and `enquiries` tables
- Sends an email notification to the site’s `MAIL_FROM_ADDRESS`
- Optional: form metadata (`form_source`, `form_variant`) for analytics

---

### Phase 1 — Backend Setup

1) Route
```php
// routes/web.php
Route::post('/contact/submit', [\App\Http\Controllers\ContactController::class, 'contactSubmit'])->name('contact.submit');
```

2) Controller
- Create `app/Http/Controllers/ContactController.php` and copy the logic from this project’s `HomeController::contactSubmit()` and `validateRecaptcha()` methods.
- Adjust namespaces/imports as needed.

Key responsibilities:
- Validate: `name`, `email`, `phone`, `subject`, `message`, `g-recaptcha-response` (+ optional `form_source`, `form_variant`)
- Verify reCAPTCHA via `services.recaptcha.secret`
- Create new `Contact` and `Enquiry` records
- Send `App\Mail\ContactUsMail` to `config('mail.from.address')`
- Return JSON on AJAX; redirect with flash otherwise

3) Models
- Contact (`app/Models/Contact.php`):
  - Important columns: `name`, `contact_email`, `contact_phone`, `subject`, `message`
  - Optional workflow: `status`, `forwarded_to`, `forwarded_at`
  - Optional accessor: `getEmailAttribute()` that maps to `contact_email`

- Enquiry (`app/Models/Enquiry.php`):
  - Important columns: `first_name`, `email`, `phone`, `subject`, `message`

4) Migrations
- Ensure these tables/columns exist in the target app. Minimal example:
```php
Schema::create('contacts', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('name');
    $table->string('contact_email');
    $table->string('contact_phone', 50)->nullable();
    $table->string('subject');
    $table->text('message');
    // Optional workflow fields
    $table->enum('status', ['unread', 'read', 'resolved', 'archived'])->default('unread');
    $table->string('forwarded_to')->nullable();
    $table->timestamp('forwarded_at')->nullable();
    $table->timestamps();
});

Schema::create('enquiries', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('first_name');
    $table->string('email');
    $table->string('phone', 50)->nullable();
    $table->string('subject');
    $table->text('message');
    $table->timestamps();
});
```

- Recommended indexes (performance/ops):
```php
Schema::table('contacts', function (Blueprint $table) {
    $table->index(['created_at'], 'idx_contacts_created_at');
    $table->index(['contact_email'], 'idx_contacts_email');
    $table->index(['status'], 'idx_contacts_status');
    $table->index(['forwarded_at'], 'idx_contacts_forwarded_at');
});

Schema::table('enquiries', function (Blueprint $table) {
    $table->index(['created_at'], 'idx_enquiries_created_at');
    $table->index(['email'], 'idx_enquiries_email');
});
```

5) Mailers
- Create `App\Mail\ContactUsMail` with a simple `build()` returning a view, e.g. `emails.contact_us`.
- Optional: `App\Mail\ContactUsCustomerMail` for user acknowledgments.

6) Config
- `.env`:
```env
MAIL_FROM_ADDRESS=info@example.com
RECAPTCHA_SECRET=your_recaptcha_secret
```
- `config/services.php`:
```php
'recaptcha' => [
    'secret' => env('RECAPTCHA_SECRET'),
],
```
- Ensure mail transport is configured (SMTP, etc.).

---

### Phase 2 — Frontend (Blade + Vanilla JS)

1) Blade form (example)
```blade
<form id="contact-form" action="{{ route('contact.submit') }}" method="POST" novalidate>
  @csrf
  <input type="text" name="name" placeholder="Your Name" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="text" name="phone" placeholder="Phone">
  <input type="text" name="subject" placeholder="Subject" required>
  <textarea name="message" placeholder="How can we help?" required></textarea>
  <input type="hidden" name="form_source" value="footer">
  <input type="hidden" name="form_variant" value="compact">
  {{-- Google reCAPTCHA widget should populate g-recaptcha-response --}}
  <button type="submit">Send</button>
</form>

<div id="contact-form-feedback" aria-live="polite"></div>
```

2) Vanilla JS (AJAX submit)
```html
<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('contact-form');
  const feedback = document.getElementById('contact-form-feedback');
  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    feedback.textContent = 'Sending...';
    const formData = new FormData(form);
    try {
      const res = await fetch(form.action, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: formData
      });
      const data = await res.json();
      if (res.ok && data.success) {
        feedback.textContent = data.message || 'Thank you! We will get back to you soon.';
        form.reset();
      } else {
        const msg = data.message || 'There were validation errors.';
        feedback.textContent = msg;
        // Optionally render field errors from data.errors
      }
    } catch (err) {
      feedback.textContent = 'Network error. Please try again.';
    }
  });
});
</script>
```

3) Google reCAPTCHA
- Add the appropriate widget (v2 Checkbox/Invisible or v3) to render and populate `g-recaptcha-response`.
- Ensure your site key is on the page and secret in the server config.

---

### Request/Response Contract (AJAX)

Request fields:
- `name`, `email`, `phone`, `subject`, `message`, `g-recaptcha-response`
- Optional: `form_source`, `form_variant`

Success (200):
```json
{ "success": true, "message": "Thank you! Your message has been sent successfully. We'll get back to you within 24 hours." }
```

Validation error (422):
```json
{ "success": false, "message": "Validation failed", "errors": { "email": ["The email must be a valid email address."] } }
```

reCAPTCHA error (422):
```json
{ "success": false, "message": "reCAPTCHA validation failed", "errors": { "g-recaptcha-response": ["Please complete the reCAPTCHA verification."] } }
```

Server error (500):
```json
{ "success": false, "message": "Sorry, there was an error sending your message. Please try again." }
```

---

### Phase 3 — Enhancements (Optional)
- Add status workflow and indexes (see migrations above)
- Customer acknowledgement email via `ContactUsCustomerMail`
- Admin tools to forward/mark as read/resolved
- Analytics using `form_source` / `form_variant`

---

### Testing Checklist
- Validation errors show correctly (both JSON and redirect)
- reCAPTCHA passes and blocks bots
- Records created in `contacts` and `enquiries`
- Email received by admin address
- Mobile/desktop responsiveness
- AJAX path and non‑AJAX fallback both work

---

### Troubleshooting
- 401/419 CSRF: ensure `@csrf` in the Blade form and same‑site cookies are accepted
- 422 Validation: check required fields and email format; inspect `errors` object
- reCAPTCHA failures: verify site key on page and `RECAPTCHA_SECRET` on server; check domain settings in Google admin
- Email not sending: verify mail driver, SMTP creds, and `MAIL_FROM_ADDRESS`


