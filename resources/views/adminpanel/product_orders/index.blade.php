@extends('adminpanel.layouts.app')
@section('title', 'Product Orders')
@section('content')
    <style>
        .table-orders td {
            line-height: 1.5;
        }
    </style>
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card shadow">
            <div class="card-body p-5">
                <div class="mb-5 div-filter-status">
                    @php
                        $statusPathMap = [
                            '' => '',
                            'Manual' => 'manual',
                            'Awaiting' => 'awaiting',
                            'Failed' => 'failed',
                            'Pending' => 'pending',
                            'In progress' => 'inprogress',
                            'Completed' => 'completed',
                            'Partial' => 'partial',
                            'Canceled' => 'canceled',
                        ];
                        $statusBtns = [
                            '' => ['Tất cả', 'btn-outline-', 'status::All'],
                            'Manual' => ['Manual', 'btn-outline-', 'status::Manual'],
                            'Awaiting' => ['Đang chờ', 'btn-outline-secondary text-gray-500', 'status::Awaiting'],
                            'Failed' => ['Thất bại', 'btn-outline-warning', 'status::Failed'],
                            'Pending' => ['Chờ xử lý', 'btn-outline-secondary text-gray-600', 'status::Pending'],
                            'In progress' => ['Đang chạy', 'btn-outline-info', 'status::In progress'],
                            'Completed' => ['Hoàn thành', 'btn-outline-success', 'status::Completed'],
                            'Partial' => ['Hoàn tiền một phần', 'btn-outline-warning', 'status::Partial'],
                            'Canceled' => ['Hủy', 'btn-outline-danger', 'status::Canceled'],
                        ];
                        $activeStatus = isset($status) ? $status : '';
                    @endphp
                    @foreach ($statusBtns as $val => $info)
                        <a href="javascript:;"
                            class="btn btn-sm btn-outline {{ $info[1] }} px-3 py-1 me-3 {{ $activeStatus === ($statusPathMap[$val] ?? '') ? 'active' : '' }}"
                            onclick="_product_orders.on.click.filterStatus('{{ $val ?: 'All' }}')">
                            <span data-lang="{{ $info[2] }}">{{ $info[0] }}</span>
                        </a>
                    @endforeach
                </div>
                <div class="row g-3">
                    <div class="col-lg-2 col-md-6 col-6">
                        <input type="text"
                            class="form-control form-control-solid form-control-sm ipt-order-id datatable-input"
                            placeholder="Product Order ID" data-lang="Order ID" data-col-name="product_order_id"
                            value="{{ request('id') }}"
                            onkeypress="if(event.key=='Enter'){event.preventDefault();_product_orders.on.click.filter()}">
                    </div>
                    <div class="col-lg-2 col-md-6 col-6">
                        <input type="text"
                            class="form-control form-control-solid form-control-sm ipt-porder-id datatable-input"
                            placeholder="Provider Order ID" data-lang="Provider Order ID"
                            data-col-name="provider_product_order_id" value="{{ request('provider_id') }}">
                    </div>
                    <div class="col-lg-3 col-md-6 col-7">
                        <select class="form-select form-select-solid form-select-sm datatable-input"
                            data-col-name="product_id" data-control="select2" data-placeholder="All products"
                            data-lang="All products" data-allow-clear="true" data-hide-search="false">
                            <option value="" {{ empty(request('product_id')) ? 'selected' : '' }}></option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->id }} - {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-5">
                        <button type="button" class="btn btn-primary btn-sm me-2"
                            onclick="_product_orders.on.click.filter()" data-lang="Search">Tìm kiếm</button>
                        <button type="button" class="btn btn-sm btn-secondary"
                            onclick="_product_orders.on.click.resetFilter()" data-lang="Reset">Thiết lập lại</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mt-5">
            <div class="card-body p-5">
                <div class="table-responsive div-orders">
                    <table class="table fs-7 gy-1 gs-3 table-orders custom-table" style="width:100%">
                        <thead>
                            <tr class="bg-lighten d-none">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr data-note="{{ addslashes($order->note ?? '') }}">
                                    <td class="dt-control"></td>
                                    <td class="pt-2">
                                        @php
                                            $btnClass = match ($order->status) {
                                                'Completed' => 'btn-success',
                                                'In progress' => 'btn-info',
                                                'Partial' => 'btn-warning',
                                                'Pending' => 'btn-secondary',
                                                'Awaiting' => 'btn-secondary',
                                                'Manual' => 'btn-primary',
                                                'Failed' => 'btn-danger',
                                                'Canceled' => 'badge-warning',
                                                default => 'btn-secondary',
                                            };
                                        @endphp

                                        @if ($order->status === 'Canceled')
                                            {{-- Canceled: chỉ badge --}}
                                            <span class="badge badge-warning badge-sm fs-7 py-2 px-5"
                                                data-lang="status::Canceled">Hủy</span>
                                        @else
                                            <button type="button"
                                                class="btn {{ $btnClass }} btn-sm fs-7 py-1 px-2 action-{{ $order->id }}"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                                                data-lang="status::{{ $order->status }}"
                                                data-quantity="{{ $order->quantity }}">
                                                {{ $order->status }}
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                            </button>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4"
                                                data-kt-menu="true">
                                                @if (in_array($order->status, ['Pending', 'Awaiting', 'Manual', 'Failed']))
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:;"
                                                            onclick="_product_orders.on.click.changeStatus('In progress', '{{ $order->id }}')"
                                                            class="menu-link px-3" data-lang="status::In progress">Đang
                                                            chạy</a>
                                                    </div>
                                                @endif
                                                @if (!in_array($order->status, ['Completed', 'Partial']))
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:;"
                                                            onclick="_product_orders.on.click.showModalCompleted('{{ $order->id }}')"
                                                            class="menu-link px-3" data-lang="status::Completed">Hoàn
                                                            thành</a>
                                                    </div>
                                                @endif
                                                @if ($order->status === 'Completed')
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:;"
                                                            onclick="_product_orders.on.click.changeStatus('Canceled', '{{ $order->id }}')"
                                                            class="menu-link px-3" data-lang="status::Canceled">Hủy</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:;"
                                                            onclick="_product_orders.on.click.changeStatus('Partial', '{{ $order->id }}')"
                                                            class="menu-link px-3" data-lang="status::Partial">Hoàn tiền một
                                                            phần</a>
                                                    </div>
                                                @elseif (!in_array($order->status, ['Partial']))
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:;"
                                                            onclick="_product_orders.on.click.changeStatus('Canceled', '{{ $order->id }}')"
                                                            class="menu-link px-3" data-lang="status::Canceled">Hủy</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:;"
                                                            onclick="_product_orders.on.click.changeStatus('Partial', '{{ $order->id }}')"
                                                            class="menu-link px-3" data-lang="status::Partial">Hoàn tiền một
                                                            phần</a>
                                                    </div>
                                                @endif
                                                <div class="separator my-2"></div>
                                                <div class="menu-item px-3">
                                                    <a href="javascript:;"
                                                        onclick="_product_orders.on.click.addNote('{{ $order->id }}')"
                                                        class="menu-link px-3" data-lang="Add Note">Thêm ghi chú</a>
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-1 fs-7">
                                                @if ($order->note)
                                                    <a href="javascript:;"
                                                        onclick="_product_orders.on.click.result({{ $order->id }})"
                                                        data-lang="Result">Result</a>
                                                @endif
                                            </p>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="m-0 fw-bolder ls-1">{{ $order->id }}</p>
                                        @if ($order->provider_product_order_id)
                                            <p class="m-0 fs-8 text-gray-600">{{ $order->provider_product_order_id }}</p>
                                        @endif
                                        <p class="m-0 fs-8 text-gray-600">{{ $order->created_at->format('Y-m-d H:i:s') }}
                                        </p>
                                        <p class="m-0 fs-8 text-gray-600">{{ $order->updated_at->format('Y-m-d H:i:s') }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="m-0">
                                            <span class="text-gray-600 fs-8" data-lang="Charge">Số tiền:</span>
                                            <span class="fw-bold">{{ number_format($order->amount) }}</span>
                                            ({{ number_format($order->charge) }})
                                        </p>
                                        <p class="m-0">
                                            <span class="text-gray-600 fs-8" data-lang="Quantity">Số lượng:</span>
                                            {{ $order->quantity }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="m-0">
                                            {{ $order->product ? $order->product->id . ' - ' . $order->product->name : 'N/A' }}
                                        </p>
                                        <p class="m-0 fs-8">
                                            <a class="text-gray-700 ls-1" target="_blank"
                                                href="/admin/accounts/{{ $order->user->username ?? '' }}">
                                                {{ $order->user->username ?? 'N/A' }}
                                            </a>
                                        </p>
                                        <p class="m-0 fs-8">
                                            <a href="javascript:;"
                                                onclick="_product_orders.on.click.require({{ $order->id }})"
                                                data-lang="button::Require">Yêu cầu</a>
                                        </p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-10" data-lang="No orders">Không
                                        có đơn hàng nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5 d-flex align-items-center">
                        <div class="text-muted fs-8">
                            <span data-lang="Showing">Hiển thị</span>
                            {{ $orders->firstItem() ?? 0 }} - {{ $orders->lastItem() ?? 0 }} /
                            {{ $orders->total() }}
                        </div>
                    </div>
                    <div class="col-md-7 d-flex justify-content-end">
                        {{ $orders->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal xem yêu cầu order --}}
    <div class="modal fade" tabindex="-1" id="modal-change-service-combo">
        <div class="modal-dialog modal-dialog-centered mw-600px">
            <div class="modal-content">
                <div class="modal-header py-3">
                    <h5 class="modal-title" data-lang="button::Require">Yêu cầu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modal-require-body">
                    <p class="text-muted text-center py-5 mb-0" data-lang="No require data found">No require data found</p>
                </div>
                <div class="modal-footer py-3">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal" data-lang="button::Close">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var _product_orders = (function() {
            var currentOrderId = null;

            return {
                on: {
                    click: {
                        filterStatus: function(status) {
                            if (typeof showFullScreenLoader === 'function') showFullScreenLoader(window.tr(
                                'Loading...'), 'body');

                            var statusPathMap = {
                                'All': '',
                                'Manual': 'manual',
                                'Awaiting': 'awaiting',
                                'Failed': 'failed',
                                'Pending': 'pending',
                                'In progress': 'inprogress',
                                'Completed': 'completed',
                                'Partial': 'partial',
                                'Canceled': 'canceled'
                            };
                            var statusPath = statusPathMap[status] || '';
                            var newUrl = statusPath ? '/admin/product_orders/' + statusPath :
                                '/admin/product_orders';

                            window.history.pushState({}, '', newUrl);

                            fetch(newUrl, {
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'text/html'
                                    }
                                })
                                .then(function(res) {
                                    return res.text();
                                })
                                .then(function(html) {
                                    var doc = new DOMParser().parseFromString(html, 'text/html');
                                    var newOrders = doc.querySelector('.div-orders');
                                    if (newOrders) document.querySelector('.div-orders').innerHTML =
                                        newOrders.innerHTML;
                                    var newFilter = doc.querySelector('.div-filter-status');
                                    if (newFilter) document.querySelector('.div-filter-status').innerHTML =
                                        newFilter.innerHTML;
                                })
                                .catch(console.error)
                                .finally(function() {
                                    if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                                });
                        },
                        filter: function() {
                            if (typeof showFullScreenLoader === 'function') showFullScreenLoader(window.tr(
                                'Searching...'), 'body');

                            var id = document.querySelector('.ipt-order-id').value.trim();
                            var pid = document.querySelector('.ipt-porder-id').value.trim();
                            var productId = document.querySelector('[data-col-name="product_id"]').value;

                            var params = new URLSearchParams();
                            if (id) params.set('id', id);
                            if (pid) params.set('provider_id', pid);
                            if (productId) params.set('product_id', productId);

                            var basePath = window.location.pathname;
                            var fetchUrl = basePath + (params.toString() ? '?' + params.toString() : '');

                            fetch(fetchUrl, {
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'text/html'
                                    }
                                })
                                .then(function(res) {
                                    return res.text();
                                })
                                .then(function(html) {
                                    var doc = new DOMParser().parseFromString(html, 'text/html');
                                    var newOrders = doc.querySelector('.div-orders');
                                    if (newOrders) document.querySelector('.div-orders').innerHTML =
                                        newOrders.innerHTML;
                                })
                                .catch(console.error)
                                .finally(function() {
                                    if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                                });
                        },
                        resetFilter: function() {
                            if (typeof showFullScreenLoader === 'function') showFullScreenLoader(window.tr(
                                'Resetting...'), 'body');

                            document.querySelector('.ipt-order-id').value = '';
                            document.querySelector('.ipt-porder-id').value = '';
                            var productSel = document.querySelector('[data-col-name="product_id"]');
                            if (productSel) {
                                productSel.value = '';
                                if (window.$ && $(productSel).data('select2')) $(productSel).val(null).trigger(
                                    'change');
                            }

                            var basePath = window.location.pathname;
                            fetch(basePath, {
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'text/html'
                                    }
                                })
                                .then(function(res) {
                                    return res.text();
                                })
                                .then(function(html) {
                                    var doc = new DOMParser().parseFromString(html, 'text/html');
                                    var newOrders = doc.querySelector('.div-orders');
                                    if (newOrders) document.querySelector('.div-orders').innerHTML =
                                        newOrders.innerHTML;
                                })
                                .catch(console.error)
                                .finally(function() {
                                    if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                                });
                        },
                        require: function(orderId) {
                            var body = document.getElementById('modal-require-body');
                            // Lấy dữ liệu từ row
                            var btn = document.querySelector('.action-' + orderId);
                            var row = btn ? btn.closest('tr') : null;
                            if (row) {
                                var cells = row.querySelectorAll('td');
                                var idText   = cells[2] ? cells[2].innerText.trim() : '';
                                var amtText  = cells[3] ? cells[3].innerText.trim() : '';
                                var prodText = cells[4] ? cells[4].innerText.trim() : '';
                                if (idText || amtText || prodText) {
                                    body.innerHTML =
                                        '<table class="table table-bordered fs-7 mb-0">' +
                                        '<tr><td class="text-muted w-150px">Order ID</td><td><b>' + idText + '</b></td></tr>' +
                                        '<tr><td class="text-muted">Sản phẩm / KH</td><td>' + prodText + '</td></tr>' +
                                        '<tr><td class="text-muted">Số tiền / SL</td><td>' + amtText + '</td></tr>' +
                                        '</table>';
                                } else {
                                    body.innerHTML = '<p class="text-muted text-center py-5 mb-0" data-lang="No require data found">No require data found</p>';
                                }
                            } else {
                                body.innerHTML = '<p class="text-muted text-center py-5 mb-0" data-lang="No require data found">No require data found</p>';
                            }
                            new bootstrap.Modal(document.getElementById('modal-change-service-combo')).show();
                        },
                        changeStatus: function(status, orderId) {
                            currentOrderId = orderId;
                            if (status === 'Partial') {
                                var modal = document.getElementById('modal-prompt');
                                modal.querySelector('p').textContent = window.tr ? window.tr(
                                    'Quantity remains') : 'Số lượng còn lại';
                                document.getElementById('ipt-prompt-value').value = '';

                                // Xóa error cũ nếu có
                                var errEl = modal.querySelector('.prompt-error');
                                if (errEl) errEl.remove();

                                var bsModal = new bootstrap.Modal(modal);
                                bsModal.show();

                                document.getElementById('btn-modal-prompt-ok').onclick = function() {
                                    var qty = document.getElementById('ipt-prompt-value').value.trim();

                                    // Xóa error cũ
                                    var old = modal.querySelector('.prompt-error');
                                    if (old) old.remove();

                                    if (qty === '' || isNaN(parseInt(qty))) {
                                        var err = document.createElement('p');
                                        err.className = 'prompt-error text-danger mt-2 mb-0 fs-7';
                                        err.textContent = 'Please input quantity remains';
                                        modal.querySelector('.modal-body').appendChild(err);
                                        return;
                                    }

                                    // Gửi lên server, giữ modal mở
                                    showFullScreenLoader('', 'body');
                                    var csrfToken = document.querySelector('meta[name="csrf-token"]')
                                        ?.content;

                                    fetch('/admin/product_orders/' + orderId + '/status', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': csrfToken,
                                                'Accept': 'application/json'
                                            },
                                            body: JSON.stringify({
                                                status: status,
                                                quantity: parseInt(qty)
                                            })
                                        })
                                        .then(function(r) {
                                            return r.json().then(function(d) {
                                                return {
                                                    ok: r.ok,
                                                    data: d
                                                };
                                            });
                                        })
                                        .then(function(res) {
                                            hideFullScreenLoader();
                                            if (res.ok && res.data.success) {
                                                bsModal.hide();
                                                _product_orders.on.click._updateStatusUI(orderId,
                                                    status);
                                            } else {
                                                bsModal.hide();
                                                showToast(res.data.message || 'Error', 'error');
                                            }
                                        })
                                        .catch(function(e) {
                                            hideFullScreenLoader();
                                            showToast(e.message || 'Error', 'error');
                                        });
                                };
                            } else {
                                _product_orders.on.click._doChangeStatus(status, orderId, null);
                            }
                        },
                        _doChangeStatus: function(status, orderId, quantity) {
                            showFullScreenLoader(window.tr ? window.tr('Updating...') : 'Updating...', 'body');
                            var csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                            var body = {
                                status: status
                            };
                            if (quantity !== null && quantity !== '') body.quantity = quantity;

                            fetch('/admin/product_orders/' + orderId + '/status', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify(body)
                                })
                                .then(function(r) {
                                    return r.json().then(function(d) {
                                        return {
                                            ok: r.ok,
                                            data: d
                                        };
                                    });
                                })
                                .then(function(res) {
                                    hideFullScreenLoader();
                                    if (res.ok && res.data.success) {
                                        _product_orders.on.click._updateStatusUI(orderId, status);
                                    } else {
                                        showToast(res.data.message || 'Error', 'error');
                                    }
                                })
                                .catch(function(e) {
                                    hideFullScreenLoader();
                                    showToast(e.message || 'Error', 'error');
                                });
                        },
                        _updateStatusUI: function(orderId, status) {
                            // Fetch lại trang để cập nhật menu buttons đúng theo status mới
                            var currentUrl = window.location.pathname + window.location.search;
                            fetch(currentUrl, {
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'text/html'
                                    }
                                })
                                .then(function(r) {
                                    return r.text();
                                })
                                .then(function(html) {
                                    var doc = new DOMParser().parseFromString(html, 'text/html');
                                    var newOrders = doc.querySelector('.div-orders');
                                    if (newOrders) {
                                        document.querySelector('.div-orders').innerHTML = newOrders
                                            .innerHTML;
                                        if (typeof KTMenu !== 'undefined') KTMenu.createInstances();
                                    }
                                    var newFilter = doc.querySelector('.div-filter-status');
                                    if (newFilter) document.querySelector('.div-filter-status').innerHTML =
                                        newFilter.innerHTML;
                                })
                                .catch(console.error);
                            showToast(window.tr ? window.tr('Update successfully') : 'Update successfully',
                                'success');
                        },
                        showModalCompleted: function(orderId) {
                            var modal = document.getElementById('modal-result');
                            var txa = modal.querySelector('.txa-result');
                            txa.value = '';
                            txa.className = 'form-control txa-result';

                            var bsModal = new bootstrap.Modal(modal);
                            bsModal.show();

                            document.getElementById('btn-submit-result').onclick = function() {
                                var result = txa.value.trim();
                                if (!result) {
                                    txa.classList.add('is-invalid');
                                    txa.focus();
                                    return;
                                }
                                bsModal.hide();
                                showFullScreenLoader('', 'body');
                                var csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

                                // Lưu result trước
                                fetch('/admin/product_orders/' + orderId + '/result', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': csrfToken,
                                            'Accept': 'application/json'
                                        },
                                        body: JSON.stringify({
                                            result: result
                                        })
                                    })
                                    .then(function(r) {
                                        return r.json();
                                    })
                                    .then(function() {
                                        // Sau đó update status Completed
                                        return fetch('/admin/product_orders/' + orderId + '/status', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': csrfToken,
                                                'Accept': 'application/json'
                                            },
                                            body: JSON.stringify({
                                                status: 'Completed'
                                            })
                                        }).then(function(r) {
                                            return r.json().then(function(d) {
                                                return {
                                                    ok: r.ok,
                                                    data: d
                                                };
                                            });
                                        });
                                    })
                                    .then(function(res) {
                                        hideFullScreenLoader();
                                        if (res.ok && res.data.success) {
                                            _product_orders.on.click._updateStatusUI(orderId,
                                                'Completed');
                                        } else {
                                            showToast(res.data.message || 'Error', 'error');
                                        }
                                    })
                                    .catch(function(e) {
                                        hideFullScreenLoader();
                                        showToast(e.message || 'Error', 'error');
                                    });
                            };
                        },
                        result: function(orderId) {
                            // Lấy note hiện tại từ data attribute của row
                            var row = document.querySelector('.action-' + orderId)?.closest('tr');
                            var currentNote = row ? (row.getAttribute('data-note') || '') : '';

                            var modal = document.getElementById('modal-view-result');
                            modal.querySelector('.txa-result').value = currentNote;
                            var bsModal = new bootstrap.Modal(modal);
                            bsModal.show();

                            document.getElementById('btn-change-result').onclick = function() {
                                _product_orders.on.click.changeResult(orderId);
                                bsModal.hide();
                            };
                        },
                        changeResult: function(orderId) {
                            var result = document.querySelector('#modal-view-result .txa-result').value.trim();
                            showFullScreenLoader('', 'body');
                            var csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

                            fetch('/admin/product_orders/' + orderId + '/result', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        result: result
                                    })
                                })
                                .then(function(r) {
                                    return r.json();
                                })
                                .then(function(data) {
                                    hideFullScreenLoader();
                                    if (data.success) {
                                        showToast(window.tr ? window.tr('Update successfully') :
                                            'Update successfully', 'success');
                                        // Cập nhật data-note trên row
                                        var row = document.querySelector('.action-' + orderId)?.closest(
                                            'tr');
                                        if (row) row.setAttribute('data-note', result);
                                    } else {
                                        showToast(data.message || 'Error', 'error');
                                    }
                                })
                                .catch(function(e) {
                                    hideFullScreenLoader();
                                    showToast(e.message || 'Error', 'error');
                                });
                        },
                        confirmChangeService: function() {}
                    }
                }
            };
        })();
    </script>

    {{-- Modal prompt (nhập số lượng còn lại cho Partial) --}}
    <div class="modal fade" tabindex="-1" id="modal-prompt">
        <div class="modal-dialog modal-dialog-centered rounded-4">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white py-4">
                    <h4 class="modal-title text-white ls-1" data-lang="Input value">Input value</h4>
                </div>
                <div class="modal-body py-10">
                    <p data-lang="Quantity remains">Số lượng còn lại</p>
                    <input type="text" class="form-control form-control-solid" id="ipt-prompt-value" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary px-4 rounded-4" id="btn-modal-prompt-cancel"
                        data-bs-dismiss="modal" data-lang="Cancel">Hủy</button>
                    <button type="button" class="btn btn-sm btn-primary px-4 rounded-4" id="btn-modal-prompt-ok"
                        data-lang="Send">Gửi</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal nhập result khi Completed --}}
    <div class="modal fade" tabindex="-1" id="modal-result" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered mw-600px">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <textarea class="form-control txa-result" rows="8" placeholder="Input result"
                        onkeyup="this.className = 'form-control txa-result'"></textarea>
                    <div class="mt-5">
                        <button type="button" id="btn-submit-result" class="btn btn-primary btn-sm"
                            onclick="_product_orders.on.click.changeStatus('Completed', '11163')"
                            rows="8">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal xem/sửa result --}}
    <div class="modal fade" tabindex="-1" id="modal-view-result">
        <div class="modal-dialog modal-dialog-centered mw-600px">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <textarea class="form-control txa-result" rows="20" placeholder="Input result"
                        onkeyup="this.className='form-control txa-result'"></textarea>
                    <div class="mt-5">
                        <button type="button" class="btn btn-primary btn-sm" id="btn-change-result"
                            data-lang="button::Update">Change result</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
