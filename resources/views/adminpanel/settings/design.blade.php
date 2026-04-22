@extends('adminpanel.layouts.app')
@section('title', 'Settings')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        @include('adminpanel.settings.partials.header')
        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2" data-lang="Design">Giao diện</h3>
        </div>

        <div class="row g-6" id="upload-image">
            <div class="col-xl-3 col-lg-6 col-md-6 mb-5">
                <div class="card shadow-sm">
                    <div class="card-body py-5">
                        <h4>Shortcut icon (.ico)</h4>
                        <hr>
                        <span id="uploader-favicon">
                            <div class="ajax-file-upload" style="position: relative; overflow: hidden; cursor: default;">
                                Upload<form method="POST" action="/request" enctype="multipart/form-data"
                                    style="margin: 0px; padding: 0px;"><input type="file"
                                        id="ajax-upload-id-1773329474651" name="favicon" accept="*"></form>
                            </div>
                            <div></div>
                        </span>
                        <div class="ajax-file-upload-container"></div>
                        <div class="ajax-file-upload-container"></div>
                        <div class="mt-5"><img src="{{ $config->favicon ? asset('assets/media/' . $config->favicon) : 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22100%22 height=%22100%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2214%22 fill=%22%23999%22 text-anchor=%22middle%22 dy=%22.3em%22%3EFavicon%3C/text%3E%3C/svg%3E' }}" class="img-favicon h-40px" alt="Favicon" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22100%22 height=%22100%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2214%22 fill=%22%23999%22 text-anchor=%22middle%22 dy=%22.3em%22%3EFavicon%3C/text%3E%3C/svg%3E'">
                        </div>
                        <p class="fst-italic mt-5 mb-0">* Recommended: 100x100 px</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-5">
                <div class="card shadow-sm">
                    <div class="card-body py-5">
                        <h4>Logo (.png)</h4>
                        <hr>
                        <span id="uploader-logo">
                            <div class="ajax-file-upload" style="position: relative; overflow: hidden; cursor: default;">
                                Upload<form method="POST" action="/request" enctype="multipart/form-data"
                                    style="margin: 0px; padding: 0px;"><input type="file"
                                        id="ajax-upload-id-1773329474652" name="logo" accept="*"></form>
                            </div>
                            <div></div>
                        </span>
                        <div class="ajax-file-upload-container"></div>
                        <div class="ajax-file-upload-container"></div>
                        <div class="mt-5"><img src="{{ $config->logo ? asset('assets/media/' . $config->logo) : 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%2250%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22200%22 height=%2250%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2214%22 fill=%22%23999%22 text-anchor=%22middle%22 dy=%22.3em%22%3ELogo%3C/text%3E%3C/svg%3E' }}" class="img-logo h-40px" alt="Logo" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%2250%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22200%22 height=%2250%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2214%22 fill=%22%23999%22 text-anchor=%22middle%22 dy=%22.3em%22%3ELogo%3C/text%3E%3C/svg%3E'"></div>
                        <p class="fst-italic mt-5 mb-0">* Recommended: 1600x400 px</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-5">
                <div class="card shadow-sm">
                    <div class="card-body py-5">
                        <h4>Logo square (.png) </h4>
                        <hr>
                        <span id="uploader-logo-square">
                            <div class="ajax-file-upload" style="position: relative; overflow: hidden; cursor: default;">
                                Upload<form method="POST" action="/request" enctype="multipart/form-data"
                                    style="margin: 0px; padding: 0px;"><input type="file"
                                        id="ajax-upload-id-1773329474652" name="logo_square" accept="*"></form>
                            </div>
                            <div></div>
                        </span>
                        <div class="ajax-file-upload-container"></div>
                        <div class="ajax-file-upload-container"></div>
                        <div class="mt-5"><img src="{{ $config->logo_square ? asset('assets/media/' . $config->logo_square) : 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22100%22 height=%22100%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2214%22 fill=%22%23999%22 text-anchor=%22middle%22 dy=%22.3em%22%3ELogo Square%3C/text%3E%3C/svg%3E' }}"
                                class="img-logo-square h-40px" alt="Logo Square" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22100%22 height=%22100%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2214%22 fill=%22%23999%22 text-anchor=%22middle%22 dy=%22.3em%22%3ELogo Square%3C/text%3E%3C/svg%3E'"></div>
                        <p class="fst-italic mt-5 mb-0">* Recommended: 1000x1000 px</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-5">
                <div class="card shadow-sm">
                    <div class="card-body py-5">
                        <h4>Thumbnail FB (.png)</h4>
                        <hr>
                        <span id="uploader-logo-facebook">
                            <div class="ajax-file-upload" style="position: relative; overflow: hidden; cursor: default;">
                                Upload<form method="POST" action="/request" enctype="multipart/form-data"
                                    style="margin: 0px; padding: 0px;"><input type="file"
                                        id="ajax-upload-id-1773329474653" name="logo_facebook" accept="*"></form>
                            </div>
                            <div></div>
                        </span>
                        <div class="ajax-file-upload-container"></div>
                        <div class="ajax-file-upload-container"></div>
                        <div class="mt-5"><img src="{{ $config->logo_facebook ? asset('assets/media/' . $config->logo_facebook) : 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22105%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22200%22 height=%22105%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2214%22 fill=%22%23999%22 text-anchor=%22middle%22 dy=%22.3em%22%3ELogo FB%3C/text%3E%3C/svg%3E' }}"
                                class="img-logo-facebook h-40px" alt="Logo Facebook" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22105%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22200%22 height=%22105%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2214%22 fill=%22%23999%22 text-anchor=%22middle%22 dy=%22.3em%22%3ELogo FB%3C/text%3E%3C/svg%3E'"></div>
                        <p class="fst-italic mt-5 mb-0">* Recommended: 1200x628 px</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack my-6">
            <h3 class="fw-bold my-2" data-lang="Design">Tùy chỉnh CSS/JS</h3>
            <div class="d-flex flex-wrap my-2">
                <button class="btn btn-primary btn-sm" data-lang="button::Update"
                    onclick="updateCustomCss()">Cập nhật</button>
            </div>
        </div>
        <div class="row g-6">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <div class="mb-5">
                            <label class="form-label">CSS</label>
                            <textarea class="form-control form-control-solid txa-css" rows="10"
                                placeholder=".text-danger { color: red; }
