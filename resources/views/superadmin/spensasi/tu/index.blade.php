@extends('main')

@section('content')
<div class="container">
    <h1>Daftar Surat Spensasi Menunggu Persetujuan</h1>

    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Detail</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surat as $item)
            <tr>
                <td>{{ $item->nama_siswa }}</td>
                <td>{{ $item->kelas }}</td>
                <td>{{ ucfirst($item->kategori_spensasi) }}</td>
                <td>{{ $item->tanggal_spensasi }}</td>
                <td>{{ $item->detail_spensasi }}</td>
                <td>
                    <form action="{{ route('superadmin.spensasi.tu.approve', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                    </form>
                    <form action="{{ route('superadmin.spensasi.tu.reject', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $surat->links() }}
</div>
@endsection
