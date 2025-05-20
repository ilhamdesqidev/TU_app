@extends('main')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section dengan styling yang ditingkatkan -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0 rounded-3">
                <div class="card-body bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-0 text-primary fw-bold">
                                <i class="bi bi-envelope me-2"></i>Arsip Surat Masuk
                            </h1>
                            <p class="text-muted mb-0">Manajemen dokumen surat masuk</p>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahSuratModal">
                                <i class="bi bi-plus-circle me-1"></i> Tambah Surat
                            </button>
                            <button type="button" class="btn btn-success rounded-pill shadow-sm ms-2" id="exportBtn">
                                <i class="bi bi-download me-1"></i> Export
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter dan Pencarian dengan styling yang ditingkatkan -->
<form id="filterForm" method="GET" action="{{ route('surat_masuk.index') }}">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-muted"><i class="bi bi-funnel me-2"></i>Filter Pencarian</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="date-filter" class="form-label fw-bold">
                                <i class="bi bi-calendar me-1 text-primary"></i>Tanggal Mulai
                            </label>
                            <input type="date" class="form-control shadow-sm" name="start_date" id="start-date-filter" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="date-filter" class="form-label fw-bold">
                                <i class="bi bi-calendar me-1 text-primary"></i>Tanggal Akhir
                            </label>
                            <input type="date" class="form-control shadow-sm" name="end_date" id="end-date-filter" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="category-filter" class="form-label fw-bold">
                                <i class="bi bi-tag me-1 text-primary"></i>Kategori
                            </label>
                            <select class="form-select shadow-sm" name="kategori" id="category-filter">
                                <option value="">Semua Kategori</option>
                                <option value="penting" {{ request('kategori') == 'penting' ? 'selected' : '' }}>Penting</option>
                                <option value="segera" {{ request('kategori') == 'segera' ? 'selected' : '' }}>Segera</option>
                                <option value="biasa" {{ request('kategori') == 'biasa' ? 'selected' : '' }}>Biasa</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="status-filter" class="form-label fw-bold">
                                <i class="bi bi-check-circle me-1 text-primary"></i>Status
                            </label>
                            <select class="form-select shadow-sm" name="status" id="status-filter">
                                <option value="">Semua Status</option>
                                <option value="belum_diproses" {{ request('status') == 'belum_diproses' ? 'selected' : '' }}>Belum Diproses</option>
                                <option value="sedang_diproses" {{ request('status') == 'sedang_diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-9">
                            <label for="search" class="form-label fw-bold">
                                <i class="bi bi-search me-1 text-primary"></i>Cari
                            </label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-primary text-white"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" placeholder="Cari berdasarkan nomor surat, pengirim, atau perihal..." 
                                       name="search" id="search" value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <div class="w-100">
                                <button class="btn btn-primary w-100" type="submit" id="searchBtn">
                                    <i class="bi bi-search me-1"></i> Terapkan Filter
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 text-end">
                        @if(request()->has('search') || request()->has('kategori') || request()->has('status') || request()->has('start_date') || request()->has('end_date'))
                        <a href="{{ route('surat_masuk.index') }}" class="btn btn-outline-danger me-2" id="resetFilter">
                            <i class="bi bi-x-circle me-1"></i> Reset Filter
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

    <!-- Bagian Tabel dengan styling yang ditingkatkan -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-muted"><i class="bi bi-table me-2"></i>Daftar Surat Masuk</h5>
                    <span class="badge bg-primary rounded-pill" id="totalRecords">{{ count($suratMasuks ?? []) }} Surat</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped border-top">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">Nomor Surat</th>
                                    <th scope="col">Tanggal Surat</th>
                                    <th scope="col">Tanggal Diterima</th>
                                    <th scope="col">Pengirim</th>
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suratMasuks ?? [] as $surat)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $surat->nomor_surat }}</td>
                                    <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($surat->tanggal_diterima)->format('d M Y') }}</td>
                                    <td>{{ $surat->pengirim }}</td>
                                    <td>{{ $surat->perihal }}</td>
                                    <td><span class="badge bg-{{ $surat->kategori == 'penting' ? 'warning text-dark' : ($surat->kategori == 'segera' ? 'danger' : 'secondary') }} rounded-pill">{{ ucfirst($surat->kategori) }}</span></td>
                                    <td><span class="badge bg-{{ $surat->status == 'belum_diproses' ? 'warning text-dark' : ($surat->status == 'sedang_diproses' ? 'info' : 'success') }} rounded-pill">{{ str_replace('_', ' ', ucfirst($surat->status)) }}</span></td>
                                    <td>
                                        <div class="btn-group">     
                                            <button type="button" class="btn btn-sm btn-primary view-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#viewModal"
                                                    data-url="{{ route('surat_masuk.show', $surat->id) }}"
                                                    data-id="{{ $surat->id }}"
                                                    data-nomor="{{ $surat->nomor_surat }}"
                                                    title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-success edit-btn ms-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editSuratModal"
                                                    data-id="{{ $surat->id }}"
                                                    data-url="{{ route('surat_masuk.edit', $surat->id) }}"
                                                    title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-danger delete-btn ms-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal"
                                                    data-id="{{ $surat->id }}"
                                                    data-url="{{ route('surat_masuk.destroy', $surat->id) }}"
                                                    data-nomor="{{ $surat->nomor_surat }}"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-info disposisi-btn ms-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#disposisiModal"
                                                    data-id="{{ $surat->id }}"
                                                    data-nomor="{{ $surat->nomor_surat }}"
                                                    title="Disposisi">
                                                <i class="bi bi-arrow-right-circle"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                            <p class="mt-2">Belum ada data surat masuk</p>
                                            <button class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#tambahSuratModal">
                                                <i class="bi bi-plus-circle me-1"></i> Tambah Surat Baru
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pagination dengan styling yang ditingkatkan -->
                <div class="card-footer bg-white">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end mb-0">
                            <li class="page-item disabled">
                                <a class="page-link rounded-start" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link rounded-end" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Detail Surat -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewModalLabel">Detail Surat Masuk</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4" id="view-loading">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data...</p>
                </div>
                <div id="view-content" class="d-none">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Informasi Surat</h6>
                                    <div class="mb-2">
                                        <small class="text-muted">Nomor Surat:</small>
                                        <p class="mb-0 fw-bold" id="view-nomor-surat"></p>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Tanggal Surat:</small>
                                        <p class="mb-0" id="view-tanggal-surat"></p>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Perihal:</small>
                                        <p class="mb-0" id="view-perihal"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Detail Penerimaan</h6>
                                    <div class="mb-2">
                                        <small class="text-muted">Pengirim:</small>
                                        <p class="mb-0" id="view-pengirim"></p>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Tanggal Diterima:</small>
                                        <p class="mb-0" id="view-tanggal-diterima"></p>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Status:</small>
                                        <p class="mb-0" id="view-status"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Isi Surat</h6>
                            <p id="view-isi-surat" class="border rounded p-3 bg-light"></p>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Disposisi</h6>
                            <div id="view-disposisi" class="border rounded p-3 bg-light">
                                <!-- Informasi disposisi akan ditampilkan di sini -->
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Lampiran</h6>
                            <div id="view-lampiran" class="d-flex flex-wrap gap-2">
                                <!-- Lampiran akan ditampilkan di sini -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-info" id="disposisi-modal-btn"><i class="bi bi-arrow-right-circle me-1"></i> Disposisi</button>
                <button type="button" class="btn btn-success" id="print-btn"><i class="bi bi-printer me-1"></i> Cetak</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Surat Masuk -->
