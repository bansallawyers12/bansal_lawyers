<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop tables if they exist
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('activities_logs');
        Schema::dropIfExists('notes');
        Schema::dropIfExists('checkin_logs');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Recreate tables if needed (for rollback)
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receiver_id');
            $table->unsignedBigInteger('sender_id');
            $table->string('title');
            $table->text('message');
            $table->string('type');
            $table->boolean('receiver_status')->default(false);
            $table->boolean('seen')->default(false);
            $table->timestamps();
        });

        Schema::create('activities_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('created_by');
            $table->string('activity_type');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('assigned_to');
            $table->string('type');
            $table->string('title');
            $table->text('description');
            $table->date('followup_date');
            $table->boolean('folloup')->default(false);
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('checkin_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_id');
            $table->datetime('checkin_time');
            $table->datetime('checkout_time');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }
};
