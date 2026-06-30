<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            if (! Schema::hasColumn('admins', 'first_name')) {
                $table->string('first_name')->nullable()->after('id');
            }
            if (! Schema::hasColumn('admins', 'last_name')) {
                $table->string('last_name')->nullable()->after('first_name');
            }
            if (! Schema::hasColumn('admins', 'phone')) {
                $table->string('phone', 50)->nullable()->after('password');
            }
            if (! Schema::hasColumn('admins', 'country')) {
                $table->string('country')->nullable()->after('phone');
            }
            if (! Schema::hasColumn('admins', 'state')) {
                $table->string('state')->nullable()->after('country');
            }
            if (! Schema::hasColumn('admins', 'city')) {
                $table->string('city')->nullable()->after('state');
            }
            if (! Schema::hasColumn('admins', 'address')) {
                $table->text('address')->nullable()->after('city');
            }
            if (! Schema::hasColumn('admins', 'zip')) {
                $table->string('zip', 20)->nullable()->after('address');
            }
            if (! Schema::hasColumn('admins', 'profile_img')) {
                $table->string('profile_img')->nullable()->after('zip');
            }
            if (! Schema::hasColumn('admins', 'company_name')) {
                $table->string('company_name')->nullable()->after('profile_img');
            }
            if (! Schema::hasColumn('admins', 'company_fax')) {
                $table->string('company_fax')->nullable()->after('company_name');
            }
            if (! Schema::hasColumn('admins', 'company_website')) {
                $table->string('company_website')->nullable()->after('company_fax');
            }
            if (! Schema::hasColumn('admins', 'status')) {
                $table->unsignedTinyInteger('status')->default(1)->after('company_website');
            }
            if (! Schema::hasColumn('admins', 'is_archived')) {
                $table->unsignedTinyInteger('is_archived')->default(0)->after('status');
            }
            if (! Schema::hasColumn('admins', 'archived_on')) {
                $table->date('archived_on')->nullable()->after('is_archived');
            }
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $columns = [
                'first_name', 'last_name', 'phone', 'country', 'state', 'city',
                'address', 'zip', 'profile_img', 'company_name', 'company_fax',
                'company_website', 'status', 'is_archived', 'archived_on',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('admins', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
