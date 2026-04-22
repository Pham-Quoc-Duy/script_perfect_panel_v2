<html id="theme_{{ $config->lang_default }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100%;"
    bbai-tooltip-injected="true">

<head>
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign up - {{ $config->title ?? 'Panel' }}</title>
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


    <link rel="stylesheet" type="text/css" href="https://storage.perfectcdn.com/global/b4rxa0pklsh0lw5q.css">
    <link rel="stylesheet" type="text/css" href="https://storage.perfectcdn.com/ptbsev/iuos9mpiak6cw8rt.css">
    <!-- Google tag (gtag.js) -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=G-9C3MMH8F4T"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Draggable Translate Button</title>

</head>

<body class="body  body-public" style="position: relative; min-height: 100%; top: 0px;">

    <meta name="heleket" content="93b13156">
    <link href="https://storage.perfectcdn.com/global/6k54ozpzw8o83xr3.js" rel="preload" as="script">
    <link href="https://storage.perfectcdn.com/global/jq8derbjf313z5ai.js" rel="preload" as="script">
    <link href="https://storage.perfectcdn.com/global/wnz4cikxqalrs02w.js" rel="preload" as="script">
    <link href="https://storage.perfectcdn.com/global/0ud5szi4ocdmm9ep.js" rel="preload" as="script">
    <link href="https://storage.perfectcdn.com/global/w9z8nk0wkyg9w246.js" rel="preload" as="script">
    <link href="https://hcaptcha.com/1/api.js?hl=en" rel="preload" as="script">

    <link rel="stylesheet" type="text/css" href="https://storage.perfectcdn.com/global/atg8oy6k63y60mi2.css">
    <link rel="stylesheet" type="text/css" href="https://storage.perfectcdn.com/ptbsev/9qy86h5pnta5hd3h.css">

    <div class="wrapper  wrapper-navbar ">
        <div id="block_56">
            <div class="block-wrapper">
                <div class="component_navbar ">
                    <div class="component-navbar__wrapper ">
                        <div
                            class="sidebar-block__top component-navbar component-navbar__navbar-public editor__component-wrapper ">
                            <div>
                                <nav class="navbar navbar-expand-lg navbar-light container-lg ">
                                    <div class="navbar-public__header">
                                        <div class="sidebar-block__top-brand">
                                            <a href="{{ route('signup') }}"
                                                class="component-navbar-brand component-navbar-public-brand">
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
                                                    <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public "
                                                        href="{{ route('login') }}"><i
                                                            class="navbar-icon fas fa-sign-in-alt"></i>
                                                        Sign in</a>
                                                </li>
                                                <li
                                                    class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                                    <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public "
                                                        href="/services"><i class="navbar-icon fas fa-store-alt"></i>
                                                        Services</a>
                                                </li>
                                                <li
                                                    class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                                    <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public "
                                                        href="/api"><i class="navbar-icon fas fa-code"></i> API</a>
                                                </li>
                                                <li
                                                    class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                                    <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public {{ request()->routeIs('signup') ? 'component-navbar-nav-link-active__navbar-public' : '' }}"
                                                        href="{{ route('signup') }}"><i
                                                            class="navbar-icon fas fa-user-plus"></i>
                                                        Sign up</a>
                                                </li>
                                                <li
                                                    class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                                    <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public "
                                                        href="/blog"><i class="navbar-icon fab fa-blogger-b"></i>
                                                        Blog</a>
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
            <div class="component_navbar"></div>
        </div>
        <div class="wrapper-content">
            <div class="wrapper-content__header">
            </div>
            <div class="wrapper-content__body">
                <!-- Main variables *content* -->
                <div id="block_74">
                    <div class="block-bg"></div>
                    <div class="container">
                        <div class="sign-in">
                            <div class="row sign-up-center-alignment">
                                <div class="col-lg-8">
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

                                            <form action="{{ route('signup.store') }}" method="POST">
                                                @csrf
                                                <div>
                                                    <div class="component_form_group">
                                                        <div class="form-group">
                                                            <label for="name" class="control-label">Họ và
                                                                tên</label>
                                                            <input type="text" class="form-control" id="name"
                                                                value="{{ old('name') }}" name="name"
                                                                placeholder="Nhập họ và tên" required>
                                                        </div>
                                                    </div>
                                                    <div class="component_form_group">
                                                        <div class="form-group">
                                                            <label for="username" class="control-label">Tên đăng
                                                                nhập</label>
                                                            <input type="text" class="form-control" id="username"
                                                                value="{{ old('username') }}" name="username"
                                                                placeholder="Nhập tên đăng nhập" required>
                                                        </div>
                                                    </div>
                                                    <div class="component_form_group">
                                                        <div class="form-group">
                                                            <label for="email" class="control-label">Email</label>
                                                            <input type="email" class="form-control" id="email"
                                                                value="{{ old('email') }}" name="email"
                                                                placeholder="Nhập địa chỉ email" required>
                                                        </div>
                                                    </div>
                                                    <div class="component_form_group">
                                                        <div class="form-group">
                                                            <label for="password" class="control-label">Mật
                                                                khẩu</label>
                                                            <input type="password" class="form-control"
                                                                id="password" name="password"
                                                                placeholder="Nhập mật khẩu" required>
                                                        </div>
                                                    </div>
                                                    <div class="component_form_group">
                                                        <div class="form-group">
                                                            <label for="password_confirmation"
                                                                class="control-label">Xác nhận mật khẩu</label>
                                                            <input type="password" class="form-control"
                                                                id="password_confirmation"
                                                                name="password_confirmation"
                                                                placeholder="Nhập lại mật khẩu" required>
                                                        </div>
                                                    </div>
                                                    <div class="component_form_group">
                                                        <div class="form-group">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="agree_terms" name="agree_terms" required>
                                                                <label class="form-check-label" for="agree_terms">
                                                                    Tôi đồng ý với <a href="/terms"
                                                                        target="_blank">điều khoản sử dụng</a>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="component_button_submit">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-block btn-big-primary"
                                                            <span class="btn-text">Đăng ký</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="text-center">Đã có tài khoản? <a
                                                        href="{{ route('login') }}"
                                                        class="sign-up-center-signin-link">Đăng nhập ngay</a></div>
                                            </form>
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
                                <p class="text-center"><span style="text-align: CENTER">© Copyright. All Rights
                                        Reserved.</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Notifications wrapper -->
    <div id="notify-wrapper" class="alert alert-success mb-3 hidden" style="display: none;"></div>

    <script async="" defer="" src="https://cdn.jsdelivr.net/npm/altcha@2/dist/altcha.min.js" type="module"></script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/wxsqj274j2fljwqh.js"></script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/ueokzc34y7ofrqqg.js"></script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/nfjxywl5k0s161d5.js"></script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/3u30z1np32rdiw54.js"></script>
    <script type="text/javascript" src="https://hcaptcha.com/1/api.js?hl=en"></script>
    <script type="text/javascript">
        window.modules.user_app_show_config = [];
    </script>
    <script type="text/javascript"></script>
</body>

</html>
