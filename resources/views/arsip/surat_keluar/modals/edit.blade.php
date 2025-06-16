<div class="modal fade" id="editSuratModal{{ $surat->id }}" tabindex="-1" aria-labelledby="editSuratModalLabel{{ $surat->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editSuratModalLabel{{ $surat->id }}">Edit Surat Keluar</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('surat_keluar.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nomor_surat_edit" class="form-label fw-bold">
                                <i class="bi bi-hash text-warning me-1"></i>Nomor Surat
                            </label>
                            <input type="text" class="form-control" id="nomor_surat_edit" name="nomor_surat" value="{{ $surat->nomor_surat }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_surat_edit" class="form-label fw-bold">
                                <i class="bi bi-calendar-date text-warning me-1"></i>Tanggal Surat
                            </label>
                            <input type="date" class="form-control" id="tanggal_surat_edit" name="tanggal_surat" value="{{ $surat->tanggal_surat->format('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="penerima_edit" class="form-label fw-bold">
                                <i class="bi bi-person text-warning me-1"></i>Penerima
                            </label>
                            <input type="text" class="form-control" id="penerima_edit" name="penerima" value="{{ $surat->penerima }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_pengiriman_edit" class="form-label fw-bold">
                                <i class="bi bi-send text-warning me-1"></i>Tanggal Pengiriman
                            </label>
                            <input type="date" class="form-control" id="tanggal_pengiriman_edit" name="tanggal_pengiriman" value="{{ $surat->tanggal_pengiriman ? $surat->tanggal_pengiriman->format('Y-m-d') : '' }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="perihal_edit" class="form-label fw-bold">
                            <i class="bi bi-chat-left-text text-warning me-1"></i>Perihal
                        </label>
                        <input type="text" class="form-control" id="perihal_edit" name="perihal" value="{{ $surat->perihal }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="kategori_edit" class="form-label fw-bold">
                            <i class="bi bi-tag text-warning me-1"></i>Kategori
                        </label>
                        <select class="form-select" id="kategori_edit" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="penting" {{ $surat->kategori == 'penting' ? 'selected' : '' }}>Penting</option>
                            <option value="segera" {{ $surat->kategori == 'segera' ? 'selected' : '' }}>Segera</option>
                            <option value="biasa" {{ $surat->kategori == 'biasa' ? 'selected' : '' }}>Biasa</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status_edit" class="form-label fw-bold">
                            <i class="bi bi-check-circle text-warning me-1"></i>Status
                        </label>
                        <select class="form-select" id="status_edit" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="draft" {{ $surat->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="dikirim" {{ $surat->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                            <option value="diterima" {{ $surat->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="isi_surat_edit" class="form-label fw-bold">
                            <i class="bi bi-file-text text-warning me-1"></i>Isi Surat
                        </label>
                        <textarea class="form-control" id="isi_surat_edit" name="isi_surat" rows="5" required>{{ $surat->isi_surat }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="lampiran_edit" class="form-label fw-bold">
                            <i class="bi bi-paperclip text-warning me-1"></i>Lampiran Baru
                        </label>
                        <input class="form-control" type="file" id="lampiran_edit" name="lampiran[]" multiple>
                        <div class="form-text">Kosongkan jika tidak ingin mengganti lampiran</div>
                    </div>

                    @if($surat->lampiran)
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="bi bi-files text-warning me-1"></i>Lampiran Sebelumnya
                        </label>
                        <div class="border rounded p-3 bg-light">
                            @foreach(explode('|', $surat->lampiran) as $file)
                                @if($file)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="existing_files[]" value="{{ $file }}" id="file-{{ $loop->index }}" checked>
                                    <label class="form-check-label" for="file-{{ $loop->index }}">
                                        <a href="{{ route('surat_keluar.download', ['surat_keluar' => $surat->id, 'filename' => basename($file)]) }}" 
                                        target="_blank"
                                        download="{{ pathinfo($file, PATHINFO_BASENAME) }}">
                                            {{ pathinfo($file, PATHINFO_BASENAME) }}
                                        </a>
                                    </label>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>