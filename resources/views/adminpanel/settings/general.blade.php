@extends('adminpanel.layouts.app')
@section('title', 'Settings')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        @include('adminpanel.settings.partials.header')
        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2" data-lang="">Tổng quan</h3>
            <div class="d-flex flex-wrap my-2">
                <button class="btn btn-primary btn-sm" data-lang="button::Update" onclick="updateGeneral()">Cập nhật</button>
            </div>
        </div>
        <div class="row g-6 mb-6">
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5">
                            <label class="form-label" data-lang="Website title">Tiêu đề website</label>
                            <input type="text" class="form-control form-control-solid ipt-website-title"
                                value="{{ $config->title ?? '' }}">
                        </div>
                        <div class="mb-5">
                            <label class="form-label" data-lang="Meta description">Mô tả Meta</label>
                            <input type="text" class="form-control form-control-solid ipt-website-description"
                                value="{{ $config->description ?? '' }}">
                        </div>
                        <div>
                            <label class="form-label" data-lang="Meta keywords">Từ khóa Meta</label>
                            <input type="text" class="form-control form-control-solid ipt-website-keywords"
                                value="{{ $config->keywords ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="mb-5">
                            <label class="form-label" data-lang="Default language">Ngôn ngữ mặc định</label>
                             <select id="sl-default-language" class="form-select form-select-solid sl-default-language"
                                data-allow-clear="false" data-hide-search="true">
                                @forelse($languages ?? [] as $lang)
                                    <option value="{{ $lang->code }}" 
                                        {{ ($config->default_lang ?? 'en') == $lang->code ? 'selected' : '' }}
                                        data-icon="{{ $lang->flag ?? 'https://flagcdn.com/us.svg' }}">
                                        {{ $lang->name }}
                                    </option>
                                @empty
                                    <option value="en" selected="" data-icon="https://flagcdn.com/us.svg">English</option>
                                @endforelse
                            </select>
                        </div>
                        <div>
                            <label class="form-label" data-lang="Default currency">Tiền tệ mặc định</label>
                            <select id="sl-default-currency" class="form-select form-select-solid sl-default-currency"
                                data-allow-clear="false" data-hide-search="false" data-hide-search="true">
                                @forelse($currencies ?? [] as $currency)
                                    <option value="{{ $currency->code }}" 
                                        {{ ($config->default_currency ?? 'USD') == $currency->code ? 'selected' : '' }}>
                                        {{ $currency->code }} - {{ $currency->name }}
                                    </option>
                                @empty
                                    <option value="USD" selected="">USD - United States Dollar</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-6">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="mb-5">
                            <label class="form-label" data-lang="Announcement style">Kiểu thông báo</label>
                            <select id="sl-announcement-position"
                                class="form-select form-select-solid sl-announcement-position" data-control="select2"
                                data-hide-search="true">
                                <option value="modal"
                                    {{ ($config->announcement_position ?? 'page') == 'modal' ? 'selected' : '' }}
                                    data-lang="announcement_position_modal">Hiển thị dưới dạng hộp thoại. Hiển thị một lần
                                    sau khi đăng nhập.</option>
                                <option value="page"
                                    {{ ($config->announcement_position ?? 'page') == 'page' ? 'selected' : '' }}
                                    data-lang="announcement_position_page">Hiển thị ở trang đặt hàng</option>
                                <option value="page_and_modal"
                                    {{ ($config->announcement_position ?? 'page') == 'page_and_modal' ? 'selected' : '' }}
                                    data-lang="announcement_position_page_and_modal">Hiển thị ở trang đặt hàng và hộp
                                    thoại. Hiển thị hộp thoại một lần sau khi đăng nhập.</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label class="form-label" data-lang="Announcement">Thông báo</label>
                            <div id="editor-announcement" class="h-250px"></div>
                            <input type="hidden" id="announcement-content"
                                value="{{ $config->announcement_content ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack my-6">
            <h3 class="fw-bold my-2">Terms</h3>
            <div class="d-flex flex-wrap my-2">
                <button class="btn btn-primary btn-sm" data-lang="button::Update" onclick="updateTerms()">Cập
                    nhật</button>
            </div>
        </div>
        <div class="row g-6">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div id="editor-terms" class="h-500px"></div>
                        <input type="hidden" id="terms-content" value="{{ $config->terms_content ?? '' }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="d-flex flex-wrap flex-stack my-6">
            <h3 class="fw-bold my-2">FAQs</h3>
            <div class="d-flex flex-wrap my-2">
                <button class="btn btn-primary btn-sm" data-lang="button::Update"
                    onclick="updateFAQ()">Cập nhật</button>
            </div>
        </div>
        <div class="row g-6">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="div-faq">
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm me-2"
                            onclick="newFAQ()" data-lang="button::New">Thêm mới</button>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
    <script>
        // Hàm update Tổng quan
        function updateGeneral() {
            showFullScreenLoader();

            const data = {
                title: document.querySelector('.ipt-website-title').value,
                description: document.querySelector('.ipt-website-description').value,
                keywords: document.querySelector('.ipt-website-keywords').value,
                default_lang: jQuery('#sl-default-language').val(),
                default_currency: jQuery('#sl-default-currency').val(),
                announcement_position: jQuery('#sl-announcement-position').val(),
                announcement_content: document.getElementById('announcement-content').value,
                _token: '{{ csrf_token() }}',
                _method: 'PUT'
            };

            fetch('{{ route('admin.settings.update.general') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    hideFullScreenLoader();
                    showToast('Cập nhật thành công', 'success');
                })
                .catch(error => {
                    hideFullScreenLoader();
                    showToast('Có lỗi xảy ra khi cập nhật', 'error');
                });
        }

        // Hàm update Terms
        function updateTerms() {
            showFullScreenLoader();

            const data = {
                terms_content: document.getElementById('terms-content').value,
                _token: '{{ csrf_token() }}',
                _method: 'PUT'
            };

            fetch('{{ route('admin.settings.update.terms') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    hideFullScreenLoader();
                    showToast('Cập nhật thành công', 'success');
                })
                .catch(error => {
                    hideFullScreenLoader();
                    showToast('Có lỗi xảy ra khi cập nhật', 'error');
                });
        }

        // Hàm format language hiển thị icon + text (giống formatPaymentMethod)
        function formatLanguage(item) {
            if (!item.id) return item.text;

            const $element = jQuery(item.element);
            const icon = $element.data('icon') || '';
            let prefix = '';

            // Format icon - hỗ trợ Font Awesome (fa, fas, fab, far, fi) và image URL
            if (icon) {
                if (icon.match(/^(fa|fas|fab|far|fi)\s/i)) {
                    // Font Awesome icon (dạng "fi fi-us", "fa fa-icon", etc.)
                    prefix = `<i class="${icon} me-2"></i>`;
                } else if (icon.match(/^https?:\/\//)) {
                    // Image URL
                    prefix =
                        `<img src="${icon}" alt="${item.text}" loading="lazy" class="me-2" style="width:20px;height:20px;object-fit:contain;border-radius:3px;" />`;
                }
            }

            return `<span>${prefix}${item.text}</span>`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (window.jQuery && window.jQuery.fn.select2) {
                // Initialize Default Language Select2
                const $selectLanguage = jQuery('#sl-default-language');
                if ($selectLanguage.length) {
                    // Lấy các attribute từ element
                    const allowClear = $selectLanguage.data('allow-clear') !== false;
                    const hideSearch = $selectLanguage.data('hide-search') === true;
                    const useSelect2 = $selectLanguage.data('kt-select2') !== false;

                    if (useSelect2) {
                        $selectLanguage.select2({
                            templateResult: formatLanguage,
                            templateSelection: formatLanguage,
                            allowClear: allowClear,
                            minimumResultsForSearch: hideSearch ? Infinity : 0,
                            width: '100%',
                            escapeMarkup: function(m) {
                                return m;
                            }
                        });
                    }
                }

                // Initialize Default Currency Select2
                const $selectCurrency = jQuery('#sl-default-currency');
                if ($selectCurrency.length) {
                    // Lấy các attribute từ element
                    const allowClear = $selectCurrency.data('allow-clear') !== false;
                    const hideSearch = $selectCurrency.data('hide-search') === true;
                    const useSelect2 = $selectCurrency.data('kt-select2') !== false;

                    if (useSelect2) {
                        $selectCurrency.select2({
                            allowClear: allowClear,
                            minimumResultsForSearch: hideSearch ? Infinity : 0,
                            width: '100%'
                        });
                    }
                }

                // Initialize Announcement Position Select2
                const $selectAnnouncementPosition = jQuery('#sl-announcement-position');
                if ($selectAnnouncementPosition.length) {
                    const allowClear = $selectAnnouncementPosition.data('allow-clear') !== false;
                    const hideSearch = $selectAnnouncementPosition.data('hide-search') === true;
                    const useSelect2 = $selectAnnouncementPosition.data('control') === 'select2';

                    if (useSelect2) {
                        $selectAnnouncementPosition.select2({
                            allowClear: allowClear,
                            minimumResultsForSearch: hideSearch ? Infinity : 0,
                            width: '100%'
                        });
                    }
                }
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Check if Quill is loaded
            if (typeof Quill === 'undefined') {
                return;
            }

            // Hàm khởi tạo Quill editor
            function initializeQuillEditor(editorId, contentInputId) {
                const editor = new Quill(`#${editorId}`, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            [{
                                'align': []
                            }],
                            ['link'],
                            [{
                                'color': []
                            }, {
                                'background': []
                            }],
                            [{
                                'size': ['small', false, 'large', 'huge']
                            }],
                            [{
                                'header': [1, 2, 3, 4, 5, 6, false]
                            }]
                        ]
                    }
                });

                // Get initial content if exists
                const contentInput = document.getElementById(contentInputId);
                if (contentInput && contentInput.value) {
                    const value = contentInput.value.trim();
                    if (value) {
                        try {
                            // Try to parse as JSON (Quill Delta format)
                            const delta = JSON.parse(value);
                            editor.setContents(delta);
                        } catch (e) {
                            // If not JSON, treat as plain HTML or text
                            editor.root.innerHTML = value;
                        }
                    }
                }

                // Update hidden input on text change
                editor.on('text-change', function() {
                    if (contentInput) {
                        contentInput.value = JSON.stringify(editor.getContents());
                    }
                });

                return editor;
            }

            // Initialize Quill editor for Announcement
            const announcementEditor = initializeQuillEditor('editor-announcement', 'announcement-content');
            window.announcementEditor = announcementEditor;

            // Initialize Quill editor for Terms
            const termsEditor = initializeQuillEditor('editor-terms', 'terms-content');
            window.termsEditor = termsEditor;
        });
    </script>
@endsection
