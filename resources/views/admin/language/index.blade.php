@extends('admin.layouts.app')

@section('title', 'Quản lý ngôn ngữ')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Quản lý ngôn ngữ',
                    'breadcrumb' => 'Ngôn ngữ',
                ])

                @include('admin.components.alert')

                <!-- Language Management Card -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            @if ($languages && $languages->count() > 0)
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                            <thead>
                                                <tr class="bg-transparent">
                                                    <th style="width: 30px;">
                                                        <div class="form-check font-size-16">
                                                            <input type="checkbox" name="check" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Ngôn ngữ</th>
                                                    <th>Mã ngôn ngữ</th>
                                                    <th>Cờ</th>
                                                    <th>Trạng thái</th>
                                                    <th>Ngày tạo</th>
                                                    <th style="width: 80px;">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($languages as $language)
                                                    <tr class="language-row" data-language-id="{{ $language->id }}">
                                                        <!-- Checkbox -->
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input" value="{{ $language->id }}">
                                                                <label class="form-check-label"></label>
                                                            </div>
                                                        </td>

                                                        <!-- Language Info -->
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 me-3">
                                                                    @if($language->flag)
                                                                        <img src="{{ $language->flag }}" 
                                                                             alt="{{ $language->code }}" 
                                                                             class="avatar-sm rounded"
                                                                             style="width: 40px; height: 30px; object-fit: cover;">
                                                                    @else
                                                                        <div class="avatar-sm bg-light rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 30px;">
                                                                            <i class="bx bx-globe text-muted"></i>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-1 fw-semibold">{{ $language->name ?? 'N/A' }}</h6>
                                                                    <p class="text-muted mb-0 small">
                                                                        <span class="badge badge-soft-primary font-size-11 me-1">{{ $language->code ?? 'N/A' }}</span>
                                                                        ID: #{{ $language->id }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <!-- Language Code -->
                                                        <td>
                                                            <code class="bg-light px-2 py-1 rounded">{{ $language->code ?? 'N/A' }}</code>
                                                        </td>

                                                        <!-- Flag -->
                                                        <td>
                                                            @if($language->flag)
                                                                <img src="{{ $language->flag }}" 
                                                                     alt="{{ $language->code }}" 
                                                                     class="rounded border"
                                                                     style="width: 32px; height: 22px; object-fit: cover;">
                                                            @else
                                                                <div class="d-flex align-items-center justify-content-center bg-light rounded border" style="width: 32px; height: 22px;">
                                                                    <i class="bx bx-image text-muted font-size-12"></i>
                                                                </div>
                                                            @endif
                                                        </td>

                                                        <!-- Status -->
                                                        <td>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div class="form-check form-switch mb-0">
                                                                    <input class="form-check-input status-toggle" type="checkbox" 
                                                                           data-language-id="{{ $language->id }}"
                                                                           {{ ($language->status ?? 0) == 1 ? 'checked' : '' }}>
                                                                </div>
                                                                <div class="status-indicator">
                                                                    @if(($language->status ?? 0) == 1)
                                                                        <span class="badge badge-soft-success font-size-12">
                                                                            <i class="bx bx-check-circle me-1"></i>Kích hoạt
                                                                        </span>
                                                                    @else
                                                                        <span class="badge badge-soft-danger font-size-12">
                                                                            <i class="bx bx-x-circle me-1"></i>Vô hiệu hóa
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <!-- Created Date -->
                                                        <td>
                                                            <div class="d-flex flex-column">
                                                                <span class="fw-medium">{{ $language->created_at ? $language->created_at->format('d/m/Y') : 'N/A' }}</span>
                                                                <small class="text-muted">{{ $language->created_at ? $language->created_at->format('H:i:s') : 'N/A' }}</small>
                                                            </div>
                                                        </td>

                                                        <!-- Actions -->
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a class="dropdown-item" href="{{ route('admin.language.edit', $language) }}">
                                                                            <i class="bx bx-edit me-2"></i>Chỉnh sửa
                                                                        </a>
                                                                    </li>
                                                                    <li><hr class="dropdown-divider"></li>
                                                                    <li>
                                                                        <a class="dropdown-item text-danger" href="#" onclick="deleteLanguage({{ $language->id }})">
                                                                            <i class="bx bx-trash me-2"></i>Xóa
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center py-4">
                                                            <div class="text-muted">
                                                                <i class="bx bx-info-circle me-1"></i>
                                                                Không có dữ liệu ngôn ngữ nào
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="card-body">
                                    <div class="text-center py-5">
                                        <i class="bx bx-globe display-4 text-muted mb-3"></i>
                                        <h5 class="text-muted">Chưa có ngôn ngữ nào</h5>
                                        <p class="text-muted mb-4">Thêm ngôn ngữ đầu tiên để bắt đầu quản lý đa ngôn ngữ cho hệ thống.</p>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.language.create') }}" class="btn btn-primary">
                                                <i class="bx bx-plus me-1"></i>Thêm ngôn ngữ đầu tiên
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa ngôn ngữ này không?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Xóa</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">

    <style>
        .avatar-sm {
            width: 2.5rem;
            height: 2.5rem;
        }

        .form-switch .form-check-input {
            width: 2.5em;
            height: 1.25em;
            cursor: pointer;
        }

        .badge {
            font-weight: 500;
        }

        .status-indicator .badge {
            min-width: 85px;
            justify-content: center;
            display: inline-flex;
            align-items: center;
        }

        /* DataTable custom styles matching t.html */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1rem;
        }

        .table.dataTable tbody tr {
            background-color: transparent;
        }

        .table.dataTable tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.025);
        }

        /* Table styling to match t.html */
        .table-check .form-check {
            margin-bottom: 0;
        }

        .table td {
            vertical-align: middle;
        }

        .dropdown-toggle::after {
            display: none;
        }

        /* Badge soft styles matching t.html */
        .badge-soft-primary {
            color: #556ee6 !important;
            background-color: rgba(85, 110, 230, 0.1);
        }

        .badge-soft-success {
            color: #34c38f !important;
            background-color: rgba(52, 195, 143, 0.1);
        }

        .badge-soft-danger {
            color: #f46a6a !important;
            background-color: rgba(244, 106, 106, 0.1);
        }

        .badge-soft-warning {
            color: #f1b44c !important;
            background-color: rgba(241, 180, 76, 0.1);
        }

        .badge-soft-info {
            color: #50a5f1 !important;
            background-color: rgba(80, 165, 241, 0.1);
        }

        .badge-soft-secondary {
            color: #74788d !important;
            background-color: rgba(116, 120, 141, 0.1);
        }

        /* Action button styling */
        .btn-link.dropdown-toggle {
            border: none;
            background: none;
            box-shadow: none !important;
        }

        .btn-link.dropdown-toggle:hover {
            color: #556ee6;
        }

        /* Font sizes matching t.html */
        .font-size-11 {
            font-size: 0.6875rem !important;
        }

        .font-size-12 {
            font-size: 0.75rem !important;
        }

        .font-size-16 {
            font-size: 1rem !important;
        }

        /* Flag image styling */
        .flag-image {
            border: 1px solid #e9ecef;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable - check if already initialized and destroy first
            if ($.fn.DataTable.isDataTable('#datatable')) {
                $('#datatable').DataTable().destroy();
            }
            
            $('#datatable').DataTable({
                responsive: true,
                language: {
                    "decimal": "",
                    "emptyTable": "Không có dữ liệu trong bảng",
                    "info": "Hiển thị _START_ đến _END_ của _TOTAL_ kết quả",
                    "infoEmpty": "Hiển thị 0 đến 0 của 0 kết quả",
                    "infoFiltered": "(lọc từ _MAX_ kết quả)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Hiển thị _MENU_ kết quả",
                    "loadingRecords": "Đang tải...",
                    "processing": "Đang xử lý...",
                    "search": "Tìm kiếm:",
                    "zeroRecords": "Không tìm thấy kết quả nào",
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Tiếp",
                        "previous": "Trước"
                    }
                },
                columnDefs: [{
                    orderable: false,
                    targets: [0, -1] // Disable sorting for checkbox and actions columns
                }],
                pageLength: 25,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                order: [
                    [1, 'asc'] // Sort by language name by default
                ]
            });

            // Check all functionality
            $('#checkAll').change(function() {
                $('.form-check-input[value]').prop('checked', this.checked);
            });

            // Individual checkbox change
            $(document).on('change', '.form-check-input[value]', function() {
                const total = $('.form-check-input[value]').length;
                const checked = $('.form-check-input[value]:checked').length;
                $('#checkAll').prop('indeterminate', checked > 0 && checked < total);
                $('#checkAll').prop('checked', checked === total);
            });
        });

        // Toggle status
        $(document).on('change', '.status-toggle', function() {
            const languageId = $(this).data('language-id');
            const isChecked = $(this).is(':checked');
            const statusIndicator = $(this).closest('td').find('.status-indicator');
            
            $.ajax({
                url: `/admin/language/${languageId}/toggle-status`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showToast('success', response.message);
                        if (response.status === 1) {
                            statusIndicator.html('<span class="badge badge-soft-success font-size-12"><i class="bx bx-check-circle me-1"></i>Kích hoạt</span>');
                        } else {
                            statusIndicator.html('<span class="badge badge-soft-danger font-size-12"><i class="bx bx-x-circle me-1"></i>Vô hiệu hóa</span>');
                        }
                    } else {
                        showToast('error', response.message);
                        $(this).prop('checked', !isChecked);
                    }
                },
                error: function() {
                    showToast('error', 'Có lỗi xảy ra khi cập nhật trạng thái');
                    $(`.status-toggle[data-language-id="${languageId}"]`).prop('checked', !isChecked);
                }
            });
        });

        // Delete language
        let deleteId = null;
        
        function deleteLanguage(id) {
            deleteId = id;
            $('#deleteModal').modal('show');
        }

        $('#confirmDelete').click(function() {
            if (deleteId) {
                $.ajax({
                    url: `/admin/language/${deleteId}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast('success', response.message);
                            setTimeout(() => window.location.reload(), 1500);
                        } else {
                            showToast('error', response.message);
                        }
                    },
                    error: function(xhr) {
                        const errorMessage = xhr.responseJSON?.message || 'Có lỗi xảy ra khi xóa ngôn ngữ';
                        showToast('error', errorMessage);
                    }
                });
                $('#deleteModal').modal('hide');
            }
        });

        // Toast notification function (if not already defined)
        function showToast(type, message) {
            if (typeof alertify !== 'undefined') {
                if (type === 'success') {
                    alertify.success(message);
                } else {
                    alertify.error(message);
                }
            } else {
                alert(message);
            }
        }
    </script>
@endpush
