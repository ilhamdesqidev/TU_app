@extends('main')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-0 text-gray-800">Arsip Surat Masuk</h1>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
                                <i class="bi bi-plus-circle me-1"></i> Tambah Surat
                            </button>
                            <button type="button" class="btn btn-success">
                                <i class="bi bi-download me-1"></i> Export
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Search Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="date-filter" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="date-filter">
                        </div>
                        <div class="col-md-3">
                            <label for="category-filter" class="form-label">Kategori</label>
                            <select class="form-select" id="category-filter">
                                <option value="">Semua Kategori</option>
                                <option value="penting">Penting</option>
                                <option value="segera">Segera</option>
                                <option value="biasa">Biasa</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="status-filter" class="form-label">Status</label>
                            <select class="form-select" id="status-filter">
                                <option value="">Semua Status</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditunda">Ditunda</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="search" class="form-label">Cari</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" placeholder="Cari surat..." id="search">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nomor Surat</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Pengirim</th>
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example Row 1 -->
                                <tr>
                                    <td>1</td>
                                    <td>SM-2025/004</td>
                                    <td>25 Apr 2025</td>
                                    <td>Dinas Pendidikan</td>
                                    <td>Undangan Rapat Koordinasi Kurikulum</td>
                                    <td><span class="badge bg-warning text-dark">Penting</span></td>
                                    <td><span class="badge bg-info">Diproses</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal" title="Lihat">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#formModal" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-secondary" title="Unduh">
                                                <i class="bi bi-download"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Example Row 2 -->
                                <tr>
                                    <td>2</td>
                                    <td>SM-2025/003</td>
                                    <td>20 Apr 2025</td>
                                    <td>Kementerian Keuangan</td>
                                    <td>Konfirmasi Anggaran Triwulan II</td>
                                    <td><span class="badge bg-danger">Segera</span></td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal" title="Lihat">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#formModal" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-secondary" title="Unduh">
                                                <i class="bi bi-download"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Example Row 3 -->
                                <tr>
                                    <td>3</td>
                                    <td>SM-2025/002</td>
                                    <td>15 Apr 2025</td>
                                    <td>PT Sejahtera Abadi</td>
                                    <td>Penawaran Kerjasama Pengadaan</td>
                                    <td><span class="badge bg-secondary">Biasa</span></td>
                                    <td><span class="badge bg-warning text-dark">Ditunda</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal" title="Lihat">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#formModal" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-secondary" title="Unduh">
                                                <i class="bi bi-download"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="card-footer">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal View Document -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Detail Surat Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Nomor Surat:</strong></p>
                        <p>SM-2025/004</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Tanggal Surat:</strong></p>
                        <p>25 April 2025</p>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Pengirim:</strong></p>
                        <p>Dinas Pendidikan</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Tanggal Diterima:</strong></p>
                        <p>26 April 2025</p>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Kategori:</strong></p>
                        <p><span class="badge bg-warning text-dark">Penting</span></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Status:</strong></p>
                        <p><span class="badge bg-info">Diproses</span></p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <p class="mb-1"><strong>Perihal:</strong></p>
                    <p>Undangan Rapat Koordinasi Kurikulum</p>
                </div>
                
                <div class="mb-4">
                    <p class="mb-1"><strong>Isi Surat:</strong></p>
                    <div class="p-3 bg-light rounded">
                        <p>
                            Dengan hormat,<br><br>
                            Bersama ini kami mengundang Bapak/Ibu untuk menghadiri Rapat Koordinasi terkait Pengembangan Kurikulum yang akan dilaksanakan pada:<br><br>
                            Hari/Tanggal: Senin, 28 April 2025<br>
                            Waktu: 09.00 - 12.00 WIB<br>
                            Tempat: Ruang Rapat Utama Dinas Pendidikan<br><br>
                            Agenda yang akan dibahas adalah terkait implementasi kurikulum baru tahun ajaran 2025/2026. Mohon kehadiran dan partisipasinya.
                        </p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <p class="mb-1"><strong>Lampiran:</strong></p>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                                <a href="#">Dokumen_Rapat_Kurikulum.pdf</a>
                            </div>
                            <span class="text-muted small">2.4 MB</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-file-earmark-excel text-success me-2"></i>
                                <a href="#">Daftar_Peserta.xlsx</a>
                            </div>
                            <span class="text-muted small">1.1 MB</span>
                        </li>
                    </ul>
                </div>
                
                <div class="mb-4">
                    <p class="mb-1"><strong>Disposisi:</strong></p>
                    <div class="p-3 bg-light rounded">
                        <p><strong>Kepada:</strong> Kabid Kurikulum</p>
                        <p><strong>Catatan:</strong> Mohon untuk ditindaklanjuti dan dipersiapkan materi presentasi untuk rapat ini. Koordinasikan dengan tim terkait.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Download Surat</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add/Edit Document -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Tambah Surat Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nomor_surat" class="form-label">Nomor Surat</label>
                            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                            <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pengirim" class="form-label">Pengirim</label>
                            <input type="text" class="form-control" id="pengirim" name="pengirim">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_diterima" class="form-label">Tanggal Diterima</label>
                            <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="penting">Penting</option>
                                <option value="segera">Segera</option>
                                <option value="biasa">Biasa</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditunda">Ditunda</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="perihal" class="form-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal">
                    </div>
                    
                    <div class="mb-3">
                        <label for="isi_surat" class="form-label">Isi Surat</label>
                        <textarea class="form-control" id="isi_surat" name="isi_surat" rows="5"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="lampiran" class="form-label">Lampiran</label>
                        <input class="form-control" type="file" id="lampiran" multiple>
                        <div class="form-text">Format yang didukung: PDF, DOC, XLS, JPG hingga 10MB</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Disposisi</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="disposisi_kepada" class="form-label">Kepada</label>
                                <select class="form-select" id="disposisi_kepada" name="disposisi_kepada">
                                    <option value="">Pilih Penerima</option>
                                    <option value="kabid_kurikulum">Kabid Kurikulum</option>
                                    <option value="kabid_keuangan">Kabid Keuangan</option>
                                    <option value="kabid_umum">Kabid Umum</option>
                                    <option value="sekretaris">Sekretaris</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="disposisi_catatan" class="form-label">Catatan</label>
                                <textarea class="form-control" id="disposisi_catatan" name="disposisi_catatan" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4">
                    <i class="bi bi-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                </div>
                <h5 class="mb-3">Hapus Surat</h5>
                <p>Apakah Anda yakin ingin menghapus surat dengan nomor <strong>SM-2025/004</strong>?</p>
                <p class="text-danger">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<!-- Bootstrap JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JavaScript for additional functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Setup filter functionality
    const dateFilter = document.getElementById('date-filter');
    const categoryFilter = document.getElementById('category-filter');
    const statusFilter = document.getElementById('status-filter');
    const searchInput = document.getElementById('search');
    
    function applyFilters() {
        const date = dateFilter.value;
        const category = categoryFilter.value;
        const status = statusFilter.value;
        const search = searchInput.value.toLowerCase();
        
        console.log('Filtering by:', { date, category, status, search });
        
        // In a real application, this would query the database or filter the data
        // For demonstration, we'll just show an alert
        if (date || category || status || search) {
            alert('Filter applied! In a real application, this would filter the table data.');
        }
    }
    
    // Add event listeners to filters
    [dateFilter, categoryFilter, statusFilter].forEach(filter => {
        filter.addEventListener('change', applyFilters);
    });
    
    // Add event listener to search input
    searchInput.addEventListener('input', function() {
        if (this.value.length >= 3) {
            applyFilters();
        }
    });
    
    // Set modal form title based on button clicked
    const formModal = document.getElementById('formModal');
    if (formModal) {
        formModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const modalTitle = this.querySelector('.modal-title');
            
            if (button.getAttribute('title') === 'Edit') {
                modalTitle.textContent = 'Edit Surat Masuk';
                // Here you would normally pre-fill the form with the selected item's data
            } else {
                modalTitle.textContent = 'Tambah Surat Masuk';
                // Clear the form
                this.querySelector('form').reset();
            }
        });
    }
});
</script>
@endsection