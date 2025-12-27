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
        // Drop unused tables from first batch
        $tablesToDrop = [
            'academic_requirements',
            'account_client_receipts',
            'activities_logs',
            'agents',
            'airports',
            'application_activities_logs',
            'application_documents',
            'application_document_lists',
            'application_fee_options',
            'application_fee_option_types',
            'application_notes',
            'appointment_logs',
            'attach_files',
            'attachments',
            'banners',
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
