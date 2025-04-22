@extends('main')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4 text-center">Daftar Surat Spensasi yang Disetujui</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($surat as $item)
                        <tr>
                            <td>{{ $item->nama_siswa }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ ucfirst($item->kategori_spensasi) }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_spensasi)->translatedFormat('d F Y') }}</td>
                            <td>{{ $item->detail_spensasi }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">Belum ada data spensasi yang disetujui.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $surat->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
