@extends('adminpanel.layouts.app')
@section('title', 'Payment methods')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        <div class="div-form mb-5" style="display: none;">
            <div class="d-flex flex-wrap flex-stack mb-6">
                <h3 class="fw-bold my-2 div-title" data-lang="Add Payment Method">Add Payment Method</h3>
                <div class="d-flex flex-wrap my-2">
                    <button class="btn btn-warning btn-sm btn-verify btn-verify-3" data-bs-toggle="modal"
                        data-bs-target="#modal-verify-perfectmoney" style="display: none;" data-lang="How to verify?">Hướng
                        dẫn xác thực</button>
                    <button class="btn btn-warning btn-sm btn-verify btn-verify-4" data-bs-toggle="modal"
                        data-bs-target="#modal-verify-payeer" style="display: none;" data-lang="How to verify?">Hướng dẫn
                        xác thực</button>
                    <button class="btn btn-warning btn-sm btn-verify btn-verify-14" data-bs-toggle="modal"
                        data-bs-target="#modal-verify-cryptomus" style="display: none;" data-lang="How to verify?">Hướng dẫn
                        xác thực</button>
                    <button class="btn btn-warning btn-sm btn-verify btn-verify-27" data-bs-toggle="modal"
                        data-bs-target="#modal-config-xendit" style="display: none;" data-lang="How to config?">Hướng dẫn
                        cấu hình</button>
                    <button class="btn btn-warning btn-sm btn-verify btn-verify-28" data-bs-toggle="modal"
                        data-bs-target="#modal-config-xendit" style="display: none;" data-lang="How to config?">Hướng dẫn
                        cấu hình</button>
                    <button class="btn btn-warning btn-sm btn-verify btn-verify-32" data-bs-toggle="modal"
                        data-bs-target="#modal-config-bhratpe" style="display: none;" data-lang="How to config?">Hướng dẫn
                        cấu hình</button>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row g-5 mb-5">
                        <div class="col-lg-4">
                            <label class="required form-label" data-lang="Method">Phương thức</label>
                             <select class="form-select form-select-solid sl-pma" id="sl-pma-add" data-kt-select2="false"
                                data-allow-clear="false" data-hide-search="false" tabindex="-1" aria-hidden="true"
                                onchange="handleMethodChange(this.value)">
                                <option value="0" data-icon="">MANUAL</option>
                                <option value="1" data-icon="https://i.imgur.com/P7EFing.png" data-currency="VND">SIEUTHICODE - ACB (VND)</option>
                                <option value="2" data-icon="https://i.imgur.com/Fz183j7.png" data-currency="VND">SIEUTHICODE - VCB (VND)</option>
                                 <option value="3" data-icon="https://i.imgur.com/zVEduxd.png" data-currency="VND">SIEUTHICODE - MBBANK (VND)</option>
                                 <option value="4" data-icon="https://inkythuatso.com/uploads/thumbnails/800/2021/09/logo-techcombank-inkythuatso-10-15-17-50.jpg" data-currency="VND">SIEUTHICODE - TCB (VND)</option>
                                 <option value="5" data-icon="https://i.imgur.com/P7EFing.png" data-currency="VND">SIEUTHICODE - VTB (VND)</option>
                                <option value="6" data-icon="https://i.imgur.com/znVQVCm.png" data-currency="VND">SIEUTHICODE - BIDV (VND)</option>
                                <option value="7" data-icon="https://i.imgur.com/P7EFing.png" data-currency="VND">SIEUTHICODE - MSB (VND)</option>
                                <option value="8" data-icon="https://i.imgur.com/P7EFing.png" data-currency="VND">SIEUTHICODE - VPB (VND)</option>
                                <option value="9" data-icon="https://i.imgur.com/P7EFing.png" data-currency="VND">SIEUTHICODE - VAB (VND)</option>
                                <option value="10" data-icon="https://i.imgur.com/P7EFing.png" data-currency="VND">SIEUTHICODE - SEABANK (VND)</option>
                                <option value="11" data-icon="https://i.imgur.com/P7EFing.png" data-currency="VND">SIEUTHICODE - VIETTEL MONEY (VND)</option>
                                <option value="13" data-icon="https://i.imgur.com/P7EFing.png" data-currency="VND">SIEUTHICODE - TIMO (VND)</option>
                                <option value="14" data-icon="https://i.imgur.com/P7EFing.png" data-currency="VND">WEB2M - MOMO (VND)</option>
                                <option value="20" data-icon="https://i.imgur.com/iBEGgng.png" data-currency="USD">FPayAZ - Binance - USDT (USD)</option>
                            </select>
                        </div>
                        <div class="col-lg-8">
                            <label class="required form-label" data-lang="Name">Tên</label>
                            <input type="text" class="form-control form-control-solid ipt-pm-method-name">
                        </div>
                    </div>
                    <input type="hidden" class="ipt-pm-type" value="other">
                    <div class="mb-5">
                        <label class="form-label" data-lang="Icon">Biểu tượng</label>
                        <div class="input-group input-group-solid">
                            <span class="input-group-text icon-image"
                                style="min-width: 45px; justify-content: center;"></span>
                            <input type="text" class="form-control ipt-pm-icon"
                                placeholder="https://example.com/image.png hoặc fa-icon-name"
                                onkeyup="updateIconPreview(this.value)">
                        </div>
                    </div>
                    <div class="">
                        <!-- My 1DG -->

                        <!-- Sieuthicode Webhook -->
                        <div class="div-options div-23 div-24 div-25 div-38" style="display: none;">
                            <div class="alert alert-warning">Đăng kí sieuthicode tại <a target="_blank" href="http://api.sieuthicode.net/">đây</a></div>
                            <div class="mb-5">
                                <label class="required form-label">Số tài khoản</label>
                                <input type="text" class="form-control form-control-solid ipt-sieuthicode-webhook-account" placeholder="1028xxxxxx">
                            </div>
                            <div class="mb-5">
                                <label class="required form-label">Tên tài khoản</label>
                                <input type="text" class="form-control form-control-solid ipt-sieuthicode-webhook-name" placeholder="NGUYEN VAN A">
                            </div>
                            <div class="mb-5">
                                <label class="required form-label">Signature</label>
                                <input type="text" class="form-control form-control-solid ipt-sieuthicode-webhook-signature" placeholder="xxxxx">
                            </div>
                            <div class="mb-5">
                                <label class="required form-label">Tỉ giá chuyển đổi</label>
                                <input type="text" class="form-control form-control-solid ipt-sieuthicode-webhook-rate" value="">
                                <span class="text-muted">Tỉ giá chuyển đổi từ VNĐ sang USD</span>
                            </div>
                            <div class="mb-5">
                                <label class="form-label">Webhook</label>
                                <div class="input-group input-group-solid border border-primary">
                                    <input type="text" class="form-control fst-italic ipt-webhook ipt-sieuthicode-webhook"
                                        readonly="" placeholder="Link webhook sẽ được hiển thị sau khi tạo phương thức">
                                    <button type="button" class="btn btn-primary"
                                        onclick="copyWebhookUrl('.ipt-sieuthicode-webhook')">Copy</button>
                                </div>
                            </div>
                        </div>


                        <!-- FPayAz -->
                        <div class="div-options div-33" style="display: none;">
                            <div class="alert alert-warning">Sign up and get key and secret key at <a target="_blank" href="https://fpayaz.com/">here</a></div>
                            <div class="mb-5">
                                <label class="required form-label">Binance ID</label>
                                <input type="text" class="form-control form-control-solid ipt-fpayaz-binance-id" placeholder="">
                            </div>
                            <div class="mb-5">
                                <label class="required form-label">Key</label>
                                <input type="text" class="form-control form-control-solid ipt-fpayaz-key" placeholder="">
                            </div>
                            <div class="mb-5">
                                <label class="required form-label">Secret key</label>
                                <input type="text" class="form-control form-control-solid ipt-fpayaz-secret" placeholder="">
                            </div>
                            <div class="mb-5">
                                <label class="form-label">Hình ảnh QR / Ảnh thanh toán</label>
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text">
                                        <span id="qr-image-preview" style="display:none;">
                                            <img id="qr-image-thumb" src="" alt="" style="width:32px;height:32px;object-fit:contain;border-radius:4px;">
                                        </span>
                                        <i class="fas fa-qrcode" id="qr-image-icon" style="font-size:18px;"></i>
                                    </span>
                                    <input type="text" class="form-control ipt-pm-qr-image"
                                        placeholder="https://example.com/qr.png"
                                        onkeyup="updateQrImagePreview(this.value)">
                                </div>
                                <span class="text-muted fs-7">URL ảnh QR hiển thị cho khách hàng khi thanh toán.</span>
                            </div>

                            <div class="mb-5">
                                <label class="form-label">Webhook</label>
                                <div class="input-group input-group-solid border border-primary">
                                    <input type="text" class="form-control fst-italic ipt-webhook ipt-fpayaz-webhook"
                                        readonly="" placeholder="Link webhook sẽ được hiển thị sau khi tạo phương thức">
                                    <button type="button" class="btn btn-primary"
                                        onclick="copyWebhookUrl('.ipt-fpayaz-webhook')">Copy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- MinMax -->
                    <div class="mb-5">
                        <label class="required form-label"><span data-lang="Set min/max">Thiết lập giới hạn số lượng
                                nạp</span> (<span class="minmax-currency fw-bold">USD</span>)</label>
                        <div class="input-group input-group-solid">
                            <span class="input-group-text" data-lang="">Tối thiểu</span>
                            <input type="number" class="form-control ipt-pm-min" value="0" min="0" step="1">
                            <span class="input-group-text" data-lang="">Tối đa</span>
                            <input type="number" class="form-control ipt-pm-max" value="0" min="0" step="1">
                        </div>
                        <span class="text-muted fst-italic" data-lang="minmax-note">* Điền 0 cho không giới hạn.</span>
                    </div>
                    <!-- MinMax Transactions -->
                    <div class="mb-5">
                        <div class="row g-5">
                            <div class="col-sm-6">
                                <label class="required form-label" data-lang="">Số giao dịch tối đa trong 1 ngày</label>
                                <input type="number" class="form-control form-control-solid ipt-pm-max-transactions"
                                    value="0" min="0" step="1">
                            </div>
                            <div class="col-sm-6">
                                <label class="required form-label" data-lang="">Tổng số tiền nhận được tối đa trong 1
                                    ngày</label>
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control ipt-pm-max-total-funds"
                                        value="0" min="0" step="1">
                                </div>
                            </div>
                            <span class="text-muted fst-italic" data-lang="maximum-note">* Điền 0 cho không giới hạn. Khi
                                đạt tới giới hạn tối đa, phương thức sẽ ẩn cho tới khi reset vào lúc 00:00 UTC Time.</span>
                        </div>
                    </div>
                    <!-- Bonus -->
                    <div class="mb-5">
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <input class="form-check-input cb-pm-bonus" type="checkbox" onchange="bonus(this.checked)">
                            <label class="form-check-label" data-lang="Bonus">Thưởng</label>
                        </div>
                    </div>
                    <div class="mb-5 div-bonus" style="display: none;">
                        <div class="div-bonus-data">
                            <div class="mb-5 bonus-item" id="bonus-default">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-secondary">Nếu nạp số lượng >=</span>
                                    <input type="number" class="form-control ipt-pm-quantity-bonus text-end" value="" step="0.0001">
                                    <span class="input-group-text bg-secondary">$</span>
                                    <span class="input-group-text">sẽ thưởng thêm</span>
                                    <input type="number" class="form-control ipt-pm-percent-bonus text-end" value="" min="0" step="0.0001">
                                    <span class="input-group-text bg-secondary">%</span>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="addBonusData()"
                            data-lang="Add condition">Thêm điều kiện</button>
                    </div>
                    <div class="mb-5">
                        <label class="required form-label" data-lang="Details">Chi tiết</label>
                        <div id="editor-payment-method-details" class="h-250px"></div>
                        <input type="hidden" id="payment-method-details-content" class="ipt-pm-method-details"
                            value="">
                    </div>


                </div>
                <!--end::Body-->
            </div>
            <button type="button" class="btn btn-primary btn-new w-100" onclick="add(0)"
                data-lang="button::Add">Thêm</button>
            <button type="button" class="btn btn-primary btn-update w-100" style="display: none;" onclick="update(0)"
                data-lang="button::Update">Cập nhật</button>
        </div>

        <!-- Form Group for ACB Payment Method -->
        <div class="div-form-group mb-6" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <div class="row g-6 mb-5">
                        <div class="col-md-3">
                            <label class="required form-label" data-lang="">Tên</label>
                            <input type="text" class="form-control form-control-solid ipt-group-name">
                        </div>
                        <div class="col-md-9">
                            <label class="required form-label" data-lang="">Chọn các phương thức</label>
                            <select class="form-select form-select-solid sl-pm select2-hidden-accessible" multiple=""
                                data-select2-id="select2-data-4-qo0s" tabindex="-1" aria-hidden="true">
                                <option value="3" data-icon="https://i.imgur.com/P7EFing.png">Ngân Hàng ACB -
                                    [Cộngtiền nhanh]</option>
                                <option value="11"
                                    data-icon="https://cdn.freebiesupply.com/logos/large/2x/binance-coin-logo-png-transparent.png">
                                    Binance Auto Payment ( USDT )</option>
                                <option value="8" data-icon="https://i.imgur.com/NzboTNN.png">Payeer (USD)</option>
                                <option value="5" data-icon="https://i.imgur.com/FYVOL1x.png">Cryptomus - USDT
                                </option>
                                <option value="15" data-icon="aaaaa">ac</option>
                                <option value="12" data-icon="https://i.imgur.com/mlK7ns8.png">PayPal Auto</option>
                                <option value="9" data-icon="https://i.imgur.com/P7EFing.png">MBBANK ( Dự
                                    phòng[Cộng tiền chậm] )</option>
                                <option value="2" data-icon="https://i.imgur.com/ja20O58.png">Perfect Money (USD)
                                </option>
                                <option value="6"
                                    data-icon="https://pbs.twimg.com/profile_images/565310907824103424/N92VUZNJ_400x400.png">
                                    Xendit (Indonesia) (IDR)</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-new-group w-100" onclick="addGroup(0)"
                        data-lang="button::Add">Thêm</button>
                    <button type="button" class="btn btn-primary btn-update-group w-100" style="display: none;"
                        data-lang="button::Update">Cập nhật</button>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack">
            <h3 class="fw-bold my-2" data-lang="">Danh sách</h3>
            <div class="d-flex flex-wrap my-2">
                <button class="btn btn-primary btn-sm" onclick="showFormAdd()" data-lang="Add Payment Method">Add Payment Method</button>
            </div>
        </div>

        <div class="pt-5 pb-3 text-muted text-end show-all-methods"
            onclick="showAll(this)">
            <span class="fst-italic pointer" data-lang="Show/Hide inactive methods">Show/Hide inactive methods</span>
            <i class="bi bi-arrows-expand fs-4 ms-2" id="toggle-icon"></i>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-row-dashed fs-7 gy-1 gs-5 mb-0"
                        id="table-payment-methods">
                        <thead>
                            <tr class="text-start bg-secondary text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th></th>
                                <th>ID</th>
                                <th data-lang="Method">Phương thức</th>
                                <th data-lang="Name">Tên</th>
                                <th data-lang="Currency">Tiền tệ</th>
                                <th></th>
                                <th data-lang="Status">Trạng thái</th>
                                <th witdh="1"></th>
                            </tr>
                        </thead>
                        <tbody class="ui-sortable" id="sortablePaymentMethods">
                            @forelse($paymentMethods as $method)
                                <tr class="row-{{ $method->id }} status-{{ $method->status ? 0 : 1}} {{ $method->status != 1 ? 'text-muted' : '' }}"
                                    data-id="{{ $method->id }}">
                                    <td width="1"><i class="fas fa-bars ui-sortable-handle"></i></td>
                                    <td>{{ $method->id }}</td>
                                    <td class="text-nowrap">
                                        @if ($method->image)
                                            @if (filter_var($method->image, FILTER_VALIDATE_URL))
                                                <img src="{{ $method->image }}" class="w-20px me-2"
                                                    alt="{{ $method->name }}">
                                            @else
                                                <img src="{{ asset('storage/payment-methods/' . $method->image) }}"
                                                    class="w-20px me-2" alt="{{ $method->name }}">
                                            @endif
                                        @endif
                                        {{ $method->name }}
                                    </td>
                                    <td>
                                        <span class="fw-semibold">
                                            {{ $method->name }}
                                            @if ($method->bonus)
                                                <i class="fa-solid fa-percent text-warning ms-2" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" aria-hidden="true" aria-label="Bonus"
                                                    data-bs-original-title="Bonus" data-kt-initialized="1"></i>
                                            @endif
                                        </span>
                                        @if ($method->config_name || $method->account)
                                            <p class="fs-8 mb-0">
                                                @if ($method->config_name && $method->account)
                                                    {{ $method->config_name }} - {{ $method->account }}
                                                @elseif($method->config_name)
                                                    {{ $method->config_name }}
                                                @else
                                                    {{ $method->account }}
                                                @endif
                                            </p>
                                        @endif
                                    </td>
                                    <td class="text-nowrap">
                                        {{ $method->currency }}
                                        @if ($method->min || $method->max)
                                            <p class="fs-8 mb-0">{{ (int)$method->min ?: '0' }} -
                                                {{ $method->max > 0 ? (int)$method->max : '∞' }}</p>
                                        @endif
                                    </td>
                                    <td></td>
                                    <td>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input h-20px w-30px" type="checkbox"
                                                value="{{ $method->id }}" {{ $method->status ? 'checked' : '' }}
                                                onchange="status(this.value, this.checked)">
                                        </div>
                                    </td>
                                    <td width="1" class="text-end">
                                        <a href="javascript:;"
                                            class="btn btn-icon btn-light-secondary btn-circle btn-sm w-25px h-25px"
                                            onclick="showFormEdit({{ $method->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil w-10px h-10px"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z">
                                                </path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-5">
                                        <p data-lang="">Chưa có phương thức thanh toán nào</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack my-6">
            <h3 class="fw-bold my-2"><span data-lang="">Nhóm</span> <span class="fs-6 text-gray-500 fw-semibold ms-1"
                    data-lang="">Phương thức ngẫu nhiên từ nhóm</span>
            </h3>
            <div class="d-flex flex-wrap my-2">
                <button class="btn btn-primary btn-sm" onclick="showFormAddGroup()" data-lang="Add Group">Add Group</button>
            </div>
        </div>

        <div class="div-form-group mb-6" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <div class="row g-6 mb-5">
                        <div class="col-md-3">
                            <label class="required form-label" data-lang="">Tên</label>
                            <input type="text" class="form-control form-control-solid ipt-group-name">
                        </div>
                        <div class="col-md-9">
                            <label class="required form-label" data-lang="">Chọn các phương thức</label>
                            <select class="form-select form-select-solid sl-pm select2-hidden-accessible" multiple=""
                                data-select2-id="select2-data-4-qo0s" tabindex="-1" aria-hidden="true">
                                <option value="3" data-icon="https://i.imgur.com/P7EFing.png">Ngân Hàng ACB - [Cộng
                                    tiền nhanh]</option>
                                <option value="11"
                                    data-icon="https://cdn.freebiesupply.com/logos/large/2x/binance-coin-logo-png-transparent.png">
                                    Binance Auto Payment ( USDT )</option>
                                <option value="8" data-icon="https://i.imgur.com/NzboTNN.png">Payeer (USD)</option>
                                <option value="5" data-icon="https://i.imgur.com/FYVOL1x.png">Cryptomus - USDT
                                </option>
                                <option value="15" data-icon="aaaaa">ac</option>
                                <option value="12" data-icon="https://i.imgur.com/mlK7ns8.png">PayPal Auto</option>
                                <option value="9" data-icon="https://i.imgur.com/P7EFing.png">MBBANK ( Dự phòng
                                    [Cộng tiền chậm] )</option>
                                <option value="2" data-icon="https://i.imgur.com/ja20O58.png">Perfect Money (USD)
                                </option>
                                <option value="6"
                                    data-icon="https://pbs.twimg.com/profile_images/565310907824103424/N92VUZNJ_400x400.png">
                                    Xendit (Indonesia) (IDR)</option>
                            </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr"
                                data-select2-id="select2-data-5-don9" style="width: 100%;"><span class="selection"><span
                                        class="select2-selection select2-selection--multiple form-select form-select-solid sl-pm"
                                        role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"
                                        aria-disabled="false">
                                        <ul class="select2-selection__rendered" id="select2-q9ty-container"></ul><span
                                            class="select2-search select2-search--inline">
                                            <textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none"
                                                spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search"
                                                aria-describedby="select2-q9ty-container" placeholder="" style="width: 0.75em;"></textarea>
                                        </span>
                                    </span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-new-group w-100" onclick="addGroup(0)"
                        data-lang="button::Add">Thêm</button>
                    <button type="button" class="btn btn-primary btn-update-group w-100" style="display: none;"
                        data-lang="button::Update">Cập nhật</button>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-7 gy-2 gs-5 mb-0">
                        <thead>
                            <tr class="text-start bg-secondary text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th data-lang="Name">Tên</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">
                                    <a href="javascript:;"
                                        class="btn btn-icon btn-light-secondary btn-circle btn-sm w-25px h-25px me-2"
                                        onclick="showFormEditGroup(1)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil w-10px h-10px" viewBox="0 0 16 16">
                                            <path
                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z">
                                            </path>
                                        </svg></a> ACB
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack my-6">
            <h3 class="fw-bold my-2" data-lang="">Thông báo</h3>
            <div class="d-flex flex-wrap my-2">
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" onchange="enableAnnouncement(this.checked);"
                        checked="">
                    <span class="form-check-label" data-lang="Show">Hiển thị</span>
                </label>
            </div>
        </div>
       <div class="card shadow-sm div-announcement">
            <div class="card-body p-0">
                <div id="editor-announcement" class="h-250px"></div>
                <input type="hidden" id="announcement-content" class="ipt-announcement-content" value="">
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-verify-perfectmoney">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Perfect Money - Website Verification</h3>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                        rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body lh-lg fs-6">
                        <ol>
                            <li>Login and go to Add Website: <a target="_blank"
                                    href="https://perfectmoney.com/site_add.html">https://perfectmoney.com/site_add.html</a>
                            </li>
                            <li>Enter your site URL: <span class="text-danger">https://smmkay.com</span> and click <span
                                    class="text-danger">Add</span></li>
                            <li>Get a file name from next instruction like this: <span
                                    class="text-danger">xxxxx.txt</span>
                                <div class="bg-light p-4 border rounded my-3 fs-7">
                                    Please, create empty text file <strong>xxxxx.txt</strong> and place it into the root of
                                    smmkay.com.<br><br>
                                    Verification system will check if this URL exists: https://smmkay.com/xxxxx.txt
                                </div>
                            </li>
                            <li>Enter file name and click Create file:
                                <div class="row align-items-center mt-2">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">File name:</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text"
                                            class="form-control form-control-solid form-control-sm ipt-file-perfectmoney"
                                            placeholder="xxxxx.txt" value="">
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary btn-sm"
                                            onclick="createFileVerify('perfectmoney', document.querySelector('.ipt-file-perfectmoney').value.trim())">Create
                                            file</button>
                                    </div>
                                </div>
                            </li>
                            <li>After create file successfully. Back to perfectmoney site and click <span
                                    class="text-danger">I've uploaded xxxxx.txt to my website. Continue
                                    verification.</span></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-verify-payeer">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Payeer - Website Verification</h3>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                        rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body lh-lg fs-6">
                        <ol>
                            <li>Login and go to ADD MERCHANT: <a target="_blank"
                                    href="https://payeer.com/en/account/api/">https://payeer.com/en/account/api/</a></li>
                            <li>Enter all infomation and save <span class="text-danger">Secret key</span></li>
                            <li>Get a file name from next instruction like this: <span
                                    class="text-danger">payeer_xxxxx.txt</span>
                                <div class="bg-light p-4 border rounded my-3 fs-7">
                                    Domain Not Confirmed: smmkay.com<br>
                                    <ol>
                                        <li>Download <strong>payeer_xxxxx.txt</strong></li>
                                        <li>Place to the root of the website: https://smmkay.com/payeer_xxxxx.txt</li>
                                        <li>Click button "Confirm"</li>
                                    </ol>
                                </div>
                            </li>
                            <li>Enter file name and click Create file:
                                <div class="row align-items-center mt-2">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">File name:</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text"
                                            class="form-control form-control-solid form-control-sm ipt-file-payeer"
                                            placeholder="payeer_xxxxx.txt" value="">
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary btn-sm"
                                            onclick="createFileVerify('payeer', document.querySelector('.ipt-file-payeer').value.trim())">Create
                                            file</button>
                                    </div>
                                </div>
                            </li>
                            <li>After create file successfully. Back to payeer site and click <span
                                    class="text-danger">CONFIRM</span></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-verify-cryptomus">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Cryptomus - Website Verification</h3>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                        rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body lh-lg fs-6">
                        <ol>
                            <li>Login and Create Merchant by follows instruction: <a target="_blank"
                                    href="https://doc.cryptomus.com/getting-started/getting-api-keys/">https://doc.cryptomus.com/getting-started/getting-api-keys/</a>
                            </li>
                            <li>Enter your site URL: <span class="text-danger">https://smmkay.com</span> and
                                Description(Optional) in step 2</li>
                            <li>Select method <span class="text-danger">Using an HTML</span> in step 3</li>
                            <li>Get a file name in step 3 like this: <span
                                    class="text-danger">cryptomus_xxxxxxxx.html</span>
                                <div class="bg-light p-4 border rounded my-3 fs-7">
                                    Confirm domain
                                    <ol>
                                        <li>Download the HTML file</li>
                                        <li>Upload the file to the root folder of the site.<br> The file should be available
                                            at: https://smmkay.com/cryptomus_xxxxxxxx.html</li>
                                        <li>Check that the domain is confirmed</li>
                                    </ol>
                                </div>
                            </li>
                            <li>Enter file name and click Create file:
                                <div class="row align-items-center mt-2">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">File name:</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text"
                                            class="form-control form-control-solid form-control-sm ipt-file-cryptomus"
                                            placeholder="cryptomus_xxxxxxxx.html" value="">
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary btn-sm"
                                            onclick="createFileVerify('cryptomus', document.querySelector('.ipt-file-cryptomus').value.trim())">Create
                                            file</button>
                                    </div>
                                </div>
                            </li>
                            <li>After create file successfully. Back to cryptomus site and click <span
                                    class="text-danger">CHECK</span></li>
                            <li>Wait for Project Moderation can takes up to 12 hours.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-config-xendit">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Xendit - Webhook Configuration</h3>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                        rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body lh-lg fs-6">
                        <ol>
                            <li>Login and Create Api Keys: <a target="_blank"
                                    href="https://dashboard.xendit.co/settings/developers#api-keys">https://dashboard.xendit.co/settings/developers#api-keys</a>
                            </li>
                            <li>Click Genenate secret key button -&gt; Enter API key name -&gt; Add Write permission for
                                Money-in Products -&gt; Click Generate key -&gt; Copy key</li>
                            <li>Back to Admin Payment Method Setup -&gt; Paste Key to API Key Input</li>
                            <li>Create Webhook Verification Token: <a target="_blank"
                                    href="https://dashboard.xendit.co/settings/developers#webhooks">https://dashboard.xendit.co/settings/developers#webhooks</a>
                            </li>
                            <li>Click View Webhook Verification Token -&gt; Copy token</li>
                            <li>Back to Admin Payment Method Setup -&gt; Paste Webhook Verification Token to Webhook Secret
                                Key Input</li>
                            <li>Copy Webhook URL</li>
                            <li>Back to Xendit Webhooks Dashboard: <a target="_blank"
                                    href="https://dashboard.xendit.co/settings/developers#webhooks">https://dashboard.xendit.co/settings/developers#webhooks</a>.
                                Scroll down to bottom and paste url to Invoices paid input -&gt; Click Test and Save button
                            </li>
                            <li>Done!</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-config-bhratpe">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">BharatPe - Configuration</h3>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                        rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body lh-lg fs-6">
                        <ol>
                            <li>Open the: <a target="_blank"
                                    href="https://enterprise.bharatpe.in/downloadqr">https://enterprise.bharatpe.in/downloadqr</a>
                            </li>
                            <li>Enter the page Inspector(fn+F12) and select the 'Application' tab.</li>
                            <li>Click 'TOKEN' in the 'Key' field and copy your token.<a target="_blank"
                                    href="https://i.imgur.com/Goy18RF.png">(screenshot 1)</a></li>
                            <li>Paste it in the 'Token' field.</li>
                            <li>Click 'USER INFO' in the 'Key' field and find the Merchant ID.<a target="_blank"
                                    href="https://i.imgur.com/DdrmDHS.png">(screenshot 2)</a></li>
                            <li>Paste it in the 'Merchant ID' field.</li>
                            <li>Copy the QR code image and paste it to the Details field.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    let showDisabled = true;

