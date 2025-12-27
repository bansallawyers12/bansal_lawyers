<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop unused tables from fifth batch
        $tablesToDrop = [
            'partner_phones',
            'partner_student_invoices',
            'partner_types',
            'password_reset_links',
            'popups',
            'products',
            'product_area_levels',
            'product_types',
            'profiles',
            'promocode_uses',
            'promotions',
            'quotations',
            'quotation_infos',
            'representing_partners',
            'reviews',
            'schedule_items',
            'seo_pages',
            'services',
            'service_fee_options',
            'template_infos',
        ];

        foreach ($tablesToDrop as $table) {
            if (Schema::hasTable($table)) {
                Schema::dropIfExists($table);
                echo "Dropped table: {$table}\n";
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Note: This migration cannot be reversed as the tables are permanently removed
        // These tables were unused and can be recreated from scratch if needed
        echo "This migration cannot be reversed. Tables have been permanently removed.\n";
    }
};
