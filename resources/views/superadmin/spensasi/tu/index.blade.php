@extends('main')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">📄 Surat Spensasi Menunggu Persetujuan</h1>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
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
                            <span class="badge bg-primary text-light">
                                {{ ucfirst($item->kategori_spensasi) }}
                            </span>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal_spensasi)->translatedFormat('d F Y') }}
                        </td>
                        <td>{{ $item->detail_spensasi }}</td>
                        <td class="text-center">
                            <form action="{{ route('superadmin.spensasi.tu.approve', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm"
                                    onclick="return confirm('Yakin ingin menyetujui surat ini?')">Setujui</button>
                            </form>
                            <form action="{{ route('superadmin.spensasi.tu.reject', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menolak surat ini?')">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada surat menunggu saat ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $surat->links() }}
    </div>
</div>
@endsection
