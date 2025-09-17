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
        // Remove tables that should have been dropped by previous migrations but still exist
        $tablesToDrop = [
            'activities_logs',
            'appointment_logs', 
            'crm_email_templates',
            'currencies',
            'email_templates',
            'invoices',
            'invoice_details',
            'items',
            'notes',
            'notifications',
            'products',
            'share_invoices',
            'tax_rates'
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
        // These tables should have been dropped by previous migrations anyway
        echo "This migration cannot be reversed. Tables have been permanently removed.\n";
    }
};
