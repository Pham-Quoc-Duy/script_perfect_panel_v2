<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password - {{ config('app.name') }}</title>
    <link rel="shortcut icon" href="/assets/media/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700">
    <link href="https://cdn.whoispanel.com/1/plugins/global/plugins.bundle.css" rel="stylesheet">
    <link href="https://cdn.whoispanel.com/1/css/style.bundle.css" rel="stylesheet">
</head>
<body id="kt_body" class="app-blank" data-theme="light">
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">

        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-lg-500px p-10">

                    @if(session('status'))
                        <div class="alert alert-success mb-5">{{ session('status') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger mb-5">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="form w-100">
                        @csrf

                        <div class="text-center mb-11">
                            <h1 class="text-dark fw-bolder mb-3">Forgot Password?</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password.</div>
                        </div>

                        <div class="fv-row mb-8">
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control form-control-solid @error('email') is-invalid @enderror"
                                placeholder="Email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mb-10">
                            <button type="submit" class="btn btn-primary">Send Reset Link</button>
                        </div>

                        <div class="text-gray-500 text-center fw-semibold fs-6">
                            <a href="{{ route('login') }}" class="link-primary">Back to Sign In</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
            style="background-image: url(https://cdn.whoispanel.com/1/media/misc/auth-bg.png)">
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <a href="/" class="mb-0 mb-lg-12">
                    <img alt="Logo" src="/assets/media/logo.png" class="h-60px h-lg-75px">
                </a>
                <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">
                    World's Best Cheap &amp; Easy SMM Panel
                </h1>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.whoispanel.com/1/plugins/global/plugins.bundle.js"></script>
<script src="https://cdn.whoispanel.com/1/js/scripts.bundle.js"></script>
</body>
</html>
