// Beranda Page Scrolling Fixes

document.addEventListener('DOMContentLoaded', function() {
    // Ensure scrolling is enabled
    document.body.style.overflowY = 'auto';
    document.body.style.overflowX = 'hidden';
    
    // Fix any potential scroll issues
    function enableScrolling() {
        document.documentElement.style.overflowY = 'auto';
        document.body.style.overflowY = 'auto';
        document.body.style.overflowX = 'hidden';
        
        // Remove any inline styles that might block scrolling
        const heroSection = document.querySelector('.hero-section');
        if (heroSection) {
            heroSection.style.overflow = 'visible';
        }
        
        // Ensure all sections allow scrolling
        const sections = document.querySelectorAll('section');
        sections.forEach(section => {
            section.style.overflow = 'visible';
        });
    }
    
    // Call enableScrolling function
    enableScrolling();
    
    // Fix dropdown functionality
    function initializeDropdowns() {
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        
        dropdownToggles.forEach(toggle => {
            // Remove any existing event listeners
            toggle.removeEventListener('click', handleDropdownClick);
            
            // Add click event listener
            toggle.addEventListener('click', handleDropdownClick);
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(event.target)) {
                    dropdown.classList.remove('show');
                    const menu = dropdown.querySelector('.dropdown-menu');
                    if (menu) {
                        menu.classList.remove('show');
                    }
                }
            });
        });
    }
    
    function handleDropdownClick(event) {
        event.preventDefault();
        event.stopPropagation();
        
        const dropdown = this.closest('.dropdown');
        const menu = dropdown.querySelector('.dropdown-menu');
        
        // Close all other dropdowns
        const allDropdowns = document.querySelectorAll('.dropdown');
        allDropdowns.forEach(d => {
            if (d !== dropdown) {
                d.classList.remove('show');
                const dMenu = d.querySelector('.dropdown-menu');
                if (dMenu) {
                    dMenu.classList.remove('show');
                }
            }
        });
        
        // Toggle current dropdown
        dropdown.classList.toggle('show');
        if (menu) {
            menu.classList.toggle('show');
        }
    }
    
    // Initialize dropdowns
    initializeDropdowns();
    
    // Fix mobile menu toggle
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener('click', function() {
            navbarCollapse.classList.toggle('show');
        });
    }
    
    // Ensure proper touch scrolling on mobile
    let touchStartY = 0;
    let touchEndY = 0;
    
    document.addEventListener('touchstart', function(event) {
        touchStartY = event.touches[0].clientY;
    }, { passive: true });
    
    document.addEventListener('touchend', function(event) {
        touchEndY = event.changedTouches[0].clientY;
        handleSwipe();
    }, { passive: true });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartY - touchEndY;
        
        if (Math.abs(diff) > swipeThreshold) {
            // Swipe detected, ensure scrolling is enabled
            enableScrolling();
        }
    }
    
    // Add scroll indicator
    function addScrollIndicator() {
        const scrollIndicator = document.createElement('div');
        scrollIndicator.id = 'scroll-indicator';
        scrollIndicator.style.cssText = `
            position: fixed;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            background: rgba(31, 111, 214, 0.8);
            color: white;
            padding: 10px;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1000;
            transition: all 0.3s ease;
            font-size: 20px;
        `;
        scrollIndicator.innerHTML = '<i class="fas fa-arrow-down"></i>';
        scrollIndicator.title = 'Scroll ke bawah';
        
        scrollIndicator.addEventListener('click', function() {
            window.scrollTo({
                top: window.innerHeight,
                behavior: 'smooth'
            });
        });
        
        document.body.appendChild(scrollIndicator);
        
        // Hide indicator when scrolled down
        window.addEventListener('scroll', function() {
            if (window.scrollY > window.innerHeight / 2) {
                scrollIndicator.style.opacity = '0.5';
            } else {
                scrollIndicator.style.opacity = '1';
            }
        });
    }
    
    // Add scroll indicator after a delay
    setTimeout(addScrollIndicator, 2000);
    
    // Debug logging
    console.log('Beranda scroll fixes initialized');
    console.log('Dropdowns found:', document.querySelectorAll('.dropdown').length);
    console.log('Scrolling enabled:', document.body.style.overflowY);
});
