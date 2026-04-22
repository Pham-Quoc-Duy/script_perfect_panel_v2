@extends('clients.theme-default.layouts.app')

@section('title', __('addfunds.title'))

@section('content')

    <div id="block_72">
        <div class="block-bg"></div>
        <div class="container-fluid">
            <div class="refill">

                @if($payment)
                @php
                    $cfg           = $payment->parsed_config;
                    $accountName   = $cfg['account_name']   ?? $cfg['name']    ?? null;
                    $accountNumber = $cfg['account_number'] ?? $cfg['account'] ?? null;
                    $transferCode  = auth()->user()->transfer_code ?? $ref;

                    // Lấy bank code từ config, nếu không có thì parse từ tên (lấy phần cuối sau dấu " - " hoặc "-")
                    $rawBank  = $cfg['bank_code'] ?? $cfg['bank'] ?? $payment->name ?? null;
                    $bankCode = $rawBank ? trim(preg_replace('/^.*[\-–]\s*/', '', $rawBank)) : null;

                    $qrUrl = null;
                    if ($bankCode && $accountNumber) {
                        $qrUrl = "https://img.vietqr.io/image/"
                            . urlencode($bankCode) . "-" . urlencode($accountNumber)
                            . "-qr_only.jpg"
                            . "?amount=" . (int)$amount
                            . ($accountName ? "&accountName=" . urlencode($accountName) : '')
                            . "&addInfo=" . urlencode($transferCode);
                    } elseif ($cfg['qr_image'] ?? null) {
                        $qrUrl = $cfg['qr_image'];
                    } elseif ($payment->image_url) {
                        $qrUrl = $payment->image_url;
                    }
                @endphp

                <div class="row">
                    {{-- Cột trái: thông tin ngân hàng --}}
                    <div class="col-lg-7 mb-4 mb-lg-0">
                        <div class="refill__margin-table">
                            <div class="component_card">
                                <div class="card">
                                    <div class="component_form_group">

                                        <div class="pay-header">
                                            <label class="control-label">{{ __('addfunds.transfer_details') }}</label>
                                            <a href="{{ route('clients.addfunds.index') }}" class="btn btn-big-secondary pay-back-btn">
                                                <i class="fas fa-arrow-left"></i> {{ __('addfunds.go_back') }}
                                            </a>
                                        </div>

                                        <div class="prow">
                                            <span class="prow__label">{{ __('addfunds.bank_name') }}</span>
                                            <span class="prow__value">{{ $payment->name }}</span>
                                        </div>

                                        <div class="prow">
                                            <span class="prow__label">{{ __('addfunds.account_holder') }}</span>
                                            <span class="prow__copy">
                                                <span id="val-name" class="prow__value">{{ $accountName ?? '—' }}</span>
                                                @if($accountName)
                                                <button type="button" class="btn-clip" data-for-clip="val-name"><i class="far fa-copy"></i></button>
                                                @endif
                                            </span>
                                        </div>

                                        <div class="prow">
                                            <span class="prow__label">{{ __('addfunds.account_number') }}</span>
                                            <span class="prow__copy">
                                                <span id="val-acc" class="prow__value">{{ $accountNumber ?? '—' }}</span>
                                                @if($accountNumber)
                                                <button type="button" class="btn-clip" data-for-clip="val-acc"><i class="far fa-copy"></i></button>
                                                @endif
                                            </span>
                                        </div>

                                        <div class="prow">
                                            <span class="prow__label">{{ __('addfunds.amount') }}</span>
                                            <span class="prow__copy">
                                                <span id="val-amt" class="prow__value prow__value--amount">{{ number_format((float)$amount, 0, '.', ',') }} VND</span>
                                                <button type="button" class="btn-clip" data-for-clip="val-amt" data-raw="{{ (int)$amount }}"><i class="far fa-copy"></i></button>
                                            </span>
                                        </div>

                                        <div class="prow prow--ref">
                                            <span class="prow__label">{{ __('addfunds.transfer_content') }}</span>
                                            <span class="prow__copy">
                                                <span id="val-ref" class="prow__value prow__value--ref">{{ $transferCode }}</span>
                                                <button type="button" class="btn-clip" data-for-clip="val-ref"><i class="far fa-copy"></i></button>
                                            </span>
                                        </div>

                                        <div class="pnotice">
                                            <i class="fas fa-exclamation-circle"></i>
                                            <span>{{ __('addfunds.auto_scan_notice') }}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Cột phải: QR code --}}
                    <div class="col-lg-5">
                        <div class="refill__margin-table">
                            <div class="component_card">
                                <div class="card">
                                    <div class="component_form_group pay-qr-body">

                                        <p class="prow__label" style="margin-bottom:12px;">{{ __('addfunds.scan_qr') }}</p>

                                        @if($qrUrl)
                                        <div class="qr-scan-wrap">
                                            <div class="qr-img-box">
                                                <img src="{{ $qrUrl }}" alt="QR" class="qr-img">
                                                <div class="scan-line"></div>
                                                <div class="qr-corner tl"></div>
                                                <div class="qr-corner tr"></div>
                                                <div class="qr-corner bl"></div>
                                                <div class="qr-corner br"></div>
                                            </div>
                                        </div>
                                        <p class="prow__label" style="margin-top:14px;">
                                            <i class="fas fa-mobile-alt" style="margin-right:4px;"></i>{{ __('addfunds.open_banking_app') }}
                                        </p>
                                        @else
                                        <p class="prow__label">{{ __('addfunds.no_qr') }}</p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @else
                <div class="row">
                    <div class="col">
                        <div class="refill__margin-table">
                            <div class="component_card">
                                <div class="card">
                                    <div class="component_form_group">
                                        <p class="nowrap" style="text-align:center;padding:16px 0;">{{ __('addfunds.invalid_payment_data') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>

    <style>
        /* Header row inside card */
        .pay-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:8px; }
        .pay-header .control-label { margin:0; }
        .pay-back-btn { font-size:0.82rem; padding:5px 12px; }

        /* Info rows */
        .prow { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:12px 0; border-bottom:1px solid var(--border-color,rgba(0,0,0,.07)); }
        .prow:last-of-type { border-bottom:none; }
        .prow__label { font-size:0.75rem; text-transform:uppercase; font-weight:700; letter-spacing:.6px; color:var(--text-muted,#9ca3af); flex-shrink:0; min-width:130px; }
        .prow__copy { display:flex; align-items:center; gap:8px; margin-left:auto; }
        .prow__value { font-weight:600; font-size:0.95rem; word-break:break-all; text-align:right; color:var(--text-color,#1f2937); }
        .prow__value--amount { font-size:1.1rem; font-weight:700; color:var(--primary-color,#337ab7); }
        .prow--ref { background:var(--primary-color-light,rgba(51,122,183,.06)); border:1.5px dashed var(--primary-color,#337ab7); border-radius:8px; padding:12px 14px; margin:6px 0 0; }
        .prow--ref .prow__label { color:var(--primary-color,#337ab7); }
        .prow__value--ref { font-family:'Courier New',monospace; font-size:1rem; font-weight:700; letter-spacing:1.5px; color:var(--primary-color,#337ab7); }

        /* Copy button */
        .btn-clip { display:inline-flex; align-items:center; justify-content:center; width:28px; height:28px; background:var(--card-bg,#f8fafc); border:1px solid var(--border-color,#e2e8f0); border-radius:6px; cursor:pointer; color:var(--text-muted,#9ca3af); flex-shrink:0; transition:background .15s,color .15s,transform .15s; font-size:0.78rem; }
        .btn-clip:hover { background:var(--primary-color,#337ab7); color:#fff; border-color:var(--primary-color,#337ab7); transform:scale(1.1); }
        .btn-clip.copied { background:#10b981; color:#fff; border-color:#10b981; }

        /* Notice */
        .pnotice { display:flex; gap:10px; align-items:flex-start; background:rgba(245,158,11,.07); border-left:3px solid #f59e0b; padding:11px 14px; border-radius:0 6px 6px 0; font-size:0.82rem; color:var(--text-color,#374151); line-height:1.55; margin-top:14px; }
        .pnotice i { color:#f59e0b; margin-top:2px; flex-shrink:0; }

        /* QR column */
        .pay-qr-body { display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:340px; text-align:center; }
        .qr-amount-badge { display:inline-flex; align-items:center; gap:6px; background:var(--primary-color-light,rgba(51,122,183,.1)); color:var(--primary-color,#337ab7); border:1px solid var(--primary-color,#337ab7); border-radius:20px; padding:5px 16px; font-weight:700; font-size:0.92rem; margin-bottom:20px; }
        .qr-scan-wrap { display:flex; justify-content:center; }
        .qr-img-box { position:relative; display:inline-block; padding:12px; background:#fff; border-radius:14px; box-shadow:0 4px 20px rgba(0,0,0,.10); overflow:hidden; }
        .qr-img { display:block; width:210px; height:210px; object-fit:contain; border-radius:6px; }

        /* Scan animation */
        .scan-line { position:absolute; left:0; right:0; height:2px; background:linear-gradient(90deg,transparent 0%,#06d6a0 40%,#06d6a0 60%,transparent 100%); box-shadow:0 0 8px 2px rgba(6,214,160,.55); animation:qr-scan 2.4s ease-in-out infinite; z-index:5; }
        @keyframes qr-scan { 0%{top:0;opacity:0} 5%{opacity:1} 95%{opacity:1} 100%{top:calc(100% - 2px);opacity:0} }
        .qr-corner { position:absolute; width:18px; height:18px; border:3px solid #06d6a0; z-index:6; }
        .qr-corner.tl { top:8px;    left:8px;    border-right:none; border-bottom:none; border-radius:4px 0 0 0; }
        .qr-corner.tr { top:8px;    right:8px;   border-left:none;  border-bottom:none; border-radius:0 4px 0 0; }
        .qr-corner.bl { bottom:8px; left:8px;    border-right:none; border-top:none;    border-radius:0 0 0 4px; }
        .qr-corner.br { bottom:8px; right:8px;   border-left:none;  border-top:none;    border-radius:0 0 4px 0; }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('.btn-clip');
            if (!btn) return;
            const target = document.getElementById(btn.dataset.forClip);
            if (!target) return;
            const text = btn.dataset.raw || target.textContent.trim();
            navigator.clipboard.writeText(text).then(() => {
                const icon = btn.querySelector('i');
                const orig = icon.className;
                icon.className = 'fas fa-check';
                btn.classList.add('copied');
                setTimeout(() => { icon.className = orig; btn.classList.remove('copied'); }, 2000);
            });
        });
    });
    </script>
@endsection
