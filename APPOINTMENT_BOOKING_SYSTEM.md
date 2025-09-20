# Appointment Booking System — Integration Guide

This document explains how the appointment booking system in `bansal_lawyers` works and how to copy it into another Laravel app. It covers frontend (Blade + jQuery), backend (routes, controllers, model), Stripe payment, promo codes, emails, and admin features.

## Overview

- **Booking page**: `GET /book-an-appointment` → multi-step Blade form (`resources/views/bookappointment.blade.php`)
- **Submit booking**: `POST /book-an-appointment/storepaid` (AJAX) → creates `appointments` record and returns `payment_url` when payment is required
- **Pay with Stripe**: `GET /stripe/{appointmentId}` renders payment page and `POST /stripe` completes payment and updates appointment status
- **Promo codes**: `POST /promo-code/check` calculates discount and final price
- **Admin features**: manage appointments and block dates in admin panel
- **Emails**: confirmation/notification via `App\Mail\CommonMail`

## Components

- **Routes**: `routes/web.php`
- **Controllers**:
  - `App\Http\Controllers\HomeController` (booking page, Stripe pay/confirm, date endpoints)
  - `App\Http\Controllers\AppointmentBookController` (`storepaid`, `checkpromocode`)
- **Model**: `App\Models\Appointment`
- **Views**:
  - `resources/views/bookappointment.blade.php` (booking UI + AJAX)
  - `resources/views/stripe.blade.php` (payment UI)
- **Mail**: `App\Mail\CommonMail`
- **Related models**: `App\Models\BookService`, `App\Models\PromoCode`, `App\Models\NatureOfEnquiry`, `App\Models\Admin`

## Routes

```php
Route::get('/book-an-appointment', [App\Http\Controllers\HomeController::class, 'bookappointment'])->name('bookappointment');
Route::post('/book-an-appointment/storepaid', [App\Http\Controllers\AppointmentBookController::class, 'storepaid'])->name('stripe.post');
Route::post('/promo-code/check', [App\Http\Controllers\AppointmentBookController::class, 'checkpromocode']);

Route::get('stripe/{appointmentId}', [App\Http\Controllers\HomeController::class, 'stripe']);
Route::post('stripe', [App\Http\Controllers\HomeController::class, 'stripePost'])->name('stripe.post1');

// Time/Date helper endpoints used by the UI:
Route::post('/getdatetime', [App\Http\Controllers\HomeController::class, 'getdatetime']);
Route::post('/getdisableddatetime', [App\Http\Controllers\HomeController::class, 'getdisableddatetime']);
```

## Controller Methods

- **Booking page render**:

```php
public function bookappointment()
{
    return view('bookappointment');
}
```

- **Stripe page + payment**:

```php
public function stripe($appointmentId)
{
    $appointmentInfo = \App\Models\Appointment::find($appointmentId);
    $adminInfo = $appointmentInfo ? \App\Models\Admin::find($appointmentInfo->client_id) : [];
    return view('stripe', compact(['appointmentId','appointmentInfo','adminInfo']));
}
```

```php
public function stripePost(Request $request)
{
    // Uses STRIPE_SECRET, creates Customer + PaymentIntent (AUD $150),
    // inserts into tbl_paid_appointment_payment,
    // sets appointments.status = 10 (payment success), redirects back with success flash.
}
```

- **Core booking submit (AJAX)**:

```php
class AppointmentBookController extends Controller {
    public function checkpromocode(Request $request) { /* validates code, returns payable */ }

    public function storepaid(Request $request)
    {
        // Validates presence of: service_id, noe_id, fullname, description, email, phone, date, time, appointment_details
        // Restricts to paid service: service_id == 1
        // Parses date (supports multiple formats)
        // Looks up BookService price and applies promo discount (if provided)
        // Sets status:
        //   - <= 0 payable → status 10 (Pending Appointment With Payment Success)
        //   - > 0 payable → status 5 (Pending Payment)
        // Creates Appointment and returns JSON { success, message, payment_url, appointment_id }
    }
}
```

Key `storepaid` flow details:
- Reads and normalizes date and time
- Applies promo code (percentage discount) to `BookService->price`
- If final amount ≤ 0: mark as “paid” (status 10) and skip Stripe
- Else: save appointment with status 5 and return `payment_url` `/stripe/{appointmentId}`

## Model

```php
class Appointment extends Model
{
    protected $fillable = [
        'id','user_id','client_id','timezone','email','noe_id','assinee','full_name',
        'date','time','title','description','invites','status','related_to','created_at','updated_at'
    ];

    public function clients() { return $this->belongsTo('App\\Models\\Admin','client_id','id'); }
    public function user() { return $this->belongsTo('App\\Models\\Admin','user_id','id'); }
    public function assignee_user() { return $this->belongsTo('App\\Models\\Admin','assignee','id'); }
    public function service() { return $this->belongsTo('App\\Models\\BookService','service_id','id'); }
    public function natureOfEnquiry() { return $this->belongsTo('App\\Models\\NatureOfEnquiry','noe_id','id'); }
}
```

Notes:
- The controller also sets: `client_unique_id`, `service_id`, `timeslot_full`, `appointment_details`, `order_hash`. Ensure your destination DB has these columns or adjust code accordingly.
- Check your `appointments` migration to include those fields.

## Views

- **Booking form (multi-step + AJAX submit)**:

```html
<form class="experimental-appointment-form" id="appintment_form" action="/book-an-appointment/storepaid" method="post" enctype="multipart/form-data">
  <!-- Tabs: Consultation Type, Date & Time, Your Information, Confirmation -->
</form>
```

