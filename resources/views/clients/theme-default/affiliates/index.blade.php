@extends('clients.theme-default.layouts.app')

@section('title', __('affiliates.title'))

@section('content')
    <div class="wrapper-content">
    <div class="wrapper-content__header">
          </div>
    <div class="wrapper-content__body">
      <!-- Main variables *content* -->
      <div id="block_54"><div class="block-bg"></div><div class="container"><div class="affiliates-info">
    <div class="row affiliates-info__alignment affiliate-block__main-table">
        <div class="col-lg-12">
            <div class="table-bg affiliates-info__data-table component_table_link ">
                <div class="table-wr table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('affiliates.referral_link') }}</th>
                            <th>{{ __('affiliates.commission_rate') }}</th>
                            <th>{{ __('affiliates.minimum_payout') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td data-label="{{ __('affiliates.referral_link') }}" nowrap="">
                                @if($authUser && $authUser->referral_code)
                                    <span id="link" class="mr-1">https://{{ getDomain() }}/ref/{{ $authUser->referral_code }}</span>
                                    <a href="#">
                                        <span data-clip="true" title="Link copied" data-clipboard-action="copy" data-clipboard-target="#link" class="fas fa-clone"></span>
                                    </a>
                                @else
                                    <span class="text-muted">{{ __('affiliates.no_referral_code') }}</span>
                                @endif
                            </td>
                            <td data-label="{{ __('affiliates.commission_rate') }}">{{ $config->affiliate_percent ?? 0 }}%</td>
                            <td data-label="{{ __('affiliates.minimum_payout') }}">${{ $config->affiliate_min ?? 0 }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row affiliates-info__alignment">
        <div class="col-lg-12">
            <div class="table-bg component_table_statistics ">
                <div class="table-wr table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('affiliates.visits') }}</th>
                            <th>{{ __('affiliates.registrations') }}</th>
                            <th>{{ __('affiliates.total_referrals') }}</th>
                            <th>{{ __('affiliates.conversion_rate') }}</th>
                            <th>{{ __('affiliates.total_earnings') }}</th>
                            <th>{{ __('affiliates.available_earnings') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="affiliates-table-border-none">
                            <td data-label="{{ __('affiliates.visits') }}">0</td>
                            <td data-label="{{ __('affiliates.registrations') }}">0</td>
                            <td data-label="{{ __('affiliates.total_referrals') }}">0</td>
                            <td data-label="{{ __('affiliates.conversion_rate') }}">0.00%</td>
                            <td data-label="{{ __('affiliates.total_earnings') }}">$0.00</td>
                            <td data-label="{{ __('affiliates.available_earnings') }}">$0.00</td>
                        </tr>
                                                </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div></div></div><div id="block_60"><div class="block-bg"></div><div class="container"><div class="affiliates-list">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-bg affiliate-block__table-payments component_table ">
                <div class="table-wr table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('affiliates.payout_date') }}</th>
                            <th>{{ __('affiliates.payout_amount') }}</th>
                            <th>{{ __('affiliates.payout_status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                                                    <tr>
                                <td colspan="3">
                                    &nbsp;
                                </td>
                            </tr>
                                                </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <nav class="component_pagination">
                <div class="">
                                    </div>
            </nav>
        </div>
    </div>
</div></div></div>
    </div>
    <div class="wrapper-content__footer">
           </div>
  </div>
@endsection
