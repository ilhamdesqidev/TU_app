@extends('main')
<link rel="stylesheet" href="{{ asset('asset/css/klapper.css') }}">

@section('content')
<body>
<section class="home">
    <div class="text">{{ $klapper->nama_buku }}</div>

    <div class="container">
        <div class="detail-card">
            <div class="detail-header">
                <h2>Detail Klapper</h2>
            </div>
            <table border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($siswa as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_siswa }}</td>
                    <td>{{ $item->nis }}</td>
                    <td>{{ $item->jurusan }}</td>
                    <td>{{ $item->angkatan }}</td>
                    <td><!-- Tombol aksi jika diperlukan --></td>
                </tr>
                @endforeach
            </table>
            <div class="detail-body">
                <!-- Informasi lainnya -->
            </div>
            <div class="btn-container">
                <a href="{{ route('klapper.index') }}" class="btn-back">Kembali</a>
                <a href="{{ route('klapper.create') }}" class="btn-add">Tambah Data</a>
            </div>
            <div class="form-container">
                <h2>Tambah Siswa</h2>
                <form action="{{ route('klapper.addSiswa', $klapper->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-input">
                        <label for="nis">NIS</label>
                        <input type="text" name="nis" id="nis" required>
                    </div>
                    <div class="form-input">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" name="nama_siswa" id="nama_siswa" required>
                    </div>
                    <!-- Tambahkan input lainnya sesuai kebutuhan -->
                    <button type="submit">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
@endsection
