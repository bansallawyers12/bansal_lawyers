<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Remove comparative claims from the blog post whose excerpt is reused
     * across the site, and from the ART application page.
     */
    public function up(): void
    {
        $blog = DB::table('blogs')
            ->where('slug', 'top-10-legal-services-australia-bansal-lawyers-melbourne')
            ->first();

        if ($blog) {
            $description = $blog->description ?? '';

            $replacements = [
                '<h2>Bansal Lawyers: Best Legal Service Provider in Melbourne</h2>' => '<h2>Legal Services in Australia</h2>',
                'The most trusted well established legal system which ensure to get justice on time, fair decisions, and protection of rights for individuals&rsquo; person, all families issues, and businesses related issues in Australia. If it&rsquo;s any immigration matters, matters related to family disputes, legal services in Australians plays a vital role to resolve complicated issues. In this blog, Bansal Lawyers explained you about the <strong>top 10 legal services in Australia</strong> that are most sought after, along with a special spotlight on <strong>Bansal Lawyers &mdash; regarded as one of the best law firms in Melbourne, Australia</strong>.' => 'Australia\'s legal system gives people, families, and businesses a way to resolve disputes and protect their rights. Immigration, family, criminal, property, and business issues often need legal advice. This article outlines <strong>10 common legal services in Australia</strong>, and how <strong>Bansal Lawyers in Melbourne</strong> can help with them.',
                'we specialise in complex immigration matters' => 'we advise on complex immigration matters',
                'Purchasing and part -exchange property in Australia be in need of specialist displacement to grasp contracts, settlements, and title transfers.' => 'Buying or selling property in Australia involves contracts, settlements, and title transfers.',
                '<strong>Why Choose Bansal Lawyers &ndash; Best Lawyers in Melbourne</strong>' => '<strong>How Bansal Lawyers Can Help</strong>',
                'Among the many legal service providers in Australia, <strong>Bansal Lawyers</strong> known as one of the <strong>best lawyers in Melbourne</strong>. Bansal Lawyers offers' => '<strong>Bansal Lawyers</strong> in Melbourne offers',
                'should be your go-to choose for trusted, professional, and outcome-driven legal advice.' => 'can provide clear advice on the legal issues described above.',
            ];

            $description = str_replace(array_keys($replacements), array_values($replacements), $description);

            DB::table('blogs')->where('id', $blog->id)->update([
                'description' => $description,
                'short_description' => 'Australia offers a wide range of legal services for individuals, families, and businesses, from immigration and family law to property and business matters.',
                'meta_description' => 'Common legal services in Australia include immigration, family, criminal, property, and business law. Bansal Lawyers in Melbourne advises on these matters.',
                'meta_keyword' => 'legal services in Australia, immigration lawyers Australia, family law Melbourne, criminal lawyers Melbourne, property lawyers Australia, business lawyers Melbourne, Bansal Lawyers',
                'updated_at' => now(),
            ]);
        }

        DB::table('cms_pages')
            ->where('slug', 'art-application')
            ->where('content', 'LIKE', '%specialist reports%')
            ->update([
                'content' => DB::raw("REPLACE(content, 'specialist reports', 'expert reports')"),
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        // Wording changes are not restored.
    }
};