Submit + post-submit behavior:

```javascript
$.ajax({
  url: '/book-an-appointment/storepaid',
  method: 'POST',
  data: formData,
  dataType: 'json',
  success: function(response) {
    if (response.success) {
      // If final amount <= 0 → show success and reload
      // Else → window.location = response.payment_url (Stripe page)
    }
  }
});
```

- **Stripe payment page**:

```html
<form id="payment-form" role="form" action="{{ route('stripe.post1') }}" method="post">
  @csrf
  <input type="hidden" name="appointment_id" value="{{ $appointmentId }}">
  <input type="hidden" name="customerEmail" value="{{ $adminInfo->email }}">
  <!-- Stripe Elements collects card and posts payment_method ID in stripeToken -->
  <button id="submit-button" class="pay-button">Pay $150.00 AUD</button>
</form>
```

## Frontend JavaScript Responsibilities

- Collect form data across tabs and validate fields before submission
- Hit `POST /promo-code/check` to preview final payable and update UI
- Submit to `POST /book-an-appointment/storepaid` via AJAX with CSRF token
- On success:
  - If `payable` ≤ 0: show success message and reload
  - Else: redirect to `payment_url` for Stripe checkout

Ensure that your layout includes jQuery and any required plugins the booking view relies upon.

## Promo Code Flow

- Endpoint: `POST /promo-code/check` → validates `promo_code` + `service_id`, returns `payable` and `discount_percentage`
- In `storepaid`, if `promo_code` is sent, discount is re-applied server-side before saving
- Assumes percentage discount field on `PromoCode` model

## Payments (Stripe)

- `HomeController::stripePost` sets API key from `STRIPE_SECRET`, creates Customer + PaymentIntent for AUD $150
- On success, inserts a row into `tbl_paid_appointment_payment` and updates the appointment status to 10
- Important: Create a DB table `tbl_paid_appointment_payment` in the destination app or adjust to your payment logging approach

Required env vars:
- `STRIPE_SECRET` (secret key)
- Optionally `STRIPE_KEY` for frontend if you render Elements in `stripe.blade.php`

## Emails

- Uses `App\Mail\CommonMail` to send booking notifications/confirmations.
- Adjust recipients and templates within the booking submit controller where emails are dispatched.

## Date and Time Slotting

- Disabling/slot lookups are handled by `HomeController::getdisableddatetime` and related methods
- They check existing `appointments` and apply business rules (`service_id == 1`, and certain `noe_id` values)
- Ensure these endpoints exist and are called by the booking page JS in your destination app if you need the same UX

## Admin Features (Optional)

- Admin routes include `resource('appointments', ...)` and screens for appointment management and date blocking.
- If you need admin management, bring corresponding controllers, views, and middleware configuration.

## Database Schema Checklist

Ensure your destination app has the following (adjust code or schema as needed):

- `appointments` table with at least:
  - `id`, `client_id`, `user_id`, `service_id`, `noe_id`, `full_name`, `email`, `phone`, `date`, `time`, `timeslot_full`, `description`, `appointment_details`, `status`, `order_hash`, `created_at`, `updated_at`
  - Optional: `client_unique_id`, `timezone`, `invites`, `assignee`, `related_to`
- `book_services` with `id`, `price` (string or decimal) for service 1
- `promo_codes` with `code`, `discount_percentage`, `status`
- `tbl_paid_appointment_payment` (if used) with fields referenced in `stripePost`:
  - `order_hash`, `payer_email`, `amount`, `currency`, `payment_type`, `order_date`, `name`, `stripe_payment_intent_id`, `payment_status`, `order_status`

## Copy Steps

1. **Routes**: Copy the routes above into your `routes/web.php`.
2. **Controllers**: Copy `AppointmentBookController` and the used methods from `HomeController` (`bookappointment`, `stripe`, `stripePost`, optional date helpers).
3. **Model**: Copy `App\Models\Appointment` and ensure relationships exist or adjust.
4. **Views**: Copy `resources/views/bookappointment.blade.php` and `resources/views/stripe.blade.php` and adapt layout/asset paths.
5. **Mail**: Copy `App\Mail\CommonMail` and related email views.
6. **Database**: Add/adjust migrations for tables/columns in the schema checklist.
7. **Env/Stripe**: Set `STRIPE_SECRET` (and `STRIPE_KEY` if needed for Elements).
8. **Test**:
   - Booking with no promo (paid path)
   - Booking with promo that reduces to zero (free path)
   - Stripe success updates `appointments.status` to 10 and inserts payment record
   - Admin list and date blocking (if ported)

## Business Rules and Defaults

- Only “paid appointments” are allowed: `service_id` must be 1
- Base consultation fee: `$150 AUD` (in UI and `stripePost`)
- Statuses:
  - `5` = Pending Payment
  - `10` = Pending Appointment With Payment Success
- `storepaid` supports multiple date formats and normalizes to `YYYY-MM-DD`.

## Security & Validation

- Server-side validation checks for required fields in `storepaid`; consider using a Laravel `FormRequest` for strict validation.
- CSRF tokens are required for AJAX (`X-CSRF-TOKEN`).
- Sanitize and rate-limit promo code checks if needed.

## Known Gaps to Address When Porting

- `tbl_paid_appointment_payment` migration is not included here; create it or adapt logging.
- Some fields like `client_unique_id`, `timeslot_full`, `appointment_details` must exist on your `appointments` table or be removed from assignments.
- Price parsing strips `aud`, `$`, and spaces — ensure `BookService->price` fits this assumption or switch to decimals.

