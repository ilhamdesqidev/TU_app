@extends('main')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<section class="home bg-light">
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Back button -->
                <div class="card shadow-sm mb-3 border-0 rounded-3">
                    <div class="card-body p-2">
                        <a href="{{ route('klapper.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
                
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3 border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2 fs-5"></i>
                        <div><strong>Berhasil!</strong> {{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                <!-- Header -->
                <div class="card shadow-sm mb-3 border-0 rounded-3">
                    <div class="card-body p-2">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h1 class="fs-2 mb-0 text-primary"><i class="fas fa-user-graduate me-1"></i>Data Siswa</h1>
                            <div class="badge bg-primary bg-opacity-10 text-primary py-1 px-2 rounded-pill">
                                Angkatan: {{ $klapper->id }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Search and filter -->
                <div class="card shadow-sm mb-3 border-0 rounded-3">
                    <div class="card-body p-2">
                        <form action="{{ route('klapper.show', $klapper->id) }}" method="GET" id="searchForm">
                            <div class="row g-1 align-items-center">
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold text-secondary small">Cari Siswa</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                                        <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Nama" class="form-control rounded-end">
                                        <div class="input-group-text bg-white border-start-0 d-none" id="loadingIndicator">
                                            <i class="fas fa-spinner fa-spin text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-secondary small">Filter Sekolah</label>
                                    <select name="amaliah" onchange="this.form.submit()" class="form-select">
                                        <option value="" {{ request('amaliah') == '' ? 'selected' : '' }}>Semua Sekolah</option>
                                        <option value="1" {{ request('amaliah') == '1' ? 'selected' : '' }}>SMK Amaliah 1</option>
                                        <option value="2" {{ request('amaliah') == '2' ? 'selected' : '' }}>SMK Amaliah 2</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label d-none d-md-block small">&nbsp;</label>
                                    <a href="{{ route('klapper.show', $klapper->id) }}" class="btn btn-outline-secondary w-100">
                                        <i class="fas fa-sync-alt me-1"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Bulk Actions -->
                <div class="card shadow-sm mb-3 border-0 rounded-3">
                    <div class="card-body p-2">
                        <div class="d-flex flex-wrap gap-1 justify-content-between align-items-center">
                            <h5 class="mb-0 text-dark small">Aksi Massal</h5>
                            <div class="d-flex flex-wrap gap-1">
                                @php
                                    $hasKelasX = false; $hasKelasXI = false; $hasKelasXII = false;
                                    $allStudentsActive = true; $allStudentsGraduated = true;
                                    $hasActiveStudents = false; $hasGraduatedStudents = false;
                                    
                                    foreach ($klapper->siswas as $siswa) {
                                        if ($siswa->status == 2) {
                                            $hasActiveStudents = true;
                                            $allStudentsGraduated = false;
                                            if ($siswa->kelas == 'X') $hasKelasX = true;
                                            if ($siswa->kelas == 'XI') $hasKelasXI = true;
                                            if ($siswa->kelas == 'XII') $hasKelasXII = true;
                                        } else if ($siswa->status == 1) {
                                            $allStudentsActive = false;
                                            $hasGraduatedStudents = true;
                                        } else {
                                            $allStudentsActive = false;
                                            $allStudentsGraduated = false;
                                        }
                                    }
                                    
                                    $enableNaikXI = $hasKelasX && !$hasKelasXI && !$hasKelasXII;
                                    $enableNaikXII = !$hasKelasX && $hasKelasXI && !$hasKelasXII;
                                    $enableLuluskan = !$hasKelasX && !$hasKelasXI && $hasKelasXII;
                                    $showTambahSiswa = count($klapper->siswas) == 0 || $hasActiveStudents || (!$hasGraduatedStudents && !$hasActiveStudents);
                                @endphp
                                
                                @if($showTambahSiswa)
                                <a href="{{ route('siswa.create', $klapper->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-user-plus me-1"></i> Tambah
                                </a>
                                @endif
                                
                                <button type="button" class="btn btn-info btn-sm text-white {{ $enableNaikXI ? '' : 'disabled' }}" 
                                        data-bs-toggle="modal" data-bs-target="{{ $enableNaikXI ? '#naikKelasXIModal' : '' }}"
                                        title="{{ $enableNaikXI ? 'Naik Kelas XI' : 'Hanya tersedia untuk siswa aktif di Kelas X' }}">
                                    <i class="fas fa-arrow-up me-1"></i> Naik XI
                                </button>
                                
                                <button type="button" class="btn btn-info btn-sm text-white {{ $enableNaikXII ? '' : 'disabled' }}" 
                                        data-bs-toggle="modal" data-bs-target="{{ $enableNaikXII ? '#naikKelasXIIModal' : '' }}"
                                        title="{{ $enableNaikXII ? 'Naik Kelas XII' : 'Hanya tersedia untuk siswa aktif di Kelas XI' }}">
                                    <i class="fas fa-arrow-up me-1"></i> Naik XII
                                </button>
                                
                                <button type="button" class="btn btn-success btn-sm {{ $enableLuluskan ? '' : 'disabled' }}" 
                                        data-bs-toggle="modal" data-bs-target="{{ $enableLuluskan ? '#tanggalLulusModal' : '' }}"
                                        title="{{ $enableLuluskan ? 'Luluskan Semua' : 'Hanya tersedia untuk siswa aktif di Kelas XII' }}">
                                    <i class="fas fa-graduation-cap me-1"></i> Luluskan
                                </button>
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
                                <div class="modal-header p-2">
                                    <h5 class="modal-title fs-6" id="tanggalLulusModalLabel">Masukkan Tanggal Lulus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-2">
                                    <div class="alert alert-info p-2 mb-2">
                                        <i class="fas fa-info-circle me-2"></i>Tindakan ini akan mengubah status semua siswa kelas XII menjadi "Lulus".
                                    </div>
                                    <label for="tanggal_lulus" class="form-label small">Tanggal Lulus:</label>
                                    <input type="date" name="tanggal_lulus" id="tanggal_lulus" class="form-control form-control-sm" required>
                                </div>
                                <div class="modal-footer p-2">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Luluskan Semua</button>
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
                                <div class="modal-header p-2">
                                    <h5 class="modal-title fs-6" id="naikKelasXIModalLabel">Masukkan Tanggal Naik Kelas XI</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-2">
                                    <div class="alert alert-info p-2 mb-2">
                                        <i class="fas fa-info-circle me-2"></i>Tindakan ini akan mengubah semua siswa kelas X menjadi kelas XI.
                                    </div>
                                    <label for="tanggal_naik_kelas_xi" class="form-label small">Tanggal:</label>
                                    <input type="date" name="tanggal_naik_kelas_xi" id="tanggal_naik_kelas_xi" class="form-control form-control-sm" required>
                                </div>
                                <div class="modal-footer p-2">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Konfirmasi</button>
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
                                <div class="modal-header p-2">
                                    <h5 class="modal-title fs-6" id="naikKelasXIIModalLabel">Masukkan Tanggal Naik Kelas XII</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-2">
                                    <div class="alert alert-info p-2 mb-2">
                                        <i class="fas fa-info-circle me-2"></i>Tindakan ini akan mengubah semua siswa kelas XI menjadi kelas XII.
                                    </div>
                                    <label for="tanggal_naik_kelas_xii" class="form-label small">Tanggal:</label>
                                    <input type="date" name="tanggal_naik_kelas_xii" id="tanggal_naik_kelas_xii" class="form-control form-control-sm" required>
                                </div>
                                <div class="modal-footer p-2">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Konfirmasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="card shadow border-0 rounded-3">
                    <div class="card-header bg-white p-2 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fs-6"><i class="fas fa-list me-1 text-primary"></i>Daftar Siswa</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="text-center border-0 py-2 small" style="width: 40px;">NO</th>
                                        <th class="border-0 py-2 small" style="width: 300px;">Nama</th>
                                        <th class="border-0 py-2 small">NIS</th>
                                        <th class="border-0 py-2 small">Jurusan</th>
                                        <th class="border-0 py-2 small">Kelas</th>
                                        <th class="border-0 py-2 small">Status</th>
                                        <th class="border-0 py-2 small" style="width: 80px;">Aksi</th>
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
                                        return true;
                                    });
                                    @endphp

                                    @foreach ($filteredSiswas as $siswa)
                                    <tr>
                                        <td class="text-center small">{{ $loop->iteration }}</td>
                                        <td class="fw-medium small">{{ $siswa->nama_siswa }}</td>
                                        <td><span class="badge bg-light text-dark small">{{ $siswa->nis }}</span></td>
                                        <td>
                                            <span class="badge rounded-pill small 
                                                @if(in_array(strtolower($siswa->jurusan), ['pplg', 'tjkt'])) bg-info text-dark
                                                @elseif(in_array(strtolower($siswa->jurusan), ['akl', 'mp'])) bg-warning text-dark
                                                @elseif(in_array(strtolower($siswa->jurusan), ['dpb', 'lps'])) bg-primary text-white
                                                @else bg-secondary text-white @endif">
                                                {{ strtoupper($siswa->jurusan) }}
                                            </span>
                                        </td>
                                        <td><span class="badge bg-light text-dark border small">Kelas {{ $siswa->kelas }}</span></td>
                                        <td>
                                            @if($siswa->status == 2)
                                            <span class="badge bg-primary text-white small"><i class="fas fa-user-graduate me-1"></i> Pelajar</span>
                                            @elseif($siswa->status == 1)
                                            <span class="badge bg-success text-white small"><i class="fas fa-graduation-cap me-1"></i> Lulus</span>
                                            @elseif($siswa->status == 0)
                                            <span class="badge bg-danger text-white small"><i class="fas fa-arrow-right-from-bracket me-1"></i> Keluar</span>
                                            <br><small class="text-muted">{{ $siswa->alasan_keluar }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-outline-primary">
                                                    <i class="fa-solid fa-folder-open"></i>
                                                </a>
                                                @if($siswa->status == 2)
                                                <button type="button" class="btn btn-outline-danger" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#modalKeluarkanSiswa{{ $siswa->id }}"
                                                        title="Keluarkan Siswa">
                                                    <i class="fas fa-arrow-right-from-bracket"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Keluarkan Siswa -->
                                    <div class="modal fade" id="modalKeluarkanSiswa{{ $siswa->id }}" tabindex="-1" aria-labelledby="modalKeluarkanSiswaLabel{{ $siswa->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header p-2">
                                                    <h5 class="modal-title fs-6" id="modalKeluarkanSiswaLabel{{ $siswa->id }}">
                                                        <i class="fas fa-arrow-right-from-bracket text-danger me-1"></i>Keluarkan Siswa
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('siswa.keluar', $siswa->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body p-2">
                                                        <div class="alert alert-warning p-2 mb-2" role="alert">
                                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                                            <strong>Peringatan!</strong> Tindakan ini akan mengeluarkan siswa <strong>{{ $siswa->nama_siswa }}</strong> dari sistem.
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="tanggal_keluar{{ $siswa->id }}" class="form-label small">
                                                                <i class="fas fa-calendar me-1"></i>Tanggal Keluar <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="date" class="form-control form-control-sm" id="tanggal_keluar{{ $siswa->id }}" 
                                                                name="tanggal_keluar" value="{{ date('Y-m-d') }}" required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="alasan_keluar{{ $siswa->id }}" class="form-label small">
                                                                <i class="fas fa-comment me-1"></i>Alasan Keluar <span class="text-danger">*</span>
                                                            </label>
                                                            <textarea class="form-control form-control-sm" name="alasan_keluar" 
                                                                id="alasan_keluar{{ $siswa->id }}" rows="3" 
                                                                placeholder="Masukkan alasan keluar siswa... (contoh: Lulus, Pindah Sekolah, Mengundurkan Diri, dll)"
                                                                required></textarea>
                                                            <div class="form-text small">Jelaskan alasan mengeluarkan siswa secara detail. Maksimal 500 karakter.</div>
                                                        </div>
                                                        <div class="modal-footer p-2">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                                                <i class="fas fa-times me-1"></i>Batal
                                                            </button>
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin mengeluarkan siswa ini?')">
                                                                <i class="fas fa-check me-1"></i>Keluarkan
                                                            </button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    @if(count($filteredSiswas) == 0)
                                    <tr>
                                        <td colspan="7" class="text-center py-3 text-muted small">
                                            <i class="fas fa-search me-1"></i> Tidak ada data siswa yang ditemukan
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="mt-3 text-center text-muted small">
                    <p class="mb-0">SMK Amaliah Data Management System © {{ date('Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Search functionality
    let searchInput = document.getElementById("searchInput");
    let searchForm = document.getElementById("searchForm");
    let loadingIndicator = document.getElementById("loadingIndicator");
    let typingTimer;
    let doneTypingInterval = 500;

    searchInput.addEventListener("input", function () {
        clearTimeout(typingTimer);
        if (loadingIndicator) loadingIndicator.classList.remove("d-none");
        typingTimer = setTimeout(() => searchForm.submit(), doneTypingInterval);
    });

    searchInput.addEventListener("keydown", function () {
        clearTimeout(typingTimer);
    });

    // Set today's date as default for all date inputs
    const today = new Date().toISOString().split('T')[0];
    const modals = [
        { id: 'tanggalLulusModal', formId: 'tanggal_lulus' },
        { id: 'naikKelasXIModal', formId: 'tanggal_naik_kelas_xi' },
        { id: 'naikKelasXIIModal', formId: 'tanggal_naik_kelas_xii' }
    ];

    modals.forEach(modal => {
        const modalElement = document.getElementById(modal.id);
        if (modalElement) {
            modalElement.addEventListener('shown.bs.modal', function () {
                const dateInput = document.getElementById(modal.formId);
                if (dateInput && !dateInput.value) dateInput.value = today;
            });
        }
    });

    // Mass action confirmation
    const massActionForms = document.querySelectorAll('.modal form');
    massActionForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin melakukan tindakan ini? Tindakan ini tidak dapat dibatalkan.')) {
                e.preventDefault();
            }
        });
    });
    
    // Tooltips for disabled buttons
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