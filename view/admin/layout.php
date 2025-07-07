<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Admin Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        :root {
            --sidebar-expanded: 280px;
            --sidebar-collapsed: 90px;
            --primary: #7367f0;
            --primary-light: rgba(115, 103, 240, 0.1);
            --primary-dark: #5d52d1;
            --text-dark: #4b4b4b;
            --text-light: #a5a5a5;
            --white: #ffffff;
            --border: #eaeaea;
            --success: #28c76f;
            --warning: #ff9f43;
            --danger: #ea5455;
            --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            --shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f8f8;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* ========== Sidebar ========== */
     .sidebar {
    width: var(--sidebar-expanded);
    height: 100vh;
    background: var(--white);
    box-shadow: var(--shadow);
    position: fixed;
    left: 0;
    top: 0;
    transition: var(--transition);
    z-index: 1000;
    overflow-y: auto;
    overflow-x: hidden; 
    padding-bottom: 20px;
    display: flex;
    flex-direction: column;
}
.sidebar.collapsed .nav-text,
.sidebar.collapsed .menu-category,
.sidebar.collapsed .user-info {
    display: none; 
}


        .sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }

        /* Logo Area */
        .logo-area {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 25px 20px;
            border-bottom: 1px solid var(--border);
            height: 80px;
            flex-shrink: 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            transition: var(--transition);
            overflow: hidden;
        }

        .logo-icon {
            font-size: 28px;
            color: var(--primary);
            min-width: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-text {
            font-weight: 700;
            font-size: 20px;
            color: var(--text-dark);
            white-space: nowrap;
            transition: opacity 0.2s ease;
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
            width: 0;
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 22px;
            cursor: pointer;
            color: var(--text-light);
            transition: var(--transition);
            min-width: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-btn:hover {
            color: var(--primary);
            transform: scale(1.1);
        }

        .menu-category {
            color: var(--text-light);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 20px 25px 10px;
            white-space: nowrap;
            font-weight: 600;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-category {
            opacity: 0;
            width: 0;
            padding: 20px 0 10px;
        }

        .nav-menu {
            padding: 0 15px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .nav-menu::-webkit-scrollbar {
            width: 6px;
        }

        .nav-menu::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,0.1);
            border-radius: 3px;
        }

        .nav-item {
            list-style: none;
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 8px;
            color: var(--text-dark);
            text-decoration: none;
            transition: var(--transition);
            white-space: nowrap;
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover {
            background: var(--primary-light);
            color: var(--primary);
        }

        .nav-link:hover .nav-icon {
            transform: translateX(3px);
        }

        .nav-link.active {
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 500;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--primary);
            border-radius: 0 4px 4px 0;
        }

        .nav-icon {
            font-size: 22px;
            margin-right: 15px;
            min-width: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .nav-text {
            font-size: 14px;
            transition: var(--transition);
            font-weight: 500;
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
            width: 0;
        }

        .badge {
            margin-left: auto;
            background: var(--primary);
            color: white;
            font-size: 10px;
            padding: 3px 8px;
            border-radius: 10px;
            font-weight: 600;
        }

        .has-submenu {
            position: relative;
        }

        .submenu-toggle {
            margin-left: auto;
            transition: var(--transition);
            font-size: 18px;
            color: var(--text-light);
        }

        .nav-link:hover .submenu-toggle {
            color: var(--primary);
        }

        .submenu {
            padding-left: 15px;
            max-height: 0;
            overflow: hidden;
            transition: var(--transition);
        }

        .submenu.open {
            max-height: 500px;
        }

        .submenu .nav-link {
            padding: 10px 15px 10px 40px;
            font-size: 13px;
        }

        .sidebar.collapsed .submenu {
            display: none;
        }

        .sidebar-footer {
            padding: 20px;
            margin-top: auto;
            border-top: 1px solid var(--border);
            flex-shrink: 0;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            transition: var(--transition);
            overflow: hidden;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }

        .user-info {
            white-space: nowrap;
            transition: var(--transition);
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
        }

        .user-role {
            font-size: 12px;
            color: var(--text-light);
        }

        .sidebar.collapsed .user-info {
            opacity: 0;
            width: 0;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-expanded);
            transition: var(--transition);
            min-height: 100vh;
            padding: 30px;
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed);
        }

        .mobile-menu-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background: var(--primary);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            z-index: 999;
            box-shadow: 0 4px 12px rgba(115, 103, 240, 0.3);
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0 !important;
            }
            
            .mobile-menu-btn {
                display: flex;
            }
            
            .sidebar.collapsed {
                width: var(--sidebar-expanded);
            }
        }

        .nav-link .tooltip {
            position: absolute;
            left: calc(var(--sidebar-collapsed) + 15px);
            top: 50%;
            transform: translateY(-50%);
            background: #333;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 13px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            pointer-events: none;
            z-index: 1000;
        }

        .nav-link .tooltip::before {
            content: '';
            position: absolute;
            left: -5px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 5px 5px 5px 0;
            border-style: solid;
            border-color: transparent #333 transparent transparent;
        }

        .sidebar.collapsed .nav-link:hover .tooltip {
            opacity: 1;
            visibility: visible;
            left: calc(var(--sidebar-collapsed) + 20px);
        }
    </style>
