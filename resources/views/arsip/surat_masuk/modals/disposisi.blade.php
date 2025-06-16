<div class="modal fade" id="disposisiModal{{ $surat->id }}" tabindex="-1" aria-labelledby="disposisiModalLabel{{ $surat->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="disposisiModalLabel{{ $surat->id }}">Disposisi Surat</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('surat_masuk.disposisi.store', $surat->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <p>Disposisi untuk surat nomor: <strong>{{ $surat->nomor_surat }}</strong></p>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tujuan_disposisi_{{ $surat->id }}" class="form-label fw-bold">Tujuan Disposisi</label>
                        <select class="form-select" id="tujuan_disposisi_{{ $surat->id }}" name="tujuan_disposisi" required>
                            <option value="">Pilih Tujuan</option>
                            <option value="kepala_bagian">Kepala Bagian</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="staff_admin">Staff Admin</option>
                            <option value="wadir">Wakil Direktur</option>
                            <option value="direktur">Direktur</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="catatan_disposisi_{{ $surat->id }}" class="form-label fw-bold">Catatan</label>
                        <textarea class="form-control" id="catatan_disposisi_{{ $surat->id }}" name="catatan_disposisi" rows="4" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tenggat_waktu_{{ $surat->id }}" class="form-label fw-bold">Tenggat Waktu</label>
                        <input type="date" class="form-control" id="tenggat_waktu_{{ $surat->id }}" name="tenggat_waktu" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="prioritas_disposisi_{{ $surat->id }}" class="form-label fw-bold">Prioritas</label>
                        <select class="form-select" id="prioritas_disposisi_{{ $surat->id }}" name="prioritas_disposisi" required>
                            <option value="">Pilih Prioritas</option>
                            <option value="tinggi">Tinggi</option>
                            <option value="sedang">Sedang</option>
                            <option value="rendah">Rendah</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info text-white">Simpan Disposisi</button>
                </div>
            </form>
        </div>
    </div>
</div>