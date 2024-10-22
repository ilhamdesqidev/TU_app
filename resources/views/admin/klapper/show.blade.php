@extends('main')
<link rel="stylesheet" href="/asset/css/show.css.css">
@section('content')

<a href="{{ url('klapper/tambah_siswa') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Data
        </a>

<div class="container">
    <h1>{{ $klapper->nama_buku }}</h1>
    <!-- <p>Tahun Ajaran: {{ $klapper->tahun_ajaran }}</p> -->
</div>


@endsection
