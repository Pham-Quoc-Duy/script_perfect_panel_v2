<!-- Modal Tùy chỉnh tài khoản -->
<div class="modal fade" id="kt_modal_edit_account" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-450px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="fw-bold" data-lang="Edit account">Tùy chỉnh tài khoản</h4>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column scroll-y me-n7 pe-7">
                    <div class="mb-5">
                        <label class="required form-label" data-lang="Username">Tài khoản</label>
                        <input type="text" class="form-control form-control-solid ipt-user" value="{{ $account->username ?? '' }}" readonly>
                    </div>
                    <div class="mb-5">
                        <label class="required form-label" data-lang="Name">Tên</label>
                        <input type="text" class="form-control form-control-solid ipt-name" value="{{ $account->name ?? '' }}">
                    </div>
                    <div class="mb-5">
                        <label class="required form-label">Email</label>
                        <input type="email" class="form-control form-control-solid ipt-email" value="{{ $account->email ?? '' }}">
                    </div>
                    <div class="mb-5">
                        <label class="required form-label" data-lang="Phone">Số điện thoại</label>
                        <input type="text" class="form-control form-control-solid ipt-phone" value="{{ $account->phone ?? '' }}">
                    </div>
                    <div class="mb-5">
                        <label class="required form-label" data-lang="Password">Mật khẩu</label>
                        <input type="password" class="form-control form-control-solid ipt-password">
                        <span class="text-muted" data-lang="Leave blank if you don't want to change the password">Để trống nếu không muốn thay đổi mật khẩu</span>
                    </div>
                    <div class="mb-5">
                        <label class="required form-label" data-lang="Percent bonus">Thưởng (%)</label>
                        <input type="number" class="form-control form-control-solid ipt-percent" value="{{ $account->bonus_percent ?? 0 }}" min="0" max="100">
                        <span class="text-muted fst-italic" data-lang="Bonus note">Nếu bạn đặt phần thưởng đặc biệt cho tài khoản này, phần thưởng thanh toán và phần thưởng thành viên sẽ không được sử dụng</span>
                    </div>
                    <div class="mb-5">
                        <label class="required form-label" data-lang="Role">Loại tài khoản</label>
                        <select class="form-select form-select-solid sl-role" data-kt-select2="true" data-hide-search="true">
                            <option value="retail" {{ ($account->level ?? '') === 'retail' ? 'selected' : '' }} data-lang="Retail">Khách lẻ</option>
                            <option value="admin" {{ ($account->role ?? '') === 'admin' ? 'selected' : '' }} data-lang="Admin">Admin</option>
                            <option value="staff" {{ ($account->role ?? '') === 'staff' ? 'selected' : '' }} data-lang="Staff">Nhân viên</option>
                            <option value="agent" {{ ($account->level ?? '') === 'agent' ? 'selected' : '' }} data-lang="Agent">Đại lý</option>
                            <option value="distributor" {{ ($account->level ?? '') === 'distributor' ? 'selected' : '' }} data-lang="Distributor">Nhà phân phối</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label class="required form-label" data-lang="Status">Trạng thái</label>
                        <select class="form-select form-select-solid sl-status" data-kt-select2="true" data-hide-search="true">
                            <option value="1" {{ ($account->is_active ?? false) ? 'selected' : '' }} data-lang="Active">Kích hoạt</option>
                            <option value="0" {{ !($account->is_active ?? false) ? 'selected' : '' }} data-lang="Inactive">Vô hiệu hóa</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 flex-center">
                <button type="button" class="btn btn-primary" data-lang="button::Update"
                    onclick="updateAccount('{{ $account->id }}', document.querySelector('.ipt-user').value.trim(), document.querySelector('.ipt-name').value.trim(), document.querySelector('.ipt-email').value.trim(), document.querySelector('.ipt-phone').value.trim(), document.querySelector('.ipt-password').value.trim(), document.querySelector('.ipt-percent').value.trim(), document.querySelector('.sl-role').value.trim(), document.querySelector('.sl-status').value.trim())">Cập nhật</button>
            </div>
        </div>
    </div>
</div>
