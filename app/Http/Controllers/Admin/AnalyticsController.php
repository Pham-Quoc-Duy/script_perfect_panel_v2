<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    private function resolveServiceName(?object $service): string
    {
        if (!$service) return 'N/A';
        $name = $service->name;
        if (is_array($name)) {
            return $service->id . ' - ' . ($name['en'] ?? $name['vi'] ?? reset($name) ?? 'N/A');
        }
        return $service->id . ' - ' . ($name ?: 'N/A');
    }

    private function mapServiceRows($collection, string $valueKey): array
    {
        return $collection->map(fn($item) => [
            'value'         => $item->{$valueKey},
            'service_label' => $this->resolveServiceName($item->service),
        ])->toArray();
    }

    public function index()
    {
        $orderSummary = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')->pluck('count', 'status');

        $totalOrders  = Order::count();
        $totalDeposit = Transaction::where('type', 'order')->where('status', 'completed')->sum('amount');

        $statusCounts = [
            'failed'     => 0,
            'awaiting'   => $orderSummary->get('awaiting', 0),
            'schedule'   => $orderSummary->get('schedule', 0),
            'pending'    => $orderSummary->get('pending', 0),
            'processing' => $orderSummary->get('processing', 0),
            'inprogress' => $orderSummary->get('in_progress', 0),
            'done'       => $orderSummary->get('completed', 0) + $orderSummary->get('canceled', 0) + $orderSummary->get('partial', 0),
        ];

        $year = Carbon::now()->year;

        $newAccounts = User::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', $year)->groupBy('month')->pluck('count', 'month');

        $activeAccounts = Order::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(DISTINCT user_id) as count'))
            ->whereYear('created_at', $year)->groupBy('month')->pluck('count', 'month');

        $accountChartData = [
            'new'    => array_values(array_map(fn($m) => $newAccounts->get($m, 0), range(1, 12))),
            'active' => array_values(array_map(fn($m) => $activeAccounts->get($m, 0), range(1, 12))),
        ];

        $currentMonth = Carbon::now()->format('Y-m');

        $topServicesByCount = $this->mapServiceRows(
            Order::select('service_id', DB::raw('COUNT(*) as order_count'))
                ->whereYear('created_at', $year)->whereMonth('created_at', Carbon::now()->month)
                ->groupBy('service_id')->orderByDesc('order_count')->limit(20)
                ->with('service:id,name')->get(),
            'order_count'
        );

        $topServicesByCharge = $this->mapServiceRows(
            Order::select('service_id', DB::raw('SUM(charge) as total_charge'))
                ->whereYear('created_at', $year)->whereMonth('created_at', Carbon::now()->month)
                ->groupBy('service_id')->orderByDesc('total_charge')->limit(20)
                ->with('service:id,name')->get(),
            'total_charge'
        );

        // Raw orders for last 12 months — used by JS client-side filter
        $rawOrders = Order::select('service_id', 'user_id', 'charge', DB::raw('DATE(created_at) as order_date'))
            ->where('created_at', '>=', Carbon::now()->subYear()->startOfDay())
            ->with([
                'service:id,name,image,category_id',
                'service.category:id,platform_id',
                'service.category.platform:id,image',
                'user:id,username',
            ])
            ->get()
            ->map(fn($o) => [
                'service_id'    => $o->service_id,
                'service_label' => $this->resolveServiceName($o->service),
                'service_image' => $o->service?->image ?? $o->service?->category?->platform?->image ?? null,
                'user_id'       => $o->user_id,
                'username'      => $o->user?->username ?? 'N/A',
                'charge'        => (float) $o->charge,
                'date'          => $o->order_date,
            ]);

        return view('adminpanel.analytics.index', compact(
            'totalOrders', 'totalDeposit', 'statusCounts',
            'accountChartData', 'topServicesByCount', 'topServicesByCharge',
            'currentMonth', 'year', 'rawOrders'
        ));
    }
}
