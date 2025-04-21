@extends('main')

@section('content')
<div class="bg-light py-3">
    <div class="container">
        <!-- Header Section with Improved Styling -->
        <div class="row my-3">
            <div class="col-lg-6 col-md-8 mx-auto text-center">
                <h3 class="fw-bold text-primary mb-0">Koleksi Klapper</h3>
                <p class="text-muted small mb-2">Akses data siswa siswi smk amaliah 1&2</p>
                <div class="d-flex justify-content-center">
                    <div class="border-bottom border-primary" style="width: 50px; height: 3px;"></div>
                </div>
            </div>
        </div>

        <!-- Improved Alert Message -->
        @if (session('status'))
        <div class="row mb-3">
            <div class="col-lg-6 col-md-8 mx-auto">
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm py-2" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle text-success me-2"></i>
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
    <!-- Tab Content with Enhanced UI -->
    <div class="tab-content" id="data-tabs-content">
        <!-- KLAPPER TAB CONTENT -->
        <div class="tab-pane fade show active" id="klapper-content" role="tabpanel" aria-labelledby="klapper-tab">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body">
                    <div class="section-header d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="fw-bold mb-0">
                                <i class="fas fa-user-graduate me-2 text-primary"></i>Klapper Siswa
                            </h5>
                            <p class="text-muted small mt-1 mb-0">Menampilkan seluruh data klapper siswa</p>
                        </div>
                        <a href="{{ url('klapper/tambahdataklapper') }}" class="btn btn-primary rounded-pill px-3 shadow-sm">
                            <i class="fas fa-plus me-2"></i> Tambah Klapper
                        </a>
                    </div>

                   <!-- Enhanced Filter Controls - Modified Layout -->
                    <div class="row g-3 mb-4">
                        <div class="col-lg-8 col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchSiswa" placeholder="Cari Angkatan Klapper...">
                                <button class="btn btn-outline-secondary" type="button" id="clearSearchSiswa">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 text-end">
                            <div class="btn-group" id="student-view-toggle">
                                <button class="btn btn-outline-primary active rounded-start-pill" id="student-grid-btn">
                                    <i class="fas fa-th me-2"></i>Grid
                                </button>
                                <button class="btn btn-outline-primary rounded-end-pill" id="student-list-btn">
                                    <i class="fas fa-list me-2"></i>List
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- Redesigned Grid View for Students -->
                    <div class="row g-3" id="student-grid-view">
                        @foreach ($klapper as $item)
                        <div class="col-xl-3 col-lg-4 col-md-6 student-item" data-tahun="{{ $item->tahun_ajaran }}">
                            <div class="card h-100 rounded-4 border-0 shadow-sm hover-card" 
                                    onclick="window.location='{{ url('klapper/' . $item->id) }}'" 
                                    role="button">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                            <i class="fas fa-book-open text-primary fs-5"></i>
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
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 small">
                                            <i class="fas fa-user-graduate me-1"></i> Siswa
                                        </span>
                                        <div class="dropdown klapper-actions">
                                            <button class="btn btn-sm btn-light rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="event.stopPropagation()">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
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

                    <!-- Enhanced List View for Students -->
                    <div id="student-list-view" style="display: none;">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col" width="40%">Nama Buku</th>
                                        <th scope="col" width="20%">Tahun Ajaran</th>
                                        <th scope="col" width="15%">Kategori</th>
                                        <th scope="col" width="20%" class="text-end">Aksi</th>
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
                                                <a href="{{ url('klapper/' . $item->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                    <i class="fas fa-eye me-1"></i> Detail
                                                </a>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
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

                    <!-- Empty State for Students with Animation -->
                    @if(count($klapper) == 0)
                    <div class="empty-state text-center py-5">
                        <div class="empty-state-icon mb-4">
                            <i class="fas fa-book-open text-muted opacity-25 fa-5x"></i>
                        </div>
                        <h5 class="fw-bold text-muted">Belum Ada Data Klapper Siswa</h5>
                        <p class="text-muted mb-4">Silakan tambahkan data klapper baru untuk mulai mengelola data siswa</p>
                        <a href="{{ url('klapper/tambahdataklapper') }}" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
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
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                    <h5 class="fw-bold">Apakah Anda yakin?</h5>
                    <p class="text-muted">Data yang dihapus tidak dapat dikembalikan.</p>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
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

<!-- Floating Action Button for Quick Add -->
<div class="position-fixed bottom-0 end-0 m-4">
    <div class="dropup">
        <button class="btn btn-primary rounded-circle shadow p-3" type="button" id="quickAddBtn" data-bs-toggle="dropdown" aria-expanded="false" style="width: 56px; height: 56px;">
            <i class="fas fa-plus"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="quickAddBtn">
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

