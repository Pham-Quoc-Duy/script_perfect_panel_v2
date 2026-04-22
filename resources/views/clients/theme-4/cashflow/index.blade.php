@extends('clients.theme-4.layouts.app')
@section('title', 'Cashflow')

@section('content')
<div class="content flex-column-fluid" id="kt_content">
    @include('clients.theme-4.layouts.toolbar', ['toolbarTitle' => 'Cashflow'])
    <div class="post" id="kt_post">

        @if ($orderId)
            <div class="d-flex align-items-center justify-content-between mb-3 px-1">
                <div class="d-flex align-items-center gap-3">
                    <span class="fs-7 text-muted" data-lang="cashflow.order_id">Order ID</span>
                    <span class="fw-bold fs-6">#{{ $orderId }}</span>
                    @if ($order)
                        <span class="text-muted fs-8">|</span>
                        <span class="fs-8 text-gray-600 wrap">{{ $order->link }}</span>
                    @endif
                </div>
                <a href="/cashflow" class="btn btn-sm btn-light-primary px-3 py-1 fs-8">
                    <i class="ki-outline ki-arrow-left fs-8 me-1"></i>
                    <span data-lang="cashflow.back">Back</span>
                </a>
            </div>
        @endif

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-7 gy-3 gs-10 mb-0">
                        <thead class="text-start text-muted bg-light fw-bold fs-7 text-uppercase gs-0">
                            <tr>
                                <th data-lang="cashflow.created">Created</th>
                                <th data-lang="cashflow.action">Action</th>
                                <th data-lang="cashflow.details">Details</th>
                                <th class="text-end" data-lang="cashflow.change">Change</th>
                                <th class="text-end" data-lang="cashflow.balance">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $fmtMoney = function($v) use ($sym, $symPos, $exRate) {
                                    $amount = $exRate > 0 ? (float)$v * $exRate : (float)$v;
                                    $str = rtrim(rtrim(number_format($amount, 8, '.', ''), '0'), '.');
                                    if ($str === '' || $str === '.') $str = '0';
                                    return $symPos === 'before' ? $sym . $str : $str . ' ' . $sym;
                                };
                                $totalChange = 0;
                            @endphp
                            @forelse ($transactions as $tx)
                                @php
                                    $totalChange += (float)$tx->amount;
                                    $actionKey = match($tx->type) {
                                        'order'   => 'cashflow.add_order',
                                        'refund'  => 'cashflow.refund',
                                        'deposit' => 'cashflow.deposit',
                                        'bonus'   => 'cashflow.bonus',
                                        default   => 'cashflow.add_order',
                                    };
                                    $actionText = match($tx->type) {
                                        'order'   => 'Add order',
                                        'refund'  => 'Refund',
                                        'deposit' => 'Deposit',
                                        'bonus'   => 'Bonus',
                                        default   => ucfirst($tx->type),
                                    };
                                @endphp
                                <tr>
                                    <td class="text-nowrap text-gray-600 fs-8">{{ $tx->created_at }}</td>
                                    <td>
                                        <span class="fw-semibold" data-lang="{{ $actionKey }}">{{ $actionText }}</span>
                                    </td>
                                    <td class="ls-1">
                                        @if ($tx->order_id && !$orderId)
                                            <a href="/cashflow?id={{ $tx->order_id }}" class="text-reset text-hover-primary">{{ $tx->order_id }}</a>
                                        @elseif ($tx->description)
                                            <span class="text-muted fs-8">{{ $tx->description }}</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold {{ (float)$tx->amount < 0 ? 'text-danger' : 'text-success' }}">
                                            {{ (float)$tx->amount >= 0 ? '+' : '' }}{{ $fmtMoney($tx->amount) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold">{{ $tx->balance_after !== null ? $fmtMoney($tx->balance_after) : '—' }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-10">
                                        <i class="bi bi-inbox fs-2x d-block mb-2"></i>
                                        <span data-lang="cashflow.no_data">No data</span>
                                    </td>
                                </tr>
                            @endforelse

                            @if ($orderId && $transactions->count() > 0)
                                <tr class="bg-light">
                                    <td colspan="3" class="text-end fw-bold text-muted fs-8" data-lang="cashflow.total">Total</td>
                                    <td class="text-end">
                                        <span class="fw-bold fs-6 {{ $totalChange < 0 ? 'text-danger' : 'text-success' }}">
                                            {{ $totalChange >= 0 ? '+' : '' }}{{ $fmtMoney($totalChange) }}
                                        </span>
                                    </td>
                                    <td></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if ($transactions->hasPages())
                    <div class="d-flex justify-content-center py-4">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
