<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class BookServiceSlotPerPerson extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'person_id',
        'service_type',
        'book_service_id',
        'start_time',
        'end_time',
        'weekend',
        'disabledates',
        'created_at',
        'updated_at'
    ];
}