</head>
<body>
    <button class="mobile-menu-btn" id="mobile-menu-toggle">
        <i class='bx bx-menu'></i>
    </button>

    <nav class="sidebar" id="sidebar">
        <div class="logo-area">
            <div class="logo">
                <i class='bx bxs-store-alt logo-icon'></i>
                <span class="logo-text">StorePro</span>
            </div>
            <button class="toggle-btn" id="toggle-sidebar">
                <i class='bx bx-chevron-left'></i>
            </button>
        </div>

        <div class="nav-menu">
            <div class="menu-category">Dashboard</div>
            <ul>
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class='bx bx-home nav-icon'></i>
                        <span class="nav-text">Overview</span>
                        <span class="tooltip">Overview</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class='bx bx-bar-chart nav-icon'></i>
                        <span class="nav-text">Analytics</span>
                        <span class="tooltip">Analytics</span>
                    </a>
                </li>
            </ul>
            
            <div class="menu-category">Management</div>
            <ul>
                <li class="nav-item has-submenu" id="products-menu">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class='bx bx-package nav-icon'></i>
                        <span class="nav-text">Products</span>
                        <i class='bx bx-chevron-down submenu-toggle'></i>
                        <span class="tooltip">Products</span>
                    </a>
                    <ul class="submenu">
                        <li class="nav-item">
                            <a href="index.php?controller=product&action=index" class="nav-link">
                                <span class="nav-text">All Products</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <span class="nav-text">Add New</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <span class="nav-text">Categories</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <span class="nav-text">Inventory</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item has-submenu">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class='bx bx-user nav-icon'></i>
                        <span class="nav-text">Customers</span>
                        <i class='bx bx-chevron-down submenu-toggle'></i>
                        <span class="tooltip">Customers</span>
                    </a>
                    <ul class="submenu">
                        <li class="nav-item">
                            <a href="index.php?controller=client&action=index" class="nav-link">
                                <span class="nav-text">All Customers</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <span class="nav-text">Add New</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <span class="nav-text">Segments</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class='bx bx-cart nav-icon'></i>
                        <span class="nav-text">Orders</span>
                        <span class="badge">9</span>
                        <span class="tooltip">Orders</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class='bx bx-dollar-circle nav-icon'></i>
                        <span class="nav-text">Payments</span>
                        <span class="tooltip">Payments</span>
                    </a>
                </li>
            </ul>
            
            <div class="menu-category">Marketing</div>
            <ul>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class='bx bx-megaphone nav-icon'></i>
                        <span class="nav-text">Campaigns</span>
                        <span class="tooltip">Campaigns</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class='bx bx-envelope nav-icon'></i>
                        <span class="nav-text">Email</span>
                        <span class="tooltip">Email</span>
                    </a>
                </li>
            </ul>
            
            <div class="menu-category">Settings</div>
            <ul>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class='bx bx-cog nav-icon'></i>
                        <span class="nav-text">Store Settings</span>
                        <span class="tooltip">Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class='bx bx-user-circle nav-icon'></i>
                        <span class="nav-text">Staff</span>
                        <span class="tooltip">Staff</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <div class="user-profile">
                <img src="https://avatars.githubusercontent.com/u/187449224?v=4" alt="User" class="user-avatar">
                <div class="user-info">
                    <div class="user-name">Mahmoud Lamadni</div>
                    <div class="user-role">Admin</div>
                </div>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <?php include $view ?>
    </main>

<script src="/store_php_mvc/public/javascript/sidebare.js"></script>



</body>
</html>