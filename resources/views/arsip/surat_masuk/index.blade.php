@extends('main')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0 rounded-3">
                <div class="card-body bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-0 text-primary fw-bold">
                                <i class="bi bi-envelope me-2"></i>Arsip Surat Masuk
                            </h1>
                            <p class="text-muted mb-0">Manajemen dokumen surat masuk</p>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('surat_masuk.create') }}" class="btn btn-primary rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahSuratModal">
                                <i class="bi bi-plus-circle me-1"></i> Tambah Surat
                            </a>
                            <a href="{{ route('surat_masuk.export') }}" class="btn btn-success rounded-pill shadow-sm ms-2" id="exportBtn">
                                <i class="bi bi-download me-1"></i> Export
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter dan Pencarian -->
    <form method="GET" action="{{ route('surat_masuk.index') }}">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-muted"><i class="bi bi-funnel me-2"></i>Filter Pencarian</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="start-date-filter" class="form-label fw-bold">
                                    <i class="bi bi-calendar me-1 text-primary"></i>Tanggal Mulai
                                </label>
                                <input type="date" class="form-control shadow-sm" name="start_date" id="start-date-filter" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="end-date-filter" class="form-label fw-bold">
                                    <i class="bi bi-calendar me-1 text-primary"></i>Tanggal Akhir
                                </label>
                                <input type="date" class="form-control shadow-sm" name="end_date" id="end-date-filter" value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="category-filter" class="form-label fw-bold">
                                    <i class="bi bi-tag me-1 text-primary"></i>Kategori
                                </label>
                                <select class="form-select shadow-sm" name="kategori" id="category-filter">
                                    <option value="">Semua Kategori</option>
                                    <option value="penting" {{ request('kategori') == 'penting' ? 'selected' : '' }}>Penting</option>
                                    <option value="segera" {{ request('kategori') == 'segera' ? 'selected' : '' }}>Segera</option>
                                    <option value="biasa" {{ request('kategori') == 'biasa' ? 'selected' : '' }}>Biasa</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="status-filter" class="form-label fw-bold">
                                    <i class="bi bi-check-circle me-1 text-primary"></i>Status
                                </label>
                                <select class="form-select shadow-sm" name="status" id="status-filter">
                                    <option value="">Semua Status</option>
                                    <option value="belum_diproses" {{ request('status') == 'belum_diproses' ? 'selected' : '' }}>Belum Diproses</option>
                                    <option value="sedang_diproses" {{ request('status') == 'sedang_diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-9">
                                <label for="search" class="form-label fw-bold">
                                    <i class="bi bi-search me-1 text-primary"></i>Cari
                                </label>
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text bg-primary text-white"><i class="bi bi-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Cari berdasarkan nomor surat, pengirim, atau perihal..." 
                                           name="search" id="search" value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <div class="w-100">
                                    <button class="btn btn-primary w-100" type="submit">
                                        <i class="bi bi-search me-1"></i> Terapkan Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            @if(request()->has('search') || request()->has('kategori') || request()->has('status') || request()->has('start_date') || request()->has('end_date'))
                            <a href="{{ route('surat_masuk.index') }}" class="btn btn-outline-danger me-2">
                                <i class="bi bi-x-circle me-1"></i> Reset Filter
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Bagian Tabel -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-muted"><i class="bi bi-table me-2"></i>Daftar Surat Masuk</h5>
                    <span class="badge bg-primary rounded-pill">{{ $suratMasuks->total() }} Surat</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped border-top">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">Nomor Surat</th>
                                    <th scope="col">Tanggal Surat</th>
                                    <th scope="col">Tanggal Diterima</th>
                                    <th scope="col">Pengirim</th>
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suratMasuks as $surat)
                                <tr>
                                    <td class="text-center">{{ ($suratMasuks->currentPage() - 1) * $suratMasuks->perPage() + $loop->iteration }}</td>
                                    <td>{{ $surat->nomor_surat }}</td>
                                    <td>{{ $surat->tanggal_surat->format('d M Y') }}</td>
                                    <td>{{ $surat->tanggal_diterima->format('d M Y') }}</td>
                                    <td>{{ $surat->pengirim }}</td>
                                    <td>{{ $surat->perihal }}</td>
                                    <td><span class="badge bg-{{ $surat->kategori == 'penting' ? 'warning text-dark' : ($surat->kategori == 'segera' ? 'danger' : 'secondary') }} rounded-pill">{{ ucfirst($surat->kategori) }}</span></td>
                                    <td><span class="badge bg-{{ $surat->status == 'belum_diproses' ? 'warning text-dark' : ($surat->status == 'sedang_diproses' ? 'info' : 'success') }} rounded-pill">{{ str_replace('_', ' ', ucfirst($surat->status)) }}</span></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <!-- View Button -->
                                            <button type="button" 
                                                    class="btn btn-sm btn-primary"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#viewModal{{ $surat->id }}"
                                                    title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            
                                            <!-- Edit Button -->
                                            <button type="button"
                                                    class="btn btn-sm btn-success mx-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $surat->id }}"
                                                    title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            
                                            <!-- Delete Button -->
                                            <button type="button"
                                                    class="btn btn-sm btn-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $surat->id }}"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            
                                            <!-- Disposisi Button -->
                                            <button type="button"
                                                    class="btn btn-sm btn-info ms-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#disposisiModal{{ $surat->id }}"
                                                    title="Disposisi">
                                                <i class="bi bi-arrow-right-circle"></i>
                                            </button>
                                            @include('arsip.surat_masuk.modals.disposisi', ['suratMasuk' => $surat])
                                        </div>
                                        
                                        <!-- Include Modals for each row -->
                                        @include('arsip.surat_masuk.modals.show', ['suratMasuk' => $surat])
                                        @include('arsip.surat_masuk.modals.edit', ['suratMasuk' => $surat])
                                        @include('arsip.surat_masuk.modals.delete', ['suratMasuk' => $surat])
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                            <p class="mt-2">Belum ada data surat masuk</p>
                                            <a href="{{ route('surat_masuk.create') }}" class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#tambahSuratModal">
                                                <i class="bi bi-plus-circle me-1"></i> Tambah Surat Baru
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pagination Section -->
                <!-- Pagination Section -->
                <div class="card-footer bg-light border-0 py-3 shadow-sm">
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center gap-3">
                        <div class="order-2 order-lg-1">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary fs-7 me-2">
                                    {{ $suratMasuks->firstItem() }} - {{ $suratMasuks->lastItem() }}
                                </span>
                                <span class="text-muted small">dari</span>
                                <span class="badge bg-info ms-2 fs-7">
                                    {{ $suratMasuks->total() }}
                                </span>
                                <span class="text-muted small ms-1">data</span>
                            </div>
                        </div>
                        <nav aria-label="Page navigation" class="order-1 order-lg-2">
                            <div class="d-flex justify-content-center">
                                <div class="pagination-container">
                                    {{ $suratMasuks->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Modal Files -->
@include('arsip.surat_masuk.modals.create')
@includeWhen(isset($suratMasuk), 'arsip.surat_masuk.modals.edit')
@includeWhen(isset($suratMasuk), 'arsip.surat_masuk.modals.show')   
@includeWhen(isset($suratMasuk), 'arsip.surat_masuk.modals.disposisi')
@includeWhen(isset($suratMasuk), 'arsip.surat_masuk.modals.delete')

<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

<!-- Bootstrap JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection