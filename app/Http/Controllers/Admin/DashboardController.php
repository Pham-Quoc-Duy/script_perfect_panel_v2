<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    private DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $stats = $this->dashboardService->getStatistics();
        $chartData = $this->dashboardService->getChartData();
        $recentOrders = $this->dashboardService->getRecentOrders();
        $recentUsers = $this->dashboardService->getRecentUsers();

        return view('adminpanel.dashboard', array_merge($stats, $chartData, compact(
            'recentOrders',
            'recentUsers'
        )));
    }
}