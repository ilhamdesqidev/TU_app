@extends('main')

@section('content')
<!-- Alert Message - Positioned at top right with better styling -->
@if (session('status'))
<div class="position-fixed top-0 end-0 p-2" style="z-index: 1100; max-width: 400px;">
    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000">
        <div class="toast-header bg-success text-white">
            <strong class="me-auto"><i class="fas fa-check-circle me-1"></i>Berhasil</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-white">
            {{ session('status') }}
        </div>
    </div>
</div>
@endif

@if ($errors->any()))
<div class="position-fixed top-0 end-0 p-2" style="z-index: 1100; max-width: 400px;">
    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="8000">
        <div class="toast-header bg-danger text-white">
            <strong class="me-auto"><i class="fas fa-exclamation-circle me-1"></i>Error</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-white">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

<div class="container py-4">
    <!-- Tab Content -->
    <div class="tab-content" id="data-tabs-content">
        <!-- KLAPPER TAB CONTENT -->
        <div class="tab-pane fade show active" id="klapper-content" role="tabpanel" aria-labelledby="klapper-tab">
            <div class="card border-0 shadow-sm rounded-4 mb-2">
                <div class="card-body p-3">
                    <!-- Header Section - Modified -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                        <div>
                            <h2 class="fw-bold mb-1 text-primary">
                                <i class="fas fa-book-open me-1"></i>Klapper Siswa
                            </h2>
                            <p class="text-muted mb-0">Manajemen data klapper siswa SMK Amaliah</p>
                        </div>
                    </div>

                    <!-- Filter Controls - Modified -->
                    <div class="row g-2 mb-3">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" id="searchSiswa" placeholder="Cari berdasarkan tahun ajaran...">
                                <button class="btn btn-outline-secondary" type="button" id="clearSearchSiswa">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="d-flex justify-content-end gap-2">
                                <div class="btn-group" id="student-view-toggle">
                                    <button class="btn btn-outline-primary active" id="student-grid-btn">
                                        <i class="fas fa-th"></i>
                                    </button>
                                    <button class="btn btn-outline-primary" id="student-list-btn">
                                        <i class="fas fa-list"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Grid View for Students -->
                    <div class="row g-2" id="student-grid-view">
                        @foreach ($klapper as $item)
                        <div class="col-xl-3 col-lg-4 col-md-6 student-item" data-tahun="{{ $item->tahun_ajaran }}">
                            <div class="card h-100 rounded-4 border-0 shadow-sm" 
                                 onclick="window.location='{{ url('klapper/' . $item->id) }}'" 
                                 role="button">
                                <div class="card-body p-2">
                                    <div class="d-flex align-items-center mb-1">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2">
                                            <i class="fas fa-book-open text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-0 text-truncate">{{ $item->nama_buku }}</h6>
                                            <div class="d-flex align-items-center mt-1">
                                                <i class="fas fa-calendar-alt text-muted me-1 small"></i>
                                                <span class="text-muted small">{{ $item->tahun_ajaran }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1">
                                            <i class="fas fa-user-graduate me-1"></i> Siswa
                                        </span>
                                        <div class="dropdown klapper-actions">
                                            <button class="btn btn-sm btn-light rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="event.stopPropagation()">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="{{ url('klapper/' . $item->id) }}"><i class="fas fa-eye me-1 text-primary"></i>Lihat Detail</a></li>
                                                <li><a class="dropdown-item" href="{{ url('klapper/' . $item->id . '/edit') }}"><i class="fas fa-edit me-1 text-warning"></i>Edit</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $item->id }}, event)"><i class="fas fa-trash-alt me-1"></i>Hapus</a></li>
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
                                        <th scope="col" class="rounded-start-3 py-1">#</th>
                                        <th scope="col" class="py-1">Nama Buku</th>
                                        <th scope="col" class="py-1">Tahun Ajaran</th>
                                        <th scope="col" class="py-1">Kategori</th>
                                        <th scope="col" class="text-end rounded-end-3 py-1">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($klapper as $index => $item)
                                    <tr class="student-item" data-tahun="{{ $item->tahun_ajaran }}">
                                        <td class="py-1">{{ $index + 1 }}</td>
                                        <td class="py-1">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2">
                                                    <i class="fas fa-book-open text-primary"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-0">{{ $item->nama_buku }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-1">{{ $item->tahun_ajaran }}</td>
                                        <td class="py-1">
                                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1">
                                                <i class="fas fa-user-graduate me-1"></i> Siswa
                                            </span>
                                        </td>
                                        <td class="py-1">
                                            <div class="d-flex justify-content-end gap-1">
                                                <a href="{{ url('klapper/' . $item->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                                    <i class="fas fa-eye me-1"></i> Detail
                                                </a>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="{{ url('klapper/' . $item->id . '/edit') }}"><i class="fas fa-edit me-1 text-warning"></i>Edit</a></li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $item->id }}, event)"><i class="fas fa-trash-alt me-1"></i>Hapus</a></li>
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
                    <div class="text-center py-3">
                        <div class="mb-2">
                            <i class="fas fa-book-open text-muted opacity-25 fa-4x"></i>
                        </div>
                        <h5 class="fw-bold text-muted mb-1">Belum Ada Data Klapper Siswa</h5>
                        <p class="text-muted mb-2">Silakan tambahkan data klapper baru untuk mulai mengelola data siswa</p>
                        <a href="{{ url('klapper/create') }}" class="btn btn-primary rounded-pill px-4 py-1">
                            <i class="fas fa-plus me-1"></i> Tambah Klapper Baru
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
            <div class="modal-header border-0 pb-1">
                <h5 class="modal-title fw-bold" id="confirmationModalLabel">
                    <i class="fas fa-exclamation-triangle text-warning me-1"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-2">
                <div class="rounded-circle bg-warning bg-opacity-10 p-2 mx-auto mb-2" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-exclamation-triangle text-warning fa-2x"></i>
                </div>
                <h5 class="fw-bold mb-1">Apakah Anda yakin?</h5>
                <p class="text-muted mb-1">Data yang dihapus tidak dapat dikembalikan lagi.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center pt-1 pb-3">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-3 me-2" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form id="deleteForm" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-3">
                        <i class="fas fa-trash-alt me-1"></i>Hapus Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button -->
