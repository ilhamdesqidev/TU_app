<!DOCTYPE html>
<html>
<head>
    <title>Cetak Surat Keluar - {{ $suratKeluar->nomor_surat }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        @page {
            size: A4 portrait;
            margin: 1cm;
        }
        
        @media print {
            * {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
            }
            
            html, body {
                width: 210mm;
                height: 297mm;
                margin: 0 !important;
                padding: 0 !important;
                overflow: hidden !important;
                background: white !important;
                font-size: 11px !important;
                line-height: 1.2 !important;
            }
            
            .print-container {
                width: 190mm !important;
                height: 277mm !important;
                margin: 0 !important;
                padding: 0 !important;
                overflow: hidden !important;
                display: flex !important;
                flex-direction: column !important;
            }
            
            .print-header {
                height: 40mm !important;
                flex-shrink: 0 !important;
            }
            
            .print-content {
                flex: 1 !important;
                overflow: hidden !important;
                display: flex !important;
                flex-direction: column !important;
            }
            
            .print-footer {
                height: 10mm !important;
                flex-shrink: 0 !important;
            }
            
            .isi-surat-print {
                flex: 1 !important;
                overflow: hidden !important;
                font-size: 10px !important;
                line-height: 1.3 !important;
            }
            
            .lampiran-print {
                max-height: 25mm !important;
                overflow: hidden !important;
            }
            
            h1 { font-size: 16px !important; margin: 2px 0 !important; }
            h2 { font-size: 14px !important; margin: 2px 0 !important; }
            h4 { font-size: 12px !important; margin: 3px 0 !important; }
            .card { margin: 2px 0 !important; }
            .card-body { padding: 4px !important; }
            .badge { font-size: 8px !important; }
            
            .no-print { display: none !important; }
        }
        
        @media screen {
            body { 
                background-color: #f8f9fa;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            
            .preview-container {
                max-width: 210mm;
                min-height: 297mm;
                margin: 20px auto;
                background: white;
                box-shadow: 0 0 20px rgba(0,0,0,0.1);
                padding: 1cm;
            }
        }
        
        .header-gradient {
            background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
        }
        
        .content-border {
            border-left: 2px solid #0d6efd;
        }
        
        .status-terkirim { 
            background-color: #d1e7dd !important; 
            color: #0f5132 !important; 
        }
        
        .status-draft { 
            background-color: #fff3cd !important; 
            color: #664d03 !important; 
        }
        
        .status-pending { 
            background-color: #cff4fc !important; 
            color: #055160 !important; 
        }
    </style>
</head>
<body>
    <div class="print-container preview-container">
        <!-- Header -->
        <div class="print-header">
            <div class="card border-0 mb-1">
                <div class="card-header header-gradient text-white text-center py-2">
                    <h1 class="fw-light mb-1 text-uppercase">
                        <i class="bi bi-envelope-paper me-2"></i>SURAT KELUAR
                    </h1>
                    <h2 class="fw-normal mb-0">{{ $suratKeluar->nomor_surat }}</h2>
                </div>
            </div>
            
            <!-- Info Grid -->
            <div class="row g-1 mb-1">
                <div class="col-3">
                    <div class="card border-0 bg-light content-border h-100">
                        <div class="card-body p-1">
                            <h6 class="text-muted fw-semibold mb-1" style="font-size: 8px;">
                                <i class="bi bi-calendar3 me-1"></i>TANGGAL
                            </h6>
                            <p class="mb-0 fw-medium" style="font-size: 9px;">{{ $suratKeluar->tanggal_surat->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-4">
                    <div class="card border-0 bg-light content-border h-100">
                        <div class="card-body p-1">
                            <h6 class="text-muted fw-semibold mb-1" style="font-size: 8px;">
                                <i class="bi bi-person-check me-1"></i>PENERIMA
                            </h6>
                            <p class="mb-0 fw-medium text-truncate" style="font-size: 9px;">{{ $suratKeluar->penerima }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-3">
                    <div class="card border-0 bg-light content-border h-100">
                        <div class="card-body p-1">
                            <h6 class="text-muted fw-semibold mb-1" style="font-size: 8px;">
                                <i class="bi bi-tags me-1"></i>KATEGORI
                            </h6>
                            <span class="badge bg-primary" style="font-size: 7px;">
                                {{ strtoupper($suratKeluar->kategori) }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="col-2">
                    <div class="card border-0 bg-light content-border h-100">
                        <div class="card-body p-1 text-center">
                            <h6 class="text-muted fw-semibold mb-1" style="font-size: 8px;">
                                <i class="bi bi-flag me-1"></i>STATUS
                            </h6>
                            <span class="badge status-{{ strtolower($suratKeluar->status) }}" style="font-size: 7px;">
                                {{ strtoupper($suratKeluar->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Perihal -->
            <div class="card border-0 bg-warning bg-opacity-10 mb-1">
                <div class="card-body p-1">
                    <h6 class="text-muted fw-semibold mb-1" style="font-size: 8px;">
                        <i class="bi bi-chat-square-text me-1"></i>PERIHAL
                    </h6>
                    <p class="mb-0 fw-medium" style="font-size: 10px;">{{ $suratKeluar->perihal }}</p>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="print-content">
            <!-- Isi Surat -->
            <div class="mb-1" style="flex: 1; display: flex; flex-direction: column;">
                <h4 class="text-secondary fw-semibold mb-1 border-bottom border-primary pb-1">
                    <i class="bi bi-file-text me-1"></i>ISI SURAT
                </h4>
                <div class="card border-primary border-opacity-25 isi-surat-print">
                    <div class="card-body p-2" style="font-size: 9px; line-height: 1.4; overflow: hidden;">
                        {!! nl2br(e($suratKeluar->isi_surat)) !!}
                    </div>
                </div>
            </div>

            <!-- Lampiran -->
            @if($suratKeluar->lampiran)
            <div class="lampiran-print">
                <h4 class="text-secondary fw-semibold mb-1 border-bottom border-warning pb-1">
                    <i class="bi bi-paperclip me-1"></i>LAMPIRAN
                </h4>
                <div class="card bg-warning bg-opacity-10">
                    <div class="card-body p-1">
                        <div class="row g-1">
                            @php 
                                $files = array_filter(explode('|', $suratKeluar->lampiran));
                                $maxFiles = 6;
                            @endphp
                            @foreach(array_slice($files, 0, $maxFiles) as $index => $file)
                            <div class="col-6">
                                <div class="d-flex align-items-center p-1 bg-white rounded border">
                                    <i class="bi bi-file-earmark text-warning me-1" style="font-size: 10px;"></i>
                                    <span class="text-truncate" style="font-size: 8px;">
                                        {{ pathinfo($file, PATHINFO_BASENAME) }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                            @if(count($files) > $maxFiles)
                            <div class="col-12 text-center">
                                <small class="text-muted" style="font-size: 7px;">
                                    ... dan {{ count($files) - $maxFiles }} file lainnya
                                </small>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="print-footer">
            <div class="text-end pt-1 border-top">
                <small class="text-muted" style="font-size: 7px;">
                    <i class="bi bi-printer me-1"></i>Dicetak pada: {{ now()->format('d/m/Y H:i') }}
                </small>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>