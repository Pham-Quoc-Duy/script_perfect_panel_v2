{{-- @extends('adminpanel.layouts.app')
@section('title', isset($ticketSubject) ? 'Sửa Ticket Subject' : 'Thêm Ticket Subject')
@section('content')
<div class="content flex-row-fluid" id="kt_content">
    <div class="d-flex flex-wrap flex-stack mb-6">
        <h3 class="fw-bold my-2">{{ isset($ticketSubject) ? 'Sửa Ticket Subject' : 'Thêm Ticket Subject' }}</h3>
        <a href="{{ route('admin.ticket-subjects.index') }}" class="btn btn-light btn-sm">
            <i class="ki-duotone ki-arrow-left fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>Quay lại
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger mb-5">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ isset($ticketSubject) ? route('admin.ticket-subjects.update', $ticketSubject) : route('admin.ticket-subjects.store') }}">
                @csrf
                @if(isset($ticketSubject)) @method('PUT') @endif

                <div class="row mb-5">
                    <div class="col-md-6">
                        <label class="form-label required">Category</label>
                        <input type="text" name="category" class="form-control @error('category') is-invalid @enderror"
                            value="{{ old('category', $ticketSubject->category ?? '') }}"
                            list="cat-list" placeholder="Nhập hoặc chọn category" required>
                        <datalist id="cat-list">
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}">
                            @endforeach
                        </datalist>
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Subcategory</label>
                        <input type="text" name="subcategory" class="form-control @error('subcategory') is-invalid @enderror"
                            value="{{ old('subcategory', $ticketSubject->subcategory ?? '') }}"
                            placeholder="Nhập subcategory (tùy chọn)">
                        @error('subcategory') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-4">
                        <label class="form-label required">Trạng thái</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="1" {{ old('status', $ticketSubject->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $ticketSubject->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror"
                            value="{{ old('sort_order', $ticketSubject->sort_order ?? 0) }}" min="0">
                        @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input type="checkbox" name="show_message_only" id="show_message_only"
                                class="form-check-input" value="1"
                                {{ old('show_message_only', $ticketSubject->show_message_only ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="show_message_only">
                                <span class="fw-semibold">Show Message Only</span>
                                <span class="text-muted d-block fs-7">Chỉ hiển thị ô nhập message</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="form-label">Required Fields (JSON)</label>
                    <textarea name="required_fields_json" id="required_fields_json" class="form-control font-monospace" rows="6"
                        placeholder='[{"id":"order_id","name":"Order ID","type":"text","required":true,"placeholder":"Enter order ID"}]'>{{ old('required_fields_json', isset($ticketSubject) && $ticketSubject->required_fields ? json_encode($ticketSubject->required_fields, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '') }}</textarea>
                    <div class="form-text">JSON array các field bổ sung. Để trống nếu không cần.</div>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('admin.ticket-subjects.index') }}" class="btn btn-light">Hủy</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ki-duotone ki-check fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>
                        {{ isset($ticketSubject) ? 'Cập nhật' : 'Lưu' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    var json = document.getElementById('required_fields_json').value.trim();
    if (json) {
        try {
            var parsed = JSON.parse(json);
            if (!Array.isArray(parsed)) throw new Error('Phải là array JSON');
        } catch(err) {
            e.preventDefault();
            alert('JSON không hợp lệ: ' + err.message);
        }
    }
});
</script>
@endsection --}}
