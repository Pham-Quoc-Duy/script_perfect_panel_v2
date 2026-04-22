@extends('adminpanel.layouts.app')
@section('title', 'Services')
@section('content')
    <div class="content flex-row-fluid" id="kt_content"><span class="title d-none">Import</span>

        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <div class="row g-5 g-xl-5">
                    <div class="col-lg-3" data-select2-id="select2-data-4-pqom">
                        <select class="form-select form-select-sm form-select-solid sl-provider select2-hidden-accessible"
                            id="providerSelect" data-kt-select2="true" data-select2-id="select2-data-4-pqom" tabindex="-1"
                            aria-hidden="true" data-placeholder="Chọn nhà cung cấp">
                            <option value="0">Chọn nhà cung cấp</option>
                            @foreach ($providers as $pro)
                                <option value="{{ $pro->id }}" data-fixed-decimal="{{ $pro->fixed_decimal }}"
                                    data-rate="1">{{ $pro->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="currentProviderFixedDecimal" value="6">
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-outline btn-outline-primary btn-sm w-100"
                            onclick="loadProviderServices()" data-lang="">Tải dịch vụ</button>
                    </div>
                    <div class="col-lg-5">
                        <select class="form-select form-select-sm form-select-solid sl-category">
                            <option value="0">Chọn danh mục</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" data-icon="{{ $category->image }}">
                                    {{ $category->platform->name ?? '' }} | {{ $category->getName() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-primary btn-sm w-100" onclick="handleImportServices()"
                            data-lang="button::Import">Nhập</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <script>
                    var percent_inc_service = {{ $markupConfig['markup_retail'] ?? 110 }},
                        percent_inc_service_1 = {{ $markupConfig['markup_agent'] ?? 108 }},
                        percent_inc_service_2 = {{ $markupConfig['markup_distributor'] ?? 105 }};
                </script>
                <div class="table-responsive">
                    <table class="table align-middle table-row-bordered fs-7 gy-2 gs-3"></table>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS cho Full Screen Loader và Select2 Category -->
    <style>
        /* Overlay tối màn hình */
        .fullscreen-loader-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.42);
            backdrop-filter: blur(3px);
            z-index: 9998;
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Container loader */
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

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>

    <script>
        // Hiển thị loader khi trang bắt đầu load
        if (typeof showFullScreenLoader === 'function') {
            showFullScreenLoader('Đang khởi tạo...');
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Khởi tạo Select2 cho Provider
            $('#providerSelect').select2({
                placeholder: 'Chọn nhà cung cấp',
                allowClear: false,
                width: '100%',
                language: 'vi',
                minimumResultsForSearch: 1
            });

            // Khởi tạo Select2 cho Category với template cho icon
            $('.sl-category').select2({
                placeholder: 'Chọn danh mục',
                allowClear: false,
                width: '100%',
                language: 'vi',
                minimumResultsForSearch: 1,
                templateResult: formatCategoryOption,
                templateSelection: formatCategoryOption
            });

            // Format option với icon
            function formatCategoryOption(data) {
                if (!data.id) return data.text;

                const $element = $(data.element);
                const iconData = $element.data('icon');

                if (!iconData) {
                    return $(`<span>${data.text}</span>`);
                }

                let iconHtml = '';

                // Kiểm tra nếu iconData là URL (chứa http hoặc https)
                if (iconData.includes('http://') || iconData.includes('https://')) {
                    // Hiển thị bằng thẻ <img>
                    iconHtml = `<img src="${iconData}" class="w-15px h-15px me-2" style="object-fit: contain;" />`;
                } else {
                    // Hiển thị bằng thẻ <i> (Font Awesome icon)
                    iconHtml = `<i class="${iconData} me-2"></i>`;
                }

                return $(`<div class="d-flex align-items-center">${iconHtml}<span>${data.text}</span></div>`);
            }

            // Xử lý thay đổi provider
            $('#providerSelect').on('change', function() {
                const selectedValue = $(this).val();
                const fixedDecimal = $(this).find(':selected').data('fixed-decimal') || 6;
                $('#currentProviderFixedDecimal').val(fixedDecimal);
                if (selectedValue) {
                    console.log('Provider selected:', selectedValue, 'Fixed decimal:', fixedDecimal);
                }
            });

            // Ẩn loader sau khi khởi tạo xong
            setTimeout(() => {
                if (typeof hideFullScreenLoader === 'function') {
                    hideFullScreenLoader();
                }
            }, 300);
        });
        // Hàm xử lý import services với loader - nhập từng service một
        async function handleImportServices() {
            const providerId = document.querySelector('.sl-provider').value;
            const categoryId = document.querySelector('.sl-category').value;

            if (!providerId || providerId === '0') {
                showToast('Vui lòng chọn nhà cung cấp!', 'error');
                return;
            }

            if (!categoryId || categoryId === '0') {
                showToast('Vui lòng chọn danh mục!', 'error');
                return;
            }

            // Lấy danh sách services đã chọn
            const checkedServices = document.querySelectorAll('.cb-service:checked');
            if (checkedServices.length === 0) {
                showToast('Please select at least 1 service', 'error');
                return;
            }

            // Hiển thị loader
            if (typeof showFullScreenLoader === 'function') {
                showFullScreenLoader('Đang nhập dịch vụ...');
            }

            try {
                // Import từng service một
                for (let i = 0; i < checkedServices.length; i++) {
                    const checkbox = checkedServices[i];
                    const serviceInfo = JSON.parse(decodeURIComponent(checkbox.dataset.info));
                    const row = checkbox.closest('tr');
                    const priceInput = row.querySelector('.ipt-service-price');
                    const price1Input = row.querySelector('.ipt-service-price-1');
                    const price2Input = row.querySelector('.ipt-service-price-2');
                    const pricePercentInput = row.querySelector('.ipt-service-price-percent');
                    const price1PercentInput = row.querySelector('.ipt-service-price-1-percent');
                    const price2PercentInput = row.querySelector('.ipt-service-price-2-percent');
                    const syncCheckbox = row.querySelector('.cb-service-sync');

                    const serviceData = {
                        service_id: serviceInfo.service,
                        rate_retail: parseFloat(priceInput.value) || 0,
                        rate_agent: parseFloat(price1Input.value) || 0,
                        rate_distributor: parseFloat(price2Input.value) || 0,
                        rate_retail_up: parseFloat(pricePercentInput?.value) || percent_inc_service,
                        rate_agent_up: parseFloat(price1PercentInput?.value) || percent_inc_service_1,
                        rate_distributor_up: parseFloat(price2PercentInput?.value) || percent_inc_service_2,
                        sync_enabled: syncCheckbox ? syncCheckbox.checked : true
                    };

                    const payload = {
                        provider_id: parseInt(providerId),
                        category_id: parseInt(categoryId),
                        services: [serviceInfo.service],
                        services_data: [serviceData],
                        markup_config: {
                            markup_retail: percent_inc_service,
                            markup_agent: percent_inc_service_1,
                            markup_distributor: percent_inc_service_2
                        }
                    };

                    // Gọi API import từng service
                    const response = await fetch('/admin/services/import', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await response.json();

                    if (data.success) {
                        showToast(`Thêm thành công. ID: ${serviceInfo.service}`, 'success');
                    } else {
                        showToast(`Lỗi khi thêm. ID: ${serviceInfo.service} - ${data.message || 'Có lỗi xảy ra'}`, 'error');
                    }

                    // Ẩn service vừa import khỏi giao diện
                    checkbox.closest('tr').style.display = 'none';

                    // Đợi một chút trước khi nhập service tiếp theo
                    await new Promise(resolve => setTimeout(resolve, 500));
                }
            } catch (error) {
                console.error('Import error:', error);
                showToast(error.message || 'Có lỗi xảy ra khi nhập dịch vụ', 'error');
            } finally {
                if (typeof hideFullScreenLoader === 'function') {
                    hideFullScreenLoader();
                }
            }
        }

        // Hàm tải dịch vụ từ provider
        function loadProviderServices() {
            const providerId = $('#providerSelect').val();

            if (!providerId || providerId === '0') {
                showToast('Vui lòng chọn nhà cung cấp!', 'error');
                return;
            }

            // Hiển thị full screen loader
            if (typeof showFullScreenLoader === 'function') {
                showFullScreenLoader();
            }

            // Gọi API
            const url = `/admin/services/provider/${providerId}/services`;

            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response && response.success && response.services) {
                        renderServicesTable(response.services);
                    } else {
                        showToast(response.message || 'Không có dịch vụ nào', 'error');
                    }
                },
                error: function(xhr) {
                    var msg = xhr.responseJSON?.message || 'Có lỗi xảy ra khi tải dịch vụ';
                    showToast(msg, 'error');
                },
                complete: function() {
                    if (typeof hideFullScreenLoader === 'function') {
                        hideFullScreenLoader();
                    }
                }
            });
        }

        // Hàm render bảng dịch vụ
        function renderServicesTable(services) {
            const $table = $('.table-responsive table');

            if (!services || services.length === 0) {
                showToast('Không có dịch vụ nào', 'error');
                return;
            }

            // Nhóm services theo category
            const groupedServices = {};
            services.forEach(service => {
                const category = service.category || 'Khác';
                if (!groupedServices[category]) {
                    groupedServices[category] = [];
                }
                groupedServices[category].push(service);
            });

            let tableHtml = '';

            // Render từng category
            Object.keys(groupedServices).forEach((category, categoryIndex) => {
                const categoryServices = groupedServices[category];

                // Header category
                tableHtml += `
                    <tbody data-category="${categoryIndex}">
                        <tr class="fs-5 fw-bold bg-secondary">
                            <td class="ps-3" colspan="5">
                                <div class="form-check form-check-custom form-check-sm">
                                    <input class="form-check-input cb-category" type="checkbox"
                                        onchange="toggleCategoryServices(this.checked, ${categoryIndex})">
                                    <label class="form-check-label text-gray-800">${category}</label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                `;

                // Render services trong category
                categoryServices.forEach(service => {
                    const rate = parseFloat(service.rate) || 0;
                    const fixedDecimal = parseInt($('#currentProviderFixedDecimal').val()) || 6;
                    const formattedRate = formatRate(rate, fixedDecimal);
                    const price110 = (rate * percent_inc_service / 100);
                    const price108 = (rate * percent_inc_service_1 / 100);
                    const price105 = (rate * percent_inc_service_2 / 100);
                    const formattedPrice110 = formatRate(price110, fixedDecimal);
                    const formattedPrice108 = formatRate(price108, fixedDecimal);
                    const formattedPrice105 = formatRate(price105, fixedDecimal);

                    const serviceInfo = {
                        service: service.id,
                        name: service.name,
                        type: service.type || 'Default',
                        category: category,
                        rate: rate,
                        min: service.min || 0,
                        max: service.max || 0,
                        refill: service.refill || false,
                        cancel: service.cancel || false
                    };

                    tableHtml += `
                        <tr>
                            <td class="ps-6" style="white-space: normal;">
                                <div class="form-check form-check-custom form-check-sm form-check-solid">
                                    <input class="form-check-input cb-service" type="checkbox"
                                        data-service="${service.id}"
                                        data-info="${encodeURIComponent(JSON.stringify(serviceInfo))}"
                                        data-category="${categoryIndex}"
                                        onchange="toggleService(this.checked, ${service.id})">
                                    <label class="form-check-label text-gray-700">${service.id} | ${service.name}</label>
                                </div>
                            </td>
                            <td>${formattedRate}<input type="hidden" class="form-control ipt-service-oprice" value="${rate}" disabled></td>
                            <td width="60%" style="zoom: 0.9;">
                                <div class="d-flex d-none" id="price-section-${service.id}">
                                    <div class="form-check from-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input cb-service-sync" type="checkbox"
                                            onchange="syncPriceImport(this.checked, ${service.id})" checked>
                                        <span class="form-check-label">Sync</span>
                                    </div>
                                    <div class="flex-fill ms-3">
                                        <div class="input-group input-group-sm input-group-solid">
                                            <span class="input-group-text bg-secondary">$</span>
                                            <input type="text" class="form-control ipt-service-price" value="${formattedPrice110}" disabled>
                                            <input type="text" class="form-control float-end text-end ipt-service-price-percent"
                                                value="${percent_inc_service}"
                                                onkeyup="updatePricePercent(this.value, ${rate}, ${service.id}, 'price')">
                                            <span class="input-group-text bg-secondary">%</span>
                                        </div>
                                    </div>
                                    <div class="flex-fill ms-3">
                                        <div class="input-group input-group-sm input-group-solid">
                                            <span class="input-group-text bg-secondary">$</span>
                                            <input type="text" class="form-control ipt-service-price-1" value="${formattedPrice108}" disabled>
                                            <input type="text" class="form-control float-end text-end ipt-service-price-1-percent"
                                                value="${percent_inc_service_1}"
                                                onkeyup="updatePricePercent(this.value, ${rate}, ${service.id}, 'price-1')">
                                            <span class="input-group-text bg-secondary">%</span>
                                        </div>
                                    </div>
                                    <div class="flex-fill ms-3">
                                        <div class="input-group input-group-sm input-group-solid">
                                            <span class="input-group-text bg-secondary">$</span>
                                            <input type="text" class="form-control ipt-service-price-2" value="${formattedPrice105}" disabled>
                                            <input type="text" class="form-control float-end text-end ipt-service-price-2-percent"
                                                value="${percent_inc_service_2}"
                                                onkeyup="updatePricePercent(this.value, ${rate}, ${service.id}, 'price-2')">
                                            <span class="input-group-text bg-secondary">%</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            });

            $table.html(tableHtml);
        }


        // Hàm toggle tất cả services trong category
        function toggleCategoryServices(checked, categoryIndex) {
            const checkboxes = $(`.cb-service[data-category="${categoryIndex}"]`);
            checkboxes.prop('checked', checked);

            // Hiển thị/ẩn phần giá cho tất cả services trong category
            checkboxes.each(function() {
                const serviceId = $(this).data('service');
                const priceSection = document.getElementById(`price-section-${serviceId}`);
                if (priceSection) {
                    if (checked) {
                        priceSection.classList.remove('d-none');
                    } else {
                        priceSection.classList.add('d-none');
                    }
                }
            });
        }

        // Hàm toggle service
        function toggleService(checked, serviceId) {
            console.log('Service toggled:', serviceId, checked);

            // Hiển thị hoặc ẩn phần giá bằng cách thêm/xóa class d-none
            const priceSection = document.getElementById(`price-section-${serviceId}`);
            if (priceSection) {
                if (checked) {
                    priceSection.classList.remove('d-none');
                } else {
                    priceSection.classList.add('d-none');
                }
            }
        }

        // Hàm sync price
        function syncPriceImport(checked, serviceId) {
            console.log('Sync price:', serviceId, checked);

            // Tìm row chứa service này
            const $checkbox = $(`.cb-service[data-service="${serviceId}"]`);
            const $row = $checkbox.closest('tr');

            // Tìm tất cả input giá trong row này
            const $priceInputs = $row.find('.ipt-service-price, .ipt-service-price-1, .ipt-service-price-2');

            if (checked) {
                // Khi bật Sync: disable các input giá (không cho sửa)
                $priceInputs.prop('disabled', true);
                $priceInputs.removeClass('custom-cursor-default-hover');
            } else {
                // Khi tắt Sync: enable các input giá (cho phép sửa)
                $priceInputs.prop('disabled', false);
                $priceInputs.addClass('custom-cursor-default-hover');
            }
        }

        // Hàm format rate dựa vào fixed_decimal
        function formatRate(rate, fixedDecimal) {
            if (fixedDecimal <= 0) fixedDecimal = 6;

            // Format với số decimal từ provider
            let formatted = rate.toFixed(fixedDecimal);

            // Loại bỏ các số 0 thừa ở cuối và dấu chấm thập phân nếu không cần
            formatted = formatted.replace(/\.?0+$/, '');

            return formatted;
        }

        // Hàm update price theo percent
        function updatePricePercent(percent, originalRate, serviceId, priceType) {
            const $row = $(`.cb-service[data-service="${serviceId}"]`).closest('tr');
            const newPrice = (originalRate * percent / 100).toFixed(6);
            $row.find(`.ipt-service-${priceType}`).val(newPrice);
        }

        // Toast notification function
        function showToast(message, type = 'error') {
            const container = document.getElementById('toastr-container');
            if (!container) return;

            const toastDiv = document.createElement('div');
            toastDiv.className = `toastr toastr-${type}`;
            toastDiv.setAttribute('aria-live', 'assertive');
            toastDiv.style.opacity = '1';

            const progressDiv = document.createElement('div');
            progressDiv.className = 'toastr-progress';
            progressDiv.style.width = '100%';

            const messageDiv = document.createElement('div');
            messageDiv.className = 'toastr-message';
            messageDiv.textContent = message;

            toastDiv.appendChild(progressDiv);
            toastDiv.appendChild(messageDiv);
            container.appendChild(toastDiv);

            // Animate progress bar
            let width = 100;
            const interval = setInterval(() => {
                width -= 2;
                progressDiv.style.width = width + '%';
                if (width <= 0) {
                    clearInterval(interval);
                    toastDiv.style.opacity = '0';
                    setTimeout(() => toastDiv.remove(), 300);
                }
            }, 30);
        }
    </script>
@endsection
