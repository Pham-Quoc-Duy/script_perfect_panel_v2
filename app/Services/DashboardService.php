<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class DashboardService
{
    private const CACHE_DURATION = 300; // 5 minutes
    private const STATS_CACHE_KEY = 'dashboard_stats';
    private const CHART_CACHE_KEY = 'dashboard_charts';

    /**
     * Get all dashboard statistics with caching
     */
    public function getStatistics()
    {
        $cacheKey = self::STATS_CACHE_KEY . '_' . date('YmdH');
        
        return Cache::remember($cacheKey, self::CACHE_DURATION, function () {
            return [
                'totalUsers' => User::count(),
                'totalOrders' => Order::count(),
                'totalServices' => Service::count(),
                'totalRevenue' => Transaction::where('status', 'completed')->sum('amount'),
                'completedOrders' => Order::where('status', 'completed')->count(),
                'pendingOrders' => Order::where('status', 'pending')->count(),
                'newUsers' => User::where('created_at', '>=', Carbon::now()->subDays(7))->count(),
                'completionRate' => $this->calculateCompletionRate(),
            ];
        });
    }

    /**
     * Get chart data with caching
     */
    public function getChartData()
    {
        $cacheKey = self::CHART_CACHE_KEY . '_' . date('YmdH');
        
        return Cache::remember($cacheKey, self::CACHE_DURATION, function () {
            $currentYear = Carbon::now()->year;
            
            return [
                'monthlyOrders' => Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->whereYear('created_at', $currentYear)
                    ->groupBy('month')
                    ->pluck('count', 'month')
                    ->toArray(),
                'monthlyRevenue' => Transaction::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
                    ->where('status', 'completed')
                    ->whereYear('created_at', $currentYear)
                    ->groupBy('month')
                    ->pluck('total', 'month')
                    ->toArray(),
            ];
        });
    }

    /**
     * Get recent orders with minimal columns
     */
    public function getRecentOrders($limit = 5)
    {
        return Order::select('id', 'user_id', 'service_id', 'status', 'created_at')
            ->with(['user:id,name', 'service:id,name'])
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get recent users with minimal columns
     */
    public function getRecentUsers($limit = 5)
    {
        return User::select('id', 'name', 'email', 'created_at')
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Clear all dashboard cache
     */
    public function clearCache()
    {
        Cache::forget(self::STATS_CACHE_KEY . '_' . date('YmdH'));
        Cache::forget(self::CHART_CACHE_KEY . '_' . date('YmdH'));
    }

    /**
     * Calculate completion rate
     */
    private function calculateCompletionRate()
    {
        $total = Order::count();
        if ($total === 0) return 0;
        
        $completed = Order::where('status', 'completed')->count();
        return round(($completed / $total) * 100, 2);
    }
}
