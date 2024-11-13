@extends('main')
<link rel="stylesheet" href="/asset/css/siswa.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@section('content')
    <section class="home">
        <div class="text">
            {{ $klapper->nama_buku }}
            <h6>{{ $klapper->tahun_ajaran }}</h6>
        </div>
</body>
<div class="detail-container">
    
    
    
    <!-- Daftar siswa terkait klapper -->
    <h1>Data Siswa</h1>
    <div style="display: flex; justify-content: flex-end; gap:10px;">
                <a href="{{ route('siswa.create', $klapper->id) }}" class="btn-lulus"><i class='bx bx-plus-circle'></i></a>

    <form action="{{ route('klapper.lulusSemua', $klapper->id) }}" method="POST">
        @csrf

        <button type="submit" class="btn-lulus">Luluskan Semua Pelajar</button>
    </form>
    
    <form action="{{ route('klapper.naikKelasXI', $klapper->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn-lulus" >Naik Kelas XI</button>
    </form>

    <form action="{{ route('klapper.naikKelasXII', $klapper->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn-lulus" >Naik Kelas XII</button>
    </form>
    </div>

    
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th style="width: 50px; text-align: center;">NO</th>
            <th style="width: 350px;">Nama</th>
            <th>NIS</th>
            <th>Jurusan</th>
            <th>kelas</th>
            <th>status</th>
            <th>Aksi</th>
        </tr>
        @foreach ($klapper->siswas as $siswa)
        <tr>
            <td style="text-align: center;">
                {{ $loop->iteration }}
            </td>
            <td style="text-align: left;">{{ $siswa->nama_siswa }}</td>
            <td>{{ $siswa->nis }}</td>
            <td>{{ strtoupper($siswa->jurusan) }}</td>
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
                <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-success">
                    <i class="fa-solid fa-folder-open"></i>
                </a>
                
                @if($siswa->status == 0) <!-- Tampilkan tombol "Keluar" hanya jika statusnya Pelajar -->
                    <a href="{{ route('klapper.keluar', $siswa->id) }}" class="btn btn-danger">
                        <i class="fas fa-arrow-right-from-bracket"></i>
                    </a>
                @endif

                @if($siswa->status == 0) <!-- Tampilkan tombol "Naik Kelas" hanya jika statusnya Pelajar -->
                    <form action="{{ route('klapper.naikKelasXI', $klapper->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning">Naik Kelas XI</button>
                    </form>
                    <form action="{{ route('klapper.naikKelasXII', $klapper->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning">Naik Kelas XII</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
