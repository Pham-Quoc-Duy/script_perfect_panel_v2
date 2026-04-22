@extends('adminpanel.layouts.app')
@section('title', 'Sync Logs')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">

        {{-- Header --}}
        <div class="d-flex flex-wrap flex-stack mb-5">
            <div class="d-flex align-items-center gap-2">
                <h3 class="fw-bold my-2" data-lang="menu::Sync Logs">Thông tin đồng bộ dịch vụ</h3>
                <span class="badge badge-danger ms-2" id="unread-badge"
                    style="{{ $unreadCount > 0 ? '' : 'display:none' }}">{{ $unreadCount }} <span data-lang="Unread">chưa đọc</span></span>
            </div>
            <div class="d-flex my-2">
                <button type="button" class="btn btn-sm btn-primary" onclick="markAllRead()">
                    <i class="fa-solid fa-check-double me-1"></i>
                    <span data-lang="Mark all as read">Đánh dấu đã đọc tất cả</span>
                </button>
            </div>
        </div>

        {{-- Filters --}}
        <div class="card shadow-sm mb-5">
            <div class="card-body py-3">
                <div class="d-flex flex-wrap align-items-end gap-3">
                    <div class="flex-fill" style="min-width:160px">
                        <label class="form-label fs-7 text-muted mb-1" data-lang="Change type">Loại thay đổi</label>
                        <select id="filter-change-type" class="form-select form-select-sm form-select-solid"
                            data-kt-select2="false" data-allow-clear="false" data-hide-search="true">
                            <option value="" data-lang="All">Tất cả</option>
                            <option value="price_increase" data-lang="Price increase">Tăng giá</option>
                            <option value="price_decrease" data-lang="Price decrease">Giảm giá</option>
                            <option value="min_max_change" data-lang="Min/Max change">Thay đổi Min/Max</option>
                            <option value="action_change" data-lang="Other change">Thay đổi khác</option>
                        </select>
                    </div>
                    <div class="flex-fill" style="min-width:130px">
                        <label class="form-label fs-7 text-muted mb-1" data-lang="Status">Trạng thái</label>
                        <select id="filter-is-read" class="form-select form-select-sm form-select-solid"
                            data-kt-select2="false" data-allow-clear="false" data-hide-search="true">
                            <option value="" data-lang="All">Tất cả</option>
                            <option value="0" data-lang="Unread">Chưa đọc</option>
                            <option value="1" data-lang="Read">Đã đọc</option>
                        </select>
                    </div>
                    <div class="flex-fill" style="min-width:180px">
                        <label class="form-label fs-7 text-muted mb-1" data-lang="Provider">Nhà cung cấp</label>
                        <select id="filter-provider" class="form-select form-select-sm form-select-solid"
                            data-kt-select2="false" data-allow-clear="false" data-hide-search="false">
                            <option value="" data-lang="All">Tất cả</option>
                            @foreach($providers as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-fill" style="min-width:200px">
                        <label class="form-label fs-7 text-muted mb-1" data-lang="Time">Thời gian</label>
                        <input class="form-control form-control-sm text-center ipt-date" placeholder="Chọn khoảng ngày" data-lang="Select date range">
                    </div>
                    <div class="d-flex gap-2 pb-1">
                        <button type="button" class="btn btn-sm btn-primary" onclick="applyFilters()" data-lang="Filter">
                            <i class="fa-solid fa-filter me-1"></i>Lọc
                        </button>
                        <button type="button" class="btn btn-sm btn-light-secondary" id="btn-clear-filter"
                            onclick="clearFilter()" style="display:none" data-lang="Clear filter">
                            <i class="fa-solid fa-xmark me-1"></i>Xóa lọc
                        </button>
                    </div>
                </div>
            </div>
        </div>
   

    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-7 gy-2 mb-0">
                    <thead>
                        <tr class="text-start bg-secondary text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="ps-4" width="1"></th>
                            <th data-lang="Service">Dịch vụ</th>
                            <th data-lang="Change log">Thay đổi</th>
                            <th data-lang="Date">Thời gian</th>
                            <th width="1"></th>
                        </tr>
                    </thead>
                    <tbody id="logs-tbody">
                        @forelse($logs as $log)
                            <tr class="{{ $log->is_read ? '' : 'bg-light-primary' }}" id="log-row-{{ $log->id }}">
                                <td class="ps-4">
                                    @if ($log->is_read)
                                        <i class="fa-solid fa-circle-check text-primary"></i>
                                    @else
                                        <i class="fa-solid fa-circle text-warning"></i>
                                    @endif
                                </td>
                                <td>
                                    <a class="text-gray-600 text-hover-primary" target="_blank"
                                        href="/admin/services/edit?id={{ $log->service_id }}">
                                        <strong class="text-gray-900">{{ $log->service_id }}</strong>
                                        @if ($log->provider_name && $log->service_api)
                                            | {{ $log->provider_name }} - {{ $log->service_api }}
                                        @endif
                                    </a>
                                    @if ($log->service)
                                        <p class="m-0 text-muted fs-8">{{ $log->service->getName() }}</p>
                                    @endif
                                </td>
                                <td>
                                    @if ($log->change_type === 'price_increase')
                                        <i class="bi bi-caret-down-fill text-danger"></i>
                                        <span class="text-danger">Price increase from {{ $log->old_value }} to
                                            {{ $log->new_value }}</span>
                                    @elseif($log->change_type === 'price_decrease')
                                        <i class="bi bi-caret-up-fill text-success"></i>
                                        <span class="text-success">Price decrease from {{ $log->old_value }} to
                                            {{ $log->new_value }}</span>
                                    @elseif($log->change_type === 'min_max_change')
                                        <i class="bi bi-bar-chart-fill text-info"></i>
                                        <span>{{ ucfirst($log->field_changed ?? 'Maximum') }} change from
                                            {{ (int) $log->old_value }} to {{ (int) $log->new_value }}</span>
                                    @else
                                        <i class="bi bi-arrow-left-right text-secondary"></i>
                                        <span class="text-secondary">{{ $log->field_changed }}: {{ $log->old_value }} →
                                            {{ $log->new_value }}</span>
                                    @endif
                                </td>
                                <td class="text-nowrap text-muted fs-8">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                <td class="pe-4" id="log-action-{{ $log->id }}">
                                    @if (!$log->is_read)
                                        <button type="button"
                                            class="btn btn-icon btn-light-primary btn-circle btn-sm w-25px h-25px"
                                            onclick="markOneRead({{ $log->id }})" title="Đánh dấu đã đọc" data-lang="Mark as read">
                                            <i class="fa-solid fa-check fs-8"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-10">
                                    <i class="fa-solid fa-inbox fs-2x mb-3 d-block opacity-50"></i>
                                    <span data-lang="No sync data">Không có dữ liệu đồng bộ nào</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center py-3" id="logs-footer"
            style="{{ $logs->hasPages() || $logs->total() > 0 ? '' : 'display:none' }}">
            <span class="text-muted fs-7" id="logs-info">
                Hiển thị {{ $logs->firstItem() ?? 0 }}–{{ $logs->lastItem() ?? 0 }} / {{ $logs->total() }} bản ghi
            </span>
            <div id="logs-pagination"></div>
        </div>
    </div>

 </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initDatePicker();
        });

        function initDatePicker() {
            if (window.jQuery?.fn?.daterangepicker && window.moment) {
                jQuery(function($) {
                    const isVi = (document.documentElement.lang || 'en')[0] === 'v';

                    // ── Select2: không search (loại thay đổi, trạng thái) ────
                    if ($.fn.select2) {
                        $('#filter-change-type, #filter-is-read').select2({
                            minimumResultsForSearch: Infinity,
                            allowClear: false,
                            width: '100%'
                        });
                        // Provider: có search
                        $('#filter-provider').select2({
                            allowClear: false,
                            width: '100%'
                        });
                    }

                    // ── Daterangepicker ──────────────────────────────────────
                    const locales = {
                        en: {
                            format: 'YYYY/MM/DD',
                            separator: ' - ',
                            applyLabel: 'Apply',
                            cancelLabel: 'Cancel',
                            customRangeLabel: 'Custom',
                            daysOfWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July',
                                'August', 'September', 'October', 'November', 'December'
                            ],
                            firstDay: 0
                        },
                        vi: {
                            format: 'YYYY/MM/DD',
                            separator: ' - ',
                            applyLabel: 'Áp dụng',
                            cancelLabel: 'Hủy',
                            customRangeLabel: 'Tùy chọn',
                            daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                            monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                                'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                            ],
                            firstDay: 1
                        }
                    };

                    const ranges = isVi ? {
                        'Hôm nay': [moment(), moment()],
                        'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        '7 ngày gần nhất': [moment().subtract(6, 'days'), moment()],
                        '30 ngày gần nhất': [moment().subtract(29, 'days'), moment()],
                        'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                        'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    } : {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 days': [moment().subtract(29, 'days'), moment()],
                        'This month': [moment().startOf('month'), moment().endOf('month')],
                        'Last month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    };

                    $('.ipt-date').daterangepicker({
                        autoUpdateInput: false,
                        locale: locales[isVi ? 'vi' : 'en'],
                        ranges: ranges
                    });

                    $('.ipt-date').on('apply.daterangepicker', function(ev, picker) {
                        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format(
                            'YYYY/MM/DD'));
                    });

                    $('.ipt-date').on('cancel.daterangepicker', function() {
                        $(this).val('');
                    });
                });
            } else {
                setTimeout(initDatePicker, 100);
            }
        }

        // ── Filter — chỉ chạy khi nhấn nút Lọc ──────────────────────────────
        var _currentPage = 1;
        var _activeFilters = {};

        function applyFilters() {
            const dateRange = jQuery('.ipt-date').val();
            const changeType = jQuery('#filter-change-type').val();
            const isRead = jQuery('#filter-is-read').val();
            const providerId = jQuery('#filter-provider').val();

            _activeFilters = {};

            if (dateRange) {
                const parts = dateRange.split(' - ');
                if (parts.length === 2) {
                    _activeFilters.start_date = parts[0];
                    _activeFilters.end_date = parts[1];
                }
            }
            if (changeType) _activeFilters.change_type = changeType;
            if (isRead !== '') _activeFilters.is_read = isRead;
            if (providerId) _activeFilters.provider_id = providerId;

            const hasFilter = Object.keys(_activeFilters).length > 0;
            document.getElementById('btn-clear-filter').style.display = hasFilter ? '' : 'none';

            _currentPage = 1;
            loadData(1);
        }

        function clearFilter() {
            if (window.jQuery) {
                jQuery('#filter-change-type').val(null).trigger('change');
                jQuery('#filter-is-read').val(null).trigger('change');
                jQuery('#filter-provider').val(null).trigger('change');
                jQuery('.ipt-date').val('');
            }
            document.getElementById('btn-clear-filter').style.display = 'none';
            _activeFilters = {};
            _currentPage = 1;
            loadData(1);
        }

        // ── Load data ─────────────────────────────────────────────────────────
        function loadData(page) {
            _currentPage = page || _currentPage;

            showFullScreenLoader();

            $.ajax({
                url: '/admin/service_sync_logs/data',
                type: 'GET',
                data: Object.assign({}, _activeFilters, {
                    page: _currentPage
                }),
                dataType: 'json',
                success: function(response) {
                    updateTable(response.items);
                    updatePagination(response);
                    updateUnreadBadge(response.unreadCount);
                    hideFullScreenLoader();
                },
                error: function(xhr, status, error) {
                    console.error('Error loading data:', error);
                    hideFullScreenLoader();
                }
            });
        }

        // ── Render ────────────────────────────────────────────────────────────
        function updateTable(items) {
            const tbody = $('#logs-tbody');
            tbody.empty();

            if (!items || items.length === 0) {
                tbody.html('<tr><td colspan="5" class="text-center text-muted py-10">' +
                    '<i class="fa-solid fa-inbox fs-2x mb-3 d-block opacity-50"></i>' +
                    'Không có dữ liệu đồng bộ nào</td></tr>');
                return;
            }

            items.forEach(function(log) {
                const icon = log.is_read ?
                    '<i class="fa-solid fa-circle-check text-primary"></i>' :
                    '<i class="fa-solid fa-circle text-warning"></i>';

                let changeHtml;
                if (log.change_type === 'price_increase') {
                    changeHtml =
                        '<i class="bi bi-caret-down-fill text-danger"></i> <span class="text-danger">Price increase from ' +
                        log.old_value + ' to ' + log.new_value + '</span>';
                } else if (log.change_type === 'price_decrease') {
                    changeHtml =
                        '<i class="bi bi-caret-up-fill text-success"></i> <span class="text-success">Price decrease from ' +
                        log.old_value + ' to ' + log.new_value + '</span>';
                } else if (log.change_type === 'min_max_change') {
                    const f = log.field_changed ? log.field_changed.charAt(0).toUpperCase() + log.field_changed
                        .slice(1) : 'Maximum';
                    changeHtml = '<i class="bi bi-bar-chart-fill text-info"></i> <span>' + f + ' change from ' +
                        parseInt(log.old_value) + ' to ' + parseInt(log.new_value) + '</span>';
                } else {
                    changeHtml =
                        '<i class="bi bi-arrow-left-right text-secondary"></i> <span class="text-secondary">' + (log
                            .field_changed || '') + ': ' + log.old_value + ' → ' + log.new_value + '</span>';
                }

                let svcInfo = '<strong class="text-gray-900">' + log.service_id + '</strong>';
                if (log.provider_name && log.service_api) svcInfo += ' | ' + log.provider_name + ' - ' + log
                    .service_api;
                const svcName = log.service_name ? '<p class="m-0 text-muted fs-8">' + log.service_name + '</p>' :
                    '';

                const actionBtn = !log.is_read ?
                    '<button type="button" class="btn btn-icon btn-light-primary btn-circle btn-sm w-25px h-25px" onclick="markOneRead(' +
                    log.id + ')" title="Đánh dấu đã đọc"><i class="fa-solid fa-check fs-8"></i></button>' :
                    '';

                tbody.append(
                    '<tr class="' + (log.is_read ? '' : 'bg-light-primary') + '" id="log-row-' + log.id + '">' +
                    '<td class="ps-4">' + icon + '</td>' +
                    '<td><a class="text-gray-600 text-hover-primary" target="_blank" href="/admin/services/edit?id=' +
                    log.service_id + '">' + svcInfo + '</a>' + svcName + '</td>' +
                    '<td>' + changeHtml + '</td>' +
                    '<td class="text-nowrap text-muted fs-8">' + log.created_at + '</td>' +
                    '<td class="pe-4" id="log-action-' + log.id + '">' + actionBtn + '</td>' +
                    '</d><a class="text-gray-600 text-hover-primary" target="_blank" href="/admin/services/edit?id=' +
                    log.service_id + '">' + svcInfo + '</a>' + svcName + '</td>'
                );
            });
        }

        function updatePagination(data) {
            const footer = document.getElementById('logs-footer');
            const info = document.getElementById('logs-info');
            const pager = document.getElementById('logs-pagination');

            if (!data.total) {
                footer.style.display = 'none';
                return;
            }
            footer.style.display = '';
            info.textContent = 'Hiển thị ' + (data.from || 0) + '–' + (data.to || 0) + ' / ' + data.total + ' bản ghi';

            if (data.last_page <= 1) {
                pager.innerHTML = '';
                return;
            }

            let html = '<nav><ul class="pagination pagination-sm mb-0">';
            html += '<li class="page-item' + (data.current_page <= 1 ? ' disabled' : '') +
                '"><a class="page-link" href="javascript:;" onclick="loadData(' + (data.current_page - 1) + ')">‹</a></li>';
            for (let p = 1; p <= data.last_page; p++) {
                if (p === 1 || p === data.last_page || Math.abs(p - data.current_page) <= 2) {
                    html += '<li class="page-item' + (p === data.current_page ? ' active' : '') +
                        '"><a class="page-link" href="javascript:;" onclick="loadData(' + p + ')">' + p + '</a></li>';
                } else if (Math.abs(p - data.current_page) === 3) {
                    html += '<li class="page-item disabled"><span class="page-link">…</span></li>';
                }
            }
            html += '<li class="page-item' + (data.current_page >= data.last_page ? ' disabled' : '') +
                '"><a class="page-link" href="javascript:;" onclick="loadData(' + (data.current_page + 1) + ')">›</a></li>';
            html += '</ul></nav>';
            pager.innerHTML = html;
            _currentPage = data.current_page;
        }

        // ── Badge / Mark read ─────────────────────────────────────────────────
        function updateUnreadBadge(count) {
            const badge = document.getElementById('unread-badge');
            if (count > 0) {
                badge.textContent = count + ' chưa đọc';
                badge.style.display = '';
            } else badge.style.display = 'none';
        }

        function markOneRead(id) {
            $.post('/admin/service_sync_logs/' + id + '/mark-read', {
                    _token: document.querySelector('meta[name="csrf-token"]').content
                },
                function(data) {
                    if (!data.success) return;
                    const row = document.getElementById('log-row-' + id);
                    if (row) {
                        row.classList.remove('bg-light-primary');
                        row.querySelector('td:first-child i').className = 'fa-solid fa-circle-check text-primary';
                    }
                    const action = document.getElementById('log-action-' + id);
                    if (action) action.innerHTML = '';
                    const cur = parseInt(document.getElementById('unread-badge').textContent) || 0;
                    updateUnreadBadge(Math.max(0, cur - 1));
                }
            );
        }

        function markAllRead() {
            showFullScreenLoader();
            $.post('/admin/service_sync_logs/mark-read', {
                    _token: document.querySelector('meta[name="csrf-token"]').content
                },
                function(data) {
                    hideFullScreenLoader();
                    if (data.success) {
                        updateUnreadBadge(0);
                        loadData(_currentPage);
                    }
                }
            ).fail(function() {
                hideFullScreenLoader();
            });
        }
    </script>
@endsection
