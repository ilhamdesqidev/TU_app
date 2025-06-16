@extends('main')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
<section class="home bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Back button -->
                <div class="card shadow-sm mb-4 border-0 rounded-3">
                    <div class="card-body">
                    <a href="{{ route('klapper.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembalii
                        </a>
                    </div>
                </div>
                
                <!-- Notification Alerts -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2 fs-5"></i>
                        <div>
                            <strong>Berhasil!</strong> {{ session('success') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                <!-- Header with card design -->
                <div class="card shadow-sm mb-4 border-0 rounded-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h1 class="fs-2 mb-0 text-primary">
                                <i class="fas fa-user-graduate me-2"></i>Data Siswa
                            </h1>
                            <div class="badge bg-primary bg-opacity-10 text-primary py-2 px-3 rounded-pill">
                               Angkatan: {{ $klapper->id }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Search and filter card -->
                <div class="card shadow-sm mb-4 border-0 rounded-3">
                    <div class="card-body">
                        <form action="{{ route('klapper.show', $klapper->id) }}" method="GET" id="searchForm">
                            <div class="row g-2 align-items-center">
                                <!-- Input Cari Siswa -->
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold text-secondary">Cari Siswa</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>
                                        <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Nama" class="form-control rounded-end">
                                        <div class="input-group-text bg-white border-start-0 d-none" id="loadingIndicator">
                                            <i class="fas fa-spinner fa-spin text-primary"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter Sekolah -->
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-secondary">Filter Sekolah</label>
                                    <select name="amaliah" onchange="this.form.submit()" class="form-select">
                                        <option value="" {{ request('amaliah') == '' ? 'selected' : '' }}>Semua Sekolah</option>
                                        <option value="1" {{ request('amaliah') == '1' ? 'selected' : '' }}>SMK Amaliah 1</option>
                                        <option value="2" {{ request('amaliah') == '2' ? 'selected' : '' }}>SMK Amaliah 2</option>
                                    </select>
                                </div>

                                <!-- Tombol Reset -->
                                <div class="col-md-3">
                                    <label class="form-label d-none d-md-block">&nbsp;</label>
                                    <a href="{{ route('klapper.show', $klapper->id) }}" class="btn btn-outline-secondary w-100">
                                        <i class="fas fa-sync-alt me-1"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="container mt-5">
    <!-- Card Aksi Massal -->
    <div class="card shadow-sm mb-4 border-0 rounded-3">
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
                <h5 class="mb-0 text-dark">Aksi Massal</h5>
                <div class="d-flex flex-wrap gap-2">
                    @php
                        // Define variables to track student status
                        $hasKelasX = false;
                        $hasKelasXI = false;
                        $hasKelasXII = false;
                        $allStudentsActive = true;
                        $allStudentsGraduated = true;
                        $hasActiveStudents = false;
                        
                        foreach ($klapper->siswas as $siswa) {
                            if ($siswa->status == 2) {  // Only check active students
                                $hasActiveStudents = true;
                                $allStudentsGraduated = false;
                                if ($siswa->kelas == 'X') $hasKelasX = true;
                                if ($siswa->kelas == 'XI') $hasKelasXI = true;
                                if ($siswa->kelas == 'XII') $hasKelasXII = true;
                            } else if ($siswa->status == 1) { // Graduated
                                $allStudentsActive = false;
                            } else { // Dropped out
                                $allStudentsActive = false;
                                $allStudentsGraduated = false;
                            }
                        }
                        
                        $enableNaikXI = $hasKelasX && !$hasKelasXI && !$hasKelasXII;
                        $enableNaikXII = !$hasKelasX && $hasKelasXI && !$hasKelasXII;
                        $enableLuluskan = !$hasKelasX && !$hasKelasXI && $hasKelasXII;
                        $showTambahSiswa = !$allStudentsGraduated || count($klapper->siswas) == 0;
                    @endphp
                    
                    @if($showTambahSiswa)
                    <a href="{{ route('siswa.create', $klapper->id) }}" class="btn btn-primary">
                        <i class="fas fa-user-plus me-1"></i> Tambah Data
                    </a>
                    @endif
                    
                    <!-- Button for "Naik Kelas XI" - Only enabled when there are active students in class X -->
                    <button type="button" class="btn btn-info text-white {{ $enableNaikXI ? '' : 'disabled' }}" 
                            data-bs-toggle="modal" data-bs-target="{{ $enableNaikXI ? '#naikKelasXIModal' : '' }}"
                            title="{{ $enableNaikXI ? 'Naik Kelas XI' : 'Hanya tersedia untuk siswa aktif di Kelas X' }}">
                        <i class="fas fa-arrow-up me-1"></i> Naik Kelas XI
                    </button>
                    
                    <!-- Button for "Naik Kelas XII" - Only enabled when there are active students in class XI -->
                    <button type="button" class="btn btn-info text-white {{ $enableNaikXII ? '' : 'disabled' }}" 
                            data-bs-toggle="modal" data-bs-target="{{ $enableNaikXII ? '#naikKelasXIIModal' : '' }}"
                            title="{{ $enableNaikXII ? 'Naik Kelas XII' : 'Hanya tersedia untuk siswa aktif di Kelas XI' }}">
                        <i class="fas fa-arrow-up me-1"></i> Naik Kelas XII
                    </button>
                    
                    <!-- Button for "Luluskan Semua" - Only enabled when there are active students in class XII -->
                    <button type="button" class="btn btn-success {{ $enableLuluskan ? '' : 'disabled' }}" 
                            data-bs-toggle="modal" data-bs-target="{{ $enableLuluskan ? '#tanggalLulusModal' : '' }}"
                            title="{{ $enableLuluskan ? 'Luluskan Semua' : 'Hanya tersedia untuk siswa aktif di Kelas XII' }}">
                        <i class="fas fa-graduation-cap me-1"></i> Luluskan Semua
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<div class="modal fade" id="tanggalLulusModal" tabindex="-1" aria-labelledby="tanggalLulusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('siswa.luluskan', $klapper->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tanggalLulusModalLabel">Masukkan Tanggal Lulus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Tindakan ini akan mengubah status semua siswa kelas XII menjadi "Lulus".
                    </div>
                    <label for="tanggal_lulus" class="form-label">Tanggal Lulus:</label>
                    <input type="date" name="tanggal_lulus" id="tanggal_lulus" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Luluskan Semua</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="naikKelasXIModal" tabindex="-1" aria-labelledby="naikKelasXIModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('siswa.naikKelasXI', $klapper->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="naikKelasXIModalLabel">Masukkan Tanggal Naik Kelas XI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Tindakan ini akan mengubah semua siswa kelas X menjadi kelas XI.
                    </div>
                    <label for="tanggal_naik_kelas_xi" class="form-label">Tanggal:</label>
                    <input type="date" name="tanggal_naik_kelas_xi" id="tanggal_naik_kelas_xi" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="naikKelasXIIModal" tabindex="-1" aria-labelledby="naikKelasXIIModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('siswa.naikKelasXII', $klapper->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="naikKelasXIIModalLabel">Masukkan Tanggal Naik Kelas XII</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Tindakan ini akan mengubah semua siswa kelas XI menjadi kelas XII.
                    </div>
                    <label for="tanggal_naik_kelas_xii" class="form-label">Tanggal:</label>
                    <input type="date" name="tanggal_naik_kelas_xii" id="tanggal_naik_kelas_xii" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

                <!-- Improved Data Table Card -->
                <div class="card shadow border-0 rounded-3">
                    <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-list me-2 text-primary"></i>Daftar Siswa
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="text-center border-0 py-3" style="width: 50px;">NO</th>
                                        <th class="border-0 py-3" style="width: 350px;">Nama</th>
                                        <th class="border-0 py-3">NIS</th>
                                        <th class="border-0 py-3">Jurusan</th>
                                        <th class="border-0 py-3">Kelas</th>
                                        <th class="border-0 py-3">Status</th>
                                        <th class="border-0 py-3" style="width: 100px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                    $filteredSiswas = $klapper->siswas->filter(function ($siswa) {
                                        $amaliah = request('amaliah');
                                        $jurusanAmaliah1 = ['pplg', 'tjkt', 'an'];
                                        $jurusanAmaliah2 = ['dpb', 'lps', 'akl', 'mp', 'br'];

                                        if ($amaliah == '1') {
                                            return in_array(strtolower($siswa->jurusan), $jurusanAmaliah1);
                                        } elseif ($amaliah == '2') {
                                            return in_array(strtolower($siswa->jurusan), $jurusanAmaliah2);
                                        }
                                        return true; // Jika tidak ada filter, tampilkan semua
                                    });
                                    @endphp

                                    @foreach ($filteredSiswas as $siswa)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="fw-medium">{{ $siswa->nama_siswa }}</td>
                                        <td><span class="badge bg-light text-dark">{{ $siswa->nis }}</span></td>
                                        <td>
                                            <span class="badge rounded-pill 
                                                @if(in_array(strtolower($siswa->jurusan), ['pplg', 'tjkt'])) bg-info text-dark
                                                @elseif(in_array(strtolower($siswa->jurusan), ['akl', 'mp'])) bg-warning text-dark
                                                @elseif(in_array(strtolower($siswa->jurusan), ['dpb', 'lps'])) bg-primary text-white
                                                @else bg-secondary text-white @endif">
                                                {{ strtoupper($siswa->jurusan) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                Kelas {{ $siswa->kelas }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($siswa->status == 2)
                                            <span class="badge bg-primary text-white">
                                                <i class="fas fa-user-graduate me-1"></i> Pelajar
                                            </span>
                                            @elseif($siswa->status == 1)
                                            <span class="badge bg-success text-white">
                                                <i class="fas fa-graduation-cap me-1"></i> Lulus
                                            </span>
                                            @elseif($siswa->status == 0)
                                            <span class="badge bg-danger text-white">
                                                <i class="fas fa-arrow-right-from-bracket me-1"></i> Keluar
                                            </span>
                                            <br>
                                                <small class="text-muted">
                                                    {{ $siswa->alasan_keluar }}
                                                </small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fa-solid fa-folder-open"></i>
                                                </a>
                                                
                                                {{-- Tombol Keluarkan Siswa (tambahkan ini) --}}
                                                @if($siswa->status == 2)
                                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#modalKeluarkanSiswa{{ $siswa->id }}"
                                                            title="Keluarkan Siswa">
                                                        <i class="fas fa-arrow-right-from-bracket"></i>
                                                    </button>
                                               @endif
                                        </td>
                                    </tr>

                                    <!-- Modal Keluarkan Siswa -->
                <div class="modal fade" id="modalKeluarkanSiswa{{ $siswa->id }}" tabindex="-1" aria-labelledby="modalKeluarkanSiswaLabel{{ $siswa->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalKeluarkanSiswaLabel{{ $siswa->id }}">
                                    <i class="fas fa-arrow-right-from-bracket text-danger me-2"></i>
                                    Keluarkan Siswa
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <form action="{{ route('siswa.keluar', $siswa->id) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="alert alert-warning" role="alert">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <strong>Peringatan!</strong> Tindakan ini akan mengeluarkan siswa <strong>{{ $siswa->nama_siswa }}</strong> dari sistem.
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="tanggal_keluar{{ $siswa->id }}" class="form-label">
                                            <i class="fas fa-calendar me-1"></i>
                                            Tanggal Keluar <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" class="form-control" id="tanggal_keluar{{ $siswa->id }}" name="tanggal_keluar" 
                                            value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                    <label for="alasan_keluar{{ $siswa->id }}" class="form-label">
                                        <i class="fas fa-comment me-1"></i>
                                        Alasan Keluar <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select mb-2" name="alasan_keluar_pilihan" id="alasan_keluar_select{{ $siswa->id }}" onchange="handleAlasanChange({{ $siswa->id }})">
                                        <option value="">Pilih alasan...</option>
                                        <option value="Lulus">Lulus</option>
                                        <option value="Pindah Sekolah">Pindah Sekolah</option>
                                        <option value="Mengundurkan Diri">Mengundurkan Diri</option>
                                        <option value="Dikeluarkan">Dikeluarkan</option>
                                        <option value="custom">Lainnya (Tulis sendiri)</option>
                                    </select>
                                    <textarea class="form-control" name="alasan_keluar_custom" id="alasan_keluar{{ $siswa->id }}" 
                                                rows="3" placeholder="Masukkan alasan keluar siswa..." disabled></textarea>
                                        <div class="form-text">Jelaskan alasan mengeluarkan siswa secara detail.</div>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="fas fa-times me-1"></i>
                                        Batal
                                    </button>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin mengeluarkan siswa ini?')">
                                        <i class="fas fa-check me-1"></i>
                                        Keluarkan Siswa
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach

                                    @if(count($filteredSiswas) == 0)
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            <i class="fas fa-search me-2"></i> Tidak ada data siswa yang ditemukan
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                
                <!-- Footer info -->
                <div class="mt-4 text-center text-muted small">
                    <p class="mb-0">SMK Amaliah Data Management System © {{ date('Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Search input functionality
    let searchInput = document.getElementById("searchInput");
    let searchForm = document.getElementById("searchForm");
    let loadingIndicator = document.getElementById("loadingIndicator");
    let typingTimer;
    let doneTypingInterval = 500; // Waktu delay sebelum pencarian otomatis (ms)

    searchInput.addEventListener("input", function () {
        clearTimeout(typingTimer);
        
        // Show loading indicator
        if (loadingIndicator) {
            loadingIndicator.classList.remove("d-none");
        }
        
        typingTimer = setTimeout(() => {
            searchForm.submit();
        }, doneTypingInterval);
    });

    // Jika pengguna masih menketik, hentikan pengiriman form sementara
    searchInput.addEventListener("keydown", function () {
        clearTimeout(typingTimer);
    });

    // Modal functionality
    const modals = [
        { id: 'tanggalLulusModal', formId: 'tanggal_lulus' },
        { id: 'naikKelasXIModal', formId: 'tanggal_naik_kelas_xi' },
        { id: 'naikKelasXIIModal', formId: 'tanggal_naik_kelas_xii' }
    ];

    function handleAlasanChange(id) {
        const select = document.getElementById(`alasan_keluar_select${id}`);
        const textarea = document.getElementById(`alasan_keluar${id}`);

        if (select.value === 'custom') {
            textarea.disabled = false;
            textarea.required = true;
        } else {
            textarea.disabled = true;
            textarea.required = false;
            textarea.value = select.value; // atau kosongkan: textarea.value = '';
        }
    }
}
    // Set today's date as default for all date inputs
    const today = new Date().toISOString().split('T')[0];
    
    modals.forEach(modal => {
        const modalElement = document.getElementById(modal.id);
        if (modalElement) {
            // When modal is shown, set default date
            modalElement.addEventListener('shown.bs.modal', function () {
                const dateInput = document.getElementById(modal.formId);
                if (dateInput && !dateInput.value) {
                    dateInput.value = today;
                }
            });
        }
    });

    // Konfirmasi sebelum melakukan tindakan massal
    const massActionForms = document.querySelectorAll('.modal form');
    massActionForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin melakukan tindakan ini? Tindakan ini tidak dapat dibatalkan.')) {
                e.preventDefault();
            }
        });
    });
    
    // Add tooltips to disabled buttons
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Auto close alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>
@endsection

