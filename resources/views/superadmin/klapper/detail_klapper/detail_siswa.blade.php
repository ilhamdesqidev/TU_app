@extends('main')
@section('content')
<!-- Import CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="container py-5">
    <style>
        .tab-button {
            transition: all 0.3s ease;
        }
        .tab-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
        }
        .nav-link.active {
            box-shadow: 0 4px 8px rgba(0,0,0,0.2) !important;
        }
    </style>
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
                <div class="card-body p-0">
                    <div class="bg-primary bg-gradient text-white p-4 text-center">
                        <h2 class="fw-bold mb-1"><i class="fas fa-user-graduate me-2"></i>Profil Siswa</h2>
                        <p class="mb-0 opacity-75">Detail informasi lengkap siswa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Sidebar dengan foto dan identitas utama -->
        <div class="col-lg-4">
            <div class="card border-0 rounded-4 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-4">
                        @if ($siswa->foto)
                            <img src="{{ asset('image/' . $siswa->foto) }}" alt="Foto {{ $siswa->nama_siswa }}" 
                                class="img-fluid rounded-circle border border-3 border-primary p-1 shadow-sm" style="width: 180px; height: 180px; object-fit: cover;">
                        @else
                            <img src="{{ asset('image/default.jpg') }}" alt="Foto Default" 
                                class="img-fluid rounded-circle border border-3 border-primary p-1 shadow-sm" style="width: 180px; height: 180px; object-fit: cover;">
                        @endif
                    </div>
                    
                    <h3 class="fw-bold text-primary mb-1">{{ $siswa->nama_siswa }}</h3>
                    <p class="text-muted mb-3">Siswa {{ $siswa->kelas }} {{ $siswa->jurusan }}</p>
                    
                    <div class="d-flex justify-content-center mb-4">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 me-2 rounded-pill">
                            <i class="fas fa-id-card me-1"></i> NIS: {{ $siswa->nis }}
                        </span>
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                            <i class="fas fa-id-badge me-1"></i> NISN: {{ $siswa->nisn }}
                        </span>
                    </div>
                    
                    <!-- Tombol aksi -->
                    <div class="d-grid gap-2 mt-4">
                        @if ($siswa->status != 1 && $siswa->status != 2)
                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-primary rounded-pill">
                                <i class="fas fa-edit me-2"></i>Edit Data
                            </a>
                        @endif
                        
                        <a href="{{ route('klapper.siswa', $siswa->klapper_id) }}" class="btn btn-outline-primary rounded-pill">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main content dengan tabs -->
        <div class="col-lg-8">
            <div class="card border-0 rounded-4 shadow-sm h-100">
                <div class="card-body p-4">
                    <!-- Nav Tabs yang lebih modern -->
                    <ul class="nav nav-tabs nav-fill bg-light rounded-3 p-2 mb-4 shadow-sm" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tab-button active fw-medium bg-primary text-white border-0 mx-1 rounded-pill" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="true">
                                <i class="fas fa-user me-2"></i>Data Pribadi
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tab-button fw-medium text-dark bg-light shadow-sm border-0 mx-1 rounded-pill" id="academic-tab" data-bs-toggle="tab" data-bs-target="#academic" type="button" role="tab" aria-controls="academic" aria-selected="false">
                                <i class="fas fa-book me-2"></i>Data Akademik
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tab-button fw-medium text-dark bg-light shadow-sm border-0 mx-1 rounded-pill" id="family-tab" data-bs-toggle="tab" data-bs-target="#family" type="button" role="tab" aria-controls="family" aria-selected="false">
                                <i class="fas fa-users me-2"></i>Data Keluarga
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content p-2" id="myTabContent">
                        <!-- Data Pribadi -->
                        <div class="tab-pane fade show active bg-opacity-5 p-3 rounded-3" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td width="40%" class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </span>
                                                    <span class="fw-medium">Nama Lengkap</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ $siswa->nama_siswa }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-id-card text-primary"></i>
                                                    </span>
                                                    <span class="fw-medium">NIS</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ $siswa->nis }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-id-badge text-primary"></i>
                                                    </span>
                                                    <span class="fw-medium">NISN</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ $siswa->nisn }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                                    </span>
                                                    <span class="fw-medium">Tempat Lahir</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ $siswa->tempat_lahir }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-calendar-day text-primary"></i>
                                                    </span>
                                                    <span class="fw-medium">Tanggal Lahir</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM YYYY') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-venus-mars text-primary"></i>
                                                    </span>
                                                    <span class="fw-medium">Jenis Kelamin</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ $siswa->gender }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Data Akademik -->
                        <div class="tab-pane fade bg-opacity-5 p-3 rounded-3" id="academic" role="tabpanel" aria-labelledby="academic-tab">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td width="40%" class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-chalkboard text-success"></i>
                                                    </span>
                                                    <span class="fw-medium">Kelas</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ $siswa->kelas }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-microscope text-success"></i>
                                                    </span>
                                                    <span class="fw-medium">Jurusan</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ $siswa->jurusan }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-door-open text-success"></i>
                                                    </span>
                                                    <span class="fw-medium">Tanggal Masuk</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ \Carbon\Carbon::parse($siswa->tanggal_masuk)->isoFormat('D MMMM YYYY') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-level-up-alt text-success"></i>
                                                    </span>
                                                    <span class="fw-medium">Naik Kelas XI</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ $siswa->tanggal_naik_kelas_xi ? \Carbon\Carbon::parse($siswa->tanggal_naik_kelas_xi)->isoFormat('D MMMM YYYY') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-level-up-alt text-success"></i>
                                                    </span>
                                                    <span class="fw-medium">Naik Kelas XII</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ $siswa->tanggal_naik_kelas_xii ? \Carbon\Carbon::parse($siswa->tanggal_naik_kelas_xii)->isoFormat('D MMMM YYYY') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-medal text-success"></i>
                                                    </span>
                                                    <span class="fw-medium">Tanggal Lulus</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ $siswa->tanggal_lulus ? \Carbon\Carbon::parse($siswa->tanggal_lulus)->isoFormat('D MMMM YYYY') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-door-closed text-success"></i>
                                                    </span>
                                                    <span class="fw-medium">Tanggal Keluar</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ $siswa->tanggal_keluar ? \Carbon\Carbon::parse($siswa->tanggal_keluar)->isoFormat('D MMMM YYYY') : '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Data Keluarga -->
                        <div class="tab-pane fade bg-opacity-5 p-3 rounded-3" id="family" role="tabpanel" aria-labelledby="family-tab">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td width="40%" class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-info bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-female text-info"></i>
                                                    </span>
                                                    <span class="fw-medium">Nama Ibu</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ $siswa->nama_ibu }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-info bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-male text-info"></i>
                                                    </span>
                                                    <span class="fw-medium">Nama Ayah</span>
                                                </div>
                                            </td>
                                            <td class="border-0">{{ $siswa->nama_ayah }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer border-0 bg-white text-center p-3 rounded-4">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i> Terakhir diperbarui: {{ now()->isoFormat('D MMMM YYYY') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('#myTab .nav-link');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active classes from all tabs
                tabs.forEach(t => {
                    t.classList.remove('bg-primary', 'text-white');
                    t.classList.add('bg-light', 'text-dark');
                });
                
                // Add active classes to clicked tab
                this.classList.remove('bg-light', 'text-dark');
                this.classList.add('bg-primary', 'text-white');
            });
        });
    });
    </script>
@endsection