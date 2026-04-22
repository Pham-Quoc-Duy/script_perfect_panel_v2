// Polyfill for Element.closest() for older browsers
if (!Element.prototype.closest) {
    Element.prototype.closest = function(s) {
        var el = this;
        if (!document.documentElement.contains(el)) return null;
        do {
            if (el.matches(s)) return el;
            el = el.parentElement || el.parentNode;
        } while (el !== null && el.nodeType === 1);
        return null;
    };
}

// Helper function to determine if a string is a valid image URL
function isValidImageUrl(string) {
    try {
        const url = new URL(string);
        return url.protocol === 'http:' || url.protocol === 'https:';
    } catch (_) {
        return false;
    }
}

// Helper function to check if string is Font Awesome class
function isFontAwesomeClass(string) {
    return string && (
        string.includes('fa-') ||
        string.startsWith('fas ') ||
        string.startsWith('fab ') ||
        string.startsWith('far ') ||
        string.startsWith('fal ') ||
        string.startsWith('fad ')
    );
}

// Helper function to render platform icon
function renderPlatformIcon(iconValue, size = '24px') {
    if (!iconValue) return '';

    if (isFontAwesomeClass(iconValue)) {
        return `<i class="${iconValue}" style="font-size: ${size}; color: #6c757d; margin-right: 8px;"></i>`;
    } else if (isValidImageUrl(iconValue)) {
        return `<img src="${iconValue}" alt="Platform icon" style="width: ${size}; height: ${size}; object-fit: contain; margin-right: 8px; border-radius: 4px;" loading="lazy" onerror="this.style.display='none';" />`;
    }

    return '';
}

// Category Modal Functions
function showModalAddCategory() {
    const modal = new bootstrap.Modal(document.getElementById('modal-category'));

    // Reset form with null checks
    const nameInput = document.querySelector('.ipt-name');
    const statusCheckbox = document.querySelector('.cb-status');
    const displayRadio = document.querySelector('input[name="display"][value="0"]');
    const platformSelect = document.querySelector('.sl-platform');
    const translatedNameDiv = document.getElementById('div-translated-name');

    if (nameInput) {
        nameInput.value = '';
        nameInput.classList.remove('is-invalid');
    }

    if (statusCheckbox) {
        statusCheckbox.checked = true;
    }

    if (displayRadio) {
        displayRadio.checked = true;
    }

    // Clear translated names
    if (translatedNameDiv) {
        translatedNameDiv.innerHTML = '';
    }

    // Reset platform select to first option
    if (platformSelect && platformSelect.options.length > 0) {
        platformSelect.value = platformSelect.options[0].value;
        platformSelect.classList.remove('is-invalid');

        // Trigger Select2 change if initialized
        if (typeof $ !== 'undefined' && $(platformSelect).hasClass('select2-hidden-accessible')) {
            $(platformSelect).val(platformSelect.options[0].value).trigger('change');
        }
    }

    modal.show();
}

function showModalAddPlatform() {
    const modal = new bootstrap.Modal(document.getElementById('modal-platform'));
    modal.show();
}

function showModalupdatePlatform() {
    const modal = new bootstrap.Modal(document.getElementById('modal-platform'));
    modal.show();
}

