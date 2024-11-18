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
            <label for="nisn">NISN</label>
            <input type="text" name="nisn" id="nisn" required>
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
        <div class="form-input" style="display: flex; align-items: center; gap: 10px;">
            <label for="gender">Gender:</label>
            <select name="gender" id="gender" required style="padding: 5px; border-radius: 4px; border: 1px solid #ccc;">
                <option value="" disabled selected>Pilih Gender</option>
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
        </div>
        
        <!-- Dropdown untuk memilih Sekolah -->
        <div class="form-input" style="display: flex; align-items: center; gap: 10px;">
            <label for="sekolah" style="margin-right: 10px;">Sekolah</label>
            <select name="sekolah" id="sekolah" required style="padding: 5px; border-radius: 4px; border: 1px solid #ccc;">
                <option value="" disabled selected>Pilih Sekolah</option>
                <option value="smk_amaliah_1">SMK Amaliah 1</option>
                <option value="smk_amaliah_2">SMK Amaliah 2</option>
            </select>
        </div>

        <!-- Dropdown untuk memilih Jurusan, yang akan diubah sesuai pilihan Sekolah -->
        <div class="form-input" style="display: flex; align-items: center; gap: 10px;">
            <label for="jurusan">Jurusan</label>
            <select name="jurusan" id="jurusan" required style="padding: 5px; border-radius: 4px; border: 1px solid #ccc;">
                <option value="" disabled selected>Pilih Jurusan</option>
            </select>
        </div>

        <div class="form-input">
            <label for="kelas">Kelas</label>
            <input type="text" name="kelas" id="kelas" value="X" required>
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
        <div class="form-input">
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto">
        </div>
        
        <button type="submit">Tambah Siswa</button>
        
    </form>

    <a href="{{ route('klapper.show', $klappersId) }}" class="btn-back">Kembali ke Halaman Siswa</a>
</div>

<script>
    // Mengatur jurusan berdasarkan sekolah yang dipilih
    document.getElementById('sekolah').addEventListener('change', function() {
        const sekolah = this.value;
        const jurusanSelect = document.getElementById('jurusan');
        
        // Kosongkan opsi jurusan sebelumnya
        jurusanSelect.innerHTML = '<option value="" disabled selected>Pilih Jurusan</option>';

        // Menambahkan jurusan sesuai pilihan sekolah
        if (sekolah === 'smk_amaliah_1') {
            const jurusanOptions = ['AN', 'PPLG', 'TJKT'];
            jurusanOptions.forEach(function(jurusan) {
                const option = document.createElement('option');
                option.value = jurusan.toLowerCase();
                option.textContent = jurusan;
                jurusanSelect.appendChild(option);
            });
        } else if (sekolah === 'smk_amaliah_2') {
            const jurusanOptions = ['MP', 'AKL', 'BR', 'LPS', 'DPB'];
            jurusanOptions.forEach(function(jurusan) {
                const option = document.createElement('option');
                option.value = jurusan.toLowerCase();
                option.textContent = jurusan;
                jurusanSelect.appendChild(option);
            });
        }
    });
</script>

<script>
    // Set the current date for the "Tanggal Masuk" field
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalMasuk = document.getElementById('tanggal_masuk');
        const currentDate = new Date().toISOString().split('T')[0]; // Get current date in YYYY-MM-DD format
        tanggalMasuk.value = currentDate; // Set the input value to the current date
    });
</script>
@endsection
