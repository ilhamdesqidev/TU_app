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
    <div class="wrapper">
        <div class="container">
            <input type="radio" name="slide" id="c1" checked>
            <label for="c1" class="slider">
                <div class="row">
                    <div class="icon">1</div>
                    <div class="description">
                        <h4>TJKT</h4>
                    </div>
                </div>
            </label>
            <input type="radio" name="slide" id="c2" >
            <label for="c2" class="slider">
                <div class="row">
                    <div class="icon">2</div>
                    <div class="description">
                        <h4>ANIMASI</h4>
                    </div>
                </div>
            </label>
            <input type="radio" name="slide" id="c3" >
            <label for="c3" class="slider">
                <div class="row">
                    <div class="icon">3</div>
                    <div class="description">
                        <h4>PPLG</h4>
                    </div>
                </div>
            </label>
            <input type="radio" name="slide" id="c4" >
            <label for="c4" class="slider">
                <div class="row">
                    <div class="icon">4</div>
                    <div class="description">
                        <h4>DKV</h4>
                    </div>
                </div>
            </label>
            <input type="radio" name="slide" id="c5" >
            <label for="c5" class="slider">
                <div class="row">
                    <div class="icon">5</div>
                    <div class="description">
                        <h4>MP</h4>
                    </div>
                </div>
            </label>
            <input type="radio" name="slide" id="c6" >
            <label for="c6" class="slider">
                <div class="row">
                    <div class="icon">6</div>
                    <div class="description">
                        <h4>AKUNTANSI</h4>
                    </div>
                </div>
            </label>
            <input type="radio" name="slide" id="c7" >
            <label for="c7" class="slider">
                <div class="row">
                    <div class="icon">7</div>
                    <div class="description">
                        <h4>LPS</h4>
                    </div>
                </div>
            </label>
            <input type="radio" name="slide" id="c8" >
            <label for="c8" class="slider">
                <div class="row">
                    <div class="icon">8</div>
                    <div class="description">
                        <h4>TATA BUSANA</h4>
                    </div>
                </div>
            </label>
            <input type="radio" name="slide" id="c9" >
            <label for="c9" class="slider">
                <div class="row">
                    <div class="icon">9</div>
                    <div class="description">
                        <h4>BISNIS RETAIL</h4>
                    </div>
                </div>
            </label>
        </div>
    </div>
</section>
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