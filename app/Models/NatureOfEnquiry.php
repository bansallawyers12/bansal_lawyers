<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class NatureOfEnquiry extends Model
{
    use Sortable;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nature_of_enquiry';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'status',
        'created_at',
        'updated_at'
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    /**
     * Sortable columns
     *
     * @var array
     */
    public $sortable = ['id', 'title', 'status', 'created_at', 'updated_at'];
    
    /**
     * Scope to get only active nature of enquiries
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
