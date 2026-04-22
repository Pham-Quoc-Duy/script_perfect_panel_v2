@extends('admin.settings.layout')

@section('tab-content')
    <form action="{{ route('admin.settings.update.keep-orders') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-8">
                <h5 class="mb-3">Danh sách cần giữ lại</h5>
                <div class="mb-3">
                    <textarea class="form-control @error('keep_orders') is-invalid @enderror" id="keep_orders" name="keep_orders" rows="12"
                        placeholder="123456789&#10;Campaign A&#10;test@example.com&#10;Tên dự án">
@if ($config->keep_orders)
{{ implode("\n", json_decode($config->keep_orders, true) ?? []) }}
@endif
</textarea>
                    <small class="text-muted d-block mt-2">
                        <i class="bx bx-info-circle me-1"></i>
                        Nhập mỗi dữ liệu trên một dòng riêng. Hệ thống sẽ lưu tất cả mà không phân biệt loại.
                    </small>
                    @error('keep_orders')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                
            </div>

            <div class="col-lg-4">


                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">
                            <i class="bx bx-help-circle me-2"></i>Hướng dẫn
                        </h6>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-2">Cách sử dụng:</h6>
                        <ol class="small">
                            <li>Nhập dữ liệu vào ô nhập liệu</li>
                            <li>Mỗi dữ liệu trên một dòng</li>
                            <li>Nhấn "Lưu cài đặt"</li>
                            <li>Dữ liệu sẽ được lưu nguyên vẹn</li>
                        </ol>

                        <hr>

                        <h6 class="mb-2">Ví dụ:</h6>
                        <pre class="bg-white p-2 rounded small"><code>123456789
Campaign A
test@example.com
Project-2024</code></pre>

                    </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('keep_orders');
            const countSpan = document.getElementById('keep-orders-count');

            function updateCount() {
                const lines = textarea.value.trim().split('\n').filter(line => line.trim() !== '');
                countSpan.textContent = lines.length;
            }

            textarea.addEventListener('input', updateCount);
            updateCount();
        });
    </script>
@endpush
