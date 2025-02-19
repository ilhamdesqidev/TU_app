@extends('main')

@section('content')
<body>

<section class="container text-center mt-5">

    <div>
        <img src="/asset/img/logo-12 (1).png" class="img-fluid" style="max-width: 150px;">
    </div>

    <h1 class="mt-3">SMK AMALIAH 1&2</h1>
    <p class="lead">"Sekolah Menengah Kejuruan Berkualitas yang Menyatu Dalam Tauhid"</p>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="fa fa-user-circle fa-3x mb-3"></i>
                    <h1>{{ $jumlahSiswa }}</h1>
                    <p class="text-muted">Siswa</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="fa fa-user-circle fa-3x mb-3"></i>
                    <h1>108</h1>
                    <p class="text-muted">Guru</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="fa fa-user-circle fa-3x mb-3"></i>
                    <h1>107</h1>
                    <p class="text-muted">Staf</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="fa fa-user-circle fa-3x mb-3"></i>
                    <h1>{{ $jumlahAngkatan }}</h1>
                    <p class="text-muted">Angkatan</p>
                </div>
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

    setInterval(autoSlide, 2000);
</script>

</body>
@endsection
