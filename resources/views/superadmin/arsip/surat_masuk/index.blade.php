@extends('main')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 mt-5 text-center">Arsip Surat Masuk</h1>

    <!-- Alert -->
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah Surat Masuk -->
    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSuratModal">
            <i class="bi bi-plus-lg"></i> Tambah Arsip
        </button>
    </div>

    <!-- Tabel Surat Masuk -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Tanggal Surat</th>
                    <th>Tanggal Terima</th>
                    <th>Asal Surat</th>
                    <th>No Surat</th>
                    <th>Perihal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suratmasuk as $index => $surat)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($surat->tanggal_terima)->format('d M Y') }}</td>
                    <td>{{ $surat->asal_surat }}</td>
                    <td>{{ $surat->nomor_surat }}</td>
                    <td>{{ $surat->perihal }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-info btn-detail" data-id="{{ $surat->id }}" data-bs-toggle="modal" data-bs-target="#detailSuratModal">
                                <i class="bi bi-eye"></i> Detail
                            </button>
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Edit</button>
                            <form action="{{ route('arsip.surat_masuk.destroy', $surat->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
                    <div class="mb-3">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                        <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_terima" class="form-label">Tanggal Terima</label>
                        <input type="date" class="form-control" id="tanggal_terima" name="tanggal_terima" required>
                    </div>
                    <div class="mb-3">
                        <label for="asal_surat" class="form-label">Asal Surat</label>
                        <input type="text" class="form-control" id="asal_surat" name="asal_surat" required>
                    </div>
                    <div class="mb-3">
                        <label for="perihal" class="form-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal" required>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Surat Masuk -->
<div class="modal fade" id="detailSuratModal" tabindex="-1" aria-labelledby="detailSuratModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailSuratModalLabel">Detail Arsip Surat Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nomor Surat:</strong> <span id="nomor_surat"></span></p>
                <p><strong>Tanggal Surat:</strong> <span id="tanggal_surat"></span></p>
                <p><strong>Tanggal Terima:</strong> <span id="tanggal_terima"></span></p>
                <p><strong>Asal Surat:</strong> <span id="asal_surat"></span></p>
                <p><strong>Perihal:</strong> <span id="perihal"></span></p>
                <div id="file"></div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".btn-detail").forEach(button => {
            button.addEventListener("click", function () {
                let suratId = this.getAttribute("data-id");

                fetch(`/arsip/surat_masuk/${suratId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("detail_nomor_surat").innerText = data.nomor_surat;
                        document.getElementById("detail_tanggal_surat").innerText = new Date(data.tanggal_surat).toLocaleDateString("id-ID");
                        document.getElementById("detail_tanggal_terima").innerText = new Date(data.tanggal_terima).toLocaleDateString("id-ID");
                        document.getElementById("detail_asal_surat").innerText = data.asal_surat;
                        document.getElementById("detail_perihal").innerText = data.perihal;

                        let fileContainer = document.getElementById("detail_file_container");
                        if (data.file) {
                            fileContainer.innerHTML = `
                                <p><strong>File:</strong></p>
                                <a href="/storage/${data.file}" class="btn btn-sm btn-primary" target="_blank">
                                    <i class="bi bi-file-earmark-text"></i> Lihat File
                                </a>
                                <a href="/arsip/surat_masuk/${suratId}/download" class="btn btn-sm btn-success">
                                    <i class="bi bi-download"></i> Download File
                                </a>
                            `;
                        } else {
                            fileContainer.innerHTML = `<p class="text-danger"><i class="bi bi-x-circle"></i> Tidak ada file tersedia</p>`;
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    });
</script>


@endsection