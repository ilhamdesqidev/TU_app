@extends('main')
<link rel="stylesheet" href="/asset/css/editsiswa.css">
@section('content')

<h2>Edit Data Siswa</h2>

<form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="nis">NIS:</label>
    <input type="text" name="nis" value="{{ $siswa->nis }}" required>

    <label for="nisn">nisn:</label>
    <input type="text" name="nisn" value="{{ $siswa->nisn }}" required>

    <label for="nama_siswa">Nama Siswa:</label>
    <input type="text" name="nama_siswa" value="{{ $siswa->nama_siswa }}" required>

    <label for="tempat_lahir">Tempat Lahir:</label>
    <input type="text" name="tempat_lahir" value="{{ $siswa->tempat_lahir }}" required>

    <label for="tanggal_lahir">Tanggal Lahir:</label>
    <input type="date" name="tanggal_lahir" value="{{ $siswa->tanggal_lahir }}" required>

    <label for="gender">Gender:</label>
    <input type="text" name="gender" value="{{ $siswa->gender }}" required>

    <label for="kelas">Kelas:</label>
    <input type="text" name="kelas" value="{{ $siswa->kelas }}" required>

    <label for="jurusan">Jurusan:</label>
    <input type="text" name="jurusan" value="{{ $siswa->jurusan }}" required>

    <label for="nama_orang_tua">Nama Orang Tua:</label>
    <input type="text" name="nama_orang_tua" value="{{ $siswa->nama_orang_tua }}" required>

    <label for="tanggal_masuk">Tanggal Masuk:</label>
    <input type="date" name="tanggal_masuk" value="{{ $siswa->tanggal_masuk }}" required>

       <!-- Tambahkan Input untuk Foto -->
       <label for="foto">Foto:</label>
    <input type="file" name="foto" id="foto">

    <!-- Tampilkan Foto Saat Ini -->
    @if($siswa->foto)
        <div class="current-photo">
            <p>Foto Saat Ini:</p>
            <img src="{{ asset('image/' . $siswa->foto) }}" alt="Foto Siswa" width="150">
        </div>
    @endif

    <div class="button-group">
        <a href="{{ route('siswa.show', $siswa->id) }}" class="btn-back">Kembali</a>
        <button type="submit" class="btn-submit">Simpan</button>
    </div>
</form>

@endsection
