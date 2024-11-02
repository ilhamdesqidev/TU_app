@extends('main')
    <link rel="stylesheet" href="{{ asset('asset/css/klapper.css') }}">

    @section('content')
        <style>
            /* Gaya untuk keseluruhan halaman */
                body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Mengubah dari center menjadi flex-start */
            margin: 0;
            padding: 20px; /* Menambahkan padding */
            }
            /* Gaya container form */
            .form-container {
                background-color: #fff;
                width: 400px;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            /* Gaya judul */
            h2 {
                text-align: center;
                color: #333;
                margin-bottom: 20px;
            }

            /* Gaya untuk elemen input */
            .form-input {
                margin-bottom: 15px;
            }

            .form-input label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
                color: #555;
            }

            .form-input input[type="text"],
            .form-input input[type="date"],
            .form-input input[type="file"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                font-size: 14px;
                transition: border-color 0.3s ease;
            }

            /* Efek focus pada input */
            .form-input input[type="text"]:focus,
            .form-input input[type="date"]:focus,
            .form-input input[type="file"]:focus {
                border-color: #4CAF50;
            }

            /* Gaya untuk radio button */
            .form-input input[type="radio"] {
                margin-right: 5px;
            }

            .form-input div {
                margin-bottom: 10px;
            }

            .form-input div label {
                margin-right: 10px;
                color: #333;
                font-weight: normal;
            }

            /* Gaya untuk tombol submit */
            button[type="submit"] {
                width: 100%;
                background-color: #4CAF50;
                color: white;
                padding: 12px;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                font-size: 16px;
                transition: background-color 0.3s ease;
            }

            /* Efek hover pada tombol */
            button[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="form-container">
            <h2>Halaman tambah buku</h2>
            <action= "{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
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
                <button type="submit">Kirim</button>
            </form>
        </div>
    </body>
    @endsection
