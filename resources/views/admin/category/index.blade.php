@extends('admin.layouts.app')

@section('title', 'Quản lý danh mục')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Quản lý danh mục',
                    'breadcrumb' => 'Danh mục',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            @if ($categories && $categories->count() > 0)
                                <div class="card-header">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                                            <i class="bx bx-plus me-1"></i> Thêm danh mục
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{-- Filter Options --}}
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <select class="form-select" id="platformFilter">
                                                <option value="">Tất cả nền tảng</option>
                                                @foreach ($platforms ?? [] as $platform)
                                                    <option value="{{ $platform->id }}"
                                                        {{ request('platform_id') == $platform->id ? 'selected' : '' }}>
                                                        {{ $platform->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            @if (request('platform_id') !== null)
                                                <a href="{{ route('admin.category.index') }}"
                                                    class="btn btn-outline-secondary w-100">
                                                    <i class="bx bx-reset me-1"></i>Xóa bộ lọc
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Table Container -->
                                    <div class="table-responsive position-relative">
                                        <!-- Table Loader Overlay -->
                                        <div id="tableLoader" class="table-loader-overlay" style="display: none;">
                                            <div class="loader-content">
                                                <div class="loading-animation">
                                                    <div class="category-icons">
                                                        <i class="bx bx-category platform-icon" style="--delay: 0s;"></i>
                                                        <i class="bx bx-folder platform-icon" style="--delay: 0.2s;"></i>
                                                        <i class="bx bx-grid-alt platform-icon" style="--delay: 0.4s;"></i>
                                                        <i class="bx bx-collection platform-icon"
                                                            style="--delay: 0.6s;"></i>
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
                                                            <input type="checkbox" name="check" class="form-check-input checkAll-categories"
                                                                id="checkAll-categories">
                                                            <label class="form-check-label" for="checkAll-categories"></label>
                                                        </div>
                                                    </th>
                                                    <th style="width: 50px;"></th>
                                                    <th style="width: 120px;">ID</th>
                                                    <th style="width: 80px;">Hình ảnh</th>
                                                    <th>Tên danh mục</th>
                                                    <th>Nền tảng</th>
                                                    <th>Số dịch vụ</th>
                                                    <th>Trạng thái</th>
                                                    <th style="width: 100px;">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody id="sortableCategories">
                                                @forelse ($categories ?? [] as $category)
                                                    <tr class="category-row {{ ($category->status ?? 0) == 0 ? 'category-disabled' : '' }}" 
                                                        data-id="{{ $category->id }}" 
                                                        data-position="{{ $category->position ?? 0 }}"
                                                        data-status="{{ ($category->status ?? 0) }}"
                                                        data-services-count="{{ $category->services_count ?? 0 }}">
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input category-checkbox"
                                                                    value="{{ $category->id }}">
                                                                <label class="form-check-label"></label>
                                                            </div>
                                                        </td>

                                                        <td class="text-center drag-handle align-middle" style="cursor: grab;">
                                                            <div class="drag-icon d-flex justify-content-center">
                                                                <i class="bx bx-menu text-muted" style="font-size: 18px;"></i>
                                                            </div>
                                                        </td>

                                                        <td>#{{ $category->id }}</td>

                                                        <td>
                                                            @if ($category->image_url)
                                                                <img src="{{ $category->image_url }}"
                                                                    alt="{{ $category->getName() }}"
                                                                    class="avatar-sm rounded"
                                                                    style="width: 40px; height: 40px; object-fit: cover;">
                                                            @else
                                                                <div
                                                                    class="avatar-sm bg-light rounded d-inline-flex align-items-center justify-content-center">
                                                                    <i class="bx bx-image font-size-14 text-muted"></i>
                                                                </div>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h6 class="mb-0">{{ $category->localized_name }}</h6>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            @if ($category->platform)
                                                                <div class="badge badge-soft-primary font-size-12">
                                                                    {{ $category->platform->name }}
                                                                </div>
                                                            @else
                                                                <div class="badge badge-soft-secondary font-size-12">Chưa có
                                                                </div>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <span
                                                                class="fw-bold text-success">{{ $category->services_count ?? 0 }}</span>
                                                        </td>

                                                        <td>
                                                            <span class="form-check form-switch mb-0">
                                                                <input class="form-check-input status-toggle"
                                                                    type="checkbox" data-category-id="{{ $category->id }}"
                                                                    {{ ($category->status ?? 0) == 1 ? 'checked' : '' }}>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                
                                                                <!-- Nút Sửa -->
                                                                <button type="button" class="btn btn-sm btn-outline-info"
                                                                    title="Chỉnh sửa"
                                                                    onclick="editCategoryModal({{ $category->id }})">
                                                                    <i class="bx bx-edit"></i>
                                                                </button>

                                                                <!-- Nút Xóa -->
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-danger delete-category-btn"
                                                                    title="Xóa danh mục"
                                                                    data-category-id="{{ $category->id }}"
                                                                    data-category-name="{{ $category->getName() }}">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>

                                                                <!-- Hidden delete form -->
                                                                <form id="delete-form-{{ $category->id }}"
                                                                    action="{{ route('admin.category.destroy', $category) }}"
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
                                                                Không có dữ liệu danh mục nào
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
                                        <i class="bx bx-category display-4 text-muted mb-3"></i>
                                        <h5 class="text-muted">Chưa có danh mục nào</h5>
                                        <p class="text-muted mb-4">Nhấn nút "Thêm danh mục" để bắt đầu thêm danh mục vào hệ
                                            thống.</p>
                                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                                            <i class="bx bx-plus me-1"></i>Thêm danh mục đầu tiên
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
    @include('admin.category.edit')
    @include('admin.category.delete')

@endsection

@push('scripts')
    <!-- SortableJS for drag & drop -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with check to avoid reinitialisation
            

            // Initialize drag & drop
            initializeSortable();
            
            // Checkbox functionality
            $('#checkAll-categories').change(function() {
                $('.category-checkbox').prop('checked', $(this).is(':checked'));
            });
            
            $('.category-checkbox').change(function() {
                var total = $('.category-checkbox').length;
                var checked = $('.category-checkbox:checked').length;
                $('#checkAll-categories').prop('checked', total === checked);
                $('#checkAll-categories').prop('indeterminate', checked > 0 && checked < total);
            });

            // Filter functionality
            $('#platformFilter').change(function() {
                const params = new URLSearchParams();
                const platformId = $('#platformFilter').val();
                
                if (platformId !== '') params.set('platform_id', platformId);
                
                window.location.href = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
            });
        });

        // Toggle status
        $(document).on('change', '.status-toggle', function() {
            const categoryId = $(this).data('category-id');
            const isChecked = $(this).is(':checked');
            const row = $(`.category-row[data-id="${categoryId}"]`);
            const servicesCount = parseInt(row.data('services-count')) || 0;

            // Update UI immediately
            if (isChecked) {
                row.removeClass('category-disabled');
                row.attr('data-status', '1');
            } else {
                row.addClass('category-disabled');
                row.attr('data-status', '0');
            }

            // Send request to server
            $.ajax({
                url: `/admin/category/${categoryId}/toggle-status`,
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
                            row.addClass('category-disabled');
                            row.attr('data-status', '0');
                        } else {
                            row.removeClass('category-disabled');
                            row.attr('data-status', '1');
                        }
                        $(this).prop('checked', !isChecked);
                    }
                },
                error: function() {
                    showToast('error', 'Có lỗi xảy ra khi cập nhật trạng thái');
                    // Revert UI if network error
                    if (isChecked) {
                        row.addClass('category-disabled');
                        row.attr('data-status', '0');
                    } else {
                        row.removeClass('category-disabled');
                        row.attr('data-status', '1');
                    }
                    $(`.status-toggle[data-category-id="${categoryId}"]`).prop('checked', !isChecked);
                }
            });
        });

        function initializeSortable() {
            const tbody = document.getElementById('sortableCategories');
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
                    
                    const categoryId = evt.item.dataset.id;
                    const newIndex = evt.newIndex;
                    const oldIndex = evt.oldIndex;
                    
                    if (newIndex !== oldIndex) {
                        updateCategoryPosition();
                    }
                }
            });
        }

        function updateCategoryPosition() {
            showToast('info', 'Đang cập nhật thứ tự...');
            
            const categoryIds = [];
            $('#sortableCategories tr').each(function(index) {
                categoryIds.push({
                    id: $(this).data('id'),
                    position: index + 1
                });
            });

            $.ajax({
                url: '{{ route("admin.category.index") }}',
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    action: 'reorder',
                    categories: categoryIds
                },
                beforeSend: function() {
                    $('.drag-handle').css('pointer-events', 'none').addClass('updating');
                },
                success: function(response) {
                    if (response.success) {
                        showToast('success', 'Thứ tự đã được cập nhật thành công!');
                        $('#sortableCategories tr').each(function(index) {
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
            toast.className = `alert alert-${colorMap[type] || 'info'} alert-dismissible fade show position-fixed toast-notification`;
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


<style>
    /* Category row styling based on status */
    .category-row {
        transition: all 0.3s ease;
    }

    /* Disabled category row - secondary/dark color */
    .category-row.category-disabled {
        background-color: #f8f9fa !important;
        opacity: 0.7;
    }

    .category-row.category-disabled td {
        color: #6c757d;
    }

    /* Keep status toggle td color unchanged */
    .category-row.category-disabled td:has(.status-toggle) {
        background-color: transparent !important;
        opacity: 1 !important;
        color: inherit;
    }

    .category-row.category-disabled h6 {
        color: #6c757d;
    }

    .category-row.category-disabled .badge {
        opacity: 0.8;
    }

    /* Hover effect for disabled rows */
    .category-row.category-disabled:hover {
        background-color: #e9ecef !important;
        opacity: 0.85;
    }

    .category-row.category-disabled:hover td:has(.status-toggle) {
        background-color: transparent !important;
        opacity: 1 !important;
    }

    /* Status toggle styling */
    .status-toggle {
        cursor: pointer;
    }

    .status-toggle:checked {
        background-color: #198754;
        border-color: #198754;
    }

    .status-toggle:not(:checked) {
        background-color: #6c757d;
        border-color: #6c757d;
    }
</style>

<script>
    // Initialize styling on page load
    $(document).ready(function() {
        $('.status-toggle').each(function() {
            const categoryId = $(this).data('category-id');
            const isChecked = $(this).is(':checked');
            const row = $(`.category-row[data-id="${categoryId}"]`);

            if (!isChecked) {
                row.addClass('category-disabled');
            }
        });
    });
</script>
