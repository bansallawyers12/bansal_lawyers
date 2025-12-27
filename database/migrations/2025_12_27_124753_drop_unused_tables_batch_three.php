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
        // Drop unused tables from third batch
        $tablesToDrop = [
            'destinations',
            'documents',
            'document_checklists',
            'download_schedule_dates',
            'education',
            'emails',
            'email_templates',
            'enquiry_sources',
            'faqs',
            'fee_options',
            'fee_option_types',
            'fee_types',
            'followups',
            'followup_types',
            'free_downloads',
            'groups',
            'hotels',
            'income_sharings',
            'interested_services',
            'invoices',
            'invoice_details',
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
