@extends('adminpanel.layouts.app')
@section('title', 'Tickets')
@section('content')
<div class="content flex-row-fluid" id="kt_content">
    <div class="d-flex flex-wrap flex-stack mb-6">
        <h3 class="fw-bold my-2">
            <span><span data-lang="Waiting">Đang chờ</span>: {{ $stats['waiting'] }}</span> |
            <span class="text-primary"><span data-lang="Processing">Đang xử lý</span>: {{ $stats['processing'] }}</span>
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-row-bordered fs-7 gx-0">
                            @forelse($ticketOrders as $providerId => $orders)
                            <tbody>
                                {{-- Provider group header --}}
                                <tr>
                                    <td colspan="7" class="fs-5 fw-bolder ls-1">
                                        <i class="fa-solid fa-house me-1"></i>
                                        {{ $orders->first()->provider_name ?? 'Manual' }}
                                        <button type="button" class="btn btn-secondary btn-sm fs-7 py-1 px-2 ms-3"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                            <span data-lang="Action">Tùy chọn</span>
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                        </button>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-150px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" onclick="_tickets.on.click.processing(0, {{ $providerId ?? 0 }})"
                                                    class="menu-link px-3" data-lang="Processing">Đang xử lý</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" onclick="_tickets.on.click.done(0, {{ $providerId ?? 0 }})"
                                                    class="menu-link px-3" data-lang="Done">Hoàn thành</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Sub-group theo service --}}
                                @foreach($orders->groupBy('service_id') as $serviceId => $serviceOrders)
                                <tr>
                                    <td colspan="7" class="fs-6 fw-bold">
                                        <i class="fa fa-crosshairs ps-10 me-1"></i>
                                        {{ $serviceOrders->first()->service_name ?? 'Manual' }}
                                        <button type="button" class="btn btn-secondary btn-sm fs-7 py-1 px-2 ms-3"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                            <span data-lang="Action">Tùy chọn</span>
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                        </button>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-150px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" onclick="_tickets.on.click.processing(1, {{ $serviceId ?? 0 }})"
                                                    class="menu-link px-3" data-lang="Processing">Đang xử lý</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" onclick="_tickets.on.click.done(1, {{ $serviceId ?? 0 }})"
                                                    class="menu-link px-3" data-lang="Done">Hoàn thành</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                @foreach($serviceOrders as $order)
                                <tr>
                                    <td class="ps-20">
                                        <a href="javascript:;" onclick="_tickets.on.click.history({{ $order->id }})"
                                            data-bs-toggle="tooltip" title="Lịch sử yêu cầu">
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                        </a>
                                        <a target="_blank" class="fw-bold text-hover-primary ms-2"
                                            href="/admin/orders?id={{ $order->id }}">{{ $order->id }}</a>
                                    </td>
                                    <td>
                                        @if($order->ticket === 'speedup')
                                            <span class="badge badge-outline badge-primary" data-lang="Speed up">Tăng tốc</span>
                                        @elseif($order->ticket === 'refill')
                                            <span class="badge badge-outline badge-info" data-lang="Refill">Bảo hành</span>
                                        @elseif($order->ticket === 'cancel')
                                            <span class="badge badge-outline badge-warning" data-lang="Cancel">Hủy</span>
                                        @else
                                            <span class="badge badge-outline badge-secondary">{{ $order->ticket }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a target="_blank" class="text-gray-800"
                                            href="/admin/accounts/{{ $order->username }}">{{ $order->username }}</a>
                                    </td>
                                    <td data-bs-toggle="tooltip" title="Created">
                                        <span data-lang="Created">{{ $order->created_at }}</span>
                                        <span class="fst-italic">({{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }})</span>
                                    </td>
                                    <td data-bs-toggle="tooltip" title="Updated">
                                        <span data-lang="Updated">{{ $order->updated_at }}</span>
                                        <span class="fst-italic">({{ \Carbon\Carbon::parse($order->updated_at)->diffForHumans() }})</span>
                                    </td>
                                    <td><span class="fw-bolder" data-lang="Waiting">Đang chờ</span></td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-secondary btn-sm fs-7 py-1 px-2"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                            <span data-lang="Action">Tùy chọn</span>
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                        </button>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-150px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" onclick="_tickets.on.click.processing(2, {{ $order->id }})"
                                                    class="menu-link px-3" data-lang="Processing">Đang xử lý</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" onclick="_tickets.on.click.done(2, {{ $order->id }})"
                                                    class="menu-link px-3" data-lang="Done">Hoàn thành</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                            @empty
                            <tbody>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-10">
                                        <span data-lang="No orders waiting">Không có đơn hàng nào đang chờ xử lý</span>
                                    </td>
                                </tr>
                            </tbody>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal-history-ticket">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" data-lang="History request">Lịch sử yêu cầu</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-row-bordered gx-0">
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                <th>#</th>
                                <th data-lang="Request">Yêu cầu</th>
                                <th data-lang="Created">Created</th>
                                <th data-lang="Updated">Updated</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