function showModalUpdateCategory(categoryData) {
    const modal = new bootstrap.Modal(document.getElementById('modal-category'));
    const data = JSON.parse(atob(categoryData));

    // Set form values with null checks
    const nameInput = document.querySelector('.ipt-name');
    const statusCheckbox = document.querySelector('.cb-status');
    const displayRadio = document.querySelector('input[name="display"][value="' + (data.display || 0) + '"]');
    const platformSelect = document.querySelector('.sl-platform');
    const btn = document.querySelector('.btn-add-category');
    const btnText = btn.querySelector('.btn-text');
    const modalTitle = document.querySelector('#modal-category-label');

    if (nameInput) {
        nameInput.value = (data.name && data.name.en) ? data.name.en : (data.name || '');
        nameInput.classList.remove('is-invalid');
    }

    if (statusCheckbox) {
        statusCheckbox.checked = data.status;
    }

    if (displayRadio) {
        displayRadio.checked = true;
    }

    // Clear and populate translated names
    const translatedNameDiv = document.getElementById('div-translated-name');
    if (translatedNameDiv) {
        translatedNameDiv.innerHTML = '';

        if (data.name && typeof data.name === 'object') {
            Object.keys(data.name).forEach(langCode => {
                if (langCode !== 'en' && data.name[langCode]) {
                    // Create wrapper div
                    const wrapper = document.createElement('div');
                    wrapper.className = 'mb-5';
                    wrapper.setAttribute('data-language', langCode);
                    wrapper.classList.add(`div-translated-${langCode}`);

                    // Create input group
                    const inputGroup = document.createElement('div');
                    inputGroup.className = 'input-group input-group-solid';

                    // Create badge span
                    const badgeSpan = document.createElement('span');
                    badgeSpan.className = 'input-group-text bg-secondary';

                    const flagSpan = document.createElement('span');
                    flagSpan.className = `rounded-1 fi fi-${langCode === 'vi' ? 'vn' : langCode} fs-5 me-2`;

                    const langText = document.createElement('span');
                    langText.textContent = langCode.toUpperCase();

                    badgeSpan.appendChild(flagSpan);
                    badgeSpan.appendChild(langText);

                    // Create input
                    const input = document.createElement('input');
                    input.type = 'text';
                    input.className = 'form-control ipt-service-translated-name';
                    input.placeholder = langCode === 'vn' ? 'Nhập tên tiếng Việt' : 'Enter translated name';
                    input.setAttribute('data-lang', langCode);
                    input.value = data.name[langCode];

                    inputGroup.appendChild(badgeSpan);
                    inputGroup.appendChild(input);
                    wrapper.appendChild(inputGroup);
                    translatedNameDiv.appendChild(wrapper);
                }
            });
        }
    }

    // Set platform select
    if (platformSelect && data.platform_id) {
        platformSelect.value = data.platform_id;
        platformSelect.classList.remove('is-invalid');

        // Trigger Select2 change if initialized
        if (typeof $ !== 'undefined' && $(platformSelect).hasClass('select2-hidden-accessible')) {
            $(platformSelect).val(data.platform_id).trigger('change');
        }
    }

    // Update modal title and button
    if (modalTitle) {
        modalTitle.textContent = 'Cập nhật danh mục';
    }
    btnText.textContent = 'Cập nhật';

    // Store category ID in button for later use
    btn.setAttribute('data-category-id', data.id);
    btn.setAttribute('data-mode', 'update');

    modal.show();
}

function showModalUpdatePlatform(platformId, platformName, platformImage) {
    const modal = new bootstrap.Modal(document.getElementById('modal-platform-update'));

    // Set form values
    const nameInput = document.querySelector('.ipt-platform-name-update');
    const iconInput = document.querySelector('.ipt-platform-icon-update');

    if (nameInput) {
        nameInput.value = platformName || '';
        nameInput.classList.remove('is-invalid');
    }

    if (iconInput) {
        iconInput.value = platformImage || '';
        iconInput.classList.remove('is-invalid');

        // Update icon preview
        if (typeof renderIconUpdate === 'function') {
            renderIconUpdate(platformImage || '');
        }
    }

    // Store platform ID for update
    modal._element.setAttribute('data-platform-id', platformId);

    modal.show();
}

// Collapse/Expand Categories
function collapse(element, status, platformId) {
    const tbody = document.querySelector('.tbody-' + platformId);
    const rows = tbody.querySelectorAll('.tr-category');
    const showHideText = element.querySelector('.show-hide-text');

    if (status === 'Hide') {
        rows.forEach(row => row.style.display = 'none');
        element.setAttribute('data-status', 'Show');
        showHideText.textContent = 'Hiện';
    } else {
        rows.forEach(row => row.style.display = '');
        element.setAttribute('data-status', 'Hide');
        showHideText.textContent = 'Ẩn';
    }
}

