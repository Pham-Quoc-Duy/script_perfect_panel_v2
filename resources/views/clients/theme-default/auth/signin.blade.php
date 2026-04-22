<!DOCTYPE html>
<html id="theme_{{ $config->interface_default }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    style="height: 100%;">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign in - {{ $config->title ?? 'Panel' }}</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="format-detection" content="telephone=no">

    <link rel="shortcut icon" type="image/ico" href="https://storage.perfectcdn.com/ptbsev/el8cc6e7wkjx3kxy.ico">
    <link rel="icon" type="image/png" sizes="192x192"
        href="https://storage.perfectcdn.com/ptbsev/el8cc6e7wkjx3kxy.ico">
    <link rel="icon" type="image/png" sizes="512x512"
        href="https://storage.perfectcdn.com/ptbsev/el8cc6e7wkjx3kxy.ico">
    <link rel="icon" type="image/png" sizes="32x32"
        href="https://storage.perfectcdn.com/ptbsev/el8cc6e7wkjx3kxy.ico">
    <link rel="icon" type="image/png" sizes="16x16"
        href="https://storage.perfectcdn.com/ptbsev/el8cc6e7wkjx3kxy.ico">
    <link rel="apple-touch-icon" href="https://storage.perfectcdn.com/ptbsev/el8cc6e7wkjx3kxy.ico">

    <link rel="stylesheet" type="text/css" href="{{ asset('global/b0bmfu8246c86q3j.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ asset('global/iuos9mpiak6cw8rt.css')}}">

    <style>
        body {
            transition: opacity ease-in 0.2s;
        }

        body[unresolved] {
            opacity: 0;
            display: block;
            overflow: hidden;
            position: relative;
        }
    </style>
</head>

