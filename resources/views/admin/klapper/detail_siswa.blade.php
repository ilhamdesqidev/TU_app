@extends('main')
@section('content')

<h2>{{ $data_siswa->nis }}</h2>
<h3>{{ $data_siswa->nama_siswa }}</h3>
<h3>{{ $data_siswa->tempat_lahir }}</h3>
<h3>{{ $data_siswa->tanggal_lahir }}</h3>
<h3>{{ $data_siswa->gender }}</h3>
<h3>{{ $data_siswa->kelas }}</h3>
<h3>{{ $data_siswa->jurusan }}</h3>
<h3>{{ $data_siswa->angkatan }}</h3>
<h3>{{ $data_siswa->nama_orang_tua }}</h3>
<h3>{{ $data_siswa->tanggal_masuk }}</h3>
<h3>{{ $data_siswa->tanggal_naik_kelas_xi }}</h3>
<h3>{{ $data_siswa->tanggal_naik_kelas_xii }}</h3>
<h3>{{ $data_siswa->tanggal_lulus }}</h3>
<h3>{{ $data_siswa->foto }}</h3>

@endsection
