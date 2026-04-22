<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'keywords', 'favicon', 'logo', 'logo_square', 'logo_facebook', 'og_image',
        'namesv1', 'namesv2',
        'default_landingpage', 'default_login', 'default_interface', 'default_theme',
        'default_currency', 'default_lang', 'timezone',
        'announcement_position', 'announcement_content', 'terms_content',
        'link_facebook', 'link_zalo', 'link_telegram', 'link_whatsapp',
        'affiliate_percent', 'affiliate_min', 'affiliate_max', 'affiliate_status',
        'affiliate_allow_withdraw', 'affiliate_min_withdraw', 'affiliate_allow_convert', 'affiliate_min_convert', 'affiliate_auto_convert',
        'child_panel_cost', 'childpanel_price',
        'markup_retail', 'markup_agent', 'markup_distributor',
        'show_multi_rate', 'min_total_deposit_child_panel', 'min_total_deposit_reseller',
        'script_header', 'script_css', 'script_footer',
        'telegram_token_bot', 'telegram_public_chat_id', 'telegram_private_chat_id', 'telegram_status',
        'telegram_notify_add_service', 'telegram_notify_update_service', 'telegram_notify_manual_order', 'telegram_notify_deposit',
        'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password', 'smtp_from_name',
        'cloudflare_email', 'cloudflare_global_key', 'cloudflare_account_id', 'cloudflare_token', 'cloudflare_ip_host',
        'domain_main', 'domain', 'status', 'keep_orders', 'notice_system',
        'create_child_panel_status', 'member_level', 'affiliate', 'module_coupon',
        'keep_cancel_orders_status', 'module_crisp_chat', 'google_analytics_status', 'module_oauth_google',
        'member_levels', 'keep_cancel_keywords',
        'google_analytics_id', 'crisp_chat_id',
        'google_oauth_client_id', 'google_oauth_client_secret',
        'enable_services', 'service_allow_report', 'service_require_login',
        'service_average_time', 'require_confirm_service',
        'check_duplicate_order_status', 'check_duplicate_order_time',
    ];

    protected $casts = [
        'affiliate_percent' => 'decimal:2', 'affiliate_min' => 'decimal:4', 'affiliate_max' => 'decimal:4',
        'affiliate_allow_withdraw' => 'boolean', 'affiliate_allow_convert' => 'boolean', 'affiliate_auto_convert' => 'boolean',
        'affiliate_min_withdraw' => 'decimal:4', 'affiliate_min_convert' => 'decimal:4',
        'child_panel_cost' => 'decimal:4', 'childpanel_price' => 'decimal:4',
        'markup_retail' => 'decimal:2', 'markup_agent' => 'decimal:2', 'markup_distributor' => 'decimal:2',
        'min_total_deposit_child_panel' => 'decimal:4', 'min_total_deposit_reseller' => 'decimal:4',
        'affiliate_status' => 'boolean', 'telegram_status' => 'boolean', 'status' => 'boolean', 'show_multi_rate' => 'boolean',
        'smtp_port' => 'integer',
        'create_child_panel_status' => 'boolean', 'member_level' => 'boolean', 'affiliate' => 'boolean',
        'module_coupon' => 'boolean', 'keep_cancel_orders_status' => 'boolean',
        'module_crisp_chat' => 'boolean', 'google_analytics_status' => 'boolean', 'module_oauth_google' => 'boolean',
        'telegram_notify_add_service' => 'boolean', 'telegram_notify_update_service' => 'boolean',
        'telegram_notify_manual_order' => 'boolean', 'telegram_notify_deposit' => 'boolean',
    ];

    protected $attributes = [
        'title' => 'Perfect Panel Vietnam', 'description' => 'Perfect Panel Vietnam',
        'default_landingpage' => 'default', 'default_login' => 'default', 'default_interface' => 'default',
        'default_theme' => 'light', 'default_currency' => 'USD', 'default_lang' => 'en', 'timezone' => 14400,
        'affiliate_percent' => 10.00, 'affiliate_min' => 0.0000, 'affiliate_max' => 0.0000, 'affiliate_status' => true,
        'child_panel_cost' => 0.0000,
        'markup_retail' => 20.00, 'markup_agent' => 10.00, 'markup_distributor' => 5.00,
        'telegram_status' => false, 'status' => true,
    ];

    public function user() { return $this->belongsTo(User::class); }

    public static function get($key, $default = null) { 
        $config = self::first(); 
        return $config ? ($config->$key ?? $default) : $default; 
    }
    
    public static function set($key, $value) { 
        $config = self::first() ?? self::create(); 
        $config->update([$key => $value]); 
        return $config; 
    }

    public function getTemplate($type) { return $this->{"default_$type"} ?? 'default'; }
    public function getLoginTemplate() { return $this->getTemplate('login'); }
    public function getInterfaceTemplate() { return $this->getTemplate('interface'); }
    public function getLandingPageTemplate() { return $this->getTemplate('landingpage'); }

    public function getSocialLinks() {
        return ['facebook' => $this->link_facebook, 'zalo' => $this->link_zalo, 
                'telegram' => $this->link_telegram, 'whatsapp' => $this->link_whatsapp];
    }

    public function getSmtpConfig() {
        return ['host' => $this->smtp_host, 'port' => $this->smtp_port, 
                'username' => $this->smtp_username, 'password' => $this->smtp_password, 
                'from_name' => $this->smtp_from_name];
    }

    public function getCloudflareConfig() {
        return [
            'email' => $this->cloudflare_email,
            'global_key' => $this->cloudflare_global_key,
            'account_id' => $this->cloudflare_account_id,
            'token' => $this->cloudflare_token,
            'ip_host' => $this->cloudflare_ip_host
        ];
    }

    public function getDomainList() {
        return $this->domain ? array_filter(array_map('trim', explode("\n", $this->domain))) : [];
    }

    public function calculatePrice($price, $type = 'retail') {
        $markup = $this->{"markup_$type"} ?? 20;
        return $price * (1 + $markup / 100);
    }

    public function calculateAffiliateCommission($amount) {
        if (!$this->affiliate_status) return 0;
        $commission = $amount * ($this->affiliate_percent / 100);
        if ($this->affiliate_min > 0 && $commission < $this->affiliate_min) return $this->affiliate_min;
        if ($this->affiliate_max > 0 && $commission > $this->affiliate_max) return $this->affiliate_max;
        return $commission;
    }

    public function isSiteActive() { return $this->status === true; }
    public function isTelegramEnabled() { return $this->telegram_status && $this->telegram_token_bot && $this->telegram_public_chat_id; }

    public function getNoticeConfig() {
        if (!$this->notice_system) return $this->getDefaultNoticeConfig();
        $config = json_decode($this->notice_system, true);
        return is_array($config) ? $config : $this->getDefaultNoticeConfig();
    }

    public function setNoticeConfig($config) {
        $this->notice_system = is_array($config) ? json_encode($config) : $config;
        return $this;
    }

    public function getDefaultNoticeConfig() {
        return [
            'enabled' => true, 'position' => 'top-right', 'duration' => 5000, 'animation' => 'slide',
            'max_notices' => 5, 'auto_dismiss' => true, 'persistence' => true, 'persistence_duration' => 3600,
            'types' => [
                'success' => ['class' => 'alert-success', 'icon' => 'fas fa-check-circle', 'color' => '#28a745', 'duration' => 5000],
                'error' => ['class' => 'alert-danger', 'icon' => 'fas fa-exclamation-circle', 'color' => '#dc3545', 'duration' => 8000],
                'warning' => ['class' => 'alert-warning', 'icon' => 'fas fa-exclamation-triangle', 'color' => '#ffc107', 'duration' => 6000],
                'info' => ['class' => 'alert-info', 'icon' => 'fas fa-info-circle', 'color' => '#17a2b8', 'duration' => 5000],
            ],
        ];
    }

    public function isNoticeSystemEnabled() { return $this->getNoticeConfig()['enabled'] ?? true; }

    public function getKeepOrders() { return $this->keep_orders ? json_decode($this->keep_orders, true) ?? [] : []; }
    public function setKeepOrders($orders) { $this->keep_orders = is_array($orders) ? json_encode($orders, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : null; return $this; }
    public function isOrderKept($orderId) { return in_array($orderId, $this->getKeepOrders()); }
    public function addKeepOrder($orderId) { $orders = $this->getKeepOrders(); if (!in_array($orderId, $orders)) { $orders[] = $orderId; $this->setKeepOrders($orders); } return $this; }
    public function removeKeepOrder($orderId) { $this->setKeepOrders(array_filter($this->getKeepOrders(), fn($id) => $id != $orderId)); return $this; }
}
