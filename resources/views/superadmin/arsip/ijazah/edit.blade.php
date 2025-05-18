@extends('main')

@section('content')
<h2>Edit Ijazah - {{ $ijazah->nama_siswa }}</h2>

<form action="{{ route('ijazah.update', $ijazah->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="angkatan_id" value="{{ $angkatan->id }}">

    <div class="mb-3">
        <label for="klapper_id" class="form-label">Pilih Siswa</label>
        <select name="klapper_id" id="klapper_id" class="form-control" required>
            @foreach($siswaList as $siswa)
            <option value="{{ $siswa->id }}" {{ $ijazah->klapper_id == $siswa->id ? 'selected' : '' }}>
                {{ $siswa->nama_siswa }} (NIS: {{ $siswa->nis }})
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
        <input type="text" name="tahun_lulus" id="tahun_lulus" class="form-control" value="{{ $ijazah->tahun_lulus }}" required>
    </div>

    <div class="mb-3">
        <label for="nomor_ijazah" class="form-label">Nomor Ijazah</label>
        <input type="text" name="nomor_ijazah" id="nomor_ijazah" class="form-control" value="{{ $ijazah->nomor_ijazah }}" required>
    </div>

    <div class="mb-3">
        <label for="file_ijazah" class="form-label">File Ijazah (PDF/JPG/PNG)</label>
        <input type="file" name="file_ijazah" id="file_ijazah" class="form-control">
        @if ($ijazah->file_ijazah)
            <a href="{{ route('ijazah.download', $ijazah->id) }}" target="_blank" class="btn btn-sm btn-success mt-2">Lihat File Saat Ini</a>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Update Ijazah</button>
    <a href="{{ route('ijazah.perAngkatan', $angkatan->id) }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
