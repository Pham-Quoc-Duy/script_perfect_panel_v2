<?php

use App\Models\Currency;

if (!function_exists('getDomain')) {
    function getDomain()
    {
        return request()->getHost();
    }
}

if (!function_exists('formatUserCurrency')) {
    function formatUserCurrency($user, $currencies, $nonDecimalCodes = [])
    {
        $userCurrency = $currencies->firstWhere('code', $user->currency ?? 'USD')
            ?: Currency::where('code', 'USD')->first()
            ?: (object) [
                'code' => 'USD',
                'symbol' => '$',
                'name' => 'US Dollar',
                'symbol_position' => 'before',
                'exchange_rate' => 1,
            ];

        return [
            'currency' => $userCurrency,
            'balance' => formatCurrencyAmount($user->balance, $userCurrency, $nonDecimalCodes),
            'spent' => formatCurrencyAmount($user->spent, $userCurrency, $nonDecimalCodes),
        ]; 
    }
}

if (!function_exists('formatCurrencyAmount')) {
    function formatCurrencyAmount($amount, $currency, $nonDecimalCodes = [])
    {
        $converted = $amount * $currency->exchange_rate;
        $isNonDecimal = in_array($currency->code, $nonDecimalCodes);

        if ($converted == 0) {
            $formatted = $isNonDecimal ? '0' : '0.00';
        } else {
            $decimals = $isNonDecimal ? 0 : ($converted >= 1000 ? 0 : ($converted >= 100 ? 1 : 2));
            
            if ($currency->code === 'VND') {
                $formatted = number_format($converted, 0, ',', '.');
            } else {
                $formatted = rtrim(number_format($converted, $decimals), '0.') ?: ($isNonDecimal ? '0' : '0.00');
            }
        }

        return $currency->symbol_position === 'before'
            ? $currency->symbol . $formatted
            : $formatted . ' ' . $currency->symbol;
    }
}

if (!function_exists('formatCharge')) {
    function formatCharge($charge)
    {
        if ($charge == 0) {
            return '0';
        }

        $charge = (float) $charge;
        $formatted = number_format($charge, 8, '.', '');
        $formatted = rtrim($formatted, '0');
        $formatted = rtrim($formatted, '.');
        
        return $formatted ?: '0';
    }
}

if (!function_exists('formatAverageTime')) {
    function formatAverageTime($seconds)
    {
        if (!$seconds || $seconds <= 0) {
            return '';
        }

        $seconds = (int) $seconds;
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $secs = $seconds % 60;

        $parts = [];
        
        if ($hours > 0) {
            $parts[] = $hours . 'h';
        }
        
        if ($minutes > 0) {
            $parts[] = $minutes . 'm';
        }
        
        if ($secs > 0 || empty($parts)) {
            $parts[] = $secs . 's';
        }

        return implode(' ', $parts);
    }
}

if (!function_exists('getOrderStatusText')) {
    function getOrderStatusText($status)
    {
        return match($status) {
            'awaiting' => 'Đang chờ',
            'pending' => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'in_progress' => 'Đang chạy',
            'completed' => 'Hoàn thành',
            'partial' => 'Hoàn tiền một phần',
            'canceled' => 'Hủy',
            'failed' => 'Thất bại',
            default => 'Không xác định'
        };
    }
}

if (!function_exists('getOrderStatusClass')) {
    function getOrderStatusClass($status)
    {
        return match($status) {
            'awaiting' => 'btn-outline-secondary btn-outline',
            'pending' => 'btn btn-secondary btn-sm',
            'processing' => 'btn-primary',
            'in_progress' => 'btn-info',
            'completed' => 'btn-success',
            'partial' => 'btn-danger',
            'canceled' => 'btn-warning',
            'failed' => 'btn-outline-warning btn-outline',
            default => 'btn-outline-dark btn-outline'
        };
    }
}

if (!function_exists('formatAmount')) {
    function formatAmount($amount)
    {
        if ($amount == 0) {
            return '0';
        }

        $amount = (float) $amount;
        $formatted = number_format($amount, 4, '.', '');
        $formatted = rtrim($formatted, '0');
        $formatted = rtrim($formatted, '.');
        
        return $formatted ?: '0';
    }
}

