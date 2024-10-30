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
<body>
    <h1>hshsh</h1>
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

    

<script src="/asset/js/main.js"></script>

</body>
@yield('content')
</html>