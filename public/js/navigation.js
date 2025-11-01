// Navigation functionality for post-login pages
document.addEventListener('DOMContentLoaded', function() {
    console.log('Navigation initialized');
    
    // Initialize Bootstrap dropdowns
    const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
    const dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl);
    });
    
    console.log('Dropdowns initialized:', dropdownList.length);
    
    // Set active navigation item based on current page
    setActiveNavigation();
    
    // Initialize mobile navigation
    initializeMobileNavigation();
});

// Set active navigation item
function setActiveNavigation() {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        
        // Check if current path matches link href
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
        
        // Special handling for dropdown parent items
        const dropdownParent = link.closest('.dropdown');
        if (dropdownParent) {
            const dropdownItems = dropdownParent.querySelectorAll('.dropdown-item');
            dropdownItems.forEach(item => {
                if (item.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        }
    });
}

// Initialize mobile navigation
function initializeMobileNavigation() {
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        // Close mobile menu when clicking on a link
        const navLinks = navbarCollapse.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 991) {
                    navbarCollapse.classList.remove('show');
                }
            });
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!navbarToggler.contains(e.target) && !navbarCollapse.contains(e.target)) {
                navbarCollapse.classList.remove('show');
            }
        });
    }
}

// Logout function
function logout() {
    if (confirm('Apakah Anda yakin ingin keluar?')) {
        // You can customize this to your logout route
        window.location.href = '/admin/login';
    }
}

// Enhanced dropdown functionality
function enhanceDropdowns() {
    const dropdowns = document.querySelectorAll('.dropdown');
    
    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.dropdown-toggle');
        const menu = dropdown.querySelector('.dropdown-menu');
        
        if (toggle && menu) {
            // Add hover effect for desktop
            if (window.innerWidth > 991) {
                dropdown.addEventListener('mouseenter', function() {
                    this.classList.add('show');
                    menu.classList.add('show');
                });
                
                dropdown.addEventListener('mouseleave', function() {
                    this.classList.remove('show');
                    menu.classList.remove('show');
                });
            }
        }
    });
}

// Close all dropdowns when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.dropdown')) {
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('show');
            const menu = dropdown.querySelector('.dropdown-menu');
            if (menu) {
                menu.classList.remove('show');
            }
        });
    }
});

// Close dropdowns on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('show');
            const menu = dropdown.querySelector('.dropdown-menu');
            if (menu) {
                menu.classList.remove('show');
            }
        });
    }
});

// Initialize enhanced dropdowns after page load
window.addEventListener('load', function() {
    enhanceDropdowns();
});

// Handle window resize
window.addEventListener('resize', function() {
    enhanceDropdowns();
});


















