@extends ('main')
 <link rel="stylesheet" href="/asset/css/dashboard2.css">
 <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section ('content')
<body>


<section class="home">

    <div>
        <img src="/asset/img/logo-12 (1).png" class="image">
    </div>

    <h1>SMK AMALIAH 1&2</h1>
    <p>"Sekolah Menengah Kejuruan Berkualitas yang Menyatu Dalam Tauhid"</p>

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
</section>

<script>
    let currentSlide = 1;
    const totalSlides = 9;

    function autoSlide() {
        document.getElementById('c' + currentSlide).checked = true;
        currentSlide = currentSlide < totalSlides ? currentSlide + 1 : 1;
    }

    setInterval(autoSlide, 2000); // Ganti 3000 untuk kecepatan, 3000ms = 3 detik
</script>

</body>
</html>
   
</body>
@endsection