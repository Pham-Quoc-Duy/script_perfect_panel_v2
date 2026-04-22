<div class="header-navs d-flex align-items-stretch flex-stack h-lg-70px w-100 py-5 py-lg-0 overflow-hidden overflow-lg-visible"
    id="kt_header_navs" data-kt-drawer="true" data-kt-drawer-name="header-menu"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_header_navs_toggle" data-kt-swapper="true" data-kt-swapper-mode="append"
    data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header'}" data-navbar-initialized="false">
    <!--begin::Container-->
    <div class="d-lg-flex container-xxl w-100">
        <!--begin::Wrapper-->
        <div class="d-lg-flex flex-column justify-content-lg-center w-100" id="kt_header_navs_wrapper">
            <!--begin::Header tab content-->
            <div class="tab-content" data-kt-scroll="true" data-kt-scroll-activate="{default: true, lg: false}"
                data-kt-scroll-height="auto" data-kt-scroll-offset="70px">
                <!--begin::Tab panel-->
                <div class="tab-pane fade <?php echo e(request()->is('admin/orders*', 'admin/product_orders*', 'admin/refill_services*', 'admin/refill_products*', 'admin/cancel_services*') ? 'active show' : ''); ?>"
                    id="header_orders" role="tabpanel">
                    <!--begin::Menu wrapper-->
                    <div class="header-menu flex-column align-items-stretch flex-lg-row">
                        <!--begin::Menu-->
                        <div class="menu menu-rounded menu-column menu-lg-row menu-root-here-bg-desktop menu-active-bg menu-title-gray-700 menu-state-primary menu-arrow-gray-500 fw-semibold align-items-stretch flex-grow-1 px-2 px-lg-0"
                            id="#kt_header_menu" data-kt-menu="true">
                            <!--begin:Menu item-->
                            <div class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/orders*') ? 'here' : ''); ?>"><a
                                    class="menu-link py-3" href="/admin/orders"><span class="menu-title"
                                        data-lang="menu::Services">Dịch
                                        vụ</span>
                                        <?php $failedOrdersCount = \App\Models\Order::where('status', 'failed')->count(); ?>
                                        <?php if($failedOrdersCount > 0): ?>
                                        <span class="badge badge-circle badge-danger badge-sm ms-2"><?php echo e($failedOrdersCount); ?></span>
                                        <?php endif; ?>
                                    </a></div>
                            <div
                                class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/product_orders*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/product_orders"><span class="menu-title"
                                        data-lang="menu::Products">Sản phẩm</span></a>
                            </div>
                            <div
                                class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/refill_services*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/refill_services"><span class="menu-title"
                                        data-lang="menu::Refill services">Bảo hành dịch vụ</span></a>
                            </div>
                            <div
                                class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/refill_products*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/refill_products"><span class="menu-title"
                                        data-lang="menu::Refill products">Bảo hành sản phẩm</span></a>
                            </div>
                            <div
                                class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/cancel_services*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/cancel_services"><span class="menu-title"
                                        data-lang="menu::Cancel services">Hủy dịch vụ</span> <span
                                        class="badge badge-circle badge-danger badge-sm ms-2">1</span></a>
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Tab panel-->
                <!--begin::Tab panel-->
                <div class="tab-pane fade <?php echo e(request()->is('admin/accounts*', 'admin/services*', 'admin/categories*', 'admin/providers*', 'admin/service_sync_logs*', 'admin/products*') ? 'active show' : ''); ?>"
                    id="header_list" role="tabpanel">
                    <!--begin::Menu wrapper-->
                    <div class="header-menu flex-column align-items-stretch flex-lg-row">
                        <!--begin::Menu-->
                        <div class="menu menu-rounded menu-column menu-lg-row menu-root-here-bg-desktop menu-active-bg menu-title-gray-700 menu-state-primary menu-arrow-gray-500 fw-semibold align-items-stretch flex-grow-1 px-2 px-lg-0"
                            id="#kt_header_menu" data-kt-menu="true">
                            <!--begin:Menu item-->
                            <div class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/accounts*') ? 'here' : ''); ?>"><a
                                    class="menu-link py-3" href="/admin/accounts"><span class="menu-title"
                                        data-lang="menu::Accounts">Tài khoản</span></a></div>
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                data-kt-menu-placement="bottom-start"
                                class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2 <?php echo e(request()->is('admin/services*', 'admin/categories*') ? 'here' : ''); ?>">
                                <!--begin:Menu link-->
                                <span class="menu-link py-3">
                                    <span class="menu-title" data-lang="menu::Services">Dịch vụ</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div
                                    class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                                    <!--begin:Menu item-->
                                    <div class="menu-item <?php echo e(request()->is('admin/services*') ? 'here' : ''); ?>">
                                        <a class="menu-link py-3" href="/admin/services"><span class="menu-title"
                                                data-lang="menu::Services">Dịch vụ</span></a>
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item <?php echo e(request()->is('admin/categories*') ? 'here' : ''); ?>">
                                        <a class="menu-link py-3" href="/admin/categories"><span class="menu-title"
                                                data-lang="menu::Categories">Danh mục dịch
                                                vụ</span></a>
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                data-kt-menu-placement="bottom-start"
                                class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2 <?php echo e(request()->is('admin/products*') ? 'here' : ''); ?>">
                                <!--begin:Menu link-->
                                <span class="menu-link py-3">
                                    <span class="menu-title" data-lang="menu::Products">Sản phẩm</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div
                                    class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                                    <!--begin:Menu item-->
                                    <div
                                        class="menu-item <?php echo e(request()->is('admin/products', 'admin/products/') ? 'here' : ''); ?>">
                                        <a class="menu-link py-3" href="/admin/products"><span class="menu-title"
                                                data-lang="menu::Products">Sản phẩm</span></a>
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div
                                        class="menu-item <?php echo e(request()->is('admin/products/warehouse*') ? 'here' : ''); ?>">
                                        <a class="menu-link py-3" href="/admin/products/warehouse"><span
                                                class="menu-title" data-lang="menu::Warehouse">Kho sản
                                                phẩm</span></a>
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <div class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/providers*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/providers"><span class="menu-title"
                                        data-lang="menu::Providers">Nhà cung cấp</span></a>
                            </div>
                            <div
                                class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/service_sync_logs*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/service_sync_logs"><span class="menu-title"
                                        data-lang="menu::Sync Logs">Thông tin đồng bộ dịch vụ</span></a>
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Tab panel-->
                <!--begin::Tab panel-->
                <div class="tab-pane fade <?php echo e(request()->is('admin/payments*', 'admin/coupons*') ? 'active show' : ''); ?>"
                    id="header_payments" role="tabpanel">
                    <!--begin::Menu wrapper-->
                    <div class="header-menu flex-column align-items-stretch flex-lg-row">
                        <!--begin::Menu-->
                        <div class="menu menu-rounded menu-column menu-lg-row menu-root-here-bg-desktop menu-active-bg menu-title-gray-700 menu-state-primary menu-arrow-gray-500 fw-semibold align-items-stretch flex-grow-1 px-2 px-lg-0"
                            id="#kt_header_menu" data-kt-menu="true">
                            <!--begin:Menu item-->
                            <div
                                class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/payments/methods*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/payments/methods"><span class="menu-title"
                                        data-lang="menu::Payment methods">Phương thức</span></a>
                            </div>
                            <div
                                class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/payments/history*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/payments/history"><span class="menu-title"
                                        data-lang="menu::Payment history">Giao dịch</span></a>
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Tab panel-->
                <!--begin::Tab panel-->
                <div class="tab-pane fade <?php echo e(request()->is('admin/coupons*') ? 'active show' : ''); ?>"
                    id="header_coupons">
                    <!--begin::Menu wrapper-->
                    <div class="header-menu flex-column align-items-stretch flex-lg-row">
                        <!--begin::Menu-->
                        <div class="menu menu-rounded menu-column menu-lg-row menu-root-here-bg-desktop menu-active-bg menu-title-gray-700 menu-state-primary menu-arrow-gray-500 fw-semibold align-items-stretch flex-grow-1 px-2 px-lg-0"
                            id="#kt_header_menu" data-kt-menu="true">
                            <!--begin:Menu item-->
                            <div
                                class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/coupons', 'admin/coupons/') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/coupons"><span class="menu-title"
                                        data-lang="menu::Coupon List">Danh sách</span></a>
                            </div>
                            <div
                                class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/coupons/usage*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/coupons/usage"><span class="menu-title"
                                        data-lang="menu::Coupon usage">Lịch sử</span></a>
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Tab panel-->
                <!--begin::Tab panel-->
                <div class="tab-pane fade <?php echo e(request()->is('admin/messages*', 'admin/tickets*', 'admin/news*', 'admin/ticket_statistics_by_service*', 'admin/ticket-subjects*') ? 'active show' : ''); ?>"
                    id="header_support" role="tabpanel">
                    <!--begin::Menu wrapper-->
                    <div class="header-menu flex-column align-items-stretch flex-lg-row">
                        <!--begin::Menu-->
                        <div class="menu menu-rounded menu-column menu-lg-row menu-root-here-bg-desktop menu-active-bg menu-title-gray-700 menu-state-primary menu-arrow-gray-500 fw-semibold align-items-stretch flex-grow-1 px-2 px-lg-0"
                            id="#kt_header_menu" data-kt-menu="true">
                            <!--begin:Menu item-->
                            <div class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/messages*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/messages"><span class="menu-title"
                                        data-lang="menu::Messages">Tin nhắn</span></a>
                            </div>
                            <div class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/ticket-subjects*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/ticket-subjects"><span class="menu-title" data-lang="menu::Ticket Subjects">Chủ đề hỗ trợ</span></a>
                            </div>
                            <div class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/tickets*') ? 'here' : ''); ?>"><a
                                    class="menu-link py-3" href="/admin/tickets"><span class="menu-title"
                                        data-lang="menu::Tickets">Phiếu hỗ trợ</span> <span
                                        class="badge badge-circle badge-danger badge-sm ms-2">3235</span></a></div>
                            <div class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/news*') ? 'here' : ''); ?>"><a
                                    class="menu-link py-3" href="/admin/news"><span class="menu-title"
                                        data-lang="menu::News">Thông
                                        báo</span></a></div>
                            <div
                                class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/ticket_statistics_by_service*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/ticket_statistics_by_service"><span
                                        class="menu-title" data-lang="menu::Ticket Statistics by Service">Thống kê
                                        phiếu hỗ trợ theo
                                        dịch vụ</span></a>
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Tab panel-->
                <!--begin::Tab panel-->
                <div class="tab-pane fade <?php echo e(request()->is('admin/settings*', 'admin/analytics*', 'admin/reports*', 'admin/affiliates*', 'admin/api*', 'admin/backup*') ? 'active show' : ''); ?>"
                    id="header_others" role="tabpanel">
                    <!--begin::Menu wrapper-->
                    <div class="header-menu flex-column align-items-stretch flex-lg-row">
                        <!--begin::Menu-->
                        <div class="menu menu-rounded menu-column menu-lg-row menu-root-here-bg-desktop menu-active-bg menu-title-gray-700 menu-state-primary menu-arrow-gray-500 fw-semibold align-items-stretch flex-grow-1 px-2 px-lg-0"
                            id="#kt_header_menu" data-kt-menu="true">
                            <!--begin:Menu item-->
                            <div class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/settings*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/settings/general"><span class="menu-title"
                                        data-lang="menu::Settings">Cài đặt</span></a>
                            </div>
                            <div class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/analytics*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/analytics"><span class="menu-title"
                                        data-lang="menu::Analytics">Phân tích</span></a>
                            </div>
                            <div class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/reports*') ? 'here' : ''); ?>"><a
                                    class="menu-link py-3" href="/admin/reports"><span class="menu-title"
                                        data-lang="menu::Reports">Thống kê</span></a></div>
                            <div
                                class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/affiliates*') ? 'here' : ''); ?>">
                                <a class="menu-link py-3" href="/admin/affiliates"><span class="menu-title"
                                        data-lang="menu::Affiliates">Tiếp thị liên kết</span></a>
                            </div>
                            <div class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/api*') ? 'here' : ''); ?>"><a
                                    class="menu-link py-3" href="/admin/api"><span class="menu-title">API</span></a>
                            </div>
                            <div class="menu-item me-0 me-lg-2 <?php echo e(request()->is('admin/backup*') ? 'here' : ''); ?>"><a
                                    class="menu-link py-3" href="/admin/backup"><span class="menu-title"
                                        data-lang="menu::Backup">Sao
                                        lưu</span></a></div>
                            <!--end:Menu item-->
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Tab panel-->
            </div>
            <!--end::Header tab content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
</div>
<?php /**PATH C:\xampp\htdocs\resources\views/adminpanel/layouts/navbar.blade.php ENDPATH**/ ?>