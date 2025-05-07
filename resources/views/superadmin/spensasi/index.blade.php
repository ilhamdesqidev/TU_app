@extends('main')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="row my-4">
        <div class="col-lg-6 col-md-8 mx-auto text-center">
            <h1 class="fw-bold mb-2">Surat Spensasi</h1>
            <p class="text-muted mb-2">Daftar surat spensasi siswa siswi SMK Amaliah 1 & 2</p>
            <div class="d-flex justify-content-center">
                <div class="border-bottom border-primary" style="width: 50px; height: 3px;"></div>
            </div>
        </div>
    </div>

    <!-- Filter dan Tombol Buat -->
    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap">
        <form method="GET" action="{{ route('superadmin.spensasi.index') }}" class="d-flex align-items-center gap-2 mb-2 mb-md-0">
            <select name="status" class="form-select">
                <option value="semua" {{ isset($status) && $status == 'semua' ? 'selected' : '' }}>Semua Status</option>
                <option value="menunggu" {{ $status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="disetujui" {{ $status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ $status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="btn btn-outline-primary">Filter</button>
        </form>
        <a href="{{ route('superadmin.spensasi.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i> Buat Surat Spensasi Baru
        </a>
    </div>

    <!-- Tabel Data -->
    <div class="card shadow rounded border-0 mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Kategori Spensasi</th>
                            <th>Mulai Spensasi</th>
                            <th>Selesai Spensasi</th>
                            <th>Status Kadaluarsa</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($surat as $item)
                        <tr>
                            <td>{{ $item->nama_siswa }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->kategori_spensasi }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y H:i') }}</td>
                            <td>
                                @if (\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($item->tanggal_selesai)))
                                    <span class="badge bg-secondary">Kadaluarsa</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge 
                                    {{ $item->status == 'menunggu' ? 'bg-warning' : 
                                       ($item->status == 'disetujui' ? 'bg-success' : 'bg-danger') }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    @if($item->status == 'menunggu')
                                        <a href="{{ route('superadmin.spensasi.edit', $item) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('superadmin.spensasi.destroy', $item) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger ms-1" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @else
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
    <i class="fas fa-eye"></i> Lihat
</button>

                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        
                        @if(count($surat) == 0)
                        <tr>
                            <td colspan="8" class="text-center py-3 text-muted">Tidak ada data surat spensasi</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $surat->links() }}
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Spensasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <p>{{ $item->detail_spensasi }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
    .container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    h1 {
        color: #333;
        font-weight: 600;
    }

    .card {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .table th {
        font-weight: 600;
    }

    .badge {
        font-weight: 500;
        padding: 5px 10px;
    }

    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        h1 {
            font-size: 24px;
        }
    }
</style>
@endsection