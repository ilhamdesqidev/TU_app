@extends('main')
<link rel="stylesheet" href="/asset/css/klapper.css">
@section('content')
<body>

<h2>Detail Klapper</h2>
<hr>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>{{ $klapper->nama_buku }}</h3>
        </div>
        <div class="card-body">
            <p class="tahun-ajaran">Tahun Ajaran: {{ $klapper->tahun_ajaran }}</p>

            <h4>Detail Informasi</h4>
            <table class="table-detail">
                <tr>
                    <th>Kode Buku</th>
                    <td>{{ $klapper->kode_buku }}</td>
                </tr>
                <tr>
                    <th>Penulis</th>
                    <td>{{ $klapper->penulis }}</td>
                </tr>
                <tr>
                    <th>Penerbit</th>
                    <td>{{ $klapper->penerbit }}</td>
                </tr>
                <tr>
                    <th>Jumlah Halaman</th>
                    <td>{{ $klapper->jumlah_halaman }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<style>
    .container {
        padding: 20px;
    }
    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        padding: 15px;
        width: 400px;
        margin: 0 auto;
    }
    .card-header {
        font-size: 1.5em;
        margin-bottom: 20px;
    }
    .card-body {
        flex-grow: 1;
    }
    .tahun-ajaran {
        color: rgba(0, 0, 0, 0.6);
        margin-bottom: 10px;
    }
    .table-detail {
        width: 100%;
        border-collapse: collapse;
    }
    .table-detail th, .table-detail td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }
    .table-detail th {
        background-color: #f5f5f5;
    }
</style>

</body>
@endsection
