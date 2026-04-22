@extends('adminpanel.layouts.app')
@section('title', 'Settings')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        
        @include('adminpanel.settings.partials.header')

        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2" data-lang="SMTP">SMTP</h3>
            <div class="d-flex flex-wrap my-2">
                <button class="btn btn-primary btn-sm" data-lang="button::Update"
                    onclick="_settings.on.click.updateSetting({
            'smtp_status': document.querySelector('.cb-smtp').checked,
            'smtp_host': document.querySelector('.ipt-smtp-host').value.trim(),
            'smtp_port': document.querySelector('.ipt-smtp-port').value.trim(),
            'smtp_user': document.querySelector('.ipt-smtp-user').value.trim(),
            'smtp_pass': document.querySelector('.ipt-smtp-pass').value.trim(),
            'smtp_from': document.querySelector('.ipt-smtp-from').value.trim(),
            'smtp_verify_account': document.querySelector('.cb-smtp-verify-account').checked,
            'smtp_forget_password': document.querySelector('.cb-forget-password').checked,
            'smtp_warning_login': document.querySelector('.cb-warning-login').checked
        })">Cập
                    nhật</button>
            </div>
        </div>

        <div class="row g-6">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                    <input class="form-check-input cb-smtp" type="checkbox" checked=""
                                        onchange="document.querySelector('.row-smtp').style.display = this.checked ? '' : 'none'">
                                    <label class="form-check-label" data-lang="SMTP">SMTP</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mt-5 row-smtp" style="">
                            <div class="col-lg-6">
                                <label class="required form-label">Hostname</label>
                                <input type="text" class="form-control form-control-solid ipt-smtp-host"
                                    value="smmkay.com">
                            </div>
                            <div class="col-lg-6">
                                <label class="required form-label">Port</label>
                                <input type="text" class="form-control form-control-solid ipt-smtp-port"
                                    value="587" placeholder="587">
                            </div>
                            <div class="col-lg-6">
                                <label class="required form-label">Username</label>
                                <input type="text" class="form-control form-control-solid ipt-smtp-user"
                                    value="smmkay">
                            </div>
                            <div class="col-lg-6">
                                <label class="required form-label">Password</label>
                                <input type="text" class="form-control form-control-solid ipt-smtp-pass"
                                    value="nyfhqsqxuqeqfrxp">
                            </div>
                            <div class="col-lg-6">
                                <label class="required form-label">From email</label>
                                <input type="text" class="form-control form-control-solid ipt-smtp-from"
                                    value="duybuntv@gmail.com">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Check SMTP </label>
                                <div class="input-group input-group-solid">
                                    <input type="text" class="form-control ipt-smtp-test" placeholder="Test email">
                                    <button class="btn btn-danger" type="button"
                                        onclick="_settings.on.click.testSmtp(document.querySelector('.ipt-smtp-test').value.trim())">Send</button>
                                </div>
                            </div>
                            <span class="result-text fw-bold"></span>
                            <div class="separator separator-dashed my-5"></div>
                            <div class="col-lg-12">
                                <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                    <input class="form-check-input cb-smtp-verify-account" type="checkbox">
                                    <label class="form-check-label" data-lang="Using for verifying account">Using for verifying account</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                    <input class="form-check-input cb-forget-password" type="checkbox" checked="">
                                    <label class="form-check-label" data-lang="Using for forgetting password">Using for forgeting password</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                    <input class="form-check-input cb-warning-login" type="checkbox" checked="">
                                    <label class="form-check-label" data-lang="Using for warning login">Using for warning login alert</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
