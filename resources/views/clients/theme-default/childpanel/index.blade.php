@extends('clients.theme-default.layouts.app')

@section('title', __('childPanel.title'))
 
@section('content')
    <div id="block_55">
        <div class="block-bg"></div>
        <div class="container">
            <div class="order-child-form">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Alert -->
                        <div id="alert-container"></div>
                        
                        <div class="component_card"></div>
                            <div class="card">
                                <form id="child-panel-form" method="post" class="component_form_group">
                                    @csrf
                                    <div class="form-group">
                                        <label for="domain" class="control-label">{{ __('childPanel.domain') }}</label>
                                        <input type="text" class="form-control" id="domain" name="domain" required>
                                    </div>
                                    
                                    <div class="component_alert_dns">
                                        <div class="alert alert-info">
                                            <div>{{ __('childPanel.dns_notice') }}</div>
                                            <ul style="padding-left: 20px">
                                                <li>{{ $config->namesv1 ?? 'ns1.example.com' }}</li>
                                                <li>{{ $config->namesv2 ?? 'ns2.example.com' }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="currency">{{ __('childPanel.currency') }}</label>
                                        <select id="currency" class="form-control" name="currency" required>
                                            <option value="USD">United States Dollars (USD)</option>
                                            <option value="EUR">Euro (EUR)</option>
                                            <option value="VND">Vietnamese đồng (VND)</option>
                                            <option value="RUB">Russian Rubles (RUB)</option>
                                            <option value="THB">Thai Baht (THB)</option>
                                            <option value="IDR">Indonesian Rupiah (IDR)</option>
                                            <option value="CNY">Chinese Yuan (CNY)</option>
                                            <option value="INR">Indian Rupee (INR)</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="username">{{ __('childPanel.admin_username') }}</label>
                                        <input type="text" id="username" class="form-control" name="username" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="password">{{ __('childPanel.admin_password') }}</label>
                                        <input type="password" id="password" class="form-control" name="password" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="password_confirmation">{{ __('childPanel.confirm_password') }}</label>
                                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="price" class="control-label">{{ __('childPanel.price_per_month') }}</label>
                                        <input type="text" class="form-control" id="price" value="{{ $costFormatted }}" readonly>
                                    </div>
                                    
                                    <div class="component_button_submit">
                                        <button class="btn btn-block btn-big-primary" type="submit" id="submit-btn">
                                            {{ __('childPanel.submit_order') }}
                                        </button>
                                    </div>
                                </form>
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
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('child-panel-form');
    const submitBtn = document.getElementById('submit-btn');
    const alertContainer = document.getElementById('alert-container');
    const originalBtnText = submitBtn.textContent;

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        submitBtn.disabled = true;
        submitBtn.textContent = 'Creating...';
        alertContainer.innerHTML = '';

        fetch('{{ route("clients.childpanel.store") }}', {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            const alertType = data.success ? 'success' : 'danger';
            
            alertContainer.innerHTML = `
                <div class="">
                    <div class="alert alert-dismissible alert-${alertType} mb-3">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        ${data.message}
                    </div>
                </div>
            `;
            
            alertContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            if (data.success) {
                form.reset();
                setTimeout(() => window.location.reload(), 3000);
            }
            
            setTimeout(() => {
                const alert = alertContainer.querySelector('.alert');
                if (alert && !data.success) {
                    alert.style.transition = 'opacity 0.3s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }
            }, 10000);
        })
        .catch(() => {
            alertContainer.innerHTML = `
                <div class="">
                    <div class="alert alert-dismissible alert-danger mb-3">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Network error. Please try again.
                    </div>
                </div>
            `;
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = originalBtnText;
        });
    });
});
</script>
@endpush
