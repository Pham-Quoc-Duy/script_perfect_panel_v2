@extends('admin.layouts.app')

@section('title', 'Quản lý Ticket Subjects')

@push('styles')
<style>
    /* Sortable Styles */
    .sortable-ghost {
        opacity: 0.4;
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
    }

    .sortable-chosen {
        background: #e3f2fd;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transform: scale(1.02);
        transition: all 0.2s ease;
    }

    .sortable-drag {
        background: #fff;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        transform: rotate(2deg);
        border-radius: 8px;
    }

    .drag-handle {
        transition: all 0.2s ease;
        border-radius: 4px;
        padding: 8px;
    }

    .drag-handle:hover {
        background: #f8f9fa;
        color: #007bff !important;
        cursor: grab;
    }

    .drag-handle:active {
        cursor: grabbing;
    }

    .drag-handle.updating {
        opacity: 0.5;
        pointer-events: none;
    }

    /* Table row animations */
    .subject-row {
        transition: all 0.3s ease;
    }

    .subject-row:hover {
        background-color: #f8f9fa;
    }

    /* Loading overlay styles */
    .table-loader-overlay {
        priority: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.95);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border-radius: 8px;
    }

    .loader-content {
        text-align: center;
        padding: 2rem;
    }

    .loading-animation {
        margin-bottom: 1rem;
    }

    .subject-icons {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .subject-icon {
        font-size: 1.5rem;
        color: #007bff;
        animation: bounce 1.5s ease-in-out infinite;
        animation-delay: var(--delay);
    }

    .loading-progress {
        width: 200px;
        height: 4px;
        background: #e9ecef;
        border-radius: 2px;
        overflow: hidden;
        margin: 0 auto;
    }

    .progress-bar {
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, #007bff, #0056b3);
        border-radius: 2px;
        animation: loading 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }

    @keyframes loading {
        0% {
            transform: translateX(-100%);
        }
        50% {
            transform: translateX(0%);
        }
        100% {
            transform: translateX(100%);
        }
    }

    /* Toast notification styles */
    .toast-notification {
        animation: slideInRight 0.3s ease-out;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Badge improvements */
    .badge-soft {
        font-weight: 500;
        font-size: 12px;
    }

    .badge-soft-success {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .badge-soft-danger {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .badge-soft-primary {
        background-color: rgba(0, 123, 255, 0.1);
        color: #007bff;
    }

    .badge-soft-info {
        background-color: rgba(23, 162, 184, 0.1);
        color: #17a2b8;
    }

    .badge-soft-secondary {
        background-color: rgba(108, 117, 125, 0.1);
        color: #6c757d;
    }

    /* Required fields */
    .field-badges .badge {
        font-size: 11px;
        margin: 1px;
    }
</style>
@endpush

@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Quản lý Ticket Subjects',
                    'breadcrumb' => 'Ticket Subjects'
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            @if ($subjects && $subjects->count() > 0)
                                <div class="card-header">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('admin.ticket-subjects.create') }}" class="btn btn-primary">
                                            <i class="bx bx-plus me-1"></i> Thêm mới
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Table Container -->
                                    <div class="table-responsive priority-relative">
                                        <!-- Table Loader Overlay -->
                                        <div id="tableLoader" class="table-loader-overlay" style="display: none;">
                                            <div class="loader-content">
                                                <div class="loading-animation">
                                                    <div class="subject-icons">
                                                        <i class="bx bx-support subject-icon" style="--delay: 0s;"></i>
                                                        <i class="bx bx-message-dots subject-icon" style="--delay: 0.2s;"></i>
                                                        <i class="bx bx-category subject-icon" style="--delay: 0.4s;"></i>
                                                        <i class="bx bx-tag subject-icon" style="--delay: 0.6s;"></i>
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
                                        <table id="datatable" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                            <thead>
                                                <tr class="bg-transparent">
                                                    <th style="width: 30px;">
                                                        <div class="form-check font-size-16">
                                                            <input type="checkbox" name="check" class="form-check-input"
                                                                id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th style="width: 50px;"></th>
                                                    <th style="width: 120px;">ID</th>
                                                    <th>Category</th>
                                                    <th>Subcategory</th>
                                                    <th>Message Only</th>
                                                    <th>Required Fields</th>
                                                    <th>Trạng thái</th>
                                                    <th style="width: 140px;">Thao tác</th>
                                                </tr>
                                            </thead>

                                            <tbody id="sortableSubjects">
                                                @forelse($subjects as $subject)
                                                <tr class="subject-row" data-id="{{ $subject->id }}" data-priority="{{ $subject->priority ?? 0 }}">
                                                    <td>
                                                        <div class="form-check font-size-16">
                                                            <input type="checkbox" class="form-check-input"
                                                                value="{{ $subject->id }}">
                                                            <label class="form-check-label"></label>
                                                        </div>
                                                    </td>

                                                    <td class="text-center drag-handle align-middle" style="cursor: grab;">
                                                        <div class="drag-icon d-flex justify-content-center">
                                                            <i class="bx bx-menu text-muted" style="font-size: 18px;"></i>
                                                        </div>
                                                    </td>

                                                    <td><a href="{{ route('admin.ticket-subjects.show', $subject) }}"
                                                            class="text-body fw-medium">#{{ $subject->id }}</a>
                                                    </td>

                                                    <td>
                                                        <span class="badge badge-soft badge-soft-primary">
                                                            {{ $subject->category }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        @if($subject->subcategory)
                                                            <h6 class="mb-0">{{ $subject->subcategory }}</h6>
                                                        @else
                                                            <span class="text-muted fst-italic">-</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if($subject->show_message_only)
                                                            <span class="badge badge-soft badge-soft-success">
                                                                <i class="bx bx-check me-1"></i>Yes
                                                            </span>
                                                        @else
                                                            <span class="badge badge-soft badge-soft-secondary">
                                                                <i class="bx bx-x me-1"></i>No
                                                            </span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if(!empty($subject->required_fields))
                                                            <div class="field-badges">
                                                                @php
                                                                    $fields = is_array($subject->required_fields) ? $subject->required_fields : json_decode($subject->required_fields, true);
                                                                    $fields = is_array($fields) ? $fields : [];
                                                                @endphp
                                                                @foreach(array_slice($fields, 0, 3) as $field)
                                                                    <span class="badge badge-soft badge-soft-info">
                                                                        {{ $field['name'] ?? 'Field' }}
                                                                    </span>
                                                                @endforeach
                                                                @if(count($fields) > 3)
                                                                    <span class="badge bg-light text-dark">
                                                                        +{{ count($fields) - 3 }}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <span class="text-muted fst-italic">None</span>
                                                        @endif
                                                    </td>

                                                    {{-- Status --}}
                                                    <td>
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input status-toggle" type="checkbox" 
                                                                   data-subject-id="{{ $subject->id }}"
                                                                   {{ ($subject->status ?? 0) == 1 ? 'checked' : '' }}>
                                                        </div>
                                                    </td>

                                                    {{-- Actions --}}
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <!-- Nút Xem -->
                                                            <button type="button" class="btn btn-sm btn-outline-info"
                                                                title="Xem thông tin"
                                                                onclick="showSubjectModal({{ $subject->id }})">
                                                                <i class="bx bx-show"></i>
                                                            </button>

                                                            <!-- Nút Sửa -->
                                                            <a href="{{ route('admin.ticket-subjects.edit',$subject) }}"
                                                               class="btn btn-sm btn-outline-info"
                                                               title="Chỉnh sửa">
                                                                <i class="bx bx-edit"></i>
                                                            </a>

                                                            <!-- Nút Xóa -->
                                                            <button type="button" class="btn btn-sm btn-outline-danger delete-subject-btn"
                                                                title="Xóa ticket subject"
                                                                data-subject-id="{{ $subject->id }}"
                                                                data-subject-name="{{ $subject->category }}">
                                                                <i class="bx bx-trash"></i>
                                                            </button>

                                                            <!-- Hidden delete form -->
                                                            <form id="delete-form-{{ $subject->id }}" 
                                                                  action="{{ route('admin.ticket-subjects.destroy', $subject) }}" 
                                                                  method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="9" class="text-center py-4">
                                                        <div class="text-muted">
                                                            <i class="bx bx-info-circle me-1"></i>
                                                            Không có dữ liệu ticket subject nào
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
                                        <i class="bx bx-support display-4 text-muted mb-3"></i>
                                        <h5 class="text-muted">Chưa có ticket subject nào</h5>
                                        <p class="text-muted mb-4">Nhấn nút "Thêm mới" để bắt đầu thêm ticket subject vào hệ thống.</p>
                                        <a href="{{ route('admin.ticket-subjects.create') }}" class="btn btn-primary">
                                            <i class="bx bx-plus me-1"></i>Thêm ticket subject đầu tiên
                                        </a>
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
    <!-- SortableJS for drag & drop -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with check to avoid reinitialisation
            if ($('#datatable').length && !$.fn.DataTable.isDataTable('#datatable')) {
                $('#datatable').DataTable({
                    "pageLength": 25,
                    "responsive": true,
                    "order": [[ 2, "desc" ]], // Sort by ID desc
                    "columnDefs": [
                        { "orderable": false, "targets": [0, 1, 8] }, // Disable sorting for checkbox, drag handle, actions
                        { "searchable": false, "targets": [0, 1, 8] }
                    ],
                    "language": {
                        "search": "Tìm kiếm:",
                        "lengthMenu": "Hiển thị _MENU_ mục",
                        "info": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                        "infoEmpty": "Hiển thị 0 đến 0 của 0 mục",
                        "infoFiltered": "(lọc từ _MAX_ tổng số mục)",
                        "paginate": {
                            "first": "Đầu",
                            "last": "Cuối",
                            "next": "Tiếp",
                            "previous": "Trước"
                        },
                        "emptyTable": "Không có dữ liệu trong bảng"
                    }
                });
            }

            // Initialize drag & drop
            initializeSortable();
            
            // Checkbox functionality
            $('#checkAll').change(function() {
                $('.form-check-input[value]').prop('checked', $(this).is(':checked'));
            });
            
            $('.form-check-input[value]').change(function() {
                var total = $('.form-check-input[value]').length;
                var checked = $('.form-check-input[value]:checked').length;
                $('#checkAll').prop('checked', total === checked);
                $('#checkAll').prop('indeterminate', checked > 0 && checked < total);
            });
        });

        // Toggle status
        $(document).on('change', '.status-toggle', function() {
            const subjectId = $(this).data('subject-id');
            const isChecked = $(this).is(':checked');
            
            $.ajax({
                url: `/admin/ticket-subjects/${subjectId}/toggle-status`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showToast('success', response.message);
                    } else {
                        showToast('error', response.message);
                        $(this).prop('checked', !isChecked);
                    }
                },
                error: function() {
                    showToast('error', 'Có lỗi xảy ra khi cập nhật trạng thái');
                    $(`.status-toggle[data-subject-id="${subjectId}"]`).prop('checked', !isChecked);
                }
            });
        });

        // Delete functionality
        $(document).on('click', '.delete-subject-btn', function() {
            const subjectId = $(this).data('subject-id');
            const subjectName = $(this).data('subject-name');
            
            if (confirm(`Bạn có chắc chắn muốn xóa ticket subject "${subjectName}"?`)) {
                $(`#delete-form-${subjectId}`).submit();
            }
        });

        function initializeSortable() {
            const tbody = document.getElementById('sortableSubjects');
            if (!tbody) return;

            new Sortable(tbody, {
                handle: '.drag-handle',
                animation: 200,
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                dragClass: 'sortable-drag',
                onStart: function(evt) {
                    document.body.style.cursor = 'grabbing';
                },
                onEnd: function(evt) {
                    document.body.style.cursor = '';
                    
                    const subjectId = evt.item.dataset.id;
                    const newIndex = evt.newIndex;
                    const oldIndex = evt.oldIndex;
                    
                    if (newIndex !== oldIndex) {
                        updateSubjectpriority();
                    }
                }
            });
        }

        function updateSubjectpriority() {
            showToast('info', 'Đang cập nhật thứ tự...');
            
            const subjectIds = [];
            $('#sortableSubjects tr').each(function(index) {
                subjectIds.push({
                    id: $(this).data('id'),
                    priority: index + 1
                });
            });

            $.ajax({
                url: '{{ route("admin.ticket-subjects.index") }}',
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    action: 'reorder',
                    subjects: subjectIds
                },
                beforeSend: function() {
                    $('.drag-handle').css('pointer-events', 'none').addClass('updating');
                },
                success: function(response) {
                    if (response.success) {
                        showToast('success', 'Thứ tự đã được cập nhật thành công!');
                        $('#sortableSubjects tr').each(function(index) {
                            $(this).data('priority', index + 1);
                        });
                    } else {
                        showToast('error', response.message || 'Có lỗi xảy ra khi cập nhật thứ tự!');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    console.error('Error updating priority:', xhr);
                    showToast('error', 'Có lỗi xảy ra khi cập nhật thứ tự!');
                    location.reload();
                },
                complete: function() {
                    $('.drag-handle').css('pointer-events', '').removeClass('updating');
                }
            });
        }

        function showSubjectModal(subjectId) {
            // Implement show modal functionality
            window.location.href = `/admin/ticket-subjects/${subjectId}`;
        }

        function showToast(type, message) {
            // Remove existing toasts
            $('.toast-notification').remove();
            
            const iconMap = {
                'success': 'bx-check-circle',
                'error': 'bx-x-circle',
                'info': 'bx-info-circle',
                'warning': 'bx-error-circle'
            };
            
            const colorMap = {
                'success': 'success',
                'error': 'danger',
                'info': 'info',
                'warning': 'warning'
            };
            
            const toast = document.createElement('div');
            toast.className = `alert alert-${colorMap[type] || 'info'} alert-dismissible fade show priority-fixed toast-notification`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px; max-width: 400px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);';
            toast.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="bx ${iconMap[type] || 'bx-info-circle'} me-2" style="font-size: 18px;"></i>
                    <span>${message}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(toast);
            
            // Auto remove after different durations based on type
            const duration = type === 'error' ? 6000 : (type === 'info' ? 3000 : 4000);
            setTimeout(() => {
                if (toast.parentNode) {
                    $(toast).fadeOut(300, function() {
                        $(this).remove();
                    });
                }
            }, duration);
        }

        // Prevent text selection during drag
        document.addEventListener('selectstart', function(e) {
            if (e.target.closest('.drag-handle')) {
                e.preventDefault();
            }
        });

        // Add keyboard support for accessibility
        $(document).on('keydown', '.drag-handle', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                showToast('info', 'Sử dụng chuột để kéo thả sắp xếp thứ tự');
            }
        });
    </script>
@endpush
