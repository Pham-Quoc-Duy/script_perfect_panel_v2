@extends('admin.settings.layout')

@section('tab-content')
    <form action="{{ route('admin.settings.update.pricing') }}" method="POST" id="pricingForm">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-lg-6">
                <h5 class="mb-3">Cài đặt Markup</h5>
                <p class="text-muted mb-3">Phần trăm markup cho từng loại khách hàng</p>
                
                <div class="mb-3">
                    <label for="markup_retail" class="form-label">Khách lẻ (%) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" class="form-control @error('markup_retail') is-invalid @enderror" 
                            id="markup_retail" name="markup_retail" value="{{ old('markup_retail', $config->markup_retail) }}" 
                            required min="0" max="100" step="0.01" placeholder="20">
                        <span class="input-group-text">%</span>
                    </div>
                    <small class="text-muted">Markup áp dụng cho khách hàng lẻ</small>
                    @error('markup_retail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="markup_agent" class="form-label">Đại lý (%) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" class="form-control @error('markup_agent') is-invalid @enderror" 
                            id="markup_agent" name="markup_agent" value="{{ old('markup_agent', $config->markup_agent) }}" 
                            required min="0" max="100" step="0.01" placeholder="10">
                        <span class="input-group-text">%</span>
                    </div>
                    <small class="text-muted">Markup áp dụng cho đại lý</small>
                    @error('markup_agent')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="markup_distributor" class="form-label">Nhà phân phối (%) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" class="form-control @error('markup_distributor') is-invalid @enderror" 
                            id="markup_distributor" name="markup_distributor" value="{{ old('markup_distributor', $config->markup_distributor) }}" 
                            required min="0" max="100" step="0.01" placeholder="5">
                        <span class="input-group-text">%</span>
                    </div>
                    <small class="text-muted">Markup áp dụng cho nhà phân phối</small>
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
                    <div class="input-group">
                        <input type="number" class="form-control @error('affiliate_percent') is-invalid @enderror" 
                            id="affiliate_percent" name="affiliate_percent" value="{{ old('affiliate_percent', $config->affiliate_percent) }}" 
                            required min="0" max="100" step="0.01" placeholder="10">
                        <span class="input-group-text">%</span>
                    </div>
                    @error('affiliate_percent')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="affiliate_min" class="form-label">Số tiền tối thiểu <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control @error('affiliate_min') is-invalid @enderror" 
                            id="affiliate_min" name="affiliate_min" value="{{ old('affiliate_min', $config->affiliate_min) }}" 
                            required min="0" step="0.0001" placeholder="0">
                    </div>
                    <small class="text-muted">Số tiền tối thiểu để nhận hoa hồng</small>
                    @error('affiliate_min')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="affiliate_max" class="form-label">Số tiền tối đa <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control @error('affiliate_max') is-invalid @enderror" 
                            id="affiliate_max" name="affiliate_max" value="{{ old('affiliate_max', $config->affiliate_max) }}" 
                            required min="0" step="0.0001" placeholder="0">
                    </div>
                    <small class="text-muted">Số tiền tối đa cho một lần hoa hồng (0 = không giới hạn)</small>
                    @error('affiliate_max')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Mô phỏng giá</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">Giá gốc ($)</label>
                                <input type="number" class="form-control" id="base_price" value="1" min="0" step="0.01">
                            </div>
                            <div class="col-md-9">
                                <label class="form-label">Giá sau markup</label>
                                <div class="row" id="price-simulation">
                                    <!-- Will be populated by JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="alert alert-warning">
                    <h6 class="alert-heading">Lưu ý quan trọng:</h6>
                    <ul class="mb-0 small">
                        <li>Markup sẽ được áp dụng tự động cho tất cả dịch vụ</li>
                        <li>Giá cuối = Giá gốc × (1 + Markup%)</li>
                        <li>Markup cao hơn = Lợi nhuận cao hơn nhưng có thể ảnh hưởng đến tính cạnh tranh</li>
                        <li>Hệ thống affiliate chỉ hoạt động khi được kích hoạt</li>
                        <li>Hoa hồng được tính trên tổng giá trị đơn hàng</li>
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
                <i class="bx bx-save me-1"></i>Lưu cài đặt
            </button>
        </div>
    </form>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    const updatePriceSimulation = () => {
        const basePrice = parseFloat($('#base_price').val()) || 1;
        const retailMarkup = parseFloat($('#markup_retail').val()) || 0;
        const agentMarkup = parseFloat($('#markup_agent').val()) || 0;
        const distributorMarkup = parseFloat($('#markup_distributor').val()) || 0;
        
        const retailPrice = basePrice * (1 + retailMarkup / 100);
        const agentPrice = basePrice * (1 + agentMarkup / 100);
        const distributorPrice = basePrice * (1 + distributorMarkup / 100);
        
        const simulationHtml = `
            <div class="col-md-4">
                <div class="text-center p-2 border rounded">
                    <small class="text-muted d-block">Khách lẻ</small>
                    <strong class="text-danger">$${retailPrice.toFixed(4)}</strong>
                    <small class="d-block text-muted">(+${retailMarkup}%)</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-2 border rounded">
                    <small class="text-muted d-block">Đại lý</small>
                    <strong class="text-warning">$${agentPrice.toFixed(4)}</strong>
                    <small class="d-block text-muted">(+${agentMarkup}%)</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-2 border rounded">
                    <small class="text-muted d-block">Nhà phân phối</small>
                    <strong class="text-success">$${distributorPrice.toFixed(4)}</strong>
                    <small class="d-block text-muted">(+${distributorMarkup}%)</small>
                </div>
            </div>
        `;
        
        $('#price-simulation').html(simulationHtml);
    };

    // Update simulation on input changes
    $('#base_price, #markup_retail, #markup_agent, #markup_distributor').on('input', updatePriceSimulation);
    
    // Form submission
    $('#pricingForm').on('submit', function(e) {
        // Add hidden input for unchecked checkbox
        if (!$('#affiliate_status').is(':checked')) {
            $(this).append('<input type="hidden" name="affiliate_status" value="0">');
        }
        
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i>Đang lưu...');
    });
    
    // Initial simulation update
    updatePriceSimulation();
});
</script>
@endpush