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
        if (!Schema::hasTable('book_service_slot_per_people')) {
            Schema::create('book_service_slot_per_people', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('person_id')->default(1); // Ajay only
                $table->unsignedInteger('service_type')->default(1); // Paid only
                $table->unsignedInteger('book_service_id')->nullable();
                $table->string('start_time')->nullable();
                $table->string('end_time')->nullable();
                $table->string('weekend')->nullable(); // Comma-separated days e.g. "Sun,Sat"
                $table->text('disabledates')->nullable(); // Comma-separated dates dd/mm/YYYY or config
                $table->timestamps();

                $table->index(['person_id', 'service_type']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_service_slot_per_people');
    }
};


