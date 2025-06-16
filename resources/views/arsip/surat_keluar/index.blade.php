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
                                <i class="bi bi-envelope-paper me-2"></i>Arsip Surat Keluar
                            </h1>
                            <p class="text-muted mb-0">Manajemen dokumen surat keluar</p>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#createSuratModal">
                                <i class="bi bi-plus-circle me-1"></i> Tambah Surat
                            </button>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter dan Pencarian -->
    <form id="filterForm" method="GET" action="{{ route('surat_keluar.index') }}">
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
                                <select class="form-select shadow-sm" name="category" id="category-filter">
                                    <option value="">Semua Kategori</option>
                                    <option value="penting" {{ request('category') == 'penting' ? 'selected' : '' }}>Penting</option>
                                    <option value="segera" {{ request('category') == 'segera' ? 'selected' : '' }}>Segera</option>
                                    <option value="biasa" {{ request('category') == 'biasa' ? 'selected' : '' }}>Biasa</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="status-filter" class="form-label fw-bold">
                                    <i class="bi bi-check-circle me-1 text-primary"></i>Status
                                </label>
                                <select class="form-select shadow-sm" name="status" id="status-filter">
                                    <option value="">Semua Status</option>
                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
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
                                    <input type="text" class="form-control" placeholder="Cari berdasarkan nomor surat, penerima, atau perihal..." 
                                           name="search" id="search" value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <div class="w-100">
                                    <button class="btn btn-primary w-100" type="submit" id="searchBtn">
                                        <i class="bi bi-search me-1"></i> Terapkan Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            @if(request()->has('search') || request()->has('category') || request()->has('status') || request()->has('start_date') || request()->has('end_date'))
                            <a href="{{ route('surat_keluar.index') }}" class="btn btn-outline-danger me-2" id="resetFilter">
                                <i class="bi bi-x-circle me-1"></i> Reset Filter
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Table Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-muted"><i class="bi bi-table me-2"></i>Daftar Surat Keluar</h5>
                    <span class="badge bg-primary rounded-pill">{{ $suratKeluars->total() }} Surat</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped border-top">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">Nomor Surat</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Penerima</th>
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suratKeluars as $surat)
                                <tr>
                                    <td class="text-center">{{ ($suratKeluars->currentPage() - 1) * $suratKeluars->perPage() + $loop->iteration }}</td>
                                    <td>{{ $surat->nomor_surat }}</td>
                                    <td>{{ $surat->tanggal_surat->format('d M Y') }}</td>
                                    <td>{{ $surat->penerima }}</td>
                                    <td>{{ Str::limit($surat->perihal, 30) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $surat->kategori == 'penting' ? 'warning text-dark' : ($surat->kategori == 'segera' ? 'danger' : 'secondary') }} rounded-pill">
                                            {{ ucfirst($surat->kategori) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $surat->status == 'draft' ? 'warning text-dark' : ($surat->status == 'dikirim' ? 'info' : 'success') }} rounded-pill">
                                            {{ ucfirst($surat->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#showSuratModal{{ $surat->id }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            
                                            <button type="button" class="btn btn-sm btn-success ms-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editSuratModal{{ $surat->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            
                                            <button type="button" class="btn btn-sm btn-danger ms-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteSuratModal{{ $surat->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                            <p class="mt-2">Belum ada data surat keluar</p>
                                            <button class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createSuratModal">
                                                <i class="bi bi-plus-circle me-1"></i> Tambah Surat Baru
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="card-footer bg-white">
                    {{ $suratKeluars->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Modals -->
@include('arsip.surat_keluar.modals.create')
@foreach($suratKeluars as $surat)
    @include('arsip.surat_keluar.modals.show', ['surat' => $surat])
    @include('arsip.surat_keluar.modals.edit', ['surat' => $surat])
    @include('arsip.surat_keluar.modals.delete', ['surat' => $surat])
@endforeach

<!-- Toast Notification -->
@if(session('success'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bi bi-bell me-2 text-primary"></i>
            <strong class="me-auto">Notifikasi</strong>
            <small>Baru saja</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('success') }}
        </div>
    </div>
</div>
@endif

<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

@endsection