<div class="modal fade" id="tambahSuratModal" tabindex="-1" aria-labelledby="tambahSuratLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="tambahSuratLabel">Tambah Surat Masuk</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tambahSuratForm" action="{{ route('surat_masuk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nomor_surat_tambah" class="form-label fw-bold">
                                <i class="bi bi-hash text-success me-1"></i>Nomor Surat
                            </label>
                            <input type="text" class="form-control" id="nomor_surat_tambah" name="nomor_surat" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_surat_tambah" class="form-label fw-bold">
                                <i class="bi bi-calendar-date text-success me-1"></i>Tanggal Surat
                            </label>
                            <input type="date" class="form-control" id="tanggal_surat_tambah" name="tanggal_surat" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pengirim_tambah" class="form-label fw-bold">
                                <i class="bi bi-person text-success me-1"></i>Pengirim
                            </label>
                            <input type="text" class="form-control" id="pengirim_tambah" name="pengirim" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_diterima_tambah" class="form-label fw-bold">
                                <i class="bi bi-calendar-check text-success me-1"></i>Tanggal Diterima
                            </label>
                            <input type="date" class="form-control" id="tanggal_diterima_tambah" name="tanggal_diterima" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="perihal_tambah" class="form-label fw-bold">
                            <i class="bi bi-chat-left-text text-success me-1"></i>Perihal
                        </label>
                        <input type="text" class="form-control" id="perihal_tambah" name="perihal" required>
                    </div>

                    <!-- Field kategori -->
                    <div class="mb-3">
                        <label for="kategori_tambah" class="form-label fw-bold">
                            <i class="bi bi-tag text-success me-1"></i>Kategori
                        </label>
                        <select class="form-select" id="kategori_tambah" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="penting">Penting</option>
                            <option value="segera">Segera</option>
                            <option value="biasa">Biasa</option>
                        </select>
                    </div>

                    <!-- Field status -->
                    <div class="mb-3">
                        <label for="status_tambah" class="form-label fw-bold">
                            <i class="bi bi-check-circle text-success me-1"></i>Status
                        </label>
                        <select class="form-select" id="status_tambah" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="belum_diproses" selected>Belum Diproses</option>
                            <option value="sedang_diproses">Sedang Diproses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="isi_surat_tambah" class="form-label fw-bold">
                            <i class="bi bi-file-text text-success me-1"></i>Isi Surat
                        </label>
                        <textarea class="form-control" id="isi_surat_tambah" name="isi_surat" rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="lampiran_tambah" class="form-label fw-bold">
                            <i class="bi bi-paperclip text-success me-1"></i>Lampiran
                        </label>
                        <input class="form-control" type="file" id="lampiran_tambah" name="lampiran[]" multiple>
                        <div class="form-text">Format yang didukung: PDF, DOC, XLS, JPG hingga 10MB</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="tambahSuratForm" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Surat Masuk -->
