<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookServiceDisableSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_service_id',
        'book_service_slot_per_person_id',
        'disabledates',
        'slots',
        'block_all',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'disabledates' => 'date',
    ];
}
