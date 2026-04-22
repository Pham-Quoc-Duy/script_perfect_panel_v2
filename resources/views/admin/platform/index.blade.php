@extends('admin.layouts.app')

@section('title', 'Quản lý nền tảng')

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Quản lý nền tảng',
                    'breadcrumb' => 'Nền tảng',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            @if ($platforms && $platforms->count() > 0)
                                <div class="card-header">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('admin.platform.create') }}" class="btn btn-primary">
                                            <i class="bx bx-plus me-1"></i> Thêm nền tảng
                                        </a>
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
                                                                class="form-check-input checkAll-platforms"
                                                                id="checkAll-platforms">
                                                            <label class="form-check-label"
                                                                for="checkAll-platforms"></label>
                                                        </div>
                                                    </th>
                                                    <th style="width: 50px;"></th>
                                                    <th style="width: 120px;">ID</th>
                                                    <th style="width: 80px;">Hình ảnh</th>
                                                    <th>Tên nền tảng</th>
                                                    <th>Số danh mục</th>
                                                    <th>Trạng thái</th>
                                                    <th style="width: 140px;">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody id="sortablePlatforms">
                                                @forelse ($platforms ?? [] as $platform)
                                                    <tr class="platform-row {{ ($platform->status ?? 0) == 0 ? 'platform-disabled' : '' }}" 
                                                        data-id="{{ $platform->id }}"
                                                        data-position="{{ $platform->position ?? 0 }}"
                                                        data-status="{{ ($platform->status ?? 0) }}"
                                                        data-categories-count="{{ $platform->categories_count ?? 0 }}">
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox"
                                                                    class="form-check-input platform-checkbox"
                                                                    value="{{ $platform->id }}">
                                                                <label class="form-check-label"></label>
                                                            </div>
                                                        </td>

                                                        <td class="text-center drag-handle align-middle"
                                                            style="cursor: grab;">
                                                            <div class="drag-icon d-flex justify-content-center">
                                                                <i class="fas fa-bars text-muted icon-sort-platform me-3"
                                                                    style="font-size: 16px;"></i>
                                                            </div>
                                                        </td>

                                                        <td>#{{ $platform->id }}</td>

                                                        <td>
                                                            @if ($platform->image)
                                                                <img src="{{ $platform->image }}"
                                                                    alt="{{ $platform->name }}" class="avatar-sm rounded"
                                                                    style="width: 40px; height: 40px; object-fit: cover;">
                                                            @else
                                                                <div
                                                                    class="avatar-sm bg-light rounded d-inline-flex align-items-center justify-content-center">
                                                                    <i class="bx bx-image font-size-14 text-muted"></i>
                                                                </div>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <h6 class="mb-0">{{ $platform->name }}</h6>
                                                        </td>

                                                        <td>
                                                            <span
                                                                class="fw-bold text-success">{{ $platform->categories_count ?? 0 }}</span>
                                                        </td>

                                                        <td>
                                                            <span class="form-check form-switch mb-0">
                                                                <input class="form-check-input status-toggle"
                                                                    type="checkbox" data-platform-id="{{ $platform->id }}"
                                                                    {{ ($platform->status ?? 0) == 1 ? 'checked' : '' }}>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex gap-2">

                                                                <!-- Nút Sửa - Hiển thị khi expanded -->
                                                                <button type="button" class="btn btn-sm btn-outline-info edit-platform-btn"
                                                                    title="Chỉnh sửa"
                                                                    onclick="editPlatformModal({{ $platform->id }})"
                                                                    style="display: none;">
                                                                    <i class="bi bi-pencil fs-8 ms-2"></i>
                                                                </button>

                                                                <!-- Nút Xóa -->
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-danger delete-platform-btn"
                                                                    title="Xóa nền tảng"
                                                                    data-platform-id="{{ $platform->id }}"
                                                                    data-platform-name="{{ $platform->name }}">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>

                                                                <!-- Hidden delete form -->
                                                                <form id="delete-form-{{ $platform->id }}"
                                                                    action="{{ route('admin.platform.destroy', $platform) }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center py-4">
                                                            <div class="text-muted">
                                                                <i class="bx bx-info-circle me-1"></i>
                                                                Không có dữ liệu nền tảng nào
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
                                        <i class="bx bx-server display-4 text-muted mb-3"></i>
                                        <h5 class="text-muted">Chưa có nền tảng nào</h5>
                                        <p class="text-muted mb-4">Nhấn nút "Thêm nền tảng" để bắt đầu thêm nền tảng vào hệ
                                            thống.</p>
                                        <a href="{{ route('admin.platform.create') }}" class="btn btn-primary">
                                            <i class="bx bx-plus me-1"></i>Thêm nền tảng đầu tiên
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

    <!-- Include modal files -->
    @include('admin.platform.edit')
    @include('admin.platform.delete')

@endsection

