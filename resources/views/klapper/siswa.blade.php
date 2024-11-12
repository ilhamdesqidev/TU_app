@extends('main')
<link rel="stylesheet" href="asset/css/siswa.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
    flex-direction: column; /* Menempatkan item di tengah secara horizontal */
/* Menempatkan teks di tengah */
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

/* Mengatur form agar teks di dalamnya rata kiri */
form {
    margin-bottom: 20px; /* Spasi antara form dan daftar siswa */
    text-align: right; /* Membuat tombol di dalam form rata kiri */
    width: 100%;
}

/* Styling untuk tombol */
form .btn-success {
    padding: 10px 20px;
    margin-top: 10px;
}

.btn-tambah {
    display: ;
    width: 50px;
    padding: 10px 20px;
    margin-bottom: 15px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    box-shadow: 0px 10px 30px -5px rgba(0,0,0,0.5);
}

.btn-lulus{
    color: white;
    border: none;
    background-color: #4CAF50;
    text-decoration: none;
    border-radius: 5px;
    padding: 10px 15px;
    transition: background-color 0.6s;
    box-shadow: 0px 10px 30px -5px rgba(0,0,0,0.5);
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
.btn-danger {
    background-color: #dc3545;
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.btn-success:hover {
    background-color: #218838;
}

.badge {
    display: inline-flex;
    align-items: center;
    gap: 0.3em;
    padding: 0.3em 0.6em;
    border-radius: 0.5rem;
    font-size: 0.9em;
}

.badge-secondary {
    background-color: #e0e0e0; /* Abu-abu minimalis */
    color: #333;
}

.badge-success {
    background-color: #d4edda; /* Hijau lembut */
    color: #155724;
}

.badge-danger {
    background-color: #f8d7da; /* Merah lembut */
    color: #721c24;
}

</style>
<div class="detail-container">

<h1>Data Siswa</h1>
    
    
    
    <!-- Daftar siswa terkait klapper -->
   

    <form action="{{ route('klapper.lulusSemua', $klapper->id) }}" method="POST">
        @csrf
        <a href="{{ route('siswa.create', $klapper->id) }}" class="btn-tambah"><i class='bx bx-plus-circle'></i></a>

        <button type="submit" class="btn-lulus">Luluskan Semua Pelajar</button>
    </form>

    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Jurusan</th>
            <th>kelas</th>
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
        <td>{{ $siswa -> kelas }}</td>
        <td>
    @if($siswa->status == 0)
        <span class="badge badge-secondary">
            <i class="fas fa-user-graduate"></i> Pelajar
        </span>
    @elseif($siswa->status == 1)
        <span class="badge badge-success">
            <i class="fas fa-graduation-cap"></i> Lulus
        </span>
    @else
        <span class="badge badge-danger">
        <i class="fas fa-arrow-right-from-bracket"></i>  Keluar
        </span>
    @endif
</td>



        <td>
        <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-success"><i class="fa-solid fa-folder-open"></i></a>
        <a href="{{ route('klapper.keluar', $siswa->id) }}" class="btn btn-danger"> <i class="fas fa-arrow-right-from-bracket"></i></a>
        </td>
    </tr>
    @endforeach
    
</table>

</div>
@endsection
