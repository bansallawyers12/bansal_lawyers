<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

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

    /**
     * Categories for blog listings (cached as plain rows; hydrate avoids fragile serialized Eloquent collections).
     */
    public static function cachedForListing(): Collection
    {
        $rows = Cache::remember('blog_categories_v2', 3600, function () {
            return static::where('status', 1)
                ->orderBy('name', 'asc')
                ->get(['id', 'name', 'slug'])
                ->map(fn (self $c) => [
                    'id' => $c->id,
                    'name' => $c->name,
                    'slug' => $c->slug,
                ])
                ->all();
        });

        return static::hydrate($rows);
    }
}
