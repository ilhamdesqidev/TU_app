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

    <!-- Filter dan Pencarian dengan styling yang ditingkatkan -->
<form id="filterForm" method="GET" action="{{ route('surat_keluar.index') }}">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-muted"><i class="bi bi-funnel me-2"></i>Filter Pencarian</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="start-date-filter" class="form-label fw-bold">
                                <i class="bi bi-calendar me-1 text-primary"></i>Tanggal Mulai
                            </label>
                            <input type="date" class="form-control shadow-sm" name="start_date" id="start-date-filter" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="end-date-filter" class="form-label fw-bold">
                                <i class="bi bi-calendar me-1 text-primary"></i>Tanggal Akhir
                            </label>
                            <input type="date" class="form-control shadow-sm" name="end_date" id="end-date-filter" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="category-filter" class="form-label fw-bold">
                                <i class="bi bi-tag me-1 text-primary"></i>Kategori
                            </label>
                            <select class="form-select shadow-sm" name="category" id="category-filter">
                                <option value="">Semua Kategori</option>
                                <option value="penting" {{ request('category') == 'penting' ? 'selected' : '' }}>Penting</option>
                                <option value="segera" {{ request('category') == 'segera' ? 'selected' : '' }}>Segera</option>
                                <option value="biasa" {{ request('category') == 'biasa' ? 'selected' : '' }}>Biasa</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="status-filter" class="form-label fw-bold">
                                <i class="bi bi-check-circle me-1 text-primary"></i>Status
                            </label>
                            <select class="form-select shadow-sm" name="status" id="status-filter">
                                <option value="">Semua Status</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
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
                                <input type="text" class="form-control" placeholder="Cari berdasarkan nomor surat, penerima, atau perihal..." 
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
                        @if(request()->has('search') || request()->has('category') || request()->has('status') || request()->has('start_date') || request()->has('end_date'))
                        <a href="{{ route('surat_keluar.index') }}" class="btn btn-outline-danger me-2" id="resetFilter">
                            <i class="bi bi-x-circle me-1"></i> Reset Filter
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

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
                <!-- Pagination Section -->
                <div class="card-footer bg-white">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-0">
                            {{-- Previous Page Link --}}
                            @if ($suratKeluars->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $suratKeluars->previousPageUrl() }}" rel="prev">&laquo;</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($suratKeluars->getUrlRange(1, $suratKeluars->lastPage()) as $page => $url)
                                @if ($page == $suratKeluars->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($suratKeluars->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $suratKeluars->nextPageUrl() }}" rel="next">&raquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">&raquo;</span>
                                </li>
                            @endif
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

    // --- VIEW FUNCTIONALITY ---
    function setupViewButtons() {
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
                        showToast('Error', 'Gagal memuat data surat: ' + error.message, 'bg-danger text-white');
                        viewLoading.classList.add('d-none');
                    });
            });
        });
    }

    // --- PERBAIKAN EDIT FUNCTIONALITY ---
document.addEventListener('DOMContentLoaded', function() {
    setupEditButtons();
});

function setupEditButtons() {
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            // Mencegah perilaku default tombol
            event.preventDefault();
            
            const id = this.getAttribute('data-id');
            const url = this.getAttribute('data-url');
            
            // Tampilkan loading
            showToast('Info', 'Memuat data surat...', 'bg-info text-white');
            
            // Fetch data untuk edit
            fetch(url)
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
                    
                    // Tampilkan modal edit
                    const editModal = new bootstrap.Modal(document.getElementById('editSuratModal'));
                    editModal.show();
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    showToast('Error', 'Gagal memuat data untuk edit: ' + error.message, 'bg-danger text-white');
                });
        });
    });
}

