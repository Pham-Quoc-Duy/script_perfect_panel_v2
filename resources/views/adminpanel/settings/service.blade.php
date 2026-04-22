@extends('adminpanel.layouts.app')
@section('title', 'Settings')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">

        @include('adminpanel.settings.partials.header')

        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2" data-lang="Service">Dịch vụ</h3>
            <div class="d-flex flex-wrap my-2">
                <button class="btn btn-primary btn-sm" data-lang="button::Update"
                    onclick="_settings.on.click.updateSetting({
                        'enable_services'              : document.querySelector('.cb-enable-services').checked,
                        'service_allow_report'         : document.querySelector('.cb-enable-service-allow-report').checked,
                        'service_require_login'        : document.querySelector('.cb-enable-service-require-login').checked,
                        'service_average_time'         : document.querySelector('.cb-enable-service-average-time').checked,
                        'require_confirm_service'      : document.querySelector('.cb-require-confirm-service').checked,
                        'check_duplicate_order_status' : document.querySelector('.cb-check-duplicate-order').checked,
                        'check_duplicate_order_time'   : document.querySelector('.ipt-check-duplicate-order-time').value.trim()
                    })">Cập nhật</button>
            </div>
        </div>

        <div class="row g-6">
    <div class="col-xl-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div>
                    <div class="form-check form-switch form-check-custom form-check-solid me-10">
                        <input class="form-check-input cb-enable-services" type="checkbox"
                            {{ ($config->enable_services ?? true) ? 'checked' : '' }}
                            onchange="document.querySelector('.div-enable-services').style.display = this.checked ? '' : 'none';">
                        <label class="form-check-label text-gray-900" data-lang="Enable sell services">Bật bán dịch vụ</label>
                    </div>
                </div>
                <div class="div-enable-services" style="{{ ($config->enable_services ?? true) ? '' : 'display:none' }}">
                    <div class="my-5">
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <input class="form-check-input cb-enable-service-allow-report" type="checkbox"
                                {{ ($config->service_allow_report ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label text-gray-900" data-lang="Allow to report orders">Cho phép khách hàng báo cáo đơn hàng</label>
                        </div>
                    </div>
                    <div class="my-5">
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <input class="form-check-input cb-enable-service-require-login" type="checkbox"
                                {{ ($config->service_require_login ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label text-gray-900" data-lang="Login is required to view the list of services">Yêu cầu đăng nhập để xem được danh sách dịch vụ</label>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <input class="form-check-input cb-enable-service-average-time" type="checkbox"
                                {{ ($config->service_average_time ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label text-gray-900" data-lang="Show average time in the list of services">Hiển thị thời gian trung bình xử lí đơn hàng ở danh sách dịch vụ</label>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <input class="form-check-input cb-require-confirm-service" type="checkbox"
                                {{ ($config->require_confirm_service ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label text-gray-900" data-lang="Require users to confirm new rate when have changed the rate">Yêu cầu người dùng xác nhận giá bán mới khi đã thay đổi giá</label>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <input class="form-check-input cb-check-duplicate-order" type="checkbox"
                                {{ ($config->check_duplicate_order_status ?? true) ? 'checked' : '' }}
                                onchange="document.querySelector('.div-check-duplicate-order').style.display = this.checked ? '' : 'none';">
                            <label class="form-check-label text-gray-900" data-lang="Check duplicate order">Kiểm tra đơn hàng trùng lặp</label>
                        </div>
                    </div>
                    <div class="div-check-duplicate-order" style="{{ ($config->check_duplicate_order_status ?? true) ? '' : 'display:none' }}">
                        <label class="form-label text-gray-700" data-lang="Time to check duplicate order">Thời gian kiểm tra đơn hàng trùng lặp</label>
                        <div class="input-group">
                            <div class="input-group-text" data-lang="seconds">giây</div>
                            <input type="number" class="form-control ipt-check-duplicate-order-time"
                                value="{{ $config->check_duplicate_order_time ?? 1 }}" min="0"
                                data-inputmask="'mask': '9', 'repeat': 2, 'greedy' : false">
                        </div>
                        <span class="text-muted" data-lang="note-check-duplicate">Điền 0 để kiểm tra đơn hàng trùng lặp ĐANG CHẠY toàn thời gian</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>

    <script>
        if (typeof _settings === 'undefined') {
            var _settings = { on: { click: {} } };
        }
        _settings.on.click.updateSetting = function(data) {
            showFullScreenLoader('', 'body');
            // Convert boolean values
            Object.keys(data).forEach(function(k) {
                if (typeof data[k] === 'boolean') data[k] = data[k] ? 1 : 0;
            });
            fetch('{{ route("admin.settings.update.service") }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(function(r) { return r.json().then(function(d) { return { ok: r.ok, data: d }; }); })
            .then(function(res) {
                hideFullScreenLoader();
                showToast(res.data.message || (res.ok ? 'Cập nhật thành công' : 'Có lỗi xảy ra'), res.ok ? 'success' : 'error');
            })
            .catch(function() {
                hideFullScreenLoader();
                showToast('Có lỗi xảy ra', 'error');
            });
        };
    </script>
@endsection
