@extends('main')
@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body bg-primary text-white text-center py-4">
                    <h1 class="h2 fw-bold mb-2">
                        <i class="fas fa-user-graduate me-2"></i>Profil Siswa
                    </h1>
                    <p class="mb-0">Sistem Informasi Manajemen Siswa</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Sidebar Profile -->
        <div class="col-lg-4">
            <div class="card border-0 shadow h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-4">
                        @if ($siswa->foto)
                            <img src="{{ asset('image/' . $siswa->foto) }}" alt="Foto {{ $siswa->nama_siswa }}" 
                                class="img-fluid rounded-circle border border-4 border-primary shadow" 
                                style="width: 180px; height: 180px; object-fit: cover;">
                        @else
                            <img src="{{ asset('image/default.jpg') }}" alt="Foto Default" 
                                class="img-fluid rounded-circle border border-4 border-primary shadow" 
                                style="width: 180px; height: 180px; object-fit: cover;">
                        @endif
                    </div>
                    
                    <h3 class="fw-bold text-dark mb-2">{{ $siswa->nama_siswa }}</h3>
                    <p class="text-muted h5 mb-4">Siswa {{ $siswa->kelas }} {{ $siswa->jurusan }}</p>
                    
                    <div class="row g-2 mb-4">
                        <div class="col-12">
                            <span class="badge bg-primary fs-6 py-2 px-3 w-100">
                                <i class="fas fa-id-card me-2"></i>NIS: {{ $siswa->nis }}
                            </span>
                        </div>
                        <div class="col-12">
                            <span class="badge bg-success fs-6 py-2 px-3 w-100">
                                <i class="fas fa-id-badge me-2"></i>NISN: {{ $siswa->nisn }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-grid gap-2">
                        @if ($siswa->status == 2)
                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-edit me-2"></i>Edit Data
                            </a>
                        @endif
                        
                        <a href="{{ route('klapper.show', $siswa->klapper_id) }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card border-0 shadow h-100">
                <div class="card-header bg-light border-0 py-3">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item me-2" role="presentation">
                            <button class="nav-link active fw-bold text-white bg-primary border-0 px-2 py-1 rounded small" 
                                    id="pills-personal-tab" data-bs-toggle="pill" 
                                    data-bs-target="#pills-personal" type="button" role="tab">
                                <i class="fas fa-user me-1"></i>Data Pribadi
                            </button>
                        </li>
                        <li class="nav-item me-2" role="presentation">
                            <button class="nav-link fw-bold text-dark bg-light border border-primary px-2 py-1 rounded small" 
                                    id="pills-academic-tab" data-bs-toggle="pill" 
                                    data-bs-target="#pills-academic" type="button" role="tab">
                                <i class="fas fa-graduation-cap me-1"></i>Data Akademik
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold text-dark bg-light border border-primary px-2 py-1 rounded small" 
                                    id="pills-family-tab" data-bs-toggle="pill" 
                                    data-bs-target="#pills-family" type="button" role="tab">
                                <i class="fas fa-users me-1"></i>Data Keluarga
                            </button>
                        </li>
                    </ul>

                    <style>
                        .nav-pills .nav-link.active, 
                        .nav-pills .show > .nav-link {
                            color: #fff !important;
                            background-color: #0d6efd !important;
                        }
                        
                        .nav-pills .nav-link:not(.active) {
                            color: #212529 !important;
                            background-color: #f8f9fa !important;
                        }
                        
                        .nav-pills .nav-link:not(.active):hover {
                            background-color: #e9ecef !important;
                        }
                    </style>
                </div>

                <div class="card-body p-3">
                    <div class="tab-content" id="pills-tabContent">
                        <!-- Data Pribadi -->
                        <div class="tab-pane fade show active" id="pills-personal" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-borderless table-sm">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold text-dark py-1" style="width: 35%; font-size: 0.85rem;">
                                                <i class="fas fa-user text-primary me-2" style="font-size: 0.75rem;"></i>Nama Lengkap
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ $siswa->nama_siswa }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="fw-bold text-dark py-1" style="font-size: 0.85rem;">
                                                <i class="fas fa-id-card text-primary me-2" style="font-size: 0.75rem;"></i>NIS
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ $siswa->nis }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="fw-bold text-dark py-1" style="font-size: 0.85rem;">
                                                <i class="fas fa-id-badge text-primary me-2" style="font-size: 0.75rem;"></i>NISN
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ $siswa->nisn }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="fw-bold text-dark py-1" style="font-size: 0.85rem;">
                                                <i class="fas fa-map-marker-alt text-danger me-2" style="font-size: 0.75rem;"></i>Tempat Lahir
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ $siswa->tempat_lahir }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="fw-bold text-dark py-1" style="font-size: 0.85rem;">
                                                <i class="fas fa-calendar-day text-info me-2" style="font-size: 0.75rem;"></i>Tanggal Lahir
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM YYYY') }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="fw-bold text-dark py-1" style="font-size: 0.85rem;">
                                                <i class="fas fa-venus-mars text-success me-2" style="font-size: 0.75rem;"></i>Jenis Kelamin
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ $siswa->gender }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Data Akademik -->
                        <div class="tab-pane fade" id="pills-academic" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-borderless table-sm">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold text-dark py-1" style="width: 35%; font-size: 0.85rem;">
                                                <i class="fas fa-chalkboard text-success me-2" style="font-size: 0.75rem;"></i>Kelas
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ $siswa->kelas }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="fw-bold text-dark py-1" style="font-size: 0.85rem;">
                                                <i class="fas fa-microscope text-success me-2" style="font-size: 0.75rem;"></i>Jurusan
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ $siswa->jurusan }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="fw-bold text-dark py-1" style="font-size: 0.85rem;">
                                                <i class="fas fa-door-open text-primary me-2" style="font-size: 0.75rem;"></i>Tanggal Masuk
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ \Carbon\Carbon::parse($siswa->tanggal_masuk)->isoFormat('D MMMM YYYY') }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="fw-bold text-dark py-1" style="font-size: 0.85rem;">
                                                <i class="fas fa-level-up-alt text-info me-2" style="font-size: 0.75rem;"></i>Naik Kelas XI
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ $siswa->tanggal_naik_kelas_xi ? \Carbon\Carbon::parse($siswa->tanggal_naik_kelas_xi)->isoFormat('D MMMM YYYY') : 'Belum Tersedia' }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="fw-bold text-dark py-1" style="font-size: 0.85rem;">
                                                <i class="fas fa-level-up-alt text-warning me-2" style="font-size: 0.75rem;"></i>Naik Kelas XII
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ $siswa->tanggal_naik_kelas_xii ? \Carbon\Carbon::parse($siswa->tanggal_naik_kelas_xii)->isoFormat('D MMMM YYYY') : 'Belum Tersedia' }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="fw-bold text-dark py-1" style="font-size: 0.85rem;">
                                                <i class="fas fa-medal text-success me-2" style="font-size: 0.75rem;"></i>Tanggal Lulus
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ $siswa->tanggal_lulus ? \Carbon\Carbon::parse($siswa->tanggal_lulus)->isoFormat('D MMMM YYYY') : 'Belum Lulus' }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="fw-bold text-dark py-1" style="font-size: 0.85rem;">
                                                <i class="fas fa-door-closed text-danger me-2" style="font-size: 0.75rem;"></i>Tanggal Keluar
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ $siswa->tanggal_keluar ? \Carbon\Carbon::parse($siswa->tanggal_keluar)->isoFormat('D MMMM YYYY') : 'Masih Aktif' }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="fw-bold text-dark py-1" style="font-size: 0.85rem;">
                                                <i class="fas fa-comment-dots text-danger me-2" style="font-size: 0.75rem;"></i>Alasan Keluar
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">
                                                    @if($siswa->tanggal_keluar && $siswa->alasan_keluar)
                                                        {{ $siswa->alasan_keluar }}
                                                    @elseif($siswa->tanggal_keluar && !$siswa->alasan_keluar)
                                                        Tidak ada alasan yang dicatat
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            @if($siswa->kelas != 'X' && $siswa->alasan_masuk)
                            <div class="alert alert-info border-0 shadow-sm mt-3" style="padding: 0.5rem 0.75rem;">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-info-circle text-info" style="font-size: 0.9rem;"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.8rem;">Alasan Masuk di Kelas {{ $siswa->kelas }}</h6>
                                        <p class="mb-0 text-dark" style="font-size: 0.75rem;">{{ $siswa->alasan_masuk }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Data Keluarga -->
                        <div class="tab-pane fade" id="pills-family" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-borderless table-sm">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold text-dark py-1" style="width: 35%; font-size: 0.85rem;">
                                                <i class="fas fa-female text-info me-2" style="font-size: 0.75rem;"></i>Nama Ibu
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ $siswa->nama_ibu }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="fw-bold text-dark py-1" style="font-size: 0.85rem;">
                                                <i class="fas fa-male text-primary me-2" style="font-size: 0.75rem;"></i>Nama Ayah
                                            </td>
                                            <td class="py-1" style="font-size: 0.85rem;">
                                                <span class="fw-medium text-dark">{{ $siswa->nama_ayah }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="card-footer bg-light border-0 text-center py-2">
                    <small class="text-muted fw-medium" style="font-size: 0.7rem;">
                        <i class="fas fa-clock me-1"></i> 
                        Terakhir diperbarui: {{ now()->isoFormat('D MMMM YYYY [pukul] HH:mm [WIB]') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection