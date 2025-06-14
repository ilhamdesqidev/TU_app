@extends('main')

@section('content')
<div class="bg-light py-4">
    <div class="container">
        <!-- Header Section -->
        <div class="row my-3">
            <div class="col-lg-6 col-md-8 mx-auto text-center">
                <h3 class="fw-bold text-primary mb-2">Tambah Klapper</h3>
                <p class="text-muted small mb-3">Masukkan data klapper dengan lengkap</p>
            </div>
        </div>
    </div>
</div>

<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('klapper.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_buku" class="form-label fw-semibold">Nama Buku</label>
                            <input type="text" name="nama_buku" id="nama_buku" class="form-control rounded-3" value="{{ old('nama_buku', $newNamaBuku) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="tahun_ajaran" class="form-label fw-semibold">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control rounded-3" value="{{ old('tahun_ajaran', $newTahunAjaran) }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Data
                        </button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('klapper.index') }}" class="text-decoration-none text-primary fw-semibold">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection