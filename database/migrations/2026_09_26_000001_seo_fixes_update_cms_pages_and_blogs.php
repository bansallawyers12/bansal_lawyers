<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Apply production SEO updates for CMS pages and blogs.
     */
    public function up(): void
    {
        // 1. Rename misspelled slugs in cms_pages
        $slugUpdates = [
            'assualt-charges' => [
                'slug' => 'assault-charges',
                'title' => 'Assault Charges',
            ],
            'trafic-offences' => [
                'slug' => 'traffic-offences',
                'title' => 'Traffic Offences',
            ],
            'intervenition-orders' => [
                'slug' => 'intervention-orders',
                'title' => 'Intervention Orders',
            ],
            'juridicational-error-federal-circuit-court-application' => [
                'slug' => 'jurisdictional-error-federal-circuit-court-application',
                'title' => 'Jurisdictional Error / Federal Circuit Court Application',
            ],
            'caveats-disputs-and-removal' => [
                'slug' => 'caveats-disputes-and-removal',
                'title' => 'Caveats Disputes and Removal',
            ],
        ];

        foreach ($slugUpdates as $oldSlug => $data) {
            DB::table('cms_pages')
                ->where('slug', $oldSlug)
                ->update($data);
        }

        // Deactivate backup practice areas page
        DB::table('cms_pages')
            ->where('slug', 'practice-areas-bkk')
            ->update(['status' => 0]);

        // 2. Update Practice Area Meta Titles and Descriptions
        DB::table('cms_pages')
            ->where('slug', 'family-law')
            ->update([
                'meta_description' => 'Family lawyers in Melbourne for divorce, property settlement, parenting and child custody matters. Speak to Bansal Lawyers today on 1300 226 725.',
            ]);

        DB::table('cms_pages')
            ->where('slug', 'migration-law')
            ->update([
                'meta_description' => 'Melbourne migration lawyers helping with partner, skilled and employer visas, citizenship, refusals and appeals. Book a consultation with Bansal Lawyers.',
            ]);

        DB::table('cms_pages')
            ->where('slug', 'criminal-law')
            ->update([
                'meta_description' => 'Criminal lawyers in Melbourne for assault, drug, traffic and driving offences, bail and court representation. Call Bansal Lawyers on 1300 226 725.',
            ]);

        DB::table('cms_pages')
            ->where('slug', 'commercial-law')
            ->update([
                'meta_title' => 'Commercial Lawyers Melbourne | Bansal Lawyers',
            ]);

        DB::table('cms_pages')
            ->where('slug', 'property-law')
            ->update([
                'meta_title' => 'Property Lawyers Melbourne | Bansal Lawyers',
            ]);

        // 3. Fix content typos and old links in cms_pages
        $contentReplacements = [
            'That I why' => 'That is why',
            'assualt-charges' => 'assault-charges',
            'trafic-offences' => 'traffic-offences',
            'intervenition-orders' => 'intervention-orders',
            'juridicational-error-federal-circuit-court-application' => 'jurisdictional-error-federal-circuit-court-application',
            'caveats-disputs-and-removal' => 'caveats-disputes-and-removal',
            'practice-areas-bkk' => 'practice-areas',
            'Expert legal guidance with the refined look and feel of our latest blog design.' => '',
        ];

        foreach ($contentReplacements as $search => $replace) {
            DB::table('cms_pages')
                ->where('content', 'LIKE', '%' . $search . '%')
                ->update([
                    'content' => DB::raw("REPLACE(content, '" . addslashes($search) . "', '" . addslashes($replace) . "')")
                ]);
        }

        DB::table('cms_pages')
            ->where('meta_description', 'LIKE', '%That I why%')
            ->update([
                'meta_description' => DB::raw("REPLACE(meta_description, 'That I why', 'That is why')")
            ]);

        if (Schema::hasColumn('cms_pages', 'hero_intro')) {
            DB::table('cms_pages')
                ->where('hero_intro', 'LIKE', '%refined look and feel%')
                ->update(['hero_intro' => null]);
        }

        // 4. Clean blog post 36 ('top-10-legal-services-australia-bansal-lawyers-melbourne')
        $blog36 = DB::table('blogs')
            ->where('slug', 'top-10-legal-services-australia-bansal-lawyers-melbourne')
            ->first();

        if ($blog36) {
            $cleanMetaDesc = preg_replace('/^\d+\s*/', '', $blog36->meta_description ?? '');
            $cleanMetaKey = preg_replace('/^\d+\s*/', '', $blog36->meta_keyword ?? '');

            DB::table('blogs')
                ->where('id', $blog36->id)
                ->update([
                    'title' => 'Top 10 Legal Services in Australia',
                    'meta_title' => 'Top 10 Legal Services in Australia | Bansal Lawyers',
                    'meta_description' => $cleanMetaDesc ?: 'Discover the top 10 legal services in Australia including immigration, family, criminal, property, and business law. Learn why Bansal Lawyers are trusted as the best lawyers in Melbourne for expert and reliable legal advice.',
                    'meta_keyword' => $cleanMetaKey ?: 'legal services in Australia, top legal services Australia, best lawyers in Melbourne, Bansal Lawyers Melbourne, immigration lawyers Australia, family law Melbourne, criminal lawyers Melbourne, property lawyers Australia, business lawyers Melbourne',
                ]);
        }

        // Clean any other blogs with leading test digits
        $blogs = DB::table('blogs')->get();
        foreach ($blogs as $b) {
            $updates = [];
            if (preg_match('/^\d+\s*/', $b->title)) {
                $updates['title'] = preg_replace('/^\d+\s*/', '', $b->title);
            }
            if (!empty($b->meta_title) && preg_match('/^\d+\s*/', $b->meta_title)) {
                $updates['meta_title'] = preg_replace('/^\d+\s*/', '', $b->meta_title);
            }
            if (!empty($b->meta_description) && preg_match('/^\d+\s*/', $b->meta_description)) {
                $updates['meta_description'] = preg_replace('/^\d+\s*/', '', $b->meta_description);
            }
            if (!empty($b->meta_keyword) && preg_match('/^\d+\s*/', $b->meta_keyword)) {
                $updates['meta_keyword'] = preg_replace('/^\d+\s*/', '', $b->meta_keyword);
            }
            if (!empty($updates)) {
                DB::table('blogs')->where('id', $b->id)->update($updates);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op for SEO fixes
    }
};
