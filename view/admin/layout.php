<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Admin Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="/sotre_php_mvc/public/css/sidebar.css?v=1">


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
                            <a href="index.php?controller=product&action=create" class="nav-link">
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
        <i class='bx bx-category nav-icon'></i>  
        <span class="nav-text">Categories</span>
        <i class='bx bx-chevron-down submenu-toggle'></i>
        <span class="tooltip">Categories</span>
    </a>
    <ul class="submenu">
        <li class="nav-item">
            <a href="index.php?controller=category&action=index" class="nav-link">
                <span class="nav-text">All Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="index.php?controller=category&action=create" class="nav-link">
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



                
               <li class="nav-item has-submenu">
                    <a href="javascript:void(0)" class="nav-link">
                     <i class='bx bx-user-check nav-icon'></i>  
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
                                    <a href="index.php?controller=client&action=create" class="nav-link">
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
                
<li class="nav-item has-submenu">
    <a href="javascript:void(0)" class="nav-link">
        <i class='bx bx-user-circle nav-icon'></i> 
        <span class="nav-text">User</span>
        <i class='bx bx-chevron-down submenu-toggle'></i>
        <span class="tooltip">Users</span>
    </a>
    <ul class="submenu">
        <li class="nav-item">
            <a href="index.php?controller=user&action=index" class="nav-link"> 
                <span class="nav-text">All Users</span>
            </a>
        </li>
                        <li class="nav-item">
                            <a href="index.php?controller=user&action=create" class="nav-link">
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
                    <form action="index.php?controller=user&action=logout" method="post">
                        <button type="submit">
                              <i class='bx bx-log-out'></i> Log Out</button>
                     </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <?php include $view ?>
    </main>
<script src="/sotre_php_mvc/public/javascript/sidebare.js"></script>



</body>
</html>