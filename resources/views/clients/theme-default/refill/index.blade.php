@extends('clients.theme-default.layouts.app')

@section('title', __('refill.title'))

@section('content')
    @php
        $currentStatus = request()->route('status') ?? request('status', '');
    @endphp
    <!-- Main variables *content* -->
    <div id="block_72">
        <div class="block-bg"></div>
        <div class="container-fluid">
            <div class="refill ">
                <div class="row">
                    <div class="col">
                        <div class="refill__margin-tab">
                            <div class="component_status_tabs">
                                <div class="">
                                    <ul class="nav nav-pills tab">
                                        <li class="nav-item">
                                            <a class="nav-link {{ $currentStatus === '' || $currentStatus === 'all' ? 'active' : '' }}"
                                                href="/refill">{{ __('common.all') ?? 'All' }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ $currentStatus === 'pending' ? 'active' : '' }}"
                                                href="/refill/pending">{{ __('refill.pending') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ $currentStatus === 'inprogress' ? 'active' : '' }}"
                                                href="/refill/inprogress">{{ __('refill.inprogress') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ $currentStatus === 'completed' ? 'active' : '' }}"
                                                href="/refill/completed">{{ __('refill.completed') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ $currentStatus === 'rejected' ? 'active' : '' }}"
                                                href="/refill/rejected">{{ __('refill.rejected') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ $currentStatus === 'error' ? 'active' : '' }}"
                                                href="/refill/error">{{ __('refill.error') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="refill__margin-search component_card">
                            <div class="card">
                                <div class="component_form_group component_button_search">
                                    <div class="">
                                        <form action="#" method="get" id="history-search">
                                            <div class="input-group">
                                                <input type="text" name="search" id="refill-search-input" class="form-control"
                                                    value="{{ request('search') }}"
                                                    placeholder="{{ __('refill.search_placeholder') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-big-secondary" type="submit">
                                                        <span class="fas fa-search"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <script>
                                        document.getElementById('history-search').addEventListener('submit', function(e) {
                                            e.preventDefault();
                                            var s = document.getElementById('refill-search-input').value;
                                            var base = '{{ $currentStatus ? '/refill/'.$currentStatus : '/refill' }}';
                                            window.location.href = base + (s ? '?search=' + encodeURIComponent(s) : '');
                                        });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="refill__margin-table">
                            <div class="table-bg component_table ">
                                <div class="table-wr table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('refill.id') }}</th>
                                                <th>{{ __('refill.date') }}</th>
                                                <th>{{ __('refill.order_id') }}</th>
                                                <th>{{ __('refill.link') }}</th>
                                                <th>{{ __('refill.service') }}</th>
                                                <th>{{ __('refill.status') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($refills as $refill)
                                                <tr>
                                                    <td data-label="{{ __('refill.id') }}">{{ $refill->id }}</td>
                                                    <td data-label="{{ __('refill.date') }}">
                                                        <span
                                                            class="nowrap">{{ $refill->created_at->format('Y-m-d') }}</span>
                                                        <span
                                                            class="nowrap">{{ $refill->created_at->format('H:i:s') }}</span>
                                                    </td>
                                                    <td data-label="{{ __('refill.order_id') }}" class="table-link">
                                                        <a
                                                            href="/orders?search={{ $refill->orders_api }}">{{ $refill->orders_api }}</a>
                                                    </td>
                                                    <td data-label="{{ __('refill.link') }}" class="table-link">
                                                        <a href="/anon.ws?r={{ urlencode($refill->link) }}" target="_blank"
                                                            title="{{ $refill->link }}">
                                                            {{ Str::limit($refill->link, 50) }}
                                                        </a>
                                                    </td>
                                                    <td data-label="{{ __('refill.service') }}" class="table-service">
                                                        @php
                                                            $serviceName = $refill->service->name ?? 'N/A';
                                                            $userLang = auth()->user()->lang ?? 'en';

                                                            // Service name is cast to json in model, so it's already an array
                                                            if (is_array($serviceName)) {
                                                                $serviceName = $serviceName[$userLang] ?? ($serviceName['en'] ?? reset($serviceName) ?? 'N/A');
                                                            }
                                                            $serviceName = (string) $serviceName;
                                                        @endphp
                                                        {{ $refill->service_id }} — {{ $serviceName }}
                                                    </td>
                                                    <td data-label="{{ __('refill.status') }}">
                                                        {{ ucfirst($refill->refill_status ?? 'pending') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center py-4">
                                                        <p class="text-muted">{{ __('refill.no_refills_found') }}</p>
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
                                {{ $refills->links('pagination::bootstrap-4') }}
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
