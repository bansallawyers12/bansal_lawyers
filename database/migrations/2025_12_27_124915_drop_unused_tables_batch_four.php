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
        // Drop unused tables from fourth batch
        $tablesToDrop = [
            'invoice_followups',
            'invoice_payments',
            'invoice_schedules',
            'items',
            'lead_services',
            'mail_reports',
            'markups',
            'media_images',
            'mentorings',
            'navmenus',
            'notes',
            'notifications',
            'offers',
            'omrs',
            'online_forms',
            'our_offices',
            'packages',
            'partners',
            'partner_branches',
            'partner_emails',
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
