@extends('main')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section with improved styling -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0 rounded-3">
                <div class="card-body bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-0 text-primary fw-bold">
                                <i class="bi bi-envelope-open me-2"></i>Arsip Surat Masuk
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

    <!-- Filter and Search Section with improved styling -->
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
                                <option value="dalam_proses">Dalam Proses</option>
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

    <!-- Table Section with improved styling -->
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
                                    <td><span class="badge bg-{{ $surat->status == 'belum_diproses' ? 'warning text-dark' : ($surat->status == 'dalam_proses' ? 'info' : 'success') }} rounded-pill">{{ ucfirst(str_replace('_', ' ', $surat->status)) }}</span></td>
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
                <!-- Pagination with improved styling -->
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

<!-- View Document Modal -->
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
                                <!-- Disposisi akan ditampilkan di sini -->
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Lampiran</h6>
                            <div id="view-lampiran" class="d-flex flex-wrap gap-2">
                                <!-- Lampiran items will be populated here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-info" id="disposisi-btn" data-bs-toggle="modal" data-bs-target="#disposisiModal"><i class="bi bi-arrow-right-circle me-1"></i> Disposisi</button>
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
                            <label for="nomor_surat" class="form-label fw-bold">
                                <i class="bi bi-hash text-success me-1"></i>Nomor Surat
                            </label>
                            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_surat" class="form-label fw-bold">
                                <i class="bi bi-calendar-date text-success me-1"></i>Tanggal Surat
                            </label>
                            <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pengirim" class="form-label fw-bold">
                                <i class="bi bi-person text-success me-1"></i>Pengirim
                            </label>
                            <input type="text" class="form-control" id="pengirim" name="pengirim" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_diterima" class="form-label fw-bold">
                                <i class="bi bi-calendar-check text-success me-1"></i>Tanggal Diterima
                            </label>
                            <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="perihal" class="form-label fw-bold">
                            <i class="bi bi-chat-left-text text-success me-1"></i>Perihal
                        </label>
                        <input type="text" class="form-control" id="perihal" name="perihal" required>
                    </div>

                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-bold">
                            <i class="bi bi-tag text-success me-1"></i>Kategori
                        </label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="penting">Penting</option>
                            <option value="segera">Segera</option>
                            <option value="biasa">Biasa</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">
                            <i class="bi bi-check-circle text-success me-1"></i>Status
                        </label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="belum_diproses">Belum Diproses</option>
                            <option value="dalam_proses">Dalam Proses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="isi_surat" class="form-label fw-bold">
                            <i class="bi bi-file-text text-success me-1"></i>Isi Surat
                        </label>
                        <textarea class="form-control" id="isi_surat" name="isi_surat" rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="lampiran" class="form-label fw-bold">
                            <i class="bi bi-paperclip text-success me-1"></i>Lampiran
                        </label>
                        <input class="form-control" type="file" id="lampiran" name="lampiran[]" multiple>
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
                <form id="editSuratForm" method="POST" enctype="multipart/form-data">
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

                    <div class="mb-3">
                        <label for="status_edit" class="form-label fw-bold">
                            <i class="bi bi-check-circle text-warning me-1"></i>Status
                        </label>
                        <select class="form-select" id="status_edit" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="belum_diproses">Belum Diproses</option>
                            <option value="dalam_proses">Dalam Proses</option>
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
                        <label for="disposisi_edit" class="form-label fw-bold">
                            <i class="bi bi-arrow-right-circle text-warning me-1"></i>Disposisi
                        </label>
                        <textarea class="form-control" id="disposisi_edit" name="disposisi" rows="3"></textarea>
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

