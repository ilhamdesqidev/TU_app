@extends('main')
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<link rel="stylesheet" href="asset/css/klapper.css">

@section('content')
<body>

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

   
</body>
@endsection
