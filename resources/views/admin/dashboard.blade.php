@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('admin.components.breadcrumb', ['title' => 'Dashboard', 'breadcrumb' => 'Tổng quan'])
            @include('admin.components.alert')

            <!-- Time Period Filter -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="period-filter">
                        <button type="button" class="period-btn active" data-period="day">Hôm nay</button>
                        <button type="button" class="period-btn" data-period="week">Tuần này</button>
                        <button type="button" class="period-btn" data-period="month">Tháng này</button>
                        <button type="button" class="period-btn" data-period="year">Năm nay</button>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="quick-actions">
                        <a href="{{ route('admin.users.index') }}" class="action-btn action-btn-primary">
                            <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            <span>Người dùng</span>
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="action-btn action-btn-success">
                            <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                            <span>Đơn hàng</span>
                        </a>
                        <a href="{{ route('admin.services.index') }}" class="action-btn action-btn-info">
                            <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            <span>Dịch vụ</span>
                        </a>
                        <a href="{{ route('admin.transactions.index') }}" class="action-btn action-btn-warning">
                            <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            <span>Giao dịch</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Statistics Grid -->
            <div class="row">
                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="stat-card stat-card-primary animate-slide-up" style="animation-delay: 0.1s;">
                        <div class="stat-card-content">
                            <div class="stat-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </div>
                            <div class="stat-card-info">
                                <p class="stat-card-label">Tổng người dùng</p>
                                <h3 class="stat-card-value counter" data-target="{{ $totalUsers ?? 0 }}">0</h3>
                                <span class="stat-card-change">+12% từ tuần trước</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="stat-card stat-card-success animate-slide-up" style="animation-delay: 0.2s;">
                        <div class="stat-card-content">
                            <div class="stat-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                            </div>
                            <div class="stat-card-info">
                                <p class="stat-card-label">Tổng đơn hàng</p>
                                <h3 class="stat-card-value counter" data-target="{{ $totalOrders ?? 0 }}">0</h3>
                                <span class="stat-card-change">+8% từ tuần trước</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="stat-card stat-card-info animate-slide-up" style="animation-delay: 0.3s;">
                        <div class="stat-card-content">
                            <div class="stat-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </div>
                            <div class="stat-card-info">
                                <p class="stat-card-label">Tổng dịch vụ</p>
                                <h3 class="stat-card-value counter" data-target="{{ $totalServices ?? 0 }}">0</h3>
                                <span class="stat-card-change">Hoạt động</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="stat-card stat-card-warning animate-slide-up" style="animation-delay: 0.4s;">
                        <div class="stat-card-content">
                            <div class="stat-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            </div>
                            <div class="stat-card-info">
                                <p class="stat-card-label">Tổng doanh thu</p>
                                <h3 class="stat-card-value">{{ number_format($totalRevenue ?? 0, 0, ',', '.') }}đ</h3>
                                <span class="stat-card-change">+15% từ tuần trước</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Statistics -->
            <div class="row mt-2">
                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="stat-card stat-card-success animate-slide-up" style="animation-delay: 0.5s;">
                        <div class="stat-card-content">
                            <div class="stat-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </div>
                            <div class="stat-card-info">
                                <p class="stat-card-label">Hoàn thành</p>
                                <h3 class="stat-card-value counter" data-target="{{ $completedOrders ?? 0 }}">0</h3>
                                <span class="stat-card-change">Hôm nay</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="stat-card stat-card-warning animate-slide-up" style="animation-delay: 0.6s;">
                        <div class="stat-card-content">
                            <div class="stat-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            </div>
                            <div class="stat-card-info">
                                <p class="stat-card-label">Đang xử lý</p>
                                <h3 class="stat-card-value counter" data-target="{{ $pendingOrders ?? 0 }}">0</h3>
                                <span class="stat-card-change">Cần xử lý</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="stat-card stat-card-info animate-slide-up" style="animation-delay: 0.7s;">
                        <div class="stat-card-content">
                            <div class="stat-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                            </div>
                            <div class="stat-card-info">
                                <p class="stat-card-label">Người dùng mới</p>
                                <h3 class="stat-card-value counter" data-target="{{ $newUsers ?? 0 }}">0</h3>
                                <span class="stat-card-change">Tuần này</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="stat-card stat-card-primary animate-slide-up" style="animation-delay: 0.8s;">
                        <div class="stat-card-content">
                            <div class="stat-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="2" x2="12" y2="22"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            </div>
                            <div class="stat-card-info">
                                <p class="stat-card-label">Tỷ lệ hoàn thành</p>
                                <h3 class="stat-card-value">{{ $completionRate ?? 0 }}%</h3>
                                <span class="stat-card-change">Hiệu suất</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row mt-4">
                <div class="col-xl-6 mb-4">
                    <div class="chart-card">
                        <div class="chart-card-header">
                            <h5 class="chart-card-title">
                                <svg class="chart-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 17"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                                Thống kê đơn hàng
                            </h5>
                        </div>
                        <div class="chart-card-body">
                            <canvas id="ordersChart" height="80"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 mb-4">
                    <div class="chart-card">
                        <div class="chart-card-header">
                            <h5 class="chart-card-title">
                                <svg class="chart-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                Thống kê doanh thu
                            </h5>
                        </div>
                        <div class="chart-card-body">
                            <canvas id="revenueChart" height="80"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Data Tables -->
            <div class="row mt-4">
                <div class="col-xl-6 mb-4">
                    <div class="data-card">
                        <div class="data-card-header">
                            <h5 class="data-card-title">
                                <svg class="data-card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                Đơn hàng gần đây
                            </h5>
                            <a href="{{ route('admin.orders.index') }}" class="view-all-link">Xem tất cả →</a>
                        </div>
                        <div class="data-card-body">
                            @if(isset($recentOrders) && $recentOrders->count() > 0)
                                <div class="table-responsive">
                                    <table class="data-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Khách hàng</th>
                                                <th>Dịch vụ</th>
                                                <th>Trạng thái</th>
                                                <th>Ngày</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentOrders as $order)
                                            <tr>
                                                <td><span class="order-id">#{{ $order->id }}</span></td>
                                                <td><span class="customer-name">{{ Str::limit($order->user->name ?? 'N/A', 15) }}</span></td>
                                                <td>
                                                    @php
                                                        $serviceName = $order->service->name ?? 'N/A';
                                                        if (is_array($serviceName)) {
                                                            $serviceName = reset($serviceName) ?? 'N/A';
                                                        }
                                                        $serviceName = (string) $serviceName;
                                                    @endphp
                                                    <span class="service-name">{{ Str::limit($serviceName, 20) }}</span>
                                                </td>
                                                <td>
                                                    @if($order->status == 'completed')
                                                        <span class="status-badge status-completed">Hoàn thành</span>
                                                    @elseif($order->status == 'pending')
                                                        <span class="status-badge status-pending">Đang xử lý</span>
                                                    @else
                                                        <span class="status-badge status-cancelled">Hủy</span>
                                                    @endif
                                                </td>
                                                <td><span class="order-date">{{ $order->created_at->format('d/m/Y') }}</span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="empty-state">
                                    <svg class="empty-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                    <p>Chưa có đơn hàng</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 mb-4">
                    <div class="data-card">
                        <div class="data-card-header">
                            <h5 class="data-card-title">
                                <svg class="data-card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                Thành viên mới
                            </h5>
                            <a href="{{ route('admin.users.index') }}" class="view-all-link">Xem tất cả →</a>
                        </div>
                        <div class="data-card-body">
                            @if(isset($recentUsers) && $recentUsers->count() > 0)
                                <div class="table-responsive">
                                    <table class="data-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên</th>
                                                <th>Email</th>
                                                <th>Ngày đăng ký</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentUsers as $user)
                                            <tr>
                                                <td><span class="user-id">#{{ $user->id }}</span></td>
                                                <td><span class="user-name">{{ Str::limit($user->name, 15) }}</span></td>
                                                <td><span class="user-email">{{ Str::limit($user->email, 20) }}</span></td>
                                                <td><span class="user-date">{{ $user->created_at->format('d/m/Y') }}</span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="empty-state">
                                    <svg class="empty-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <p>Chưa có thành viên mới</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-up {
        animation: slideUp 0.6s ease-out forwards;
        opacity: 0;
    }

    /* Period Filter */
    .period-filter {
        display: flex;
        gap: 12px;
        padding: 16px;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .period-btn {
        padding: 8px 16px;
        border: 2px solid #e5e7eb;
        background: white;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .period-btn:hover {
        border-color: #5156be;
        color: #5156be;
    }

    .period-btn.active {
        background: #5156be;
        color: white;
        border-color: #5156be;
    }

    /* Quick Actions */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 16px;
    }

    .action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 14px;
        gap: 8px;
    }

    .action-btn-primary {
        background: linear-gradient(135deg, #5156be 0%, #7c3aed 100%);
        color: white;
    }

    .action-btn-success {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: white;
    }

    .action-btn-info {
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        color: white;
    }

    .action-btn-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        color: white;
    }

    .action-btn:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .action-icon {
        width: 24px;
        height: 24px;
    }

    /* Stat Card */
    .stat-card {
        border-radius: 12px;
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        border-left: 4px solid #5156be;
    }

    .stat-card-primary {
        border-left-color: #5156be;
    }

    .stat-card-success {
        border-left-color: #10b981;
    }

    .stat-card-info {
        border-left-color: #0ea5e9;
    }

    .stat-card-warning {
        border-left-color: #f59e0b;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
    }

    .stat-card-content {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px;
    }

    .stat-card-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #f3f4f6;
    }

    .stat-card-primary .stat-card-icon {
        background: rgba(81, 86, 190, 0.1);
        color: #5156be;
    }

    .stat-card-success .stat-card-icon {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .stat-card-info .stat-card-icon {
        background: rgba(14, 165, 233, 0.1);
        color: #0ea5e9;
    }

    .stat-card-warning .stat-card-icon {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .stat-card-icon svg {
        width: 24px;
        height: 24px;
        stroke-width: 2;
    }

    .stat-card-info {
        flex: 1;
    }

    .stat-card-label {
        font-size: 12px;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0 0 8px 0;
    }

    .stat-card-value {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 6px 0;
    }

    .stat-card-change {
        font-size: 12px;
        color: #6b7280;
    }

    /* Data Card */
    .data-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .data-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #f3f4f6;
    }

    .data-card-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
    }

    .data-card-icon {
        width: 20px;
        height: 20px;
        color: #5156be;
    }

    .view-all-link {
        font-size: 13px;
        color: #5156be;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .view-all-link:hover {
        color: #7c3aed;
    }

    .data-card-body {
        padding: 0;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead {
        background: #f9fafb;
    }

    .data-table th {
        padding: 12px 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #e5e7eb;
    }

    .data-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #f3f4f6;
        font-size: 14px;
    }

    .data-table tbody tr:hover {
        background: #f9fafb;
    }

    .order-id, .user-id {
        font-weight: 600;
        color: #5156be;
    }

    .customer-name, .user-name {
        font-weight: 500;
        color: #1f2937;
    }

    .service-name, .user-email {
        color: #6b7280;
    }

    .order-date, .user-date {
        color: #9ca3af;
        font-size: 13px;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-completed {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .status-cancelled {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        color: #9ca3af;
    }

    .empty-icon {
        width: 48px;
        height: 48px;
        margin-bottom: 12px;
        opacity: 0.5;
    }

    .empty-state p {
        margin: 0;
        font-size: 14px;
    }

    .counter {
        font-weight: 700;
        color: #1f2937;
    }

    /* Chart Card */
    .chart-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .chart-card-header {
        padding: 20px;
        border-bottom: 1px solid #f3f4f6;
    }

    .chart-card-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
    }

    .chart-icon {
        width: 20px;
        height: 20px;
        color: #5156be;
    }

    .chart-card-body {
        padding: 20px;
        position: relative;
        height: 300px;
    }
</style>

<script>
    // Counter Animation
    function animateCounter() {
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const increment = target / 50;
            let current = 0;

            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    counter.textContent = Math.floor(current).toLocaleString();
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target.toLocaleString();
                }
            };

            updateCounter();
        });
    }

    // Period Filter
    document.querySelectorAll('.period-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const period = this.getAttribute('data-period');
            console.log('Period selected:', period);
        });
    });

    // Chart.js Configuration
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    font: { size: 12, weight: '500' },
                    color: '#6b7280',
                    padding: 15,
                    usePointStyle: true
                }
            },
            filler: {
                propagate: true
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#f3f4f6',
                    drawBorder: false
                },
                ticks: {
                    font: { size: 12 },
                    color: '#9ca3af'
                }
            },
            x: {
                grid: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    font: { size: 12 },
                    color: '#9ca3af'
                }
            }
        }
    };

    // Orders Chart
    const ordersCtx = document.getElementById('ordersChart');
    if (ordersCtx) {
        new Chart(ordersCtx, {
            type: 'line',
            data: {
                labels: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'],
                datasets: [
                    {
                        label: 'Đơn hàng hoàn thành',
                        data: [65, 78, 90, 81, 95, 88, 92],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Đơn hàng đang xử lý',
                        data: [45, 52, 48, 61, 55, 67, 58],
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointBackgroundColor: '#f59e0b',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 7
                    }
                ]
            },
            options: chartOptions
        });
    }

    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart');
    if (revenueCtx) {
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'],
                datasets: [
                    {
                        label: 'Doanh thu (triệu đ)',
                        data: [2.5, 3.2, 2.8, 4.1, 3.9, 4.5, 5.2],
                        borderColor: '#5156be',
                        backgroundColor: 'rgba(81, 86, 190, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointBackgroundColor: '#5156be',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 7
                    }
                ]
            },
            options: chartOptions
        });
    }

    document.addEventListener('DOMContentLoaded', animateCounter);
</script>

@endsection
