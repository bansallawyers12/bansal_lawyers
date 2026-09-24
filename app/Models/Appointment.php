<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use Notifiable;
	use Sortable;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array  
     */
	
	
	protected $fillable = [
        'id','user_id','client_id','client_unique_id','timezone','email','noe_id','service_id','assignee','full_name','date','time','timeslot_full','title','description','invites','status','appointment_details','order_hash','related_to','created_at', 'updated_at'
    ];
   
	public $sortable = ['id', 'created_at', 'updated_at'];
	
	public function clients()
    {
        return $this->belongsTo('App\Models\Admin','client_id','id');
    }
	

    public function user()
    {
        return $this->belongsTo('App\Models\Admin','user_id','id');
    }

    public function assignee_user()
    {
        return $this->belongsTo('App\Models\Admin','assignee','id');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\BookService','service_id','id');
    }

    public function natureOfEnquiry()
    {
        return $this->belongsTo('App\Models\NatureOfEnquiry','noe_id','id');
    }

    public function payment()
    {
        return $this->hasOne(AppointmentPayment::class, 'order_hash', 'order_hash');
    }

    /**
     * Name for admin UI. Uses linked client when present so existing rows are unchanged.
     */
    public function displayClientName(): string
    {
        if ($this->clients) {
            $name = trim(($this->clients->first_name ?? '').' '.($this->clients->last_name ?? ''));
            if ($name !== '') {
                return $name;
            }
        }

        $fallback = trim((string) $this->full_name);

        return $fallback !== '' ? $fallback : 'N/A';
    }

    /**
     * Client reference for admin UI. Uses linked client id when present.
     */
    public function displayClientReference(): string
    {
        if ($this->clients && filled($this->clients->client_id)) {
            return (string) $this->clients->client_id;
        }

        if (filled($this->client_unique_id)) {
            return (string) $this->client_unique_id;
        }

        return 'N/A';
    }

    /**
     * Email for admin UI. Prefers linked client, then appointment email.
     */
    public function displayClientEmail(): ?string
    {
        if ($this->clients && filled($this->clients->email)) {
            return (string) $this->clients->email;
        }

        return filled($this->email) ? (string) $this->email : null;
    }
}
