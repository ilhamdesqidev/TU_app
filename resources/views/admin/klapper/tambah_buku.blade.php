<!-- resources/views/klapper/create.blade.php -->
@extends('main')

@section('content')
<style>
    /* Gaya untuk keseluruhan halaman */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
        display: flex;
        justify-content: center;
    }

    /* Gaya container form */
    .form-container {
        background-color: #fff;
        width: 100%;
        max-width: 500px;
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
    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    .form-group input[type="text"],
    .form-group input[type="date"],
    .form-group input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }

    /* Efek focus pada input */
    .form-group input:focus {
        border-color: #4CAF50;
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

    /* Gaya untuk link kembali */
    .back-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #4CAF50;
        text-decoration: none;
        font-size: 14px;
    }

    .back-link:hover {
        color: #388E3C;
    }
</style>

<div class="form-container">
    <h2>Tambah Klapper</h2>
    <form action="{{ route('klapper.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_buku">Nama Buku:</label>
            <input type="text" name="nama_buku" id="nama_buku" required>
        </div>
        <div class="form-group">
            <label for="tahun_ajaran">Tahun Ajaran:</label>
            <input type="text" name="tahun_ajaran" id="tahun_ajaran" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
   <a href="{{ route('klapper.index') }}" class="back-link">Kembali</a> 
</div>
@endsection
