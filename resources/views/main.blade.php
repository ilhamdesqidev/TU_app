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
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --text-color: #5a5c69;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --topbar-height: 70px;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
            overflow-x: hidden;
        }
        
        /* Improved Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 0 0.15rem 1.75rem rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            transition: all 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
            padding-bottom: 20px;
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
        }
        
        .logo-img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            flex-shrink: 0;
        }
        
        .brand-text {
            margin-left: 10px;
            white-space: nowrap;
            overflow: hidden;
        }
        
        /* Nav Items Styling */
        .nav-item {
            margin: 5px 0;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            border-radius: 0.35rem;
            margin: 0.25rem 1rem;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            transition: all 0.2s;
            white-space: nowrap;
        }
        
        .nav-link:hover, .nav-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .icon-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 24px;
            margin-right: 10px;
            flex-shrink: 0;
        }
        
        .nav-text {
            flex-grow: 1;
        }
        
        .dropdown-icon {
            transition: transform 0.3s;
        }
        
        /* Nested Menu Styling */
        .nested-menu {
            padding-left: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            margin: 0 1rem;
        }
        
        .nested-menu.show {
            max-height: 200px;
        }
        
        .nested-link {
            color: rgba(255, 255, 255, 0.7) !important;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            display: flex;
            align-items: center;
            transition: all 0.2s;
            border-radius: 0.35rem;
            text-decoration: none;
            margin: 0.25rem 0;
        }
        
        .nested-link:hover, .nested-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
            text-decoration: none;
        }
        
        .nested-link i {
            margin-right: 8px;
            font-size: 0.9rem;
        }

        /* Logout Section */
        .sidebar-divider {
            margin: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
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
            margin: 0.25rem 0.5rem;
        }
        
        .sidebar.collapsed .icon-wrapper {
            margin-right: 0;
        }
        
        .sidebar.collapsed .nested-menu {
            display: none;
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
        }
        
        .dropdown-item {
            color: var(--text-color);
            padding: 0.5rem 1.5rem;
            transition: all 0.2s;
        }
        
        .dropdown-item:hover {
            background-color: rgba(78, 115, 223, 0.1);
            color: var(--primary-color);
        }
        
        /* Toggle Button */
        #sidebarToggle {
            background: none;
            border: none;
            color: var(--text-color);
            padding: 0.5rem;
            transition: all 0.2s;
            border-radius: 0.35rem;
        }
        
        #sidebarToggle:hover {
            background-color: rgba(78, 115, 223, 0.1);
            color: var(--primary-color);
        }
        
        /* Scrollbars */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }
        
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="/asset/img/logo-12 (1).png" alt="Logo" class="logo-img">
            <div class="brand-text">
                <span class="fs-5 fw-bold">Tata Usaha</span>
                <div class="small text-light opacity-75">SMK AMALIAH 1&2</div>
            </div>
        </div>
        
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a href="{{url('/')}}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                    <div class="icon-wrapper"><i class='bx bx-grid-alt fs-5'></i></div>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('klapper')}}" class="nav-link {{ Request::is('klapper') ? 'active' : '' }}">
                    <div class="icon-wrapper"><i class='bx bx-book fs-5'></i></div>
                    <span class="nav-text">Klapper</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('spensasi')}}" class="nav-link {{ Request::is('spensasi') ? 'active' : '' }}">
                    <div class="icon-wrapper"><i class='bx bx-message-square-detail fs-5'></i></div>
                    <span class="nav-text">Spensasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" id="archiveToggle">
                    <div class="icon-wrapper"><i class='bx bx-folder fs-5'></i></div>
                    <span class="nav-text">Arsip</span>
                    <i class='bx bx-chevron-down ms-2 dropdown-icon'></i>
                </a>
                <div class="nested-menu" id="archiveMenu">
                    <a href="{{url('surat_masuk')}}" class="nested-link {{ Request::is('surat_masuk') ? 'active' : '' }}">
                        <i class='bx bx-envelope-open'></i>Surat Masuk
                    </a>
                    <a href="{{url('surat_keluar')}}" class="nested-link {{ Request::is('surat_keluar') ? 'active' : '' }}">
                        <i class='bx bx-envelope'></i>Surat Keluar
                    </a>
                    <a href="{{url('ijazah')}}" class="nested-link {{ Request::is('ijazah') ? 'active' : '' }}">
                        <i class='bx bx-file'></i>Ijazah
                    </a>
                </div>
            </li>
        </ul>
        
        <!-- Logout Section -->
        <div class="mt-auto" style="position: absolute; bottom: 20px; width: 100%;">
            <hr class="sidebar-divider">
            <a href="#" class="nav-link text-danger">
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
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
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

        // Set active class based on current page
        const currentLocation = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link');
        const nestedLinks = document.querySelectorAll('.nested-link');

        [...navLinks, ...nestedLinks].forEach(link => {
            const linkPath = link.getAttribute('href');
            if (linkPath && currentLocation.includes(linkPath)) {
                link.classList.add('active');
                if (link.classList.contains('nested-link')) {
                    archiveMenu.classList.add('show');
                    const dropdownIcon = archiveToggle.querySelector('.dropdown-icon');
                    dropdownIcon.classList.remove('bx-chevron-down');
                    dropdownIcon.classList.add('bx-chevron-up');
                }
            }
        });
        
        // Fix for logout button when sidebar is collapsed
        window.addEventListener('resize', adjustLogoutPosition);
        
        function adjustLogoutPosition() {
            const logoutSection = document.querySelector('.sidebar .mt-auto');
            if (sidebar.classList.contains('collapsed')) {
                logoutSection.style.position = 'static';
                logoutSection.style.bottom = 'auto';
            } else {
                logoutSection.style.position = 'absolute';
                logoutSection.style.bottom = '20px';
            }
        }
        
        // Run once on load
        adjustLogoutPosition();
    });
    </script>
</body>
</html>