@extends('adminpanel.layouts.app')
@section('title', 'Accounts')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        @include('adminpanel.accounts.partials.header')

        <span class="title d-none">View account - Custom rates</span>
        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2" data-lang="Custom rates">Thiết lập giá</h3>
        </div>

        <div class="row g-6">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="mb-5">
                                    <select class="form-select form-select-solid sl-services" 
                                        data-control="select2"
                                        data-placeholder="Select service" data-lang="Select service">
                                        <option value="0" data-lang="Select service">Chọn dịch vụ</option>
                                        <option value="-1" data-lang="All active services">Tất cả dịch vụ đang hoạt động</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}" data-orate="{{ $service->rate_retail }}"
                                                @if ($service->image) data-icon="{{ $service->image }}" @endif>
                                                {{ $service->id }} | {{ $service->getName() }} |
                                                ${{ number_format($service->rate_retail, 4) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-5">
                                <div class="mb-5">
                                    <select class="form-select form-select-solid sl-mode" data-control="select2"
                                        data-placeholder="Select mode" data-lang="Select mode" data-hide-search="true"
                                        onchange="setModeCustomRates()">
                                        <option></option>
                                        <option value="1" data-lang="Set by price">Thiết lập theo giá</option>
                                        <option value="2" data-lang="Set by percent">Thiết lập theo phần trăm</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-5">
                                <div class="input-group input-group-solid div-ipt-rate mb-5">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control ipt-rate">
                                </div>
                                <div class="input-group input-group-solid div-ipt-rate-percent mb-5" style="display: none;">
                                    <input type="text" class="form-control ipt-rate-percent"
                                        data-inputmask="'mask': '9', 'repeat': 3, 'greedy' : false" data-bs-toggle="tooltip"
                                        data-bs-placement="top" value=""
                                        aria-label="Nếu giá nhà cung cấp là 1$, bạn thiết lập 110% thì giá mới là 1.1$"
                                        data-bs-original-title="Nếu giá nhà cung cấp là 1$, bạn thiết lập 110% thì giá mới là 1.1$">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="col-lg-1 col-2">
                                <div class="d-flex">
                                    <button type="button" class="btn btn-primary me-1 btn-icon"
                                        onclick="_accounts.on.click.addCustomRate('4374')" data-bs-toggle="tooltip"
                                        data-bs-placement="top" aria-label="Add" data-bs-original-title="Add"
                                        data-kt-initialized="1"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    <button type="button" class="btn btn-danger btn-icon"
                                        onclick="_accounts.on.click.clearAllCustomRate('4374')" data-bs-toggle="tooltip"
                                        data-bs-placement="top" aria-label="Clear all" data-bs-original-title="Clear all"
                                        data-kt-initialized="1"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-check form-check-custom form-check-sm form-check-solid"><input
                                    class="form-check-input h-15px w-15px cb-all" type="checkbox"
                                    onchange="cbSelectAll(this.checked)"></div>
                            <div class="checkall ms-5" style="display: none;">
                                <a href="#"
                                    class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm py-1 px-2"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <span data-page="common" data-lang="Action">Tùy chọn</span>
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                </a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-150px py-3"
                                    data-kt-menu="true">
                                    <div class="menu-item px-3"><a href="javascript:;" class="menu-link px-3"
                                            onclick="_accounts.on.click.removeCustomRates('4374')"
                                            data-lang="Remove">Xóa</a></div>
                                </div>
                                <label class="ms-3 fs-7"></label>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-7 gy-2 table-customrates"
                                id="table-customrates" style="width: 100%;">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th></th>
                                        <th colspan="2" data-lang="Service">Dịch vụ</th>
                                        <th data-lang="Rate">Giá bán</th>
                                        <th data-lang="Percent">Phần trăm</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-7 text-gray-700"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show full screen loader when page loads
            if (typeof showFullScreenLoader === 'function') {
                showFullScreenLoader('Đang tải dữ liệu...', 'body');
            }

            // Simulate data loading and hide loader after content is ready
            setTimeout(() => {
                if (typeof hideFullScreenLoader === 'function') {
                    hideFullScreenLoader();
                }
            }, 500);
        });

        // Chuyển đổi giữa input giá và phần trăm
        function setModeCustomRates() {
            const mode = document.querySelector('.sl-mode').value;
            const divRate = document.querySelector('.div-ipt-rate');
            const divPercent = document.querySelector('.div-ipt-rate-percent');

            if (mode === '1') {
                divRate.style.display = '';
                divPercent.style.display = 'none';
                document.querySelector('.ipt-rate-percent').value = '';
            } else if (mode === '2') {
                divRate.style.display = 'none';
                divPercent.style.display = '';
                document.querySelector('.ipt-rate').value = '';
            } else {
                divRate.style.display = '';
                divPercent.style.display = 'none';
            }
        }

        // Update account function
        function updateAccount() {
            if (typeof showFullScreenLoader === 'function') {
                showFullScreenLoader('Đang cập nhật...', '#kt_modal_edit_account');
            }

            const username = '{{ $account->username ?? '' }}';
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            const data = {
                name: document.querySelector('.ipt-name')?.value.trim(),
                email: document.querySelector('.ipt-email')?.value.trim(),
                phone: document.querySelector('.ipt-phone')?.value.trim(),
                password: document.querySelector('.ipt-password')?.value.trim(),
                bonus_percent: document.querySelector('.ipt-percent')?.value.trim(),
                role: document.querySelector('.sl-role')?.value.trim(),
                is_active: document.querySelector('.sl-status')?.value.trim()
            };

            fetch(`/admin/accounts/${username}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (typeof hideFullScreenLoader === 'function') {
                        hideFullScreenLoader();
                    }

                    if (result.success) {
                        // Close modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('kt_modal_edit_account'));
                        if (modal) modal.hide();

                        // Update displayed data without reload
                        if (result.user) {
                            // Update name in header if exists
                            const nameElement = document.querySelector('.account-name');
                            if (nameElement && result.user.name) {
                                nameElement.textContent = result.user.name;
                            }

                            // Update email in header if exists
                            const emailElement = document.querySelector('.account-email');
                            if (emailElement && result.user.email) {
                                emailElement.textContent = result.user.email;
                            }

                            // Update phone in header if exists
                            const phoneElement = document.querySelector('.account-phone');
                            if (phoneElement && result.user.phone) {
                                phoneElement.textContent = result.user.phone;
                            }

                            // Update status badge
                            const statusBadge = document.querySelector('.account-status-badge');
                            if (statusBadge) {
                                if (result.user.is_active) {
                                    statusBadge.className = 'badge badge-success';
                                    statusBadge.textContent = 'Kích hoạt';
                                } else {
                                    statusBadge.className = 'badge badge-danger';
                                    statusBadge.textContent = 'Vô hiệu hóa';
                                }
                            }

                            // Update role display
                            const roleElement = document.querySelector('.account-role');
                            if (roleElement && result.user.role) {
                                const roleText = result.user.role === 'admin' ? 'Admin' : 'User';
                                roleElement.textContent = roleText;
                            }
                        }
                    } else {
                        if (typeof showToast === 'function') {
                            showToast(result.message || 'Cập nhật thất bại!', 'error');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (typeof hideFullScreenLoader === 'function') {
                        hideFullScreenLoader();
                    }
                    if (typeof showToast === 'function') {
                        showToast('Có lỗi xảy ra!', 'error');
                    }
                });
        }

        // Set selected values when modal is shown
        const editModal = document.getElementById('kt_modal_edit_account');
        if (editModal) {
            editModal.addEventListener('show.bs.modal', function() {
                // Set role
                const roleValue = '{{ ($account->role ?? '') === 'admin' ? 'admin' : ($account->level ?? 'retail') }}';
                const roleSelect = document.querySelector('.sl-role');
                if (roleSelect) {
                    roleSelect.value = roleValue;
                    if (window.jQuery) {
                        jQuery('.sl-role').trigger('change');
                    }
                }

                // Set status
                const statusValue = '{{ ($account->is_active ?? false) ? '1' : '0' }}';
                const statusSelect = document.querySelector('.sl-status');
                if (statusSelect) {
                    statusSelect.value = statusValue;
                    if (window.jQuery) {
                        jQuery('.sl-status').trigger('change');
                    }
                }
            });
        }
    </script>
@endsection