<!-- Modal Disposisi -->
<div class="modal fade" id="disposisiModal" tabindex="-1" aria-labelledby="disposisiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="disposisiModalLabel">Tambah Disposisi</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="disposisiForm" method="POST">
                    @csrf
                    <input type="hidden" id="surat_id" name="surat_id">
                    
                    <div class="mb-3">
                        <label for="tujuan_disposisi" class="form-label fw-bold">
                            <i class="bi bi-person-check text-info me-1"></i>Tujuan Disposisi
                        </label>
                        <select class="form-select" id="tujuan_disposisi" name="tujuan_disposisi" required>
                            <option value="">Pilih Tujuan</option>
                            <option value="kepala_bagian">Kepala Bagian</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="staff_admin">Staff Admin</option>
                            <option value="staff_keuangan">Staff Keuangan</option>
                            <option value="staff_teknis">Staff Teknis</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="catatan_disposisi" class="form-label fw-bold">
                            <i class="bi bi-pencil-square text-info me-1"></i>Catatan Disposisi
                        </label>
                        <textarea class="form-control" id="catatan_disposisi" name="catatan_disposisi" rows="4" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="prioritas_disposisi" class="form-label fw-bold">
                            <i class="bi bi-flag text-info me-1"></i>Prioritas
                        </label>
                        <select class="form-select" id="prioritas_disposisi" name="prioritas_disposisi" required>
                            <option value="">Pilih Prioritas</option>
                            <option value="tinggi">Tinggi</option>
                            <option value="sedang">Sedang</option>
                            <option value="rendah">Rendah</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tenggat_waktu" class="form-label fw-bold">
                            <i class="bi bi-calendar-event text-info me-1"></i>Tenggat Waktu
                        </label>
                        <input type="date" class="form-control" id="tenggat_waktu" name="tenggat_waktu" required>
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

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 3rem;"></i>
                </div>
                <p class="text-center">Apakah Anda yakin ingin menghapus surat dengan nomor:</p>
                <h5 class="text-center fw-bold" id="delete-nomor-surat"></h5>
                <p class="text-center text-muted small">Tindakan ini tidak dapat dibatalkan dan akan menghapus seluruh data terkait surat ini.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Permanen</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi date picker dengan format Indonesia
        const dateInputs = document.querySelectorAll('input[type="date"]');
        const today = new Date().toISOString().split('T')[0];
        
        dateInputs.forEach(input => {
            // Default tanggal ke hari ini untuk input tanggal diterima
            if(input.id === 'tanggal_diterima') {
                input.value = today;
            }
        });

        // Tampilkan detail surat
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const url = this.getAttribute('data-url');
                
                // Tampilkan loading
                document.getElementById('view-loading').classList.remove('d-none');
                document.getElementById('view-content').classList.add('d-none');
                
                // Fetch data dari server
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        // Sembunyikan loading
                        document.getElementById('view-loading').classList.add('d-none');
                        document.getElementById('view-content').classList.remove('d-none');
                        
                        // Isi detail surat
                        document.getElementById('view-nomor-surat').textContent = data.nomor_surat;
                        document.getElementById('view-tanggal-surat').textContent = formatDate(data.tanggal_surat);
                        document.getElementById('view-perihal').textContent = data.perihal;
                        document.getElementById('view-pengirim').textContent = data.pengirim;
                        document.getElementById('view-tanggal-diterima').textContent = formatDate(data.tanggal_diterima);
                        
                        // Status dengan badge
                        const statusText = data.status.replace('_', ' ');
                        let statusClass = 'bg-secondary';
                        
                        if(data.status === 'belum_diproses') {
                            statusClass = 'bg-warning text-dark';
                        } else if(data.status === 'dalam_proses') {
                            statusClass = 'bg-info';
                        } else if(data.status === 'selesai') {
                            statusClass = 'bg-success';
                        }
                        
                        document.getElementById('view-status').innerHTML = `<span class="badge ${statusClass} rounded-pill">${statusText}</span>`;
                        document.getElementById('view-isi-surat').textContent = data.isi_surat || 'Tidak ada isi surat.';
                        
                        // Disposisi
                        if(data.disposisi) {
                            document.getElementById('view-disposisi').innerHTML = `
                                <div class="alert alert-info mb-0">
                                    <h6 class="fw-bold mb-2">Disposisi ke: ${data.disposisi.tujuan_disposisi.replace('_', ' ')}</h6>
                                    <p class="mb-2">${data.disposisi.catatan_disposisi}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary rounded-pill">${data.disposisi.prioritas_disposisi}</span>
                                        <small class="text-muted">Tenggat: ${formatDate(data.disposisi.tenggat_waktu)}</small>
                                    </div>
                                </div>
                            `;
                        } else {
                            document.getElementById('view-disposisi').innerHTML = '<p class="text-muted mb-0">Belum ada disposisi untuk surat ini.</p>';
                        }
                        
                        // Lampiran
                        const lampiranContainer = document.getElementById('view-lampiran');
                        lampiranContainer.innerHTML = '';
                        
                        if(data.lampiran && data.lampiran.length > 0) {
                            data.lampiran.forEach(lampiran => {
                                const fileExtension = getFileExtension(lampiran.nama_file);
                                let iconClass = 'bi-file-earmark';
                                
                                if(['pdf'].includes(fileExtension)) {
                                    iconClass = 'bi-file-earmark-pdf';
                                } else if(['doc', 'docx'].includes(fileExtension)) {
                                    iconClass = 'bi-file-earmark-word';
                                } else if(['xls', 'xlsx'].includes(fileExtension)) {
                                    iconClass = 'bi-file-earmark-excel';
                                } else if(['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                                    iconClass = 'bi-file-earmark-image';
                                }
                                
                                const lampiranItem = `
                                    <div class="card border-0 shadow-sm" style="width: 120px;">
                                        <div class="card-body text-center p-2">
                                            <i class="bi ${iconClass} text-primary" style="font-size: 2rem;"></i>
                                            <p class="small mb-0 text-truncate">${lampiran.nama_file}</p>
                                            <a href="${lampiran.path}" class="btn btn-sm btn-outline-primary mt-2" target="_blank">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                `;
                                
                                lampiranContainer.innerHTML += lampiranItem;
                            });
                        } else {
                            lampiranContainer.innerHTML = '<p class="text-muted mb-0">Tidak ada lampiran.</p>';
                        }
                        
                        // Update tombol disposisi
                        document.getElementById('disposisi-btn').setAttribute('data-id', id);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('view-loading').classList.add('d-none');
                        document.getElementById('view-content').classList.remove('d-none');
                        document.getElementById('view-content').innerHTML = `
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                Terjadi kesalahan saat memuat data. Silakan coba lagi.
                            </div>
                        `;
                    });
            });
        });

        // Edit surat
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const url = this.getAttribute('data-url');
                
                // Set form action
                document.getElementById('editSuratForm').action = `/surat_masuk/${id}`;
                
                // Fetch data dari server
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        // Isi form dengan data yang ada
                        document.getElementById('nomor_surat_edit').value = data.nomor_surat;
                        document.getElementById('tanggal_surat_edit').value = data.tanggal_surat;
                        document.getElementById('pengirim_edit').value = data.pengirim;
                        document.getElementById('tanggal_diterima_edit').value = data.tanggal_diterima;
                        document.getElementById('perihal_edit').value = data.perihal;
                        document.getElementById('kategori_edit').value = data.kategori;
                        document.getElementById('status_edit').value = data.status;
                        document.getElementById('isi_surat_edit').value = data.isi_surat;
                        
                        if(data.disposisi) {
                            document.getElementById('disposisi_edit').value = data.disposisi.catatan_disposisi;
                        }
                        
                        // Lampiran
                        const lampiranList = document.querySelector('#lampiran-list .border');
                        lampiranList.innerHTML = '';
                        
                        if(data.lampiran && data.lampiran.length > 0) {
                            data.lampiran.forEach(lampiran => {
                                const lampiranItem = `
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-paperclip me-2"></i>
                                        <span>${lampiran.nama_file}</span>
                                        <div class="form-check ms-auto">
                                            <input class="form-check-input" type="checkbox" name="hapus_lampiran[]" value="${lampiran.id}" id="lampiran-${lampiran.id}">
                                            <label class="form-check-label text-danger" for="lampiran-${lampiran.id}">
                                                Hapus
                                            </label>
                                        </div>
                                    </div>
                                `;
                                
                                lampiranList.innerHTML += lampiranItem;
                            });
                        } else {
                            lampiranList.innerHTML = '<p class="text-muted mb-0">Tidak ada lampiran sebelumnya.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });

        // Delete confirmation
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const url = this.getAttribute('data-url');
                const nomor = this.getAttribute('data-nomor');
                
                document.getElementById('delete-nomor-surat').textContent = nomor;
                document.getElementById('deleteForm').action = url;
            });
        });

        // Disposisi
        document.getElementById('disposisi-btn').addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            document.getElementById('surat_id').value = id;
            
            // Set form action
            document.getElementById('disposisiForm').action = `/surat_masuk/${id}/disposisi`;
            
            // Close view modal
            bootstrap.Modal.getInstance(document.getElementById('viewModal')).hide();
        });

        // Export functionality
        document.getElementById('exportBtn').addEventListener('click', function() {
            // Filter parameters
            const dateFilter = document.getElementById('date-filter').value;
            const categoryFilter = document.getElementById('category-filter').value;
            const statusFilter = document.getElementById('status-filter').value;
            const searchFilter = document.getElementById('search').value;
            
            // Construct query parameters
            let queryParams = new URLSearchParams();
            if(dateFilter) queryParams.append('date', dateFilter);
            if(categoryFilter) queryParams.append('category', categoryFilter);
            if(statusFilter) queryParams.append('status', statusFilter);
            if(searchFilter) queryParams.append('search', searchFilter);
            
            // Redirect to export URL
            window.location.href = `/surat_masuk/export?${queryParams.toString()}`;
        });

        // Search functionality
        document.getElementById('searchBtn').addEventListener('click', function() {
            // Get filter values
            const dateFilter = document.getElementById('date-filter').value;
            const categoryFilter = document.getElementById('category-filter').value;
            const statusFilter = document.getElementById('status-filter').value;
            const searchFilter = document.getElementById('search').value;
            
            // Construct query parameters
            let queryParams = new URLSearchParams();
            if(dateFilter) queryParams.append('date', dateFilter);
            if(categoryFilter) queryParams.append('category', categoryFilter);
            if(statusFilter) queryParams.append('status', statusFilter);
            if(searchFilter) queryParams.append('search', searchFilter);
            
            // Redirect with filters
            window.location.href = `/surat_masuk?${queryParams.toString()}`;
        });

        // Print functionality
        document.getElementById('print-btn').addEventListener('click', function() {
            const printWindow = window.open('', '_blank');
            const suratId = document.getElementById('disposisi-btn').getAttribute('data-id');
            
            // Fetch print view
            fetch(`/surat_masuk/${suratId}/print`)
                .then(response => response.text())
                .then(html => {
                    printWindow.document.write(html);
                    printWindow.document.close();
                    // Wait for resources to load
                    setTimeout(() => {
                        printWindow.print();
                    }, 500);
                })
                .catch(error => {
                    console.error('Error:', error);
                    printWindow.close();
                    alert('Terjadi kesalahan saat mencetak dokumen.');
                });
        });

        // Utility Functions
        function formatDate(dateString) {
            if(!dateString) return '-';
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        }
        
        function getFileExtension(filename) {
            return filename.split('.').pop().toLowerCase();
        }
    });
</script>
@endsection