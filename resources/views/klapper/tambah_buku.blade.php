@extends('main')

@section('content')
<div class="d-flex flex-column min-vh-100">
    <!-- Header Section -->
    <div class="bg-light">
        <div class="container">
            <div class="row pt-3">
                <div class="col-lg-6 col-md-8 mx-auto text-center">
                    <h3 class="fw-bold text-primary mb-1">Tambah Klapper</h3>
                    <p class="text-muted small mb-0">Masukkan data klapper dengan lengkap</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container flex-grow-1 mb-3"> <!-- Added margin-bottom here -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
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
                                <input type="text" name="nama_buku" id="nama_buku" class="form-control" 
                                       value="{{ old('nama_buku', $newNamaBuku) }}" required>
                                @if(!empty($newNamaBuku))
                                    <div class="form-text mt-1">Nama buku akan otomatis berlanjut dari data terakhir</div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="tahun_ajaran" class="form-label fw-semibold">Tahun Ajaran</label>
                                <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control" 
                                       value="{{ old('tahun_ajaran', $newTahunAjaran) }}" required>
                                @if(!empty($newTahunAjaran))
                                    <div class="form-text mt-1">Tahun ajaran akan otomatis berlanjut dari data terakhir</div>
                                @endif
                            </div>
                            
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('klapper.index') }}" class="btn btn-outline-secondary px-3">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary px-3">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection