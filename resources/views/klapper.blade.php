@extends('main')
@section('content')
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<section class="home">
    <div class="text">Klapper</div>
</section>

<div class="container">
    <a href="{{ url('klapper/tambahdataklapper') }}" class="btn-add">Tambah Data</a>

    <div class="card-container">
        @foreach ($klapper as $item)
        <div class="card" onclick="window.location='{{ url("klapper/".$item->id) }}'">
            <div class="card-header">
                <i class="fas fa-book logo-buku"></i> <!-- Ikon buku Font Awesome -->
                <h3>{{ $item->nama_buku }}</h3>
            </div>
            <div class="card-body">
                <p class="tahun-ajaran">{{ $item->tahun_ajaran }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .container {
        padding: 20px;
        margin-left: 250px;
    }
    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-left: 250px;
    }
    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 200px;
        box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        padding: 15px;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        transition: transform 0.1s;
    }
    .card:hover {
        transform: scale(1.02);
    }
    .card-header {
        display: flex;
        align-items: center; /* Menjadikan ikon dan teks sejajar */
        font-size: 1.2em;
        margin-bottom: 10px;
    }
    .logo-buku {
        font-size: 24px; /* Ukuran ikon buku */
        margin-right: 10px; /* Jarak antara ikon dan teks nama buku */
        color: #007bff; /* Warna ikon */
    }
    .card-body {
        flex-grow: 1;
    }
    .tahun-ajaran {
        color: rgba(0, 0, 0, 0.6);
    }
    .btn-add {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>

</body>
@endsection
