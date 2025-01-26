@extends('main')
@section('content')
<div class="container">
    <h1>Daftar Surat Spensasi</h1>
    
    <div class="filter-section">
        <form method="GET" action="{{ route('superadmin.spensasi.index') }}">
            <select name="status">
                <option value="semua" {{ isset($status) && $status == 'semua' ? 'selected' : '' }}>Semua Status</option>
                <option value="menunggu" {{ $status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="disetujui" {{ $status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ $status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit">Filter</button>
        </form>
        <a href="{{ route('superadmin.spensasi.create') }}" class="btn btn-primary">Buat Surat Spensasi Baru</a>
    </div>

    <table class="table">
        <thead>
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
                        <form action="{{ route('superadmin.spensasi.destroy', $item) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $surat->links() }}
</div>
@endsection