@extends('main')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 mt-5">Welcome to Arsip Surat Masuk</h1>

    <!-- Tombol Tambah Surat Masuk -->
    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSuratModal">
            Tambah Arsip Surat Masuk
        </button>
    </div>

    <!-- Tabel Surat Masuk -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Pengirim</th>
                <th>Perihal</th>
                <th>Tanggal Surat</th>
                <th>Penerima</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suratmasuk as $index => $surat)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $surat->nomor_surat }}</td>
                <td>{{ $surat->pengirim }}</td>
                <td>{{ $surat->perihal }}</td>
                <td>{{ $surat->tanggal_surat }}</td>
                <td>{{ $surat->penerima }}</td>
                <td>
                    @if($surat->file)
                        <a href="{{ asset('storage/' . $surat->file) }}" target="_blank" class="btn btn-sm btn-info">Lihat File</a>
                    @else
                        Tidak ada file
                    @endif
                </td>
                <td>
                    <button class="btn btn-sm btn-warning">Edit</button>
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Surat Masuk -->
<div class="modal fade" id="tambahSuratModal" tabindex="-1" aria-labelledby="tambahSuratModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSuratModalLabel">Tambah Arsip Surat Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('arsip.surat_masuk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nomor_surat" class="form-label">Nomor Surat</label>
                            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pengirim" class="form-label">Pengirim</label>
                            <input type="text" class="form-control" id="pengirim" name="pengirim" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="perihal" class="form-label">Perihal</label>
                            <input type="text" class="form-control" id="perihal" name="perihal" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                            <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="penerima" class="form-label">Penerima</label>
                            <input type="text" class="form-control" id="penerima" name="penerima">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="file" class="form-label">Upload File</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".pdf,.doc,.docx,.jpg,.png">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
