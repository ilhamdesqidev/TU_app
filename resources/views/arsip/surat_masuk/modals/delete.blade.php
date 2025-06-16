<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('surat_masuk.destroy', $suratMasuk->id) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                    </div>
                    <p>Anda yakin ingin menghapus surat masuk dengan nomor:</p>
                    <p class="fw-bold text-center">{{ $suratMasuk->nomor_surat }}</p>
                    <p>Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait surat tersebut.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>