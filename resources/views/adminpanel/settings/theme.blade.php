@extends('adminpanel.layouts.app')
@section('title', 'Settings')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">

        @include('adminpanel.settings.partials.header')

        <div class="d-flex flex-wrap flex-stack my-6">
            <h3 class="fw-bold my-2" data-lang="Landing theme">Giao diện trang chủ</h3>
            <div class="d-flex flex-wrap my-2">
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox"
                        onchange="enableLandingPage(this.checked);" checked="">
                    <span class="form-check-label" data-lang="Show">Hiển thị</span>
                </label>
            </div>
        </div>
        <div class="row g-6">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex div-set-landing-as d-none">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" name="landingpage" value="-1"
                                    onchange="setLandingAsServicePage(this.value);" checked="">
                                <span class="form-check-label">Redirect to services page</span>
                            </label>
                            <label class="form-check form-switch form-check-custom form-check-solid ms-10">
                                <input class="form-check-input" type="radio" name="landingpage" value="-2"
                                    onchange="setLandingAsServicePage(this.value);">
                                <span class="form-check-label">Redirect to products page</span>
                            </label>
                        </div>
                        <div class="row g-6 div-list-landing-page ">
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/theme-1.png?v=5"
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('1', 'landing')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifyLanding('1')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">1</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/theme-2.png?v=5"
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('2', 'landing')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifyLanding('2')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">2</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/theme-3.png?v=5"
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('3', 'landing')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifyLanding('3')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">3</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/theme-4.png?v=5"
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('4', 'landing')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifyLanding('4')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">4</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/theme-5.png?v=5"
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('5', 'landing')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifyLanding('5')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">5</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/theme-6.png?v=5"
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('6', 'landing')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifyLanding('6')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">6</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden theme-active">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/theme-7.png?v=5"
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow d-none"
                                                onclick="updateDesign('7', 'landing')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 "
                                                onclick="showModalModifyLanding('7')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary ">7</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/theme-8.png?v=5"
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('8', 'landing')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifyLanding('8')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">8</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/theme-9.png?v=5"
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('9', 'landing')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifyLanding('9')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">9</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/theme-10.png?v=5"
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('10', 'landing')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifyLanding('10')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">10</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/theme-11.png?v=5"
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('11', 'landing')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifyLanding('11')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">11</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/theme-12.png?v=5"
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('12', 'landing')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifyLanding('12')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">12</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/theme-13.png?v=5"
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('13', 'landing')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifyLanding('13')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">13</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/theme-Default.png?v=5"
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('Default', 'landing')" data-lang="button::Apply">Áp
                                                dụng</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge  badge-primary badge-outline">Default</h4>
                            </div>
                        </div>
                        <div class="modal bg-dark fade" tabindex="-1" id="modal-modify-landing-page">
                            <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content shadow-none">
                                    <div class="modal-body p-0 text-center">
                                        <iframe id="ifr-theme"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                                            data-lang="button::Cancel">Hủy</button>
                                        <button type="button" class="btn btn-info btn-default"
                                            data-lang="button::Default">Mặc định</button>
                                        <button type="button" class="btn btn-primary btn-save"
                                            data-lang="button::Save">Lưu thay đổi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack my-6">
            <h3 class="fw-bold my-2" data-lang="Sign-in theme">Giao diện đăng nhập</h3>
        </div>
        <div class="row g-6">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row g-6 div-list-login-page">
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden theme-active">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/home-1.png?v=1" alt=""
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow d-none"
                                                onclick="updateDesign('1', 'home')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 "
                                                onclick="showModalModifySignIn('1')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary ">1</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/home-2.png?v=1" alt=""
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('2', 'home')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifySignIn('2')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">2</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/home-3.png?v=1" alt=""
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('3', 'home')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifySignIn('3')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">3</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden ">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/home-4.png?v=1" alt=""
                                                class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75">
                                            <button type="button" class="btn btn-primary btn-sm btn-shadow "
                                                onclick="updateDesign('4', 'home')" data-lang="button::Apply">Áp
                                                dụng</button><button type="button"
                                                class="btn btn-info btn-sm btn-shadow ms-2 d-none"
                                                onclick="showModalModifySignIn('4')" data-lang="button::Modify">Tủy
                                                chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary badge-outline">4</h4>
                            </div>
                        </div>

                        <div class="modal bg-dark fade" tabindex="-1" id="modal-modify-signin-page">
                            <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content shadow-none">
                                    <div class="modal-body p-0 text-center">
                                        <iframe id="ifr-signintheme"></iframe>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                                            data-lang="button::Cancel">Hủy</button>
                                        <button type="button" class="btn btn-primary btn-save"
                                            data-lang="button::Save">Lưu thay đổi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack my-6">
            <h3 class="fw-bold my-2" data-lang="Client theme">Giao diện người dùng</h3>
        </div>
        <div class="row g-6">
            <div class="col-lg-12">
                <div class="card shadow-sm">

                    <div class="card-body">
                        @php
                            $currentInterface = $config->default_interface ?? '1';
                            if ($currentInterface === 'default') $currentInterface = '1';
                        @endphp
                        <div class="row div-style-theme div-style-theme-1">
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden {{ $currentInterface === '1' ? 'theme-active' : '' }}" data-theme="1">
                                    <div class="card-body p-0 card-preview">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.phototourl.com/free/2026-04-11-a2fbf69b-88ac-465d-a219-c0b91e80f0e1.jpg" alt="" class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75 {{ $currentInterface === '1' ? 'd-none' : '' }}">
                                            <button type="button" class="btn btn-primary btn-sm {{ $currentInterface === '1' ? 'd-none' : '' }}"
                                                onclick="updateDesign('1', 'client')">Apply</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary {{ $currentInterface === '1' ? '' : 'badge-outline' }}">1</h4>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-4 text-center">
                                <div class="card overlay overflow-hidden {{ $currentInterface === '4' ? 'theme-active' : '' }}" data-theme="4">
                                    <div class="card-body p-0 card-preview">
                                        <div class="overlay-wrapper">
                                            <img src="https://cdn.whoispanel.com/imgs/client-14.png?v=1" alt="" class="w-100 rounded">
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-75 {{ $currentInterface === '4' ? 'd-none' : '' }}">
                                            <button type="button" class="btn btn-primary btn-sm {{ $currentInterface === '4' ? 'd-none' : '' }}"
                                                onclick="updateDesign('4', 'client')">Apply</button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-3 badge badge-circle badge-primary {{ $currentInterface === '4' ? '' : 'badge-outline' }}">4</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    // Khởi tạo theme-active dựa trên config
    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo landing page theme
        const landingTheme = '{{ $config->default_landingpage ?? "default" }}';
        initializeThemeActive('.div-list-landing-page', landingTheme);
        
        // Khởi tạo login page theme
        const loginTheme = '{{ $config->default_login ?? "1" }}';
        initializeThemeActive('.div-list-login-page', loginTheme);
        
        // Khởi tạo interface theme
        const interfaceTheme = '{{ $config->default_interface ?? "1" }}' === 'default' ? '1' : '{{ $config->default_interface ?? "1" }}';
        initializeThemeActive('.div-style-theme', interfaceTheme);
    });
    
    function initializeThemeActive(containerSelector, themeId) {
        const container = document.querySelector(containerSelector);
        if (!container) return;
        
        const cards = container.querySelectorAll('.card');
        cards.forEach(card => {
            // Ưu tiên data-theme, fallback về badge text
            const badge = card.nextElementSibling;
            const cardTheme = card.dataset.theme || (badge ? badge.textContent.trim() : '');
            const isActive = cardTheme === themeId;

            card.classList.toggle('theme-active', isActive);
            const btn = card.querySelector('.btn-primary');
            const modifyBtn = card.querySelector('.btn-info');
            const overlay = card.querySelector('.overlay-layer');
            if (btn) btn.classList.toggle('d-none', isActive);
            if (modifyBtn) modifyBtn.classList.toggle('d-none', !isActive);
            if (overlay) overlay.classList.toggle('d-none', isActive);
        });
    }

    function updateDesign(themeId, type) {
        showFullScreenLoader();
        
        let selectorClass = '';
        let fieldName = '';
        
        if (type === 'landing') {
            selectorClass = '.div-list-landing-page';
            fieldName = 'default_landingpage';
        } else if (type === 'home') {
            selectorClass = '.div-list-login-page';
            fieldName = 'default_login';
        } else if (type === 'client') {
            selectorClass = '.div-style-theme';
            fieldName = 'default_interface';
        }
        
        // Tìm card có theme-active và xóa class
        const currentActive = document.querySelector(selectorClass + ' .theme-active');
        if (currentActive) {
            currentActive.classList.remove('theme-active');
            const currentBtn = currentActive.querySelector('.btn-primary');
            const currentModifyBtn = currentActive.querySelector('.btn-info');
            if (currentBtn) currentBtn.classList.remove('d-none');
            if (currentModifyBtn) currentModifyBtn.classList.add('d-none');
        }
        
        // Tìm card mới và thêm class theme-active
        const cards = document.querySelectorAll(selectorClass + ' .card');
        cards.forEach(card => {
            const badge = card.nextElementSibling;
            if (badge && badge.textContent.trim() === themeId) {
                card.classList.add('theme-active');
                const btn = card.querySelector('.btn-primary');
                const modifyBtn = card.querySelector('.btn-info');
                if (btn) btn.classList.add('d-none');
                if (modifyBtn) modifyBtn.classList.remove('d-none');
            }
        });
        
        // Gửi update request
        const data = {};
        data[fieldName] = themeId;
        data['_token'] = '{{ csrf_token() }}';
        
        fetch('{{ route('admin.settings.update.theme') }}', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            hideFullScreenLoader();
            showToast(result.message || 'Cập nhật thành công', 'success');
        })
        .catch(error => {
            hideFullScreenLoader();
            console.error('Update error:', error);
            showToast('Có lỗi xảy ra khi cập nhật: ' + (error.message || 'Unknown error'), 'error');
        });
    }

    function updateLandingPage() {
        showFullScreenLoader();

        // Lấy theme được chọn từ element có class "theme-active"
        const activeTheme = document.querySelector('.div-list-landing-page .theme-active');
        let selectedTheme = 'default';

        if (activeTheme) {
            const badge = activeTheme.nextElementSibling;
            if (badge) {
                selectedTheme = badge.textContent.trim();
            }
        }

        const data = {
            default_landingpage: selectedTheme,
            _token: '{{ csrf_token() }}'
        };

        fetch('{{ route('admin.settings.update.theme') }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                hideFullScreenLoader();
                showToast(result.message || 'Cập nhật thành công', 'success');
            })
            .catch(error => {
                hideFullScreenLoader();
                console.error('Update error:', error);
                showToast('Có lỗi xảy ra khi cập nhật: ' + (error.message || 'Unknown error'), 'error');
            });
    }
</script>
