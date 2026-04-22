@extends('clients.theme-default.layouts.app')

@section('title', 'Tạo Ticket Mới')

@section('content')

    <!-- Header -->
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">Tạo Ticket Mới</h4>
                        <p class="text-muted mb-0">Gửi yêu cầu hỗ trợ của bạn</p>
                    </div>
                    <a href="{{ route('clients.tickets.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Form -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="component_card">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-life-ring"></i> Thông tin Ticket
                            </h6>
                        </div>
                        <div class="card-body">
                            <form id="ticketForm">
                                <div class="alert alert-dismissible alert-danger" id="errorAlert" style="display: none">
                                    <button type="button" class="close" onclick="hideAlert('errorAlert')">×</button>
                                    <div id="errorContent"></div>
                                </div>

                                <div class="alert alert-dismissible alert-success" id="successAlert" style="display: none">
                                    <button type="button" class="close" onclick="hideAlert('successAlert')">×</button>
                                    <div id="successContent"></div>
                                </div>

                                <div class="form-group">
                                    <label for="subject" class="control-label">Tiêu đề <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="subject" name="subject"
                                        placeholder="Nhập tiêu đề ticket..." required>
                                </div>

                                <div class="form-group">
                                    <label for="priority" class="control-label">Độ ưu tiên <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="priority" name="priority" required>
                                        <option value="">Chọn độ ưu tiên</option>
                                        <option value="low">Thấp - Câu hỏi thông thường</option>
                                        <option value="medium">Trung bình - Vấn đề quan trọng</option>
                                        <option value="high">Cao - Vấn đề nghiêm trọng</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="message" class="control-label">Nội dung <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="8" id="message" name="message"
                                        placeholder="Mô tả chi tiết vấn đề của bạn..." required></textarea>
                                    <small class="form-text text-muted">
                                        Hãy mô tả chi tiết vấn đề để chúng tôi có thể hỗ trợ bạn tốt nhất.
                                    </small>
                                </div>

                                <div class="component_button_submit">
                                    <button type="submit" class="btn btn-block btn-big-primary" id="submitBtn">
                                        <i class="fas fa-paper-plane"></i> Tạo Ticket
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Help Card -->
                <div class="component_card mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-info-circle"></i> Hướng dẫn tạo ticket
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-primary">Độ ưu tiên:</h6>
                                    <ul class="list-unstyled">
                                        <li><span class="badge badge-danger me-2">Cao</span> Vấn đề nghiêm trọng, cần xử lý
                                            ngay</li>
                                        <li><span class="badge badge-warning me-2">Trung bình</span> Vấn đề quan trọng, cần
                                            xử lý sớm</li>
                                        <li><span class="badge badge-secondary me-2">Thấp</span> Câu hỏi thông thường, tư
                                            vấn</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-primary">Mẹo viết ticket hiệu quả:</h6>
                                    <ul class="list-unstyled">
                                        <li>• Tiêu đề ngắn gọn, súc tích</li>
                                        <li>• Mô tả chi tiết vấn đề</li>
                                        <li>• Cung cấp thông tin liên quan</li>
                                        <li>• Đính kèm ảnh chụp màn hình nếu cần</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.getElementById('ticketForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;

            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang tạo...';

            // Hide previous alerts
            hideAlert('errorAlert');
            hideAlert('successAlert');

            // Get form data
            const formData = {
                subject: document.getElementById('subject').value,
                priority: document.getElementById('priority').value,
                message: document.getElementById('message').value,
                _token: '{{ csrf_token() }}'
            };

            try {
                const response = await fetch('{{ route('clients.tickets.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();

                if (result.success) {
                    showAlert('successAlert', result.message);

                    // Redirect after 2 seconds
                    setTimeout(() => {
                        if (result.redirect) {
                            window.location.href = result.redirect;
                        } else {
                            window.location.href = '{{ route('clients.tickets.index') }}';
                        }
                    }, 2000);
                } else {
                    if (result.errors) {
                        let errorText = '';
                        for (const field in result.errors) {
                            errorText += result.errors[field].join('<br>') + '<br>';
                        }
                        showAlert('errorAlert', errorText);
                    } else {
                        showAlert('errorAlert', result.message || 'Có lỗi xảy ra khi tạo ticket.');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                showAlert('errorAlert', 'Có lỗi xảy ra khi gửi yêu cầu. Vui lòng thử lại.');
            } finally {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });

        function showAlert(alertId, message) {
            const alert = document.getElementById(alertId);
            const content = document.getElementById(alertId.replace('Alert', 'Content'));
            content.innerHTML = message;
            alert.style.display = 'block';
        }

        function hideAlert(alertId) {
            document.getElementById(alertId).style.display = 'none';
        }
    </script>

@endsection
