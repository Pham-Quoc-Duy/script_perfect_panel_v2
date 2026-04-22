<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <title>{{ __('install.title') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body { background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%); }
    .brand-left { background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); }
    .brand-logo { width: 48px; height: 48px; background: white; color: #2563eb; font-weight: 900; font-size: 24px; border-radius: 12px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); }
    .input-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #2563eb; font-size: 16px; pointer-events: none; z-index: 2; }
    .toggle-password { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #2563eb; font-size: 16px; z-index: 2; transition: opacity 0.2s; opacity: 0.7; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; }
    .toggle-password:hover { opacity: 1; }
    .form-control { padding-left: 40px; padding-right: 40px; border: 1.5px solid #e5e7eb !important; border-radius: 8px; height: 44px; font-size: 14px; transition: all 0.3s; }
    .form-control:focus { border-color: #2563eb !important; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08) !important; }
    .form-control::placeholder { color: #d1d5db; font-size: 13px; }
    .form-label { font-weight: 600; font-size: 13px; color: #4b5563; text-transform: uppercase; letter-spacing: 0.3px; }
    .form-hint { font-size: 12px; color: #9ca3af; margin-top: 6px; }
    .form-hint i { margin-right: 4px; color: #d1d5db; }
    .is-invalid { border-color: #ef4444 !important; }
    .is-invalid:focus { box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.08) !important; }
    .invalid-feedback { color: #ef4444; font-size: 12px; margin-top: 6px; font-weight: 500; }
    .alert { border-radius: 8px; border: none; font-size: 13px; padding: 12px 16px; }
    .alert-danger { background-color: #fef2f2; color: #991b1b; border-left: 4px solid #ef4444; }
    .alert-success { background-color: #f0fdf4; color: #166534; border-left: 4px solid #10b981; }
    .alert-info { background-color: #f0f9ff; color: #0c4a6e; border-left: 4px solid #0ea5e9; }
    .alert ul { padding-left: 20px; margin: 0; }
    .alert li { margin-bottom: 4px; }
    .alert i { margin-right: 6px; font-size: 16px; }
    .btn-primary { background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); border: none; border-radius: 8px; font-weight: 600; font-size: 14px; height: 44px; box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2); transition: all 0.3s; }
    .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); }
    .btn-primary:active { transform: translateY(0); }
    .language-selector { position: absolute; top: 20px; right: 20px; z-index: 1000; }
    .language-selector select { border: 1.5px solid #e5e7eb; border-radius: 8px; padding: 8px 32px 8px 12px; font-size: 13px; font-weight: 500; color: #4b5563; background-color: white; cursor: pointer; transition: all 0.3s; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%234b5563' d='M6 9L1 4h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 10px center; }
    .language-selector select:hover { border-color: #2563eb; }
    .language-selector select:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08); }
    .language-selector i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #2563eb; pointer-events: none; }
    @media (max-width: 768px) { .form-control { height: 42px; font-size: 13px; } .btn-primary { height: 42px; font-size: 13px; } .language-selector { top: 10px; right: 10px; } .language-selector select { font-size: 12px; padding: 6px 28px 6px 10px; } }
  </style>
</head>
<body class="bg-light">

<div class="container-fluid min-vh-100">
  <div class="row min-vh-100">

    <!-- LEFT -->
    <div class="col-md-5 col-lg-4 d-none d-md-flex flex-column p-5 brand-left text-white">
      <div class="d-flex align-items-center gap-2 mb-auto">
        <div class="brand-logo d-flex align-items-center justify-content-center">{{ strtoupper(getDomain())[0] }}</div>
        <h4 class="m-0 fw-bold">{{ strtoupper(getDomain()) }}</h4>
      </div>

      <!-- Centered Image -->
      <div class="d-flex justify-content-center align-items-center flex-grow-1">
        <img src="{{ asset('../images/smm.png') }}" 
             alt="SMM Panel Illustration" 
             class="img-fluid rounded-3 " 
             style="max-width: 280px; height: auto; opacity: 0.9;">
      </div>

      <blockquote class="mt-auto">
        <p class="fs-5">
          "{{ __('install.quote') }}"
        </p>
        <footer class="opacity-75">{{ __('install.quote_author') }}</footer>
      </blockquote>
    </div>
 
    <!-- RIGHT -->
    <div class="col-md-7 col-lg-8 d-flex align-items-center justify-content-center p-4">
      <div style="max-width: 450px;" class="w-100">

        <div class="text-center mb-5">
          <h2 class="fw-bold text-dark mb-2">{{ __('install.title') }}</h2>
          <p class="text-muted fs-6">{{ __('install.subtitle') }}</p>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show d-flex align-items-start" role="alert">
            <i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i>
            <div class="ms-2 flex-grow-1">
              <strong class="d-block mb-1">{{ __('install.error_title') }}</strong>
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill flex-shrink-0"></i>
            <div class="ms-2 flex-grow-1">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (session('error'))
          <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-circle-fill flex-shrink-0"></i>
            <div class="ms-2 flex-grow-1">{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <form id="installForm" method="POST" action="{{ route('install') }}" novalidate>
          @csrf

          <!-- Full Name -->
          <div class="mb-3">
            <label class="form-label">{{ __('install.full_name') }}</label>
            <div class="position-relative">
              <i class="bi bi-person-fill input-icon"></i>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('install.full_name_placeholder') }}" value="{{ old('name') }}" required>
            </div>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <!-- Username -->
          <div class="mb-3">
            <label class="form-label">{{ __('install.username') }}</label>
            <div class="position-relative">
              <i class="bi bi-at input-icon"></i>
              <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="{{ __('install.username_placeholder') }}" value="{{ old('username') }}" required>
            </div>
            <small class="form-hint"><i class="bi bi-info-circle"></i>{{ __('install.username_hint') }}</small>
            @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label class="form-label">{{ __('install.email') }}</label>
            <div class="position-relative">
              <i class="bi bi-envelope-fill input-icon"></i>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('install.email_placeholder') }}" value="{{ old('email') }}" required>
            </div>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <!-- Password -->
          <div class="mb-3">
            <label class="form-label">{{ __('install.password') }}</label>
            <div class="position-relative">
              <i class="bi bi-lock-fill input-icon"></i>
              <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('install.password_placeholder') }}" required>
              <i class="bi bi-eye toggle-password" id="togglePassword"></i>
            </div>
            <small class="form-hint"><i class="bi bi-info-circle"></i>{{ __('install.password_hint') }}</small>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <!-- Confirm Password -->
          <div class="mb-3">
            <label class="form-label">{{ __('install.confirm_password') }}</label>
            <div class="position-relative">
              <i class="bi bi-lock-fill input-icon"></i>
              <input type="password" name="password_confirmation" id="passwordConfirm" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('install.confirm_password_placeholder') }}" required>
              <i class="bi bi-eye toggle-password" id="togglePasswordConfirm"></i>
            </div>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          {{-- @if ($isSubdomain)
          <!-- API Key -->
          <div class="mb-3">
            <label class="form-label">{{ __('install.api_key') }}</label>
            <div class="position-relative">
              <i class="bi bi-key-fill input-icon"></i>
              <input type="text" name="api_key" class="form-control @error('api_key') is-invalid @enderror" placeholder="{{ __('install.api_key_placeholder') }}" value="{{ old('api_key') }}" required>
            </div>
            <small class="form-hint"><i class="bi bi-info-circle"></i>{{ __('install.api_key_hint') }}</small>
            @error('api_key')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          @endif --}}

          <button type="submit" class="btn btn-primary w-100 fw-semibold mt-2">
            <i class="bi bi-check-circle me-2"></i>{{ __('install.submit') }}
          </button>
        </form>

        <p class="text-center text-muted small mt-4">
          {{ __('install.terms_text') }}
          <a href="#" class="text-decoration-none text-primary fw-semibold">{{ __('install.terms_link') }}</a>
          {{ __('install.and') }}
          <a href="#" class="text-decoration-none text-primary fw-semibold">{{ __('install.privacy_link') }}</a>.
        </p>

      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function setupPasswordToggle(toggleId, inputId) {
    const toggle = document.getElementById(toggleId);
    const input = document.getElementById(inputId);
    if (toggle && input) {
      toggle.onclick = function (e) {
        e.preventDefault();
        const isPassword = input.type === "password";
        input.type = isPassword ? "text" : "password";
        toggle.classList.toggle("bi-eye", !isPassword);
        toggle.classList.toggle("bi-eye-slash", isPassword);
      };
    }
  }
  setupPasswordToggle("togglePassword", "password");
  setupPasswordToggle("togglePasswordConfirm", "passwordConfirm");
  document.getElementById("installForm").addEventListener("submit", function (e) {
    if (!this.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
    }
  });
</script>

</body>
</html>
