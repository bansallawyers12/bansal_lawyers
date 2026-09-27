<?php

use App\Support\PracticeHubCopy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Write the Google Doc titles, keyword lists, and on-page phrases
     * onto the practice hubs already published by the content-brief migration.
     */
    public function up(): void
    {
        foreach (PracticeHubCopy::pages() as $slug => $page) {
            DB::table('cms_pages')->where('slug', $slug)->update([
                'title' => $page['title'],
                'content' => $page['content'],
                'meta_title' => $page['meta_title'],
                'meta_description' => $page['meta_description'],
                'meta_keyward' => $page['meta_keyward'],
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        // Keyword copy is replaced in place. There is no previous keyword set to restore.
    }
};
