@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa thành viên')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Chỉnh sửa thành viên',
                    'breadcrumb' => 'Thành viên',
                ])

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="bx bx-edit me-2"></i>Chỉnh sửa thông tin thành viên
                                </h5>
                            </div>
                            <div class="card-body">
                                <form id="editUserForm" method="POST" action="{{ route('admin.users.update', $user) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Tên đăng nhập</label>
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}">
                                                @error('username')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Số điện thoại</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="role" class="form-label">Vai trò <span class="text-danger">*</span></label>
                                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Thành viên</option>
                                                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                                                </select>
                                                @error('role')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="level" class="form-label">Cấp bậc</label>
                                                <select class="form-select @error('level') is-invalid @enderror" id="level" name="level">
                                                    <option value="">-- Chọn cấp bậc --</option>
                                                    <option value="retail" {{ old('level', $user->level) === 'retail' ? 'selected' : '' }}>Khách lẻ</option>
                                                    <option value="agent" {{ old('level', $user->level) === 'agent' ? 'selected' : '' }}>Đại lý</option>
                                                    <option value="distributor" {{ old('level', $user->level) === 'distributor' ? 'selected' : '' }}>Nhà phân phối</option>
                                                </select>
                                                @error('level')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="balance" class="form-label">Số dư</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" class="form-control @error('balance') is-invalid @enderror" id="balance" name="balance" value="{{ old('balance', $user->balance) }}" min="0" step="0.01">
                                                </div>
                                                @error('balance')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Trạng thái</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_active">Kích hoạt tài khoản</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Mật khẩu mới</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Để trống nếu không muốn thay đổi">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Tối thiểu 8 ký tự</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu mới">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bx bx-save me-1"></i>Lưu thay đổi
                                        </button>
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-secondary">
                                            <i class="bx bx-arrow-back me-1"></i>Quay lại
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Thông tin</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label text-muted">ID</label>
                                    <p class="fw-medium">#{{ $user->id }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted">Ngày tạo</label>
                                    <p class="fw-medium">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted">Cập nhật cuối</label>
                                    <p class="fw-medium">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
