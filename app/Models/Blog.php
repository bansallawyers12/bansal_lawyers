<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
// use Kyslik\ColumnSortable\Sortable;

class Blog extends Authenticatable {
    use Notifiable;
	// use Sortable;

	protected $fillable = [
        'id', 'title', 'alias', 'content', 'slug', 'image', 'description', 'parent_category', 'status', 'meta_title', 'meta_description', 'meta_keyword', 'created_at', 'updated_at'
    ];
	
	public $sortable = ['id', 'title', 'created_at', 'updated_at'];
	
	public function categorydetail()
    {
        return $this->belongsTo(\App\Models\BlogCategory::class, 'parent_category');
    }

    /**
     * Latest published posts for blog detail sidebar (cached as plain rows for Laravel 13 Redis).
     */
    public static function cachedLatestExcluding(string $slug, int $limit = 5): Collection
    {
        $cacheKey = 'latest_blogs_exclude_v2_' . $slug;

        $rows = Cache::remember($cacheKey, 1800, function () use ($slug, $limit) {
            return static::where('status', 1)
                ->where('slug', '!=', $slug)
                ->latest()
                ->take($limit)
                ->get(['id', 'title', 'slug', 'image', 'description', 'created_at'])
                ->map(fn (self $blog) => [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'slug' => $blog->slug,
                    'image' => $blog->image,
                    'description' => $blog->description,
                    'created_at' => $blog->created_at?->toDateTimeString(),
                ])
                ->all();
        });

        return static::hydrate($rows);
    }

    public static function forgetLatestExcludingCache(?string $slug = null): void
    {
        if ($slug !== null && $slug !== '') {
            Cache::forget('latest_blogs_exclude_v2_' . $slug);
        }
    }

}
