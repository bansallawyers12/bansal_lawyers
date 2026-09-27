<?php

use App\Support\PracticeHubCopy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Publish the content-brief copy for the five practice hubs and add civil law.
     * Titles are the on-page H1s. Meta titles are also stored here; HomeController
     * applies the same strings at render time.
     */
    public function up(): void
    {
        foreach (PracticeHubCopy::pages() as $slug => $page) {
            $payload = [
                'title' => $page['title'],
                'content' => $page['content'],
                'meta_title' => $page['meta_title'],
                'meta_description' => $page['meta_description'],
                'meta_keyward' => $page['meta_keyward'],
                'updated_at' => now(),
            ];

            $exists = DB::table('cms_pages')->where('slug', $slug)->exists();

            if ($exists) {
                DB::table('cms_pages')->where('slug', $slug)->update($payload);
                continue;
            }

            DB::table('cms_pages')->insert($payload + [
                'service_type' => 'main',
                'service_cat_id' => null,
                'slug' => $slug,
                'image' => null,
                'image_alt' => null,
                'user_id' => 1,
                'meta_keyward' => null,
                'youtube_url' => null,
                'pdf_doc' => null,
                'created_at' => now(),
                'type' => 'other',
                'status' => 1,
            ]);
        }
    }

    public function down(): void
    {
        DB::table('cms_pages')->where('slug', 'civil-law')->delete();
    }
};
