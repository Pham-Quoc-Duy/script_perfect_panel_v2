<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use App\Models\ApiProvider;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $currentYear = Carbon::now()->year;
        // $years       = range($currentYear + 1, 2020); //Lấy tù năm 2020 - năm hiển thị + 1
        $years       = [$currentYear + 1, $currentYear, $currentYear - 1]; //hiển thị năm trước ,nằm hiện tại + 1

        $services = Service::select('id', 'name')
            ->where('status', true)
            ->orderBy('id')
            ->get()
            ->map(fn($s) => [
                'id'   => $s->id,
                'name' => $s->id . ' - ' . (is_array($s->name) ? ($s->name['en'] ?? reset($s->name)) : $s->name),
            ]);

        $providers      = ApiProvider::select('id', 'name')->where('status', true)->orderBy('name')->get();
        $paymentMethods = PaymentMethod::select('id', 'name')->where('status', true)->orderBy('name')->get();

        // Raw payments — filter theo domain
        $rawPayments = Payment::select(
                'user_id',
                'payment_method_id',
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('DAY(created_at) as day'),
                DB::raw('SUM(total_amount) as total')
            )
            ->where('status', 'completed')
            ->where('domain', getDomain())
            ->groupBy('user_id', 'payment_method_id', 'year', 'month', 'day')
            ->get()
            ->map(fn($r) => [
                'user_id'   => (int) $r->user_id,
                'method_id' => (int) ($r->payment_method_id ?? 0),
                'year'      => (int) $r->year,
                'month'     => (int) $r->month,
                'day'       => (int) $r->day,
                'total'     => (float) $r->total,
            ]);

        // Raw orders — filter theo domain
        $rawOrders = Order::select(
                'orders.user_id',
                'orders.service_id',
                'orders.provider_name',
                'orders.status',
                DB::raw('YEAR(orders.created_at) as year'),
                DB::raw('MONTH(orders.created_at) as month'),
                DB::raw('DAY(orders.created_at) as day'),
                DB::raw('SUM(orders.total) as total'),
                DB::raw('SUM(orders.total) - SUM(COALESCE(services.rate_original, 0) * orders.quantity / 1000) as profit'),
                DB::raw('COUNT(*) as order_count'),
                DB::raw('SUM(orders.quantity) as quantity')
            )
            ->leftJoin('services', 'services.id', '=', 'orders.service_id')
            ->where('orders.domain', getDomain())
            ->groupBy('orders.user_id', 'orders.service_id', 'orders.provider_name', 'orders.status', 'year', 'month', 'day')
            ->get()
            ->map(fn($r) => [
                'user_id'     => (int) $r->user_id,
                'service_id'  => (int) $r->service_id,
                'provider'    => $r->provider_name ?? '',
                'status'      => $r->status,
                'year'        => (int) $r->year,
                'month'       => (int) $r->month,
                'day'         => (int) $r->day,
                'total'       => (float) $r->total,
                'profit'      => (float) $r->profit,
                'order_count' => (int) $r->order_count,
                'quantity'    => (int) $r->quantity,
            ]);

        $methodNames  = $paymentMethods->pluck('name', 'id');
        $serviceNames = $services->pluck('name', 'id');

        // Chỉ lấy users thuộc domain hiện tại có payments/orders
        $userIds   = $rawPayments->pluck('user_id')->merge($rawOrders->pluck('user_id'))->unique();
        $userNames = User::whereIn('id', $userIds)
            ->where('domain', getDomain())
            ->pluck('username', 'id');

        return view('adminpanel.reports.index', compact(
            'years', 'services', 'providers', 'paymentMethods',
            'rawPayments', 'rawOrders', 'methodNames', 'serviceNames', 'userNames',
            'currentYear'
        ));
    }

    public function analytics()
    {
        return view('admin.reports.analytics');
    }

    public function export()
    {
        return response()->download('path/to/report.csv');
    }
}
