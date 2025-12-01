import './bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import Chart from 'chart.js/auto';

window.Chart = Chart;

// Sidebar Toggle Functionality
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    
    // Load saved state from localStorage
    const sidebarState = localStorage.getItem('sidebarState');
    if (sidebarState === 'collapsed') {
        sidebar.classList.add('collapsed');
        mainContent.classList.add('expanded');
    }
    
    // Toggle sidebar on button click
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            
            // Save state to localStorage
            if (sidebar.classList.contains('collapsed')) {
                localStorage.setItem('sidebarState', 'collapsed');
            } else {
                localStorage.setItem('sidebarState', 'expanded');
            }
        });
    }
    
    // Mobile responsive - toggle sidebar on small screens
    if (window.innerWidth <= 768) {
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('mobile-open');
            });
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnToggle = toggleBtn.contains(event.target);
            
            if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('mobile-open')) {
                sidebar.classList.remove('mobile-open');
            }
        });
    }
    
    // Active menu highlight based on current route
    const currentPath = window.location.pathname;
    const menuItems = document.querySelectorAll('.sidebar-menu .menu-item');
    
    menuItems.forEach(item => {
        const link = item.querySelector('a');
        if (link && link.getAttribute('href') === currentPath) {
            item.classList.add('active');
        }
    });
    
    // Auto-collapse sidebar on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth <= 768) {
            sidebar.classList.remove('mobile-open');
        }
    });
});
