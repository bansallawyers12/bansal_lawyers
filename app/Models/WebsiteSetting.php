<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class WebsiteSetting extends Authenticatable
{
    use Notifiable;

	protected $fillable = [
        'id', 'phone', 'ofc_timing', 'email', 'logo', 
        'date_format', 'time_format', 'created_at', 'updated_at'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
