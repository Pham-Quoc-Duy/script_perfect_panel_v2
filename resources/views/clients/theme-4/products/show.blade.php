@extends('clients.theme-4.layouts.app')
@section('title', $product->name)

@section('content')
<div class="content flex-column-fluid" id="kt_content">
    @include('clients.theme-4.layouts.toolbar', ['toolbarTitle' => $product->name])
    <div class="post" id="kt_post">

        <div class="row g-5 mb-10">
            {{-- Image --}}
            <div class="col-lg-4">
                @if ($product->thumbnail)
                    <img src="{{ $product->thumbnail }}" width="100%" style="border-radius:0.475rem" alt="{{ $product->name }}">
                @endif
            </div>

            {{-- Info --}}
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-2">
                            <span class="text-gray-900 fs-1 fw-bold">{{ $product->name }}</span>
                        </div>

                        <div class="fw-semibold fs-5 mb-4 text-success">
                            <i class="bi bi-box-seam fs-3 me-2" style="line-height:1.3"></i>
                            <span data-lang="label::In stock">In stock</span>
                        </div>

                        @if ($product->category)
                            <div class="fw-semibold fs-6 mb-4">
                                <i class="bi bi-bookmark fs-3 me-2" style="line-height:1.3"></i>
                                <a class="text-gray-900" href="/products?category={{ $product->product_category_id }}">
                                    {{ $product->category->name }}
                                </a>
                            </div>
                        @endif

                        <div class="mb-4">
                            @php
                                $price = (float)$product->price * ($exRate ?? 1);
                                $priceStr = rtrim(rtrim(number_format($price, 6, '.', ''), '0'), '.');
                            @endphp
                            <span class="fw-bolder fs-1">{{ $sym ?? '$' }}{{ $priceStr }}</span>
                        </div>

                        <div class="separator border-2 mb-4"></div>

                        <div class="fw-semibold fs-7 mb-4">
                            <i class="bi bi-1-circle fs-4 me-2"></i>
                            <span data-lang="products.quantity">Quantity</span>
                        </div>

                        <div class="fw-semibold fs-6 mb-4 mw-250px">
                            <div class="input-group">
                                <button type="button" class="btn btn-outline"
                                    onclick="_products.on.click.quantity(-1, {{ $product->min ?? 1 }}, {{ $product->max ?? 999 }})">-</button>
                                <input type="text" id="ipt-quantity" class="form-control text-center" value="1"
                                    onkeyup="_products.on.keyup.quantity({{ $product->min ?? 1 }}, {{ $product->max ?? 999 }})">
                                <button type="button" class="btn btn-outline"
                                    onclick="_products.on.click.quantity(1, {{ $product->min ?? 1 }}, {{ $product->max ?? 999 }})">+</button>
                            </div>
                        </div>

                        <div class="separator border-2 mb-4"></div>

                        <button type="button" id="btn-buy" class="btn btn-primary"
                            onclick="_products.on.click.buy({{ $product->id }}, '{{ addslashes($product->name) }}', '{{ $priceStr }}')"
                            data-lang="button::Buy now">Buy now</button>

                        <div class="div-result-bulk mt-5 d-none"></div>
                        <script>
                            var PRODUCT_TYPE = '{{ ucfirst($product->type ?? 'Manual') }}';
                            var PRODUCT_ORDER_URL = '/product-order/{{ $product->id }}';
                            var CSRF_TOKEN = '{{ csrf_token() }}';
                        </script>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="mt-10">
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tab-info"
                        data-lang="products.information" role="tab">Information</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-policy"
                        data-lang="products.warranty_policy" role="tab">Warranty policy</a>
                </li>
            </ul>
            <div class="tab-content tab-description-product">
                <div class="tab-pane fade active show" id="tab-info" role="tabpanel">
                    {!! $product->description ?? '' !!}
                </div>
                <div class="tab-pane fade" id="tab-policy" role="tabpanel">
                    {!! $product->warranty_policy ?? '' !!}
                </div>
            </div>
        </div>

        {{-- Modal confirm --}}
        <div class="modal fade" tabindex="-1" id="modal-confirm" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered mw-600px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" data-lang="products.confirm_order">Confirm order</h3>
                    </div>
                    <div class="modal-body">
                        <div class="mb-5 div-confirm"></div>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input cb-agree" type="checkbox" value=""
                                onchange="this.checked ? this.nextElementSibling.className='form-check-label' : ''">
                            <label class="form-check-label text-danger fw-bold"
                                data-lang="products.agree_warranty">I agree with the warranty policy</label>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary btn-confirm btn-sm"
                                data-lang="button::Confirm">Confirm</button>
                            <button type="button" class="btn btn-light btn-sm ms-3"
                                data-bs-dismiss="modal" data-lang="button::Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal alert success --}}
        <div class="modal fade" tabindex="-1" id="modal-alert" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered rounded-4">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white py-4">
                        <h4 class="modal-title text-white ls-1" data-lang="Alert">Alert</h4>
                    </div>
                    <div class="modal-body py-10 fs-4" style="word-break:break-word"></div>
                    <div class="modal-footer text-center py-4">
                        <button type="button" class="btn btn-sm btn-success px-4 rounded-4"
                            data-bs-dismiss="modal"
                            data-lang="Read">Read</button>
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
        if (typeof _products === 'undefined') return;

        _products.on.click.buy = function(productId, name, price) {
            var modal = document.getElementById('modal-confirm');
            var qty   = parseInt(document.getElementById('ipt-quantity').value) || 1;
            var sym   = window.currentCurrencySymbol || '$';
            var total = (parseFloat(price) * qty).toFixed(6).replace(/\.?0+$/, '');

            modal.querySelector('.div-confirm').innerHTML =
                '<p><strong>' + name + '</strong></p>' +
                '<p>Quantity: <strong>' + qty + '</strong></p>' +
                '<p>Total: <strong>' + sym + total + '</strong></p>';

            var bsConfirm = new bootstrap.Modal(modal);
            bsConfirm.show();

            modal.querySelector('.btn-confirm').onclick = function() {
                var cbAgree = modal.querySelector('.cb-agree');
                if (!cbAgree.checked) {
                    cbAgree.nextElementSibling.classList.add('text-danger');
                    return;
                }

                bsConfirm.hide();
                showFullScreenLoader('', 'body');

                fetch(PRODUCT_ORDER_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ quantity: qty })
                })
                .then(r => r.json())
                .then(function(data) {
                    hideFullScreenLoader();
                    if (data.status === 'success') {
                        var chargeStr = sym + (parseFloat(data.charge) * (window.CURRENCY_RATE || 1)).toFixed(6).replace(/\.?0+$/, '');
                        var alertModal = document.getElementById('modal-alert');
                        alertModal.querySelector('.modal-body').textContent =
                            'Order successfully. ID: ' + data.order_id + '. Charge: ' + chargeStr;
                        new bootstrap.Modal(alertModal).show();
                    } else {
                        alert(data.message || 'Error');
                    }
                })
                .catch(function() {
                    hideFullScreenLoader();
                    alert('An error occurred');
                });
            };
        };
    });
</script>
@endpush
