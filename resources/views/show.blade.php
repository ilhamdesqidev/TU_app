@extends('main')
<link rel="stylesheet" href="/asset/css/show.css.css">
@section('content')

<a href="{{ url('show/tambah_siswa') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Data
        </a>

        <table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <th>NO</th>
        <th>Nama buku</th>
        <th>tahun ajaran</th>
        <th>aksi</th>
</tr>
@php
    $i = 1;
@endphp
@foreach ($show as $item)
    <tr>
        <td>
            @php
                echo $i;
            @endphp
        </td>
        <td>{{ $item -> nama_buku }}</td>
        <td>{{ $item -> tahun_ajaran }}</td>

        <td><a href="">detail</a>
        <form action="{{url('show/'.$item->id)}}" method="POST" class="d-inline" 
        onsubmit="return confirm('Apakah Data Akan Dihapus?')">
            @method('delete')
            @csrf
            <button class="btn-delete">Delete</button>
        </form>
        </td>
        
    </tr>

    @php
    $i++;
    @endphp
    
    @endforeach
    
</table>

@endsection
