@extends('main')
<!-- <link rel="stylesheet" href="/asset/css/klapper.css"> -->
@section('content')
<body>


<section class="home">
        <div class="text">Klapper</div>
    </section>
<div class="container">
    <a href="{{ url('klapper/tambahdataklapper') }}" class="btn-add">Tambah Data</a>
    <div class="card-container">
        @foreach ($klapper as $item)
        <div class="card" onclick="window.location='{{ url("klapper/".$item->id) }}'">
                <div class="card-header">
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
        margin-left:250px;
    }
    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-left:250px;
    }
    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 200px;
        box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        padding: 15px;
        display: flex;
        flex-direction: column;
        cursor: pointer; /* Menambahkan pointer cursor untuk menunjukkan bahwa card bisa diklik */
        transition: transform 0.1s; /* Mengurangi durasi animasi saat hover */
    }
    .card:hover {
        transform: scale(1.02); /* Mengurangi efek zoom saat hover */
    }
    .card-header {
        font-size: 1.2em;
        margin-bottom: 10px;
    }
    .card-body {
        flex-grow: 1;
    }
    .tahun-ajaran {
        color: rgba(0, 0, 0, 0.6); /* Membuat teks tahun ajaran sedikit samar */
    }
    .btn-add {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 5px;
        margin-bottom: 20px; /* Menambahkan jarak di bawah tombol */
    }
</style>

</body>
@endsection
