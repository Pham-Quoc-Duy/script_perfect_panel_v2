<!--begin::Header-->
<div id="kt_header" class="header align-items-stretch">
    <div class="container-xxl d-flex align-items-stretch justify-content-between">
        <!--begin::Brand-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 w-lg-225px me-5">
            <div class="btn btn-icon btn-active-icon-primary ms-n2 me-2 d-flex d-lg-none" id="kt_aside_toggle">
                <i class="ki-duotone ki-abstract-14 fs-1"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <a href="/new">
                <img alt="Logo" src="/assets/media/logo.png" class="d-none d-lg-inline h-30px theme-light-show">
                <img alt="Logo" src="/assets/media/logo.png" class="d-none d-lg-inline h-30px theme-dark-show">
                <img alt="Logo" src="/assets/media/logo_square.png" class="d-lg-none h-30px">
            </a>
        </div>
        <!--end::Brand-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
                    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end"
                    data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true"
                    data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                </div>
            </div>
            <div class="d-flex align-items-stretch flex-shrink-0">
                <div class="d-flex align-items-center ms-lg-5" id="kt_header_user_menu_toggle">
                    <div class="btn btn-flex align-items-center bg-hover-white bg-hover-opacity-10 py-2 ps-2 pe-2 me-n2"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <div class="d-none d-md-flex flex-column align-items-end justify-content-center me-2 me-md-4">
                            @php
                                $level = auth()->user()->level ?? 'retail';
                                $isAdmin = auth()->user()->role === 1;
                                $levelKey = $isAdmin ? 'user.role_admin' : match($level) {
                                    'agent'       => 'user.level_agent',
                                    'distributor' => 'user.level_distributor',
                                    default       => 'user.level_retail',
                                };
                                $levelText = $isAdmin ? 'Admin' : match($level) {
                                    'agent'       => 'Agent',
                                    'distributor' => 'Distributor',
                                    default       => 'Customer',
                                };
                                $badgeClass = $isAdmin ? 'badge-light-danger' : match($level) {
                                    'agent'       => 'badge-light-warning',
                                    'distributor' => 'badge-light-primary',
                                    default       => 'badge-light-success',
                                };
                            @endphp
                            <span class="fs-8 fw-bold lh-1 ls-1 mb-1">{{ auth()->user()->username }}</span>
                            <span class="opacity-75 fs-8 fw-semibold lh-1" data-lang="{{ $levelKey }}">{{ $levelText }}</span>
                        </div>
                        <div class="symbol symbol-30px symbol-md-40px">
                            <img src="https://cdn.whoispanel.com/dashboard/5/media/avatars/300-1.jpg" alt="{{ auth()->user()->username }}">
                        </div>
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    <img alt="{{ auth()->user()->username }}" src="https://cdn.whoispanel.com/dashboard/5/media/avatars/300-1.jpg">
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">
                                        {{ auth()->user()->username }}
                                        <span class="badge {{ $badgeClass }} fw-bold fs-8 px-2 py-1 ms-2" data-lang="{{ $levelKey }}">{{ $levelText }}</span>
                                    </div>
                                    <span class="fw-semibold text-muted fs-7">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <a href="/settings" class="menu-link px-5" data-lang="menu::Settings">Settings</a>
                        </div>
                        <div class="menu-item px-5">
                            <a href="/affiliate" class="menu-link px-5" data-lang="menu::Affiliate">Affiliate</a>
                        </div>
                        <div class="menu-item px-5">
                            <a href="/childpanel" class="menu-link px-5" data-lang="menu::Child Panel">Child Panel</a>
                        </div>
                        <div class="menu-item px-5">
                            <a href="/apidoc" class="menu-link px-5" data-lang="menu::API Documentation">API Documentation</a>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <a href="/signout" class="menu-link px-5" data-lang="menu::Sign out">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Header-->
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-stretch container-xxl">
    @include('clients.theme-4.layouts.aside')
    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
    @yield('content')
