<div class="toolbar d-flex flex-stack flex-wrap mb-5 mb-lg-7" id="kt_toolbar">
    <div class="page-title d-flex flex-column py-1">
        <h1 class="d-flex align-items-center my-1">
            <span class="text-gray-900 fw-bold fs-1"><?php echo e($toolbarTitle ?? ''); ?></span>
        </h1>
    </div>
    <div class="d-flex align-items-center py-2 gap-2">
        <div class="d-flex align-items-center">
            <a href="/addfunds" class="btn btn-primary btn-sm fw-bold fs-4 ls-2 py-1">
                <?php echo e($formattedBalance ?? '0'); ?>

            </a>
        </div>
        <div class="d-flex align-items-center">
            <a href="/settings">
                <span class="rounded-1 fi fi-<?php echo e(langToFlag(auth()->user()->lang ?? 'en')); ?>"
                    style="font-size: 2.2em !important;"></span>
            </a>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\resources\views/clients/theme-4/layouts/toolbar.blade.php ENDPATH**/ ?>