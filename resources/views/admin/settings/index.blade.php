@extends('admin.layouts.app')

@section('title', 'Cấu hình hệ thống')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Cấu hình hệ thống',
                    'breadcrumb' => 'Cài đặt',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#general" role="tab">
                                                <i class="bx bx-cog me-2"></i>
                                                <span class="d-none d-sm-block">Thông tin chung</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#appearance" role="tab">
                                                <i class="bx bx-palette me-2"></i>
                                                <span class="d-none d-sm-block">Giao diện</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#social" role="tab">
                                                <i class="bx bx-share-alt me-2"></i>
                                                <span class="d-none d-sm-block">Mạng xã hội</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#pricing" role="tab">
                                                <i class="bx bx-dollar me-2"></i>
                                                <span class="d-none d-sm-block">Giá & Hoa hồng</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#notifications" role="tab">
                                                <i class="bx bx-bell me-2"></i>
                                                <span class="d-none d-sm-block">Thông báo</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#email" role="tab">
                                                <i class="bx bx-envelope me-2"></i>
                                                <span class="d-none d-sm-block">Email</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#advanced" role="tab">
                                                <i class="bx bx-code-alt me-2"></i>
                                                <span class="d-none d-sm-block">Nâng cao</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#advanced" role="tab">
                                                <i class="bx bx-code-alt me-2"></i>
                                                <span class="d-none d-sm-block">Nâng cao</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content p-3 text-muted">
                                        <!-- Thông tin chung -->
                                        <div class="tab-pane active" id="general" role="tabpanel">
                                            <form action="{{ route('admin.settings.update.general') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h5 class="mb-3">Thông tin website</h5>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="title" class="form-label">Tiêu đề website <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                                                    id="title" name="title" value="{{ old('title', $config->title) }}" 
                                                                    required placeholder="Perfect Panel Vietnam">
                                                                @error('title')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="keywords" class="form-label">Từ khóa SEO</label>
                                                                <input type="text" class="form-control @error('keywords') is-invalid @enderror" 
                                                                    id="keywords" name="keywords" value="{{ old('keywords', $config->keywords) }}" 
                                                                    placeholder="smm panel, social media marketing">
                                                                @error('keywords')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Mô tả website <span class="text-danger">*</span></label>
                                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                            id="description" name="description" rows="3" required
                                                            placeholder="Mô tả ngắn về website của bạn">{{ old('description', $config->description) }}</textarea>
                                                        @error('description')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="logo" class="form-label">Logo URL</label>
                                                                <input type="url" class="form-control @error('logo') is-invalid @enderror" 
                                                                    id="logo" name="logo" value="{{ old('logo', $config->logo) }}" 
                                                                    placeholder="https://example.com/logo.png">
                                                                @error('logo')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="favicon" class="form-label">Favicon URL</label>
                                                                <input type="url" class="form-control @error('favicon') is-invalid @enderror" 
                                                                    id="favicon" name="favicon" value="{{ old('favicon', $config->favicon) }}" 
                                                                    placeholder="https://example.com/favicon.ico">
                                                                @error('favicon')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="og_image" class="form-label">OG Image URL</label>
                                                                <input type="url" class="form-control @error('og_image') is-invalid @enderror" 
                                                                    id="og_image" name="og_image" value="{{ old('og_image', $config->og_image) }}" 
                                                                    placeholder="https://example.com/og-image.jpg">
                                                                @error('og_image')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <h5 class="mb-3 mt-4">Cài đặt mặc định</h5>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="landingpage" class="form-label">Trang đích <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control @error('landingpage') is-invalid @enderror" 
                                                                    id="landingpage" name="landingpage" value="{{ old('landingpage', $config->landingpage) }}" 
                                                                    required placeholder="/">
                                                                @error('landingpage')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="login_page" class="form-label">Trang đăng nhập <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control @error('login_page') is-invalid @enderror" 
                                                                    id="login_page" name="login_page" value="{{ old('login_page', $config->login_page) }}" 
                                                                    required placeholder="/login">
                                                                @error('login_page')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="default_currency" class="form-label">Tiền tệ mặc định <span class="text-danger">*</span></label>
                                                                <select class="form-select @error('default_currency') is-invalid @enderror" 
                                                                    id="default_currency" name="default_currency" required>
                                                                    <option value="USD" {{ old('default_currency', $config->default_currency) == 'USD' ? 'selected' : '' }}>USD ($)</option>
                                                                    <option value="VND" {{ old('default_currency', $config->default_currency) == 'VND' ? 'selected' : '' }}>VND (₫)</option>
                                                                    <option value="EUR" {{ old('default_currency', $config->default_currency) == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                                                                </select>
                                                                @error('default_currency')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="default_lang" class="form-label">Ngôn ngữ mặc định <span class="text-danger">*</span></label>
                                                                <select class="form-select @error('default_lang') is-invalid @enderror" 
                                                                    id="default_lang" name="default_lang" required>
                                                                    <option value="en" {{ old('default_lang', $config->default_lang) == 'en' ? 'selected' : '' }}>English</option>
                                                                    <option value="vi" {{ old('default_lang', $config->default_lang) == 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
                                                                </select>
                                                                @error('default_lang')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="timezone" class="form-label">Múi giờ <span class="text-danger">*</span></label>
                                                                <select class="form-select @error('timezone') is-invalid @enderror" 
                                                                    id="timezone" name="timezone" required>
                                                                    <option value="UTC" {{ old('timezone', $config->timezone) == 'UTC' ? 'selected' : '' }}>UTC (UTC+0)</option>
                                                                    <option value="Asia/Ho_Chi_Minh" {{ old('timezone', $config->timezone) == 'Asia/Ho_Chi_Minh' ? 'selected' : '' }}>Asia/Ho_Chi_Minh (UTC+7)</option>
                                                                    <option value="America/New_York" {{ old('timezone', $config->timezone) == 'America/New_York' ? 'selected' : '' }}>America/New_York (UTC-5)</option>
                                                                    <option value="Europe/London" {{ old('timezone', $config->timezone) == 'Europe/London' ? 'selected' : '' }}>Europe/London (UTC+0)</option>
                                                                </select>
                                                                @error('timezone')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Trạng thái website</label>
                                                        <div class="form-check form-switch mt-2">
                                                            <input class="form-check-input @error('status') is-invalid @enderror" 
                                                                   type="checkbox" id="setting_status" name="status" value="1"
                                                                   {{ old('status', $config->status) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="setting_status">
                                                                Website hoạt động
                                                            </label>
                                                        </div>
                                                        @error('status')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="card bg-light">
                                                        <div class="card-header">
                                                            <h6 class="card-title mb-0">Xem trước</h6>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <div id="preview-logo" class="mb-3">
                                                                @if($config->logo)
                                                                    <img src="{{ $config->logo }}" alt="Logo" class="rounded" style="max-width: 100px; max-height: 60px; object-fit: contain;">
                                                                @else
                                                                    <div class="bg-white rounded d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 60px;">
                                                                        <i class="bx bx-image font-size-24 text-muted"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <h6 id="preview-title" class="mb-2">{{ $config->title ?: 'Tiêu đề website' }}</h6>
                                                            <p id="preview-description" class="text-muted small mb-2">{{ $config->description ?: 'Mô tả website' }}</p>
                                                            <span id="preview-status" class="badge {{ $config->status ? 'bg-success' : 'bg-danger' }}">
                                                                {{ $config->status ? 'Hoạt động' : 'Bảo trì' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Nút lưu -->
                                                <div class="d-flex justify-content-end gap-2 mt-4">
                                                    <button type="reset" class="btn btn-secondary">
                                                        <i class="bx bx-reset me-1"></i>Đặt lại
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="bx bx-save me-1"></i>Lưu cấu hình
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                        <!-- Giao diện -->
                                        <div class="tab-pane" id="appearance" role="tabpanel">
                                            <form action="{{ route('admin.settings.update.appearance') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                    <h5 class="mb-3">Cài đặt giao diện</h5>
                                                    
                                                    <div class="mb-3">
                                                        <label for="default_theme" class="form-label">Giao diện mặc định <span class="text-danger">*</span></label>
                                                        <select class="form-select @error('default_theme') is-invalid @enderror" 
                                                            id="default_theme" name="default_theme" required>
                                                            <option value="light" {{ old('default_theme', $config->default_theme) == 'light' ? 'selected' : '' }}>Sáng</option>
                                                            <option value="dark" {{ old('default_theme', $config->default_theme) == 'dark' ? 'selected' : '' }}>Tối</option>
                                                        </select>
                                                        @error('default_theme')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="notice_modal" class="form-label">Thông báo popup</label>
                                                        <textarea class="form-control @error('notice_modal') is-invalid @enderror" 
                                                            id="notice_modal" name="notice_modal" rows="4"
                                                            placeholder="Nội dung thông báo hiển thị khi người dùng truy cập website">{{ old('notice_modal', $config->notice_modal) }}</textarea>
                                                        <small class="text-muted">Để trống nếu không muốn hiển thị thông báo</small>
                                                        @error('notice_modal')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <h5 class="mb-3">Domain</h5>
                                                    
                                                    <div class="mb-3">
                                                        <label for="domain_main" class="form-label">Domain chính</label>
                                                        <input type="text" class="form-control @error('domain_main') is-invalid @enderror" 
                                                            id="domain_main" name="domain_main" value="{{ old('domain_main', $config->domain_main) }}" 
                                                            placeholder="example.com">
                                                        @error('domain_main')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Nút lưu -->
                                                <div class="d-flex justify-content-end gap-2 mt-4">
                                                    <button type="reset" class="btn btn-secondary">
                                                        <i class="bx bx-reset me-1"></i>Đặt lại
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="bx bx-save me-1"></i>Lưu cấu hình
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>

                                        <!-- Mạng xã hội -->
                                        <div class="tab-pane" id="social" role="tabpanel">
                                            <form action="{{ route('admin.settings.update.social') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                
                                                <h5 class="mb-3">Liên kết mạng xã hội</h5>
                                                
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

                                                <!-- Nút lưu -->
                                                <div class="d-flex justify-content-end gap-2 mt-4">
                                                    <button type="reset" class="btn btn-secondary">
                                                        <i class="bx bx-reset me-1"></i>Đặt lại
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="bx bx-save me-1"></i>Lưu cấu hình
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>

                                        <!-- Giá & Hoa hồng -->
                                        <div class="tab-pane" id="pricing" role="tabpanel">
                                            <form action="{{ route('admin.settings.update.pricing') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h5 class="mb-3">Cài đặt Markup</h5>
                                                        <p class="text-muted mb-3">Phần trăm markup cho từng loại khách hàng</p>
                                                    
                                                    <div class="mb-3">
                                                        <label for="markup_retail" class="form-label">Khách lẻ (%) <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control @error('markup_retail') is-invalid @enderror" 
                                                            id="markup_retail" name="markup_retail" value="{{ old('markup_retail', $config->markup_retail) }}" 
                                                            required min="0" max="100" step="0.01" placeholder="20">
                                                        @error('markup_retail')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="markup_agent" class="form-label">Đại lý (%) <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control @error('markup_agent') is-invalid @enderror" 
                                                            id="markup_agent" name="markup_agent" value="{{ old('markup_agent', $config->markup_agent) }}" 
                                                            required min="0" max="100" step="0.01" placeholder="10">
                                                        @error('markup_agent')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="markup_distributor" class="form-label">Nhà phân phối (%) <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control @error('markup_distributor') is-invalid @enderror" 
                                                            id="markup_distributor" name="markup_distributor" value="{{ old('markup_distributor', $config->markup_distributor) }}" 
                                                            required min="0" max="100" step="0.01" placeholder="5">
                                                        @error('markup_distributor')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <h5 class="mb-3">Cài đặt Affiliate</h5>
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label">Trạng thái Affiliate</label>
                                                        <div class="form-check form-switch mt-2">
                                                            <input class="form-check-input @error('affiliate_status') is-invalid @enderror" 
                                                                   type="checkbox" id="affiliate_status" name="affiliate_status" value="1"
                                                                   {{ old('affiliate_status', $config->affiliate_status) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="affiliate_status">
                                                                Kích hoạt hệ thống affiliate
                                                            </label>
                                                        </div>
                                                        @error('affiliate_status')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="affiliate_percent" class="form-label">Phần trăm hoa hồng (%) <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control @error('affiliate_percent') is-invalid @enderror" 
                                                            id="affiliate_percent" name="affiliate_percent" value="{{ old('affiliate_percent', $config->affiliate_percent) }}" 
                                                            required min="0" max="100" step="0.01" placeholder="10">
                                                        @error('affiliate_percent')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="affiliate_min" class="form-label">Số tiền tối thiểu <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control @error('affiliate_min') is-invalid @enderror" 
                                                            id="affiliate_min" name="affiliate_min" value="{{ old('affiliate_min', $config->affiliate_min) }}" 
                                                            required min="0" step="0.0001" placeholder="0">
                                                        @error('affiliate_min')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="affiliate_max" class="form-label">Số tiền tối đa <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control @error('affiliate_max') is-invalid @enderror" 
                                                            id="affiliate_max" name="affiliate_max" value="{{ old('affiliate_max', $config->affiliate_max) }}" 
                                                            required min="0" step="0.0001" placeholder="0">
                                                        @error('affiliate_max')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Nút lưu -->
                                                <div class="d-flex justify-content-end gap-2 mt-4">
                                                    <button type="reset" class="btn btn-secondary">
                                                        <i class="bx bx-reset me-1"></i>Đặt lại
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="bx bx-save me-1"></i>Lưu cấu hình
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>

                                        <!-- Thông báo -->
                                        <div class="tab-pane" id="notifications" role="tabpanel">
                                            <form action="{{ route('admin.settings.update.notifications') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                
                                                <h5 class="mb-3">Cài đặt Telegram Bot</h5>
                                            
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
                                                        @error('telegram_bot')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="telegram_chat_id" class="form-label">Telegram Chat ID</label>
                                                        <input type="text" class="form-control @error('telegram_chat_id') is-invalid @enderror" 
                                                            id="telegram_chat_id" name="telegram_chat_id" value="{{ old('telegram_chat_id', $config->telegram_chat_id) }}" 
                                                            placeholder="-1001234567890">
                                                        @error('telegram_chat_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="alert alert-info">
                                                        <h6 class="alert-heading">Hướng dẫn cài đặt Telegram Bot:</h6>
                                                        <ol class="mb-0 small">
                                                            <li>Tạo bot mới với @BotFather</li>
                                                            <li>Lấy Bot Token từ @BotFather</li>
                                                            <li>Thêm bot vào group/channel</li>
                                                            <li>Lấy Chat ID từ group/channel</li>
                                                            <li>Nhập thông tin vào form</li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="tab-pane" id="email" role="tabpanel">
                                            <h5 class="mb-3">Cài đặt SMTP</h5>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="smtp_host" class="form-label">SMTP Host</label>
                                                        <input type="text" class="form-control @error('smtp_host') is-invalid @enderror" 
                                                            id="smtp_host" name="smtp_host" value="{{ old('smtp_host', $config->smtp_host) }}" 
                                                            placeholder="smtp.gmail.com">
                                                        @error('smtp_host')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="smtp_port" class="form-label">SMTP Port</label>
                                                        <input type="number" class="form-control @error('smtp_port') is-invalid @enderror" 
                                                            id="smtp_port" name="smtp_port" value="{{ old('smtp_port', $config->smtp_port) }}" 
                                                            min="1" max="65535" placeholder="587">
                                                        @error('smtp_port')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="smtp_username" class="form-label">SMTP Username</label>
                                                        <input type="text" class="form-control @error('smtp_username') is-invalid @enderror" 
                                                            id="smtp_username" name="smtp_username" value="{{ old('smtp_username', $config->smtp_username) }}" 
                                                            placeholder="your-email@gmail.com">
                                                        @error('smtp_username')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="smtp_password" class="form-label">SMTP Password</label>
                                                        <input type="password" class="form-control @error('smtp_password') is-invalid @enderror" 
                                                            id="smtp_password" name="smtp_password" value="{{ old('smtp_password', $config->smtp_password) }}" 
                                                            placeholder="your-app-password">
                                                        @error('smtp_password')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="smtp_from_name" class="form-label">From Name</label>
                                                <input type="text" class="form-control @error('smtp_from_name') is-invalid @enderror" 
                                                    id="smtp_from_name" name="smtp_from_name" value="{{ old('smtp_from_name', $config->smtp_from_name) }}" 
                                                    placeholder="Perfect Panel Vietnam">
                                                @error('smtp_from_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="alert alert-warning">
                                                <h6 class="alert-heading">Lưu ý bảo mật:</h6>
                                                <ul class="mb-0 small">
                                                    <li>Sử dụng App Password thay vì mật khẩu chính</li>
                                                    <li>Bật 2FA cho tài khoản email</li>
                                                    <li>Kiểm tra cài đặt bảo mật của nhà cung cấp email</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Nâng cao -->
                                        <div class="tab-pane" id="advanced" role="tabpanel">
                                            <h5 class="mb-3">Custom Scripts</h5>
                                            <p class="text-muted mb-3">Thêm mã JavaScript/CSS tùy chỉnh vào website</p>
                                            
                                            <div class="mb-3">
                                                <label for="script_header" class="form-label">Script Header</label>
                                                <textarea class="form-control @error('script_header') is-invalid @enderror" 
                                                    id="script_header" name="script_header" rows="4"
                                                    placeholder="<!-- Mã sẽ được chèn vào thẻ <head> -->">{{ old('script_header', $config->script_header) }}</textarea>
                                                <small class="text-muted">Mã sẽ được chèn vào thẻ &lt;head&gt;</small>
                                                @error('script_header')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="script_body" class="form-label">Script Body</label>
                                                <textarea class="form-control @error('script_body') is-invalid @enderror" 
                                                    id="script_body" name="script_body" rows="4"
                                                    placeholder="<!-- Mã sẽ được chèn vào đầu thẻ <body> -->">{{ old('script_body', $config->script_body) }}</textarea>
                                                <small class="text-muted">Mã sẽ được chèn vào đầu thẻ &lt;body&gt;</small>
                                                @error('script_body')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="script_footer" class="form-label">Script Footer</label>
                                                <textarea class="form-control @error('script_footer') is-invalid @enderror" 
                                                    id="script_footer" name="script_footer" rows="4"
                                                    placeholder="<!-- Mã sẽ được chèn vào cuối thẻ <body> -->">{{ old('script_footer', $config->script_footer) }}</textarea>
                                                <small class="text-muted">Mã sẽ được chèn vào cuối thẻ &lt;body&gt;</small>
                                                @error('script_footer')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="alert alert-danger">
                                                <h6 class="alert-heading">Cảnh báo:</h6>
                                                <ul class="mb-0 small">
                                                    <li>Chỉ thêm mã từ nguồn tin cậy</li>
                                                    <li>Mã độc có thể làm hỏng website</li>
                                                    <li>Kiểm tra kỹ trước khi lưu</li>
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
                                            <i class="bx bx-save me-1"></i>Lưu cấu hình
                                        </button>
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
    const isValidUrl = (string) => {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    };

    const updatePreview = () => {
        const title = $('#title').val() || 'Tiêu đề website';
        const description = $('#description').val() || 'Mô tả website';
        const logo = $('#logo').val();
        const siteActive = $('#setting_status').is(':checked');
        
        $('#preview-title').text(title);
        $('#preview-description').text(description);
        
        if (logo && isValidUrl(logo)) {
            $('#preview-logo').html(`<img src="${logo}" alt="Logo" class="rounded" style="max-width: 100px; max-height: 60px; object-fit: contain;">`);
        } else {
            $('#preview-logo').html(`<div class="bg-white rounded d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 60px;">
                <i class="bx bx-image font-size-24 text-muted"></i>
            </div>`);
        }
        
        if (siteActive) {
            $('#preview-status').removeClass('bg-danger').addClass('bg-success').text('Hoạt động');
        } else {
            $('#preview-status').removeClass('bg-success').addClass('bg-danger').text('Bảo trì');
        }
    };

    // Update preview on input changes
    $('#title, #description, #logo, #setting_status').on('input change', updatePreview);
    
    // Form submission
    $('#settingsForm').on('submit', function(e) {
        // Add hidden inputs for unchecked checkboxes to ensure they are sent as 0
        if (!$('#telegram_status').is(':checked')) {
            $(this).append('<input type="hidden" name="telegram_status" value="0">');
        }
        if (!$('#affiliate_status').is(':checked')) {
            $(this).append('<input type="hidden" name="affiliate_status" value="0">');
        }
        if (!$('#setting_status').is(':checked')) {
            $(this).append('<input type="hidden" name="status" value="0">');
        }
        
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i>Đang lưu...');
    });
    
    // Initial preview update
    updatePreview();
});
</script>
@endpush