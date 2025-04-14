@extends('main')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <div class="text-center mb-4">
            <h2 class="text-dark">Profil Siswa</h2>
        </div>
        <div class="row">
            <div class="col-md-4 text-center">
                @if ($siswa->foto)
                    <img src="{{ asset('image/' . $siswa->foto) }}" alt="Foto {{ $siswa->nama_siswa }}" class="img-thumbnail rounded-circle" style="max-width: 180px;">
                @else
                    <img src="{{ asset('image/default.jpg') }}" alt="Foto Default" class="img-thumbnail rounded-circle" style="max-width: 180px;">
                @endif
                <div class="mt-3">
                    @if ($siswa->status != 1 && $siswa->status != 2)
                        <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                    @endif
                </div>
                <div class="mt-2">
                    <a href="{{ route('klapper.siswa', $siswa->klapper_id) }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr><th class="bg-light">Nama Siswa</th><td>{{ $siswa->nama_siswa }}</td></tr>
                            <tr><th class="bg-light">NIS</th><td>{{ $siswa->nis }}</td></tr>
                            <tr><th class="bg-light">NISN</th><td>{{ $siswa->nisn }}</td></tr>
                            <tr><th class="bg-light">Tempat, Tanggal Lahir</th><td>{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM YYYY') }}</td></tr>
                            <tr><th class="bg-light">Jenis Kelamin</th><td>{{ $siswa->gender }}</td></tr>
                            <tr><th class="bg-light">Kelas</th><td>{{ $siswa->kelas }}</td></tr>
                            <tr><th class="bg-light">Jurusan</th><td>{{ $siswa->jurusan }}</td></tr>
                            <tr><th class="bg-light">Nama Ibu</th><td>{{ $siswa->nama_ibu }}</td></tr>
                            <tr><th class="bg-light">Nama Ayah</th><td>{{ $siswa->nama_ayah }}</td></tr>
                            <tr><th class="bg-light">Tanggal Masuk</th><td>{{ \Carbon\Carbon::parse($siswa->tanggal_masuk)->isoFormat('D MMMM YYYY') }}</td></tr>
                            <tr><th class="bg-light">Naik Kelas XI</th><td>{{ $siswa->tanggal_naik_kelas_xi ? \Carbon\Carbon::parse($siswa->tanggal_naik_kelas_xi)->isoFormat('D MMMM YYYY') : '-' }}</td></tr>
                            <tr><th class="bg-light">Naik Kelas XII</th><td>{{ $siswa->tanggal_naik_kelas_xii ? \Carbon\Carbon::parse($siswa->tanggal_naik_kelas_xii)->isoFormat('D MMMM YYYY') : '-' }}</td></tr>
                            <tr><th class="bg-light">Tanggal Lulus</th><td>{{ $siswa->tanggal_lulus ? \Carbon\Carbon::parse($siswa->tanggal_lulus)->isoFormat('D MMMM YYYY') : '-' }}</td></tr>
                            <tr><th class="bg-light">Tanggal Keluar</th><td>{{ $siswa->tanggal_keluar ? \Carbon\Carbon::parse($siswa->tanggal_keluar)->isoFormat('D MMMM YYYY') : '-' }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection