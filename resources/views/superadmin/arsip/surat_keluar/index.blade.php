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
                                <i class="bi bi-envelope-paper me-2"></i>Arsip Surat Keluar
                            </h1>
                            <p class="text-muted mb-0">Manajemen dokumen surat keluar</p>
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
                                <option value="draft">Draft</option>
                                <option value="dikirim">Dikirim</option>
                                <option value="diterima">Diterima</option>
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
                    <h5 class="mb-0 text-muted"><i class="bi bi-table me-2"></i>Daftar Surat Keluar</h5>
                    <span class="badge bg-primary rounded-pill" id="totalRecords">{{ count($suratKeluars ?? []) }} Surat</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped border-top">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">Nomor Surat</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Penerima</th>
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suratKeluars ?? [] as $surat)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $surat->nomor_surat }}</td>
                                    <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}</td>
                                    <td>{{ $surat->penerima }}</td>
                                    <td>{{ $surat->perihal }}</td>
                                    <td><span class="badge bg-{{ $surat->kategori == 'penting' ? 'warning text-dark' : ($surat->kategori == 'segera' ? 'danger' : 'secondary') }} rounded-pill">{{ ucfirst($surat->kategori) }}</span></td>
                                    <td><span class="badge bg-{{ $surat->status == 'draft' ? 'warning text-dark' : ($surat->status == 'dikirim' ? 'info' : 'success') }} rounded-pill">{{ ucfirst($surat->status) }}</span></td>
                                    <td>
                                        <div class="btn-group">     
                                            <button type="button" class="btn btn-sm btn-primary view-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#viewModal"
                                                    data-url="{{ route('surat_keluar.show', $surat->id) }}"
                                                    data-id="{{ $surat->id }}"
                                                    data-nomor="{{ $surat->nomor_surat }}"
                                                    title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-success edit-btn ms-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#formModal"
                                                    data-id="{{ $surat->id }}"
                                                    data-url="{{ route('surat_keluar.edit', $surat->id) }}"
                                                    data-action="edit"
                                                    title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-danger delete-btn ms-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal"
                                                    data-id="{{ $surat->id }}"
                                                    data-url="{{ route('surat_keluar.destroy', $surat->id) }}"
                                                    data-nomor="{{ $surat->nomor_surat }}"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                            <p class="mt-2">Belum ada data surat keluar</p>
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
                <h5 class="modal-title" id="viewModalLabel">Detail Surat Keluar</h5>
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
                                    <h6 class="card-subtitle mb-2 text-muted">Detail Pengiriman</h6>
                                    <div class="mb-2">
                                        <small class="text-muted">Penerima:</small>
                                        <p class="mb-0" id="view-penerima"></p>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Tanggal Pengiriman:</small>
                                        <p class="mb-0" id="view-tanggal-pengiriman"></p>
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
                <button type="button" class="btn btn-success" id="print-btn"><i class="bi bi-printer me-1"></i> Cetak</button>
            </div>
        </div>
    </div>
</div>

<!-- Perbaikan Modal Tambah Surat Keluar -->
<div class="modal fade" id="tambahSuratModal" tabindex="-1" aria-labelledby="tambahSuratLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="tambahSuratLabel">Tambah Surat Keluar</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tambahSuratForm" action="{{ route('surat_keluar.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="penerima_tambah" class="form-label fw-bold">
                                <i class="bi bi-person text-success me-1"></i>Penerima
                            </label>
                            <input type="text" class="form-control" id="penerima_tambah" name="penerima" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_pengiriman_tambah" class="form-label fw-bold">
                                <i class="bi bi-send text-success me-1"></i>Tanggal Pengiriman
                            </label>
                            <input type="date" class="form-control" id="tanggal_pengiriman_tambah" name="tanggal_pengiriman">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="perihal_tambah" class="form-label fw-bold">
                            <i class="bi bi-chat-left-text text-success me-1"></i>Perihal
                        </label>
                        <input type="text" class="form-control" id="perihal_tambah" name="perihal" required>
                    </div>

                    <!-- Tambahkan field kategori -->
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

                    <!-- Tambahkan field status -->
                    <div class="mb-3">
                        <label for="status_tambah" class="form-label fw-bold">
                            <i class="bi bi-check-circle text-success me-1"></i>Status
                        </label>
                        <select class="form-select" id="status_tambah" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="draft">Draft</option>
                            <option value="dikirim">Dikirim</option>
                            <option value="diterima">Diterima</option>
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

