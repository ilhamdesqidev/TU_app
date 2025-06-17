@extends('main')

@section('content')
<!-- Header Banner -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8 col-md-10 mx-auto text-center">
                <h3 class="fw-bold text-primary mb-3">
                    <i class="fas fa-user-edit me-2"></i>Edit Data Siswa
                </h3>
                <p class="text-muted mb-3">Perbarui informasi siswa pada form di bawah ini</p>
                <div class="d-flex justify-content-center">
                    <div class="border-bottom border-primary" style="width: 50px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card shadow-lg border-0 rounded-4 w-100 mx-auto" style="max-width: 1140px;">
                <!-- Card Header -->
                <div class="card-header bg-white border-0 pt-4 pb-0 px-5">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-user-edit text-primary"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Form Edit Siswa</h5>
                            <p class="text-muted small mb-0">Perbarui data dengan informasi yang valid dan lengkap</p>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-5">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- NIS and NISN -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="nis" class="form-label fw-semibold">
                                    <i class="fas fa-id-card text-primary me-1"></i> NIS
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="nis" id="nis" class="form-control" 
                                           value="{{ $siswa->nis }}" required onkeypress="return isNumberKey(event)">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-hashtag text-muted"></i>
                                    </span>
                                </div>
                                <div class="form-text">Nomor Induk Siswa (hanya angka)</div>
                            </div>
                            <div class="col-md-6">
                                <label for="nisn" class="form-label fw-semibold">
                                    <i class="fas fa-fingerprint text-primary me-1"></i> NISN
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="nisn" id="nisn" class="form-control" 
                                           value="{{ $siswa->nisn }}" required onkeypress="return isNumberKey(event)">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-hashtag text-muted"></i>
                                    </span>
                                </div>
                                <div class="form-text">Nomor Induk Siswa Nasional (hanya angka)</div>
                            </div>
                        </div>
                        
                        <!-- Nama Siswa -->
                        <div class="mb-4">
                            <label for="nama_siswa" class="form-label fw-semibold">
                                <i class="fas fa-user text-primary me-1"></i> Nama Siswa
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama_siswa" id="nama_siswa" class="form-control text-capitalize" 
                                   value="{{ $siswa->nama_siswa }}" required>
                            <div class="form-text">Nama lengkap sesuai dokumen resmi</div>
                        </div>
                        
                        <!-- Tempat & Tanggal Lahir -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="tempat_lahir" class="form-label fw-semibold">
                                    <i class="fas fa-map-marker-alt text-primary me-1"></i> Tempat Lahir
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control text-capitalize" 
                                       value="{{ $siswa->tempat_lahir }}" required>
                                <div class="form-text">Kota tempat siswa dilahirkan</div>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label fw-semibold">
                                    <i class="fas fa-calendar-day text-primary me-1"></i> Tanggal Lahir
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" 
                                       value="{{ $siswa->tanggal_lahir }}" required>
                                <div class="form-text">Format: YYYY-MM-DD</div>
                            </div>
                        </div>
                        
                        <!-- Gender & Sekolah -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="gender" class="form-label fw-semibold">
                                    <i class="fas fa-venus-mars text-primary me-1"></i> Gender
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="gender" id="gender" class="form-select" required>
                                    <option value="laki-laki" {{ strtolower($siswa->gender) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="perempuan" {{ strtolower($siswa->gender) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <div class="form-text">Jenis kelamin siswa</div>
                            </div>
                            <div class="col-md-6">
                                <label for="sekolah" class="form-label fw-semibold">
                                    <i class="fas fa-school text-primary me-1"></i> Sekolah
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="sekolah" id="sekolah" class="form-select" required>
                                    <option value="smk_amaliah_1" {{ strpos($siswa->jurusan, 'an') !== false || strpos($siswa->jurusan, 'pplg') !== false || strpos($siswa->jurusan, 'tjkt') !== false || strpos($siswa->jurusan, 'dkv') !== false ? 'selected' : '' }}>SMK Amaliah 1</option>
                                    <option value="smk_amaliah_2" {{ strpos($siswa->jurusan, 'mp') !== false || strpos($siswa->jurusan, 'akl') !== false || strpos($siswa->jurusan, 'br') !== false || strpos($siswa->jurusan, 'lps') !== false || strpos($siswa->jurusan, 'dpb') !== false ? 'selected' : '' }}>SMK Amaliah 2</option>
                                </select>
                                <div class="form-text">Pilih sekolah siswa</div>
                            </div>
                        </div>
                        
                        <!-- Jurusan -->
                        <div class="mb-4">
                            <label for="jurusan" class="form-label fw-semibold">
                                <i class="fas fa-graduation-cap text-primary me-1"></i> Jurusan
                                <span class="text-danger">*</span>
                            </label>
                            <select name="jurusan" id="jurusan" class="form-select" required>
                                <!-- Options will be loaded via JavaScript -->
                                <option value="{{ $siswa->jurusan }}" selected>{{ ucwords(str_replace('_', ' ', $siswa->jurusan)) }}</option>
                            </select>
                            <div class="form-text">Pilih jurusan sesuai dengan sekolah</div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-layer-group me-1 text-primary"></i> Kelas
                                <span class="text-danger">*</span>
                            </label>
                            <div class="d-flex gap-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                    Kelas {{ $minClass }}
                                </span>
                            </div>
                            <small class="text-muted">
                                @if($minClass != 'X')
                                    <i class="fas fa-info-circle me-1"></i> 
                                    Siswa baru untuk kelas {{ $minClass }} harus memiliki alasan masuk yang valid.
                                @else
                                    Siswa baru kelas X (tidak memerlukan alasan masuk)
                                @endif
                            </small>
                        </div>


            
                        @if($minClass != 'X' || $siswa->alasan_masuk)
                        <div class="mb-2">
                            <label for="alasan_masuk" class="form-label fw-semibold">
                                <i class="fas fa-comment-dots me-1 text-primary"></i> Alasan Masuk
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="alasan_masuk" id="alasan_masuk" class="form-control rounded @error('alasan_masuk') is-invalid @enderror" 
                                    rows="2" placeholder="Jelaskan alasan siswa masuk di kelas {{ $minClass }}">
                                {{ old('alasan_masuk', $siswa->alasan_masuk) }}
                            </textarea>
                            @error('alasan_masuk')
                            <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Contoh: Pindahan dari sekolah lain, mengulang tahun ajaran, dll.</small>
                        </div>
                        @endif

                        

                        <!-- Kelas -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-layer-group text-primary me-1"></i> Kelas
                                <span class="text-danger">*</span>
                            </label>
                            <div class="d-flex flex-wrap gap-3 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelas" id="kelasX" value="X" 
                                           {{ $siswa->kelas == 'X' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kelasX">
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">Kelas X</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelas" id="kelasXI" value="XI" 
                                           {{ $siswa->kelas == 'XI' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kelasXI">
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">Kelas XI</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelas" id="kelasXII" value="XII" 
                                           {{ $siswa->kelas == 'XII' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kelasXII">
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">Kelas XII</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-text mt-2">Pilih tingkat kelas siswa</div>
                        </div>

                        <!-- Nama Orang Tua -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="nama_ibu" class="form-label fw-semibold">
                                    <i class="fas fa-female text-primary me-1"></i> Nama Ibu
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_ibu" id="nama_ibu" class="form-control text-capitalize" 
                                       value="{{ $siswa->nama_ibu }}" required>
                                <div class="form-text">Nama lengkap ibu kandung</div>
                            </div>
                            <div class="col-md-6">
                                <label for="nama_ayah" class="form-label fw-semibold">
                                    <i class="fas fa-male text-primary me-1"></i> Nama Ayah
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_ayah" id="nama_ayah" class="form-control text-capitalize" 
                                       value="{{ $siswa->nama_ayah }}" required>
                                <div class="form-text">Nama lengkap ayah kandung</div>
                            </div>
                        </div>
                        
                        <!-- Tanggal Masuk -->
                        <div class="mb-4">
                            <label for="tanggal_masuk" class="form-label fw-semibold">
                                <i class="fas fa-calendar-check text-primary me-1"></i> Tanggal Masuk
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" 
                                   value="{{ $siswa->tanggal_masuk }}" required>
                            <div class="form-text">Tanggal siswa mulai bersekolah</div>
                        </div>
                        
                        <!-- Foto Upload -->
                        <div class="mb-4">
                            <label for="foto" class="form-label fw-semibold">
                                <i class="fas fa-camera text-primary me-1"></i> Foto
                            </label>
                            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                            <div class="form-text">Unggah foto terbaru siswa (opsional, format: JPG, PNG)</div>
                        </div>
                        
                        <!-- Current Photo -->
                        @if($siswa->foto)
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-image text-primary me-1"></i> Foto Saat Ini
                            </label>
                            <div class="card bg-light border-0 p-3 text-center">
                                <img src="{{ asset('image/' . $siswa->foto) }}" alt="Foto {{ $siswa->nama_siswa }}" 
                                     class="img-thumbnail mx-auto" style="max-height: 200px;">
                                <div class="card-text small text-muted mt-2">Foto yang tersimpan saat ini</div>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Info Alert -->
                        <div class="alert alert-info border-0 rounded-3 mt-4 mb-4">
                            <div class="d-flex">
                                <i class="fas fa-info-circle text-primary me-3 fa-lg mt-1"></i>
                                <div>
                                    <p class="mb-0 small">Pastikan seluruh data yang diperbarui sudah benar dan sesuai dengan dokumen resmi. 
                                    Field yang bertanda <span class="text-danger">*</span> wajib diisi.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Buttons -->
                        <div class="d-flex gap-2 mt-4">
                            <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-outline-secondary rounded-pill py-2 px-4">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill py-2 px-4 ms-auto">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script tetap -->
<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    document.getElementById('sekolah').addEventListener('change', function () {
        const sekolah = this.value;
        const jurusanSelect = document.getElementById('jurusan');
        const currentJurusan = "{{ $siswa->jurusan }}";

        jurusanSelect.innerHTML = '';

        if (sekolah === 'smk_amaliah_1') {
            const jurusanSMK1 = [
                { value: 'an', label: 'AN - Animasi' },
                { value: 'pplg', label: 'PPLG - Pengembangan Perangkat Lunak dan Gim' },
                { value: 'tjkt', label: 'TJKT - Teknik Jaringan Komputer dan Telekomunikasi' },
                { value: 'dkv', label: 'DKV - Desain Komunikasi Visual' }
            ];

            jurusanSMK1.forEach(item => {
                const option = document.createElement('option');
                option.value = item.value;
                option.textContent = item.label;
                if (item.value === currentJurusan) {
                    option.selected = true;
                }
                jurusanSelect.appendChild(option);
            });
        } else if (sekolah === 'smk_amaliah_2') {
            const jurusanSMK2 = [
                { value: 'mp', label: 'MP - Manajemen Perkantoran' },
                { value: 'akl', label: 'AKL - Akuntansi dan Keuangan Lembaga' },
                { value: 'br', label: 'BR - Bisnis Ritel' },
                { value: 'lps', label: 'LPS - Layanan Perbankan Syariah' },
                { value: 'dpb', label: 'DPB - Desain Produk Busana' }
            ];

            jurusanSMK2.forEach(item => {
                const option = document.createElement('option');
                option.value = item.value;
                option.textContent = item.label;
                if (item.value === currentJurusan) {
                    option.selected = true;
                }
                jurusanSelect.appendChild(option);
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('sekolah').dispatchEvent(new Event('change'));
    });
</script>
@endsection
