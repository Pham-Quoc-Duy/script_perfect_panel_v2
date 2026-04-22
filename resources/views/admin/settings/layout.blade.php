@extends('admin.layouts.app')

@section('title', 'Cấu hình hệ thống')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Cấu hình hệ thống',
                    'breadcrumb' => 'Cài đặt',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}" 
                                           href="{{ route('admin.settings.general') }}">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="d-none d-sm-block">Thông tin chung</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('admin.settings.appearance') ? 'active' : '' }}" 
                                           href="{{ route('admin.settings.appearance') }}">
                                            <i class="bx bx-palette me-2"></i>
                                            <span class="d-none d-sm-block">Giao diện</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('admin.settings.social') ? 'active' : '' }}" 
                                           href="{{ route('admin.settings.social') }}">
                                            <i class="bx bx-share-alt me-2"></i>
                                            <span class="d-none d-sm-block">Mạng xã hội</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('admin.settings.pricing') ? 'active' : '' }}" 
                                           href="{{ route('admin.settings.pricing') }}">
                                            <i class="bx bx-dollar me-2"></i>
                                            <span class="d-none d-sm-block">Giá & Hoa hồng</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('admin.settings.notifications') ? 'active' : '' }}" 
                                           href="{{ route('admin.settings.notifications') }}">
                                            <i class="bx bx-bell me-2"></i>
                                            <span class="d-none d-sm-block">Thông báo</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('admin.settings.email') ? 'active' : '' }}" 
                                           href="{{ route('admin.settings.email') }}">
                                            <i class="bx bx-envelope me-2"></i>
                                            <span class="d-none d-sm-block">Email</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('admin.settings.advanced') ? 'active' : '' }}" 
                                           href="{{ route('admin.settings.advanced') }}">
                                            <i class="bx bx-code-alt me-2"></i>
                                            <span class="d-none d-sm-block">Nâng cao</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('admin.settings.keep-orders') ? 'active' : '' }}" 
                                           href="{{ route('admin.settings.keep-orders') }}">
                                            <i class="bx bx-lock me-2"></i>
                                            <span class="d-none d-sm-block">Giữ đơn hàng</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('admin.settings.cloudflare') ? 'active' : '' }}" 
                                           href="{{ route('admin.settings.cloudflare') }}">
                                            <i class="bx bx-cloud me-2"></i>
                                            <span class="d-none d-sm-block">Cloudflare</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab content -->
                                <div class="tab-content p-3">
                                    @yield('tab-content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@stack('scripts')