<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Paid booking (Ajay Bansal) requires a row in book_service_slot_per_people for person_id=1, service_type=1.
     * Without it, /getdatetime returns "Service configuration not found".
     */
    public function up(): void
    {
        if (! Schema::hasTable('book_service_slot_per_people')) {
            return;
        }

        $exists = DB::table('book_service_slot_per_people')
            ->where('person_id', 1)
            ->where('service_type', 1)
            ->exists();

        if ($exists) {
            return;
        }

        $now = now()->format('Y-m-d H:i:s');

        DB::table('book_service_slot_per_people')->insert([
            'person_id' => 1,
            'service_type' => 1,
            'book_service_id' => 1,
            'start_time' => '09:00',
            'end_time' => '17:00',
            'weekend' => 'Sun,Sat',
            'disabledates' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public function down(): void
    {
        // Intentionally empty: do not delete configuration that may have been edited in production.
    }
};
