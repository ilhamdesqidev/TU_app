@extends('main')
<link rel="stylesheet" href="asset/css/siswa.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('content')
<body>
    <section class="home">
        <div class="text">{{ $klapper->nama_buku }}<h6>{{ $klapper->tahun_ajaran }}</h6></div>

    </div>
        </div>
</body>
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

/* Styling untuk tabel */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
    min-width: 400px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.15);
}

table th, table td {
    padding: 12px 15px;
    text-align: center;
}

table th {
    background-color: #4CAF50; /* Warna background header tabel */
    color: #ffffff;
    font-weight: bold;
}

table tr {
    border-bottom: 1px solid #dddddd;
}

table tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

table tr:last-of-type {
    border-bottom: 2px solid #4CAF50;
}

/* Efek hover untuk baris tabel */
table tr:hover {
    background-color: #e9f5e9;
    cursor: pointer;
}

/* Styling untuk tombol */
.btn-tambah {
    display: inline-block;
    padding: 10px 20px;
    margin-bottom: 15px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn-tambah:hover {
    background-color: #45a049;
}

.btn-success {
    background-color: #28a745;
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.btn-success:hover {
    background-color: #218838;
}

</style>
<div class="detail-container">
    
    
    
    <a href="{{ route('siswa.create', $klapper->id) }}" class="btn-tambah">Tambah Data Siswa</a>
    <form action="{{ route('klapper.lulusSemua', $klapper->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn-success">Luluskan Semua Pelajar</button>
    </form>
    
    <!-- Daftar siswa terkait klapper -->
    <h3>Daftar Siswa</h3>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Jurusan</th>
            <th>Angkatan</th>
            <th>status</th>
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
        <td>
            @if($siswa->status == 0)
                Pelajar
            @elseif($siswa->status == 1)
                Lulus
            @else
                Keluar
            @endif
        </td>

        <td>
            <a href="{{ route('klapper.keluar', $siswa->id) }}" class="btn btn-danger"><i class="fa-solid fa-user-slash"></i></a>
            <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-success"><i class="fa-solid fa-folder-open"></i></a>
        </td>
    </tr>
    @endforeach
    
</table>

</div>
@endsection
