@extends('admin.settings.layout')

@section('tab-content')
    <form action="{{ route('admin.settings.update.social') }}" method="POST" id="socialForm">
        @csrf
        @method('PUT')
        
        <h5 class="mb-3">Liên kết mạng xã hội</h5>
        <p class="text-muted mb-4">Cấu hình các liên kết mạng xã hội để hiển thị trên website</p>
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="link_facebook" class="form-label">
                        <i class="bx bxl-facebook text-primary me-2"></i>Facebook
                    </label>
                    <input type="url" class="form-control @error('link_facebook') is-invalid @enderror" 
                        id="link_facebook" name="link_facebook" value="{{ old('link_facebook', $config->link_facebook) }}" 
                        placeholder="https://facebook.com/yourpage">
                    @error('link_facebook')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="link_telegram" class="form-label">
                        <i class="bx bxl-telegram text-info me-2"></i>Telegram
                    </label>
                    <input type="url" class="form-control @error('link_telegram') is-invalid @enderror" 
                        id="link_telegram" name="link_telegram" value="{{ old('link_telegram', $config->link_telegram) }}" 
                        placeholder="https://t.me/yourchannel">
                    @error('link_telegram')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="link_zalo" class="form-label">
                        <i class="bx bx-message-rounded-dots text-primary me-2"></i>Zalo
                    </label>
                    <input type="url" class="form-control @error('link_zalo') is-invalid @enderror" 
                        id="link_zalo" name="link_zalo" value="{{ old('link_zalo', $config->link_zalo) }}" 
                        placeholder="https://zalo.me/yourpage">
                    @error('link_zalo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="link_whatsapp" class="form-label">
                        <i class="bx bxl-whatsapp text-success me-2"></i>WhatsApp
                    </label>
                    <input type="url" class="form-control @error('link_whatsapp') is-invalid @enderror" 
                        id="link_whatsapp" name="link_whatsapp" value="{{ old('link_whatsapp', $config->link_whatsapp) }}" 
                        placeholder="https://wa.me/1234567890">
                    @error('link_whatsapp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-12">
                <div class="alert alert-info">
                    <h6 class="alert-heading">Hướng dẫn:</h6>
                    <ul class="mb-0 small">
                        <li><strong>Facebook:</strong> Nhập URL trang Facebook của bạn (ví dụ: https://facebook.com/yourpage)</li>
                        <li><strong>Telegram:</strong> Nhập URL kênh hoặc nhóm Telegram (ví dụ: https://t.me/yourchannel)</li>
                        <li><strong>Zalo:</strong> Nhập URL trang Zalo OA (ví dụ: https://zalo.me/yourpage)</li>
                        <li><strong>WhatsApp:</strong> Nhập URL WhatsApp với số điện thoại (ví dụ: https://wa.me/1234567890)</li>
                        <li>Để trống các trường không muốn hiển thị</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Nút lưu -->
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="reset" class="btn btn-secondary">
                <i class="bx bx-reset me-1"></i>Đặt lại
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-save me-1"></i>Lưu cài đặt
            </button>
        </div>
    </form>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Form submission
    $('#socialForm').on('submit', function(e) {
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i>Đang lưu...');
    });
});
</script>
@endpush