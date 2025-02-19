@extends('main')

@section('content')
<div class="bg-light py-3">
    <div class="container">
        <!-- Header Section -->
        <div class="row my-3">
            <div class="col-lg-6 col-md-8 mx-auto text-center">
                <h3 class="fw-bold text-primary mb-2">Koleksi Klapper</h3>
                <p class="text-muted small mb-3">Akses pustaka digital dan materi pembelajaran</p>
                <a href="{{ url('klapper/tambahdataklapper') }}" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Data
                </a>
            </div>
        </div>

        <!-- Alert Message -->
        @if (session('status'))
        <div class="row mb-3">
            <div class="col-lg-6 col-md-8 mx-auto">
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm py-2" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check text-success me-2"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="container py-3">
    <!-- Filter/Search -->
    <div class="row mb-3">
        <div class="col-md-5 mb-2 mb-md-0">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Cari buku...">
            </div>
        </div>
        <div class="col-md-7 text-md-end">
            <div class="btn-group btn-group-sm" id="view-toggle">
                <button class="btn btn-outline-secondary active" id="grid-view-btn">
                    <i class="fas fa-th me-1"></i>Grid
                </button>
                <button class="btn btn-outline-secondary" id="list-view-btn">
                    <i class="fas fa-list me-1"></i>List
                </button>
            </div>
        </div>
    </div>

    <!-- Grid View Content (Default) -->
    <div class="row g-3" id="grid-view">
        @foreach ($klapper as $item)
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 rounded-3 shadow-sm border-0" 
                 onclick="window.location='{{ url('klapper/' . $item->id) }}'" 
                 role="button">
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div class="p-2 me-2 bg-primary bg-opacity-10 rounded-circle">
                            <i class="bx bxs-book text-primary"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">{{ $item->nama_buku }}</h6>
                            <p class="text-muted small mb-0">{{ $item->tahun_ajaran }}</p>
                        </div>
                    </div>
                    
                    <hr class="text-muted opacity-25 my-2">
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-light text-primary small">Klapper</span>
                        <button class="btn btn-sm btn-outline-primary rounded-circle" style="width: 24px; height: 24px; padding: 0; line-height: 24px;">
                            <i class="fas fa-arrow-right small"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Enhanced List View Content (Initially Hidden) -->
    <div class="row" id="list-view" style="display: none;">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="list-group list-group-flush rounded-3">
                    @foreach ($klapper as $item)
                    <a href="{{ url('klapper/' . $item->id) }}" class="list-group-item list-group-item-action p-3 border-bottom">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="bg-primary bg-opacity-10 rounded-3 p-3 text-center">
                                    <i class="bx bxs-book-alt text-primary fs-4"></i>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <h6 class="fw-bold mb-0 text-truncate">{{ $item->nama_buku }}</h6>
                                <div class="d-flex align-items-center mt-1">
                                    <i class="fas fa-calendar-alt text-muted me-1 small"></i>
                                    <span class="text-muted small">{{ $item->tahun_ajaran }}</span>
                                </div>
                            </div>
                            <div class="col-auto ms-auto">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary me-3 px-2 py-1">
                                        Klapper
                                    </span>
                                    <div class="btn btn-outline-primary btn-sm rounded-pill px-2">
                                        Detail <i class="fas fa-chevron-right ms-1 small"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Empty State -->
    @if(count($klapper) == 0)
    <div class="row">
        <div class="col-md-6 mx-auto text-center py-4 my-3">
            <div class="p-3 rounded-3 bg-light">
                <i class="fas fa-books fs-1 text-muted opacity-25 mb-3"></i>
                <h5 class="fw-bold text-muted">Belum Ada Data Klapper</h5>
                <p class="text-muted small mb-3">Silakan tambahkan data baru</p>
                <a href="{{ url('klapper/tambahdataklapper') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="fas fa-plus me-1"></i> Tambah Data
                </a>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- JavaScript untuk fungsi toggle view -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const gridViewBtn = document.getElementById('grid-view-btn');
    const listViewBtn = document.getElementById('list-view-btn');
    const gridView = document.getElementById('grid-view');
    const listView = document.getElementById('list-view');
    
    // Fungsi untuk menampilkan view grid
    gridViewBtn.addEventListener('click', function() {
        gridView.style.display = 'flex';
        listView.style.display = 'none';
        gridViewBtn.classList.add('active');
        listViewBtn.classList.remove('active');
        
        // Simpan preferensi pengguna di localStorage
        localStorage.setItem('klapperViewPreference', 'grid');
    });
    
    // Fungsi untuk menampilkan view list
    listViewBtn.addEventListener('click', function() {
        gridView.style.display = 'none';
        listView.style.display = 'block';
        listViewBtn.classList.add('active');
        gridViewBtn.classList.remove('active');
        
        // Simpan preferensi pengguna di localStorage
        localStorage.setItem('klapperViewPreference', 'list');
    });
    
    // Cek preferensi yang tersimpan
    const savedViewPreference = localStorage.getItem('klapperViewPreference');
    if (savedViewPreference === 'list') {
        listViewBtn.click();
    }
});
</script>
@endsection