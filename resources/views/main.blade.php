<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css-->
    <link rel="stylesheet" href="/asset/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Tata Usaha</title>
    <style>
        a {
            text-decoration: none !important;
        }
    </style>
</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="/asset/img/logo-12 (1).png" alt=""> </div>
    </header>
    <div class="l-navbar show" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="#" class="nav_logo">
                <div class="header_toggle">
                    <img src="/asset/img/logo-12 (1).png" alt="Menu Icon" id="header-toggle">
                </div>
                     <span class="nav_logo-name">Tata Usaha
                     <small class="nav_logo-subtitle">SMK AMALIAH 1&2</small>
                     </span> </a>
                <div class="nav_list">
                    <a href="{{url('/')}}" class="nav_link {{ Request::is('/') ? 'active' : '' }}"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
                    <a href="{{url('klapper')}}" class="nav_link {{ Request::is('klapper') ? 'active' : '' }}"> <i class='bx bx-book nav_icon'></i> <span class="nav_name">Klapper</span> </a> 
                    <a href="{{url('spensasi')}}" class="nav_link {{ Request::is('spensasi') ? 'active' : '' }}"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Spensasi</span> </a> 
                    <a href="#" class="nav_link" id="bookmarkDropdown">
                        <i class='bx bx-folder nav_icon'></i>
                        <span class="nav_name">Arsip
                        <i class='bx bx-chevron-down nav_icon' id="dropdownIcon"></i>
                        </span>
                    </a>
                    <div id="dropdownMenu" class="dropdown-menu">
                        <a href="{{url('surat_masuk')}}" class="dropdown-item">Surat Masuk</a>
                        <a href="{{url('surat_keluar')}}" class="dropdown-item">Surat Keluar</a>
                    </div>

                    <a href="#" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a> 
                    <a href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Stats</span> </a> 
                </div>
            </div> 
            <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <script src="/asset/js/main.js"></script>
</body>
@yield('content')
</html>
