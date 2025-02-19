@extends('main')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
<section class="home bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Header with card design -->
                <div class="card shadow-sm mb-4 border-0 rounded-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h1 class="fs-2 mb-0 text-primary">
                                <i class="fas fa-user-graduate me-2"></i>Data Siswa
                            </h1>
                            <div class="badge bg-primary bg-opacity-10 text-primary py-2 px-3 rounded-pill">
                                Klapper ID: {{ $klapper->id }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Search and filter card -->
                <div class="card shadow-sm mb-4 border-0 rounded-3">
                    <div class="card-body">
                        <form action="{{ route('klapper.show', $klapper->id) }}" method="GET">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Cari Siswa</label>
                                    <div class="input-group">
                                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama atau Jurusan" class="form-control">
                                        <button type="submit" class="btn btn-primary px-3">
                                            <i class="fas fa-search me-1"></i> Cari
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted">Filter Sekolah</label>
                                    <select name="amaliah" onchange="this.form.submit()" class="form-select">
                                        <option value="" {{ request('amaliah') == '' ? 'selected' : '' }}>Semua Sekolah</option>
                                        <option value="1" {{ request('amaliah') == '1' ? 'selected' : '' }}>SMK Amaliah 1</option>
                                        <option value="2" {{ request('amaliah') == '2' ? 'selected' : '' }}>SMK Amaliah 2</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Action buttons card -->
                <div class="card shadow-sm mb-4 border-0 rounded-3">
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
                            <h5 class="mb-0 text-dark">Aksi Massal</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('siswa.create', $klapper->id) }}" class="btn btn-primary">
                                    <i class="fas fa-user-plus me-1"></i> Tambah Data
                                </a>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-cog me-1"></i> Aksi Kelas
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#tanggalLulusModal">
                                                <i class="fas fa-graduation-cap me-2 text-success"></i> Luluskan Semua Pelajar
                                            </button>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#naikKelasXIModal">
                                                <i class="fas fa-arrow-up me-2 text-primary"></i> Naik Kelas XI
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#naikKelasXIIModal">
                                                <i class="fas fa-arrow-up me-2 text-primary"></i> Naik Kelas XII
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modals -->
                <div class="modal fade" id="tanggalLulusModal" tabindex="-1" aria-labelledby="tanggalLulusModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('klapper.lulusSemua', $klapper->id) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Masukkan Tanggal Lulus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
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
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('klapper.naikKelasXI', $klapper->id) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="naikKelasXIModalLabel">Masukkan Tanggal Naik Kelas XI</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
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
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('klapper.naikKelasXII', $klapper->id) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="naikKelasXIIModalLabel">Masukkan Tanggal Naik Kelas XII</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
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
                                            @if($siswa->status == 0)
                                            <span class="badge bg-primary text-white">
                                                <i class="fas fa-user-graduate me-1"></i> Pelajar
                                            </span>
                                            @elseif($siswa->status == 1)
                                            <span class="badge bg-success text-white">
                                                <i class="fas fa-graduation-cap me-1"></i> Lulus
                                            </span>
                                            @else
                                            <span class="badge bg-danger text-white">
                                                <i class="fas fa-arrow-right-from-bracket me-1"></i> Keluar
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fa-solid fa-folder-open"></i>
                                                </a>
                                                
                                                @if($siswa->status == 0)
                                                <a href="{{ route('klapper.keluar', $siswa->id) }}" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-arrow-right-from-bracket"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
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
@endsection