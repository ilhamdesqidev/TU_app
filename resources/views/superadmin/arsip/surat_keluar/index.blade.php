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
                            <button type="button" class="btn btn-primary rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#formModal">
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
                                                    data-id="{{ $surat->id }}"
                                                    data-url="{{ route('surat_keluar.show', $surat->id) }}"
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
                                            <button class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#formModal">
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

<!-- Modal Add/Edit Document with improved styling -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="formModalLabel">Tambah Surat Keluar</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4 d-none" id="form-loading">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat form...</p>
                </div>
                
                <form id="suratForm" action="{{ route('surat_keluar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="method-input">
                        <!-- For PUT method when editing -->
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nomor_surat" class="form-label fw-bold">
                                <i class="bi bi-hash text-primary me-1"></i>Nomor Surat
                            </label>
                            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_surat" class="form-label fw-bold">
                                <i class="bi bi-calendar-date text-primary me-1"></i>Tanggal Surat
                            </label>
                            <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="penerima" class="form-label fw-bold">
                                <i class="bi bi-person text-primary me-1"></i>Penerima
                            </label>
                            <input type="text" class="form-control" id="penerima" name="penerima" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_pengiriman" class="form-label fw-bold">
                                <i class="bi bi-send text-primary me-1"></i>Tanggal Pengiriman
                            </label>
                            <input type="date" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="perihal" class="form-label fw-bold">
                            <i class="bi bi-chat-left-text text-primary me-1"></i>Perihal
                        </label>
                        <input type="text" class="form-control" id="perihal" name="perihal" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="isi_surat" class="form-label fw-bold">
                            <i class="bi bi-file-text text-primary me-1"></i>Isi Surat
                        </label>
                        <textarea class="form-control" id="isi_surat" name="isi_surat" rows="5"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="lampiran" class="form-label fw-bold">
                            <i class="bi bi-paperclip text-primary me-1"></i>Lampiran
                        </label>
                        <input class="form-control" type="file" id="lampiran" name="lampiran[]" multiple>
                        <div class="form-text">Format yang didukung: PDF, DOC, XLS, JPG hingga 10MB</div>
                    </div>
                    
                    <div id="lampiran-list" class="mb-3 d-none">
                        <label class="form-label fw-bold">Lampiran Tersedia</label>
                        <div class="border rounded p-3 bg-light">
                            <!-- Existing attachments will be shown here when editing -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="suratForm" class="btn btn-primary">Simpan</button>
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
    const dateFilter = document.getElementById('date-filter');
    const categoryFilter = document.getElementById('category-filter');
    const statusFilter = document.getElementById('status-filter');
    const searchInput = document.getElementById('search');
    const searchBtn = document.getElementById('searchBtn');
    
    function applyFilters() {
        const date = dateFilter.value;
        const category = categoryFilter.value;
        const status = statusFilter.value;
        const search = searchInput.value.toLowerCase();
        
        console.log('Filtering by:', { date, category, status, search });
        
        // In a real application, this would query the database or filter the data
        showToast('Filter Diterapkan', 'Data telah difilter sesuai kriteria.', 'bg-info text-white');
        
        // For demonstration, we'll simulate a loading state
        const tableBody = document.querySelector('tbody');
        tableBody.innerHTML = `
            <tr>
                <td colspan="8" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data...</p>
                </td>
            </tr>
        `;
        
        // After 1 second, restore the original content (in a real app, this would show filtered data)
        setTimeout(() => {
            // This would be replaced with actual filtered data
            tableBody.innerHTML = document.querySelector('tbody').innerHTML;
        }, 1000);
    }
    
    // Add event listeners to filters
    [dateFilter, categoryFilter, statusFilter].forEach(filter => {
        filter.addEventListener('change', applyFilters);
    });
    
    // Add event listener to search button
    searchBtn.addEventListener('click', applyFilters);
    
    // Add event listener to search input (enter key)
    searchInput.addEventListener('keyup', function(event) {
        if (event.key === 'Enter') {
            applyFilters();
        }
    });
    
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
            
            // In a real application, fetch data from server
            // For demonstration, we'll simulate an API call
            setTimeout(() => {
                // This would be an actual fetch in a real application
                // fetch(url).then(res => res.json()).then(data => {...})
                
                // Sample data (in a real app, this would come from the API)
                const sampleData = {
                    nomor_surat: this.getAttribute('data-nomor') || 'SK-2025/001',
                    tanggal_surat: '2025-05-01',
                    perihal: 'Undangan Rapat Koordinasi',
                    penerima: 'PT Mitra Sejahtera',
                    tanggal_pengiriman: '2025-05-03',
                    status: 'Dikirim',
                    isi_surat: 'Dengan hormat,\n\nBersama ini kami mengundang Bapak/Ibu untuk menghadiri Rapat Koordinasi yang akan dilaksanakan pada:\n\nHari/Tanggal: Senin, 10 Mei 2025\nWaktu: 10.00 - 12.00 WIB\nTempat: Ruang Rapat Utama\n\nDemikian undangan ini kami sampaikan. Atas perhatian dan kehadirannya, kami ucapkan terima kasih.',
                    lampiran: [
                        { nama: 'agenda_rapat.pdf', ukuran: '250 KB', tipe: 'pdf' },
                        { nama: 'lokasi_venue.jpg', ukuran: '1.2 MB', tipe: 'jpg' }
                    ]
                };
                
                // Populate modal with data
                document.getElementById('view-nomor-surat').textContent = sampleData.nomor_surat;
                document.getElementById('view-tanggal-surat').textContent = formatDate(sampleData.tanggal_surat);
                document.getElementById('view-perihal').textContent = sampleData.perihal;
                document.getElementById('view-penerima').textContent = sampleData.penerima;
                document.getElementById('view-tanggal-pengiriman').textContent = formatDate(sampleData.tanggal_pengiriman);
                document.getElementById('view-status').innerHTML = `<span class="badge bg-info">${sampleData.status}</span>`;
                document.getElementById('view-isi-surat').textContent = sampleData.isi_surat;
                
                // Populate lampiran
                const lampiranContainer = document.getElementById('view-lampiran');
                lampiranContainer.innerHTML = '';
                
                if (sampleData.lampiran && sampleData.lampiran.length > 0) {
                    sampleData.lampiran.forEach(item => {
                        let icon = 'file-earmark';
                        let bgColor = 'bg-secondary';
                        
                        if (item.tipe === 'pdf') {
                            icon = 'file-earmark-pdf';
                            bgColor = 'bg-danger';
                        } else if (item.tipe === 'jpg' || item.tipe === 'png') {
                            icon = 'file-earmark-image';
                            bgColor = 'bg-primary';
                        } else if (item.tipe === 'doc' || item.tipe === 'docx') {
                            icon = 'file-earmark-word';
                            bgColor = 'bg-info';
                        } else if (item.tipe === 'xls' || item.tipe === 'xlsx') {
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
                            <button class="btn btn-sm btn-link ms-auto" title="Download">
                                <i class="bi bi-download"></i>
                            </button>
                        `;
                        lampiranContainer.appendChild(fileItem);
                    });
                } else {
                    lampiranContainer.innerHTML = '<p class="text-muted mb-0">Tidak ada lampiran</p>';
                }
                
                // Hide loading, show content
                viewLoading.classList.add('d-none');
                viewContent.classList.remove('d-none');
            }, 800);
        });
    });
    
    // Edit button functionality
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const url = this.getAttribute('data-url');
            const formLoading = document.getElementById('form-loading');
            const formModal = document.getElementById('formModal');
            const formTitle = formModal.querySelector('.modal-title');
            
            // Update modal title
            formTitle.textContent = 'Edit Surat Keluar';
            
            // Show loading
            formLoading.classList.remove('d-none');
            
            // Update form action for edit
            const form = document.getElementById('suratForm');
            form.action = url;
            
            // Add method input for PUT request
            const methodInput = document.getElementById('method-input');
            methodInput.innerHTML = '<input type="hidden" name="_method" value="PUT">';
            
            // In a real application, fetch data from server
            // For demonstration, we'll simulate an API call
            setTimeout(() => {
                // Sample data (in a real app, this would come from the API)
                const sampleData = {
                    nomor_surat: 'SK-2025/001',
                    tanggal_surat: '2025-05-01',
                    perihal: 'Undangan Rapat Koordinasi',
                    penerima: 'PT Mitra Sejahtera',
                    tanggal_pengiriman: '2025-05-03',
                    kategori: 'penting',
                    status: 'dikirim',
                    isi_surat: 'Dengan hormat,\n\nBersama ini kami mengundang Bapak/Ibu untuk menghadiri Rapat Koordinasi...',
                    lampiran: [
                        { id: 1, nama: 'agenda_rapat.pdf', ukuran: '250 KB', tipe: 'pdf' },
                        { id: 2, nama: 'lokasi_venue.jpg', ukuran: '1.2 MB', tipe: 'jpg' }
                    ]
                };
                
                // Populate form with data
                document.getElementById('nomor_surat').value = sampleData.nomor_surat;
                document.getElementById('tanggal_surat').value = sampleData.tanggal_surat;
                document.getElementById('perihal').value = sampleData.perihal;
                document.getElementById('penerima').value = sampleData.penerima;
                document.getElementById('tanggal_pengiriman').value = sampleData.tanggal_pengiriman;
                document.getElementById('kategori').value = sampleData.kategori;
                document.getElementById('status').value = sampleData.status;
                document.getElementById('isi_surat').value = sampleData.isi_surat;
                
                // Show existing attachments if any
                const lampiranList = document.getElementById('lampiran-list');
                
                if (sampleData.lampiran && sampleData.lampiran.length > 0) {
                    lampiranList.classList.remove('d-none');
                    const lampiranContainer = lampiranList.querySelector('.border');
                    lampiranContainer.innerHTML = '';
                    
                    sampleData.lampiran.forEach(item => {
                        let icon = 'file-earmark';
                        if (item.tipe === 'pdf') icon = 'file-earmark-pdf';
                        else if (item.tipe === 'jpg' || item.tipe === 'png') icon = 'file-earmark-image';
                        else if (item.tipe === 'doc' || item.tipe === 'docx') icon = 'file-earmark-word';
                        else if (item.tipe === 'xls' || item.tipe === 'xlsx') icon = 'file-earmark-excel';
                        
                        const fileItem = document.createElement('div');
                        fileItem.className = 'd-flex align-items-center mb-2';
                        fileItem.innerHTML = `
                            <i class="bi bi-${icon} me-2 text-primary"></i>
                            <span>${item.nama}</span>
                            <small class="text-muted ms-2">(${item.ukuran})</small>
                            <div class="form-check ms-auto">
                                <input class="form-check-input" type="checkbox" id="keep-file-${item.id}" name="keep_file[]" value="${item.id}" checked>
                                <label class="form-check-label" for="keep-file-${item.id}">Pertahankan</label>
                            </div>
                        `;
                        lampiranContainer.appendChild(fileItem);
                    });
                } else {
                    lampiranList.classList.add('d-none');
                }
                
                // Hide loading
                formLoading.classList.add('d-none');
            }, 800);
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
            document.getElementById('delete-nomor-surat').textContent = nomorSurat || 'SK-2025/001';
        });
    });
    
    // Add new document functionality (reset form)
    document.querySelectorAll('[data-bs-target="#formModal"]').forEach(button => {
        if (!button.classList.contains('edit-btn')) {
            button.addEventListener('click', function() {
                const formModal = document.getElementById('formModal');
                const formTitle = formModal.querySelector('.modal-title');
                
                // Update modal title
                formTitle.textContent = 'Tambah Surat Keluar';
                
                // Reset form
                document.getElementById('suratForm').reset();
                
                // Update form action for create
                const form = document.getElementById('suratForm');
                form.action = "{{ route('surat_keluar.store') }}";
                
                // Remove method input for PUT request
                document.getElementById('method-input').innerHTML = '';
                
                // Hide lampiran list
                document.getElementById('lampiran-list').classList.add('d-none');
            });
        }
    });
    
    // Export button functionality
    document.getElementById('exportBtn').addEventListener('click', function() {
        showToast('Export Dimulai', 'File sedang diproses untuk diunduh.', 'bg-success text-white');
        
        // Simulate export process
        setTimeout(() => {
            // In a real application, this would trigger a file download
            const a = document.createElement('a');
            a.href = '#'; // Would be a real URL in production
            a.download = 'daftar_surat_keluar.xlsx';
            document.body.appendChild(a);
            // a.click(); // Commented out for demo
            document.body.removeChild(a);
            
            showToast('Export Selesai', 'File berhasil diproses dan siap diunduh.', 'bg-success text-white');
        }, 1500);
    });
    
    // Print button functionality
    document.getElementById('print-btn').addEventListener('click', function() {
        showToast('Print Dipersipakan', 'Dokumen sedang disiapkan untuk dicetak', 'bg-info text-white');
        
        // In a real application, this would open a print dialog
        setTimeout(() => {
            // window.print(); // Commented out for demo
            showToast('Print Siap', 'Silahkan cetak dokumen melalui dialog print', 'bg-info text-white');
        }, 800);
    });
    
    // Form submission handler
    document.getElementById('suratForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent actual form submission for demo
        
        // Simulate form submission
        const formModal = bootstrap.Modal.getInstance(document.getElementById('formModal'));
        formModal.hide();
        
        // Show success notification
        const isEdit = this.querySelector('input[name="_method"]') !== null;
        const message = isEdit ? 'Surat berhasil diperbarui.' : 'Surat baru berhasil ditambahkan.';
        showToast('Sukses', message, 'bg-success text-white');
        
        // In a real application, you would submit the form to the server
        // this.submit();
    });
    
    // Delete form submission handler
    document.getElementById('deleteForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent actual form submission for demo
        
        // Close modal
        const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
        deleteModal.hide();
        
        // Show success notification
        showToast('Dihapus', 'Surat berhasil dihapus dari sistem.', 'bg-success text-white');
        
        // In a real application, you would submit the form to the server
        // this.submit();
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
    
    // Show tooltips (optional, requires Bootstrap Tooltip initialization)
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection