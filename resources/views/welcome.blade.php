@extends('main')

@section('content')
<div class="min-vh-100 bg-light">
    <!-- Elegant Header Section -->
    <section class="bg-white border-bottom">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="mb-4">
                        <img src="/asset/img/logo-12 (1).png" class="img-fluid mb-3" alt="SMK Amaliah Logo" width="100">
                    </div>
                    <h1 class="display-6 fw-light text-dark mb-3 lh-1">SMK AMALIAH 1&2</h1>
                    <p class="fs-6 text-muted mb-4 fw-normal" style="max-width: 600px; margin: 0 auto;">
                        Sekolah Menengah Kejuruan Berkualitas yang Menyatu Dalam Tauhid
                    </p>
                    <div class="border-top border-dark" style="width: 60px; margin: 0 auto; border-width: 2px !important;"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Professional Stats Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="h4 fw-normal text-dark mb-2">Statistik Sekolah</h2>
                    <p class="text-muted small">Data terkini tahun akademik</p>
                </div>
            </div>
            
            <div class="row g-4 justify-content-center">
                <!-- Students Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 bg-white h-100">
                        <div class="card-body p-4 text-center">
                            <div class="mb-3">
                                <div class="bg-primary bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="fa fa-users text-primary fs-5"></i>
                                </div>
                            </div>
                            <h3 class="display-6 fw-light text-dark mb-1">{{ $jumlahSiswa }}</h3>
                            <p class="text-uppercase small fw-semibold text-muted mb-2 tracking-wide">Siswa</p>
                            <div class="border-top pt-2">
                                <small class="text-muted">Total siswa aktif</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Teachers Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 bg-white h-100">
                        <div class="card-body p-4 text-center">
                            <div class="mb-3">
                                <div class="bg-success bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="fa fa-chalkboard-teacher text-success fs-5"></i>
                                </div>
                            </div>
                            <h3 class="display-6 fw-light text-dark mb-1">—</h3>
                            <p class="text-uppercase small fw-semibold text-muted mb-2 tracking-wide">Guru</p>
                            <div class="border-top pt-2">
                                <small class="text-muted">Tenaga pengajar</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Staff Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 bg-white h-100">
                        <div class="card-body p-4 text-center">
                            <div class="mb-3">
                                <div class="bg-warning bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="fa fa-user-tie text-warning fs-5"></i>
                                </div>
                            </div>
                            <h3 class="display-6 fw-light text-dark mb-1">—</h3>
                            <p class="text-uppercase small fw-semibold text-muted mb-2 tracking-wide">Staf</p>
                            <div class="border-top pt-2">
                                <small class="text-muted">Tenaga kependidikan</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Classes Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 bg-white h-100">
                        <div class="card-body p-4 text-center">
                            <div class="mb-3">
                                <div class="bg-info bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="fa fa-graduation-cap text-info fs-5"></i>
                                </div>
                            </div>
                            <h3 class="display-6 fw-light text-dark mb-1">{{ $jumlahAngkatan }}</h3>
                            <p class="text-uppercase small fw-semibold text-muted mb-2 tracking-wide">Angkatan</p>
                            <div class="border-top pt-2">
                                <small class="text-muted">Tahun angkatan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sophisticated Navigation -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="text-center mb-4">
                        <h3 class="h4 fw-normal text-dark mb-2">Menu Utama</h3>
                        <p class="text-muted small">Akses cepat ke berbagai layanan</p>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="btn btn-outline-dark w-100 py-3 border-2 text-decoration-none d-flex flex-column align-items-center">
                                <i class="fa fa-home mb-2"></i>
                                <span class="fw-normal">Beranda</span>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="btn btn-outline-dark w-100 py-3 border-2 text-decoration-none d-flex flex-column align-items-center">
                                <i class="fa fa-info-circle mb-2"></i>
                                <span class="fw-normal">Tentang</span>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="btn btn-outline-dark w-100 py-3 border-2 text-decoration-none d-flex flex-column align-items-center">
                                <i class="fa fa-book mb-2"></i>
                                <span class="fw-normal">Program</span>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="btn btn-outline-dark w-100 py-3 border-2 text-decoration-none d-flex flex-column align-items-center">
                                <i class="fa fa-phone mb-2"></i>
                                <span class="fw-normal">Kontak</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Clean Footer -->
    <footer class="py-4 border-top bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-muted small mb-0">© 2024 SMK Amaliah 1&2. Pendidikan berkualitas berbasis nilai-nilai Islami.</p>
                </div>
            </div>
        </div>
    </footer>
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