// Fungsi untuk menampilkan toast notification
function showToast(title, message, bgClass) {
    // Periksa apakah elemen toast container sudah ada
    let toastContainer = document.getElementById('toast-container');
    
    if (!toastContainer) {
        // Buat container jika belum ada
        toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        toastContainer.className = 'position-fixed bottom-0 end-0 p-3';
        document.body.appendChild(toastContainer);
    }
    
    // Buat toast element
    const toastId = 'toast-' + Date.now();
    const toastElement = document.createElement('div');
    toastElement.id = toastId;
    toastElement.className = `toast ${bgClass}`;
    toastElement.setAttribute('role', 'alert');
    toastElement.setAttribute('aria-live', 'assertive');
    toastElement.setAttribute('aria-atomic', 'true');
    
    toastElement.innerHTML = `
        <div class="toast-header">
            <strong class="me-auto">${title}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            ${message}
        </div>
    `;
    
    toastContainer.appendChild(toastElement);
    
    // Tampilkan toast
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
    
    // Hapus toast setelah 5 detik
    setTimeout(() => {
        toast.hide();
        setTimeout(() => {
            toastElement.remove();
        }, 500);
    }, 5000);
}

    // --- DELETE FUNCTIONALITY ---
    function setupDeleteButtons() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nomorSurat = this.getAttribute('data-nomor');
                
                // Set form action
                const deleteForm = document.getElementById('deleteForm');
                deleteForm.action = `/surat_keluar/${id}`; 
                
                // Set nomor surat in confirmation text
                document.getElementById('delete-nomor-surat').textContent = nomorSurat || '';
                
                // Show delete modal
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            });
        });
    }

    // Function for formatting dates
    function formatDate(dateString) {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { 
            day: 'numeric', 
            month: 'long', 
            year: 'numeric' 
        });
    }

    // Function untuk apply filter
    function applyFilters() {
        // Buat URL dasar dengan pathname saat ini
        const baseUrl = window.location.pathname;
        loadPageWithFilters(baseUrl);
    }

    // Function untuk load halaman dengan filter
    function loadPageWithFilters(baseUrl) {
        // Pastikan baseUrl adalah URL yang valid
        const url = new URL(baseUrl, window.location.origin);
        
        // Tambahkan parameter filter yang aktif ke URL
        const startDate = document.getElementById('start-date-filter').value;
        const endDate = document.getElementById('end-date-filter').value;
        const categoryFilter = document.getElementById('category-filter').value;
        const statusFilter = document.getElementById('status-filter').value;
        const searchQuery = document.getElementById('search').value;
        
        if (startDate) url.searchParams.set('start_date', startDate);
        if (endDate) url.searchParams.set('end_date', endDate);
        if (categoryFilter) url.searchParams.set('kategori', categoryFilter);
        if (statusFilter) url.searchParams.set('status', statusFilter);
        if (searchQuery) url.searchParams.set('search', searchQuery);
        
        // Tampilkan indikator loading
        const tableBody = document.querySelector('tbody');
        tableBody.innerHTML = `
            <tr>
                <td colspan="8" class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Sedang memuat data...</p>
                </td>
            </tr>
        `;
        
        // Load data dengan AJAX
        fetch(url.toString(), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html, application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            try {
                return response.json();
            } catch (e) {
                // If not JSON, just return the response to handle as HTML
                return response.text().then(text => ({ html: text }));
            }
        })
        .then(data => {
            if (typeof data === 'string') {
                // If data is a string, it's HTML
                window.location.href = url.toString();
                return;
            }
            
            // Handle JSON response
            if (!data.html && typeof data !== 'string') {
                throw new Error('Invalid response format');
            }
            
            // Update tabel dengan data baru
            if (data.html) {
                tableBody.innerHTML = data.html;
            } else {
                window.location.href = url.toString();
                return;
            }
            
            // Update pagination jika ada
            const paginationContainer = document.querySelector('.pagination');
            if (paginationContainer && data.pagination) {
                paginationContainer.innerHTML = data.pagination;
            }
            
            // Update jumlah total records
            const totalRecordsElement = document.getElementById('totalRecords');
            if (totalRecordsElement && data.total !== undefined) {
                totalRecordsElement.textContent = data.total + ' Surat';
            }
            
            // Update URL browser tanpa reload halaman
            window.history.pushState({}, '', url.toString());
            
            // Re-attach event listeners untuk tombol-tombol aksi
            setupViewButtons();
            setupEditButtons();
            setupDeleteButtons();
            
            // Scroll ke atas tabel
            const tableElement = document.querySelector('.table-responsive');
            if (tableElement) {
                window.scrollTo({
                    top: tableElement.offsetTop - 50,
                    behavior: 'smooth'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error', 'Gagal memuat data surat: ' + error.message, 'bg-danger text-white');
            
            // Menampilkan pesan error pada tabel
            tableBody.innerHTML = `
                <tr>
                    <td colspan="8" class="text-center py-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                            <p class="mt-2">Gagal memuat data. Silakan coba lagi.</p>
                            <button class="btn btn-sm btn-primary mt-2" onclick="window.location.reload()">
                                <i class="bi bi-arrow-clockwise me-1"></i> Muat Ulang
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
    }

    // --- IMPROVED PAGINATION HANDLING ---
document.addEventListener('DOMContentLoaded', function() {
    // Setup pagination event delegation for dynamic content
    document.addEventListener('click', function(e) {
        const paginationLink = e.target.closest('.page-link');
        
        if (paginationLink && !paginationLink.parentElement.classList.contains('disabled')) {
            e.preventDefault();
            
            // Get URL from the href attribute
            const pageUrl = paginationLink.getAttribute('href');
            
            if (pageUrl && pageUrl !== '#') {
                // Show loading indicator
                const tableBody = document.querySelector('tbody');
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Sedang memuat data...</p>
                        </td>
                    </tr>
                `;
                
                // Load page with AJAX
                fetch(pageUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json, text/html'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Update table with new data
                    if (data.html) {
                        tableBody.innerHTML = data.html;
                    } else {
                        // If no HTML in response, redirect to the page
                        window.location.href = pageUrl;
                        return;
                    }
                    
                    // Update pagination if available
                    const paginationContainer = document.querySelector('.pagination');
                    if (paginationContainer && data.pagination) {
                        paginationContainer.innerHTML = data.pagination;
                    }
                    
                    // Update total records count
                    const totalRecordsElement = document.getElementById('totalRecords');
                    if (totalRecordsElement && data.total !== undefined) {
                        totalRecordsElement.textContent = data.total + ' Surat';
                    }
                    
                    // Update browser URL without reloading
                    window.history.pushState({}, '', pageUrl);
                    
                    // Re-attach event listeners to the new buttons
                    if (typeof setupViewButtons === 'function') setupViewButtons();
                    if (typeof setupEditButtons === 'function') setupEditButtons();
                    if (typeof setupDeleteButtons === 'function') setupDeleteButtons();
                    
                    // Scroll to top of table
                    const tableElement = document.querySelector('.table-responsive');
                    if (tableElement) {
                        window.scrollTo({
                            top: tableElement.offsetTop - 50,
                            behavior: 'smooth'
                        });
                    }
                    
                    // Show success notification
                    showToast('Sukses', 'Data berhasil diperbarui', 'bg-success text-white');
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error', 'Gagal memuat data: ' + error.message, 'bg-danger text-white');
                    
                    // Show error message in table
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                                    <p class="mt-2">Gagal memuat data. Silakan coba lagi.</p>
                                    <button class="btn btn-sm btn-primary mt-2" onclick="window.location.reload()">
                                        <i class="bi bi-arrow-clockwise me-1"></i> Muat Ulang
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            }
        }
    });
});

