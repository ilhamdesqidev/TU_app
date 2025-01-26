@extends('main')
@section('content')
<div class="container">
    <h1>Buat Surat Spensasi Baru</h1>

    <form action="{{ route('superadmin.spensasi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" required 
                   value="{{ old('nama_siswa') }}">
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control" required 
                   value="{{ old('kelas') }}">
        </div>

        <div class="form-group">
            <label>Kategori Spensasi</label>
            <select name="kategori_spensasi" class="form-control" required>
                @foreach($kategoriSpensasi as $key => $label)
                    <option value="{{ $key }}" 
                        {{ old('kategori_spensasi') == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Mata Pelajaran (Opsional)</label>
            <input type="text" name="jam_pelajaran" class="form-control" 
                   value="{{ old('mata_pelajaran') }}">
        </div>

        <div class="form-group">
            <label>Detail Spensasi</label>
            <textarea name="detail_spensasi" class="form-control" rows="4" required>{{ old('detail_spensasi') }}</textarea>
        </div>

        <div class="form-group">
            <label>Tanggal Spensasi</label>
            <input type="date" name="tanggal_spensasi" class="form-control" required 
                   value="{{ old('tanggal_spensasi') ?? date('Y-m-d') }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Surat Spensasi</button>
    </form>
</div>
@endsection