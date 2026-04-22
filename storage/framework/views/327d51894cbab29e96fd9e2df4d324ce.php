<div id="kt_header" class="header">
    <!--begin::Header top-->
    <div class="header-top d-flex align-items-stretch flex-grow-1">
        <!--begin::Container-->
        <div class="d-flex container-xxl align-items-stretch">
            <!--begin::Brand-->
            <div class="d-flex align-items-center align-items-lg-stretch me-5 flex-row-fluid">
                <!--begin::Heaeder navs toggle-->
                <button
                    class="d-lg-none btn btn-icon btn-color-white bg-hover-white bg-hover-opacity-10 w-35px h-35px h-md-40px w-md-40px ms-n3 me-2"
                    id="kt_header_navs_toggle">
                    <i class="ki-duotone ki-abstract-14 fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </button>
                <!--end::Heaeder navs toggle-->
                <!--begin::Logo-->
                <a href="/admin/settings" class="d-flex align-items-center">
                    <i class="fas fa-cube text-primary fs-2"></i>
                </a>
                <!--end::Logo-->
                <!--begin::Tabs wrapper-->
                <div class="align-self-end overflow-auto" id="kt_brand_tabs">
                    <!--begin::Header tabs wrapper-->
                    <div class="header-tabs overflow-auto mx-4 ms-lg-10 mb-5 mb-lg-0" id="kt_header_tabs"
                        data-kt-swapper="true" data-kt-swapper-mode="prepend"
                        data-kt-swapper-parent="{default: '#kt_header_navs_wrapper', lg: '#kt_brand_tabs'}">
                        <!--begin::Header tabs-->
                        <ul class="nav flex-nowrap text-nowrap" role="tablist">
                            <li class="nav-item" role="presentation"><a
                                    class="nav-link <?php echo e(request()->is('admin/orders*', 'admin/product_orders*', 'admin/refill_services*', 'admin/refill_products*', 'admin/cancel_services*') ? 'active' : ''); ?>"
                                    data-bs-toggle="tab" href="#header_orders"
                                    aria-selected="<?php echo e(request()->is('admin/orders*', 'admin/product_orders*', 'admin/refill_services*', 'admin/refill_products*', 'admin/cancel_services*') ? 'true' : 'false'); ?>"
                                    role="tab"
                                    <?php echo e(!request()->is('admin/orders*', 'admin/product_orders*', 'admin/refill_services*', 'admin/refill_products*', 'admin/cancel_services*') ? 'tabindex="-1"' : ''); ?>><span
                                        data-lang="menu::Orders">Đơn hàng</span><span
                                        class="badge badge-circle badge-danger badge-sm ms-2">8</span></a></li>
                            <li class="nav-item" role="presentation"><a
                                    class="nav-link <?php echo e(request()->is('admin/accounts*', 'admin/services*', 'admin/categories*', 'admin/providers*', 'admin/service_sync_logs*', 'admin/products*') ? 'active' : ''); ?>"
                                    data-bs-toggle="tab" href="#header_list"
                                    aria-selected="<?php echo e(request()->is('admin/accounts*', 'admin/services*', 'admin/categories*', 'admin/providers*', 'admin/service_sync_logs*', 'admin/products*') ? 'true' : 'false'); ?>"
                                    role="tab"
                                    <?php echo e(!request()->is('admin/accounts*', 'admin/services*', 'admin/categories*', 'admin/providers*', 'admin/service_sync_logs*', 'admin/products*') ? 'tabindex="-1"' : ''); ?>><span
                                        data-lang="menu::List">Quản lý</span></a></li>
                            <li class="nav-item" role="presentation"><a
                                    class="nav-link <?php echo e(request()->is('admin/payments*', 'admin/coupons*') ? 'active' : ''); ?>"
                                    data-bs-toggle="tab" href="#header_payments" data-lang="menu::Payments"
                                    aria-selected="<?php echo e(request()->is('admin/payments*', 'admin/coupons*') ? 'true' : 'false'); ?>"
                                    role="tab"
                                    <?php echo e(!request()->is('admin/payments*', 'admin/coupons*') ? 'tabindex="-1"' : ''); ?>>Thanh
                                    toán</a></li>
                            <li class="nav-item" role="presentation"><a
                                    class="nav-link <?php echo e(request()->is('admin/messages*', 'admin/tickets*', 'admin/news*', 'admin/ticket_statistics_by_service*', 'admin/ticket-subjects*') ? 'active' : ''); ?>"
                                    data-bs-toggle="tab" href="#header_support"
                                    aria-selected="<?php echo e(request()->is('admin/messages*', 'admin/tickets*', 'admin/news*', 'admin/ticket_statistics_by_service*', 'admin/ticket-subjects*') ? 'true' : 'false'); ?>"
                                    role="tab"
                                    <?php echo e(!request()->is('admin/messages*', 'admin/tickets*', 'admin/news*', 'admin/ticket_statistics_by_service*', 'admin/ticket-subjects*') ? 'tabindex="-1"' : ''); ?>><span
                                        data-lang="menu::Support">Hỗ trợ</span><span
                                        class="badge badge-circle badge-danger badge-sm ms-2">3235</span></a></li>
                            <li class="nav-item" role="presentation"><a
                                    class="nav-link <?php echo e(request()->is('admin/settings*', 'admin/analytics*', 'admin/reports*', 'admin/affiliates*', 'admin/api*', 'admin/backup*') ? 'active' : ''); ?>"
                                    data-bs-toggle="tab" href="#header_others"
                                    aria-selected="<?php echo e(request()->is('admin/settings*', 'admin/analytics*', 'admin/reports*', 'admin/affiliates*', 'admin/api*', 'admin/backup*') ? 'true' : 'false'); ?>"
                                    role="tab"
                                    <?php echo e(!request()->is('admin/settings*', 'admin/analytics*', 'admin/reports*', 'admin/affiliates*', 'admin/api*', 'admin/backup*') ? 'tabindex="-1"' : ''); ?>><span
                                        data-lang="menu::Others">Khác</span></a></li>
                        </ul>
                        <!--begin::Header tabs-->
                    </div>
                    <!--end::Header tabs wrapper-->
                </div>
                <!--end::Tabs wrapper-->
            </div>
            <!--end::Brand-->
            <!--begin::Topbar-->
            <div class="d-flex align-items-center flex-row-auto">
                <div class="d-flex align-items-center ms-1 pointer">
                    <div class="btn btn-icon btn-color-white bg-hover-white bg-hover-opacity-10 w-35px h-35px h-md-40px w-md-40px position-relative"
                        data-bs-custom-class="tooltip-dark" data-bs-toggle="tooltip" data-bs-placement="top"
                        aria-label="Trang web đang hoạt động bình thường"
                        data-bs-original-title="Trang web đang hoạt động bình thường" data-kt-initialized="1">
                        <i class="fa-solid fa-solid fa-shield-heart text-success fs-1" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center ms-1">
                    <!--begin::Menu toggle-->
                    <a href="#"
                        class="btn btn-icon btn-color-white bg-hover-white bg-hover-opacity-10 w-35px h-35px h-md-40px w-md-40px"
                        data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-night-day theme-light-show fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                            <span class="path7"></span>
                            <span class="path8"></span>
                            <span class="path9"></span>
                            <span class="path10"></span>
                        </i>
                        <i class="ki-duotone ki-moon theme-dark-show fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                    <!--begin::Menu toggle-->
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                        data-kt-menu="true" data-kt-element="theme-mode-menu" style="">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2 active" data-kt-element="mode"
                                data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title" data-lang="menu::Light">Sáng</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-moon fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title" data-lang="menu::Dark">Tối</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Theme mode-->
                <!--begin::User-->
                <div class="d-flex align-items-center ms-1" id="kt_header_user_menu_toggle">
                    <!--begin::User info-->
                    <div class="btn btn-flex align-items-center bg-hover-white bg-hover-opacity-10 py-2 ps-2 pe-2 me-n2"
                        data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <!--begin::Name-->
                        <div class="d-none d-md-flex flex-column align-items-end justify-content-center me-2 me-md-4">
                            <span class="text-white opacity-75 fs-8 fw-semibold lh-1 mb-1">smmkay</span>
                            <span class="text-white fs-8 fw-bold lh-1">Admin</span>
                        </div>
                        <!--end::Name-->
                        <!--begin::Symbol-->
                        <div class="symbol symbol-30px symbol-md-40px">
                            <img src="https://cdn.whoispanel.com/admin/media/avatars/300-1.jpg" alt="image">
                        </div>
                        <!--end::Symbol-->
                    </div>
                    <!--end::User info-->
                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo"
                                        src="https://cdn.whoispanel.com/admin/media/avatars/300-1.jpg">
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">smmkay
                                        <span
                                            class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Admin</span>
                                    </div>
                                    <a href="#"
                                        class="fw-semibold text-muted text-hover-primary fs-7">duybuntv@gmail.com</a>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--end::Menu separator-->
                        <div class="menu-item px-5">
                            <a href="javascript:;" class="menu-link px-5">App version: <span
                                    class="fw-bolder ms-2">14.9.0.6
                                </span></a>
                        </div>
                        <div class="separator my-2"></div>
                        <!--begin::Menu item-->
                        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                            <?php
                                $langMap = [
                                    'en' => ['name' => 'English',    'flag' => 'united-states.svg'],
                                    'vi' => ['name' => 'Vietnamese', 'flag' => 'vietnam.svg'],
                                ];
                                $currentLang = Auth::user()->lang ?? session('language', 'vi');
                                $currentLang = array_key_exists($currentLang, $langMap) ? $currentLang : 'vi';
                                $current = $langMap[$currentLang];
                            ?>
                            <a href="#" class="menu-link px-5">
                                <span class="menu-title position-relative">
                                    <span data-lang="Language">Language</span>
                                    <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                                        <?php echo e($current['name']); ?>

                                        <img class="w-15px h-15px rounded-1 ms-2"
                                            src="https://cdn.whoispanel.com/admin/media/flags/<?php echo e($current['flag']); ?>"
                                            alt="<?php echo e($current['name']); ?>">
                                    </span>
                                </span>
                            </a>
                            <!--begin::Menu sub-->
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                <?php $__currentLoopData = $langMap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="javascript:;" onclick="app_admin.on.click.changeLanguage('<?php echo e($code); ?>')"
                                        class="menu-link px-3 py-2 <?php echo e($currentLang === $code ? 'active' : ''); ?>"
                                        data-kt-element="language" data-kt-value="<?php echo e($code); ?>">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <img class="w-20px h-20px rounded-1"
                                                src="https://cdn.whoispanel.com/admin/media/flags/<?php echo e($lang['flag']); ?>"
                                                alt="<?php echo e($lang['name']); ?>">
                                        </span>
                                        <span class="menu-title"><?php echo e($lang['name']); ?></span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <!--end::Menu sub-->
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5 my-1">
                            <a href="/settings" class="menu-link px-5" data-lang="menu::Settings">Cài đặt</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="/signout" class="menu-link px-5" data-lang="menu::Sign Out">Đăng xuất</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->
                </div>
                <!--end::User -->
            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header top-->
    <!--begin::Header navs-->
    <?php echo $__env->make('adminpanel.layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!--end::Header navs-->
</div>
<?php /**PATH C:\xampp\htdocs\resources\views/adminpanel/layouts/header.blade.php ENDPATH**/ ?>