@push('scripts')
    <!-- SortableJS for drag & drop -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize drag & drop
            initializeSortable();

            // Checkbox functionality
            $('#checkAll-platforms').change(function() {
                $('.platform-checkbox').prop('checked', $(this).is(':checked'));
            });

            $('.platform-checkbox').change(function() {
                var total = $('.platform-checkbox').length;
                var checked = $('.platform-checkbox:checked').length;
                $('#checkAll-platforms').prop('checked', total === checked);
                $('#checkAll-platforms').prop('indeterminate', checked > 0 && checked < total);
            });

            // Toggle edit button visibility based on collapse-all-icon state
            updateEditButtonVisibility();
        });

        // Function to update edit button visibility
        function updateEditButtonVisibility() {
            const collapseIcon = document.getElementById('collapse-all-icon');
            if (!collapseIcon) return;

            const isExpanded = collapseIcon.classList.contains('bi-arrows-expand');
            const editButtons = document.querySelectorAll('.edit-platform-btn');
            
            editButtons.forEach(btn => {
                btn.style.display = isExpanded ? 'inline-block' : 'none';
            });
        }

        // Observe changes to collapse-all-icon
        const collapseIcon = document.getElementById('collapse-all-icon');
        if (collapseIcon) {
            const observer = new MutationObserver(() => {
                updateEditButtonVisibility();
            });
            
            observer.observe(collapseIcon, {
                attributes: true,
                attributeFilter: ['class']
            });
        }

        // Toggle status
        $(document).on('change', '.status-toggle', function() {
            const platformId = $(this).data('platform-id');
            const isChecked = $(this).is(':checked');
            const row = $(`.platform-row[data-id="${platformId}"]`);

            // Update UI immediately
            if (isChecked) {
                row.removeClass('platform-disabled');
                row.attr('data-status', '1');
            } else {
                row.addClass('platform-disabled');
                row.attr('data-status', '0');
            }

            // Send request to server
            $.ajax({
                url: `/admin/platform/${platformId}/toggle-status`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showToast('success', response.message);
                    } else {
                        showToast('error', response.message);
                        // Revert UI if server error
                        if (isChecked) {
                            row.addClass('platform-disabled');
                            row.attr('data-status', '0');
                        } else {
                            row.removeClass('platform-disabled');
                            row.attr('data-status', '1');
                        }
                        $(this).prop('checked', !isChecked);
                    }
                },
                error: function() {
                    showToast('error', 'Có lỗi xảy ra khi cập nhật trạng thái');
                    // Revert UI if network error
                    if (isChecked) {
                        row.addClass('platform-disabled');
                        row.attr('data-status', '0');
                    } else {
                        row.removeClass('platform-disabled');
                        row.attr('data-status', '1');
                    }
                    $(`.status-toggle[data-platform-id="${platformId}"]`).prop('checked', !isChecked);
                }
            });
        });

        function initializeSortable() {
            const tbody = document.getElementById('sortablePlatforms');
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

                    const platformId = evt.item.dataset.id;
                    const newIndex = evt.newIndex;
                    const oldIndex = evt.oldIndex;

                    if (newIndex !== oldIndex) {
                        updatePlatformPosition();
                    }
                }
            });
        }

        function updatePlatformPosition() {
            showToast('info', 'Đang cập nhật thứ tự...');

            const platformIds = [];
            $('#sortablePlatforms tr').each(function(index) {
                platformIds.push({
                    id: $(this).data('id'),
                    position: index + 1
                });
            });

            $.ajax({
                url: '{{ route('admin.platform.index') }}',
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    action: 'reorder',
                    platforms: platformIds
                },
                beforeSend: function() {
                    $('.drag-handle').css('pointer-events', 'none').addClass('updating');
                },
                success: function(response) {
                    if (response.success) {
                        showToast('success', 'Thứ tự đã được cập nhật thành công!');
                        $('#sortablePlatforms tr').each(function(index) {
                            $(this).data('position', index + 1);
                        });
                    } else {
                        showToast('error', response.message || 'Có lỗi xảy ra khi cập nhật thứ tự!');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    console.error('Error updating position:', xhr);
                    showToast('error', 'Có lỗi xảy ra khi cập nhật thứ tự!');
                    location.reload();
                },
                complete: function() {
                    $('.drag-handle').css('pointer-events', '').removeClass('updating');
                }
            });
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
            toast.className =
                `alert alert-${colorMap[type] || 'info'} alert-dismissible fade show position-fixed toast-notification`;
            toast.style.cssText =
                'top: 20px; right: 20px; z-index: 9999; min-width: 300px; max-width: 400px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);';
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


<style>
    /* Platform row styling based on status */
    .platform-row {
        transition: all 0.3s ease;
    }

    /* Disabled platform row - secondary/dark color */
    .platform-row.platform-disabled {
        background-color: #f8f9fa !important;
        opacity: 0.7;
    }

    .platform-row.platform-disabled td {
        color: #6c757d;
    }

    .platform-row.platform-disabled h6 {
        color: #6c757d;
    }

    .platform-row.platform-disabled .badge {
        opacity: 0.8;
    }

    /* Hover effect for disabled rows */
    .platform-row.platform-disabled:hover {
        background-color: #e9ecef !important;
        opacity: 0.85;
    }
</style>

<script>
    // Initialize styling on page load
    $(document).ready(function() {
        $('.status-toggle').each(function() {
            const platformId = $(this).data('platform-id');
            const isChecked = $(this).is(':checked');
            const row = $(`.platform-row[data-id="${platformId}"]`);

            if (!isChecked) {
                row.addClass('platform-disabled');
            }
        });
    });
</script>