// Collapse All Categories
function collapseAll() {
    const iconElement = document.getElementById('collapse-all-icon');
    const isCollapsed = iconElement.classList.contains('bi-arrows-collapse');
    const allRows = document.querySelectorAll('.tr-category');
    const allShowHideElements = document.querySelectorAll('.show-hide');
    const allEditLinks = document.querySelectorAll('.a-update-platform');
    const allSortIcons = document.querySelectorAll('.icon-sort-platform');

    if (isCollapsed) {
        // Collapsing all - SHOW all edit icons and sort icons
        allRows.forEach(row => row.style.display = 'none');
        allShowHideElements.forEach(el => {
            el.setAttribute('data-status', 'Show');
            el.querySelector('.show-hide-text').textContent = 'Hiện';
        });
        allEditLinks.forEach(link => link.style.display = 'inline');
        allSortIcons.forEach(icon => icon.style.display = 'inline');
        iconElement.classList.remove('bi-arrows-collapse');
        iconElement.classList.add('bi-arrows-expand');
        isAllCollapsed = true; // Update collapse state
    } else {
        // Expanding all - HIDE all edit icons and sort icons
        allRows.forEach(row => row.style.display = '');
        allShowHideElements.forEach(el => {
            el.setAttribute('data-status', 'Hide');
            el.querySelector('.show-hide-text').textContent = 'Ẩn';
        });
        allEditLinks.forEach(link => link.style.display = 'none');
        allSortIcons.forEach(icon => icon.style.display = 'none');
        iconElement.classList.remove('bi-arrows-expand');
        iconElement.classList.add('bi-arrows-collapse');
        isAllCollapsed = false; // Update collapse state
    }
}



// Change Category Status
function statusCategory(categoryId, isChecked) {
    const checkbox = document.querySelector('input[value="' + categoryId + '"]');
    const row = document.querySelector('tr[data-id="' + categoryId + '"]');

    // Get CSRF token from meta tag
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        console.error('CSRF token not found');
        checkbox.checked = !isChecked;
        return;
    }
    const token = csrfMeta.content;

    // Show loader
    showFullScreenLoader('', null);

    // Disable checkbox during request
    checkbox.disabled = true;
    checkbox.style.opacity = '1';
    checkbox.style.cursor = 'wait';

    const url = window.location.origin + '/admin/categories/' + categoryId + '/toggle-status';

    fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                status: isChecked ? 1 : 0
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success === 'Update Successfully') {
                console.log(JSON.stringify({
                    success: 'Update Successfully'
                }));

                // Update row class based on status
                if (isChecked) {
                    row.classList.remove('text-muted');
                    row.style.opacity = '1';
                } else {
                    row.classList.add('text-muted');
                    row.style.opacity = '0.6';
                }
            } else {
                console.error('Failed to update status');
                checkbox.checked = !isChecked;
            }
        })
        .catch(error => {
            console.error('Error updating status:', error);
            checkbox.checked = !isChecked;
        })
        .finally(() => {
            // Hide loader
            hideFullScreenLoader();

            // Re-enable checkbox after request completes
            checkbox.disabled = false;
            checkbox.style.opacity = '1';
            checkbox.style.cursor = 'pointer';
        });
}

// Update Platform Icon Preview
function updatePlatformIcon(iconValue) {
    const iconElement = document.querySelector('.platform-icon');
    if (!iconElement) return;

    // Clear previous classes
    iconElement.className = 'platform-icon';

    // Check if it's a Font Awesome icon or image URL
    if (iconValue.startsWith('fa-') || iconValue.startsWith('fas ') || iconValue.startsWith('fab ')) {
        // Font Awesome icon
        iconElement.className = 'platform-icon ' + iconValue;
    } else if (iconValue.startsWith('http') || iconValue.startsWith('/')) {
        // Image URL
        iconElement.innerHTML = '<img src="' + iconValue + '" style="max-width: 24px; max-height: 24px; object-fit: contain;">';
    }
}

