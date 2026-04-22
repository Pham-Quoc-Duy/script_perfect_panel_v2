@extends('admin.layouts.app')

@section('title', 'Quản lý Child Panels')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Quản lý Child Panels',
                    'breadcrumb' => 'Child Panels',
                ])

                @include('admin.components.alert')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Table Container -->
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
                                            <tr class="bg-transparent">
                                                <th style="width: 30px;">
                                                    <div class="form-check font-size-16">
                                                        <input type="checkbox" name="check"
                                                            class="form-check-input checkAll-panels"
                                                            id="checkAll-panels">
                                                        <label class="form-check-label"
                                                            for="checkAll-panels"></label>
                                                    </div>
                                                </th>
                                                <th style="width: 80px;">ID</th>
                                                <th>Domain</th>
                                                <th>Người dùng</th>
                                                <th>Giá</th>
                                                <th>Trạng thái</th>
                                                <th>Ngày tạo</th>
                                                <th style="width: 140px;">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sortablePanels">
                                            @forelse ($childPanels ?? [] as $panel)
                                                <tr class="panel-row {{ $panel->status === 'suspended' ? 'panel-disabled' : '' }}" 
                                                    data-id="{{ $panel->id }}"
                                                    data-status="{{ $panel->status }}">
                                                    <td>
                                                        <div class="form-check font-size-16">
                                                            <input type="checkbox"
                                                                class="form-check-input panel-checkbox"
                                                                value="{{ $panel->id }}">
                                                            <label class="form-check-label"></label>
                                                        </div>
                                                    </td>

                                                    <td>#{{ $panel->id }}</td>

                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h6 class="mb-0">{{ $panel->domain_panel }}</h6>
                                                                <small class="text-muted">{{ $panel->domain_panel }}</small>
                                                            </div>
                                                            <div class="d-flex gap-1">
                                                                <!-- Nút Visit Domain -->
                                                                <a href="https://{{ $panel->domain_panel }}" target="_blank" 
                                                                    class="btn btn-sm btn-outline-primary" title="Truy cập domain">
                                                                    <i class="bx bx-link-external"></i>
                                                                </a>
                                                                <!-- Nút Copy Domain -->
                                                                <button type="button" class="btn btn-sm btn-outline-secondary copy-domain-btn" 
                                                                    title="Sao chép domain"
                                                                    data-domain="{{ $panel->domain_panel }}">
                                                                    <i class="bx bx-copy"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <small>{{ $panel->user->name ?? 'N/A' }}</small><br>
                                                        <small class="text-muted">{{ $panel->user->email ?? 'N/A' }}</small>
                                                    </td>

                                                    <td>
                                                        <span class="fw-bold text-success">${{ number_format($panel->price, 2) }}</span>
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-{{ $panel->status_color }}">
                                                            {{ $panel->status_label }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <small>{{ $panel->created_at->format('d/m/Y H:i') }}</small>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <!-- Nút Create Domain -->
                                                            <button type="button" class="btn btn-sm btn-outline-info create-domain-btn"
                                                                title="Tạo domain"
                                                                data-panel-id="{{ $panel->id }}"
                                                                data-domain="{{ $panel->domain_panel }}">
                                                                <i class="bx bx-plus"></i>
                                                            </button>

                                                            <!-- Nút Approve -->
                                                            @if($panel->status === 'pending')
                                                                <button type="button" class="btn btn-sm btn-outline-success approve-btn"
                                                                    title="Phê duyệt"
                                                                    data-panel-id="{{ $panel->id }}">
                                                                    <i class="bx bx-check"></i>
                                                                </button>
                                                            @endif

                                                            <!-- Nút Suspend -->
                                                            @if($panel->status !== 'suspended')
                                                                <button type="button" class="btn btn-sm btn-outline-warning suspend-btn"
                                                                    title="Tạm dừng"
                                                                    data-panel-id="{{ $panel->id }}">
                                                                    <i class="bx bx-pause"></i>
                                                                </button>
                                                            @endif

                                                            <!-- Nút Xóa -->
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-danger delete-panel-btn"
                                                                title="Xóa"
                                                                data-panel-id="{{ $panel->id }}"
                                                                data-panel-name="{{ $panel->domain_panel }}"
                                                                data-zone-id="{{ $panel->cloudflare_zone_id ?? '' }}">
                                                                <i class="bx bx-trash"></i>
                                                            </button>

                                                            <!-- Hidden delete form -->
                                                            <form id="delete-form-{{ $panel->id }}"
                                                                action="{{ route('admin.child-panels.destroy', $panel) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="empty-state-row">
                                                    <td colspan="8" class="text-center py-5">
                                                        <div class="text-muted">
                                                            <i class="bx bx-inbox display-4 mb-3" style="display: block;"></i>
                                                            <h6>Không có dữ liệu child panel nào</h6>
                                                            <p class="small">Hiện tại không có child panel nào trong hệ thống.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Pagination -->
                            @if($childPanels && $childPanels->hasPages())
                                <div class="card-footer">
                                    <div class="d-flex justify-content-center">
                                        {{ $childPanels->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTables only if there's data
        const $table = $('#datatable');
        const $tbody = $('#sortablePanels');
        const hasData = $tbody.find('tr:not(.empty-state-row)').length > 0;
        
        if ($table.length && hasData) {
            try {
                $table.DataTable({
                    responsive: true,
                    ordering: false,
                    paging: false,
                    searching: false,
                    info: false,
                    columnDefs: [
                        { targets: 0, orderable: false },
                        { targets: -1, orderable: false }
                    ]
                });
            } catch (e) {
                console.warn('DataTables initialization warning:', e.message);
            }
        }

        // Checkbox functionality
        $('#checkAll-panels').change(function() {
            $('.panel-checkbox').prop('checked', $(this).is(':checked'));
        });

        $('.panel-checkbox').change(function() {
            var total = $('.panel-checkbox').length;
            var checked = $('.panel-checkbox:checked').length;
            $('#checkAll-panels').prop('checked', total === checked);
            $('#checkAll-panels').prop('indeterminate', checked > 0 && checked < total);
        });

        // Approve button
        $(document).on('click', '.approve-btn', function() {
            const panelId = $(this).data('panel-id');
            alertify.confirm('Xác nhận phê duyệt', 'Bạn có chắc chắn muốn phê duyệt child panel này?',
                function() {
                    $.ajax({
                        url: `/admin/child-panels/${panelId}/approve`,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                alertify.success(response.message || 'Phê duyệt thành công!');
                                setTimeout(() => location.reload(), 1500);
                            } else {
                                alertify.error(response.message || 'Có lỗi xảy ra');
                            }
                        },
                        error: function() {
                            alertify.error('Có lỗi xảy ra khi phê duyệt');
                        }
                    });
                },
                function() {
                    alertify.error('Đã hủy thao tác phê duyệt');
                }
            );
        });

        // Suspend button
        $(document).on('click', '.suspend-btn', function() {
            const panelId = $(this).data('panel-id');
            alertify.confirm('Xác nhận tạm dừng', 'Bạn có chắc chắn muốn tạm dừng child panel này?',
                function() {
                    $.ajax({
                        url: `/admin/child-panels/${panelId}/suspend`,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                alertify.success(response.message || 'Tạm dừng thành công!');
                                setTimeout(() => location.reload(), 1500);
                            } else {
                                alertify.error(response.message || 'Có lỗi xảy ra');
                            }
                        },
                        error: function() {
                            alertify.error('Có lỗi xảy ra khi tạm dừng');
                        }
                    });
                },
                function() {
                    alertify.error('Đã hủy thao tác tạm dừng');
                }
            );
        });

        // Delete button
        $(document).on('click', '.delete-panel-btn', function() {
            const panelId = $(this).data('panel-id');
            const panelName = $(this).data('panel-name');
            const zoneId = $(this).data('zone-id');
            
            alertify.confirm('Xác nhận xóa child panel', `Bạn có chắc chắn muốn xóa child panel "${panelName}"? Hành động này không thể hoàn tác.`,
                function() {
                    alertify.success('Đang xóa child panel...');
                    
                    $.ajax({
                        url: `/admin/child-panels/${panelId}`,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            zone_id: zoneId
                        },
                        success: function(response) {
                            if (response.success) {
                                alertify.success(response.message || 'Xóa child panel thành công!');
                                setTimeout(() => location.reload(), 1500);
                            } else {
                                alertify.error(response.message || 'Có lỗi xảy ra');
                            }
                        },
                        error: function(xhr) {
                            const errorMsg = xhr.responseJSON?.message || 'Có lỗi xảy ra khi xóa child panel';
                            alertify.error(errorMsg);
                        }
                    });
                },
                function() {
                    alertify.error('Đã hủy thao tác xóa');
                }
            );
        });

        // Create Domain button
        $(document).on('click', '.create-domain-btn', function() {
            const domain = $(this).data('domain');
            const panelId = $(this).data('panel-id');
            
            if (!domain) {
                alertify.error('Không tìm thấy domain');
                return;
            }
            
            // Validate domain format
            const domainRegex = /^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,}$/;
            if (!domainRegex.test(domain)) {
                alertify.error('Định dạng domain không hợp lệ');
                return;
            }
            
            alertify.confirm('Xác nhận tạo domain', `Bạn có chắc chắn muốn tạo domain "${domain}"?`,
                function() {
                    alertify.success('Đang tạo domain panel...');
                    
                    $.ajax({
                        url: '/admin/child-panels/create-domain',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            domain: domain
                        },
                        success: function(response) {
                            if (response.success) {
                                alertify.success(response.message || 'Tạo domain panel thành công!');
                                setTimeout(() => location.reload(), 1500);
                            } else {
                                alertify.error(response.message || 'Có lỗi xảy ra');
                            }
                        },
                        error: function(xhr) {
                            const errorMsg = xhr.responseJSON?.message || 'Có lỗi xảy ra khi tạo domain panel';
                            alertify.error(errorMsg);
                        }
                    });
                },
                function() {
                    alertify.error('Đã hủy thao tác tạo domain');
                }
            );
        });

        // Copy domain button
        $(document).on('click', '.copy-domain-btn', function() {
            const domain = $(this).data('domain');
            
            // Copy to clipboard
            navigator.clipboard.writeText(domain).then(function() {
                alertify.success('Domain copied to clipboard: ' + domain);
            }).catch(function(err) {
                alertify.error('Failed to copy domain');
            });
        });
    });
