@extends('main')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-0 text-gray-800">Arsip Surat Keluar</h1>
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
                                <option value="draft">Draft</option>
                                <option value="dikirim">Dikirim</option>
                                <option value="diterima">Diterima</option>
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
                                    <th scope="col">Penerima</th>
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
                                    <td>SK-2025/004</td>
                                    <td>27 Apr 2025</td>
                                    <td>Dinas Kesehatan</td>
                                    <td>Laporan Pelaksanaan Program Kesehatan Sekolah</td>
                                    <td><span class="badge bg-warning text-dark">Penting</span></td>
                                    <td><span class="badge bg-info">Dikirim</span></td>
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
                                    <td>SK-2025/003</td>
                                    <td>22 Apr 2025</td>
                                    <td>Badan Keuangan Daerah</td>
                                    <td>Pengajuan Anggaran Kegiatan Triwulan III</td>
                                    <td><span class="badge bg-danger">Segera</span></td>
                                    <td><span class="badge bg-success">Diterima</span></td>
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
                                    <td>SK-2025/002</td>
                                    <td>18 Apr 2025</td>
                                    <td>PT Mitra Sejahtera</td>
                                    <td>Konfirmasi Kerjasama Pengadaan Peralatan</td>
                                    <td><span class="badge bg-secondary">Biasa</span></td>
                                    <td><span class="badge bg-warning text-dark">Draft</span></td>
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
                <h5 class="modal-title" id="viewModalLabel">Detail Surat Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Nomor Surat:</strong></p>
                        <p>SK-2025/004</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Tanggal Surat:</strong></p>
                        <p>27 April 2025</p>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Penerima:</strong></p>
                        <p>Dinas Kesehatan</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Tanggal Pengiriman:</strong></p>
                        <p>27 April 2025</p>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Kategori:</strong></p>
                        <p><span class="badge bg-warning text-dark">Penting</span></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Status:</strong></p>
                        <p><span class="badge bg-info">Dikirim</span></p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <p class="mb-1"><strong>Perihal:</strong></p>
                    <p>Laporan Pelaksanaan Program Kesehatan Sekolah</p>
                </div>
                
                <div class="mb-4">
                    <p class="mb-1"><strong>Isi Surat:</strong></p>
                    <div class="p-3 bg-light rounded">
                        <p>
                            Dengan hormat,<br><br>
                            Bersama ini kami sampaikan laporan pelaksanaan Program Kesehatan Sekolah untuk bulan April 2025. Kami telah melaksanakan serangkaian kegiatan meliputi:<br><br>
                            1. Pemeriksaan kesehatan berkala bagi siswa<br>
                            2. Penyuluhan gizi seimbang<br>
                            3. Vaksinasi lanjutan<br>
                            4. Sanitasi lingkungan sekolah<br><br>
                            Adapun hasil dari kegiatan tersebut dapat dilihat pada lampiran. Mohon untuk dapat ditindaklanjuti dan dijadikan bahan evaluasi bersama.
                        </p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <p class="mb-1"><strong>Tanda Tangan Elektronik:</strong></p>
                    <div class="p-3 bg-light rounded">
                        <p>
                            <strong>Ditandatangani oleh:</strong> Drs. Budi Setiawan, M.Pd<br>
                            <strong>Jabatan:</strong> Kepala Sekolah<br>
                            <strong>Tanggal:</strong> 27 April 2025<br>
                            <strong>ID Verifikasi:</strong> #1234-5678-ABCD-EFGH
                        </p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <p class="mb-1"><strong>Lampiran:</strong></p>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                                <a href="#">Laporan_Program_Kesehatan_April.pdf</a>
                            </div>
                            <span class="text-muted small">3.2 MB</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-file-earmark-excel text-success me-2"></i>
                                <a href="#">Data_Statistik_Kesehatan.xlsx</a>
                            </div>
                            <span class="text-muted small">1.5 MB</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-file-earmark-image text-primary me-2"></i>
                                <a href="#">Dokumentasi_Kegiatan.zip</a>
                            </div>
                            <span class="text-muted small">8.7 MB</span>
                        </li>
                    </ul>
                </div>
                
                <div class="mb-4">
                    <p class="mb-1"><strong>Riwayat Pengiriman:</strong></p>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Dikirim melalui email
                            </div>
                            <span class="text-muted small">27 Apr 2025, 10:15</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Dikirim melalui pos
                            </div>
                            <span class="text-muted small">27 Apr 2025, 11:30</span>
                        </li>
                    </ul>
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
                <h5 class="modal-title" id="formModalLabel">Tambah Surat Keluar</h5>
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
                            <label for="penerima" class="form-label">Penerima</label>
                            <input type="text" class="form-control" id="penerima" name="penerima">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_pengiriman" class="form-label">Tanggal Pengiriman</label>
                            <input type="date" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman">
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
                                <option value="draft">Draft</option>
                                <option value="dikirim">Dikirim</option>
                                <option value="diterima">Diterima</option>
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
                        <label class="form-label">Penandatangan</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="penandatangan" class="form-label">Nama Penandatangan</label>
                                <select class="form-select" id="penandatangan" name="penandatangan">
                                    <option value="">Pilih Penandatangan</option>
                                    <option value="kepala_sekolah">Kepala Sekolah</option>
                                    <option value="wakil_kepala">Wakil Kepala Sekolah</option>
                                    <option value="sekretaris">Sekretaris</option>
                                    <option value="bendahara">Bendahara</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="metode_pengiriman" class="form-label">Metode Pengiriman</label>
                                <select class="form-select" id="metode_pengiriman" name="metode_pengiriman">
                                    <option value="email">Email</option>
                                    <option value="pos">Pos</option>
                                    <option value="kurir">Kurir</option>
                                    <option value="langsung">Diserahkan Langsung</option>
                                </select>
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
                <p>Apakah Anda yakin ingin menghapus surat dengan nomor <strong>SK-2025/004</strong>?</p>
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
                modalTitle.textContent = 'Edit Surat Keluar';
                // Here you would normally pre-fill the form with the selected item's data
            } else {
                modalTitle.textContent = 'Tambah Surat Keluar';
                // Clear the form
                this.querySelector('form').reset();
            }
        });
    }
});
</script>
@endsection