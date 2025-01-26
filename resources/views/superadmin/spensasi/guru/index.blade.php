@extends('main')
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@section('content')
<div class="container">
    <h1>Daftar Surat Spensasi yang Disetujui</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surat as $item)
            <tr>
                <td>{{ $item->nama_siswa }}</td>
                <td>{{ $item->kelas }}</td>
                <td>{{ ucfirst($item->kategori_spensasi) }}</td>
                <td>{{ $item->tanggal_spensasi }}</td>
                <td>{{ $item->detail_spensasi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $surat->links() }}
</div>
@endsection

