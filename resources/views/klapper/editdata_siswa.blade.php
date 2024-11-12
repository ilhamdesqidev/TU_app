@extends('main')
@section('content')

<style>
    /* Style untuk halaman Edit Data Siswa */

h2 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Style untuk form */
form {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
}

/* Style untuk label */
label {
    display: block;
    margin-top: 15px;
    color: #333;
    font-weight: bold;
}

/* Style untuk input teks */
input[type="text"],
input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus,
input[type="date"]:focus {
    border-color: #4CAF50;
    outline: none;
}

/* Style untuk tombol submit */
.btn-submit {
    display: block;
    width: 100%;
    padding: 10px;
    margin-top: 20px;
    background-color: #4CAF50;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-submit:hover {
    background-color: #45a049;
}

</style>

<h2>Edit Data Siswa</h2>

<form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="nis">NIS:</label>
    <input type="text" name="nis" value="{{ $siswa->nis }}" required>

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

    <label for="angkatan">Angkatan:</label>
    <input type="text" name="angkatan" value="{{ $siswa->angkatan }}" required>

    <label for="nama_orang_tua">Nama Orang Tua:</label>
    <input type="text" name="nama_orang_tua" value="{{ $siswa->nama_orang_tua }}" required>

    <label for="tanggal_masuk">Tanggal Masuk:</label>
    <input type="date" name="tanggal_masuk" value="{{ $siswa->tanggal_masuk }}" required>

    <label for="tanggal_keluar">Tanggal Keluar:</label>
    <input type="date" name="tanggal_keluar" value="{{ $siswa->tanggal_keluar }}" required>

    <button type="submit" class="btn-submit">Simpan Perubahan</button>
</form>

@endsection
