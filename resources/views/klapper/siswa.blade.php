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

    <form action="{{ route('klapper.show', $klapper->id) }}" method="GET" style="margin-bottom: 20px;">
        <div style="display: flex; gap: 10px; align-items: center;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama atau Jurusan" class="search-input">
            <button type="submit" class="btn-search"><i class="fas fa-search"></i> Cari</button>

            <select name="amaliah" onchange="this.form.submit()" class="form-select" style="width: 200px;">
                <option value="" {{ request('amaliah') == '' ? 'selected' : '' }}>Semua Amaliah</option>
                <option value="1" {{ request('amaliah') == '1' ? 'selected' : '' }}>SMK Amaliah 1</option>
                <option value="2" {{ request('amaliah') == '2' ? 'selected' : '' }}>SMK Amaliah 2</option>
            </select>
        </div>
    </form>
    
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

            @php 
            $filteredSiswas = $klapper->siswas->filter(function ($siswa) {
                $amaliah = request('amaliah');
                $jurusanAmaliah1 = ['pplg', 'tjkt', 'an'];
                $jurusanAmaliah2 = ['dpb', 'lps', 'akl', 'mp', 'br'];

                if ($amaliah == '1') {
                    return in_array(strtolower($siswa->jurusan), $jurusanAmaliah1);
                } elseif ($amaliah == '2') {
                    return in_array(strtolower($siswa->jurusan), $jurusanAmaliah2);
                }
                return true; // Jika tidak ada filter, tampilkan semua
            });
            @endphp

        </tr>
        @foreach ($filteredSiswas as $siswa)
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
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