// Function for showing toast notifications
function showToast(title, message, bgClass = 'bg-success text-white') {
    // Check if toast container exists
    let toastContainer = document.getElementById('toast-container');
    
    if (!toastContainer) {
        // Create container if it doesn't exist
        toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        toastContainer.className = 'position-fixed bottom-0 end-0 p-3';
        toastContainer.style.zIndex = '1050';
        document.body.appendChild(toastContainer);
    }
    
    // Create toast element
    const toastId = 'toast-' + Date.now();
    const toastElement = document.createElement('div');
    toastElement.id = toastId;
    toastElement.className = `toast ${bgClass}`;
    toastElement.setAttribute('role', 'alert');
    toastElement.setAttribute('aria-live', 'assertive');
    toastElement.setAttribute('aria-atomic', 'true');
    
    toastElement.innerHTML = `
        <div class="toast-header">
            <i class="bi bi-bell me-2"></i>
            <strong class="me-auto">${title}</strong>
            <small>Baru saja</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            ${message}
        </div>
    `;
    
    toastContainer.appendChild(toastElement);
    
    // Show toast using Bootstrap's Toast
    const toast = new bootstrap.Toast(toastElement, {
        delay: 4000
    });
    toast.show();
    
    // Remove toast after it's hidden
    toastElement.addEventListener('hidden.bs.toast', function() {
        toastElement.remove();
    });
}

    // --- FILTER HANDLING ---
     // Setup filter functionality
   const filterForm = document.getElementById('filterForm');
    
    if (filterForm) {
        // Validasi tanggal sebelum submit
        filterForm.addEventListener('submit', function(e) {
            const startDate = document.getElementById('start-date-filter').value;
            const endDate = document.getElementById('end-date-filter').value;
            const categoryFilter = document.getElementById('category-filter').value;
            const statusFilter = document.getElementById('status-filter').value;
            
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
            window.location.href = '{{ route("surat_keluar.index") }}';
        });
    }
    
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
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
                    <style>
                        body { padding: 20px; }
                        @media print {
                            .no-print { display: none; }
                            a[href]::after { content: none !important; }
                        }
                        .print-header {
                            text-align: center;
                            margin-bottom: 30px;
                            padding-bottom: 20px;
                            border-bottom: 2px solid #dee2e6;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="print-header">
                            <h2 class="mb-1">Detail Surat Keluar</h2>
                            <p class="text-muted">Dicetak pada: ${new Date().toLocaleString('id-ID')}</p>
                        </div>
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

    // Initialize all functionality
    setupViewButtons();
    setupEditButtons();
    setupDeleteButtons();
});
</script>
@endsection