<div class="modal fade" id="showSuratModal{{ $surat->id }}" tabindex="-1" aria-labelledby="showSuratModalLabel{{ $surat->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="showSuratModalLabel{{ $surat->id }}">Detail Surat Keluar</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">Informasi Surat</h6>
                                <div class="mb-2">
                                    <small class="text-muted">Nomor Surat:</small>
                                    <p class="mb-0 fw-bold">{{ $surat->nomor_surat }}</p>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Tanggal Surat:</small>
                                    <p class="mb-0">{{ $surat->tanggal_surat->format('d M Y') }}</p>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Perihal:</small>
                                    <p class="mb-0">{{ $surat->perihal }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">Detail Pengiriman</h6>
                                <div class="mb-2">
                                    <small class="text-muted">Penerima:</small>
                                    <p class="mb-0">{{ $surat->penerima }}</p>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Tanggal Pengiriman:</small>
                                    <p class="mb-0">{{ $surat->tanggal_pengiriman ? $surat->tanggal_pengiriman->format('d M Y') : '-' }}</p>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Status:</small>
                                    <p class="mb-0">
                                        <span class="badge bg-{{ $surat->status == 'draft' ? 'warning text-dark' : ($surat->status == 'dikirim' ? 'info' : 'success') }} rounded-pill">
                                            {{ ucfirst($surat->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Isi Surat</h6>
                        <p class="border rounded p-3 bg-light">{{ $surat->isi_surat }}</p>
                    </div>
                </div>
                @if($surat->lampiran)
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Lampiran</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach(explode('|', $surat->lampiran) as $file)
                                @if($file)
                                <div class="border rounded p-2">
                                    <i class="bi bi-file-earmark"></i>
                                    <a href="{{ route('surat_keluar.download', ['surat_keluar' => $surat->id, 'filename' => basename($file)]) }}" 
                                    target="_blank"
                                    download="{{ pathinfo($file, PATHINFO_BASENAME) }}">
                                        {{ pathinfo($file, PATHINFO_BASENAME) }}
                                    </a>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('surat_keluar.print', $surat->id) }}" class="btn btn-success" target="_blank">
                    <i class="bi bi-printer me-1"></i> Cetak
                </a>
            </div>
        </div>
    </div>
</div>