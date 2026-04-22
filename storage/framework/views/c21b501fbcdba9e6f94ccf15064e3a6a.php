<html lang="<?php echo e(Auth::user()->lang ?? 'en'); ?>" data-bs-theme="light">
<script>
    (function() {
        var t = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', t);
    })();
</script>

<head>
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e($config->title ?? ''); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="shortcut icon" href="https://smmkay.com/assets/media/favicon.ico?1729818471">

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700">
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="<?php echo e(asset('cdn.whoispanel.com/dashboard/5/plugins/custom/datatables/datatables.bundle.css')); ?>"
        rel="stylesheet">

    <link href="<?php echo e(asset('cdn.whoispanel.com/dashboard/5/plugins/custom/jstree/jstree.bundle.css')); ?>" rel="stylesheet">

    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="https://cdn.whoispanel.com/dashboard/5/plugins/global/plugins.bundle.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo e(asset('cdn.whoispanel.com/dashboard/5/css/style.bundle.css')); ?>" rel="stylesheet">

    <!--end::Global Stylesheets Bundle-->
    <link href="https://cdn.whoispanel.com/flags/css/flag-icons.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/metronic.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/custom.css')); ?>" rel="stylesheet">
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

    <?php echo $__env->yieldPushContent('styles'); ?>


    
    <script>
        var ROLE = <?php echo e($user->role ?? 0); ?>,
            CURRENCY_ID = <?php echo e($currency->id ?? 1); ?>,
            CURRENCY_ICON = '<?php echo e($currency->symbol ?? '$'); ?>',
            CURRENCY_SYMBOL = '<?php echo e($currency->code ?? 'USD'); ?>',
            CURRENCY_RATE = <?php echo e($currency->exchange_rate ?? 1); ?>,
            TIME_ZONE = <?php echo e($config->timezone ?? 0); ?>,
            USERNAME = '<?php echo e($user->username ?? ''); ?>',
            NEWS = 0;
        window.currentCurrencySymbol = '<?php echo e($currency->symbol ?? '$'); ?>';
        window.symbolPosition = '<?php echo e($currency->symbol_position ?? 'before'); ?>';
    </script>

</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-enabled">
    

    <style>
        /* ===== PROMO MODAL (SCOPED) ===== */
        #pm-modal.pm-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(4px);
            z-index: 9999;

            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;

            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }

        #pm-modal.pm-show {
            opacity: 1;
            pointer-events: auto;
        }

        #pm-modal .pm-box {
            max-width: 420px;
            width: 100%;
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transform: translateY(-20px) scale(0.95);
            transition: all 0.3s ease;
        }

        #pm-modal.pm-show .pm-box {
            transform: translateY(0) scale(1);
        }

        #pm-modal .pm-img {
            position: relative;
        }

        #pm-modal .pm-img img {
            width: 100%;
            display: block;
        }

        #pm-modal .pm-close {
            position: absolute;
            top: 10px;
            right: 12px;
            font-size: 22px;
            color: #fff;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.4);
            padding: 2px 8px;
            border-radius: 50%;
        }

        #pm-modal .pm-content {
            padding: 20px;
            text-align: center;
        }

        #pm-modal h2 {
            color: #ff3b3b;
            margin-bottom: 8px;
        }

        #pm-modal .pm-big {
            font-size: 20px;
            font-weight: bold;
        }

        #pm-modal .pm-big span {
            color: #16a34a;
            font-size: 24px;
        }

        #pm-modal .pm-desc {
            font-size: 14px;
            color: #555;
            margin: 8px 0;
        }

        #pm-modal .pm-note {
            font-size: 13px;
            color: #777;
            margin-bottom: 15px;
        }

        #pm-modal .pm-btn {
            display: block;
            padding: 12px;
            background: linear-gradient(45deg, #0068ff, #00c6ff);
            color: #fff;
            border-radius: 10px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.25s;
        }

        #pm-modal .pm-btn:hover {
            transform: scale(1.05);
        }
    </style>

    

    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-column flex-column-fluid">
            <?php echo $__env->make('clients.theme-4.layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <?php echo $__env->make('clients.theme-4.layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\resources\views/clients/theme-4/layouts/app.blade.php ENDPATH**/ ?>