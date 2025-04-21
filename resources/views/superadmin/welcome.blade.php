@extends('main')

@section('content')
<div class="container py-5">
    <!-- Minimalist Header Section -->
    <div class="text-center mb-5">
        <div class="bg-light py-4 rounded-4 mb-4">
            <img src="/asset/img/logo-12 (1).png" class="img-fluid" alt="SMK Amaliah Logo" width="195">
        </div>
        <h1 class="display-5 fw-bold text-dark mb-2">SMK AMALIAH 1&2</h1>
        <p class="lead text-secondary">"Sekolah Menengah Kejuruan Berkualitas yang Menyatu Dalam Tauhid"</p>
        <div class="border-bottom border-2 w-25 mx-auto mt-3"></div>
    </div>

    <!-- Clean Stats Cards with Icons -->
    <div class="row g-4 justify-content-center">
        <!-- Students Card -->
        <div class="col-6 col-md-3">
            <div class="card border-0 bg-white rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle mx-auto mb-3" style="width: 70px; height: 70px;">
                        <i class="fa fa-user-graduate fa-2x text-primary"></i>
                    </div>
                    <h2 class="display-6 fw-bold">{{ $jumlahSiswa }}</h2>
                    <p class="text-uppercase small fw-bold text-secondary mb-0">Siswa</p>
                </div>
            </div>
        </div>

        <!-- Teachers Card -->
        <div class="col-6 col-md-3">
            <div class="card border-0 bg-white rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle mx-auto mb-3" style="width: 70px; height: 70px;">
                        <i class="fa fa-chalkboard-teacher fa-2x text-success"></i>
                    </div>
                    <h2 class="display-6 fw-bold">108</h2>
                    <p class="text-uppercase small fw-bold text-secondary mb-0">Guru</p>
                </div>
            </div>
        </div>

        <!-- Staff Card -->
        <div class="col-6 col-md-3">
            <div class="card border-0 bg-white rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle mx-auto mb-3" style="width: 70px; height: 70px;">
                        <i class="fa fa-users fa-2x text-warning"></i>
                    </div>
                    <h2 class="display-6 fw-bold">107</h2>
                    <p class="text-uppercase small fw-bold text-secondary mb-0">Staf</p>
                </div>
            </div>
        </div>

        <!-- Classes Card -->
        <div class="col-6 col-md-3">
            <div class="card border-0 bg-white rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="bg-info bg-opacity-10 p-3 rounded-circle mx-auto mb-3" style="width: 70px; height: 70px;">
                        <i class="fa fa-graduation-cap fa-2x text-info"></i>
                    </div>
                    <h2 class="display-6 fw-bold">{{ $jumlahAngkatan }}</h2>
                    <p class="text-uppercase small fw-bold text-secondary mb-0">Angkatan</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Simple Navigation Menu -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="d-flex justify-content-center flex-wrap gap-2">
                <a href="#" class="btn btn-outline-dark rounded-pill px-4 py-2">
                    <i class="fa fa-home me-2"></i>Beranda
                </a>
                <a href="#" class="btn btn-outline-dark rounded-pill px-4 py-2">
                    <i class="fa fa-info-circle me-2"></i>Tentang
                </a>
                <a href="#" class="btn btn-outline-dark rounded-pill px-4 py-2">
                    <i class="fa fa-book me-2"></i>Program
                </a>
                <a href="#" class="btn btn-outline-dark rounded-pill px-4 py-2">
                    <i class="fa fa-phone me-2"></i>Kontak
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    let currentSlide = 1;
    const totalSlides = 9;

    function autoSlide() {
        document.getElementById('c' + currentSlide).checked = true;
        currentSlide = currentSlide < totalSlides ? currentSlide + 1 : 1;
    }

    setInterval(autoSlide, 2000);
</script>
@endsection