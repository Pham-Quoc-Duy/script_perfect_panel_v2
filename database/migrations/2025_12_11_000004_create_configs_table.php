<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            // Website Information
            $table->string('title')->default('Perfect Panel Vietnam');
            $table->text('description')->default('Perfect Panel Vietnam');
            $table->string('keywords')->nullable();
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_square')->nullable();
            $table->string('logo_facebook')->nullable();

            // Child Panel Settings
            $table->string('namesv1')->nullable();
            $table->string('namesv2')->nullable();
            $table->decimal('child_panel_cost', 15, 4)->default(0);
            $table->boolean('child_panel_status')->default(0);

            // Default Settings
            $table->string('default_landingpage')->default('default');
            $table->string('default_login')->default('default');
            $table->string('default_interface')->default('default');
            $table->string('default_theme')->default('light');
            $table->string('default_currency')->default('USD');
            $table->string('default_lang')->default('en');
            $table->integer('timezone')->default(0);

            // Announcement Settings
            $table->string('announcement_position')->default('page'); // modal, page, page_and_modal
            $table->longText('announcement_content')->nullable();

            // Terms Content
            $table->longText('terms_content')->nullable();

            // Keep Orders
            $table->text('keep_orders')->nullable();
            $table->boolean('keep_orders_status')->default(0);


            // Social Links
            $table->string('link_facebook')->nullable();
            $table->string('link_zalo')->nullable();
            $table->string('link_telegram')->nullable();
            $table->string('link_whatsapp')->nullable();

            // Affiliate Settings
            $table->boolean('affiliate_allow_convert')->default(false);
            $table->boolean('affiliate_allow_withdraw')->default(false);
            $table->decimal('affiliate_percent', 5, 2)->default(10);
            $table->decimal('affiliate_min', 15, 4)->default(0);
            $table->decimal('affiliate_max', 15, 4)->default(0);
            $table->boolean('affiliate_status')->default(true);

            // Markup rates for different customer types
            $table->decimal('markup_retail', 5, 2)->default(100);
            $table->decimal('markup_agent', 5, 2)->default(100);
            $table->decimal('markup_distributor', 5, 2)->default(100);

            // Multi-rate settings
            $table->boolean('show_multi_rate')->default(false);
            $table->decimal('min_total_deposit_child_panel', 15, 4)->default(0);
            $table->decimal('min_total_deposit_reseller', 15, 4)->default(0);

            // Scripts
            $table->text('script_header')->nullable();
            $table->text('script_css')->nullable();
            $table->text('script_footer')->nullable();

            // Telegram Bot
            $table->string('telegram_token_bot')->nullable();
            $table->string('telegram_public_chat_id')->nullable();
            $table->string('telegram_private_chat_id')->nullable();
            $table->boolean('telegram_notify_add_service')->default(false);
            $table->boolean('telegram_notify_update_service')->default(false);
            $table->boolean('telegram_notify_manual_order')->default(false);
            $table->boolean('telegram_notify_deposit')->default(false);
            $table->boolean('telegram_status')->default(false);

            // SMTP Settings
            $table->string('smtp_host')->nullable();
            $table->integer('smtp_port')->nullable();
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('smtp_from_name')->nullable();

            // Cloudflare Settings
            $table->string('cloudflare_email')->nullable();
            $table->string('cloudflare_global_key')->nullable();
            $table->string('cloudflare_account_id')->nullable();
            $table->string('cloudflare_token')->nullable();
            $table->string('cloudflare_ip_host')->nullable();

            // cPanel Settings
            $table->string('cpanel_server')->nullable();
            $table->string('cpanel_username')->nullable();
            $table->string('cpanel_password')->nullable();

            // Google OAuth Settings
            $table->boolean('module_oauth_google')->default(false);
            $table->string('google_oauth_client_id')->nullable();
            $table->string('google_oauth_client_secret')->nullable();
            $table->boolean('google_oauth_status')->default(false);

            // Simulate Order ID
            $table->integer('fake_order_step_min')->default(1);
            $table->integer('fake_order_step_max')->default(1000);
            $table->boolean('fake_order_status')->default(false);

             // Service Settings
            $table->boolean('enable_services')->default(true);
            $table->boolean('service_allow_report')->default(true);
            $table->boolean('service_require_login')->default(false);
            $table->boolean('service_average_time')->default(true);
            $table->boolean('require_confirm_service')->default(false);
            $table->boolean('check_duplicate_order_status')->default(true);
            $table->integer('check_duplicate_order_time')->default(1);

            // Domain Settings
            $table->string('domain_main')->nullable();
            $table->string('domain')->nullable();

            // Status
            $table->boolean('status')->default(true);
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
