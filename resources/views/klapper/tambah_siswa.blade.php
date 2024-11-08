@extends('main')
@section('content')
<style>
    /* Menyusun form di tengah halaman */
    .form-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        max-width: 500px; /* Batasi lebar form */
        margin: 0 auto; /* Tengah secara horizontal */
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    /* Styling untuk input form */
    .form-input {
        margin-bottom: 15px;
        width: 100%;
    }

    .form-input label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-input input[type="text"],
    .form-input input[type="date"],
    .form-input input[type="file"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    /* Styling untuk tombol */
    button[type="submit"] {
        padding: 10px 15px;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
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
            <input type="text" name="kelas" id="kelas" value="10" required>
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
        <div class="form-input">
                    <label for="tanggal_naik_kelas_xi">tanggal_naik_kelas_xi</label>
                    <input type="date" name="tanggal_naik_kelas_xi" id="tanggal_naik_kelas_xi">
                </div>
                <div class="form-input">
                    <label for="tanggal_naik_kelas_xii">tanggal naik kelas xii</label>
                    <input type="date" name="tanggal_naik_kelas_xii" id="tanggal_naik_kelas_xii">
                </div>
                <div class="form-input">
                    <label for="tanggal_lulus">Tanggal lulus</label>
                    <input type="date" name="tanggal_lulus" id="tanggal_lulus">
                </div>
                <div class="form-input">
                    <label for="tanggal_keluar">Tanggal Keluar</label>
                    <input type="date" name="tanggal_keluar" id="tanggal_keluar">
                </div>
        <div class="form-input">
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto">
        </div>
        
        <button type="submit">Tambah Siswa</button>
        
    </form>
</div>
@endsection