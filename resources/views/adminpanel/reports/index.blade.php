@extends('adminpanel.layouts.app')
@section('title', 'Reports')
@section('content')
    <div class="content flex-row-fluid" id="kt_content"><span class="title d-none">List</span>
        <div class="row g-3 mb-3">
            <div class="col-lg-2 col-4">
                <select class="form-select form-select-sm sl-year" data-kt-select2="true" data-hide-search="true"
                    data-placeholder="Year" data-lang="Year">
                    @foreach ($years as $y)
                        <option value="{{ $y }}" {{ $y == now()->year ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2 col-4">
                <select class="form-select form-select-sm sl-type" data-kt-select2="true" data-hide-search="true"
                    data-placeholder="Report type" data-lang="Report type" onchange="changeType(this.value)">
                    <option value="0" selected data-lang="Payments">Thanh toán</option>
                    <option value="1" data-lang="Orders">Services</option>
                    <option value="2" data-lang="Orders - OLD">Services - OLD</option>
                    <option value="3" data-lang="Products">Products</option>
                </select>
            </div>
            <div class="col-lg-2 col-4 type type-1 type-2 type-3" style="display:none;">
                <select class="form-select form-select-sm sl-order-type" data-kt-select2="true" data-hide-search="true"
                    data-placeholder="Statistic type" data-lang="Statistic type">
                    <option value="0" selected data-lang="Charge">Số tiền</option>
                    <option value="3" data-lang="Profit">Lợi nhuận</option>
                    <option value="1" data-lang="Count">Số lượng đơn</option>
                    <option value="2" data-lang="View">Số lượng view</option>
                </select>
            </div>
            <div class="col-lg-2 col-4 type type-0">
                <select class="form-select form-select-sm sl-method" data-kt-select2="true" data-hide-search="true" data-allow-clear="false">
                    <option value="0" selected data-lang="All methods">All methods</option>
                    @foreach ($paymentMethods as $pm)
                        <option value="{{ $pm->id }}">{{ $pm->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-6">
                <select class="form-select form-select-sm sl-account" data-kt-select2="true" data-allow-clear="false" data-hide-search="false">
                    <option value="0" selected data-lang="All accounts">All accounts</option>
                    @foreach ($userNames as $id => $username)
                        <option value="{{ $id }}">{{ $username }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-6 type type-1 type-2 type-3" style="display:none;">
                <select class="form-select form-select-sm sl-provider" data-kt-select2="true" data-allow-clear="false">
                    <option value="0" selected data-lang="All providers">All providers</option>
                    @foreach ($providers as $p)
                        <option value="{{ $p->name }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-12 type type-1 type-2 type-3" style="display:none;">
                <select class="form-select form-select-sm sl-order-status" data-kt-select2="true" data-hide-search="true" multiple data-placeholder="Order status" data-lang="Order status">
                    <option value="awaiting" selected data-lang="status::Awaiting">Chờ duyệt</option>
                    <option value="pending" selected data-lang="status::Pending">Chờ xử lý</option>
                    <option value="processing" selected data-lang="status::Processing">Đang xử lý</option>
                    <option value="in_progress" selected data-lang="status::In progress">Đang chạy</option>
                    <option value="completed" selected data-lang="status::Completed">Hoàn thành</option>
                    <option value="partial" selected data-lang="status::Partial">Hoàn tiền một phần</option>
                    <option value="canceled" selected data-lang="status::Canceled">Hủy</option>
                    <option value="failed" selected data-lang="status::Failed">Thất bại</option>
                </select>
            </div>
            <div class="col-lg-12 type type-1 type-2" style="display:none;">
                <select class="form-select form-select-sm sl-service" data-kt-select2="true" multiple data-allow-clear="true" data-placeholder="Select service" data-lang="Select service">
                    @foreach ($services as $s)
                        <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 d-flex align-items-center gap-2">
            <button type="button" class="btn btn-primary btn-sm" onclick="applyReport()" data-lang="button::Apply">Áp dụng</button>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-row-bordered table-hover fs-7 gy-2 gs-9 mb-0">
                        <thead id="report-thead">
                            <tr class="fw-bold bg-secondary">
                                <th class="text-end" data-lang="Month 1">Tháng 1</th>
                                <th class="text-end" data-lang="Month 2">Tháng 2</th>
                                <th class="text-end" data-lang="Month 3">Tháng 3</th>
                                <th class="text-end" data-lang="Month 4">Tháng 4</th>
                                <th class="text-end" data-lang="Month 5">Tháng 5</th>
                                <th class="text-end" data-lang="Month 6">Tháng 6</th>
                                <th class="text-end" data-lang="Month 7">Tháng 7</th>
                                <th class="text-end" data-lang="Month 8">Tháng 8</th>
                                <th class="text-end" data-lang="Month 9">Tháng 9</th>
                                <th class="text-end" data-lang="Month 10">Tháng 10</th>
                                <th class="text-end" data-lang="Month 11">Tháng 11</th>
                                <th class="text-end" data-lang="Month 12">Tháng 12</th>
                            </tr>
                        </thead>
                        <tbody id="report-tbody">
                            <tr><td colspan="13" class="text-center text-muted py-4" data-lang="Loading">Đang tải...</td></tr>
                        </tbody>
                        <tfoot id="report-tfoot"></tfoot>
                    </table>
                </div>
                <canvas id="chart" style="display:block;width:100%;height:300px;"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
    var rawPayments  = @json($rawPayments);
    var rawOrders    = @json($rawOrders);
    var methodNames  = @json($methodNames);
    var serviceNames = @json($serviceNames);
    var userNames    = @json($userNames);
    var currentYear  = {{ $currentYear }};
    var reportChart  = null;

    // Màu giống t.html
    var CHART_COLORS = [
        '#3b8edb','#ff5c7c','#ff8c2a','#2ecc71','#9b59b6',
        '#1abc9c','#e74c3c','#f39c12','#34495e','#e91e63',
        '#00bcd4','#8bc34a'
    ];

    // ── Init Chart — cấu trúc giống t.html ───────────────────────────────
    function initChart() {
        if (typeof Chart === 'undefined') { setTimeout(initChart, 100); return; }
        var ctx = document.getElementById('chart');
        if (!ctx || reportChart) return;
        reportChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: Array.from({length: 31}, function(_, i) { return i + 1; }),
                datasets: []
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'center',
                        onClick: function(e, legendItem, legend) {
                            var index = legendItem.index;
                            var ci = legend.chart;
                            if (ci.isDatasetVisible(index)) {
                                ci.hide(index);
                                legendItem.hidden = true;
                            } else {
                                ci.show(index);
                                legendItem.hidden = false;
                            }
                        },
                        labels: {
                            boxWidth: 40,
                            boxHeight: 12,
                            generateLabels: function(chart) {
                                return chart.data.datasets.map(function(ds, i) {
                                    var color = ds.borderColor;
                                    return {
                                        text: ds.label,
                                        fillStyle: color + '33',
                                        strokeStyle: color,
                                        lineWidth: 3,
                                        hidden: !chart.isDatasetVisible(i),
                                        index: i
                                    };
                                });
                            }
                        }
                    }
                },
                scales: {
                    x: { grid: { color: '#d0d0d0' } },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#d0d0d0' },
                        ticks: { callback: function(value) { return value.toLocaleString(); } }
                    }
                }
            }
        });
    }
    initChart();

    // ── updateChart: dayData[31][12], mỗi tháng = 1 line ─────────────────
    function updateChart(dayData) {
        if (!reportChart) return;

        var selectedYear = parseInt(document.querySelector('.sl-year')?.value || currentYear);
        var now = new Date();
        var maxMonth = (selectedYear === now.getFullYear()) ? now.getMonth() + 1 : 12;

        var datasets = [];
        for (var mi = 0; mi < maxMonth; mi++) {
            var color = CHART_COLORS[mi % CHART_COLORS.length];
            datasets.push({
                label: String(mi + 1),
                data: dayData.map(function(row) { return row[mi] || 0; }),
                borderColor: color,
                backgroundColor: color,
                pointBackgroundColor: color,
                pointRadius: 4,
                borderWidth: 2,
                tension: 0
            });
        }
        reportChart.data.datasets = datasets;
        reportChart.update();
    }

    function _monthToDay(chartData) {
        return Array.from({length: 31}, function(_, di) {
            return chartData.map(function(v) { return di === 0 ? v : 0; });
        });
    }

    // ── Helpers ───────────────────────────────────────────────────────────
    function getMultiVal(cls) {
        if (window.jQuery && jQuery(cls).hasClass('select2-hidden-accessible'))
            return jQuery(cls).val() || [];
        return Array.from(document.querySelectorAll(cls + ' option:checked')).map(function(o) { return o.value; });
    }

    function fmt(v, isInt) {
        if (!v) return '';
        if (isInt) return Math.round(v).toLocaleString();
        return parseFloat(v.toFixed(3)).toString();
    }

    // ── applyReport ───────────────────────────────────────────────────────
    function applyReport() {
        var type       = document.querySelector('.sl-type')?.value || '0';
        var year       = parseInt(document.querySelector('.sl-year')?.value || currentYear);
        var method     = document.querySelector('.sl-method')?.value || '';
        var account    = document.querySelector('.sl-account')?.value || '';
        var provider   = document.querySelector('.sl-provider')?.value || '';
        var orderType  = document.querySelector('.sl-order-type')?.value || '0';
        var statuses   = getMultiVal('.sl-order-status');
        var serviceIds = getMultiVal('.sl-service').map(Number);

        if (typeof showFullScreenLoader === 'function') showFullScreenLoader('', 'body');
        setTimeout(function() {
            renderByDay(type, year, method, account || null, provider, orderType, statuses, serviceIds);
            if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
        }, 50);
    }

    // ── renderByDay ───────────────────────────────────────────────────────
    function renderByDay(type, year, method, accountUserId, provider, orderType, statuses, serviceIds) {
        var dayData = Array.from({length: 31}, function() { return Array(12).fill(0); });
        var isInt   = type !== '0' && (orderType === '1' || orderType === '2');

        if (type === '0') {
            rawPayments.forEach(function(r) {
                if (r.year !== year) return;
                if (method !== '0' && parseInt(r.method_id) !== parseInt(method)) return;
                if (accountUserId !== '0' && r.user_id != accountUserId) return;
                if (r.day >= 1 && r.day <= 31) dayData[r.day - 1][r.month - 1] += r.total;
            });
        } else {
            rawOrders.forEach(function(r) {
                if (r.year !== year) return;
                if (provider !== '0' && r.provider !== provider) return;
                if (accountUserId !== '0' && r.user_id != accountUserId) return;
                if (statuses.length && !statuses.includes(r.status)) return;
                if (serviceIds.length && !serviceIds.includes(parseInt(r.service_id))) return;
                var val = orderType === '1' ? r.order_count
                        : orderType === '2' ? r.quantity
                        : orderType === '3' ? r.profit : r.total;
                if (r.day >= 1 && r.day <= 31) dayData[r.day - 1][r.month - 1] += val;
            });
        }

        // Header
        var thead = document.getElementById('report-thead');
        if (thead) {
            var hcells = Array.from({length: 12}, function(_, i) {
                return '<th class="text-end" data-lang="Month ' + (i + 1) + '">Tháng ' + (i + 1) + '</th>';
            }).join('');
            thead.innerHTML = '<tr class="fw-bold bg-secondary"><th data-lang="Date">Ngày</th>' + hcells + '</tr>';
        }

        // Max per month
        var maxPerMonth = Array(12).fill(0);
        dayData.forEach(function(row) {
            row.forEach(function(v, mi) { if (v > maxPerMonth[mi]) maxPerMonth[mi] = v; });
        });

        // Body
        var tbody = document.getElementById('report-tbody');
        if (tbody) {
            tbody.innerHTML = dayData.map(function(row, di) {
                var cells = row.map(function(v, mi) {
                    var hi = v > 0 && v === maxPerMonth[mi] ? ' text-primary fw-bolder' : '';
                    return '<td class="text-end' + hi + '">' + fmt(v, isInt) + '</td>';
                }).join('');
                return '<tr><th class="fw-bold">' + (di + 1) + '</th>' + cells + '</tr>';
            }).join('');
        }

        // Tfoot
        var daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        var tfoot = document.getElementById('report-tfoot');
        if (tfoot) {
            var fcells = Array.from({length: 12}, function(_, mi) {
                var total = dayData.reduce(function(s, d) { return s + d[mi]; }, 0);
                var avg   = total > 0 ? total / daysInMonth[mi] : 0;
                return '<th class="text-end" style="line-height:1.2;">' + fmt(total, isInt)
                    + '<p class="fst-italic mb-0 text-success fs-8" style="line-height:1.2;">~ ' + fmt(avg, isInt) + '</p></th>';
            }).join('');
            tfoot.innerHTML = '<tr class="fw-bolder bg-secondary"><th data-lang="Total">Tổng</th>' + fcells + '</tr>';
        }

        updateChart(dayData);
    }

    // ── renderByMonth ─────────────────────────────────────────────────────
    function renderByMonth(type, year, method, accountUserId, provider, orderType, statuses, serviceIds) {
        var grouped   = {};
        var chartData = Array(12).fill(0);
        var monthNames = ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6',
                          'Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'];

        if (type === '0') {
            rawPayments.forEach(function(r) {
                if (r.year !== year) return;
                if (method !== '0' && parseInt(r.method_id) !== parseInt(method)) return;
                if (accountUserId !== '0' && r.user_id != accountUserId) return;
                var key = r.method_id;
                if (!grouped[key]) grouped[key] = Array(12).fill(0);
                grouped[key][r.month - 1] += r.total;
                chartData[r.month - 1] += r.total;
            });
        } else {
            rawOrders.forEach(function(r) {
                if (r.year !== year) return;
                if (provider !== '0' && r.provider !== provider) return;
                if (accountUserId !== '0' && r.user_id != accountUserId) return;
                if (statuses.length && !statuses.includes(r.status)) return;
                if (serviceIds.length && !serviceIds.includes(parseInt(r.service_id))) return;
                var val = orderType === '1' ? r.order_count
                        : orderType === '2' ? r.quantity
                        : orderType === '3' ? r.profit : r.total;
                var key = parseInt(r.service_id);
                if (!grouped[key]) grouped[key] = Array(12).fill(0);
                grouped[key][r.month - 1] += val;
                chartData[r.month - 1] += val;
            });
        }

        var isInt = type !== '0' && (orderType === '1' || orderType === '2');
        var cols  = Object.entries(grouped).map(function(e) {
            return {
                label: type === '0' ? (methodNames[e[0]] || 'Khác') : (serviceNames[e[0]] || '#' + e[0]),
                vals: e[1],
                total: e[1].reduce(function(s, v) { return s + v; }, 0)
            };
        }).sort(function(a, b) { return b.total - a.total; });

        if (!cols.length) {
            var tbody = document.getElementById('report-tbody');
            if (tbody) tbody.innerHTML = '<tr><td colspan="13" class="text-center text-muted py-4" data-lang="No data">Không có dữ liệu</td></tr>';
            updateChart(_monthToDay(chartData));
            return;
        }

        var thead = document.getElementById('report-thead');
        if (thead) {
            var hcells = cols.map(function(c) {
                return '<th class="text-end" style="max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="' + c.label + '">' + c.label + '</th>';
            }).join('');
            thead.innerHTML = '<tr class="fw-bold bg-secondary"><th data-lang="Month">Tháng</th>' + hcells + '<th class="text-end" data-lang="Total">Tổng</th></tr>';
        }

        var maxPerRow = Array(12).fill(0);
        for (var mi = 0; mi < 12; mi++) {
            cols.forEach(function(c) { if (c.vals[mi] > maxPerRow[mi]) maxPerRow[mi] = c.vals[mi]; });
        }

        var tbody = document.getElementById('report-tbody');
        if (tbody) {
            tbody.innerHTML = monthNames.map(function(mName, mi) {
                var rowTotal = 0;
                var cells = cols.map(function(c) {
                    var v = c.vals[mi] || 0; rowTotal += v;
                    var hi = v > 0 && v === maxPerRow[mi] ? ' text-primary fw-bolder' : '';
                    return '<td class="text-end' + hi + '">' + fmt(v, isInt) + '</td>';
                }).join('');
                return '<tr><th class="fw-bold">' + mName + '</th>' + cells
                    + '<td class="text-end fw-bold">' + (rowTotal ? fmt(rowTotal, isInt) : '') + '</td></tr>';
            }).join('');
        }

        var tfoot = document.getElementById('report-tfoot');
        if (tfoot) {
            var fcells = cols.map(function(c) { return '<th class="text-end">' + fmt(c.total, isInt) + '</th>'; }).join('');
            var grand  = cols.reduce(function(s, c) { return s + c.total; }, 0);
            tfoot.innerHTML = '<tr class="fw-bolder bg-secondary"><th data-lang="Total">Tổng</th>' + fcells + '<th class="text-end">' + fmt(grand, isInt) + '</th></tr>';
        }

        updateChart(_monthToDay(chartData));
    }

    // ── Select2 + first load ──────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function() {
        _toggleTypeUI(document.querySelector('.sl-type')?.value || '0');
        applyReport();

        // Init select2 sau khi t() đã dịch option text (t() chạy lúc 800ms)
        setTimeout(function() {
            if (window.jQuery && window.jQuery.fn.select2) {
                jQuery('[data-kt-select2="true"]:not(.select2-hidden-accessible)').each(function() {
                    var $el = jQuery(this);
                    $el.select2({
                        theme: 'bootstrap5',
                        placeholder: $el.data('placeholder') || '',
                        allowClear: $el.data('allow-clear') === true || $el.data('allow-clear') === 'true',
                        minimumResultsForSearch: $el.data('hide-search') ? Infinity : 0,
                        width: '100%'
                    });
                });
            }
        }, 900);
    });

    function _toggleTypeUI(val) {
        document.querySelectorAll('.type').forEach(function(el) { el.style.display = 'none'; });
        document.querySelectorAll('.type-' + val).forEach(function(el) { el.style.display = ''; });
        if (val !== '0') { var m = document.querySelector('.type-0'); if (m) m.style.display = 'none'; }
    }

    function changeType(val) { _toggleTypeUI(val); }
    </script>
@endsection
