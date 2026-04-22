@extends('clients.theme-4.layouts.app')
@section('title', 'Refill')

@section('content')
    @php
        $currentStatus = request()->route('status') ?? request('status', '');
    @endphp
    <div class="content flex-column-fluid" id="kt_content">
        @include('clients.theme-4.layouts.toolbar', ['toolbarTitle' => 'Refill'])
        <div class="post" id="kt_post">

            <div class="card mb-5">
                <div class="card-body p-3">
                    <form method="GET" action="#" id="form-filter">
                        <div class="row g-5">
                            <div class="col-lg-3 col-6">
                                <select id="sl-status" class="form-select form-select-sm form-select-solid">
                                    <option value=""           {{ $currentStatus === '' ? 'selected' : '' }} data-lang="orders.all_status">All status</option>
                                    <option value="pending"    {{ $currentStatus === 'pending'    ? 'selected' : '' }} data-lang="status::pending">Pending</option>
                                    <option value="inprogress" {{ $currentStatus === 'inprogress' ? 'selected' : '' }} data-lang="status::in_progress">In progress</option>
                                    <option value="completed"  {{ $currentStatus === 'completed'  ? 'selected' : '' }} data-lang="status::completed">Completed</option>
                                    <option value="rejected"   {{ $currentStatus === 'rejected'   ? 'selected' : '' }} data-lang="status::rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-6">
                                <select id="sl-type" class="form-select form-select-sm form-select-solid">
                                    <option value="0" {{ request('type', '0') == '0' ? 'selected' : '' }} data-lang="refill.search_type">Search type</option>
                                    <option value="1" {{ request('type') == '1' ? 'selected' : '' }} data-lang="refill.refill_id_type">Refill ID</option>
                                    <option value="2" {{ request('type') == '2' ? 'selected' : '' }} data-lang="refill.order_id_type">Order ID</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-group input-group-sm input-group-solid">
                                    <input type="text" id="ipt-keyword" class="form-control"
                                        placeholder="Keyword" data-lang="refill.keyword"
                                        value="{{ request('keyword', request('search')) }}">
                                    <button type="submit" class="btn btn-sm btn-primary" data-lang="button::search">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-7 gy-3 gs-10">
                            <thead class="text-start text-muted bg-light fw-bold fs-7 text-uppercase gs-0">
                                <tr>
                                    <th data-lang="refill.refill_id">Refill ID</th>
                                    <th data-lang="refill.order_id">Order ID</th>
                                    <th data-lang="refill.service">Service</th>
                                    <th data-lang="refill.link">Link</th>
                                    <th data-lang="refill.created">Created</th>
                                    <th data-lang="refill.status">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($refills as $refill)
                                    @php
                                        $serviceName = $refill->service->name ?? 'N/A';
                                        if (is_array($serviceName)) {
                                            $lang = auth()->user()->lang ?? 'en';
                                            $serviceName = $serviceName[$lang] ?? ($serviceName['en'] ?? reset($serviceName) ?? 'N/A');
                                        }
                                        $statusClass = match($refill->refill_status ?? 'pending') {
                                            'completed'  => 'badge-light-success',
                                            'rejected'   => 'badge-light-danger',
                                            'inprogress' => 'badge-light-warning',
                                            default      => 'badge-light-primary',
                                        };
                                    @endphp
                                    <tr>
                                        <td class="ls-1">{{ $refill->id }}</td>
                                        <td class="ls-1 fw-bold">
                                            <a href="/orders?search={{ $refill->orders_api }}" class="text-gray-800 text-hover-primary">
                                                {{ $refill->orders_api }}
                                            </a>
                                        </td>
                                        <td class="text-gray-700">{{ $refill->service_id }} — {{ $serviceName }}</td>
                                        <td class="mw-150px">
                                            @if ($refill->link)
                                                <a href="{{ $refill->link }}" target="_blank"
                                                    class="text-gray-600 text-hover-primary text-truncate d-block mw-150px"
                                                    title="{{ $refill->link }}">{{ Str::limit($refill->link, 35) }}</a>
                                            @else —
                                            @endif
                                        </td>
                                        <td class="text-muted">{{ $refill->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <span class="badge {{ $statusClass }} fs-8 fw-bold"
                                                data-lang="status::{{ $refill->refill_status ?? 'pending' }}">
                                                {{ ucfirst($refill->refill_status ?? 'pending') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-10" data-lang="refill.no_refills_found">
                                            No refill found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($refills->hasPages())
                        <div class="px-5 py-4">
                            {{ $refills->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var CURRENT_STATUS = '{{ $currentStatus }}';
    var s2opts = { escapeMarkup: function(m){return m;}, minimumResultsForSearch: -1, width: '100%' };

    function navigate(status) {
        var keyword = document.getElementById('ipt-keyword').value.trim();
        var type    = $('#sl-type').val();
        var base    = status ? '/refill/' + status : '/refill';
        var qs      = [];
        if (type && type !== '0') qs.push('type=' + type);
        if (keyword) qs.push('keyword=' + encodeURIComponent(keyword));
        window.location.href = base + (qs.length ? '?' + qs.join('&') : '');
    }

    $('#sl-status').select2(s2opts).on('change', function () { navigate($(this).val()); });
    $('#sl-type').select2(s2opts);

    document.getElementById('form-filter').addEventListener('submit', function (e) {
        e.preventDefault();
        navigate(CURRENT_STATUS);
    });
});
</script>
@endpush
