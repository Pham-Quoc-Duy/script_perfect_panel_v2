@extends('adminpanel.layouts.app')
@section('title', 'Settings')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">

        @include('adminpanel.settings.partials.header')

        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2" data-lang="Modules">Tiện ích</h3>
        </div>

        <div class="row g-5">

            {{-- Child panel --}}
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fs-6 fw-semibold" data-lang="Child panel">Tạo web con</span>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input module-toggle" type="checkbox"
                                    data-module="child_panel_status" data-enable-val="true" data-disable-val="false"
                                    {{ ($config->child_panel_status ?? false) ? 'checked' : '' }}
                                    onchange="_settings.on.click.enableModule('child_panel_status', this.checked ? 'true' : 'false')">
                            </div>
                        </div>
                        <p class="text-gray-600 fs-7 mb-0" data-lang="Child panel - desc">Tạo một website với tên miền và thương hiệu riêng cho khách hàng của bạn. Website này chỉ được kết nối dịch vụ với website của bạn.</p>
                        <div class="mt-auto">
                            <a href="javascript:;" class="btn btn-light btn-sm btn-active-light-primary"
                                onclick="_settings.on.click.showModalConfig('child_panel_status', 'Child panel')"
                                data-lang="Config">Thiết lập</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Member level --}}
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fs-6 fw-semibold" data-lang="Member level">Cấp bậc thành viên</span>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input module-toggle" type="checkbox"
                                    data-module="member_level" data-enable-val="true" data-disable-val="false"
                                    onchange="_settings.on.click.enableModule('member_level', this.checked ? 'true' : 'false')">
                            </div>
                        </div>
                        <p class="text-gray-600 fs-7 mb-0" data-lang="Member level - desc">Thiết lập phần thưởng cho thành viên theo số lượng tiền nạp</p>
                        <div class="mt-auto">
                            <a href="javascript:;" class="btn btn-light btn-sm btn-active-light-primary"
                                onclick="_settings.on.click.showModalConfig('member_level', 'Member level')"
                                data-lang="Config">Thiết lập</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Affiliates --}}
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fs-6 fw-semibold" data-lang="Affiliates">Tiếp thị liên kết</span>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input module-toggle" type="checkbox"
                                    data-module="affiliate_status" data-enable-val="true" data-disable-val="false"
                                    {{ ($config->affiliate_status ?? true) ? 'checked' : '' }}
                                    onchange="_settings.on.click.enableModule('affiliate_status', this.checked ? 'true' : 'false')">
                            </div>
                        </div>
                        <p class="text-gray-600 fs-7 mb-0" data-lang="Affiliates - desc">Giới thiệu link đăng ký cho người khác để được hưởng hoa hồng</p>
                        <div class="mt-auto">
                            <a href="javascript:;" class="btn btn-light btn-sm btn-active-light-primary"
                                onclick="_settings.on.click.showModalConfig('affiliate_status', 'Affiliates')"
                                data-lang="Config">Thiết lập</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Coupon --}}
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fs-6 fw-semibold" data-lang="Coupon">Mã giảm giá</span>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input module-toggle" type="checkbox"
                                    data-module="module_coupon" data-enable-val="true" data-disable-val="false"
                                    onchange="_settings.on.click.enableModule('module_coupon', this.checked ? 'true' : 'false')">
                            </div>
                        </div>
                        <p class="text-gray-600 fs-7 mb-0" data-lang="Coupon - desc">Tạo ưu đãi giảm giá hoặc khuyến mại đặc biệt cho khách hàng</p>
                        <div class="mt-auto pt-2"></div>
                    </div>
                </div>
            </div>

            {{-- Keep cancel orders --}}
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fs-6 fw-semibold" data-lang="Keep cancel orders">Giữ đơn hàng bị hủy</span>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input module-toggle" type="checkbox"
                                    data-module="keep_orders_status" data-enable-val="true" data-disable-val="false"
                                    {{ ($config->keep_orders_status ?? false) ? 'checked' : '' }}
                                    onchange="_settings.on.click.enableModule('keep_orders_status', this.checked ? 'true' : 'false')">
                            </div>
                        </div>
                        <p class="text-gray-600 fs-7 mb-0" data-lang="Keep cancel orders - desc">Giữ lại các đơn đặt hàng không thành công khi được gửi đến nhà cung cấp. Bạn có thể gửi lại hoặc hủy các đơn đặt hàng này.</p>
                        <div class="mt-auto">
                            <a href="javascript:;" class="btn btn-light btn-sm btn-active-light-primary"
                                onclick="_settings.on.click.showModalConfig('keep_orders_status', 'Keep cancel orders')"
                                data-lang="Config">Thiết lập</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Telegram --}}
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fs-6 fw-semibold" data-lang="Telegram">Telegram</span>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input module-toggle" type="checkbox"
                                    data-module="telegram_status" data-enable-val="true" data-disable-val="false"
                                    {{ ($config->telegram_status ?? false) ? 'checked' : '' }}
                                    onchange="_settings.on.click.enableModule('telegram_status', this.checked ? 'true' : 'false')">
                            </div>
                        </div>
                        <p class="text-gray-600 fs-7 mb-0" data-lang="Telegram - desc">Thiết lập thông báo cho các đơn đặt hàng thủ công mới, dịch vụ mới, cập nhật dịch vụ và giao dịch nạp tiền trên trang web thông qua Telegram.</p>
                        <div class="mt-auto">
                            <a href="javascript:;" class="btn btn-light btn-sm btn-active-light-primary"
                                onclick="_settings.on.click.showModalConfig('telegram_status', 'Telegram')"
                                data-lang="Config">Thiết lập</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Google Analytics --}}
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fs-6 fw-semibold" data-lang="Google analytics">Google Analytics</span>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input module-toggle" type="checkbox" checked
                                    data-module="google_analytics_status" data-enable-val="true" data-disable-val="false"
                                    onchange="_settings.on.click.enableModule('google_analytics_status', this.checked ? 'true' : 'false')">
                            </div>
                        </div>
                        <p class="text-gray-600 fs-7 mb-0" data-lang="Google analytics - desc">Hỗ trợ tích hợp với Google Analytics để theo dõi lưu lượng truy cập trang web của bạn.</p>
                        <div class="mt-auto">
                            <a href="javascript:;" class="btn btn-light btn-sm btn-active-light-primary"
                                onclick="_settings.on.click.showModalConfig('google_analytics_status', 'Google analytics')"
                                data-lang="Config">Thiết lập</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Crisp chat --}}
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fs-6 fw-semibold" data-lang="Crisp chat">Crisp Chat</span>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input module-toggle" type="checkbox"
                                    data-module="module_crisp_chat" data-enable-val="true" data-disable-val="false"
                                    onchange="_settings.on.click.enableModule('module_crisp_chat', this.checked ? 'true' : 'false')">
                            </div>
                        </div>
                        <p class="text-gray-600 fs-7 mb-0" data-lang="Crisp chat - desc">Live chat cho website. Đăng kí <a target="_blank" href="https://crisp.chat/">tại đây</a></p>
                        <div class="mt-auto">
                            <a href="javascript:;" class="btn btn-light btn-sm btn-active-light-primary"
                                onclick="_settings.on.click.showModalConfig('module_crisp_chat', 'Crisp chat')"
                                data-lang="Config">Thiết lập</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Google OAuth Login --}}
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fs-6 fw-semibold" data-lang="Google Oauth Login">Google OAuth Login</span>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input module-toggle" type="checkbox"
                                    data-module="google_oauth_status" data-enable-val="true" data-disable-val="false"
                                    {{ ($config->google_oauth_status ?? false) ? 'checked' : '' }}
                                    onchange="_settings.on.click.enableModule('google_oauth_status', this.checked ? 'true' : 'false')">
                            </div>
                        </div>
                        <p class="text-gray-600 fs-7 mb-0" data-lang="Google Oauth Login - desc">Đăng nhập bằng tài khoản Google. Bạn cần tạo một dự án và Client ID và Client Secret. <a target="_blank" href="https://developers.google.com/identity/protocols/oauth2">Tham khảo</a></p>
                        <div class="mt-auto">
                            <a href="javascript:;" class="btn btn-light btn-sm btn-active-light-primary"
                                onclick="_settings.on.click.showModalConfig('google_oauth_status', 'Google Oauth Login')"
                                data-lang="Config">Thiết lập</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Simulate Order ID --}}
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fs-6 fw-semibold" data-lang="Simulate Order ID">Giả lập mã đơn hàng</span>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input module-toggle" type="checkbox"
                                    data-module="fake_order_status" data-enable-val="true" data-disable-val="false"
                                    {{ ($config->fake_order_status ?? false) ? 'checked' : '' }}
                                    onchange="_settings.on.click.enableModule('fake_order_status', this.checked ? 'true' : 'false')">
                            </div>
                        </div>
                        <p class="text-gray-600 fs-7 mb-0" data-lang="Simulate Order ID - desc">Giả lập mã đơn hàng để cho khách hàng thấy website có nhiều đơn đặt hàng. Thích hợp cho trang web mới tạo.</p>
                        <div class="mt-auto">
                            <a href="javascript:;" class="btn btn-light btn-sm btn-active-light-primary"
                                onclick="_settings.on.click.showModalConfig('fake_order_status', 'Simulate Order ID')"
                                data-lang="Config">Thiết lập</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Modal config module --}}
    <div class="modal fade" id="modal-config-module" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark fs-4"></i>
                    </div>
                </div>
                <div class="modal-body">

                    {{-- Child panel --}}
                    <div class="div-module div-child_panel_status" style="display:none">
                        <div class="mb-4">
                            <label class="form-label required">Đặt giá tạo web con</label>
                            <div class="input-group input-group-solid">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control ipt-childpanel-price" value="{{ $config->child_panel_cost ?? 0 }}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label class="form-label">Tên dịch vụ 1 (namesv1)</label>
                                <input type="text" class="form-control form-control-solid ipt-namesv1"
                                    value="{{ $config->namesv1 ?? '' }}" placeholder="VD: Dịch vụ SMM">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Tên dịch vụ 2 (namesv2)</label>
                                <input type="text" class="form-control form-control-solid ipt-namesv2"
                                    value="{{ $config->namesv2 ?? '' }}" placeholder="VD: Tăng follow, like...">
                            </div>
                        </div>

                        <div class="separator my-4"></div>
                        <div class="fw-semibold fs-6 mb-3"><i class="fa-brands fa-cloudflare text-warning me-2"></i>Cloudflare</div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control form-control-solid ipt-cf-email"
                                    value="{{ $config->cloudflare_email ?? '' }}" placeholder="email@domain.com">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Global API Key</label>
                                <input type="text" class="form-control form-control-solid ipt-cf-global-key"
                                    value="{{ $config->cloudflare_global_key ?? '' }}" placeholder="Global Key">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label">Account ID</label>
                                <input type="text" class="form-control form-control-solid ipt-cf-account-id"
                                    value="{{ $config->cloudflare_account_id ?? '' }}" placeholder="Account ID">
                            </div>
                            <div class="col-6">
                                <label class="form-label">API Token</label>
                                <input type="text" class="form-control form-control-solid ipt-cf-token"
                                    value="{{ $config->cloudflare_token ?? '' }}" placeholder="API Token">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">IP Host</label>
                            <input type="text" class="form-control form-control-solid ipt-cf-ip-host"
                                value="{{ $config->cloudflare_ip_host ?? '' }}" placeholder="1.2.3.4">
                        </div>

                        <div class="separator my-4"></div>
                        <div class="fw-semibold fs-6 mb-3"><i class="fa-solid fa-server text-primary me-2"></i>cPanel</div>
                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <label class="form-label">Server URL</label>
                                <input type="text" class="form-control form-control-solid ipt-cpanel-server"
                                    value="{{ $config->cpanel_server ?? '' }}" placeholder="https://cpanel.domain.com:2083">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control form-control-solid ipt-cpanel-username"
                                    value="{{ $config->cpanel_username ?? '' }}" placeholder="Username">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control form-control-solid ipt-cpanel-password"
                                    value="{{ $config->cpanel_password ?? '' }}" placeholder="Password">
                            </div>
                        </div>
                    </div>

                    {{-- Member level --}}
                    <div class="div-module div-member_level" style="display:none">
                        <div class="table-responsive">
                            <table class="table table-row-gray-300 align-middle gy-1 fs-7">
                                <thead>
                                    <tr class="fs-6 fw-bold">
                                        <td data-lang="Name">Tên</td>
                                        <td data-lang="Reach $ amount">Số tiền cần đạt</td>
                                        <td data-lang="Will be get % Bonus">Nhận được % thưởng</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach([['NEWBIE','0','0'],['JUNIOR','1000','0'],['ELITE','5000','0'],['FREQUENT','10000','0'],['VIP','20000','0']] as $level)
                                    <tr>
                                        <td><input type="text" class="form-control form-control-solid" value="{{ $level[0] }}"></td>
                                        <td><input type="text" class="form-control form-control-solid text-end" value="{{ $level[1] }}"></td>
                                        <td><input type="text" class="form-control form-control-solid text-end" value="{{ $level[2] }}"></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Affiliates --}}
                    <div class="div-module div-affiliate_status" style="display:none">
                        {{-- Hoa hồng & Giới hạn --}}
                        <div class="row mb-5">
                            <div class="col-4">
                                <label class="form-label required">Hoa hồng (%)</label>
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text">%</span>
                                    <input type="number" step="0.01" min="0" max="100" class="form-control ipt-affiliate-percent"
                                        value="{{ $config->affiliate_percent ?? 10 }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Tối thiểu ($)</label>
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.0001" min="0" class="form-control ipt-affiliate-min"
                                        value="{{ $config->affiliate_min ?? 0 }}">
                                </div>
                                <span class="text-muted fs-8">0 = không giới hạn</span>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Tối đa ($)</label>
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.0001" min="0" class="form-control ipt-affiliate-max"
                                        value="{{ $config->affiliate_max ?? 0 }}">
                                </div>
                                <span class="text-muted fs-8">0 = không giới hạn</span>
                            </div>
                        </div>
 
                        <div class="separator my-4"></div>

                        {{-- Quyền hạn --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="d-flex align-items-center justify-content-between border rounded p-3 h-100">
                                    <div>
                                        <div class="fw-semibold fs-7">Cho phép rút tiền</div>
                                        <div class="text-muted fs-8">Người dùng có thể rút hoa hồng</div>
                                    </div>
                                    <div class="form-check form-switch form-check-custom form-check-solid ms-3">
                                        <input class="form-check-input cb-affiliate-allow-withdraw" type="checkbox"
                                            {{ ($config->affiliate_allow_withdraw ?? false) ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center justify-content-between border rounded p-3 h-100">
                                    <div>
                                        <div class="fw-semibold fs-7">Cho phép chuyển đổi số dư</div>
                                        <div class="text-muted fs-8">Chuyển hoa hồng sang số dư tài khoản</div>
                                    </div>
                                    <div class="form-check form-switch form-check-custom form-check-solid ms-3">
                                        <input class="form-check-input cb-affiliate-allow-convert" type="checkbox"
                                            {{ ($config->affiliate_allow_convert ?? false) ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-4"></div>

                        {{-- Trạng thái --}}
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-semibold fs-7">Trạng thái module</div>
                                <div class="text-muted fs-8">Bật/tắt toàn bộ tính năng tiếp thị liên kết</div>
                            </div>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input cb-affiliate-status" type="checkbox"
                                    {{ ($config->affiliate_status ?? true) ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>

                    {{-- Keep cancel orders --}}
                    <div class="div-module div-keep_orders_status" style="display:none">
                       <label class="required form-label" data-lang="Enter keywords from ERROR message">Nhập từ khóa của cảnh báo lỗi</label>
                        <div class="div-keyword" style="max-height:300px;overflow-y:auto"></div>
                        <button type="button" class="btn btn-light btn-sm mt-3"
                            onclick="_settings.on.click.addKeywordKeepCancelOrders()" data-lang="button::Add">
                            <i class="fa-solid fa-plus me-1"></i> Thêm từ khóa
                        </button>
                        <div id="keep-keywords-data" style="display:none">@json(json_decode($config->keep_orders ?? '[]', true) ?? [])</div>
                    </div>

                    {{-- Telegram --}}
                    <div class="div-module div-telegram_status" style="display:none">
                        <div class="col-lg-12 mb-5">
                                    <button class="btn btn-outline btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-user-telegram-bot" data-lang="How to get BOT_TOKEN &amp; channel CHAT_ID?">Cách lấy BOT_TOKEN &amp; channel CHAT_ID?</button>
                                    <div class="mt-10">
                                        <label class="required form-label">Token (BOT_TOKEN)</label>
                                        <input type="text" class="form-control ipt-telegram-token"
                                value="{{ $config->telegram_bot ?? '' }}" placeholder="123456789:AAF...">
                                    </div>
                                </div>
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <label class="form-label">Public Channel (CHAT_ID)</label>
                                <input type="text" class="form-control ipt-telegram-public-chat-id"
                                    value="{{ $config->telegram_public_chat_id ?? '' }}" placeholder="-100xxxxxxxxx">
                                <span class="text-muted fs-8">Dành cho group công khai</span>
                                <div class="mt-3 mb-1 fw-semibold fs-8">Gửi khi:</div>
                                <div class="form-check form-switch form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input cb-telegram-notification-add-service" type="checkbox"
                                        {{ ($config->telegram_notify_add_service ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label fs-7">Thêm dịch vụ mới</label>
                                </div>
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input cb-telegram-notification-update-service" type="checkbox"
                                        {{ ($config->telegram_notify_update_service ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label fs-7">Cập nhật dịch vụ</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Private Channel (CHAT_ID)</label>
                                <input type="text" class="form-control ipt-telegram-private-chat-id"
                                    value="{{ $config->telegram_private_chat_id ?? '' }}" placeholder="-100xxxxxxxxx">
                                <span class="text-muted fs-8">Dành cho quản trị viên</span>
                                <div class="mt-3 mb-1 fw-semibold fs-8">Gửi khi:</div>
                                <div class="form-check form-switch form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input cb-telegram-notification-new-manual-order" type="checkbox"
                                        {{ ($config->telegram_notify_manual_order ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label fs-7">Có đơn hàng thủ công</label>
                                </div>
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input cb-telegram-notification-new-deposit" type="checkbox"
                                        {{ ($config->telegram_notify_deposit ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label fs-7">Giao dịch nạp tiền mới</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Google Analytics --}}
                    <div class="div-module div-google_analytics_status" style="display:none">
                        <label class="required form-label">Measurement ID</label>
                        <input type="text" class="form-control ipt-google-analytics-id" value="" placeholder="G-XXXXXXXXXX">
                    </div>

                    {{-- Crisp chat --}}
                    <div class="div-module div-module_crisp_chat" style="display:none">
                        <label class="required form-label">Website ID</label>
                        <input type="text" class="form-control ipt-crisp-chat-id" value="" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx">
                    </div>

                    {{-- Google OAuth --}}
                    <div class="div-module div-google_oauth_status" style="display:none">
                        <div class="mb-5">
                            <label class="required form-label">Client ID</label>
                            <input type="text" class="form-control ipt-google-oauth-client-id"
                                value="{{ $config->google_oauth_client_id ?? '' }}">
                        </div>
                        <div class="mb-5">
                            <label class="required form-label">Client Secret</label>
                            <input type="text" class="form-control ipt-google-oauth-client-secret"
                                value="{{ $config->google_oauth_client_secret ?? '' }}">
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Authorized redirect URI</label>
                            <input type="text" class="form-control" value="{{ url('/api/oauth_google') }}" disabled>
                        </div>
                    </div>

                    {{-- Simulate Order ID --}}
                    <div class="div-module div-fake_order_status" style="display:none">
                        <div class="alert alert-primary fs-7">
                            <ol class="mb-0">
                                <li>Khi đặt hàng thành công, mã đơn hàng tiếp theo sẽ tăng ngẫu nhiên trong khoảng bước nhảy bên dưới.</li>
                            </ol>
                        </div>
                        <div class="mb-3">
                            <label class="required form-label">Bước nhảy: tối thiểu 1 - tối đa 1000</label>
                            <div class="input-group input-group-solid">
                                <input type="number" min="1" max="1000"
                                    class="form-control ipt-fake-order-step-min border-2 border-end"
                                    value="{{ $config->fake_order_step_min ?? 1 }}"
                                    placeholder="Min">
                                <span class="input-group-text">—</span>
                                <input type="number" min="1" max="1000"
                                    class="form-control ipt-fake-order-step-max border-2 border-start"
                                    value="{{ $config->fake_order_step_max ?? 100 }}"
                                    placeholder="Max">
                            </div>
                            <div class="text-muted fs-8 mt-1">Mỗi đơn hàng ID sẽ tăng ngẫu nhiên trong khoảng min–max</div>
                        </div>
                    </div>

                    <div class="text-center pt-6">
                        <button type="button" class="btn btn-primary btn-sm" id="btn-save-config-module" data-lang="button::Update">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
const _settings = {
    _currentModule: null,

    init() {
        document.getElementById('btn-save-config-module')?.addEventListener('click', () => {
            _settings.on.click.saveModuleConfig();
        });
    },

    on: {
        click: {
            showModalConfig(moduleKey, title) {
                _settings._currentModule = moduleKey;
                // Set title
                document.querySelector('#modal-config-module .modal-title').textContent = title;
                // Hide all module divs
                document.querySelectorAll('#modal-config-module .div-module').forEach(el => el.style.display = 'none');
                // Show target
                const target = document.querySelector(`#modal-config-module .div-${moduleKey}`);
                if (target) target.style.display = '';
                // Load keywords nếu là keep_cancel_orders
                if (moduleKey === 'keep_orders_status') {
                    _settings.on.click.loadKeywordsKeepCancelOrders();
                }
                // Open modal
                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modal-config-module'));
                modal.show();
            },

            enableModule(moduleKey, value) {
                showFullScreenLoader();
                fetch('{{ route("admin.settings.modules.enable") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ module: moduleKey, value: value })
                })
                .then(r => r.json())
                .then(res => {
                    hideFullScreenLoader();
                    showToast(res.message, res.success ? 'success' : 'error');
                })
                .catch(() => {
                    hideFullScreenLoader();
                    showToast('Có lỗi xảy ra', 'error');
                });
            },

            saveModuleConfig() {
                const key = _settings._currentModule;
                if (!key) return;

                let data = {};

                if (key === 'child_panel_status') {
                    data.child_panel_cost = document.querySelector('.ipt-childpanel-price')?.value;
                    data.namesv1 = document.querySelector('.ipt-namesv1')?.value;
                    data.namesv2 = document.querySelector('.ipt-namesv2')?.value;
                    data.cloudflare_email = document.querySelector('.ipt-cf-email')?.value;
                    data.cloudflare_global_key = document.querySelector('.ipt-cf-global-key')?.value;
                    data.cloudflare_account_id = document.querySelector('.ipt-cf-account-id')?.value;
                    data.cloudflare_token = document.querySelector('.ipt-cf-token')?.value;
                    data.cloudflare_ip_host = document.querySelector('.ipt-cf-ip-host')?.value;
                    data.cpanel_server = document.querySelector('.ipt-cpanel-server')?.value;
                    data.cpanel_username = document.querySelector('.ipt-cpanel-username')?.value;
                    data.cpanel_password = document.querySelector('.ipt-cpanel-password')?.value;
                } else if (key === 'member_level') {
                    const rows = document.querySelectorAll('.div-member_level tbody tr');
                    const levels = [];
                    rows.forEach(row => {
                        const inputs = row.querySelectorAll('input');
                        levels.push({ name: inputs[0]?.value, amount: inputs[1]?.value, bonus: inputs[2]?.value });
                    });
                    data.member_levels = JSON.stringify(levels);
                } else if (key === 'affiliate_status') {
                    data.affiliate_percent = document.querySelector('.ipt-affiliate-percent')?.value;
                    data.affiliate_min = document.querySelector('.ipt-affiliate-min')?.value;
                    data.affiliate_max = document.querySelector('.ipt-affiliate-max')?.value;
                    data.affiliate_status = document.querySelector('.cb-affiliate-status')?.checked ? 1 : 0;
                    data.affiliate_allow_withdraw = document.querySelector('.cb-affiliate-allow-withdraw')?.checked ? 1 : 0;
                    data.affiliate_allow_convert = document.querySelector('.cb-affiliate-allow-convert')?.checked ? 1 : 0;
                } else if (key === 'keep_orders_status') {
                    const keywords = Array.from(document.querySelectorAll('.div-keyword .kw-input')).map(i => i.value.trim()).filter(Boolean);
                    data.keep_orders = JSON.stringify(keywords);
                } else if (key === 'telegram_status') {
                    data.telegram_bot = document.querySelector('.ipt-telegram-token')?.value;
                    data.telegram_public_chat_id = document.querySelector('.ipt-telegram-public-chat-id')?.value;
                    data.telegram_private_chat_id = document.querySelector('.ipt-telegram-private-chat-id')?.value;
                    data.telegram_notify_add_service = document.querySelector('.cb-telegram-notification-add-service')?.checked ? 1 : 0;
                    data.telegram_notify_update_service = document.querySelector('.cb-telegram-notification-update-service')?.checked ? 1 : 0;
                    data.telegram_notify_manual_order = document.querySelector('.cb-telegram-notification-new-manual-order')?.checked ? 1 : 0;
                    data.telegram_notify_deposit = document.querySelector('.cb-telegram-notification-new-deposit')?.checked ? 1 : 0;
                } else if (key === 'google_analytics_status') {
                    data.google_analytics_id = document.querySelector('.ipt-google-analytics-id')?.value;
                } else if (key === 'module_crisp_chat') {
                    data.crisp_chat_id = document.querySelector('.ipt-crisp-chat-id')?.value;
                } else if (key === 'google_oauth_status') {
                    data.google_oauth_client_id = document.querySelector('.ipt-google-oauth-client-id')?.value;
                    data.google_oauth_client_secret = document.querySelector('.ipt-google-oauth-client-secret')?.value;
                } else if (key === 'fake_order_status') {
                    const min = parseInt(document.querySelector('.ipt-fake-order-step-min')?.value) || 1;
                    const max = parseInt(document.querySelector('.ipt-fake-order-step-max')?.value) || 100;
                    data.fake_order_step_min = Math.min(min, max);
                    data.fake_order_step_max = Math.max(min, max);
                }

                showFullScreenLoader();
                fetch('{{ route("admin.settings.modules.config") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ module: key, data: data })
                })
                .then(r => r.json())
                .then(res => {
                    hideFullScreenLoader();
                    showToast(res.message, res.success ? 'success' : 'error');
                    if (res.success) {
                        bootstrap.Modal.getInstance(document.getElementById('modal-config-module'))?.hide();
                    }
                })
                .catch(() => {
                    hideFullScreenLoader();
                    showToast('Có lỗi xảy ra', 'error');
                });
            },

            addKeywordKeepCancelOrders(value = '') {
                const div = document.querySelector('.div-keyword');
                const row = document.createElement('div');
                row.className = 'input-group input-group-solid mb-2';

                const input = document.createElement('input');
                input.type = 'text';
                input.className = 'form-control form-control-sm kw-input';
                input.placeholder = 'Nhập từ khóa lỗi...';
                input.value = value;
                input.addEventListener('input', _settings.on.click.updateKeywordCount);

                const btn = document.createElement('span');
                btn.className = 'input-group-text bg-danger cursor-pointer';
                btn.innerHTML = '<i class="fa-solid fa-xmark text-white"></i>';
                btn.addEventListener('click', () => _settings.on.click.deleteKeywordKeepCancelOrders(btn));

                row.appendChild(input);
                row.appendChild(btn);
                div.appendChild(row);
                _settings.on.click.updateKeywordCount();
            },

            loadKeywordsKeepCancelOrders() {
                const div = document.querySelector('.div-keyword');
                div.innerHTML = '';
                try {
                    const raw = document.getElementById('keep-keywords-data')?.textContent?.trim();
                    const keywords = raw ? JSON.parse(raw) : [];
                    keywords.forEach(kw => _settings.on.click.addKeywordKeepCancelOrders(kw));
                } catch(e) {}
                if (!div.children.length) _settings.on.click.addKeywordKeepCancelOrders();
                _settings.on.click.updateKeywordCount();
            },

            updateKeywordCount() {},

            deleteKeywordKeepCancelOrders(el) {
                el?.closest('.input-group')?.remove();
                _settings.on.click.updateKeywordCount();
            }
        }
    }
};

document.addEventListener('DOMContentLoaded', () => _settings.init());
</script>

{{-- Modal hướng dẫn Telegram --}}
<div class="modal fade" id="modal-user-telegram-bot" tabindex="-1" style="z-index:1060">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-brands fa-telegram text-primary me-2"></i>Hướng dẫn cấu hình Telegram Bot</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark fs-4"></i>
                </div>
            </div>
            <div class="modal-body">
                <style>
                    #modal-user-telegram-bot ul li,
                    #modal-user-telegram-bot ol li { margin: 10px 0; }
                </style>
                <h5 class="text-success">Requirements</h5>
                <ul>
                    <li>a Telegram bot</li>
                    <li>a Telegram API access token</li>
                    <li>a Telegram chat ID</li>
                </ul>
                <h5 class="text-success">Create a Telegram bot</h5>
                <ol>
                    <li>Search for the <span class="text-danger fw-bold">@BotFather</span> username in your Telegram application</li>
                    <li>Click <span class="text-danger fw-bold">Start</span> to begin a conversation with <span class="text-danger fw-bold">@BotFather</span></li>
                    <li>Send <span class="text-danger fw-bold">/newbot</span> to <span class="text-danger fw-bold">@BotFather</span>. @BotFather will respond:
                        <div class="bg-light p-3 border rounded my-2">Alright, a new bot. How are we going to call it? Please choose a name for your bot.</div>
                    </li>
                    <li>Send your bot's name to <span class="text-danger fw-bold">@BotFather</span>.
                        <div class="bg-light p-3 border rounded my-2">Note that this is not your bot's Telegram <span class="text-danger fw-bold">@username</span>. You will create the username in step 5.</div>
                    </li>
                    <li>Send your bot's username — <span class="text-danger fw-bold">@BotFather</span> will respond with your <strong>API access token</strong>:
                        <div class="bg-light p-3 border rounded my-2">
                            Use this token to access the HTTP API:<br>
                            <span class="text-danger fw-bold">&lt;API-access-token&gt;</span>
                        </div>
                    </li>
                    <li>Click the <span class="text-danger fw-bold">t.me/&lt;bot-username&gt;</span> link and click <span class="text-danger fw-bold">Start</span></li>
                </ol>
                <h5 class="text-success">Get a Telegram API access token</h5>
                <p>Token được gửi khi tạo bot. Nếu mất, gửi <span class="text-danger fw-bold">/token</span> cho <span class="text-danger fw-bold">@BotFather</span> để lấy lại.</p>
                <h5 class="text-success">Get your Telegram chat ID</h5>
                <ol>
                    <li>Mở trình duyệt, truy cập:
                        <div class="bg-light p-3 border rounded my-2">
                            <code>https://api.telegram.org/bot&lt;API-access-token&gt;/getUpdates?offset=0</code>
                        </div>
                    </li>
                    <li>Gửi một tin nhắn bất kỳ cho bot trong Telegram</li>
                    <li>Refresh trình duyệt và tìm <span class="text-danger fw-bold">id</span> trong object <span class="text-danger fw-bold">chat</span>:
                        <div class="bg-light p-3 border rounded my-2">
<pre class="m-0 fs-8">{
  "ok": true,
  "result": [{
    "message": {
      "chat": {
        "id": 123456789,
        "type": "private"
      },
      "text": "hi"
    }
  }]
}</pre>
                        </div>
                    </li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

@endsection
