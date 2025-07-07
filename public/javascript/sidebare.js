  const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle-sidebar');
        const mobileToggleBtn = document.getElementById('mobile-menu-toggle');
        
        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');
            
            const icon = toggleBtn.querySelector('i');
            icon.classList.toggle('bx-chevron-left');
            icon.classList.toggle('bx-chevron-right');
            
            const isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        }
        
        function toggleMobileSidebar() {
            sidebar.classList.toggle('active');
        }
        
        function setupSubmenus() {
            document.querySelectorAll('.has-submenu').forEach(item => {
                const link = item.querySelector('.nav-link');
                const submenu = item.querySelector('.submenu');
                const toggleIcon = item.querySelector('.submenu-toggle');
                
                link.addEventListener('click', function(e) {
                    if (!sidebar.classList.contains('collapsed')) {
                        submenu.classList.toggle('open');
                        toggleIcon.classList.toggle('bx-chevron-down');
                        toggleIcon.classList.toggle('bx-chevron-up');
                        e.preventDefault();
                    }
                });
            });
        }
        
        function initSidebarState() {
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                toggleBtn.querySelector('i').classList.remove('bx-chevron-left');
                toggleBtn.querySelector('i').classList.add('bx-chevron-right');
            }
        }
        
        toggleBtn.addEventListener('click', toggleSidebar);
        mobileToggleBtn.addEventListener('click', toggleMobileSidebar);
        
        sidebar.addEventListener('transitionend', function() {
            if (this.classList.contains('collapsed')) {
                document.querySelectorAll('.submenu').forEach(submenu => {
                    submenu.classList.remove('open');
                });
                document.querySelectorAll('.submenu-toggle').forEach(icon => {
                    icon.classList.remove('bx-chevron-up');
                    icon.classList.add('bx-chevron-down');
                });
            }
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            initSidebarState();
            setupSubmenus();
            
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 992 && 
                    !sidebar.contains(e.target) && 
                    e.target !== mobileToggleBtn) {
                    sidebar.classList.remove('active');
                }
            });
        });