<div class="card mb-6">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap">
            <!--begin: Pic-->
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-fixed position-relative">
                    @if (!empty($config->logo_square))
                        <img src="{{ asset($config->logo_square) }}" alt="logo">
                    @else
                        <div class="symbol-label fs-1 fw-bold bg-light-primary text-primary d-flex align-items-center justify-content-center w-100 h-100 rounded">
                            {{ strtoupper(substr($config->title ?? 'SMM PANEL', 0, 10)) }}
                        </div>
                    @endif
                </div>
            </div>
            <!--end::Pic-->
            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <!--begin::User-->
                    <div class="d-flex flex-column">
                        <!--begin::Name-->
                        <div class="d-flex align-items-center mb-2">
                            <a href="javascript:;"
                                class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $config->domain_main ?? 'Domain' }}: {{ $config->title ?? 'Title' }}</a>
                        </div>
                        <!--end::Name-->
                        <!--begin::Info-->
                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                            <span class="text-gray-500">{{ $config->description ?? '' }}</span>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Title-->
                <!--begin::Stats-->
                <div class="d-flex flex-wrap flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                        <span><i class="fa-solid fa-language"></i> 
                            @if($languages && $config->default_lang)
                                {{ $languages->firstWhere('code', $config->default_lang)?->name ?? 'English' }}
                            @else
                                English
                            @endif
                        </span>
                        <span class="ms-10"><i class="fa-solid fa-dollar-sign"></i> 
                            @if($currencies && $config->default_currency)
                                {{ $currencies->firstWhere('code', $config->default_currency)?->code ?? 'USD' }} - {{ $currencies->firstWhere('code', $config->default_currency)?->name ?? 'United States Dollar' }}
                            @else
                                USD - United States Dollar
                            @endif
                        </span>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Info-->
        </div>
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold" id="settingsTabs">
            <li class="nav-item">
                <a class="nav-link ms-0 me-6" href="/admin/settings/general" data-tab="general" data-lang="General">Tổng quan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6" href="/admin/settings/theme" data-tab="theme">Theme</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6" href="/admin/settings/design" data-tab="design" data-lang="Design">Giao diện</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6" href="/admin/settings/price" data-tab="price" data-lang="Price">Giá bán</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6" href="/admin/settings/service" data-tab="service" data-lang="Service">Dịch vụ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6" href="/admin/settings/product" data-tab="product" data-lang="Product">Sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6" href="/admin/settings/language" data-tab="language" data-lang="Language">Ngôn ngữ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6" href="/admin/settings/currency" data-tab="currency" data-lang="Currency">Tiền tệ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6" href="/admin/settings/support" data-tab="support" data-lang="Support">Hỗ trợ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6" href="/admin/settings/security" data-tab="security" data-lang="Security">Bảo mật</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6" href="/admin/settings/smtp" data-tab="smtp">SMTP</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-0 me-6" href="/admin/settings/modules" data-tab="modules" data-lang="Modules">Tiện ích</a>
            </li>
        </ul>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const currentPath = window.location.pathname;
                const tabs = document.querySelectorAll('#settingsTabs .nav-link');
                
                tabs.forEach(tab => {
                    const href = tab.getAttribute('href');
                    if (currentPath === href || currentPath.includes(href)) {
                        tab.classList.add('active');
                    } else {
                        tab.classList.remove('active');
                    }
                });
            });
        </script>
    </div>
</div>
