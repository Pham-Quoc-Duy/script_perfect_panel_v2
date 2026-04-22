@php
$lang = $langData ?? [];
$cards = [
    ['icon' => 'far fa-user',           'value' => Auth::user()->username,                          'label' => $lang['components.welcome_to_panel'] ?? __('components.welcome_to_panel')],
    ['icon' => 'fal fa-wallet',         'value' => $formattedSpent,                                 'label' => $lang['components.spent_balance']    ?? __('components.spent_balance')],
    ['icon' => 'fal fa-clipboard-list', 'value' => number_format(Auth::user()->orders()->count()),  'label' => $lang['components.total_orders']     ?? __('components.total_orders')],
    ['icon' => 'fal fa-credit-card',    'value' => $formattedBalance,                               'label' => $lang['components.account_balance']  ?? __('components.account_balance')]
];
@endphp

<div id="block_99">
    <div class="block-bg"></div>
    <div class="container-fluid">
        <div class="totals">
            <div class="row align-items-start justify-content-start">
                @foreach($cards as $card)
                <div class="col-lg-3 col-md-6 col-sm-12 mb-2 mt-2">
                    <div class="card h-100" style="padding: 24px 0; border: none;">
                        <div class="totals-block__card">
                            <div class="totals-block__card-left">
                                <div class="totals-block__icon-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary">
                                    <span class="totals-block__icon style-text-primary {{ $card['icon'] }}" style="font-size: 38px;"></span>
                                </div>
                            </div>
                            <div class="totals-block__card-right">
                                <div class="totals-block__count">
                                    <h2 class="totals-block__count-value style-text-primary">{{ $card['value'] }}</h2>
                                </div>
                                <div class="totals-block__card-name">
                                    <p>{{ $card['label'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
