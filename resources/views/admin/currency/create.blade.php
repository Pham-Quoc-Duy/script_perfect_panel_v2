@extends('admin.layouts.app')

@section('title', 'Thêm tiền tệ mới')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Thêm tiền tệ mới',
                    'breadcrumb' => 'Tiền tệ / Thêm mới',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Thông tin tiền tệ</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.currency.store') }}" method="POST">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="code" class="form-label">Mã tiền tệ <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                                       id="code" name="code" value="{{ old('code') }}" 
                                                       placeholder="Ví dụ: USD" maxlength="3" style="text-transform: uppercase;">
                                                @error('code')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Tên tiền tệ <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                       id="name" name="name" value="{{ old('name') }}" 
                                                       placeholder="Ví dụ: US Dollar">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="symbol" class="form-label">Ký hiệu <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('symbol') is-invalid @enderror" 
                                                       id="symbol" name="symbol" value="{{ old('symbol') }}" 
                                                       placeholder="Ví dụ: $">
                                                @error('symbol')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="exchange_rate" class="form-label">Tỷ giá hối đoái <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('exchange_rate') is-invalid @enderror" 
                                                       id="exchange_rate" name="exchange_rate" value="{{ old('exchange_rate', '1.00000000') }}" 
                                                       step="0.00000001" min="0.00000001"
                                                       placeholder="1.00000000">
                                                <div class="form-text">Tỷ giá so với USD (1 USD = ? đơn vị tiền tệ này)</div>
                                                @error('exchange_rate')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="symbol_position" class="form-label">Vị trí ký hiệu <span class="text-danger">*</span></label>
                                                <select class="form-select @error('symbol_position') is-invalid @enderror" 
                                                        id="symbol_position" name="symbol_position">
                                                    <option value="before" {{ old('symbol_position') === 'before' ? 'selected' : '' }}>
                                                        Trước số tiền ($100)
                                                    </option>
                                                    <option value="after" {{ old('symbol_position') === 'after' ? 'selected' : '' }}>
                                                        Sau số tiền (100$)
                                                    </option>
                                                </select>
                                                @error('symbol_position')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                                                <select class="form-select @error('status') is-invalid @enderror" 
                                                        id="status" name="status">
                                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                                        Hoạt động
                                                    </option>
                                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                                        Tạm dừng
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="domain" class="form-label">Domain</label>
                                                <input type="text" class="form-control @error('domain') is-invalid @enderror" 
                                                       id="domain" name="domain" value="{{ old('domain') }}" 
                                                       placeholder="Để trống cho tất cả domain">
                                                <div class="form-text">Để trống nếu áp dụng cho tất cả domain</div>
                                                @error('domain')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="sync" name="sync" value="1" 
                                                   {{ old('sync') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sync">
                                                Tự động đồng bộ tỷ giá từ API
                                            </label>
                                            <div class="form-text">Khi bật, tỷ giá sẽ được cập nhật tự động từ API bên ngoài</div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bx bx-save me-1"></i>Lưu tiền tệ
                                        </button>
                                        <a href="{{ route('admin.currency.index') }}" class="btn btn-secondary">
                                            <i class="bx bx-x me-1"></i>Hủy
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Hướng dẫn</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">
                                    <h6 class="alert-heading">Lưu ý quan trọng:</h6>
                                    <ul class="mb-0">
                                        <li>Tỷ giá được tính theo USD làm chuẩn</li>
                                        <li>Ví dụ: 1 USD = 23,000 VND thì nhập 23000</li>
                                        <li>Bật đồng bộ tự động để cập nhật tỷ giá theo thời gian thực</li>
                                        <li>Domain để trống sẽ áp dụng cho tất cả trang web</li>
                                    </ul>
                                </div>
                                
                                <div class="mt-3">
                                    <h6>Ví dụ các loại tiền tệ phổ biến:</h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Mã</th>
                                                    <th>Ký hiệu</th>
                                                    <th>Vị trí</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>USD</td>
                                                    <td>$</td>
                                                    <td>Trước</td>
                                                </tr>
                                                <tr>
                                                    <td>EUR</td>
                                                    <td>€</td>
                                                    <td>Trước</td>
                                                </tr>
                                                <tr>
                                                    <td>VND</td>
                                                    <td>₫</td>
                                                    <td>Sau</td>
                                                </tr>
                                                <tr>
                                                    <td>JPY</td>
                                                    <td>¥</td>
                                                    <td>Trước</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Auto uppercase currency code
            $('#code').on('input', function() {
                this.value = this.value.toUpperCase();
            });
            
            // Preview currency format
            function updatePreview() {
                const symbol = $('#symbol').val() || '$';
                const position = $('#symbol_position').val();
                const amount = '100.00';
                
                let preview = position === 'before' ? symbol + amount : amount + symbol;
                $('#symbol_position').siblings('.form-text').remove();
                $('#symbol_position').after(`<div class="form-text">Ví dụ: ${preview}</div>`);
            }
            
            $('#symbol, #symbol_position').on('input change', updatePreview);
            updatePreview(); // Initial preview
        });
    </script>
@endpush