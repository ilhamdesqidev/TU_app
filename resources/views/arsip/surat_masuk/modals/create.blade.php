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
                    <!-- Tampilkan error validasi -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nomor_surat" class="form-label fw-bold">Nomor Surat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" 
                                   id="nomor_surat" name="nomor_surat" required
                                   value="{{ old('nomor_surat') }}">
                            @error('nomor_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_surat" class="form-label fw-bold">Tanggal Surat <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_surat') is-invalid @enderror" 
                                   id="tanggal_surat" name="tanggal_surat" required
                                   value="{{ old('tanggal_surat') }}">
                            @error('tanggal_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pengirim" class="form-label fw-bold">Pengirim <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('pengirim') is-invalid @enderror" 
                                   id="pengirim" name="pengirim" required
                                   value="{{ old('pengirim') }}">
                            @error('pengirim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_diterima" class="form-label fw-bold">Tanggal Diterima <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_diterima') is-invalid @enderror" 
                                   id="tanggal_diterima" name="tanggal_diterima" 
                                   value="{{ old('tanggal_diterima', date('Y-m-d')) }}" required>
                            @error('tanggal_diterima')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="perihal" class="form-label fw-bold">Perihal <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('perihal') is-invalid @enderror" 
                               id="perihal" name="perihal" required
                               value="{{ old('perihal') }}">
                        @error('perihal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kategori" class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('kategori') is-invalid @enderror" 
                                    id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="penting" {{ old('kategori') == 'penting' ? 'selected' : '' }}>Penting</option>
                                <option value="segera" {{ old('kategori') == 'segera' ? 'selected' : '' }}>Segera</option>
                                <option value="biasa" {{ old('kategori') == 'biasa' ? 'selected' : '' }}>Biasa</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="belum_diproses" {{ old('status', 'belum_diproses') == 'belum_diproses' ? 'selected' : '' }}>Belum Diproses</option>
                                <option value="sedang_diproses" {{ old('status') == 'sedang_diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="isi_surat" class="form-label fw-bold">Isi Surat</label>
                        <textarea class="form-control @error('isi_surat') is-invalid @enderror" 
                                  id="isi_surat" name="isi_surat" rows="5">{{ old('isi_surat') }}</textarea>
                        @error('isi_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="lampiran" class="form-label">Lampiran</label>
                        <input type="file" class="form-control @error('lampiran') is-invalid @enderror" 
                               id="lampiran" name="lampiran">
                        @error('lampiran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format: PDF, DOC, DOCX, JPG, PNG (Maks. 10MB)</small>
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