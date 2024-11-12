@extends('main')
<link rel="stylesheet" href="/asset/css/siswa.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('content')
    <section class="home">
        <div class="text">
            {{ $klapper->nama_buku }}
            <h6>{{ $klapper->tahun_ajaran }}</h6>
        </div>

<div class="detail-container">
    <a href="{{ route('siswa.create', $klapper->id) }}" class="btn-tambah">Tambah Data Siswa</a>
    <h3>Daftar Siswa</h3>
    <form action="{{ route('klapper.lulusSemua', $klapper->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn-lulus">Luluskan Semua Pelajar</button>
    </form>
    
    <form action="{{ route('klapper.naikKelasXI', $klapper->id) }}" method="POST" style="display: inline-block;">
        @csrf
        <button type="submit" class="btn-lulus" style="background-color: #17a2b8;">Naik Kelas XI</button>
    </form>

    <form action="{{ route('klapper.naikKelasXII', $klapper->id) }}" method="POST" style="display: inline-block; margin-left: 10px;">
        @csrf
        <button type="submit" class="btn-lulus" style="background-color: #6c757d;">Naik Kelas XII</button>
    </form>
    
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Jurusan</th>
            <th>kelas</th>
            <th>status</th>
            <th>Aksi</th>
        </tr>
        @foreach ($klapper->siswas as $siswa)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>
            <td>{{ $siswa->nama_siswa }}</td>
            <td>{{ $siswa->nis }}</td>
            <td>{{ $siswa->jurusan }}</td>
            <td>{{ $siswa->kelas }}</td>
            <td>
                @if($siswa->status == 0)
                <span class="badge badge-secondary">
                    <i class="fas fa-user-graduate"></i> Pelajar
                </span>
                @elseif($siswa->status == 1)
                <span class="badge badge-success">
                    <i class="fas fa-graduation-cap"></i> Lulus
                </span>
                @else
                <span class="badge badge-danger">
                    <i class="fas fa-arrow-right-from-bracket"></i> Keluar
                </span>
                @endif
            </td>
            <td>
                <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-success"><i class="fa-solid fa-folder-open"></i></a>
                <a href="{{ route('klapper.keluar', $siswa->id) }}" class="btn btn-danger"> <i class="fas fa-arrow-right-from-bracket"></i></a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