// Update Category
function updateCategory(categoryId) {
    const platformId = document.querySelector('.sl-platform').value;
    const name = document.querySelector('.ipt-name').value.trim();
    const display = document.querySelector('input[name="display"]:checked').value;
    const status = document.querySelector('.cb-status').checked ? 1 : 0;

    // Get CSRF token from meta tag
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        console.error('CSRF token not found');
        return;
    }
    const token = csrfMeta.content;

    if (!name) {
        showToast('Vui lòng nhập tên danh mục', 'error');
        return;
    }

    if (!platformId) {
        showToast('Vui lòng chọn nền tảng', 'error');
        return;
    }

    // Show loading overlay
    const loadingOverlay = document.createElement('div');
    loadingOverlay.id = 'loading-overlay';
    loadingOverlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9998;
    `;

    const spinner = document.createElement('div');
    spinner.style.cssText = `
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
    `;

    loadingOverlay.appendChild(spinner);
    document.body.appendChild(loadingOverlay);

    // Add animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);

    const url = window.location.origin + '/admin/categories/' + categoryId;

    // Prepare name data - collect all translated names
    const nameData = {
        en: name
    };

    // Collect translated names
    const translatedInputs = document.querySelectorAll('#div-translated-name input.ipt-service-translated-name');
    translatedInputs.forEach(input => {
        const langCode = input.getAttribute('data-lang');
        const value = input.value.trim();
        if (value) {
            nameData[langCode] = value;
        }
    });

    fetch(url, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                platform_id: platformId,
                name: nameData,
                display: display,
                status: status
            })
        })
        .then(response => response.json())
        .then(data => {
            // Remove loading overlay
            loadingOverlay.remove();

            if (data.success) {
                showToast(data.message || 'Danh mục đã được cập nhật thành công!', 'success');

                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('modal-category'));
                if (modal) {
                    modal.hide();
                }

                // Reload page after 1 second
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                showToast(data.message || 'Cập nhật danh mục thất bại', 'error');
            }
        })
        .catch(error => {
            // Remove loading overlay
            loadingOverlay.remove();

            console.error('Error updating category:', error);
            showToast(error.message || 'Có lỗi xảy ra', 'error');
        });
}

// Create Platform
function createPlatform() {
    const name = document.querySelector('.ipt-platform-name').value.trim();
    const icon = document.querySelector('.ipt-platform-icon').value.trim();

    // Get CSRF token from meta tag
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        console.error('CSRF token not found');
        return;
    }
    const token = csrfMeta.content;

    if (!name) {
        showToast('Vui lòng nhập tên nền tảng', 'error');
        return;
    }

    if (!icon) {
        showToast('Vui lòng nhập biểu tượng hoặc hình ảnh', 'error');
        return;
    }

    // Show loading overlay
    const loadingOverlay = document.createElement('div');
    loadingOverlay.id = 'loading-overlay';
    loadingOverlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9998;
    `;

    const spinner = document.createElement('div');
    spinner.style.cssText = `
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
    `;

    loadingOverlay.appendChild(spinner);
    document.body.appendChild(loadingOverlay);

    // Add animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);

    const url = window.location.origin + '/admin/platform';

    fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: name,
                image: icon,
                status: true
            })
        })
        .then(response => response.json())
        .then(data => {
            // Remove loading overlay
            loadingOverlay.remove();

            if (data.success) {
                showToast(data.message || 'Nền tảng đã được tạo thành công!', 'success');

                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('modal-platform'));
                if (modal) {
                    modal.hide();
                }

                // Reset form
                document.querySelector('.ipt-platform-name').value = '';
                document.querySelector('.ipt-platform-icon').value = '';
                document.querySelector('.platform-icon').className = 'platform-icon';

                // Reload page after 1 second
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                showToast(data.message || 'Tạo nền tảng thất bại', 'error');
            }
        })
        .catch(error => {
            // Remove loading overlay
            loadingOverlay.remove();

            console.error('Error creating platform:', error);
            showToast(error.message || 'Có lỗi xảy ra', 'error');
        });
}

