@extends('main')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">
                <i class="fas fa-archive me-2 text-primary"></i>Arsip Ijazah
            </h4>
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-filter me-1"></i> Filter Klapper
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="?filter=all">Semua Klapper</a></li>
                    @foreach($availableKlappers as $klapper)
                    <li>
                        <a class="dropdown-item" href="?filter=klapper-{{ $klapper->id }}">
                            Angkatan {{ $klapper->tahun_ajaran }}
                            <span class="badge bg-primary float-end">{{ $klapper->ijazahs_count }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
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
@endsection