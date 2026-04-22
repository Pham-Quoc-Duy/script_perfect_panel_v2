@extends('clients.theme-4.layouts.app')
@section('title', __('addfunds.title'))

@section('content')
    <div class="content flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar d-flex flex-stack flex-wrap mb-5 mb-lg-7" id="kt_toolbar">
            <div class="page-title d-flex flex-column py-1">
                <h1 class="d-flex align-items-center my-1">
                    <span class="text-gray-900 fw-bold fs-1" data-lang="addfunds.title">Nạp tiền</span>
                </h1>
            </div>
            <div class="d-flex align-items-center py-2 gap-2">
                <div class="d-flex align-items-center">
                    <a href="/addfunds" class="btn btn-primary btn-sm fw-bold fs-4 ls-2 py-1">
                        {{ number_format(auth()->user()->balance ?? 0) }}
                        <sup>₫</sup>
                    </a>
                </div>
                <div class="d-flex align-items-center">
                    <a href="/settings"><span class="rounded-1 fi fi-vn" style="font-size: 2.2em !important;"></span></a>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Post-->
        <div class="post" id="kt_post">
            <div class="row g-5 mb-5">

                {{-- Card 1: Hạng thành viên --}}
                <div class="col-md-4 col-12">
                    <div class="card border-hover-primary h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="d-flex flex-column">
                                <span class="fw-bold fs-2x lh-1 ls-2">{{ ucfirst(auth()->user()->level ?? 'Retail') }}</span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-7 text-gray-500" data-lang="addfunds.member_level">Hạng thành viên</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Tổng tiền nạp --}}
                <div class="col-md-4 col-12">
                    <div class="card border-hover-primary h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="d-flex flex-column">
                                <span class="text-primary fw-bold fs-2x lh-1 ls-2">
                                    {{ formatCurrencyAmount($transactions->where('status', 'completed')->sum('amount'), $currency, $nonDecimalCodes) }}
                                </span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-7 text-gray-500" data-lang="addfunds.total_deposit">Tổng tiền nạp</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Tổng tiền thưởng --}}
                <div class="col-md-4 col-12">
                    <div class="card border-hover-primary h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="d-flex flex-column">
                                <span class="text-warning fw-bold fs-2x lh-1 ls-2">
                                    {{ formatCurrencyAmount($transactions->where('type', 'bonus')->sum('amount'), $currency, $nonDecimalCodes) }}
                                </span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-7 text-gray-500" data-lang="addfunds.total_bonus">Tổng tiền thưởng</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Col trái: Chọn phương thức --}}
                <div class="col-md-5 col-12">
                    <div class="card">
                        <div class="card-body">

                            {{-- Select phương thức thanh toán --}}
                            <div class="mb-3">
                                <label for="sl-pm-method" class="form-label" data-lang="addfunds.payment_method">Phương thức thanh toán</label>
                                <select id="sl-pm-method" class="form-select form-select-solid">
                                    <option value="0" data-lang="addfunds.please_select">Vui lòng chọn</option>
                                    @forelse($payments as $payment)
                                        @php
                                            $bonus = $payment->parsed_config['bonus'] ?? $payment->bonus ?? null;
                                            $hasBonus = !empty($bonus);
                                            $label = $payment->name . ($hasBonus ? ' (' . __('addfunds.has_bonus') . ')' : '');
                                            $imgTag = $payment->image
                                                ? '<img src="' . e($payment->image) . '" class="rounded-circle h-20px me-2"/>'
                                                : '';
                                            $dataContent = $imgTag . ' ' . $label;
                                        @endphp
                                        <option value="{{ $payment->id }}"
                                            data-type="{{ $payment->type }}"
                                            data-content="{{ $dataContent }}">
                                            {{ $label }}
                                        </option>
                                    @empty
                                        <option value="0" disabled>{{ __('addfunds.no_payment_methods') }}</option>
                                    @endforelse
                                </select>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    $('#sl-pm-method').select2({
                                        escapeMarkup: function(markup) { return markup; },
                                        minimumResultsForSearch: -1,
                                        templateResult: function(option) {
                                            if (!option.element) return option.text;
                                            const style = option.element.getAttribute('style');
                                            if (style && style.includes('display: none')) return null;
                                            const content = option.element.getAttribute('data-content');
                                            return content ? content : option.text;
                                        },
                                        templateSelection: function(option) {
                                            if (!option.element) return option.text;
                                            const content = option.element.getAttribute('data-content');
                                            return content ? content : option.text;
                                        },
                                        width: '100%'
                                    });

                                    function onPaymentChange(pmId) {
                                        // Ẩn tất cả
                                        $('#pm-separator, .div-rate, .div-bonus, .div-options, #div-sieuthicode').hide();

                                        if (!pmId || pmId === '0') return;

                                        // Lấy pm từ PAYMENT_METHODS
                                        var pm = null;
                                        if (typeof PAYMENT_METHODS !== 'undefined') {
                                            for (var i = 0; i < PAYMENT_METHODS.length; i++) {
                                                if (String(PAYMENT_METHODS[i].id) === String(pmId)) { pm = PAYMENT_METHODS[i]; break; }
                                            }
                                        }
                                        if (!pm) return;

                                        // Lấy type từ option element
                                        var selectedOption = $('#sl-pm-method option:selected');
                                        var pmType = selectedOption.data('type') || pm.type || '';

                                        $('#pm-separator').show();

                                        // Tỉ giá
                                        if (pm.rate) {
                                            $('#pm-rate-text').text('1 USD = ' + Number(pm.rate).toLocaleString() + ' ' + (pm.currency || 'VND'));
                                            $('.div-rate').show();
                                        }

                                        // Bảng tiền thưởng
                                        var rows = (pm.bonus_data && pm.bonus_data.length) ? pm.bonus_data : [];
                                        if (rows.length) {
                                            var html = '';
                                            rows.forEach(function(b) {
                                                var amount = Number(b.min || b.q || 0).toLocaleString('en-US');
                                                var percent = b.percent || b.p || 0;
                                                html += '<tr><td class="ls-1">$ ' + amount + '</td><td class="fw-bold">' + percent + '%</td></tr>';
                                            });
                                            $('#bonus-tbody').html(html);
                                            $('.div-bonus').show();
                                        }

                                        // Parse options
                                        var opts = pm.options || {};

                                        var account  = pm.account_number || opts.account_number || opts.account || '';
                                        var accName  = pm.account_name   || opts.account_name   || opts.name   || '';
                                        var bankCode = pm.bank_code      || opts.bank_code       || opts.bank   || '';
                                        var content = (typeof TRANSFER_CODE !== 'undefined' && TRANSFER_CODE) ? TRANSFER_CODE : '';

                                        // Show div theo type
                                        if (pmType === 'bank_vn' || pmType === 'bank') {
                                            // QR: https://img.vietqr.io/image/{pm.name}-{account}-qr_only.jpg?amount=0&accountName={name}&addInfo={transfer_code}
                                            var transferCode = (typeof TRANSFER_CODE !== 'undefined' && TRANSFER_CODE) ? TRANSFER_CODE : content;
                                            var qrUrl = 'https://img.vietqr.io/image/'
                                                + encodeURIComponent(pm.name) + '-'
                                                + encodeURIComponent(account)
                                                + '-qr_only.jpg?amount=0'
                                                + (accName ? '&accountName=' + encodeURIComponent(accName) : '')
                                                + '&addInfo=' + encodeURIComponent(transferCode);
                                            $('#sieuthicode_qr_img').attr('src', qrUrl);
                                            $('#sieuthicode_webhook_account').html(
                                                (account ? '<span class="fw-boldest text-primary fs-4">' + account + '</span>' : '') +
                                                (accName ? ' (<span class="fw-bolder fs-6">' + accName + '</span>)' : '')
                                            );
                                            $('#sieuthicode_content_text').text(transferCode);
                                            $('#div-sieuthicode').show();

                                        } else if (pmType === 'manual' || pmType === 'redirect' || pmType === 'form') {
                                            // Form nhập số tiền
                                            $('.div-options.div-36').find('[name="PM_ID"]').val(pmId);
                                            $('.div-options.div-36').show();

                                        } else if (pmType === 'crypto' || pmType === 'binance') {
                                            // Chỉ hiển thị input Amount
                                            window._currentBinancePm = pm;
                                            $('#ipt-binance-pm-id').val(pmId);
                                            $('#binance-currency-label').text(pm.currency || 'USD');
                                            $('#div-binance').show();

                                        } else {
                                            // Fallback: show form nhập tiền
                                            $('.div-options.div-36').find('[name="PM_ID"]').val(pmId);
                                            $('.div-options.div-36').show();
                                        }

                                        // Min/max — chỉ hiển thị khi > 0
                                        if (pm.min > 0 || pm.max > 0) {
                                            var minMax = '';
                                            if (pm.min > 0) minMax += 'Min: ' + Number(pm.min).toLocaleString();
                                            if (pm.max > 0) minMax += (minMax ? ' | ' : '') + 'Max: ' + Number(pm.max).toLocaleString();
                                            $('.div-minmax').text(minMax).show();
                                        } else {
                                            $('.div-minmax').hide();
                                        }
                                    }

                                    // Khi chọn option
                                    $('#sl-pm-method').on('change', function() {
                                        onPaymentChange($(this).val());
                                    });

                                    // Mặc định ẩn khi vào trang
                                    onPaymentChange('0');

                                    // Binance Check → mở modal QR
                                    $('#btn-binance-check').on('click', function() {
                                        var pm = window._currentBinancePm;
                                        if (!pm) return;

                                        var opts       = pm.options || {};
                                        var wallet     = pm.account_number || opts.wallet || opts.address || opts.account || '';
                                        var binanceId  = pm.binance_id || opts.binance_id || opts.uid || '';
                                        var qrImg      = pm.qr_image || opts.qr_image || '';
                                        var amount     = $('#ipt-binance-amount').val() || '';
                                        var currency   = pm.currency || 'USDT';

                                        $('#service-name').empty();

                                        // #service-description → QR + thông tin ví
                                        var descHtml = '';
                                        if (qrImg) {
                                            descHtml += '<div class="text-center mb-5">'
                                                + '<div class="d-inline-block position-relative p-3 bg-white rounded shadow-sm">'
                                                + '<img src="' + qrImg + '" class="d-block" style="width:200px;height:200px;object-fit:contain;">'
                                                + '</div></div>';
                                        }
                                        if (wallet) {
                                            descHtml += '<div class="d-flex justify-content-between align-items-center py-3 border-bottom">'
                                                + '<span class="text-muted fs-7 text-uppercase fw-bold">Wallet / ID</span>'
                                                + '<span class="fw-bold text-primary fs-6 ms-3 text-end" style="word-break:break-all">' + wallet + '</span>'
                                                + '</div>';
                                        }
                                        if (binanceId) {
                                            descHtml += '<div class="d-flex justify-content-between align-items-center py-3 border-bottom">'
                                                + '<span class="text-muted fs-7 text-uppercase fw-bold">Binance ID</span>'
                                                + '<span class="fw-bold text-primary fs-6 ms-3 text-end font-monospace">' + binanceId + '</span>'
                                                + '</div>';
                                        }
                                        if (amount) {
                                            descHtml += '<div class="d-flex justify-content-between align-items-center py-3 border-bottom">'
                                                + '<span class="text-muted fs-7 text-uppercase fw-bold">{{ $langData["addfunds.amount"] ?? "Amount" }}</span>'
                                                + '<span class="fw-bold text-warning fs-5">' + amount + ' ' + currency + '</span>'
                                                + '</div>';
                                        }
                                        var transferCode = (typeof TRANSFER_CODE !== 'undefined' && TRANSFER_CODE) ? TRANSFER_CODE : '';
                                        if (transferCode) {
                                            descHtml += '<div class="d-flex justify-content-between align-items-center py-3 border-top">'
                                                + '<span class="text-muted fs-7 text-uppercase fw-bold">{{ $langData["addfunds.note"] ?? "Note" }}</span>'
                                                + '<span class="fw-bold text-danger fs-6 ms-3 text-end font-monospace">' + transferCode + '</span>'
                                                + '</div>';
                                        }
                                        $('#service-description').html(descHtml);

                                        // Ẩn nút Buy now
                                        $('#modal-desc-buy').hide();

                                        new bootstrap.Modal(document.getElementById('modal-description')).show();
                                    });
                                });
                            </script>

                            <div class="separator my-5" id="pm-separator" style="display: none;"></div>
                            <div class="div-minmax mb-1 text-center"></div>
                            <div class="div-rate mb-5 text-center" style="display: none;">
                                <span class="fw-bolder fs-6 text-primary" id="pm-rate-text"></span>
                            </div>

                            {{-- Bảng tiền thưởng - render động bằng JS --}}
                            <div class="div-bonus mb-5 text-center" style="display: none;">
                                <table class="table align-middle table-bordered fs-7 gy-2 gs-10 mb-0">
                                    <tbody id="bonus-tbody"></tbody>
                                </table>
                            </div>

                            {{-- Các div-options (ẩn/hiện theo JS) --}}
                            <div class="div-options div-1 div-2 div-9 div-26 div-30 div-31 text-center" style="display: none;">
                                <img src="" class="w-250px mb-5">
                                <div>
                                    <span id="casso_account"></span>
                                    <span class="d-block" id="casso_name"></span>
                                    <span class="d-block" id="casso_content"></span>
                                </div>
                            </div>

                            <div class="div-options div-10 div-11 div-12 div-16 text-center" style="display: none;">
                                <img src="" class="w-250px mb-5">
                                <div class="mb-5">
                                    <span id="web2m_account"></span>
                                    <span class="d-block" id="web2m_content"></span>
                                </div>
                            </div>

                            <div class="div-options div-13 text-center" style="display: none;">
                                <img src="" class="w-250px mb-5">
                                <div class="mb-5">
                                    <span id="web2m_momo_phone"></span>
                                    <span class="d-block" id="web2m_momo_content"></span>
                                </div>
                            </div>

                            <div class="div-options div-19 div-20 div-21 div-29 div-37 text-center" style="display: none;">
                                <img src="" class="w-250px mb-5">
                                <div>
                                    <span id="web2m_webhook_account"></span>
                                    <span class="d-block" id="web2m_webhook_name"></span>
                                    <span class="d-block" id="web2m_webhook_content">{{ __('addfunds.transfer_note') }} <span class="fs-6 fw-bolder text-primary">{{ auth()->user()->name ?? '' }} chuyen tien</span></span>
                                </div>
                                <h5 class="text-danger fw-bold" data-lang="addfunds.note_no_change_content"></h5>
                            </div>

                            {{-- div-23: sieuthicode webhook bank - render động bằng JS --}}
                            <div id="div-sieuthicode" class="div-options div-23 div-24 div-25 div-38 text-center" style="display: none;">
                                <img src="" class="w-250px mb-5" id="sieuthicode_qr_img">
                                <div>
                                    <span id="sieuthicode_webhook_account"></span>
                                    <span class="d-block" id="sieuthicode_webhook_name"></span>
                                    <span class="d-block" id="sieuthicode_webhook_content">{{ __('addfunds.transfer_note') }} <span class="fs-6 fw-bolder text-primary" id="sieuthicode_content_text"></span></span>
                                </div>
                                <h5 class="text-danger fw-bold" data-lang="addfunds.note_no_change_content"></h5>
                            </div>
                            <div class="div-options div-39 div-40 div-41 div-42 div-43 div-44 text-center" style="display: none;">
                                <img src="" class="w-250px mb-5">
                                <div>
                                    <span id="pay2s_account"></span>
                                    <span class="d-block" id="pay2s_name"></span>
                                    <span class="d-block" id="pay2s_content">{{ __('addfunds.transfer_note') }} <span class="fs-6 fw-bolder text-primary">{{ $content ?? '' }} chuyen tien1</span></span>
                                </div>
                                <h5 class="text-danger fw-bold" data-lang="addfunds.note_no_change_content"></h5>
                            </div>

                            {{-- Binance / Crypto: chỉ nhập Amount, Submit → modal QR --}}
                            <div id="div-binance" class="div-options mb-5" style="display: none;">
                                <div class="mb-5">
                                    <label class="required form-label" data-lang="addfunds.enter_amount"></label>
                                    <input type="hidden" id="ipt-binance-pm-id" name="PM_ID" value="">
                                    <div class="input-group">
                                        <span class="input-group-text" id="binance-currency-label">USD</span>
                                        <input type="number" id="ipt-binance-amount" name="PAYMENT_AMOUNT"
                                            value="" min="0" step="any"
                                            class="form-control form-control-solid">
                                    </div>
                                </div>
                                <button type="button" id="btn-binance-check" class="btn btn-primary w-100"
                                    data-lang="addfunds.pay_now"></button>
                            </div>

                            <div class="div-options div-36" style="display: none;">
                                <form method="post" action="">
                                    @csrf
                                    <div class="mb-5">
                                        <label class="required form-label" data-lang="addfunds.enter_amount">Số tiền</label>
                                        <input type="hidden" name="PM_ID" value="">
                                        <div class="input-group">
                                            <input type="text" name="PAYMENT_AMOUNT" id="vnd-input" value=""
                                                placeholder="1000000" class="form-control" inputmode="numeric"
                                                style="text-align: right;">
                                            <span class="input-group-text">VNĐ</span>
                                        </div>
                                    </div>
                                    <input type="submit" name="PAYMENT_METHOD" class="btn btn-primary w-100" data-lang="addfunds.pay_now" value="Thanh toán">
                                </form>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        Inputmask({
                                            alias: "numeric",
                                            groupSeparator: ".",
                                            radixPoint: ",",
                                            autoGroup: true,
                                            digits: 0,
                                            digitsOptional: false,
                                            prefix: "",
                                            suffix: "",
                                            rightAlign: true,
                                            removeMaskOnSubmit: true
                                        }).mask("#vnd-input");
                                    });
                                </script>
                            </div>

                            <div class="alert alert-addfunds alert-normal mt-5 mb-5" style="display: none;"></div>
                            <script>
                                var CONTENT = '{{ $content ?? '' }}';
                                var TRANSFER_CODE = '{{ auth()->user()->transfer_code ?? '' }}';
                            </script>

                            {{-- Chi tiết phương thức --}}
                            <div class="div-details mb-5"></div>

                        </div>
                    </div>
                </div>

                {{-- Col phải: Lịch sử giao dịch --}}
                <div class="col-md-7 col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="mb-3 p-8 pb-3">
                                <label class="form-label" data-lang="addfunds.filter">Lọc</label>
                                <input type="text" id="ipt-date" class="form-control form-control-solid ipt-date"
                                    placeholder="{{ __('addfunds.filter_placeholder') }}" readonly>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-7 gy-2 gs-5 mb-0" id="table-history-fund">
                                    <thead class="text-start text-muted bg-light fw-bold fs-7 text-uppercase gs-0">
                                        <tr>
                                            <th data-lang="addfunds.method">Phương thức</th>
                                            <th data-lang="addfunds.amount">Số tiền</th>
                                            <th data-lang="common.status">Trạng thái</th>
                                            <th data-lang="addfunds.created">Thời gian</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $transaction)
                                            <tr>
                                                <td>
                                                    @if($transaction->paymentMethod?->image)
                                                        <img src="{{ $transaction->paymentMethod->image }}"
                                                            class="rounded-circle h-20px me-1 p-0"
                                                            alt="{{ $transaction->paymentMethod->name }}">
                                                    @endif
                                                    {{ $transaction->paymentMethod->name ?? 'N/A' }}
                                                    @if(!empty($transaction->reference))
                                                        <p class="wrap fs-8 fst-italic m-1 mb-0">{{ $transaction->reference }}</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $isBonus = ($transaction->type ?? '') === 'bonus';
                                                    @endphp
                                                    <span class="fw-bolder {{ $isBonus ? 'text-warning' : 'text-primary' }}">
                                                        {{ number_format($transaction->amount, 3) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @php
                                                        $st = $transaction->status ?? 'pending';
                                                        $stClass = match($st) {
                                                            'completed' => 'badge-light-success',
                                                            'pending'   => 'badge-light-warning',
                                                            'failed'    => 'badge-light-danger',
                                                            default     => 'badge-light-secondary',
                                                        };
                                                        $stLabel = match($st) {
                                                            'completed' => __('addfunds.status_completed'),
                                                            'pending'   => __('addfunds.status_pending'),
                                                            'failed'    => __('addfunds.status_failed'),
                                                            default     => ucfirst($st),
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $stClass }}">{{ $stLabel }}</span>
                                                </td>
                                                <td>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</td>
                                                <td>
                                                    @if(!$isBonus)
                                                        <a href="javascript:;" class="ms-2"
                                                            onclick="_addfunds.on.click.invoice({{ $transaction->id }})"
                                                            title="Download Invoice">
                                                            <i class="fas fa-file-invoice"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-8">
                                                    <i class="ki-outline ki-inbox fs-3x d-block mb-2"></i>
                                                    <span data-lang="addfunds.no_transactions">Chưa có giao dịch nào</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Modal QR Binance/Crypto --}}
            <div class="modal fade" id="modal-binance-qr" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header py-4">
                            <h5 class="modal-title" id="modal-binance-title">Binance Pay</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center py-6">
                            <div id="modal-binance-qr-wrap" class="mb-4" style="display:none;">
                                <img id="modal-binance-qr-img" src="" alt="QR" class="w-200px rounded">
                            </div>
                            <div id="modal-binance-info" class="text-start fs-7"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal dùng chung cho Binance/Crypto QR --}}
            <div class="modal fade" id="modal-description" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-start p-5">
                            <div id="service-name" style="display:none;"></div>
                            <div class="separator separator-dashed my-5" style="display:none;"></div>
                            <div id="service-description"></div>
                            <a id="modal-desc-buy" href="#" target="_blank"
                                class="btn btn-primary w-100 mt-5 text-uppercase" style="display:none;">Buy now</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal hạng thành viên --}}
            <div class="modal fade" id="modal-memberlevel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header py-4">
                            <h4 class="modal-title" data-lang="addfunds.member_level">Hạng thành viên</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <table class="table align-middle table-row-dashed fs-7 gy-3 gs-5 mb-0">
                                <thead class="text-start text-muted bg-light fw-bold fs-7 text-uppercase gs-0">
                                    <tr>
                                        <td></td>
                                        <th class="text-center" data-lang="addfunds.total_deposit">Tổng tiền nạp</th>
                                        <th class="text-center" data-lang="addfunds.deposit_bonus">% tiền thưởng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>NEWBIE</th>
                                        <td class="text-center text-primary fw-bolder">&gt;= $0</td>
                                        <td class="text-center text-warning fw-bolder">0%</td>
                                    </tr>
                                    <tr>
                                        <th>JUNIOR</th>
                                        <td class="text-center text-primary fw-bolder">&gt;= $1000</td>
                                        <td class="text-center text-warning fw-bolder">0%</td>
                                    </tr>
                                    <tr>
                                        <th>ELITE</th>
                                        <td class="text-center text-primary fw-bolder">&gt;= $5000</td>
                                        <td class="text-center text-warning fw-bolder">0%</td>
                                    </tr>
                                    <tr>
                                        <th>FREQUENT</th>
                                        <td class="text-center text-primary fw-bolder">&gt;= $10000</td>
                                        <td class="text-center text-warning fw-bolder">0%</td>
                                    </tr>
                                    <tr>
                                        <th>VIP</th>
                                        <td class="text-center text-primary fw-bolder">&gt;= $20000</td>
                                        <td class="text-center text-warning fw-bolder">0%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PAYMENT_METHODS JSON cho JS --}}
            @php
                $paymentMethodsJson = $payments->map(function($p) {
                    $cfg = $p->parsed_config;
                    $bonus = is_string($p->bonus) ? json_decode($p->bonus, true) : ($p->bonus ?? []);
                    $bonusData = [];
                    foreach (($bonus ?? []) as $b) {
                        $bonusData[] = [
                            'q' => $b['min'] ?? $b['q'] ?? 0,
                            'p' => $b['percent'] ?? $b['p'] ?? 0,
                        ];
                    }
                    return [
                        'id'             => $p->id,
                        'currency'       => $p->currency,
                        'name'           => $p->name,
                        'custom_icon'    => $p->image,
                        'icon'           => $p->image,
                        'rate'           => $cfg['rate'] ?? 27000,
                        'details'        => $p->details ?? '',
                        'options'        => $cfg,
                        'bonus'          => !empty($bonus) ? 1 : 0,
                        'bonus_data'     => $bonusData,
                        'min'            => $p->min ?? 0,
                        'max'            => $p->max ?? 0,
                        'type'           => $p->type,
                        'account_number' => $cfg['account_number'] ?? $cfg['account'] ?? '',
                        'account_name'   => $cfg['account_name']   ?? $cfg['name']    ?? '',
                        'bank_code'      => $cfg['bank_code']       ?? $cfg['bank']    ?? '',
                        'qr_image'       => $cfg['qr_image']        ?? '',
                        'binance_id'     => $cfg['binance_id']      ?? $cfg['uid']     ?? '',
                    ];
                })->values();
            @endphp
            <script>
                var PAYMENT_METHODS = {!! json_encode($paymentMethodsJson) !!};
            </script>

        </div>
        <!--end::Post-->
    </div>
