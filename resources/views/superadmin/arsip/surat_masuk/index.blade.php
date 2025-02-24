@extends('main')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 mt-5 text-center">Arsip Surat Masuk</h1>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Add Button -->
    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSuratModal">
            <i class="bi bi-plus-lg"></i> Tambah Arsip
        </button>
    </div>

    <!-- Main Table -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Tanggal Surat</th>
                    <th width="15%">Tanggal Terima</th>
                    <th width="15%">Asal Surat</th>
                    <th width="15%">No Surat</th>
                    <th width="20%">Perihal</th>
                    <th width="15%">Aksi</th>
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
                            <button class="btn btn-sm btn-info btn-detail" data-id="{{ $surat->id }}" 
                                    data-bs-toggle="modal" data-bs-target="#detailSuratModal">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning btn-edit" data-id="{{ $surat->id }}"
                                    data-bs-toggle="modal" data-bs-target="#editSuratModal">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('arsip.surat_masuk.destroy', $surat->id) }}" 
                                  method="POST" class="d-inline" id="deleteForm{{ $surat->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" 
                                        onclick="confirmDelete({{ $surat->id }})">
                                    <i class="bi bi-trash"></i>
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

<!-- Add Modal -->
<div class="modal fade" id="tambahSuratModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Arsip Surat Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('arsip.surat_masuk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" name="nomor_surat" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                        <input type="date" class="form-control" name="tanggal_surat" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_terima" class="form-label">Tanggal Terima</label>
                        <input type="date" class="form-control" name="tanggal_terima" required>
                    </div>
                    <div class="mb-3">
                        <label for="asal_surat" class="form-label">Asal Surat</label>
                        <input type="text" class="form-control" name="asal_surat" required>
                    </div>
                    <div class="mb-3">
                        <label for="perihal" class="form-label">Perihal</label>
                        <textarea class="form-control" name="perihal" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File</label>
                        <input type="file" class="form-control" name="file" accept=".pdf,.doc,.docx">
                        <small class="text-muted">Format: PDF, DOC, DOCX (Max: 5MB)</small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editSuratModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Arsip Surat Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" name="nomor_surat" id="edit_nomor_surat" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_tanggal_surat" class="form-label">Tanggal Surat</label>
                        <input type="date" class="form-control" name="tanggal_surat" id="edit_tanggal_surat" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_tanggal_terima" class="form-label">Tanggal Terima</label>
                        <input type="date" class="form-control" name="tanggal_terima" id="edit_tanggal_terima" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_asal_surat" class="form-label">Asal Surat</label>
                        <input type="text" class="form-control" name="asal_surat" id="edit_asal_surat" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_perihal" class="form-label">Perihal</label>
                        <textarea class="form-control" name="perihal" id="edit_perihal" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_file" class="form-label">Upload File Baru (Opsional)</label>
                        <input type="file" class="form-control" name="file" accept=".pdf,.doc,.docx">
                        <small class="text-muted">Format: PDF, DOC, DOCX (Max: 5MB)</small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailSuratModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Arsip Surat Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">Nomor Surat</th>
                                <td width="70%" id="detail_nomor_surat"></td>
                            </tr>
                            <tr>
                                <th>Tanggal Surat</th>
                                <td id="detail_tanggal_surat"></td>
                            </tr>
                            <tr>
                                <th>Tanggal Terima</th>
                                <td id="detail_tanggal_terima"></td>
                            </tr>
                            <tr>
                                <th>Asal Surat</th>
                                <td id="detail_asal_surat"></td>
                            </tr>
                            <tr>
                                <th>Perihal</th>
                                <td id="detail_perihal"></td>
                            </tr>
                            <tr>
                                <th>File</th>
                                <td id="detail_file_container"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle Detail Button Click
    document.querySelectorAll('.btn-detail').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            fetch(`/arsip/surat-masuk/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detail_nomor_surat').textContent = data.nomor_surat;
                    document.getElementById('detail_tanggal_surat').textContent = new Date(data.tanggal_surat).toLocaleDateString('id-ID');
                    document.getElementById('detail_tanggal_terima').textContent = new Date(data.tanggal_terima).toLocaleDateString('id-ID');
                    document.getElementById('detail_asal_surat').textContent = data.asal_surat;
                    document.getElementById('detail_perihal').textContent = data.perihal;
                    
                    const fileContainer = document.getElementById('detail_file_container');
                    if (data.file) {
                        fileContainer.innerHTML = `
                            <div class="btn-group">
                                <a href="/storage/${data.file}" class="btn btn-sm btn-primary" target="_blank">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <a href="/arsip/surat-masuk/${id}/download" class="btn btn-sm btn-success">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </div>`;
                    } else {
                        fileContainer.innerHTML = '<span class="text-danger">Tidak ada file</span>';
                    }
                });
        });
    });

    // Handle Edit Button Click
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            fetch(`/arsip/surat-masuk/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_nomor_surat').value = data.nomor_surat;
                    document.getElementById('edit_tanggal_surat').value = data.tanggal_surat;
                    document.getElementById('edit_tanggal_terima').value = data.tanggal_terima;
                    document.getElementById('edit_asal_surat').value = data.asal_surat;
                    document.getElementById('edit_perihal').value = data.perihal;
                    document.getElementById('editForm').action = `/arsip/surat-masuk/${id}`;
                });
        });
    });
});

// Delete Confirmation
function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus arsip ini?')) {
        document.getElementById(`deleteForm${id}`).submit();
    }
}
</script>
@endpush
@endsection