<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CmsPage extends Authenticatable
{
    use Notifiable;
	use Sortable;

	protected $fillable = [
        'id', 'title', 'alias', 'content', 'image', 'image_alt', 'slug', 'meta_title', 'meta_description', 'meta_keyward', 'youtube_url', 'pdf_doc', 'status', 'user_id', 'created_at', 'updated_at'
    ];
	
	public $sortable = ['id', 'title', 'created_at', 'updated_at'];
}
