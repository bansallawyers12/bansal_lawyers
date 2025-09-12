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
        // Drop tables for removed models
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('activities_logs');
        Schema::dropIfExists('notes');
        Schema::dropIfExists('checkin_logs');
        Schema::dropIfExists('appointment_logs');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('invoice_details');
        Schema::dropIfExists('items');
        Schema::dropIfExists('products');
        Schema::dropIfExists('invoice_payments');
        Schema::dropIfExists('invoice_followups');
        Schema::dropIfExists('email_templates');
        Schema::dropIfExists('share_invoices');
        Schema::dropIfExists('tax_rates');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('crm_email_templates');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Recreate tables if needed (for rollback)
        // Note: This is a destructive migration, so rollback is not recommended
        // Only implement if absolutely necessary
    }
};
