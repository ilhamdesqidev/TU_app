@extends ('main')
 <link rel="stylesheet" href="/asset/css/dashboard.css">
 <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@section ('content')
<body>


<section class="home">
        <div class="text">Dashboard</div>
    </section>

    <h1>SMK AMALIAH 1&2</h1>
<div class="cards-container">
    <div class="card">
        <div class="icon">
            <i class="fa fa-user-circle"></i>
        </div>
        <div class="content">
            <h1>1389</h1>
            <p>Siswa</p>
        </div>
    </div>
    
    <div class="card">
        <div class="icon">
            <i class="fa fa-user-circle"></i>
        </div>
        <div class="content">
            <h1>108</h1>
            <p>Guru</p>
        </div>
    </div>
    
    <div class="card">
        <div class="icon">
            <i class="fa fa-user-circle"></i>
        </div>
        <div class="content">
            <h1>107</h1>
            <p>Staf</p>
        </div>
    </div>
    <div class="card">
        <div class="icon">
            <i class="fa fa-user-circle"></i>
        </div>
        <div class="content">
            <h1>17</h1>
            <p>Angkatan</p>
        </div>
    </div>
</div>

<section class="slider-container">
    <div class="slider-image">
        <div class="slider-img">
        <img src="/asset/img/WhatsApp Image 2024-10-22 at 08.47.17.jpeg" alt="1">
        <h1>Jurusan</h1>
        <div class="detail">
            <h2>Jurusan</h2>
            <p>PPLG</p>
            </div>
        </div>
        <div class="slider-img">
        <img src="/asset/img/WhatsApp Image 2024-10-22 at 08.47.17.jpeg" alt="2">
        <h1>Jurusan</h1>
        <div class="detail">
            <h2>Jurusan</h2>
            <p>PPLG</p>
            </div>
        </div>
        <div class="slider-img">
        <img src="/asset/img/WhatsApp Image 2024-10-22 at 08.47.17.jpeg" alt="3">
        <h1>Jurusan</h1>
        <div class="detail">
            <h2>Jurusan</h2>
            <p>PPLG</p>
            </div>
        </div>
        <div class="slider-img">
        <img src="/asset/img/WhatsApp Image 2024-10-22 at 08.47.17.jpeg" alt="4">
        <h1>Jurusan</h1>
        <div class="detail">
            <h2>Jurusan</h2>
            <p>PPLG</p>
            </div>
        </div>
        <div class="slider-img active">
        <img src="/asset/img/WhatsApp Image 2024-10-22 at 08.47.17.jpeg" alt="5">
        <h1>Jurusan</h1>
        <div class="detail">
            <h2>Jurusan</h2>
            <p>PPLG</p>
            </div>
        </div>
        <div class="slider-img">
        <img src="/asset/img/WhatsApp Image 2024-10-22 at 08.47.17.jpeg" alt="6">
        <h1>Jurusan</h1>
        <div class="detail">
            <h2>Jurusan</h2>
            <p>PPLG</p>
            </div>
        </div>
        <div class="slider-img">
        <img src="/asset/img/WhatsApp Image 2024-10-22 at 08.47.17.jpeg" alt="7">
        <h1>Jurusan</h1>
        <div class="detail">
            <h2>Jurusan</h2>
            <p>PPLG</p>
            </div>
        </div>
        <div class="slider-img">
        <img src="/asset/img/WhatsApp Image 2024-10-22 at 08.47.17.jpeg" alt="8">
        <h1>Jurusan</h1>
        <div class="detail">
            <h2>Jurusan</h2>
            <p>PPLG</p>
            </div>
        </div>
        <div class="slider-img">
        <img src="/asset/img/WhatsApp Image 2024-10-22 at 08.47.17.jpeg" alt="9">
        <h1>Jurusan</h1>
        <div class="detail">
            <h2>Jurusan</h2>
            <p>PPLG</p>
            </div>
        </div>
    </div>

</section>


<script>
    jQuery(document).ready(function($){

        $('.slider-img').on('click', function(){
            $('.slider-img').removeClass('active');
            $(this).addClass('active');
        })

    });
</script>
</body>
</html>
   
</body>
@endsection