<div class="modal fade" id="editSuratModal" tabindex="-1" aria-labelledby="editSuratLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editSuratLabel">Edit Surat Masuk</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSuratForm" method="POST" enctype="multipart/form-data" action="">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nomor_surat_edit" class="form-label fw-bold">
                                <i class="bi bi-hash text-warning me-1"></i>Nomor Surat
                            </label>
                            <input type="text" class="form-control" id="nomor_surat_edit" name="nomor_surat" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_surat_edit" class="form-label fw-bold">
                                <i class="bi bi-calendar-date text-warning me-1"></i>Tanggal Surat
                            </label>
                            <input type="date" class="form-control" id="tanggal_surat_edit" name="tanggal_surat" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pengirim_edit" class="form-label fw-bold">
                                <i class="bi bi-person text-warning me-1"></i>Pengirim
                            </label>
                            <input type="text" class="form-control" id="pengirim_edit" name="pengirim" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_diterima_edit" class="form-label fw-bold">
                                <i class="bi bi-calendar-check text-warning me-1"></i>Tanggal Diterima
                            </label>
                            <input type="date" class="form-control" id="tanggal_diterima_edit" name="tanggal_diterima" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="perihal_edit" class="form-label fw-bold">
                            <i class="bi bi-chat-left-text text-warning me-1"></i>Perihal
                        </label>
                        <input type="text" class="form-control" id="perihal_edit" name="perihal" required>
                    </div>

                    <!-- Field kategori -->
                    <div class="mb-3">
                        <label for="kategori_edit" class="form-label fw-bold">
                            <i class="bi bi-tag text-warning me-1"></i>Kategori
                        </label>
                        <select class="form-select" id="kategori_edit" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="penting">Penting</option>
                            <option value="segera">Segera</option>
                            <option value="biasa">Biasa</option>
                        </select>
                    </div>

                    <!-- Field status -->
                    <div class="mb-3">
                        <label for="status_edit" class="form-label fw-bold">
                            <i class="bi bi-check-circle text-warning me-1"></i>Status
                        </label>
                        <select class="form-select" id="status_edit" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="belum_diproses">Belum Diproses</option>
                            <option value="sedang_diproses">Sedang Diproses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="isi_surat_edit" class="form-label fw-bold">
                            <i class="bi bi-file-text text-warning me-1"></i>Isi Surat
                        </label>
                        <textarea class="form-control" id="isi_surat_edit" name="isi_surat" rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="lampiran_edit" class="form-label fw-bold">
                            <i class="bi bi-paperclip text-warning me-1"></i>Lampiran Baru
                        </label>
                        <input class="form-control" type="file" id="lampiran_edit" name="lampiran[]" multiple>
                        <div class="form-text">Kosongkan jika tidak ingin mengganti lampiran. Format: PDF, DOC, JPG, dll.</div>
                    </div>

                    <div id="lampiran-list" class="mb-3">
                        <label class="form-label fw-bold">Lampiran Sebelumnya</label>
                        <div class="border rounded p-3 bg-light">
                            <!-- Isi dengan JS saat modal dibuka -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="editSuratForm" class="btn btn-warning text-white">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Disposisi Surat -->
