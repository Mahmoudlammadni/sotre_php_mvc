 function dashboard() {
            return {
                isSidebarCollapsed: false,
                isMobileSidebarOpen: false,
                isDarkMode: false,
                activeMenuItem: 'overview',
                
                init() {
                    if (localStorage.getItem('sidebarCollapsed') === 'true') {
                        this.isSidebarCollapsed = true;
                    }
                    
                    if (localStorage.getItem('darkMode') === 'true' || 
                        (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                        this.isDarkMode = true;
                        document.documentElement.classList.add('dark');
                    }
                    
                    this.setActiveMenuItem();
                },
                
                toggleSidebar() {
                    this.isSidebarCollapsed = !this.isSidebarCollapsed;
                    localStorage.setItem('sidebarCollapsed', this.isSidebarCollapsed);
                },
                
                toggleDarkMode() {
                    this.isDarkMode = !this.isDarkMode;
                    localStorage.setItem('darkMode', this.isDarkMode);
                    
                    if (this.isDarkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                },
                
                isActive(menuItem) {
                    return this.activeMenuItem === menuItem;
                },
                
                setActiveMenuItem() {
                
                    this.activeMenuItem = 'overview';
                }
            }
        }