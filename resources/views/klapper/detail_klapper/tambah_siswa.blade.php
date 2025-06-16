@extends('main')

@section('content')
<div class="bg-light py-3">
    <div class="container">
        <div class="row mb-2">
            <div class="col-lg-8 col-md-10 mx-auto text-center">
                <h3 class="fw-bold text-primary mb-2">
                    <i class="fas fa-user-graduate me-2"></i>Tambah Data Siswa
                </h3>
                <p class="text-muted mb-2">Masukkan informasi lengkap siswa pada form di bawah ini</p>
                <div class="d-flex justify-content-center">
                    <div class="border-bottom border-primary" style="width: 50px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-0 pt-3 pb-0 px-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                            <i class="fas fa-user-plus text-primary"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Form Data Siswa</h5>
                            <p class="text-muted small mb-0">Isi dengan data yang valid dan lengkap</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('siswa.store', $klappersId) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="kelas" value="{{ $minClass }}">
                        
                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <label for="nis" class="form-label fw-semibold">
                                    <i class="fas fa-id-card me-1 text-primary"></i> NIS
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group has-validation">
                                    <input type="text" name="nis" id="nis" class="form-control rounded-start @error('nis') is-invalid @enderror" 
                                           placeholder="Contoh: 20210001" required onkeypress="return isNumberKey(event)"
                                           value="{{ old('nis') }}">
                                    <span class="input-group-text bg-light rounded-end">
                                        <i class="fas fa-hashtag text-muted"></i>
                                    </span>
                                    @error('nis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <small class="text-muted">Nomor Induk Siswa (hanya angka)</small>
                            </div>
                            <div class="col-md-6">
                                <label for="nisn" class="form-label fw-semibold">
                                    <i class="fas fa-fingerprint me-1 text-primary"></i> NISN
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group has-validation">
                                    <input type="text" name="nisn" id="nisn" class="form-control rounded-start @error('nisn') is-invalid @enderror" 
                                           placeholder="Contoh: 0012345678" required onkeypress="return isNumberKey(event)"
                                           value="{{ old('nisn') }}">
                                    <span class="input-group-text bg-light rounded-end">
                                        <i class="fas fa-hashtag text-muted"></i>
                                    </span>
                                    @error('nisn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <small class="text-muted">Nomor Induk Siswa Nasional (hanya angka)</small>
                            </div>
                        </div>
                        
                        <div class="mb-2">
                            <label for="nama_siswa" class="form-label fw-semibold">
                                <i class="fas fa-user me-1 text-primary"></i> Nama Siswa
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama_siswa" id="nama_siswa" class="form-control rounded @error('nama_siswa') is-invalid @enderror" 
                                   placeholder="Masukkan nama lengkap siswa" required value="{{ old('nama_siswa') }}">
                            @error('nama_siswa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Nama lengkap sesuai dokumen resmi</small>
                        </div>
                        
                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <label for="tempat_lahir" class="form-label fw-semibold">
                                    <i class="fas fa-map-marker-alt me-1 text-primary"></i> Tempat Lahir
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control rounded @error('tempat_lahir') is-invalid @enderror" 
                                       placeholder="Masukkan kota kelahiran" required value="{{ old('tempat_lahir') }}">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="text-muted">Kota tempat siswa dilahirkan</small>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label fw-semibold">
                                    <i class="fas fa-calendar-day me-1 text-primary"></i> Tanggal Lahir
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control rounded @error('tanggal_lahir') is-invalid @enderror" 
                                       required value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="text-muted">Format: YYYY-MM-DD</small>
                            </div>
                        </div>
                        
                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <label for="gender" class="form-label fw-semibold">
                                    <i class="fas fa-venus-mars me-1 text-primary"></i> Gender
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="gender" id="gender" class="form-select rounded @error('gender') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Gender</option>
                                    <option value="laki-laki" {{ old('gender') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="text-muted">Jenis kelamin siswa</small>
                            </div>
                            <div class="col-md-6">
                                <label for="sekolah" class="form-label fw-semibold">
                                    <i class="fas fa-school me-1 text-primary"></i> Sekolah
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="sekolah" id="sekolah" class="form-select rounded @error('sekolah') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Sekolah</option>
                                    <option value="smk_amaliah_1" {{ old('sekolah') == 'smk_amaliah_1' ? 'selected' : '' }}>SMK Amaliah 1</option>
                                    <option value="smk_amaliah_2" {{ old('sekolah') == 'smk_amaliah_2' ? 'selected' : '' }}>SMK Amaliah 2</option>
                                </select>
                                @error('sekolah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="text-muted">Pilih sekolah siswa</small>
                            </div>
                        </div>
                        
                        <div class="mb-2">
                            <label for="jurusan" class="form-label fw-semibold">
                                <i class="fas fa-graduation-cap me-1 text-primary"></i> Jurusan
                                <span class="text-danger">*</span>
                            </label>
                            <select name="jurusan" id="jurusan" class="form-select rounded @error('jurusan') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih Jurusan</option>
                                @if(old('sekolah') == 'smk_amaliah_1')
                                    <option value="an" {{ old('jurusan') == 'an' ? 'selected' : '' }}>AN - Animasi</option>
                                    <option value="pplg" {{ old('jurusan') == 'pplg' ? 'selected' : '' }}>PPLG - Pengembangan Perangkat Lunak dan Gim</option>
                                    <option value="tjkt" {{ old('jurusan') == 'tjkt' ? 'selected' : '' }}>TJKT - Teknik Jaringan Komputer dan Telekomunikasi</option>
                                    <option value="dkv" {{ old('jurusan') == 'dkv' ? 'selected' : '' }}>DKV - Desain Komunikasi Visual</option>
                                @elseif(old('sekolah') == 'smk_amaliah_2')
                                    <option value="mp" {{ old('jurusan') == 'mp' ? 'selected' : '' }}>MP - Manajemen Perkantoran</option>
                                    <option value="akl" {{ old('jurusan') == 'akl' ? 'selected' : '' }}>AKL - Akuntansi dan Keuangan Lembaga</option>
                                    <option value="br" {{ old('jurusan') == 'br' ? 'selected' : '' }}>BR - Bisnis Ritel</option>
                                    <option value="lps" {{ old('jurusan') == 'lps' ? 'selected' : '' }}>LPS - Layanan Perbankan Syariah</option>
                                    <option value="dpb" {{ old('jurusan') == 'dpb' ? 'selected' : '' }}>DPB - Desain Produk Busana</option>
                                @endif
                            </select>
                            @error('jurusan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Pilih jurusan sesuai dengan sekolah</small>
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

                        @if($minClass != 'X')
                        <div class="mb-2">
                            <label for="alasan_masuk" class="form-label fw-semibold">
                                <i class="fas fa-comment-dots me-1 text-primary"></i> Alasan Masuk
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="alasan_masuk" id="alasan_masuk" class="form-control rounded @error('alasan_masuk') is-invalid @enderror" 
                                      rows="2" placeholder="Jelaskan alasan siswa masuk di kelas {{ $minClass }}" required>{{ old('alasan_masuk') }}</textarea>
                            @error('alasan_masuk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Contoh: Pindahan dari sekolah lain, mengulang tahun ajaran, dll.</small>
                        </div>
                        @endif
                        
                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <label for="nama_ibu" class="form-label fw-semibold">
                                    <i class="fas fa-female me-1 text-primary"></i> Nama Ibu
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_ibu" id="nama_ibu" class="form-control rounded @error('nama_ibu') is-invalid @enderror" 
                                       placeholder="Masukkan nama ibu kandung" required value="{{ old('nama_ibu') }}">
                                @error('nama_ibu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="text-muted">Nama lengkap ibu kandung</small>
                            </div>
                            <div class="col-md-6">
                                <label for="nama_ayah" class="form-label fw-semibold">
                                    <i class="fas fa-male me-1 text-primary"></i> Nama Ayah
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_ayah" id="nama_ayah" class="form-control rounded @error('nama_ayah') is-invalid @enderror" 
                                       placeholder="Masukkan nama ayah kandung" required value="{{ old('nama_ayah') }}">
                                @error('nama_ayah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="text-muted">Nama lengkap ayah kandung</small>
                            </div>
                        </div>
                        
                        <div class="mb-2">
                            <label for="tanggal_masuk" class="form-label fw-semibold">
                                <i class="fas fa-calendar-check me-1 text-primary"></i> Tanggal Masuk
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control rounded @error('tanggal_masuk') is-invalid @enderror" 
                                   required value="{{ old('tanggal_masuk', date('Y-m-d')) }}">
                            @error('tanggal_masuk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Tanggal siswa mulai bersekolah</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="foto" class="form-label fw-semibold">
                                <i class="fas fa-camera me-1 text-primary"></i> Foto
                            </label>
                            <input type="file" name="foto" id="foto" class="form-control rounded @error('foto') is-invalid @enderror" accept="image/*">
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Unggah foto terbaru siswa (opsional, format: JPG, PNG)</small>
                        </div>
                        
                        <div class="alert alert-light border rounded-2 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                <div>
                                    <p class="mb-0 small">Pastikan seluruh data yang dimasukkan sudah benar dan sesuai dengan dokumen resmi. 
                                    Field yang bertanda <span class="text-danger">*</span> wajib diisi.</p>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 mb-3">
                            <i class="fas fa-save me-2"></i> Simpan Data
                        </button>
                    </form>
                    
                    <div class="text-center">
                        <a href="{{ route('klapper.show', $klappersId) }}" class="text-decoration-none text-primary fw-semibold">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Halaman Klapper
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to restrict input to numbers only
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    // Auto-capitalize inputs
    document.querySelectorAll('input[type="text"]').forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/\b\w/g, function(l) { 
                return l.toUpperCase(); 
            });
        });
    });

    // Load jurusan based on selected sekolah
    document.getElementById('sekolah').addEventListener('change', function() {
        const sekolah = this.value;
        const jurusanSelect = document.getElementById('jurusan');
        
        // Clear existing options
        jurusanSelect.innerHTML = '<option value="" disabled selected>Pilih Jurusan</option>';
        
        // Add options based on selected school
        if (sekolah === 'smk_amaliah_1') {
            const jurusanSMK1 = [
                { value: 'an', label: 'AN - Animasi' },
                { value: 'pplg', label: 'PPLG - Pengembangan Perangkat Lunak dan Gim' },
                { value: 'tjkt', label: 'TJKT - Teknik Jaringan Komputer dan Telekomunikasi' },
                { value: 'dkv', label: 'DKV - Desain Komunikasi Visual' }
            ];
            
            jurusanSMK1.forEach(item => {
                jurusanSelect.innerHTML += `<option value="${item.value}">${item.label}</option>`;
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
                jurusanSelect.innerHTML += `<option value="${item.value}">${item.label}</option>`;
            });
        }
    });

    // Initialize jurusan based on old sekolah value if exists
    document.addEventListener('DOMContentLoaded', function() {
        const sekolah = document.getElementById('sekolah').value;
        if (sekolah) {
            document.getElementById('sekolah').dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection