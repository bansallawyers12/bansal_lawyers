<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BlogCategory extends Authenticatable {
    use Notifiable;

	protected $fillable = [
        'id', 'name', 'slug', 'parent_id', 'status', 'created_at', 'updated_at'
    ];
	
	public $sortable = ['id', 'name', 'created_at', 'updated_at'];
	
	public function subcategory()
    {
        return $this->hasMany(\App\Models\BlogCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\BlogCategory::class, 'parent_id');
    }
}
