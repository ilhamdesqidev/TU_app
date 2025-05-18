```blade
@extends('main')

@section('content')
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

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 pt-4 pb-0 px-5">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-user-edit text-primary"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Form Edit Siswa</h5>
                            <p class="text-muted small mb-0">Perbarui data dengan informasi yang valid dan lengkap</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
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
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="nis" class="form-label fw-semibold">
                                    <i class="fas fa-id-card me-1 text-primary"></i> NIS
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="nis" id="nis" class="form-control rounded-start-3" 
                                           value="{{ $siswa->nis }}" required onkeypress="return isNumberKey(event)">
                                    <span class="input-group-text bg-light rounded-end-3">
                                        <i class="fas fa-hashtag text-muted"></i>
                                    </span>
                                </div>
                                <small class="text-muted mt-1 d-block">Nomor Induk Siswa (hanya angka)</small>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="nisn" class="form-label fw-semibold">
                                    <i class="fas fa-fingerprint me-1 text-primary"></i> NISN
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="nisn" id="nisn" class="form-control rounded-start-3" 
                                           value="{{ $siswa->nisn }}" required onkeypress="return isNumberKey(event)">
                                    <span class="input-group-text bg-light rounded-end-3">
                                        <i class="fas fa-hashtag text-muted"></i>
                                    </span>
                                </div>
                                <small class="text-muted mt-1 d-block">Nomor Induk Siswa Nasional (hanya angka)</small>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="nama_siswa" class="form-label fw-semibold">
                                <i class="fas fa-user me-1 text-primary"></i> Nama Siswa
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama_siswa" id="nama_siswa" class="form-control rounded-3" 
                                   value="{{ $siswa->nama_siswa }}" required style="text-transform: capitalize;">
                            <small class="text-muted mt-1 d-block">Nama lengkap sesuai dokumen resmi</small>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="tempat_lahir" class="form-label fw-semibold">
                                    <i class="fas fa-map-marker-alt me-1 text-primary"></i> Tempat Lahir
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control rounded-3" 
                                       value="{{ $siswa->tempat_lahir }}" required style="text-transform: capitalize;">
                                <small class="text-muted mt-1 d-block">Kota tempat siswa dilahirkan</small>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="tanggal_lahir" class="form-label fw-semibold">
                                    <i class="fas fa-calendar-day me-1 text-primary"></i> Tanggal Lahir
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control rounded-3" 
                                       value="{{ $siswa->tanggal_lahir }}" required>
                                <small class="text-muted mt-1 d-block">Format: YYYY-MM-DD</small>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="gender" class="form-label fw-semibold">
                                    <i class="fas fa-venus-mars me-1 text-primary"></i> Gender
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="gender" id="gender" class="form-select rounded-3" required>
                                    <option value="laki-laki" {{ strtolower($siswa->gender) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="perempuan" {{ strtolower($siswa->gender) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <small class="text-muted mt-1 d-block">Jenis kelamin siswa</small>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="sekolah" class="form-label fw-semibold">
                                    <i class="fas fa-school me-1 text-primary"></i> Sekolah
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="sekolah" id="sekolah" class="form-select rounded-3" required>
                                    <option value="smk_amaliah_1" {{ strpos($siswa->jurusan, 'an') !== false || strpos($siswa->jurusan, 'pplg') !== false || strpos($siswa->jurusan, 'tjkt') !== false || strpos($siswa->jurusan, 'dkv') !== false ? 'selected' : '' }}>SMK Amaliah 1</option>
                                    <option value="smk_amaliah_2" {{ strpos($siswa->jurusan, 'mp') !== false || strpos($siswa->jurusan, 'akl') !== false || strpos($siswa->jurusan, 'br') !== false || strpos($siswa->jurusan, 'lps') !== false || strpos($siswa->jurusan, 'dpb') !== false ? 'selected' : '' }}>SMK Amaliah 2</option>
                                </select>
                                <small class="text-muted mt-1 d-block">Pilih asal sekolah siswa</small>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="jurusan" class="form-label fw-semibold">
                                <i class="fas fa-graduation-cap me-1 text-primary"></i> Jurusan
                                <span class="text-danger">*</span>
                            </label>
                            <select name="jurusan" id="jurusan" class="form-select rounded-3" required>
                                <!-- Options will be loaded via JavaScript -->
                                <option value="{{ $siswa->jurusan }}" selected>{{ ucwords(str_replace('_', ' ', $siswa->jurusan)) }}</option>
                            </select>
                            <small class="text-muted mt-1 d-block">Pilih jurusan sesuai dengan sekolah</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-layer-group me-1 text-primary"></i> Kelas
                                <span class="text-danger">*</span>
                            </label>
                            <div class="d-flex gap-3 mt-2">
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
                            <small class="text-muted mt-2 d-block">Pilih tingkat kelas siswa</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="nama_ibu" class="form-label fw-semibold">
                                    <i class="fas fa-female me-1 text-primary"></i> Nama Ibu
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_ibu" id="nama_ibu" class="form-control rounded-3" 
                                       value="{{ $siswa->nama_ibu }}" required style="text-transform: capitalize;">
                                <small class="text-muted mt-1 d-block">Nama lengkap ibu kandung</small>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="nama_ayah" class="form-label fw-semibold">
                                    <i class="fas fa-male me-1 text-primary"></i> Nama Ayah
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_ayah" id="nama_ayah" class="form-control rounded-3" 
                                       value="{{ $siswa->nama_ayah }}" required style="text-transform: capitalize;">
                                <small class="text-muted mt-1 d-block">Nama lengkap ayah kandung</small>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="tanggal_masuk" class="form-label fw-semibold">
                                <i class="fas fa-calendar-check me-1 text-primary"></i> Tanggal Masuk
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control rounded-3" 
                                   value="{{ $siswa->tanggal_masuk }}" required>
                            <small class="text-muted mt-1 d-block">Tanggal siswa mulai bersekolah</small>
                        </div>
                        
                        <div class="mb-4">
                            <label for="foto" class="form-label fw-semibold">
                                <i class="fas fa-camera me-1 text-primary"></i> Foto
                            </label>
                            <input type="file" name="foto" id="foto" class="form-control rounded-3" accept="image/*">
                            <small class="text-muted mt-1 d-block">Unggah foto terbaru siswa (opsional, format: JPG, PNG)</small>
                        </div>
                        
                        @if($siswa->foto)
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-image me-1 text-primary"></i> Foto Saat Ini
                            </label>
                            <div class="mt-2 border rounded-3 p-3 text-center bg-light">
                                <img src="{{ asset('image/' . $siswa->foto) }}" alt="Foto {{ $siswa->nama_siswa }}" 
                                     class="img-thumbnail" style="max-height: 200px;">
                                <p class="small text-muted mt-2 mb-0">Foto yang tersimpan saat ini</p>
                            </div>
                        </div>
                        @endif
                        
                        <div class="alert alert-light border rounded-3 mt-4 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle text-primary me-3 fa-lg"></i>
                                <div>
                                    <p class="mb-0 small">Pastikan seluruh data yang diperbarui sudah benar dan sesuai dengan dokumen resmi. 
                                    Field yang bertanda <span class="text-danger">*</span> wajib diisi.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2 mt-4">
                            <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-outline-secondary rounded-pill py-2 px-4">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill shadow-sm py-2 px-4 ms-auto">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
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

    // Load jurusan based on selected sekolah
    document.getElementById('sekolah').addEventListener('change', function() {
        const sekolah = this.value;
        const jurusanSelect = document.getElementById('jurusan');
        const currentJurusan = "{{ $siswa->jurusan }}";
        
        // Clear existing options
        jurusanSelect.innerHTML = '';
        
        // Add options based on selected school
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

    // Trigger the sekolah change event to populate jurusan on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-capitalize inputs that need capitalization
        const capitalizeInputs = document.querySelectorAll('input[style*="text-transform: capitalize;"]');
        capitalizeInputs.forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/\b\w/g, function(l) { return l.toUpperCase(); });
            });
        });
        
        // Initialize jurusan dropdown based on selected sekolah
        document.getElementById('sekolah').dispatchEvent(new Event('change'));
    });
</script>
@endsection
```