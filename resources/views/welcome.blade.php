@extends ('main')
 <link rel="stylesheet" href="/asset/css/dashboard.css">
 <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section ('content')
<body>


<section class="home">
        <div class="text">Dashboard</div>

    <h1>SMK AMALIAH 1&2</h1>
<div class="cards-container">
    <div class="card">
        <div class="icon">
            <i class="fa fa-user-circle"></i>
        </div>
        <div class="content">
        <h1>{{ $jumlahSiswa }}</h1>
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
</section>

<script>
    jQuery(document).ready(function($) {
        let currentIndex = 0;
        const slides = $('.slider-img');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.removeClass('active');
            slides.eq(index).addClass('active');
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            showSlide(currentIndex);
        }

        // Menampilkan slide pertama
        showSlide(currentIndex);

        // Mengatur interval untuk pergerakan otomatis
        setInterval(nextSlide, 3000); // Ubah setiap 3 detik

        // Mengubah slide saat diklik
        slides.on('click', function() {
            currentIndex = $(this).index();
            showSlide(currentIndex);
        });
    });
</script>

</body>
</html>
   
</body>
@endsection