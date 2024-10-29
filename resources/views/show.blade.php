@extends('main')
<link rel="stylesheet" href="/asset/css/show.css.css">
@section('content')

<a href="{{ url('show/tambah_siswa') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Data
        </a>

        <table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <th>NO</th>
        <th>Nama siswa</th>
        <th>nisn</th>
        <th>jurusan</th>
        <th>angkatan</th>
        <th>aksi</th>
    </tr>

    @php $i = 1; @endphp
    @foreach ($show as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $item->nama_siswa }}</td>
            <td>{{ $item->nis }}</td>
            <td>{{ $item->jurusan }}</td>
            <td>{{ $item->angkatan }}</td>
            <td>
                <a href="{{ url('detail_siswa', $item->id) }}">detail</a>
                <form action="{{ url('show/' . $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Data Akan Dihapus?')">
                    @method('delete')
                    @csrf
                    <button class="btn-delete">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>


@endsection
