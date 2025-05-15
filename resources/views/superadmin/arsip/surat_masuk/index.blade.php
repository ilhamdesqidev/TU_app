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
                                <i class="bi bi-calendar me-1 text-primary"></i>Tanggal
                            </label>
                            <input type="date" class="form-control shadow-sm" id="date-filter">
                        </div>
                        <div class="col-md-3">
                            <label for="category-filter" class="form-label fw-bold">
                                <i class="bi bi-tag me-1 text-primary"></i>Kategori
                            </label>
                            <select class="form-select shadow-sm" id="category-filter">
                                <option value="">Semua Kategori</option>
                                <option value="penting">Penting</option>
                                <option value="segera">Segera</option>
                                <option value="biasa">Biasa</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="status-filter" class="form-label fw-bold">
                                <i class="bi bi-check-circle me-1 text-primary"></i>Status
                            </label>
                            <select class="form-select shadow-sm" id="status-filter">
                                <option value="">Semua Status</option>
                                <option value="belum_diproses">Belum Diproses</option>
                                <option value="sedang_diproses">Sedang Diproses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="search" class="form-label fw-bold">
                                <i class="bi bi-search me-1 text-primary"></i>Cari
                            </label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-primary text-white"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" placeholder="Cari surat..." id="search">
                                <button class="btn btn-primary" type="button" id="searchBtn">Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

