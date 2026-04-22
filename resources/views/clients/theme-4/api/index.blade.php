@extends('clients.theme-4.layouts.app')
@section('title', 'API')

@section('content')
<div class="content flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    @include('clients.theme-4.layouts.toolbar', ['toolbarTitle' => 'Add funds']) <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post" id="kt_post">
        <div class="card mb-5">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-bordered fs-7 gy-3 gs-3 mb-0">
                        <tbody>
                            <tr>
                                <td>API URL</td>
                                <td class="fw-bold">https://{{ getDomain() }}/api/v2</td>
                            </tr>
                            <tr>
                                <td>API Key</td>
                                <td class="fw-bold">
                                    @php
                                        $apiKey = auth()->user()->api_key ?? '';
                                        $maskedKey = $apiKey ? substr($apiKey, 0, 5) . str_repeat('*', max(0, strlen($apiKey) - 5)) : '—';
                                    @endphp
                                    <span class="text-danger" id="api-key">{{ $maskedKey }}</span>
                                    <a href="javascript:;" id="btn-change-key" class="ms-2" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Regenerate API Key">
                                        <i class="fa fa-refresh fs-4"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>HTTP Method</td>
                                <td class="fw-bold">POST</td>
                            </tr>
                            <tr>
                                <td>Content-Type</td>
                                <td class="fw-bold">application/x-www-form-urlencoded</td>
                            </tr>
                            <tr>
                                <td>Response</td>
                                <td class="fw-bold">JSON</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-5">
            <div class="card-body p-2">
                <div class="d-flex flex-column flex-md-row">
                    <ul class="nav nav-tabs nav-pills border-0 flex-row flex-md-column me-5 mb-3 mb-md-0 fs-6"
                        role="tablist">
                        <li class="nav-item w-md-200px me-0" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#services" aria-selected="true"
                                role="tab">Services</a>
                        </li>
                        <li class="nav-item w-md-200px me-0" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#add" aria-selected="false" tabindex="-1"
                                role="tab">Add order</a>
                        </li>
                        <li class="nav-item w-md-200px me-0" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#status" aria-selected="false" tabindex="-1"
                                role="tab">Order status</a>
                        </li>
                        <li class="nav-item w-md-200px me-0" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#multistatus" aria-selected="false"
                                tabindex="-1" role="tab">Multiple orders status</a>
                        </li>
                        <li class="nav-item w-md-200px me-0" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#refill" aria-selected="false" tabindex="-1"
                                role="tab">Create refill</a>
                        </li>
                        <li class="nav-item w-md-200px me-0" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#refills" aria-selected="false" tabindex="-1"
                                role="tab">Create multiple refill</a>
                        </li>
                        <li class="nav-item w-md-200px me-0" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#refill_status" aria-selected="false"
                                tabindex="-1" role="tab">Refill status</a>
                        </li>
                        <li class="nav-item w-md-200px me-0" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#refills_status" aria-selected="false"
                                tabindex="-1" role="tab">Multiple refill status</a>
                        </li>
                        <li class="nav-item w-md-200px" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#products" aria-selected="false"
                                tabindex="-1" role="tab">Products</a>
                        </li>
                        <li class="nav-item w-md-200px" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#add_product_order" aria-selected="false"
                                tabindex="-1" role="tab">Add product order</a>
                        </li>
                        <li class="nav-item w-md-200px" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#product_order_status" aria-selected="false"
                                tabindex="-1" role="tab">Product order status</a>
                        </li>
                        <li class="nav-item w-md-200px" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#multiple_product_order_status"
                                aria-selected="false" tabindex="-1" role="tab">Multiple product orders status</a>
                        </li>
                        <li class="nav-item w-md-200px" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#result_product" aria-selected="false"
                                tabindex="-1" role="tab">Result product</a>
                        </li>
                        <li class="nav-item w-md-200px" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#balance" aria-selected="false" tabindex="-1"
                                role="tab">Balance</a>
                        </li>
                    </ul>
                    <div class="tab-content w-100">
                        <div class="tab-pane fade show active" id="services" role="tabpanel">
                            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                        <td class="fw-bolder" data-lang="Description">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>"services"</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 data-lang="Example response">Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html mb-0">[
    {
        "service": 1,
        "name": "Youtube views",
        "type": "Default",
        "category": "Youtube",
        "rate": "2.5",
        "min": "200",
        "max": "10000",
        "refill": true
    },
    {
        "service": 2,
        "name": "Facebook comments",
        "type": "Custom Comments",
        "category": "Facebook",
        "rate": "4",
        "min": "10",
        "max": "1500",
        "refill": false
    }
]</pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="add" role="tabpanel">
                            <div class="mb-5">
                                <label class="form-label">Type</label>
                                <select id="sl-add-type" class="form-select form-select-solid"
                                    data-hide-search="true">
                                    <option value="default">Default</option>
                                    <option value="package">Package</option>
                                    <option value="custom-comments">Custom Comments</option>
                                    <option value="special">Special (1DG)</option>
                                    <option value="special1">Special 1 (1DG)</option>
                                </select>
                            </div>
                            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                        <td class="fw-bolder" data-lang="Description">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>"add"</td>
                                    </tr>
                                    <tr>
                                        <td>service</td>
                                        <td>Service ID</td>
                                    </tr>
                                    <tr>
                                        <td>link</td>
                                        <td>Link</td>
                                    </tr>
                                    <tr class="options default special special1">
                                        <td>quantity</td>
                                        <td>Needed quantity</td>
                                    </tr>
                                    <tr class="options special" style="display: none;">
                                        <td>list</td>
                                        <td>Suggest video list or Keyword search list</td>
                                    </tr>
                                    <tr class="options special1" style="display: none;">
                                        <td>suggest</td>
                                        <td>Suggest video list</td>
                                    </tr>
                                    <tr class="options special1" style="display: none;">
                                        <td>search</td>
                                        <td>Keyword search list</td>
                                    </tr>
                                    <tr class="options custom-comments" style="display: none;">
                                        <td>comments</td>
                                        <td>Comment list separated by \n</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 data-lang="Example response">Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html mb-0">{
    "order": 99999
}</pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="status" role="tabpanel">
                            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                        <td class="fw-bolder" data-lang="Description">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>"status"</td>
                                    </tr>
                                    <tr>
                                        <td>order</td>
                                        <td>Order ID</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 data-lang="Example response">Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html mb-0">{
    "charge": "2.5",
    "start_count": "168",
    "status": "Completed",
    "remains": "-2"
}</pre>
                            </div>
                            <p><strong>Status</strong>: <em>Pending, Processing, In progress, Completed, Partial,
                                    Canceled</em></p>
                        </div>

                        <div class="tab-pane fade" id="multistatus" role="tabpanel">
                            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                        <td class="fw-bolder" data-lang="Description">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>"status"</td>
                                    </tr>
                                    <tr>
                                        <td>orders</td>
                                        <td>Order IDs separated by comma (E.g: 123,456,789) (Limit 100)</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 data-lang="Example response">Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html mb-0">{
    "123": {
        "charge": "0.27819",
        "start_count": "3572",
        "status": "Partial",
        "remains": "157"
    },
    "456": {
        "error": "Incorrect order ID"
    },
    "789": {
        "charge": "1.44219",
        "start_count": "234",
        "status": "In progress",
        "remains": "10"
    }
}</pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="balance" role="tabpanel">
                            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                        <td class="fw-bolder" data-lang="Description">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>"balance"</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 data-lang="Example response">Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html mb-0">{
    "balance": "68.6868",
    "currency": "USD"
}</pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="refill" role="tabpanel">
                            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                        <td class="fw-bolder" data-lang="Description">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>"refill"</td>
                                    </tr>
                                    <tr>
                                        <td>order</td>
                                        <td>Order ID</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 data-lang="Example response">Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html mb-0">{
    "refill": "1"
}</pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="refills" role="tabpanel">
                            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                        <td class="fw-bolder" data-lang="Description">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>"refill"</td>
                                    </tr>
                                    <tr>
                                        <td>orders</td>
                                        <td>Order IDs separated by comma (E.g: 123,456,789) (Limit 100)</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 data-lang="Example response">Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html mb-0">{
    "refill": "1"
}</pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="refill_status" role="tabpanel">
                            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                        <td class="fw-bolder" data-lang="Description">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>"refill_status"</td>
                                    </tr>
                                    <tr>
                                        <td>refill</td>
                                        <td>Refill ID</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 data-lang="Example response">Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html mb-0">{
    "status": "Completed"
}</pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="refills_status" role="tabpanel">
                            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                        <td class="fw-bolder" data-lang="Description">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>"refill_status"</td>
                                    </tr>
                                    <tr>
                                        <td>refills</td>
                                        <td>Refill IDs separated by comma (E.g: 123,456,789) (Limit 100)</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 data-lang="Example response">Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html mb-0">[
    {
        "refill": 1,
        "status": "Completed"
    },
    {
        "refill": 2,
        "status": "Rejected"
    },
    {
        "refill": 3,
        "status": {
            "error": "Incorrect refill ID"
        }
    }
]</pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="products" role="tabpanel">
                            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                        <td class="fw-bolder" data-lang="Description">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>"products"</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 data-lang="Example response">Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html mb-0">[
    {
        "product": 1,
        "name": "Netflix premium 1 month",
        "require": "Input your account",
        "rate": 2.5,
        "min": 1,
        "max": 10,
        "category": "Netflix",
        "status": "In stock",
        "inventory": 40,
        "type": "Auto"
    },
    {
        "product": 2,
        "name": "Youtube premium 1 month",
        "require": "Input your account",
        "rate": 5,
        "min": 1,
        "max": 1,
        "category": "Youtube"
        "status": "Out of stock"
        "inventory": 0,
        "type": "Auto"
    },
    {
        "product": 3,
        "name": "Facebook account 5000 friends"
        "rate": 0.5,
        "min": 1,
        "max": 2,
        "category": "Facebook"
        "status": "In stock",
        "type": "Service"
    }
]</pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="add_product_order" role="tabpanel">
                            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                        <td class="fw-bolder" data-lang="Description">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>"add_product_order"</td>
                                    </tr>
                                    <tr>
                                        <td>product</td>
                                        <td>Product ID</td>
                                    </tr>
                                    <tr class="options default special special1">
                                        <td>quantity</td>
                                        <td>Needed quantity</td>
                                    </tr>
                                    <tr>
                                        <td>require</td>
                                        <td>Infomation need to process</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 data-lang="Example response">Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html mb-0">{
    "order": 99999
} </pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="product_order_status" role="tabpanel">
                            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                        <td class="fw-bolder" data-lang="Description">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>"product_order_status"</td>
                                    </tr>
                                    <tr>
                                        <td>order</td>
                                        <td>Product Order ID</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 data-lang="Example response">Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html mb-0">{
    "charge": 7.5,
    "status": "Completed",
    "result": "c85c1d1a-9ef3-4d01-8c58-3dfaf3bbc78e"
}
{
    "charge": 6,
    "status": "Partial",
    "remains": 3,
    "result": "c85c1d1a-9ef3-4d01-8c58-3dfaf3bbc457"
}</pre>
                            </div>
                            <p><strong>Status</strong>: <em>Pending, In progress, Completed, Partial, Canceled</em>
                            </p>
                        </div>

                        <div class="tab-pane fade" id="multiple_product_order_status" role="tabpanel">
                            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                        <td class="fw-bolder" data-lang="Description">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>"product_order_status"</td>
                                    </tr>
                                    <tr>
                                        <td>orders</td>
                                        <td>Product Order IDs separated by comma (E.g: 123,456,789) (Limit 100)</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 data-lang="Example response">Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html mb-0">{
    "123": {
        "charge": 7.5,
        "status": "Completed",
        "result": "c85c1d1a-9ef3-4d01-8c58-3dfaf3bbc78e"
    },
    "456": {
        "error": "Incorrect order ID"
    },
    "789": {
        "charge": 0,
        "status": "Canceled",
        "note": "Out of stock"
    },
    "321": @{{
        "charge": 6,
        "status": "Partial",
        "remains": 3,
        "result": "c85c1d1a-9ef3-4d01-8c58-3dfaf3bbc457"
    @}}
}</pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="result_product" role="tabpanel">
                            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                        <td class="fw-bolder" data-lang="Description">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>"result_product"</td>
                                    </tr>
                                    <tr>
                                        <td>order</td>
                                        <td>Product Order ID</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 data-lang="Example response">Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html mb-0">{
    "result": [
        "abc@gmail | 2 | 3",
        "abc1@gmail | 2 | 3",
        "abc2@gmail | 2 | 3"
    ]
}</pre>
                            </div>
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
(function() {
    // Type select in Add order tab
    var typeSelect = document.getElementById('sl-add-type');
    if (typeSelect) {
        $(typeSelect).select2({
            minimumResultsForSearch: -1,
            width: '100%'
        }).on('change', function() {
            var val = $(this).val();
            document.querySelectorAll('#add table tr.options').forEach(function(row) {
                row.style.display = row.classList.contains(val) ? '' : 'none';
            });
        });
        // Trigger on init
        var initVal = $(typeSelect).val();
        document.querySelectorAll('#add table tr.options').forEach(function(row) {
            row.style.display = row.classList.contains(initVal) ? '' : 'none';
        });
    }

    // Regenerate API key
    var btn = document.getElementById('btn-change-key');
    if (!btn) return;
    btn.addEventListener('click', function() {
        btn.style.pointerEvents = 'none';
        fetch('{{ route("clients.account.generate-api-key") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(function(r) { return r.json(); })
        .then(function(res) {
            if (res.success && res.api_key) {
                document.getElementById('api-key').textContent = res.api_key;
            } else {
                alert(res.message || 'Error generating API key.');
            }
        })
        .catch(function() { alert('Network error.'); })
        .finally(function() { btn.style.pointerEvents = ''; });
    });
})();
</script>
@endpush