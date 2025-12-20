<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment - Bansal Lawyers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .payment-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            background: white;
        }
        .payment-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .payment-header h1 {
            color: #1B4D89;
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .payment-amount {
            font-size: 1.5rem;
            color: #28a745;
            font-weight: bold;
        }
        .stripe-element {
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            margin: 10px 0;
            background: white;
        }
        .stripe-element--focus {
            border-color: #1B4D89;
            box-shadow: 0 0 0 3px rgba(27, 77, 137, 0.1);
        }
        .stripe-element--invalid {
            border-color: #dc3545;
        }
        .pay-button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #1B4D89, #2c5aa0);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .pay-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(27, 77, 137, 0.3);
        }
        .pay-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        .success-message {
            color: #28a745;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>
</head>
<body style="background: #f8f9fa;">

<div class="container">
    <div class="payment-container">
        <div class="payment-header">
            <h1>Appointment Payment</h1>
            <div class="payment-amount">$150.00 AUD</div>
            <div class="alert alert-warning text-center" style="margin-top: 20px; background-color: #fff3cd; border-color: #ffc107; color: #856404;">
                <strong>Your payment is Pending.</strong><br>
                Please pay your payment by filling below stripe payment form.
            </div>
            <p class="text-muted" style="margin-top: 15px;">Secure payment powered by Stripe</p>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger text-center">
                <p>{{ Session::get('error') }}</p>
            </div>
        @endif

        <form id="payment-form" role="form" action="{{ route('stripe.post1') }}" method="post">
            @csrf
            <input type="hidden" name="appointment_id" value="{{ $appointmentId }}">
            <input type="hidden" name="customerEmail" value="{{ is_object($adminInfo) ? $adminInfo->email : '' }}">
            
            <div class="form-group">
                <label for="cardholder-name">Name on Card</label>
                <input type="text" id="cardholder-name" name="cardName" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="card-element">Card Details</label>
                <div id="card-element" class="stripe-element">
                    <!-- Stripe Elements will create form elements here -->
                </div>
                <div id="card-errors" class="error-message"></div>
            </div>

            <button id="submit-button" class="pay-button">
                <span id="button-text">Pay $150.00 AUD</span>
                <span id="spinner" style="display: none;">Processing...</span>
            </button>
        </form>
    </div>
</div>

<script>
// Set your publishable key
const stripe = Stripe('{{ config('services.stripe.key') }}');

// Create an instance of Elements
const elements = stripe.elements();

// Create an instance of the card Element
const cardElement = elements.create('card', {
    style: {
        base: {
            fontSize: '16px',
            color: '#424770',
            '::placeholder': {
                color: '#aab7c4',
            },
        },
        invalid: {
            color: '#9e2146',
        },
    },
});

// Mount the card Element
cardElement.mount('#card-element');

// Handle real-time validation errors from the card Element
cardElement.on('change', function(event) {
    const displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Handle form submission
const form = document.getElementById('payment-form');
form.addEventListener('submit', async (event) => {
    event.preventDefault();

    const submitButton = document.getElementById('submit-button');
    const buttonText = document.getElementById('button-text');
    const spinner = document.getElementById('spinner');

    // Disable the submit button
    submitButton.disabled = true;
    buttonText.style.display = 'none';
    spinner.style.display = 'inline';

    // Get the cardholder name
    const cardholderName = document.getElementById('cardholder-name').value;

    // Create payment method
    const {error, paymentMethod} = await stripe.createPaymentMethod({
        type: 'card',
        card: cardElement,
        billing_details: {
            name: cardholderName,
        },
    });

    if (error) {
        // Show error to customer
        const errorElement = document.getElementById('card-errors');
        errorElement.textContent = error.message;
        
        // Re-enable the submit button
        submitButton.disabled = false;
        buttonText.style.display = 'inline';
        spinner.style.display = 'none';
    } else {
        // Add the payment method ID to the form
        const hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', paymentMethod.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
});
</script>
</body>
</html>
