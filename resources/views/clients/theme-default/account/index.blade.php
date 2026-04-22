@extends('clients.theme-default.layouts.app')

@section('title', __('account.title'))

@section('content')
    <div class="wrapper-content">
        <div class="wrapper-content__header">
        </div>
        <div class="wrapper-content__body">
            <!-- Main variables *content* -->
            <div id="block_42">
                <div class="block-bg"></div>
                <div class="container">
                    <div class="account ">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="alertContainer" class="mb-3"></div>
                                <div class="component_tabs account-card">
                                    <div class="">
                                        <ul class="nav nav-pills tab">
                                            <li class="nav-item">
                                                <a class="nav-link active"
                                                    href="{{ route('clients.account.index') }}">{{ __('account.general') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ route('clients.notifications.index') }}">{{ __('account.notifications_settings') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="component_card">
                                    <div class="card account-card">
                                        <div class="component_form_group">
                                            <div class="">
                                                <div class="form-group">
                                                    <label>{{ __('account.username') }}</label>
                                                    <input type="text" class="form-control" id="username"
                                                        value="{{ Auth::user()->username }}" disabled="disabled">
                                                </div>
                                                <div class="component_button_save">
                                                    <div class="form-group">
                                                        <label for="email" class="control-label">{{ __('account.email') }}</label>
                                                        <input type="text" class="form-control" id="email"
                                                            value="{{ Auth::user()->email }}" readonly="">
                                                    </div>
                                                    <button class="btn btn-block btn-big-primary" id="changeEmailLink">
                                                        {{ __('account.change_email') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(isset($data['languages']) && !empty($data['languages']))
                                <div class="component_card">
                                    <div class="card account-card">
                                        <form class="component_form_group" method="post"
                                            action="{{ route('clients.account.update-language') }}" id="languageForm">
                                            @csrf
                                            <div class="">
                                                <div class="form-group">
                                                    <label>{{ __('account.language') }}</label>
                                                    <div class="d-flex">
                                                        <div class="w-100">
                                                            <select class="form-control" id="language" name="lang">
                                                                @foreach ($data['languages'] as $language)
                                                                    <option value="{{ $language['code'] }}"
                                                                        @if ($data['lang'] === $language['code']) selected @endif>
                                                                        {{ $language['name'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="account-button-right">
                                                            <div class="component_button_save">
                                                                <button type="submit"
                                                                    class="btn btn-block btn-big-primary">
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                                <div class="component_card">
                                    <div class="card account-card">
                                        <div id="passwordAlertContainer" class="mb-3"></div>
                                        <form class="component_form_group" method="post"
                                            action="{{ route('clients.account.update-password') }}" id="passwordForm">
                                            @csrf
                                            <div class="">
                                                <div class="form-group">
                                                    <label>{{ __('account.current_password') }}</label>
                                                    <input type="password" class="form-control" id="current"
                                                        name="current_password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('account.new_password') }}</label>
                                                    <input type="password" class="form-control" id="new"
                                                        name="password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('account.confirm_password') }}</label>
                                                    <input type="password" class="form-control" id="confirm"
                                                        name="password_confirmation" required>
                                                </div>
                                            </div>
                                            <div class="component_button_save">
                                                <div class="">
                                                    <button class="btn btn-block btn-big-primary" type="submit">
                                                        {{ __('account.change_password') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="component_card">
                                    <div class="card account-card">
                                        <div id="2fa-approve-error-block" style="display: none;"
                                            class="alert alert-dismissible alert-danger mb-3 ">
                                            <button type="button" class="close">×</button>
                                            <span id="2fa-error-text"></span>
                                        </div>

                                        <div class="component_form_group ">
                                            <div id="2fa-alert-container" class="mb-3"></div>
                                            <div class="form-group">
                                                <label>
                                                    Two-factor authentication
                                                </label>

                                                <!-- 2FA Form generate code -->
                                                <form id="2fa-generate-form" method="post"
                                                    action="{{ route('clients.account.2fa-generate') }}"
                                                    style=" display: block; ">
                                                    <div class="mb-4">Email-based option to add an extra layer of
                                                        protection to your account. When signing in you’ll need to enter a
                                                        code that will be sent to your email address.</div>
                                                    @csrf
                                                    <div class="component_button_save">
                                                        <div class="">
                                                            <button id="2fa-generate" type="submit"
                                                                class="btn btn-block btn-big-primary">
                                                                Enable
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>

                                                <!-- 2FA Form approve code -->
                                                <form id="2fa-approve-form" method="post"
                                                    action="{{ route('clients.account.2fa-approve') }}"
                                                    style=" display: none; ">
                                                    <div class="mb-4">Please check your email and enter the code below.
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="code" class="control-label">Code</label>
                                                        <input type="text" id="code" name="code"
                                                            class="form-control" required>
                                                    </div>
                                                    @csrf
                                                    <div class="component_button_save">
                                                        <div class="">
                                                            <button id="2fa-approve" type="submit"
                                                                class="btn btn-block btn-big-primary">
                                                                Enable
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                @if(isset($data['timezones']) && !empty($data['timezones']))
                                <div class="component_card">
                                    <div class="card account-card">
                                        <form class="component_form_group" method="post"
                                            action="{{ route('clients.account.update-timezone') }}" id="timezoneForm">
                                            @csrf
                                            <div class="">
                                                <div class="form-group">
                                                    <label>Timezone</label>
                                                    <div class="d-flex">
                                                        <div class="w-100">
                                                            <select name="timezone" id="timezone" class="form-control">
                                                                @foreach ($data['timezones'] as $tz)
                                                                    <option value="{{ $tz['timezone'] }}"
                                                                        @if ($data['timezone'] == $tz['timezone']) selected @endif>
                                                                        {{ $tz['label'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="account-button-right">
                                                            <div class="component_button_save">
                                                                <div class="">
                                                                    <input type="hidden" name="_csrf"
                                                                        value="{{ Auth::user()->api_key }}">
                                                                    <button class="btn btn-block btn-big-primary"
                                                                        type="submit">
                                                                        Save
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                                <div class="component_card">
                                    <div class="card account-card">
                                        <form class="component_form_group" method="post"
                                            action="{{ route('clients.account.generate-api-key') }}" id="apiKeyForm">
                                            @csrf
                                            <div class="">
                                                <div class="form-group">
                                                    <label>API key</label>
                                                    <div class="d-flex">
                                                        <div class="w-100">
                                                            <input type="text" class="form-control" id="api_key"
                                                                value="{{ Auth::user()->api_key }}" readonly=""
                                                                data-original-title="" title="">
                                                        </div>
                                                        <div class="account-button-right">
                                                            <div class="component_button_save">
                                                                <div class="">
                                                                    <button class="btn btn-block btn-big-primary"
                                                                        type="submit">
                                                                        Generate new
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <small class="help-block">Created:
                                                        {{ Auth::user()->created_at }}</small>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Change email -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="changeEmailModal" data-backdrop="static">
                        <div class="modal-dialog" role="document">
                            <form id="changeEmailForm" class="modal-content" method="post"
                                action="{{ route('clients.account.update-email') }}">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">Change email</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body component_form_group">
                                    <div id="changeEmailError"
                                        class="error-summary alert alert-dismissible alert-danger mb-3 hidden"></div>
                                    <div class="form-group">
                                        <label for="current-email">Current email</label>
                                        <input type="email" class="form-control" value="{{ Auth::user()->email }}"
                                            readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label for="new-email">New email</label>
                                        <input type="email" class="form-control" id="new-email" name="email"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="current-password">Current password</label>
                                        <input type="password" class="form-control" id="current-password"
                                            name="password" required>
                                    </div>
                                </div>
                                <div class="modal-footer component_button_save">
                                    <button type="button" class="btn btn-big-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-big-primary" id="changeEmailSubmitBtn">Change
                                        email</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-content__footer">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hide API key
            const apiKeyInput = document.getElementById('api_key');
            if (apiKeyInput) apiKeyInput.value = '*'.repeat(apiKeyInput.value.length);

            // Show alert helper with custom container
            const showAlert = (msg, type = 'success', containerId = 'alertContainer') => {
                const container = document.getElementById(containerId);
                if (!container) return;
                container.innerHTML = `
            <div class="alert alert-dismissible alert-${type} mb-3">
                <button type="button" class="close" data-dismiss="alert">×</button>
                ${msg}
            </div>
        `;

            };

            // Handle form submission
            const handleFormSubmit = (formId, alertContainerId = 'alertContainer') => {
                const form = document.getElementById(formId);
                if (!form) return;

                form.addEventListener('submit', e => {
                    e.preventDefault();
                    fetch(form.action, {
                            method: 'POST',
                            body: new FormData(form),
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(r => r.json())
                        .then(data => {
                            if (data.success) {
                                // Special handling for API key form
                                if (formId === 'apiKeyForm') {
                                    document.getElementById('api_key').value = data.api_key;
                                    showAlert('API key has been generated:<br>' + data.api_key,
                                        'success',
                                        alertContainerId);
                                } else {
                                    showAlert('Changes saved successfully', 'success',
                                        alertContainerId);
                                }
                                if (formId === 'changeEmailForm') {
                                    $('#changeEmailModal').modal('hide');
                                    form.reset();
                                } else if (formId === 'passwordForm') {
                                    form.reset();
                                }
                            } else {
                                showAlert(data.message || 'Error', 'danger', alertContainerId);
                            }
                        })
                        .catch(() => showAlert('An error occurred', 'danger', alertContainerId));
                });
            };

            // Open Change Email modal
            document.getElementById('changeEmailLink')?.addEventListener('click', () => {
                $('#changeEmailModal').modal('show');
            });

            handleFormSubmit('languageForm', 'alertContainer');
            handleFormSubmit('changeEmailForm', 'alertContainer');
            handleFormSubmit('passwordForm', 'passwordAlertContainer');
            handleFormSubmit('timezoneForm', 'alertContainer');
            handleFormSubmit('apiKeyForm', 'alertContainer');

            // Handle 2FA forms
            const handle2FA = () => {
                const generateForm = document.getElementById('2fa-generate-form');
                const approveForm = document.getElementById('2fa-approve-form');

                if (generateForm) {
                    generateForm.addEventListener('submit', e => {
                        e.preventDefault();
                        fetch(generateForm.action, {
                                method: 'POST',
                                body: new FormData(generateForm),
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(r => r.json())
                            .then(data => {
                                if (data.success) {
                                    generateForm.style.display = 'none';
                                    approveForm.style.display = 'block';
                                    showAlert(data.message, 'success', '2fa-alert-container');
                                } else {
                                    showAlert(data.message || 'Error', 'danger',
                                        '2fa-alert-container');
                                }
                            })
                            .catch(() => showAlert('An error occurred', 'danger',
                                '2fa-alert-container'));
                    });
                }

                if (approveForm) {
                    approveForm.addEventListener('submit', e => {
                        e.preventDefault();
                        fetch(approveForm.action, {
                                method: 'POST',
                                body: new FormData(approveForm),
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(r => r.json())
                            .then(data => {
                                if (data.success) {
                                    showAlert(data.message, 'success', '2fa-alert-container');
                                    approveForm.reset();
                                    approveForm.style.display = 'none';
                                    generateForm.style.display = 'block';
                                } else {
                                    showAlert(data.message || 'Error', 'danger',
                                        '2fa-alert-container');
                                }
                            })
                            .catch(() => showAlert('An error occurred', 'danger',
                                '2fa-alert-container'));
                    });
                }
            };

            handle2FA();
        });
    </script>
@endsection
