<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookServiceSlotPerPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'service_type',
        'book_service_id',
        'created_at',
        'updated_at'
    ];
}
