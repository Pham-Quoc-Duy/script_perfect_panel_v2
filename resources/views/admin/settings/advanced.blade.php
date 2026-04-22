@extends('admin.settings.layout')

@section('tab-content')
    <form action="{{ route('admin.settings.update.advanced') }}" method="POST" id="advancedForm">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-12">
                <h5 class="mb-3">Custom Scripts</h5>
                <p class="text-muted mb-4">Thêm mã JavaScript/CSS tùy chỉnh vào website. Hãy cẩn thận khi sử dụng tính năng này.</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                <!-- Script Header -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="card-title mb-0">
                            <i class="bx bx-code-alt text-primary me-2"></i>Script Header
                        </h6>
                        <small class="text-muted">Mã sẽ được chèn vào thẻ &lt;head&gt; của tất cả các trang</small>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control code-editor @error('script_header') is-invalid @enderror" 
                            id="script_header" name="script_header" rows="10"
                            placeholder="<!-- Ví dụ: Google Analytics, CSS tùy chỉnh -->&#10;&lt;script&gt;&#10;  // Your JavaScript code here&#10;&lt;/script&gt;">{{ old('script_header', $config->script_header ?? '') }}</textarea>
                        @error('script_header')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <!-- Character count -->
                        <div class="mt-2">
                            <small class="text-muted">
                                <span id="header-count">{{ strlen($config->script_header ?? '') }}</span> ký tự
                                @if($config->script_header)
                                    <span class="text-success ms-2">✓ Đã lưu</span>
                                @endif
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Script Body -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="card-title mb-0">
                            <i class="bx bx-code-alt text-warning me-2"></i>Script Body (Top)
                        </h6>
                        <small class="text-muted">Mã sẽ được chèn vào đầu thẻ &lt;body&gt;</small>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control code-editor @error('script_body') is-invalid @enderror" 
                            id="script_body" name="script_body" rows="10"
                            placeholder="<!-- Ví dụ: Google Tag Manager (noscript) -->&#10;&lt;noscript&gt;&#10;  &lt;iframe src=&quot;https://www.googletagmanager.com/ns.html?id=GTM-XXXXXX&quot;&gt;&lt;/iframe&gt;&#10;&lt;/noscript&gt;">{{ old('script_body', $config->script_body ?? '') }}</textarea>
                        @error('script_body')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <!-- Character count -->
                        <div class="mt-2">
                            <small class="text-muted">
                                <span id="body-count">{{ strlen($config->script_body ?? '') }}</span> ký tự
                                @if($config->script_body)
                                    <span class="text-success ms-2">✓ Đã lưu</span>
                                @endif
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Script Footer -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="card-title mb-0">
                            <i class="bx bx-code-alt text-success me-2"></i>Script Footer
                        </h6>
                        <small class="text-muted">Mã sẽ được chèn vào cuối thẻ &lt;body&gt;</small>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control code-editor @error('script_footer') is-invalid @enderror" 
                            id="script_footer" name="script_footer" rows="10"
                            placeholder="<!-- Ví dụ: Chat widget, JavaScript libraries -->&#10;&lt;script&gt;&#10;  // Chat widget or other scripts&#10;&lt;/script&gt;">{{ old('script_footer', $config->script_footer ?? '') }}</textarea>
                        @error('script_footer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <!-- Character count -->
                        <div class="mt-2">
                            <small class="text-muted">
                                <span id="footer-count">{{ strlen($config->script_footer ?? '') }}</span> ký tự
                                @if($config->script_footer)
                                    <span class="text-success ms-2">✓ Đã lưu</span>
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Security Warning -->
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white">
                        <h6 class="card-title mb-0">⚠️ Cảnh báo bảo mật</h6>
                    </div>
                    <div class="card-body">
                        <ul class="mb-0 small">
                            <li><strong>Chỉ thêm mã từ nguồn tin cậy</strong></li>
                            <li>Mã độc có thể làm hỏng website</li>
                            <li>Kiểm tra kỹ mã trước khi lưu</li>
                            <li>Backup website trước khi thay đổi</li>
                            <li>Test trên môi trường development</li>
                        </ul>
                    </div>
                </div>

                <!-- Position Guide -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="card-title mb-0">📍 Vị trí chèn mã</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-primary me-2">1</span>
                                <strong>Header Scripts</strong>
                            </div>
                            <small class="text-muted">
                                Chèn vào &lt;head&gt;<br>
                                <strong>Tốt cho:</strong> CSS, Meta tags, Analytics
                            </small>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-warning me-2">2</span>
                                <strong>Body Scripts</strong>
                            </div>
                            <small class="text-muted">
                                Chèn vào đầu &lt;body&gt;<br>
                                <strong>Tốt cho:</strong> Noscript tags, GTM
                            </small>
                        </div>
                        
                        <div class="mb-0">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-success me-2">3</span>
                                <strong>Footer Scripts</strong>
                            </div>
                            <small class="text-muted">
                                Chèn vào cuối &lt;body&gt;<br>
                                <strong>Tốt cho:</strong> Chat widgets, JS libraries
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Quick Examples -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">💡 Ví dụ nhanh</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-outline-primary w-100 example-btn" 
                                data-target="script_header" data-example="analytics">
                                <i class="bx bx-bar-chart me-1"></i>Google Analytics
                            </button>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-outline-info w-100 example-btn" 
                                data-target="script_header" data-example="css">
                                <i class="bx bx-palette me-1"></i>Custom CSS
                            </button>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-outline-warning w-100 example-btn" 
                                data-target="script_body" data-example="gtm">
                                <i class="bx bx-code-block me-1"></i>Google Tag Manager
                            </button>
                        </div>
                        <div class="mb-0">
                            <button type="button" class="btn btn-sm btn-outline-success w-100 example-btn" 
                                data-target="script_footer" data-example="chat">
                                <i class="bx bx-chat me-1"></i>Chat Widget
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <button type="button" class="btn btn-warning me-2" id="validateScripts">
                            <i class="bx bx-check-circle me-1"></i>Kiểm tra mã
                        </button>
                        <button type="button" class="btn btn-info me-2" id="clearAll">
                            <i class="bx bx-trash me-1"></i>Xóa tất cả
                        </button>
                    </div>
                    <div>
                        <button type="reset" class="btn btn-secondary me-2">
                            <i class="bx bx-reset me-1"></i>Đặt lại
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i>Lưu cài đặt
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Validation Results -->
        <div id="validation-results" class="mt-3"></div>
    </form>
@endsection