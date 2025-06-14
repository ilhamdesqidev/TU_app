@extends('main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

@section('content')
<body>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">{{ $klapper->nama_buku }}</h3>
        </div>
        <div class="card-body">
            <p class="text-muted">Tahun Ajaran: {{ $klapper->tahun_ajaran }}</p>

            <h4 class="mb-3">Detail Informasi</h4>
            <table class="table table-bordered">
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

</body>
@endsection
