@extends('main')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="row my-3">
        <div class="col-lg-6 col-md-8 mx-auto text-center">
            <h3 class="fw-bold text-primary mb-0">Spensasi</h3>
            <p class="text-muted small mb-2">Daftar surat spensasi siswa siswi SMK Amaliah 1 & 2</p>
            <div class="d-flex justify-content-center">
                <div class="border-bottom border-primary" style="width: 50px; height: 3px;"></div>
            </div>
        </div>
    </div>

    <!-- Filter dan Tombol Buat -->
    <div class="mb-3 d-flex justify-content-between align-items-center flex-wrap">
        <form method="GET" action="{{ route('superadmin.spensasi.index') }}" class="d-flex align-items-center gap-2 mb-2 mb-md-0">
            <select name="status" class="form-select">
                <option value="semua" {{ isset($status) && $status == 'semua' ? 'selected' : '' }}>Semua Status</option>
                <option value="menunggu" {{ $status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="disetujui" {{ $status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ $status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="btn btn-outline-primary">Filter</button>
        </form>
        <a href="{{ route('superadmin.spensasi.create') }}" class="btn btn-primary">Buat Surat Spensasi Baru</a>
    </div>

    <!-- Tabel Data -->
<div class="card shadow-sm rounded-3 border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Kategori Spensasi</th>
                        <th>Mata Pelajaran</th>
                        <th>Tanggal</th>
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
                        <td>{{ $item->jam_pelajaran ?? '-' }}</td>
                        <td>{{ $item->tanggal_spensasi }}</td>
                        <td>
                            <span class="badge 
                                {{ $item->status == 'menunggu' ? 'bg-warning' : 
                                   ($item->status == 'disetujui' ? 'bg-success' : 'bg-danger') }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>
                            @if($item->status == 'menunggu')
                                <a href="{{ route('superadmin.spensasi.edit', $item) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('superadmin.spensasi.destroy', $item) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
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
@endsection
