@extends('adminpanel.layouts.app')
@section('title', 'API Documentation')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card shadow-sm">
            <div class="card-body fs-7">

                {{-- Info table --}}
                <div class="table-responsive mb-5">
                    <table class="table fs-7 align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                        <tbody>
                            <tr>
                                <td class="text-gray-700">API URL</td>
                                <td class="fw-bolder">https://{{ getDomain() }}/api/adminv1 </td>
                            </tr>
                            <tr>
                                <td class="text-gray-700">API Key</td>
                                <td class="fw-bolder">
                                    <span class="text-danger" id="key">
                                        {{ $apiKey ? substr($apiKey, 0, 5) . str_repeat('*', max(0, strlen($apiKey) - 5)) : '—' }}
                                    </span>
                                    <a href="javascript:;" onclick="_api.on.click.changeKey()" class="ms-2"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Tạo key mới">
                                        <i class="fa fa-refresh fs-4"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gray-700">HTTP Method</td>
                                <td class="fw-bolder">POST</td>
                            </tr>
                            <tr>
                                <td class="text-gray-700">Content-Type</td>
                                <td class="fw-bolder">application/x-www-form-urlencoded</td>
                            </tr>
                            <tr>
                                <td class="text-gray-700">Response</td>
                                <td class="fw-bolder">JSON</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Tabs --}}
                <div class="d-flex flex-column flex-md-row">
                    <ul class="nav nav-tabs nav-pills border-0 flex-row flex-md-column me-5 mb-3 mb-md-0 fs-7"
                        role="tablist">
                        @foreach (['getOrder', 'getOrders', 'updateOrders', 'setStatus', 'setStartCount', 'setRemains', 'addFund'] as $tab)
                            <li class="nav-item w-md-200px me-0" role="presentation">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                    href="#{{ $tab }}" role="tab">{{ $tab }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content w-100 fs-7">

                        {{-- getOrder --}}
                        <div class="tab-pane fade show active" id="getOrder" role="tabpanel">
                            <p class="fst-italic text-muted mb-3">Gives one Pending order.</p>
                            <div class="table-responsive mb-4">
                                <table
                                    class="table fs-7 align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                    <tbody>
                                        <tr class="bg-light fw-bold">
                                            <td>Parameters</td>
                                            <td>Description</td>
                                        </tr>
                                        <tr>
                                            <td>key</td>
                                            <td>API Key</td>
                                        </tr>
                                        <tr>
                                            <td>action</td>
                                            <td>"getOrder"</td>
                                        </tr>
                                        <tr>
                                            <td>type</td>
                                            <td>Service ID</td>
                                        </tr>
                                        <tr>
                                            <td>status</td>
                                            <td>(Optional) Set status</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="fw-bold mb-1">Example response</p>
                            <div class="bg-light-success rounded p-3 mb-2">
                                <pre class="mb-0 fs-7">{
    "id": 12345,
    "link": "https://www.example.com/watch?v=12345",
    "quantity": 1000,
    "comment": ["a", "b", "c", "d"]
}</pre>
                            </div>
                        </div>

                        {{-- getOrders --}}
                        <div class="tab-pane fade" id="getOrders" role="tabpanel">
                            <p class="fst-italic text-muted mb-3">Gives 100 Pending orders.</p>
                            <div class="table-responsive mb-4">
                                <table
                                    class="table fs-7 align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                    <tbody>
                                        <tr class="bg-light fw-bold">
                                            <td>Parameters</td>
                                            <td>Description</td>
                                        </tr>
                                        <tr>
                                            <td>key</td>
                                            <td>API Key</td>
                                        </tr>
                                        <tr>
                                            <td>action</td>
                                            <td>"getOrders"</td>
                                        </tr>
                                        <tr>
                                            <td>type</td>
                                            <td>Service ID</td>
                                        </tr>
                                        <tr>
                                            <td>status</td>
                                            <td>(Optional) Set status</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="fw-bold mb-1">Example response</p>
                            <div class="bg-light-success rounded p-3 mb-2">
                                <pre class="mb-0 fs-7">[
    {"id": 12345, "link": "https://www.example.com/watch?v=12345", "quantity": 1000},
    {"id": 54321, "link": "https://www.example.com/watch?v=54321", "quantity": 500}
]</pre>
                            </div>
                        </div>

                        {{-- updateOrders --}}
                        <div class="tab-pane fade" id="updateOrders" role="tabpanel">
                            <div class="table-responsive mb-4">
                                <table
                                    class="table fs-7 align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                    <tbody>
                                        <tr class="bg-light fw-bold">
                                            <td>Parameters</td>
                                            <td>Description</td>
                                        </tr>
                                        <tr>
                                            <td>key</td>
                                            <td>API Key</td>
                                        </tr>
                                        <tr>
                                            <td>action</td>
                                            <td>"updateOrders"</td>
                                        </tr>
                                        <tr>
                                            <td>orders</td>
                                            <td>Array: [{id, status, start_count, remains}]<br><span
                                                    class="text-muted fst-italic">[{"id":1,"status":"In
                                                    progress"},{"id":2,"status":"Completed","remains":-56}]</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="fw-bold mb-1">Example response</p>
                            <div class="bg-light-success rounded p-3 mb-2">
                                <pre class="mb-0 fs-7">{"1":{"status":"In progress"},"2":{"error":"Invalid order id"},"3":{"status":"Completed"}}</pre>
                            </div>
                        </div>

                        {{-- setStatus --}}
                        <div class="tab-pane fade" id="setStatus" role="tabpanel">
                            <div class="table-responsive mb-4">
                                <table
                                    class="table fs-7 align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                    <tbody>
                                        <tr class="bg-light fw-bold">
                                            <td>Parameters</td>
                                            <td>Description</td>
                                        </tr>
                                        <tr>
                                            <td>key</td>
                                            <td>API Key</td>
                                        </tr>
                                        <tr>
                                            <td>action</td>
                                            <td>"setStatus"</td>
                                        </tr>
                                        <tr>
                                            <td>id</td>
                                            <td>Order ID</td>
                                        </tr>
                                        <tr>
                                            <td>status</td>
                                            <td>Processing, In progress, Completed, Canceled, Partial</td>
                                        </tr>
                                        <tr>
                                            <td>remains</td>
                                            <td>Remains quantity (if Partial)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="fw-bold mb-1">Example response</p>
                            <div class="bg-light-success rounded p-3 mb-2">
                                <pre class="mb-0 fs-7">{"success": 12345}</pre>
                            </div>
                        </div>

                        {{-- setStartCount --}}
                        <div class="tab-pane fade" id="setStartCount" role="tabpanel">
                            <div class="table-responsive mb-4">
                                <table
                                    class="table fs-7 align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                    <tbody>
                                        <tr class="bg-light fw-bold">
                                            <td>Parameters</td>
                                            <td>Description</td>
                                        </tr>
                                        <tr>
                                            <td>key</td>
                                            <td>API Key</td>
                                        </tr>
                                        <tr>
                                            <td>action</td>
                                            <td>"setStartCount"</td>
                                        </tr>
                                        <tr>
                                            <td>id</td>
                                            <td>Order ID</td>
                                        </tr>
                                        <tr>
                                            <td>start_count</td>
                                            <td>Start count</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="fw-bold mb-1">Example response</p>
                            <div class="bg-light-success rounded p-3 mb-2">
                                <pre class="mb-0 fs-7">{"success": 12345}</pre>
                            </div>
                        </div>

                        {{-- setRemains --}}
                        <div class="tab-pane fade" id="setRemains" role="tabpanel">
                            <div class="table-responsive mb-4">
                                <table
                                    class="table fs-7 align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                    <tbody>
                                        <tr class="bg-light fw-bold">
                                            <td>Parameters</td>
                                            <td>Description</td>
                                        </tr>
                                        <tr>
                                            <td>key</td>
                                            <td>API Key</td>
                                        </tr>
                                        <tr>
                                            <td>action</td>
                                            <td>"setRemains"</td>
                                        </tr>
                                        <tr>
                                            <td>id</td>
                                            <td>Order ID</td>
                                        </tr>
                                        <tr>
                                            <td>remains</td>
                                            <td>Remains quantity</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="fw-bold mb-1">Example response</p>
                            <div class="bg-light-success rounded p-3 mb-2">
                                <pre class="mb-0 fs-7">{"success": 12345}</pre>
                            </div>
                        </div>

                        {{-- addFund --}}
                        <div class="tab-pane fade" id="addFund" role="tabpanel">
                            <div class="table-responsive mb-4">
                                <table
                                    class="table fs-7 align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                                    <tbody>
                                        <tr class="bg-light fw-bold">
                                            <td>Parameters</td>
                                            <td>Description</td>
                                        </tr>
                                        <tr>
                                            <td>key</td>
                                            <td>API Key</td>
                                        </tr>
                                        <tr>
                                            <td>action</td>
                                            <td>"addFund"</td>
                                        </tr>
                                        <tr>
                                            <td>amount</td>
                                            <td>Amount ($)</td>
                                        </tr>
                                        <tr>
                                            <td>user</td>
                                            <td>Username</td>
                                        </tr>
                                        <tr>
                                            <td>pm_id</td>
                                            <td>Payment method ID</td>
                                        </tr>
                                        <tr>
                                            <td>details</td>
                                            <td>Details (check duplicate)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="fw-bold mb-1">Example response</p>
                            <div class="bg-light-success rounded p-3 mb-2">
                                <pre class="mb-0 fs-7">{"success": "Added"}</pre>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

<script>
    var _api = {
        on: {
            click: {
                changeKey: function() {
                    if (typeof showFullScreenLoader === 'function') showFullScreenLoader('', 'body');
                    fetch('{{ route('admin.api.change-key') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(function(r) { return r.json(); })
                        .then(function(res) {
                            if (res.key) document.getElementById('key').textContent = res.key;
                        })
                        .finally(function() {
                            if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                        });
                }
            }
        }
    };
</script>
