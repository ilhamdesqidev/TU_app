@extends('main')

@section('content')
<div class="bg-light py-4">
    <div class="container">
        <!-- Header Section -->
        <div class="row my-4">
            <div class="col-md-8 mx-auto text-center">
                <h2 class="fw-bold text-primary mb-2">Koleksi Klapper</h2>
                <p class="text-muted">Akses data siswa siswi smk amaliah 1&2</p>
                <div class="d-flex justify-content-center">
                    <div class="border-bottom border-primary" style="width: 50px;"></div>
                </div>
            </div>
        </div>

        <!-- Alert Message -->
        @if (session('status'))
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="container py-4">
    <!-- Tab Content -->
    <div class="tab-content" id="data-tabs-content">
        <!-- KLAPPER TAB CONTENT -->
        <div class="tab-pane fade show active" id="klapper-content" role="tabpanel" aria-labelledby="klapper-tab">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                        <div class="mb-3 mb-md-0">
                            <h4 class="fw-bold mb-1">
                                <i class="fas fa-user-graduate me-2 text-primary"></i>Klapper Siswa
                            </h4>
                            <p class="text-muted mb-0">Menampilkan seluruh data klapper siswa</p>
                        </div>
                        <a href="{{ route('klapper.create') }}" class="btn btn-primary rounded-pill">
                            <i class="fas fa-plus me-2"></i> Tambah Klapper
                        </a>
                    </div>

                    <!-- Filter Controls -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" id="searchSiswa" placeholder="Cari Angkatan Klapper...">
                                <button class="btn btn-outline-secondary" type="button" id="clearSearchSiswa">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="btn-group" id="student-view-toggle">
                                <button class="btn btn-outline-primary active" id="student-grid-btn">
                                    <i class="fas fa-th me-1"></i> Grid
                                </button>
                                <button class="btn btn-outline-primary" id="student-list-btn">
                                    <i class="fas fa-list me-1"></i> List
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Grid View for Students -->
                    <div class="row g-4" id="student-grid-view">
                        @foreach ($klapper as $item)
                        <div class="col-xl-3 col-lg-4 col-md-6 student-item" data-tahun="{{ $item->tahun_ajaran }}">
                            <div class="card h-100 rounded-4 border-0 shadow-sm" 
                                 onclick="window.location='{{ url('klapper/' . $item->id) }}'" 
                                 role="button">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                            <i class="fas fa-book-open text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0 text-truncate">{{ $item->nama_buku }}</h6>
                                            <div class="d-flex align-items-center mt-1">
                                                <i class="fas fa-calendar-alt text-muted me-1 small"></i>
                                                <span class="text-muted small">{{ $item->tahun_ajaran }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                            <i class="fas fa-user-graduate me-1"></i> Siswa
                                        </span>
                                        <div class="dropdown klapper-actions">
                                            <button class="btn btn-sm btn-light rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="event.stopPropagation()">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="{{ url('klapper/' . $item->id) }}"><i class="fas fa-eye me-2 text-primary"></i>Lihat Detail</a></li>
                                                <li><a class="dropdown-item" href="{{ url('klapper/' . $item->id . '/edit') }}"><i class="fas fa-edit me-2 text-warning"></i>Edit</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $item->id }}, event)"><i class="fas fa-trash-alt me-2"></i>Hapus</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- List View for Students -->
                    <div id="student-list-view" style="display: none;">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle bg-white rounded-3">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="rounded-start-3">#</th>
                                        <th scope="col">Nama Buku</th>
                                        <th scope="col">Tahun Ajaran</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col" class="text-end rounded-end-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($klapper as $index => $item)
                                    <tr class="student-item" data-tahun="{{ $item->tahun_ajaran }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                                    <i class="fas fa-book-open text-primary"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-0">{{ $item->nama_buku }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->tahun_ajaran }}</td>
                                        <td>
                                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                                <i class="fas fa-user-graduate me-1"></i> Siswa
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ url('klapper/' . $item->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                                    <i class="fas fa-eye me-1"></i> Detail
                                                </a>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="{{ url('klapper/' . $item->id . '/edit') }}"><i class="fas fa-edit me-2 text-warning"></i>Edit</a></li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $item->id }}, event)"><i class="fas fa-trash-alt me-2"></i>Hapus</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Empty State for Students -->
                    @if(count($klapper) == 0)
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-book-open text-muted opacity-25 fa-5x"></i>
                        </div>
                        <h5 class="fw-bold text-muted mb-3">Belum Ada Data Klapper Siswa</h5>
                        <p class="text-muted mb-4">Silakan tambahkan data klapper baru untuk mulai mengelola data siswa</p>
                        <a href="{{ url('klapper/tambahdataklapper') }}" class="btn btn-primary rounded-pill px-4 py-2">
                            <i class="fas fa-plus me-2"></i> Tambah Klapper Baru
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                <h5 class="fw-bold">Apakah Anda yakin?</h5>
                <p class="text-muted">Data yang dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    Batal
                </button>
                <form id="deleteForm" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button -->