<!-- JavaScript for toggling views, search functionality, and remembering tab selection -->
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

    // Enhanced search for students
    const searchSiswa = document.getElementById('searchSiswa');
    const clearSearchSiswa = document.getElementById('clearSearchSiswa');
    
    searchSiswa.addEventListener('keyup', function() {
        filterStudents();
    });
    
    clearSearchSiswa.addEventListener('click', function() {
        searchSiswa.value = '';
        filterStudents();
    });
    
    function filterStudents() {
        const searchValue = searchSiswa.value.toLowerCase();
        const filterTahun = document.getElementById('filterTahunAjaran').value;
        const studentItems = document.querySelectorAll('.student-item');
        let count = 0;
        
        studentItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            const tahun = item.getAttribute('data-tahun');
            const showBySearch = text.includes(searchValue);
            const showByTahun = filterTahun === '' || tahun === filterTahun;
            
            if (showBySearch && showByTahun) {
                item.style.display = '';
                count++;
            } else {
                item.style.display = 'none';
            }
        });
        
        const emptyStateDiv = document.querySelector('#klapper-content .empty-state');
        if (count === 0 && studentItems.length > 0) {
            if (!emptyStateDiv) {
                const noResultsDiv = document.createElement('div');
                noResultsDiv.className = 'empty-state text-center py-4';
                noResultsDiv.innerHTML = `
                    <div class="empty-state-icon mb-3">
                        <i class="fas fa-search text-muted opacity-25 fa-3x"></i>
                    </div>
                    <h5 class="fw-bold text-muted">Tidak Ada Hasil</h5>
                    <p class="text-muted mb-3">Coba ubah filter pencarian Anda</p>
                    <button id="resetFilterSiswa" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="fas fa-redo me-2"></i> Reset Filter
                    </button>
                `;
                
                if (studentGridView.style.display !== 'none') {
                    studentGridView.appendChild(noResultsDiv);
                } else {
                    studentListView.appendChild(noResultsDiv);
                }
                
                document.getElementById('resetFilterSiswa').addEventListener('click', function() {
                    searchSiswa.value = '';
                    document.getElementById('filterTahunAjaran').value = '';
                    filterStudents();
                });
            }
        } else {
            const noResultsDiv = document.querySelector('.empty-state');
            if (noResultsDiv && noResultsDiv.parentNode) {
                noResultsDiv.parentNode.removeChild(noResultsDiv);
            }
        }
    }
    
    const filterTahunAjaran = document.getElementById('filterTahunAjaran');
    filterTahunAjaran.addEventListener('change', function() {
        filterStudents();
    });

    // Delete confirmation
    window.confirmDelete = function(id, event) {
        event.preventDefault();
        event.stopPropagation();
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `{{ url('klapper') }}/${id}`;
        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        modal.show();
    };

    // Export functionality
    document.getElementById('exportDataSiswa').addEventListener('click', function() {
        alert('Export data siswa sedang diproses...');
    });

    // Add CSS for visual styling
    const style = document.createElement('style');
    style.textContent = `
        body {
            background-color: #f8f9fa;
        }
        
        .hover-card {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
            border-color: var(--bs-primary);
        }

        #data-tabs .nav-link {
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.6rem 1.5rem;
        }
        #klapper-tab.active {
            background: linear-gradient(135deg, #3a8ffe 0%, #0062cc 100%);
            box-shadow: 0 4px 10px rgba(58, 143, 254, 0.3);
        }
        #data-tabs .nav-link:not(.active):hover {
            background-color: rgba(0,0,0,0.05);
        }

        .empty-state-icon {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.05); opacity: 0.8; }
            100% { transform: scale(1); opacity: 0.5; }
        }

        .dropdown-menu {
            border-radius: 0.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 0.5rem 0;
        }
        .dropdown-item {
            padding: 0.6rem 1rem;
            transition: background-color 0.2s ease;
        }
        .dropdown-item:hover {
            background-color: rgba(0,0,0,0.05);
        }
        .dropdown-item:active {
            background-color: var(--bs-primary);
        }

        .table {
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }
        .table tr:hover {
            transition: background-color 0.2s ease;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        @media (max-width: 768px) {
            .section-header {
                flex-direction: column;
                align-items: flex-start !important;
            }
            .section-header a {
                margin-top: 1rem;
                align-self: flex-start;
            }
        }

        .form-control, .form-select, .btn {
            font-size: 0.875rem;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }

        #quickAddBtn {
            transition: all 0.3s ease;
        }
        #quickAddBtn:hover {
            transform: rotate(45deg);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2) !important;
        }
    `;
    document.head.appendChild(style);
});
</script>

@endsection