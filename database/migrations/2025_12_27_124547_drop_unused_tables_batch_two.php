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
        // Drop unused tables from second batch
        $tablesToDrop = [
            'branches',
            'cashbacks',
            'categories',
            'checkin_histories',
            'checkin_logs',
            'checklists',
            'check_applications',
            'check_partners',
            'check_products',
            'cities',
            'client_phones',
            'client_service_takens',
            'coupons',
            'crm_email_templates',
            'currencies',
            'destinations',
            'documents',
            'client_monthly_rewards',
            'countries',
            'states',
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