function showAll(el) {
    showDisabled = !showDisabled;

    document.querySelectorAll('#sortablePaymentMethods tr.status-0')
        .forEach(row => row.style.display = showDisabled ? '' : 'none');

    el.querySelector('i').className =
        showDisabled ? 'bi bi-arrows-expand fs-4 ms-2' : 'bi bi-arrows-collapse fs-4 ms-2';
}

    // Hàm toggle status phương thức thanh toán
    function status(methodId, isChecked) {
        showFullScreenLoader();
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const row = document.querySelector(`tr[data-id="${methodId}"]`);
        
        fetch(`/admin/payments/methods/${methodId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                status: isChecked ? 1 : 0
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Cập nhật class của row
                if (isChecked) {
                    row.classList.remove('status-0');
                    row.classList.add('status-1');
                    row.classList.remove('text-muted');
                } else {
                    row.classList.remove('status-1');
                    row.classList.add('status-0');
                    row.classList.add('text-muted');
                }
            } else {
                // Revert checkbox nếu có lỗi
                const checkbox = row.querySelector('input[type="checkbox"]');
                checkbox.checked = !isChecked;
            }
            hideFullScreenLoader();
        })
        .catch(error => {
            console.error('Error:', error);
            // Revert checkbox
            const checkbox = row.querySelector('input[type="checkbox"]');
            checkbox.checked = !isChecked;
            hideFullScreenLoader();
        });
    }

    // Khởi tạo Select2 cho select phương thức
    document.addEventListener('DOMContentLoaded', function() {
        if (window.jQuery && window.jQuery.fn.select2) {
            const $select = jQuery('#sl-pma-add');

            // Lấy các attribute từ element
            const allowClear = $select.data('allow-clear') !== false;
            const hideSearch = $select.data('hide-search') === true;

            $select.select2({
                templateResult: formatPaymentMethod,
                templateSelection: formatPaymentMethod,
                allowClear: allowClear,
                minimumResultsForSearch: hideSearch ? Infinity : 0,
                width: '100%',
                escapeMarkup: function(m) {
                    return m;
                },
                dropdownParent: jQuery('.div-form')
            });
        }
    });

    // Hàm format payment method hiển thị icon + text + currency
    function formatPaymentMethod(item) {
        if (!item.id) return item.text;

        const $element = jQuery(item.element);
        const icon = $element.data('icon') || '';
        let prefix = '';

        // Format icon
        if (icon && icon.match(/^(fa|fas|fab|far)-/i)) {
            prefix = `<i class="${icon} me-2"></i>`;
        } else if (icon && icon.match(/^https?:\/\//)) {
            prefix =
                `<img src="${icon}" alt="${item.text}" loading="lazy" class="me-2" style="width:20px;height:20px;object-fit:contain;border-radius:3px;" />`;
        }

        return `<span>${prefix}${item.text}</span>`;
    }

    // Hàm hiển thị form thêm phương thức
    function showFormAdd() {
        const formAdd = document.querySelector('.div-form');
        if (formAdd) {
            // Reset tiêu đề
            const divTitle = formAdd.querySelector('.div-title');
            if (divTitle) {
                divTitle.textContent = 'Thêm phương thức';
            }
            
            // Reset select phương thức
            const selectMethod = document.querySelector('#sl-pma-add');
            if (selectMethod) {
                selectMethod.value = '0';
                selectMethod.disabled = false;
                selectMethod.dispatchEvent(new Event('change'));
            }
            
            // Reset tất cả input fields
            document.querySelector('.ipt-pm-method-name').value = '';
            document.querySelector('.ipt-pm-icon').value = '';
            document.querySelector('.ipt-pm-qr-image').value = '';
            updateQrImagePreview('');
            document.querySelector('.ipt-pm-min').value = '0';
            document.querySelector('.ipt-pm-max').value = '0';
            document.querySelector('.ipt-pm-max-transactions').value = '0';
            document.querySelector('.ipt-pm-max-total-funds').value = '0';
            
            // Reset icon preview
            updateIconPreview('');
            
            // Reset checkbox bonus
            const cbBonus = document.querySelector('.cb-pm-bonus');
            if (cbBonus) {
                cbBonus.checked = false;
                cbBonus.dispatchEvent(new Event('change'));
            }
            
            // Reset Quill editor
            if (window.paymentMethodDetailsEditor) {
                window.paymentMethodDetailsEditor.setText('');
            }
            
            // Hiển thị nút "Thêm", ẩn nút "Cập nhật"
            formAdd.querySelector('.btn-new').style.display = 'block';
            formAdd.querySelector('.btn-update').style.display = 'none';
            
            // Xóa ID phương thức
            delete formAdd.dataset.methodId;
            
            formAdd.style.display = 'block';
            formAdd.scrollIntoView({
                behavior: 'smooth'
            });
        }
    }

    // Hàm hiển thị form chỉnh sửa phương thức
    function showFormEdit(methodId) {
        // Hiển thị fullscreen loader
        showFullScreenLoader();
        
        // Fetch dữ liệu phương thức từ server
        fetch(`/admin/payments/methods/${methodId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // Hiển thị form
                const formAdd = document.querySelector('.div-form');
                if (formAdd) {
                    formAdd.style.display = 'block';
                    
                    // Cập nhật tiêu đề
                    const divTitle = formAdd.querySelector('.div-title');
                    if (divTitle) {
                        divTitle.textContent = 'Tùy chỉnh phương thức';
                    }
                    
                    // Cập nhật select phương thức
                    const selectMethod = document.querySelector('#sl-pma-add');
                    if (selectMethod) {
                        selectMethod.value = data.method_payment_id || '0';
                        selectMethod.disabled = true;
                        selectMethod.dispatchEvent(new Event('change'));
                    }
                    
                    // Set type từ dữ liệu
                    const typeInput = document.querySelector('.ipt-pm-type');
                    if (typeInput && data.type) {
                        typeInput.value = data.type;
                    }
                    
                    // Cập nhật dữ liệu vào form
                    document.querySelector('.ipt-pm-method-name').value = data.name || '';
                    document.querySelector('.ipt-pm-icon').value = data.image || '';
                    document.querySelector('.ipt-pm-min').value = parseInt(data.min) || 0;
                    document.querySelector('.ipt-pm-max').value = parseInt(data.max) || 0;
                    document.querySelector('.ipt-pm-max-transactions').value = parseInt(data.max_transactions) || 0;
                    document.querySelector('.ipt-pm-max-total-funds').value = parseInt(data.max_total_funds) || 0;
                    
                    // Parse config từ JSON
                    let config = {};
                    if (data.config) {
                        try {
                            config = typeof data.config === 'string' ? JSON.parse(data.config) : data.config;
                        } catch (e) {
                            console.error('Error parsing config:', e);
                            config = {};
                        }
                    }
                    
                    // Load dữ liệu config cho các phương thức khác nhau
                    loadConfigData(data.id, config, data.type);
                    
                    // Parse bonus từ JSON
                    let bonusData = [];
                    if (data.bonus) {
                        try {
                            bonusData = typeof data.bonus === 'string' ? JSON.parse(data.bonus) : data.bonus;
                        } catch (e) {
                            console.error('Error parsing bonus:', e);
                            bonusData = [];
                        }
                    }
                    
                    // Cập nhật checkbox bonus
                    const cbBonus = document.querySelector('.cb-pm-bonus');
                    if (cbBonus) {
                        cbBonus.checked = Array.isArray(bonusData) && bonusData.length > 0;
                        cbBonus.dispatchEvent(new Event('change'));
                        
                        // Cập nhật dữ liệu bonus nếu có
                        if (cbBonus.checked && bonusData.length > 0) {
                            const bonusDataDiv = document.querySelector('.div-bonus-data');
                            if (bonusDataDiv) {
                                bonusDataDiv.innerHTML = '';
                                bonusData.forEach(bonus => {
                                    const bonusId = Date.now() + Math.random();
                                    const bonusItem = document.createElement('div');
                                    bonusItem.className = 'mb-5 bonus-item';
                                    bonusItem.id = `bonus-${bonusId}`;
                                    bonusItem.innerHTML = `<div class="input-group input-group-solid"><span class="input-group-text bg-secondary">Nếu nạp số lượng >=</span><input type="number" class="form-control ipt-pm-quantity-bonus text-end" value="${bonus.min || 0}" min="0" step="1"><span class="input-group-text bg-secondary">$</span><span class="input-group-text">sẽ thưởng thêm</span><input type="number" class="form-control ipt-pm-percent-bonus text-end" value="${bonus.percent || 0}" min="0" max="100" step="0.1"><span class="input-group-text bg-secondary">%</span></div>`;
                                    bonusDataDiv.appendChild(bonusItem);
                                });
                            }
                        }
                    }
                    
                    // Cập nhật icon preview
                    updateIconPreview(data.image || '');
                    
                    // Cập nhật Quill editor nếu có
                    if (window.paymentMethodDetailsEditor && data.details) {
                        // Luôn load dạng plain text
                        window.paymentMethodDetailsEditor.setText(data.details);
                    }
                    
                    // Ẩn nút "Thêm", hiển thị nút "Cập nhật"
                    formAdd.querySelector('.btn-new').style.display = 'none';
                    formAdd.querySelector('.btn-update').style.display = 'block';
                    
                    // Lưu ID phương thức để cập nhật
                    formAdd.dataset.methodId = methodId;
                    
                    formAdd.scrollIntoView({
                        behavior: 'smooth'
                    });
                    
                    // Ẩn fullscreen loader
                    hideFullScreenLoader();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                hideFullScreenLoader();
                showToast('Lỗi khi tải dữ liệu phương thức: ' + error.message, 'error');
            });
    }

    // Hàm load dữ liệu config cho các phương thức khác nhau
    function loadConfigData(methodId, config, type) {
        try {
            // Ẩn tất cả các div-options
            const allOptions = document.querySelectorAll('.div-options');
            allOptions.forEach(option => {
                option.style.display = 'none';
            });

            // Hiển thị dựa trên type
            if (type === 'bank_vn') {
                // Sieuthicode Webhook
                const acbOption = document.querySelector('.div-23');
                if (acbOption) {
                    acbOption.style.display = 'block';
                }
                const accountEl = document.querySelector('.ipt-sieuthicode-webhook-account');
                const nameEl = document.querySelector('.ipt-sieuthicode-webhook-name');
                const signatureEl = document.querySelector('.ipt-sieuthicode-webhook-signature');
                const rateEl = document.querySelector('.ipt-sieuthicode-webhook-rate');
                const webhookEl = document.querySelector('.ipt-sieuthicode-webhook');
                
                if (accountEl) accountEl.value = config.account || '';
                if (nameEl) nameEl.value = config.name || '';
                if (signatureEl) signatureEl.value = config.signature || '';
                if (rateEl) rateEl.value = config.rate || '';
                if (webhookEl) webhookEl.value = `${window.location.origin}/webhook/sieuthicode?type=${methodId}`;
                const qrImageEl = document.querySelector('.ipt-pm-qr-image');
                if (qrImageEl) { qrImageEl.value = config.qr_image || ''; updateQrImagePreview(qrImageEl.value); }            } else if (type === 'binance') {
                // FPayAz Webhook
                const binanceOption = document.querySelector('.div-33');
                if (binanceOption) {
                    binanceOption.style.display = 'block';
                }
                const binanceIdEl = document.querySelector('.ipt-fpayaz-binance-id');
                const keyEl = document.querySelector('.ipt-fpayaz-key');
                const secretEl = document.querySelector('.ipt-fpayaz-secret');
                const webhookEl = document.querySelector('.ipt-fpayaz-webhook');
                
                if (binanceIdEl) binanceIdEl.value = config.binance_id || '';
                if (keyEl) keyEl.value = config.key || '';
                if (secretEl) secretEl.value = config.secret || '';
                if (webhookEl) webhookEl.value = `${window.location.origin}/webhook/fpayaz?type=${methodId}`;
                const qrImageEl = document.querySelector('.ipt-pm-qr-image');
                if (qrImageEl) { qrImageEl.value = config.qr_image || ''; updateQrImagePreview(qrImageEl.value); }
            }
        } catch (error) {
            console.error('Error loading config data:', error);
        }
    }

    // Hàm copy webhook URL
    function copyWebhookUrl(selector) {
        const element = document.querySelector(selector);
        if (!element) {
            showToast('Không tìm thấy webhook URL', 'error');
            return;
        }
        
        const url = element.value;
        if (!url) {
            showToast('Webhook URL trống', 'warning');
            return;
        }
        
        // Copy to clipboard
        navigator.clipboard.writeText(url).then(() => {
            showToast('Đã copy webhook URL', 'success');
        }).catch(err => {
            showToast('Lỗi khi copy: ' + err.message, 'error');
        });
    }

    // Hàm cập nhật preview icon/image
    function updateIconPreview(value) {
        const iconSpan = document.querySelector('.icon-image');
        if (!iconSpan) return;

        // Xóa nội dung cũ
        iconSpan.innerHTML = '';

        if (!value || value.trim() === '') {
            return;
        }

        // Kiểm tra nếu là Font Awesome icon (bắt đầu với fa-)
        if (value.match(/^(fa|fas|fab|far|fal|fad)-/i)) {
            const icon = document.createElement('i');
            icon.className = value.trim();
            iconSpan.appendChild(icon);
        }
        // Kiểm tra nếu là URL (http:// hoặc https://)
        else if (value.match(/^https?:\/\//i)) {
            const img = document.createElement('img');
            img.src = value.trim();
            img.alt = 'Icon preview';
            img.style.cssText = 'width: 20px; height: 20px; object-fit: contain; border-radius: 3px;';
            img.onerror = function() {
                this.style.display = 'none';
                iconSpan.innerHTML = '<i class="bi bi-exclamation-circle text-danger"></i>';
            };
            iconSpan.appendChild(img);
        }
        // Nếu không hợp lệ, hiển thị icon cảnh báo
        else {
            const icon = document.createElement('i');
            icon.className = 'bi bi-exclamation-circle text-warning';
            icon.title = 'URL hoặc Font Awesome icon không hợp lệ';
            iconSpan.appendChild(icon);
        }
    }
    // Hàm cập nhật preview ảnh QR
    function updateQrImagePreview(value) {
        const thumb = document.getElementById('qr-image-thumb');
        const preview = document.getElementById('qr-image-preview');
        const icon = document.getElementById('qr-image-icon');
        if (!thumb || !preview || !icon) return;
        if (value && value.match(/^https?:\/\//i)) {
            thumb.src = value.trim();
            preview.style.display = 'inline';
            icon.style.display = 'none';
        } else {
            preview.style.display = 'none';
            icon.style.display = '';
        }
    }
    // Hàm xử lý khi thay đổi phương thức thanh toán
    function handleMethodChange(methodId) {
        // Ẩn tất cả các div-options
        const allOptions = document.querySelectorAll('.div-options');
        allOptions.forEach(option => {
            option.style.display = 'none';
        });

        // Xác định type dựa trên methodId
        let type = 'other';
        if (methodId === '0') {
            type = 'other';
        } else if ([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14].includes(parseInt(methodId))) {
            type = 'bank_vn';
        } else if (methodId === '20') {
            type = 'binance';
        }
        
        // Set type vào input hidden
        const typeInput = document.querySelector('.ipt-pm-type');
        if (typeInput) {
            typeInput.value = type;
        }

        // Hiển thị div-options phù hợp với phương thức được chọn
        if (methodId && methodId !== '0') {
            // Lấy currency từ option được chọn
            const selectElement = document.getElementById('sl-pma-add');
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const currency = selectedOption.getAttribute('data-currency');
            
            // Hiển thị input dựa trên currency
            if (currency === 'VND') {
                // Hiển thị input Sieuthicode
                const acbOption = document.querySelector('.div-23');
                if (acbOption) {
                    acbOption.style.display = 'block';
                }
            } else if (currency === 'USD') {
                // Hiển thị input FPayAZ
                const binanceOption = document.querySelector('.div-33');
                if (binanceOption) {
                    binanceOption.style.display = 'block';
                }
            }
        }

        // Hiển thị form group khi chọn ACB (value="3")
        if (methodId === '3') {
            const formGroup = document.querySelector('.div-form-group');
            if (formGroup) {
                formGroup.style.display = 'block';
                formGroup.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        } else {
            const formGroup = document.querySelector('.div-form-group');
            if (formGroup) {
                formGroup.style.display = 'none';
            }
        }
    }


    // Hàm thêm nhóm phương thức
    function addGroup(id) {
        const groupName = document.querySelector('.ipt-group-name').value;
        const selectedMethods = Array.from(document.querySelectorAll('.sl-pm[multiple] option:checked')).map(opt => opt
            .value);

        if (!groupName.trim()) {
            showToast('Vui lòng nhập tên nhóm', 'warning');
            return;
        }

        if (selectedMethods.length === 0) {
            showToast('Vui lòng chọn ít nhất một phương thức', 'warning');
            return;
        }

        console.log('Thêm nhóm:', {
            name: groupName,
            methods: selectedMethods
        });
        // Gọi API để lưu nhóm
        // TODO: Thêm logic gọi API

        showToast('Nhóm phương thức đã được thêm thành công', 'success');
        document.querySelector('.ipt-group-name').value = '';
        document.querySelectorAll('.sl-pm[multiple] option').forEach(opt => opt.selected = false);
    }

    // Hàm cập nhật nhóm phương thức
    function updateGroup(id) {
        const groupName = document.querySelector('.ipt-group-name').value;
        const selectedMethods = Array.from(document.querySelectorAll('.sl-pm[multiple] option:checked')).map(opt => opt
            .value);

        if (!groupName.trim()) {
            showToast('Vui lòng nhập tên nhóm', 'warning');
            return;
        }

        if (selectedMethods.length === 0) {
            showToast('Vui lòng chọn ít nhất một phương thức', 'warning');
            return;
        }

        console.log('Cập nhật nhóm:', {
            id,
            name: groupName,
            methods: selectedMethods
        });
        // Gọi API để cập nhật nhóm
        // TODO: Thêm logic gọi API

        showToast('Cập nhật thành công', 'success');
        document.querySelector('.ipt-group-name').value = '';
        document.querySelectorAll('.sl-pm[multiple] option').forEach(opt => opt.selected = false);
    }
    // Hàm xử lý checkbox bonus
    function bonus(checked) {
        const divBonus = document.querySelector('.div-bonus');
        if (divBonus) {
            divBonus.style.display = checked ? 'block' : 'none';
            if (checked) {
                // Nếu chưa có điều kiện bonus nào, thêm một cái mặc định
                const bonusData = document.querySelector('.div-bonus-data');
                if (bonusData && bonusData.children.length === 0) {
                    addBonusData();
                }
            }
        }
    }

    // Hàm thêm điều kiện bonus
    function addBonusData() {
        const bonusData = document.querySelector('.div-bonus-data');
        if (!bonusData) return;

        const bonusId = Date.now(); // Tạo ID duy nhất cho mỗi điều kiện
        const bonusItem = document.createElement('div');
        bonusItem.className = 'mb-5 bonus-item';
        bonusItem.id = `bonus-${bonusId}`;
        bonusItem.innerHTML = `
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-secondary">Nếu nạp số lượng >=</span>
                <input type="number" class="form-control ipt-pm-quantity-bonus text-end" value="" step="0.0001">
                <span class="input-group-text bg-secondary">$</span>
                <span class="input-group-text">sẽ thưởng thêm</span>
                <input type="number" class="form-control ipt-pm-percent-bonus text-end" value="" step="0.001">
                <span class="input-group-text bg-secondary">%</span>
            </div>
        `;
        bonusData.appendChild(bonusItem);
    }
    // Hàm xóa điều kiện bonus
    // function removeBonusData(bonusId) {
    //     const bonusItem = document.getElementById(`bonus-${bonusId}`);
    //     if (bonusItem) {
    //         bonusItem.remove();
    //     }
    // }

    // Hàm lấy tất cả dữ liệu bonus
    function getBonusData() {
        const bonusItems = document.querySelectorAll('.bonus-item');
        const bonusData = [];

        bonusItems.forEach(item => {
            const quantity = item.querySelector('.ipt-pm-quantity-bonus').value;
            const percent = item.querySelector('.ipt-pm-percent-bonus').value;

            if (quantity && percent) {
                bonusData.push({
                    quantity: parseFloat(quantity),
                    percent: parseFloat(percent)
                });
            }
        });

        return bonusData;
    }

    // Initialize Quill Editor for Payment Method Details
    document.addEventListener('DOMContentLoaded', function() {
        // Check if Quill is loaded
        if (typeof Quill === 'undefined') {
            return;
        }

        // Initialize Quill editor
        const quill = new Quill('#editor-payment-method-details', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'align': []
                    }],
                    ['link'],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'size': ['small', false, 'large', 'huge']
                    }],
                    [{
                        'header': [1, 2, 3, 4, 5, 6, false]
                    }]
                ]
            }
        });

        // Store reference globally for form submission
        window.paymentMethodDetailsEditor = quill;

        // Get initial content if exists
        const initialContent = document.getElementById('payment-method-details-content');
        if (initialContent && initialContent.value) {
            const value = initialContent.value.trim();

            if (value) {
                try {
                    // Try to parse as JSON (Quill Delta format)
                    const delta = JSON.parse(value);
                    quill.setContents(delta);
                } catch (e) {
                    // If not JSON, treat as plain HTML or text
                    quill.root.innerHTML = value;
                }
            }
        }

        // Update hidden input on text change - lưu plain text
        quill.on('text-change', function() {
            if (initialContent) {
                initialContent.value = quill.getText().trim();
            }
        });

        // Initialize Quill editor for Announcement
        const announcementEditor = new Quill('#editor-announcement', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    [{'align': []}],
                    ['link'],
                    [{'color': []}, {'background': []}],
                    [{'size': ['small', false, 'large', 'huge']}],
                    [{'header': [1, 2, 3, 4, 5, 6, false]}]
                ]
            }
        });

        // Store reference globally for form submission
        window.announcementEditor = announcementEditor;

        // Get initial content if exists
        const announcementContent = document.getElementById('announcement-content');
        if (announcementContent && announcementContent.value) {
            const value = announcementContent.value.trim();
            if (value) {
                try {
                    const delta = JSON.parse(value);
                    announcementEditor.setContents(delta);
                } catch (e) {
                    announcementEditor.root.innerHTML = value;
                }
            }
        }

        // Update hidden input on text change
        announcementEditor.on('text-change', function() {
            if (announcementContent) {
                announcementContent.value = JSON.stringify(announcementEditor.getContents());
            }
        });
    });

    // Hàm thêm phương thức thanh toán
    function add(id) {
        // Lấy dữ liệu từ form
        const methodId = document.querySelector('#sl-pma-add').value;
        const nameInput = document.querySelector('.ipt-pm-method-name');
        const name = nameInput ? nameInput.value : '';
        const image = document.querySelector('.ipt-pm-icon').value;
        const min = parseInt(document.querySelector('.ipt-pm-min').value) || 0;
        const max = parseInt(document.querySelector('.ipt-pm-max').value) || 0;
        const maxTransactions = parseInt(document.querySelector('.ipt-pm-max-transactions').value) || 0;
        const maxTotalFunds = parseInt(document.querySelector('.ipt-pm-max-total-funds').value) || 0;
        const details = document.querySelector('.ipt-pm-method-details').value || '';
        
        // Lấy type từ method ID
        const selectElement = document.getElementById('sl-pma-add');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const currency = selectedOption.getAttribute('data-currency');
        let type = 'other';
        if (currency === 'VND') {
            type = 'bank_vn';
        } else if (currency === 'USD') {
            type = 'binance';
        }
        
        // Validate dữ liệu
        if (!name || !name.trim()) {
            showToast('Vui lòng nhập tên phương thức', 'warning');
            return;
        }

        // Lấy dữ liệu config dựa trên type
        let config = {};
        if (type === 'bank_vn') {
            // Sieuthicode
            const account = document.querySelector('.ipt-sieuthicode-webhook-account').value || '';
            const configName = document.querySelector('.ipt-sieuthicode-webhook-name').value || '';
            const signature = document.querySelector('.ipt-sieuthicode-webhook-signature').value || '';
            const rate = document.querySelector('.ipt-sieuthicode-webhook-rate').value || '';
            const qrImage = document.querySelector('.ipt-pm-qr-image').value || '';
            
            // Chỉ thêm vào config nếu có giá trị
            if (account) config.account = account;
            if (configName) config.name = configName;
            if (signature) config.signature = signature;
            if (rate) config.rate = rate;
        } else if (type === 'binance') {
            // FPayAz
            const binanceId = document.querySelector('.ipt-fpayaz-binance-id').value || '';
            const key = document.querySelector('.ipt-fpayaz-key').value || '';
            const secret = document.querySelector('.ipt-fpayaz-secret').value || '';
            const qrImage = document.querySelector('.ipt-pm-qr-image')?.value || '';

            // Chỉ thêm vào config nếu có giá trị
            if (binanceId) config.binance_id = binanceId;
            if (key) config.key = key;
            if (secret) config.secret = secret;
            if (qrImage) config.qr_image = qrImage;
        }

        // Lấy dữ liệu bonus
        const bonusData = getBonusData();
        
        // Chuẩn bị dữ liệu gửi lên server
        const formData = new FormData();
        formData.append('name', name);
        formData.append('type', type);
        formData.append('method_payment_id', methodId);
        formData.append('image', image);
        formData.append('min', min);
        formData.append('max', max);
        formData.append('max_transactions', maxTransactions);
        formData.append('max_total_funds', maxTotalFunds);
        formData.append('details', details);
        formData.append('config', JSON.stringify(config));
        formData.append('bonus', JSON.stringify(bonusData));
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

        // Gửi request tới server
        showFullScreenLoader();
        fetch('/admin/payments/methods/', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            hideFullScreenLoader();
            if (data.success) {
                showToast('Thêm thành công!', 'success');
                location.reload();
            } else {
                showToast('Lỗi: ' + (data.message || 'Không thể thêm phương thức'), 'error');
            }
        })
        .catch(error => {
            hideFullScreenLoader();
            console.error('Error:', error);
            showToast('Lỗi khi thêm phương thức: ' + error.message, 'error');
        });
    }

    // Hàm cập nhật phương thức thanh toán
    function update(id) {
        const formAdd = document.querySelector('.div-form');
        const methodId = formAdd.dataset.methodId;
        
        if (!methodId) {
            showToast('Lỗi: Không tìm thấy ID phương thức', 'error');
            return;
        }

        // Lấy dữ liệu từ form
        const nameInput = document.querySelector('.ipt-pm-method-name');
        const name = nameInput ? nameInput.value : '';
        const image = document.querySelector('.ipt-pm-icon').value;
        const min = parseInt(document.querySelector('.ipt-pm-min').value) || 0;
        const max = parseInt(document.querySelector('.ipt-pm-max').value) || 0;
        const maxTransactions = parseInt(document.querySelector('.ipt-pm-max-transactions').value) || 0;
        const maxTotalFunds = parseInt(document.querySelector('.ipt-pm-max-total-funds').value) || 0;
        const details = document.querySelector('.ipt-pm-method-details').value || '';
        
        // Validate dữ liệu
        if (!name || !name.trim()) {
            showToast('Vui lòng nhập tên phương thức', 'warning');
            return;
        }

        // Lấy type từ input hidden
        const type = document.querySelector('.ipt-pm-type')?.value || 'other';

        // Lấy dữ liệu config dựa trên type
        let config = {};
        if (type === 'bank_vn') {
            // Sieuthicode
            config = {
                account: document.querySelector('.ipt-sieuthicode-webhook-account').value || '',
                name: document.querySelector('.ipt-sieuthicode-webhook-name').value || '',
                signature: document.querySelector('.ipt-sieuthicode-webhook-signature').value || '',
                rate: document.querySelector('.ipt-sieuthicode-webhook-rate').value || ''
            };
        } else if (type === 'binance') {
            // FPayAz
            config = {
                binance_id: document.querySelector('.ipt-fpayaz-binance-id').value || '',
                key: document.querySelector('.ipt-fpayaz-key').value || '',
                secret: document.querySelector('.ipt-fpayaz-secret').value || '',
                qr_image: document.querySelector('.ipt-pm-qr-image')?.value || ''
            };
        }

        // Lấy dữ liệu bonus
        const bonusData = getBonusData();
        
        // Chuẩn bị dữ liệu gửi lên server
        const formData = new FormData();
        formData.append('name', name);
        formData.append('type', type);
        formData.append('image', image);
        formData.append('min', min);
        formData.append('max', max);
        formData.append('max_transactions', maxTransactions);
        formData.append('max_total_funds', maxTotalFunds);
        formData.append('details', details);
        formData.append('config', JSON.stringify(config));
        formData.append('bonus', JSON.stringify(bonusData));
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
        formData.append('_method', 'PUT');

        // Gửi request tới server
        showFullScreenLoader();
        fetch(`/admin/payments/methods/${methodId}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name: name,
                type: type,
                image: image,
                min: min,
                max: max,
                max_transactions: maxTransactions,
                max_total_funds: maxTotalFunds,
                details: details,
                config: JSON.stringify(config),
                bonus: JSON.stringify(bonusData)
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            hideFullScreenLoader();
            if (data.success) {
                showToast('Cập nhật thành công!', 'success');
                location.reload();
            } else {
                showToast('Lỗi: ' + (data.message || 'Không thể cập nhật phương thức'), 'error');
            }
        })
        .catch(error => {
            hideFullScreenLoader();
            console.error('Error:', error);
            showToast('Lỗi khi cập nhật phương thức: ' + error.message, 'error');
        });
    }

    // Initialize Sortable for payment methods
    document.addEventListener('DOMContentLoaded', function() {
        const sortableElement = document.getElementById('sortablePaymentMethods');
        if (sortableElement) {
            new Sortable(sortableElement, {
                animation: 200,
                handle: '.ui-sortable-handle',
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                dragClass: 'sortable-drag',
                onEnd: function(evt) {
                    const rows = sortableElement.querySelectorAll('tr');
                    const paymentMethods = [];
                    
                    rows.forEach((row, index) => {
                        const id = row.getAttribute('data-id');
                        if (id) {
                            paymentMethods.push({ id, position: index });
                        }
                    });
                    
                    if (paymentMethods.length > 0) {
                        fetch('/admin/payments/methods', {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                action: 'reorder',
                                payment_methods: paymentMethods
                            })
                        })
                        .then(response => response.json())
                        .catch(error => console.error('Reorder error:', error));
                    }
                }
            });
        }
    });
</script>
