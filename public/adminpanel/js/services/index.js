let isAllCollapsed = false;
let sortableInstances = [];

document.addEventListener('DOMContentLoaded', function() {
    initializeDragAndDrop();
});

function initializeDragAndDrop() {
    // Destroy existing instances
    sortableInstances.forEach(instance => instance.destroy());
    sortableInstances = [];

    // Get all tbody elements (each represents a category)
    const tbodyElements = document.querySelectorAll('tbody[data-cat-id]');
    
    tbodyElements.forEach(tbody => {
        const platformId = tbody.getAttribute('data-platform-id');
        const categoryId = tbody.getAttribute('data-cat-id');
        
        if (!platformId || !categoryId) return;

        const sortable = new Sortable(tbody, {
            group: {
                name: `category-${categoryId}`,
                pull: false,
                put: false
            },
            animation: 200,
            handle: 'td:first-child',
            draggable: 'tr.service',
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            
            onEnd: function(evt) {
                if (evt.oldIndex !== evt.newIndex) {
                    updateServicePositions(platformId, categoryId);
                }
            }
        });

        sortableInstances.push(sortable);
    });
}

function updateServicePositions(platformId, categoryId) {
    const services = [];
    const tbody = document.querySelector(
        `tbody[data-platform-id="${platformId}"][data-cat-id="${categoryId}"]`
    );
    
    if (!tbody) return;
    
    const serviceRows = tbody.querySelectorAll('tr.service');
    
    // Get CSRF token from meta tag
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        console.error('CSRF token not found');
        return;
    }
    const token = csrfMeta.content;

    serviceRows.forEach((row, index) => {
        const serviceId = row.getAttribute('data-id');
        if (serviceId) {
            services.push({
                id: parseInt(serviceId),
                position: index + 1,
                category_id: parseInt(categoryId),
                platform_id: parseInt(platformId)
            });
        }
    });

    if (services.length === 0) return;

    // Add updating class to prevent multiple operations
    tbody.classList.add('updating');

    fetch(window.location.origin + '/admin/services', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
            action: 'reorder',
            services: services
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Services reordered successfully', data);
    })
    .catch(error => {
        console.error('Error reordering services:', error);
    })
    .finally(() => {
        tbody.classList.remove('updating');
    });
}

function collapsePlatform(element, status, platformId) {
    const newStatus = status === 'Show' ? 'Hide' : 'Show';
    element.setAttribute('data-status', newStatus);
    element.querySelector('.show-hide-text').textContent = newStatus === 'Hide' ? 'Ẩn' : 'Hiện';

    // Toggle all categories and services under this platform
    const categories = document.querySelectorAll(`thead.category[data-platform="${platformId}"]`);
    const tbodies = document.querySelectorAll(`tbody[data-platform-id="${platformId}"]`);
    
    categories.forEach(cat => {
        cat.style.display = newStatus === 'Hide' ? 'none' : '';
    });
    
    tbodies.forEach(tbody => {
        tbody.style.display = newStatus === 'Hide' ? 'none' : '';
    });
}

function collapseCategory(element, status, platformId, categoryId) {
    const newStatus = status === 'Show' ? 'Hide' : 'Show';
    element.setAttribute('data-status', newStatus);
    element.querySelector('.show-hide-text').textContent = newStatus === 'Hide' ? 'Ẩn' : 'Hiện';

    // Toggle tbody for this category
    const tbody = document.querySelector(
        `tbody[data-platform-id="${platformId}"][data-cat-id="${categoryId}"]`
    );
    if (tbody) {
        tbody.style.display = newStatus === 'Hide' ? 'none' : '';
    }
}

function collapseAll() {
    const icon = document.getElementById('collapse-all-icon');
    const collapseBtn = document.getElementById('collapse-all-btn');
    isAllCollapsed = !isAllCollapsed;

    // Toggle icon and text
    if (isAllCollapsed) {
        icon.classList.remove('bi-arrows-collapse');
        icon.classList.add('bi-arrows-expand');
        collapseBtn.querySelector('.fst-italic').textContent = 'Mở rộng tất cả';
    } else {
        icon.classList.remove('bi-arrows-expand');
        icon.classList.add('bi-arrows-collapse');
        collapseBtn.querySelector('.fst-italic').textContent = 'Thu gọn tất cả';
    }

    // Toggle all platforms
    document.querySelectorAll('thead.platform .show-hide').forEach(element => {
        const status = isAllCollapsed ? 'Hide' : 'Show';
        element.setAttribute('data-status', status);
        element.querySelector('.show-hide-text').textContent = status === 'Hide' ? 'Ẩn' : 'Hiện';
    });

    // Toggle all categories
    document.querySelectorAll('thead.category').forEach(cat => {
        cat.style.display = isAllCollapsed ? 'none' : '';
        const showHide = cat.querySelector('.show-hide');
        if (showHide) {
            const status = isAllCollapsed ? 'Hide' : 'Show';
            showHide.setAttribute('data-status', status);
            showHide.querySelector('.show-hide-text').textContent = status === 'Hide' ? 'Ẩn' : 'Hiện';
        }
    });

    // Toggle all tbody elements (services)
    document.querySelectorAll('tbody[data-cat-id]').forEach(tbody => {
        tbody.style.display = isAllCollapsed ? 'none' : '';
    });
}

