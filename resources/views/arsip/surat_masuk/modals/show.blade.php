<div class="modal fade" id="viewModal{{ $suratMasuk->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $suratMasuk->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewModalLabel">Detail Surat Masuk</h5>
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
                                    <p class="mb-0 fw-bold">{{ $suratMasuk->nomor_surat }}</p>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Tanggal Surat:</small>
                                    <p class="mb-0">
                                        {{ \Carbon\Carbon::parse($suratMasuk->tanggal_surat)->format('d M Y') }}
                                    </p>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Perihal:</small>
                                    <p class="mb-0">{{ $suratMasuk->perihal }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">Detail Penerimaan</h6>
                                <div class="mb-2">
                                    <small class="text-muted">Pengirim:</small>
                                    <p class="mb-0">{{ $suratMasuk->pengirim }}</p>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Tanggal Diterima:</small>
                                    <p class="mb-0">
                                    {{ \Carbon\Carbon::parse($suratMasuk->tanggal_diterima)->format('d M Y') }}
                                    </p>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Status:</small>
                                    <p class="mb-0">
                                        <span class="badge bg-{{ $suratMasuk->status == 'belum_diproses' ? 'warning text-dark' : ($suratMasuk->status == 'sedang_diproses' ? 'info' : 'success') }}">
                                            {{ str_replace('_', ' ', ucfirst($suratMasuk->status)) }}
                                        </span>
                                    </p>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Kategori:</small>
                                    <p class="mb-0">
                                        <span class="badge bg-{{ $suratMasuk->kategori == 'penting' ? 'warning text-dark' : ($suratMasuk->kategori == 'segera' ? 'danger' : 'secondary') }}">
                                            {{ ucfirst($suratMasuk->kategori) }}
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
                        <div class="border rounded p-3 bg-light">
                            @if($suratMasuk->isi_surat)
                                {!! nl2br(e($suratMasuk->isi_surat)) !!}
                            @else
                                <div class="text-center text-muted py-3">
                                    <i class="bi bi-info-circle fs-4"></i>
                                    <p class="mb-0">Tidak ada konten surat yang tercatat</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($suratMasuk->disposisi)
                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Disposisi</h6>
                        <div class="border rounded p-3 bg-light">
                            <div class="row">
                                <div class="col-md-6">
                                    <small class="text-muted">Tujuan:</small>
                                    <p class="mb-2">{{ ucfirst(str_replace('_', ' ', $suratMasuk->disposisi->tujuan_disposisi)) }}</p>
                                    
                                    <small class="text-muted">Prioritas:</small>
                                    <p class="mb-2">{{ ucfirst($suratMasuk->disposisi->prioritas_disposisi) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted">Tenggat Waktu:</small>
                                    <p class="mb-2">
                                        {{ \Carbon\Carbon::parse($suratMasuk->disposisi->tenggat_waktu)->format('d M Y') }}
                                    </p>
                                    
                                    <small class="text-muted">Catatan:</small>
                                    <p class="mb-0">
                                        @if($suratMasuk->disposisi->catatan_disposisi)
                                            {!! nl2br(e($suratMasuk->disposisi->catatan_disposisi)) !!}
                                        @else
                                            <span class="text-muted">Tidak ada catatan</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($suratMasuk->lampiran_path)
                <div class="mb-3">
                    <label class="form-label fw-bold">Lampiran</label>
                    <div class="border rounded p-2 bg-light">
                        <a href="{{ $suratMasuk->lampiran_path }}" 
                        target="_blank" 
                        class="text-decoration-none d-flex align-items-center">
                            <i class="bi bi-file-earmark-{{ $suratMasuk->lampiran_tipe === 'pdf' ? 'pdf' : 'text' }} me-2"></i>
                            <span>{{ $suratMasuk->lampiran_nama }}</span>
                            <small class="ms-2 text-muted">({{ $suratMasuk->lampiran_size }})</small>
                        </a>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                @if(!$suratMasuk->disposisi)
                <a href="{{ route('surat_masuk.disposisi', $suratMasuk->id) }}" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#disposisiModal{{ $suratMasuk->id }}">
                    <i class="bi bi-arrow-right-circle me-1"></i> Disposisi
                </a>
                @endif
                <a href="{{ route('surat_masuk.print', $suratMasuk->id) }}" target="_blank" class="btn btn-success">
                    <i class="bi bi-printer me-1"></i> Cetak
                </a>
            </div>
        </div>
    </div>
</div>