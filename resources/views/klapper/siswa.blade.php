@extends('main')
<link rel="stylesheet" href="asset/css/siswa.css">
@section('content')
<style>
    /* asset/css/klapper.css */
.detail-container {
    display: flex;
    flex-direction: column;
    align-items: center; /* Menempatkan item di tengah secara horizontal */
    justify-content: center; /* Menempatkan item di tengah secara vertikal */
    text-align: center; /* Menempatkan teks di tengah */
    padding: 20px; /* Tambahkan padding untuk ruang */
}

h2, h3, p {
    margin: 10px 0; /* Spasi antar elemen */
}

form {
    margin-bottom: 20px; /* Spasi antara form dan daftar siswa */
}

ul {
    list-style-type: none; /* Menghilangkan bullet pada list */
    padding: 0; /* Menghilangkan padding pada list */
}

</style>
<div class="detail-container">
    <h2>Detail Klapper: {{ $klapper->nama_buku }}</h2>
    <p>Tahun Ajaran: {{ $klapper->tahun_ajaran }}</p>
    
    <h3>Tambah Data Siswa</h3>
    <form action="{{ route('siswa.store', $klapper->id) }}" method="POST">
    @csrf
    <div class="form-input">
                    <label for="nis">nis</label>
                    <input type="text" name="nis" id="nis">
                </div>
                <div class="form-input">
                    <label for="nama_siswa">nama_siswa</label>
                    <input type="text" name="nama_siswa" id="nama_siswa">
                </div>
                <div class="form-input">
                    <label for="tempat_lahir">tempat_lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir">
                </div>
                <div class="form-input">
                    <label for="tanggal_lahir">tanggal_lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir">
                </div>
                <div class="form-input">
                    <label>Gender:</label>
                        <input type="radio" name="gender" id="male" value="laki-laki">
                        <label for="male">Laki-laki</label>
                        <input type="radio" name="gender" id="female" value="perempuan">
                        <label for="female">Perempuan</label>
                </div>
                <div class="form-input">
                    <label for="kelas">kelas</label>
                    <input type="text" name="kelas" id="kelas">
                </div>
                <div class="form-input">
                    <label for="jurusan">jurusan</label>
                    <input type="text" name="jurusan" id="jurusan">
                </div>
                <div class="form-input">
                    <label for="angkatan">angkatan</label>
                    <input type="text" name="angkatan" id="angkatan">
                </div>
                <div class="form-input">
                    <label for="nama_orang_tua">nama orang tua</label>
                    <input type="text" name="nama_orang_tua" id="nama_orang_tua">
                </div>
                <div class="form-input">
                    <label for="tanggal_masuk">tanggal masuk</label>
                    <input type="date" name="tanggal_masuk" id="tanggal_masuk">
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
                    <label for="foto"> foto</label>
                    <input type="file" name="foto" id="foto">
                </div>
    <button type="submit">Tambah Siswa</button>
    </form>

    
    <!-- Daftar siswa terkait klapper -->
    <h3>Daftar Siswa</h3>
    <ul>
        @foreach ($klapper->siswas as $siswa)
            <li>{{ $siswa->nama_siswa }} - NIS: {{ $siswa->nis }}</li>
        @endforeach
    </ul>
</div>
@endsection
