@extends ('main')
 <link rel="stylesheet" href="/asset/css/klapper.css">
@section ('content')
<body>

<h2>Klapper</h2>

<hr>

</head>
<body>

<a href="{{url('klapper/tambahdataklapper')}}" class="btn-add">Tambah Data</a>

<table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <th>NO</th>
        <th>Nama</th>
        <th>NIS</th>
        <th>Jurusan</th>
        <th>Angkatan</th>
        <th>Aksi</th>
</tr>
@php
    $i = 1;
@endphp
@foreach ($klapper as $item)
    <tr>
        <td>
            @php
                echo $i;
            @endphp
        </td>
        <td>{{ $item -> nama }}</td>
        <td>{{ $item -> nis }}</td>
        <td>{{ $item -> jurusan }}</td>
        <td>{{ $item -> angkatan }}</td>
        <td><a href="">detail</a>
        <form action="{{url('klapper/'.$item->id)}}" method="POST" class="d-inline" 
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
        
   
</body>
@endsection