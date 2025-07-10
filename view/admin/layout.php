<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f2ff',
                            100: '#e0e5ff',
                            200: '#cbd0ff',
                            300: '#a8b1ff',
                            400: '#7d87ff',
                            500: '#4d55ff',
                            600: '#2c2df5',
                            700: '#1f1fd8',
                            800: '#1d1dae',
                            900: '#1f1f89',
                        },
                        dark: {
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    transitionProperty: {
                        'width': 'width',
                        'spacing': 'margin, padding',
                    },
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .submenu-transition {
            transition: max-height 0.3s ease-in-out, opacity 0.2s ease;
        }
        .sidebar-collapsed .group:hover .group-hover\:block {
            display: block;
        }
        .sidebar-collapsed .group:hover .group-hover\:rotate-90 {
            transform: rotate(90deg);
        }
    </style>
</head>
<body class="h-full bg-gray-50 text-gray-800 dark:bg-dark-900 dark:text-gray-200 font-sans" x-data="dashboard()" x-init="init()">
    <div x-show="isMobileSidebarOpen" @click="isMobileSidebarOpen = false" 
         class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
    </div>

    <aside class="fixed inset-y-0 left-0 z-30 flex flex-col w-64 h-screen transition-all duration-300 border-r border-gray-200 bg-white dark:bg-dark-800 dark:border-gray-700"
           :class="{
               '-translate-x-full lg:translate-x-0': !isMobileSidebarOpen,
               'w-20': isSidebarCollapsed,
               'shadow-xl': isMobileSidebarOpen
           }">
        
        <!-- Logo Area -->
        <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-3 overflow-hidden">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-primary-100 dark:bg-primary-900 text-primary-600 dark:text-primary-300">
                    <i class='bx bxs-store-alt text-xl'></i>
                </div>
                <span class="text-lg font-semibold whitespace-nowrap transition-opacity duration-300"
                      :class="{'opacity-0 w-0': isSidebarCollapsed}">StorePro</span>
            </div>
            
            <button @click="toggleSidebar" class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400">
                <i class='bx text-xl' :class="isSidebarCollapsed ? 'bx-chevron-right' : 'bx-chevron-left'"></i>
            </button>
        </div>
        
        <nav class="flex-1 overflow-y-auto">
            <div class="px-4 py-3">
                <div class="mb-6">
                    <p class="text-xs font-semibold tracking-wider text-gray-500 uppercase dark:text-gray-400 mb-2 px-2"
                       :class="{'opacity-0 h-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Dashboard</p>
                    
                    <ul class="space-y-1">
                        <li>
                            <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg group"
                               :class="{'bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300': isActive('overview'), 
                                       'hover:bg-gray-100 dark:hover:bg-gray-700': !isActive('overview')}">
                                <i class='bx bx-home text-xl mr-3'></i>
                                <span :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Overview</span>
                                <span x-show="isSidebarCollapsed" class="absolute left-full ml-4 px-2 py-1 text-xs rounded-md bg-gray-900 text-white opacity-0 group-hover:opacity-100 whitespace-nowrap">Overview</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg group"
                               :class="{'bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300': isActive('analytics'), 
                                       'hover:bg-gray-100 dark:hover:bg-gray-700': !isActive('analytics')}">
                                <i class='bx bx-bar-chart text-xl mr-3'></i>
                                <span :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Analytics</span>
                                <span x-show="isSidebarCollapsed" class="absolute left-full ml-4 px-2 py-1 text-xs rounded-md bg-gray-900 text-white opacity-0 group-hover:opacity-100 whitespace-nowrap">Analytics</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="mb-6">
                    <p class="text-xs font-semibold tracking-wider text-gray-500 uppercase dark:text-gray-400 mb-2 px-2"
                       :class="{'opacity-0 h-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Management</p>
                    
                    <ul class="space-y-1">
                        <li x-data="{ open: false }">
                            <button @click="!isSidebarCollapsed && (open = !open)" 
                                    class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium rounded-lg group"
                                    :class="{'bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300': isActive('products'), 
                                            'hover:bg-gray-100 dark:hover:bg-gray-700': !isActive('products')}">
                                <div class="flex items-center">
                                    <i class='bx bx-package text-xl mr-3'></i>
                                    <span :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Products</span>
                                    <span x-show="isSidebarCollapsed" class="absolute left-full ml-4 px-2 py-1 text-xs rounded-md bg-gray-900 text-white opacity-0 group-hover:opacity-100 whitespace-nowrap">Products</span>
                                </div>
                                <i x-show="!isSidebarCollapsed" class='bx text-lg transition-transform duration-200' 
                                   :class="{'transform rotate-180': open, 'bx-chevron-down': !open}"></i>
                            </button>
                            
                            <ul x-show="open && !isSidebarCollapsed" x-collapse class="pl-4 mt-1 space-y-1 submenu-transition">
                                <li>
                                    <a href="index.php?controller=product&action=index" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span>All Products</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?controller=product&action=create" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span>Add New</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?controller=category&action=index" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span>Categories</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span>Inventory</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li x-data="{ open: false }">
                            <button @click="!isSidebarCollapsed && (open = !open)" 
                                    class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium rounded-lg group"
                                    :class="{'bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300': isActive('categories'), 
                                            'hover:bg-gray-100 dark:hover:bg-gray-700': !isActive('categories')}">
                                <div class="flex items-center">
                                    <i class='bx bx-category text-xl mr-3'></i>
                                    <span :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Categories</span>
                                    <span x-show="isSidebarCollapsed" class="absolute left-full ml-4 px-2 py-1 text-xs rounded-md bg-gray-900 text-white opacity-0 group-hover:opacity-100 whitespace-nowrap">Categories</span>
                                </div>
                                <i x-show="!isSidebarCollapsed" class='bx text-lg transition-transform duration-200' 
                                   :class="{'transform rotate-180': open, 'bx-chevron-down': !open}"></i>
                            </button>
                            
                            <ul x-show="open && !isSidebarCollapsed" x-collapse class="pl-4 mt-1 space-y-1 submenu-transition">
                                <li>
                                    <a href="index.php?controller=category&action=index" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span>All Categories</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?controller=category&action=create" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span>Add New</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li x-data="{ open: false }">
                            <button @click="!isSidebarCollapsed && (open = !open)" 
                                    class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium rounded-lg group"
                                    :class="{'bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300': isActive('customers'), 
                                            'hover:bg-gray-100 dark:hover:bg-gray-700': !isActive('customers')}">
                                <div class="flex items-center">
                                    <i class='bx bx-user-check text-xl mr-3'></i>
                                    <span :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Customers</span>
                                    <span x-show="isSidebarCollapsed" class="absolute left-full ml-4 px-2 py-1 text-xs rounded-md bg-gray-900 text-white opacity-0 group-hover:opacity-100 whitespace-nowrap">Customers</span>
                                </div>
                                <i x-show="!isSidebarCollapsed" class='bx text-lg transition-transform duration-200' 
                                   :class="{'transform rotate-180': open, 'bx-chevron-down': !open}"></i>
                            </button>
                            
                            <ul x-show="open && !isSidebarCollapsed" x-collapse class="pl-4 mt-1 space-y-1 submenu-transition">
                                <li>
                                    <a href="index.php?controller=client&action=index" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span>All Customers</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?controller=client&action=create" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span>Add New</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li x-data="{ open: false }">
                            <button @click="!isSidebarCollapsed && (open = !open)" 
                                    class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium rounded-lg group"
                                    :class="{'bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300': isActive('users'), 
                                            'hover:bg-gray-100 dark:hover:bg-gray-700': !isActive('users')}">
                                <div class="flex items-center">
                                    <i class='bx bx-user-circle text-xl mr-3'></i>
                                    <span :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Users</span>
                                    <span x-show="isSidebarCollapsed" class="absolute left-full ml-4 px-2 py-1 text-xs rounded-md bg-gray-900 text-white opacity-0 group-hover:opacity-100 whitespace-nowrap">Users</span>
                                </div>
                                <i x-show="!isSidebarCollapsed" class='bx text-lg transition-transform duration-200' 
                                   :class="{'transform rotate-180': open, 'bx-chevron-down': !open}"></i>
                            </button>
                            
                            <ul x-show="open && !isSidebarCollapsed" x-collapse class="pl-4 mt-1 space-y-1 submenu-transition">
                                <li>
                                    <a href="index.php?controller=user&action=index" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span>All Users</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?controller=user&action=create" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span>Add New</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span>Segments</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="#" class="flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg group"
                               :class="{'bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300': isActive('orders'), 
                                       'hover:bg-gray-100 dark:hover:bg-gray-700': !isActive('orders')}">
                                <div class="flex items-center">
                                    <i class='bx bx-cart text-xl mr-3'></i>
                                    <span :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Orders</span>
                                    <span x-show="isSidebarCollapsed" class="absolute left-full ml-4 px-2 py-1 text-xs rounded-md bg-gray-900 text-white opacity-0 group-hover:opacity-100 whitespace-nowrap">Orders</span>
                                </div>
                                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-primary-600 rounded-full"
                                      :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">9</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg group"
                               :class="{'bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300': isActive('payments'), 
                                       'hover:bg-gray-100 dark:hover:bg-gray-700': !isActive('payments')}">
                                <i class='bx bx-dollar-circle text-xl mr-3'></i>
                                <span :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Payments</span>
                                <span x-show="isSidebarCollapsed" class="absolute left-full ml-4 px-2 py-1 text-xs rounded-md bg-gray-900 text-white opacity-0 group-hover:opacity-100 whitespace-nowrap">Payments</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="mb-6">
                    <p class="text-xs font-semibold tracking-wider text-gray-500 uppercase dark:text-gray-400 mb-2 px-2"
                       :class="{'opacity-0 h-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Marketing</p>
                    
                    <ul class="space-y-1">
                        <li>
                            <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg group"
                               :class="{'bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300': isActive('campaigns'), 
                                       'hover:bg-gray-100 dark:hover:bg-gray-700': !isActive('campaigns')}">
                                <i class='bx bx-megaphone text-xl mr-3'></i>
                                <span :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Campaigns</span>
                                <span x-show="isSidebarCollapsed" class="absolute left-full ml-4 px-2 py-1 text-xs rounded-md bg-gray-900 text-white opacity-0 group-hover:opacity-100 whitespace-nowrap">Campaigns</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg group"
                               :class="{'bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300': isActive('email'), 
                                       'hover:bg-gray-100 dark:hover:bg-gray-700': !isActive('email')}">
                                <i class='bx bx-envelope text-xl mr-3'></i>
                                <span :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Email</span>
                                <span x-show="isSidebarCollapsed" class="absolute left-full ml-4 px-2 py-1 text-xs rounded-md bg-gray-900 text-white opacity-0 group-hover:opacity-100 whitespace-nowrap">Email</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="mb-6">
                    <p class="text-xs font-semibold tracking-wider text-gray-500 uppercase dark:text-gray-400 mb-2 px-2"
                       :class="{'opacity-0 h-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Settings</p>
                    
                    <ul class="space-y-1">
                        <li>
                            <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg group"
                               :class="{'bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300': isActive('settings'), 
                                       'hover:bg-gray-100 dark:hover:bg-gray-700': !isActive('settings')}">
                                <i class='bx bx-cog text-xl mr-3'></i>
                                <span :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Store Settings</span>
                                <span x-show="isSidebarCollapsed" class="absolute left-full ml-4 px-2 py-1 text-xs rounded-md bg-gray-900 text-white opacity-0 group-hover:opacity-100 whitespace-nowrap">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg group"
                               :class="{'bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300': isActive('staff'), 
                                       'hover:bg-gray-100 dark:hover:bg-gray-700': !isActive('staff')}">
                                <i class='bx bx-user-circle text-xl mr-3'></i>
                                <span :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">Staff</span>
                                <span x-show="isSidebarCollapsed" class="absolute left-full ml-4 px-2 py-1 text-xs rounded-md bg-gray-900 text-white opacity-0 group-hover:opacity-100 whitespace-nowrap">Staff</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-3 group">
                <img src="https://avatars.githubusercontent.com/u/187449224?v=4" alt="User" class="w-10 h-10 rounded-full">
                
                <div class="flex-1 min-w-0 transition-all duration-300 overflow-hidden"
                     :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">
                    <p class="text-sm font-medium truncate">Mahmoud Lamadni</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">Admin</p>
                </div>
                
                <form action="index.php?controller=user&action=logout" method="post" 
                      class="transition-all duration-300"
                      :class="{'opacity-0 w-0': isSidebarCollapsed, 'opacity-100': !isSidebarCollapsed}">
                    <button type="submit" class="p-1 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        <i class='bx bx-log-out text-xl'></i>
                    </button>
                </form>
                
                <form x-show="isSidebarCollapsed" action="index.php?controller=user&action=logout" method="post" 
                      class="absolute left-full ml-4 px-2 py-1 rounded-md bg-gray-900 text-white opacity-0 group-hover:opacity-100 whitespace-nowrap">
                    <button type="submit" class="text-xs">Log Out</button>
                </form>
            </div>
        </div>
    </aside>

    <div class="min-h-screen flex flex-col"
         :class="{'lg:ml-64': !isSidebarCollapsed, 'lg:ml-20': isSidebarCollapsed}">
        
        <header class="sticky top-0 z-10 bg-white dark:bg-dark-800 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                <button @click="isMobileSidebarOpen = true" class="p-1 rounded-md text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 lg:hidden">
                    <i class='bx bx-menu text-2xl'></i>
                </button>
                
                <div class="flex-1 max-w-md mx-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class='bx bx-search text-gray-400'></i>
                        </div>
                        <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-dark-700 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="Search...">
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <button @click="toggleDarkMode" class="p-1 rounded-full text-gray-500 hover:text-gray-600 dark:hover:text-gray-300">
                        <i class='bx text-xl' :class="isDarkMode ? 'bx-sun' : 'bx-moon'"></i>
                    </button>
                    
                    <button class="p-1 rounded-full text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 relative">
                        <i class='bx bx-bell text-xl'></i>
                        <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                    </button>
                    
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <span class="hidden sm:inline-block text-sm font-medium">Mahmoud Lamadni</span>
                            <img src="https://avatars.githubusercontent.com/u/187449224?v=4" alt="User" class="w-8 h-8 rounded-full">
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-dark-700 ring-1 ring-black ring-opacity-5 py-1 z-50"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Settings</a>
                            <form action="index.php?controller=user&action=logout" method="post">
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            <?php include $view ?>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
     <script>
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
     </script>
</body>
</html>