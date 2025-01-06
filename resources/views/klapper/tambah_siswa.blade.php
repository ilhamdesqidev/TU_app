@extends('main')
<link rel="stylesheet" href="/asset/css/tambahsiswa.css">
@section('content')
<div class="form-container">
    <h2>Tambah Data Siswa</h2>
    <form action="{{ route('siswa.store', $klappersId) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-input">
            <label for="nis">NIS</label>
            <input type="text" name="nis" id="nis" required>
        </div>
        <div class="form-input">
            <label for="nama_siswa">Nama Siswa</label>
            <input type="text" name="nama_siswa" id="nama_siswa" required>
        </div>
        <div class="form-input">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" required>
        </div>
        <div class="form-input">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" required>
        </div>
        <div class="form-input">
            <label>Gender:</label>
            <input type="radio" name="gender" id="male" value="laki-laki" required>
            <label for="male">Laki-laki</label>
            <input type="radio" name="gender" id="female" value="perempuan" required>
            <label for="female">Perempuan</label>
        </div>
        <div class="form-input">
            <label for="kelas">Kelas</label>
            <input type="text" name="kelas" id="kelas" value="X" required>
        </div>
        <div class="form-input">
            <label for="jurusan">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan" required>
        </div>
        <div class="form-input">
            <label for="angkatan">Angkatan</label>
            <input type="text" name="angkatan" id="angkatan" required>
        </div>
        <div class="form-input">
            <label for="nama_orang_tua">Nama Orang Tua</label>
            <input type="text" name="nama_orang_tua" id="nama_orang_tua" required>
        </div>
        <div class="form-input">
            <label for="tanggal_masuk">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" id="tanggal_masuk" required>
        </div>
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto">
        </div>
        
        <button type="submit">Tambah Siswa</button>
        
    </form>

    <a href="{{ route('klapper.show', $klappersId) }}" class="btn-back">Kembali ke Halaman Siswa</a>
</div>
<script>
    // Set the current date for the "Tanggal Masuk" field
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalMasuk = document.getElementById('tanggal_masuk');
        const currentDate = new Date().toISOString().split('T')[0]; // Get current date in YYYY-MM-DD format
        tanggalMasuk.value = currentDate; // Set the input value to the current date
    });
</script>
@endsection