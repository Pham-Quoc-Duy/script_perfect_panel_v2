@extends('adminpanel.layouts.app')
@section('title', 'Providers')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        <div class="row mb-6">
            <div class="col-lg-12">
                <button class="btn btn-primary btn-sm me-3" onclick="showModalProvider()" fdprocessedid="n504pi">
                    <span data-lang="New provider">Thêm nhà cung cấp</span>
                </button>
                <button class="btn btn-primary btn-sm" onclick="checkAllBalance()" fdprocessedid="vpc6m7">
                    <span data-lang="Check all balance">Kiểm tra số dư</span>
                </button>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <p class="fst-italic">* <span data-lang="note-alert">Nếu bạn muốn sử dụng tính năng cảnh báo số dư, bạn cần
                        phải kích hoạt tiện ích Telegram</span> <a target="_blank" href="/admin/settings/modules"
                        data-lang="note-alert-1">tại đây</a></p>
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-7 gy-2 mb-0" id="table-provider">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th></th>
                                <th data-lang="Provider">Nhà cung cấp</th>
                                <th data-lang="Balance">Số dư</th>
                                <th data-lang="Currency">Tiền tệ</th>
                                <th data-lang="provider::Alert">Cảnh báo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="sort-provider" id="sortableProviders">
                            @foreach ($providers as $pro)
                                <tr class="tr-provider row-{{ $pro->id }}" data-id="{{ $pro->id }}" data-provider="{{ json_encode(['id' => $pro->id, 'name' => $pro->name, 'link' => $pro->link, 'type' => $pro->type, 'rate' => $pro->rate ?? 1, 'fixed_decimal' => $pro->fixed_decimal ?? 10, 'balance_alert' => $pro->balance_alert ?? 0, 'rate_api' => $pro->rate_api, 'warning' => $pro->warning ?? 0]) }}">
                                    <td width="1">
                                        <i class="fas fa-bars ui-sortable-handle"></i>
                                    </td>
                                    <td>{{ $pro->name }}</td>
                                    <td><span class="fw-bold text-uppercase balance-63 ">{{ $pro->balance != 0 ? rtrim(rtrim($pro->balance, '0'), '.') : '0' }}</span></td>
                                    <td>{{ $pro->currency }} <i class="fa fa-exclamation-circle ms-2 text-muted"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Tỉ giá: {{ $pro->rate_api ?? 1 }}, Làm tròn: {{ $pro->fixed_decimal ?? 10 }}"></i>
                                    </td>
                                    <td>
                                        @if ($pro->warning && $pro->warning != 0)
                                            <i class="fa fa-bell me-2 text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $pro->warning }}"></i>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-secondary btn-sm py-1 px-3 rotate"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                                            data-kt-menu-offset="0,5" fdprocessedid="23ei02">
                                            <span data-lang="Actions">Tùy chọn</span>
                                            <span class="svg-icon svg-icon-3 rotate-180 ms-3 me-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </button>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3"><a href="javascript:;" class="menu-link px-3"
                                                    onclick="showModalProvider('Tùy chỉnh', {{ $pro->id }})"
                                                    data-lang="Edit">Tùy chỉnh</a></div>
                                            <div class="menu-item px-3"><a href="javascript:;" class="menu-link px-3"
                                                    onclick="checkBalance({{ $pro->id }})"
                                                    data-lang="Check balance">Kiểm tra số dư</a></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-provider" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" data-lang="Add provider">Thêm nhà cung cấp</h4>
                    </div>
                    <div class="modal-body div-provider">
                        <div class="mb-5">
                            <label class="required form-label">API URL</label>
                            <input type="text" name="link" class="form-control form-control-solid ipt-url">
                        </div>
                        <div class="mb-5">
                            <label class="form-label">API Key</label>
                            <input type="text" name="api_key" class="form-control form-control-solid ipt-key">
                        </div>
                        <input type="hidden" name="type" class="ipt-type" value="api">
                        <div class="mb-5">
                            <label class="required form-label" data-lang="Rate">Rate</label>
                            <input type="text" name="rate_api" class="form-control form-control-solid ipt-rate-api" value="1">
                            <span class="form-text text-muted" data-lang="Rate-description">Tỷ giá 1 USD với nhà cung
                                cấp . Ví dụ: Nếu đơn vị tiền tệ của nhà cung cấp là VND, bạn có thể đặt tỷ giá là
                                25000</span>
                        </div>
                        <div class="mb-5">
                            <label class="required form-label" data-lang="Fixed decimal">Làm tròn</label>
                            <select class="form-select form-select-solid sl-fixed-decimal" name="fixed_decimal" data-control="select2" data-hide-search="true">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10" selected>10</option>
                            </select>
                            <span class="form-text text-muted" data-lang="Fixed-description">Làm tròn sau chữ số thập
                                phân. Nếu bạn chọn 3 thì giá sẽ là 5.123, chọn 4 thì giá sẽ là 5.1234</span>
                        </div>
                        <div class="mb-5">
                            <label class="form-label" data-lang="balance-alert-amount">Cảnh báo số dư</label>
                            <input type="number" name="warning" class="form-control form-control-solid ipt-warning"
                                value="0" step="0.01" placeholder="Số dư cảnh báo (tùy chọn)">
                            <span class="form-text text-muted" data-lang="Set 0 if wanna disable">Nhập 0 nếu muốn vô
                                hiệu hóa</span>
                        </div>
                        <div class="">
                            <label class="form-label" data-lang="Memorable name">Tên dễ nhớ</label>
                            <input type="text" name="name" class="form-control form-control-solid ipt-name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"
                            data-lang="button::Close">Đóng</button>
                        <button type="button" class="btn btn-primary btn-sm btn-submit-provider" onclick="submitProvider()">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
         .fullscreen-loader-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.42);
            backdrop-filter: blur(3px);
            z-index: 9998;
            animation: fadeIn 0.3s ease-in-out;
        }

        .fullscreen-loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            animation: slideUp 0.5s ease-out;
        }

        .fullscreen-loader-overlay.d-none,
        .fullscreen-loader.d-none {
            display: none !important;
        }

        .fullscreen-loader-overlay.fade-out,
        .fullscreen-loader.fade-out {
            animation: fadeOut 0.3s ease-in-out forwards;
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>

    <script>
        let providerSortable = null;
        let providerSortables = [];

        window.showModalProvider = showModalProvider;

        function showModalProvider(title = null, providerId = null) {
            const modal = new bootstrap.Modal(document.getElementById('modal-provider'));
            const modalTitle = document.querySelector('#modal-provider .modal-title');
            const inputs = {
                url: document.querySelector('.ipt-url'),
                key: document.querySelector('.ipt-key'),
                type: document.querySelector('.ipt-type'),
                rateApi: document.querySelector('.ipt-rate-api'),
                rate: document.querySelector('.ipt-rate'),
                decimal: document.querySelector('.sl-fixed-decimal'),
                warning: document.querySelector('.ipt-warning'),
                name: document.querySelector('.ipt-name')
            };
            const submitBtn = document.querySelector('#modal-provider .btn-submit-provider');

            const extractDomainFromUrl = (url) => {
                try {
                    const urlObj = new URL(url.startsWith('http') ? url : 'https://' + url);
                    return urlObj.hostname.replace('www.', '');
                } catch {
                    return '';
                }
            };

            const resetForm = () => {
                if (inputs.url) inputs.url.value = '';
                if (inputs.key) inputs.key.value = '';
                if (inputs.type) inputs.type.value = 'api';
                if (inputs.rateApi) inputs.rateApi.value = '1';
                if (inputs.rate) inputs.rate.value = '1';
                if (inputs.decimal) inputs.decimal.value = '10';
                if (inputs.warning) inputs.warning.value = '0';
                if (inputs.name) inputs.name.value = '';
            };

            modalTitle.textContent = title || 'Thêm nhà cung cấp';
            submitBtn.textContent = title ? 'Cập nhật' : 'Thêm';
            
            if (providerId) {
                submitBtn.setAttribute('data-provider-id', providerId);
                const row = document.querySelector(`tr[data-id="${providerId}"][data-provider]`);
                if (row) {
                    const data = JSON.parse(row.getAttribute('data-provider'));
                    if (inputs.url) inputs.url.value = data.link || '';
                    if (inputs.type) inputs.type.value = data.type || '';
                    if (inputs.rateApi) inputs.rateApi.value = data.rate_api || '1';
                    if (inputs.rate) inputs.rate.value = data.rate || '1';
                    if (inputs.decimal) inputs.decimal.value = data.fixed_decimal || '10';
                    if (inputs.warning) inputs.warning.value = data.warning || '0';
                    if (inputs.name) inputs.name.value = data.name || '';
                    if (inputs.key) inputs.key.value = '';
                    
                    if (typeof $ !== 'undefined' && inputs.decimal && $(inputs.decimal).data('select2')) {
                        $(inputs.decimal).val(data.fixed_decimal || '10').trigger('change');
                    }
                }
            } else {
                submitBtn.removeAttribute('data-provider-id');
                resetForm();
            }

            // Auto-fill name from URL when URL changes
            if (inputs.url) {
                inputs.url.addEventListener('change', function() {
                    if (!providerId && inputs.name) {
                        inputs.name.value = extractDomainFromUrl(this.value);
                    }
                });
            }

            modal.show();

            setTimeout(() => {
                if (typeof $ !== 'undefined' && $.fn.select2 && inputs.decimal && !$(inputs.decimal).data('select2')) {
                    $(inputs.decimal).select2({
                        dropdownParent: $('#modal-provider'),
                        minimumResultsForSearch: Infinity
                    });
                }
            }, 50);
        }

        function initializeProviderSort() {
            const tbody = document.getElementById('sortableProviders');
            if (tbody && !providerSortable) {
                providerSortable = new Sortable(tbody, {
                    animation: 200,
                    handle: '.tr-provider td:first-child',
                    draggable: '.tr-provider',
                    ghostClass: 'sortable-ghost',
                    chosenClass: 'sortable-chosen',
                    dragClass: 'sortable-drag',
                    onEnd: function(evt) {
                        if (evt.oldIndex !== evt.newIndex) {
                            updateProviderPositions();
                        }
                    }
                });
            }
        }

        function updateProviderPositions() {
            const providers = [];
            const rows = document.querySelectorAll('.tr-provider');
            
            rows.forEach((row, index) => {
                const providerId = row.getAttribute('data-id');
                if (providerId) {
                    providers.push({
                        id: parseInt(providerId),
                        position: index + 1
                    });
                }
            });

            if (providers.length === 0) return;

            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            if (!csrfMeta) {
                console.error('CSRF token not found');
                return;
            }

            fetch('/admin/providers', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfMeta.content
                },
                body: JSON.stringify({
                    action: 'reorder',
                    providers: providers
                })
            })
            .then(response => response.json())
            .catch(error => console.error('Error updating positions:', error));
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeProviderSort();
        });

        function showToast(message, type = 'error') {
            const container = document.getElementById('toastr-container');
            if (!container) return;

            const toastDiv = document.createElement('div');
            toastDiv.className = `toastr toastr-${type}`;
            toastDiv.setAttribute('aria-live', 'assertive');
            toastDiv.style.opacity = '1';

            const progressDiv = document.createElement('div');
            progressDiv.className = 'toastr-progress';
            progressDiv.style.width = '100%';

            const messageDiv = document.createElement('div');
            messageDiv.className = 'toastr-message';
            messageDiv.textContent = message;

            toastDiv.appendChild(progressDiv);
            toastDiv.appendChild(messageDiv);
            container.appendChild(toastDiv);

            let width = 100;
            const interval = setInterval(() => {
                width -= 2;
                progressDiv.style.width = width + '%';
                if (width <= 0) {
                    clearInterval(interval);
                    toastDiv.style.opacity = '0';
                    setTimeout(() => toastDiv.remove(), 300);
                }
            }, 30);
        }

        function submitProvider() {
            const submitBtn = document.querySelector('#modal-provider .btn-submit-provider');
            const providerId = submitBtn.getAttribute('data-provider-id');
            const inputs = {
                url: document.querySelector('.ipt-url'),
                key: document.querySelector('.ipt-key'),
                type: document.querySelector('.ipt-type'),
                rateApi: document.querySelector('.ipt-rate-api'),
                rate: document.querySelector('.ipt-rate'),
                decimal: document.querySelector('.sl-fixed-decimal'),
                warning: document.querySelector('.ipt-warning'),
                name: document.querySelector('.ipt-name')
            };

            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            if (!csrfMeta) {
                showToast('CSRF token không tìm thấy', 'error');
                return;
            }

            const payload = {
                name: inputs.name?.value.trim() || '',
                link: inputs.url?.value.trim() || '',
                type: inputs.type?.value.trim() || 'api',
                rate: inputs.rate?.value.trim() || '1',
                fixed_decimal: inputs.decimal?.value || '10',
                warning: inputs.warning?.value.trim() || '0'
            };

            if (inputs.key?.value.trim()) {
                payload.api_key = inputs.key.value.trim();
            }

            if (inputs.rateApi?.value.trim()) {
                payload.rate_api = inputs.rateApi.value.trim();
            }

            if (!payload.name) {
                showToast('Vui lòng nhập tên nhà cung cấp', 'error');
                return;
            }

            if (!payload.link) {
                showToast('Vui lòng nhập API URL', 'error');
                return;
            }

            const url = providerId ? `/admin/providers/${providerId}` : '/admin/providers';
            const method = providerId ? 'PUT' : 'POST';

            if (typeof showFullScreenLoader === 'function') {
                showFullScreenLoader('', '#modal-provider');
            }

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfMeta.content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(response => {
                // Handle non-JSON responses or validation errors
                if (response.status === 422) {
                    return response.json().then(data => {
                        throw { status: 422, errors: data.errors };
                    });
                }
                if (!response.ok) {
                    return response.json().then(data => {
                        throw { status: response.status, message: data.message || '' };
                    });
                }
                return response.json();
            })
            .then(data => {
                if (typeof hideFullScreenLoader === 'function') {
                    hideFullScreenLoader();
                }

                if (data.success) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('modal-provider'));
                    if (modal) {
                        modal.hide();
                    }
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                } else {
                    if (data.message) {
                        showToast(data.message, 'error');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (typeof hideFullScreenLoader === 'function') {
                    hideFullScreenLoader();
                }

                // Handle validation errors (422)
                if (error.status === 422 && error.errors) {
                    Object.keys(error.errors).forEach(field => {
                        const errorMessages = error.errors[field];
                        const errorMsg = Array.isArray(errorMessages) ? errorMessages[0] : errorMessages;
                        showToast(`${field}: ${errorMsg}`, 'error');
                    });
                } else if (error.message) {
                    showToast(error.message, 'error');
                }
            });
        }

        function checkBalance(providerId) {
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            if (!csrfMeta) {
                console.error('CSRF token not found');
                return;
            }

            const row = document.querySelector(`tr[data-id="${providerId}"]`);
            if (!row) return;

            const balanceCell = row.querySelector('td:nth-child(3)');
            const originalContent = balanceCell.innerHTML;
            balanceCell.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

            fetch(`/admin/providers/${providerId}/balance`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfMeta.content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    balanceCell.innerHTML = `<span class="fw-bold text-uppercase">${data.balance} ${data.currency}</span>`;
                } else {
                    balanceCell.innerHTML = originalContent;
                    if (data.error) {
                        showToast(data.error, 'error');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                balanceCell.innerHTML = originalContent;
            });
        }

        function checkAllBalance() {
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            if (!csrfMeta) {
                console.error('CSRF token not found');
                return;
            }

            const rows = document.querySelectorAll('.tr-provider');
            const originalContents = new Map();

            rows.forEach(row => {
                const balanceCell = row.querySelector('td:nth-child(3)');
                originalContents.set(row.getAttribute('data-id'), balanceCell.innerHTML);
                balanceCell.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
            });

            fetch('/admin/providers/sync-all-balances', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfMeta.content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.results) {
                    let failCount = 0;

                    data.results.forEach(result => {
                        const row = document.querySelector(`tr[data-id="${result.id}"]`);
                        if (row) {
                            const balanceCell = row.querySelector('td:nth-child(3)');
                            if (result.success) {
                                balanceCell.innerHTML = `<span class="fw-bold text-uppercase">${result.balance} ${result.currency}</span>`;
                            } else {
                                balanceCell.innerHTML = originalContents.get(String(result.id));
                                failCount++;
                                if (result.error) {
                                    showToast(result.error, 'error');
                                }
                            }
                        }
                    });
                } else {
                    rows.forEach(row => {
                        const balanceCell = row.querySelector('td:nth-child(3)');
                        balanceCell.innerHTML = originalContents.get(row.getAttribute('data-id'));
                    });
                    if (data.message) {
                        showToast(data.message, 'error');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error); 
                rows.forEach(row => {
                    const balanceCell = row.querySelector('td:nth-child(3)');
                    balanceCell.innerHTML = originalContents.get(row.getAttribute('data-id'));
                });
            });
        }
    </script>
@endsection
