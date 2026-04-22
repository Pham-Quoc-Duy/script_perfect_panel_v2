@extends('admin.layouts.app')

@section('title', 'Tạo Ticket Subject')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Tạo Ticket Subject</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.ticket-subjects.index') }}">Ticket Subjects</a></li>
                                <li class="breadcrumb-item active">Tạo mới</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="card-title mb-0">Thông tin Ticket Subject</h4>
                                <a href="{{ route('admin.ticket-subjects.index') }}" class="btn btn-secondary">
                                    <i class="bx bx-arrow-back me-1"></i> Quay lại
                                </a>
                            </div>
                        </div>
                        
                        <form action="{{ route('admin.ticket-subjects.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bx bx-error me-2"></i>
                                        <strong>Có lỗi xảy ra:</strong>
                                        <ul class="mb-0 mt-2">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('category') is-invalid @enderror" 
                                                   id="category" name="category" value="{{ old('category') }}" 
                                                   list="categories" required placeholder="Nhập category...">
                                            <datalist id="categories">
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat }}">
                                                @endforeach
                                            </datalist>
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="subcategory" class="form-label">Subcategory</label>
                                            <input type="text" class="form-control @error('subcategory') is-invalid @enderror" 
                                                   id="subcategory" name="subcategory" value="{{ old('subcategory') }}" 
                                                   placeholder="Nhập subcategory...">
                                            @error('subcategory')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                                <option value="">Chọn status...</option>
                                                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="sort_order" class="form-label">Sort Order</label>
                                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                                   id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" 
                                                   min="0" placeholder="0">
                                            @error('sort_order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="show_message_only" 
                                               name="show_message_only" value="1" {{ old('show_message_only') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_message_only">
                                            <strong>Show Message Only</strong>
                                            <small class="text-muted d-block">Chỉ hiển thị ô nhập message, không hiển thị các field bổ sung</small>
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="required_fields_text" class="form-label">Required Fields (JSON)</label>
                                    <textarea class="form-control @error('required_fields') is-invalid @enderror" 
                                              id="required_fields_text" rows="5" 
                                              placeholder='[{"id":"order_id","name":"Order ID","type":"text","required":true,"placeholder":"Enter order ID"}]'>{{ old('required_fields') ? (is_array(old('required_fields')) ? json_encode(old('required_fields')) : old('required_fields')) : '' }}</textarea>
                                    <div class="form-text">
                                        <i class="bx bx-info-circle me-1"></i>
                                        Nhập các field bắt buộc dưới dạng JSON array. Để trống nếu không cần field bổ sung.
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Xem ví dụ</a>
                                    </div>
                                    @error('required_fields')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer bg-light">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.ticket-subjects.index') }}" class="btn btn-light">
                                        <i class="bx bx-x me-1"></i> Hủy
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save me-1"></i> Lưu
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Example Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ví dụ Required Fields JSON</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Ví dụ cho Order ID field:</p>
                <pre class="bg-light p-3 rounded"><code>[
  {
    "id": "order_id",
    "name": "Order ID", 
    "type": "text",
    "required": true,
    "placeholder": "Enter order ID"
  }
]</code></pre>
                
                <p class="mt-3">Ví dụ cho nhiều fields:</p>
                <pre class="bg-light p-3 rounded"><code>[
  {
    "id": "order_id",
    "name": "Order ID",
    "type": "text", 
    "required": true,
    "placeholder": "Enter order ID"
  },
  {
    "id": "service_name",
    "name": "Service Name",
    "type": "text",
    "required": false,
    "placeholder": "Enter service name"
  }
]</code></pre>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const requiredFieldsText = document.getElementById('required_fields_text');
    const categoryInput = document.getElementById('category');
    const subcategoryInput = document.getElementById('subcategory');
    const showMessageOnlyCheckbox = document.getElementById('show_message_only');
    
    // Xử lý khi thay đổi category
    categoryInput.addEventListener('change', function() {
        const category = this.value.toLowerCase();
        // Nếu là Payments hoặc Other, tự động bật show_message_only
        if (category === 'payments' || category === 'other') {
            showMessageOnlyCheckbox.checked = true;
            requiredFieldsText.value = '';
            requiredFieldsText.disabled = true;
        } else {
            showMessageOnlyCheckbox.checked = false;
            requiredFieldsText.disabled = false;
        }
    });
    
    // Validate JSON khi submit
    form.addEventListener('submit', function(e) {
        const text = requiredFieldsText.value.trim();
        if (text) {
            try {
                const parsed = JSON.parse(text);
                if (!Array.isArray(parsed)) {
                    throw new Error('Phải là một array');
                }
                // Validate từng field
                parsed.forEach((field, index) => {
                    if (!field.id || !field.name || !field.type) {
                        throw new Error(`Field ${index + 1}: thiếu id, name hoặc type`);
                    }
                });
            } catch (error) {
                e.preventDefault();
                alert('Lỗi JSON: ' + error.message);
                requiredFieldsText.focus();
                return false;
            }
        }
    });
});
</script>
@endsection