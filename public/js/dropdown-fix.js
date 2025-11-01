// Dropdown Menu Fix for Beranda Page

document.addEventListener('DOMContentLoaded', function() {
    console.log('Dropdown fix initialized');
    
    // Initialize Bootstrap dropdowns
    const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
    const dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl);
    });
    
    // Custom dropdown handling for better control
    const dropdowns = document.querySelectorAll('.dropdown');
    
    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.dropdown-toggle');
        const menu = dropdown.querySelector('.dropdown-menu');
        
        if (toggle && menu) {
            // Remove default Bootstrap behavior
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Close all other dropdowns
                dropdowns.forEach(otherDropdown => {
                    if (otherDropdown !== dropdown) {
                        otherDropdown.classList.remove('show');
                        const otherMenu = otherDropdown.querySelector('.dropdown-menu');
                        if (otherMenu) {
                            otherMenu.classList.remove('show');
                        }
                    }
                });
                
                // Toggle current dropdown
                dropdown.classList.toggle('show');
                menu.classList.toggle('show');
                
                console.log('Dropdown toggled:', dropdown.classList.contains('show'));
            });
        }
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
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
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
                const menu = dropdown.querySelector('.dropdown-menu');
                if (menu) {
                    menu.classList.remove('show');
                }
            });
        }
    });
    
    // Fix mobile dropdown behavior
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener('click', function() {
            // Close all dropdowns when mobile menu is toggled
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
                const menu = dropdown.querySelector('.dropdown-menu');
                if (menu) {
                    menu.classList.remove('show');
                }
            });
        });
    }
    
    // Add visual feedback for dropdown items
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
        
        // Add click feedback
        item.addEventListener('click', function() {
            // Add a brief visual feedback
            this.style.background = '#e3f2fd';
            setTimeout(() => {
                this.style.background = 'transparent';
            }, 200);
        });
    });
    
    // Debug information
    console.log('Dropdowns found:', dropdowns.length);
    console.log('Dropdown items found:', dropdownItems.length);
    
    // Test dropdown functionality
    setTimeout(() => {
        console.log('Testing dropdown functionality...');
        const testDropdown = document.querySelector('.dropdown');
        if (testDropdown) {
            console.log('First dropdown element:', testDropdown);
            console.log('Dropdown toggle:', testDropdown.querySelector('.dropdown-toggle'));
            console.log('Dropdown menu:', testDropdown.querySelector('.dropdown-menu'));
        }
    }, 1000);
});


