<!-- Modal Edit Surat Keluar -->
<div class="modal fade" id="editSuratModal" tabindex="-1" aria-labelledby="editSuratLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editSuratLabel">Edit Surat Keluar</h5>
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
                            <label for="penerima_edit" class="form-label fw-bold">
                                <i class="bi bi-person text-warning me-1"></i>Penerima
                            </label>
                            <input type="text" class="form-control" id="penerima_edit" name="penerima" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_pengiriman_edit" class="form-label fw-bold">
                                <i class="bi bi-send text-warning me-1"></i>Tanggal Pengiriman
                            </label>
                            <input type="date" class="form-control" id="tanggal_pengiriman_edit" name="tanggal_pengiriman">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="perihal_edit" class="form-label fw-bold">
                            <i class="bi bi-chat-left-text text-warning me-1"></i>Perihal
                        </label>
                        <input type="text" class="form-control" id="perihal_edit" name="perihal" required>
                    </div>

                    <!-- Tambahkan field kategori -->
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

                    <!-- Tambahkan field status -->
                    <div class="mb-3">
                        <label for="status_edit" class="form-label fw-bold">
                            <i class="bi bi-check-circle text-warning me-1"></i>Status
                        </label>
                        <select class="form-select" id="status_edit" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="draft">Draft</option>
                            <option value="dikirim">Dikirim</option>
                            <option value="diterima">Diterima</option>
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


<!-- Confirmation Delete Modal with improved styling -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4">
                    <i class="bi bi-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                </div>
                <h5 class="mb-3">Hapus Surat</h5>
                <p>Apakah Anda yakin ingin menghapus surat dengan nomor <strong id="delete-nomor-surat"></strong>?</p>
                <p class="text-danger">Tindakan ini tidak dapat dibatalkan.</p>
                
                <form id="deleteForm" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="deleteForm" class="btn btn-danger">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast for notifications -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bi bi-bell me-2 text-primary"></i>
            <strong class="me-auto" id="toast-title">Notifikasi</strong>
            <small>Baru saja</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-message">
            Operasi berhasil dilakukan.
        </div>
    </div>
</div>

<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<!-- Bootstrap JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JavaScript for functionality -->
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
    // [Kode filter tetap sama]
    
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
                    document.getElementById('view-perihal').textContent = data.perihal;
                    document.getElementById('view-penerima').textContent = data.penerima;
                    document.getElementById('view-tanggal-pengiriman').textContent = data.tanggal_pengiriman ? formatDate(data.tanggal_pengiriman) : '-';
                    
                    // Status dengan badge yang sesuai
                    let statusClass = 'bg-secondary';
                    if (data.status === 'draft') statusClass = 'bg-warning text-dark';
                    else if (data.status === 'dikirim') statusClass = 'bg-info';
                    else if (data.status === 'diterima') statusClass = 'bg-success';
                    
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
                                <a href="/surat_keluar/${data.id}/download/${index}" class="btn btn-sm btn-link ms-auto" title="Download">
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
    
    // Edit button functionality// Script untuk menangani edit surat
document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const url = this.getAttribute('data-url');
        
        // Tampilkan modal edit
        const editModal = new bootstrap.Modal(document.getElementById('editSuratModal'));
        editModal.show();
        
        // Fetch data untuk edit
        fetch(`/surat_keluar/${id}/edit`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Set form action
                document.getElementById('editSuratForm').action = `/surat_keluar/${id}`;
                
                // Populate form fields
                document.getElementById('nomor_surat_edit').value = data.nomor_surat;
                document.getElementById('tanggal_surat_edit').value = data.tanggal_surat;
                document.getElementById('penerima_edit').value = data.penerima;
                document.getElementById('tanggal_pengiriman_edit').value = data.tanggal_pengiriman || '';
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
        window.location.href = '/surat_keluar/export';
    });
    
    // Print button functionality
    document.getElementById('print-btn').addEventListener('click', function() {
        const contentToPrint = document.getElementById('view-content').cloneNode(true);
        
        // Buat halaman cetak
        const printWin = window.open('', '_blank');
        printWin.document.write(`
            <html>
                <head>
                    <title>Cetak Surat Keluar</title>
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
                        <h2 class="text-center mb-4">Detail Surat Keluar</h2>
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