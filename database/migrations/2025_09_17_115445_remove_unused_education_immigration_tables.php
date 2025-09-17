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
        // Remove completely unused education/immigration related tables
        // Note: Excluding tables that are actually being used in the codebase
        $unusedTables = [
            'academic_requirements',
            'account_client_receipts',
            'agents',
            'airports',
            'application_activities_logs',
            'application_document_lists',
            'application_documents',
            'application_fee_option_types',
            'application_fee_options',
            'application_notes',
            // 'applications' - KEEP: referenced in AdminController.php
            'attach_files',
            'attachments',
            'banners',
            'branches',
            'cashbacks',
            'categories',
            'check_applications',
            'check_partners',
            'check_products',
            'checkin_histories',
            'checkin_logs',
            'checklists',
            'cities',
            // 'client_monthly_rewards' - KEEP: referenced in migration files
            'client_phones',
            'client_service_takens',
            'coupons',
            'destinations',
            'document_checklists',
            'documents',
            'download_schedule_dates',
            'education',
            'emails',
            // 'enquiries' - KEEP: this is a core table for the current system
            'enquiry_sources',
            'faqs',
            'fee_option_types',
            'fee_options',
            'fee_types',
            'followup_types',
            'followups',
            'free_downloads',
            'groups',
            'hotels',
            'income_sharings',
            'interested_services',
            'lead_services',
            'mail_reports',
            'markups',
            'media_images',
            'mentorings',
            'navmenus',
            'offers',
            'omrs',
            'online_forms',
            'our_offices',
            'packages',
            'partner_branches',
            'partner_emails',
            'partner_phones',
            'partner_student_invoices',
            'partner_types',
            'partners',
            'password_reset_links',
            'popups',
            'product_area_levels',
            'product_types',
            'profiles',
            'promocode_uses',
            'promotions',
            'quotation_infos',
            'quotations',
            'representing_partners',
            'reviews',
            // 'schedule_items' - KEEP: referenced in AdminController.php
            'seo_pages',
            'service_fee_option_types',
            'service_fee_options',
            'services',
            'sources',
            'sub_categories',
            'subject_areas',
            'subjects',
            'tags',
            'task_logs',
            'tasks',
            'taxes',
            'teams',
            // 'template_infos' - KEEP: referenced in AdminController.php
            'templates',
            'test_scores',
            'theme_options',
            'to_do_groups',
            'upload_checklists',
            'user_logs',
            'user_roles',
            'user_types',
            'users',
            'verify_users',
            'visa_types',
            'wallets',
            'wishlists',
            'workflow_stages',
            'workflows'
        ];

        foreach ($unusedTables as $table) {
            if (Schema::hasTable($table)) {
                Schema::dropIfExists($table);
                echo "Dropped table: {$table}\n";
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Note: This migration cannot be reversed as the tables are permanently removed
        // If you need to restore these tables, you would need to recreate them from scratch
        echo "This migration cannot be reversed. Tables have been permanently removed.\n";
    }
};
