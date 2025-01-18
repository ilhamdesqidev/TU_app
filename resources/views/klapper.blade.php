@extends('main')
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background: #f5f5f5; /* Warna netral */
        color: #333;
    }

    .home {
        padding: 2rem;
        text-align: center;
    }

    .home .text {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 2rem;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .btn-container {
        text-align: center;
        margin-bottom: 2rem;
    }

    .btn-add {
        background: #007bff; /* Biru profesional */
        color: #fff;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 600;
        transition: 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-add:hover {
        background: #0056b3; /* Biru lebih gelap */
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .alert {
        background: #28a745; /* Hijau untuk notifikasi sukses */
        color: #fff;
        padding: 1rem;
        border-radius: 5px;
        text-align: center;
        margin-bottom: 2rem;
    }

    .card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Menempatkan kartu di tengah */
    gap: 2rem;
    margin-top: 2rem;
    }

    .card {
    flex: 0 1 350px; /* Menyesuaikan ukuran kartu menjadi lebih panjang */
    max-width: 500px; /* Membatasi lebar maksimum kartu */
    width: 100%;
    height: 200px; /* Menetapkan tinggi tetap untuk kartu */
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    }



    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        background: #007bff; /* Warna biru untuk header */
        color: #fff;
        padding: 1.5rem;
        text-align: center;
    }

    .card-header i {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .card-header h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .card-body {
        padding: 1.5rem;
        text-align: center;
    }

    .card-body .tahun-ajaran {
        font-size: 1rem;
        color: #555;
    }
</style>


@section('content')
<section class="home">
    <div class="text">Klapper</div>

    <div class="container">
        <!-- Membuat tombol tambah data berada di tengah -->
        <div class="btn-container">
            <a href="{{ url('klapper/tambahdataklapper') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
        </div>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <div class="card-container">
            @foreach ($klapper as $item)
            <div class="card" onclick="window.location='{{ url('klapper/' . $item->id) }}'">
                <div class="card-header">
                    <i class='bx bxs-book'></i>
                    <h3>{{ $item->nama_buku }}</h3>
                </div>
                <div class="card-body">
                    <p class="tahun-ajaran">{{ $item->tahun_ajaran }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
