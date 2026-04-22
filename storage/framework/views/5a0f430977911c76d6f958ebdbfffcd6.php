<div id="kt_app_footer" class="app-footer">
    <!--begin::Footer container-->
    <div class="app-container container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
        <!--begin::Copyright-->
        <div class="text-gray-900 order-2 order-md-1">
            <span class="text-muted fw-semibold me-1">2026 ©</span>
            <a href="https://smmkay.com" target="_blank" class="text-gray-800 text-hover-primary">Smmkay.com:
                Cheapest SMM Services Provider in Vietnam.</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
            <li class="menu-item">
                <a href="/" target="_blank" class="menu-link px-2">Home</a>
            </li>
            <li class="menu-item">
                <a href="/terms" target="_blank" class="menu-link px-2">Term</a>
            </li>
            <li class="menu-item">
                <a href="/faqs" target="_blank" class="menu-link px-2">FAQs</a>
            </li>
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Footer container-->
</div> <!--end::Footer-->
</div>
</div>
<!--end::Container-->
</div>
<!--end::Page-->
</div>
<!--end::Root-->
<!--begin::Drawers-->


<!--end::Drawers-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <i class="ki-duotone ki-arrow-up">
        <span class="path1"></span>
        <span class="path2"></span>
    </i>
</div>
<!--end::Scrolltop-->
<!--begin::Javascript-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('a');
        const currentDomain = window.location.hostname;

        links.forEach(function(link) {
            const linkDomain = new URL(link.href).hostname,
                href = link.getAttribute('href');

            if (linkDomain !== currentDomain && href != 'javascript:;' && href != '') {
                link.href = '/anonym?url=' + encodeURIComponent(link.href);
            }
        });
    });
</script>
<script>
    var LANGUAGE = <?php echo json_encode($langData ?? [], 15, 512) ?>;

    // Resolve key từ data-lang attribute
    // Hỗ trợ 3 format:
    //   "menu::New order"  → thử LANGUAGE["menu::New order"] rồi LANGUAGE["menu.new_order"]
    //   "addfunds.pay_now" → LANGUAGE["addfunds.pay_now"]
    //   "Pay Now"          → LANGUAGE["Pay Now"]
    function resolveLang(raw) {
        if (LANGUAGE[raw] !== undefined) return LANGUAGE[raw];
        // Format section::key → thử section.snake_case
        if (raw.includes('::')) {
            var parts = raw.split('::');
            var snake = parts[0] + '.' + parts[1].toLowerCase().replace(/\s+/g, '_').replace(/[^a-z0-9_&.]/g, '');
            if (LANGUAGE[snake] !== undefined) return LANGUAGE[snake];
        }
        return raw;
    }

    document.querySelectorAll('[data-lang]').forEach(function(el) {
        var raw = el.getAttribute('data-lang') || el.innerText;
        var value = resolveLang(raw);
        if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
            if (el.hasAttribute('value')) el.value = value;
            else if (el.hasAttribute('placeholder')) el.setAttribute('placeholder', value);
        } else {
            el.innerHTML = value;
        }
    });
</script>
<script async="" src="https://www.googletagmanager.com/gtag/js?id=G-EYDFWT3TGZ"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-EYDFWT3TGZ');
</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="<?php echo e(asset('cdn.whoispanel.com/dashboard/5/plugins/global/plugins.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('cdn.whoispanel.com/dashboard/5/js/scripts.bundle.js')); ?>"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="<?php echo e(asset('cdn.whoispanel.com/dashboard/5/plugins/custom/datatables/datatables.bundle.js')); ?>"></script>
<!--end::Vendors Javascript-->
<!-- <script src="https://kit.fontawesome.com/706d20f321.js" crossorigin="anonymous"></script> -->
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script src="<?php echo e(asset('assets/app.js')); ?>"></script>
<script src="<?php echo e(asset('assets/client/dashboard.js')); ?>"></script>
<script>
    typeof _new !== 'undefined' && typeof _new.init !== 'undefined' && _new.init();
</script>
<script src="<?php echo e(asset('js/loader.js')); ?>"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
<div class="daterangepicker ltr single opensright">
    <div class="ranges"></div>
    <div class="drp-calendar left single" style="display: block;">
        <div class="calendar-table"></div>
        <div class="calendar-time"></div>
    </div>
    <div class="drp-calendar right" style="display: none;">
        <div class="calendar-table"></div>
        <div class="calendar-time"></div>
    </div>
    <div class="drp-buttons"><span class="drp-selected"></span><button class="cancelBtn btn btn-sm btn-default"
            type="button">Cancel</button><button class="applyBtn btn btn-sm btn-primary" disabled="disabled"
            type="button">Apply</button> </div>
</div>
</body><!--end::Body-->
</html>
<?php /**PATH C:\xampp\htdocs\resources\views/clients/theme-4/layouts/footer.blade.php ENDPATH**/ ?>