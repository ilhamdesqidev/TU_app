@extends('main')
<link rel="stylesheet" href="asset/css/siswa.css">
@section('content')
<style>
    /* asset/css/klapper.css */
.detail-container {
    display: flex;
    flex-direction: column;
    align-items: center; /* Menempatkan item di tengah secara horizontal */
    justify-content: center; /* Menempatkan item di tengah secara vertikal */
    text-align: center; /* Menempatkan teks di tengah */
    padding: 20px; /* Tambahkan padding untuk ruang */
}

h2, h3, p {
    margin: 10px 0; /* Spasi antar elemen */
}

form {
    margin-bottom: 20px; /* Spasi antara form dan daftar siswa */
}

ul {
    list-style-type: none; /* Menghilangkan bullet pada list */
    padding: 0; /* Menghilangkan padding pada list */
}

</style>
<div class="detail-container">
    <h2>Detail Klapper: {{ $klapper->nama_buku }}</h2>
    <p>Tahun Ajaran: {{ $klapper->tahun_ajaran }}</p>
    
    <a href="{{ route('siswa.create', $klapper->id) }}" class="btn-tambah">Tambah Data Siswa</a>
    
    <!-- Daftar siswa terkait klapper -->
    <h3>Daftar Siswa</h3>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Jurusan</th>
            <th>Angkatan</th>
            <th>Aksi</th>
        </tr>
        @foreach ($klapper->siswas as $siswa)
    <tr>
        <td>
            {{ $loop->iteration }}
        </td>
        <td>{{ $siswa -> nama_siswa }}</td>
        <td>{{ $siswa -> nis }}</td>
        <td>{{ $siswa -> jurusan }}</td>
        <td>{{ $siswa -> angkatan }}</td>
        <td><a href="">detail</a>
        </td>
    </tr>
    @endforeach
    
</table>

</div>
@endsection
