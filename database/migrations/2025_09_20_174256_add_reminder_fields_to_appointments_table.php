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
        if (Schema::hasTable('appointments')) {
            Schema::table('appointments', function (Blueprint $table) {
                if (!Schema::hasColumn('appointments', 'reminder_sent')) {
                    $table->boolean('reminder_sent')->default(false)->after('status');
                }
                if (!Schema::hasColumn('appointments', 'immediate_reminder_sent')) {
                    $table->boolean('immediate_reminder_sent')->default(false)->after('reminder_sent');
                }
                if (!Schema::hasColumn('appointments', 'reminder_sent_at')) {
                    $table->timestamp('reminder_sent_at')->nullable()->after('immediate_reminder_sent');
                }
                if (!Schema::hasColumn('appointments', 'immediate_reminder_sent_at')) {
                    $table->timestamp('immediate_reminder_sent_at')->nullable()->after('reminder_sent_at');
                }
                if (!Schema::hasColumn('appointments', 'notification_preferences')) {
                    $table->json('notification_preferences')->nullable()->after('immediate_reminder_sent_at');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn([
                'reminder_sent',
                'immediate_reminder_sent', 
                'reminder_sent_at',
                'immediate_reminder_sent_at',
                'notification_preferences'
            ]);
        });
    }
};
