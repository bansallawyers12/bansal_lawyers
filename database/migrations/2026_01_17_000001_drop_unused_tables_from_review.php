<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tablesToDrop = [
            'countries',
            'home_contents',
            'our_services',
            'settings',
            'states',
            'testimonials',
            'website_settings',
        ];

        foreach ($tablesToDrop as $table) {
            if (Schema::hasTable($table)) {
                Schema::drop($table);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Intentionally left empty: tables were identified as unused.
        // Recreate manually if needed.
    }
};
