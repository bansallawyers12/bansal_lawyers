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
        if (Schema::hasTable('promo_codes')) {
            Schema::table('promo_codes', function (Blueprint $table) {
                if (!Schema::hasColumn('promo_codes', 'code')) {
                    $table->string('code')->unique()->after('id');
                }
                if (!Schema::hasColumn('promo_codes', 'discount_percentage')) {
                    $table->decimal('discount_percentage', 5, 2)->after('code');
                }
                if (!Schema::hasColumn('promo_codes', 'status')) {
                    $table->boolean('status')->default(true)->after('discount_percentage');
                }
                if (!Schema::hasColumn('promo_codes', 'description')) {
                    $table->text('description')->nullable()->after('status');
                }
                if (!Schema::hasColumn('promo_codes', 'expires_at')) {
                    $table->timestamp('expires_at')->nullable()->after('description');
                }
                if (!Schema::hasColumn('promo_codes', 'usage_limit')) {
                    $table->integer('usage_limit')->nullable()->after('expires_at');
                }
                if (!Schema::hasColumn('promo_codes', 'used_count')) {
                    $table->integer('used_count')->default(0)->after('usage_limit');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promo_codes', function (Blueprint $table) {
            $table->dropColumn(['code', 'discount_percentage', 'status', 'description', 'expires_at', 'usage_limit', 'used_count']);
        });
    }
};