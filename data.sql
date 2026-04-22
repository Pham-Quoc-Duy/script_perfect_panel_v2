-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 22, 2026 lúc 03:48 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mydb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `activity` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`activity`)),
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `type`, `activity`, `domain`, `created_at`) VALUES
(1, 1, 'login', '\"{\\\"ip_address\\\":\\\"127.0.0.1\\\",\\\"user_agent\\\":\\\"Mozilla\\\\\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\\\\\/537.36 (KHTML, like Gecko) Chrome\\\\\\/147.0.0.0 Safari\\\\\\/537.36\\\"}\"', '127.0.0.1', '2026-04-15 15:50:21'),
(2, 1, 'login', '\"{\\\"ip_address\\\":\\\"127.0.0.1\\\",\\\"user_agent\\\":\\\"Mozilla\\\\\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\\\\\/537.36 (KHTML, like Gecko) Chrome\\\\\\/147.0.0.0 Safari\\\\\\/537.36\\\"}\"', '127.0.0.1', '2026-04-16 02:59:35'),
(3, 1, 'login', '\"{\\\"ip_address\\\":\\\"127.0.0.1\\\",\\\"user_agent\\\":\\\"Mozilla\\\\\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\\\\\/537.36 (KHTML, like Gecko) Chrome\\\\\\/147.0.0.0 Safari\\\\\\/537.36\\\"}\"', '127.0.0.1', '2026-04-16 10:55:34'),
(4, 1, 'login', '\"{\\\"ip_address\\\":\\\"127.0.0.1\\\",\\\"user_agent\\\":\\\"Mozilla\\\\\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\\\\\/537.36 (KHTML, like Gecko) Chrome\\\\\\/147.0.0.0 Safari\\\\\\/537.36\\\"}\"', '127.0.0.1', '2026-04-17 04:57:32'),
(5, 1, 'login', '\"{\\\"ip_address\\\":\\\"127.0.0.1\\\",\\\"user_agent\\\":\\\"Mozilla\\\\\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\\\\\/537.36 (KHTML, like Gecko) Chrome\\\\\\/147.0.0.0 Safari\\\\\\/537.36\\\"}\"', '127.0.0.1', '2026-04-17 09:49:14'),
(6, 1, 'login', '\"{\\\"ip_address\\\":\\\"127.0.0.1\\\",\\\"user_agent\\\":\\\"Mozilla\\\\\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\\\\\/537.36 (KHTML, like Gecko) Chrome\\\\\\/147.0.0.0 Safari\\\\\\/537.36\\\"}\"', '127.0.0.1', '2026-04-17 19:39:52'),
(7, 1, 'login', '\"{\\\"ip_address\\\":\\\"127.0.0.1\\\",\\\"user_agent\\\":\\\"Mozilla\\\\\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\\\\\/537.36 (KHTML, like Gecko) Chrome\\\\\\/147.0.0.0 Safari\\\\\\/537.36\\\"}\"', '127.0.0.1', '2026-04-18 05:23:40'),
(8, 1, 'login', '\"{\\\"ip_address\\\":\\\"127.0.0.1\\\",\\\"user_agent\\\":\\\"Mozilla\\\\\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\\\\\/537.36 (KHTML, like Gecko) Chrome\\\\\\/147.0.0.0 Safari\\\\\\/537.36\\\"}\"', '127.0.0.1', '2026-04-18 11:10:56'),
(9, 1, 'login', '\"{\\\"ip_address\\\":\\\"127.0.0.1\\\",\\\"user_agent\\\":\\\"Mozilla\\\\\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\\\\\/537.36 (KHTML, like Gecko) Chrome\\\\\\/147.0.0.0 Safari\\\\\\/537.36\\\"}\"', '127.0.0.1', '2026-04-18 20:52:52'),
(10, 1, 'login', '\"{\\\"ip_address\\\":\\\"127.0.0.1\\\",\\\"user_agent\\\":\\\"Mozilla\\\\\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\\\\\/537.36 (KHTML, like Gecko) Chrome\\\\\\/147.0.0.0 Safari\\\\\\/537.36\\\"}\"', '127.0.0.1', '2026-04-20 13:18:43'),
(11, 1, 'login', '\"{\\\"ip_address\\\":\\\"127.0.0.1\\\",\\\"user_agent\\\":\\\"Mozilla\\\\\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\\\\\/537.36 (KHTML, like Gecko) Chrome\\\\\\/147.0.0.0 Safari\\\\\\/537.36\\\"}\"', '127.0.0.1', '2026-04-21 06:28:33'),
(12, 1, 'login', '\"{\\\"ip_address\\\":\\\"127.0.0.1\\\",\\\"user_agent\\\":\\\"Mozilla\\\\\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\\\\\/537.36 (KHTML, like Gecko) Chrome\\\\\\/147.0.0.0 Safari\\\\\\/537.36\\\"}\"', '127.0.0.1', '2026-04-21 06:28:38'),
(13, 1, 'login', '\"{\\\"ip_address\\\":\\\"127.0.0.1\\\",\\\"user_agent\\\":\\\"Mozilla\\\\\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\\\\\/537.36 (KHTML, like Gecko) Chrome\\\\\\/147.0.0.0 Safari\\\\\\/537.36\\\"}\"', '127.0.0.1', '2026-04-21 16:31:14'),
(14, 1, 'login', '\"{\\\"ip_address\\\":\\\"127.0.0.1\\\",\\\"user_agent\\\":\\\"Mozilla\\\\\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\\\\\/537.36 (KHTML, like Gecko) Chrome\\\\\\/147.0.0.0 Safari\\\\\\/537.36\\\"}\"', '127.0.0.1', '2026-04-22 12:27:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `affiliates`
--

CREATE TABLE `affiliates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referrer_id` bigint(20) UNSIGNED NOT NULL,
  `referred_id` bigint(20) UNSIGNED NOT NULL,
  `referral_code` varchar(255) DEFAULT NULL,
  `commission_rate` decimal(5,4) NOT NULL DEFAULT 0.0000,
  `total_earned` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `total_orders` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `orders_count` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `first_order_at` timestamp NULL DEFAULT NULL,
  `last_order_at` timestamp NULL DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `api_providers`
--

CREATE TABLE `api_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `api_key` varchar(255) NOT NULL,
  `rate_api` varchar(255) DEFAULT NULL,
  `balance` decimal(15,8) NOT NULL DEFAULT 0.00000000,
  `fixed_decimal` varchar(255) NOT NULL DEFAULT '4',
  `warning` tinyint(1) NOT NULL DEFAULT 1,
  `currency` varchar(255) NOT NULL DEFAULT 'USD',
  `note` text DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `api_providers`
--

INSERT INTO `api_providers` (`id`, `name`, `type`, `link`, `api_key`, `rate_api`, `balance`, `fixed_decimal`, `warning`, `currency`, `note`, `position`, `status`, `created_at`, `updated_at`, `domain`) VALUES
(1, 'smmkay.com', 'api', 'https://smmkay.com/api/v2', 'd50584c0ef20199192a5e285b21250a8', '1', 1.36931000, '4', 0, 'USD', NULL, 0, 1, '2026-04-15 15:51:54', '2026-04-15 15:52:29', '127.0.0.1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `platform_id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `image` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `platform_id`, `name`, `image`, `position`, `status`, `created_at`, `updated_at`, `domain`) VALUES
(1, 1, '{\"en\":\"Like\"}', 'fa-brands fa-facebook', 2, 1, '2026-04-15 15:54:05', '2026-04-15 15:54:22', '127.0.0.1'),
(2, 1, '{\"en\":\"Sub\"}', 'fa-brands fa-facebook', 1, 1, '2026-04-15 15:54:19', '2026-04-15 15:54:22', '127.0.0.1'),
(3, 1, '{\"en\":\"1\"}', 'fa-brands fa-facebook', 3, 1, '2026-04-15 17:17:22', '2026-04-15 17:17:22', '127.0.0.1'),
(4, 1, '{\"en\":\"32112132\"}', 'fa-brands fa-facebook', 4, 1, '2026-04-15 17:19:52', '2026-04-15 17:19:52', '127.0.0.1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `child_panels`
--

CREATE TABLE `child_panels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `domain` varchar(255) NOT NULL,
  `domain_panel` varchar(255) NOT NULL,
  `total_orders` int(11) NOT NULL DEFAULT 0,
  `total_services` int(11) NOT NULL DEFAULT 0,
  `total_users` int(11) NOT NULL DEFAULT 0,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `access` varchar(255) NOT NULL DEFAULT 'child',
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`settings`)),
  `status` enum('pending','completed','suspended') NOT NULL DEFAULT 'pending',
  `last_sync_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `configs`
--

CREATE TABLE `configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'Perfect Panel Vietnam',
  `description` text NOT NULL DEFAULT 'Perfect Panel Vietnam',
  `keywords` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `logo_square` varchar(255) DEFAULT NULL,
  `logo_facebook` varchar(255) DEFAULT NULL,
  `namesv1` varchar(255) DEFAULT NULL,
  `namesv2` varchar(255) DEFAULT NULL,
  `child_panel_cost` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `child_panel_status` tinyint(1) NOT NULL DEFAULT 0,
  `default_landingpage` varchar(255) NOT NULL DEFAULT 'default',
  `default_login` varchar(255) NOT NULL DEFAULT 'default',
  `default_interface` varchar(255) NOT NULL DEFAULT 'default',
  `default_theme` varchar(255) NOT NULL DEFAULT 'light',
  `default_currency` varchar(255) NOT NULL DEFAULT 'USD',
  `default_lang` varchar(255) NOT NULL DEFAULT 'en',
  `timezone` int(11) NOT NULL DEFAULT 0,
  `announcement_position` varchar(255) NOT NULL DEFAULT 'page',
  `announcement_content` longtext DEFAULT NULL,
  `terms_content` longtext DEFAULT NULL,
  `keep_orders` text DEFAULT NULL,
  `keep_orders_status` tinyint(1) NOT NULL DEFAULT 0,
  `link_facebook` varchar(255) DEFAULT NULL,
  `link_zalo` varchar(255) DEFAULT NULL,
  `link_telegram` varchar(255) DEFAULT NULL,
  `link_whatsapp` varchar(255) DEFAULT NULL,
  `affiliate_allow_convert` tinyint(1) NOT NULL DEFAULT 0,
  `affiliate_allow_withdraw` tinyint(1) NOT NULL DEFAULT 0,
  `affiliate_percent` decimal(5,2) NOT NULL DEFAULT 10.00,
  `affiliate_min` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `affiliate_max` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `affiliate_status` tinyint(1) NOT NULL DEFAULT 1,
  `markup_retail` decimal(5,2) NOT NULL DEFAULT 100.00,
  `markup_agent` decimal(5,2) NOT NULL DEFAULT 100.00,
  `markup_distributor` decimal(5,2) NOT NULL DEFAULT 100.00,
  `show_multi_rate` tinyint(1) NOT NULL DEFAULT 0,
  `min_total_deposit_child_panel` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `min_total_deposit_reseller` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `script_header` text DEFAULT NULL,
  `script_css` text DEFAULT NULL,
  `script_footer` text DEFAULT NULL,
  `telegram_token_bot` varchar(255) DEFAULT NULL,
  `telegram_public_chat_id` varchar(255) DEFAULT NULL,
  `telegram_private_chat_id` varchar(255) DEFAULT NULL,
  `telegram_notify_add_service` tinyint(1) NOT NULL DEFAULT 0,
  `telegram_notify_update_service` tinyint(1) NOT NULL DEFAULT 0,
  `telegram_notify_manual_order` tinyint(1) NOT NULL DEFAULT 0,
  `telegram_notify_deposit` tinyint(1) NOT NULL DEFAULT 0,
  `telegram_status` tinyint(1) NOT NULL DEFAULT 0,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` int(11) DEFAULT NULL,
  `smtp_username` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `smtp_from_name` varchar(255) DEFAULT NULL,
  `cloudflare_email` varchar(255) DEFAULT NULL,
  `cloudflare_global_key` varchar(255) DEFAULT NULL,
  `cloudflare_account_id` varchar(255) DEFAULT NULL,
  `cloudflare_token` varchar(255) DEFAULT NULL,
  `cloudflare_ip_host` varchar(255) DEFAULT NULL,
  `cpanel_server` varchar(255) DEFAULT NULL,
  `cpanel_username` varchar(255) DEFAULT NULL,
  `cpanel_password` varchar(255) DEFAULT NULL,
  `module_oauth_google` tinyint(1) NOT NULL DEFAULT 0,
  `google_oauth_client_id` varchar(255) DEFAULT NULL,
  `google_oauth_client_secret` varchar(255) DEFAULT NULL,
  `google_oauth_status` tinyint(1) NOT NULL DEFAULT 0,
  `fake_order_step_min` int(11) NOT NULL DEFAULT 1,
  `fake_order_step_max` int(11) NOT NULL DEFAULT 1000,
  `fake_order_status` tinyint(1) NOT NULL DEFAULT 0,
  `domain_main` varchar(255) DEFAULT NULL,
  `enable_services` tinyint(1) NOT NULL DEFAULT 1,
  `service_allow_report` tinyint(1) NOT NULL DEFAULT 1,
  `service_require_login` tinyint(1) NOT NULL DEFAULT 1,
  `service_average_time` tinyint(1) NOT NULL DEFAULT 1,
  `require_confirm_service` tinyint(1) NOT NULL DEFAULT 1,
  `check_duplicate_order_status` tinyint(1) NOT NULL DEFAULT 1,
  `check_duplicate_order_time` tinyint(1) NOT NULL DEFAULT 1,
  `domain` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `configs`
--

INSERT INTO `configs` (`id`, `user_id`, `title`, `description`, `keywords`, `favicon`, `logo`, `logo_square`, `logo_facebook`, `namesv1`, `namesv2`, `child_panel_cost`, `child_panel_status`, `default_landingpage`, `default_login`, `default_interface`, `default_theme`, `default_currency`, `default_lang`, `timezone`, `announcement_position`, `announcement_content`, `terms_content`, `keep_orders`, `keep_orders_status`, `link_facebook`, `link_zalo`, `link_telegram`, `link_whatsapp`, `affiliate_allow_convert`, `affiliate_allow_withdraw`, `affiliate_percent`, `affiliate_min`, `affiliate_max`, `affiliate_status`, `markup_retail`, `markup_agent`, `markup_distributor`, `show_multi_rate`, `min_total_deposit_child_panel`, `min_total_deposit_reseller`, `script_header`, `script_css`, `script_footer`, `telegram_token_bot`, `telegram_public_chat_id`, `telegram_private_chat_id`, `telegram_notify_add_service`, `telegram_notify_update_service`, `telegram_notify_manual_order`, `telegram_notify_deposit`, `telegram_status`, `smtp_host`, `smtp_port`, `smtp_username`, `smtp_password`, `smtp_from_name`, `cloudflare_email`, `cloudflare_global_key`, `cloudflare_account_id`, `cloudflare_token`, `cloudflare_ip_host`, `cpanel_server`, `cpanel_username`, `cpanel_password`, `module_oauth_google`, `google_oauth_client_id`, `google_oauth_client_secret`, `google_oauth_status`, `fake_order_step_min`, `fake_order_step_max`, `fake_order_status`, `domain_main`, `enable_services`, `service_allow_report`, `service_require_login`, `service_average_time`, `require_confirm_service`, `check_duplicate_order_status`, `check_duplicate_order_time`, `domain`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'SMM Panel', 'Hệ thống quản lý dịch vụ mạng xã hội', NULL, NULL, NULL, NULL, NULL, '1', '2', 1.0000, 0, 'default', 'default', '4', 'light', 'USD', 'en', 14400, 'page', NULL, NULL, '[\"Invalid service\"]', 1, NULL, NULL, NULL, NULL, 0, 0, 10.00, 0.0000, 0.0000, 1, 20.00, 10.00, 5.00, 0, 0.0000, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 1, 1000, 0, '127.0.0.1', 1, 0, 0, 1, 0, 1, 1, '127.0.0.1', 1, '2026-04-15 15:50:19', '2026-04-21 17:30:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `currency`
--

CREATE TABLE `currency` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `exchange_rate` decimal(15,8) NOT NULL DEFAULT 1.00000000,
  `name` varchar(255) NOT NULL,
  `sync` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `symbol_position` enum('before','after') NOT NULL DEFAULT 'before',
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `currency`
--

INSERT INTO `currency` (`id`, `code`, `symbol`, `exchange_rate`, `name`, `sync`, `status`, `symbol_position`, `domain`, `created_at`, `updated_at`) VALUES
(1, 'USD', '$', 1.00000000, 'US Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(2, 'AED', 'د.إ', 3.67000000, 'United Arab Emirates Dirham', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(3, 'AFN', '؋', 64.50000000, 'Afghan Afghani', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(4, 'ALL', 'L', 81.30000000, 'Albanian Lek', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(5, 'AMD', '֏', 374.00000000, 'Armenian Dram', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(6, 'ANG', 'ƒ', 1.79000000, 'Netherlands Antillean Guilder', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(7, 'AOA', 'Kz', 924.00000000, 'Angolan Kwanza', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(8, 'ARS', '$', 1364.00000000, 'Argentine Peso', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(9, 'AUD', 'A$', 1.40000000, 'Australian Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(10, 'AWG', 'ƒ', 1.79000000, 'Aruban Florin', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(11, 'AZN', '₼', 1.70000000, 'Azerbaijani Manat', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(12, 'BAM', 'КМ', 1.66000000, 'Bosnia-Herzegovina Convertible Mark', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(13, 'BBD', '$', 2.00000000, 'Barbadian Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(14, 'BDT', '৳', 123.00000000, 'Bangladeshi Taka', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(15, 'BGN', 'лв', 1.66000000, 'Bulgarian Lev', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(16, 'BHD', '.د.ب', 0.37600000, 'Bahraini Dinar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(17, 'BIF', 'FBu', 2977.00000000, 'Burundian Franc', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(18, 'BMD', '$', 1.00000000, 'Bermudan Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(19, 'BND', '$', 1.27000000, 'Brunei Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(20, 'BOB', '$b', 6.92000000, 'Bolivian Boliviano', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(21, 'BRL', 'R$', 4.99000000, 'Brazilian Real', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(22, 'BSD', '$', 1.00000000, 'Bahamian Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(23, 'BTN', 'Nu.', 93.40000000, 'Bhutanese Ngultrum', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(24, 'BWP', 'P', 13.60000000, 'Botswanan Pula', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(25, 'BYN', 'Br', 2.83000000, 'Belarusian Ruble', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(26, 'BZD', 'BZ$', 2.00000000, 'Belize Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(27, 'CAD', 'C$', 1.37000000, 'Canadian Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(28, 'CDF', 'FC', 2305.00000000, 'Congolese Franc', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(29, 'CHF', 'CHF', 0.78170000, 'Swiss Franc', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(30, 'CLF', 'CLF', 0.02244000, 'CLF', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(31, 'CLP', '$', 887.00000000, 'Chilean Peso', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(32, 'CNH', 'CNH', 6.82000000, 'CNH', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(33, 'CNY', '¥', 6.83000000, 'Chinese Yuan', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(34, 'COP', '$', 3580.00000000, 'Colombian Peso', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(35, 'CRC', '₡', 460.00000000, 'Costa Rican Colón', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(36, 'CUP', '₱', 24.00000000, 'Cuban Peso', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(37, 'CVE', '$', 93.50000000, 'Cape Verdean Escudo', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(38, 'CZK', 'Kč', 20.60000000, 'Czech Republic Koruna', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(39, 'DJF', 'Fdj', 178.00000000, 'Djiboutian Franc', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(40, 'DKK', 'kr', 6.33000000, 'Danish Krone', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(41, 'DOP', 'RD$', 59.60000000, 'Dominican Peso', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(42, 'DZD', 'دج', 132.00000000, 'Algerian Dinar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(43, 'EGP', '£', 52.00000000, 'Egyptian Pound', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(44, 'ERN', 'Nfk', 15.00000000, 'Eritrean Nakfa', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(45, 'ETB', 'Br', 156.00000000, 'Ethiopian Birr', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(46, 'EUR', '€', 0.84750000, 'Euro', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(47, 'FJD', '$', 2.20000000, 'Fijian Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(48, 'FKP', '£', 0.73710000, 'Falkland Islands Pound', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(49, 'FOK', 'FOK', 6.33000000, 'FOK', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(50, 'GBP', '£', 0.73710000, 'British Pound Sterling', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(51, 'GEL', '₾', 2.69000000, 'Georgian Lari', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(52, 'GGP', '£', 0.73710000, 'Guernsey Pound', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(53, 'GHS', '¢', 11.10000000, 'Ghanaian Cedi', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(54, 'GIP', '£', 0.73710000, 'Gibraltar Pound', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(55, 'GMD', 'D', 74.20000000, 'Gambian Dalasi', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(56, 'GNF', 'FG', 8767.00000000, 'Guinean Franc', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(57, 'GTQ', 'Q', 7.65000000, 'Guatemalan Quetzal', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(58, 'GYD', '$', 209.00000000, 'Guyanaese Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(59, 'HKD', 'HK$', 7.83000000, 'Hong Kong Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(60, 'HNL', 'L', 26.60000000, 'Honduran Lempira', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(61, 'HRK', 'kn', 6.39000000, 'Croatian Kuna', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(62, 'HTG', 'G', 131.00000000, 'Haitian Gourde', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(63, 'HUF', 'Ft', 308.00000000, 'Hungarian Forint', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(64, 'IDR', 'Rp', 17159.00000000, 'Indonesian Rupiah', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(65, 'ILS', '₪', 3.00000000, 'Israeli New Sheqel', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(66, 'IMP', '£', 0.73710000, 'Manx pound', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(67, 'INR', '₹', 93.40000000, 'Indian Rupee', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(68, 'IQD', 'ع.د', 1310.00000000, 'Iraqi Dinar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(69, 'IRR', '﷼', 1078720.00000000, 'Iranian Rial', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(70, 'ISK', 'kr', 122.00000000, 'Icelandic Króna', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(71, 'JEP', '£', 0.73710000, 'Jersey Pound', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(72, 'JMD', 'J$', 158.00000000, 'Jamaican Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(73, 'JOD', 'JD', 0.70900000, 'Jordanian Dinar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(74, 'JPY', '¥', 159.00000000, 'Japanese Yen', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(75, 'KES', 'KSh', 129.00000000, 'Kenyan Shilling', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(76, 'KGS', 'лв', 87.50000000, 'Kyrgystani Som', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(77, 'KHR', '៛', 4014.00000000, 'Cambodian Riel', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(78, 'KID', 'KID', 1.40000000, 'KID', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(79, 'KMF', 'CF', 417.00000000, 'Comorian Franc', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(80, 'KRW', '₩', 1475.00000000, 'South Korean Won', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(81, 'KWD', 'KD', 0.30840000, 'Kuwaiti Dinar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(82, 'KYD', '$', 0.83330000, 'Cayman Islands Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(83, 'KZT', '₸', 474.00000000, 'Kazakhstani Tenge', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(84, 'LAK', '₭', 21996.00000000, 'Laotian Kip', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(85, 'LBP', '£', 89500.00000000, 'Lebanese Pound', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(86, 'LKR', '₨', 316.00000000, 'Sri Lankan Rupee', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(87, 'LRD', '$', 184.00000000, 'Liberian Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(88, 'LSL', 'M', 16.40000000, 'Lesotho Loti', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(89, 'LYD', 'LD', 6.33000000, 'Libyan Dinar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(90, 'MAD', 'MAD', 9.25000000, 'Moroccan Dirham', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(91, 'MDL', 'lei', 17.10000000, 'Moldovan Leu', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(92, 'MGA', 'Ar', 4144.00000000, 'Malagasy Ariary', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(93, 'MKD', 'ден', 52.30000000, 'Macedonian Denar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(94, 'MMK', 'K', 2100.00000000, 'Myanma Kyat', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(95, 'MNT', '₮', 3591.00000000, 'Mongolian Tugrik', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(96, 'MOP', 'MOP$', 8.07000000, 'Macanese Pataca', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(97, 'MRU', 'UM', 40.10000000, 'Mauritanian Ouguiya', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(98, 'MUR', '₨', 46.30000000, 'Mauritian Rupee', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(99, 'MVR', 'Rf', 15.50000000, 'Maldivian Rufiyaa', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(100, 'MWK', 'MK', 1739.00000000, 'Malawian Kwacha', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(101, 'MXN', '$', 17.30000000, 'Mexican Peso', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(102, 'MYR', 'RM', 3.95000000, 'Malaysian Ringgit', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(103, 'MZN', 'MT', 63.70000000, 'Mozambican Metical', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(104, 'NAD', '$', 16.40000000, 'Namibian Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(105, 'NGN', '₦', 1346.00000000, 'Nigerian Naira', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(106, 'NIO', 'C$', 36.80000000, 'Nicaraguan Córdoba', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(107, 'NOK', 'kr', 9.41000000, 'Norwegian Krone', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(108, 'NPR', '₨', 150.00000000, 'Nepalese Rupee', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(109, 'NZD', 'NZ$', 1.69000000, 'New Zealand Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(110, 'OMR', '﷼', 0.38450000, 'Omani Rial', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(111, 'PAB', 'B/.', 1.00000000, 'Panamanian Balboa', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(112, 'PEN', 'S/.', 3.41000000, 'Peruvian Nuevo Sol', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(113, 'PGK', 'K', 4.37000000, 'Papua New Guinean Kina', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(114, 'PHP', '₱', 60.10000000, 'Philippine Peso', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(115, 'PKR', '₨', 279.00000000, 'Pakistani Rupee', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(116, 'PLN', 'zł', 3.59000000, 'Polish Zloty', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(117, 'PYG', 'Gs', 6396.00000000, 'Paraguayan Guarani', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(118, 'QAR', '﷼', 3.64000000, 'Qatari Rial', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(119, 'RON', 'lei', 4.32000000, 'Romanian Leu', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(120, 'RSD', 'Дин.', 99.60000000, 'Serbian Dinar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(121, 'RUB', '₽', 75.50000000, 'Russian Ruble', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(122, 'RWF', 'R₣', 1460.00000000, 'Rwandan Franc', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(123, 'SAR', '﷼', 3.75000000, 'Saudi Riyal', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(124, 'SBD', '$', 8.02000000, 'Solomon Islands Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(125, 'SCR', '₨', 14.50000000, 'Seychellois Rupee', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(126, 'SDG', 'ج.س.', 544.00000000, 'Sudanese Pound', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(127, 'SEK', 'kr', 9.17000000, 'Swedish Krona', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(128, 'SGD', 'S$', 1.27000000, 'Singapore Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(129, 'SHP', '£', 0.73710000, 'Saint Helena Pound', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(130, 'SLE', 'Le', 24.70000000, 'Sierra Leonean Leone', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(131, 'SLL', 'Le', 24662.00000000, 'Sierra Leonean Leone (Old)', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(132, 'SOS', 'S', 572.00000000, 'Somali Shilling', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(133, 'SRD', '$', 37.50000000, 'Surinamese Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(134, 'SSP', '£', 4607.00000000, 'South Sudanese Pound', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(135, 'STN', 'Db', 20.80000000, 'São Tomé and Príncipe Dobra', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(136, 'SYP', '£', 114.00000000, 'Syrian Pound', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(137, 'SZL', 'E', 16.40000000, 'Swazi Lilangeni', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(138, 'THB', '฿', 32.00000000, 'Thai Baht', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(139, 'TJS', 'SM', 9.49000000, 'Tajikistani Somoni', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(140, 'TMT', 'T', 3.50000000, 'Turkmenistani Manat', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(141, 'TND', 'د.ت', 2.88000000, 'Tunisian Dinar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(142, 'TOP', 'T$', 2.37000000, 'Tongan Paʻanga', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(143, 'TRY', '₺', 44.70000000, 'Turkish Lira', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(144, 'TTD', 'TT$', 6.78000000, 'Trinidad and Tobago Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(145, 'TVD', '$', 1.40000000, 'Tuvaluan Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(146, 'TWD', 'NT$', 31.60000000, 'New Taiwan Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(147, 'TZS', 'TSh', 2598.00000000, 'Tanzanian Shilling', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(148, 'UAH', '₴', 43.50000000, 'Ukrainian Hryvnia', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(149, 'UGX', 'USh', 3696.00000000, 'Ugandan Shilling', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(150, 'UYU', '$U', 40.20000000, 'Uruguayan Peso', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(151, 'UZS', 'лв', 12197.00000000, 'Uzbekistan Som', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(152, 'VES', 'Bs', 480.00000000, 'Venezuelan Bolívar Soberano', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(153, 'VND', '₫', 26240.00000000, 'Vietnamese Dong', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(154, 'VUV', 'VT', 119.00000000, 'Vanuatu Vatu', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(155, 'WST', 'WS$', 2.70000000, 'Samoan Tala', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(156, 'XAF', 'FCFA', 556.00000000, 'CFA Franc BEAC', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(157, 'XCD', '$', 2.70000000, 'East Caribbean Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(158, 'XCG', 'XCG', 1.79000000, 'XCG', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(159, 'XDR', 'SDR', 0.72750000, 'Special Drawing Rights', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(160, 'XOF', 'CFA', 556.00000000, 'CFA Franc BCEAO', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(161, 'XPF', '₣', 101.00000000, 'CFP Franc', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(162, 'YER', '﷼', 239.00000000, 'Yemeni Rial', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(163, 'ZAR', 'R', 16.40000000, 'South African Rand', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(164, 'ZMW', 'ZK', 19.30000000, 'Zambian Kwacha', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(165, 'ZWG', 'ZWG', 25.20000000, 'ZWG', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28'),
(166, 'ZWL', 'Z$', 25.20000000, 'Zimbabwean Dollar', 1, 1, 'before', '127.0.0.1', '2026-04-16 04:27:28', '2026-04-16 04:27:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('spin','box') NOT NULL DEFAULT 'spin',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `max_spins_per_day` int(11) NOT NULL DEFAULT 1,
  `max_spins_total` int(11) NOT NULL DEFAULT 0,
  `rewards` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`rewards`)),
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `event_spins`
--

CREATE TABLE `event_spins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reward_name` varchar(255) NOT NULL,
  `reward_amount` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `flag`, `status`, `created_at`, `updated_at`, `domain`) VALUES
(2, 'Tiếng Việt', 'vi', 'fi fi-vn', 1, '2026-04-21 07:54:55', '2026-04-21 07:54:55', '127.0.0.1'),
(3, 'English', 'en', 'fi fi-us', 1, '2026-04-21 07:54:55', '2026-04-21 07:54:55', '127.0.0.1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2025_01_13_130000_create_activity_logs_table', 1),
(4, '2025_12_10_075057_create_tickets_table', 1),
(5, '2025_12_11_000000_create_platforms_table', 1),
(6, '2025_12_11_000001_create_categories_table', 1),
(8, '2025_12_11_000003_create_api_providers_table', 1),
(9, '2025_12_11_000004_create_configs_table', 1),
(10, '2025_12_11_000011_create_payment_methods_table', 1),
(11, '2025_12_11_000012_create_payments_table', 1),
(12, '2025_12_11_000013_create_orders_table', 1),
(13, '2025_12_11_000014_create_affiliates_table', 1),
(14, '2025_12_15_064148_create_languages_table', 1),
(15, '2025_12_22_080000_create_currency_table', 1),
(16, '2025_12_30_000000_create_ticket_messages_table', 1),
(17, '2026_01_17_000000_create_events_table', 1),
(18, '2026_01_23_190911_create_child_panels_table', 1),
(20, '2026_03_28_000001_create_product_categories_table', 1),
(21, '2026_03_28_000002_create_product_groups_table', 1),
(23, '2026_03_28_000004_create_product_goods_table', 1),
(24, '2026_03_28_194917_create_news_table', 1),
(25, '2026_04_02_140418_create_product_orders_table', 1),
(26, '2025_12_11_000002_create_services_table', 2),
(27, '2025_12_10_075040_create_transactions_table', 3),
(28, '2026_03_28_000003_create_products_table', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) NOT NULL,
  `comment` longtext DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `rate` decimal(15,8) NOT NULL DEFAULT 4.00000000,
  `charge` decimal(15,8) NOT NULL DEFAULT 4.00000000,
  `total` decimal(15,8) NOT NULL DEFAULT 4.00000000,
  `start_count` int(11) NOT NULL DEFAULT 0,
  `remains` int(11) NOT NULL DEFAULT 0,
  `orders_api` varchar(255) DEFAULT NULL,
  `service_api` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `provider_name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'default',
  `refill` tinyint(1) NOT NULL DEFAULT 0,
  `refill_status` enum('pending','rejected','completed') DEFAULT NULL,
  `cancel` tinyint(1) NOT NULL DEFAULT 0,
  `cancel_status` enum('pending','rejected','completed') DEFAULT NULL,
  `dripfeed` tinyint(1) NOT NULL DEFAULT 0,
  `ticket` varchar(255) DEFAULT NULL,
  `ticket_status` enum('processing','completed') DEFAULT NULL,
  `loop_quantity` int(11) DEFAULT NULL,
  `loop_spacing` int(11) DEFAULT NULL,
  `schedule_time` timestamp NULL DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `success_time` timestamp NULL DEFAULT NULL,
  `note` text DEFAULT NULL,
  `reaction` varchar(255) DEFAULT NULL,
  `status` enum('awaiting','pending','processing','in_progress','completed','partial','canceled','failed') NOT NULL DEFAULT 'pending',
  `currency` varchar(255) NOT NULL DEFAULT 'USD',
  `order_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`order_data`)),
  `response_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`response_data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `service_id`, `link`, `comment`, `quantity`, `rate`, `charge`, `total`, `start_count`, `remains`, `orders_api`, `service_api`, `provider_id`, `provider_name`, `type`, `refill`, `refill_status`, `cancel`, `cancel_status`, `dripfeed`, `ticket`, `ticket_status`, `loop_quantity`, `loop_spacing`, `schedule_time`, `start_time`, `success_time`, `note`, `reaction`, `status`, `currency`, `order_data`, `response_data`, `created_at`, `updated_at`, `domain`) VALUES
(1, 1, 2, 'http://127.0.0.1:8000/clear-view-cache', NULL, 100, 0.05000000, 0.00500000, 0.00500000, 0, 100, NULL, NULL, NULL, NULL, 'normal', 0, NULL, 0, NULL, 0, 'canceled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"Shopee Live Stream Views [ Max 100K ] | Only Thailand Link \\ud83c\\uddf9\\ud83c\\udded | 90 Minutes\\\"},\\\"service_id\\\":2,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"http:\\/\\/127.0.0.1:8000\\/clear-view-cache\\\",\\\"quantity\\\":\\\"100\\\",\\\"rate\\\":0.05,\\\"charge\\\":0.005000000000000001,\\\"total\\\":0.005000000000000001,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\"}\"', NULL, '2026-04-17 14:45:04', '2026-04-18 05:30:06', '127.0.0.1'),
(2, 1, 3, 'http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=mydb&table=services', NULL, 100, 0.11000000, 0.22000000, 0.01100000, 111, 0, '2037843', '1138', '1', 'smmkay.com', 'normal', 1, NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'completed', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar\\/Video | Refill 7 Day | 500 - 2K\\/Day \\u26d4\\u267b\\ufe0f\\u26a1\\ufe0f\\\"},\\\"service_id\\\":3,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"http:\\/\\/localhost\\/phpmyadmin\\/index.php?route=\\/sql&pos=0&db=mydb&table=services\\\",\\\"quantity\\\":\\\"100\\\",\\\"rate\\\":0.11,\\\"charge\\\":0.011000000000000001,\\\"total\\\":0.011000000000000001,\\\"refill\\\":true,\\\"cancel\\\":true,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\"}\"', '\"{\\\"order\\\":2037843}\"', '2026-04-17 14:48:35', '2026-04-17 20:15:34', '127.0.0.1'),
(4, 1, 3, 'http://scamer.vn/install.php', NULL, 101, 0.11000000, 0.22000000, 0.01111000, 111, 0, '2037843', '11111', '1', 'smmkay.com', 'normal', 1, NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'completed', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar\\/Video | Refill 7 Day | 500 - 2K\\/Day \\u26d4\\u267b\\ufe0f\\u26a1\\ufe0f\\\"},\\\"service_id\\\":3,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"http:\\/\\/scamer.vn\\/install.php\\\",\\\"quantity\\\":\\\"101\\\",\\\"rate\\\":0.11,\\\"charge\\\":0.01111,\\\"total\\\":0.01111,\\\"refill\\\":true,\\\"cancel\\\":true,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\",\\\"api_error\\\":\\\"Invalid service\\\",\\\"error_status\\\":\\\"kept_error\\\",\\\"api_response\\\":{\\\"error\\\":\\\"Invalid service\\\"},\\\"created_at\\\":\\\"2026-04-17T22:19:52+07:00\\\"}\"', '\"{\\\"error\\\":\\\"Invalid service\\\"}\"', '2026-04-17 15:19:52', '2026-04-17 20:43:27', '127.0.0.1'),
(5, 1, 3, 'http://127.0.0.1:8000/admin/orders21321312', NULL, 100, 0.11000000, 0.01100000, 0.01100000, 0, 100, NULL, '11111', '1', 'smmkay.com', 'normal', 1, NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'failed', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar\\/Video | Refill 7 Day | 500 - 2K\\/Day \\u26d4\\u267b\\ufe0f\\u26a1\\ufe0f\\\"},\\\"service_id\\\":3,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders21321312\\\",\\\"quantity\\\":\\\"100\\\",\\\"rate\\\":0.11,\\\"charge\\\":0.011000000000000001,\\\"total\\\":0.011000000000000001,\\\"refill\\\":true,\\\"cancel\\\":true,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\",\\\"api_error\\\":\\\"Invalid service\\\",\\\"error_status\\\":\\\"kept_error\\\",\\\"api_response\\\":{\\\"error\\\":\\\"Invalid service\\\"},\\\"created_at\\\":\\\"2026-04-17T22:31:58+07:00\\\"}\"', '\"{\\\"error\\\":\\\"Invalid service\\\"}\"', '2026-04-17 15:31:58', '2026-04-17 15:31:58', '127.0.0.1'),
(6, 1, 3, 'http://127.0.0.1:8000/admin/orders', NULL, 100, 0.11000000, 0.01100000, 0.01100000, 0, 100, NULL, '11111', '1', 'smmkay.com', 'normal', 1, NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'failed', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar\\/Video | Refill 7 Day | 500 - 2K\\/Day \\u26d4\\u267b\\ufe0f\\u26a1\\ufe0f\\\"},\\\"service_id\\\":3,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\\\",\\\"quantity\\\":\\\"100\\\",\\\"rate\\\":0.11,\\\"charge\\\":0.011000000000000001,\\\"total\\\":0.011000000000000001,\\\"refill\\\":true,\\\"cancel\\\":true,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\",\\\"api_error\\\":\\\"Invalid service\\\",\\\"error_status\\\":\\\"kept_error\\\",\\\"api_response\\\":{\\\"error\\\":\\\"Invalid service\\\"},\\\"created_at\\\":\\\"2026-04-17T22:32:08+07:00\\\"}\"', '\"{\\\"error\\\":\\\"Invalid service\\\"}\"', '2026-04-17 15:32:08', '2026-04-17 15:32:08', '127.0.0.1'),
(7, 1, 3, 'http://127.0.0.1:8000/admin/orders', NULL, 1091, 0.11000000, 0.12001000, 0.12001000, 0, 1091, NULL, '11111', '1', 'smmkay.com', 'normal', 1, NULL, 1, NULL, 0, 'speedup', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'failed', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar\\/Video | Refill 7 Day | 500 - 2K\\/Day \\u26d4\\u267b\\ufe0f\\u26a1\\ufe0f\\\"},\\\"service_id\\\":3,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\\\",\\\"quantity\\\":\\\"1091\\\",\\\"rate\\\":0.11,\\\"charge\\\":0.12000999999999999,\\\"total\\\":0.12000999999999999,\\\"refill\\\":true,\\\"cancel\\\":true,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\",\\\"api_error\\\":\\\"Invalid service\\\",\\\"error_status\\\":\\\"kept_error\\\",\\\"api_response\\\":{\\\"error\\\":\\\"Invalid service\\\"},\\\"created_at\\\":\\\"2026-04-17T22:32:24+07:00\\\"}\"', '\"{\\\"error\\\":\\\"Invalid service\\\"}\"', '2026-04-17 15:32:24', '2026-04-18 05:51:37', '127.0.0.1'),
(8, 1, 3, 'http://127.0.0.1:8000/admin/orders', NULL, 102, 0.11000000, 0.01122000, 0.01122000, 0, 102, '2038307', '11111', '1', 'smmkay.com', 'normal', 1, NULL, 1, NULL, 0, 'canceled', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'in_progress', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar\\/Video | Refill 7 Day | 500 - 2K\\/Day \\u26d4\\u267b\\ufe0f\\u26a1\\ufe0f\\\"},\\\"service_id\\\":3,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\\\",\\\"quantity\\\":\\\"102\\\",\\\"rate\\\":0.11,\\\"charge\\\":0.011219999999999999,\\\"total\\\":0.011219999999999999,\\\"refill\\\":true,\\\"cancel\\\":true,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\",\\\"api_error\\\":\\\"Invalid service\\\",\\\"error_status\\\":\\\"kept_error\\\",\\\"api_response\\\":{\\\"error\\\":\\\"Invalid service\\\"},\\\"created_at\\\":\\\"2026-04-18T02:40:30+07:00\\\"}\"', '\"{\\\"error\\\":\\\"Invalid service\\\"}\"', '2026-04-17 19:40:30', '2026-04-18 05:30:05', '127.0.0.1'),
(9, 1, 1, 'http://localhost/phpmyadmin/index.php?route=/table/structure&db=mydb&table=transactions', NULL, 100, 0.00040000, 0.00004000, 0.00004000, 0, 100, '2049212', '1061', '1', 'smmkay.com', 'normal', 1, NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"Twitter Tweet Profile Visits | UltraFast \\/ Day 500K \\u26a1 | 365 Days Guaranteed \\u267b\\ufe0f\\\"},\\\"service_id\\\":1,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"http:\\/\\/localhost\\/phpmyadmin\\/index.php?route=\\/table\\/structure&db=mydb&table=transactions\\\",\\\"quantity\\\":\\\"100\\\",\\\"rate\\\":0.0004,\\\"charge\\\":4.0e-5,\\\"total\\\":4.0e-5,\\\"refill\\\":true,\\\"cancel\\\":true,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\"}\"', '\"{\\\"order\\\":2049212}\"', '2026-04-18 06:09:51', '2026-04-18 06:09:51', '127.0.0.1'),
(13, 1, 1, 'http://localhost/phpmyadmin/index.php?route=/database/structure&db=mydb', NULL, 100, 0.00040000, 0.00004000, 0.00004000, 0, 100, '2049610', '1061', '1', 'smmkay.com', 'normal', 1, NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"Twitter Tweet Profile Visits | UltraFast \\/ Day 500K \\u26a1 | 365 Days Guaranteed \\u267b\\ufe0f\\\"},\\\"service_id\\\":1,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"http:\\/\\/localhost\\/phpmyadmin\\/index.php?route=\\/database\\/structure&db=mydb\\\",\\\"quantity\\\":\\\"100\\\",\\\"rate\\\":0.0004,\\\"charge\\\":4.0e-5,\\\"total\\\":4.0e-5,\\\"refill\\\":true,\\\"cancel\\\":true,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\"}\"', '\"{\\\"order\\\":2049610}\"', '2026-04-18 06:39:15', '2026-04-18 06:39:15', '127.0.0.1'),
(14, 1, 3, 'http://127.0.0.1:8000/admin/orders', NULL, 100, 0.11000000, 0.01100000, 0.01100000, 0, 100, NULL, '11111', '1', 'smmkay.com', 'normal', 1, NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'failed', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar\\/Video | Refill 7 Day | 500 - 2K\\/Day \\u26d4\\u267b\\ufe0f\\u26a1\\ufe0f\\\"},\\\"service_id\\\":3,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\\\",\\\"quantity\\\":\\\"100\\\",\\\"rate\\\":0.11,\\\"charge\\\":0.011000000000000001,\\\"total\\\":0.011000000000000001,\\\"refill\\\":true,\\\"cancel\\\":true,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\",\\\"api_error\\\":\\\"Invalid service\\\",\\\"error_status\\\":\\\"kept_error\\\",\\\"api_response\\\":{\\\"error\\\":\\\"Invalid service\\\"},\\\"created_at\\\":\\\"2026-04-20T20:33:52+07:00\\\"}\"', '\"{\\\"error\\\":\\\"Invalid service\\\"}\"', '2026-04-20 13:33:52', '2026-04-20 13:33:52', '127.0.0.1'),
(15, 1, 3, 'http://127.0.0.1:8000/admin/orders', NULL, 100, 0.11000000, 0.01100000, 0.01100000, 0, 100, NULL, '11111', '1', 'smmkay.com', 'normal', 1, NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'failed', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar\\/Video | Refill 7 Day | 500 - 2K\\/Day \\u26d4\\u267b\\ufe0f\\u26a1\\ufe0f\\\"},\\\"service_id\\\":3,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\\\",\\\"quantity\\\":\\\"100\\\",\\\"rate\\\":0.11,\\\"charge\\\":0.011000000000000001,\\\"total\\\":0.011000000000000001,\\\"refill\\\":true,\\\"cancel\\\":true,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\",\\\"api_error\\\":\\\"Invalid service\\\",\\\"error_status\\\":\\\"kept_error\\\",\\\"api_response\\\":{\\\"error\\\":\\\"Invalid service\\\"},\\\"created_at\\\":\\\"2026-04-20T20:34:14+07:00\\\"}\"', '\"{\\\"error\\\":\\\"Invalid service\\\"}\"', '2026-04-20 13:34:14', '2026-04-20 13:34:14', '127.0.0.1'),
(16, 1, 3, 'https://smmkay.com/orders', NULL, 100, 0.11000000, 0.01100000, 0.01100000, 0, 100, '2091180', '1138', '1', 'smmkay.com', 'normal', 1, NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar\\/Video | Refill 7 Day | 500 - 2K\\/Day \\u26d4\\u267b\\ufe0f\\u26a1\\ufe0f\\\"},\\\"service_id\\\":3,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"https:\\/\\/smmkay.com\\/orders\\\",\\\"quantity\\\":\\\"100\\\",\\\"rate\\\":0.11,\\\"charge\\\":0.011000000000000001,\\\"total\\\":0.011000000000000001,\\\"refill\\\":true,\\\"cancel\\\":true,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\"}\"', '\"{\\\"order\\\":2091180}\"', '2026-04-20 13:36:37', '2026-04-20 13:36:37', '127.0.0.1'),
(17, 1, 3, 'http://127.0.0.1:8000/admin/orders/failed', NULL, 100, 0.11000000, 0.01100000, 0.01100000, 0, 100, '2091197', '1138', '1', 'smmkay.com', 'normal', 1, NULL, 0, 'pending', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar\\/Video | Refill 7 Day | 500 - 2K\\/Day \\u26d4\\u267b\\ufe0f\\u26a1\\ufe0f\\\"},\\\"service_id\\\":3,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\\/failed\\\",\\\"quantity\\\":\\\"100\\\",\\\"rate\\\":0.11,\\\"charge\\\":0.011000000000000001,\\\"total\\\":0.011000000000000001,\\\"refill\\\":true,\\\"cancel\\\":true,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\"}\"', '\"{\\\"order\\\":2091197}\"', '2026-04-20 13:37:54', '2026-04-20 13:53:26', '127.0.0.1'),
(18, 1, 3, 'http://127.0.0.1:8000/admin/services/edit?id=3', NULL, 100, 0.11000000, 0.01100000, 0.01100000, 0, 100, '2091279', '1138', '1', 'smmkay.com', 'normal', 1, NULL, 0, 'pending', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'processing', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar\\/Video | Refill 7 Day | 500 - 2K\\/Day \\u26d4\\u267b\\ufe0f\\u26a1\\ufe0f\\\"},\\\"service_id\\\":3,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"http:\\/\\/127.0.0.1:8000\\/admin\\/services\\/edit?id=3\\\",\\\"quantity\\\":\\\"100\\\",\\\"rate\\\":0.11,\\\"charge\\\":0.011000000000000001,\\\"total\\\":0.011000000000000001,\\\"refill\\\":true,\\\"cancel\\\":true,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\"}\"', '\"{\\\"order\\\":2091279}\"', '2026-04-20 13:43:56', '2026-04-20 17:43:46', '127.0.0.1'),
(19, 1, 3, 'http://127.0.0.1:8000/admin/services', NULL, 100, 0.11000000, 0.01100000, 0.01100000, 0, 100, '2091287', '1138', '1', 'smmkay.com', 'normal', 1, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'completed', 'USD', '\"{\\\"service_name\\\":{\\\"en\\\":\\\"TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar\\/Video | Refill 7 Day | 500 - 2K\\/Day \\u26d4\\u267b\\ufe0f\\u26a1\\ufe0f\\\"},\\\"service_id\\\":3,\\\"service_type\\\":\\\"Default\\\",\\\"link\\\":\\\"http:\\/\\/127.0.0.1:8000\\/admin\\/services\\\",\\\"quantity\\\":\\\"100\\\",\\\"rate\\\":0.11,\\\"charge\\\":0.011000000000000001,\\\"total\\\":0.011000000000000001,\\\"refill\\\":true,\\\"type\\\":\\\"normal\\\",\\\"currency\\\":\\\"USD\\\"}\"', '\"{\\\"order\\\":2091287}\"', '2026-04-20 13:44:33', '2026-04-20 13:44:33', '127.0.0.1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `bonus_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(15,2) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'USD',
  `exchange_rate` decimal(15,4) NOT NULL DEFAULT 1.0000,
  `status` enum('pending','processing','completed','failed','cancelled') NOT NULL DEFAULT 'pending',
  `note` text DEFAULT NULL,
  `payment_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_info`)),
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method_payment_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'other',
  `image` varchar(255) DEFAULT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'USD',
  `min` decimal(15,2) NOT NULL DEFAULT 0.00,
  `max` decimal(15,2) NOT NULL DEFAULT 0.00,
  `max_transactions` int(11) NOT NULL DEFAULT 0,
  `max_total_funds` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bonus` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`bonus`)),
  `details` varchar(255) DEFAULT NULL,
  `config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`config`)),
  `position` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `method_payment_id`, `name`, `type`, `image`, `currency`, `min`, `max`, `max_transactions`, `max_total_funds`, `bonus`, `details`, `config`, `position`, `status`, `domain`, `created_at`, `updated_at`) VALUES
(1, 1, 'ACB', 'bank_vn', 'https://i.imgur.com/P7EFing.png', 'USD', 0.00, 0.00, 0, 0.00, '[{\"min\":5,\"percent\":1},{\"min\":10,\"percent\":2}]', 'aaaaaaaaaaaaaaa', '{\"account\":\"18145511\",\"name\":\"PHAM QUOC DUY\",\"rate\":\"27000\",\"signature\":\"\"}', 1, 1, '127.0.0.1', '2026-04-16 05:03:41', '2026-04-16 13:03:32'),
(2, 20, 'Binance', 'binance', 'https://i.imgur.com/iBEGgng.png', 'USD', 0.00, 0.00, 0, 0.00, '[{\"min\":50,\"percent\":2},{\"min\":100,\"percent\":3},{\"min\":500,\"percent\":4},{\"min\":1000,\"percent\":5}]', '{\"ops\":[{\"insert\":\"binance auto\\n\"}]}', '{\"binance_id\":\"123456789\",\"key\":\"xxxxxxxxxxx\",\"secret\":\"zzzzzzzzzzzzzz\",\"qr_image\":\"https:\\/\\/i.imgur.com\\/iBEGgng.png\"}', 2, 1, '127.0.0.1', '2026-04-16 11:24:05', '2026-04-16 11:24:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `platforms`
--

CREATE TABLE `platforms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `platforms`
--

INSERT INTO `platforms` (`id`, `name`, `image`, `position`, `status`, `created_at`, `updated_at`, `domain`) VALUES
(1, 'Facebook 1', 'fa-brands fa-facebook', 1, 1, '2026-04-15 15:53:51', '2026-04-15 15:54:30', '127.0.0.1'),
(2, '12312', 'fa-brands fa-facebook', 2, 1, '2026-04-15 17:19:48', '2026-04-15 17:19:48', '127.0.0.1'),
(3, '3211332', 'fa-brands fa-facebook', 3, 1, '2026-04-15 17:21:43', '2026-04-15 17:21:43', '127.0.0.1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `domain` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `warranty_policy` text DEFAULT NULL,
  `product_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group_tag` varchar(255) DEFAULT NULL,
  `type` enum('Manual','Api') NOT NULL DEFAULT 'Manual',
  `api_provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `api_service_id` varchar(255) DEFAULT NULL,
  `process_type` varchar(255) DEFAULT NULL,
  `cost_price` decimal(20,10) NOT NULL DEFAULT 0.0000000000,
  `price` decimal(20,10) NOT NULL DEFAULT 0.0000000000,
  `price_1` decimal(20,10) NOT NULL DEFAULT 0.0000000000,
  `price_2` decimal(20,10) NOT NULL DEFAULT 0.0000000000,
  `price_percent` decimal(8,2) NOT NULL DEFAULT 110.00,
  `price_1_percent` decimal(8,2) NOT NULL DEFAULT 108.00,
  `price_2_percent` decimal(8,2) NOT NULL DEFAULT 105.00,
  `min` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `max` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `sync` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('In stock','Out of stock','Inactive') NOT NULL DEFAULT 'In stock',
  `position` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `domain`, `name`, `slug`, `thumbnail`, `description`, `warranty_policy`, `product_category_id`, `product_group_id`, `group_tag`, `type`, `api_provider_id`, `api_service_id`, `process_type`, `cost_price`, `price`, `price_1`, `price_2`, `price_percent`, `price_1_percent`, `price_2_percent`, `min`, `max`, `sync`, `status`, `position`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'Nhóm Zalo 500 - 1000 thành viên thật', 'nhom-zalo-500-1000-thanh-vien-that', 'https://cdn.pixabay.com/photo/2021/01/05/06/40/icon-5889010_640.png', '<p>Nhóm Zalo thật, thành viên Việt Nam, giao hàng trong 24h.</p>', '<p>Bảo hành 7 ngày nếu nhóm bị xóa hoặc không đủ thành viên.</p>', 1, 1, '500-1000', 'Manual', NULL, NULL, 'Manual', 3.0000000000, 5.0000000000, 4.8000000000, 4.5000000000, 110.00, 108.00, 105.00, 1, 100, 0, 'In stock', 1, '2026-04-21 08:21:29', '2026-04-21 08:21:29'),
(2, '127.0.0.1', 'Nhóm Zalo 1000 - 1500 thành viên thật', 'nhom-zalo-1000-1500-thanh-vien-that', 'https://cdn.pixabay.com/photo/2021/01/05/06/40/icon-5889010_640.png', '<p>Nhóm Zalo thật, thành viên Việt Nam, giao hàng trong 24h.</p>', '<p>Bảo hành 7 ngày nếu nhóm bị xóa hoặc không đủ thành viên.</p>', 1, 1, '1000-1500', 'Manual', NULL, NULL, 'Manual', 5.0000000000, 8.0000000000, 7.7000000000, 7.2000000000, 110.00, 108.00, 105.00, 1, 50, 0, 'In stock', 2, '2026-04-21 08:21:29', '2026-04-21 08:21:29'),
(3, '127.0.0.1', 'Nhóm Zalo 1700 - 2000 thành viên thật', 'nhom-zalo-1700-2000-thanh-vien-that', 'https://cdn.pixabay.com/photo/2021/01/05/06/40/icon-5889010_640.png', '<p>Nhóm Zalo thật, thành viên Việt Nam, giao hàng trong 24h.</p>', '<p>Bảo hành 7 ngày nếu nhóm bị xóa hoặc không đủ thành viên.</p>', 1, 1, '1700-2000', 'Manual', NULL, NULL, 'Manual', 8.0000000000, 12.0000000000, 11.5000000000, 11.0000000000, 110.00, 108.00, 105.00, 1, 20, 0, 'In stock', 3, '2026-04-21 08:21:29', '2026-04-21 08:21:29'),
(4, '127.0.0.1', 'Tài khoản Facebook cá nhân Việt Nam', 'tai-khoan-facebook-ca-nhan-viet-nam', 'https://cdn.pixabay.com/photo/2021/06/15/12/28/facebook-6338507_640.png', '<p>Tài khoản Facebook Việt Nam, đã xác minh số điện thoại.</p>', '<p>Bảo hành 3 ngày nếu tài khoản bị khóa do lỗi từ phía chúng tôi.</p>', 2, 2, 'Cá nhân', 'Manual', NULL, NULL, 'Manual', 2.0000000000, 3.5000000000, 3.3000000000, 3.1000000000, 110.00, 108.00, 105.00, 1, 500, 0, 'In stock', 1, '2026-04-21 08:21:29', '2026-04-21 08:21:29'),
(5, '127.0.0.1', 'Tài khoản Facebook Business', 'tai-khoan-facebook-business', 'https://cdn.pixabay.com/photo/2021/06/15/12/28/facebook-6338507_640.png', '<p>Tài khoản Facebook Business đã xác minh, sẵn sàng chạy quảng cáo.</p>', '<p>Bảo hành 3 ngày nếu tài khoản bị khóa do lỗi từ phía chúng tôi.</p>', 2, 2, 'Business', 'Manual', NULL, NULL, 'Manual', 10.0000000000, 15.0000000000, 14.5000000000, 14.0000000000, 110.00, 108.00, 105.00, 1, 100, 0, 'In stock', 2, '2026-04-21 08:21:29', '2026-04-21 08:21:29'),
(6, '127.0.0.1', 'Canva Premium 1 tháng', 'canva-premium-1-thang', 'https://cdn.pixabay.com/photo/2022/01/30/17/54/canva-6981481_640.png', '<p>Tài khoản Canva Pro, dùng riêng, đầy đủ tính năng premium.</p>', '<p>Bảo hành đủ 30 ngày, đổi mới nếu hết hạn sớm.</p>', 3, 3, '1 tháng', 'Manual', NULL, NULL, 'Manual', 1.5000000000, 2.5000000000, 2.3000000000, 2.1000000000, 110.00, 108.00, 105.00, 1, 999, 0, 'In stock', 1, '2026-04-21 08:21:29', '2026-04-21 08:21:29'),
(7, '127.0.0.1', 'Netflix Premium 1 tháng', 'netflix-premium-1-thang', 'https://cdn.pixabay.com/photo/2019/11/05/15/44/netflix-4603951_640.png', '<p>Tài khoản Netflix Premium 4K, dùng riêng, không chia sẻ.</p>', '<p>Bảo hành đủ 30 ngày, đổi mới nếu hết hạn sớm.</p>', 3, 3, '1 tháng', 'Manual', NULL, NULL, 'Manual', 2.5000000000, 4.0000000000, 3.8000000000, 3.5000000000, 110.00, 108.00, 105.00, 1, 999, 0, 'In stock', 2, '2026-04-21 08:21:29', '2026-04-21 08:21:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `position` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `domain`, `status`, `position`, `created_at`, `updated_at`) VALUES
(1, 'Zalo', '127.0.0.1', 1, 1, '2026-04-20 14:22:22', '2026-04-20 14:22:22'),
(2, 'Facebook', '127.0.0.1', 1, 2, '2026-04-20 14:22:22', '2026-04-20 14:22:22'),
(3, 'Account', '127.0.0.1', 1, 3, '2026-04-20 14:22:22', '2026-04-20 14:22:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_goods`
--

CREATE TABLE `product_goods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_groups`
--

CREATE TABLE `product_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_groups`
--

INSERT INTO `product_groups` (`id`, `name`, `domain`, `position`, `created_at`, `updated_at`) VALUES
(1, 'Nhóm Zalo', '127.0.0.1', 1, '2026-04-20 14:22:22', '2026-04-20 14:22:22'),
(2, 'Tài khoản Facebook', '127.0.0.1', 2, '2026-04-20 14:22:22', '2026-04-20 14:22:22'),
(3, 'Tài khoản Premium', '127.0.0.1', 3, '2026-04-20 14:22:22', '2026-04-20 14:22:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_orders`
--

CREATE TABLE `product_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_product_order_id` varchar(255) DEFAULT NULL,
  `status` enum('Awaiting','Manual','Pending','In progress','Completed','Canceled','Failed','Partial') NOT NULL DEFAULT 'Awaiting',
  `amount` decimal(16,4) NOT NULL DEFAULT 0.0000,
  `charge` decimal(16,4) NOT NULL DEFAULT 0.0000,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_orders`
--

INSERT INTO `product_orders` (`id`, `user_id`, `domain`, `product_id`, `provider_product_order_id`, `status`, `amount`, `charge`, `quantity`, `note`, `created_at`, `updated_at`) VALUES
(3, 1, '127.0.0.1', 4, NULL, 'Completed', 3.5000, 3.5000, 1, '1', '2026-04-21 16:32:06', '2026-04-21 16:49:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_warehouses`
--

CREATE TABLE `product_warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attributes`)),
  `rate_original` decimal(15,8) NOT NULL DEFAULT 4.00000000,
  `rate_retail` decimal(15,8) DEFAULT NULL,
  `rate_agent` decimal(15,8) DEFAULT NULL,
  `rate_distributor` decimal(15,8) DEFAULT NULL,
  `rate_retail_up` decimal(15,8) DEFAULT NULL,
  `rate_agent_up` decimal(15,8) DEFAULT NULL,
  `rate_distributor_up` decimal(15,8) DEFAULT NULL,
  `sync_rate` tinyint(1) NOT NULL DEFAULT 0,
  `sync_min_max` tinyint(1) NOT NULL DEFAULT 0,
  `sync_action` tinyint(1) NOT NULL DEFAULT 0,
  `min` int(11) NOT NULL DEFAULT 1,
  `max` int(11) NOT NULL DEFAULT 10000,
  `service_api` varchar(255) DEFAULT NULL,
  `provider_name` varchar(255) DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'api',
  `type_service` varchar(255) DEFAULT NULL,
  `type_radio` varchar(255) DEFAULT NULL,
  `refill` tinyint(1) NOT NULL DEFAULT 0,
  `cancel` tinyint(1) NOT NULL DEFAULT 0,
  `dripfeed` tinyint(1) NOT NULL DEFAULT 0,
  `average_time` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `reaction` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `category_id`, `name`, `title`, `description`, `image`, `position`, `attributes`, `rate_original`, `rate_retail`, `rate_agent`, `rate_distributor`, `rate_retail_up`, `rate_agent_up`, `rate_distributor_up`, `sync_rate`, `sync_min_max`, `sync_action`, `min`, `max`, `service_api`, `provider_name`, `provider_id`, `type`, `type_service`, `type_radio`, `refill`, `cancel`, `dripfeed`, `average_time`, `note`, `reaction`, `status`, `created_at`, `updated_at`, `domain`) VALUES
(1, 1, '{\"en\":\"Twitter Tweet Profile Visits | UltraFast \\/ Day 500K \\u26a1 | 365 Days Guaranteed \\u267b\\ufe0f\"}', NULL, NULL, 'fa-brands fa-facebook', 1, '[\"Exclusive\",\"Provider Direct\",\"New\",\"Best seller\",\"Promotion\",\"Recommend\",\"Instant\",\"Super Fast\",\"Real\",\"Lifetime\"]', 0.00841000, 0.00170000, 0.00080000, 0.00040000, 20.00000000, 10.00000000, 5.00000000, 0, 0, 0, 100, 217545811, '1061', 'smmkay.com', 1, 'api', 'Default', NULL, 1, 1, 0, '0', NULL, NULL, 1, '2026-04-15 17:44:16', '2026-04-15 18:00:43', '127.0.0.1'),
(2, 1, '{\"en\":\"Shopee Live Stream Views [ Max 100K ] | Only Thailand Link \\ud83c\\uddf9\\ud83c\\udded | 90 Minutes\"}', NULL, NULL, 'fa-brands fa-facebook', 2, '[\"Best seller\",\"Recommend\",\"Real\"]', 1.00000000, 0.20000000, 0.10000000, 0.05000000, 20.00000000, 10.00000000, 5.00000000, 0, 0, 0, 10, 100000, NULL, NULL, NULL, 'manual', 'Default', NULL, 0, 0, 0, '0', NULL, NULL, 1, '2026-04-15 17:46:09', '2026-04-15 17:46:09', '127.0.0.1'),
(3, 1, '{\"en\":\"TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar\\/Video | Refill 7 Day | 500 - 2K\\/Day \\u26d4\\u267b\\ufe0f\\u26a1\\ufe0f\"}', 'TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar/Video | Refill 7 Day | 500 - 2K/Day ⛔♻️⚡️', '', 'fa-brands fa-facebook', 0, '[]', 2.20000000, 0.44000000, 0.22000000, 0.11000000, 20.00000000, 10.00000000, 5.00000000, 0, 0, 0, 100, 10000000, '1138', 'smmkay.com', 1, 'api', 'Default', NULL, 1, 0, 0, '0', NULL, NULL, 1, '2026-04-17 14:47:22', '2026-04-20 13:37:39', '127.0.0.1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service_sync_logs`
--

CREATE TABLE `service_sync_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_name` varchar(255) DEFAULT NULL,
  `service_api` varchar(255) DEFAULT NULL,
  `change_type` varchar(255) NOT NULL DEFAULT 'price_increase',
  `old_value` decimal(15,8) DEFAULT NULL,
  `new_value` decimal(15,8) DEFAULT NULL,
  `field_changed` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `service_sync_logs`
--

INSERT INTO `service_sync_logs` (`id`, `service_id`, `provider_id`, `provider_name`, `service_api`, `change_type`, `old_value`, `new_value`, `field_changed`, `is_read`, `domain`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'smmkay.com', '1061', 'price_increase', 0.07100000, 0.07600000, 'rate', 0, '127.0.0.1', '2026-04-18 10:53:58', '2026-04-18 10:53:58'),
(2, 2, NULL, NULL, NULL, 'price_increase', 0.09200000, 0.09700000, 'rate', 0, '127.0.0.1', '2026-04-18 18:53:58', '2026-04-18 18:53:58'),
(3, 3, 1, 'smmkay.com', '11111', 'price_increase', 0.09100000, 0.10100000, 'rate', 0, '127.0.0.1', '2026-04-18 12:53:58', '2026-04-18 12:53:58'),
(4, 1, 1, 'smmkay.com', '1061', 'price_increase', 0.06400000, 0.06600000, 'rate', 1, '127.0.0.1', '2026-04-11 20:53:58', '2026-04-11 20:53:58'),
(5, 2, NULL, NULL, NULL, 'price_increase', 0.05200000, 0.05400000, 'rate', 1, '127.0.0.1', '2026-04-05 20:53:58', '2026-04-05 20:53:58'),
(6, 3, 1, 'smmkay.com', '11111', 'price_increase', 0.05700000, 0.06200000, 'rate', 1, '127.0.0.1', '2026-03-24 20:53:58', '2026-03-24 20:53:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `custom_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_fields`)),
  `status` enum('open','answered','closed') NOT NULL DEFAULT 'open',
  `priority` enum('low','medium','high') NOT NULL DEFAULT 'medium',
  `last_reply_at` timestamp NULL DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ticket_reply`
--

CREATE TABLE `ticket_reply` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_system` tinyint(1) NOT NULL DEFAULT 0,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ticket_subjects`
--

CREATE TABLE `ticket_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `show_message_only` tinyint(1) NOT NULL DEFAULT 0,
  `required_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`required_fields`)),
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(20,9) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'order',
  `status` varchar(255) NOT NULL DEFAULT 'completed',
  `payment_method` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `balance_after` decimal(20,9) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `order_id`, `amount`, `type`, `status`, `payment_method`, `transaction_id`, `description`, `balance_after`, `domain`, `created_at`, `updated_at`) VALUES
(1, 1, 13, -0.000040000, 'order', 'completed', 'balance', 'ORDER-13', 'Order #13 - Service #1', 0.819540000, '127.0.0.1', '2026-04-18 06:39:15', '2026-04-18 06:39:15'),
(2, 1, 14, -0.011000000, 'order', 'completed', 'balance', 'ORDER-14', 'Order #14 - Service #3', 0.797580000, '127.0.0.1', '2026-04-20 13:33:52', '2026-04-20 13:33:52'),
(3, 1, 15, -0.011000000, 'order', 'completed', 'balance', 'ORDER-15', 'Order #15 - Service #3', 0.786580000, '127.0.0.1', '2026-04-20 13:34:14', '2026-04-20 13:34:14'),
(4, 1, 16, -0.011000000, 'order', 'completed', 'balance', 'ORDER-16', 'Order #16 - Service #3', 0.775580000, '127.0.0.1', '2026-04-20 13:36:37', '2026-04-20 13:36:37'),
(5, 1, 17, -0.011000000, 'order', 'completed', 'balance', 'ORDER-17', 'Order #17 - Service #3', 0.764580000, '127.0.0.1', '2026-04-20 13:37:54', '2026-04-20 13:37:54'),
(6, 1, 18, -0.011000000, 'order', 'completed', 'balance', 'ORDER-18', 'Order #18 - Service #3', 0.753580000, '127.0.0.1', '2026-04-20 13:43:56', '2026-04-20 13:43:56'),
(7, 1, 19, -0.011000000, 'order', 'completed', 'balance', 'ORDER-19', 'Order #19 - Service #3', 0.742580000, '127.0.0.1', '2026-04-20 13:44:33', '2026-04-20 13:44:33'),
(8, 1, NULL, -5.000000000, 'order', 'completed', 'balance', 'PRODUCT-1', 'Product order #1 - Nhóm Zalo 500 - 1000 thành viên thật', -5.000000000, '127.0.0.1', '2026-04-20 14:40:46', '2026-04-20 14:40:46'),
(9, 1, NULL, -5.000000000, 'order', 'completed', 'balance', 'PRODUCT-2', 'Product order #2 - Nhóm Zalo 500 - 1000 thành viên thật', 0.000000000, '127.0.0.1', '2026-04-20 14:47:17', '2026-04-20 14:47:17'),
(10, 1, NULL, -3.500000000, 'order', 'completed', 'balance', 'PRODUCT-3', 'Product order #3 - Tài khoản Facebook cá nhân Việt Nam', -2.000000000, '127.0.0.1', '2026-04-21 16:32:07', '2026-04-21 16:32:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `balance` decimal(15,8) NOT NULL DEFAULT 4.00000000,
  `spent` decimal(15,8) NOT NULL DEFAULT 4.00000000,
  `api_key` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `timezone` int(11) NOT NULL DEFAULT 14400,
  `lang` varchar(255) NOT NULL DEFAULT 'en',
  `currency` varchar(255) NOT NULL DEFAULT 'USD',
  `level` enum('retail','agent','distributor') NOT NULL DEFAULT 'retail',
  `role` enum('member','admin') NOT NULL DEFAULT 'member',
  `transfer_code` varchar(255) DEFAULT NULL,
  `referral_code` varchar(255) DEFAULT NULL,
  `two_factor_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `two_factor_secret` varchar(255) DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `phone`, `email_verified_at`, `password`, `balance`, `spent`, `api_key`, `is_active`, `timezone`, `lang`, `currency`, `level`, `role`, `transfer_code`, `referral_code`, `two_factor_enabled`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `domain`) VALUES
(1, 'smmpanel', 'smmkay', 'quocduy110204@gmail.com', NULL, NULL, '$2y$12$i4iSiSV5GLp1paxFCKaLue2ESjLWibmqvCoM6dqpu1PW8zoSKVm4e', 1.50000000, 0.00000000, 'BkMT5lFDYdPOrR4VrQHQlSSIzS80woGH', 1, 14400, 'vi', 'VND', 'distributor', 'admin', '12312', 'td9txVuh', 0, NULL, NULL, NULL, NULL, '2026-04-15 15:50:18', '2026-04-22 13:48:20', '127.0.0.1');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_type_created_at_index` (`type`,`created_at`),
  ADD KEY `activity_logs_user_id_index` (`user_id`),
  ADD KEY `activity_logs_domain_index` (`domain`),
  ADD KEY `activity_logs_created_at_index` (`created_at`);

--
-- Chỉ mục cho bảng `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `affiliates_referrer_id_referred_id_unique` (`referrer_id`,`referred_id`),
  ADD KEY `affiliates_referrer_id_status_index` (`referrer_id`,`status`),
  ADD KEY `affiliates_referred_id_status_index` (`referred_id`,`status`),
  ADD KEY `affiliates_referral_code_index` (`referral_code`),
  ADD KEY `affiliates_status_index` (`status`),
  ADD KEY `affiliates_created_at_index` (`created_at`);

--
-- Chỉ mục cho bảng `api_providers`
--
ALTER TABLE `api_providers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `api_providers_name_unique` (`name`),
  ADD KEY `api_providers_type_index` (`type`),
  ADD KEY `api_providers_status_index` (`status`),
  ADD KEY `api_providers_created_at_index` (`created_at`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_platform_id_index` (`platform_id`),
  ADD KEY `categories_status_index` (`status`),
  ADD KEY `categories_created_at_index` (`created_at`);

--
-- Chỉ mục cho bảng `child_panels`
--
ALTER TABLE `child_panels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `child_panels_domain_panel_unique` (`domain_panel`),
  ADD KEY `child_panels_user_id_index` (`user_id`),
  ADD KEY `child_panels_domain_index` (`domain`),
  ADD KEY `child_panels_domain_panel_index` (`domain_panel`),
  ADD KEY `child_panels_access_index` (`access`),
  ADD KEY `child_panels_status_index` (`status`),
  ADD KEY `child_panels_created_at_index` (`created_at`);

--
-- Chỉ mục cho bảng `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `configs_user_id_index` (`user_id`),
  ADD KEY `configs_status_index` (`status`),
  ADD KEY `configs_created_at_index` (`created_at`);

--
-- Chỉ mục cho bảng `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currency_code_unique` (`code`),
  ADD KEY `currency_status_index` (`status`),
  ADD KEY `currency_domain_index` (`domain`),
  ADD KEY `currency_code_index` (`code`),
  ADD KEY `currency_status_domain_index` (`status`,`domain`),
  ADD KEY `currency_created_at_index` (`created_at`);

--
-- Chỉ mục cho bảng `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_status_start_date_end_date_index` (`status`,`start_date`,`end_date`),
  ADD KEY `events_domain_index` (`domain`),
  ADD KEY `events_created_at_index` (`created_at`);

--
-- Chỉ mục cho bảng `event_spins`
--
ALTER TABLE `event_spins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_spins_event_id_user_id_created_at_index` (`event_id`,`user_id`,`created_at`),
  ADD KEY `event_spins_user_id_index` (`user_id`),
  ADD KEY `event_spins_created_at_index` (`created_at`);

--
-- Chỉ mục cho bảng `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_name_unique` (`name`),
  ADD UNIQUE KEY `languages_code_unique` (`code`),
  ADD KEY `languages_status_index` (`status`),
  ADD KEY `languages_code_index` (`code`),
  ADD KEY `languages_created_at_index` (`created_at`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_created_at_index` (`created_at`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_index` (`user_id`),
  ADD KEY `orders_service_id_index` (`service_id`),
  ADD KEY `orders_status_index` (`status`),
  ADD KEY `orders_created_at_index` (`created_at`),
  ADD KEY `orders_provider_id_index` (`provider_id`),
  ADD KEY `orders_user_id_status_index` (`user_id`,`status`),
  ADD KEY `orders_user_id_created_at_index` (`user_id`,`created_at`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_transaction_id_unique` (`transaction_id`),
  ADD KEY `payments_user_id_status_index` (`user_id`,`status`),
  ADD KEY `payments_payment_method_id_status_index` (`payment_method_id`,`status`),
  ADD KEY `payments_status_created_at_index` (`status`,`created_at`),
  ADD KEY `payments_transaction_id_index` (`transaction_id`),
  ADD KEY `payments_domain_index` (`domain`);

--
-- Chỉ mục cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_methods_status_index` (`status`),
  ADD KEY `payment_methods_status_position_index` (`status`,`position`),
  ADD KEY `payment_methods_currency_index` (`currency`),
  ADD KEY `payment_methods_domain_index` (`domain`),
  ADD KEY `payment_methods_type_index` (`type`),
  ADD KEY `payment_methods_method_payment_id_index` (`method_payment_id`);

--
-- Chỉ mục cho bảng `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `platforms_status_index` (`status`),
  ADD KEY `platforms_position_index` (`position`),
  ADD KEY `platforms_created_at_index` (`created_at`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_product_group_id_foreign` (`product_group_id`),
  ADD KEY `products_domain_index` (`domain`),
  ADD KEY `products_product_category_id_index` (`product_category_id`),
  ADD KEY `products_status_index` (`status`),
  ADD KEY `products_type_index` (`type`);

--
-- Chỉ mục cho bảng `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_categories_domain_index` (`domain`),
  ADD KEY `product_categories_status_index` (`status`);

--
-- Chỉ mục cho bảng `product_goods`
--
ALTER TABLE `product_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_goods_warehouse_id_index` (`warehouse_id`),
  ADD KEY `product_goods_used_index` (`used`);

--
-- Chỉ mục cho bảng `product_groups`
--
ALTER TABLE `product_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_groups_domain_index` (`domain`);

--
-- Chỉ mục cho bảng `product_orders`
--
ALTER TABLE `product_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_orders_domain_index` (`domain`),
  ADD KEY `product_orders_user_id_index` (`user_id`),
  ADD KEY `product_orders_status_index` (`status`),
  ADD KEY `product_orders_product_id_index` (`product_id`);

--
-- Chỉ mục cho bảng `product_warehouses`
--
ALTER TABLE `product_warehouses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_warehouses_domain_index` (`domain`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_category_id_status_index` (`category_id`,`status`),
  ADD KEY `services_status_type_index` (`status`,`type`),
  ADD KEY `services_provider_name_index` (`provider_name`),
  ADD KEY `services_sync_action_index` (`sync_action`),
  ADD KEY `services_created_at_index` (`created_at`),
  ADD KEY `services_domain_index` (`domain`);

--
-- Chỉ mục cho bảng `service_sync_logs`
--
ALTER TABLE `service_sync_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_sync_logs_domain_is_read_index` (`domain`,`is_read`),
  ADD KEY `service_sync_logs_service_id_index` (`service_id`),
  ADD KEY `service_sync_logs_created_at_index` (`created_at`);

--
-- Chỉ mục cho bảng `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_subject_id_foreign` (`subject_id`),
  ADD KEY `tickets_assigned_to_foreign` (`assigned_to`),
  ADD KEY `tickets_domain_index` (`domain`),
  ADD KEY `tickets_user_id_index` (`user_id`),
  ADD KEY `tickets_status_index` (`status`),
  ADD KEY `tickets_priority_index` (`priority`),
  ADD KEY `tickets_created_at_index` (`created_at`),
  ADD KEY `tickets_user_id_status_index` (`user_id`,`status`);

--
-- Chỉ mục cho bảng `ticket_reply`
--
ALTER TABLE `ticket_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_reply_ticket_id_index` (`ticket_id`),
  ADD KEY `ticket_reply_user_id_index` (`user_id`),
  ADD KEY `ticket_reply_created_at_index` (`created_at`),
  ADD KEY `ticket_reply_ticket_id_created_at_index` (`ticket_id`,`created_at`);

--
-- Chỉ mục cho bảng `ticket_subjects`
--
ALTER TABLE `ticket_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_subjects_status_index` (`status`),
  ADD KEY `ticket_subjects_sort_order_index` (`sort_order`);

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_index` (`user_id`),
  ADD KEY `transactions_order_id_index` (`order_id`),
  ADD KEY `transactions_type_index` (`type`),
  ADD KEY `transactions_status_index` (`status`),
  ADD KEY `transactions_created_at_index` (`created_at`),
  ADD KEY `transactions_user_id_created_at_index` (`user_id`,`created_at`),
  ADD KEY `transactions_user_id_domain_index` (`user_id`,`domain`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_api_key_unique` (`api_key`),
  ADD UNIQUE KEY `users_transfer_code_unique` (`transfer_code`),
  ADD UNIQUE KEY `users_referral_code_unique` (`referral_code`),
  ADD KEY `users_email_index` (`email`),
  ADD KEY `users_username_index` (`username`),
  ADD KEY `users_api_key_index` (`api_key`),
  ADD KEY `users_is_active_index` (`is_active`),
  ADD KEY `users_created_at_index` (`created_at`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `api_providers`
--
ALTER TABLE `api_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `child_panels`
--
ALTER TABLE `child_panels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `currency`
--
ALTER TABLE `currency`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT cho bảng `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `event_spins`
--
ALTER TABLE `event_spins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `product_goods`
--
ALTER TABLE `product_goods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product_groups`
--
ALTER TABLE `product_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `product_orders`
--
ALTER TABLE `product_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `product_warehouses`
--
ALTER TABLE `product_warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `service_sync_logs`
--
ALTER TABLE `service_sync_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ticket_reply`
--
ALTER TABLE `ticket_reply`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ticket_subjects`
--
ALTER TABLE `ticket_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `affiliates`
--
ALTER TABLE `affiliates`
  ADD CONSTRAINT `affiliates_referred_id_foreign` FOREIGN KEY (`referred_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `affiliates_referrer_id_foreign` FOREIGN KEY (`referrer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_platform_id_foreign` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `child_panels`
--
ALTER TABLE `child_panels`
  ADD CONSTRAINT `child_panels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `configs`
--
ALTER TABLE `configs`
  ADD CONSTRAINT `configs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `event_spins`
--
ALTER TABLE `event_spins`
  ADD CONSTRAINT `event_spins_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_spins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_product_group_id_foreign` FOREIGN KEY (`product_group_id`) REFERENCES `product_groups` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `product_goods`
--
ALTER TABLE `product_goods`
  ADD CONSTRAINT `product_goods_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `product_warehouses` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_orders`
--
ALTER TABLE `product_orders`
  ADD CONSTRAINT `product_orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tickets_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `ticket_subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ticket_reply`
--
ALTER TABLE `ticket_reply`
  ADD CONSTRAINT `ticket_reply_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_reply_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
