document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.relative');

    dropdowns.forEach(dropdown => {
        const trigger = dropdown.querySelector('.flex');
        const menu = dropdown.querySelector('.absolute');

        trigger.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Close the dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!dropdown.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    });
});
