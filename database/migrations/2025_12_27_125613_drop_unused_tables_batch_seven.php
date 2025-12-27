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
        // Drop unused tables from final batch
        $tablesToDrop = [
            'to_do_groups',
            'upload_checklists',
            'users',
            'user_logs',
            'user_roles',
            'user_types',
            'verify_users',
            'visa_types',
            'wallets',
            'why_chooseuses',
            'wishlists',
            'workflows',
            'workflow_stages',
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
