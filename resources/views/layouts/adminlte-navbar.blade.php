<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link sidebar-toggle" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.home') }}" class="nav-link home-link">
                <i class="fas fa-home mr-1"></i>Home
            </a>
        </li>
    </ul>

    <!-- Center brand/logo -->
    <div class="navbar-brand mx-auto d-none d-md-block">
        <div class="brand-content">
            <i class="fas fa-hotel brand-icon"></i>
            <span class="brand-text">Lux Hotel Admin</span>
        </div>
    </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item search-item">
            <a class="nav-link search-toggle" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search..." aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        <!-- User Menu -->
        <li class="nav-item dropdown user-menu">
            <a class="nav-link user-toggle" href="#" role="button" data-toggle="dropdown">
                <div class="user-panel">
                    <div class="user-image">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="user-info">
                        <span class="user-name">Administrator</span>
                        <span class="user-role">Admin</span>
                    </div>
                    <i class="fas fa-chevron-down user-arrow"></i>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i>My Profile
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-cog mr-2"></i>Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </div>
        </li>

        <!-- Fullscreen Toggle -->
        <li class="nav-item">
            <a class="nav-link fullscreen-toggle" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<style>
    /* Custom Navbar Styles */
    .main-header.navbar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-bottom: none;
        box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        padding: 0.5rem 1rem;
        min-height: 70px;
    }

    /* Left Sidebar Toggle */
    .sidebar-toggle {
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 10px 12px;
        margin-right: 10px;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .sidebar-toggle:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Home Link */
    .home-link {
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 8px 16px;
        margin: 0 5px;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .home-link:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Brand/Logo */
    .navbar-brand {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .brand-content {
        display: flex;
        align-items: center;
        padding: 8px 16px;
        background: rgba(255,255,255,0.1);
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
    }

    .brand-icon {
        font-size: 1.5rem;
        margin-right: 10px;
        color: #ffd43b;
    }

    .brand-text {
        font-weight: 700;
        font-size: 1.2rem;
        color: white;
        letter-spacing: 0.5px;
    }

    /* Search */
    .search-item {
        position: relative;
    }

    .search-toggle {
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 10px 12px;
        margin: 0 5px;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .search-toggle:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .navbar-search-block {
        position: absolute;
        right: 0;
        top: 100%;
        margin-top: 10px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        border: none;
        min-width: 300px;
        padding: 15px;
        z-index: 1000;
    }

    .form-control-navbar {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .form-control-navbar:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn-navbar {
        background: #667eea;
        border: none;
        border-radius: 8px;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-navbar:hover {
        background: #5a6fd8;
        transform: translateY(-1px);
    }

    /* Notifications */
    .notification-item {
        position: relative;
    }

    .notification-toggle {
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 10px 12px;
        margin: 0 5px;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.2);
        position: relative;
    }

    .notification-toggle:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: linear-gradient(135deg, #ff6b6b 0%, #fa5252 100%);
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 0.7rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    .dropdown-menu {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        margin-top: 10px;
        padding: 10px 0;
    }

    .dropdown-header {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1rem;
        padding: 10px 20px;
    }

    .dropdown-item {
        padding: 12px 20px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        border-radius: 8px;
        margin: 2px 10px;
        width: auto;
    }

    .dropdown-item:hover {
        background: #f8f9ff;
        transform: translateX(5px);
    }

    .dropdown-content {
        flex: 1;
        margin-left: 10px;
    }

    .dropdown-title {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.9rem;
    }

    .dropdown-text {
        color: #6c757d;
        font-size: 0.8rem;
        margin-top: 2px;
    }

    .dropdown-time {
        color: #868e96;
        font-size: 0.75rem;
        margin-top: 2px;
    }

    /* User Menu */
    .user-menu {
        margin-left: 10px;
    }

    .user-toggle {
        padding: 5px;
        border-radius: 12px;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .user-toggle:hover {
        background: rgba(255,255,255,0.1);
        transform: translateY(-1px);
    }

    .user-panel {
        display: flex;
        align-items: center;
        padding: 0px 10px;
        border-radius: 8px;
    }

    .user-image {
        width: 35px;
        height: 35px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
    }

    .user-image i {
        font-size: 1.5rem;
        color: white;
    }

    .user-info {
        display: flex;
        flex-direction: column;
        margin-right: 10px;
    }

    .user-name {
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        line-height: 1.2;
    }

    .user-role {
        color: rgba(255,255,255,0.8);
        font-size: 0.75rem;
        line-height: 1.2;
    }

    .user-arrow {
        color: rgba(255,255,255,0.7);
        font-size: 0.8rem;
        transition: transform 0.3s ease;
    }

    .user-toggle.show .user-arrow {
        transform: rotate(180deg);
    }

    /* Fullscreen Toggle */
    .fullscreen-toggle {
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 10px 12px;
        margin-left: 5px;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .fullscreen-toggle:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .navbar-brand {
            display: none;
        }
        
        .user-info {
            display: none;
        }
        
        .user-arrow {
            display: none;
        }
        
        .navbar-search-block {
            right: -50px;
            min-width: 280px;
        }
        
        .brand-content {
            padding: 6px 12px;
        }
        
        .brand-text {
            font-size: 1rem;
        }
    }

    /* Animation for dropdowns */
    .dropdown-menu {
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Icons hover effects */
    .nav-link i {
        transition: transform 0.3s ease;
    }

    .nav-link:hover i {
        transform: scale(1.1);
    }
</style>