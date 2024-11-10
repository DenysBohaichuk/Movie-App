document.addEventListener('DOMContentLoaded', function() {

    const menuButton = document.getElementById('menu-button');
    const dropdownMenu = menuButton.parentElement.nextElementSibling;

    const toggleDropdown = () => {
        const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
        menuButton.setAttribute('aria-expanded', !isExpanded);
        if (isExpanded) {
            dropdownMenu.setAttribute('hidden', '');
        } else {
            dropdownMenu.removeAttribute('hidden');
            adjustDropdownPosition();
        }
    };

    const adjustDropdownPosition = () => {
        const rect = menuButton.getBoundingClientRect();
        const spaceBelow = window.innerHeight - rect.bottom;
        const spaceAbove = rect.top;
        const dropdownHeight = dropdownMenu.offsetHeight;

        if (spaceBelow < dropdownHeight && spaceAbove > dropdownHeight) {
            dropdownMenu.classList.add('dropdown-top');
        } else {
            dropdownMenu.classList.remove('dropdown-top');
        }
    };

    menuButton.addEventListener('click', (event) => {
        toggleDropdown();
        event.stopPropagation();
    });

    document.addEventListener('click', () => {
        if (menuButton.getAttribute('aria-expanded') === 'true') {
            menuButton.setAttribute('aria-expanded', 'false');
            dropdownMenu.setAttribute('hidden', '');
        }
    });

    dropdownMenu.addEventListener('click', (event) => {
        event.stopPropagation();
    });
});
