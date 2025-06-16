<div class="modal fade" id="tambahSuratModal" tabindex="-1" aria-labelledby="tambahSuratLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="tambahSuratLabel">Tambah Surat Masuk</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('surat_masuk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nomor_surat" class="form-label fw-bold">Nomor Surat</label>
                            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_surat" class="form-label fw-bold">Tanggal Surat</label>
                            <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pengirim" class="form-label fw-bold">Pengirim</label>
                            <input type="text" class="form-control" id="pengirim" name="pengirim" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_diterima" class="form-label fw-bold">Tanggal Diterima</label>
                            <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="perihal" class="form-label fw-bold">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal" required>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kategori" class="form-label fw-bold">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="penting">Penting</option>
                                <option value="segera">Segera</option>
                                <option value="biasa">Biasa</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="belum_diproses" selected>Belum Diproses</option>
                                <option value="sedang_diproses">Sedang Diproses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="isi_surat" class="form-label fw-bold">Isi Surat</label>
                        <textarea class="form-control" id="isi_surat" name="isi_surat" rows="5"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="lampiran" class="form-label fw-bold">Lampiran</label>
                        <input class="form-control" type="file" id="lampiran" name="lampiran[]" multiple>
                        <div class="form-text">Format: PDF, DOC, XLS, JPG (maks. 10MB per file)</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>