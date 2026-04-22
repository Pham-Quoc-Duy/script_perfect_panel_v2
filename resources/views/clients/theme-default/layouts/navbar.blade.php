<div class="wrapper  wrapper-sidebar-navbar ">
    <div id="block_52" class="component_private_navbar">
        <span class="component_private_navbar ">
            <div class="component-navbar-private__wrapper component_private_sidebar ">
                <div
                    class="sidebar-block__top component-navbar component-navbar__navbar-private editor__component-wrapper ">
                    <div>
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="navbar-private__header">
                                <div class="sidebar-block__top-brand">
                                    <div class="component-navbar-logo">
                                        <a href="{{ route('clients.new') }}"
                                            style="background-image: url({{ $config?->logo ?? '' }})">
                                            @if ($config?->logo)
                                                <img src="{{ $config->logo }}" alt="{{ $config->title ?? 'Logo' }}"
                                                    class="sidebar-block__top-logo"
                                                    title="{{ $config->title ?? 'Logo' }}">
                                            @else
                                                <span class="navbar-logo-text">{{ $config->title ?? 'Panel' }}</span>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbar-collapse-52" aria-controls="navbar-collapse-52"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-burger">
                                        <span class="navbar-burger-line"></span>
                                    </span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse" id="navbar-collapse-52">
                                <div class="component-navbar-collapse-divider"></div>
                                <div class="d-flex component-navbar-collapse">
                                    <ul class="navbar-nav navbar-nav-sidebar-menu">
                                        <li
                                            class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-private {{ request()->routeIs('clients.new') ? 'component-navbar-nav-link-active__navbar-private' : '' }}"
                                                href="{{ route('clients.new') }}">
                                                {{ __('navbar.new_order') }}
                                            </a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-private {{ request()->routeIs('clients.services.*') ? 'component-navbar-nav-link-active__navbar-private' : '' }}"
                                                href="{{ route('clients.services.index') }}">
                                                {{ __('navbar.services') }}
                                            </a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-private {{ request()->routeIs('clients.orders.index', 'clients.orders.show') ? 'component-navbar-nav-link-active__navbar-private' : '' }}"
                                                href="{{ route('clients.orders.index') }}">
                                                {{ __('navbar.orders') }}
                                            </a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-private {{ request()->routeIs('clients.refill.*') ? 'component-navbar-nav-link-active__navbar-private' : '' }}"
                                                href="{{ route('clients.refill.refill') }}">
                                                {{ __('navbar.refill') }}
                                            </a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-private {{ request()->routeIs('clients.addfunds.*') ? 'component-navbar-nav-link-active__navbar-private' : '' }}"
                                                href="{{ route('clients.addfunds.index') }}">
                                                {{ __('navbar.add_funds') }}
                                            </a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-private {{ request()->routeIs('clients.orders.refunds') ? 'component-navbar-nav-link-active__navbar-private' : '' }}"
                                                href="{{ route('clients.orders.refunds') }}">
                                                {{ __('navbar.refunds') }}
                                            </a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-private {{ request()->routeIs('clients.api.*') ? 'component-navbar-nav-link-active__navbar-private' : '' }}"
                                                href="{{ route('clients.api.index') }}">
                                                {{ __('navbar.api') }}
                                            </a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-private {{ request()->routeIs('clients.affiliates.*') ? 'component-navbar-nav-link-active__navbar-private' : '' }}"
                                                href="{{ route('clients.affiliates.index') }}">
                                                {{ __('navbar.affiliates') }}
                                            </a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-private {{ request()->routeIs('clients.childpanel.*') ? 'component-navbar-nav-link-active__navbar-private' : '' }}"
                                                href="{{ route('clients.childpanel.index') }}">
                                                {{ __('navbar.child_panel') }}
                                            </a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-private {{ request()->routeIs('clients.tickets.*') ? 'component-navbar-nav-link-active__navbar-private' : '' }}"
                                                href="{{ route('clients.tickets.index') }}">
                                                {{ __('navbar.tickets') }}
                                                {{-- @if (Auth::user()->tickets()->withCount([
            'replies as unread_count' => function ($query) {
                $query->whereNull('read_at')->where('is_admin', true);
            },
        ])->get()->sum('unread_count') > 0)
                          <span class="badge badge-warning">{{ Auth::user()->tickets()->withCount(['replies as unread_count' => function ($query) { $query->whereNull('read_at')->where('is_admin', true); }])->get()->sum('unread_count') }}</span>
                          @endif --}}
                                            </a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-private {{ request()->routeIs('clients.massorder.*') ? 'component-navbar-nav-link-active__navbar-private' : '' }}"
                                                href="{{ route('clients.massorder.index') }}">
                                                {{ __('navbar.mass_order') }}
                                            </a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-private {{ request()->routeIs('clients.cooperate.*') ? 'component-navbar-nav-link-active__navbar-private' : '' }}"
                                                href="{{ route('clients.cooperate.index') }}">
                                                <span class="component-navbar-nav-link-icon">
                                                    <span class="fas fa-badge-dollar"></span>
                                                </span>
                                                {{ __('navbar.cooperate') }}
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="navbar-nav navbar-nav-currencies">
                                        <div class="balance-dropdown-container component_balance_dropdown">
                                            <div class="balance-dropdown">
                                                <div class="balance-dropdown__name balance-dropdown__toggle"
                                                    data-toggle="dropdown" data-hover="dropdown" aria-expanded="false"
                                                    id="balance-display">
                                                    {{ $formattedBalance }}
                                                </div>
                                                <ul class="balance-dropdown__container dropdown-menu"
                                                    id="currencies-list">
                                                    @foreach ($currencies as $currency)
                                                        <li class="balance-dropdown__item">
                                                            <a href="#"
                                                                class="balance-dropdown__link currencies-item {{ $userCurrency->code == $currency->code ? 'active' : '' }}"
                                                                data-currency-code="{{ $currency->code }}"
                                                                data-currency-symbol="{{ $currency->symbol }}"
                                                                data-currency-name="{{ $currency->name }}"
                                                                data-symbol-position="{{ $currency->symbol_position }}"
                                                                data-exchange-rate="{{ $currency->exchange_rate }}">
                                                                {{ $currency->code }} {{ $currency->symbol }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </ul>
                                    <ul class="navbar-nav">
                                        <li
                                            class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                            <a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private"
                                                href="/account">{{ __('navbar.account') }}</a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                            <a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private"
                                                href="{{ route('logout') }}">{{ __('navbar.logout') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </span>
        <span class="component_private_sidebar ">
            <div class="component-sidebar_wrapper">
                <div
                    class="sidebar-block__left component-sidebar component-sidebar-with-navbar component_private_navbar editor__component-wrapper">
                    <div class="component-sidebar__menu">
                        <div class="component-sidebar__menu-logo">
                            <a href="{{ route('clients.new') }}" class="component-navbar-logo"
                                style="background-image: url({{ $config?->logo ?? '' }})">
                                @if ($config?->logo)
                                    <img src="{{ $config->logo }}" alt="{{ $config->title ?? 'Logo' }}"
                                        class="sidebar-logo-img" style="max-width: 100%; height: auto;">
                                @else
                                    <span class="sidebar-logo-text">{{ $config->title ?? 'Panel' }}</span>
                                @endif
                            </a>
                        </div>
                        <ul class="sidebar-block__left-menu editor__component-wrapper">
                            <li
                                class="component-sidebar__menu-item {{ request()->routeIs('clients.new') ? 'component-sidebar__menu-item-active' : '' }}">
                                <a class="component-sidebar__menu-item-link" href="{{ route('clients.new') }}">
                                    {{ __('navbar.new_order') }}
                                </a>
                            </li>
                            <li
                                class="component-sidebar__menu-item {{ request()->routeIs('clients.services.*') ? 'component-sidebar__menu-item-active' : '' }}">
                                <a class="component-sidebar__menu-item-link"
                                    href="{{ route('clients.services.index') }}">
                                    {{ __('navbar.services') }}
                                </a>
                            </li>
                            <li
                                class="component-sidebar__menu-item {{ request()->routeIs('clients.orders.index', 'clients.orders.show') ? 'component-sidebar__menu-item-active' : '' }}">
                                <a class="component-sidebar__menu-item-link"
                                    href="{{ route('clients.orders.index') }}">
                                    {{ __('navbar.orders') }}
                                </a>
                            </li>
                            <li
                                class="component-sidebar__menu-item {{ request()->routeIs('clients.refill.*') ? 'component-sidebar__menu-item-active' : '' }}">
                                <a class="component-sidebar__menu-item-link"
                                    href="{{ route('clients.refill.refill') }}">
                                    {{ __('navbar.refill') }}
                                </a>
                            </li>
                            <li
                                class="component-sidebar__menu-item {{ request()->routeIs('clients.addfunds.*') ? 'component-sidebar__menu-item-active' : '' }}">
                                <a class="component-sidebar__menu-item-link"
                                    href="{{ route('clients.addfunds.index') }}">
                                    {{ __('navbar.add_funds') }}
                                </a>
                            </li>
                            <li
                                class="component-sidebar__menu-item {{ request()->routeIs('clients.orders.refunds') ? 'component-sidebar__menu-item-active' : '' }}">
                                <a class="component-sidebar__menu-item-link"
                                    href="{{ route('clients.orders.refunds') }}">
                                    {{ __('navbar.refunds') }}
                                </a>
                            </li>
                            <li
                                class="component-sidebar__menu-item {{ request()->routeIs('clients.api.*') ? 'component-sidebar__menu-item-active' : '' }}">
                                <a class="component-sidebar__menu-item-link" href="{{ route('clients.api.index') }}">
                                    {{ __('navbar.api') }}
                                </a>
                            </li>
                            <li
                                class="component-sidebar__menu-item {{ request()->routeIs('clients.affiliates.*') ? 'component-sidebar__menu-item-active' : '' }}">
                                <a class="component-sidebar__menu-item-link"
                                    href="{{ route('clients.affiliates.index') }}">
                                    {{ __('navbar.affiliates') }}
                                </a>
                            </li>
                            <li
                                class="component-sidebar__menu-item {{ request()->routeIs('clients.childpanel.*') ? 'component-sidebar__menu-item-active' : '' }}">
                                <a class="component-sidebar__menu-item-link"
                                    href="{{ route('clients.childpanel.index') }}">
                                    {{ __('navbar.child_panel') }}
                                </a>
                            </li>
                            <li
                                class="component-sidebar__menu-item {{ request()->routeIs('clients.tickets.*') ? 'component-sidebar__menu-item-active' : '' }}">
                                <a class="component-sidebar__menu-item-link"
                                    href="{{ route('clients.tickets.index') }}">
                                    {{ __('navbar.tickets') }}
                                    @if (Auth::user()->tickets()->withCount([
                                                'replies as unread_count' => function ($query) {
                                                    $query->whereNull('read_at')->where('is_admin', true);
                                                },
                                            ])->get()->sum('unread_count') > 0)
                                        <span
                                            class="badge badge-warning">{{ Auth::user()->tickets()->withCount(['replies as unread_count' => function ($query) {$query->whereNull('read_at')->where('is_admin', true);}])->get()->sum('unread_count') }}</span>
                                    @endif
                                </a>
                            </li>
                            <li
                                class="component-sidebar__menu-item {{ request()->routeIs('clients.massorder.*') ? 'component-sidebar__menu-item-active' : '' }}">
                                <a class="component-sidebar__menu-item-link"
                                    href="{{ route('clients.massorder.index') }}">
                                    {{ __('navbar.mass_order') }}
                                </a>
                            </li>
                            {{-- <li
                                class="component-sidebar__menu-item {{ request()->routeIs('clients.cooperate.*') ? 'component-sidebar__menu-item-active' : '' }}">
                                <a class="component-sidebar__menu-item-link"
                                    href="{{ route('clients.cooperate.index') }}">
                                    <span class="sidebar-block__menu-item-icon">
                                        <span class="fas fa-badge-dollar"></span>
                                    </span>
                                    {{ __('navbar.cooperate') }}
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </span>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currencyItems = document.querySelectorAll('.currencies-item');
            const balanceDisplay = document.getElementById('balance-display');

            if (!balanceDisplay || !currencyItems.length) return;

            currencyItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (this.classList.contains('active')) return;

                    const currencyCode = this.dataset.currencyCode;
                    const currencySymbol = this.dataset.currencySymbol;
                    const currencyName = this.dataset.currencyName;
                    const symbolPosition = this.dataset.symbolPosition;

                    fetch('{{ route('clients.account.update-currency') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]')?.content ||
                                    '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                currency_code: currencyCode,
                                currency_symbol: currencySymbol,
                                currency_name: currencyName
                            })
                        })
                        .then(response => response.json())
                        .then(response => {
                            if (response.success) {
                                // Update balance display
                                let defaultBalance = '0';
                                if (currencyCode === 'VND' || currencyCode === 'JPY' || currencyCode === 'KRW') {
                                    defaultBalance = '0';
                                } else {
                                    defaultBalance = '0.00';
                                }
                                
                                balanceDisplay.textContent = response.data.formatted_balance ||
                                    (symbolPosition === 'before' ? currencySymbol + defaultBalance :
                                        defaultBalance + ' ' + currencySymbol);

                                // Update active state without visual changes
                                currencyItems.forEach(i => i.classList.remove('active'));
                                this.classList.add('active');

                                // Silent reload after short delay
                                setTimeout(() => window.location.reload(), 500);
                            }
                        })
                        .catch(error => {
                            console.error('Currency update error:', error);
                        });
                });
            });
        });
    </script>
