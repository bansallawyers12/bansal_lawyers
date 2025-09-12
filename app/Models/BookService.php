<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookService extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'duration',
        'status',
        'description',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
