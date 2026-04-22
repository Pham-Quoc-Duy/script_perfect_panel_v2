// Service Edit Page - Handle translated names
document.addEventListener('DOMContentLoaded', function() {
    // Store all translated names data
    window.translatedNamesData = {};

    // Initialize connection type on page load
    const addTypeSelect = document.querySelector('.sl-service-add-type');
    if (addTypeSelect) {
        toggleConnectionType(addTypeSelect.value);
    }

    // Load services handled by blade inline script (loadProviderServices)

    // Handle service selection change - fire only on user interaction via select2:select
    const serviceSelect = document.querySelector('.sl-provider-sid');
    if (serviceSelect) {
        // select2:select only fires when user picks an option, not on programmatic .val()
        $(document).on('select2:select', '.sl-provider-sid', function(e) {
            handleServiceSelection(e.params.data.id);
        });
    }

    // Override the original addTranslatedName to store data
    const originalAddTranslatedName = window.addTranslatedName;
    window.addTranslatedName = function(langCode) {
        // Call original function
        if (originalAddTranslatedName) {
            originalAddTranslatedName(langCode);
        }

        // Store the language code
        if (!window.translatedNamesData[langCode]) {
            window.translatedNamesData[langCode] = '';
        }
    };

    // Listen for input changes to store data
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('ipt-service-translated-name')) {
            const langCode = e.target.getAttribute('data-lang');
            if (langCode) {
                window.translatedNamesData[langCode] = e.target.value;
            }
        }
    });
});

// Store all services data globally
window.allServicesData = {};

// Load services on page load
window.loadServicesOnPageLoad = function() {
    const providerSelect = document.querySelector('.sl-provider');
    const serviceSelect = document.querySelector('.sl-provider-sid');
    const serviceApiInput = document.querySelector('.ipt-service-api');

    if (!providerSelect || !serviceSelect) {
        return;
    }

    const providerId = providerSelect.value;

    if (!providerId || providerId === '0') {
        return;
    }

    // Fetch services from provider using new endpoint
    const endpoint = `/admin/services/provider/${providerId}/services`;

    fetch(endpoint, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            credentials: 'include'
        })
        .then(response => response.json())
        .then(data => {
            if (data.services && Array.isArray(data.services)) {
                // Clear existing options
                serviceSelect.innerHTML = '<option value="">Chọn dịch vụ</option>';

                // Store services data globally
                window.allServicesData = {};

                // Add options for each service
                data.services.forEach(service => {
                    const option = document.createElement('option');
                    option.value = service.id;
                    option.text = service.name;

                    // Store full service data
                    window.allServicesData[service.id] = service;

                    serviceSelect.appendChild(option);
                });

                // If there's a current service_api value, select it
                if (serviceApiInput && serviceApiInput.value) {
                    serviceSelect.value = serviceApiInput.value;
                    serviceSelect.dispatchEvent(new Event('change'));
                }
            }
        })
        .catch(error => {
            console.error('Error loading services:', error);
        });
};

