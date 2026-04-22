<html lang="vi" data-bs-theme="light">

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
    <base href="">
    <title id="page-title" data-lang="">@yield('title') | {{ $config->title ?? getDomain() }}</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="canonical" href="">
    <link rel="shortcut icon" href="/assets/media/favicon.ico?1729818471">
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700">
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('adminpanel/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('adminpanel/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css">
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('adminpanel/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('adminpanel/css/style.bundle.css') }}" rel="stylesheet" type="text/css">
    <!--end::Global Stylesheets Bundle-->
    <link href="https://cdn.whoispanel.com/flags/css/flag-icons.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('adminpanel/assets/style.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ asset('adminpanel/css/select2-flags.css') }}" rel="stylesheet" type="text/css"> --}}
    <style>
        .form-control:focus,
        .input-group-text:focus {
            box-shadow: none;
        }

        .fullscreen-loader-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.42);
            backdrop-filter: blur(3px);
            z-index: 9998;
            animation: fadeIn 0.3s ease-in-out;
        }

        .fullscreen-loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            animation: slideUp 0.5s ease-out;
        }

        .fullscreen-loader-overlay.d-none,
        .fullscreen-loader.d-none {
            display: none !important;
        }

        .fullscreen-loader-overlay.fade-out,
        .fullscreen-loader.fade-out {
            animation: fadeOut 0.3s ease-in-out forwards;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-extended header-fixed header-tablet-and-mobile-fixed" style="">
    <!--begin::Navbar Loading Indicator-->
    <div class="navbar-loading" id="navbarLoading"></div>
    <!--end::Navbar Loading Indicator-->

    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--::Header-->
                @include('adminpanel.layouts.header')
                @php $pageTitle = $__env->yieldContent('title', ''); @endphp
                @include('adminpanel.layouts.toolbar')
                <!--::Toolbar-->

                <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                    <!--begin::Post-->
                    @yield('content')
                    <!--end::Post-->
                </div>
                <!--end::Container-->
                <!--begin::Footer-->
                @include('adminpanel.layouts.footer')

                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('adminpanel/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('adminpanel/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('adminpanel/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.10.27/interact.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('adminpanel/js/services/quill-editor.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/app.js') }}?v=14.9.0.6"></script>

    <script src="{{ asset('js/loader.js') }}"></script>
    <script src="{{ asset('js/toast.js') }}"></script>
    <script src="{{ asset('js/language.js') }}"></script>

    <script>
        const t = () => {
            let l = (document.documentElement.lang || 'en')[0] == 'v' ? LANGUAGE.language : LANGUAGE.core;
            const tr = k => Object.values(l).find(i => i[k])?.[k] || k;
            window.tr = tr;

            document.querySelectorAll('[data-lang]').forEach(e => {
                let k = e.dataset.lang;
                if (!k || k.trim() === '') k = e.textContent.trim();
                const v = tr(k);
                if (e.tagName === 'SELECT') {
                    if (e.hasAttribute('data-placeholder')) e.setAttribute('data-placeholder', v);
                } else if (e.tagName === 'OPTION') {
                    e.textContent = v;
                } else if (e.tagName === 'INPUT' || e.tagName === 'TEXTAREA') {
                    if (e.hasAttribute('placeholder')) e.setAttribute('placeholder', v);
                    else e.value = v;
                } else {
                    // If element has child elements (e.g. button with icon), only update first text node
                    const firstTextNode = Array.from(e.childNodes).find(n => n.nodeType === 3 && n.textContent.trim());
                    if (firstTextNode && e.children.length > 0) {
                        firstTextNode.textContent = firstTextNode.textContent.replace(firstTextNode.textContent.trim(), v);
                    } else {
                        e.textContent = v;
                    }
                }
            });

            if (window.jQuery && window.jQuery.fn.select2) {
                jQuery('[data-control="select2"], [data-kt-select2="true"]').each(function() {
                    const $el = jQuery(this);
                    const placeholder = this.getAttribute('data-placeholder') || '';
                    const hideSearch = this.getAttribute('data-hide-search') === 'true';
                    const allowClear = this.getAttribute('data-allow-clear') === 'true';
                    const minSearch = this.getAttribute('data-minimum-results-for-search');

                    if ($el.data('select2')) {
                        $el.select2('destroy');
                    }
                    $el.select2({
                        placeholder: placeholder,
                        allowClear: allowClear,
                        minimumResultsForSearch: hideSearch ? Infinity : (minSearch ? parseInt(minSearch) : 5),
                        width: '100%',
                    });
                });

                // Reinit select2 cho các select thường (không dùng data-control) có option[data-lang]
                jQuery('select:not([data-control="select2"]):not([data-kt-select2="true"])').each(function() {
                    if (this.querySelector('option[data-lang]') && jQuery(this).data('select2')) {
                        const val = jQuery(this).val();
                        jQuery(this).select2('destroy').select2({ width: '100%' }).val(val).trigger('change');
                    }
                });
            }
        };
        document.addEventListener('DOMContentLoaded', () => setTimeout(t, 800));
        window.tr = k => k; // fallback until t() runs
        const o = app.on.click.changeLanguage;
        app.on.click.changeLanguage = async l => (document.documentElement.lang = l, t(), o(l));
        
        // Handle page title translation
        function updatePageTitle() {
            const titleEl = document.getElementById('page-title');
            if (titleEl && titleEl.textContent) {
                const titleText = titleEl.textContent.split(' | ')[0].trim();
                const translated = tr(titleText);
                if (translated !== titleText) {
                    const siteName = titleEl.textContent.split(' | ')[1] || '';
                    titleEl.textContent = translated + (siteName ? ' | ' + siteName : '');
                }
            }
        }
        
        // Update title after translation
        const originalT = window.t;
        window.t = function() {
            originalT();
            updatePageTitle();
        };
    </script>

    <!-- Toast Container -->
    <div id="toastr-container" class="toastr-bottom-center"></div>


    <div class="daterangepicker ltr show-ranges opensright">
        <div class="ranges">
            <ul>
                <li data-range-key="Hôm nay">Hôm nay</li>
                <li data-range-key="Hôm qua">Hôm qua</li>
                <li data-range-key="7 ngày gần nhất">7 ngày gần nhất</li>
                <li data-range-key="30 ngày gần nhất">30 ngày gần nhất</li>
                <li data-range-key="Tháng này">Tháng này</li>
                <li data-range-key="Tháng trước">Tháng trước</li>
                <li data-range-key="Lựa chọn">Lựa chọn</li>
            </ul>
        </div>
        <div class="drp-calendar left">
            <div class="calendar-table"></div>
            <div class="calendar-time" style="display: none;"></div>
        </div>
        <div class="drp-calendar right">
            <div class="calendar-table"></div>
            <div class="calendar-time" style="display: none;"></div>
        </div>
        <div class="drp-buttons"><span class="drp-selected"></span><button class="cancelBtn btn btn-sm btn-default"
                type="button">Hủy</button><button class="applyBtn btn btn-sm btn-primary" disabled="disabled"
                type="button">Áp dụng</button> </div>
    </div>

</body>

</html>