</script>
@endpush

<style>
    /* Panel row styling based on status */
    .panel-row {
        transition: all 0.3s ease;
    }

    /* Disabled panel row */
    .panel-row.panel-disabled {
        background-color: #f8f9fa !important;
        opacity: 0.7;
    }

    .panel-row.panel-disabled td {
        color: #6c757d;
    }

    .panel-row.panel-disabled h6 {
        color: #6c757d;
    }

    /* Hover effect for disabled rows */
    .panel-row.panel-disabled:hover {
        background-color: #e9ecef !important;
        opacity: 0.85;
    }

    /* Table loader overlay styling */
    .table-loader-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.95);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        border-radius: 0.25rem;
    }

    .loader-content {
        text-align: center;
    }

    .loading-animation {
        margin-bottom: 20px;
    }

    .platform-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .platform-icon {
        font-size: 32px;
        color: #0d6efd;
        animation: bounce 1.4s infinite;
    }

    .platform-icon:nth-child(1) { animation-delay: var(--delay, 0s); }
    .platform-icon:nth-child(2) { animation-delay: var(--delay, 0.2s); }
    .platform-icon:nth-child(3) { animation-delay: var(--delay, 0.4s); }
    .platform-icon:nth-child(4) { animation-delay: var(--delay, 0.6s); }

    @keyframes bounce {
        0%, 80%, 100% {
            transform: translateY(0);
            opacity: 0.7;
        }
        40% {
            transform: translateY(-10px);
            opacity: 1;
        }
    }

    .loading-progress {
        width: 200px;
        height: 4px;
        background: #e9ecef;
        border-radius: 2px;
        overflow: hidden;
        margin: 0 auto 15px;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #0d6efd, #0dcaf0);
        animation: progress 2s infinite;
    }

    @keyframes progress {
        0% {
            width: 0;
        }
        50% {
            width: 100%;
        }
        100% {
            width: 0;
        }
    }

    .loading-title {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .loading-subtitle {
        font-size: 0.875rem;
    }
</style>
