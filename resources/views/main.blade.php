<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Tata Usaha</title>
    
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #f8f9fc;
            --text-color: #5a5c69;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --topbar-height: 70px;
            --transition-speed: 0.3s;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
            overflow-x: hidden;
        }
        
        /* Improved Sidebar with better scrolling */
        .sidebar {
            display: flex;
            flex-direction: column;
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 0 0.15rem 1.75rem rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            transition: all var(--transition-speed) ease;
            z-index: 1000;
            border-radius: 0 15px 15px 0;
            /* Improved scroll behavior */
            overflow-y: auto;
            overflow-x: hidden;
        }
        
        /* Main sidebar content area that needs to scroll */
        .sidebar-content {
            display: flex;
            flex-direction: column;
            flex: 1;
            overflow-y: auto;
            padding-bottom: 80px; /* Space for logout button */
        }
        
        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }
        
        .sidebar-brand {
            height: var(--topbar-height);
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 10px;
            flex-shrink: 0; /* Prevent brand from shrinking */
        }
        
        .logo-img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            flex-shrink: 0;
            filter: drop-shadow(0 0 3px rgba(255, 255, 255, 0.5));
            transition: transform var(--transition-speed);
        }
        
        .sidebar.collapsed .logo-img {
            transform: scale(1.2);
        }
        
        .brand-text {
            margin-left: 10px;
            white-space: nowrap;
            overflow: hidden;
            transition: opacity var(--transition-speed);
        }
        
        /* Nav Items Styling */
        .nav-item {
            margin: 8px 0;
            position: relative;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            border-radius: 10px;
            margin: 0.25rem 1rem;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            transition: all 0.2s;
            white-space: nowrap;
            position: relative;
            overflow: hidden;
        }
        
        .nav-link:hover, .nav-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: #fff;
            border-radius: 0 4px 4px 0;
        }
        
        .icon-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            margin-right: 12px;
            flex-shrink: 0;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.1);
            transition: all var(--transition-speed);
        }
        
        .nav-link:hover .icon-wrapper, 
        .nav-link.active .icon-wrapper {
            background-color: rgba(255, 255, 255, 0.25);
            transform: rotate(-5deg);
        }
        
        .nav-text {
            flex-grow: 1;
            font-weight: 500;
            letter-spacing: 0.3px;
            transition: all var(--transition-speed);
        }
        
        .dropdown-icon {
            transition: transform 0.3s;
        }
        
        /* Nested Menu Styling - IMPROVED */
        .nested-menu {
            padding-left: 0;
            margin: 0 1rem;
            transition: max-height 0.3s ease;
            list-style: none;
            overflow: hidden;
            max-height: 0;
        }
        
        .nested-menu.show {
            max-height: 500px; /* Increased to ensure full visibility */
        }
        
        .nested-link {
            color: rgba(255, 255, 255, 0.7) !important;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            display: flex;
            align-items: center;
            transition: all 0.2s;
            border-radius: 8px;
            text-decoration: none;
            margin: 0.25rem 0;
            position: relative;
        }
        
        .nested-link:hover, .nested-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
            text-decoration: none;
        }
        
        .nested-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: #fff;
            border-radius: 0 4px 4px 0;
        }
        
        .nested-link i {
            margin-right: 8px;
            font-size: 0.9rem;
            transition: transform 0.2s;
        }
        
        .nested-link:hover i {
            transform: scale(1.2);
        }

        /* Logout Section */
        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            flex-shrink: 0; /* Prevent from shrinking */
            margin-top: auto; /* Push to bottom when there's space */
            width: 100%;
        }
        
        .logout-link {
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(255, 59, 48, 0.7) 0%, rgba(255, 59, 48, 0.9) 100%);
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }
        
        .logout-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 59, 48, 0.4);
            background: linear-gradient(135deg, rgba(255, 59, 48, 0.9) 0%, rgba(255, 59, 48, 1) 100%);
        }
        
        /* Collapsed State Styles */
        .sidebar.collapsed .nav-text, 
        .sidebar.collapsed .brand-text,
        .sidebar.collapsed .dropdown-icon {
            display: none;
        }
        
        .sidebar.collapsed .sidebar-brand {
            justify-content: center;
            padding: 0;
        }
        
        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 0.75rem 0;
            margin: 0.5rem;
            border-radius: 50%;
            width: 45px;
            height: 45px;
        }
        
        .sidebar.collapsed .icon-wrapper {
            margin-right: 0;
            transform: scale(1.2);
        }
        
        .sidebar.collapsed .nested-menu {
            display: none;
        }
        
        .sidebar.collapsed .logout-link {
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            margin: 0 auto;
        }
        
        /* Hover effects */
        .sidebar:not(.collapsed) .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: rgba(255, 255, 255, 0.7);
            transition: width 0.3s ease;
        }
        
        .sidebar:not(.collapsed) .nav-link:hover::after,
        .sidebar:not(.collapsed) .nav-link.active::after {
            width: 50%;
        }
        
        /* Improved scrollbars for better UX */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 3px;
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }
        
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }
        
        /* Firefox scrollbar styling */
        .sidebar {
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.2) rgba(255, 255, 255, 0.05);
        }
        
        /* Main Content Layout */
        .main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
            padding: 20px;
        }
        
        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        /* Top Navbar */
        .navbar-top {
            background-color: white;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            position: fixed;
            width: calc(100% - var(--sidebar-width));
            transition: all 0.3s ease;
            z-index: 100;
            height: var(--topbar-height);
            left: var(--sidebar-width);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            border-radius: 0 0 15px 15px;
        }
        
        .navbar-top.expanded {
            width: calc(100% - var(--sidebar-collapsed-width));
            left: var(--sidebar-collapsed-width);
        }
        
        /* User Profile */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e3e6f0;
            transition: all 0.3s;
        }
        
        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(78, 115, 223, 0.4);
            border-color: var(--primary-color);
        }
        
        /* Content Wrapper */
        .content-wrapper {
            padding-top: calc(var(--topbar-height) + 20px);
        }
        
        /* Dropdown Styling */
        .dropdown-menu {
            background-color: #f8f9fc;
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border-radius: 10px;
            overflow: hidden;
            animation: fadeInDown 0.3s ease;
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .dropdown-item {
            color: var(--text-color);
            padding: 0.5rem 1.5rem;
            transition: all 0.2s;
        }
        
        .dropdown-item:hover {
            background-color: rgba(78, 115, 223, 0.1);
            color: var(--primary-color);
            transform: translateX(5px);
        }
        
        /* Toggle Button */
        #sidebarToggle {
            background: none;
            border: none;
            color: var(--text-color);
            padding: 0.5rem;
            transition: all 0.2s;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        #sidebarToggle:hover {
            background-color: rgba(78, 115, 223, 0.1);
            color: var(--primary-color);
            transform: rotate(90deg);
        }
        
        /* Notification Pulse Animation */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
            }
        }
        
        .badge-pulse {
            animation: pulse 2s infinite;
        }
        
        /* Detail Page Styling */
        .detail-page-header {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .detail-page-header .breadcrumb {
            margin-bottom: 0.5rem;
        }
        
        .detail-page-header h1 {
            color: var(--text-color);
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }
        
        .detail-page-header .meta-info {
            color: #6c757d;
            font-size: 0.875rem;
        }
        
        .detail-page-content {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            padding: 1.5rem;
        }
        
        .detail-page-section {
            margin-bottom: 2rem;
        }
        
        .detail-page-section:last-child {
            margin-bottom: 0;
        }
        
        .detail-page-section h2 {
            color: var(--text-color);
            font-size: 1.25rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e3e6f0;
        }
        
        .detail-page-actions {
            margin-top: 1.5rem;
            display: flex;
            gap: 0.5rem;
        }
        
        .back-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: #e3e6f0;
            color: var(--text-color);
            border-radius: 0.25rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .back-button:hover {
            background-color: #d1d3e2;
            transform: translateX(-5px);
        }
    </style>
</head>
<body>
    <!-- Sidebar with improved scrolling -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="/asset/img/logo-12 (1).png" alt="Logo" class="logo-img">
            <div class="brand-text">
                <span class="fs-5 fw-bold">Tata Usaha</span>
                <div class="small text-light opacity-75">SMK AMALIAH 1&2</div>
            </div>
        </div>
        
        <!-- Scrollable sidebar content -->
        <div class="sidebar-content">
            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a href="{{url('/')}}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                        <div class="icon-wrapper"><i class='bx bx-grid-alt fs-5'></i></div>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('klapper')}}" class="nav-link {{ Request::is('klapper*') ? 'active' : '' }}">
                        <div class="icon-wrapper"><i class='bx bx-book fs-5'></i></div>
                        <span class="nav-text">Klapper</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('surat_masuk*') || Request::is('surat_keluar*') || Request::is('ijazah*') ? 'active' : '' }}" id="archiveToggle">
                        <div class="icon-wrapper"><i class='bx bx-folder fs-5'></i></div>
                        <span class="nav-text">Arsip</span>
                        <i class='bx bx-chevron-down ms-2 dropdown-icon'></i>
                    </a>
                    <ul class="nested-menu" id="archiveMenu">
                        <li>
                            <a href="{{url('surat_masuk')}}" class="nested-link {{ Request::is('surat_masuk*') ? 'active' : '' }}">
                                <i class='bx bx-envelope-open'></i>Surat Masuk
                            </a>
                        </li>
                        <li>
                            <a href="{{url('surat_keluar')}}" class="nested-link {{ Request::is('surat_keluar*') ? 'active' : '' }}">
                                <i class='bx bx-envelope'></i>Surat Keluar
                            </a>
                        </li>
                        <li>
                            <a href="{{url('ijazah')}}" class="nested-link {{ Request::is('ijazah*') ? 'active' : '' }}">
                                <i class='bx bx-file'></i>Ijazah
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        
        <!-- Logout Section - Now as a footer component -->
        <div class="sidebar-footer">
            <a href="#" class="nav-link text-danger logout-link">
                <div class="icon-wrapper"><i class='bx bx-log-out fs-5'></i></div>
                <span class="nav-text">Keluar</span>
            </a>
        </div>
    </div>

    <!-- Top Navbar -->
    <nav class="navbar-top" id="navbar-top">
        <div class="container-fluid p-0">
            <div class="d-flex justify-content-between align-items-center w-100">
                <!-- Sidebar Toggle Button -->
                <button id="sidebarToggle" class="btn">
                    <i class='bx bx-menu fs-4'></i>
                </button>

                <!-- Right Navbar Items -->
                <div class="d-flex align-items-center">
                    <!-- Notifications -->
                    <div class="dropdown mx-3">
                        <a class="btn btn-light position-relative rounded-circle p-2" href="#" role="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-bell fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger badge-pulse">
                                3
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown" style="width: 300px;">
                            <li><h6 class="dropdown-header">Notifikasi</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item py-2" href="#">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 bg-primary bg-opacity-10 rounded-circle text-primary">
                                            <i class="bx bx-envelope"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0 small">Surat masuk baru</p>
                                        <span class="text-muted x-small">15 menit yang lalu</span>
                                    </div>
                                </div>
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center small text-primary" href="#">Lihat Semua Notifikasi</a></li>
                        </ul>
                    </div>
                    
                    <!-- User Profile -->
                    <div class="dropdown">
                        <a class="d-flex align-items-center dropdown-toggle text-dark text-decoration-none" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="/asset/img/logo-12 (1).png" alt="Profile" class="user-avatar">
                            <div class="ms-2 d-none d-lg-block">
                                <div class="fw-bold">Admin</div>
                                <div class="small text-muted">Tata Usaha</div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bx bx-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bx bx-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="bx bx-log-out me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const navbarTop = document.getElementById('navbar-top');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const archiveToggle = document.getElementById('archiveToggle');
        const archiveMenu = document.getElementById('archiveMenu');

        // Toggle sidebar
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function () {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                navbarTop.classList.toggle('expanded');
            });
        }

        // Toggle archive dropdown
        if (archiveToggle) {
            archiveToggle.addEventListener('click', function (e) {
                e.preventDefault();
                archiveMenu.classList.toggle('show');
                const dropdownIcon = archiveToggle.querySelector('.dropdown-icon');
                dropdownIcon.classList.toggle('bx-chevron-down');
                dropdownIcon.classList.toggle('bx-chevron-up');
            });
        }

        // Auto-expand the archive menu if any of its child links are active
        const currentLocation = window.location.pathname;
        
        const isArchiveActive = 
            currentLocation.includes('surat_masuk') || 
            currentLocation.includes('surat_keluar') || 
            currentLocation.includes('ijazah');
            
        if (isArchiveActive && archiveMenu) {
            archiveMenu.classList.add('show');
            const dropdownIcon = archiveToggle.querySelector('.dropdown-icon');
            if (dropdownIcon) {
                dropdownIcon.classList.remove('bx-chevron-down');
                dropdownIcon.classList.add('bx-chevron-up');
            }
        }
        
        // Keep the dropdown open by default on page load
        if (archiveMenu && !isArchiveActive) {
            archiveMenu.classList.add('show');
            const dropdownIcon = archiveToggle.querySelector('.dropdown-icon');
            if (dropdownIcon) {
                dropdownIcon.classList.remove('bx-chevron-down');
                dropdownIcon.classList.add('bx-chevron-up');
            }
        }
    });
    </script>
</body>
</html>