<div class="position-fixed bottom-0 end-0 m-3">
    <div class="dropup">
        <button class="btn btn-primary rounded-circle shadow" type="button" id="quickAddBtn" data-bs-toggle="dropdown" aria-expanded="false" style="width: 48px; height: 48px;">
            <i class="fas fa-plus"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end mb-1 border-0 shadow" aria-labelledby="quickAddBtn">
            <li>
                <h6 class="dropdown-header text-primary fw-bold">
                    <i class="fas fa-plus-circle me-1"></i>Tambah Data Baru
                </h6>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item py-1" href="{{ url('klapper/create') }}">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-1 me-2">
                            <i class="fas fa-user-graduate text-primary"></i>
                        </div>
                        <div>
                            <span class="fw-semibold">Tambah Klapper</span>
                            <p class="text-muted small mb-0">Buat data siswa baru</p>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- JavaScript for functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all toasts
    const toastElList = [].slice.call(document.querySelectorAll('.toast'))
    const toastList = toastElList.map(function(toastEl) {
        return new bootstrap.Toast(toastEl)
    })
    
    // Auto hide toasts after delay
    toastList.forEach(toast => {
        const delay = toast._element.dataset.bsDelay || 5000
        setTimeout(() => {
            toast.hide()
        }, delay)
    })

    // Student view toggle - Fixed functionality
    const studentGridBtn = document.getElementById('student-grid-btn')
    const studentListBtn = document.getElementById('student-list-btn')
    const studentGridView = document.getElementById('student-grid-view')
    const studentListView = document.getElementById('student-list-view')
    
    const switchView = (view) => {
        if (view === 'grid') {
            studentGridView.style.display = 'flex'
            studentListView.style.display = 'none'
            studentGridBtn.classList.add('active')
            studentListBtn.classList.remove('active')
        } else {
            studentGridView.style.display = 'none'
            studentListView.style.display = 'block'
            studentListBtn.classList.add('active')
            studentGridBtn.classList.remove('active')
        }
        localStorage.setItem('studentViewPreference', view)
    }
    
    studentGridBtn.addEventListener('click', () => switchView('grid'))
    studentListBtn.addEventListener('click', () => switchView('list'))
    
    // Load saved student view
    const studentViewPref = localStorage.getItem('studentViewPreference') || 'grid'
    switchView(studentViewPref)

    // Improved search functionality with debounce
    const searchSiswa = document.getElementById('searchSiswa')
    const clearSearchSiswa = document.getElementById('clearSearchSiswa')
    
    const debounce = (func, delay) => {
        let timeoutId
        return function() {
            clearTimeout(timeoutId)
            timeoutId = setTimeout(() => {
                func.apply(this, arguments)
            }, delay)
        }
    }
    
    const filterStudents = () => {
        const searchValue = searchSiswa.value.toLowerCase()
        const studentItems = document.querySelectorAll('.student-item')
        
        studentItems.forEach(item => {
            const text = item.textContent.toLowerCase()
            if (studentViewPref === 'grid') {
                item.style.display = text.includes(searchValue) ? '' : 'none'
            } else {
                item.style.display = text.includes(searchValue) ? 'table-row' : 'none'
            }
        })
    }
    
    searchSiswa.addEventListener('input', debounce(filterStudents, 300))
    
    clearSearchSiswa.addEventListener('click', () => {
        searchSiswa.value = ''
        filterStudents()
        searchSiswa.focus()
    })

    // Delete confirmation
    window.confirmDelete = function(id, event) {
        event.preventDefault()
        event.stopPropagation()
        document.getElementById('deleteForm').action = `klapper/${id}`
        new bootstrap.Modal(document.getElementById('confirmationModal')).show()
    }
    
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
})
</script>
@endsection