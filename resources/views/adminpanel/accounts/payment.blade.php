@extends('adminpanel.layouts.app')
@section('title', 'Accounts')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        @include('adminpanel.accounts.partials.header', ['account' => $accounts, 'lastLogin' => $lastLogin])

        <span class="title d-none">View account - Payment</span>
        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2" data-lang="Top up">Nạp tiền</h3>
        </div>

        <div class="row g-6">
            <div class="col-md-6 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="mb-5">
                            <label class="form-label" data-lang="Payment method">Phương thức thanh toán</label>
                            <select class="form-select form-select-solid sl-payment-method" data-hide-search="false" onchange="handlePaymentMethodChange()">
                                <option value="" data-lang="Please select payment method">Vui lòng chọn phương thức thanh toán</option>
                                <option value="bonus" data-icon="https://cdn-icons-png.flaticon.com/512/5622/5622939.png" data-currency="USD" data-rate="1">Bonus</option>
                                @foreach($payments as $payment)
                                    <option value="{{ $payment->id }}" 
                                        data-icon="{{ $payment->image }}" 
                                        data-currency="{{ $payment->currency }}" 
                                        data-rate="{{ $payment->exchange_rate ?? 1 }}">
                                        {{ $payment->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <fieldset class="div-currency border border-1 border-info rounded p-5 pt-0 mb-5" style="display: none;">
                            <legend class="float-none w-auto mb-0">
                                <label class="form-label text-info" data-lang="Currency conversion">Chuyển đổi tiền tệ</label>
                            </legend>
                            <div class="input-group input-group-solid">
                                <input type="number" class="form-control form-control-solid ipt-currency-value" onkeyup="convertCurrency()">
                                <input type="number" class="form-control bg-secondary form-control-solid ipt-currency-rate" onkeyup="convertCurrency()">
                                <span class="input-group-text bg-secondary currency-symbol">USD</span>
                            </div>
                        </fieldset>
                        <div class="mb-5">
                            <label class="form-label" data-lang="Quantity">Số lượng</label>
                            <div class="input-group input-group-solid">
                                <input type="number" class="form-control form-control-solid ipt-fund-amount" step="0.0001" min="0.0001">
                                <span class="input-group-text bg-secondary currency-amount-symbol">USD</span>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="form-label" data-lang="Details">Chi tiết</label>
                            <textarea rows="5" class="form-control form-control-solid txa-fund-details"></textarea>
                        </div>
                        <div class="mb-5">
                            <button type="button" class="btn btn-primary w-100" onclick="submitFundDeposit()" data-lang="button::Add">Thêm</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="row g-6">
                    <div class="col-md-6 col-6">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h2 class="info-fund-deposit text-primary">{{ formatCharge($totalDeposit) }}</h2>
                                <span class="text-gray-700" data-lang="Deposited">Đã nạp</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h2 class="info-fund-bonus text-warning">{{ formatCharge($totalBonus) }}</h2>
                                <span class="text-gray-700" data-lang="Bonus">Thưởng</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h2 class="info-fund-spent text-danger">{{ formatCharge($totalSpent) }}</h2>
                                <span class="text-gray-700" data-lang="Spent">Đã tiêu</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h2 class="info-fund-can-refund">{{ formatCharge($canRefund) }}</h2>
                                <span class="text-gray-700" data-lang="Can refund">Có thể hoàn</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

        <div class="d-flex flex-wrap flex-stack my-6">
            <h3 class="fw-bold my-2" data-lang="Top up history">Lịch sử nạp tiền</h3>
        </div>

        <div class="row g-6">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="mb-5">
                            <input class="form-control ipt-date" placeholder="Filter date">
                        </div>
                        <div id="table-payment_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer"
                            style="position: relative;">
                            <div id="table-payment_processing" class="dt-processing card" role="status"
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
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-7 gy-2 table-payment-history"
                                    style="width: 100%;">
                                    <thead>
                                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                            <th data-lang="Created at">Ngày tạo</th>
                                            <th data-lang="Quantity">Số lượng</th>
                                            <th data-lang="Method">Phương thức</th>
                                            <th data-lang="Details">Chi tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-7 fw-semibold text-gray-700" id="payment-table-body">
                                        @forelse($trans as $pay)
                                            <tr>
                                                <td>{{ $pay->created_at?->format('Y-m-d H:i:s') ?? '' }}</td>
                                                <td class="fw-bold"><span
                                                        class="text-success">{{ formatCharge($pay->amount) }}</span></td>
                                                <td>{{ $pay->payment_method ?? '' }}</td>
                                                <td>{{ $pay->description ?? '' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-3">
                                                    <span class="text-muted">Không có dữ liệu</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initDatePicker();
        });

        (function initDatePicker() {
            if (window.jQuery?.fn?.daterangepicker && window.moment) {
                jQuery(function($) {
                    const $dateInput = $('.ipt-date');

                    if ($dateInput.length) {
                        $dateInput.daterangepicker({
                            autoUpdateInput: false,
                            startDate: moment().startOf('month'),
                            endDate: moment().endOf('month'),
                            locale: {
                                format: 'YYYY/MM/DD',
                                separator: ' - ',
                                applyLabel: 'Áp dụng',
                                cancelLabel: 'Hủy',
                                customRangeLabel: 'Tùy chọn',
                                daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                                monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5',
                                    'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10',
                                    'Tháng 11', 'Tháng 12'
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

                        // When date selected, update input and filter automatically
                        $dateInput.on('apply.daterangepicker', function(ev, picker) {
                            $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate
                                .format('YYYY/MM/DD'));
                            toggleTableLoader(true);
                            applyFilters();
                        });

                        // When cancelled, clear input and reload
                        $dateInput.on('cancel.daterangepicker', function() {
                            $(this).val('');
                            toggleTableLoader(true);
                            applyFilters();
                        });

                        // Set initial value - default to current month
                        const startOfMonth = moment().startOf('month').format('YYYY/MM/DD');
                        const endOfMonth = moment().endOf('month').format('YYYY/MM/DD');
                        $dateInput.val(startOfMonth + ' - ' + endOfMonth);

                        // Show loader and apply default filter on page load
                        toggleTableLoader(true);
                        setTimeout(() => {
                            applyFilters();
                        }, 300);
                    }
                });
            } else {
                setTimeout(initDatePicker, 100);
            }
        })();

        function applyFilters() {
            const dateInput = document.querySelector('.ipt-date');
            const username = '{{ $accounts->username }}';

            const params = new URLSearchParams();

            // Add date range if filled
            if (dateInput?.value && dateInput.value.includes(' - ')) {
                const [dateFrom, dateTo] = dateInput.value.split(' - ');
                params.append('date_from', dateFrom.trim());
                params.append('date_to', dateTo.trim());
            }

            // Step 1: Show table loader (Loading...)
            toggleTableLoader(true);

            // Step 2: Fetch data while table loader is showing
            fetch(`{{ route('admin.accounts.payment', $accounts->username) }}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Step 3: Hide table loader when data is received
                    toggleTableLoader(false);

                    // Step 4: Show full screen loader
                    if (typeof showFullScreenLoader === 'function') {
                        showFullScreenLoader('Đang tải dữ liệu...', 'body');
                    }

                    // Step 5: Update table with data
                    setTimeout(() => {
                        const tbody = document.querySelector('#payment-table-body');
                        if (data.success && tbody) {
                            tbody.innerHTML = data.html;
                        } else if (tbody) {
                            tbody.innerHTML =
                                '<tr><td colspan="4" class="text-center py-3"><span class="text-muted">Không có dữ liệu</span></td></tr>';
                        }

                        // Step 6: Hide full screen loader after rendering
                        if (typeof hideFullScreenLoader === 'function') {
                            hideFullScreenLoader();
                        }
                    }, 300);
                })
                .catch(error => {
                    console.error('Error:', error);
                    toggleTableLoader(false);

                    // Show full screen loader for error
                    if (typeof showFullScreenLoader === 'function') {
                        showFullScreenLoader('Có lỗi xảy ra...', 'body');
                    }

                    setTimeout(() => {
                        const tbody = document.querySelector('#payment-table-body');
                        if (tbody) {
                            tbody.innerHTML =
                                '<tr><td colspan="4" class="text-center py-3"><span class="text-danger">Có lỗi xảy ra</span></td></tr>';
                        }

                        if (typeof hideFullScreenLoader === 'function') {
                            hideFullScreenLoader();
                        }
                    }, 300);
                });
        }

        function toggleTableLoader(show) {
            const loader = document.getElementById('table-payment_processing');
            const table = document.querySelector('.table-payment-history');

            if (loader) loader.style.display = show ? 'block' : 'none';
            if (table) table.style.opacity = show ? '0.4' : '1';
        }

        function convertCurrency() {
            const currencyValue = parseFloat(document.querySelector('.ipt-currency-value').value) || 0;
            const currencyRate = parseFloat(document.querySelector('.ipt-currency-rate').value) || 1;
            const usdAmount = currencyValue / currencyRate;
            document.querySelector('.ipt-fund-amount').value = usdAmount.toFixed(2);
        }

        function handlePaymentMethodChange() {
            const select = document.querySelector('.sl-payment-method');
            const selectedOption = select.options[select.selectedIndex];
            
            if (!selectedOption.value) {
                // Hide currency converter if no method selected
                const currencyDiv = document.querySelector('.div-currency');
                if (currencyDiv) currencyDiv.style.display = 'none';
                return;
            }

            const currency = selectedOption.getAttribute('data-currency') || 'USD';
            const rate = selectedOption.getAttribute('data-rate') || '1';
            
            // Show currency converter only if currency is VND
            const currencyDiv = document.querySelector('.div-currency');
            if (currencyDiv) {
                if (currency === 'VND') {
                    currencyDiv.style.display = 'block';
                    document.querySelector('.ipt-currency-rate').value = rate;
                    document.querySelector('.currency-symbol').textContent = currency;
                } else {
                    currencyDiv.style.display = 'none';
                }
            }

            // Update currency symbol in amount input
            const currencySymbol = document.querySelector('.currency-amount-symbol');
            if (currencySymbol) {
                currencySymbol.textContent = currency || 'USD';
            }
        }

        function submitFundDeposit() {
            const select = document.querySelector('.sl-payment-method');
            const selectedOption = select.options[select.selectedIndex];
            const paymentId = selectedOption.value;
            const amount = parseFloat(document.querySelector('.ipt-fund-amount').value);
            const description = document.querySelector('.txa-fund-details').value;

            // Validation
            if (!paymentId) {
                if (typeof showToast === 'function') {
                    showToast('Vui lòng chọn phương thức thanh toán!', 'warning');
                }
                return;
            }

            if (!amount || amount <= 0) {
                if (typeof showToast === 'function') {
                    showToast('Vui lòng nhập số lượng hợp lệ!', 'warning');
                }
                return;
            }

            // Get payment method name
            const paymentName = selectedOption.textContent;

            // Store data for confirmation
            window.depositData = {
                paymentId: paymentId,
                amount: amount,
                description: description,
                paymentName: paymentName,
                type: paymentId === 'bonus' ? 'bonus' : 'deposit'
            };

            // Show confirmation modal
            const confirmModal = new bootstrap.Modal(document.getElementById('modal-confirm'));
            document.querySelector('.confirm-amount').textContent = amount.toFixed(2);
            confirmModal.show();
        }

        function confirmFundDeposit() {
            const data = window.depositData;
            if (!data) return;

            // Close modal first
            const confirmModal = bootstrap.Modal.getInstance(document.getElementById('modal-confirm'));
            if (confirmModal) confirmModal.hide();

            // Show loading after modal closes
            setTimeout(() => {
                if (typeof showFullScreenLoader === 'function') {
                    showFullScreenLoader('Đang xử lý nạp tiền...', 'body');
                }

                // Submit to server
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const accountId = '{{ $accounts->id }}';

                fetch(`/admin/accounts/${accountId}/update-balance`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        amount: data.amount,
                        type: data.type ?? 'deposit',
                        payment_method: data.paymentName,
                        description: data.description,
                        payment_id: data.paymentId === 'bonus' ? null : data.paymentId
                    })
                })
                .then(response => response.json())
                .then(result => {
                    if (typeof hideFullScreenLoader === 'function') {
                        hideFullScreenLoader();
                    }

                    if (result.success) {
                        if (typeof showToast === 'function') {
                            showToast('Nạp tiền thành công!', 'success');
                        }

                        // Update balance display
                        if (result.user) {
                            const newBalance = result.user.balance;
                            const balanceElement = document.querySelector('.account-fund');
                            if (balanceElement) {
                                balanceElement.textContent = '$ ' + formatBalance(newBalance);
                            }

                            // Update info cards
                            const totalDeposit = parseFloat(result.user.balance) + data.amount;
                            const depositElement = document.querySelector('.info-fund-deposit');
                            if (depositElement) {
                                depositElement.textContent = '$ ' + formatBalance(totalDeposit);
                            }
                        }

                        // Reset form
                        document.querySelector('.sl-payment-method').value = '';
                        document.querySelector('.ipt-fund-amount').value = '';
                        document.querySelector('.txa-fund-details').value = '';
                        document.querySelector('.div-currency').style.display = 'none';

                        // Reload transactions table
                        setTimeout(() => {
                            applyFilters();
                        }, 500);
                    } else {
                        if (typeof showToast === 'function') {
                            showToast(result.message || 'Có lỗi xảy ra!', 'error');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (typeof hideFullScreenLoader === 'function') {
                        hideFullScreenLoader();
                    }
                    if (typeof showToast === 'function') {
                        showToast('Có lỗi xảy ra!', 'error');
                    }
                });
            }, 300);
        }

        function formatBalance(balance) {
            return parseFloat(balance).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }
    </script>


    <script>
        // Set selected values when modal is shown
        document.getElementById('kt_modal_edit_account').addEventListener('show.bs.modal', function() {
            // Set role
            const roleValue = '{{ $accounts->role === 'admin' ? 'admin' : $accounts->level ?? 'retail' }}';
            document.querySelector('.sl-role').value = roleValue;
            if (window.jQuery) {
                jQuery('.sl-role').trigger('change');
            }

            // Set status
            const statusValue = '{{ $accounts->is_active ? '1' : '0' }}';
            document.querySelector('.sl-status').value = statusValue;
            if (window.jQuery) {
                jQuery('.sl-status').trigger('change');
            }
        });

        function updateAccount() {
                        if (typeof showFullScreenLoader === 'function') {
                showFullScreenLoader('Đang cập nhật tài khoản...', '#kt_modal_edit_account');
            }

            const username = '{{ $accounts->username }}';
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            const data = {
                name: document.querySelector('.ipt-name').value.trim(),
                email: document.querySelector('.ipt-email').value.trim(),
                phone: document.querySelector('.ipt-phone').value.trim(),
                password: document.querySelector('.ipt-password').value.trim(),
                bonus_percent: document.querySelector('.ipt-percent').value.trim(),
                role: document.querySelector('.sl-role').value.trim(),
                is_active: document.querySelector('.sl-status').value.trim()
            };

            fetch(`/admin/accounts/${username}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                                                if (typeof hideFullScreenLoader === 'function') {
                            hideFullScreenLoader();
                        }


                        // Close modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('kt_modal_edit_account'));
                        if (modal) modal.hide();

                        // Update displayed data without reload
                        if (result.user) {
                            // Update name in header if exists
                            const nameElement = document.querySelector('.account-name');
                            if (nameElement && result.user.name) {
                                nameElement.textContent = result.user.name;
                            }

                            // Update email in header if exists
                            const emailElement = document.querySelector('.account-email');
                            if (emailElement && result.user.email) {
                                emailElement.textContent = result.user.email;
                            }

                            // Update phone in header if exists
                            const phoneElement = document.querySelector('.account-phone');
                            if (phoneElement && result.user.phone) {
                                phoneElement.textContent = result.user.phone;
                            }

                            // Update status badge
                            const statusBadge = document.querySelector('.account-status-badge');
                            if (statusBadge) {
                                if (result.user.is_active) {
                                    statusBadge.className = 'badge badge-success';
                                    statusBadge.textContent = 'Kích hoạt';
                                } else {
                                    statusBadge.className = 'badge badge-danger';
                                    statusBadge.textContent = 'Vô hiệu hóa';
                                }
                            }

                            // Update role display
                            const roleElement = document.querySelector('.account-role');
                            if (roleElement && result.user.role) {
                                const roleText = result.user.role === 'admin' ? 'Admin' : 'User';
                                roleElement.textContent = roleText;
                            }
                        }
                    } else {
                        if (typeof showToast === 'function') {
                            showToast(result.message || 'Cập nhật thất bại!', 'error');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (typeof showToast === 'function') {
                        showToast('Có lỗi xảy ra!', 'error');
                    }
                });
        }

        // Initialize Select2 with custom template for payment method
        function initPaymentSelect2() {
            // Apply translation to options
            document.querySelectorAll('.sl-payment-method option[data-lang]').forEach(function(opt) {
                const key = opt.getAttribute('data-lang');
                if (key && typeof window.tr === 'function') {
                    const translated = window.tr(key);
                    if (translated && translated !== key) opt.textContent = translated;
                }
            });

            if (window.jQuery && window.jQuery.fn.select2) {
                jQuery('.sl-payment-method').select2({
                    templateResult: formatMethod,
                    templateSelection: formatMethod,
                    allowClear: false,
                    minimumResultsForSearch: 0,
                    width: '100%',
                    escapeMarkup: function(m) { return m; }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Chờ t() chạy xong (800ms) rồi mới init select2
            setTimeout(initPaymentSelect2, 900);

            // Reinit khi đổi ngôn ngữ
            const _origChangeLang = app?.on?.click?.changeLanguage;
            if (app?.on?.click) {
                app.on.click.changeLanguage = async function(l) {
                    if (_origChangeLang) await _origChangeLang(l);
                    setTimeout(initPaymentSelect2, 100);
                };
            }
        });

        function formatMethod(item) {
            if (!item.id) return item.text;

            const icon = jQuery(item.element).data('icon') || '';
            let prefix = '';

            if (icon && icon.match(/^(fa|fas|fab|far)-/i)) {
                prefix = `<i class="${icon} me-2"></i>`;
            } else if (icon && icon.match(/^https?:\/\//)) {
                prefix = `<img src="${icon}" alt="${item.text}" loading="lazy" class="me-2" style="width:20px;height:20px;object-fit:contain;border-radius:3px;" />`;
            }

            return jQuery(`<span class="d-flex align-items-center">${prefix}${item.text}</span>`);
        }
    </script>

    <!-- Modal Xác nhận nạp tiền -->
    <div class="modal fade" id="modal-confirm" tabindex="-1" data-bs-backdrop="static" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered rounded-4">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white py-4">
                    <h4 class="modal-title text-white ls-1">Xác nhận</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-10 fs-4">
                    <p class="text-center">$ <span class="fs-1 ls-1 fw-bolder text-primary confirm-amount">0.00</span></p>
                    <p class="text-center mb-0">Bạn có chắc chắn muốn nạp tiền vào tài khoản này?</p>
                </div>
                <div class="modal-footer py-4">
                    <button type="button" class="btn btn-sm btn-secondary px-4 rounded-4" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-sm btn-warning px-4 rounded-4" onclick="confirmFundDeposit()">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>

@endsection
