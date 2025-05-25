@extends('main')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-white p-3">
            <h4 class="card-title mb-0">
                <i class="fas fa-edit me-2 text-primary"></i>Edit Data Ijazah
            </h4>
        </div>
        
        <div class="card-body">
            <form action="{{ route('ijazah.update', $ijazah->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Siswa</label>
                        <input type="text" class="form-control" value="{{ $ijazah->nama_siswa }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NIS</label>
                        <input type="text" class="form-control" value="{{ $ijazah->nis }}" readonly>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nomor_ijazah" class="form-label">Nomor Ijazah</label>
                        <input type="text" class="form-control @error('nomor_ijazah') is-invalid @enderror" 
                               id="nomor_ijazah" name="nomor_ijazah" 
                               value="{{ old('nomor_ijazah', $ijazah->nomor_ijazah) }}" required>
                        @error('nomor_ijazah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_lulus" class="form-label">Tanggal Lulus</label>
                        <input type="date" class="form-control @error('tanggal_lulus') is-invalid @enderror" 
                               id="tanggal_lulus" name="tanggal_lulus" 
                               value="{{ old('tanggal_lulus', $ijazah->tanggal_lulus->format('Y-m-d')) }}" required>
                        @error('tanggal_lulus')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="klapper_id" class="form-label">Klapper</label>
                    <select class="form-select @error('klapper_id') is-invalid @enderror" 
                            id="klapper_id" name="klapper_id" required>
                        <option value="">Pilih Klapper</option>
                        @foreach($klappers as $klapper)
                            <option value="{{ $klapper->id }}" 
                                {{ old('klapper_id', $ijazah->klapper_id) == $klapper->id ? 'selected' : '' }}>
                                {{ $klapper->nama_buku }} ({{ $klapper->tahun_ajaran }})
                            </option>
                        @endforeach
                    </select>
                    @error('klapper_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('ijazah.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection