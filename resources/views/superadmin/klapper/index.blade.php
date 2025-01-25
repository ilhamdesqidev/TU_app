@extends('main')
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background: #f9f9f9; /* Warna netral */
        color: #333;
    }

    .home {
        padding: 3rem 2rem;
        text-align: center;
    }

    .home .text {
        font-size: 2.5rem;
        font-weight: bold;
        color: #444;
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
        background: #007bff; /* Warna biru */
        color: #fff;
        padding: 0.75rem 2rem;
        border-radius: 30px;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-add:hover {
        background: #0056b3; /* Warna biru lebih gelap */
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    /* Notifikasi dengan animasi */
    @keyframes slideIn {
        0% {
            top: -50px; /* Mulai di luar layar (atas) */
            opacity: 0;
        }
        100% {
            top: 20px; /* Posisi akhir notifikasi */
            opacity: 1;
        }
    }

    @keyframes slideOut {
        0% {
            opacity: 1;
            top: 20px; /* Posisi akhir notifikasi */
        }
        100% {
            opacity: 0;
            top: -50px; /* Pindah keluar layar ke atas */
        }
    }

    .alert {
        background: #28a745; /* Hijau */
        color: #fff;
        padding: 1rem;
        border-radius: 8px;
        text-align: center;
        margin-bottom: 2rem;
        position: absolute;
        top: 20px; /* Posisi notifikasi di atas tengah layar */
        left: 50%;
        transform: translateX(-50%); /* Menjaga posisi tetap di tengah */
        width: auto;
        animation: slideIn 2s ease forwards, slideOut 2s 2s forwards; /* Animasi muncul dan hilang */
        z-index: 9999; /* Memastikan berada di atas elemen lainnya */
    }

    .card-container {
        display: flex;
        flex-wrap: wrap; /* Memungkinkan konten berpindah ke baris baru */
        justify-content: flex-start; /* Mengisi dari kiri ke kanan */
        gap: 2rem;
        margin-top: 2rem;
    }

    .card {
        flex: 0 1 calc(25% - 2rem);
        max-width: calc(25% - 2rem);
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    @media (max-width: 1024px) {
        .card {
            flex: 0 1 calc(33.33% - 2rem);
            max-width: calc(33.33% - 2rem);
        }
    }

    @media (max-width: 768px) {
        .card {
            flex: 0 1 calc(50% - 2rem);
            max-width: calc(50% - 2rem);
        }
    }

    @media (max-width: 576px) {
        .card {
            flex: 0 1 100%;
            max-width: 100%;
        }
    }

    .card-content {
        display: flex;
        align-items: center; /* Memastikan konten sejajar secara vertikal */
        padding: 1.5rem;
    }

    .card-icon {
        color: #007bff;
        font-size: 3rem; /* Ukuran ikon lebih besar */
        margin-right: 1rem; /* Jarak dengan teks */
    }

    .card-info {
        text-align: left; /* Menyelaraskan teks ke kiri */
        flex: 1;
    }

    .card-info h3 {
        margin: 0;
        font-size: 1.25rem; /* Ukuran nama buku */
        font-weight: bold;
        color: #333;
        flex: 1;
    }

    .card-info p {
        margin: 0;
        font-size: 0.9rem; /* Ukuran tahun ajaran lebih kecil */
        color: #777;
    }
</style>

@section('content')
<section class="home">
    <div class="text">Klapper</div>

    <div class="container">
        <div class="btn-container">
            <a href="{{ url('klapper/tambahdataklapper') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
        </div>

        @if (session('status'))
        <div class="alert">
            {{ session('status') }}
        </div>
        @endif

        <div class="card-container">
            @foreach ($klapper as $item)
            <div class="card" onclick="window.location='{{ url('klapper/' . $item->id) }}'">
                <div class="card-content">
                    <!-- Ikon buku di sebelah kiri -->
                    <div class="card-icon">
                        <i class="bx bxs-book"></i>
                    </div>
                    <!-- Informasi buku di sebelah kanan -->
                    <div class="card-info">
                        <h3>{{ $item->nama_buku }}</h3>
                        <p>{{ $item->tahun_ajaran }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
