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
        Schema::table('promo_codes', function (Blueprint $table) {
            $table->string('code')->unique()->after('id');
            $table->decimal('discount_percentage', 5, 2)->after('code');
            $table->boolean('status')->default(true)->after('discount_percentage');
            $table->text('description')->nullable()->after('status');
            $table->timestamp('expires_at')->nullable()->after('description');
            $table->integer('usage_limit')->nullable()->after('expires_at');
            $table->integer('used_count')->default(0)->after('usage_limit');
        });
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