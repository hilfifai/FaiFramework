export function setShowAlert(message, type='primary') {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        `;
    // Tambahkan alert ke container yang sesuai
    const alertContainer = document.getElementById('alertContainer') || document.body;
    // alertContainer.insertAdjacentHTML('afterbegin', alertHtml);
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert-global global-alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert-global"></button>
        `;

    alertContainer.appendChild(alertDiv);

    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}