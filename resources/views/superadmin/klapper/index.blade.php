@extends('main')

@section('content')
<div class="bg-light py-3">
    <div class="container">
        <!-- Header Section -->
        <div class="row my-3">
            <div class="col-lg-6 col-md-8 mx-auto text-center">
                <h3 class="fw-bold text-primary mb-2">Koleksi Klapper</h3>
                <p class="text-muted small mb-3">Akses pustaka digital dan materi pembelajaran</p>
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
    <!-- SECTION: KLAPPER SISWA -->
    <div class="section-header d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">
            <i class="fas fa-user-graduate me-2 text-primary"></i>Klapper Siswa
        </h5>
        <a href="{{ url('klapper/tambahdataklapper') }}" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Data Siswa
        </a>
    </div>

    <!-- Filter/Search for Students -->
    <div class="row mb-3">
        <div class="col-md-5 mb-2 mb-md-0">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" id="searchSiswa" placeholder="Cari data siswa...">
            </div>
        </div>
        <div class="col-md-7 text-md-end">
            <div class="btn-group btn-group-sm" id="student-view-toggle">
                <button class="btn btn-outline-secondary active" id="student-grid-btn">
                    <i class="fas fa-th me-1"></i>Grid
                </button>
                <button class="btn btn-outline-secondary" id="student-list-btn">
                    <i class="fas fa-list me-1"></i>List
                </button>
            </div>
        </div>
    </div>

    <!-- Grid View for Students (Default) -->
    <div class="row g-3" id="student-grid-view">
        @foreach ($klapper as $item)
        <div class="col-xl-3 col-lg-4 col-md-6 student-item">
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
                        <span class="badge bg-light text-primary small">Siswa</span>
                        <button class="btn btn-sm btn-outline-primary rounded-circle" style="width: 24px; height: 24px; padding: 0; line-height: 24px;">
                            <i class="fas fa-arrow-right small"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- List View for Students (Initially Hidden) -->
    <div class="row" id="student-list-view" style="display: none;">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="list-group list-group-flush rounded-3">
                    @foreach ($klapper as $item)
                    <a href="{{ url('klapper/' . $item->id) }}" class="list-group-item list-group-item-action p-3 border-bottom student-item">
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
                                        Siswa
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

    <!-- Empty State for Students -->
    @if(count($klapper) == 0)
    <div class="row">
        <div class="col-md-6 mx-auto text-center py-4 my-3">
            <div class="p-3 rounded-3 bg-light">
                <i class="fas fa-user-graduate fs-1 text-muted opacity-25 mb-3"></i>
                <h5 class="fw-bold text-muted">Belum Ada Data Klapper Siswa</h5>
                <p class="text-muted small mb-3">Silakan tambahkan data siswa baru</p>
                <a href="{{ url('klapper/tambahdataklapper') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="fas fa-plus me-1"></i> Tambah Data Siswa
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Spacer between sections -->
    <div class="my-5"></div>

    <!-- SECTION: DATA GURU -->
    <div class="section-header d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">
            <i class="fas fa-chalkboard-teacher me-2 text-success"></i>Data Guru
        </h5>
        <a href="{{ url('klapper/tambahdataguru') }}" class="btn btn-success btn-sm rounded-pill px-3 shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Data Guru
        </a>
    </div>

    <!-- Filter/Search for Teachers -->
    <div class="row mb-3">
        <div class="col-md-5 mb-2 mb-md-0">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" id="searchGuru" placeholder="Cari data guru...">
            </div>
        </div>
        <div class="col-md-7 text-md-end">
            <div class="btn-group btn-group-sm" id="teacher-view-toggle">
                <button class="btn btn-outline-secondary active" id="teacher-grid-btn">
                    <i class="fas fa-th me-1"></i>Grid
                </button>
                <button class="btn btn-outline-secondary" id="teacher-list-btn">
                    <i class="fas fa-list me-1"></i>List
                </button>
            </div>
        </div>
    </div>

    <!-- Grid View for Teachers (Default) -->
    <div class="row g-3" id="teacher-grid-view">
        @foreach ($guru ?? [] as $item)
        <div class="col-xl-3 col-lg-4 col-md-6 teacher-item">
            <div class="card h-100 rounded-3 shadow-sm border-0" 
                    onclick="window.location='{{ url('klapper/guru/' . $item->id) }}'" 
                    role="button">
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div class="p-2 me-2 bg-success bg-opacity-10 rounded-circle">
                            <i class="bx bxs-user text-success"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">{{ $item->nama_guru ?? 'Nama Guru' }}</h6>
                            <p class="text-muted small mb-0">{{ $item->mata_pelajaran ?? 'Mata Pelajaran' }}</p>
                        </div>
                    </div>
                    
                    <hr class="text-muted opacity-25 my-2">
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-light text-success small">Guru</span>
                        <button class="btn btn-sm btn-outline-success rounded-circle" style="width: 24px; height: 24px; padding: 0; line-height: 24px;">
                            <i class="fas fa-arrow-right small"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Example cards for visualization (remove in production) -->
        <div class="col-xl-3 col-lg-4 col-md-6 teacher-item">
            <div class="card h-100 rounded-3 shadow-sm border-0" role="button">
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div class="p-2 me-2 bg-success bg-opacity-10 rounded-circle">
                            <i class="bx bxs-user text-success"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Budi Santoso, S.Pd</h6>
                            <p class="text-muted small mb-0">Matematika</p>
                        </div>
                    </div>
                    
                    <hr class="text-muted opacity-25 my-2">
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-light text-success small">Guru</span>
                        <button class="btn btn-sm btn-outline-success rounded-circle" style="width: 24px; height: 24px; padding: 0; line-height: 24px;">
                            <i class="fas fa-arrow-right small"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-4 col-md-6 teacher-item">
            <div class="card h-100 rounded-3 shadow-sm border-0" role="button">
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div class="p-2 me-2 bg-success bg-opacity-10 rounded-circle">
                            <i class="bx bxs-user text-success"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Siti Rahayu, M.Pd</h6>
                            <p class="text-muted small mb-0">Bahasa Indonesia</p>
                        </div>
                    </div>
                    
                    <hr class="text-muted opacity-25 my-2">
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-light text-success small">Guru</span>
                        <button class="btn btn-sm btn-outline-success rounded-circle" style="width: 24px; height: 24px; padding: 0; line-height: 24px;">
                            <i class="fas fa-arrow-right small"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- List View for Teachers (Initially Hidden) -->
    <div class="row" id="teacher-list-view" style="display: none;">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="list-group list-group-flush rounded-3">
                    <!-- Loop through teacher data (if available) -->
                    @foreach ($guru ?? [] as $item)
                    <a href="{{ url('klapper/guru/' . $item->id) }}" class="list-group-item list-group-item-action p-3 border-bottom teacher-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="bg-success bg-opacity-10 rounded-3 p-3 text-center">
                                    <i class="bx bxs-user text-success fs-4"></i>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <h6 class="fw-bold mb-0 text-truncate">{{ $item->nama_guru }}</h6>
                                <div class="d-flex align-items-center mt-1">
                                    <i class="fas fa-book text-muted me-1 small"></i>
                                    <span class="text-muted small">{{ $item->mata_pelajaran }}</span>
                                </div>
                            </div>
                            <div class="col-auto ms-auto">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-success bg-opacity-10 text-success me-3 px-2 py-1">
                                        Guru
                                    </span>
                                    <div class="btn btn-outline-success btn-sm rounded-pill px-2">
                                        Detail <i class="fas fa-chevron-right ms-1 small"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach

                    <!-- Example items for visualization (remove in production) -->
                    <a href="#" class="list-group-item list-group-item-action p-3 border-bottom teacher-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="bg-success bg-opacity-10 rounded-3 p-3 text-center">
                                    <i class="bx bxs-user text-success fs-4"></i>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <h6 class="fw-bold mb-0 text-truncate">Budi Santoso, S.Pd</h6>
                                <div class="d-flex align-items-center mt-1">
                                    <i class="fas fa-book text-muted me-1 small"></i>
                                    <span class="text-muted small">Matematika</span>
                                </div>
                            </div>
                            <div class="col-auto ms-auto">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-success bg-opacity-10 text-success me-3 px-2 py-1">
                                        Guru
                                    </span>
                                    <div class="btn btn-outline-success btn-sm rounded-pill px-2">
                                        Detail <i class="fas fa-chevron-right ms-1 small"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    
                    <a href="#" class="list-group-item list-group-item-action p-3 border-bottom teacher-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="bg-success bg-opacity-10 rounded-3 p-3 text-center">
                                    <i class="bx bxs-user text-success fs-4"></i>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <h6 class="fw-bold mb-0 text-truncate">Siti Rahayu, M.Pd</h6>
                                <div class="d-flex align-items-center mt-1">
                                    <i class="fas fa-book text-muted me-1 small"></i>
                                    <span class="text-muted small">Bahasa Indonesia</span>
                                </div>
                            </div>
                            <div class="col-auto ms-auto">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-success bg-opacity-10 text-success me-3 px-2 py-1">
                                        Guru
                                    </span>
                                    <div class="btn btn-outline-success btn-sm rounded-pill px-2">
                                        Detail <i class="fas fa-chevron-right ms-1 small"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Empty State for Teachers -->
    @if(empty($guru) || count($guru) == 0)
    <div class="row" id="teacher-empty-state">
        <div class="col-md-6 mx-auto text-center py-4 my-3">
            <div class="p-3 rounded-3 bg-light">
                <i class="fas fa-chalkboard-teacher fs-1 text-muted opacity-25 mb-3"></i>
                <h5 class="fw-bold text-muted">Belum Ada Data Guru</h5>
                <p class="text-muted small mb-3">Silakan tambahkan data guru baru</p>
                <a href="{{ url('klapper/tambahdataguru') }}" class="btn btn-success btn-sm rounded-pill px-3">
                    <i class="fas fa-plus me-1"></i> Tambah Data Guru
                </a>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- JavaScript untuk fungsi toggle view dan search -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Student view toggle
    const studentGridBtn = document.getElementById('student-grid-btn');
    const studentListBtn = document.getElementById('student-list-btn');
    const studentGridView = document.getElementById('student-grid-view');
    const studentListView = document.getElementById('student-list-view');
    
    studentGridBtn.addEventListener('click', function() {
        studentGridView.style.display = 'flex';
        studentListView.style.display = 'none';
        studentGridBtn.classList.add('active');
        studentListBtn.classList.remove('active');
        localStorage.setItem('studentViewPreference', 'grid');
    });
    
    studentListBtn.addEventListener('click', function() {
        studentGridView.style.display = 'none';
        studentListView.style.display = 'block';
        studentListBtn.classList.add('active');
        studentGridBtn.classList.remove('active');
        localStorage.setItem('studentViewPreference', 'list');
    });
    
    // Teacher view toggle
    const teacherGridBtn = document.getElementById('teacher-grid-btn');
    const teacherListBtn = document.getElementById('teacher-list-btn');
    const teacherGridView = document.getElementById('teacher-grid-view');
    const teacherListView = document.getElementById('teacher-list-view');
    
    teacherGridBtn.addEventListener('click', function() {
        teacherGridView.style.display = 'flex';
        teacherListView.style.display = 'none';
        teacherGridBtn.classList.add('active');
        teacherListBtn.classList.remove('active');
        localStorage.setItem('teacherViewPreference', 'grid');
    });
    
    teacherListBtn.addEventListener('click', function() {
        teacherGridView.style.display = 'none';
        teacherListView.style.display = 'block';
        teacherListBtn.classList.add('active');
        teacherGridBtn.classList.remove('active');
        localStorage.setItem('teacherViewPreference', 'list');
    });
    
    // Load saved preferences
    const studentViewPref = localStorage.getItem('studentViewPreference');
    if (studentViewPref === 'list') {
        studentListBtn.click();
    }
    
    const teacherViewPref = localStorage.getItem('teacherViewPreference');
    if (teacherViewPref === 'list') {
        teacherListBtn.click();
    }
    
    // Search functionality for students
    const searchSiswa = document.getElementById('searchSiswa');
    searchSiswa.addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const studentItems = document.querySelectorAll('.student-item');
        
        studentItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(searchValue)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
    
    // Search functionality for teachers
    const searchGuru = document.getElementById('searchGuru');
    searchGuru.addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const teacherItems = document.querySelectorAll('.teacher-item');
        
        teacherItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(searchValue)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
    
    // Add CSS for visual styling
    const style = document.createElement('style');
    style.textContent = `
        .section-header {
            position: relative;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .section-header:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 50px;
            background-color: var(--bs-primary);
        }
        .section-header:nth-of-type(2):after {
            background-color: var(--bs-success);
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection