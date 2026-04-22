<?php $__env->startSection('title', 'Tickets'); ?>
<?php $__env->startSection('content'); ?>

<script>
function ticketUpdateStatus(type, id, status) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    if (typeof showFullScreenLoader === 'function') {
        showFullScreenLoader(window.tr ? window.tr('Updating...') : 'Đang cập nhật...', 'body');
    }

    fetch('/admin/tickets/update-status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ type, id, status })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            ticketReloadTable();
        } else {
            if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
            if (typeof showToast === 'function') showToast(window.tr ? window.tr('Update failed!') : 'Cập nhật thất bại!', 'error');
        }
    })
    .catch(() => {
        if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
        if (typeof showToast === 'function') showToast(window.tr ? window.tr('An error occurred!') : 'Có lỗi xảy ra!', 'error');
    });
}

function ticketReloadTable() {
    fetch(window.location.pathname, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'text/html'
        }
    })
    .then(res => res.text())
    .then(html => {
        const doc = new DOMParser().parseFromString(html, 'text/html');

        const newCard = doc.querySelector('.div-ticket-table')?.innerHTML;
        if (newCard) {
            document.querySelector('.div-ticket-table').innerHTML = newCard;
        }

        const newStats = doc.querySelector('.div-ticket-stats')?.innerHTML;
        if (newStats) {
            document.querySelector('.div-ticket-stats').innerHTML = newStats;
        }

        if (typeof KTMenu !== 'undefined') KTMenu.createInstances();
        if (typeof t === 'function') t();
    })
    .catch(console.error)
    .finally(() => {
        if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
    });
}
</script>