.text-primary { color: blue; }">{{ $config->script_css ?? '' }}</textarea>
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Header</label>
                            <textarea class="form-control form-control-solid txa-header-js" rows="5"
                                placeholder="<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css' />
<script>console.log('Custom header script');</script>">{{ $config->script_header ?? '' }}</textarea>
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Footer</label>
                            <textarea class="form-control form-control-solid txa-footer-js" rows="5"
                                placeholder="<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js'></script>
<script>console.log('Custom footer script');</script>">{{ $config->script_footer ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoFields = ['favicon', 'logo', 'logo_square', 'logo_facebook'];
    
    logoFields.forEach(field => {
        const input = document.querySelector(`input[name="${field}"]`);
        if (input) {
            input.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    uploadLogo(field, this.files[0]);
                }
            });
        }
    });
});

function uploadLogo(field, file) {
    showFullScreenLoader();
    
    const formData = new FormData();
    formData.append(field, file);
    formData.append('_token', '{{ csrf_token() }}');
    
    fetch('{{ route("admin.settings.upload-logo") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(response => {
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new Error('Server returned non-JSON response: ' + response.status);
        }
        return response.json();
    })
    .then(result => {
        hideFullScreenLoader();
        
        if (result.message) {
            const isSuccess = result.uploaded && Object.keys(result.uploaded).length > 0;
            showToast(result.message, isSuccess ? 'success' : 'warning');
        }
        
        // Reload page after 1.5 seconds to show updated images
        if (result.uploaded && Object.keys(result.uploaded).length > 0) {
            setTimeout(() => {
                location.reload();
            }, 1500);
        }
    })
    .catch(error => {
        hideFullScreenLoader();
        console.error('Upload error:', error);
        showToast(window.tr('An error occurred!'), 'success'), 'error');
    });
}

function updateCustomCss() {
    showFullScreenLoader();
    
    const data = {
        script_header: document.querySelector('.txa-header-js').value,
        script_css: document.querySelector('.txa-css').value,
        script_footer: document.querySelector('.txa-footer-js').value,
        _token: '{{ csrf_token() }}'
    };
    
    fetch('{{ route("admin.settings.update-custom-css") }}', {
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
        showToast(result.message || 'Cập nhật thành công', 'success');
    })
    .catch(error => {
        hideFullScreenLoader();
        console.error('Update error:', error);
        showToast(window.tr('An error occurred!'), 'success'), 'error');
    });
}
</script>