<div class="modal fade" id="disposisiModal" tabindex="-1" aria-labelledby="disposisiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="disposisiModalLabel">Disposisi Surat</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="disposisiForm" method="POST" action="">
                    @csrf
                    <input type="hidden" name="surat_id" id="disposisi-surat-id">
                    
                    <div class="mb-3">
                        <p>Disposisi untuk surat nomor: <strong id="disposisi-nomor-surat"></strong></p>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tujuan_disposisi" class="form-label fw-bold">
                            <i class="bi bi-person-check text-info me-1"></i>Tujuan Disposisi
                        </label>
                        <select class="form-select" id="tujuan_disposisi" name="tujuan_disposisi" required>
                            <option value="">Pilih Tujuan</option>
                            <option value="kepala_bagian">Kepala Bagian</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="staff_admin">Staff Admin</option>
                            <option value="wadir">Wakil Direktur</option>
                            <option value="direktur">Direktur</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="catatan_disposisi" class="form-label fw-bold">
                            <i class="bi bi-pencil text-info me-1"></i>Catatan
                        </label>
                        <textarea class="form-control" id="catatan_disposisi" name="catatan_disposisi" rows="4" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tenggat_waktu" class="form-label fw-bold">
                            <i class="bi bi-clock text-info me-1"></i>Tenggat Waktu
                        </label>
                        <input type="date" class="form-control" id="tenggat_waktu" name="tenggat_waktu" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="prioritas_disposisi" class="form-label fw-bold">
                            <i class="bi bi-exclamation-circle text-info me-1"></i>Prioritas
                        </label>
                        <select class="form-select" id="prioritas_disposisi" name="prioritas_disposisi" required>
                            <option value="">Pilih Prioritas</option>
                            <option value="tinggi">Tinggi</option>
                            <option value="sedang">Sedang</option>
                            <option value="rendah">Rendah</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="disposisiForm" class="btn btn-info text-white">Simpan Disposisi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Surat -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="text-center mb-3">
                        <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                    </div>
                    <p>Anda yakin ingin menghapus surat masuk dengan nomor:</p>
                    <p class="fw-bold text-center" id="delete-nomor-surat"></p>
                    <p>Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait surat tersebut.</p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="deleteForm" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<!-- Bootstrap JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<!-- JavaScript untuk menangani fungsi-fungsi -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Toast notification function
    function showToast(title, message, bgClass = 'bg-success text-white') {
        const toast = document.getElementById('liveToast');
        const toastTitle = document.getElementById('toast-title');
        const toastMessage = document.getElementById('toast-message');
        
        // Set content
        toastTitle.textContent = title;
        toastMessage.textContent = message;
        
        // Remove existing bg classes and add new one
        toast.classList.remove('bg-success', 'bg-danger', 'bg-warning', 'bg-info');
        if (bgClass) toast.classList.add(bgClass);
        
        // Show toast
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
    }
    
    // Setup filter functionality
   // Setup filter functionality
   const filterForm = document.getElementById('filterForm');
    
    if (filterForm) {
        // Validasi tanggal sebelum submit
        filterForm.addEventListener('submit', function(e) {
            const startDate = document.getElementById('start-date-filter').value;
            const endDate = document.getElementById('end-date-filter').value;
            
            if (startDate && endDate && new Date(startDate) > new Date(endDate)) {
                e.preventDefault();
                showToast('Error', 'Tanggal mulai tidak boleh lebih besar dari tanggal akhir', 'bg-danger text-white');
                return false;
            }
            
            return true;
        });
        
        // Reset filter
        document.getElementById('resetFilter')?.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = '{{ route("surat_masuk.index") }}';
        });
    }
    
    // Validasi range tanggal secara real-time
    const startDateInput = document.getElementById('start-date-filter');
    const endDateInput = document.getElementById('end-date-filter');
    
    if (startDateInput && endDateInput) {
        startDateInput.addEventListener('change', function() {
            if (endDateInput.value && new Date(this.value) > new Date(endDateInput.value)) {
                showToast('Peringatan', 'Tanggal mulai diset setelah tanggal akhir', 'bg-warning text-dark');
                endDateInput.value = '';
            }
        });
        
        endDateInput.addEventListener('change', function() {
            if (startDateInput.value && new Date(this.value) < new Date(startDateInput.value)) {
                showToast('Peringatan', 'Tanggal akhir diset sebelum tanggal mulai', 'bg-warning text-dark');
                this.value = '';
            }
        });
    }
    
    // Fungsi untuk menampilkan toast
    function showToast(title, message, bgClass = 'bg-success text-white') {
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white ${bgClass} border-0 position-fixed bottom-0 end-0 m-3`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        toast.style.zIndex = '1100';
        
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <strong>${title}</strong><br>${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
        
        document.body.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
        
        // Hapus toast setelah beberapa detik
        setTimeout(() => {
            toast.remove();
        }, 5000);
    }

    
    // View button functionality
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const url = this.getAttribute('data-url');
            const viewLoading = document.getElementById('view-loading');
            const viewContent = document.getElementById('view-content');
            
            // Show loading, hide content
            viewLoading.classList.remove('d-none');
            viewContent.classList.add('d-none');
            
            // Fetch data dari server
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Populate modal dengan data
                    document.getElementById('view-nomor-surat').textContent = data.nomor_surat;
                    document.getElementById('view-tanggal-surat').textContent = formatDate(data.tanggal_surat);
                    document.getElementById('view-tanggal-diterima').textContent = formatDate(data.tanggal_diterima);
                    document.getElementById('view-perihal').textContent = data.perihal;
                    document.getElementById('view-pengirim').textContent = data.pengirim;
                    
                    // Status dengan badge yang sesuai
                    let statusClass = 'bg-secondary';
                    if (data.status === 'diterima') statusClass = 'bg-success';
                    else if (data.status === 'diproses') statusClass = 'bg-info';
                    else if (data.status === 'selesai') statusClass = 'bg-primary';
                    else if (data.status === 'ditunda') statusClass = 'bg-warning text-dark';
                    
                    document.getElementById('view-status').innerHTML = `<span class="badge ${statusClass}">${data.status}</span>`;
                    document.getElementById('view-isi-surat').textContent = data.isi_surat || '-';
                   
                    // Populate lampiran
                    const lampiranContainer = document.getElementById('view-lampiran');
                    lampiranContainer.innerHTML = '';
                    
                    if (data.lampiran && data.lampiran.length > 0) {
                        data.lampiran.forEach((item, index) => {
                            let icon = 'file-earmark';
                            let bgColor = 'bg-secondary';
                            
                            if (item.tipe === 'pdf') {
                                icon = 'file-earmark-pdf';
                                bgColor = 'bg-danger';
                            } else if (['jpg', 'jpeg', 'png'].includes(item.tipe)) {
                                icon = 'file-earmark-image';
                                bgColor = 'bg-primary';
                            } else if (['doc', 'docx'].includes(item.tipe)) {
                                icon = 'file-earmark-word';
                                bgColor = 'bg-info';
                            } else if (['xls', 'xlsx'].includes(item.tipe)) {
                                icon = 'file-earmark-excel';
                                bgColor = 'bg-success';
                            }
                            
                            const fileItem = document.createElement('div');
                            fileItem.className = 'border rounded p-2 d-flex align-items-center';
                            fileItem.innerHTML = `
                                <div class="p-2 rounded ${bgColor} text-white me-2">
                                    <i class="bi bi-${icon}"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">${item.nama}</p>
                                    <small class="text-muted">${item.ukuran}</small>
                                </div>
                                <a href="/surat_masuk/${data.id}/download/${index}" class="btn btn-sm btn-link ms-auto" title="Download">
                                    <i class="bi bi-download"></i>
                                </a>
                            `;
                            lampiranContainer.appendChild(fileItem);
                        });
                    } else {
                        lampiranContainer.innerHTML = '<p class="text-muted mb-0">Tidak ada lampiran</p>';
                    }
                    
                    // Hide loading, show content
                    viewLoading.classList.add('d-none');
                    viewContent.classList.remove('d-none');
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    showToast('Error', 'Gagal memuat data surat', 'bg-danger text-white');
                    viewLoading.classList.add('d-none');
                });
        });
    });
    
    // Edit button functionality
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const url = this.getAttribute('data-url');
            
            // Tampilkan modal edit
            const editModal = new bootstrap.Modal(document.getElementById('editSuratModal'));
            editModal.show();
            
            // Fetch data untuk edit
            fetch(`/surat_masuk/${id}/edit`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Set form action
                    document.getElementById('editSuratForm').action = `/surat_masuk/${id}`;
                    
                    // Populate form fields
                    document.getElementById('nomor_surat_edit').value = data.nomor_surat;
                    document.getElementById('tanggal_surat_edit').value = data.tanggal_surat;
                    document.getElementById('tanggal_diterima_edit').value = data.tanggal_diterima;
                    document.getElementById('pengirim_edit').value = data.pengirim;
                    document.getElementById('perihal_edit').value = data.perihal;
                    document.getElementById('isi_surat_edit').value = data.isi_surat || '';
                    
                    // Populate kategori dan status dropdown
                    if (data.kategori) {
                        document.getElementById('kategori_edit').value = data.kategori;
                    }
                    if (data.status) {
                        document.getElementById('status_edit').value = data.status;
                    }
                    
                    // Menangani lampiran yang ada
                    const lampiranList = document.getElementById('lampiran-list');
                    const lampiranContainer = lampiranList.querySelector('.border');
                    lampiranContainer.innerHTML = '';
                    
                    if (data.lampiran && data.lampiran.length > 0) {
                        lampiranList.classList.remove('d-none');
                        
                        data.lampiran.forEach((item, index) => {
                            let icon = 'file-earmark';
                            if (item.tipe === 'pdf') icon = 'file-earmark-pdf';
                            else if (['jpg', 'jpeg', 'png'].includes(item.tipe)) icon = 'file-earmark-image';
                            else if (['doc', 'docx'].includes(item.tipe)) icon = 'file-earmark-word';
                            else if (['xls', 'xlsx'].includes(item.tipe)) icon = 'file-earmark-excel';
                            
                            const fileItem = document.createElement('div');
                            fileItem.className = 'd-flex align-items-center mb-2';
                            fileItem.innerHTML = `
                                <i class="bi bi-${icon} me-2 text-warning"></i>
                                <span>${item.nama}</span>
                                <small class="text-muted ms-2">(${item.ukuran})</small>
                                <div class="form-check ms-auto">
                                    <input class="form-check-input" type="checkbox" id="keep-file-${index}" name="keep_file[]" value="${index}" checked>
                                    <label class="form-check-label" for="keep-file-${index}">Pertahankan</label>
                                </div>
                            `;
                            lampiranContainer.appendChild(fileItem);
                        });
                    } else {
                        lampiranList.classList.add('d-none');
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    showToast('Error', 'Gagal memuat data untuk edit', 'bg-danger text-white');
                });
        });
    });
    
    // Delete button functionality
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const url = this.getAttribute('data-url');
            const nomorSurat = this.getAttribute('data-nomor');
            
            // Set form action
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = url;
            
            // Set surat number in confirmation text
            document.getElementById('delete-nomor-surat').textContent = nomorSurat || '';
        });
    });
    
    // Export button functionality
    document.getElementById('exportBtn').addEventListener('click', function() {
        window.location.href = '/surat_masuk/export';
    });
    
    // Print button functionality
    document.getElementById('print-btn').addEventListener('click', function() {
        const contentToPrint = document.getElementById('view-content').cloneNode(true);
        
        // Buat halaman cetak
        const printWin = window.open('', '_blank');
        printWin.document.write(`
            <html>
                <head>
                    <title>Cetak Surat Masuk</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    <style>
                        body { padding: 20px; }
                        @media print {
                            .no-print { display: none; }
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h2 class="text-center mb-4">Detail Surat Masuk</h2>
                        ${contentToPrint.innerHTML}
                        <div class="text-center mt-4 no-print">
                            <button onclick="window.print()" class="btn btn-primary">Cetak</button>
                            <button onclick="window.close()" class="btn btn-secondary ms-2">Tutup</button>
                        </div>
                    </div>
                </body>
            </html>
        `);
        printWin.document.close();
    });
    
    // Disposisi button functionality
document.addEventListener('DOMContentLoaded', function() {
    // Setup disposisi buttons from the main table
    document.querySelectorAll('.disposisi-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nomorSurat = this.getAttribute('data-nomor');
            
            // Set the surat ID in the hidden field
            document.getElementById('disposisi-surat-id').value = id;
            
            // Set the form action URL correctly
            document.getElementById('disposisiForm').action = `/surat_masuk/${id}/disposisi`;
            
            // Display the nomor surat in the modal
            document.getElementById('disposisi-nomor-surat').textContent = nomorSurat || '';
            
            // Set today's date as default for tenggat_waktu
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            document.getElementById('tenggat_waktu').value = formattedDate;
        });
    });
    
    // Setup disposisi button from view modal
    document.getElementById('disposisi-modal-btn')?.addEventListener('click', function() {
        // Close view modal
        const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewModal'));
        viewModal.hide();
        
        // Get the active surat ID from the view button that was clicked
        const activeViewBtn = document.querySelector('.view-btn[data-bs-toggle="modal"][data-bs-target="#viewModal"].active');
        if (activeViewBtn) {
            const id = activeViewBtn.getAttribute('data-id');
            const nomorSurat = activeViewBtn.getAttribute('data-nomor');
            
            // Set values in disposisi modal
            document.getElementById('disposisi-surat-id').value = id;
            document.getElementById('disposisiForm').action = `/surat_masuk/${id}/disposisi`;
            document.getElementById('disposisi-nomor-surat').textContent = nomorSurat || '';
            
            // Set today's date as default for tenggat_waktu
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            document.getElementById('tenggat_waktu').value = formattedDate;
            
            // Show disposisi modal
            const disposisiModal = new bootstrap.Modal(document.getElementById('disposisiModal'));
            disposisiModal.show();
        }
    });
    
    // Add active class to view button when clicked to track which one is active
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.view-btn').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Form validation for disposisi
    document.getElementById('disposisiForm').addEventListener('submit', function(event) {
        const tujuan = document.getElementById('tujuan_disposisi').value;
        const catatan = document.getElementById('catatan_disposisi').value;
        const tenggat = document.getElementById('tenggat_waktu').value;
        const prioritas = document.getElementById('prioritas_disposisi').value;
        
        if (!tujuan || !catatan || !tenggat || !prioritas) {
            event.preventDefault();
            showToast('Error', 'Semua field disposisi harus diisi', 'bg-danger text-white');
        }
    });
})
    
    // Form submission handlers
    document.getElementById('tambahSuratForm').addEventListener('submit', function(event) {
        // Form validation can be added here if needed
    });
    
    document.getElementById('editSuratForm').addEventListener('submit', function(event) {
        // Form validation can be added here if needed
    });
    
    document.getElementById('deleteForm').addEventListener('submit', function(event) {
        // Form validation can be added here if needed
    });
    
    document.getElementById('dispositionForm').addEventListener('submit', function(event) {
        // Form validation can be added here if needed
    });
    
    // Helper function to format dates
    function formatDate(dateString) {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { 
            day: 'numeric', 
            month: 'long', 
            year: 'numeric' 
        });
    }
});
</script>
@endsection