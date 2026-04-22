<!DOCTYPE html>
<html lang="en" class="light" bbai-tooltip-injected="true">

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
    <title>New order</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" type="image/ico" href="">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <style>
        .integration-fixed {
            position: fixed;
            z-index: 10000000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 24px;
            row-gap: 12px;
        }

        .integration-fixed__top-left {
            top: 0;
            left: 0;
        }

        .integration-fixed__top-right {
            top: 0;
            right: 0;
        }

        .integration-fixed__bottom-left {
            bottom: 0;
            left: 0;
        }

        .integration-fixed__bottom-right {
            bottom: 0;
            right: 0;
        }
    </style>


    {{-- jQuery --}}
    <link rel="preload" as="script" href="{{ asset('template/js/jquery.min.js') }}">

    {{-- Global scripts --}}
    <link rel="preload" as="script" href="{{ asset('template/js/fgks9m94k0nhqmix.js') }}">
    <link rel="preload" as="script" href="{{ asset('template/js/8gmoznjnttfyk1mz.js') }}">
    <link rel="preload" as="script" href="{{ asset('template/js/w8l498eitwhkze7w.js') }}">
    <link rel="preload" as="script" href="{{ asset('template/js/jq8derbjf313z5ai.js') }}">
    <link rel="preload" as="script" href="{{ asset('template/js/0ud5szi4ocdmm9ep.js') }}">

    {{-- Page specific --}}
    <link rel="preload" as="script" href="{{ asset('template/js/kmrhwytcnx2ms6up.js') }}">
    <link rel="preload" as="script" href="{{ asset('template/js/os8r133zojpct6tf.js') }}">


    <link rel="stylesheet" href="{{ asset('template/css/799gyfk7eg5l8i4w.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/3rt3fg7g92zrs6k4.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/bootstrap-datetimepicker.min.css') }}">

    <link rel="stylesheet" href="https://storage.perfectcdn.com/css/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('template/css/w1ak29btsbdhu8s0.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/cao32di3zo8u7xgq.css') }}">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/default.min.css">
    <link rel="stylesheet" media="screen"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">


    <script>
        window.modules = {};
        var htmlcontent = document.querySelector("html");

        function colorApp() {
            let getmode = localStorage.getItem("lightMode") || "dark";
            if (getmode === "auto") {
                let isDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches;
                htmlcontent.setAttribute("class", isDarkMode ? "dark" : "light");
            } else {
                htmlcontent.setAttribute("class", getmode);
            }
        }

        colorApp();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
    
    {{-- Custom Header Scripts --}}
    <style>
        .files-wrapper {
            display: flex;
            flex-direction: column;
            line-height: 29px;
        }

        .files-item {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            line-height: 29px;
        }

        .files-item:last-child {
            margin-bottom: 0px;
        }

        .files-loader {
            margin: 0 0.2em 0 0;
            padding: 0;
            line-height: 0;
            vertical-align: middle;
            font-size: 24px;
            display: flex;
            align-items: center;
            min-height: 29px;

        }

        .files-loader__svg {
            display: block;
            width: 1em;
            height: 1em;
            fill: transparent;
            transform: rotate(180deg);
            margin: 0px 8px;
        }

        .files-loader__svg-circle {
            fill: transparent;
        }

        .files-loader__svg-progress {
            transition: all 0.4s;
        }
    </style>
    <style data-jss="" data-meta="MuiDialog">
        @media print {
            .MuiDialog-root {
                position: absolute !important;
            }
        }

        .MuiDialog-scrollPaper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .MuiDialog-scrollBody {
            overflow-x: hidden;
            overflow-y: auto;
            text-align: center;
        }

        .MuiDialog-scrollBody:after {
            width: 0;
            height: 100%;
            content: "";
            display: inline-block;
            vertical-align: middle;
        }

        .MuiDialog-container {
            height: 100%;
            outline: 0;
        }

        @media print {
            .MuiDialog-container {
                height: auto;
            }
        }

        .MuiDialog-paper {
            margin: 32px;
            position: relative;
            overflow-y: auto;
        }

        @media print {
            .MuiDialog-paper {
                box-shadow: none;
                overflow-y: visible;
            }
        }

        .MuiDialog-paperScrollPaper {
            display: flex;
            max-height: calc(100% - 64px);
            flex-direction: column;
        }

        .MuiDialog-paperScrollBody {
            display: inline-block;
            text-align: left;
            vertical-align: middle;
        }

        .MuiDialog-paperWidthFalse {
            max-width: calc(100% - 64px);
        }

        .MuiDialog-paperWidthXs {
            max-width: 444px;
        }

        @media (max-width:507.95px) {
            .MuiDialog-paperWidthXs.MuiDialog-paperScrollBody {
                max-width: calc(100% - 64px);
            }
        }

        .MuiDialog-paperWidthSm {
            max-width: 600px;
        }

        @media (max-width:663.95px) {
            .MuiDialog-paperWidthSm.MuiDialog-paperScrollBody {
                max-width: calc(100% - 64px);
            }
        }

        .MuiDialog-paperWidthMd {
            max-width: 960px;
        }

        @media (max-width:1023.95px) {
            .MuiDialog-paperWidthMd.MuiDialog-paperScrollBody {
                max-width: calc(100% - 64px);
            }
        }

        .MuiDialog-paperWidthLg {
            max-width: 1280px;
        }

        @media (max-width:1343.95px) {
            .MuiDialog-paperWidthLg.MuiDialog-paperScrollBody {
                max-width: calc(100% - 64px);
            }
        }

        .MuiDialog-paperWidthXl {
            max-width: 1920px;
        }

        @media (max-width:1983.95px) {
            .MuiDialog-paperWidthXl.MuiDialog-paperScrollBody {
                max-width: calc(100% - 64px);
            }
        }

        .MuiDialog-paperFullWidth {
            width: calc(100% - 64px);
        }

        .MuiDialog-paperFullScreen {
            width: 100%;
            height: 100%;
            margin: 0;
            max-width: 100%;
            max-height: none;
            border-radius: 0;
        }

        .MuiDialog-paperFullScreen.MuiDialog-paperScrollBody {
            margin: 0;
            max-width: 100%;
        }
    </style>

    {{-- Custom Header Scripts --}}
     {!! $config->script_header ?? '' !!}
</head>

<body id="dash" class="">
    {{-- Custom Body Scripts --}}
   {!! $config->script_body ?? '' !!}
    
    <div class="app">
        @include('clients.theme-default.layouts.menu')
        <div class="sidebar-overlay"></div>
        @include('clients.theme-default.layouts.header')

        @yield('content')
    </div>

    @include('clients.theme-default.layouts.footer')
</body>

</html>
