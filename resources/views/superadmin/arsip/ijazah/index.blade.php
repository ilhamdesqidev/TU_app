@extends('main')
@section('content')
<div class="container mx-auto">
  <h1 class="text-2xl font-bold mb-4">Arsip Ijazah</h1>
  <form action="{{ route('ijazah.index') }}" class="mb-4">
    <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama siswa..."
      class="border rounded px-2 py-1">
    <button type="submit" class="btn-blue">Cari</button>
    <a href="{{ route('ijazah.create') }}" class="btn-green float-right">Tambah Ijazah</a>
  </form>
  <table class="w-full table-auto">
    <thead><tr>
      <th>No.</th><th>Nama Siswa</th><th>Angkatan</th><th>Tgl. Terbit</th><th>Aksi</th>
    </tr></thead>
    <tbody>
    @foreach($ijazahs as $i=>$ij)
      <tr>
        <td>{{ $i+1 + ($ijazahs->currentPage()-1)*$ijazahs->perPage() }}</td>
        <td>{{ $ij->siswa->nama_siswa }}</td>
        <td>{{ $ij->siswa->klapper->nama_angkatan }}</td>
        <td>{{ $ij->tgl_terbit->format('d-m-Y') }}</td>
        <td>
          <a href="{{ Storage::url($ij->file_path) }}" target="_blank">Lihat</a> |
          <a href="{{ route('ijazah.edit',$ij) }}">Edit</a> |
          <form action="{{ route('ijazah.destroy',$ij) }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button onclick="return confirm('Yakin?')">Hapus</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $ijazahs->links() }}
</div>
@endsection