function filter(keyword) {
    if (!keyword) {
        // Show all if keyword is empty
        document.querySelectorAll('tr.service').forEach(row => {
            row.style.display = '';
        });
        document.querySelectorAll('thead.category').forEach(row => {
            row.style.display = '';
        });
        document.querySelectorAll('thead.platform').forEach(row => {
            row.style.display = '';
        });
        document.querySelectorAll('tbody[data-cat-id]').forEach(tbody => {
            tbody.style.display = '';
        });
        return;
    }

    const lowerKeyword = keyword.toLowerCase();
    
    // First, filter services
    document.querySelectorAll('tr.service').forEach(row => {
        const id = row.getAttribute('data-id');
        const text = row.textContent.toLowerCase();
        
        if (id.includes(keyword) || text.includes(lowerKeyword)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });

    // Show/hide tbody and categories based on visible services
    document.querySelectorAll('tbody[data-cat-id]').forEach(tbody => {
        const platformId = tbody.getAttribute('data-platform-id');
        const categoryId = tbody.getAttribute('data-cat-id');
        const visibleServices = tbody.querySelectorAll('tr.service:not([style*="display: none"])');
        
        if (visibleServices.length > 0) {
            tbody.style.display = '';
            // Show corresponding category header
            const categoryHeader = document.querySelector(
                `thead.category[data-platform="${platformId}"][data-cat="${categoryId}"]`
            );
            if (categoryHeader) {
                categoryHeader.style.display = '';
            }
        } else {
            tbody.style.display = 'none';
            // Hide corresponding category header
            const categoryHeader = document.querySelector(
                `thead.category[data-platform="${platformId}"][data-cat="${categoryId}"]`
            );
            if (categoryHeader) {
                categoryHeader.style.display = 'none';
            }
        }
    });

    // Show/hide platforms based on visible categories
    document.querySelectorAll('thead.platform').forEach(platHead => {
        const platformClass = Array.from(platHead.classList).find(cls => cls.startsWith('platform-'));
        if (!platformClass) return;
        
        const platformId = platformClass.replace('platform-', '');
        const visibleCategories = document.querySelectorAll(
            `thead.category[data-platform="${platformId}"]:not([style*="display: none"])`
        );
        
        platHead.style.display = visibleCategories.length > 0 ? '' : 'none';
    });
}

// Toggle service status
function statusService(serviceId, isChecked, catStatus) {
    // Get CSRF token from meta tag
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        console.error('CSRF token not found');
        return;
    }
    const token = csrfMeta.content;

    const row = document.querySelector(`tr.service[data-id="${serviceId}"]`);
    if (!row) return;

    // Disable the checkbox during request
    const checkbox = row.querySelector('input[type="checkbox"]');
    if (checkbox) {
        checkbox.disabled = true;
    }

    // Show loader
    if (typeof showFullScreenLoader === 'function') {
        showFullScreenLoader('', null);
    }

    fetch(window.location.origin + `/admin/services/${serviceId}/toggle-status`, {
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
        if (data.success) {
            // Update row styling
            if (isChecked) {
                row.classList.remove('text-muted');
            } else {
                row.classList.add('text-muted');
            }
            
            // Update data attribute
            row.setAttribute('data-status', isChecked ? '1' : '0');
            
            console.log('Service status updated successfully');
        } else {
            // Revert checkbox if failed
            if (checkbox) {
                checkbox.checked = !isChecked;
            }
            console.error('Failed to update service status:', data.message);
        }
    })
    .catch(error => {
        console.error('Error updating service status:', error);
        // Revert checkbox on error
        if (checkbox) {
            checkbox.checked = !isChecked;
        }
    })
    .finally(() => {
        // Hide loader
        if (typeof hideFullScreenLoader === 'function') {
            hideFullScreenLoader();
        }
        
        // Re-enable the checkbox
        if (checkbox) {
            checkbox.disabled = false;
        }
    });
}

// Make functions globally accessible
window.collapsePlatform = collapsePlatform;
window.collapseCategory = collapseCategory;
window.collapseAll = collapseAll;
window.filter = filter;
window.statusService = statusService;

// Prevent text selection during drag
document.addEventListener('selectstart', function(e) {
    if (e.target.closest('tbody[data-cat-id] td:first-child')) {
        e.preventDefault();
    }
});
