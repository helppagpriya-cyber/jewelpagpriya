import './bootstrap';;


document.addEventListener('DOMContentLoaded', () => {
    // Helper function to toggle offcanvas
    const toggleOffcanvas = (id) => {
        const offcanvas = document.getElementById(id);
        if (offcanvas) {
            offcanvas.classList.toggle('translate-x-full');
        } else {
            console.error(`Offcanvas with ID ${id} not found`);
        }
    };

    // Dropdown Toggle
    const dropdownButton = document.getElementById('navbarDropdown');
    const dropdownMenu = document.getElementById('dropdown-menu');
    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener('click', (e) => {
            e.preventDefault();
            dropdownMenu.classList.toggle('hidden');
            dropdownButton.setAttribute(
                'aria-expanded',
                dropdownMenu.classList.contains('hidden') ? 'false' : 'true'
            );
        });
        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
                dropdownButton.setAttribute('aria-expanded', 'false');
            }
        });
    } else {
        console.warn('Dropdown elements not found');
    }

    // Mobile Menu Toggle
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    } else {
        console.warn('Mobile menu elements not found');
    }

    // Offcanvas Toggles
    const offcanvasButtons = [
        { selector: '[data-toggle="cartcanvas"]', id: 'cartcanvas' },
        { selector: '[data-toggle="wishlistcanvas"]', id: 'wishlistcanvas' },
        { selector: '[data-toggle="ordercanvas"]', id: 'ordercanvas' },
    ];

    offcanvasButtons.forEach(({ selector, id }) => {
        document.querySelectorAll(selector).forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                toggleOffcanvas(id);
            });
        });
    });

    // Handle form submissions for cart/wishlist removal
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const action = form.getAttribute('action');
            const method = form.querySelector('input[name="_method"]')?.value || form.method;

            fetch(action, {
                method: method.toUpperCase(),
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccessAlert(data.message || 'Action completed successfully');
                        // Remove the item from the DOM
                        const itemId = form.closest('[id^="cart-item-"]')?.id || form.closest('.bg-white')?.id;
                        if (itemId) {
                            document.getElementById(itemId)?.remove();
                        }
                        // Refresh the page to update totals (or implement dynamic updates)
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        console.error('Error:', data.message);
                    }
                })
                .catch(error => console.error('Fetch error:', error));
        });
    });
});

// Function to show success alert
// function showSuccessAlert(message) {
//     const alert = document.getElementById('success-alert');
//     const messageSpan = document.getElementById('message');
//     if (alert && messageSpan) {
//         messageSpan.textContent = message;
//         alert.classList.remove('hidden');
//         setTimeout(() => {
//             alert.classList.add('hidden');
//         }, 5000); // Auto-close after 5 seconds
//     } else {
//         console.warn('Success alert elements not found');
//     }
// }
