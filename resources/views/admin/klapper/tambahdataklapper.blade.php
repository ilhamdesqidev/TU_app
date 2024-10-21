<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>input data siswa</title>
</head>
<body>
    <div class="form-container">
        <h2>Halaman Input</h2>
        <form action="{{ url('klapper') }}" method="POST" enctype="multipart/form-data">

            @csrf
            
            <div class="form-input">
                <label for="nis">NIS</label>
                <input type="text" name="nis" id="nis">
            </div>
            <div class="form-input">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama">
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
                <!-- <select name="kelas" id="kelas">kelas
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="10">10</option>
                </select> -->
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
                <label for="tempat_tanggal_lahir">Tempat tgl Lahir</label>
                <input type="text" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir">
            </div>
            <div class="form-input">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tgl_lahir">
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

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>