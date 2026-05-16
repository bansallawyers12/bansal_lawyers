<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Public blog listing for apps / integrations.
     * Query: page, per_page (1–50, default 9), category (category slug).
     */
    public function list(Request $request): JsonResponse
    {
        $perPage = min(max((int) $request->query('per_page', 9), 1), 50);

        $blogCategories = BlogCategory::cachedForListing();

        $query = Blog::where('status', 1)->with(['categorydetail']);

        if ($request->filled('category')) {
            $categorySlug = $request->query('category');
            $category = $blogCategories->where('slug', $categorySlug)->first();
            if ($category) {
                $query->where('parent_category', $category->id);
            }
        }

        $paginator = $query->orderByDesc('id')->paginate($perPage);

        $data = collect($paginator->items())->map(function (Blog $blog) {
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'slug' => $blog->slug,
                'excerpt' => Str::limit(strip_tags((string) $blog->description), 220),
                'meta_title' => $blog->meta_title,
                'meta_description' => $blog->meta_description,
                'image_url' => $this->resolveBlogListImageUrl($blog),
                'category' => $blog->categorydetail ? [
                    'id' => $blog->categorydetail->id,
                    'name' => $blog->categorydetail->name,
                    'slug' => $blog->categorydetail->slug,
                ] : null,
                'created_at' => $blog->created_at?->toIso8601String(),
                'updated_at' => $blog->updated_at?->toIso8601String(),
                'url' => url('/blog/'.$blog->slug),
            ];
        })->values();

        return response()->json([
            'data' => $data,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
            ],
        ]);
    }

    private function resolveBlogListImageUrl(Blog $blog): string
    {
        $imagePath = ! empty($blog->image) ? 'images/blog/'.$blog->image : 'images/Blog.jpg';
        $pathInfo = pathinfo($imagePath);
        $webpPath400 = $pathInfo['dirname'].'/'.$pathInfo['filename'].'-400.webp';
        $webpPath = $pathInfo['dirname'].'/'.$pathInfo['filename'].'.webp';

        if (file_exists(public_path($webpPath400))) {
            return asset($webpPath400);
        }
        if (file_exists(public_path($webpPath))) {
            return asset($webpPath);
        }

        return asset($imagePath);
    }
}