<div class="position-fixed bottom-0 end-0 m-4">
    <div class="dropup">
        <button class="btn btn-primary rounded-circle p-3" type="button" id="quickAddBtn" data-bs-toggle="dropdown" aria-expanded="false" style="width: 56px; height: 56px;">
            <i class="fas fa-plus"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="quickAddBtn">
            <li>
                <h6 class="dropdown-header">Tambah Data Baru</h6>
            </li>
            <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ url('klapper/tambahdataklapper') }}">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2">
                        <i class="fas fa-user-graduate text-primary"></i>
                    </div>
                    <div>
                        <span>Tambah Klapper</span>
                        <p class="text-muted small mb-0">Data siswa baru</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- JavaScript for functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Store the active tab in localStorage
    const saveActiveTab = function(tabId) {
        localStorage.setItem('activeKlapperTab', tabId);
    };

    // Set active tab based on localStorage
    const setActiveTab = function() {
        const activeTab = localStorage.getItem('activeKlapperTab');
        if (activeTab) {
            const tabEl = document.querySelector(`#${activeTab}`);
            if (tabEl) {
                const tab = new bootstrap.Tab(tabEl);
                tab.show();
            }
        }
    };

    // Initialize tabs with Bootstrap
    const tabs = document.querySelectorAll('button[data-bs-toggle="pill"]');
    tabs.forEach(function(tab) {
        tab.addEventListener('shown.bs.tab', function(e) {
            saveActiveTab(e.target.id);
        });
    });

    // Restore active tab when page loads
    setActiveTab();

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
    
    // Load saved student view
    const studentViewPref = localStorage.getItem('studentViewPreference');
    if (studentViewPref === 'list') {
        studentListBtn.click();
    }

    // Search functionality
    const searchSiswa = document.getElementById('searchSiswa');
    const clearSearchSiswa = document.getElementById('clearSearchSiswa');
    
    let searchTimeout;
    searchSiswa.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            filterStudents();
        }, 300);
    });
    
    clearSearchSiswa.addEventListener('click', function() {
        searchSiswa.value = '';
        filterStudents();
    });
    
    function filterStudents() {
        const searchValue = searchSiswa.value.toLowerCase();
        const studentItems = document.querySelectorAll('.student-item');
        let count = 0;
        
        studentItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            const tahun = item.getAttribute('data-tahun');
            const showBySearch = text.includes(searchValue);
            
            if (showBySearch) {
                item.style.display = '';
                count++;
            } else {
                item.style.display = 'none';
            }
        });
        
        handleEmptyState(count, studentItems.length);
    }
    
    function handleEmptyState(count, totalItems) {
        const activeView = document.getElementById('student-grid-view').style.display !== 'none' 
            ? document.getElementById('student-grid-view') 
            : document.getElementById('student-list-view');
        
        // Remove any existing search-empty state first
        const existingEmptyState = document.querySelector('.empty-state.search-empty');
        if (existingEmptyState) {
            existingEmptyState.remove();
        }
        
        if (count === 0 && totalItems > 0) {
            const noResultsDiv = document.createElement('div');
            noResultsDiv.className = 'empty-state search-empty text-center py-4';
            noResultsDiv.innerHTML = `
                <div class="mb-3">
                    <i class="fas fa-search text-muted opacity-25 fa-3x"></i>
                </div>
                <h5 class="fw-bold text-muted">Tidak Ada Hasil</h5>
                <p class="text-muted mb-3">Coba ubah filter pencarian Anda</p>
                <button id="resetFilterSiswa" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="fas fa-redo me-2"></i> Reset Filter
                </button>
            `;
            
            activeView.appendChild(noResultsDiv);
            
            document.getElementById('resetFilterSiswa').addEventListener('click', function() {
                searchSiswa.value = '';
                filterStudents();
            });
        }
    }

    // Delete confirmation
    window.confirmDelete = function(id, event) {
        event.preventDefault();
        event.stopPropagation();
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `klapper/${id}`;
        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        modal.show();
    };
});
</script>
@endsection