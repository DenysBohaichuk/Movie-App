
function createFlashAlert(type, message) {
    const alertContainer = document.getElementById('alerts-container') || createAlertsContainer();
    const alert = document.createElement('div');
    alert.className = `flash-alert border-l-4 rounded-md p-4 mb-2 ${getStateAlertClasses(type)} fadeInUp`;
    alert.innerHTML = `
        <div class="flex">
            <div class="flex-shrink-0">
                ${getIcon(type)}
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium ${getTextColor(type)}">${message}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button onclick="closeAlert(this)" type="button" class="inline-flex rounded-md p-1.5 ${getButtonClasses(type)}">
                        <span class="sr-only">Dismiss</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>`;

    alertContainer.prepend(alert); // Вставляємо новий алерт на початок контейнера

    setTimeout(() => {
        alert.classList.replace('fadeInUp', 'fadeOutDown');
        setTimeout(() => alert.remove(), 500); // Забезпечуємо завершення анімації
    }, 9500); // Починаємо зникнення через 9.5 секунд
}

// Змініть інші частини коду відповідно до потреб вашого додатку


    function createAlertsContainer() {
        const container = document.createElement('div');
        container.id = 'alerts-container';
        container.style.position = 'fixed';
        container.style.bottom = '0';
        container.style.left = '50%';
        container.style.transform = 'translateX(-50%)';
        container.style.zIndex = '1051';
        document.body.appendChild(container);
        return container;
    }

    function closeAlert(button) {
        const alert = button.closest('.flash-alert');
        alert.classList.add('fadeOutDown');
        setTimeout(() => alert.remove(), 500);
    }

    function getStateAlertClasses(type) {
        switch(type) {
            case 'success': return 'border-green-400 bg-green-50';
            case 'danger': return 'border-yellow-400 bg-yellow-50';
            case 'error': return 'border-red-400 bg-red-50';
            default: return '';
        }
    }

    function getButtonClasses(type) {
        switch(type) {
            case 'success': return 'text-green-500 bg-green-50 hover:bg-green-100';
            case 'danger': return 'text-yellow-500 bg-yellow-50 hover:bg-yellow-100';
            case 'error': return 'text-red-500 bg-red-50 hover:bg-red-100';
            default: return '';
        }
    }

    function getTextColor(type) {
        switch(type) {
            case 'success': return 'text-green-800';
            case 'danger': return 'text-yellow-800';
            case 'error': return 'text-red-800';
            default: return '';
        }
    }

    function getIcon(type) {
        switch(type) {
            case 'success': return '<svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">\n' +
                '                    <path fill-rule="evenodd"\n' +
                '                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"\n' +
                '                          clip-rule="evenodd"/>\n' +
                '                </svg>';
            case 'danger': return '<svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">\n' +
                '                    <path fill-rule="evenodd"\n' +
                '                          d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"\n' +
                '                          clip-rule="evenodd"/>\n' +
                '                </svg>';
            case 'error': return '<svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">\n' +
                '                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />\n' +
                '                </svg>';
            default: return '';
        }
    }

