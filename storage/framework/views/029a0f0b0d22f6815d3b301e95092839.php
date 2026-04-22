
<?php $__env->startSection('title', 'Orders'); ?>
<?php $__env->startSection('content'); ?>
    <style>
        .table-orders td {
            line-height: 1.5;
        }
    </style>
    <div class="content flex-row-fluid" id="kt_content" unresolved>
        <div class="card shadow">
            <div class="card-body p-5">
                <div class="div-filter-status">
                    <div class="mb-3">
                        <a href="javascript:;"
                            class="btn btn-sm btn-outline btn-outline- px-3 py-1 me-3 <?php echo e(!$status ? 'active' : ''); ?>"
                            onclick="filterStatus('All')"><span data-lang="status::All">Tất cả</span></a>
                        <a href="javascript:;"
                            class="btn btn-sm btn-outline btn-outline- px-3 py-1 me-3 <?php echo e($status === 'manual' ? 'active' : ''); ?>"
                            onclick="filterStatus('Manual')"><span data-lang="status::Manual">Thủ công</span> <?php if($manualCount > 0): ?>
                                <span class="badge badge-circle badge-secondary ms-1"><?php echo e($manualCount); ?></span>
                            <?php endif; ?>
                        </a>
                        <a href="javascript:;"
                            class="btn btn-sm btn-outline btn-outline-warning px-3 py-1 me-3 <?php echo e($status === 'failed' ? 'active' : ''); ?>"
                            onclick="filterStatus('Failed')"><span data-lang="status::Failed">Thất bại</span> <?php if($failedCount > 0): ?>
                                <span class="badge badge-circle badge-warning ms-1"><?php echo e($failedCount); ?></span>
                            <?php endif; ?>
                        </a>
                        <a href="javascript:;"
                            class="btn btn-sm btn-outline btn-outline-secondary text-gray-500 px-3 py-1 me-3 <?php echo e($status === 'awaiting' ? 'active' : ''); ?>"
                            onclick="filterStatus('Awaiting')"><span data-lang="status::Awaiting">Đang chờ</span></a>
                        <a href="javascript:;"
                            class="btn btn-sm btn-outline btn-outline-danger px-3 py-1 me-3 <?php echo e($status === 'ticket' ? 'active' : ''); ?>"
                            onclick="filterStatus('Ticket')"><span data-lang="status::Ticket">Hỗ trợ</span></a>
                    </div>
                    <div class="mb-3">
                        <a href="javascript:;"
                            class="btn btn-sm btn-outline btn-outline-secondary text-gray-600 px-3 py-1 me-3 <?php echo e($status === 'pending' ? 'active' : ''); ?>"
                            onclick="filterStatus('Pending')"><span data-lang="status::Pending">Chờ xử lý</span></a>
                        <a href="javascript:;"
                            class="btn btn-sm btn-outline btn-outline-primary px-3 py-1 me-3 <?php echo e($status === 'processing' ? 'active' : ''); ?>"
                            onclick="filterStatus('Processing')"><span data-lang="status::Processing">Đang xử lý</span></a>
                        <a href="javascript:;"
                            class="btn btn-sm btn-outline btn-outline-info px-3 py-1 me-3 <?php echo e($status === 'inprogress' ? 'active' : ''); ?>"
                            onclick="filterStatus('In progress')"><span data-lang="status::In progress">Đang chạy</span></a>
                        <a href="javascript:;"
                            class="btn btn-sm btn-outline btn-outline-success px-3 py-1 me-3 <?php echo e($status === 'completed' ? 'active' : ''); ?>"
                            onclick="filterStatus('Completed')"><span data-lang="status::Completed">Hoàn thành</span></a>
                        <a href="javascript:;"
                            class="btn btn-sm btn-outline btn-outline-danger px-3 py-1 me-3 <?php echo e($status === 'partial' ? 'active' : ''); ?>"
                            onclick="filterStatus('Partial')"><span data-lang="status::Partial">Hoàn tiền một phần</span></a>
                        <a href="javascript:;"
                            class="btn btn-sm btn-outline btn-outline-warning px-3 py-1 me-3 <?php echo e($status === 'canceled' ? 'active' : ''); ?>"
                            onclick="filterStatus('Canceled')"><span data-lang="status::Canceled">Hủy</span></a>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-lg-2 col-md-6 col-6">
                        <input type="text"
                            class="form-control form-control-solid form-control-sm ipt-order-id datatable-input"
                            placeholder="Order ID" data-lang="Order ID" data-col-name="order_id"
                            value="<?php echo e($searchParams['order_id'] ?? ''); ?>">
                    </div>
                    <div class="col-lg-2 col-md-6 col-6">
                        <input type="text"
                            class="form-control form-control-solid form-control-sm ipt-orders-api datatable-input"
                            placeholder="Provider Order ID" data-lang="Provider Order ID" data-col-name="orders_api"
                            value="<?php echo e($searchParams['orders_api'] ?? ''); ?>">
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="input-group input-group-solid input-group-sm">
                            <span class="input-group-text">
                                <div class="form-check form-check-solid form-check-custom form-check-sm">
                                    <input class="form-check-input w-15px h-15px cb-link" type="checkbox"
                                        onchange="_orders.on.change.link(this.checked) ">
                                </div>
                            </span>
                            <input type="text"
                                class="form-control form-control-solid form-control-sm ipt-link datatable-input"
                                placeholder="Link-exact" data-lang="Link-exact" data-col-name="order_link"
                                value="<?php echo e($searchParams['link'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <button type="button" class="btn btn-primary btn-sm me-2" onclick="filter()" data-lang="Search">Tìm
                            kiếm</button>
                        <button type="button" class="btn btn-sm btn-secondary"
                            onclick="document.querySelector('.div-advanced-search').style.display = ''"
                            data-lang="button::Advanced">Nâng cao</button>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="resetFilter()"
                            data-lang="Reset">Thiết lập lại</button>
                    </div>
                    <div class="col-lg-12 div-advanced-search" style="display: none;">
                        <div class="row g-3">
                            <div class="col-lg-2 col-md-6 col-6">
                                <div class="input-group input-group-solid input-group-sm">
                                    <span class="input-group-text">
                                        <div class="form-check form-check-solid form-check-custom form-check-sm">
                                            <input class="form-check-input w-15px h-15px cb-date" type="checkbox"
                                                <?php echo e(!empty($searchParams['date_from']) ? 'checked' : ''); ?>>
                                        </div>
                                    </span>
                                    <input class="form-control datatable-input ipt-date" data-col-name="date_range"
                                        placeholder="Chọn khoảng thời gian" data-lang="Select date range" readonly>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-6">
                                <select class="form-select form-select-solid form-select-sm datatable-input sl-account"
                                    data-control="select2" data-col-name="user_id" name="user_id"
                                    data-placeholder="All accounts" data-lang="All accounts" data-allow-clear="true">
                                    <option value="" <?php echo e(empty($searchParams['user_id']) ? 'selected' : ''); ?>></option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>"
                                            <?php echo e($searchParams['user_id'] == $user->id ? 'selected' : ''); ?>>
                                            <?php echo e($user->username); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6">
                                <select class="form-select form-select-solid form-select-sm datatable-input sl-service"
                                    data-control="select2" data-col-name="service_id" name="service_id"
                                    data-placeholder="All services" data-lang="All services" data-allow-clear="true">
                                    <option value="" <?php echo e(empty($searchParams['service_id']) ? 'selected' : ''); ?>></option>
                                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($service['id']); ?>"
                                            <?php echo e($searchParams['service_id'] == $service['id'] ? 'selected' : ''); ?>>
                                            <?php echo e($service['id']); ?> - <?php echo e($service['name']); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-6 col-6">
                                <select class="form-select form-select-solid form-select-sm datatable-input sl-provider"
                                    data-control="select2" data-col-name="provider_id" name="provider_id"
                                    data-placeholder="All" data-lang="All" data-allow-clear="true">
                                    <option value="" <?php echo e(empty($searchParams['provider_id']) ? 'selected' : ''); ?>></option>
                                    <option value="manual"
                                        <?php echo e($searchParams['provider_id'] == 'manual' ? 'selected' : ''); ?>>Tất cả đơn thủ
                                        công</option>
                                    <option value="all_providers"
                                        <?php echo e($searchParams['provider_id'] == 'all_providers' ? 'selected' : ''); ?>>Tất cả nhà
                                        cung cấp</option>
                                    <?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($provider->id); ?>"
                                            <?php echo e($searchParams['provider_id'] == $provider->id ? 'selected' : ''); ?>>
                                            <?php echo e($provider->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack">
            <h3 class="fw-bold my-2"></h3>
            <div class="d-flex flex-wrap my-2">
                <div class="text-end switch-text current">
                    <p class="fst-italic fw-semibold p-2 mb-0"><a href="javascript:;"
                            onclick="switchOrderDiv('div-table-orders-old')" data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            data-bs-original-title="*Truy cập dữ liệu cũ hơn"
                            data-kt-initialized="1">* <span data-lang="note-order">Truy cập dữ liệu cũ hơn</span></a></p>
                </div>
                <div class="text-end switch-text old" style="display: none;">
                    <p class="fst-italic fw-semibold p-2 mb-0"><a href="javascript:;"
                            onclick="switchOrderDiv('div-table-orders')" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-original-title="Quay lại danh sách các đơn hàng hiện tại"
                            data-kt-initialized="1">*
                            <span data-lang="note-order-2">Quay lại danh sách hiện tại</span></a></p>
                </div>
            </div>
        </div>

        <div class="card shadow-sm div-orders">
            <div class="card-body p-5 card-orders" id="div-table-orders">
                <div class="d-flex">
                    <div class="form-check form-check-custom form-check-sm form-check-solid"><input
                            class="form-check-input h-15px w-15px cb-all" type="checkbox"
                            onchange="cbSelectAll(this.checked)"></div>
                    <div class="checkall ms-5" style="display: none;">
                        <a href="#"
                            class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm py-1 px-2"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <span data-page="common" data-lang="Actions">Tùy chọn</span>
                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4"
                            data-kt-menu="true">
                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                data-kt-menu-placement="right-start">
                                <a href="javascript:;" class="menu-link px-3">
                                    <span class="menu-title" data-lang="Change status">Chuyển trạng thái 1</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="menu-sub menu-sub-dropdown py-4 w-200px">
                                    <div class="menu-item px-3"><a href="javascript:;" class="menu-link px-3"
                                            onclick="actionBulk('Change status', 'In progress')"
                                            data-lang="status::In progress">Đang chạy</a></div>
                                    <div class="menu-item px-3"><a href="javascript:;" class="menu-link px-3"
                                            onclick="actionBulk('Change status', 'Completed')"
                                            data-lang="status::Completed">Hoàn thành</a></div>
                                    <div class="menu-item px-3"><a href="javascript:;" class="menu-link px-3"
                                            onclick="actionBulk('Change status', 'Canceled')"
                                            data-lang="status::Canceled">Hủy</a></div>
                                </div>
                            </div>
                            <div class="separator my-2"></div>
                            <div class="menu-item px-3"><a href="javascript:;" class="menu-link px-3"
                                    onclick="actionBulk('Provider - Update Status')"
                                    data-lang="Provider - Update Status">Cập nhật trạng thái</a></div>

                            <div class="menu-item px-3"><a href="javascript:;" class="menu-link px-3"
                                    onclick="actionBulk('Send order')" data-lang="Provider - Send Order">Gửi lại đơn
                                    hàng</a></div>
                            <div class="separator my-2"></div>
                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                data-kt-menu-placement="right-start">
                                <a href="javascript:;" class="menu-link px-3">
                                    <span class="menu-title" data-lang="Copy">Sao chép</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="menu-sub menu-sub-dropdown p-3 w-200px">
                                    <div class="menu-item">
                                        <a href="javascript:;" onclick="actionBulk('Copy Order ID', '', false)"
                                            class="menu-link px-3" data-lang="">Mã đơn hàng</a>
                                        <a href="javascript:;" onclick="actionBulk('Copy Link', '', false)"
                                            class="menu-link px-3">Link</a>
                                        <a href="javascript:;" onclick="actionBulk('Copy Provider Order ID', '', false)"
                                            class="menu-link px-3" data-lang="">Mã đơn hàng NCC</a>
                                    </div>
                                </div>
                            </div>
                            <div class="separator my-2"></div>
                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                data-kt-menu-placement="right-start">
                                <a href="javascript:;" class="menu-link px-3">
                                    <span class="menu-title" data-lang="Tag - Add">Thêm yêu cầu</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="menu-sub menu-sub-dropdown p-3 w-200px">
                                    <div class="menu-item">
                                        <a href="javascript:;" onclick="actionBulk('Tag - Add', 'Cancel')"
                                            class="menu-link px-3" data-lang="ticket::Cancel">Yêu cầu hủy đơn hàng</a>
                                        <a href="javascript:;" onclick="actionBulk('Tag - Add', 'Refill')"
                                            class="menu-link px-3" data-lang="ticket::Refill">Yêu cầu bảo hành</a>
                                        <a href="javascript:;" onclick="actionBulk('Tag - Add', 'Speedup')"
                                            class="menu-link px-3" data-lang="ticket::Speedup">Yêu cầu tăng tốc</a>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-item px-3"><a href="javascript:;" class="menu-link px-3"
                                    onclick="actionBulk('Tag - Add', '')" data-lang="Tag - Clear">Xóa yêu
                                    cầu</a></div>
                            <div class="separator my-2"></div>
                            <div class="menu-item px-3"><a href="javascript:;" class="menu-link px-3"
                                    onclick="actionBulk('Total quantity', '', false)" data-lang="Stats">Thống kê</a></div>
                        </div>
                        <label class="ms-3 fs-7"></label>
                    </div>
                </div>
                <div class="table-responsive">
                    <div id="table-orders_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer"
                        style="position: relative;">
                        <div id="table-orders_processing" class="dt-processing card" role="status"
                            style="display: none;"><span
                                class="spinner-border w-15px h-15px text-muted align-middle me-2"></span>
                            <span class="text-gray-600">Loading...</span>
                            <div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                        <div id="" class="table-responsive">
                            <table class="table fs-7 gy-1 gx-2 gs-3 table-orders custom-table dataTable" id="table-orders"
                                aria-describedby="table-orders_info" style="width: 100%;">
                                <colgroup>
                                    <col data-dt-column="0" style="width: 32.25px;">
                                    <col data-dt-column="1" style="width: 108.547px;">
                                    <col data-dt-column="2" style="width: 146.438px;">
                                    <col data-dt-column="3" style="width: 154.797px;">
                                    <col data-dt-column="4" style="width: 459.469px;">
                                </colgroup>
                                <thead class="fs-6 fw-bold ">
                                    <tr class="bg-lighten d-none" role="row">
                                        <th data-dt-column="0" rowspan="1" colspan="1" class="dt-orderable-none"
                                            aria-label=""><span class="dt-column-title"></span><span
                                                class="dt-column-order"></span></th>
                                        <th data-dt-column="1" class="pt-2 text-nowrap dt-orderable-none" rowspan="1"
                                            colspan="1" aria-label="Status"><span
                                                class="dt-column-title">Status</span><span class="dt-column-order"></span>
                                        </th>
                                        <th data-dt-column="2" rowspan="1" colspan="1"
                                            class="dt-orderable-asc dt-orderable-desc dt-ordering-desc"
                                            aria-sort="descending" aria-label="ID: Activate to remove sorting"
                                            tabindex="0"><span class="dt-column-title" role="button">ID</span><span
                                                class="dt-column-order"></span></th>
                                        <th data-dt-column="3" class="text-nowrap dt-orderable-none" rowspan="1"
                                            colspan="1" aria-label="Stats"><span
                                                class="dt-column-title">Stats</span><span class="dt-column-order"></span>
                                        </th>
                                        <th data-dt-column="4" rowspan="1" colspan="1" class="dt-orderable-none"
                                            aria-label="Link"><span class="dt-column-title">Link</span><span
                                                class="dt-column-order"></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr data-order-id="<?php echo e($order->id); ?>">
                                            <td><label
                                                    class="form-check form-check-custom form-check-sm form-check-solid"><input
                                                        class="form-check-input h-15px w-15px cb-select" type="checkbox"
                                                        value="<?php echo e($order->id); ?>"
                                                        data-pid="<?php echo e($order->orders_api ?? 0); ?>"
                                                        onchange="cbSelect(this.checked)"></label></td>
                                            <td class="pt-2 text-nowrap">
                                                <?php
                                                    $statusClass = getOrderStatusClass($order->status);
                                                    $statusText = getOrderStatusText($order->status);
                                                    $statusLangMap = [
                                                        'pending'     => 'status::Pending',
                                                        'processing'  => 'status::Processing',
                                                        'in_progress' => 'status::In progress',
                                                        'completed'   => 'status::Completed',
                                                        'partial'     => 'status::Partial',
                                                        'canceled'    => 'status::Canceled',
                                                        'failed'      => 'status::Failed',
                                                        'awaiting'    => 'status::Awaiting',
                                                        'manual'      => 'status::Manual',
                                                    ];
                                                    $statusLangKey = $statusLangMap[$order->status] ?? ('status::' . ucfirst($order->status));
                                                ?>
                                                <button type="button"
                                                    class="btn btn-sm fs-7 py-1 px-2 action-<?php echo e($order->id); ?> <?php echo e($statusClass); ?>"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                                                    data-lang="<?php echo e($statusLangKey); ?>">
                                                    <?php echo e($statusText); ?>

                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                </button>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fs-7 w-200px py-4"
                                                    data-kt-menu="true">
                                                    <?php if($order->status !== 'canceled'): ?>
                                                        <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                            data-kt-menu-placement="right-start">
                                                            <a href="javascript:;" class="menu-link px-3">
                                                                <span class="menu-title" data-lang="Change status">Chuyển trạng thái</span>
                                                                <span class="menu-arrow"></span>
                                                            </a>
                                                            <div class="menu-sub menu-sub-dropdown py-4 w-200px">
                                                                <div class="menu-item">
                                                                    <?php if($order->status === 'failed'): ?>
                                                                        
                                                                        <?php if($order->status !== 'processing'): ?>
                                                                            <div class="menu-item px-3"><a
                                                                                    href="javascript:;"
                                                                                    onclick="updateOrderStatus('processing', '<?php echo e($order->id); ?>')"
                                                                                    class="menu-link px-3" data-lang="status::Processing">Đang xử lý</a>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <?php if($order->status !== 'canceled'): ?>
                                                                            <div class="menu-item px-3"><a
                                                                                    href="javascript:;"
                                                                                    onclick="updateOrderStatus('canceled', '<?php echo e($order->id); ?>')"
                                                                                    class="menu-link px-3" data-lang="status::Canceled">Hủy</a></div>
                                                                        <?php endif; ?>
                                                                    <?php elseif($order->status === 'pending'): ?>
                                                                        
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('processing', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::Processing">Đang xử lý</a></div>
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('in_progress', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::In progress">Đang chạy</a></div>
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('completed', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::Completed">Hoàn thành</a></div>
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('partial', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::Partial">Hoàn tiền một
                                                                                phần</a></div>
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('canceled', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::Canceled">Hủy</a></div>
                                                                    <?php elseif($order->status === 'processing'): ?>
                                                                        
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('in_progress', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::In progress">Đang chạy</a></div>
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('completed', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::Completed">Hoàn thành</a></div>
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('partial', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::Partial">Hoàn tiền một phần</a></div>
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('canceled', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::Canceled">Hủy</a></div>
                                                                    <?php elseif($order->status === 'in_progress'): ?>
                                                                        
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('completed', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::Completed">Hoàn thành</a></div>
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('partial', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::Partial">Hoàn tiền một phần</a></div>
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('canceled', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::Canceled">Hủy</a></div>
                                                                    <?php elseif($order->status === 'completed'): ?>
                                                                        
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('in_progress', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::In progress">Đang chạy</a></div>
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('partial', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::Partial">Hoàn tiền một phần</a></div>
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('canceled', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::Canceled">Hủy</a></div>
                                                                    <?php elseif($order->status === 'partial'): ?>
                                                                        
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('in_progress', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::In progress">Đang chạy</a></div>
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('completed', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::Completed">Hoàn thành</a></div>
                                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                                onclick="updateOrderStatus('canceled', '<?php echo e($order->id); ?>')"
                                                                                class="menu-link px-3" data-lang="status::Canceled">Hủy</a></div>
                                                                    <?php else: ?>
                                                                        
                                                                        <?php if($order->status !== 'pending'): ?>
                                                                            <div class="menu-item px-3"><a
                                                                                    href="javascript:;"
                                                                                    onclick="updateOrderStatus('pending', '<?php echo e($order->id); ?>')"
                                                                                    class="menu-link px-3" data-lang="status::Pending">Chờ xử lý</a>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <?php if($order->status !== 'processing'): ?>
                                                                            <div class="menu-item px-3"><a
                                                                                    href="javascript:;"
                                                                                    onclick="updateOrderStatus('processing', '<?php echo e($order->id); ?>')"
                                                                                    class="menu-link px-3" data-lang="status::Processing">Đang xử lý</a>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <?php if($order->status !== 'in_progress'): ?>
                                                                            <div class="menu-item px-3"><a
                                                                                    href="javascript:;"
                                                                                    onclick="updateOrderStatus('in_progress', '<?php echo e($order->id); ?>')"
                                                                                    class="menu-link px-3" data-lang="status::In progress">Đang chạy</a>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <?php if($order->status !== 'completed'): ?>
                                                                            <div class="menu-item px-3"><a
                                                                                    href="javascript:;"
                                                                                    onclick="updateOrderStatus('completed', '<?php echo e($order->id); ?>')"
                                                                                    class="menu-link px-3" data-lang="status::Completed">Hoàn thành</a>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <?php if($order->status !== 'partial'): ?>
                                                                            <div class="menu-item px-3"><a
                                                                                    href="javascript:;"
                                                                                    onclick="updateOrderStatus('partial', '<?php echo e($order->id); ?>')"
                                                                                    class="menu-link px-3" data-lang="status::Partial">Hoàn tiền một phần</a>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <?php if($order->status !== 'canceled'): ?>
                                                                            <div class="menu-item px-3"><a
                                                                                    href="javascript:;"
                                                                                    onclick="updateOrderStatus('canceled', '<?php echo e($order->id); ?>')"
                                                                                    class="menu-link px-3" data-lang="status::Canceled">Hủy</a></div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="separator my-2"></div>
                                                    <?php endif; ?>
                                                    <?php if($order->status === 'pending'): ?>
                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                onclick="addStartCount('<?php echo e($order->id); ?>')"
                                                                class="menu-link px-3" data-lang="Add Start Count">Thêm số lượng bắt đầu</a></div>
                                                        <div class="separator my-2"></div>
                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                onclick="changeStatusFromApi('<?php echo e($order->id); ?>')"
                                                                class="menu-link px-3" data-lang="Provider - Update Status">Cập nhật trạng thái</a></div>
                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                onclick="addProviderOrderID('<?php echo e($order->id); ?>')"
                                                                class="menu-link px-3" data-lang="Provider - Assign Order ID">Cập nhật mã đơn hàng NCC</a></div>
                                                        <div class="separator my-2"></div>
                                                    <?php elseif($order->status === 'processing'): ?>
                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                onclick="addStartCount('<?php echo e($order->id); ?>')"
                                                                class="menu-link px-3" data-lang="Add Start Count">Thêm số lượng bắt đầu</a></div>
                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                onclick="changeStatusFromApi('<?php echo e($order->id); ?>')"
                                                                class="menu-link px-3" data-lang="Provider - Update Status">Cập nhật trạng thái</a></div>
                                                        <div class="separator my-2"></div>
                                                    <?php elseif($order->status === 'in_progress'): ?>
                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                onclick="addStartCount('<?php echo e($order->id); ?>')"
                                                                class="menu-link px-3" data-lang="Add Start Count">Thêm số lượng bắt đầu</a></div>
                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                onclick="changeStatusFromApi('<?php echo e($order->id); ?>')"
                                                                class="menu-link px-3" data-lang="Provider - Update Status">Cập nhật trạng thái</a></div>
                                                        <div class="separator my-2"></div>
                                                    <?php elseif($order->status === 'completed'): ?>
                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                onclick="addNote('<?php echo e($order->id); ?>')"
                                                                class="menu-link px-3" data-lang="Add Note">Thêm ghi chú</a></div>
                                                        <div class="separator my-2"></div>
                                                    <?php elseif($order->status === 'partial'): ?>
                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                onclick="changeStatusFromApi('<?php echo e($order->id); ?>')"
                                                                class="menu-link px-3" data-lang="Provider - Update Status">Cập nhật trạng thái</a></div>
                                                        <div class="separator my-2"></div>
                                                    <?php elseif($order->status === 'failed'): ?>
                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                onclick="resendOrder('<?php echo e($order->id); ?>')"
                                                                class="menu-link px-3" data-lang="Provider - Send Order">Gửi lại đơn hàng</a></div>
                                                        <div class="menu-item px-3"><a href="javascript:;"
                                                                onclick="addProviderOrderID('<?php echo e($order->id); ?>')"
                                                                class="menu-link px-3" data-lang="Provider - Assign Order ID">Cập nhật mã đơn hàng NCC</a></div>
                                                        <div class="separator my-2"></div>
                                                    <?php endif; ?>
                                                    <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                        data-kt-menu-placement="right-start">
                                                        <a href="javascript:;" class="menu-link px-3">
                                                            <span class="menu-title" data-lang="Tag - Add">Thêm yêu cầu</span>
                                                            <span class="menu-arrow"></span>
                                                        </a>
                                                        <div class="menu-sub menu-sub-dropdown p-3 w-200px">
                                                            <div class="menu-item">
                                                                <a href="javascript:;"
                                                                    onclick="addTag(<?php echo e($order->id); ?>, 'Cancel')"
                                                                    class="menu-link px-3" data-lang="ticket::Cancel">Yêu cầu hủy đơn hàng</a>
                                                                <a href="javascript:;"
                                                                    onclick="addTag(<?php echo e($order->id); ?>, 'Refill')"
                                                                    class="menu-link px-3" data-lang="ticket::Refill">Yêu cầu bảo hành</a>
                                                                <a href="javascript:;"
                                                                    onclick="addTag(<?php echo e($order->id); ?>, 'Speedup')"
                                                                    class="menu-link px-3" data-lang="ticket::Speedup">Yêu cầu tăng tốc</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="menu-item px-3"><a href="javascript:;"
                                                            onclick="addTag(<?php echo e($order->id); ?>, '')"
                                                            class="menu-link px-3" data-lang="Tag - Clear">Xóa yêu cầu</a></div>
                                                </div>
                                                <?php if($order->status === 'failed' && $order->response_data): ?>
                                                    <?php
                                                        $data = is_string($order->response_data)
                                                            ? json_decode($order->response_data, true)
                                                            : $order->response_data;
                                                        $msg = $data['error'] ?? '';
                                                    ?>
                                                    <?php if($msg): ?>
                                                        <i class="bi bi-x-circle text-warning fs-5"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            aria-label="<?php echo e($msg); ?>"
                                                            data-bs-original-title="<?php echo e($msg); ?>"></i>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <p class="mt-2 mb-0"></p>
                                                <?php if($order->ticket): ?>
                                                    <?php
                                                        $ticket = [
                                                            'canceled' => ['text' => 'Hủy',      'badge' => 'badge-warning', 'lang' => 'Cancel'],
                                                            'speedup'  => ['text' => 'Tăng tốc', 'badge' => 'badge-primary', 'lang' => 'badge::Speedup'],
                                                            'refill'   => ['text' => 'Bảo hành', 'badge' => 'badge-info',    'lang' => 'badge::Refill'],
                                                        ];
                                                        $ticket = $ticket[$order->ticket] ?? [
                                                            'text'  => $order->ticket,
                                                            'badge' => 'badge-secondary',
                                                            'lang'  => $order->ticket,
                                                        ];
                                                    ?>
                                                    <p class="mt-1 mb-0"><a href="javascript:;"
                                                            onclick="historyTicket(<?php echo e($order->id); ?>)"><span
                                                                class="badge badge-outline border-dashed <?php echo e($ticket['badge']); ?> fs-9" data-lang="<?php echo e($ticket['lang']); ?>"><?php echo e($ticket['text']); ?>

                                                                <i
                                                                    class="fa-solid fa-clock-rotate-left fs-9 ms-2"></i></span></a>
                                                    </p>
                                                <?php endif; ?>
                                            </td>
                                            <td class="sorting_1">
                                                <p class="m-0 fw-bolder ls-1"><?php echo e($order->id); ?></p>
                                                <?php if($order->provider_name || $order->orders_api): ?>
                                                    <p class="m-0 text-gray-600 fs-7"><?php echo e(implode(' - ', array_filter([$order->provider_name, $order->orders_api]))); ?></p>
                                                <?php endif; ?>
                                                <?php if($order->note): ?>
                                                    <p class="m-0 text-gray-600 fs-7 d-flex"><span class="bd-highlight"><?php echo e($order->note); ?></span></p>
                                                <?php endif; ?>
                                                <p class="m-0 fs-8 text-gray-600"><span><?php echo e($order->created_at->format('Y-m-d H:i:s')); ?></span></p>
                                                <?php if($order->start_time): ?>
                                                    <p class="m-0 fs-8 text-gray-600"><span><?php echo e($order->start_time->format('Y-m-d H:i:s')); ?></span></p>
                                                <?php endif; ?>
                                                <?php if($order->updated_at): ?>
                                                    <p class="m-0 fs-8 text-gray-500"><span><?php echo e($order->updated_at->format('Y-m-d H:i:s')); ?></span></p>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-nowrap">
                                                <p class="m-0"><span class="text-gray-600 fs-8" data-lang="Charge">Số tiền:</span> <span
                                                        class="fw-bold"><?php echo e(formatCharge($order->charge ?? 0)); ?></span>
                                                    (<?php echo e(formatCharge($order->total ?? 0)); ?>)
                                                </p>

                                                <p class="m-0"><span class="text-gray-600 fs-8" data-lang="Quantity">Số lượng:</span> <span
                                                        class="fw-bold"><?php echo e($order->quantity); ?></span></p>
                                                <p class="m-0"><span class="text-gray-600 fs-8" data-lang="Start count">Số lượng ban
                                                        đầu:</span>
                                                    <span class="fw-bold"><?php echo e($order->start_count ?? 0); ?></span>
                                                </p>
                                                <p class="m-0"><span class="text-gray-600 fs-8" data-lang="Remains">Số lượng còn
                                                        lại:</span>
                                                    <span class="fw-bold"><?php echo e($order->remains ?? 0); ?></span>
                                                </p>
                                            </td>
                                            <td data-link="<?php echo e($order->link ?? ''); ?>">
                                                <p class="m-0 fw-bold">
                                                    <?php if($order->link): ?>
                                                        <a class="text-gray-900" target="_blank"
                                                            href="/anonym?url=<?php echo e(urlencode($order->link)); ?>"><?php echo e($order->link); ?></a>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </p>
                                                <?php if($order->service): ?>
                                                    <p class="m-0 fs-7"><a class="text-gray-600" target="_blank"
                                                            href="/admin/services/edit?id=<?php echo e($order->service_id); ?>"><?php echo e($order->service_id); ?>

                                                            | <span
                                                                class="fs-8"><?php echo e($order->service->getName('en')); ?></span></a>
                                                    </p>
                                                <?php endif; ?>

                                                <?php if($order->user): ?>
                                                    <p class="m-0 fs-8"><a class="text-gray-700 ls-1" target="_blank"
                                                            href="/admin/accounts/<?php echo e($order->user->username); ?>"><?php echo e($order->user->username); ?></a>
                                                        <?php if($order->provider_name): ?>
                                                            <span
                                                                class="badge badge-secondary fs-9 py-1 ms-1"><?php echo e($order->provider_name === 'manual' ? 'Manual' : 'API'); ?></span>
                                                        <?php endif; ?>
                                                    </p>
                                                <?php endif; ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div
                                class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <select name="table-orders_length"
                                            class="form-select form-select-solid form-select-sm w-80px"
                                            id="per-page-select" onchange="changePerPage(this.value)">
                                            <option value="50" <?php echo e(request('per_page') == 50 ? 'selected' : ''); ?>>50
                                            </option>
                                            <option value="100" <?php echo e(request('per_page') == 100 ? 'selected' : ''); ?>>100
                                            </option>
                                            <option value="200" <?php echo e(request('per_page') == 200 ? 'selected' : ''); ?>>200
                                            </option>
                                            <option value="500" <?php echo e(request('per_page') == 500 ? 'selected' : ''); ?>>500
                                            </option>
                                            <option value="1000" <?php echo e(request('per_page') == 1000 ? 'selected' : ''); ?>>
                                                1000</option>
                                        </select>
                                    </div>
                                    <div class="dt-info" aria-live="polite" id="table-orders_info" role="status">
                                        <span data-lang="Showing">Hiển thị</span> <?php echo e($orders->firstItem() ?? 0); ?> -
                                        <?php echo e($orders->lastItem() ?? 0); ?> /
                                        <?php echo e(number_format($orders->total())); ?>

                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end mt-3 mt-md-0">
                                <div class="dt-paging">
                                    <nav>
                                        <ul class="pagination">
                                            <?php if($orders->onFirstPage()): ?>
                                                <li class="page-item disabled">
                                                    <span class="page-link">
                                                        <i class="previous"></i>
                                                    </span>
                                                </li>
                                            <?php else: ?>
                                                <li class="page-item">
                                                    <a href="javascript:;"
                                                        onclick="goToPage(<?php echo e($orders->currentPage() - 1); ?>)"
                                                        class="page-link">
                                                        <i class="previous"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                            <?php
                                                $start = max(1, $orders->currentPage() - 2);
                                                $end = min($orders->lastPage(), $orders->currentPage() + 2);
                                            ?>

                                            <?php if($start > 1): ?>
                                                <li class="page-item">
                                                    <a href="javascript:;" onclick="goToPage(1)" class="page-link">1</a>
                                                </li>
                                                <?php if($start > 2): ?>
                                                    <li class="page-item disabled">
                                                        <span class="page-link">...</span>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <?php for($page = $start; $page <= $end; $page++): ?>
                                                <?php if($page == $orders->currentPage()): ?>
                                                    <li class="page-item active">
                                                        <span class="page-link"><?php echo e($page); ?></span>
                                                    </li>
                                                <?php else: ?>
                                                    <li class="page-item">
                                                        <a href="javascript:;" onclick="goToPage(<?php echo e($page); ?>)"
                                                            class="page-link">
                                                            <?php echo e($page); ?>

                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endfor; ?>

                                            <?php if($end < $orders->lastPage()): ?>
                                                <?php if($end < $orders->lastPage() - 1): ?>
                                                    <li class="page-item disabled">
                                                        <span class="page-link">...</span>
                                                    </li>
                                                <?php endif; ?>
                                                <li class="page-item">
                                                    <a href="javascript:;" onclick="goToPage(<?php echo e($orders->lastPage()); ?>)"
                                                        class="page-link">
                                                        <?php echo e($orders->lastPage()); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if($orders->hasMorePages()): ?>
                                                <li class="page-item">
                                                    <a href="javascript:;"
                                                        onclick="goToPage(<?php echo e($orders->currentPage() + 1); ?>)"
                                                        class="page-link">
                                                        <i class="next"></i>
                                                    </a>
                                                </li>
                                            <?php else: ?>
                                                <li class="page-item disabled">
                                                    <span class="page-link">
                                                        <i class="next"></i>
                                                    </span>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-5 card-orders-old" id="div-table-orders-old" style="display: none;">
                <div class="table-responsive">
                    <table class="table fs-7 gy-1 gs-3 table-orders custom-table" id="table-orders-old">
                        <thead class="fs-6 fw-bold ">
                            <tr class="bg-lighten d-none">
                                <th></th>
                                <th>Status</th>
                                <th>ID</th>
                                <th>Stats</th>
                                <th>Link</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-comments">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header py-3">
                        <h4 class="modal-title" data-lang="Comments">Nội dung</h4>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span class="svg-icon svg-icon-2x">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body p-0"></div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-history-ticket">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" data-page="/tickets" data-lang="History request">Lịch sử yêu cầu</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle table-row-bordered gx-0">
                                <thead></thead>
                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                    <th class="text-start">#</th>
                                    <th data-page="/tickets" data-lang="Request">Yêu cầu</th>
                                    <th data-page="/refill" data-lang="Created">Created</th>
                                    <th data-page="/refill" data-lang="Updated">Updated</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-copy" aria-labelledby="modal-copy-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex align-items-center">
                            <h4 class="modal-title" id="modal-copy-title" data-lang="Order ID">Mã đơn hàng</h4>
                            <button type="button" class="btn btn-outline btn-outline-primary btn-sm ms-2"
                                onclick="copyToClipboard()">Copy</button>
                        </div>
                    </div>

                    <div class="modal-body">
                        <textarea class="form-control" rows="20" readonly id="modal-copy-textarea"></textarea>
                    </div>
                </div>
            </div>
        </div>




        <script>
            var STATUS_ORDER = '',
                ORDER_ID_SEARCH = '',
                USER_SEARCH = '0',
                ROLE = 1,
                ROLE_PERMISSONS = [],
                LABEL_FEATURES = true;

            // Remove unresolved attribute when page fully loaded
            window.addEventListener('load', () => {
                setTimeout(() => {
                    const content = document.getElementById('kt_content');
                    if (content) {
                        content.removeAttribute('unresolved');
                    }
                }, 100);
            });

            // Helper functions for table loader
            function showTableLoader() {
                const loader = document.getElementById('table-orders_processing');
                const table = document.getElementById('table-orders');

                if (loader) {
                    loader.style.display = 'block';
                }
                if (table) {
                    table.style.opacity = '0.4';
                }
            }

            function hideTableLoader() {
                const loader = document.getElementById('table-orders_processing');
                const table = document.getElementById('table-orders');

                if (loader) {
                    loader.style.display = 'none';
                }
                if (table) {
                    table.style.opacity = '1';
                }
            }

            // Pagination functions
            window.goToPage = function(page) {
                if (typeof showFullScreenLoader === 'function') {
                    showFullScreenLoader(window.tr('Loading...'), 'body');
                }

                const getVal = selector => document.querySelector(selector)?.value?.trim();
                const fields = {
                    order_id: '.ipt-order-id',
                    orders_api: '.ipt-orders-api',
                    link: '.ipt-link',
                    user_id: '.sl-account',
                    service_id: '.sl-service',
                    provider_id: '.sl-provider'
                };

                const params = new URLSearchParams();
                params.append('page', page);

                const perPage = document.getElementById('per-page-select')?.value;
                if (perPage) params.append('per_page', perPage);

                Object.entries(fields).forEach(([key, selector]) => {
                    const val = getVal(selector);
                    if (val) params.append(key, val);
                });

                const dateCheckbox = document.querySelector('.cb-date');
                const dateRange = getVal('.ipt-date');
                if (dateCheckbox?.checked && dateRange && dateRange.includes(' - ')) {
                    const [dateFrom, dateTo] = dateRange.split(' - ');
                    params.append('date_from', dateFrom.trim());
                    params.append('date_to', dateTo.trim());
                }

                fetch(window.location.pathname + '?' + params, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        const newContent = new DOMParser()
                            .parseFromString(html, 'text/html')
                            .querySelector('.div-orders')?.innerHTML;

                        if (newContent) {
                            document.querySelector('.div-orders').innerHTML = newContent;
                            if (typeof KTMenu !== 'undefined') {
                                KTMenu.createInstances();
                            }
                        }
                    })
                    .catch(console.error)
                    .finally(() => {
                        if (typeof hideFullScreenLoader === 'function') {
                            hideFullScreenLoader();
                        }
                    });
            };

            window.changePerPage = function(perPage) {
                if (typeof showFullScreenLoader === 'function') {
                    showFullScreenLoader(window.tr('Loading...'), 'body');
                }

                const getVal = selector => document.querySelector(selector)?.value?.trim();
                const fields = {
                    order_id: '.ipt-order-id',
                    orders_api: '.ipt-orders-api',
                    link: '.ipt-link',
                    user_id: '.sl-account',
                    service_id: '.sl-service',
                    provider_id: '.sl-provider'
                };

                const params = new URLSearchParams();
                params.append('per_page', perPage);

                Object.entries(fields).forEach(([key, selector]) => {
                    const val = getVal(selector);
                    if (val) params.append(key, val);
                });

                const dateCheckbox = document.querySelector('.cb-date');
                const dateRange = getVal('.ipt-date');
                if (dateCheckbox?.checked && dateRange && dateRange.includes(' - ')) {
                    const [dateFrom, dateTo] = dateRange.split(' - ');
                    params.append('date_from', dateFrom.trim());
                    params.append('date_to', dateTo.trim());
                }

                fetch(window.location.pathname + '?' + params, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        const newContent = new DOMParser()
                            .parseFromString(html, 'text/html')
                            .querySelector('.div-orders')?.innerHTML;

                        if (newContent) {
                            document.querySelector('.div-orders').innerHTML = newContent;
                            if (typeof KTMenu !== 'undefined') {
                                KTMenu.createInstances();
                            }
                        }
                    })
                    .catch(console.error)
                    .finally(() => {
                        if (typeof hideFullScreenLoader === 'function') {
                            hideFullScreenLoader();
                        }
                    });
            };

            // Switch between current and old orders (use table loader)
            window.switchOrderDiv = function(targetDiv) {
                showTableLoader();

                if (targetDiv === 'div-table-orders-old') {
                    // Load old orders (completed in last 3 months)
                    const threeMonthsAgo = new Date();
                    threeMonthsAgo.setMonth(threeMonthsAgo.getMonth() - 3);
                    const dateFrom = threeMonthsAgo.toISOString().split('T')[0].replace(/-/g, '/');
                    const dateTo = new Date().toISOString().split('T')[0].replace(/-/g, '/');

                    const params = new URLSearchParams();
                    params.append('status', 'completed');
                    params.append('date_from', dateFrom);
                    params.append('date_to', dateTo);
                    params.append('old_view', '1');

                    fetch(window.location.pathname + '?' + params, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'text/html'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            const newContent = new DOMParser()
                                .parseFromString(html, 'text/html')
                                .querySelector('.div-orders')?.innerHTML;

                            if (newContent) {
                                document.querySelector('.div-orders').innerHTML = newContent;

                                if (typeof KTMenu !== 'undefined') {
                                    KTMenu.createInstances();
                                }

                                // Toggle switch text
                                document.querySelector('.switch-text.current').style.display = 'none';
                                document.querySelector('.switch-text.old').style.display = 'block';
                            }
                        })
                        .catch(console.error)
                        .finally(() => {
                            hideTableLoader();
                        });
                } else {
                    // Load current orders (reload page without filters)
                    fetch(window.location.pathname, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'text/html'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            const newContent = new DOMParser()
                                .parseFromString(html, 'text/html')
                                .querySelector('.div-orders')?.innerHTML;

                            if (newContent) {
                                document.querySelector('.div-orders').innerHTML = newContent;

                                if (typeof KTMenu !== 'undefined') {
                                    KTMenu.createInstances();
                                }

                                // Toggle switch text
                                document.querySelector('.switch-text.current').style.display = 'block';
                                document.querySelector('.switch-text.old').style.display = 'none';
                            }
                        })
                        .catch(console.error)
                        .finally(() => {
                            hideTableLoader();
                        });
                }
            };

            window.filter = function() {
                if (typeof showFullScreenLoader === 'function') {
                    showFullScreenLoader(window.tr('Loading...'), 'body');
                }

                const getVal = selector => document.querySelector(selector)?.value?.trim();

                const fields = {
                    order_id: '.ipt-order-id',
                    orders_api: '.ipt-orders-api',
                    link: '.ipt-link',
                    user_id: '.sl-account',
                    service_id: '.sl-service',
                    provider_id: '.sl-provider'
                };

                const params = new URLSearchParams();
                Object.entries(fields).forEach(([key, selector]) => {
                    const val = getVal(selector);
                    if (val) params.append(key, val);
                });

                // Handle date range (only if checkbox is checked)
                const dateCheckbox = document.querySelector('.cb-date');
                const dateRange = getVal('.ipt-date');
                if (dateCheckbox?.checked && dateRange && dateRange.includes(' - ')) {
                    const [dateFrom, dateTo] = dateRange.split(' - ');
                    params.append('date_from', dateFrom.trim());
                    params.append('date_to', dateTo.trim());
                }

                const url = window.location.pathname + (params.toString() ? '?' + params : '');

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        const newContent = new DOMParser()
                            .parseFromString(html, 'text/html')
                            .querySelector('.div-orders')?.innerHTML;

                        if (newContent) {
                            document.querySelector('.div-orders').innerHTML = newContent;

                            // Reinitialize KTMenu for dropdown menus
                            if (typeof KTMenu !== 'undefined') {
                                KTMenu.createInstances();
                            }

                            // Reinitialize Bootstrap tooltips
                            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                                new bootstrap.Tooltip(el);
                            });
                        }
                    })
                    .catch(console.error)
                    .finally(() => {
                        if (typeof hideFullScreenLoader === 'function') {
                            hideFullScreenLoader();
                        }
                    });
            };

            // Reset all filters with AJAX
            window.resetFilter = function() {
                if (typeof showFullScreenLoader === 'function') {
                    showFullScreenLoader(window.tr('Loading...'), 'body');
                }

                // Clear all input fields
                document.querySelector('.ipt-order-id').value = '';
                document.querySelector('.ipt-orders-api').value = '';
                document.querySelector('.ipt-link').value = '';
                document.querySelector('.ipt-date').value = '';

                // Uncheck date checkbox
                const dateCheckbox = document.querySelector('.cb-date');
                if (dateCheckbox) dateCheckbox.checked = false;

                // Reset select2 dropdowns
                if (window.jQuery) {
                    jQuery('.sl-account').val('').trigger('change');
                    jQuery('.sl-service').val('').trigger('change');
                    jQuery('.sl-provider').val('').trigger('change');
                }

                // Load data without filters using AJAX
                setTimeout(() => {
                    fetch(window.location.pathname, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'text/html'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            const newContent = new DOMParser()
                                .parseFromString(html, 'text/html')
                                .querySelector('.div-orders')?.innerHTML;

                            if (newContent) {
                                document.querySelector('.div-orders').innerHTML = newContent;

                                // Reinitialize KTMenu for dropdown menus
                                if (typeof KTMenu !== 'undefined') {
                                    KTMenu.createInstances();
                                }

                                // Reinitialize Bootstrap tooltips
                                document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                                    new bootstrap.Tooltip(el);
                                });
                            }
                        })
                        .catch(console.error)
                        .finally(() => {
                            if (typeof hideFullScreenLoader === 'function') {
                                hideFullScreenLoader();
                            }
                        });
                }, 100);
            };

            // Enter key
            document.addEventListener('DOMContentLoaded', () => {
                showTableLoader();
                setTimeout(() => {
                    hideTableLoader();
                }, 1000);

                document.querySelectorAll('.ipt-order-id, .ipt-orders-api, .ipt-link')
                    .forEach(el => el.addEventListener('keydown', e => {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            filter();
                        }
                    }));
            });

            // Select2
            (function initSelect2() {
                if (window.jQuery?.fn?.select2) {
                    jQuery('[data-control="select2"]').select2({
                        width: '100%',
                        minimumResultsForSearch: 5
                    });
                } else {
                    setTimeout(initSelect2, 100);
                }
            })();

            // Date Range Picker
            (function initDatePicker() {
                if (window.jQuery?.fn?.daterangepicker && window.moment) {
                    jQuery(function($) {
                        const $dateInput = $('.ipt-date');
                        const $checkbox = $('.cb-date');

                        if ($dateInput.length) {
                            $dateInput.daterangepicker({
                                autoUpdateInput: false,
                                locale: {
                                    format: 'YYYY/MM/DD',
                                    separator: ' - ',
                                    applyLabel: 'Áp dụng',
                                    cancelLabel: 'Hủy',
                                    customRangeLabel: 'Tùy chọn',
                                    daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                                    monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5',
                                        'Tháng 6',
                                        'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11',
                                        'Tháng 12'
                                    ],
                                    firstDay: 1
                                },
                                ranges: {
                                    'Hôm nay': [moment(), moment()],
                                    'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                    '7 ngày gần nhất': [moment().subtract(6, 'days'), moment()],
                                    '30 ngày gần nhất': [moment().subtract(29, 'days'), moment()],
                                    'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                                    'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment()
                                        .subtract(1, 'month').endOf('month')
                                    ]
                                }
                            });

                            // When date selected, just update input (don't auto-check)
                            $dateInput.on('apply.daterangepicker', function(ev, picker) {
                                $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate
                                    .format('YYYY/MM/DD'));
                            });

                            // When cancelled, clear input and uncheck
                            $dateInput.on('cancel.daterangepicker', function() {
                                $(this).val('');
                                $checkbox.prop('checked', false);
                            });

                            // Set initial value if exists
                            <?php if(!empty($searchParams['date_from']) && !empty($searchParams['date_to'])): ?>
                                $dateInput.val(
                                    '<?php echo e($searchParams['date_from']); ?> - <?php echo e($searchParams['date_to']); ?>');
                                $checkbox.prop('checked', true);
                            <?php endif; ?>

                            // When uncheck, clear date value
                            $checkbox.on('change', function() {
                                if (!$(this).is(':checked')) {
                                    $dateInput.val('');
                                }
                            });
                        }
                    });
                } else {
                    setTimeout(initDatePicker, 100);
                }
            })();

            // Checkbox functions
            window.cbSelectAll = function(checked) {
                const checkboxes = document.querySelectorAll('.cb-select');
                checkboxes.forEach(cb => {
                    cb.checked = checked;
                });
                updateCheckallDisplay();
            };

            window.cbSelect = function() {
                updateCheckallDisplay();

                // Update "select all" checkbox state
                const allCheckboxes = document.querySelectorAll('.cb-select');
                const checkedCheckboxes = document.querySelectorAll('.cb-select:checked');
                const cbAll = document.querySelector('.cb-all');

                if (cbAll) {
                    cbAll.checked = allCheckboxes.length > 0 && allCheckboxes.length === checkedCheckboxes.length;
                }
            };

            function updateCheckallDisplay() {
                const checkedCheckboxes = document.querySelectorAll('.cb-select:checked');
                const checkallDiv = document.querySelector('.checkall');
                const checkallLabel = document.querySelector('.checkall label');

                if (checkedCheckboxes.length > 0) {
                    if (checkallDiv) checkallDiv.style.display = 'block';
                    if (checkallLabel) checkallLabel.innerHTML = `${window.tr('Selected')} <strong>${checkedCheckboxes.length}</strong> ${window.tr('orders')}`
                } else {
                    if (checkallDiv) checkallDiv.style.display = 'none';
                    if (checkallLabel) checkallLabel.textContent = '';
                }
            }

            // Filter by status
            window.filterStatus = function(status) {
                if (typeof showFullScreenLoader === 'function') {
                    showFullScreenLoader(window.tr('Loading...'), 'body');
                }

                // Map status to URL path
                const statusMap = {
                    'All': '', 
                    'Manual': 'manual',
                    'Failed': 'failed',
                    'Awaiting': 'awaiting',
                    'Ticket': 'ticket',
                    'Pending': 'pending',
                    'Processing': 'processing',
                    'In progress': 'inprogress',
                    'Completed': 'completed',
                    'Partial': 'partial',
                    'Canceled': 'canceled'
                };

                const statusPath = statusMap[status] || '';
                const baseUrl = window.location.pathname.split('/').slice(0, 3).join('/'); // /admin/orders
                const newUrl = statusPath ? `${baseUrl}/${statusPath}` : baseUrl;

                // Update URL without reload
                window.history.pushState({}, '', newUrl);

                // Fetch data
                fetch(newUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        // Update orders table
                        const newOrders = doc.querySelector('.div-orders')?.innerHTML;
                        if (newOrders) {
                            document.querySelector('.div-orders').innerHTML = newOrders;

                            if (typeof KTMenu !== 'undefined') {
                                KTMenu.createInstances();
                            }
                        }

                        // Update filter status buttons (active state)
                        const newFilterStatus = doc.querySelector('.div-filter-status')?.innerHTML;
                        if (newFilterStatus) {
                            document.querySelector('.div-filter-status').innerHTML = newFilterStatus;
                        }

                        // Reinitialize Bootstrap tooltips
                        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                            new bootstrap.Tooltip(el);
                        });
                    })
                    .catch(console.error)
                    .finally(() => {
                        if (typeof hideFullScreenLoader === 'function') {
                            hideFullScreenLoader();
                        }
                    });
            };

            // Update order status
            window.updateOrderStatus = function(status, orderId) {
                // If status is partial, show modal to input remains
                if (status === 'partial') {
                    document.getElementById('modal-prompt-title').textContent = window.tr('Input value');
                    document.getElementById('modal-prompt-label').textContent = window.tr('Remains');

                    const container = document.getElementById('modal-prompt-input-container');
                    container.innerHTML =
                        '<input type="text" class="form-control form-control-solid" id="ipt-prompt-value" value="">';

                    const modal = new bootstrap.Modal(document.getElementById('modal-prompt'));
                    modal.show();

                    document.getElementById('btn-modal-prompt-ok').onclick = function() {
                        const remains = document.getElementById('ipt-prompt-value').value;

                        if (!remains || isNaN(remains)) {
                            showToast(window.tr('Please enter a valid quantity'), 'error');
                            return;
                        }

                        showFullScreenLoader(window.tr('Updating status...'), 'body');
                        modal.hide();

                        const url = `/admin/orders/${orderId}/update-status`;
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                        fetch(url, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify({
                                    status: status,
                                    remains: parseInt(remains)
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    setTimeout(() => {
                                        filter();
                                    }, 500);
                                } else {
                                    hideFullScreenLoader();
                                    showToast(window.tr('Update failed!'), 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                hideFullScreenLoader();
                                showToast(window.tr('An error occurred!'), 'error');
                            });
                    };
                    return;
                }

                // For other statuses, update directly
                showFullScreenLoader(window.tr('Updating status...'), 'body');

                const url = `/admin/orders/${orderId}/update-status`;
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            status: status
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Reload table after 500ms to show updated status and menu
                            setTimeout(() => {
                                filter();
                            }, 500);
                        } else {
                            hideFullScreenLoader();
                            showToast(window.tr('Update failed!'), 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        hideFullScreenLoader();
                        showToast(window.tr('An error occurred!'), 'error');
                    });
            };

            // Placeholder functions for future implementation
            window.changeStatusFromApi = function(orderId) {
                showFullScreenLoader(window.tr('Updating status from provider...'), 'body');

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                fetch('/admin/orders/update-status-provider', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ order_id: orderId })
                    })
                    .then(res => res.json())
                    .then(data => {
                        hideFullScreenLoader();
                        if (data.success) {
                            if (data.provider_error) {
                                // API trả lỗi (vd: order not found) — toast error
                                showToast(data.message, 'error');
                            } else {
                                // Cập nhật thành công — reload table
                                setTimeout(() => filter(), 500);
                            }
                        } else {
                            showToast(data.message || window.tr('Update failed!'), 'error');
                        }
                    })
                    .catch(error => {
                        hideFullScreenLoader();
                        showToast(window.tr('An error occurred!'), 'error');
                    });
            };

            window.addStartCount = function(orderId) {
                // Set modal title and label
                document.getElementById('modal-prompt-title').textContent = window.tr('Add Start Count');
                document.getElementById('modal-prompt-label').textContent = window.tr('Start count');

                // Replace with input field
                const container = document.getElementById('modal-prompt-input-container');
                container.innerHTML =
                    '<input type="text" class="form-control form-control-solid" id="ipt-prompt-value" value="">';

                const modal = new bootstrap.Modal(document.getElementById('modal-prompt'));
                modal.show();

                document.getElementById('btn-modal-prompt-ok').onclick = function() {
                    const startCount = document.getElementById('ipt-prompt-value').value;

                    if (!startCount || isNaN(startCount)) {
                        showFullScreenLoader('', '#modal-prompt');
                        setTimeout(() => {
                            hideFullScreenLoader();
                            showToast(window.tr('Please enter a valid quantity'), 'error');
                        }, 300);
                        return;
                    }

                    showFullScreenLoader('', '#modal-prompt');

                    fetch(`/admin/orders/${orderId}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                add_start_count: true,
                                start_count: parseInt(startCount)
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            hideFullScreenLoader();
                            modal.hide();

                            if (data.success) {
                                filter();
                            }
                        })
                        .catch(error => {
                            hideFullScreenLoader();
                            console.error('Error:', error);
                            showToast(window.tr('An error occurred'), 'error');
                        });
                };
            };

            window.addProviderOrderID = function(orderId) {
                // Set modal title and label
                document.getElementById('modal-prompt-title').textContent = window.tr('Input value');
                document.getElementById('modal-prompt-label').textContent = window.tr('Provider Order ID');

                // Replace with input field
                const container = document.getElementById('modal-prompt-input-container');
                container.innerHTML =
                    '<input type="text" class="form-control form-control-solid" id="ipt-prompt-value" value="">';

                const modalElement = document.getElementById('modal-prompt');
                const modal = new bootstrap.Modal(modalElement);
                modal.show();

                document.getElementById('btn-modal-prompt-ok').onclick = function() {
                    const ordersApi = document.getElementById('ipt-prompt-value').value;
                    if (!ordersApi.trim()) {
                        alert(window.tr('Please enter provider order ID'));
                        return;
                    }
                    showFullScreenLoader('', '#modal-prompt');

                    fetch(`/admin/orders/${orderId}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                orders_api: ordersApi
                            })
                        })
                        .then(r => r.json())
                        .then(data => {
                            hideFullScreenLoader();
                            modal.hide();
                            if (data.success) filter();
                        })
                        .catch(e => {
                            hideFullScreenLoader();
                            console.error('Error:', e);
                        });
                };
            };

            window.resendOrder = function(orderId) {
                showFullScreenLoader(window.tr('Resending order...'), 'body');

                const hideRow = () => {
                    const row = document.querySelector(`tr[data-order-id="${orderId}"]`);
                    if (row) {
                        row.style.opacity = '0.5';
                        setTimeout(() => row.remove(), 300);
                    }
                };

                fetch(`/admin/orders/${orderId}/resend`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        hideFullScreenLoader();
                        if (!data.success) {
                            showToast(data.message || window.tr('Error resending order'), 'error');
                        }
                        hideRow();
                    })
                    .catch(error => {
                        hideFullScreenLoader();
                        showToast(error.message, 'error');
                        hideRow();
                    });
            };

            window.addTag = function(orderId, tagType) {
                showFullScreenLoader('', 'body');

                fetch(`/admin/orders/${orderId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ ticket: tagType })
                    })
                    .then(r => r.json())
                    .then(data => {
                        hideFullScreenLoader();
                        if (data.success) {
                            filter();
                        } else {
                            showToast(data.message || 'Failed', 'error');
                        }
                    })
                    .catch(e => {
                        hideFullScreenLoader();
                        showToast(e.message, 'error');
                    });
            };

            window.addNote = function(orderId) {
                // Set modal title and label
                document.getElementById('modal-prompt-title').textContent = window.tr('Add Note');
                document.getElementById('modal-prompt-label').textContent = window.tr('Note');

                // Replace with input field
                const container = document.getElementById('modal-prompt-input-container');
                container.innerHTML =
                    '<input type="text" class="form-control form-control-solid" id="ipt-prompt-value" value="">';

                const modalElement = document.getElementById('modal-prompt');
                const modal = new bootstrap.Modal(modalElement);
                modal.show();

                document.getElementById('btn-modal-prompt-ok').onclick = function() {
                    const note = document.getElementById('ipt-prompt-value').value;
                    showFullScreenLoader('', '#modal-prompt');

                    fetch(`/admin/orders/${orderId}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                note: note
                            })
                        })
                        .then(r => r.json())
                        .then(data => {
                            hideFullScreenLoader();
                            modal.hide();
                            if (data.success) filter();
                        })
                        .catch(e => {
                            hideFullScreenLoader();
                            console.error('Error:', e);
                        });
                };
            };

            window.actionBulk = function(action, value, showLoader = true) {
                // Get all checked order IDs
                const checkedCheckboxes = document.querySelectorAll('.cb-select:checked');
                const orderIds = Array.from(checkedCheckboxes).map(cb => cb.value);

                if (orderIds.length === 0) {
                    return;
                }

                // Handle "Send order" action
                if (action === 'Send order') {
                    // Show confirm modal
                    const confirmModal = new bootstrap.Modal(document.getElementById('modal-confirm'));
                    document.getElementById('modal-confirm-title').textContent = window.tr('Confirm resend orders');
                    document.getElementById('modal-confirm-message').textContent =
                        `${window.tr('Are you sure you want to resend')} ${orderIds.length} ${window.tr('orders')}?`;

                    document.getElementById('btn-modal-confirm-ok').onclick = () => {
                        confirmModal.hide();

                        if (showLoader) {
                            showFullScreenLoader(window.tr('Resending...'), 'body');
                        }

                        let index = 0;
                        const processNext = () => {
                            if (index >= orderIds.length) {
                                if (showLoader) {
                                    hideFullScreenLoader();
                                }
                                return;
                            }

                            const orderId = orderIds[index];
                            const url = `/admin/orders/${orderId}/resend`;
                            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                                'content');

                            fetch(url, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'application/json'
                                    }
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (!data.success) {
                                        showToast(`Order #${orderId}: ${data.message || window.tr('Update failed!')}`, 'error');
                                    }

                                    // Hide row regardless of success/error
                                    const orderRow = document.querySelector(`tr[data-order-id="${orderId}"]`);
                                    if (orderRow) {
                                        orderRow.style.opacity = '0.5';
                                        setTimeout(() => orderRow.remove(), 300);
                                    }

                                    // Process next order
                                    index++;
                                    processNext();
                                })
                                .catch(error => {
                                    showToast(`Order #${orderId}: ${error.message}`, 'error');
                                    // Hide row even on error
                                    const orderRow = document.querySelector(`tr[data-order-id="${orderId}"]`);
                                    if (orderRow) {
                                        orderRow.style.opacity = '0.5';
                                        setTimeout(() => orderRow.remove(), 300);
                                    }
                                    // Continue to next order
                                    index++;
                                    processNext();
                                });
                        };

                        processNext();
                    };

                    confirmModal.show();
                    return;
                }

                // Handle "Change status" action
                if (action === 'Change status') {
                    if (showLoader) {
                        showFullScreenLoader(window.tr('Updating...'), 'body');
                    }

                    // Process orders sequentially
                    let index = 0;
                    const processNext = () => {
                        if (index >= orderIds.length) {
                            // All done
                            if (showLoader) {
                                hideFullScreenLoader();
                            }
                            return;
                        }

                        const orderId = orderIds[index];
                        const url = `/admin/orders/${orderId}/update-status`;
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                        fetch(url, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify({
                                    status: value
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    // Fade out and remove the order row
                                    const orderRow = document.querySelector(`tr[data-order-id="${orderId}"]`);
                                    if (orderRow) {
                                        orderRow.style.transition = 'opacity 0.3s ease-out';
                                        orderRow.style.opacity = '0';

                                        setTimeout(() => {
                                            orderRow.style.display = 'none';
                                        }, 300);
                                    }
                                }

                                // Process next order
                                index++;
                                processNext();
                            })
                            .catch(error => {
                                index++;
                                processNext();
                            });
                    };

                    processNext();
                    return;
                }

                // Handle "Copy Order ID" action
                if (action === 'Copy Order ID') {
                    const modal = new bootstrap.Modal(document.getElementById('modal-copy'));
                    document.getElementById('modal-copy-title').textContent = 'Mã đơn hàng';

                    const textarea = document.getElementById('modal-copy-textarea');
                    textarea.value = orderIds.join('\n');

                    modal.show();
                    return;
                }

                // Handle "Copy Link" action
                if (action === 'Copy Link') {
                    const links = Array.from(checkedCheckboxes).map(cb => {
                        const row = cb.closest('tr');
                        // Get link from the row (adjust selector based on your table structure)
                        const linkCell = row.querySelector('[data-link]');
                        return linkCell ? linkCell.getAttribute('data-link') : '';
                    }).filter(link => link);

                    const modal = new bootstrap.Modal(document.getElementById('modal-copy'));
                    document.getElementById('modal-copy-title').textContent = 'Link';

                    const textarea = document.getElementById('modal-copy-textarea');
                    textarea.value = links.join('\n');

                    modal.show();
                    return;
                }

                // Handle "Copy Provider Order ID" action
                if (action === 'Copy Provider Order ID') {
                    const providerOrderIds = Array.from(checkedCheckboxes).map(cb => cb.getAttribute('data-pid')).filter(
                        id => id);

                    const modal = new bootstrap.Modal(document.getElementById('modal-copy'));
                    document.getElementById('modal-copy-title').textContent = 'Mã đơn hàng NCC';

                    const textarea = document.getElementById('modal-copy-textarea');
                    textarea.value = providerOrderIds.join('\n');

                    modal.show();
                    return;
                }

                // Handle "Tag - Add" action — batch 10
                if (action === 'Tag - Add') {
                    const BATCH = 10;
                    const total = orderIds.length;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    let index = 0;

                    const runBatch = () => {
                        if (index >= total) {
                            hideFullScreenLoader();
                            filter();
                            return;
                        }
                        const batch = orderIds.slice(index, index + BATCH);
                        showFullScreenLoader(`${index + 1}–${index + batch.length} / ${total}...`, 'body');

                        let bi = 0;
                        const next = () => {
                            if (bi >= batch.length) { index += batch.length; setTimeout(runBatch, 300); return; }
                            const oid = batch[bi];
                            fetch(`/admin/orders/${oid}`, {
                                method: 'PUT',
                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                                body: JSON.stringify({ ticket: value })
                            })
                            .then(r => r.json())
                            .then(d => {
                                if (!d.success) showToast(`#${oid}: ${d.message || 'Failed'}`, 'error');
                                bi++; next();
                            })
                            .catch(e => { showToast(e.message, 'error'); bi++; next(); });
                        };
                        next();
                    };
                    runBatch();
                    return;
                }

                // Handle "Provider - Update Status" — dùng changeStatusFromApi, batch 10
                if (action === 'Provider - Update Status') {
                    const BATCH = 10;
                    const total  = orderIds.length;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    let index = 0;

                    const runBatch = () => {
                        if (index >= total) {
                            hideFullScreenLoader();
                            return;
                        }
                        const batch = orderIds.slice(index, index + BATCH);
                        showFullScreenLoader(`Đang cập nhật ${index + 1}–${index + batch.length} / ${total}...`, 'body');

                        let bi = 0;
                        const next = () => {
                            if (bi >= batch.length) { index += batch.length; setTimeout(runBatch, 300); return; }
                            const oid = batch[bi];
                            fetch('/admin/orders/update-status-provider', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                                body: JSON.stringify({ order_id: oid })
                            })
                            .then(r => r.json())
                            .then(d => {
                                if (d.success) {
                                    if (d.provider_error) {
                                        // API error — toast error, tiếp tục
                                        showToast(d.message, 'error');
                                    } else {
                                        // Thành công — fade out row
                                        const row = document.querySelector(`tr[data-order-id="${oid}"]`);
                                        if (row) { row.style.opacity = '0.5'; setTimeout(() => row.remove(), 300); }
                                    }
                                } else {
                                    // Lỗi hệ thống — toast error
                                    showToast(d.message || 'Failed', 'error');
                                }
                                bi++; next();
                            })
                            .catch(e => { showToast(e.message, 'error'); bi++; next(); });
                        };
                        next();
                    };
                    runBatch();
                    return;
                }
            };

            window.copyToClipboard = function() {
                const textarea = document.getElementById('modal-copy-textarea');
                textarea.select();
                document.execCommand('copy');

                // Close modal after successful copy
                const modal = bootstrap.Modal.getInstance(document.getElementById('modal-copy'));
                if (modal) {
                    modal.hide();
                }
            };
        </script>
    </div>

    <!-- Modal for confirmation -->
    <div class="modal fade" id="modal-confirm" tabindex="-1" data-bs-backdrop="static" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered rounded-4">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white py-4">
                    <h4 class="modal-title text-white ls-1" id="modal-confirm-title" data-lang="Confirm">Xác nhận</h4>
                </div>
                <div class="modal-body py-10 fs-5" id="modal-confirm-message">
                    <span data-lang="Are you sure you want to perform this action?">Bạn có chắc chắn muốn thực hiện hành động này?</span>
                </div>
                <div class="modal-footer py-4">
                    <button type="button" class="btn btn-sm btn-secondary px-4 rounded-4" id="btn-modal-confirm-cancel"
                        data-bs-dismiss="modal" data-lang="Cancel">Hủy</button>
                    <button type="button" class="btn btn-sm btn-warning px-4 rounded-4" id="btn-modal-confirm-ok" data-lang="OK">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding start count or note -->
    <div class="modal fade" id="modal-prompt" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered rounded-4">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white py-4">
                    <h4 class="modal-title text-white ls-1" id="modal-prompt-title">Input value</h4>
                </div>
                <div class="modal-body py-10">
                    <p id="modal-prompt-label" data-lang="Start count">Số lượng ban đầu</p>
                    <div id="modal-prompt-input-container">
                        <input type="text" class="form-control form-control-solid" id="ipt-prompt-value"
                            value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary px-4 rounded-4" id="btn-modal-prompt-cancel"
                        data-bs-dismiss="modal" data-lang="Cancel">Hủy</button>
                    <button type="button" class="btn btn-sm btn-primary px-4 rounded-4"
                        id="btn-modal-prompt-ok" data-lang="Send">Gửi</button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminpanel.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/adminpanel/orders/index.blade.php ENDPATH**/ ?>