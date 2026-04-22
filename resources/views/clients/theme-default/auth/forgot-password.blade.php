<!DOCTYPE html>
<html id="theme_{{ $config->interface_default ?? 'default' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    style="height: 100%;">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quên mật khẩu - {{ $config->title ?? 'Panel' }}</title>
    <meta name="format-detection" content="telephone=no">

    <link rel="shortcut icon" type="image/ico" href="https://storage.perfectcdn.com/ptbsev/el8cc6e7wkjx3kxy.ico">
    <link rel="stylesheet" type="text/css" href="https://storage.perfectcdn.com/global/b4rxa0pklsh0lw5q.css">
    <link rel="stylesheet" type="text/css" href="https://storage.perfectcdn.com/ptbsev/iuos9mpiak6cw8rt.css">

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

        {{-- Navbar --}}
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
                                            <a href="{{ route('login') }}">
                                                @if ($config?->logo)
                                                    <img src="{{ $config->logo }}" alt="{{ $config->title ?? 'Logo' }}"
                                                        style="max-height: 40px; width: auto;">
                                                @else
                                                    <p><span
                                                            style="text-transform:uppercase;letter-spacing:1.7px;font-size:24px">
                                                            <strong>{{ $config->title ?? 'LOGO' }}</strong>
                                                        </span></p>
                                                @endif
                                            </a>
                                        </div>
                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                            data-target="#navbar-collapse-fp" aria-controls="navbar-collapse-fp"
                                            aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-burger"><span class="navbar-burger-line"></span></span>
                                        </button>
                                    </div>
                                    <div class="navbar-collapse collapse" id="navbar-collapse-56" style="">
                                        <div class="component-navbar-collapse-divider"></div>
                                        <div class="d-flex component-navbar-collapse">
                                            <ul class="navbar-nav">
                                                <li
                                                    class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                                    <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public "
                                                        href="/"><i class="navbar-icon fas fa-sign-in-alt"></i>
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
                                                    <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public "
                                                        href="/signup"><i class="navbar-icon fas fa-user-plus"></i> Sign
                                                        up</a>
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
        </div>

        {{-- Content --}}
        <div class="wrapper-content">
            <div class="wrapper-content__body">
                <!-- Main variables *content* -->
                <div id="block_45">
                    <div class="block-bg"></div>
                    <div class="container-fluid">
                        <div class="reset-password-form">
                            <div class="row reset-password-form__alignment">
                                <div class="col-lg-4">
                                    <div class="component_card">
                                        <div class="card">
                                            <form method="post" action="">
                                                <div class="component_form_group">
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label for="email" class="control-label">Email</label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="ResetPasswordForm[email]">
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="_csrf"
                                                        value="sD1vFOyIm_iZAx3amuUBXm2cUL7N33FEFRaME77xEyrlSkJhutzckvRsS4Xok0oRA8wdzLe9FTFcWt5V2oRSQw==">
                                                    <div class="component_button_submit">
                                                        <div class="">
                                                            <button type="submit"
                                                                class="btn btn-block btn-big-primary">Send</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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

    <script type="text/javascript" src="https://storage.perfectcdn.com/global/wxsqj274j2fljwqh.js"></script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/ueokzc34y7ofrqqg.js"></script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/nfjxywl5k0s161d5.js"></script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/3u30z1np32rdiw54.js"></script>
    <script type="text/javascript">
        window.modules.user_app_show_config = [];
    </script>
    <script type="text/javascript"></script>
</body>

</html>
