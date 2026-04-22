@extends('clients.theme-4.layouts.app')
@section('title', 'Settings')

@section('content')
<div class="content flex-column-fluid" id="kt_content">
    @include('clients.theme-4.layouts.toolbar', ['toolbarTitle' => 'Settings'])
    <div class="post" id="kt_post">

        {{-- Information --}}
        <div class="card mb-5">
            <div class="card-header">
                <div class="card-title fw-bold" data-lang="account.information">Information</div>
            </div>
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" data-lang="account.email">Email</label>
                            <div class="input-group input-group-solid">
                                <input type="text" id="ipt-email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                                <span class="input-group-text"></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" data-lang="account.phone">Phone number</label>
                            <input type="text" id="ipt-phone" class="form-control form-control-solid"
                                value="{{ auth()->user()->phone ?? '' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" data-lang="account.current_password">Current password</label>
                            <input type="password" id="ipt-current-pass" class="form-control form-control-solid">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" data-lang="account.new_password">New password</label>
                            <input type="password" id="ipt-new-pass" class="form-control form-control-solid">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" data-lang="account.confirm_password">Confirm password</label>
                            <input type="password" id="ipt-confirm-pass" class="form-control form-control-solid">
                        </div>
                        <button type="button" id="btn-change-password" class="btn btn-primary"
                            onclick="_settings.on.click.changePassword()" data-lang="button::Update">Update</button>
                    </div>
                </div>
                <div class="alert mt-4 d-none" id="alert-info"></div>
            </div>
        </div>

        {{-- Security --}}
        <div class="card mb-5">
            <div class="card-header">
                <div class="card-title fw-bold" data-lang="account.security">Security</div>
            </div>
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger" data-lang="account.disable_2fa"
                            data-bs-toggle="modal" data-bs-target="#modal-2fa">Disable 2FA Google Authentication</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Settings --}}
        <div class="card mb-5">
            <div class="card-header">
                <div class="card-title fw-bold" data-lang="account.settings">Settings</div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="sl-language" class="form-label" data-lang="account.language">Language</label>
                    <select id="sl-language" class="form-select form-select-solid">
                        @foreach ($data['languages'] as $lang)
                            <option value="{{ $lang['code'] }}"
                                data-content="<span class='rounded-1 fi fi-{{ langToFlag($lang['code']) }} fs-4 me-1'></span> {{ $lang['name'] }}"
                                {{ ($data['lang'] ?? 'en') === $lang['code'] ? 'selected' : '' }}>
                                {{ $lang['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sl-currency" class="form-label" data-lang="account.currency">Currency</label>
                    <select id="sl-currency" class="form-select form-select-solid">
                        @foreach ($data['currencies'] as $cur)
                            <option value="{{ $cur->code }}"
                                data-symbol="{{ $cur->symbol }}"
                                data-name="{{ $cur->name }}"
                                data-content="<span class='badge badge-primary me-1'>{{ $cur->code }}</span> {{ $cur->name }}"
                                {{ ($data['user_currency'] ?? 'USD') === $cur->code ? 'selected' : '' }}>
                                {{ $cur->code }} - {{ $cur->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sl-appearance" class="form-label" data-lang="account.appearance">Appearance</label>
                    <select id="sl-appearance" class="form-select form-select-solid">
                        <option value="light" data-lang="account.light">Light</option>
                        <option value="dark" data-lang="account.dark">Dark</option>
                    </select>
                </div>
                <div class="">
                    <label for="sl-timezone" class="form-label" data-lang="account.timezone">Timezone</label>
                    <select id="sl-timezone" class="form-select form-select-solid">
                        @foreach ($data['timezones'] as $tz)
                            <option value="{{ $tz['timezone'] ?? $tz }}"
                                {{ ($data['timezone'] ?? '0') == ($tz['timezone'] ?? $tz) ? 'selected' : '' }}>
                                {{ $tz['label'] ?? $tz }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Sign-in history --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title fw-bold" data-lang="account.signin_history">Sign-in history</div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-7 gy-3 gs-5 mb-0">
                        <thead class="text-start text-muted bg-light fw-bold fs-7 text-uppercase gs-0">
                            <tr>
                                <th data-lang="account.time">Time</th>
                                <th>IP</th>
                                <th data-lang="account.device">User Agent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data['login_history'] as $log)
                                <tr>
                                    <td class="text-nowrap text-muted fs-7">{{ $log['time'] }}</td>
                                    <td class="fw-semibold ls-1">{{ $log['ip'] }}</td>
                                    <td class="fs-7 text-gray-600 wrap">{{ $log['ua'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-5" data-lang="common.no_data">No data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- 2FA Modal --}}
        <div class="modal fade" id="modal-2fa" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header flex-stack">
                        <h3 data-lang="account.google_auth_setting">Google Authentication Setting</h3>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body scroll-y">
                        <form class="form" action="#">
                            <div class="mb-3">
                                <div class="input-group input-group-solid">
                                    <input type="text" id="ipt-2fa-code" class="form-control form-control-solid"
                                        placeholder="Enter authentication code" data-lang="account.enter_auth_code">
                                    <button type="button" id="btn-disable-2fa" class="btn btn-danger"
                                        onclick="_settings.on.click.disable2FA()"
                                        data-lang="account.disable">Disable</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
(function() {
    function showAlert(type, msg) {
        var el = document.getElementById('alert-info');
        if (!el) return;
        el.className = 'alert mt-4 alert-' + type;
        el.textContent = msg;
        el.classList.remove('d-none');
    }

    window._settings = window._settings || { on: { click: {} } };

    _settings.on.click.changePassword = function() {
        var btn         = document.getElementById('btn-change-password');
        var email       = document.getElementById('ipt-email').value.trim();
        var currentPass = document.getElementById('ipt-current-pass').value;
        var newPass     = document.getElementById('ipt-new-pass').value;
        var confirmPass = document.getElementById('ipt-confirm-pass').value;
        var origEmail   = '{{ auth()->user()->email }}';

        var emailChanged = email && email !== origEmail;
        var passChanged  = newPass.length > 0;

        // Validate BEFORE showing loader
        if (!emailChanged && !passChanged) return;

        // Show loader first, then disable button
        showFullScreenLoader('Updating...', 'body');
        if (btn) btn.disabled = true;

        var tasks = [];

        if (emailChanged) {
            tasks.push(fetch('{{ route("clients.settings.update-email") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ email: email })
            }).then(r => r.json()));
        }

        if (passChanged) {
            tasks.push(fetch('{{ route("clients.settings.update-password") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ current_password: currentPass, password: newPass, password_confirmation: confirmPass })
            }).then(r => r.json()));
        }

        Promise.all(tasks).then(function(results) {
            var allOk = results.every(r => r.success);
            var msgs  = results.map(r => r.message).filter(Boolean).join(' | ');
            // Hide loader before showing result
            hideFullScreenLoader();
            showAlert(allOk ? 'success' : 'danger', msgs || (allOk ? 'Updated successfully.' : 'An error occurred.'));
            if (allOk && passChanged) {
                document.getElementById('ipt-current-pass').value = '';
                document.getElementById('ipt-new-pass').value = '';
                document.getElementById('ipt-confirm-pass').value = '';
            }
        }).catch(function() {
            hideFullScreenLoader();
            showAlert('danger', 'Network error.');
        }).finally(function() {
            if (btn) btn.disabled = false;
        });
    };

    _settings.on.click.disable2FA = function() {
        var code = document.getElementById('ipt-2fa-code').value;
        fetch('{{ route("clients.settings.2fa-approve") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify({ code: code })
        }).then(r => r.json()).then(function(res) {
            if (res.success) location.reload();
            else alert(res.message || 'Error.');
        });
    };

    // Select2 for Settings card
    document.addEventListener('DOMContentLoaded', function() {
        var s2 = {
            escapeMarkup: function(m) { return m; },
            templateResult: function(o) {
                if (!o.element) return o.text;
                var c = o.element.getAttribute('data-content');
                return c ? c : o.text;
            },
            templateSelection: function(o) {
                if (!o.element) return o.text;
                var c = o.element.getAttribute('data-content');
                return c ? c : o.text;
            },
            width: '100%'
        };

        $('#sl-language').select2(s2).on('change', function() {
            fetch('{{ route("clients.settings.update-language") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ lang: $(this).val() })
            }).then(r => r.json()).then(function(res) { if (res.success) location.reload(); });
        });

        $('#sl-currency').select2(s2).on('change', function() {
            var opt = $(this).find(':selected');
            fetch('{{ route("clients.settings.update-currency") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ currency_code: $(this).val(), currency_symbol: opt.data('symbol'), currency_name: opt.data('name') })
            }).then(r => r.json()).then(function(res) { if (res.success) location.reload(); });
        });

        $('#sl-appearance').select2({ minimumResultsForSearch: -1, width: '100%' });

        // Set select value from localStorage on load
        var savedTheme = localStorage.getItem('theme') || 'light';
        $('#sl-appearance').val(savedTheme).trigger('change.select2');

        $('#sl-appearance').on('change', function() {
            var theme = $(this).val();
            localStorage.setItem('theme', theme);
            document.documentElement.setAttribute('data-bs-theme', theme);
        });

        $('#sl-timezone').select2({ width: '100%' }).on('change', function() {
            fetch('{{ route("clients.settings.update-timezone") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ timezone: $(this).val() })
            }).then(r => r.json()).then(function(res) { if (res.success) location.reload(); });
        });
    });
})();
</script>
@endpush
