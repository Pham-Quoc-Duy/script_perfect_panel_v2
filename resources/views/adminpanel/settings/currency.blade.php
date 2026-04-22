@extends('adminpanel.layouts.app')
@section('title', 'Settings')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">

        @include('adminpanel.settings.partials.header')

        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2" data-lang="">Tiền tệ</h3>
            <div class="d-flex flex-wrap my-2 gap-2">
                <button class="btn btn-primary btn-sm" data-lang="button::Update" onclick="updateCurrency()">Cập nhật</button>
                <button class="btn btn-info btn-sm" data-lang="button::Data" onclick="showCurrencyData()">Dữ liệu</button>
            </div>
        </div>
        <div class="fst-italic fs-7 text-gray-800 mb-3">
            * <span data-lang="Last synced">Đồng bộ lần cuối</span>: <span
                class="fw-bold">{{ now()->format('Y-m-d H:i:s') }}</span>
            <br>
            <small class="text-warning">Nếu không có tiền tệ nào, vui lòng click nút "Cập nhật" để tải dữ liệu từ
                API</small>
        </div>

        <div class="row g-6">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-body p -0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle table-row-dashed fs-7 gy-2 gs-5"
                                id="table-currency">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th><span data-lang="Currency">Tiền tệ</span> <input type="text"
                                                class="form-control form-control-solid form-control-flush ms-3"
                                                placeholder="Tìm kiếm ..." onkeyup="searchCurrency(this.value)"
                                                data-lang="Search..."></th>
                                        <th data-lang="Sync?" width="10%">Đồng bộ</th>
                                        <th class="text-end" data-lang="Rate">Tỉ giá</th>
                                        <th class="text-end"></th>
                                    </tr>
                                    <tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($currency_settings as $currency)
                                        <tr class="currency-{{ $currency->id }} currency-row" data-id="{{ $currency->id }}"
                                            data-symbol="{{ $currency->code }}"
                                            data-searchtext="{{ strtolower($currency->code . ' ' . $currency->name) }}">
                                            <td class="fw-bold">{{ $currency->code }} - {{ $currency->name }}</td>
                                            <td width="1">
                                                <div class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input h-20px w-30px sync-checkbox"
                                                        type="checkbox" id="sync-{{ $currency->id }}"
                                                        data-currency-id="{{ $currency->id }}"
                                                        {{ $currency->sync ? 'checked' : '' }}
                                                        onchange="syncCurrency(this)">
                                                </div>
                                            </td>
                                            <td class="text-end px-1" width="20%">
                                                <input type="text"
                                                    class="form-control form-control-solid text-end py-0 exchange-rate-input"
                                                    value="{{ rtrim(rtrim(number_format((float) $currency->exchange_rate, 8), '0'), '.') }}"
                                                    {{ $currency->sync ? 'disabled' : '' }}>
                                            </td>
                                            <td width="1">
                                                <div class="form-check form-check-custom form-check-solid"
                                                    data-bs-custom-class="tooltip-dark" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    aria-label="Đồng bộ tỷ giá của phương thức thanh toán"
                                                    data-bs-original-title="Đồng bộ tỷ giá của phương thức thanh toán">
                                                    <input class="form-check-input h-15px w-15px" type="checkbox">
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-5">
                                                Không có tiền tệ nào. Vui lòng cập nhật từ API.
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
@endsection

<script>
    const API_ENDPOINT = '{{ route('admin.settings.update.currency_settings') }}';

    function searchCurrency(searchText) {
        const rows = document.querySelectorAll('.currency-row');
        const searchLower = searchText.toLowerCase();
        rows.forEach(row => {
            row.style.display = row.getAttribute('data-searchtext').includes(searchLower) ? '' : 'none';
        });
    }

    function collectCurrencyData() {
        const currencies = {};
        document.querySelectorAll('.currency-row').forEach(row => {
            const currencyId = row.getAttribute('data-id');
            const syncCheckbox = row.querySelector('.sync-checkbox');
            const rateInput = row.querySelector('.exchange-rate-input');
            
            currencies[currencyId] = {
                sync: syncCheckbox.checked,
                exchange_rate: rateInput.disabled ? null : rateInput.value
            };
        });
        return currencies;
    }

    function updateCurrency() {
        showFullScreenLoader();
        const currencies = collectCurrencyData();

        fetch(API_ENDPOINT, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ currencies })
        })
        .then(response => response.json())
        .then(result => {
            hideFullScreenLoader();
            showToast(result.message || 'Cập nhật thành công', result.success ? 'success' : 'error');
            if (result.success) setTimeout(() => location.reload(), 1500);
        })
        .catch(error => {
            hideFullScreenLoader();
            console.error('Update error:', error);
            showToast('Có lỗi xảy ra: ' + error.message, 'error');
        });
    }

    function syncCurrency(checkbox) {
        const row = checkbox.closest('.currency-row');
        const currencyId = row.getAttribute('data-id');
        const input = row.querySelector('.exchange-rate-input');
        
        input.disabled = checkbox.checked;
        if (checkbox.checked) input.value = '';
        
        // Auto-save sync change
        const currencies = {};
        currencies[currencyId] = {
            sync: checkbox.checked,
            exchange_rate: null
        };
        
        fetch(API_ENDPOINT, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ currencies })
        })
        .then(response => response.json())
        .then(result => {
            if (!result.success) {
                checkbox.checked = !checkbox.checked;
                input.disabled = !input.disabled;
                showToast('Lỗi: ' + result.message, 'error');
            }
        })
        .catch(error => {
            checkbox.checked = !checkbox.checked;
            input.disabled = !input.disabled;
            console.error('Sync error:', error);
        });
    }

    function showCurrencyData() {
        showFullScreenLoader();
        
        fetch(API_ENDPOINT, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ action: 'fetch' })
        })
        .then(response => response.json())
        .then(result => {
            hideFullScreenLoader();
            showToast(result.message || 'Cập nhật dữ liệu thành công', result.success ? 'success' : 'error');
            if (result.success) {
                console.log('Currency Data:', result.data);
                setTimeout(() => location.reload(), 1500);
            }
        })
        .catch(error => {
            hideFullScreenLoader();
            console.error('Fetch error:', error);
            showToast('Có lỗi xảy ra: ' + error.message, 'error');
        });
    }
</script>
