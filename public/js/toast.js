// Show Toast Notification
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