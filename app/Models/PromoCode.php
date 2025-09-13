<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable = [
        'code',
        'discount_percentage',
        'status'
    ];

    protected $casts = [
        'discount_percentage' => 'decimal:2',
        'status' => 'boolean'
    ];

    /**
     * Check if the promo code is valid
     */
    public function isValid()
    {
        // Check if code is active
        if (!$this->status) {
            return false;
        }

        return true;
    }

    /**
     * Increment the usage count (placeholder for future implementation)
     */
    public function incrementUsage()
    {
        // Future implementation for usage tracking
        return true;
    }
}
