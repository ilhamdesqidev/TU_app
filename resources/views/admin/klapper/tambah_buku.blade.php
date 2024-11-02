<!-- resources/views/klapper/create.blade.php -->
@extends('main')
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
@section('content')
<div class="container">
    <h2>Tambah Klapper</h2>
    <form action="{{ route('klapper.store') }}" method="POST">
        @csrf
        <div>
            <label for="nama_buku">Nama Buku:</label>
            <input type="text" name="nama_buku" required>
        </div>
        <div>
            <label for="tahun_ajaran">Tahun Ajaran:</label>
            <input type="text" name="tahun_ajaran" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
    <a href="{{ route('klapper.index') }}">Kembali</a>
</div>
@endsection