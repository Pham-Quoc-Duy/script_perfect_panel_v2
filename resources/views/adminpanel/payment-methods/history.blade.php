@extends('adminpanel.layouts.app')
@section('title', 'Payment methods')
@section('content')
    <div class="content flex-row-fluid" id="kt_content"><span class="title d-none">History</span>
        <div class="d-flex align-items-center mb-3">
            <div class="flex-grow-1">
                <h3><span data-lang="Total">Total</span>: <strong class="total-funds text-success">$ {{ formatAmount($total) }}</strong></h3>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12 col-md-6 offset-md-6">
                <div class="input-group">
                    <div class="overflow-hidden flex-grow-1">
                        <select id="paymentMethodFilter" class="form-select rounded-end-0 sl-method"
                            data-control="select2"
                            data-placeholder="All"
                            data-lang="All"
                            data-allow-clear="true">
                            <option value=""></option>
                            @foreach($paymentMethods as $method)
                                <option value="{{ $method->id }}">{{ $method->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input class="form-control text-center ipt-date" placeholder="Select date range" data-lang="Select date range">
                </div>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-hover fs-7 gy-2 gs-5 mb-0" id="table-history-fund">
                        <thead>
                            <tr class="text-start text-muted bg-secondary fw-bold fs-7 text-uppercase gs-0">
                                <th data-lang="Account">Account</th>
                                <th data-lang="Amount">Số lượng</th>
                                <th data-lang="Bonus">Bonus</th>
                                <th data-lang="Method">Method</th>
                                <th data-lang="Created">Created</th>
                                <th data-lang="Details">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($payments->count() > 0)
                                @foreach($payments as $item)
                                    <tr>
                                        <td class="fw-semibold ls-1">
                                            <a class="text-reset text-hover-primary" target="_blank" href="/admin/accounts/{{ $item['account'] }}">
                                                {{ $item['account'] }}
                                            </a>
                                        </td>
                                        <td class="fw-bold text-success ls-1">{{ formatAmount($item['amount']) }}</td>
                                        <td class="text-nowrap">
                                            @if(($item['bonus_amount'] ?? 0) > 0)
                                                <span class="badge badge-light-warning text-warning fw-bold">+{{ formatAmount($item['bonus_amount']) }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-nowrap">{{ $item['method_name'] }}</td>
                                        <td class="text-nowrap">{{ $item['created_at'] }}</td>
                                        <td class="text-muted">{{ $item['details'] ?: '-' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Không có dữ liệu</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showFullScreenLoader() {
            let loader = document.getElementById('fullscreen-loader');
            if (!loader) {
                loader = document.createElement('div');
                loader.id = 'fullscreen-loader';
                loader.style.cssText = 'position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; align-items: center; justify-content: center; z-index: 9999;';
                loader.innerHTML = '<div class="text-center"><div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 3rem;"><span class="visually-hidden">Loading...</span></div><p class="text-white">Đang tải dữ liệu...</p></div>';
                document.body.appendChild(loader);
            }
            loader.style.display = 'flex';
        }

        function hideFullScreenLoader() {
            const loader = document.getElementById('fullscreen-loader');
            if (loader) loader.style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            initDatePicker();
        });

        function initDatePicker() {
            if (window.jQuery?.fn?.daterangepicker && window.moment) {
                jQuery(function($) {
                    const $dateInput = $('.ipt-date');
                    const $methodFilter = $('#paymentMethodFilter');
                    const isVi = (document.documentElement.lang || 'en')[0] == 'v';

                    if ($dateInput.length) {
                        const locales = {
                            en: {
                                format: 'YYYY/MM/DD', separator: ' - ', applyLabel: 'Apply', cancelLabel: 'Cancel',
                                customRangeLabel: 'Custom',
                                daysOfWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                firstDay: 0
                            },
                            vi: {
                                format: 'YYYY/MM/DD', separator: ' - ', applyLabel: 'Áp dụng', cancelLabel: 'Hủy',
                                customRangeLabel: 'Tùy chọn',
                                daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                                monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                                firstDay: 1
                            }
                        };

                        const ranges = isVi ? {
                            'Hôm nay': [moment(), moment()],
                            'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            '7 ngày gần nhất': [moment().subtract(6, 'days'), moment()],
                            '30 ngày gần nhất': [moment().subtract(29, 'days'), moment()],
                            'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                            'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        } : {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 days': [moment().subtract(29, 'days'), moment()],
                            'This month': [moment().startOf('month'), moment().endOf('month')],
                            'Last month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        };

                        $dateInput.daterangepicker({
                            autoUpdateInput: false,
                            startDate: moment(),
                            endDate: moment(),
                            locale: locales[isVi ? 'vi' : 'en'],
                            ranges: ranges
                        });

                        $dateInput.on('apply.daterangepicker', function(ev, picker) {
                            $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
                            applyFilters();
                        });

                        $dateInput.on('cancel.daterangepicker', function() {
                            $(this).val('');
                            applyFilters();
                        });

                        $dateInput.val(moment().format('YYYY/MM/DD') + ' - ' + moment().format('YYYY/MM/DD'));

                        $methodFilter.on('change', function() {
                            applyFilters();
                        });
                    }
                });
            } else {
                setTimeout(initDatePicker, 100);
            }
        }

        function applyFilters() {
            const dateRange = $('.ipt-date').val();
            const methodId = $('#paymentMethodFilter').val();
            let params = {};

            if (dateRange) {
                const dates = dateRange.split(' - ');
                if (dates.length === 2) {
                    params.start_date = dates[0];
                    params.end_date = dates[1];
                }
            }

            if (methodId) params.method_id = methodId;

            showFullScreenLoader();

            $.ajax({
                url: '{{ route("admin.payments.history-data") }}',
                type: 'GET',
                data: params,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        updateTable(response.data);
                        updateTotal(response.total);
                    }
                    hideFullScreenLoader();
                },
                error: function(xhr, status, error) {
                    console.error('Error loading data:', error);
                    hideFullScreenLoader();
                }
            });
        }

        function formatAmountJS(amount) {
            if (!amount || amount == 0) return '0';
            let formatted = parseFloat(amount).toFixed(4);
            return formatted.replace(/\.?0+$/, '') || '0';
        }

        function updateTable(data) {
            const tbody = $('#table-history-fund tbody');
            tbody.empty();

            if (data.length === 0) {
                tbody.html('<tr><td colspan="6" class="text-center text-muted py-4">Không có dữ liệu</td></tr>');
                return;
            }

            data.forEach(function(item) {
                const bonusHtml = (parseFloat(item.bonus_amount) > 0)
                    ? '<span class="badge badge-light-warning text-warning fw-bold">+' + formatAmountJS(item.bonus_amount) + '</span>'
                    : '<span class="text-muted">-</span>';

                const row = '<tr>'
                    + '<td class="fw-semibold ls-1"><a class="text-reset text-hover-primary" target="_blank" href="/admin/accounts/' + item.account + '">' + item.account + '</a></td>'
                    + '<td class="fw-bold text-success ls-1">' + formatAmountJS(item.amount) + '</td>'
                    + '<td class="text-nowrap">' + bonusHtml + '</td>'
                    + '<td class="text-nowrap">' + item.method_name + '</td>'
                    + '<td class="text-nowrap">' + item.created_at + '</td>'
                    + '<td class="text-muted">' + (item.details || '-') + '</td>'
                    + '</tr>';
                tbody.append(row);
            });
        }

        function updateTotal(total) {
            $('.total-funds').text('$ ' + formatAmountJS(total));
        }
    </script>
@endsection
