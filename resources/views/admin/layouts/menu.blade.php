<div class="vertical-menu">
    <div data-simplebar="" class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="2" x2="12" y2="22"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        <span>Thống kê</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.users.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <span>Thành viên</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.accounts.index') }}">Danh sách</a></li>
                        <li><a href="{{ route('admin.activity.index') }}">Lịch sử người dùng</a></li>
                    </ul>
                </li>

                <li class="{{ request()->routeIs('admin.events.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="12 1 3 5 3 19 12 23 21 19 21 5 12 1"></polyline><line x1="12" y1="12" x2="12" y2="23"></line><line x1="12" y1="1" x2="12" y2="12"></line><line x1="3" y1="5" x2="12" y2="12"></line><line x1="21" y1="5" x2="12" y2="12"></line></svg>
                        <span>Sự kiện</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.events.index') }}">Danh sách sự kiện</a></li>
                        <li><a href="{{ route('admin.events.history') }}">Lịch sử quay</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><path d="M1 10h22"></path></svg>
                        <span>Ngân hàng</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.payments.method.index') }}">Phương thức thanh toán</a></li>
                        <li><a href="{{ route('admin.payments.index') }}">Tài khoản thanh toán</a></li>
                        <li><a href="{{ route('admin.transactions.index') }}">Lịch sử giao dịch</a></li>
                    </ul>
                </li>

                <li class="{{ request()->routeIs('admin.platform.*') || request()->routeIs('admin.category.*') || request()->routeIs('admin.services.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                        <span>Dịch vụ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.platform.index') }}">Nền tảng</a></li>
                        <li><a href="{{ route('admin.category.index') }}">Danh mục</a></li>
                        <li><a href="{{ route('admin.services.index') }}">Dịch vụ</a></li>
                    </ul>
                </li>

                <li class="{{ request()->routeIs('admin.orders.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.orders.index') }}">Lịch sử</a></li>
                        <li><a href="#">Thống kê đơn</a></li>
                    </ul>
                </li>

                <li class="{{ request()->routeIs('admin.ticket.*') || request()->routeIs('admin.ticket-subjects.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>
                        <span>Hỗ trợ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.ticket.index') }}">Danh sách ticket</a></li>
                        <li><a href="{{ route('admin.ticket-subjects.index') }}">Chủ đề hỗ trợ</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M2 12h20"></path><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                        <span>Website riêng</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.language.*') || request()->routeIs('admin.currency.*') || request()->routeIs('admin.settings.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M12 1v6m0 6v6M4.22 4.22l4.24 4.24m5.08 5.08l4.24 4.24M1 12h6m6 0h6M4.22 19.78l4.24-4.24m5.08-5.08l4.24-4.24"></path></svg>
                        <span>Cấu hình</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.settings.general') }}">Thông tin chung</a></li>
                        <li><a href="{{ route('admin.settings.appearance') }}">Giao diện</a></li>
                        <li><a href="{{ route('admin.settings.social') }}">Mạng xã hội</a></li>
                        <li><a href="{{ route('admin.settings.pricing') }}">Giá & Hoa hồng</a></li>
                        <li><a href="{{ route('admin.settings.notifications') }}">Thông báo</a></li>
                        <li><a href="{{ route('admin.settings.email') }}">Email</a></li>
                        <li><a href="{{ route('admin.settings.advanced') }}">Nâng cao</a></li>
                        <li><a href="{{ route('admin.settings.keep-orders') }}">Giữ đơn hàng</a></li>
                        <li><a href="{{ route('admin.language.index') }}">Ngôn ngữ</a></li>
                        <li><a href="{{ route('admin.currency.index') }}">Tiền tệ</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                        <span>Liên kết tiếp thị</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.provider.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.provider.index') }}">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="16" y1="21" x2="16" y2="5"></line><line x1="8" y1="21" x2="8" y2="5"></line><path d="M12 21V5M4 6h16M4 11h16"></path></svg>
                        <span>Nhà cung cấp</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.cron-jobs.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.cron-jobs.index') }}">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <span>Thao tác công việc</span>
                    </a>
                </li>
            </ul>

            <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                <div class="card-body">
                    <img src="{{ asset('template-admin/images/giftbox.png') }}" alt="upgrade" loading="lazy">
                    <div class="mt-4">
                        <p class="font-size-13">Upgrade your plan from a Free trial, to select 'Business Plan'.</p>
                        <a href="#!" class="btn btn-primary mt-2">Upgrade Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
