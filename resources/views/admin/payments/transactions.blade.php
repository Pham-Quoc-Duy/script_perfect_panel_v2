@extends('admin.layouts.app')

@section('title', 'Lịch sử giao dịch')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Lịch sử giao dịch',
                    'breadcrumb' => 'Transactions',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">
                                        <i class="bx bx-transfer me-2"></i>Lịch sử giao dịch
                                    </h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <!-- Table Container -->
                                <div class="table-responsive position-relative">
                                    <!-- Table Loader Overlay -->
                                    <div id="tableLoader" class="table-loader-overlay" style="display: none;">
                                        <div class="loader-content">
                                            <div class="loading-animation">
                                                <div class="platform-icons">
                                                    <i class="bx bx-transfer platform-icon" style="--delay: 0s;"></i>
                                                    <i class="bx bx-dollar-circle platform-icon" style="--delay: 0.2s;"></i>
                                                    <i class="bx bx-wallet platform-icon" style="--delay: 0.4s;"></i>
                                                    <i class="bx bx-credit-card platform-icon" style="--delay: 0.6s;"></i>
                                                </div>
                                                <div class="loading-progress">
                                                    <div class="progress-bar"></div>
                                                </div>
                                            </div>
                                            <h6 class="text-primary mb-2 loading-title">Đang tải dữ liệu...</h6>
                                            <p class="text-muted small loading-subtitle">Vui lòng chờ trong giây lát</p>
                                        </div>
                                    </div>

                                    <!-- Main Table -->
                                    <table id="datatable" class="table align-middle datatable dt-responsive table-check nowrap"
                                           style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="width: 80px;">ID</th>
                                                <th style="width: 200px;">Người dùng</th>
                                                <th style="width: 150px;">Loại</th>
                                                <th style="width: 150px;">Số tiền</th>
                                                <th style="width: 150px;">Phương thức</th>
                                                <th style="width: 130px;">Trạng thái</th>
                                                <th>Mô tả</th>
                                                <th style="width: 180px;">Thời gian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions ?? [] as $transaction)
                                                <tr>
                                                    <td>#{{ $transaction->id }}</td>
                                                    
                                                    <td>
                                                        @if($transaction->user)
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-xs me-2">
                                                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                        {{ strtoupper(substr($transaction->user->name, 0, 1)) }}
                                                                    </span>
                                                                </div>
                                                                <div>
                                                                    <h6 class="mb-0 font-size-13">{{ $transaction->user->name }}</h6>
                                                                    <small class="text-muted">{{ $transaction->user->email }}</small>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    
                                                    <td>
                                                        @php
                                                            $typeConfig = [
                                                                'deposit' => ['color' => 'success', 'icon' => 'bx-plus-circle', 'text' => 'Nạp tiền'],
                                                                'order' => ['color' => 'info', 'icon' => 'bx-shopping-bag', 'text' => 'Đơn hàng'],
                                                                'refund' => ['color' => 'warning', 'icon' => 'bx-undo', 'text' => 'Hoàn tiền'],
                                                            ];
                                                            $config = $typeConfig[$transaction->type] ?? ['color' => 'secondary', 'icon' => 'bx-circle', 'text' => ucfirst($transaction->type)];
                                                        @endphp
                                                        <span class="badge bg-soft-{{ $config['color'] }} text-{{ $config['color'] }} font-size-12">
                                                            <i class="bx {{ $config['icon'] }} me-1"></i>
                                                            {{ $config['text'] }}
                                                        </span>
                                                    </td>
                                                    
                                                    <td>
                                                        <span class="fw-bold text-{{ $transaction->type == 'deposit' ? 'success' : ($transaction->type == 'refund' ? 'warning' : 'danger') }}">
                                                            {{ $transaction->type == 'order' ? '-' : '+' }}${{ number_format($transaction->amount, 2) }}
                                                        </span>
                                                    </td>
                                                    
                                                    <td>
                                                        @if($transaction->payment_method)
                                                            <span class="badge bg-light text-dark font-size-11">
                                                                {{ strtoupper($transaction->payment_method) }}
                                                            </span>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    
                                                    <td>
                                                        @php
                                                            $statusConfig = [
                                                                'pending' => ['color' => 'warning', 'icon' => 'bx-time', 'text' => 'Đang chờ'],
                                                                'completed' => ['color' => 'success', 'icon' => 'bx-check-circle', 'text' => 'Hoàn thành'],
                                                                'failed' => ['color' => 'danger', 'icon' => 'bx-x-circle', 'text' => 'Thất bại'],
                                                            ];
                                                            $status = $statusConfig[$transaction->status] ?? ['color' => 'secondary', 'icon' => 'bx-circle', 'text' => ucfirst($transaction->status)];
                                                        @endphp
                                                        <span class="badge bg-soft-{{ $status['color'] }} text-{{ $status['color'] }}">
                                                            <i class="bx {{ $status['icon'] }} me-1"></i>
                                                            {{ $status['text'] }}
                                                        </span>
                                                    </td>
                                                    
                                                    <td>
                                                        <div class="overflow-auto" style="max-width: 300px; max-height: 60px;">
                                                            <small class="text-muted">
                                                                {{ $transaction->description ?? '-' }}
                                                            </small>
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                        <div class="d-flex flex-column gap-1">
                                                            <small class="text-dark">
                                                                <i class="bx bx-calendar text-primary me-1"></i>
                                                                {{ $transaction->created_at ? $transaction->created_at->format('d/m/Y') : '-' }}
                                                            </small>
                                                            <small class="text-muted">
                                                                <i class="bx bx-time text-success me-1"></i>
                                                                {{ $transaction->created_at ? $transaction->created_at->format('H:i:s') : '-' }}
                                                            </small>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center py-4">
                                                        <div class="text-muted">
                                                            <i class="bx bx-info-circle me-1"></i>
                                                            Không có dữ liệu giao dịch nào
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if (isset($transactions) && method_exists($transactions, 'links'))
                                    <div class="mt-3">
                                        {{ $transactions->appends(request()->query())->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
