@extends('main')

@section('content')
<div class="bg-light py-4">
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-8 col-md-10 mx-auto text-center">
                <h3 class="fw-bold text-primary mb-2"><i class="fas fa-user-edit me-2"></i>Edit Data Siswa</h3>
                <p class="text-muted mb-2">Perbarui informasi siswa</p>
                <div class="border-bottom border-primary mx-auto" style="width: 50px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="fas fa-user-edit text-primary"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Form Edit Siswa</h5>
                            <p class="text-muted small">Perbarui data dengan informasi valid</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="kelas" value="{{ $siswa->kelas }}">

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-id-card text-primary me-1"></i> NIS*</label>
                                <div class="input-group">
                                    <input type="text" name="nis" class="form-control" value="{{ $siswa->nis }}" required onkeypress="return isNumberKey(event)">
                                    <span class="input-group-text bg-light"><i class="fas fa-hashtag text-muted"></i></span>
                                </div>
                                <small class="text-muted">Nomor Induk Siswa</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-fingerprint text-primary me-1"></i> NISN*</label>
                                <div class="input-group">
                                    <input type="text" name="nisn" class="form-control" value="{{ $siswa->nisn }}" required onkeypress="return isNumberKey(event)">
                                    <span class="input-group-text bg-light"><i class="fas fa-hashtag text-muted"></i></span>
                                </div>
                                <small class="text-muted">Nomor Induk Nasional</small>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><i class="fas fa-user text-primary me-1"></i> Nama Siswa*</label>
                            <input type="text" name="nama_siswa" class="form-control text-capitalize" value="{{ $siswa->nama_siswa }}" required>
                        </div>
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-map-marker-alt text-primary me-1"></i> Tempat Lahir*</label>
                                <input type="text" name="tempat_lahir" class="form-control text-capitalize" value="{{ $siswa->tempat_lahir }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-calendar-day text-primary me-1"></i> Tanggal Lahir*</label>
                                <input type="date" name="tanggal_lahir" class="form-control" value="{{ $siswa->tanggal_lahir }}" required>
                            </div>
                        </div>
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-venus-mars text-primary me-1"></i> Gender*</label>
                                <select name="gender" class="form-select" required>
                                    <option value="laki-laki" {{ strtolower($siswa->gender) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="perempuan" {{ strtolower($siswa->gender) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-school text-primary me-1"></i> Sekolah*</label>
                                <select name="sekolah" id="sekolah" class="form-select" required>
                                    <option value="smk_amaliah_1" {{ strpos($siswa->jurusan, 'an') !== false || strpos($siswa->jurusan, 'pplg') !== false || strpos($siswa->jurusan, 'tjkt') !== false || strpos($siswa->jurusan, 'dkv') !== false ? 'selected' : '' }}>SMK Amaliah 1</option>
                                    <option value="smk_amaliah_2" {{ strpos($siswa->jurusan, 'mp') !== false || strpos($siswa->jurusan, 'akl') !== false || strpos($siswa->jurusan, 'br') !== false || strpos($siswa->jurusan, 'lps') !== false || strpos($siswa->jurusan, 'dpb') !== false ? 'selected' : '' }}>SMK Amaliah 2</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><i class="fas fa-graduation-cap text-primary me-1"></i> Jurusan*</label>
                            <select name="jurusan" id="jurusan" class="form-select" required>
                                <option value="{{ $siswa->jurusan }}" selected>{{ ucwords(str_replace('_', ' ', $siswa->jurusan)) }}</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold"><i class="fas fa-layer-group text-primary me-1"></i> Kelas*</label>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelas" id="kelasX" value="X" {{ $siswa->kelas == 'X' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kelasX"><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">Kelas X</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelas" id="kelasXI" value="XI" {{ $siswa->kelas == 'XI' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kelasXI"><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">Kelas XI</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelas" id="kelasXII" value="XII" {{ $siswa->kelas == 'XII' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kelasXII"><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">Kelas XII</span></label>
                                </div>
                            </div>
                            @if($siswa->kelas != 'X')
                                <small class="text-muted mt-1"><i class="fas fa-info-circle me-1"></i>Alasan masuk diperlukan untuk kelas {{ $siswa->kelas }}</small>
                            @endif
                        </div>

                        @if($siswa->kelas != 'X' || $siswa->alasan_masuk)
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><i class="fas fa-comment-dots text-primary me-1"></i> Alasan Masuk</label>
                            <textarea name="alasan_masuk" class="form-control" rows="2">{{ old('alasan_masuk', $siswa->alasan_masuk) }}</textarea>
                            @if($siswa->kelas != 'X')
                                <small class="text-muted">Wajib diisi untuk kelas {{ $siswa->kelas }}</small>
                            @endif
                        </div>
                        @endif

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-female text-primary me-1"></i> Nama Ibu*</label>
                                <input type="text" name="nama_ibu" class="form-control text-capitalize" value="{{ $siswa->nama_ibu }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-male text-primary me-1"></i> Nama Ayah*</label>
                                <input type="text" name="nama_ayah" class="form-control text-capitalize" value="{{ $siswa->nama_ayah }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><i class="fas fa-calendar-check text-primary me-1"></i> Tanggal Masuk*</label>
                            <input type="date" name="tanggal_masuk" class="form-control" value="{{ $siswa->tanggal_masuk }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-camera text-primary me-1"></i> Foto</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            @if($siswa->foto)
                            <div class="mt-2 text-center">
                                <img src="{{ asset('image/' . $siswa->foto) }}" alt="Foto Siswa" class="img-thumbnail" style="max-height: 150px;">
                                <small class="d-block text-muted mt-1">Foto saat ini</small>
                            </div>
                            @endif
                        </div>
                        
                        <div class="alert alert-info border-0 rounded-3 mt-4">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Pastikan data valid. Field bertanda <span class="text-danger">*</span> wajib diisi.
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        return !(charCode > 31 && (charCode < 48 || charCode > 57));
    }

    const sekolahSelect = document.getElementById('sekolah');
    const jurusanSelect = document.getElementById('jurusan');
    
    const jurusanOptions = {
        'smk_amaliah_1': [
            {value: 'an', label: 'AN - Animasi'},
            {value: 'pplg', label: 'PPLG - Pengembangan Perangkat Lunak dan Gim'},
            {value: 'tjkt', label: 'TJKT - Teknik Jaringan Komputer dan Telekomunikasi'},
            {value: 'dkv', label: 'DKV - Desain Komunikasi Visual'}
        ],
        'smk_amaliah_2': [
            {value: 'mp', label: 'MP - Manajemen Perkantoran'},
            {value: 'akl', label: 'AKL - Akuntansi dan Keuangan Lembaga'},
            {value: 'br', label: 'BR - Bisnis Ritel'},
            {value: 'lps', label: 'LPS - Layanan Perbankan Syariah'},
            {value: 'dpb', label: 'DPB - Desain Produk Busana'}
        ]
    };

    function updateJurusanOptions() {
        const selectedSekolah = sekolahSelect.value;
        jurusanSelect.innerHTML = '<option value="" disabled selected>Pilih Jurusan</option>';
        
        if (selectedSekolah && jurusanOptions[selectedSekolah]) {
            jurusanOptions[selectedSekolah].forEach(option => {
                const optElement = document.createElement('option');
                optElement.value = option.value;
                optElement.textContent = option.label;
                if (option.value === "{{ $siswa->jurusan }}") {
                    optElement.selected = true;
                }
                jurusanSelect.appendChild(optElement);
            });
        }
    }

    sekolahSelect.addEventListener('change', updateJurusanOptions);
    
    document.addEventListener('DOMContentLoaded', function() {
        updateJurusanOptions();
    });
</script>
@endsection