<div class="content flex-row-fluid" id="kt_content">
    <div class="d-flex flex-wrap flex-stack mb-6 div-ticket-stats">
        <h3 class="fw-bold my-2">
            <span><span data-lang="Waiting">Đang chờ</span>: <?php echo e($stats['waiting']); ?></span> |
            <span class="text-primary"><span data-lang="Processing">Đang xử lý</span>: <?php echo e($stats['processing']); ?></span>
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm div-ticket-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-row-bordered fs-7 gx-0">
                            <?php $__empty_1 = true; $__currentLoopData = $ticketOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $providerId => $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tbody>
                                
                                <tr>
                                    <td colspan="7" class="fs-5 fw-bolder ls-1">
                                        <i class="fa-solid fa-house me-1"></i>
                                        <?php echo e($orders->first()->provider_name ?? 'Manual'); ?>

                                        <button type="button" class="btn btn-secondary btn-sm fs-7 py-1 px-2 ms-3"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                            <span data-lang="Action">Tùy chọn</span>
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                        </button>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-150px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" onclick="ticketUpdateStatus(0, <?php echo e($providerId ?? 0); ?>, 'processing')"
                                                    class="menu-link px-3" data-lang="Processing">Đang xử lý</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" onclick="ticketUpdateStatus(0, <?php echo e($providerId ?? 0); ?>, 'completed')"
                                                    class="menu-link px-3" data-lang="Done">Hoàn thành</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                
                                <?php $__currentLoopData = $orders->groupBy('service_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceId => $serviceOrders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="7" class="fs-6 fw-bold">
                                        <i class="fa fa-crosshairs ps-10 me-1"></i>
                                        <?php echo e($serviceOrders->first()->service_name ?? 'Manual'); ?>

                                        <button type="button" class="btn btn-secondary btn-sm fs-7 py-1 px-2 ms-3"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                            <span data-lang="Action">Tùy chọn</span>
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                        </button>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-150px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" onclick="ticketUpdateStatus(1, <?php echo e($serviceId ?? 0); ?>, 'processing')"
                                                    class="menu-link px-3" data-lang="Processing">Đang xử lý</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" onclick="ticketUpdateStatus(1, <?php echo e($serviceId ?? 0); ?>, 'completed')"
                                                    class="menu-link px-3" data-lang="Done">Hoàn thành</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <?php $__currentLoopData = $serviceOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="ps-20">
                                        <a href="javascript:;" onclick="_tickets && _tickets.on && _tickets.on.click.history(<?php echo e($order->id); ?>)"
                                            data-bs-toggle="tooltip" title="Lịch sử yêu cầu">
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                        </a>
                                        <a target="_blank" class="fw-bold text-hover-primary ms-2"
                                            href="/admin/orders?id=<?php echo e($order->id); ?>"><?php echo e($order->id); ?></a>
                                    </td>
                                    <td>
                                        <?php
                                            $ticketBadges = [
                                                'speedup'  => ['class' => 'badge-primary', 'lang' => 'Speed up',  'label' => 'Tăng tốc'],
                                                'refill'   => ['class' => 'badge-info',    'lang' => 'Refill',    'label' => 'Bảo hành'],
                                                'cancel'   => ['class' => 'badge-warning', 'lang' => 'Cancel',    'label' => 'Hủy'],
                                                'canceled' => ['class' => 'badge-warning', 'lang' => 'Cancel',    'label' => 'Hủy'],
                                            ];
                                            $badge = $ticketBadges[$order->ticket] ?? ['class' => 'badge-secondary', 'lang' => $order->ticket, 'label' => $order->ticket];
                                        ?>
                                        <span class="badge badge-outline <?php echo e($badge['class']); ?>" data-lang="<?php echo e($badge['lang']); ?>"><?php echo e($badge['label']); ?></span>
                                    </td>
                                    <td>
                                        <a target="_blank" class="text-gray-800"
                                            href="/admin/accounts/<?php echo e($order->username); ?>"><?php echo e($order->username); ?></a>
                                    </td>
                                    <td data-bs-toggle="tooltip" title="Created">
                                        <span><?php echo e($order->created_at); ?></span>
                                        <span class="fst-italic">(<?php echo e(\Carbon\Carbon::parse($order->created_at)->diffForHumans()); ?>)</span>
                                    </td>
                                    <td data-bs-toggle="tooltip" title="Updated">
                                        <span><?php echo e($order->updated_at); ?></span>
                                        <span class="fst-italic">(<?php echo e(\Carbon\Carbon::parse($order->updated_at)->diffForHumans()); ?>)</span>
                                    </td>
                                    <td>
                                        <?php if(($order->ticket_status ?? null) === 'processing'): ?>
                                            <span class="badge badge-light-primary fw-bold" data-lang="Processing">Đang xử lý</span>
                                        <?php elseif(($order->ticket_status ?? null) === 'completed'): ?>
                                            <span class="badge badge-light-success fw-bold" data-lang="Done">Hoàn thành</span>
                                        <?php else: ?>
                                            <span class="badge badge-light-secondary fw-bold">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-secondary btn-sm fs-7 py-1 px-2"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                            <span data-lang="Action">Tùy chọn</span>
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                        </button>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-150px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" onclick="ticketUpdateStatus(2, <?php echo e($order->id); ?>, 'processing')"
                                                    class="menu-link px-3" data-lang="Processing">Đang xử lý</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" onclick="ticketUpdateStatus(2, <?php echo e($order->id); ?>, 'completed')"
                                                    class="menu-link px-3" data-lang="Done">Hoàn thành</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tbody>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-10">
                                        <span data-lang="No orders waiting">Không có đơn hàng nào đang chờ xử lý</span>
                                    </td>
                                </tr>
                            </tbody>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal-history-ticket">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" data-lang="History request">Lịch sử yêu cầu</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-row-bordered gx-0">
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                <th>#</th>
                                <th data-lang="Request">Yêu cầu</th>
                                <th data-lang="Created">Created</th>
                                <th data-lang="Updated">Updated</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminpanel.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/adminpanel/ticket/index.blade.php ENDPATH**/ ?>