@extends('main')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="row my-4">
        <div class="col-lg-6 col-md-8 mx-auto text-center">
            <h1 class="fw-bold mb-2">Surat Spensasi Disetujui</h1>
            <p class="text-muted mb-2">Daftar surat spensasi yang telah disetujui</p>
            <div class="d-flex justify-content-center">
                <div class="border-bottom border-primary" style="width: 50px; height: 3px;"></div>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="card shadow rounded border-0 mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Mulai Spensasi</th>
                            <th>Selesai Spensasi</th>
                            <th>Detail</th>
                            <th>Status</th>
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
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y H:i') }}</td>
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
                                @if (\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($item->tanggal_selesai)))
                                    <span class="badge bg-secondary">Kadaluarsa</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-3 text-muted">Belum ada data spensasi yang disetujui</td>
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
    }
</style>
@endsection