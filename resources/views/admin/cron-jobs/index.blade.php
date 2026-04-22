@extends('admin.layouts.app')

@section('title', 'Danh sách Cron Jobs')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Danh sách Cron Jobs',
                    'breadcrumb' => 'Cron Jobs',
                ])

                @include('admin.components.alert')

                <!-- Alert -->
                <div id="alert-container"></div>

                <!-- Cron URLs -->
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-transparent border-bottom">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-info bg-soft text-info rounded-circle">
                                            <i class="bx bx-link-alt"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-1 fw-semibold">Đường dẫn Cron Jobs</h5>
                                        <p class="text-muted mb-0 font-size-13">Danh sách đường dẫn cron cho từng nhà cung cấp</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Cron Type: Status/Orders -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-2">
                                            <span class="avatar-title bg-primary bg-soft text-primary rounded-circle">
                                                <i class="bx bx-refresh"></i>
                                            </span>
                                        </div>
                                        <h6 class="mb-0 fw-semibold">Cập nhật trạng thái đơn hàng (Status/Orders)</h6>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover table-nowrap align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 50px;">ID</th>
                                                    <th style="width: 200px;">Nhà cung cấp</th>
                                                    <th>Cron URL</th>
                                                    <th style="width: 100px;" class="text-center">Trạng thái</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($providers as $provider)
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-primary-subtle text-primary">{{ $provider->id }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-xs me-2">
                                                                    <span class="avatar-title bg-soft-primary text-primary rounded-circle font-size-12">
                                                                        {{ strtoupper(substr($provider->name, 0, 2)) }}
                                                                    </span>
                                                                </div>
                                                                <span class="fw-medium">{{ $provider->name }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <code class="text-dark bg-light px-2 py-1 rounded font-size-11 flex-grow-1" 
                                                                      id="status-url-{{ $provider->id }}">{{ url('/crons/status/orders?provider=' . $provider->id) }}</code>
                                                                <button class="btn btn-sm btn-link text-primary ms-2 p-0" 
                                                                        onclick="copyToClipboard('{{ url('/crons/status/orders?provider=' . $provider->id) }}')" 
                                                                        title="Sao chép">
                                                                    <i class="bx bx-copy font-size-16"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            @if($provider->status)
                                                                <span class="badge bg-success-subtle text-success">
                                                                    <i class="bx bx-check-circle me-1"></i>Active
                                                                </span>
                                                            @else
                                                                <span class="badge bg-danger-subtle text-danger">
                                                                    <i class="bx bx-x-circle me-1"></i>Inactive
                                                                </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center text-muted py-4">
                                                            <i class="bx bx-info-circle font-size-20 d-block mb-2"></i>
                                                            Chưa có nhà cung cấp nào
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Cron Type: Sync/Services -->
                                <div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-2">
                                            <span class="avatar-title bg-success bg-soft text-success rounded-circle">
                                                <i class="bx bx-sync"></i>
                                            </span>
                                        </div>
                                        <h6 class="mb-0 fw-semibold">Đồng bộ dịch vụ (Sync/Services)</h6>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover table-nowrap align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 50px;">ID</th>
                                                    <th style="width: 200px;">Nhà cung cấp</th>
                                                    <th>Cron URL</th>
                                                    <th style="width: 100px;" class="text-center">Trạng thái</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($providers as $provider)
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-success-subtle text-success">{{ $provider->id }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-xs me-2">
                                            <span class="avatar-title bg-success bg-soft text-success rounded-circle">
                                                <i class="bx bx-sync"></i>
                                            </span>
                                        </div>
                                                                <span class="fw-medium">{{ $provider->name }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <code class="text-dark bg-light px-2 py-1 rounded font-size-11 flex-grow-1" 
                                                                      id="sync-url-{{ $provider->id }}">{{ url('/crons/sync/services?provider=' . $provider->id) }}</code>
                                                                <button class="btn btn-sm btn-link text-success ms-2 p-0" 
                                                                        onclick="copyToClipboard('{{ url('/crons/sync/services?provider=' . $provider->id) }}')" 
                                                                        title="Sao chép">
                                                                    <i class="bx bx-copy font-size-16"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            @if($provider->status)
                                                                <span class="badge bg-success-subtle text-success">
                                                                    <i class="bx bx-check-circle me-1"></i>Active
                                                                </span>
                                                            @else
                                                                <span class="badge bg-danger-subtle text-danger">
                                                                    <i class="bx bx-x-circle me-1"></i>Inactive
                                                                </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center text-muted py-4">
                                                            <i class="bx bx-info-circle font-size-20 d-block mb-2"></i>
                                                            Chưa có nhà cung cấp nào
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Info Alert -->
                                <div class="alert alert-info border-0 mt-4 mb-0" role="alert">
                                    <div class="d-flex align-items-start">
                                        <i class="bx bx-info-circle font-size-20 me-2 mt-1"></i>
                                        <div>
                                            <h6 class="alert-heading font-size-14 mb-2">Hướng dẫn sử dụng Cron Jobs</h6>
                                            <ul class="mb-0 font-size-13 ps-3">
                                                <li class="mb-1"><strong>Status/Orders:</strong> Cập nhật trạng thái đơn hàng từ nhà cung cấp (nên chạy mỗi 5-10 phút)</li>
                                                <li class="mb-1"><strong>Sync/Services:</strong> Đồng bộ thông tin dịch vụ từ API (nên chạy mỗi 1-6 giờ)</li>
                                                <li class="mb-1">Sao chép URL và thêm vào cron job trên server của bạn</li>
                                                <li>Ví dụ crontab: <code class="text-dark">*/5 * * * * curl "{{ url('/crons/status/orders?provider=1') }}"</code></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showAlert(message, type = 'success') {
            const iconMap = {
                'success': 'bx-check-circle',
                'danger': 'bx-x-circle',
                'info': 'bx-info-circle',
                'warning': 'bx-error-circle'
            };
            
            const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bx ${iconMap[type] || 'bx-info-circle'} font-size-18 me-2"></i>
                        <span>${message}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            document.getElementById('alert-container').innerHTML = alertHtml;
            
            setTimeout(() => {
                const alert = document.querySelector('#alert-container .alert');
                if (alert) {
                    $(alert).fadeOut(300, function() {
                        $(this).remove();
                    });
                }
            }, 5000);
        }
        
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                showAlert('Đã sao chép đường dẫn vào clipboard!', 'success');
            }).catch(() => {
                showAlert('Không thể sao chép. Vui lòng thử lại!', 'danger');
            });
        }
    </script>
@endpush
