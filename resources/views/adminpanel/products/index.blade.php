@extends('adminpanel.layouts.app')
@section('title', 'Products')
@section('content')
    <div class="content flex-row-fluid" id="kt_content"><span class="title d-none">List</span>
        <div class="row mb-6">
            <div class="col-lg-12">
                <a class="btn btn-primary btn-sm me-3" href="/admin/products/add">
                    <span data-lang="menu::Add product">Thêm sản phẩm</span>
                </a>
                <a class="btn btn-info btn-sm me-3" href="javascript:;" onclick="_products.on.click.showModalAddCategory()">
                    <span data-lang="button::Add category">Thêm danh mục</span>
                </a>
                <a class="btn btn-info btn-sm" href="javascript:;" onclick="_products.on.click.showModalAddGroup()">
                    <span data-lang="Add group">Thêm nhóm</span>
                </a>
            </div>
        </div>

        <div class="row mb-6">
            <div class="col-lg-6 col-12">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control ipt-keyword" placeholder="ID hoặc tên"
                        data-lang="ID or Name"
                        onkeydown="if(event.key==='Enter') _products.on.click.filter(this.value.trim())">
                    <button class="btn btn-primary btn-sm btn-icon px-4" type="button"
                        onclick="_products.on.click.filter(document.querySelector('.ipt-keyword').value.trim())">
                        <i class="las la-search fs-2"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="mb-5 text-muted text-end pointer"
            onclick="_products.on.click.collapseAll(this.querySelector('i'), this.querySelector('i').className.includes('expand'))">
            <span class="fst-italic" data-lang="Collapse all to modify categories">Thu gọn tất cả để chỉnh sửa danh mục</span>
            <i class="bi bi-arrows-collapse ms-2"></i>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-7 gy-1 gs-5 mb-0" id="table-category">
                        @forelse ($categories as $cat)
                            @php $count = $cat->products->count(); @endphp
                            <tbody class="tbody-{{ $cat->id }} sort-product" data-cat-id="{{ $cat->id }}">
                                {{-- Category header row --}}
                                <tr class="bg-secondary row-{{ $cat->id }} tr-cat" data-cat-id="{{ $cat->id }}">
                                    <td colspan="8" class="py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 fs-5 fw-bolder {{ $cat->status ? '' : 'text-muted' }}">
                                                <i class="fas fa-bars icon-sort-category me-3" style="display:none;"></i>
                                                {{ $cat->name }}
                                                @if (!$cat->status)
                                                    <span class="badge badge-light-danger ms-2 fs-8" data-lang="Inactive">Inactive</span>
                                                @endif
                                                <a href="javascript:;"
                                                    onclick="_products.on.click.showModalUpdateCategory({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ $cat->status ? 'Active' : 'Inactive' }}')"
                                                    style="display:none;" class="a-update-category">
                                                    <i class="bi bi-pencil fs-8 ms-2"></i>
                                                </a>
                                            </div>
                                            @if ($count > 0)
                                                <div data-status="Hide" class="text-end fs-8 show-hide pointer"
                                                    style="border-bottom: 0.5px dashed"
                                                    onclick="_products.on.click.collapse(this, this.getAttribute('data-status'), {{ $cat->id }})">
                                                    <span class="show-hide-text" data-lang="Hide">Ẩn</span> ({{ $count }})
                                                </div>
                                            @else
                                                <div class="text-end fs-8 text-muted">(0)</div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                {{-- Product rows --}}
                                @foreach ($cat->products as $product)
                                    @php
                                        $statusClass = match($product->status) {
                                            'In stock'     => 'text-success',
                                            'Out of stock' => 'text-warning',
                                            default        => 'text-danger',
                                        };
                                        $statusLabel = match($product->status) {
                                            'In stock'     => 'In stock',
                                            'Out of stock' => 'Out of stock',
                                            default        => 'Inactive',
                                        };
                                    @endphp
                                    <tr data-id="{{ $product->id }}" class="fs-7 tr-product">
                                        <td width="1"><i class="fas fa-bars"></i></td>
                                        <td class="fw-bolder ls-1">{{ $product->id }}</td>
                                        <td class="fs-7 text-muted">
                                            @if ($product->group)
                                                <span class="badge badge-light-info">{{ $product->group->name }}</span>
                                                @if ($product->group_tag)
                                                    <span class="ms-1 text-muted">{{ $product->group_tag }}</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="fs-7">
                                            @if ($product->type === 'Api')
                                                <i class="bi bi-cloud-fill fs-4 text-primary" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="API"></i>
                                            @else
                                                <i class="bi bi-hand-index-fill fs-4" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Manual"></i>
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <div class="m-0">
                                                <span class="d-block">
                                                    {{ rtrim(rtrim($product->price, '0'), '.') }} -
                                                    {{ rtrim(rtrim($product->price_1, '0'), '.') }} -
                                                    {{ rtrim(rtrim($product->price_2, '0'), '.') }}
                                                </span>
                                                <span class="fs-7 text-muted">
                                                    <span data-lang="Cost rate">Vốn</span>: {{ rtrim(rtrim($product->cost_price, '0'), '.') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-bold {{ $statusClass }}" data-lang="{{ $statusLabel }}">{{ $statusLabel }}</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="/admin/products/edit?id={{ $product->id }}" class="me-2"
                                                data-bs-toggle="tooltip" title="Sửa">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="javascript:;" onclick="_products.on.click.copyProduct({{ $product->id }});"
                                                data-bs-toggle="tooltip" title="Clone">
                                                <i class="bi bi-clipboard"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @empty
                            <tbody>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-5" data-lang="No products">Chưa có danh mục nào</td>
                                </tr>
                            </tbody>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>

        {{-- Modal: Thêm danh mục --}}
        <div class="modal fade" tabindex="-1" id="modal-category" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" data-lang="Add category">Thêm danh mục</h4>
                    </div>
                    <div class="modal-body">
                        <div class="mb-5">
                            <label class="required form-label" data-lang="Name">Tên</label>
                            <input type="text" class="form-control form-control-solid ipt-cat-name">
                        </div>
                        <div class="form-check form-switch form-check-custom">
                            <input class="form-check-input h-20px w-30px cb-cat-status" type="checkbox" checked>
                            <label class="form-check-label" data-lang="Active">Kích hoạt</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal" data-lang="button::Close">Đóng</button>
                        <button type="button" class="btn btn-primary btn-sm" onclick="_products.on.click.addCategory()" data-lang="button::Add">Thêm</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal: Thêm nhóm --}}
        <div class="modal fade" tabindex="-1" id="modal-group" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" data-lang="Add group">Thêm nhóm</h4>
                    </div>
                    <div class="modal-body">
                        <label class="required form-label" data-lang="Name">Tên</label>
                        <input type="text" class="form-control form-control-solid ipt-group-name">
                        <p class="fst-italic text-muted mt-2 mb-0" data-lang="product-group-desc">* Dùng để nhóm các sản phẩm cùng nội dung, khác tùy chọn nhỏ. Ví dụ: Netflix 1 ngày, 14 ngày, 1 tháng.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal" data-lang="button::Close">Đóng</button>
                        <button type="button" class="btn btn-primary btn-sm"
                            onclick="_products.on.click.addGroup(document.querySelector('.ipt-group-name').value.trim())" data-lang="button::Add">Thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        var _products = {
            on: {
                click: {
                    showModalAddCategory: function () {
                        document.querySelector('#modal-category .ipt-cat-name').value = '';
                        document.querySelector('#modal-category .cb-cat-status').checked = true;
                        new bootstrap.Modal(document.getElementById('modal-category')).show();
                    },
                    showModalAddGroup: function () {
                        document.querySelector('.ipt-group-name').value = '';
                        new bootstrap.Modal(document.getElementById('modal-group')).show();
                    },
                    addCategory: function () {
                        var name   = document.querySelector('#modal-category .ipt-cat-name').value.trim();
                        var status = document.querySelector('#modal-category .cb-cat-status').checked;
                        if (!name) { alert('Vui lòng nhập tên danh mục'); return; }

                        bootstrap.Modal.getInstance(document.getElementById('modal-category')).hide();
                        if (typeof showFullScreenLoader === 'function') showFullScreenLoader('', 'body');

                        fetch('{{ route("admin.products.category.store") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ name: name, status: status ? 1 : 0 })
                        })
                        .then(function (r) { return r.json(); })
                        .then(function (res) {
                            if (res.success) {
                                location.reload();
                            } else {
                                if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                            }
                        })
                        .catch(function () {
                            if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                        });
                    },
                    addGroup: function (name) {
                        if (!name) { alert('Vui lòng nhập tên nhóm'); return; }

                        bootstrap.Modal.getInstance(document.getElementById('modal-group')).hide();
                        if (typeof showFullScreenLoader === 'function') showFullScreenLoader('', 'body');

                        fetch('{{ route("admin.products.group.store") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ name: name })
                        })
                        .then(function (r) { return r.json(); })
                        .then(function (res) {
                            if (res.success) {
                                location.reload();
                            } else {
                                if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                            }
                        })
                        .catch(function () {
                            if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                        });
                    },
                    showModalUpdateCategory: function (id, name, status) {},
                    copyProduct: function (id) {},

                    filter: function (keyword) {
                        var kw = keyword.toLowerCase().trim();
                        document.querySelectorAll('.sort-product').forEach(function (tbody) {
                            var rows = tbody.querySelectorAll('.tr-product');
                            var visible = 0;
                            rows.forEach(function (row) {
                                var id   = (row.getAttribute('data-id') || '').toLowerCase();
                                var name = (row.querySelector('td:nth-child(5)') || {}).textContent || '';
                                var match = !kw || id.includes(kw) || name.toLowerCase().includes(kw);
                                row.style.display = match ? '' : 'none';
                                if (match) visible++;
                            });
                            var toggle = tbody.querySelector('.show-hide');
                            if (toggle) {
                                toggle.innerHTML = toggle.innerHTML.replace(/\(\d+\)/, '(' + visible + ')');
                                var t = toggle.querySelector('.show-hide-text');
                                if (kw && visible > 0) {
                                    toggle.setAttribute('data-status', 'Hide');
                                    if (t) t.textContent = 'Ẩn';
                                } else if (kw && visible === 0) {
                                    toggle.setAttribute('data-status', 'Show');
                                    if (t) t.textContent = 'Hiện';
                                }
                            }
                        });
                    },

                    collapse: function (el, status, catId) {
                        var rows = document.querySelectorAll('.tbody-' + catId + ' .tr-product');
                        var t = el.querySelector('.show-hide-text');
                        if (status === 'Hide') {
                            rows.forEach(function (r) { r.style.display = 'none'; });
                            el.setAttribute('data-status', 'Show');
                            if (t) t.textContent = 'Hiện';
                        } else {
                            rows.forEach(function (r) { r.style.display = ''; });
                            el.setAttribute('data-status', 'Hide');
                            if (t) t.textContent = 'Ẩn';
                        }
                    },

                    collapseAll: function (icon, isExpand) {
                        var allRows    = document.querySelectorAll('.tr-product');
                        var allToggles = document.querySelectorAll('.show-hide');
                        if (isExpand) {
                            allRows.forEach(function (r) { r.style.display = 'none'; });
                            allToggles.forEach(function (el) {
                                el.setAttribute('data-status', 'Show');
                                var t = el.querySelector('.show-hide-text');
                                if (t) t.textContent = 'Hiện';
                            });
                            icon.className = icon.className.replace('bi-arrows-expand', 'bi-arrows-collapse');
                        } else {
                            allRows.forEach(function (r) { r.style.display = ''; });
                            allToggles.forEach(function (el) {
                                el.setAttribute('data-status', 'Hide');
                                var t = el.querySelector('.show-hide-text');
                                if (t) t.textContent = 'Ẩn';
                            });
                            icon.className = icon.className.replace('bi-arrows-collapse', 'bi-arrows-expand');
                        }
                    }
                }
            }
        };

        // ── Sortable: kéo thả sản phẩm trong từng danh mục ──────────
        document.querySelectorAll('.sort-product').forEach(function (tbody) {
            Sortable.create(tbody, {
                handle: '.tr-product td:first-child',
                draggable: '.tr-product',
                animation: 150,
                onEnd: function () {
                    var catId = tbody.getAttribute('data-cat-id');
                    var ids = [];
                    tbody.querySelectorAll('.tr-product').forEach(function (row, i) {
                        ids.push({ id: parseInt(row.getAttribute('data-id')), position: i + 1 });
                    });
                    fetch('{{ route("admin.products.reorder") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ items: ids, type: 'product' })
                    });
                }
            });
        });

        // ── Sortable: kéo thả danh mục (tbody rows) ─────────────────
        var table = document.getElementById('table-category');
        if (table) {
            Sortable.create(table, {
                handle: '.icon-sort-category',
                draggable: 'tbody',
                animation: 150,
                onEnd: function () {
                    var ids = [];
                    table.querySelectorAll('tbody[data-cat-id]').forEach(function (tbody, i) {
                        ids.push({ id: parseInt(tbody.getAttribute('data-cat-id')), position: i + 1 });
                    });
                    fetch('{{ route("admin.products.reorder") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ items: ids, type: 'category' })
                    });
                }
            });
        }
    </script>
@endsection
