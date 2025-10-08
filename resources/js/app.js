// Island Art Hawaiʻi - Main JavaScript entry point
import '../css/app.css'

// Initialize Island Art Hawaiʻi website
console.log('Island Art Hawaiʻi - Ready! Built with CodeIgniter 4 + Vite + Tailwind CSS v4')

// Global functionality for Island Art Hawaiʻi
document.addEventListener('DOMContentLoaded', function() {
    // Initialize website features
    console.log('Island Art Hawaiʻi DOM loaded - ready for interactive features')
    
    // Mobile menu functionality
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuOpenIcon = document.getElementById('menu-open-icon');
    const menuCloseIcon = document.getElementById('menu-close-icon');
    
    if (mobileMenuButton && mobileMenu && menuOpenIcon && menuCloseIcon) {
        let isOpen = false;
        
        mobileMenuButton.addEventListener('click', function() {
            isOpen = !isOpen;
            
            if (isOpen) {
                // Show menu
                mobileMenu.classList.remove('opacity-0', '-translate-x-full');
                mobileMenu.classList.add('opacity-100', 'translate-x-0');
                menuOpenIcon.classList.add('hidden');
                menuCloseIcon.classList.remove('hidden');
            } else {
                // Hide menu
                mobileMenu.classList.remove('opacity-100', 'translate-x-0');
                mobileMenu.classList.add('opacity-0', '-translate-x-full');
                menuOpenIcon.classList.remove('hidden');
                menuCloseIcon.classList.add('hidden');
            }
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (isOpen && !mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                isOpen = false;
                mobileMenu.classList.remove('opacity-100', 'translate-x-0');
                mobileMenu.classList.add('opacity-0', '-translate-x-full');
                menuOpenIcon.classList.remove('hidden');
                menuCloseIcon.classList.add('hidden');
            }
        });
        
        // Close menu on window resize (when switching to desktop view)
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024 && isOpen) { // lg breakpoint
                isOpen = false;
                mobileMenu.classList.remove('opacity-100', 'translate-x-0');
                mobileMenu.classList.add('opacity-0', '-translate-x-full');
                menuOpenIcon.classList.remove('hidden');
                menuCloseIcon.classList.add('hidden');
            }
        });
    }
    
    // Add any other website-specific functionality here
    // Example: Image galleries, artist interactions, etc.
})
