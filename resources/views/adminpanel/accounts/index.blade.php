@extends('adminpanel.layouts.app')
@section('title', 'Accounts')
@section('content')

    <div class="content flex-row-fluid" id="kt_content"><span class="title d-none">List</span>
        <div class="row g-5 mb-5">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <span class="fw-semibold text-gray-400 me-2"><i class="fa fa-user fs-1"
                                        aria-hidden="true"></i></span>
                                <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-4"
                                    id="total_users">{{ $users->total() ?? 0 }}</span>

                            </div>
                            <span class="text-gray-400 pt-1 fw-semibold fs-6" data-lang="Total accounts">Tổng số lượng tài khoản</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 d-flex flex-wrap">
                                <div class="d-flex flex-column content-justify-center flex-row-fluid">
                                    <div class="d-flex fw-semibold align-items-center">
                                        <div class="bullet w-20px h-10px rounded-2 bg-primary me-3"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4" data-lang="Retail">Khách lẻ</div>
                                        <div class="fw-bolder text-gray-700 text-xxl-end ls-2" id="count_retail">0</div>
                                    </div>

                                    <div class="d-flex fw-semibold align-items-center my-3">
                                        <div class="bullet w-20px h-10px rounded-2 bg-warning me-3"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4" data-lang="Distributor">Nhà phân phối</div>
                                        <div class="fw-bolder text-gray-700 text-xxl-end ls-2" id="count_distributor">0
                                        </div>
                                    </div>

                                    <div class="d-flex fw-semibold align-items-center">
                                        <div class="bullet w-20px h-10px rounded-2 bg-warning me-3"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4" data-lang="Agent">Đại lý</div>
                                        <div class=" fw-bolder text-gray-700 text-xxl-end ls-2" id="count_agent">0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex flex-wrap">
                                <div class="d-flex flex-column content-justify-center flex-row-fluid">
                                    <div class="d-flex fw-semibold align-items-center">
                                        <div class="bullet w-20px h-10px rounded-2 bg-danger me-3"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4" data-lang="Admin">Admin</div>
                                        <div class="fw-bolder text-gray-700 text-xxl-end ls-2" id="count_admin">0</div>
                                    </div>

                                    <div class="d-flex fw-semibold align-items-center my-3">
                                        <div class="bullet w-8px h-3px rounded-2 bg-info me-3"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4" data-lang="Active">Hoạt động</div>
                                        <div class="fw-bolder text-gray-700 text-xxl-end ls-2" id="count_active">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-lg-100">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <span class="fw-semibold text-gray-400 me-2"><i class="fa fa-dollar fs-1"
                                        aria-hidden="true"></i></span>
                                <span class="fs-2hx fw-bold me-2 lh-1 ls-4 total_balance" id="total_balance">0</span>
                            </div>
                            <span class="text-gray-400 pt-1 fw-semibold fs-6" data-lang="Total current balance">Tổng số dư
                                hiện có</span>
                        </div>
                    </div>

                    <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                        <div class="d-flex flex-column content-justify-center flex-row-fluid">
                            <div class="d-flex fw-semibold align-items-center">
                                <div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
                                <div class="text-gray-500 flex-grow-1 me-4" data-lang="Deposit">Tiền nạp</div>
                                <div class="fw-bolder text-gray-700 text-xxl-end ls-2 total_deposit">{{ formatCharge($totalDeposit ?? 0) }}</div>
                            </div>

                            <div class="d-flex fw-semibold align-items-center my-3">
                                <div class="bullet w-8px h-3px rounded-2 bg-warning me-3"></div>
                                <div class="text-gray-500 flex-grow-1 me-4" data-lang="Bonus">Tiền thưởng</div>
                                <div class="fw-bolder text-gray-700 text-xxl-end ls-2 total_bonus">{{ formatCharge($totalBonus ?? 0) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-6">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <select
                                class="form-select form-select-solid fw-bold w-300px w-xl-400px sl-account datatable-input select2-hidden-accessible"
                                data-col-name="account_id" 
                                data-kt-select2="true"
                                data-placeholder="Tìm tài khoản hoặc email"
                                data-allow-clear="true"
                                tabindex="-1" aria-hidden="true">
                                <option></option>
                            </select>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-light-primary me-3"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <span data-lang="Filter">Lọc</span>
                                </button>
                                <div class="menu menu-sub menu-sub-dropdown w-400px" data-kt-menu="true">
                                    <div class="px-7 py-5">
                                        <div class="fs-5 fw-bold" data-lang="Filter Options">Tùy chọn lọc</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>
                                    <div class="px-7 py-5">
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold"><span data-lang="Role">Loại tài
                                                    khoản</span>:</label>
                                            <select id="filter_account_type"
                                                class="form-select form-select-solid fw-bold datatable-input select2-hidden-accessible"
                                                data-kt-select2="true" data-placeholder="Select option"
                                                data-allow-clear="true" data-hide-search="true" tabindex="-1"
                                                aria-hidden="true">
                                                <option></option>
                                                <option value="retail" data-type="level" data-lang="Retail">Khách lẻ</option>
                                                <option value="admin" data-type="role" data-lang="Admin">Admin</option>
                                                <option value="staff" data-type="role" data-lang="Staff">Nhân viên</option>
                                                <option value="agent" data-type="level" data-lang="Agent">Đại lý</option>
                                                <option value="distributor" data-type="level" data-lang="Distributor">Nhà phân phối</option>
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="reset"
                                                class="btn btn-sm btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                                data-kt-menu-dismiss="true" onclick="resetFilters()"
                                                data-lang="button::Reset">Thiết lập lại</button>
                                            <button type="submit" class="btn btn-sm btn-primary fw-semibold px-6"
                                                data-kt-menu-dismiss="true" onclick="applyFilters()"
                                                data-lang="button::Apply">Áp dụng</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_add_account">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor">
                                            </rect>
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <span data-lang="New">Thêm</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0">
                         <div id="table-orders_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer"
                        style="position: relative;">
                        <div id="table-orders_processing" class="dt-processing card" role="status"
                            style="display: none;"><span
                                class="spinner-border w-15px h-15px text-muted align-middle me-2"></span>
                            <span class="text-gray-600">Loading...</span>
                            <div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle table-row-dashed fs-7 gy-2 gs-10"
                                id="users_table" style="width: 100%;">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0" role="row">
                                        <th data-dt-column="0" class="ls-1 fw-bold dt-orderable-asc dt-orderable-desc"
                                            rowspan="1" colspan="1" aria-label="ID: Activate to sort"
                                            tabindex="0"><span class="dt-column-title" role="button">ID</span><span
                                                class="dt-column-order"></span></th>
                                        <th data-lang="Username" data-dt-column="1"
                                            class="d-flex align-items-center dt-orderable-none" rowspan="1"
                                            colspan="1" aria-label="Tài khoản"><span class="dt-column-title">Tài
                                                khoản</span><span class="dt-column-order"></span></th>
                                        <th data-lang="Role" data-dt-column="2" rowspan="1" colspan="1"
                                            class="dt-orderable-none" aria-label="Loại tài khoản"><span
                                                class="dt-column-title">Loại tài khoản</span><span
                                                class="dt-column-order"></span></th>
                                        <th data-dt-column="4" rowspan="1" colspan="1"
                                            class="dt-orderable-asc dt-orderable-desc"
                                            aria-label="Thưởng (%): Activate to sort" tabindex="0"><span
                                                class="dt-column-title" role="button"><span
                                                    data-lang="Percent bonus">Thưởng</span> (%)</span><span
                                                class="dt-column-order"></span></th>
                                        <th data-dt-column="5" class="text-nowrap dt-orderable-asc dt-orderable-desc"
                                            rowspan="1" colspan="1" aria-label="Số dư ($): Activate to sort"
                                            tabindex="0"><span class="dt-column-title" role="button"><span
                                                    data-lang="Balance">Số dư</span> ($)</span><span
                                                class="dt-column-order"></span></th>
                                        <th class="text-end text-nowrap dt-orderable-none" data-dt-column="6"
                                            rowspan="1" colspan="1" aria-label=""><span
                                                class="dt-column-title"></span><span class="dt-column-order"></span></th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 fw-semibold">
                                    @forelse($users as $user)
                                        <tr>
                                            <td class="ls-1 fw-bold">{{ $user->id }}</td>
                                            <td class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-40px overflow-hidden me-3">
                                                    <div class="symbol-label fs-3 bg-light-success text-success">
                                                        {{ strtoupper(substr($user->username ?? $user->name, 0, 1)) }}
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column" style="line-height: 1.2;">
                                                    <a href="{{ route('admin.accounts.show', $user->username) }}"
                                                        class="text-gray-800 text-hover-primary ls-1 fw-bold text-nowrap">
                                                        {{ $user->username ?? $user->name }}
                                                    </a>
                                                    <span class="text-muted fs-8 text-nowrap" style="line-height: 1;">{{ $user->email }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($user->role === 'admin')
                                                    <span class="badge badge-outline badge-danger fs-8 py-1">Admin</span>
                                                @else
                                                    <span class="badge badge-outline badge-primary fs-8 py-1">User</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($user->bonus_amount))
                                                    {{ formatCharge($user->bonus_amount) }}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('admin.accounts.payment', $user->username) }}"><i
                                                        class="fa-solid fa-circle-plus text-primary fs-4"></i></a>
                                                <span
                                                    class="fs-4 ls-1 fw-boldest text-primary">{{ formatCharge($user->balance) }}</span>
                                            </td>
                                            <td class="text-end text-nowrap">
                                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    <span>Tùy chọn</span>
                                                    <span class="svg-icon svg-icon-5 m-0">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('admin.accounts.show', $user) }}"
                                                            class="menu-link px-3">Chi tiết</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:;" class="menu-link px-3"
                                                            onclick="showModalCopyRates({{ $user->id }}, '{{ $user->username }}')">Sao
                                                            chép giá</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="admin/messages/{{ $user->username }}"
                                                            class="menu-link px-3">Gửi tin nhắn</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <span class="text-muted">Không có dữ liệu</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                    @if ($users->hasPages())
                        <div class="card-footer">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toggleTableLoader(true);
            setTimeout(() => {
                updateStats();
                initializeAccountSelect();
                toggleTableLoader(false);
            }, 300);
        });

        function initializeAccountSelect() {
            const users = @json($users->items());
            const selectElement = document.querySelector('.sl-account');
            
            if (!selectElement) return;

            // Clear existing options except the first empty one
            while (selectElement.options.length > 1) {
                selectElement.remove(1);
            }

            // Add user options
            users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id;
                option.textContent = `${user.username} (${user.email})`;
                option.dataset.username = user.username;
                option.dataset.email = user.email;
                selectElement.appendChild(option);
            });

            // Initialize Select2 if available
            if (window.jQuery && window.jQuery.fn.select2) {
                jQuery('.sl-account').select2({
                    placeholder: 'Tìm tài khoản hoặc email',
                    allowClear: true,
                    width: '100%',
                    matcher: function(params, data) {
                        if (!params.term) {
                            return data;
                        }

                        const searchTerm = params.term.toLowerCase();
                        const text = data.text.toLowerCase();

                        if (text.indexOf(searchTerm) > -1) {
                            return data;
                        }

                        return null;
                    }
                });

                // Handle selection change
                jQuery('.sl-account').on('select2:select', function(e) {
                    const selectedId = e.params.data.id;
                    const selectedUser = users.find(u => u.id == selectedId);
                    
                    // if (selectedUser) {
                    //     // Navigate to account payment page
                    //     window.location.href = `/admin/accounts/${selectedUser.username}/payment`;
                    // }
                });
            }
        }

        function updateStats() {
            const users = @json($users->items());
            let totalBalance = 0;
            let countRetail = 0;
            let countDistributor = 0;
            let countAgent = 0;
            let countAdmin = 0;
            let countActive = 0;

            users.forEach(user => {
                totalBalance += parseFloat(user.balance) || 0;

                if (user.role === 'admin') {
                    countAdmin++;
                } else {
                    if (user.level === 'distributor') {
                        countDistributor++;
                    } else if (user.level === 'agent') {
                        countAgent++;
                    } else {
                        countRetail++;
                    }
                }

                if (user.is_active) {
                    countActive++;
                }
            });

            document.getElementById('total_balance').textContent = totalBalance.toFixed(2);
            document.getElementById('count_retail').textContent = countRetail;
            document.getElementById('count_distributor').textContent = countDistributor;
            document.getElementById('count_agent').textContent = countAgent;
            document.getElementById('count_admin').textContent = countAdmin;
            document.getElementById('count_active').textContent = countActive;
        }



        function resetFilters() {
            document.getElementById('filter_account_type').value = '';
            
            toggleTableLoader(true);

            fetch(`{{ route('admin.accounts.index') }}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                // Cập nhật bảng users
                const newTable = doc.querySelector('#users_table tbody')?.innerHTML;
                if (newTable) {
                    document.querySelector('#users_table tbody').innerHTML = newTable;
                    
                    // Reinitialize KTMenu cho dropdown
                    if (typeof KTMenu !== 'undefined') {
                        KTMenu.createInstances();
                    }
                }

                // Cập nhật stats
                updateStats();
            })
            .catch(error => alert('Có lỗi xảy ra: ' + error.message))
            .finally(() => toggleTableLoader(false));
        }

        function applyFilters() {
            const filterSelect = document.getElementById('filter_account_type');
            const selectedValue = filterSelect.value;

            if (!selectedValue) {
                location.reload();
                return;
            }

            const filterType = filterSelect.options[filterSelect.selectedIndex].getAttribute('data-type');
            const params = new URLSearchParams();
            params.set(filterType === 'role' ? 'role' : 'level', selectedValue);

            toggleTableLoader(true);

            fetch(`{{ route('admin.accounts.index') }}?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                // Cập nhật bảng users
                const newTable = doc.querySelector('#users_table tbody')?.innerHTML;
                if (newTable) {
                    document.querySelector('#users_table tbody').innerHTML = newTable;
                    
                    // Reinitialize KTMenu cho dropdown
                    if (typeof KTMenu !== 'undefined') {
                        KTMenu.createInstances();
                    }
                }

                // Cập nhật stats
                updateStats();
            })
            .catch(error => alert('Có lỗi xảy ra: ' + error.message))
            .finally(() => toggleTableLoader(false));
        }

        function toggleTableLoader(show) {
            const loader = document.getElementById('table-orders_processing');
            const table = document.getElementById('users_table');

            if (loader) loader.style.display = show ? 'block' : 'none';
            if (table) table.style.opacity = show ? '0.4' : '1';
        }

        function showModalCopyRates(data) {
            const modal = new bootstrap.Modal(document.getElementById('modal-copy-rates'));
            const parsedData = JSON.parse(decodeURIComponent(data));
            
            if (parsedData && parsedData.length > 0) {
                document.querySelector('.ipt-from-account').value = parsedData[0].id;
                document.querySelector('.div-to-account input').value = parsedData[0].user;
            }
            
            modal.show();
        }

    </script>

    <!-- Modal Sao chép giá -->
    <div class="modal fade" tabindex="-1" id="modal-copy-rates" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" data-lang="Copy rates">Sao chép giá</h4>
                </div>
                <div class="modal-body">
                    <div class="mb-5">
                        <label class="required form-label" data-lang="From account">Từ tài khoản</label>
                        <select class="form-select form-select-solid ipt-from-account select2-hidden-accessible" data-kt-select2="true" data-dropdown-parent="#modal-copy-rates" data-placeholder="Lựa chọn tài khoản">
                            <option></option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" data-username="{{ $user->username }}" data-email="{{ $user->email }}">
                                    {{ $user->username }} - {{ $user->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="div-to-account">
                        <label class="form-label" data-lang="To account">Đến tài khoản</label>
                        <input type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal" data-lang="button::Close">Đóng</button>
                    <button type="button" class="btn btn-sm btn-primary" data-lang="button::Apply" onclick="copyRates()">Áp dụng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tạo tài khoản mới -->
    <div class="modal fade" id="kt_modal_add_account" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" data-lang="New account">Tạo tài khoản mới</h4>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body d-flex flex-column">
                    <div class="mb-5">
                        <label class="required form-label" data-lang="Username">Tài khoản</label>
                        <input type="text" class="form-control ipt-username">
                    </div>
                    <div class="mb-5">
                        <label class="required form-label">Email</label>
                        <input type="email" class="form-control ipt-email">
                    </div>
                    <div class="mb-5">
                        <label class="required form-label" data-lang="Password">Mật khẩu</label>
                        <input type="password" class="form-control ipt-password">
                    </div>
                    <div class="mb-5">
                        <label class="required form-label">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control ipt-password-confirm">
                    </div>
                    <div class="mb-5">
                        <label class="form-label" data-lang="Percent bonus">Thưởng (%)</label>
                        <input type="number" class="form-control ipt-percent" value="0" min="0" max="100">
                        <span class="text-muted fst-italic fs-7" data-lang="Percent bonus - desc">Nếu bạn đặt phần thưởng ĐẶC BIỆT cho tài khoản này, phần thưởng THANH TOÁN và phần thưởng THÀNH VIÊN sẽ không được sử dụng</span>
                    </div>
                    <div class="mb-5">
                        <label class="required form-label" data-lang="Role">Loại tài khoản</label>
                        <select class="form-select form-select-solid sl-role" data-control="select2" data-hide-search="true">
                            <option value="user" selected data-lang="User">Người dùng</option>
                            <option value="admin" data-lang="Admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-5 div-level">
                        <label class="form-label" data-lang="Level">Cấp độ</label>
                        <select class="form-select form-select-solid sl-level" data-control="select2" data-hide-search="true">
                            <option value="retail" selected data-lang="Retail">Khách lẻ</option>
                            <option value="agent" data-lang="Agent">Đại lý</option>
                            <option value="distributor" data-lang="Distributor">Nhà phân phối</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label class="required form-label" data-lang="Status">Trạng thái</label>
                        <select class="form-select form-select-solid sl-status" data-control="select2" data-hide-search="true">
                            <option value="1" selected data-lang="Active">Kích hoạt</option>
                            <option value="0" data-lang="Suspended">Vô hiệu hóa</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" onclick="addAccount()" data-lang="button::Add">Thêm</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addAccount() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            const data = {
                username: document.querySelector('.ipt-username')?.value.trim(),
                email: document.querySelector('.ipt-email')?.value.trim(),
                password: document.querySelector('.ipt-password')?.value,
                password_confirmation: document.querySelector('.ipt-password-confirm')?.value,
                bonus_percent: document.querySelector('.ipt-percent')?.value.trim(),
                role: document.querySelector('.sl-role')?.value,
                level: document.querySelector('.sl-level')?.value,
                is_active: document.querySelector('.sl-status')?.value
            };

            // Validation
            if (!data.email) {
                if (typeof showToast === 'function') {
                    showToast('Vui lòng nhập email!', 'warning');
                }
                return;
            }

            if (!data.password) {
                if (typeof showToast === 'function') {
                    showToast('Vui lòng nhập mật khẩu!', 'warning');
                }
                return;
            }

            if (data.password !== data.password_confirmation) {
                if (typeof showToast === 'function') {
                    showToast('Mật khẩu xác nhận không khớp!', 'warning');
                }
                return;
            }

            if (!data.role) {
                if (typeof showToast === 'function') {
                    showToast('Vui lòng chọn loại tài khoản!', 'warning');
                }
                return;
            }

            fetch('/admin/accounts', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        // Close modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('kt_modal_add_account'));
                        if (modal) modal.hide();

                        // Clear form
                        document.querySelector('.ipt-username').value = '';
                        document.querySelector('.ipt-email').value = '';
                        document.querySelector('.ipt-password').value = '';
                        document.querySelector('.ipt-password-confirm').value = '';
                        document.querySelector('.ipt-percent').value = '0';
                        document.querySelector('.sl-role').value = '';
                        document.querySelector('.sl-level').value = '';
                        document.querySelector('.sl-status').value = '';

                        // Trigger select2 change
                        if (window.jQuery) {
                            jQuery('.sl-role, .sl-level, .sl-status').trigger('change');
                        }

                        // Reload page to show new account
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    } else {
                        if (typeof showToast === 'function') {
                            showToast(result.message || 'Tạo tài khoản thất bại!', 'error');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (typeof showToast === 'function') {
                        showToast('Có lỗi xảy ra!', 'error');
                    }
                });
        }

        // Show/hide level select based on role
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.querySelector('.sl-role');
            const levelDiv = document.querySelector('.div-level');

            if (roleSelect && levelDiv) {
                roleSelect.addEventListener('change', function() {
                    if (this.value === 'user') {
                        levelDiv.style.display = '';
                    } else {
                        levelDiv.style.display = 'none';
                        document.querySelector('.sl-level').value = '';
                        if (window.jQuery) {
                            jQuery('.sl-level').trigger('change');
                        }
                    }
                });
            }
        });
    </script>

@endsection