// Handle service selection - update form fields with selected service data
window.handleServiceSelection = function(serviceId) {
    if (!serviceId) return;

    const serviceSelect = document.querySelector('.sl-provider-sid');
    if (!serviceSelect) return;

    const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
    if (!selectedOption) return;

    const dataInfo = selectedOption.getAttribute('data-service-info');
    if (!dataInfo) return;

    let service;
    try {
        service = JSON.parse(dataInfo);
    } catch (e) {
        return;
    }

    // 1. Name
    const nameInput = document.querySelector('.ipt-service-name');
    if (nameInput && service.name) {
        nameInput.value = service.name;
    }

    // 2. Rate - update #rate-original-display và input giá gốc
    const rateDisplay = document.getElementById('rate-original-display');
    if (rateDisplay) rateDisplay.textContent = service.rate !== undefined ? service.rate : '0';

    const rateInput = document.querySelector('.ipt-service-oprice');
    if (rateInput) rateInput.value = service.rate !== undefined ? service.rate : '';

    // 3. Min / Max inputs + label display
    const minInput = document.querySelector('.ipt-service-min');
    const maxInput = document.querySelector('.ipt-service-max');
    if (minInput) minInput.value = service.min !== undefined ? service.min : '';
    if (maxInput) maxInput.value = service.max !== undefined ? service.max : '';

    const minDisplay = document.getElementById('min-display');
    const maxDisplay = document.getElementById('max-display');
    if (minDisplay) minDisplay.textContent = service.min !== undefined ? service.min : '';
    if (maxDisplay) maxDisplay.textContent = service.max !== undefined ? service.max : '';

    // 4. Refill checkbox
    const refillCheckbox = document.querySelector('.cb-service-refill');
    if (refillCheckbox) {
        refillCheckbox.checked = !!service.refill;
        refillCheckbox.disabled = !service.refill;
    }

    // 5. Cancel checkbox
    const cancelCheckbox = document.querySelector('.cb-service-cancel');
    if (cancelCheckbox) {
        cancelCheckbox.checked = !!service.cancel;
        cancelCheckbox.disabled = !service.cancel;
    }

    // 6. Description
    const descriptionInput = document.getElementById('service-description-content');
    if (descriptionInput) {
        descriptionInput.value = service.description ? service.description : '';
    }
    // Update Quill editor if available
    const quillEditor = document.querySelector('#editor-service-description');
    if (quillEditor && quillEditor.__quill) {
        quillEditor.__quill.setText(service.description ? service.description : '');
    }

    // 7. Type (service order type)
    const typeSelect = document.querySelector('.sl-service-type');
    if (typeSelect && service.type) {
        typeSelect.value = service.type;
        if (window.$ && $(typeSelect).data('select2')) {
            $(typeSelect).trigger('change');
        }
        const typeDisplay = document.getElementById('type-display');
        if (typeDisplay) typeDisplay.textContent = service.type;
    }

    // 8. Check tất cả sync checkboxes
    const syncCheckboxes = document.querySelectorAll('.cb-sync');
    syncCheckboxes.forEach(function(cb) {
        cb.checked = true;
        cb.dispatchEvent(new Event('change'));
    });
};

// Helper function to get selected attributes from select element
function getSelectedAttributes() {
    const attributesSelect = document.querySelector('.sl-features');
    let selectedAttributes = [];

    if (!attributesSelect) {
        return selectedAttributes;
    }

    // Try to get from Select2 first
    if (window.$ && $(attributesSelect).data('select2')) {
        selectedAttributes = $(attributesSelect).val() || [];
    } else {
        // Fallback to native select
        selectedAttributes = Array.from(attributesSelect.selectedOptions).map(opt => opt.value);
    }

    // Ensure it's an array and filter empty values
    if (!Array.isArray(selectedAttributes)) {
        selectedAttributes = selectedAttributes ? [selectedAttributes] : [];
    }

    selectedAttributes = selectedAttributes.filter(attr => attr && attr.trim && attr.trim() !== '');

    return selectedAttributes;
}

// Collect all translated names before form submission
function collectTranslatedNames() {
    const container = document.getElementById('div-translated-name');
    if (!container) return {};

    const nameData = {};

    // Get main English name
    const mainNameInput = document.querySelector('.ipt-service-name');
    if (mainNameInput) {
        nameData['en'] = mainNameInput.value;
    }

    // Collect all translated names (including hidden ones)
    const allInputs = container.querySelectorAll('input.ipt-service-translated-name');
    allInputs.forEach(input => {
        const langCode = input.getAttribute('data-lang');
        const value = input.value.trim();
        if (value) {
            nameData[langCode] = value;
        }
    });

    return nameData;
}

// Toggle connection type (manual/api)
window.toggleConnectionType = function(type) {
    const manualFields = document.querySelector('.div-oprice-manual');
    const apiContainer = document.querySelector('.div-type-api-container');
    const copyButtons = document.querySelectorAll('.btn-copy');
    const showApiElements = document.querySelectorAll('.show-api');

    if (type === 'manual') {
        // Show manual fields
        if (manualFields) manualFields.style.display = 'block';
        if (apiContainer) apiContainer.style.display = 'none';

        // Hide copy buttons and API data
        copyButtons.forEach(btn => btn.style.display = 'none');
        showApiElements.forEach(el => el.style.display = 'none');
    } else if (type === 'api') {
        // Show API fields
        if (manualFields) manualFields.style.display = 'none';
        if (apiContainer) apiContainer.style.display = 'block';

        // Show copy buttons and API data
        copyButtons.forEach(btn => btn.style.display = 'inline-block');
        showApiElements.forEach(el => el.style.display = '');
    }
};

