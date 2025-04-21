@extends('main')

@section('content')
<div class="bg-light py-4">
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8 col-md-10 mx-auto text-center">
                <h3 class="fw-bold text-primary mb-2">Tambah Data Siswa</h3>
                <p class="text-muted small mb-3">Masukkan data siswa dengan lengkap</p>
            </div>
        </div>
    </div>
</div>

<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
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
                    
                    <form action="{{ route('siswa.store', $klappersId) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nis" class="form-label fw-semibold">NIS</label>
                                <input type="text" name="nis" id="nis" class="form-control rounded-3" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nisn" class="form-label fw-semibold">NISN</label>
                                <input type="text" name="nisn" id="nisn" class="form-control rounded-3" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama_siswa" class="form-label fw-semibold">Nama Siswa</label>
                            <input type="text" name="nama_siswa" id="nama_siswa" class="form-control rounded-3" required style="text-transform: capitalize;">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tempat_lahir" class="form-label fw-semibold">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control rounded-3" required style="text-transform: capitalize;>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control rounded-3" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label fw-semibold">Gender</label>
                                <select name="gender" id="gender" class="form-select rounded-3" required>
                                    <option value="" disabled selected>Pilih Gender</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sekolah" class="form-label fw-semibold">Sekolah</label>
                                <select name="sekolah" id="sekolah" class="form-select rounded-3" required>
                                    <option value="" disabled selected>Pilih Sekolah</option>
                                    <option value="smk_amaliah_1">SMK Amaliah 1</option>
                                    <option value="smk_amaliah_2">SMK Amaliah 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label fw-semibold">Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-select rounded-3" required>
                                <option value="" disabled selected>Pilih Jurusan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kelas</label>
                            <div class="d-flex">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kelas" id="kelasX" value="X" checked>
                                    <label class="form-check-label" for="kelasX">X</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kelas" id="kelasXI" value="XI">
                                    <label class="form-check-label" for="kelasXI">XI</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kelas" id="kelasXII" value="XII">
                                    <label class="form-check-label" for="kelasXII">XII</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_ibu" class="form-label fw-semibold">Nama Ibu</label>
                                <input type="text" name="nama_ibu" id="nama_ibu" class="form-control rounded-3" required style="text-transform: capitalize;>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama_ayah" class="form-label fw-semibold">Nama Ayah</label>
                                <input type="text" name="nama_ayah" id="nama_ayah" class="form-control rounded-3" required style="text-transform: capitalize;>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_masuk" class="form-label fw-semibold">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control rounded-3" required>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label fw-semibold">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control rounded-3">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Data
                        </button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('klapper.show', $klappersId) }}" class="text-decoration-none text-primary fw-semibold">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('sekolah').addEventListener('change', function() {
        const sekolah = this.value;
        const jurusanSelect = document.getElementById('jurusan');
        jurusanSelect.innerHTML = '<option value="" disabled selected>Pilih Jurusan</option>';
        if (sekolah === 'smk_amaliah_1') {
            ['AN', 'PPLG', 'TJKT'].forEach(jurusan => jurusanSelect.innerHTML += `<option value="${jurusan.toLowerCase()}">${jurusan}</option>`);
        } else if (sekolah === 'smk_amaliah_2') {
            ['MP', 'AKL', 'BR', 'LPS', 'DPB'].forEach(jurusan => jurusanSelect.innerHTML += `<option value="${jurusan.toLowerCase()}">${jurusan}</option>`);
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('tanggal_masuk').value = new Date().toISOString().split('T')[0];
    });
</script>
@endsection
