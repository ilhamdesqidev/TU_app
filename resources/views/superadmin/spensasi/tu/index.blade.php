@extends('main')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="row my-4">
        <div class="col-lg-6 col-md-8 mx-auto text-center">
            <h1 class="fw-bold mb-2">
                <i class="fas fa-clipboard-check me-2"></i>Persetujuan Surat Spensasi
            </h1>
            <p class="text-muted mb-2">Daftar surat spensasi yang memerlukan persetujuan</p>
            <div class="d-flex justify-content-center">
                <div class="border-bottom border-primary" style="width: 50px; height: 3px;"></div>
            </div>
        </div>
    </div>

    <!-- Alert Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Tabel Data -->
    <div class="card shadow rounded border-0 mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Periode Spensasi</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($surat as $item)
                        <tr>
                            <td>{{ $item->nama_siswa }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>
                                <span class="badge bg-primary">{{ ucfirst($item->kategori_spensasi) }}</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_spensasi)->translatedFormat('d F Y') }}</td>
                            <td>
                                <small class="d-block">Mulai: {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y H:i') }}</small>
                                <small class="d-block">Selesai: {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y H:i') }}</small>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                    <i class="fas fa-eye"></i> Lihat
                                </button>
                                
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
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <form action="{{ route('superadmin.spensasi.tu.approve', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm"
                                            onclick="return confirm('Yakin ingin menyetujui surat ini?')">
                                            <i class="fas fa-check me-1"></i> Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('superadmin.spensasi.tu.reject', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menolak surat ini?')">
                                            <i class="fas fa-times me-1"></i> Tolak
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Tidak ada surat yang menunggu persetujuan</h5>
                                </div>
                            </td>
                        </tr>
                        @endforelse
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

    .modal-body {
        white-space: pre-line;
    }

    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        h1 {
            font-size: 24px;
        }
        
        .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
    }
</style>
@endsection