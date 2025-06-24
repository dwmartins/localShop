import { Toast } from "bootstrap";

// Function to show or hide the button loading state
export function toggleLoading(button, isLoading = false, isForm = false) {
    const spinner = button.querySelector('.spinner-loader');
    const btnText = button.querySelector('.btn-text');

    if (isLoading) {
        button.setAttribute('disabled', 'true');

        const loadingText = button.getAttribute('data-trans-loading');
        if (spinner) spinner.classList.remove('d-none');

        if (btnText && loadingText) {
            button.setAttribute('data-default-text', btnText.textContent.trim());
            btnText.textContent = loadingText;
        }

        if (isForm) {
            const form = button.closest('form');
            form.submit();
        }
    } else {
        button.removeAttribute('disabled');

        const defaultText = button.getAttribute('data-default-text');
        if (spinner) spinner.classList.add('d-none');

        if (btnText && defaultText) {
            btnText.textContent = defaultText;
        }
    }
}

window.toggleLoading = toggleLoading;

export function showAlert(type, title, messageOrFields) {
    const toastContainer = document.getElementById('toastContainer');
    const toastEl = document.createElement('div');

    toastEl.className = 'toast align-items-center border-0';
    toastEl.setAttribute('role', 'alert');
    toastEl.setAttribute('aria-live', 'assertive');
    toastEl.setAttribute('aria-atomic', 'true');

    let iconClass = '';
    const toastClasses = ['bg-white'];

    switch (type) {
        case 'success':
            iconClass = 'fa-solid fa-circle-check text-success';
            break;
        case 'error':
            iconClass = 'fa-solid fa-circle-xmark text-danger';
            break;
        case 'warning':
            iconClass = 'fa-solid fa-circle-exclamation text-warning';
            break;
        default:
            break;
    }

    toastEl.classList.add(...toastClasses);

    const titleHtml = title ? `<strong class="me-auto">${title}</strong>` : '';

    let messageHtml;
    let iconPositionHtml = `<i class="${iconClass} fs-5 me-2"></i>`;

    if (typeof messageOrFields === 'object') {
        debugger
        messageHtml = Object.entries(messageOrFields)
            .map(([field, messages]) => {
                if (Array.isArray(messages)) {
                    return messages.map((msg) => `<div class="text-secondary">- ${msg}</div>`).join('');
                } else {
                    return `<div class="text-secondary">- ${messages}</div>`;
                }
            })
            .join('');
    } else {
        messageHtml = `<span class="text-secondary ">${messageOrFields}</span>`;
    }

    if (titleHtml) {
        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <div class="d-flex align-items-center mb-2">
                        ${iconPositionHtml}
                        ${titleHtml}
                    </div>
                    ${messageHtml}
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
    } else {
        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <div class="d-flex align-items-center mb-2">
                        <i class="${iconClass} fs-5 me-2"></i>
                        ${messageHtml}
                    </div>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
    }

    toastContainer.appendChild(toastEl);

    const toast = new Toast(toastEl);
    toast.show();

    toastEl.addEventListener('hidden.bs.toast', function () {
        toastEl.remove();
    });
}