// Add Category
function addCategory() {
    const platformSelect = document.querySelector('.sl-platform');
    const nameInput = document.querySelector('.ipt-name');
    const displayRadio = document.querySelector('input[name="display"]:checked');
    const statusCheckbox = document.querySelector('.cb-status');

    // Get CSRF token from meta tag
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        console.error('CSRF token not found');
        showToast('Không tìm thấy CSRF token', 'error');
        return;
    }
    const token = csrfMeta.content;

    // Check if elements exist
    if (!platformSelect) {
        console.error('Platform select not found');
        showToast('Không tìm thấy trường chọn nền tảng', 'error');
        return;
    }

    if (!nameInput) {
        showToast('Không tìm thấy trường tên danh mục', 'error');
        return;
    }

    if (!displayRadio) {
        console.error('Display radio not found');
        showToast('Không tìm thấy tùy chọn hiển thị', 'error');
        return;
    }

    if (!statusCheckbox) {
        console.error('Status checkbox not found');
        showToast('Không tìm thấy trường trạng thái', 'error');
        return;
    }

    const platformId = platformSelect.value;
    const name = nameInput.value.trim();
    const display = displayRadio.value;
    const status = statusCheckbox.checked;

    // Reset validation styles
    platformSelect.classList.remove('is-invalid');
    nameInput.classList.remove('is-invalid');

    // Validation
    if (!name) {
        nameInput.classList.add('is-invalid');
        showToast('Vui lòng nhập tên danh mục', 'error');
        return;
    }

    if (!platformId) {
        platformSelect.classList.add('is-invalid');
        showToast('Vui lòng chọn nền tảng', 'error');
        return;
    }

    // Show loading overlay
    const loadingOverlay = document.createElement('div');
    loadingOverlay.id = 'loading-overlay';
    loadingOverlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9998;
    `;

    const spinner = document.createElement('div');
    spinner.style.cssText = `
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
    `;

    loadingOverlay.appendChild(spinner);
    document.body.appendChild(loadingOverlay);

    // Add animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);

    const url = window.location.origin + '/admin/categories';

    // Prepare name data - collect all translated names
    const nameData = {
        en: name
    };

    // Collect translated names
    const translatedInputs = document.querySelectorAll('#div-translated-name input.ipt-service-translated-name');
    translatedInputs.forEach(input => {
        const langCode = input.getAttribute('data-lang');
        const value = input.value.trim();
        if (value) {
            nameData[langCode] = value;
        }
    });

    fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                platform_id: platformId,
                name: nameData,
                display: display,
                status: status
            })
        })
        .then(response => response.json())
        .then(data => {
            // Remove loading overlay
            loadingOverlay.remove();

            if (data.success) {
                showToast(data.message || 'Danh mục đã được tạo thành công!', 'success');

                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('modal-category'));
                if (modal) {
                    modal.hide();
                }

                // Reset form with null checks
                const nameInputReset = document.querySelector('.ipt-name');
                const statusCheckboxReset = document.querySelector('.cb-status');
                const displayRadioReset = document.querySelector('input[name="display"][value="0"]');
                const platformSelectReset = document.querySelector('.sl-platform');
                const translatedNameDiv = document.getElementById('div-translated-name');

                if (nameInputReset) nameInputReset.value = '';
                if (statusCheckboxReset) statusCheckboxReset.checked = true;
                if (displayRadioReset) displayRadioReset.checked = true;
                if (translatedNameDiv) translatedNameDiv.innerHTML = '';
                if (platformSelectReset) {
                    platformSelectReset.value = '';
                    if (typeof $ !== 'undefined') {
                        $('.sl-platform').trigger('change'); // Trigger Select2 change
                    }
                }

                // Reload page after 1 second
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                showToast(data.message || 'Tạo danh mục thất bại', 'error');
            }
        })
        .catch(error => {
            // Remove loading overlay
            loadingOverlay.remove();

            console.error('Error creating category:', error);
            showToast(error.message || 'Có lỗi xảy ra', 'error');
        });
}


// Add Translated Name
function addTranslatedName(langCode) {
    const container = document.getElementById('div-translated-name');
    if (!container) return;

    // Check if language already exists
    const existingWrapper = container.querySelector(`[data-language="${langCode}"]`);
    if (existingWrapper) {
        // Language already exists, just focus on it
        const input = existingWrapper.querySelector('input');
        if (input) input.focus();
        return;
    }

    // Create wrapper div
    const wrapper = document.createElement('div');
    wrapper.className = 'mb-5';
    wrapper.setAttribute('data-language', langCode);
    wrapper.classList.add(`div-translated-${langCode}`);

    // Create input group
    const inputGroup = document.createElement('div');
    inputGroup.className = 'input-group input-group-solid';

    // Create badge span
    const badgeSpan = document.createElement('span');
    badgeSpan.className = 'input-group-text bg-secondary';

    const flagSpan = document.createElement('span');
    flagSpan.className = `rounded-1 fi fi-${langCode === 'vi' ? 'vn' : langCode} fs-5 me-2`;

    const langText = document.createElement('span');
    langText.textContent = langCode.toUpperCase();

    badgeSpan.appendChild(flagSpan);
    badgeSpan.appendChild(langText);

    // Create input
    const input = document.createElement('input');
    input.type = 'text';
    input.className = 'form-control ipt-service-translated-name';
    input.setAttribute('data-lang', langCode);
    input.setAttribute('name', `name[${langCode}]`);
    input.value = '';

    inputGroup.appendChild(badgeSpan);
    inputGroup.appendChild(input);
    wrapper.appendChild(inputGroup);
    container.appendChild(wrapper);

    // Focus on new input
    input.focus();
}


// ===== Drag & Drop Functionality =====
let platformSortable = null;
let categorySortables = [];
let isAllCollapsed = false;

// Initialize drag & drop on DOM ready
document.addEventListener('DOMContentLoaded', function() {
    // Apply translations
    var langs = document.querySelectorAll('[data-lang]');
    for (var i = 0; i < langs.length; i++) {
        var key = langs[i].getAttribute('data-lang');

        // Skip empty keys
        if (!key) continue;

        // Get translated text
        var value = (typeof translateText !== 'undefined') ?
            translateText(key, langs[i].innerText) :
            langs[i].innerText;

        if (langs[i].tagName == 'INPUT') {
            if (langs[i].hasAttribute('value')) {
                langs[i].value = value;
            } else if (langs[i].hasAttribute('placeholder')) {
                langs[i].setAttribute('placeholder', value)
            }
        } else if (langs[i].hasAttribute('data-bs-toggle') && langs[i].getAttribute('data-bs-toggle') ==
            'tooltip') {
            langs[i].setAttribute('title', value)
        } else {
            langs[i].innerHTML = value;
        }
    }

    // Initialize drag & drop functionality
    initializeDragAndDrop();
});

function initializeDragAndDrop() {
    // Initialize Platform Sorting
    initializePlatformSort();

    // Initialize Category Sorting
    initializeCategorySort();
}

function initializePlatformSort() {
    const tableElement = document.getElementById('table-platform');
    if (tableElement && !platformSortable) {
        platformSortable = new Sortable(tableElement, {
            group: 'platforms',
            animation: 200,
            handle: '.icon-sort-platform',
            draggable: 'tbody',
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onStart: function(evt) {
                // Show platform sort icons when dragging starts
                document.querySelectorAll('.icon-sort-platform').forEach(icon => {
                    icon.style.display = 'inline-block';
                });
            },
            onEnd: function(evt) {
                // Restore platform sort icons visibility based on collapse state
                document.querySelectorAll('.icon-sort-platform').forEach(icon => {
                    icon.style.display = isAllCollapsed ? 'inline-block' : 'none';
                });

                if (evt.oldIndex !== evt.newIndex) {
                    updatePlatformPositions();
                }
            }
        });
    }
}

function initializeCategorySort() {
    // Initialize category sorting for each platform tbody
    document.querySelectorAll('.sort-category').forEach(tbody => {
        const existingSortable = categorySortables.find(s => s.el === tbody);
        if (!existingSortable) {
            const sortable = new Sortable(tbody, {
                group: {
                    name: 'categories',
                    pull: false,
                    put: false
                },
                animation: 200,
                handle: '.tr-category td:first-child',
                draggable: '.tr-category',
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                dragClass: 'sortable-drag',
                filter: '.tr-platform',
                onEnd: function(evt) {
                    if (evt.oldIndex !== evt.newIndex) {
                        const platformId = tbody.getAttribute('data-platform-id');
                        updateCategoryPositions(platformId);
                    }
                }
            });
            categorySortables.push(sortable);
        }
    });
}

function updatePlatformPositions() {
    const platforms = [];
    const tbodies = document.querySelectorAll('#table-platform tbody');

    tbodies.forEach((tbody, index) => {
        const platformId = tbody.getAttribute('data-platform-id');
        if (platformId) {
            platforms.push({
                id: parseInt(platformId),
                position: index + 1
            });
        }
    });

    if (platforms.length === 0) return;

    // Add updating class to prevent multiple operations
    document.querySelectorAll('.icon-sort-platform').forEach(icon => {
        icon.classList.add('updating');
    });

    // Get CSRF token from meta tag
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        console.error('CSRF token not found');
        return;
    }

    fetch('/admin/platform', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfMeta.content
            },
            body: JSON.stringify({
                action: 'reorder',
                platforms: platforms
            })
        })
        .then(response => response.json())
        .finally(() => {
            // Remove updating class
            document.querySelectorAll('.icon-sort-platform').forEach(icon => {
                icon.classList.remove('updating');
            });
        });
}

function updateCategoryPositions(platformId) {
    const categories = [];
    const categoryRows = document.querySelectorAll(`.tbody-${platformId} .tr-category`);

    categoryRows.forEach((row, index) => {
        const categoryId = row.getAttribute('data-id');
        if (categoryId) {
            categories.push({
                id: parseInt(categoryId),
                position: index + 1
            });
        }
    });

    if (categories.length === 0) return;

    // Add updating class to prevent multiple operations
    categoryRows.forEach(row => {
        row.querySelector('td:first-child').classList.add('updating');
    });

    // Get CSRF token from meta tag
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        console.error('CSRF token not found');
        return;
    }

    fetch('/admin/categories', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfMeta.content
            },
            body: JSON.stringify({
                action: 'reorder',
                categories: categories
            })
        })
        .then(response => response.json())
        .finally(() => {
            // Remove updating class
            categoryRows.forEach(row => {
                row.querySelector('td:first-child').classList.remove('updating');
            });
        });
}

// Prevent text selection during drag
document.addEventListener('selectstart', function(e) {
    if (e.target.closest('.icon-sort-platform') || e.target.closest('.tr-category td:first-child')) {
        e.preventDefault();
    }
});

// Add keyboard support for accessibility
document.addEventListener('keydown', function(e) {
    if ((e.target.closest('.icon-sort-platform') || e.target.closest('.tr-category td:first-child')) &&
        (e.key === 'Enter' || e.key === ' ')) {
        e.preventDefault();
        showToast('Sử dụng chuột để kéo thả sắp xếp thứ tự', 'info');
    }
});

// Make functions globally accessible
window.showModalAddCategory = showModalAddCategory;
window.showModalAddPlatform = showModalAddPlatform;
window.showModalUpdateCategory = showModalUpdateCategory;
window.showModalUpdatePlatform = showModalUpdatePlatform;
window.collapse = collapse;
window.collapseAll = collapseAll;
window.statusCategory = statusCategory;
window.updateCategory = updateCategory;
window.createPlatform = createPlatform;
window.addCategory = addCategory;
window.addTranslatedName = addTranslatedName;
window.updatePlatformIcon = updatePlatformIcon;