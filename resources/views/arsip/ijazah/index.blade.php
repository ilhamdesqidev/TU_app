@extends('main')

@section('content')
<div class="container py-4">
    <div class="card">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="mb-0">
                <i class="fas fa-archive me-2"></i>Arsip Ijazah
            </h4>
            
            <div class="d-flex gap-2 mt-2 mt-md-0">
                <!-- Pencarian -->
                <form action="{{ route('ijazah.index') }}" method="GET" class="d-flex">
                    <input type="text" 
                           name="search" 
                           class="form-control me-2" 
                           placeholder="Cari nama/NIS/nomor ijazah..." 
                           value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                
                <!-- Filter -->
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?filter=all{{ request('search') ? '&search='.request('search') : '' }}">Semua</a></li>
                        @foreach($availableKlappers as $klapper)
                        <li>
                            <a class="dropdown-item" href="?filter=klapper-{{ $klapper->id }}{{ request('search') ? '&search='.request('search') : '' }}">
                                {{ $klapper->tahun_ajaran }} ({{ $klapper->ijazahs_count }})
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Notifikasi -->
        @if(request('filter') || request('search'))
        <div class="alert alert-info alert-dismissible fade show mx-3 mt-3 mb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    @if(request('search'))
                        Hasil pencarian: <strong>{{ request('search') }}</strong>
                    @endif
                    @if(request('filter') && request('filter') != 'all')
                        - Angkatan: <strong>{{ $availableKlappers->firstWhere('id', str_replace('klapper-', '', request('filter')))->tahun_ajaran ?? '' }}</strong>
                    @endif
                    <span class="badge bg-primary ms-2">{{ $ijazahs->total() }} data</span>
                </div>
                <div>
                    <a href="{{ route('ijazah.index') }}" class="btn btn-sm btn-outline-secondary me-2">Reset</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            </div>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-3 mt-3 mb-0">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
        @endif

        @if($errors->any()))
        <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3 mb-0">
            <i class="fas fa-exclamation-circle me-2"></i>Terjadi kesalahan. Silakan cek kembali.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
        @endif

        <!-- Tabel -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Jurusan</th>
                            <th>Angkatan</th>
                            <th>Tanggal Lulus</th>
                            <th>Nomor Ijazah</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ijazahs as $ijazah)
                        <tr>
                            <td>{{ ($ijazahs->currentPage()-1) * $ijazahs->perPage() + $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('siswa.show', $ijazah->siswa_id) }}" class="text-decoration-none">
                                    {{ $ijazah->nama_siswa }}
                                </a>
                                @if($ijazah->siswa->status == 2)
                                    <i class="fas fa-user-slash text-danger ms-1" title="Siswa Keluar"></i>
                                @endif
                            </td>
                            <td>{{ $ijazah->nis }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ strtoupper($ijazah->jurusan) }}</span>
                            </td>
                            <td>{{ $ijazah->klapper->tahun_ajaran }}</td>
                            <td>{{ $ijazah->tanggal_lulus->format('d/m/Y') }}</td>
                            <td>
                                <code>{{ $ijazah->nomor_ijazah }}</code>
                            </td>
                            <td>
                                @if($ijazah->file_path)
                                    <span class="badge bg-success">Ada</span>
                                @else
                                    <span class="badge bg-danger">Belum</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if($ijazah->file_path)
                                        <a href="{{ Storage::url($ijazah->file_path) }}" 
                                           target="_blank" class="btn btn-outline-primary" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('ijazah.download', $ijazah->id) }}" 
                                           class="btn btn-outline-success" title="Unduh">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endif
                                    <button class="btn btn-outline-secondary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#uploadModal{{ $ijazah->id }}"
                                            title="Unggah">
                                        <i class="fas fa-upload"></i>
                                    </button>
                                    <a href="{{ route('ijazah.edit', $ijazah->id) }}" 
                                       class="btn btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                                
                                <!-- Modal Unggah -->
                                <div class="modal fade" id="uploadModal{{ $ijazah->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('ijazah.upload', $ijazah->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Unggah Ijazah</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">File PDF (Maks 5MB)</label>
                                                        <input type="file" class="form-control" name="file_ijazah" accept=".pdf" required>
                                                    </div>
                                                    @if($ijazah->file_path)
                                                    <div class="alert alert-warning">
                                                        File lama akan diganti dengan file baru.
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Unggah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="fas fa-inbox fa-2x text-muted mb-3"></i>
                                <h5 class="text-muted">Tidak ada data</h5>
                                @if(request('filter') || request('search'))
                                <a href="{{ route('ijazah.index') }}" class="btn btn-outline-primary">
                                    Tampilkan Semua
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($ijazahs->hasPages())
            <div class="card-footer">
                {{ $ijazahs->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Notifikasi akan hilang otomatis setelah 5 detik
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000); // 5000 milidetik = 5 detik
    });
});
</script>
@endsection