@extends('adminpanel.layouts.app')
@section('title', 'Products')
@section('content')
    <div class="content flex-row-fluid" id="kt_content"><span class="title d-none">Add</span>

        {{-- Card 1: Thông tin cơ bản --}}
        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <div class="row g-5 mb-5">
                    {{-- Dạng kết nối --}}
                    <div class="col-lg-2">
                        <label class="required form-label">Dạng kết nối</label>
                        <select class="form-select form-select-solid sl-product-add-type"
                            data-kt-select2="true" data-placeholder="Chọn" data-hide-search="true"
                            tabindex="-1" aria-hidden="true"
                            onchange="_products.on.change.addType(this.value)">
                            <option value="Manual">Thủ công</option>
                            <option value="Api">API</option>
                        </select>
                    </div>

                    {{-- Nhà cung cấp (API) / Giá vốn (Manual) --}}
                    <div class="col-lg-10">
                        <div class="div-add-type div-add-type-api" style="display:none;">
                            <div class="row g-5">
                                <div class="col-lg-3">
                                    <label class="required form-label">Nhà cung cấp</label>
                                    <select class="form-select form-select-solid sl-provider"
                                        data-kt-select2="true" data-placeholder="Chọn" data-allow-clear="false"
                                        tabindex="-1" aria-hidden="true"
                                        onchange="_products.on.change.provider(this.value)">
                                        <option></option>
                                        @foreach ($providers as $prov)
                                            <option value="{{ $prov->id }}"
                                                data-rate="{{ $prov->rate_api ?? 1 }}"
                                                data-fixed-decimal="{{ $prov->fixed_decimal ?? 10 }}">
                                                {{ $prov->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-9 div-provider-product" style="display:none;">
                                    <label class="required form-label">Sản phẩm</label>
                                    <select class="form-select form-select-solid sl-provider-pid"
                                        data-kt-select2="true" data-placeholder="Chọn sản phẩm" data-allow-clear="false"
                                        tabindex="-1" aria-hidden="true"
                                        onchange="_products.on.change.providerProduct(this.value)">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="div-add-type div-add-type-manual">
                            <label class="required form-label">Giá vốn</label>
                            <input type="number" class="form-control form-control-solid ipt-cost-price"
                                onkeyup="_products.on.keyup.costPrice(this.value)">
                        </div>
                    </div>

                    {{-- Trạng thái --}}
                    <div class="col-lg-3">
                        <label class="required form-label">Trạng thái</label>
                        <select class="form-select form-select-solid sl-status"
                            data-kt-select2="true" data-placeholder="Chọn" data-hide-search="true"
                            tabindex="-1" aria-hidden="true">
                            <option value="In stock">Còn hàng</option>
                            <option value="Out of stock">Hết hàng</option>
                            <option value="Inactive">Vô hiệu hóa</option>
                        </select>
                    </div>
                </div>

                {{-- Tên sản phẩm --}}
                <div class="row g-5 mb-5">
                    <div class="col-lg-12">
                        <label class="required form-label">Tên</label>
                        <input type="text" class="form-control form-control-solid ipt-name"
                            onkeyup="document.querySelector('.ipt-slug').value = _products.slug(this.value.trim())">
                        <div class="mb-5 mt-2 d-none">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-solid ipt-slug" disabled>
                                <span class="input-group-text pointer" onclick="_products.on.click.editSlug()">
                                    <i class="fas fa-pencil"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Danh mục & Nhóm --}}
                <div class="row g-5 mb-5">
                    <div class="col-lg-4">
                        <label class="required form-label">Danh mục</label>
                        <select class="form-select form-select-solid sl-category"
                            data-kt-select2="true" data-placeholder="Chọn danh mục" data-allow-clear="false"
                            tabindex="-1" aria-hidden="true">
                            <option></option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label">Nhóm</label>
                        <select class="form-select form-select-solid sl-group"
                            data-kt-select2="true" data-placeholder="Không có nhóm" data-allow-clear="false"
                            tabindex="-1" aria-hidden="true"
                            onchange="document.querySelector('.div-group').style.display = this.value > 0 ? '' : 'none';">
                            <option value="0">Không có nhóm</option>
                            @foreach ($groups as $grp)
                                <option value="{{ $grp->id }}">{{ $grp->id }} - {{ $grp->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 div-group" style="display:none;">
                        <label class="form-label">Tên nhãn</label>
                        <input type="text" class="form-control form-control-solid ipt-group-tag"
                            placeholder="Ví dụ: 1 tháng, VIP...">
                    </div>
                </div>

                {{-- Hình ảnh --}}
                <div class="row g-5">
                    <div class="col-lg-12">
                        <label class="form-label">Hình ảnh (460x215)</label>
                        <input type="text" class="form-control form-control-solid ipt-thumbnail"
                            placeholder="Link hình ảnh"
                            onkeyup="document.querySelector('.img-preview').src = this.value">
                        <span class="text-muted fst-italic fs-8">Hình ảnh tham khảo:
                            <a href="https://cdn.whoispanel.com/product_thumbnail/" target="_blank">Truy cập</a>
                        </span>
                        <div class="mt-2">
                            <img src="" class="img-preview rounded" width="300" style="display:none;"
                                onerror="this.style.display='none'" onload="this.style.display=''">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: Giá & Số lượng --}}
        <div class="card shadow-sm mb-5">
            <div class="card-header div-add-type div-add-type-api" style="display:none;">
                <div class="card-title">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input cb-product-sync" type="checkbox"
                            onchange="_products.on.change.syncprice(this.checked)">
                        <label class="form-check-label fs-6 fw-bold">Tự động đồng bộ giá</label>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-5 mb-5">
                    <div class="col-lg-4">
                        <label class="required form-label">Giá bán lẻ</label>
                        <div class="input-group">
                            <span class="input-group-text bg-secondary">$</span>
                            <input type="number" class="form-control ipt-product-price" step="any">
                            <input type="text" class="form-control text-end ipt-product-price-percent"
                                value="110" style="max-width:70px;"
                                onkeyup="_products.on.keyup.pricePercent('price', this.value)">
                            <span class="input-group-text bg-secondary">%</span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label class="required form-label">Giá đại lý</label>
                        <div class="input-group">
                            <span class="input-group-text bg-secondary">$</span>
                            <input type="number" class="form-control ipt-product-price-1" step="any">
                            <input type="text" class="form-control text-end ipt-product-price-1-percent"
                                value="108" style="max-width:70px;"
                                onkeyup="_products.on.keyup.pricePercent('price_1', this.value)">
                            <span class="input-group-text bg-secondary">%</span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label class="required form-label">Giá nhà phân phối</label>
                        <div class="input-group">
                            <span class="input-group-text bg-secondary">$</span>
                            <input type="number" class="form-control ipt-product-price-2" step="any">
                            <input type="text" class="form-control text-end ipt-product-price-2-percent"
                                value="105" style="max-width:70px;"
                                onkeyup="_products.on.keyup.pricePercent('price_2', this.value)">
                            <span class="input-group-text bg-secondary">%</span>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-6">
                        <label class="required form-label">SL đặt hàng: Tối thiểu - Tối đa</label>
                        <div class="input-group">
                            <input type="number" class="form-control ipt-product-min" value="1" min="1">
                            <span class="input-group-text bg-secondary">-</span>
                            <input type="number" class="form-control ipt-product-max" value="1" min="1">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 3: Kiểu xử lý (Manual only) --}}
        <div class="card shadow-sm mb-5 div-add-type div-add-type-manual">
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-lg-4">
                        <label class="required form-label">Kiểu xử lý</label>
                        <select class="form-select form-select-solid sl-process-type"
                            data-kt-select2="true" data-placeholder="Chọn kiểu" data-hide-search="true"
                            tabindex="-1" aria-hidden="true">
                            <option value="key">Key / License</option>
                            <option value="account">Tài khoản</option>
                            <option value="link">Link</option>
                            <option value="file">File</option>
                            <option value="other">Khác</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="d-flex justify-content-end gap-3 mb-10">
            <a href="/admin/products" class="btn btn-light btn-sm">Hủy</a>
            <button type="button" class="btn btn-primary btn-sm" onclick="_products.on.click.save()">
                Lưu sản phẩm
            </button>
        </div>
    </div>

    <script>
        var _products = {
            slug: function (str) {
                return str.toLowerCase()
                    .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                    .replace(/đ/g, 'd').replace(/[^a-z0-9\s-]/g, '')
                    .trim().replace(/\s+/g, '-');
            },
            on: {
                change: {
                    addType: function (val) {
                        document.querySelectorAll('.div-add-type-api').forEach(function (el) {
                            el.style.display = val === 'Api' ? '' : 'none';
                        });
                        document.querySelectorAll('.div-add-type-manual').forEach(function (el) {
                            el.style.display = val === 'Manual' ? '' : 'none';
                        });
                    },
                    provider: function (val) {
                        var sl = document.querySelector('.sl-provider-pid');
                        var divProduct = document.querySelector('.div-provider-product');
                        // Reset
                        sl.innerHTML = '<option></option>';
                        if (typeof $ !== 'undefined') $(sl).trigger('change');

                        if (!val) {
                            divProduct.style.display = 'none';
                            return;
                        }

                        divProduct.style.display = '';

                        // Load services từ provider
                        fetch('/admin/api/provider/' + val + '/services', {
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                        })
                        .then(function (r) { return r.json(); })
                        .then(function (res) {
                            var services = res.data || res || [];
                            services.forEach(function (s) {
                                var opt = document.createElement('option');
                                opt.value = s.service || s.id;
                                opt.textContent = '[' + (s.service || s.id) + '] ' + (s.name || '');
                                opt.setAttribute('data-min', s.min || 0);
                                opt.setAttribute('data-max', s.max || 0);
                                opt.setAttribute('data-rate', s.rate || 0);
                                sl.appendChild(opt);
                            });
                            if (typeof $ !== 'undefined') $(sl).trigger('change');
                        })
                        .catch(function () {
                            // load failed silently
                        });
                    },
                    providerProduct: function (val) {
                        if (!val) return;
                        var opt = document.querySelector('.sl-provider-pid option[value="' + val + '"]');
                        if (!opt) return;
                        var min = opt.getAttribute('data-min');
                        var max = opt.getAttribute('data-max');
                        if (min) document.querySelector('.ipt-product-min').value = min;
                        if (max) document.querySelector('.ipt-product-max').value = max;
                    },
                    syncprice: function (checked) {}
                },
                keyup: {
                    costPrice: function (val) {
                        var cost = parseFloat(val) || 0;
                        [['ipt-product-price', 'ipt-product-price-percent'],
                         ['ipt-product-price-1', 'ipt-product-price-1-percent'],
                         ['ipt-product-price-2', 'ipt-product-price-2-percent']
                        ].forEach(function (pair) {
                            var pct = parseFloat(document.querySelector('.' + pair[1]).value) || 100;
                            document.querySelector('.' + pair[0]).value = (cost * pct / 100).toFixed(4);
                        });
                    },
                    pricePercent: function (field, val) {}
                },
                click: {
                    editSlug: function () {
                        var el = document.querySelector('.ipt-slug');
                        el.disabled = !el.disabled;
                    },
                    save: function () {
                        var type = document.querySelector('.sl-product-add-type').value;

                        var payload = {
                            type:                 type,
                            name:                 document.querySelector('.ipt-name').value.trim(),
                            slug:                 document.querySelector('.ipt-slug').value.trim(),
                            status:               document.querySelector('.sl-status').value,
                            product_category_id:  document.querySelector('.sl-category').value,
                            product_group_id:     document.querySelector('.sl-group').value || 0,
                            group_tag:            document.querySelector('.ipt-group-tag')?.value.trim() || '',
                            thumbnail:            document.querySelector('.ipt-thumbnail').value.trim(),
                            price:                document.querySelector('.ipt-product-price').value,
                            price_1:              document.querySelector('.ipt-product-price-1').value,
                            price_2:              document.querySelector('.ipt-product-price-2').value,
                            price_percent:        document.querySelector('.ipt-product-price-percent').value,
                            price_1_percent:      document.querySelector('.ipt-product-price-1-percent').value,
                            price_2_percent:      document.querySelector('.ipt-product-price-2-percent').value,
                            min:                  document.querySelector('.ipt-product-min').value,
                            max:                  document.querySelector('.ipt-product-max').value,
                        };

                        if (type === 'Manual') {
                            payload.cost_price    = document.querySelector('.ipt-cost-price').value;
                            payload.process_type  = document.querySelector('.sl-process-type').value;
                        } else {
                            payload.api_provider_id = document.querySelector('.sl-provider').value;
                            payload.api_service_id  = document.querySelector('.sl-provider-pid').value;
                            payload.sync            = document.querySelector('.cb-product-sync').checked ? 1 : 0;
                        }

                        if (!payload.name) { alert('Vui lòng nhập tên sản phẩm'); return; }
                        if (!payload.product_category_id) { alert('Vui lòng chọn danh mục'); return; }

                        if (typeof showFullScreenLoader === 'function') showFullScreenLoader('', 'body');

                        fetch('{{ route("admin.products.store") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(payload)
                        })
                        .then(function (r) { return r.json(); })
                        .then(function (res) {
                            if (res.success) {
                                window.location.href = '/admin/products';
                            } else {
                                if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                                alert(res.message || 'Có lỗi xảy ra');
                            }
                        })
                        .catch(function () {
                            if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                            alert('Có lỗi xảy ra, vui lòng thử lại');
                        });
                    }
                }
            }
        };
    </script>
@endsection
