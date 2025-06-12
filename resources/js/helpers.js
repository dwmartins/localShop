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

        if(isForm) {
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