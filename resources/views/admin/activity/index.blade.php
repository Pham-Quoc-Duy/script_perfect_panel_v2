@extends('admin.layouts.app')

@section('title', 'Lịch sử hoạt động')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Lịch sử hoạt động',
                    'breadcrumb' => 'Activity Logs',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">
                                        <i class="bx bx-history me-2"></i>Lịch sử hoạt động
                                    </h4>
                                </div>
                            </div>

                            <div class="card-body">
                              
                                <!-- Table Container -->
                                <div class="table-responsive position-relative">
                                    <!-- Table Loader Overlay -->
                                   <div class="table-responsive position-relative">
                                        <!-- Table Loader Overlay -->
                                        <div id="tableLoader" class="table-loader-overlay" style="display: none;">
                                            <div class="loader-content">
                                                <div class="loading-animation">
                                                    <div class="platform-icons">
                                                        <i class="bx bx-server platform-icon" style="--delay: 0s;"></i>
                                                        <i class="bx bx-devices platform-icon" style="--delay: 0.2s;"></i>
                                                        <i class="bx bx-desktop platform-icon" style="--delay: 0.4s;"></i>
                                                        <i class="bx bx-mobile platform-icon" style="--delay: 0.6s;"></i>
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
                                        <table id="datatable"
                                            class="table align-middle datatable dt-responsive table-check nowrap"
                                            style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th style="width: 80px;" class="text-center">ID</th>
                                                <th style="width: 180px;">Người dùng</th>
                                                <th style="width: 130px;">Loại</th>
                                                <th>Hoạt động</th>
                                                <th style="width: 180px;">Thời gian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($logs ?? [] as $log)
                                                <tr class="border-bottom">
                                                    <td class="text-center">
                                                        <span class="badge bg-soft-secondary text-secondary font-size-11 px-2 py-1">
                                                            #{{ $log->id }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($log->user)
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-xs me-2">
                                                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-14">
                                                                        {{ strtoupper(substr($log->user->name, 0, 1)) }}
                                                                    </span>
                                                                </div>
                                                                <div>
                                                                    <h6 class="mb-0 font-size-13">{{ $log->user->name }}</h6>
                                                                    <small class="text-muted">{{ $log->user->email }}</small>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span class="text-muted font-size-12">
                                                                <i class="bx bx-user-x me-1"></i>Không xác định
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $typeColors = [
                                                                'create' => 'success',
                                                                'update' => 'info',
                                                                'delete' => 'danger',
                                                                'login' => 'primary',
                                                                'logout' => 'warning',
                                                            ];
                                                            $color = $typeColors[strtolower($log->type)] ?? 'secondary';
                                                        @endphp
                                                        <span class="badge bg-soft-{{ $color }} text-{{ $color }} font-size-12 px-3 py-2">
                                                            <i class="bx bx-{{ $color === 'success' ? 'plus-circle' : ($color === 'danger' ? 'trash' : ($color === 'info' ? 'edit' : 'dot-circle-alt')) }} me-1"></i>
                                                            {{ ucfirst($log->type) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div style="max-width: 500px;">
                                                            <div class="p-3 bg-light border-start border-4 border-primary rounded overflow-auto" style="max-height: 100px;">
                                                                <p class="mb-0 text-muted small lh-base text-wrap">
                                                                    @if(is_array($log->activity))
                                                                        @if(isset($log->activity['ip_address']))
                                                                            <strong>IP:</strong> {{ $log->activity['ip_address'] }}<br>
                                                                        @endif
                                                                        @if(isset($log->activity['user_agent']))
                                                                            <strong>Trình duyệt:</strong> {{ Str::limit($log->activity['user_agent'], 60) }}
                                                                        @endif
                                                                    @else
                                                                        {{ $log->activity }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column gap-1">
                                                            <div class="d-flex align-items-center">
                                                                <i class="bx bx-calendar text-primary me-2" style="font-size: 16px;"></i>
                                                                <span class="text-dark fw-medium" style="font-size: 13px;">
                                                                    {{ $log->created_at ? $log->created_at->format('d/m/Y') : '-' }}
                                                                </span>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <i class="bx bx-time text-success me-2" style="font-size: 16px;"></i>
                                                                <span class="text-dark" style="font-size: 13px;">
                                                                    {{ $log->created_at ? $log->created_at->format('H:i:s') : '-' }}
                                                                </span>
                                                            </div>
                                                            <small class="text-muted ms-4" style="font-size: 11px;">
                                                                <i class="bx bx-history me-1"></i>
                                                                {{ $log->created_at ? $log->created_at->diffForHumans() : '' }}
                                                            </small>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-5">
                                                        <div class="py-4">
                                                            <i class="bx bx-history display-4 text-muted mb-3 d-block"></i>
                                                            <h5 class="text-muted mb-2">Chưa có lịch sử hoạt động</h5>
                                                            <p class="text-muted mb-0">Các hoạt động của hệ thống sẽ được ghi lại tại đây</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if (isset($logs) && method_exists($logs, 'links'))
                                    <div class="mt-3">
                                        {{ $logs->appends(request()->query())->links() }}
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
