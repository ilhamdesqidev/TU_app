@extends('main')

@section('content')
<h2>Data Ijazah Angkatan {{ $angkatan->nama }}</h2>

<a href="{{ route('ijazah.create', $angkatan->id) }}" class="btn btn-primary mb-3">Tambah Ijazah</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Tahun Lulus</th>
            <th>Nomor Ijazah</th>
            <th>File</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($ijazahs as $ijazah)
        <tr>
            <td>{{ $ijazah->nis }}</td>
            <td>{{ $ijazah->nama_siswa }}</td>
            <td>{{ $ijazah->tahun_lulus }}</td>
            <td>{{ $ijazah->nomor_ijazah }}</td>
            <td>
                @if ($ijazah->file_ijazah)
                    <a href="{{ route('ijazah.download', $ijazah->id) }}" class="btn btn-sm btn-success">Download</a>
                @else
                    <span class="text-muted">Tidak ada file</span>
                @endif
            </td>
            <td>
                <a href="{{ route('ijazah.edit', $ijazah->id) }}" class="btn btn-sm btn-warning">Edit</a>
            </td>
        </tr>
        @empty
        <tr><td colspan="6">Belum ada data ijazah untuk angkatan ini.</td></tr>
        @endforelse
    </tbody>
</table>

@if($klapper)
    <a href="{{ route('ijazah.perAngkatan', $klapper->id) }}" class="btn btn-secondary">Kembali ke Daftar Ijazah Angkatan</a>
@else
    <a href="{{ route('ijazah.index') }}" class="btn btn-secondary">Kembali ke Daftar Ijazah</a>
@endif


@endsection
