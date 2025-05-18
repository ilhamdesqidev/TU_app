@extends('main')
@section('content')
<h2>Tambah Ijazah - Angkatan {{ $angkatan->nama }}</h2>
<form action="{{ route('ijazah.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="angkatan_id" value="{{ $angkatan->id }}">
    <div class="mb-3">
        <label for="klapper_id" class="form-label">Pilih Siswa</label>
        <select name="klapper_id" id="klapper_id" class="form-control" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach($siswaList as $siswa)
            <option value="{{ $siswa->id }}">{{ $siswa->nama_siswa }} (NIS: {{ $siswa->nis }})</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
        <input type="text" name="tahun_lulus" id="tahun_lulus" class="form-control" placeholder="contoh: 2024" required>
    </div>
    <div class="mb-3">
        <label for="nomor_ijazah" class="form-label">Nomor Ijazah</label>
        <input type="text" name="nomor_ijazah" id="nomor_ijazah" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="file_ijazah" class="form-label">File Ijazah (PDF/JPG/PNG)</label>
        <input type="file" name="file_ijazah" id="file_ijazah" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Simpan Ijazah</button>
    @if(isset($klapperId))
        <a href="{{ route('ijazah.perAngkatan', ['klapper' => $klapperId]) }}" class="btn btn-secondary">Batal</a>
    @else
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
    @endif
</form>
@endsection