if (!function_exists('trans_menu')) {
    function trans_menu($key)
    {
        $lang = session('language', 'vi');
        $isVietnamese = $lang === 'vi';
        
        $translations = [
            'menu::Orders' => $isVietnamese ? 'Đơn hàng' : 'Orders',
            'menu::List' => $isVietnamese ? 'Quản lý' : 'Manage',
            'menu::Payments' => $isVietnamese ? 'Thanh toán' : 'Payments',
            'menu::Support' => $isVietnamese ? 'Hỗ trợ' : 'Support',
            'menu::Others' => $isVietnamese ? 'Khác' : 'Others',
            'menu::Services' => $isVietnamese ? 'Dịch vụ' : 'Services',
            'menu::Products' => $isVietnamese ? 'Sản phẩm' : 'Products',
            'menu::Refill services' => $isVietnamese ? 'Bảo hành dịch vụ' : 'Refill services',
            'menu::Refill products' => $isVietnamese ? 'Bảo hành sản phẩm' : 'Refill products',
            'menu::Cancel services' => $isVietnamese ? 'Hủy dịch vụ' : 'Cancel services',
            'menu::Accounts' => $isVietnamese ? 'Tài khoản' : 'Accounts',
            'menu::Categories' => $isVietnamese ? 'Danh mục dịch vụ' : 'Categories',
            'menu::Providers' => $isVietnamese ? 'Nhà cung cấp' : 'Providers',
            'menu::Sync Logs' => $isVietnamese ? 'Thông tin đồng bộ dịch vụ' : 'Sync Logs',
            'menu::Payment methods' => $isVietnamese ? 'Phương thức' : 'Methods',
            'menu::Payment history' => $isVietnamese ? 'Giao dịch' : 'History',
            'menu::Coupon List' => $isVietnamese ? 'Danh sách' : 'List',
            'menu::Coupon usage' => $isVietnamese ? 'Lịch sử' : 'Usage',
            'menu::Messages' => $isVietnamese ? 'Tin nhắn' : 'Messages',
            'menu::Tickets' => $isVietnamese ? 'Phiếu hỗ trợ' : 'Tickets',
            'menu::News' => $isVietnamese ? 'Thông báo' : 'News',
            'menu::Ticket Statistics by Service' => $isVietnamese ? 'Thống kê phiếu hỗ trợ theo dịch vụ' : 'Ticket Statistics by Service',
            'menu::Settings' => $isVietnamese ? 'Cài đặt' : 'Settings',
            'menu::Analytics' => $isVietnamese ? 'Phân tích' : 'Analytics',
            'menu::Reports' => $isVietnamese ? 'Thống kê' : 'Reports',
            'menu::Affiliates' => $isVietnamese ? 'Tiếp thị liên kết' : 'Affiliates',
            'menu::Backup' => $isVietnamese ? 'Sao lưu' : 'Backup',
            'menu::Warehouse' => $isVietnamese ? 'Kho sản phẩm' : 'Warehouse',
        ];
        
        return $translations[$key] ?? $key;
    }
}

if (!function_exists('langToFlag')) {
    function langToFlag(string $lang): string
    {
        $map = [
            'en' => 'us', 'vi' => 'vn', 'zh' => 'cn', 'ja' => 'jp', 'ko' => 'kr',
            'fr' => 'fr', 'de' => 'de', 'es' => 'es', 'pt' => 'pt', 'it' => 'it',
            'ru' => 'ru', 'ar' => 'sa', 'hi' => 'in', 'th' => 'th', 'id' => 'id',
            'ms' => 'my', 'tr' => 'tr', 'pl' => 'pl', 'nl' => 'nl', 'sv' => 'se',
            'da' => 'dk', 'fi' => 'fi', 'no' => 'no', 'cs' => 'cz', 'hu' => 'hu',
            'ro' => 'ro', 'uk' => 'ua', 'he' => 'il', 'fa' => 'ir', 'bn' => 'bd',
        ];
        return $map[$lang] ?? 'us';
    }
}
