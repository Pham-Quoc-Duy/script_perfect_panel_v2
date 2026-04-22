@extends('adminpanel.layouts.app')
@section('title', 'Analytics')

@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        <div class="row g-5">

            {{-- Summary --}}
            <div class="col-lg-12 div-summary">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="row g-5 mb-10">
                            <div class="col-md-6">
                                <h2 class="total-summary total_orders ls-1">{{ number_format($totalOrders) }}</h2>
                                <span class="fs-8 text-gray-600">Total orders</span>
                            </div>
                            <div class="col-md-6">
                                <h2 class="total-summary total_deposit ls-1">$ {{ number_format($totalDeposit, 2) }}</h2>
                                <span class="fs-8 text-gray-600">Total deposit</span>
                            </div>
                        </div>
                        <div class="row g-5 mb-5">
                            <div class="col">
                                <h4 class="total-summary total_Failed ls-1">{{ number_format($statusCounts['failed']) }}
                                </h4>
                                <span class="fs-8 text-gray-600">Failed</span>
                            </div>
                            <div class="col">
                                <h4 class="total-summary total_Awaiting ls-1">{{ number_format($statusCounts['awaiting']) }}
                                </h4>
                                <span class="fs-8 text-gray-600">Awaiting</span>
                            </div>
                            <div class="col">
                                <h4 class="total-summary total_Schedule ls-1">{{ number_format($statusCounts['schedule']) }}
                                </h4>
                                <span class="fs-8 text-gray-600">Schedule</span>
                            </div>
                        </div>
                        <div class="row g-5">
                            <div class="col">
                                <h4 class="total-summary total_Pending ls-1">{{ number_format($statusCounts['pending']) }}
                                </h4>
                                <span class="fs-8 text-gray-600">Pending</span>
                            </div>
                            <div class="col">
                                <h4 class="total-summary total_Processing ls-1">
                                    {{ number_format($statusCounts['processing']) }}</h4>
                                <span class="fs-8 text-gray-600">Processing</span>
                            </div>
                            <div class="col">
                                <h4 class="total-summary total_In_progress ls-1">
                                    {{ number_format($statusCounts['inprogress']) }}</h4>
                                <span class="fs-8 text-gray-600">In progress</span>
                            </div>
                            <div class="col">
                                <h4 class="total-summary total_Done ls-1">{{ number_format($statusCounts['done']) }}</h4>
                                <span class="fs-8 text-gray-600">Done
                                    <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Completed, Canceled, Partial"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Top 10 services & users by date --}}
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-5">
                            <div class="input-group input-group-sm w-250px">
                                <span class="input-group-text"><i class="las la-calendar fs-2"></i></span>
                                <input class="form-control text-center ipt-date">
                            </div>
                        </div>
                        <div class="row g-5">
                            <div class="col-lg-9 border-end">
                                <div class="fw-semibold text-center mb-5 ls-1">Top 10 services</div>
                                <div class="loading-top-10-services text-center" style="display: none;">
                                    <span class="spinner-border text-primary" role="status"></span>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle fs-7 gy-2 mb-0 table-top-10-services">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="fw-semibold text-center mb-5 ls-1">Top 10 users charge</div>
                                <div class="loading-top-10-users-charge text-center" style="display: none;">
                                    <span class="spinner-border text-primary" role="status"></span>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle fs-7 gy-2 mb-0 table-top-10-users-charge">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Account chart --}}
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title mb-0" data-lang="">Tài khoản</h4>
                    </div>
                    <div class="card-body">
                        <div class="loading-account text-center" style="display: none;">
                            <span class="spinner-border text-primary" role="status"></span>
                        </div>
                        <div class="chart-wrapper" style="position: relative; height: 320px;">
                            <canvas id="chart-account"></canvas>
                        </div>
                        <div class="fw-semibold text-center mt-4 ls-1">
                            <span data-lang="">Thống kê tài khoản mới và tài khoản hoạt động</span> - {{ $year }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Service tables --}}
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">Dịch vụ</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-5">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle table-row-bordered fs-7 gy-2 gs-2"
                                        id="table-best-service-by-count">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <td colspan="2">Dịch vụ được đặt hàng nhiều nhất</td>
                                                <td class="text-end">COUNT</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($topServicesByCount as $i => $item)
                                                <tr>
                                                    <td>{{ $i + 1 }}</td>
                                                    <td class="wrap">{{ $item['service_label'] }}</td>
                                                    <td class="fw-bold">{{ number_format($item['value']) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted">Không có dữ liệu</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle table-row-bordered fs-7 gy-2 gs-2"
                                        id="table-best-service-by-charge">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <td colspan="2">Dịch vụ bán chạy nhất</td>
                                                <td class="text-end">CHARGE</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($topServicesByCharge as $i => $item)
                                                <tr>
                                                    <td>{{ $i + 1 }}</td>
                                                    <td class="wrap">{{ $item['service_label'] }}</td>
                                                    <td class="fw-bold">{{ number_format($item['value'], 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted">Không có dữ liệu
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="loading-service text-center" style="display: none;">
                            <span class="spinner-border text-primary" role="status"></span>
                        </div>
                        <div class="fw-semibold text-center mt-5 ls-1">
                            Thống kê dịch vụ bán chạy nhất (<span class="service-date">{{ $currentMonth }}</span>)
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        <script>
            var accountChartData = @json($accountChartData);
            var rawOrders = @json($rawOrders);
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                initChart();
                initDatePicker();
            });

            // ── Chart tài khoản ───────────────────────────────────────────────
            (function initChart() {
                if (typeof Chart !== 'undefined') {
                    var canvas = document.getElementById('chart-account');
                    var loader = document.querySelector('.loading-account');
                    if (!canvas) return;
                    if (loader) loader.style.display = 'none';

                    const chartAreaBorder = {
                        id: 'chartAreaBorder',
                        beforeDraw(chart) {
                            const {
                                ctx,
                                chartArea: {
                                    left,
                                    top,
                                    width,
                                    height
                                }
                            } = chart;
                            ctx.save();
                            ctx.strokeStyle = '#dcdcdc';
                            ctx.lineWidth = 1;
                            ctx.strokeRect(left, top, width, height);
                            ctx.restore();
                        }
                    };

                    new Chart(canvas, {
                        type: 'line',
                        data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'August', 'September', 'October', 'November', 'December'
                            ],
                            datasets: [{
                                    label: 'Mới',
                                    data: accountChartData.new,
                                    borderColor: '#3498db',
                                    pointBackgroundColor: '#3498db',
                                    pointRadius: 4,
                                    borderWidth: 2,
                                    tension: 0,
                                    fill: false
                                },
                                {
                                    label: 'Hoạt động',
                                    data: accountChartData.active,
                                    borderColor: '#ff4d6d',
                                    pointBackgroundColor: '#ff4d6d',
                                    pointRadius: 4,
                                    borderWidth: 2,
                                    tension: 0,
                                    fill: false
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        usePointStyle: false,
                                        boxWidth: 38, // 🔥 dài hơn
                                        boxHeight: 12, // 🔥 cao hơn (dày hơn)
                                        padding: 15,

                                        generateLabels: function(chart) {
                                            const datasets = chart.data.datasets;
                                            return datasets.map((ds, i) => ({
                                                text: ds.label,
                                                fillStyle: ds.borderColor + '33',
                                                strokeStyle: ds.borderColor,
                                                lineWidth: 3, // 🔥 viền dày hơn
                                                hidden: !chart.isDatasetVisible(i),
                                                datasetIndex: i
                                            }));
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: false,
                                    ticks: {
                                        precision: 0
                                    },
                                    grid: {
                                        color: '#e9e9e9'
                                    }
                                },
                                x: {
                                    grid: {
                                        color: '#f2f2f2'
                                    }
                                }
                            }
                        },
                        plugins: [chartAreaBorder]
                    });
                } else {
                    setTimeout(initChart, 100);
                }
            })();

            // ── Loader ────────────────────────────────────────────────────────
            function toggleTableLoader(show) {
                const l1 = document.querySelector('.loading-top-10-services');
                const l2 = document.querySelector('.loading-top-10-users-charge');
                const t1 = document.querySelector('.table-top-10-services');
                const t2 = document.querySelector('.table-top-10-users-charge');
                if (l1) l1.style.display = show ? 'block' : 'none';
                if (l2) l2.style.display = show ? 'block' : 'none';
                // ẩn hoàn toàn table khi loading, hiện lại khi xong
                if (t1) t1.style.display = show ? 'none' : '';
                if (t2) t2.style.display = show ? 'none' : '';
            }

            // ── Client-side filter ────────────────────────────────────────────
            function applyFilters() {
                const dateInput = document.querySelector('.ipt-date');
                let from = null,
                    to = null;

                if (dateInput?.value && dateInput.value.includes(' - ')) {
                    const parts = dateInput.value.split(' - ');
                    from = parts[0].trim().replace(/\//g, '-');
                    to = parts[1].trim().replace(/\//g, '-');
                }

                // Show loader first, then process in next frame so browser renders spinner
                toggleTableLoader(true);

                setTimeout(function() {
                    const filtered = rawOrders.filter(function(o) {
                        if (!from || !to) return true;
                        return o.date >= from && o.date <= to;
                    });

                    const serviceMap = {};
                    filtered.forEach(function(o) {
                        if (!serviceMap[o.service_id]) serviceMap[o.service_id] = {
                            label: o.service_label,
                            image: o.service_image,
                            charge: 0
                        };
                        serviceMap[o.service_id].charge += o.charge;
                    });
                    const top10Services = Object.values(serviceMap).sort((a, b) => b.charge - a.charge).slice(0, 10);

                    const userMap = {};
                    filtered.forEach(function(o) {
                        if (!userMap[o.user_id]) userMap[o.user_id] = {
                            username: o.username,
                            charge: 0
                        };
                        userMap[o.user_id].charge += o.charge;
                    });
                    const top10Users = Object.values(userMap).sort((a, b) => b.charge - a.charge).slice(0, 10);

                    const sTbody = document.querySelector('.table-top-10-services tbody');
                    if (sTbody) {
                        sTbody.innerHTML = top10Services.length ?
                            top10Services.map(r => {
                                let icon = '';
                                if (r.image && /^https?:\/\//i.test(r.image)) {
                                    icon =
                                        `<img src="${r.image}" class="me-1" style="width:20px;height:20px;object-fit:contain;border-radius:3px;" loading="lazy">`;
                                } else if (r.image) {
                                    icon = `<i class="${r.image} me-1"></i>`;
                                }
                                return `<tr><th class="text-right fw-bold">${r.charge.toFixed(3)}</th><td>${icon}${r.label}</td></tr>`;
                            }).join('') :
                            '<tr><td colspan="2" class="text-center text-muted">Không có dữ liệu</td></tr>';
                    }

                    const uTbody = document.querySelector('.table-top-10-users-charge tbody');
                    if (uTbody) {
                        uTbody.innerHTML = top10Users.length ?
                            top10Users.map(r => {
                                const link = r.username !== 'N/A' ?
                                    `<a target="_blank" href="/admin/accounts/${r.username}">${r.username}</a>` :
                                    'N/A';
                                return `<tr><td>${link}</td><th class="text-right fw-bold">${r.charge.toFixed(3)}</th></tr>`;
                            }).join('') :
                            '<tr><td colspan="2" class="text-center text-muted">Không có dữ liệu</td></tr>';
                    }

                    toggleTableLoader(false);
                }, 150);
            }

            // ── Date picker ───────────────────────────────────────────────────
            (function initDatePicker() {
                if (window.jQuery?.fn?.daterangepicker && window.moment) {
                    jQuery(function($) {
                        const $dateInput = $('.ipt-date');
                        if (!$dateInput.length) return;

                        $dateInput.daterangepicker({
                            autoUpdateInput: false,
                            startDate: moment().startOf('month'),
                            endDate: moment().endOf('month'),
                            locale: {
                                format: 'YYYY/MM/DD',
                                separator: ' - ',
                                applyLabel: 'Áp dụng',
                                cancelLabel: 'Hủy',
                                customRangeLabel: 'Tùy chọn',
                                daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                                monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5',
                                    'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10',
                                    'Tháng 11', 'Tháng 12'
                                ],
                                firstDay: 1
                            },
                            ranges: {
                                'Hôm nay': [moment(), moment()],
                                'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                '7 ngày gần nhất': [moment().subtract(6, 'days'), moment()],
                                '30 ngày gần nhất': [moment().subtract(29, 'days'), moment()],
                                'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                                'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment()
                                    .subtract(1, 'month').endOf('month')
                                ]
                            }
                        });

                        $dateInput.on('apply.daterangepicker', function(ev, picker) {
                            $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate
                                .format('YYYY/MM/DD'));
                            applyFilters();
                        });

                        $dateInput.on('cancel.daterangepicker', function() {
                            $(this).val('');
                            applyFilters();
                        });

                        $dateInput.val(
                            moment().startOf('month').format('YYYY/MM/DD') + ' - ' +
                            moment().endOf('month').format('YYYY/MM/DD')
                        );

                        applyFilters();
                    });
                } else {
                    setTimeout(initDatePicker, 100);
                }
            })();
        </script>
    </div>
@endsection
