@extends('admin.layouts.app')

@section('title', 'Tạo sự kiện')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Tạo sự kiện mới',
                    'breadcrumb' => 'Create Event',
                ])

                @include('admin.components.alert')

                <form action="{{ route('admin.events.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Thông tin sự kiện</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Tên sự kiện <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Mô tả</label>
                                        <textarea name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Loại sự kiện</label>
                                            <select name="type" class="form-select">
                                                <option value="spin" {{ old('type') == 'spin' ? 'selected' : '' }}>Vòng quay may mắn</option>
                                                <option value="box" {{ old('type') == 'box' ? 'selected' : '' }}>Mở hộp quà</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Lượt/ngày</label>
                                            <input type="number" name="max_spins_per_day" class="form-control" value="{{ old('max_spins_per_day', 1) }}" min="1" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Tổng lượt</label>
                                            <input type="number" name="max_spins_total" class="form-control" value="{{ old('max_spins_total', 0) }}" min="0">
                                            <small class="text-muted">0 = không giới hạn</small>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Ngày bắt đầu</label>
                                            <input type="datetime-local" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Ngày kết thúc</label>
                                            <input type="datetime-local" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Cấu hình phần thưởng</h5>
                                    <button type="button" class="btn btn-sm btn-primary" onclick="addReward()">
                                        <i class="bx bx-plus me-1"></i>Thêm
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div id="rewards-container"></div>
                                    <input type="hidden" name="rewards" id="rewards-json" value="[]">
                                    
                                    <div class="alert alert-info mb-0 mt-3">
                                        <strong>Tổng tỉ lệ: <span id="total-probability" class="text-danger">0</span>%</strong>
                                        <small class="d-block">Tổng phải bằng 100%</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Cài đặt</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                                        <label class="form-check-label">Kích hoạt</label>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bx bx-save me-1"></i>Tạo sự kiện
                                        </button>
                                        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                                            <i class="bx bx-arrow-back me-1"></i>Quay lại
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
let rewardIndex = 0;
const rewards = [];

function addReward() {
    const html = `
        <div class="reward-item border rounded p-3 mb-2" data-index="${rewardIndex}">
            <div class="row align-items-end">
                <div class="col-md-3 mb-2">
                    <label class="form-label small">Tên</label>
                    <input type="text" class="form-control form-control-sm reward-name" data-index="${rewardIndex}" placeholder="VD: 100$">
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label small">Số tiền</label>
                    <input type="number" class="form-control form-control-sm reward-amount" data-index="${rewardIndex}" placeholder="0" min="0" step="0.01">
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label small">Tỉ lệ %</label>
                    <input type="number" class="form-control form-control-sm reward-probability" data-index="${rewardIndex}" placeholder="0" min="0" max="100">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label small">Màu</label>
                    <input type="color" class="form-control form-control-sm form-control-color reward-color" data-index="${rewardIndex}" value="#FF6B6B">
                </div>
                <div class="col-md-2 mb-2">
                    <button type="button" class="btn btn-sm btn-danger w-100" onclick="removeReward(${rewardIndex})">
                        <i class="bx bx-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    
    $('#rewards-container').append(html);
    rewards[rewardIndex] = { name: '', amount: 0, probability: 0, color: '#FF6B6B' };
    rewardIndex++;
    updateRewardsJson();
}

function removeReward(index) {
    $(`.reward-item[data-index="${index}"]`).remove();
    delete rewards[index];
    updateRewardsJson();
}

function updateRewardsJson() {
    const validRewards = rewards.filter(r => r !== undefined && r.name);
    $('#rewards-json').val(JSON.stringify(validRewards));
    
    const total = validRewards.reduce((sum, r) => sum + parseFloat(r.probability || 0), 0);
    $('#total-probability').text(total.toFixed(0)).toggleClass('text-success', total === 100).toggleClass('text-danger', total !== 100);
}

$(document).on('input', '.reward-name, .reward-amount, .reward-probability, .reward-color', function() {
    const index = $(this).data('index');
    const field = $(this).hasClass('reward-name') ? 'name' : 
                  $(this).hasClass('reward-amount') ? 'amount' :
                  $(this).hasClass('reward-probability') ? 'probability' : 'color';
    
    if (rewards[index] !== undefined) {
        rewards[index][field] = field === 'amount' || field === 'probability' ? parseFloat($(this).val()) || 0 : $(this).val();
        updateRewardsJson();
    }
});
</script>
@endpush
