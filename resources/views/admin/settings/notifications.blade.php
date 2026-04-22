@extends('admin.settings.layout')

@push('styles')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.css">
@endpush

@section('tab-content')
    <form action="{{ route('admin.settings.update.notifications') }}" method="POST" id="notificationsForm">
        @csrf
        @method('PUT')
        
        <h5 class="mb-3">Cài đặt Telegram Bot</h5>
        <p class="text-muted mb-4">Cấu hình bot Telegram để nhận thông báo về đơn hàng, thanh toán và các sự kiện quan trọng</p>
        
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Trạng thái Telegram</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input @error('telegram_status') is-invalid @enderror" 
                               type="checkbox" id="telegram_status" name="telegram_status" value="1"
                               {{ old('telegram_status', $config->telegram_status) ? 'checked' : '' }}>
                        <label class="form-check-label" for="telegram_status">
                            Kích hoạt thông báo Telegram
                        </label>
                    </div>
                    @error('telegram_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="telegram_bot" class="form-label">Telegram Bot Token</label>
                    <input type="text" class="form-control @error('telegram_bot') is-invalid @enderror" 
                        id="telegram_bot" name="telegram_bot" value="{{ old('telegram_bot', $config->telegram_bot) }}" 
                        placeholder="123456789:ABCdefGHIjklMNOpqrsTUVwxyz">
                    <small class="text-muted">Token bot từ @BotFather</small>
                    @error('telegram_bot')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="telegram_chat_id" class="form-label">Telegram Chat ID</label>
                    <input type="text" class="form-control @error('telegram_chat_id') is-invalid @enderror" 
                        id="telegram_chat_id" name="telegram_chat_id" value="{{ old('telegram_chat_id', $config->telegram_chat_id) }}" 
                        placeholder="-1001234567890">
                    <small class="text-muted">ID của group/channel nhận thông báo</small>
                    @error('telegram_chat_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-lg-6">
                <div class="alert alert-success">
                    <h6 class="alert-heading">Hướng dẫn cài đặt Telegram:</h6>
                    <ol class="mb-0 small">
                        <li>Mở Telegram và tìm <strong>@BotFather</strong></li>
                        <li>Gửi lệnh <code>/newbot</code> để tạo bot mới</li>
                        <li>Đặt tên và username cho bot</li>
                        <li>Copy <strong>Bot Token</strong> và dán vào trường trên</li>
                        <li>Thêm bot vào group/channel muốn nhận thông báo</li>
                        <li>Lấy <strong>Chat ID</strong> của group/channel</li>
                        <li>Dán Chat ID vào trường trên</li>
                        <li>Bấm "Test kết nối" để kiểm tra</li>
                    </ol>
                </div>

                <div class="alert alert-warning">
                    <h6 class="alert-heading">Cách lấy Chat ID:</h6>
                    <ul class="mb-0 small">
                        <li><strong>Group:</strong> Thêm bot vào group, gửi tin nhắn, sau đó truy cập: 
                            <br><code>https://api.telegram.org/bot[BOT_TOKEN]/getUpdates</code></li>
                        <li><strong>Channel:</strong> Thêm bot làm admin channel, Chat ID sẽ có dạng <code>-100xxxxxxxxx</code></li>
                        <li><strong>Private:</strong> Chat với bot, Chat ID sẽ là số dương</li>
                    </ul>
                </div>
            </div>
        </div>

        

        <div class="row mt-4">
            <div class="col-12">
                <h5 class="mb-3">Nội dung thông báo hệ thống</h5>
                <p class="text-muted mb-3">Nhập nội dung thông báo sẽ được hiển thị cho người dùng. Hỗ trợ định dạng HTML cơ bản.</p>
                <div class="mb-3">
                    <textarea id="notice_system" name="notice_system" class="form-control @error('notice_system') is-invalid @enderror" rows="8" placeholder="Nhập nội dung thông báo...">{{ old('notice_system', $config->notice_system ?? '') }}</textarea>
                    <small class="text-muted d-block mt-2">
                        <i class="bx bx-info-circle"></i> Tối đa 5000 ký tự. Hỗ trợ: Heading, Bold, Italic, Link, Danh sách
                    </small>
                    @error('notice_system')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
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
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>

$(document).ready(function() {
    
    // Initialize CKEditor for notice textarea
    ClassicEditor
        .create(document.querySelector('#notice_system'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            }
        })
        .then(editor => {
            window.noticeEditor = editor;
        })
        .catch(error => {
            console.error('CKEditor initialization error:', error);
        });
    
    // Form submission
    $('#notificationsForm').on('submit', function(e) {
        // Sync editor data before submit
        if (window.noticeEditor) {
            const noticeTextarea = document.getElementById('notice_system');
            if (noticeTextarea) {
                noticeTextarea.value = window.noticeEditor.getData();
            }
        }
        
        // Add hidden input for unchecked checkbox
        if (!$('#telegram_status').is(':checked')) {
            $(this).append('<input type="hidden" name="telegram_status" value="0">');
        }
        
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i>Đang lưu...');
    });
});
</script>
@endpush