@extends('main')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0 rounded-3">
        <!-- Card Header dengan Search dan Filter -->
        <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex align-items-center mb-2 mb-md-0">
                <h4 class="card-title mb-0">
                    <i class="fas fa-archive me-2 text-primary"></i>Arsip Ijazah
                </h4>
            </div>
            
            <div class="d-flex flex-wrap gap-2">
                <!-- Search Form -->
                <form action="{{ route('ijazah.index') }}" method="GET" class="position-relative" id="searchForm">
                    <div class="input-group">
                        <input type="text" 
                               name="search" 
                               id="searchInput"
                               class="form-control" 
                               placeholder="Cari nama/NIS/nomor ijazah..." 
                               value="{{ request('search') }}"
                               style="min-width: 250px;">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <div class="position-absolute top-50 end-0 translate-middle-y pe-4 d-none" id="searchLoading">
                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </form>
                
                <!-- Filter Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-filter me-1"></i> Filter Klapper
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="?filter=all{{ request('search') ? '&search='.request('search') : '' }}">Semua Klapper</a></li>
                        @foreach($availableKlappers as $klapper)
                        <li>
                            <a class="dropdown-item" href="?filter=klapper-{{ $klapper->id }}{{ request('search') ? '&search='.request('search') : '' }}">
                                Angkatan {{ $klapper->tahun_ajaran }}
                                <span class="badge bg-primary float-end">{{ $klapper->ijazahs_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Notifikasi Filter Aktif -->
        @if(request('filter') && request('filter') != 'all' && !request('search'))
        <div class="alert alert-primary alert-dismissible fade show mx-3 mt-3 mb-0" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-filter me-2"></i>
                <div>
                    <strong>Filter Aktif:</strong> 
                    Menampilkan ijazah dari angkatan 
                    <strong>{{ $availableKlappers->firstWhere('id', str_replace('klapper-', '', request('filter')))->tahun_ajaran ?? '' }}</strong>
                    <span class="badge bg-white text-primary ms-2">{{ $ijazahs->total() }} data</span>
                </div>
            </div>
            <a href="{{ route('ijazah.index') }}{{ request('search') ? '?search='.request('search') : '' }}" class="btn-close" aria-label="Close"></a>
        </div>
        @endif

        @if(request('search') && (!request('filter') || request('filter') == 'all'))
        <div class="alert alert-info alert-dismissible fade show mx-3 mt-3 mb-0" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-search me-2"></i>
                <div>
                    <strong>Pencarian:</strong> 
                    Menampilkan hasil untuk "<strong>{{ request('search') }}</strong>"
                    <span class="badge bg-white text-info ms-2">{{ $ijazahs->total() }} hasil</span>
                </div>
            </div>
            <a href="{{ route('ijazah.index') }}{{ request('filter') ? '?filter='.request('filter') : '' }}" class="btn-close" aria-label="Close"></a>
        </div>
        @endif

        @if(request('filter') && request('filter') != 'all' && request('search'))
        <div class="alert alert-secondary alert-dismissible fade show mx-3 mt-3 mb-0" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-funnel me-2"></i>
                <div>
                    <strong>Kombinasi Filter:</strong> 
                    Menampilkan hasil pencarian "<strong>{{ request('search') }}</strong>" 
                    dalam angkatan <strong>{{ $availableKlappers->firstWhere('id', str_replace('klapper-', '', request('filter')))->tahun_ajaran ?? '' }}</strong>
                    <span class="badge bg-white text-secondary ms-2">{{ $ijazahs->total() }} data</span>
                </div>
            </div>
            <a href="{{ route('ijazah.index') }}" class="btn-close" aria-label="Close"></a>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-3 mt-3 mb-0" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3 mb-0" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            Terjadi kesalahan saat menyimpan data. Silakan cek kembali form edit.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Card Body dengan Tabel Data -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Jurusan</th>
                            <th>Klapper</th>
                            <th>Tanggal Lulus</th>
                            <th>Nomor Ijazah</th>
                            <th>File Ijazah</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ijazahs as $ijazah)
                        <tr>
                            <td>{{ ($ijazahs->currentPage()-1) * $ijazahs->perPage() + $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('siswa.show', $ijazah->siswa_id) }}" class="text-dark">
                                    {{ $ijazah->nama_siswa }}
                                    @if($ijazah->siswa->status == 2)
                                        <i class="fas fa-user-slash text-danger ms-1" title="Siswa Keluar"></i>
                                    @endif
                                </a>
                            </td>
                            <td>{{ $ijazah->nis }}</td>
                            <td>
                                <span class="badge 
                                    @if(in_array(strtolower($ijazah->jurusan), ['pplg', 'tjkt'])) bg-info text-dark
                                    @elseif(in_array(strtolower($ijazah->jurusan), ['akl', 'mp'])) bg-warning text-dark
                                    @else bg-secondary text-white @endif">
                                    {{ strtoupper($ijazah->jurusan) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $ijazah->klapper->nama_buku }} ({{ $ijazah->klapper->tahun_ajaran }})
                                </span>
                            </td>
                            <td>{{ $ijazah->tanggal_lulus->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary">
                                    {{ $ijazah->nomor_ijazah }}
                                </span>
                            </td>
                            <td>
                                @if($ijazah->file_path)
                                    <a href="{{ Storage::url($ijazah->file_path) }}" 
                                    target="_blank" class="badge bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-file-pdf me-1"></i> Lihat
                                    </a>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger">Belum Upload</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if($ijazah->file_path)
                                        <a href="{{ route('ijazah.download', $ijazah->id) }}" 
                                           class="btn btn-outline-primary" title="Unduh PDF">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                    @endif
                                    <button class="btn btn-outline-secondary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#uploadModal{{ $ijazah->id }}"
                                            title="Upload Ijazah">
                                        <i class="fas fa-upload"></i>
                                    </button>
                                    <a href="{{ route('ijazah.edit', $ijazah->id) }}" 
                                       class="btn btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                                
                                <!-- Modal Upload -->
                                <div class="modal fade" id="uploadModal{{ $ijazah->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <form action="{{ route('ijazah.upload', $ijazah->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Upload File Ijazah</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="file_ijazah" class="form-label">Pilih File Ijazah (PDF)</label>
                                                        <input type="file" class="form-control" id="file_ijazah" name="file_ijazah" accept=".pdf" required>
                                                        <div class="form-text">Maksimal ukuran file: 5MB</div>
                                                    </div>
                                                    @if($ijazah->file_path)
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle me-2"></i>
                                                        File ijazah sudah ada. Upload baru akan menggantikan file yang lama.
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada arsip ijazah</h5>
                                @if(request('filter') || request('search'))
                                <a href="{{ route('ijazah.index') }}" class="btn btn-sm btn-outline-primary mt-2">
                                    <i class="fas fa-times me-1"></i> Hapus semua filter
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($ijazahs->hasPages())
            <div class="card-footer bg-white">
                {{ $ijazahs->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    const searchLoading = document.getElementById('searchLoading');
    let typingTimer;
    const doneTypingInterval = 500; // 0.5 detik setelah selesai mengetik
    
    // Auto submit form setelah selesai mengetik
    searchInput.addEventListener('input', function() {
        clearTimeout(typingTimer);
        searchLoading.classList.remove('d-none');
        
        typingTimer = setTimeout(() => {
            searchForm.submit();
        }, doneTypingInterval);
    });
    
    // Jika tekan enter, langsung submit
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            clearTimeout(typingTimer);
            searchForm.submit();
        }
    });
    
    // Reset loading indicator saat form submit
    searchForm.addEventListener('submit', function() {
        searchLoading.classList.remove('d-none');
    });
});
</script>
@endsection