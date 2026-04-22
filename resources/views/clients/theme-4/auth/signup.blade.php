<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign up - {{ config('app.name') }}</title>
    <link rel="shortcut icon" href="/assets/media/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700">
    <link href="https://cdn.whoispanel.com/1/plugins/global/plugins.bundle.css" rel="stylesheet">
    <link href="https://cdn.whoispanel.com/1/css/style.bundle.css" rel="stylesheet">
</head>
<body id="kt_body" class="app-blank" data-theme="light">
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">

        {{-- Form side --}}
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-lg-500px p-10">

                    {{-- Flash messages --}}
                    @if(session('error'))
                        <div class="alert alert-danger mb-5">{{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success mb-5">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('signup.store') }}" class="form w-100">
                        @csrf

                        <div class="text-center mb-11">
                            <h1 class="text-dark fw-bolder mb-3">Sign up</h1>
                            <div class="text-gray-500 fw-semibold fs-6">{{ config('app.name') }}</div>
                        </div>

                        {{-- Name --}}
                        <div class="fv-row mb-8">
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control form-control-solid @error('name') is-invalid @enderror"
                                placeholder="Full name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Username --}}
                        <div class="fv-row mb-8">
                            <input type="text" name="username" value="{{ old('username') }}"
                                class="form-control form-control-solid @error('username') is-invalid @enderror"
                                placeholder="Username (lowercase, no spaces)">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="fv-row mb-8">
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control form-control-solid @error('email') is-invalid @enderror"
                                placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="fv-row mb-6">
                            <input type="password" name="password"
                                class="form-control form-control-solid @error('password') is-invalid @enderror"
                                placeholder="Password">
                            <div class="text-muted mt-2 fs-7">Use 8 or more characters with letters, numbers &amp; symbols.</div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirm password --}}
                        <div class="fv-row mb-8">
                            <input type="password" name="password_confirmation"
                                class="form-control form-control-solid"
                                placeholder="Repeat password">
                        </div>

                        {{-- Terms --}}
                        <div class="fv-row mb-8">
                            <label class="form-check form-check-inline">
                                <input type="checkbox" name="agree_terms" value="1"
                                    class="form-check-input @error('agree_terms') is-invalid @enderror">
                                <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">
                                    I Accept the <a href="/terms" class="ms-1 link-primary">Terms</a>
                                </span>
                            </label>
                            @error('agree_terms')
                                <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mb-10">
                            <button type="submit" class="btn btn-primary">Sign up</button>
                        </div>

                        <div class="text-gray-500 text-center fw-semibold fs-6">
                            Already have an Account?
                            <a href="{{ route('login') }}" class="link-primary fw-semibold">Sign in</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- Aside --}}
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
            style="background-image: url(https://cdn.whoispanel.com/1/media/misc/auth-bg.png)">
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <a href="/" class="mb-0 mb-lg-12">
                    <img alt="Logo" src="/assets/media/logo.png" class="h-60px h-lg-75px">
                </a>
                <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                    src="https://cdn.mypanel.link/6f7slz/jd7xmobnjdlu0eun.webp" alt="">
                <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">
                    World's Best Cheap &amp; Easy SMM Panel
                </h1>
                <div class="d-none d-lg-block text-white fs-base text-center" style="max-width: 550px;">
                    We offer several advantages that make us the best SMM panel. Our SMM services are diverse,
                    making us the cheapest around. Many agencies and freelancers worldwide rely on us.
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.whoispanel.com/1/plugins/global/plugins.bundle.js"></script>
<script src="https://cdn.whoispanel.com/1/js/scripts.bundle.js"></script>
</body>
</html>
