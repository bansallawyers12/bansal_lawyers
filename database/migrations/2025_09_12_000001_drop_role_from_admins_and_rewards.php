<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('admins', 'role')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }

        if (Schema::hasTable('client_monthly_rewards') && Schema::hasColumn('client_monthly_rewards', 'role')) {
            Schema::table('client_monthly_rewards', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('admins', 'role')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->integer('role')->nullable()->after('id');
            });
        }

        if (Schema::hasTable('client_monthly_rewards') && !Schema::hasColumn('client_monthly_rewards', 'role')) {
            Schema::table('client_monthly_rewards', function (Blueprint $table) {
                $table->integer('role')->nullable()->after('client_id');
            });
        }
    }
};


