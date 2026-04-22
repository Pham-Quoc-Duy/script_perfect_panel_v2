<div class="card mb-6">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap">
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed symbol-circle position-relative">
                    <img src="https://cdn.whoispanel.com/1/media/avatars/300-1.jpg" alt="image">
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <span class="fs-2 fw-bolder ls-2 me-1">{{ $account->username }}</span>
                            <span class="badge {{ $account->is_active ? 'badge-success' : 'badge-danger' }}"
                                data-lang="{{ $account->is_active ? 'Active' : 'Inactive' }}">
                                {{ $account->is_active ? 'Kích hoạt' : 'Vô hiệu hóa' }}
                            </span>
                        </div>
                        <div class="d-flex flex-wrap fs-7 pe-2 mb-2">
                            <span class="d-flex align-items-center text-gray-500 me-5">
                                <i class="fa-solid fa-id-card fs-5 me-2"></i>
                                <span id="account-id">{{ $account->id }}</span>
                            </span>
                            <span class="d-flex align-items-center text-gray-500 fw-semibold me-5">
                                <i class="fa-solid fa-circle-user fs-5 me-2"></i>
                                <span class="fw-bold">{{ $account->name }}</span>
                            </span>
                            <span class="d-flex align-items-center text-gray-500 fw-semibold me-5">
                                <i class="fa-solid fa-user-secret fs-5 me-2"></i>
                                <span class="text-primary">{{ $account->role === 'admin' ? 'Admin' : 'User' }}</span>
                            </span>
                        </div>
                        <div class="d-flex flex-wrap fs-7 pe-2 mb-2">
                            <span class="d-flex align-items-center text-gray-500 me-5">
                                <i class="fa-solid fa-phone fs-5 me-2"></i>
                                {{ $account->phone ?? '' }}
                            </span>
                            <span class="d-flex align-items-center text-gray-500 me-5">
                                <i class="fa-solid fa-envelope fs-5 me-2"></i>
                                {{ $account->email }}
                            </span>
                            <span class="d-flex align-items-center text-gray-500 me-5">
                                <i class="fa-solid fa-percent fs-5 me-2"></i>
                                {{ $account->bonus_percent ?? 0 }}
                            </span>
                        </div>
                        <div class="d-flex flex-wrap fs-7 mb-2 pe-2">
                            <span class="d-flex align-items-center text-gray-500 me-5">
                                <span class="fst-italic" data-lang="Created at">Ngày tạo</span>:
                                {{ $account->created_at?->format('Y-m-d H:i:s') ?? '' }}
                            </span>
                            <span class="d-flex align-items-center text-gray-500">
                                <span class="fst-italic" data-lang="Last login">Đăng nhập lần cuối</span>:
                                {{ $lastLogin?->created_at?->format('Y-m-d H:i:s') ?? '' }}
                            </span>
                        </div>
                    </div>
                    <div class="d-flex my-4">
                        <button class="btn btn-sm btn-primary me-3" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_edit_account"><span data-lang="Customize">Tùy chỉnh</span></button>
                    </div>
                </div>
                <div class="d-flex flex-wrap flex-stack">
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <div class="d-flex flex-wrap">
                            <div class="border border-gray-300 border-dashed rounded py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="fs-2 ls-2 fw-bold text-primary account-fund">$
                                        {{ formatCharge($account->balance) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
            <li class="nav-item">
                <a class="nav-link ms-0 me-6 {{ Route::currentRouteName() === 'admin.accounts.payment' ? 'active' : '' }}"
                    href="{{ route('admin.accounts.payment', $account->username) }}" data-lang="Top up">Nạp tiền</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6 {{ Route::currentRouteName() === 'admin.accounts.customrates' ? 'active' : '' }}"
                    href="{{ route('admin.accounts.customrates', $account->username) }}" data-lang="Custom rates">Thiết lập giá</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6 {{ Route::currentRouteName() === 'admin.accounts.signinhistory' ? 'active' : '' }}"
                    href="{{ route('admin.accounts.signinhistory', $account->username) }}" data-lang="Sign in history">Lịch sử đăng nhập</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6 {{ Route::currentRouteName() === 'admin.accounts.transactions' ? 'active' : '' }}"
                    href="{{ route('admin.accounts.transactions', $account->username) }}" data-lang="Transactions">Giao dịch</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6 {{ Route::currentRouteName() === 'admin.accounts.affiliates' ? 'active' : '' }}"
                    href="{{ route('admin.accounts.affiliates', $account->username) }}" data-lang="Affiliates">Tiếp thị liên kết</a>
            </li>
        </ul>
    </div>
</div>
@include('adminpanel.accounts.partials.edit-account')