@extends('clients.theme-default.layouts.app')

@section('title', __('orders.title'))

@section('content')
    <!-- Main variables *content* -->
    <div id="block_40">
        <div class="block-bg"></div>
        <div class="container-fluid">
            <div class="orders-history ">
                <!-- Error Alert Message -->
                <div class="alert alert-dismissible mb-3 alert-danger" role="alert" id="js-order-alert-error"
                    style="display: none;">
                    <button type="button" class="close" data-hide="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="text"></div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="orders-history__margin-tab">
                            <div class="component_status_tabs">
                                <div class="">
                                    <ul class="nav nav-pills tab">
                                        <li class="nav-item">
                                            <a class="nav-link {{ !request('status') || request('status') === 'all' ? 'active' : '' }}"
                                                href="/orders">{{ __('orders.all') ?? 'All' }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('status') === 'pending' ? 'active' : '' }}"
                                                href="/orders?status=pending">{{ __('orders.pending') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('status') === 'inprogress' ? 'active' : '' }}"
                                                href="/orders?status=inprogress">{{ __('orders.processing') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('status') === 'completed' ? 'active' : '' }}"
                                                href="/orders?status=completed">{{ __('orders.completed') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('status') === 'partial' ? 'active' : '' }}"
                                                href="/orders?status=partial">{{ __('orders.partial') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('status') === 'processing' ? 'active' : '' }}"
                                                href="/orders?status=processing">{{ __('orders.processing') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('status') === 'canceled' ? 'active' : '' }}"
                                                href="/orders?status=canceled">{{ __('orders.canceled') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="orders-history__margin-search component_card">
                            <div class="card">
                                <div class="component_form_group component_button_search">
                                    <div class="">
                                        <form action="/orders" method="get" id="history-search">
                                            <div class="input-group">
                                                <input type="text" name="search" class="form-control"
                                                    value="{{ request('search') }}" placeholder="Search">
                                                <div class="input-group-append">
                                                    <button class="btn btn-big-secondary" type="submit">
                                                        <span class="fas fa-search"></span>
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
                <div class="row">
                    <div class="col">
                        <div class="orders-history__margin-table">
                            <div class="table-bg component_table ">
                                <div class="table-wr table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('orders.order_id') }}</th>
                                                <th>{{ __('orders.created_at') }}</th>
                                                <th>{{ __('orders.link') }}</th>
                                                <th>{{ __('newOrder.charge') }}</th>
                                                <th class="nowrap">{{ __('orders.start_count') }}</th>
                                                <th>{{ __('orders.quantity') }}</th>
                                                <th>{{ __('orders.service') }}</th>
                                                <th>{{ __('orders.status') }}</th>
                                                <th>{{ __('orders.remains') }}</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($orders as $order)
                                                <tr>
                                                    <td data-label="{{ __('orders.order_id') }}">{{ $order->id }}</td>
                                                    <td data-label="{{ __('orders.created_at') }}">
                                                        <span
                                                            class="nowrap">{{ $order->created_at->format('Y-m-d') }}</span>
                                                        <span
                                                            class="nowrap">{{ $order->created_at->format('H:i:s') }}</span>
                                                    </td>
                                                    <td data-label="{{ __('orders.link') }}" class="table-link">
                                                        <a href="/anon.ws?r={{ urlencode($order->link) }}" target="_blank"
                                                            title="{{ $order->link }}">
                                                            {{ Str::limit($order->link, 50) }}
                                                        </a>
                                                        @if ($order->comment && $order->comment !== '1')
                                                            <a href="#" data-toggle="modal" data-target="#order-details-{{ $order->id }}" title="View additional data">
                                                                <i class="far fa-file-alt"></i>
                                                            </a>
                                                            <div class="modal fade" tabindex="-1" id="order-details-{{ $order->id }}" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                                <i class="fas fa-times"></i>
                                                                            </button>
                                                                            <div>
                                                                                <h3>{{ __('orders.additional_data') ?? 'Additional data' }}</h3>
                                                                            </div>
                                                                            <div>
                                                                                <div class="form-group">
                                                                                    <label for="details-{{ $order->id }}">{{ __('orders.comments') ?? 'Comments' }}</label>
                                                                                    <textarea id="details-{{ $order->id }}" class="form-control" rows="5" disabled="">{{ $order->comment }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td data-label="{{ __('newOrder.charge') }}">
                                                        {{ $order->charge_display }}
                                                    </td>
                                                    <td data-label="{{ __('orders.start_count') }}" class="nowrap">
                                                        {{ $order->start_count ?? '' }}</td>
                                                    <td data-label="{{ __('orders.quantity') }}">{{ $order->quantity }}</td>
                                                    <td data-label="{{ __('orders.service') }}" class="table-service">
                                                        {{ $order->service_id }} — {{ $order->service_name }}
                                                    </td>
                                                    <td data-label="{{ __('orders.status') }}" nowrap="">
                                                        @if ($order->status === 'canceled')
                                                            {{ __('orders.canceled') }} <i class="fas fa-comment-alt-lines"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="This order has been canceled and refunded."></i>
                                                        @else
                                                            {{ ucfirst($order->status) }}
                                                        @endif
                                                    </td>
                                                    <td data-label="{{ __('orders.remains') }}">{{ $order->remains }}</td>
                                                    <td data-label="" class="orders-history-actions" nowrap="nowrap">
                                                        @if ($order->refill == 1 && $order->status === 'completed')
                                                            <div class="d-inline-block component_button_refill">
                                                                <div class="">
                                                                    <button class="btn btn-actions order-action-btn"
                                                                        data-href="{{ route('clients.orders.refill', $order->id) }}"
                                                                        data-action="refill" title="Refill this order">
                                                                        Refill
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($order->cancel == 1 && !in_array($order->status, ['canceled', 'completed', 'partial']))
                                                            <div class="d-inline-block component_button_cancel">
                                                                <div class="">
                                                                    <button class="btn btn-actions order-action-btn"
                                                                        data-href="{{ route('clients.orders.cancel', $order->id) }}"
                                                                        data-action="cancel" title="Cancel this order">
                                                                        Cancel
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10" class="text-center py-4">
                                                        <p class="text-muted">No orders found</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <nav class="component_pagination">
                            <div class="">
                                {{ $orders->links('pagination::bootstrap-4') }}
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const alertErrorDiv = document.getElementById('js-order-alert-error');

            document.querySelectorAll('.order-action-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const action = this.dataset.action;
                    const href = this.dataset.href;
                    const td = this.closest('td');
                    const btn = this;

                    // Disable button during request
                    btn.disabled = true;
                    btn.style.opacity = '0.6';

                    fetch(href)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // Replace button with text using class
                                td.innerHTML =
                                    `<span class="orders-history-actions-text">${data.btn_text}</span>`;
                            } else {
                                // Show error alert
                                const errorMsg = data.message || 'An error occurred';
                                showErrorAlert(errorMsg);

                                btn.disabled = false;
                                btn.style.opacity = '1';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showErrorAlert('An error occurred while processing your request');

                            btn.disabled = false;
                            btn.style.opacity = '1';
                        });
                });
            });

            /**
             * Show error alert message
             */
            function showErrorAlert(message) {
                if (alertErrorDiv) {
                    const textDiv = alertErrorDiv.querySelector('.text');
                    if (textDiv) {
                        textDiv.innerHTML = message;
                    }

                    alertErrorDiv.style.display = 'block';

                    // Scroll to alert
                    alertErrorDiv.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }

            // Handle close button clicks
            document.addEventListener('click', function(e) {
                if (e.target.matches('.close[data-hide="alert"]') || e.target.closest(
                        '.close[data-hide="alert"]')) {
                    const alertDiv = e.target.closest('.alert');
                    if (alertDiv) {
                        alertDiv.style.display = 'none';
                    }
                }
            });
        </script>
    @endsection
