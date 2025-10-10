/**
 * Admin Dashboard JavaScript
 * Island Art Admin Panel
 */

class IslandArtAdmin {
    constructor() {
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.initializeSidebar();
        this.initializeDarkMode();
        this.initializeTooltips();
        this.initializeModals();
        this.initializeDataTables();
        this.initializeNotifications();
    }

    // Sidebar Navigation
    setupEventListeners() {
        document.addEventListener('DOMContentLoaded', () => {
            // Mobile sidebar toggle
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', () => {
                    this.toggleSidebar();
                });
            }

            if (overlay) {
                overlay.addEventListener('click', () => {
                    this.closeSidebar();
                });
            }

            // Dropdown menus
            this.initializeDropdowns();
            
            // Form validation
            this.initializeFormValidation();
            
            // File uploads
            this.initializeFileUploads();
        });
    }

    initializeSidebar() {
        const navItems = document.querySelectorAll('.admin-nav-item');
        const currentPath = window.location.pathname;

        navItems.forEach(item => {
            const href = item.getAttribute('href');
            if (href && currentPath.includes(href)) {
                item.classList.add('active');
            }
        });
    }

    toggleSidebar() {
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (sidebar && overlay) {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    }

    closeSidebar() {
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (sidebar && overlay) {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    }

    // Dark Mode Toggle
    initializeDarkMode() {
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const html = document.documentElement;

        // Check for saved theme preference or default to light
        const savedTheme = localStorage.getItem('admin-theme') || 'light';
        html.classList.toggle('dark', savedTheme === 'dark');

        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', () => {
                const isDark = html.classList.contains('dark');
                html.classList.toggle('dark', !isDark);
                localStorage.setItem('admin-theme', isDark ? 'light' : 'dark');
                
                // Update toggle icon
                this.updateDarkModeIcon(!isDark);
            });
        }
    }

    updateDarkModeIcon(isDark) {
        const toggle = document.getElementById('dark-mode-toggle');
        if (toggle) {
            const icon = toggle.querySelector('i') || toggle.querySelector('svg');
            if (icon) {
                icon.className = isDark ? 'fas fa-moon' : 'fas fa-sun';
            }
        }
    }

    // Tooltips
    initializeTooltips() {
        const tooltipElements = document.querySelectorAll('[data-tooltip]');
        
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', (e) => {
                this.showTooltip(e.target);
            });
            
            element.addEventListener('mouseleave', () => {
                this.hideTooltip();
            });
        });
    }

    showTooltip(element) {
        const text = element.getAttribute('data-tooltip');
        if (!text) return;

        const tooltip = document.createElement('div');
        tooltip.className = 'absolute z-50 px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm tooltip dark:bg-gray-700';
        tooltip.textContent = text;
        tooltip.id = 'admin-tooltip';

        document.body.appendChild(tooltip);

        const rect = element.getBoundingClientRect();
        tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
        tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + 'px';
    }

    hideTooltip() {
        const tooltip = document.getElementById('admin-tooltip');
        if (tooltip) {
            tooltip.remove();
        }
    }

    // Modal Management
    initializeModals() {
        const modalTriggers = document.querySelectorAll('[data-modal-target]');
        const modalCloses = document.querySelectorAll('[data-modal-close]');

        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = trigger.getAttribute('data-modal-target');
                this.openModal(targetId);
            });
        });

        modalCloses.forEach(closeBtn => {
            closeBtn.addEventListener('click', () => {
                this.closeModal();
            });
        });

        // Close modal on background click
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal-overlay')) {
                this.closeModal();
            }
        });

        // Close modal on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeModal();
            }
        });
    }

    openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('fade-in');
            document.body.style.overflow = 'hidden';
        }
    }

    closeModal() {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.classList.add('hidden');
            modal.classList.remove('fade-in');
        });
        document.body.style.overflow = '';
    }

    // Dropdown Menus
    initializeDropdowns() {
        const dropdownTriggers = document.querySelectorAll('[data-dropdown-toggle]');
        
        dropdownTriggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                const targetId = trigger.getAttribute('data-dropdown-toggle');
                const dropdown = document.getElementById(targetId);
                
                if (dropdown) {
                    // Close other dropdowns
                    this.closeAllDropdowns();
                    
                    // Toggle current dropdown
                    dropdown.classList.toggle('hidden');
                }
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', () => {
            this.closeAllDropdowns();
        });
    }

    closeAllDropdowns() {
        const dropdowns = document.querySelectorAll('[id$="-dropdown"]');
        dropdowns.forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    }

    // Data Tables Enhancement
    initializeDataTables() {
        const tables = document.querySelectorAll('.admin-table');
        
        tables.forEach(table => {
            this.enhanceTable(table);
        });
    }

    enhanceTable(table) {
        // Add sorting functionality
        const headers = table.querySelectorAll('th[data-sortable]');
        
        headers.forEach(header => {
            header.style.cursor = 'pointer';
            header.addEventListener('click', () => {
                this.sortTable(table, header);
            });
        });

        // Add row selection
        this.addRowSelection(table);
    }

    sortTable(table, header) {
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        const headerIndex = Array.from(header.parentNode.children).indexOf(header);
        const isAscending = header.classList.contains('sort-asc');

        rows.sort((a, b) => {
            const aText = a.children[headerIndex].textContent.trim();
            const bText = b.children[headerIndex].textContent.trim();
            
            if (isAscending) {
                return bText.localeCompare(aText);
            } else {
                return aText.localeCompare(bText);
            }
        });

        // Update header classes
        header.parentNode.querySelectorAll('th').forEach(th => {
            th.classList.remove('sort-asc', 'sort-desc');
        });
        
        header.classList.add(isAscending ? 'sort-desc' : 'sort-asc');

        // Reorder rows
        rows.forEach(row => tbody.appendChild(row));
    }

    addRowSelection(table) {
        const rows = table.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            row.addEventListener('click', (e) => {
                if (e.target.type !== 'checkbox') {
                    row.classList.toggle('bg-blue-50');
                    row.classList.toggle('dark:bg-blue-900/20');
                }
            });
        });
    }

    // Form Validation
    initializeFormValidation() {
        const forms = document.querySelectorAll('form[data-validate]');
        
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                if (!this.validateForm(form)) {
                    e.preventDefault();
                }
            });
        });
    }

    validateForm(form) {
        let isValid = true;
        const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
        
        inputs.forEach(input => {
            if (!input.value.trim()) {
                this.showFieldError(input, 'This field is required');
                isValid = false;
            } else {
                this.clearFieldError(input);
            }
        });

        return isValid;
    }

    showFieldError(input, message) {
        this.clearFieldError(input);
        
        const error = document.createElement('div');
        error.className = 'text-red-600 text-sm mt-1 field-error';
        error.textContent = message;
        
        input.parentNode.appendChild(error);
        input.classList.add('border-red-500');
    }

    clearFieldError(input) {
        const existingError = input.parentNode.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }
        input.classList.remove('border-red-500');
    }

    // File Upload Enhancement
    initializeFileUploads() {
        const fileInputs = document.querySelectorAll('input[type="file"]');
        
        fileInputs.forEach(input => {
            this.enhanceFileInput(input);
        });
    }

    enhanceFileInput(input) {
        const wrapper = document.createElement('div');
        wrapper.className = 'relative border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-lg p-6 hover:border-blue-500 transition-colors';
        
        input.parentNode.insertBefore(wrapper, input);
        wrapper.appendChild(input);
        
        const label = document.createElement('div');
        label.className = 'text-center';
        label.innerHTML = `
            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div class="mt-4">
                <span class="text-blue-600 hover:text-blue-500 font-medium">Upload a file</span>
                <span class="text-slate-500"> or drag and drop</span>
            </div>
            <p class="text-xs text-slate-500 mt-2">PNG, JPG, GIF up to 10MB</p>
        `;
        
        wrapper.appendChild(label);
        
        // Drag and drop functionality
        wrapper.addEventListener('dragover', (e) => {
            e.preventDefault();
            wrapper.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        });
        
        wrapper.addEventListener('dragleave', () => {
            wrapper.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        });
        
        wrapper.addEventListener('drop', (e) => {
            e.preventDefault();
            wrapper.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                input.files = files;
                this.updateFileLabel(wrapper, files[0].name);
            }
        });
        
        input.addEventListener('change', () => {
            if (input.files.length > 0) {
                this.updateFileLabel(wrapper, input.files[0].name);
            }
        });
    }

    updateFileLabel(wrapper, fileName) {
        const label = wrapper.querySelector('div:last-child');
        label.innerHTML = `
            <svg class="mx-auto h-12 w-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="mt-4">
                <span class="text-green-600 font-medium">${fileName}</span>
            </div>
            <p class="text-xs text-slate-500 mt-2">File selected successfully</p>
        `;
    }

    // Notifications
    initializeNotifications() {
        // Auto-dismiss notifications after 5 seconds
        const notifications = document.querySelectorAll('.admin-alert');
        
        notifications.forEach(notification => {
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        });
    }

    // Utility Methods
    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `admin-alert-${type} fixed top-4 right-4 z-50 max-w-sm slide-in-right`;
        notification.innerHTML = `
            <div class="flex items-center">
                <div class="flex-1">${message}</div>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-current opacity-70 hover:opacity-100">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }

    // AJAX Helper
    async apiRequest(url, options = {}) {
        const defaultOptions = {
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        };
        
        const mergedOptions = { ...defaultOptions, ...options };
        
        try {
            const response = await fetch(url, mergedOptions);
            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.message || 'Request failed');
            }
            
            return data;
        } catch (error) {
            this.showNotification(error.message, 'error');
            throw error;
        }
    }
}

// Initialize admin dashboard when DOM is loaded
const adminDashboard = new IslandArtAdmin();

// Export for use in other scripts
window.IslandArtAdmin = IslandArtAdmin;