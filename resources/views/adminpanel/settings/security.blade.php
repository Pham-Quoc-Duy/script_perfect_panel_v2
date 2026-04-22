@extends('adminpanel.layouts.app')
@section('title', 'Settings')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        
        @include('adminpanel.settings.partials.header')
        
        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2" data-lang="Security">Bảo mật</h3>
            <div class="d-flex flex-wrap my-2">
                <button class="btn btn-primary btn-sm" data-lang="button::Update"
                    onclick="_settings.on.click.updateSecurity(document.querySelector('.cb-enable-website-maintenance').checked, document.querySelector('.cb-enable-signup').checked, document.querySelector('.cb-enable-gcaptcha').checked, document.querySelector('.cb-multiple-login-status').checked, document.querySelector('.ipt-gcaptcha-site-key').value.trim(), document.querySelector('.ipt-secret-site-key').value.trim())">Cập
                    nhật</button>
            </div>
        </div>

        <div class="row g-6">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-5">
                                    <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                        <input class="form-check-input cb-enable-website-maintenance" type="checkbox">
                                        <label class="form-check-label" data-lang="Maintenance mode">Bảo trì website</label>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                        <input class="form-check-input cb-enable-signup" type="checkbox" checked="">
                                        <label class="form-check-label" data-lang="Allow to sign up">Cho phép đăng ký</label>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                        <input class="form-check-input cb-multiple-login-status" type="checkbox"
                                            checked="">
                                        <label class="form-check-label" data-lang="Multiple session login for the same account">Cho phép đăng nhập một tài khoản
                                            trên nhiều thiết bị</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                        <input class="form-check-input cb-enable-gcaptcha" type="checkbox"
                                            onchange="document.querySelector('.row-gcaptcha').style.display = this.checked ? '' : 'none'">
                                        <label class="form-check-label" data-lang="Google reCAPTCHA">Google reCAPTCHA</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5 row-gcaptcha" style="display: none;">
                            <div class="col-lg-6">
                                <div class="mb-5">
                                    <label class="required form-label">Site key</label>
                                    <input type="text" class="form-control form-control-solid ipt-gcaptcha-site-key"
                                        value="" placeholder="6LcWxxxxxxx">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="">
                                    <label class="required form-label">Secret key</label>
                                    <input type="text" class="form-control form-control-solid ipt-secret-site-key"
                                        value="" placeholder="6LcW2xxxxxxx">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack my-6">
            <h3 class="fw-bold my-2" data-lang="IP Address">Chặn IP</h3>
            <div class="d-flex flex-wrap my-2">
                <button class="btn btn-danger btn-sm" data-lang="button::Clear"
                    onclick="_settings.on.click.unlockIP()">Xóa</button>
            </div>
        </div>

        <div class="row g-6">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-hover table-striped align-middle table-row-dashed fs-7 gy-2 table-ip-blocking">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th data-lang="IP Address">Địa chỉ IP</th>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>117.5.152.137</td>
                                        <td class="text-end"><a href="javascript:;"
                                                onclick="_settings.on.click.unlockIP('117.5.152.137')"
                                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Unlock"
                                                data-bs-original-title="Unlock" data-kt-initialized="1"><i
                                                    class="fa-solid fa-xmark fs-4 text-danger"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>113.172.152.239</td>
                                        <td class="text-end"><a href="javascript:;"
                                                onclick="_settings.on.click.unlockIP('113.172.152.239')"
                                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Unlock"
                                                data-bs-original-title="Unlock" data-kt-initialized="1"><i
                                                    class="fa-solid fa-xmark fs-4 text-danger"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>113.185.44.158</td>
                                        <td class="text-end"><a href="javascript:;"
                                                onclick="_settings.on.click.unlockIP('113.185.44.158')"
                                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Unlock"
                                                data-bs-original-title="Unlock" data-kt-initialized="1"><i
                                                    class="fa-solid fa-xmark fs-4 text-danger"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>27.73.21.230</td>
                                        <td class="text-end"><a href="javascript:;"
                                                onclick="_settings.on.click.unlockIP('27.73.21.230')"
                                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Unlock"
                                                data-bs-original-title="Unlock" data-kt-initialized="1"><i
                                                    class="fa-solid fa-xmark fs-4 text-danger"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>117.5.142.182</td>
                                        <td class="text-end"><a href="javascript:;"
                                                onclick="_settings.on.click.unlockIP('117.5.142.182')"
                                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Unlock"
                                                data-bs-original-title="Unlock" data-kt-initialized="1"><i
                                                    class="fa-solid fa-xmark fs-4 text-danger"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>1.55.84.181</td>
                                        <td class="text-end"><a href="javascript:;"
                                                onclick="_settings.on.click.unlockIP('1.55.84.181')"
                                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Unlock"
                                                data-bs-original-title="Unlock" data-kt-initialized="1"><i
                                                    class="fa-solid fa-xmark fs-4 text-danger"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>123.18.179.114</td>
                                        <td class="text-end"><a href="javascript:;"
                                                onclick="_settings.on.click.unlockIP('123.18.179.114')"
                                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Unlock"
                                                data-bs-original-title="Unlock" data-kt-initialized="1"><i
                                                    class="fa-solid fa-xmark fs-4 text-danger"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>88.230.209.137</td>
                                        <td class="text-end"><a href="javascript:;"
                                                onclick="_settings.on.click.unlockIP('88.230.209.137')"
                                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Unlock"
                                                data-bs-original-title="Unlock" data-kt-initialized="1"><i
                                                    class="fa-solid fa-xmark fs-4 text-danger"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>14.191.68.231</td>
                                        <td class="text-end"><a href="javascript:;"
                                                onclick="_settings.on.click.unlockIP('14.191.68.231')"
                                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Unlock"
                                                data-bs-original-title="Unlock" data-kt-initialized="1"><i
                                                    class="fa-solid fa-xmark fs-4 text-danger"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>171.252.153.78</td>
                                        <td class="text-end"><a href="javascript:;"
                                                onclick="_settings.on.click.unlockIP('171.252.153.78')"
                                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Unlock"
                                                data-bs-original-title="Unlock" data-kt-initialized="1"><i
                                                    class="fa-solid fa-xmark fs-4 text-danger"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>42.114.18.191</td>
                                        <td class="text-end"><a href="javascript:;"
                                                onclick="_settings.on.click.unlockIP('42.114.18.191')"
                                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Unlock"
                                                data-bs-original-title="Unlock" data-kt-initialized="1"><i
                                                    class="fa-solid fa-xmark fs-4 text-danger"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
