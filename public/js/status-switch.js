/**
 * Status Switch Component JavaScript
 * Handles status toggle functionality with duplicate request prevention
 */

// Ensure this script only runs once
if (typeof window.statusSwitchInitialized === 'undefined') {
    window.statusSwitchInitialized = true;
    
    document.addEventListener('DOMContentLoaded', function() {
        // Track ongoing requests to prevent duplicates
        const ongoingRequests = new Map();
        
        console.log('Status Switch: Event listener initialized');
        
        // Handle status switch changes with event delegation
        document.addEventListener('change', function(e) {
            if (!e.target.classList.contains('status-switch')) return;
            
            const switchElement = e.target;
            const url = switchElement.dataset.url;
            const isChecked = switchElement.checked;
            const entityId = switchElement.dataset.entityId;
            const entityType = switchElement.dataset.entityType;
            const switchId = switchElement.id;
            
            console.log('Status Switch: Change detected', {
                switchId,
                url,
                isChecked,
                entityId,
                entityType
            });
            
            if (url === '#') {
                console.log('Status Switch: No URL provided, skipping');
                return;
            }
            
            // Prevent duplicate requests for the same switch
            if (ongoingRequests.has(switchId)) {
                console.warn('Status Switch: Request already in progress for switch:', switchId);
                // Revert the switch state
                switchElement.checked = !isChecked;
                return;
            }
            
            // Add to ongoing requests with timestamp
            ongoingRequests.set(switchId, Date.now());
            console.log('Status Switch: Starting request for', switchId);
            
            // Disable switch temporarily to prevent rapid clicking
            switchElement.disabled = true;
            
            // Send AJAX request
            fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-HTTP-Method-Override': 'PUT'
                },
                body: JSON.stringify({
                    toggle_status: true,
                    status: isChecked ? 1 : 0,
                    entity_id: entityId,
                    entity_type: entityType,
                    _method: 'PUT'
                })
            })
            .then(response => {
                console.log('Status Switch: Response received', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Status Switch: Success response', data);
                if (data.success) {
                    if (typeof showStatusNotification === 'function') {
                        showStatusNotification('success', data.message || 'Cập nhật trạng thái thành công!');
                    }
                    switchElement.checked = data.status !== undefined ? data.status : isChecked;
                } else {
                    switchElement.checked = !isChecked;
                    if (typeof showStatusNotification === 'function') {
                        showStatusNotification('error', data.message || 'Có lỗi xảy ra!');
                    }
                }
            })
            .catch(error => {
                console.error('Status Switch: Error', error);
                switchElement.checked = !isChecked;
                if (typeof showStatusNotification === 'function') {
                    showStatusNotification('error', 'Có lỗi xảy ra khi cập nhật trạng thái!');
                }
            })
            .finally(() => {
                console.log('Status Switch: Request completed for', switchId);
                switchElement.disabled = false;
                ongoingRequests.delete(switchId);
            });
        });
    });
}