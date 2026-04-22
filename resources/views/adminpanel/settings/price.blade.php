@extends('adminpanel.layouts.app')
@section('title', 'Settings')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        
        @include('adminpanel.settings.partials.header')
        
        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2" data-lang="Price">Giá bán</h3>
            <div class="d-flex flex-wrap my-2">
                <button class="btn btn-primary btn-sm" data-lang="button::Update"
                    onclick="updatePrice()">Cập nhật</button>
            </div>
        </div>

        <div class="row g-6">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <div class="card-title" data-lang="Percentage increase">Phần trăm tăng giá</div>
                    </div>
                    <div class="card-body">
                        <div class="mb-5 d-flex">
                            <div class="form-check form-check-custom form-check-solid me-10 form-check-danger">
                                <input class="form-check-input cb-change-price-all" type="checkbox">
                                <label class="form-check-label text-danger fw-bold text-uppercase"
                                    data-lang="Change for all current services">Thay đổi cho toàn bộ dịch vụ cũ</label>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="form-label" data-lang="Retail Price">Giá bán lẻ</label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control ipt-markup-retail text-end" value="{{ $config->markup_retail ?? '100' }}"
                                    data-inputmask="'mask': '9{1,4}.9{1,2}', 'greedy': false, 'placeholder': '0'"
                                    inputmode="text">
                                <span class="input-group-text bg-secondary">%</span>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="form-label"><span data-lang="Wholesale Price">Giá bán buôn</span> - <span data-lang="Child Panel">Đại
                                    lý</span></label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control ipt-markup-agent text-end"
                                    value="{{ $config->markup_agent ?? '100' }}"
                                    data-inputmask="'mask': '9{1,4}.9{1,2}', 'greedy': false, 'placeholder': '0'"
                                    inputmode="text">
                                <span class="input-group-text bg-secondary">%</span>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="form-label"><span data-lang="Wholesale Price">Giá bán buôn</span> - <span data-lang="Reseller">Nhà
                                    phân phối</span></label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control ipt-markup-distributor text-end"
                                    value="{{ $config->markup_distributor ?? '100' }}"
                                    data-inputmask="'mask': '9{1,4}.9{1,2}', 'greedy': false, 'placeholder': '0'"
                                    inputmode="text">
                                <span class="input-group-text bg-secondary">%</span>
                            </div>
                        </div>
                        <span class="fst-italic" data-lang="Example-price">Ví dụ : nếu giá gốc là 1$ và bạn thiết lập 150%
                            thì giá bán sẽ là 1,5$</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <div class="card-title" data-lang="Price">Hiển thị nhiều giá bán dịch vụ</div>
                    </div>
                    <div class="card-body">
                        <div class="mb-5">
                            <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                <input class="form-check-input cb-enable-show-multi-rate" type="checkbox"
                                    {{ $config->show_multi_rate ? 'checked' : '' }}
                                    onchange="document.querySelector('.div-enable-show-multi-rate').style.display = this.checked ? '' : 'none';">
                                <label class="form-check-label" data-lang="Enable">Bật</label>
                            </div>
                        </div>
                        <div class="div-enable-show-multi-rate" style="display: {{ $config->show_multi_rate ? '' : 'none' }}">
                            <div class="mb-5">
                                <label class="required form-label" data-lang="Min deposit to reach child panel rate">Số
                                    tiền nạp tối thiểu để đạt giá bán dành cho đại lý</label>
                                <input type="text"
                                    class="form-control form-control-solid ipt-min-total-deposit-childpanel"
                                    value="{{ number_format((int)($config->min_total_deposit_child_panel ?? 0)) }}" data-inputmask="'mask': '9', 'repeat': 9, 'greedy' : false"
                                    inputmode="text">
                            </div>
                            <div class="mb-5">
                                <label class="required form-label" data-lang="Min deposit to reach reseller rate">Số tiền
                                    nạp tối thiểu để đạt giá bán dành cho nhà phân phối</label>
                                <input type="text"
                                    class="form-control form-control-solid ipt-min-total-deposit-reseller" value="{{ number_format((int)($config->min_total_deposit_reseller ?? 0)) }}"
                                    data-inputmask="'mask': '9', 'repeat': 9, 'greedy' : false" inputmode="text">
                            </div>
                        </div>
                        <span class="fst-italic" data-lang="Note-showmultirate">Nhiều giá bán bao gồm giá cho bán lẻ, giá
                            cho đại lý và giá cho nhà phân phối</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
function updatePrice() {
    showFullScreenLoader();
    
    const data = {
        markup_retail: document.querySelector('.ipt-markup-retail').value,
        markup_agent: document.querySelector('.ipt-markup-agent').value,
        markup_distributor: document.querySelector('.ipt-markup-distributor').value,
        change_price_all: document.querySelector('.cb-change-price-all').checked,
        _token: '{{ csrf_token() }}'
    };
    
    // Nếu checkbox "Hiển thị nhiều giá bán dịch vụ" được checked
    const showMultiRateCheckbox = document.querySelector('.cb-enable-show-multi-rate');
    if (showMultiRateCheckbox && showMultiRateCheckbox.checked) {
        data.show_multi_rate = true;
        data.min_total_deposit_child_panel = document.querySelector('.ipt-min-total-deposit-childpanel').value;
        data.min_total_deposit_reseller = document.querySelector('.ipt-min-total-deposit-reseller').value;
    } else {
        data.show_multi_rate = false;
    }
    
    fetch('{{ route("admin.settings.update.price") }}', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        hideFullScreenLoader();
        showToast(result.message || 'Cập nhật thành công', 'success');
    })
    .catch(error => {
        hideFullScreenLoader();
        console.error('Update error:', error);
        showToast(window.tr('An error occurred!'), 'success'), 'error');
    });
}
</script>