<body class="body body-public" style="position: relative; min-height: 100%; top: 0px;">
    <div class="wrapper wrapper-navbar">
        <div id="block_56">
            <div class="block-wrapper">
                <div class="component_navbar">
                    <div class="component-navbar__wrapper">
                        <div
                            class="sidebar-block__top component-navbar component-navbar__navbar-public editor__component-wrapper">
                            <div>
                                <nav class="navbar navbar-expand-lg navbar-light container-lg">
                                    <div class="navbar-public__header">
                                        <div class="sidebar-block__top-brand">
                                            <a href="{{ route('login') }}"
                                                style="background-image: url({{ $config?->logo ?? '' }})">
                                                @if ($config?->logo)
                                                    <img src="{{ $config->logo }}" alt="{{ $config->title ?? 'Logo' }}"
                                                        style="max-height: 40px; width: auto;">
                                                @else
                                                    <p><span style="text-transform: uppercase"><span
                                                                style="letter-spacing: 1.7px"><span
                                                                    style="font-size: 24px"><strong
                                                                        style="font-weight: bold">{{ $config->title ?? 'LOGO' }}</strong></span></span></span>
                                                    </p>
                                                @endif
                                            </a>
                                        </div>
                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                            data-target="#navbar-collapse-56" aria-controls="navbar-collapse-56"
                                            aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-burger">
                                                <span class="navbar-burger-line"></span>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="collapse navbar-collapse" id="navbar-collapse-56">
                                        <div class="component-navbar-collapse-divider"></div>
                                        <div class="d-flex component-navbar-collapse">
                                            <ul class="navbar-nav">
                                                <li
                                                    class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                                    <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public {{ request()->routeIs('login') ? 'component-navbar-nav-link-active__navbar-public' : '' }}"
                                                        href="{{ route('login') }}">
                                                        <i class="navbar-icon fas fa-sign-in-alt"></i> Sign in
                                                    </a>
                                                </li>
                                                <li
                                                    class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                                    <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public"
                                                        href="/services">
                                                        <i class="navbar-icon fas fa-store-alt"></i> Services
                                                    </a>
                                                </li>
                                                <li
                                                    class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                                    <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public"
                                                        href="/api">
                                                        <i class="navbar-icon fas fa-code"></i> API
                                                    </a>
                                                </li>
                                                <li
                                                    class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                                    <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public"
                                                        href="{{ route('signup') }}">
                                                        <i class="navbar-icon fas fa-user-plus"></i> Sign up
                                                    </a>
                                                </li>
                                                <li
                                                    class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                                    <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public"
                                                        href="/blog">
                                                        <i class="navbar-icon fab fa-blogger-b"></i> Blog
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper-content">
            <div class="wrapper-content__body">
                <div id="block_71">
                    <div class="block-bg"></div>
                    <div class="block-divider-bottom">
                        <svg width="100%" height="100%" viewBox="0 0 1280 140" preserveAspectRatio="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g fill="currentColor">
                                <path d="M0 47.44L170 0l626.48 94.89L1110 87.11l170-39.67V140H0V47.44z"
                                    fill-opacity=".5"></path>
                                <path
                                    d="M0 90.72l140-28.28 315.52 24.14L796.48 65.8 1140 104.89l140-14.17V140H0V90.72z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <div class="container">
                        <div class="block-signin-text">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="block-signin-text__block-text">
                                        <div class="block-signin-text__block-text-title">
                                            <h1><strong style="font-weight: bold">{{ $config->title }}</strong></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="component_card">
                                        <div class="card">
                                            @if (session('success'))
                                                <div class="alert alert-dismissible alert-success mb-3">
                                                    <button type="button" class="close"
                                                        data-dismiss="alert">×</button>
                                                    <div>{{ session('success') }}</div>
                                                </div>
                                            @endif

                                            @if (session('error'))
                                                <div class="alert alert-dismissible alert-danger mb-3">
                                                    <button type="button" class="close"
                                                        data-dismiss="alert">×</button>
                                                    <div>{{ session('error') }}</div>
                                                </div>
                                            @endif

                                            @if ($errors->any())
                                                <div class="alert alert-dismissible alert-danger mb-3">
                                                    <button type="button" class="close"
                                                        data-dismiss="alert">×</button>
                                                    @foreach ($errors->all() as $error)
                                                        <div>{{ $error }}</div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <form method="post" action="{{ route('login.store') }}">
                                                @csrf
                                                <div>
                                                    <div class="component_form_group">
                                                        <div class="form-group">
                                                            <label>Username</label>
                                                            <input type="text" name="username"
                                                                class="form-control" value="{{ old('username') }}"
                                                                placeholder="Nhập username" autocomplete="username"
                                                                required>
                                                        </div>
                                                    </div>

                                                    <div class="component_form_group">
                                                        <div class="form-group">
                                                            <label>Mật khẩu</label>
                                                            <div class="position-relative">
                                                                <input type="password" name="password"
                                                                    class="form-control" placeholder="Nhập mật khẩu"
                                                                    autocomplete="current-password" required>
                                                                <div
                                                                    class="sign-in__forgot h-100 d-flex align-items-center">
                                                                    <a href="/resetpassword">Quên mật khẩu?</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="component_checkbox_remember_me">
                                                        <div class="sign-in__remember-me">
                                                            <div class="form-group__checkbox">
                                                                <label class="form-group__checkbox-label">
                                                                    <input type="checkbox" name="remember"
                                                                        id="block_71_remember_me"
                                                                        {{ old('remember') ? 'checked' : '' }}>
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label class="form-group__label-title"
                                                                    for="block_71_remember_me">Ghi nhớ đăng
                                                                    nhập</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="component_button_submit">
                                                            <button class="btn btn-block btn-big-primary"
                                                                type="submit">
                                                                <span class="btn-text">Đăng nhập</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="text-center d-flex justify-content-center">
                                                    <div>Chưa có tài khoản?</div>
                                                    <a href="{{ route('signup') }}"
                                                        class="block-signin-text__sign-up-link">Đăng ký ngay</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="block_137">
                    <div class="block-bg"></div>
                    <div class="container">
                        <div class="totals">
                            <div class="row align-items-start justify-content-center">
                                <div class="col-lg-3 col-md-6 mb-2 mt-2">
                                    <div class="card totals-card h-100"
                                        style="background: var(--color-id-59); color: var(--text-dark); padding-top: 24px; padding-bottom: 24px;">
                                        <div class="totals-card__count">
                                            <h2 class="totals-card__count-value style-text-primary">
                                                {{ number_format($totalServices ?? 0) }}</h2>
                                        </div>
                                        <div class="totals-card__name">
                                            <p>Total services</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-2 mt-2">
                                    <div class="card totals-card h-100"
                                        style="background: var(--color-id-59); color: var(--text-dark); padding-top: 24px; padding-bottom: 24px;">
                                        <div class="totals-card__count">
                                            <h2 class="totals-card__count-value style-text-primary">
                                                {{ number_format($totalOrders ?? 0) }}</h2>
                                        </div>
                                        <div class="totals-card__name">
                                            <p>Total orders</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-2 mt-2">
                                    <div class="card totals-card h-100"
                                        style="background: var(--color-id-59); color: var(--text-dark); padding-top: 24px; padding-bottom: 24px;">
                                        <div class="totals-card__count">
                                            <h2 class="totals-card__count-value style-text-primary">
                                                {{ number_format($totalCompletedOrders ?? 0) }}</h2>
                                        </div>
                                        <div class="totals-card__name">
                                            <p>Total completed orders</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-2 mt-2">
                                    <div class="card totals-card h-100"
                                        style="background: var(--color-id-59); color: var(--text-dark); padding-top: 24px; padding-bottom: 24px;">
                                        <div class="totals-card__count">
                                            <h2 class="totals-card__count-value style-text-primary">99.8%</h2>
                                        </div>
                                        <div class="totals-card__name">
                                            <p>Uptime</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wrapper-content__footer">
                <div id="block_41">
                    <div class="block-bg"></div>
                    <div class="container-fluid">
                        <div class="footer ">
                            <div class="component-footer__public-copyright text-center position-relative">
                                <p class="text-center"><span style="text-align: CENTER">© Copyright. All Rights Reserved.</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Notifications wrapper -->
    <div id="notify-wrapper" class="alert alert-success mb-3 hidden" style="display: none;"></div>

    <script type="text/javascript" src="https://storage.perfectcdn.com/global/wxsqj274j2fljwqh.js">
    </script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/ueokzc34y7ofrqqg.js">
    </script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/nfjxywl5k0s161d5.js">
    </script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/3u30z1np32rdiw54.js">
    </script>
    <script type="text/javascript">
        window.modules.user_app_show_config = [];
    </script>
    <script type="text/javascript">
    </script>
</body>

</html>