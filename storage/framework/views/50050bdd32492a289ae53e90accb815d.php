<?php $__env->startSection('title', 'Orders'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .table-orders td {
            line-height: 1.5;
        }

        .wrap {
            word-break: break-all;
            overflow-wrap: anywhere;
        }

        #table-orders td:nth-child(2) {
            max-width: 260px;
            min-width: 120px;
        }
    </style>
    <div class="content flex-column-fluid" id="kt_content">
        <?php echo $__env->make('clients.theme-4.layouts.toolbar', ['toolbarTitle' => 'Orders'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="post" id="kt_post">
            
            <div class="card mb-4">
                <div class="card-body py-3 px-4">
                    <div class="row g-2 align-items-center">
                        
                        <div class="col-12 col-md-2">
                            <select id="sl-status" class="form-select form-select-sm form-select-solid">
                                <option value="" data-url="<?php echo e(route('clients.orders.index')); ?>" data-lang="orders.all_status">All status</option>
                                <?php $__currentLoopData = ['pending', 'processing', 'inprogress', 'completed', 'partial', 'canceled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($s); ?>" data-url="<?php echo e(route('clients.orders.status', $s)); ?>"
                                        data-lang="status::<?php echo e($s); ?>"
                                        <?php echo e(request()->segment(2) === $s ? 'selected' : ''); ?>>
                                        <?php echo e(ucfirst($s)); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        
                        <div class="col-12 col-md-3">
                            <div class="input-group input-group-sm input-group-solid">
                                <span class="input-group-text">
                                    <div class="form-check form-check-custom form-check-sm">
                                        <input class="form-check-input w-15px h-15px cb-date" type="checkbox"
                                            <?php echo e(request('start') || request('end') ? 'checked' : ''); ?>>
                                    </div>
                                </span>
                                <input type="text" class="form-control ipt-date" readonly
                                    value="<?php echo e(request('start') && request('end') ? request('start') . ' - ' . request('end') : ''); ?>"
                                    placeholder="<?php echo e(now()->format('Y/m/01')); ?> - <?php echo e(now()->format('Y/m/d')); ?>">
                            </div>
                        </div>

                        
                        <div class="col-12 col-md-2">
                            <select id="sl-type" class="form-select form-select-sm form-select-solid">
                                <option value="0" data-lang="orders.search_type">Search type</option>
                                <option value="1" data-lang="orders.order_id_type" <?php echo e(request('type') === '1' ? 'selected' : ''); ?>>Order ID</option>
                                <option value="2" data-lang="orders.link_type" <?php echo e(request('type') === '2' ? 'selected' : ''); ?>>Link</option>
                                <option value="3" data-lang="orders.service_id_type" <?php echo e(request('type') === '3' ? 'selected' : ''); ?>>Service ID</option>
                            </select>
                        </div>

                        
                        <div class="col-12 col-md-4">
                            <div class="input-group input-group-sm input-group-solid">
                                <input type="text" id="ipt-keyword" class="form-control"
                                    placeholder="Keyword" data-lang="orders.keyword"
                                    value="<?php echo e(request('keyword')); ?>">
                                <button type="button" class="btn btn-primary btn-sm" id="btn-search"
                                    data-lang="orders.search_btn">Search</button>
                            </div>
                        </div>
                        <div class="col-12 col-md-1">
                            <button type="button" class="btn btn-sm btn-info w-100"
                                onclick="_orders.on.click.export()" data-lang="orders.export">Export</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end mb-2">
                <a class="text-muted fst-italic fs-8 text-hover-primary" href="/orders_old">
                    * <span data-lang="orders.access_older">Access older data</span>
                </a>
            </div>

            
            <div class="card card-orders border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table
                            class="table table-striped table-orders table-row-bordered table-row-gray-200 gs-3 gy-2 gx-2 fs-7 mb-0"
                            id="table-orders">
                            <tbody>
                                
                                <tr>
                                    <th colspan="10">
                                        <div class="form-check form-check-custom form-check-sm">
                                            <input class="form-check-input h-15px w-15px cb-all" type="checkbox"
                                                onchange="_orders.on.change.cbselectallOrder(this.checked)">
                                            <label class="ms-3 fs-7 count-selected"></label>
                                            <button class="btn btn-primary btn-sm px-2 py-1 ms-4 btn-action" type="button"
                                                onclick="_orders.on.click.bulkAction('Copy ID')" style="display:none"
                                                data-lang="orders.copy_id">Copy ID</button>
                                            <button class="btn btn-info btn-sm px-2 py-1 ms-2 btn-action" type="button"
                                                onclick="_orders.on.click.bulkAction('Refill')"
                                                style="display:none">Refill</button>
                                        </div>
                                    </th>
                                </tr>

                                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="bg-lighten">
                                        <td width="1" class="text-nowrap ps-3">
                                            <div class="form-check form-check-custom form-check-sm">
                                                <input class="form-check-input h-15px w-15px cb-select" type="checkbox"
                                                    onchange="_orders.on.change.cbselectOrder(this.checked)"
                                                    value="<?php echo e($order->id); ?>">
                                                <span class="ms-2 fw-bolder ls-1"><?php echo e($order->id); ?></span>
                                            </div>
                                            <p class="m-0 fw-bolder
                                                <?php echo e($order->status === 'completed' ? 'text-success' :
                                                  ($order->status === 'canceled'   ? 'text-danger'  :
                                                  ($order->status === 'partial'    ? 'text-primary' :
                                                  ($order->status === 'processing' ? 'text-warning' :
                                                  (in_array($order->status, ['inprogress', 'in_progress']) ? 'text-info' : 'text-gray-600'))))); ?>">
                                                <?php
                                                    $displayStatus = match($order->status) {
                                                        'failed'      => 'pending',
                                                        'in_progress' => 'In progress',
                                                        'inprogress'  => 'In progress',
                                                        default       => $order->status,
                                                    };
                                                ?>
                                                <span class="text-uppercase"
                                                    data-lang="status::<?php echo e($displayStatus); ?>"><?php echo e($displayStatus); ?></span>
                                            </p>
                                            <p class="m-0 fs-8 text-gray-500"><?php echo e($order->created_at); ?></p>
                                            <p class="m-0 fs-8 text-gray-500"><?php echo e($order->updated_at); ?></p>
                                            <button class="btn btn-danger hover-scale fs-9 px-2 py-0 mt-1"
                                                onclick="_orders.on.click.showModalReport(<?php echo e($order->id); ?>)">Report</button>
                                        </td>

                                        <td>
                                            <div class="d-flex flex-column">
                                                <p class="m-0 text-gray-700">
                                                    <?php
                                                        $svcImg = $order->service->image ?? $order->service->category->image ?? null;
                                                        $svcIsUrl = $svcImg && (str_contains($svcImg, '/') || str_contains($svcImg, '.'));
                                                    ?>
                                                    <?php if($svcImg && $svcIsUrl): ?>
                                                        <img src="<?php echo e($svcImg); ?>" alt="" class="w-20px h-20px rounded-1 me-1" style="object-fit:cover;vertical-align:middle">
                                                    <?php elseif($svcImg): ?>
                                                        <i class="<?php echo e($svcImg); ?> me-1"></i>
                                                    <?php else: ?>
                                                        <i class="fa-solid fa-star text-warning me-1 fs-9"></i>
                                                    <?php endif; ?>
                                                    <span class="text-gray-900 fw-bold"><?php echo e($order->service_id); ?></span>
                                                    <?php if($order->service_name !== '—'): ?>
                                                        <span class="text-muted ms-1">| <?php echo e($order->service_name); ?></span>
                                                    <?php endif; ?>
                                                </p>
                                                <p class="m-0 fs-7 fst-italic">
                                                    <a class="text-gray-500 text-hover-primary" target="_blank"
                                                        href="<?php echo e($order->link); ?>"><?php echo e($order->link); ?></a>
                                                </p>
                                            </div>
                                        </td>


                                        <td width="1">
                                            <p class="m-0 fw-bold text-nowrap">
                                                <span class="text-gray-600 fw-normal fs-8" data-lang="orders.charge">Charge</span>:
                                                <a href="/cashflow?id=<?php echo e($order->id); ?>">
                                                    <span class="text-primary"><?php echo e($order->charge_display); ?></span>
                                                </a>
                                            </p>
                                            <p class="m-0 fw-bold text-nowrap">
                                                <span class="text-gray-600 fw-normal fs-8"
                                                    data-lang="orders.quantity">Quantity</span>:
                                                <?php echo e(number_format($order->quantity ?? 0)); ?>

                                            </p>
                                            <p class="m-0 fw-bold text-nowrap">
                                                <span class="text-gray-600 fw-normal fs-8" data-lang="orders.start_count">Start
                                                    count</span>: <?php echo e($order->start_count ?? 0); ?>

                                            </p>
                                            <p class="m-0 fw-bold text-nowrap">
                                                <span class="text-gray-600 fw-normal fs-8"
                                                    data-lang="orders.remains">Remains</span>: <?php echo e($order->remains ?? 0); ?>

                                            </p>
                                        </td>

                                        <td width="1">
                                            <div class="d-flex align-items-end flex-column text-nowrap">
                                                <div class="mb-auto d-flex flex-column">
                                                    <?php if($order->refill == 1 && $order->status === 'completed'): ?>
                                                        <button class="btn btn-info hover-scale fs-8 px-3 py-0 order-action-btn"
                                                            data-href="<?php echo e(route('clients.orders.refill', $order->id)); ?>"
                                                            data-action="refill"
                                                            data-lang="orders.request_refill">Request refill</button>
                                                    <?php endif; ?>
                                                    <?php if($order->cancel == 1 && !in_array($order->status, ['canceled', 'completed', 'partial'])): ?>
                                                        <button class="btn btn-warning hover-scale fs-8 px-3 py-0 mt-1 order-action-btn"
                                                            data-href="<?php echo e(route('clients.orders.cancel', $order->id)); ?>"
                                                            data-action="cancel"
                                                            data-lang="orders.request_cancel">Request cancel</button>
                                                    <?php endif; ?>
                                                    <a target="_blank"
                                                        class="btn btn-primary hover-scale fs-8 px-3 py-0 mt-1"
                                                        href="/new?service=<?php echo e($order->service_id); ?>"
                                                        data-lang="orders.reorder">Reorder</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-5">
                                            <i class="bi bi-inbox fs-2x d-block mb-2"></i>
                                            <span data-lang="orders.no_orders">No orders found</span>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    
                    <?php if($orders->hasPages()): ?>
                        <div class="d-flex justify-content-center py-4">
                            <?php echo e($orders->links()); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    
    <div class="modal fade" tabindex="-1" id="modal-ticket-order">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header py-3">
                    <h5 class="modal-title" data-lang="Report Order">Report Order</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-2"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="mb-5">
                        <label class="required form-label" data-lang="Order ID">Order ID</label>
                        <input type="text" class="form-control ipt-report-order-id" disabled>
                    </div>
                    <div class="mb-5">
                        <label class="required form-label" data-lang="Request">Request</label>
                        <select class="form-select form-select-solid sl-report-request" data-kt-select2="true" data-hide-search="true">
                            <option value="0" data-lang="Please choose">Please choose</option>
                            <option value="1" data-lang="Cancel">Cancel</option>
                            <option value="2" data-lang="Refill">Refill</option>
                            <option value="3" data-lang="Speed up">Speed up</option>
                        </select>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary w-100" id="btn-report-submit" data-lang="button::Request">Request</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var s2 = {
                escapeMarkup: function(m) {
                    return m;
                },
                minimumResultsForSearch: -1,
                templateResult: function(o) {
                    return o.text;
                },
                templateSelection: function(o) {
                    return o.text;
                },
                width: '100%'
            };
            $('#sl-status').select2(s2);
            $('#sl-type').select2(s2);

            // Status: navigate to /orders/{status}
            $('#sl-status').on('change', function() {
                var url = $(this).find(':selected').data('url');
                if (url) window.location.href = url;
            });

            // Date range picker
            (function initDatePicker() {
                if (window.jQuery?.fn?.daterangepicker && window.moment) {
                    jQuery(function($) {
                        const $dateInput = $('.ipt-date');
                        const $checkbox = $('.cb-date');

                        if (!$dateInput.length) return;

                        $dateInput.daterangepicker({
                            autoUpdateInput: false,
                            drops: 'down',
                            opens: 'left',
                            showDropdowns: true,
                            startDate: moment().startOf('month'),
                            endDate: moment().endOf('month'),
                            locale: {
                                format: 'YYYY/MM/DD',
                                separator: ' - ',
                                applyLabel: 'Áp dụng',
                                cancelLabel: 'Hủy',
                                customRangeLabel: 'Tùy chỉnh',
                                daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                                monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4',
                                    'Tháng 5', 'Tháng 6',
                                    'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11',
                                    'Tháng 12'
                                ],
                                firstDay: 1
                            },
                            ranges: {
                                'Hôm nay': [moment(), moment()],
                                'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1,
                                    'days')],
                                '30 ngày qua': [moment().subtract(29, 'days'), moment()],
                                'Tháng này': [moment().startOf('month'), moment().endOf(
                                    'month')],
                                'Tháng trước': [moment().subtract(1, 'month').startOf('month'),
                                    moment().subtract(1, 'month').endOf('month')
                                ]
                            }
                        });

                        // Khi chọn xong: chỉ cập nhật input, KHÔNG tự check checkbox
                        $dateInput.on('apply.daterangepicker', function(ev, picker) {
                            $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker
                                .endDate.format('YYYY/MM/DD'));
                        });

                        // Khi hủy: xóa input và uncheck
                        $dateInput.on('cancel.daterangepicker', function() {
                            $(this).val('');
                            $checkbox.prop('checked', false);
                        });

                        // Uncheck → xóa giá trị
                        $checkbox.on('change', function() {
                            if (!$(this).is(':checked')) $dateInput.val('');
                        });

                        // Mặc định: hiển thị "Tháng này" trong input nhưng KHÔNG check
                        <?php if(request('start') && request('end')): ?>
                            $dateInput.val('<?php echo e(request('start')); ?> - <?php echo e(request('end')); ?>');
                            $checkbox.prop('checked', true);
                        <?php else: ?>
                            $dateInput.val(moment().startOf('month').format('YYYY/MM/DD') + ' - ' +
                                moment().endOf('month').format('YYYY/MM/DD'));
                            $checkbox.prop('checked', false);
                        <?php endif; ?>
                    });
                } else {
                    setTimeout(initDatePicker, 100);
                }
            })();

            // Search button: navigate to /orders/search?type=&keyword=&start=&end=
            $('#btn-search').on('click', function() {
                var type = $('#sl-type').val();
                var keyword = $('#ipt-keyword').val().trim();
                var dateVal = $('.ipt-date').val().trim();
                var start = '',
                    end = '';

                if (dateVal && dateVal.includes(' - ')) {
                    var parts = dateVal.split(' - ');
                    start = parts[0].trim();
                    end = parts[1].trim();
                }

                var params = new URLSearchParams();
                if (type && type !== '0') params.set('type', type);
                if (keyword) params.set('keyword', keyword);
                if (start) params.set('start', start);
                if (end) params.set('end', end);

                window.location.href = '<?php echo e(route('clients.orders.search')); ?>?' + params.toString();
            });

            // Enter key on keyword input
            $('#ipt-keyword').on('keydown', function(e) {
                if (e.key === 'Enter') $('#btn-search').click();
            });
        });

        // Report Order modal
        const _reportModal = new bootstrap.Modal(document.getElementById('modal-ticket-order'));

        if (typeof _orders !== 'undefined') {
            _orders.on.click.showModalReport = function(orderId) {
                document.querySelector('.ipt-report-order-id').value = orderId;
                document.querySelector('.sl-report-request').value = '0';
                if (window.jQuery?.fn?.select2) {
                    jQuery('.sl-report-request').val('0').trigger('change');
                }
                _reportModal.show();
            };

            _orders.on.click.report = function(orderId, type) {
                if (!type || type === '0') {
                    alert(window.tr ? window.tr('Please choose') : 'Please choose a request type');
                    return;
                }
                document.getElementById('btn-report-submit').disabled = true;
                fetch(`/orders/${orderId}/report`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    body: JSON.stringify({ type })
                })
                .then(r => r.json())
                .then(data => {
                    document.getElementById('btn-report-submit').disabled = false;
                    if (data.success) {
                        _reportModal.hide();
                    } else {
                        alert(data.message || 'Error');
                    }
                })
                .catch(() => { document.getElementById('btn-report-submit').disabled = false; });
            };
        }

        document.getElementById('btn-report-submit')?.addEventListener('click', function() {
            const orderId = document.querySelector('.ipt-report-order-id').value;
            const type = document.querySelector('.sl-report-request').value;
            _orders.on.click.report(orderId, type);
        });

        // Init select2 for report modal
        if (window.jQuery?.fn?.select2) {
            jQuery('.sl-report-request').select2({
                minimumResultsForSearch: -1,
                width: '100%',
                dropdownParent: jQuery('#modal-ticket-order')
            });
        }

        // Handle order-action-btn (cancel / refill)
        document.addEventListener('click', function(e) {
            var btn = e.target.closest('.order-action-btn');
            if (!btn) return;

            var href   = btn.getAttribute('data-href');
            var action = btn.getAttribute('data-action');
            if (!href) return;

            var isCancel = action === 'cancel';
            var msg = isCancel
                ? (window.tr ? window.tr('orders.confirm_cancel') : 'Are you sure to request a CANCEL to this order?')
                : (window.tr ? window.tr('orders.confirm_refill') : 'Are you sure to request a REFILL to this order?');

            var modal = document.getElementById('modal-order-confirm');
            modal.querySelector('.modal-body').textContent = msg;
            modal.querySelector('.modal-header').className = 'modal-header py-4 ' + (isCancel ? 'bg-warning' : 'bg-info') + ' text-white';

            var bsModal = new bootstrap.Modal(modal);
            bsModal.show();

            modal.querySelector('#btn-order-confirm-ok').onclick = function() {
                bsModal.hide();
                btn.disabled = true;
                fetch(href, {
                    method: 'GET',
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.status === 'success') {
                        btn.textContent = data.btn_text || (isCancel ? 'Canceled' : 'Refilled');
                        btn.classList.remove('btn-warning', 'btn-info');
                        btn.classList.add('btn-secondary');
                        btn.disabled = true;
                    } else {
                        btn.disabled = false;
                        alert(data.message || 'Error');
                    }
                })
                .catch(() => { btn.disabled = false; });
            };
        });
    </script>

    
    <div class="modal fade" tabindex="-1" id="modal-order-confirm" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered rounded-4">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white py-4">
                    <h4 class="modal-title text-white ls-1" data-lang="Confirm">Confirm</h4>
                </div>
                <div class="modal-body py-10 fs-4">Are you sure?</div>
                <div class="modal-footer py-4">
                    <button type="button" class="btn btn-sm btn-secondary px-4 rounded-4"
                        data-bs-dismiss="modal" data-lang="Cancel">Cancel</button>
                    <button type="button" class="btn btn-sm btn-warning px-4 rounded-4"
                        id="btn-order-confirm-ok" data-lang="Agree">Agree</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('clients.theme-4.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/clients/theme-4/orders/index.blade.php ENDPATH**/ ?>