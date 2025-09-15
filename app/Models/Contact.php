<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contact extends Authenticatable
{
    use Notifiable;
	use Sortable; 
	
	/** 
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	
	 
	protected $fillable = [
        'id', 'name', 'contact_email', 'contact_phone', 'department', 'subject', 'message', 'image', 'branch', 'fax', 'position', 'primary_contact', 'countrycode', 'user_id', 'created_at', 'updated_at'
    ]; 
  
	public $sortable = ['id', 'created_at', 'updated_at'];
 
	 // Currency functionality removed - not needed for appointment system
	 // public function currencydata() 
    // {
    //     return $this->belongsTo('App\Models\Currency','currency','id');
    // }
	
	public function company()
    {
        return $this->belongsTo('App\Models\Admin','user_id','id');
    }
	
	/*public function desmedia() 
    {
        return $this->belongsTo('App\Models\MediaImage','dest_image','id');
    }
	
	public function mypackage() 
    {
        return $this->hasMany('App\Models\Package','destination','id');
    } */

	/**
	 * Virtual accessor for email mapped to contact_email.
	 */
	public function getEmailAttribute()
	{
		return $this->attributes['contact_email'] ?? null;
	}
} 
