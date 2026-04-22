@extends('clients.theme-default.layouts.app')

@section('title', __('refunds.title'))

@section('content')

    <div class="wrapper-content__body">
        <!-- Main variables *content* -->
        <div id="block_72">
            <div class="block-bg"></div>
            <div class="container-fluid">
                <div class="orders-refunds">
                    <div class="row">
                        <div class="col">
                            <div class="component_alert mb-3">
                                <div class="alert alert-info alert-dismissible fade show mb-3" role="alert">
                                    {{ __('refunds.refund_details_90_days') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="margin-tab">
                                <div class="component_tabs">
                                    <div class="">
                                        <ul class="nav nav-pills tab">
                                            <li class="nav-item">
                                                <a class="nav-link {{ !request('order_status') || request('order_status') === 'all' ? 'active' : '' }}"
                                                    href="{{ route('clients.orders.refunds') }}">{{ __('refunds.all') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('order_status') === 'canceled' ? 'active' : '' }}"
                                                    href="{{ route('clients.orders.refunds', ['order_status' => 'canceled']) }}">{{ __('refunds.canceled') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('order_status') === 'partial' ? 'active' : '' }}"
                                                    href="{{ route('clients.orders.refunds', ['order_status' => 'partial']) }}">{{ __('refunds.partial') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="margin-search component_card">
                                <div class="card">
                                    <div class="component_form_group component_button_search">
                                        <div class="">
                                            <form action="{{ route('clients.orders.refunds') }}" method="get"
                                                id="history-search">
                                                <div class="input-group">
                                                    <input type="text" name="search" class="form-control"
                                                        value="{{ request('search') }}" placeholder="{{ __('newOrder.search') }}">
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
                            <div class="margin-table">
                                <div class="table-bg component_table">
                                    <div class="table-wr table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('refunds.order_id') }}</th>
                                                    <th>{{ __('refunds.refunded_amount') }}</th>
                                                    <th>{{ __('refunds.order_status') }}</th>
                                                    <th>{{ __('refunds.date') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($refunds as $refund)
                                                    <tr>
                                                        <td data-label="{{ __('refunds.order_id') }}">
                                                            <a
                                                                href="{{ route('clients.orders.index', ['search' => $refund->id]) }}">{{ $refund->id }}</a>
                                                        </td>
                                                        <td data-label="{{ __('refunds.refunded_amount') }}" nowrap="">
                                                            +{{ rtrim((string) $refund->charge, '0') ?: '0' }}
                                                        </td>
                                                        <td data-label="{{ __('refunds.order_status') }}">
                                                            {{ ucfirst($refund->status) }}
                                                        </td>
                                                        <td data-label="{{ __('refunds.date') }}">
                                                            {{ $refund->created_at->format('Y-m-d H:i:s') }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center py-4">
                                                            <p class="text-muted">{{ __('refunds.no_refunds_found') }}</p>
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
                                    {{ $refunds->links('pagination::bootstrap-4') }}
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