// Add translated name field
window.addTranslatedName = function(langCode) {
    const container = document.getElementById('div-translated-name');
    if (!container) {
        console.error('Translated name container not found');
        return;
    }

    // Check if language already exists
    const existingField = container.querySelector(`[data-language="${langCode}"]`);
    if (existingField) {
        alert('Ngôn ngữ này đã được thêm!');
        return;
    }

    // Get flag code (vi -> vn for Vietnam)
    const flagCode = langCode === 'vi' ? 'vn' : langCode;

    // Create new field - matching the structure
    const fieldHtml = `
        <div class="mb-5 div-translated-${langCode}" data-language="${langCode}">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-secondary">
                    <span class="rounded-1 fi fi-${flagCode} fs-5 me-2"></span>
                    <span>${langCode.toUpperCase()}</span>
                </span>
                <input type="text" 
                       class="form-control ipt-service-translated-name" 
                       data-lang="${langCode}"
                       name="name[${langCode}]">
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', fieldHtml);
};

// Remove translated name field
window.removeTranslatedName = function(langCode) {
    const field = document.querySelector(`.div-translated-${langCode}[data-language="${langCode}"]`);
    if (field) {
        field.remove();

        // Remove from stored data
        if (window.translatedNamesData && window.translatedNamesData[langCode]) {
            delete window.translatedNamesData[langCode];
        }
    }
};

// Placeholder functions for service edit page
window.handleServiceTypeChange = function(value) {
    // Service type change handler
};

window.sync = function(value) {
    // Sync checkbox handler
};

window.copyFromProvider = function(type) {
    // Copy from provider handler
    if (type === 'feature') {
        alert('Chức năng sao chép thuộc tính từ nhà cung cấp sẽ được triển khai sau.');
    } else if (type === 'summary') {
        alert('Chức năng sao chép thông số từ nhà cung cấp sẽ được triển khai sau.');
    }
};

// Format number with proper rounding: 0.8000 = 0.80, 0.0040 = 0.004, 0.0210 = 0.021
function formatPrice(value) {
    if (!value || isNaN(value)) return '';

    const num = parseFloat(value);
    if (num === 0) return '0';

    // Convert to string and remove trailing zeros after decimal point
    let formatted = num.toFixed(10); // Start with high precision
    formatted = parseFloat(formatted).toString(); // Remove trailing zeros

    return formatted;
}

window.retail_rate = function(value) {
    const input = document.querySelector('.ipt-service-price');
    if (input) {
        input.value = formatPrice(value);
    }
};

window.price_percent = function(value, type) {};

window.summary = function() {
    // Summary field change handler
    // This function is called when summary fields are updated
};

// Handle sync checkboxes and input disable/enable
document.addEventListener('DOMContentLoaded', function() {
    // Format all price inputs on page load
    const priceInputs = document.querySelectorAll('.ipt-service-price, .ipt-service-price-1, .ipt-service-price-2, .ipt-service-oprice');
    priceInputs.forEach(input => {
        if (input.value) {
            input.value = formatPrice(input.value);
        }
    });

    // Format rate_original display
    const rateOriginalDisplay = document.getElementById('rate-original-display');
    if (rateOriginalDisplay && rateOriginalDisplay.textContent.trim()) {
        rateOriginalDisplay.textContent = formatPrice(rateOriginalDisplay.textContent.trim()) || '0';
    }

    // Sync rate-original-display với ipt-service-oprice nếu có value
    const opriceInput = document.querySelector('.ipt-service-oprice');
    if (opriceInput && opriceInput.value && rateOriginalDisplay) {
        rateOriginalDisplay.textContent = formatPrice(opriceInput.value) || '0';
    }

    // Add event listeners for real-time formatting
    priceInputs.forEach(input => {
        input.addEventListener('blur', function() {
            this.value = formatPrice(this.value);
        });
    });

    // Function to disable/enable price inputs (only the price, not the markup percentage)
    function updatePriceInputs(shouldDisable) {
        const priceInputs = document.querySelectorAll('.ipt-service-price, .ipt-service-price-1, .ipt-service-price-2');
        priceInputs.forEach(input => {
            input.disabled = shouldDisable;
        });
    }

    // Function to disable/enable min/max inputs
    function updateMinMaxInputs(shouldDisable) {
        const minMaxInputs = document.querySelectorAll('.ipt-service-min, .ipt-service-max');
        minMaxInputs.forEach(input => {
            input.disabled = shouldDisable;
        });
    }

    // Function to check if all sync checkboxes are checked
    function updateAutoSyncCheckbox() {
        const syncRateCheckbox = document.querySelector('.cb-service-sync-rate');
        const syncMinmaxCheckbox = document.querySelector('.cb-service-sync-minmax');
        const syncRefillCheckbox = document.querySelector('.cb-service-sync-refill');
        const syncCancelCheckbox = document.querySelector('.cb-service-sync-cancel');
        const syncStatusCheckbox = document.querySelector('.cb-service-sync-status');
        const autoSyncCheckbox = document.querySelector('.cb-service-sync');

        if (autoSyncCheckbox && syncRateCheckbox && syncMinmaxCheckbox && syncRefillCheckbox && syncCancelCheckbox && syncStatusCheckbox) {
            const allChecked = syncRateCheckbox.checked && syncMinmaxCheckbox.checked && syncRefillCheckbox.checked && syncCancelCheckbox.checked && syncStatusCheckbox.checked;
            autoSyncCheckbox.checked = allChecked;
        }
    }

    // Handle rate sync checkbox
    const syncRateCheckbox = document.querySelector('.cb-service-sync-rate');
    if (syncRateCheckbox) {
        // Set initial state
        updatePriceInputs(syncRateCheckbox.checked);

        syncRateCheckbox.addEventListener('change', function() {
            updatePriceInputs(this.checked);
            updateAutoSyncCheckbox();
        });
    }

    // Handle minmax sync checkbox
    const syncMinmaxCheckbox = document.querySelector('.cb-service-sync-minmax');
    if (syncMinmaxCheckbox) {
        // Set initial state
        updateMinMaxInputs(syncMinmaxCheckbox.checked);

        syncMinmaxCheckbox.addEventListener('change', function() {
            updateMinMaxInputs(this.checked);
            updateAutoSyncCheckbox();
        });
    }

    // Handle refill sync checkbox
    const syncRefillCheckbox = document.querySelector('.cb-service-sync-refill');
    if (syncRefillCheckbox) {
        const refillCheckbox = document.querySelector('.cb-service-refill');
        if (refillCheckbox) {
            // Set initial state
            refillCheckbox.disabled = syncRefillCheckbox.checked;

            syncRefillCheckbox.addEventListener('change', function() {
                refillCheckbox.disabled = this.checked;
                updateAutoSyncCheckbox();
            });
        }
    }

    // Handle cancel sync checkbox
    const syncCancelCheckbox = document.querySelector('.cb-service-sync-cancel');
    if (syncCancelCheckbox) {
        const cancelCheckbox = document.querySelector('.cb-service-cancel');
        if (cancelCheckbox) {
            // Set initial state
            cancelCheckbox.disabled = syncCancelCheckbox.checked;

            syncCancelCheckbox.addEventListener('change', function() {
                cancelCheckbox.disabled = this.checked;
                updateAutoSyncCheckbox();
            });
        }
    }

    // Handle status sync checkbox
    const syncStatusCheckbox = document.querySelector('.cb-service-sync-status');
    if (syncStatusCheckbox) {
        syncStatusCheckbox.addEventListener('change', function() {
            updateAutoSyncCheckbox();
        });
    }

    // Handle auto sync checkbox
    const autoSyncCheckbox = document.querySelector('.cb-service-sync');
    if (autoSyncCheckbox) {
        autoSyncCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // Check all individual sync checkboxes
                if (syncRateCheckbox) syncRateCheckbox.checked = true;
                if (syncMinmaxCheckbox) syncMinmaxCheckbox.checked = true;
                if (syncRefillCheckbox) syncRefillCheckbox.checked = true;
                if (syncCancelCheckbox) syncCancelCheckbox.checked = true;
                if (syncStatusCheckbox) syncStatusCheckbox.checked = true;

                // Trigger change events to update inputs
                if (syncRateCheckbox) syncRateCheckbox.dispatchEvent(new Event('change'));
                if (syncMinmaxCheckbox) syncMinmaxCheckbox.dispatchEvent(new Event('change'));
                if (syncRefillCheckbox) syncRefillCheckbox.dispatchEvent(new Event('change'));
                if (syncCancelCheckbox) syncCancelCheckbox.dispatchEvent(new Event('change'));
                if (syncStatusCheckbox) syncStatusCheckbox.dispatchEvent(new Event('change'));
            } else {
                // Uncheck all individual sync checkboxes
                if (syncRateCheckbox) syncRateCheckbox.checked = false;
                if (syncMinmaxCheckbox) syncMinmaxCheckbox.checked = false;
                if (syncRefillCheckbox) syncRefillCheckbox.checked = false;
                if (syncCancelCheckbox) syncCancelCheckbox.checked = false;
                if (syncStatusCheckbox) syncStatusCheckbox.checked = false;

                // Trigger change events to update inputs
                if (syncRateCheckbox) syncRateCheckbox.dispatchEvent(new Event('change'));
                if (syncMinmaxCheckbox) syncMinmaxCheckbox.dispatchEvent(new Event('change'));
                if (syncRefillCheckbox) syncRefillCheckbox.dispatchEvent(new Event('change'));
                if (syncCancelCheckbox) syncCancelCheckbox.dispatchEvent(new Event('change'));
                if (syncStatusCheckbox) syncStatusCheckbox.dispatchEvent(new Event('change'));
            }
        });
    }

    // Set initial state of auto sync checkbox
    updateAutoSyncCheckbox();
});


// Update service function
window.update = function(serviceId) {
    // Get service ID from URL parameter if not provided
    if (!serviceId) {
        const urlParams = new URLSearchParams(window.location.search);
        serviceId = urlParams.get('id');
    }

    if (!serviceId) {
        console.error('Service ID not found in URL or parameter');
        alert('Không tìm thấy Service ID. Vui lòng kiểm tra URL.');
        return;
    }

    // Get button element
    const btn = document.getElementById('updateServiceBtn');
    if (!btn) {
        console.error('Update button not found');
        return;
    }

    // Save original button content
    const originalBtnContent = btn.innerHTML;

    // Collect all form data
    const formData = new FormData();

    // Add _method for Laravel to recognize PUT request
    formData.append('_method', 'PUT');

    // 1. Collect connection type (manual/api)
    const addTypeSelect = document.querySelector('.sl-service-add-type');
    const connectionType = addTypeSelect ? addTypeSelect.value : 'manual';
    // Map 'manual' -> 'normal' cho controller
    formData.append('type', connectionType);

    // 2. Collect provider and service_api (for API type)
    if (connectionType === 'api') {
        const providerSelect = document.querySelector('.sl-provider');
        const providerServiceSelect = document.querySelector('.sl-provider-sid');

        if (providerSelect && providerSelect.value && providerSelect.value !== '0') {
            formData.append('provider_id', providerSelect.value);
        }

        if (providerServiceSelect && providerServiceSelect.value) {
            formData.append('provider_service_id', providerServiceSelect.value);
            formData.append('service_api', providerServiceSelect.value);
        }
    }

    // 3. Collect rate_original (giá gốc)
    const rateOriginalInput = document.querySelector('.ipt-service-oprice');
    if (rateOriginalInput && rateOriginalInput.value) {
        formData.append('rate_original', rateOriginalInput.value);
    }

    // 4. Collect category
    const categorySelect = document.querySelector('.sl-category');
    if (categorySelect && categorySelect.value) {
        formData.append('category_id', categorySelect.value);
    }

    // 5. Collect service name (English + translated names)
    const nameInput = document.querySelector('.ipt-service-name');
    if (nameInput && nameInput.value) {
        formData.append('name[en]', nameInput.value);
    }

    // Collect translated names
    const translatedContainer = document.getElementById('div-translated-name');
    if (translatedContainer) {
        const translatedInputs = translatedContainer.querySelectorAll('input.ipt-service-translated-name');
        translatedInputs.forEach(input => {
            const langCode = input.getAttribute('data-lang');
            if (langCode && input.value.trim()) {
                formData.append(`name[${langCode}]`, input.value);
            }
        });
    }

    // 6. Collect pricing fields
    const priceInputs = {
        'rate_retail': '.ipt-service-price',
        'rate_agent': '.ipt-service-price-1',
        'rate_distributor': '.ipt-service-price-2',
        'rate_retail_up': '.ipt-service-price-percent',
        'rate_agent_up': '.ipt-service-price-1-percent',
        'rate_distributor_up': '.ipt-service-price-2-percent'
    };

    Object.entries(priceInputs).forEach(([fieldName, selector]) => {
        const input = document.querySelector(selector);
        if (input && input.value) {
            formData.append(fieldName, input.value);
        }
    });

    // 7. Collect min/max
    const minInput = document.querySelector('.ipt-service-min');
    const maxInput = document.querySelector('.ipt-service-max');
    if (minInput && minInput.value) formData.append('min', minInput.value);
    if (maxInput && maxInput.value) formData.append('max', maxInput.value);

    // 8. Collect total_limit and limit
    const totalLimitInput = document.querySelector('.ipt-service-tlimit');
    const limitInput = document.querySelector('.ipt-service-limit');
    if (totalLimitInput && totalLimitInput.value) formData.append('total_limit', totalLimitInput.value);
    if (limitInput && limitInput.value) formData.append('limit', limitInput.value);

    // 9. Collect type_service (kiểu dịch vụ)
    const typeServiceSelect = document.querySelector('.sl-service-type');
    if (typeServiceSelect && typeServiceSelect.value) {
        formData.append('type_service', typeServiceSelect.value);
    }

    // 10. Collect description (from hidden input)
    const descriptionInput = document.getElementById('service-description-content');
    if (descriptionInput && descriptionInput.value) {
        let descriptionValue = descriptionInput.value;

        // Check if it's Quill Delta format (JSON)
        try {
            const parsed = JSON.parse(descriptionValue);
            if (parsed.ops && Array.isArray(parsed.ops)) {
                // Extract plain text from Quill Delta
                descriptionValue = parsed.ops
                    .map(op => typeof op.insert === 'string' ? op.insert : '')
                    .join('')
                    .trim();
            }
        } catch (e) {
            // Not JSON, use as-is (could be HTML or plain text)
        }

        if (descriptionValue) {
            formData.append('description', descriptionValue);
        }
    }

    // 11. Collect status checkbox
    const statusCheckbox = document.querySelector('.cb-service-status');
    if (statusCheckbox) {
        formData.append('status', statusCheckbox.checked ? '1' : '0');
    }

    // 11. Collect refill and cancel checkboxes
    const refillCheckbox = document.querySelector('.cb-service-refill');
    const cancelCheckbox = document.querySelector('.cb-service-cancel');
    if (refillCheckbox) {
        formData.append('refill', refillCheckbox.checked ? '1' : '0');
    }
    if (cancelCheckbox) {
        formData.append('cancel', cancelCheckbox.checked ? '1' : '0');
    }

    // 12. Collect sync options
    const syncRateCheckbox = document.querySelector('.cb-service-sync-rate');
    const syncMinMaxCheckbox = document.querySelector('.cb-service-sync-minmax');
    const syncRefillCheckbox = document.querySelector('.cb-service-sync-refill');
    const syncCancelCheckbox = document.querySelector('.cb-service-sync-cancel');
    const syncStatusCheckbox = document.querySelector('.cb-service-sync-status');

    if (syncRateCheckbox) formData.append('sync_rate', syncRateCheckbox.checked ? '1' : '0');
    if (syncMinMaxCheckbox) formData.append('sync_min_max', syncMinMaxCheckbox.checked ? '1' : '0');
    if (syncStatusCheckbox) formData.append('sync_action', syncStatusCheckbox.checked ? '1' : '0');

    // 13. Collect attributes from select2
    const selectedAttributes = getSelectedAttributes();

    // Send attributes as array
    if (selectedAttributes.length > 0) {
        selectedAttributes.forEach((attr, index) => {
            formData.append(`attributes[${index}]`, attr);
        });
    }

    // 14. Collect reaction field
    const reactionInput = document.querySelector('.ipt-service-reaction');
    if (reactionInput && reactionInput.value.trim()) {
        formData.append('reaction', reactionInput.value.trim().toUpperCase());
    }

    // 15. Collect summary fields (thông số dịch vụ)
    const summaryFields = document.querySelectorAll('.card-summary .input-group');
    summaryFields.forEach(field => {
        const checkbox = field.querySelector('input[type="checkbox"]');
        const input = field.querySelector('input[type="text"]');
        const key = field.getAttribute('data-key');

        if (checkbox && checkbox.checked && input && input.value && key) {
            formData.append(`summary[${key}]`, input.value);
        }
    });

    // 16. Collect average_time
    const avgTimeInput = document.querySelector('.ipt-service-avg-time');
    if (avgTimeInput) formData.append('average_time', avgTimeInput.value || '0');

    // 17. Collect provider_name từ option text của sl-provider
    if (connectionType === 'api') {
        const providerSelect = document.querySelector('.sl-provider');
        if (providerSelect && providerSelect.value && providerSelect.value !== '0') {
            const selectedOption = providerSelect.options[providerSelect.selectedIndex];
            if (selectedOption) formData.append('provider_name', selectedOption.text.trim());
        }
    }

    // Send update request
    const url = `/admin/services/edit?id=${serviceId}`;

    if (typeof showFullScreenLoader === 'function') showFullScreenLoader('', '');

    fetch(url, {
            method: 'POST', // Use POST instead of PUT for FormData
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            // Check if response is ok
            if (!response.ok) {
                return response.json().then(errorData => {
                    throw {
                        status: response.status,
                        data: errorData
                    };
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const message = typeof data.success === 'string' ? data.success : 'Cập nhật thành công!';
                showToast(message, 'success');

                // Re-enable button without reloading page
                if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                btn.innerHTML = originalBtnContent;
            } else {
                const errorMessage = data.message || 'Lỗi khi cập nhật dịch vụ';
                showToast(errorMessage, 'error');

                // Log validation errors if present
                if (data.errors) {
                    console.error('Validation errors:', data.errors);
                }

                if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                btn.innerHTML = originalBtnContent;
            }
        })
        .catch(error => {
            console.error('Error:', error);

            // Handle validation errors (422 status)
            if (error.status === 422 && error.data && error.data.errors) {
                console.error('Validation errors:', error.data.errors);
                const errors = error.data.errors;

                // Show first error in toast
                const firstField = Object.keys(errors)[0];
                const firstError = errors[firstField][0];
                showToast(`Lỗi validation: ${firstError}`, 'error');
            }
            // Handle other HTTP errors
            else if (error.status && error.data) {
                console.error(`HTTP Error ${error.status}:`, error.data);
                const errorMessage = error.data.message || `Lỗi HTTP ${error.status}`;
                showToast(errorMessage, 'error');
            }
            // Handle network errors
            else {
                console.error('Network or unknown error:', error);
                const errorMessage = error.message || 'Đã xảy ra lỗi khi cập nhật dịch vụ';
                showToast(`Lỗi: ${errorMessage}`, 'error');
            }

            console.error('=== END ERROR ===');

            if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
            btn.innerHTML = originalBtnContent;
        });
};

// Delete service function with confirmation
window.confirmDelete = function(serviceId) {
    // Get service ID from URL parameter if not provided
    if (!serviceId) {
        const urlParams = new URLSearchParams(window.location.search);
        serviceId = urlParams.get('id');
    }

    if (!serviceId) {
        console.error('Service ID not found in URL or parameter');
        alert('Không tìm thấy Service ID. Vui lòng kiểm tra URL.');
        return;
    }

    if (!confirm('Bạn có chắc chắn muốn xóa dịch vụ này?\n\nHành động này không thể hoàn tác!')) {
        return;
    }

    // Call the actual delete function
    window.delete(serviceId);
};

// Delete service function
window.delete = function(serviceId) {
    // Get service ID from URL parameter if not provided
    if (!serviceId) {
        const urlParams = new URLSearchParams(window.location.search);
        serviceId = urlParams.get('id');
    }

    if (!serviceId) {
        console.error('Service ID not found');
        alert('Không tìm thấy Service ID');
        return;
    }

    // Get button element
    const btn = document.getElementById('deleteServiceBtn');
    let originalBtnContent;

    if (btn) {
        originalBtnContent = btn.innerHTML;
    }

    const url = `/admin/services/${serviceId}`;

    fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const message = data.message || 'Service deleted successfully!';
                showToast(message, 'success');

                // Redirect to services list after showing notification
                setTimeout(() => {
                    window.location.href = '/admin/services';
                }, 1500);
            } else {
                const errorMessage = data.message || 'Error deleting service';
                showToast(errorMessage, 'error');

                // Re-enable button
                if (btn) {
                    btn.innerHTML = originalBtnContent;
                }
            }
        })
        .catch(error => {
            const errorMessage = 'An error occurred while deleting the service: ' + error.message;
            showToast(errorMessage, 'error');

            // Re-enable button
            if (btn) {
                btn.innerHTML = originalBtnContent;
            }
        });
};