<!-- JavaScript untuk menangani fungsi-fungsi -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk inisialisasi datatable
    const table = document.querySelector('table');
    if (table) {
        // Kode inisialisasi DataTable bisa diletakkan di sini
    }
    
    // Handler untuk tombol View
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const url = this.dataset.url;
            const loadingEl = document.getElementById('view-loading');
            const contentEl = document.getElementById('view-content');
            
            loadingEl.classList.remove('d-none');
            contentEl.classList.add('d-none');
            
            // Tambahkan token CSRF untuk request
            const headers = {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            };
            
            // Fetch data dari server berdasarkan ID
            fetch(url, {
                method: 'GET',
                headers: headers
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.status === 'error') {
                        throw new Error(data.message || 'Terjadi kesalahan saat memuat data');
                    }
                    
                    loadingEl.classList.add('d-none');
                    contentEl.classList.remove('d-none');
                    
                    // Mengisi data ke dalam modal
                    document.getElementById('view-nomor-surat').textContent = data.nomor_surat || '-';
                    document.getElementById('view-tanggal-surat').textContent = formatDate(data.tanggal_surat);
                    document.getElementById('view-perihal').textContent = data.perihal || '-';
                    document.getElementById('view-pengirim').textContent = data.pengirim || '-';
                    document.getElementById('view-tanggal-diterima').textContent = formatDate(data.tanggal_diterima);
                    
                    // Format status untuk ditampilkan
                    let statusText = data.status ? data.status.replace(/_/g, ' ') : '-';
                    statusText = statusText.charAt(0).toUpperCase() + statusText.slice(1);
                    document.getElementById('view-status').textContent = statusText;
                    
                    // Isi surat
                    document.getElementById('view-isi-surat').textContent = data.isi_surat || 'Tidak ada isi surat';
                    
                    // Disposisi
                    const disposisiEl = document.getElementById('view-disposisi');
                    if (data.disposisi && data.disposisi.length > 0) {
                        let disposisiHTML = '';
                        data.disposisi.forEach(disp => {
                            disposisiHTML += `
                                <div class="mb-2 p-2 border-bottom">
                                    <div><strong>Tujuan:</strong> ${formatTujuan(disp.tujuan_disposisi)}</div>
                                    <div><strong>Catatan:</strong> ${disp.catatan_disposisi || '-'}</div>
                                    <div><strong>Tenggat:</strong> ${formatDate(disp.tenggat_waktu)}</div>
                                    <div><strong>Prioritas:</strong> ${formatPrioritas(disp.prioritas_disposisi)}</div>
                                </div>
                            `;
                        });
                        disposisiEl.innerHTML = disposisiHTML;
                    } else {
                        disposisiEl.innerHTML = '<p class="text-muted fst-italic text-center">Belum ada disposisi</p>';
                    }
                    
                    // Lampiran
                    const lampiranEl = document.getElementById('view-lampiran');
                    if (data.lampiran && data.lampiran.length > 0) {
                        let lampiranHTML = '';
                        data.lampiran.forEach(lamp => {
                            const fileIcon = getFileIcon(lamp.nama_file);
                            lampiranHTML += `
                                <div class="border rounded p-2 bg-white">
                                    <i class="${fileIcon} me-1"></i>
                                    <span>${lamp.nama_file}</span>
                                    <a href="${lamp.file_path}" class="ms-2 text-primary" target="_blank">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            `;
                        });
                        lampiranEl.innerHTML = lampiranHTML;
                    } else {
                        lampiranEl.innerHTML = '<p class="text-muted fst-italic text-center">Tidak ada lampiran</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    loadingEl.classList.add('d-none');
                    contentEl.classList.remove('d-none');
                    contentEl.innerHTML = `
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Terjadi kesalahan saat memuat data. Silakan coba lagi. (${error.message})
                        </div>
                    `;
                });
            
            // Setup tombol disposisi dalam modal view
            document.getElementById('disposisi-modal-btn').addEventListener('click', function() {
                const disposisiModal = new bootstrap.Modal(document.getElementById('disposisiModal'));
                document.getElementById('disposisi-surat-id').value = id;
                document.getElementById('disposisi-nomor-surat').textContent = button.dataset.nomor;
                
                // Tutup modal view dan buka modal disposisi
                bootstrap.Modal.getInstance(document.getElementById('viewModal')).hide();
                disposisiModal.show();
            });
        });
    });
    
    // Handler untuk tombol Edit
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const url = this.dataset.url;
            
            // Set action URL untuk form
            const formAction = url.replace('/edit', ''); // Mengubah endpoint dari edit ke update
            document.getElementById('editSuratForm').action = formAction;
            
            // Tambahkan loading spinner
            const modalBody = document.querySelector('#editSuratModal .modal-body');
            const loadingHTML = `
                <div id="edit-loading" class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data...</p>
                </div>
            `;
            
            // Tampilkan loading spinner
            const formContent = document.getElementById('editSuratForm').innerHTML;
            document.getElementById('editSuratForm').innerHTML = loadingHTML + formContent;
            
            // Tambahkan token CSRF untuk request
            const headers = {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            };
            
            // Fetch data untuk mengisi form
            fetch(url, {
                method: 'GET',
                headers: headers
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Hapus loading spinner
                    const loadingEl = document.getElementById('edit-loading');
                    if (loadingEl) {
                        loadingEl.remove();
                    }
                    
                    // Isi form dengan data dari server
                    document.getElementById('nomor_surat_edit').value = data.nomor_surat || '';
                    document.getElementById('tanggal_surat_edit').value = formatDateForInput(data.tanggal_surat);
                    document.getElementById('pengirim_edit').value = data.pengirim || '';
                    document.getElementById('tanggal_diterima_edit').value = formatDateForInput(data.tanggal_diterima);
                    document.getElementById('perihal_edit').value = data.perihal || '';
                    document.getElementById('kategori_edit').value = data.kategori || '';
                    document.getElementById('status_edit').value = data.status || '';
                    document.getElementById('isi_surat_edit').value = data.isi_surat || '';
                    
                    // Lampiran list
                    const lampiranListEl = document.querySelector('#lampiran-list .border');
                    if (data.lampiran && data.lampiran.length > 0) {
                        let lampiranHTML = '';
                        data.lampiran.forEach(lamp => {
                            const fileIcon = getFileIcon(lamp.nama_file);
                            lampiranHTML += `
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <i class="${fileIcon} me-1"></i>
                                        <span>${lamp.nama_file}</span>
                                    </div>
                                    <div>
                                        <a href="${lamp.file_path}" class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-lampiran" 
                                            data-id="${lamp.id}" data-surat-id="${id}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            `;
                        });
                        lampiranListEl.innerHTML = lampiranHTML;
                        
                        // Event handler untuk hapus lampiran
                        document.querySelectorAll('.delete-lampiran').forEach(btn => {
                            btn.addEventListener('click', function() {
                                const lampId = this.dataset.id;
                                const suratId = this.dataset.suratId;
                                
                                if (confirm('Apakah Anda yakin ingin menghapus lampiran ini?')) {
                                    // Ajax request untuk menghapus lampiran
                                    fetch(`/lampiran/${lampId}/delete`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                            'Content-Type': 'application/json'
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            // Hapus element dari DOM
                                            this.closest('.d-flex').remove();
                                        } else {
                                            alert('Gagal menghapus lampiran. Silakan coba lagi.');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        alert('Terjadi kesalahan saat menghapus lampiran.');
                                    });
                                }
                            });
                        });
                    } else {
                        lampiranListEl.innerHTML = '<p class="text-muted text-center mb-0">Tidak ada lampiran</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    
                    // Hapus loading spinner
                    const loadingEl = document.getElementById('edit-loading');
                    if (loadingEl) {
                        loadingEl.remove();
                    }
                    
                    // Tampilkan pesan error
                    const errorHTML = `
                        <div class="alert alert-danger mb-3">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Terjadi kesalahan saat memuat data. Silakan coba lagi. (${error.message})
                        </div>
                    `;
                    document.getElementById('editSuratForm').insertAdjacentHTML('afterbegin', errorHTML);
                });
        });
    });
    
    // Handler untuk tombol Delete
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const url = this.dataset.url;
            const nomor = this.dataset.nomor;
            
            document.getElementById('deleteForm').action = url;
            document.getElementById('delete-nomor-surat').textContent = nomor;
        });
    });
    
    // Handler untuk tombol Disposisi
    document.querySelectorAll('.disposisi-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const nomor = this.dataset.nomor;
            
            // Set URL untuk form disposisi
            document.getElementById('disposisiForm').action = `/surat_masuk/${id}/disposisi`;
            document.getElementById('disposisi-surat-id').value = id;
            document.getElementById('disposisi-nomor-surat').textContent = nomor;
        });
    });
    
    // Filter dan pencarian
    document.getElementById('searchBtn').addEventListener('click', function() {
        const search = document.getElementById('search').value;
        const dateFilter = document.getElementById('date-filter').value;
        const categoryFilter = document.getElementById('category-filter').value;
        const statusFilter = document.getElementById('status-filter').value;
        
        // Membuat URL dengan query params untuk filter
        let url = new URL(window.location.href);
        url.searchParams.set('search', search);
        if (dateFilter) url.searchParams.set('date', dateFilter);
        if (categoryFilter) url.searchParams.set('category', categoryFilter);
        if (statusFilter) url.searchParams.set('status', statusFilter);
        
        // Redirect ke URL dengan filter
        window.location.href = url.toString();
    });
    
    // Export button
    document.getElementById('exportBtn').addEventListener('click', function() {
        // Mengambil nilai filter untuk dikirim ke endpoint export
        const search = document.getElementById('search').value;
        const dateFilter = document.getElementById('date-filter').value;
        const categoryFilter = document.getElementById('category-filter').value;
        const statusFilter = document.getElementById('status-filter').value;
        
        let url = '/surat_masuk/export?';
        if (search) url += `search=${encodeURIComponent(search)}&`;
        if (dateFilter) url += `date=${encodeURIComponent(dateFilter)}&`;
        if (categoryFilter) url += `category=${encodeURIComponent(categoryFilter)}&`;
        if (statusFilter) url += `status=${encodeURIComponent(statusFilter)}&`;
        
        // Redirect ke endpoint export
        window.location.href = url;
    });
    
    // Print button
    document.getElementById('print-btn').addEventListener('click', function() {
        window.print();
    });
    
    // Fungsi pembantu untuk format tanggal
    function formatDate(dateString) {
        if (!dateString) return '-';
        const date = new Date(dateString);
        if (isNaN(date.getTime())) return '-'; // Cek apakah tanggal valid
        const options = { day: 'numeric', month: 'short', year: 'numeric' };
        return date.toLocaleDateString('id-ID', options);
    }
    
    // Format tanggal untuk input date (YYYY-MM-DD)
    function formatDateForInput(dateString) {
        if (!dateString) return '';
        const date = new Date(dateString);
        if (isNaN(date.getTime())) return ''; // Cek apakah tanggal valid
        return date.toISOString().split('T')[0];
    }
    
    // Mendapatkan icon berdasarkan ekstensi file
    function getFileIcon(filename) {
        if (!filename) return 'bi bi-file-earmark';
        const ext = filename.split('.').pop().toLowerCase();
        switch (ext) {
            case 'pdf':
                return 'bi bi-file-pdf text-danger';
            case 'doc':
            case 'docx':
                return 'bi bi-file-word text-primary';
            case 'xls':
            case 'xlsx':
                return 'bi bi-file-excel text-success';
            case 'jpg':
            case 'jpeg':
            case 'png':
                return 'bi bi-file-image text-info';
            default:
                return 'bi bi-file-earmark';
        }
    }
    
    // Format tujuan disposisi
    function formatTujuan(tujuan) {
        if (!tujuan) return '-';
        return tujuan.replace(/_/g, ' ')
                    .split(' ')
                    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                    .join(' ');
    }
    
    // Format prioritas disposisi
    function formatPrioritas(prioritas) {
        if (!prioritas) return '-';
        const prioritasClass = {
            'tinggi': 'text-danger',
            'sedang': 'text-warning',
            'rendah': 'text-success'
        };
        
        return `<span class="${prioritasClass[prioritas] || ''}">${prioritas.charAt(0).toUpperCase() + prioritas.slice(1)}</span>`;
    }
});
</script>
@endsection