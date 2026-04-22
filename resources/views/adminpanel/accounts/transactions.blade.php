@extends('adminpanel.layouts.app')
@section('title', 'Accounts')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        @include('adminpanel.accounts.partials.header')

        <span class="title d-none">View account - Transactions</span>
        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2" data-lang="Transactions">Giao dịch</h3>
        </div>
        <div class="row g-6">
            <div class="col-xl-12" id="tab-transactions">
                <div class="card card-transactions">
                    <div class="card-body">
                        <p class="fst-italic">* <span data-lang="note-transactions">Lịch sử này chỉ hiển thị trong 3 tháng
                                gần nhất. Nếu bạn muốn truy cập dữ liệu cũ hơn. Truy cập ở </span><a href="javascript:;"
                                onclick="_accounts.on.click.switchTransactionCard('card-transactions-old')"
                                data-lang="note-transactions-1">đây</a>.</p>
                        <div class="table-responsive">
                            <div id="table-transactions_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                                <div id="" class="table-responsive">
                                    <div id="table-transactions_processing" class="dt-processing card" role="status"
                                        style="display: none;"><span
                                            class="spinner-border w-15px h-15px text-muted align-middle me-2"></span> <span
                                            class="text-gray-600">Loading...</span>
                                        <div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>
                                    <table class="table align-middle table-row-dashed fs-7 gy-2 dataTable"
                                        id="table-transactions" aria-describedby="table-transactions_info"
                                        style="width: 100%;">
                                        <colgroup>
                                            <col data-dt-column="2" style="width: 135.609px;">
                                            <col data-dt-column="3" style="width: 135.797px;">
                                            <col data-dt-column="4" style="width: 177.219px;">
                                            <col data-dt-column="5" style="width: 157.562px;">
                                            <col data-dt-column="6" style="width: 275.312px;">
                                        </colgroup>
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0"
                                                role="row">
                                                <th data-dt-column="2" rowspan="1" colspan="1"
                                                    class="dt-orderable-none" aria-label="Action"><span
                                                        class="dt-column-title">Action</span><span
                                                        class="dt-column-order"></span></th>
                                                <th data-dt-column="3" rowspan="1" colspan="1"
                                                    class="dt-orderable-none" aria-label="ID"><span
                                                        class="dt-column-title">ID</span><span
                                                        class="dt-column-order"></span></th>
                                                <th data-dt-column="4" rowspan="1" colspan="1"
                                                    class="dt-orderable-none" aria-label="Change"><span
                                                        class="dt-column-title">Change</span><span
                                                        class="dt-column-order"></span></th>
                                                <th data-dt-column="5" rowspan="1" colspan="1"
                                                    class="dt-orderable-none" aria-label="Balance"><span
                                                        class="dt-column-title">Balance</span><span
                                                        class="dt-column-order"></span></th>
                                                <th data-dt-column="6" rowspan="1" colspan="1"
                                                    class="dt-orderable-none" aria-label="Created"><span
                                                        class="dt-column-title">Created</span><span
                                                        class="dt-column-order"></span></th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-7 text-gray-700" style="display: none;">
                                            @forelse($transactions as $transaction)
                                                <tr>
                                                    <td>
                                                        @switch($transaction->type)
                                                            @case('deposit')
                                                                <span data-lang="Deposit">Nạp tiền</span>
                                                                @break
                                                            @case('withdraw')
                                                                <span data-lang="Withdraw">Rút tiền</span>
                                                                @break
                                                            @case('order')
                                                                <span data-lang="Order">Đơn hàng</span>
                                                                @break
                                                            @case('refund')
                                                                <span data-lang="Refund">Hoàn tiền</span>
                                                                @break
                                                            @case('bonus')
                                                                <span data-lang="Bonus">Thưởng</span>
                                                                @break
                                                            @default
                                                                {{ ucfirst($transaction->type) }}
                                                        @endswitch
                                                    </td>
                                                    <td>{{ $transaction->transaction_id }}</td>
                                                    <td>
                                                        @if(in_array($transaction->type, ['deposit', 'refund', 'bonus']))
                                                            <span class="text-success">{{ formatAmount($transaction->amount) }}</span>
                                                        @else
                                                            <span class="text-danger">-{{ formatAmount($transaction->amount) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ formatAmount($transaction->balance_after ?? 0) }}</td>
                                                    <td>{{ $transaction->created_at?->format('Y-m-d H:i:s') ?? '-' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-3">
                                                        <span class="text-muted">Không có giao dịch nào</span>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                                <div id="" class="row">
                                    <div id=""
                                        class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start dt-toolbar">
                                        <div class="d-flex align-items-center gap-2">
                                            <label for="dt-length-0" class="text-nowrap" data-lang="Show">Hiển thị:</label>
                                            <select name="table-transactions_length" aria-controls="table-transactions"
                                                class="form-select form-select-solid form-select-sm" id="dt-length-0"
                                                onchange="window.location.href='?per_page=' + this.value">
                                                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                        <div class="dt-info ms-3" aria-live="polite" id="table-transactions_info"
                                            role="status">
                                            Hiển thị {{ $transactions->firstItem() ?? 0 }} - {{ $transactions->lastItem() ?? 0 }} / {{ $transactions->total() }}
                                        </div>
                                    </div>
                                    <div id=""
                                        class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination mb-0">
                                                @if ($transactions->onFirstPage())
                                                    <li class="page-item disabled">
                                                        <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $transactions->previousPageUrl() }}" aria-label="Previous">
                                                            <i class="bi bi-chevron-left"></i>
                                                        </a>
                                                    </li>
                                                @endif

                                                @foreach ($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                                                    @if ($page == $transactions->currentPage())
                                                        <li class="page-item active">
                                                            <span class="page-link">{{ $page }}</span>
                                                        </li>
                                                    @else
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach

                                                @if ($transactions->hasMorePages())
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $transactions->nextPageUrl() }}" aria-label="Next">
                                                            <i class="bi bi-chevron-right"></i>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="page-item disabled">
                                                        <span class="page-link"><i class="bi bi-chevron-right"></i></span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-transactions-old" style="display: none;">
                    <div class="card-header">
                        <div class="card-title flex-column">
                            <h2 class="mb-1"><i class="bi bi-arrow-left-circle fs-2 me-2 pointer text-gray-800"
                                    onclick="_accounts.on.click.switchTransactionCard('card-transactions')"></i><span
                                    data-lang="button::Back">Quay lại</span></h2>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-5">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-7 gy-2" id="table-transactions-old">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th></th>
                                        <th></th>
                                        <th>Action</th>
                                        <th>ID</th>
                                        <th>Change</th>
                                        <th>Balance</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-7 fw-semibold text-gray-700"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toggleTableLoader(true);
            setTimeout(() => {
                toggleTableLoader(false);
                // Hiển thị tbody sau khi Loading... xong
                const tbody = document.querySelector('#table-transactions tbody');
                if (tbody) tbody.style.display = '';
            }, 500);
        });

        function toggleTableLoader(show) {
            const loader = document.getElementById('table-transactions_processing');
            const table = document.getElementById('table-transactions');

            if (loader) loader.style.display = show ? 'block' : 'none';
            if (table) table.style.opacity = show ? '0.4' : '1';
        }
    </script>
@endsection
