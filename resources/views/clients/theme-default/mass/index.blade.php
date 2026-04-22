@extends('clients.theme-default.layouts.app')

@section('title', __('massOrder.title'))

@section('content')

    <!-- Main variables *content* -->
    <div id="block_73">
        <div class="block-bg"></div>
        <div class="container">
            <div class="new_order-block">
                <div class="row mass-order__alignment">
                    <div class="col-lg-12">
                        <div class="component_card">
                            <div class="card">
                                <!-- Alert Section -->
                                <div id="alertSection" style="display: none; margin-bottom: 20px;">
                                </div>

                                <form id="massOrderForm">
                                    <div class="component_form_group">
                                        <div class="">
                                            <div class="form-group">
                                                <label for="links"
                                                    class="control-label">{{ __('massOrder.format_example') }}</label>
                                                <textarea class="form-control" name="orders" rows="15" id="links"
                                                    placeholder="{{ __('massOrder.format_placeholder') }}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="component_button_submit">
                                        <div class="">
                                            <button type="submit" class="btn btn-block btn-big-primary" id="submitBtn">
                                                {{ __('massOrder.submit') }}
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
    </div>


    <script>
        document.getElementById('massOrderForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const textarea = document.getElementById('links');
            const lines = textarea.value.trim().split('\n').filter(line => line.trim());

            if (lines.length === 0) {
                alert('{{ __('massOrder.please_enter_order') }}');
                return;
            }

            const alertSection = document.getElementById('alertSection');
            const submitBtn = document.getElementById('submitBtn');

            // Hide alert section initially
            alertSection.style.display = 'none';
            alertSection.innerHTML = '';
            submitBtn.disabled = true;

            let successCount = 0;
            let errorCount = 0;
            const orderIds = [];

            for (let i = 0; i < lines.length; i++) {
                const line = lines[i].trim();
                const parts = line.split('|').map(p => p.trim());

                if (parts.length !== 3) {
                    errorCount++;
                    continue;
                }

                const [serviceId, link, quantity] = parts;

                // Validate inputs
                if (!serviceId || !link || !quantity) {
                    errorCount++;
                    continue;
                }

                if (isNaN(quantity) || parseInt(quantity) <= 0) {
                    errorCount++;
                    continue;
                }

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

                    const response = await fetch('{{ route('clients.orders.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken || ''
                        },
                        body: JSON.stringify({
                            service: parseInt(serviceId),
                            link: link,
                            quantity: parseInt(quantity)
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        successCount++;
                        if (data.order_id) {
                            orderIds.push(data.order_id);
                        }
                    } else {
                        errorCount++;
                    }
                } catch (error) {
                    errorCount++;
                }

                // Add small delay between requests
                await new Promise(resolve => setTimeout(resolve, 300));
            }

            // Show alert notification
            showAlert(alertSection, successCount, errorCount, orderIds);

            submitBtn.disabled = false;
        });

        function showAlert(container, successCount, errorCount, orderIds = []) {
            const totalOrders = successCount + errorCount;
            let detailsLink = 'javascript:void(0);';

            // Generate details link if there are successful orders
            if (orderIds.length > 0) {
                detailsLink = `/orders?ids=${orderIds.join(',')}`;
            }

            if (errorCount > 0) {
                // Show error alert
                const alertHTML = `
                    <div class="alert alert-dismissible alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                                                    <h4>{{ __('massOrder.failed') }}</h4>
                                            {{ __('massOrder.total_orders') }}: ${totalOrders}<br>
                                            {{ __('massOrder.total_errors') }}: ${errorCount}<br>
                                            <a href="${detailsLink}" target="_blank">{{ __('massOrder.details') }}</a>
                                                                            </div>
                `;
                container.innerHTML = alertHTML;
            } else {
                // Show success alert
                const alertHTML = `
                    <div class="alert alert-dismissible alert-success">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                                                    <h4>{{ __('massOrder.failed') }}</h4>
                                            {{ __('massOrder.total_orders') }}: ${totalOrders}<br>
                                            {{ __('massOrder.total_errors') }}: ${errorCount}<br>
                                            <a href="${detailsLink}" target="_blank">{{ __('massOrder.details') }}</a>
                                                                            </div>
                `;
                container.innerHTML = alertHTML;
            }

            container.style.display = 'block';
        }
    </script>
@endsection
