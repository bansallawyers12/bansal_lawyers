<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Align stored titles with page headings, and point internal links at their final URLs.
     */
    public function up(): void
    {
        $titles = [
            'about' => 'About Bansal Lawyers | Melbourne Law Firm',
            'case' => 'Recent Case Law Updates | Bansal Lawyers',
            'family-violence-orders' => 'Family Law Mediation and Dispute Resolution | Bansal Lawyers',
            'personal-law' => 'Personal Injury Law | Bansal Lawyers',
            'conveyancing' => 'Conveyancing Lawyers in Melbourne | Bansal Lawyers',
            'property-settlement' => 'Property Settlement Lawyers in Melbourne | Bansal Lawyers',
        ];

        foreach ($titles as $slug => $metaTitle) {
            DB::table('cms_pages')->where('slug', $slug)->update(['meta_title' => $metaTitle]);
        }

        $blogSlugs = DB::table('blogs')->whereNotNull('slug')->pluck('slug')->all();
        $cmsSlugs = DB::table('cms_pages')->whereNotNull('slug')->pluck('slug')->all();
        $blogOnly = array_values(array_diff($blogSlugs, $cmsSlugs));

        $this->rewriteColumn('cms_pages', 'content', $blogOnly);
        $this->rewriteColumn('blogs', 'description', $blogOnly);
    }

    public function down(): void
    {
        // Stored copy and links are not restored.
    }

    private function rewriteColumn(string $table, string $column, array $blogSlugs): void
    {
        $rows = DB::table($table)
            ->where($column, 'like', '%bansallawyers.com.au%')
            ->orWhere($column, 'like', '%/immigration-law%')
            ->get(['id', $column]);

        foreach ($rows as $row) {
            $html = $row->{$column};
            if (! is_string($html) || $html === '') {
                continue;
            }

            $updated = str_replace(
                'https://bansallawyers.com.au',
                'https://www.bansallawyers.com.au',
                $html
            );
            $updated = str_replace('/immigration-law', '/migration-law', $updated);

            foreach ($blogSlugs as $slug) {
                $updated = preg_replace(
                    '#https://www\.bansallawyers\.com\.au/(?!blog/)'.preg_quote($slug, '#').'(?=["\'\s\#\?]|$)#',
                    'https://www.bansallawyers.com.au/blog/'.$slug,
                    $updated
                );
            }

            if ($updated !== $html) {
                DB::table($table)->where('id', $row->id)->update([$column => $updated]);
            }
        }
    }
};
