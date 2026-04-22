@extends('clients.theme-default.layouts.app')

@section('title', __('addfunds.title'))

@section('content')

    <div id="block_46">
        <div class="block-bg"></div>
        <div class="container-fluid">
            <div class="add-funds">

                {{-- Payment Form --}}
                <div class="component_card">
                    <div class="card">
                        <form id="main-payment-form" class="component_form_group" onsubmit="return false;">
                            <div class="form-group">
                                <label for="method" class="control-label">{{ __('addfunds.method') }}</label>
                                <select class="form-control"  id="method" name="AddFoundsForm[type]" >
                                    @foreach ($payments ?? [] as $payment)
                                        @php
                                            $bonusText = '';
                                            if ($payment->bonus) {
                                                $bonusArray = is_string($payment->bonus)
                                                    ? json_decode($payment->bonus, true)
                                                    : $payment->bonus;
                                                if (is_array($bonusArray) && count($bonusArray) > 0) {
                                                    $firstBonus = $bonusArray[0] ?? null;
                                                    if (
                                                        $firstBonus &&
                                                        isset($firstBonus['min']) &&
                                                        isset($firstBonus['percent'])
                                                    ) {
                                                        $bonusText =
                                                            ' | ' .
                                                            number_format($firstBonus['min'], 0) .
                                                            ' + ' .
                                                            $firstBonus['percent'] .
                                                            '% Bonus';
                                                    }
                                                }
                                            }
                                        @endphp
                                        <option value="{{ $payment->id }}" data-type="{{ $payment->type }}"
                                            data-payment-name="{{ $payment->name }}"
                                            data-qr-image="{{ $payment->image_url ?? '' }}"
                                            data-binance-id="{{ $payment->binance_id ?? '' }}"
                                            data-image="{{ $payment->image_url ?? '' }}">
                                            {{ $payment->name }}{{ $bonusText }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="amount" class="control-label">
                                    <span id="amount_label">{{ __('addfunds.amount') }}</span>
                                    <span id="amount_label_currency" class="hidden"></span>
                                </label>
                                <input type="number" inputmode="decimal" class="form-control"
                                    name="AddFoundsForm[amount]" id="amount">
                            </div>

                            <div class="component_button_submit">
                                <button type="button" class="btn btn-block btn-big-primary"
                                    id="payButton">{{ __('addfunds.pay') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Transaction History --}}
                <div class="mt-4">
                    <div class="table-bg component_table">
                        <div class="table-wr table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('addfunds.id') }}</th>
                                        <th>{{ __('addfunds.date') }}</th>
                                        <th>{{ __('addfunds.method') }}</th>
                                        <th>{{ __('addfunds.amount') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions ?? [] as $transaction)
                                        @php
                                            $hasBonus     = $transaction->bonus_amount > 0;
                                            $bonusPercent = ($hasBonus && $transaction->amount > 0)
                                                ? round(($transaction->bonus_amount / $transaction->amount) * 100, 1)
                                                : 0;
                                        @endphp
                                        <tr>
                                            <td data-label="{{ __('addfunds.id') }}">
                                                {{ $transaction->id }}
                                            </td>
                                            <td data-label="{{ __('addfunds.date') }}">
                                                <span class="nowrap">{{ $transaction->created_at->format('Y-m-d') }}</span>
                                                <span class="nowrap">{{ $transaction->created_at->format('H:i:s') }}</span>
                                            </td>
                                            <td data-label="{{ __('addfunds.method') }}">
                                                <span class="nowrap">{{ $transaction->paymentMethod->name ?? 'N/A' }}</span>
                                                @if ($hasBonus)
                                                    <span class="tx-bonus-badge">+{{ $bonusPercent }}% bonus</span>
                                                @endif
                                            </td>
                                            <td data-label="{{ __('addfunds.amount') }}">
                                                <span class="nowrap">{{ number_format($transaction->amount, 2) }} {{ $transaction->currency }}</span>
                                                @if ($hasBonus)
                                                    <span class="nowrap tx-bonus-amount">
                                                        +{{ number_format($transaction->bonus_amount, 2) }} {{ $transaction->currency }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                <p class="nowrap">{{ __('addfunds.no_transactions') }}</p>
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
    </div>


    <!-- Binance Payment Modal -->
    <div class="modal binance-modal fade" tabindex="-1" role="dialog" id="binance-qr-modal" data-backdrop="static">
        <div class="modal-dialog binance-modal-dialog binance-modal-dialog-scrollable">
            <form class="binance-modal-content" id="binance-form">
                <div class="binance-modal-header">
                    <h4 class="binance-modal-title">Binance internal transfer</h4>
                    <button type="button" class="binance-btn-close" data-dismiss="modal">×</button>
                </div>

                <div class="binance-modal-body">
                    <div class="binance-alert binance-alert-danger hidden"><span class="content"></span></div>
                    <div class="binance-alert binance-alert-success hidden"><span class="content"></span></div>

                    <div id="binance-qr-modal-spinner" class="text-center hidden">
                        <div class="spinner-block__wrapper spinner-block__container" style="height: 100px;">
                            <span class="fa fa-spinner fa-spin fa-3x" style="color:#337AB7"></span>
                        </div>
                    </div>

                    <div id="binance-main">
                        <div class="binance-steps" id="binance-steps">
                            <div class="binance-step start">
                                <div class="binance-step-line before"></div>
                                <div class="binance-step-wrap">
                                    <span id="step-1" class="binance-step-num active">1</span>
                                    <div class="binance-step-label">Make payment</div>
                                </div>
                                <div class="step-line after"></div>
                            </div>
                            <div class="binance-step end">
                                <div class="binance-step-line before"></div>
                                <div class="binance-step-wrap">
                                    <span id="step-2" class="binance-step-num">2</span>
                                    <div class="binance-step-label">Verify payment</div>
                                </div>
                                <div class="binance-step-line after"></div>
                            </div>
                        </div>

                        <!-- Step 1 -->
                        <div id="binance-top-step1">
                            <div class="binance-amount">
                                <span class="binance-amount-value"><strong>1</strong></span>
                                <span class="binance-currency-value">USDT</span>
                            </div>
                            <div class="binance-uuid">
                                <div class="binance-form-group">
                                    <label>Send to Binance ID</label>
                                    <div class="binance-input-group">
                                        <input id="binance-uuid-input" readonly class="binance-form-control"
                                            value="">
                                        <div class="binance-input-group-btn">
                                            <button class="binance-btn binance-btn-default" type="button"
                                                data-for-clip="binance-uuid-input">
                                                <span class="fa fa-copy"></span> Copy
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="binance-pay-instruction text-center">
                                <img id="binance-qr-code-image" src="" class="img-fluid m-auto"
                                    style="max-width: 140px;">
                                <div class="binance-pay-instruction-text mt-3">
                                    <p>1. Scan the QR using the Binance app or send funds using the Binance ID.</p>
                                    <p>2. After completing the payment tap "Confirm payment".</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div id="binance-top-step2" class="hidden">
                            <div class="binance-amount-uuid">
                                <div class="amount-currency">
                                    <div class="amount-label">Amount</div>
                                    <div class="amount-block">
                                        <span class="binance-amount-value">1</span>
                                        <span class="binance-currency-value">USDT</span>
                                    </div>
                                </div>
                                <div class="uuid">
                                    <div class="uuid-label">Send to Binance ID</div>
                                    <div class="uuid-block">
                                        <span class="binance-uuid-value" id="binance-uuid-value">228223025</span>
                                        <button id="copy-uuid-2" class="binance-uuid-value-copy" type="button"
                                            data-for-clip="binance-uuid-value">
                                            <span class="far fa-copy"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="binance-order-id">
                                <div class="binance-form-group">
                                    <label class="control-label" for="binance-order-id">Enter your Binance Order
                                        ID</label>
                                    <input id="binance-order-id" class="binance-form-control" placeholder="Order ID">
                                </div>
                            </div>
                            <div class="binance-verify-instruction text-center">
                                <div class="binance-verify-instruction-text mt-3">
                                    <p>1. Copy the Order ID from the successful payment details in your Binance account.</p>
                                    <p>2. Paste it into the field above and tap "Verify payment".</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="binance-modal-footer">
                    <button id="binance-primary-btn" type="button"
                        class="binance-btn binance-btn-primary binance-btn-block">
                        Confirm payment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        @keyframes spinner {
            to {
                transform: rotate(360deg)
            }
        }

        .hidden {
            display: none !important;
        }

        .spinner-block__container {
            display: block;
            width: 100%;
            height: 558px;
        }

        .spinner-block__wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .spinner-block__wrapper span {
            animation: spinner .6s linear infinite;
        }

        .modal-backdrop {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1040;
            background-color: #000;
        }

        .modal-backdrop.in {
            opacity: .5;
        }

        .modal-backdrop.fade {
            opacity: 0;
        }

        .modal-backdrop.show {
            opacity: 0.5;
        }

        .binance-modal.modal {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
            font-size: 14px !important;
            line-height: 1.42857143 !important;
            color: #333 !important;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1050;
            display: none;
            overflow: hidden;
            -webkit-overflow-scrolling: touch;
            outline: 0;
        }

        .modal-open .binance-modal.modal {
            overflow-x: hidden;
            overflow-y: auto;
        }

        .binance-modal .binance-modal-dialog-scrollable {
            display: flex;
            max-height: calc(100% - 1rem) !important;
            height: auto !important;
        }

        .binance-modal .binance-alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .binance-modal .binance-alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }

        .binance-modal .binance-alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .binance-modal .binance-modal-dialog-scrollable .binance-modal-content {
            background-color: #fff !important;
            max-height: calc(100vh - 1rem);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            width: 100%;
            border: none !important;
            border-radius: 6px;
            outline: 0;
            position: relative;
            background-clip: padding-box;
            pointer-events: auto;
        }

        .binance-modal .binance-modal-dialog-scrollable .binance-modal-body {
            background-color: #fff !important;
            overflow-y: auto;
            position: relative;
            padding: 15px;
        }

        .binance-modal .binance-modal-dialog-scrollable .binance-modal-header {
            padding: 15px;
            border-bottom: 1px solid #E6E6E6;
        }

        .binance-modal .binance-modal-dialog-scrollable .binance-modal-header .binance-btn-close {
            float: right;
            font-size: 21px;
            font-weight: bold;
            line-height: 1;
            color: #000;
            opacity: .2;
            appearance: none;
            padding: 0;
            cursor: pointer;
            background: transparent;
            border: 0;
            margin-top: -2px;
        }

        .binance-modal .binance-modal-dialog-scrollable .binance-modal-footer {
            padding: 15px;
            text-align: right;
            border-top: 1px solid #E6E6E6;
        }

        .binance-modal .binance-modal-dialog-scrollable .binance-modal-footer,
        .binance-modal .binance-modal-dialog-scrollable .binance-modal-header {
            background-color: #fff !important;
            flex-shrink: 0;
        }

        .binance-modal .binance-modal-title {
            float: left;
            margin: 0;
        }

        .binance-modal .binance-steps {
            display: flex;
            align-items: center;
            margin-top: 32px;
        }

        .binance-modal .binance-step {
            flex: 1 0 auto;
            text-align: center;
            position: relative;
            display: flex;
        }

        .binance-modal .binance-step-wrap {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            margin-top: -12px;
        }

        .binance-modal .binance-step .binance-step-line {
            flex: 1;
            height: 1px;
        }

        .binance-modal .binance-step.start .binance-step-line.before {
            background: linear-gradient(to right, white, #337AB7) !important;
        }

        .binance-modal .binance-step.start .binance-step-line.after {
            flex: 0.2;
            background: #337AB7 !important;
        }

        .binance-modal .binance-step.end .binance-step-line.after {
            background: linear-gradient(to left, white, #337AB7) !important;
        }

        .binance-modal .binance-step.end .binance-step-line.before {
            flex: 0.2;
            background: #337AB7 !important;
        }

        .binance-modal .binance-step-num {
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #ADADAD !important;
            color: #fff;
            position: relative;
        }

        .binance-modal .binance-step-wrap::after,
        .binance-modal .binance-step-wrap::before {
            content: "";
            position: absolute;
            top: 12px;
            height: 1px;
            background: #337AB7 !important;
        }

        .binance-modal .binance-step-wrap::before {
            left: 0;
            width: 35%;
        }

        .binance-modal .binance-step-wrap::after {
            right: 0;
            width: 35%;
        }

        .binance-modal .binance-step-num.active {
            background-color: #337AB7 !important;
        }

        .binance-modal .binance-step-label {
            margin-top: 4px;
            white-space: nowrap;
        }

        .binance-amount {
            padding: 24px;
            text-align: center;
        }

        .binance-amount-value {
            font-weight: 700;
            font-size: 32px;
        }

        .binance-currency-value {
            font-weight: 500;
            font-size: 24px;
        }

        .binance-pay-instruction,
        .binance-verify-instruction {
            background-color: #F2F2F2;
            padding: 24px 16px;
            border-radius: 4px;
        }

        .binance-pay-instruction img {
            width: 140px;
            height: 140px;
            object-fit: contain;
        }

        .binance-pay-instruction-text,
        .binance-verify-instruction-text {
            margin-top: 24px;
        }

        .binance-pay-instruction-text p:last-child,
        .binance-verify-instruction p:last-child {
            margin-bottom: 0;
        }

        .binance-amount-uuid {
            margin-top: 24px;
            margin-bottom: 16px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            background-color: #F2F2F2;
            border-radius: 4px;
        }

        .binance-amount-uuid .amount-currency,
        .binance-amount-uuid .uuid {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .binance-amount-uuid .amount-currency .amount-label,
        .binance-amount-uuid .uuid .uuid-label {
            font-size: 10px !important;
            color: #767676 !important;
            margin-bottom: 4px;
        }

        .binance-amount-uuid .amount-currency .amount-block .binance-amount-value,
        .binance-amount-uuid .amount-currency .amount-block .binance-currency-value {
            font-size: 14px !important;
            word-break: break-all;
            font-weight: 400 !important;
        }

        .binance-amount-uuid .uuid .uuid-block {
            font-size: 14px !important;
        }

        .binance-amount-uuid .uuid .binance-uuid-value-copy {
            display: inline-block;
            margin-left: 6px;
            padding: 0;
            outline: none;
            border: none;
            box-shadow: none;
            color: #337AB7;
        }

        .binance-modal .binance-btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            touch-action: manipulation;
            cursor: pointer;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .binance-modal .binance-btn.disabled {
            pointer-events: none;
            box-shadow: none;
            opacity: 0.65;
        }

        .binance-modal .binance-btn-block {
            display: block;
            width: 100%;
        }

        .binance-modal .binance-btn-primary {
            color: #fff;
            background-color: #337ab7;
            border-color: #2e6da4;
        }

        .binance-modal .binance-btn-primary:hover {
            background-color: #286090;
            border-color: #204d74;
        }

        .binance-modal .binance-btn-default {
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }

        .binance-modal .binance-btn-default:hover {
            color: #333;
            border-color: #8c8c8c;
        }

        .binance-modal .binance-input-group>.binance-input-group-btn {
            padding: 0 !important;
            width: 1%;
            white-space: nowrap;
            vertical-align: middle;
            position: relative;
            font-size: 0;
            display: table-cell;
        }

        .binance-modal .binance-input-group-btn:last-child>.binance-btn {
            z-index: 2;
            margin-left: -1px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .binance-modal .binance-form-group {
            margin-bottom: 15px;
        }

        .binance-modal .binance-form-group .binance-input-group {
            position: relative;
            display: table;
            border-collapse: separate;
        }

        .binance-modal label {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .binance-modal .binance-form-control {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }

        .binance-modal .binance-form-control:focus {
            border-color: #66afe9;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
        }

        .binance-modal .binance-form-control:read-only {
            background-color: #eee;
            opacity: 1;
        }

        .binance-modal .binance-input-group .binance-form-control {
            position: relative;
            z-index: 2;
            float: left;
            width: 100%;
            margin-bottom: 0;
            display: table-cell;
        }

        .binance-input-group .binance-form-control:first-child {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        @media (min-width: 768px) {
            .binance-modal .modal-dialog {
                width: 460px;
                margin: 30px auto;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const methodSelect = document.getElementById('method');
            const amountInput = document.getElementById('amount');
            const binanceModal = $('#binance-qr-modal');
            const binancePrimaryBtn = document.getElementById('binance-primary-btn');

            let currentBinanceStep = 1;

            document.addEventListener('click', function(e) {
                const btn = e.target.closest('#payButton, .payment-action-btn');
                if (!btn) return;

                let amount, type, data = {};

                if (btn.id === 'payButton') {
                    amount = parseFloat(amountInput.value);
                    if (isNaN(amount) || amount <= 0) return alert('Vui lòng nhập số tiền hợp lệ');
                    const opt = methodSelect.selectedOptions[0];
                    type = opt.dataset.type;
                    data = {
                        binance_id: opt.dataset.binanceId || '228223025',
                        qr_image: opt.dataset.qrImage || opt.dataset.image
                    };
                } else {
                    amount = btn.dataset.amount;
                    type = btn.dataset.paymentType;
                    data = JSON.parse(btn.dataset.paymentData || '{}');
                }

                if (type === 'bank_vn' || type === 'bank') {
                    const randomNum = Math.floor(100000 + Math.random() * 900000);
                    window.location.href = `/addfunds/${randomNum}?amount=${amount}`;
                    return;
                }

                if (type === 'binance') {
                    currentBinanceStep = 1;
                    document.querySelectorAll('.binance-amount-value').forEach(el => el.textContent =
                        amount);
                    document.getElementById('binance-uuid-input').value = data.binance_id;
                    document.getElementById('binance-uuid-value').textContent = data.binance_id;
                    document.getElementById('binance-qr-code-image').src = data.qr_image;
                    $('#binance-top-step1').removeClass('hidden');
                    $('#binance-top-step2').addClass('hidden');
                    $('#step-1').addClass('active');
                    $('#step-2').removeClass('active');
                    binancePrimaryBtn.textContent = 'Confirm payment';
                    binanceModal.modal('show');
                }
            });

            binancePrimaryBtn.addEventListener('click', function() {
                if (currentBinanceStep === 1) {
                    currentBinanceStep = 2;
                    $('#binance-top-step1').addClass('hidden');
                    $('#binance-top-step2').removeClass('hidden');
                    $('#step-1').removeClass('active');
                    $('#step-2').addClass('active');
                    this.textContent = 'Verify payment';
                } else {
                    const orderId = document.getElementById('binance-order-id').value.trim();
                    if (!orderId) return alert('Vui lòng nhập Order ID');
                    this.disabled = true;
                    $('#binance-qr-modal-spinner').removeClass('hidden');
                    fetch(
                            `/cron/binance/transactions?orderId=${orderId}&amount=${document.querySelector('.binance-amount-value').textContent}`)
                        .then(res => res.json())
                        .then(res => {
                            this.disabled = false;
                            $('#binance-qr-modal-spinner').addClass('hidden');
                            if (res.success) {
                                alert('Xác minh thành công!');
                                location.reload();
                            } else {
                                alert(res.message || 'Không tìm thấy giao dịch.');
                            }
                        }).catch(() => {
                            this.disabled = false;
                            $('#binance-qr-modal-spinner').addClass('hidden');
                        });
                }
            });

            document.addEventListener('click', function(e) {
                const btn = e.target.closest('[data-for-clip]');
                if (btn) {
                    const target = document.getElementById(btn.dataset.forClip);
                    const val = target.value || target.textContent;
                    navigator.clipboard.writeText(val);
                    const oldText = btn.innerText;
                    btn.innerText = 'Copied!';
                    setTimeout(() => btn.innerText = oldText, 2000);
                }
            });
        });
    </script>

    <style>
        /* Transaction history bonus */
        .tx-bonus-badge {
            display: inline-block;
            margin-left: 6px;
            font-size: .72em;
            font-weight: 600;
            color: #28a745;
            background: rgba(40, 167, 69, .1);
            padding: 1px 7px;
            border-radius: 20px;
            white-space: nowrap;
            vertical-align: middle;
        }

        .tx-bonus-amount {
            display: block;
            font-size: .82em;
            color: #28a745;
            font-weight: 600;
            margin-top: 2px;
        }

        /* Bonus tiers panel */
        #bonus-panel {
            margin-bottom: 16px;
            padding: 10px 14px;
            border-radius: 8px;
            background: rgba(40, 167, 69, .05);
            border: 1px solid rgba(40, 167, 69, .2);
        }

        #bonus-panel .bp-title {
            font-size: .82em;
            font-weight: 600;
            color: #28a745;
            margin-bottom: 8px;
        }

        #bonus-tiers {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .bonus-tier {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 5px 12px;
            border-radius: 6px;
            background: rgba(40, 167, 69, .1);
            border: 1px solid rgba(40, 167, 69, .2);
            font-size: .78em;
            line-height: 1.5;
        }

        .bonus-tier__percent { font-weight: 700; color: #28a745; font-size: 1.05em; }
        .bonus-tier__min { color: #666; white-space: nowrap; }
    </style>

    <script>
        (function () {
            const sel    = document.getElementById('method');
            const panel  = document.getElementById('bonus-panel');
            const tiers  = document.getElementById('bonus-tiers');
            if (!sel || !panel || !tiers) return;

            function render(opt) {
                let data = [];
                try { data = JSON.parse(opt?.dataset?.bonus || '[]'); } catch (e) {}
                data = data.filter(t => t && t.percent > 0);
                if (!data.length) { panel.style.display = 'none'; return; }
                const cur = opt?.dataset?.currency || '';
                tiers.innerHTML = data.map(t =>
                    `<div class="bonus-tier">
                        <span class="bonus-tier__percent">+${t.percent}%</span>
                        <span class="bonus-tier__min">≥ ${Number(t.min).toLocaleString()} ${cur}</span>
                    </div>`
                ).join('');
                panel.style.display = 'block';
            }

            render(sel.selectedOptions[0]);
            sel.addEventListener('change', () => render(sel.selectedOptions[0]));
        })();
    </script>
@endsection