@endsection

@push('scripts')
<script>
(function initDatePicker() {
    if (window.jQuery?.fn?.daterangepicker && window.moment) {
        jQuery(function($) {
            const $dateInput = $('#ipt-date');
            if (!$dateInput.length) return;

            $dateInput.daterangepicker({
                autoUpdateInput: false,
                drops: 'down',
                opens: 'right',
                showDropdowns: true,
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month'),
                locale: {!! json_encode([
                    'format'      => 'YYYY/MM/DD',
                    'separator'   => ' - ',
                    'applyLabel'       => $langData['addfunds.button_Apply']  ?? 'Apply',
                    'cancelLabel'      => $langData['addfunds.button_Cancel'] ?? 'Cancel',
                    'customRangeLabel' => $langData['addfunds.Custom range']  ?? 'Custom range',
                    'daysOfWeek'       => $langData['addfunds.days_of_week']  ?? ['Su','Mo','Tu','We','Th','Fr','Sa'],
                    'monthNames'       => $langData['addfunds.month_names']   ?? ['January','February','March','April','May','June','July','August','September','October','November','December'],
                    'firstDay'    => 1,
                ]) !!},
                ranges: {
                    '{{ $langData["addfunds.Today"]        ?? "Today" }}':        [moment(), moment()],
                    '{{ $langData["addfunds.Yesterday"]    ?? "Yesterday" }}':    [moment().subtract(1,'days'), moment().subtract(1,'days')],
                    '{{ $langData["addfunds.Last 7 days"]  ?? "Last 7 days" }}':  [moment().subtract(6,'days'), moment()],
                    '{{ $langData["addfunds.Last 30 days"] ?? "Last 30 days" }}': [moment().subtract(29,'days'), moment()],
                    '{{ $langData["addfunds.This month"]   ?? "This month" }}':   [moment().startOf('month'), moment().endOf('month')],
                    '{{ $langData["addfunds.Last month"]   ?? "Last month" }}':   [moment().subtract(1,'month').startOf('month'), moment().subtract(1,'month').endOf('month')]
                }
            });

            $dateInput.on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
                // Filter table
                filterTable($(this).val());
            });

            $dateInput.on('cancel.daterangepicker', function() {
                $(this).val('');
                filterTable('');
            });

            @if(request('start') && request('end'))
            $dateInput.val('{{ request("start") }} - {{ request("end") }}');
            @else
            $dateInput.val(moment().startOf('month').format('YYYY/MM/DD') + ' - ' + moment().endOf('month').format('YYYY/MM/DD'));
            @endif

            // Filter table theo giá trị input
            function filterTable(val) {
                var rows = $('#table-history-fund tbody tr');
                if (!val) { rows.show(); return; }
                var parts = val.split(' - ');
                var start = parts[0] ? moment(parts[0], 'YYYY/MM/DD') : null;
                var end   = parts[1] ? moment(parts[1], 'YYYY/MM/DD') : null;
                rows.each(function() {
                    var dateCell = $(this).find('td:last-child').text().trim() || $(this).find('td:eq(3)').text().trim();
                    var rowDate  = moment(dateCell, 'YYYY-MM-DD HH:mm:ss');
                    var show = (!start || rowDate.isSameOrAfter(start, 'day')) &&
                               (!end   || rowDate.isSameOrBefore(end, 'day'));
                    $(this).toggle(show);
                });
            }

            // Filter ngay khi load nếu có giá trị
            if ($dateInput.val()) filterTable($dateInput.val());
        });
    } else {
        setTimeout(initDatePicker, 100);
    }
})();
</script>
@endpush
