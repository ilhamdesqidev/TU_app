
@extends('main')
@section('content')
<div class="container">
    <h1>Edit Surat Spensasi</h1>

    <form action="{{ route('superadmin.spensasi.update', $spensasi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" required 
                   value="{{ old('nama_siswa', $spensasi->nama_siswa) }}">
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control" required 
                   value="{{ old('kelas', $spensasi->kelas) }}">
        </div>

        <div class="form-group">
            <label>Kategori Spensasi</label>
            <select name="kategori_spensasi" class="form-control" required>
                @foreach($kategoriSpensasi as $key => $label)
                    <option value="{{ $key }}" 
                        {{ (old('kategori_spensasi', $spensasi->kategori_spensasi) == $key) ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Mata Pelajaran (Opsional)</label>
            <input type="text" name="jam_pelajaran" class="form-control" 
                   value="{{ old('mata_pelajaran', $spensasi->mata_pelajaran) }}">
        </div>

        <div class="form-group">
            <label>Detail Spensasi</label>
            <textarea name="detail_spensasi" class="form-control" rows="4" required>{{ old('detail_spensasi', $spensasi->detail_spensasi) }}</textarea>
        </div>

        <div class="form-group">
            <label>Tanggal Spensasi</label>
            <input type="date" name="tanggal_spensasi" class="form-control" required 
                   value="{{ old('tanggal_spensasi', $spensasi->tanggal_spensasi) }}">
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Surat Spensasi</button>
    </form>
</div>
@endsection