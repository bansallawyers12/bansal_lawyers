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
        // Add critical indexes for appointments table (most frequently queried)
        Schema::table('appointments', function (Blueprint $table) {
            $table->index(['status', 'date'], 'idx_appointments_status_date');
            $table->index(['client_id', 'status'], 'idx_appointments_client_status');
            $table->index(['date', 'time'], 'idx_appointments_date_time');
            $table->index(['service_id'], 'idx_appointments_service_id');
            $table->index(['noe_id'], 'idx_appointments_noe_id');
            $table->index(['created_at'], 'idx_appointments_created_at');
        });

        // Add indexes for blogs table (frequently accessed on frontend)
        Schema::table('blogs', function (Blueprint $table) {
            $table->index(['status', 'parent_category'], 'idx_blogs_status_category');
            $table->index(['slug', 'status'], 'idx_blogs_slug_status');
            $table->index(['created_at', 'status'], 'idx_blogs_created_status');
            $table->index(['parent_category'], 'idx_blogs_parent_category');
        });

        // Add indexes for cms_pages table
        Schema::table('cms_pages', function (Blueprint $table) {
            $table->index(['slug', 'status'], 'idx_cms_slug_status');
            $table->index(['service_cat_id'], 'idx_cms_service_cat_id');
            $table->index(['status'], 'idx_cms_status');
        });

        // Add indexes for recent_cases table
        Schema::table('recent_cases', function (Blueprint $table) {
            $table->index(['slug', 'status'], 'idx_cases_slug_status');
            $table->index(['status', 'created_at'], 'idx_cases_status_created');
            $table->index(['status'], 'idx_cases_status');
        });

        // Add indexes for testimonials table
        Schema::table('testimonials', function (Blueprint $table) {
            $table->index(['status'], 'idx_testimonials_status');
            $table->index(['status', 'created_at'], 'idx_testimonials_status_created');
        });

        // Add indexes for our_services table
        Schema::table('our_services', function (Blueprint $table) {
            $table->index(['status'], 'idx_services_status');
            $table->index(['slug', 'status'], 'idx_services_slug_status');
        });

        // Add indexes for contacts table
        Schema::table('contacts', function (Blueprint $table) {
            $table->index(['created_at'], 'idx_contacts_created_at');
            $table->index(['contact_email'], 'idx_contacts_email');
        });

        // Add indexes for enquiries table
        Schema::table('enquiries', function (Blueprint $table) {
            $table->index(['created_at'], 'idx_enquiries_created_at');
            $table->index(['email'], 'idx_enquiries_email');
        });

        // Add indexes for nature_of_enquiry table
        Schema::table('nature_of_enquiry', function (Blueprint $table) {
            $table->index(['status'], 'idx_noe_status');
        });

        // Add indexes for book_services table
        Schema::table('book_services', function (Blueprint $table) {
            $table->index(['status'], 'idx_book_services_status');
        });

        // Add indexes for blog_categories table
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->index(['status'], 'idx_blog_categories_status');
            $table->index(['parent_id'], 'idx_blog_categories_parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop indexes for appointments table
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropIndex('idx_appointments_status_date');
            $table->dropIndex('idx_appointments_client_status');
            $table->dropIndex('idx_appointments_date_time');
            $table->dropIndex('idx_appointments_service_id');
            $table->dropIndex('idx_appointments_noe_id');
            $table->dropIndex('idx_appointments_created_at');
        });

        // Drop indexes for blogs table
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropIndex('idx_blogs_status_category');
            $table->dropIndex('idx_blogs_slug_status');
            $table->dropIndex('idx_blogs_created_status');
            $table->dropIndex('idx_blogs_parent_category');
        });

        // Drop indexes for cms_pages table
        Schema::table('cms_pages', function (Blueprint $table) {
            $table->dropIndex('idx_cms_slug_status');
            $table->dropIndex('idx_cms_service_cat_id');
            $table->dropIndex('idx_cms_status');
        });

        // Drop indexes for recent_cases table
        Schema::table('recent_cases', function (Blueprint $table) {
            $table->dropIndex('idx_cases_slug_status');
            $table->dropIndex('idx_cases_status_created');
            $table->dropIndex('idx_cases_status');
        });

        // Drop indexes for testimonials table
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropIndex('idx_testimonials_status');
            $table->dropIndex('idx_testimonials_status_created');
        });

        // Drop indexes for our_services table
        Schema::table('our_services', function (Blueprint $table) {
            $table->dropIndex('idx_services_status');
            $table->dropIndex('idx_services_slug_status');
        });

        // Drop indexes for contacts table
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropIndex('idx_contacts_created_at');
            $table->dropIndex('idx_contacts_email');
        });

        // Drop indexes for enquiries table
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropIndex('idx_enquiries_created_at');
            $table->dropIndex('idx_enquiries_email');
        });

        // Drop indexes for nature_of_enquiry table
        Schema::table('nature_of_enquiry', function (Blueprint $table) {
            $table->dropIndex('idx_noe_status');
        });

        // Drop indexes for book_services table
        Schema::table('book_services', function (Blueprint $table) {
            $table->dropIndex('idx_book_services_status');
        });

        // Drop indexes for blog_categories table
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropIndex('idx_blog_categories_status');
            $table->dropIndex('idx_blog_categories_parent_id');
        });
    }
};
