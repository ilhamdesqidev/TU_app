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
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
            overflow-x: hidden;
        }
        
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 0 0.15rem 1.75rem rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            transition: all 0.3s;
            z-index: 1000;
            overflow-y: auto;
        }
        
        .sidebar.collapsed {
            width: 70px;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
            padding: 20px;
        }
        
        .main-content.expanded {
            margin-left: 70px;
        }
        
        .sidebar-brand {
            height: 80px;
            padding: 1.5rem 1rem;
            display: flex;
            align-items: center;
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            border-radius: 0.35rem;
            margin: 0.5rem 0.8rem;
            transition: all 0.2s;
            position: relative;
        }
        
        .nav-link:hover, .nav-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .navbar-top {
            background-color: white;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            position: fixed;
            width: calc(100% - var(--sidebar-width));
            transition: all 0.3s;
            z-index: 100;
            height: 70px;
            left: var(--sidebar-width);
        }
        
        .navbar-top.expanded {
            width: calc(100% - 70px);
            left: 70px;
        }
        
        .dropdown-menu {
            margin-top: 0;
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
        
        .icon-wrapper {
            width: 40px;
            display: inline-block;
            text-align: center;
        }
        
        .content-wrapper {
            padding-top: 90px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e3e6f0;
        }
        
        /* Hide text when sidebar is collapsed */
        .sidebar.collapsed .nav-text, 
        .sidebar.collapsed .brand-text,
        .sidebar.collapsed .dropdown-icon,
        .sidebar.collapsed .logout-text {
            display: none;
        }
        
        /* Center icons when sidebar is collapsed */
        .sidebar.collapsed .nav-link {
            display: flex;
            justify-content: center;
            padding: 0.8rem 0;
        }
        
        .sidebar.collapsed .sidebar-brand {
            justify-content: center;
        }
        
        /* Dropdown menu for archives */
        .nested-menu {
            padding-left: 3rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            margin-left: 0.8rem;
            margin-right: 0.8rem;
        }
        
        .nested-menu.show {
            max-height: 200px;
        }
        
        .nested-link {
            color: rgba(255, 255, 255, 0.7) !important;
            padding: 0.5rem 1rem;
            display: block;
            transition: all 0.2s;
            border-radius: 0.35rem;
        }
        
        .nested-link:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        /* Sidebar Logo */
        .logo-img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            transition: all 0.3s;
        }
        
        .sidebar.collapsed .logo-img {
            margin: 0;
        }

        /* Untuk menyelaraskan icon sidebar saat collapsed */
        .sidebar.collapsed .nav-link .icon-wrapper {
            width: 100%;
            justify-content: center;
        }

        /* Pastikan padding tidak hilang di navbar saat sidebar collapsed */
        .navbar-top {
            padding: 0 1rem;
            display: flex;
            align-items: center;
        }

        /* Atur transisi agar mulus saat sidebar berubah */
        .navbar-top, .main-content {
            transition: all 0.3s ease-in-out;
        }

        /* Rapiin toggle sidebar button */
        #sidebarToggle {
            border: none;
            background: none;
            outline: none;
        }

        /* Sidebar yang collapsed agar ikon center */
        .sidebar.collapsed .icon-wrapper {
            margin: 0 auto;
            display: block;
            text-align: center;
        }

        .sidebar.collapsed .nav-link {
            padding-left: 0;
            padding-right: 0;
        }

        /* Navbar kanan tetap tampil rapi saat collapse */
        .navbar-top .d-flex.align-items-center {
            gap: 1rem;
        }

    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="/asset/img/logo-12 (1).png" alt="Logo" class="logo-img me-2">
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
                    <i class='bx bx-chevron-down ms-auto dropdown-icon'></i>
                </a>
                <div class="nested-menu" id="archiveMenu">
                    <a href="{{url('surat_masuk')}}" class="nested-link">
                        <i class='bx bx-envelope-open me-2'></i>Surat Masuk
                    </a>
                    <a href="{{url('surat_keluar')}}" class="nested-link">
                        <i class='bx bx-envelope me-2'></i>Surat Keluar
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <div class="icon-wrapper"><i class='bx bx-folder fs-5'></i></div>
                    <span class="nav-text">Files</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <div class="icon-wrapper"><i class='bx bx-bar-chart-alt-2 fs-5'></i></div>
                    <span class="nav-text">Stats</span>
                </a>
            </li>
            <li class="nav-item mt-auto">
                <hr class="sidebar-divider d-none d-md-block opacity-25 my-3">
                <a href="#" class="nav-link text-danger">
                    <div class="icon-wrapper"><i class='bx bx-log-out fs-5'></i></div>
                    <span class="nav-text logout-text">Keluar</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Top Navbar -->
    <nav class="navbar-top" id="navbar-top">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center h-100">
                <!-- Toggle Button -->
                <button class="btn btn-link text-dark" id="sidebarToggle">
                    <i class='bx bx-menu fs-4'></i>
                </button>
                
                <!-- Right Navbar Items -->
                <div class="d-flex align-items-center">
                    <!-- Notifications -->
                    <div class="dropdown mx-2">
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
           sidebarToggle.addEventListener('click', function () {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('expanded');
    navbarTop.classList.toggle('expanded');

    // Untuk menyesuaikan ukuran dropdown jika ada
    const dropdowns = document.querySelectorAll('.dropdown-menu');
    dropdowns.forEach(dropdown => {
        dropdown.style.right = sidebar.classList.contains('collapsed') ? '10px' : '';
    });
            
            // Toggle archive dropdown
            archiveToggle.addEventListener('click', function(e) {
                e.preventDefault();
                archiveMenu.classList.toggle('show');
                const dropdownIcon = archiveToggle.querySelector('.dropdown-icon');
                dropdownIcon.classList.toggle('bx-chevron-down');
                dropdownIcon.classList.toggle('bx-chevron-up');
            });
            
            // Set active class based on current page
            const currentLocation = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            const nestedLinks = document.querySelectorAll('.nested-link');
            
            [...navLinks, ...nestedLinks].forEach(link => {
                const linkPath = link.getAttribute('href');
                if (linkPath && currentLocation.includes(linkPath.replace('{{url(', '').replace(')', ''))) {
                    link.classList.add('active');
                    // If it's a nested link, show its parent menu
                    if (link.classList.contains('nested-link')) {
                        archiveMenu.classList.add('show');
                    }
                }
            });
        });
    </script>
</body>
</html>