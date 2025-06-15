<div class="modal fade" id="editSuratModal" tabindex="-1" aria-labelledby="editSuratLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editSuratLabel">Edit Surat Masuk</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('surat_masuk.update', $suratMasuk->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nomor_surat" class="form-label fw-bold">Nomor Surat</label>
                            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ $suratMasuk->nomor_surat }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_surat" class="form-label fw-bold">Tanggal Surat</label>
                            <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="{{ $suratMasuk->tanggal_surat->format('Y-m-d') }}" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pengirim" class="form-label fw-bold">Pengirim</label>
                            <input type="text" class="form-control" id="pengirim" name="pengirim" value="{{ $suratMasuk->pengirim }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_diterima" class="form-label fw-bold">Tanggal Diterima</label>
                            <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" value="{{ $suratMasuk->tanggal_diterima->format('Y-m-d') }}" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="perihal" class="form-label fw-bold">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal" value="{{ $suratMasuk->perihal }}" required>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kategori" class="form-label fw-bold">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="penting" {{ $suratMasuk->kategori == 'penting' ? 'selected' : '' }}>Penting</option>
                                <option value="segera" {{ $suratMasuk->kategori == 'segera' ? 'selected' : '' }}>Segera</option>
                                <option value="biasa" {{ $suratMasuk->kategori == 'biasa' ? 'selected' : '' }}>Biasa</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="belum_diproses" {{ $suratMasuk->status == 'belum_diproses' ? 'selected' : '' }}>Belum Diproses</option>
                                <option value="sedang_diproses" {{ $suratMasuk->status == 'sedang_diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                <option value="selesai" {{ $suratMasuk->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="isi_surat" class="form-label fw-bold">Isi Surat</label>
                        <textarea class="form-control" id="isi_surat" name="isi_surat" rows="5">{{ $suratMasuk->isi_surat }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="lampiran" class="form-label fw-bold">Lampiran Baru</label>
                        <input class="form-control" type="file" id="lampiran" name="lampiran[]" multiple>
                        <div class="form-text">Kosongkan jika tidak ingin mengganti lampiran</div>
                    </div>
                    
                    @if($suratMasuk->lampiran->count() > 0)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Lampiran Saat Ini</label>
                        <div class="border rounded p-3 bg-light">
                            <ul class="list-unstyled mb-0">
                                @foreach($suratMasuk->lampiran as $lampiran)
                                <li class="mb-2">
                                    <a href="{{ Storage::url($lampiran->path) }}" target="_blank" class="text-decoration-none">
                                        <i class="bi bi-paperclip me-1"></i> Lampiran {{ $loop->iteration }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
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