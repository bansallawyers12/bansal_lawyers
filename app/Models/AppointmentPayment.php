<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppointmentPayment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_paid_appointment_payment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_hash',
        'payer_email',
        'amount',
        'currency',
        'payment_type',
        'order_date',
        'order_status',
        'notes',
        'name',
        'address',
        'country',
        'postal_code',
        'stripe_payment_intent_id',
        'payment_status',
        'stripe_payment_status',
        'stripe_payment_response'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'order_date' => 'datetime',
        'stripe_payment_response' => 'array',
    ];

    /**
     * Get the appointment that owns the payment.
     * Note: Using order_hash to link with appointments table since appointment_id column doesn't exist
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class, 'order_hash', 'order_hash');
    }

    /**
     * Scope a query to only include successful payments.
     */
    public function scopeSuccessful($query)
    {
        return $query->where('payment_status', 'Paid')
                    ->where('order_status', 'Completed');
    }

    /**
     * Scope a query to only include pending payments.
     */
    public function scopePending($query)
    {
        return $query->where('payment_status', 'Pending')
                    ->orWhere('order_status', 'Pending');
    }

    /**
     * Scope a query to only include failed payments.
     */
    public function scopeFailed($query)
    {
        return $query->where('payment_status', 'Failed')
                    ->orWhere('order_status', 'Failed');
    }

    /**
     * Get the formatted amount with currency.
     */
    public function getFormattedAmountAttribute(): string
    {
        return $this->currency . ' $' . number_format($this->amount, 2);
    }

    /**
     * Check if the payment is successful.
     */
    public function isSuccessful(): bool
    {
        return $this->payment_status === 'Paid' && $this->order_status === 'Completed';
    }

    /**
     * Check if the payment is pending.
     */
    public function isPending(): bool
    {
        return $this->payment_status === 'Pending' || $this->order_status === 'Pending';
    }

    /**
     * Check if the payment failed.
     */
    public function isFailed(): bool
    {
        return $this->payment_status === 'Failed' || $this->order_status === 'Failed';
    }
}
