<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css-->
    <link rel="stylesheet" href="/asset/css/main.css">

    <!-- Boxicons CSS -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Tata Usaha</title>
</head>
<!-- <body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="/asset/img/WhatsApp Image 2024-10-22 at 08.47.17.jpeg " alt="">
                </span>
                <div class="text header-text">
                    <span class="name">Smk Amaliah 1&2</span>
                    <span class="tu">Tata Usaha</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>
<div class="menu-bar">
        <div class="menu">
             <li class="nav-link">
                <a href="{{url('/')}}">
                <i class='bx bx-home icon'></i>
                <span class="text nav-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="{{url('klapper')}}">
                    <i class='bx bxs-book-open icon' ></i>
                <span class="text nav-text">Klapper</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="#">
                    <i class='bx bxs-time icon'></i>
                <span class="text nav-text">Coming Soon</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="#">
                    <i class='bx bxs-time icon'></i>
                <span class="text nav-text">Coming Soon</span>
                </a>
            </li>
        </div>

        <div class="bottom-content">
            <li class="">
                <a href="">
                    <i class='bx bxs-user-circle icon'></i>
                    <span class="text nav-text">Account</span>
                </a>
            </li>
        </div>
      
    </div>
    </nav>

    

<script src="/asset/js/main.js"></script> -->

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">BBBootstrap</span> </a>
                <div class="nav_list">
                    <a href="{{url('/')}}" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
                    <a href="{{url('klapper')}}" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span> </a> 
                    <a href="#" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Messages</span> </a> 
                    <a href="#" class="nav_link"> <i class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Bookmark</span> </a> 
                    <a href="#" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a> 
                    <a href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Stats</span> </a> </div>
            </div> <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
</body>
@yield('content')
</html>

<!-- link template sidebar : https://bbbootstrap.com/snippets/bootstrap-5-sidebar-menu-toggle-button-34132202 -->