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
        // Drop unused tables from sixth batch
        $tablesToDrop = [
            'service_fee_option_types',
            'share_invoices',
            'sliders',
            'sources',
            'subjects',
            'subject_areas',
            'sub_categories',
            'tags',
            'tasks',
            'task_logs',
            'taxes',
            'tax_rates',
            'teams',
            'templates',
            'test_scores',
            'theme_options',
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
