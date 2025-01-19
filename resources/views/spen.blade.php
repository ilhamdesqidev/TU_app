@extends('main')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Form Surat Dispensasi Sekolah</h1>
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h4>Buat Surat Dispensasi</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('dispensasi.store') }}" method="POST">
                @csrf
                <!-- Nama Siswa -->
                <div class="mb-3">
                    <label for="nama_siswa" class="form-label">Nama Siswa</label>
                    <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" placeholder="Masukkan nama siswa" required>
                </div>
                
                <!-- Kelas -->
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Masukkan kelas siswa (contoh: XI IPA 2)" required>
                </div>
                
                <!-- Tanggal Dispensasi -->
                <div class="mb-3">
                    <label for="tanggal_dispensasi" class="form-label">Tanggal Dispensasi</label>
                    <input type="date" name="tanggal_dispensasi" id="tanggal_dispensasi" class="form-control" required>
                </div>
                
                <!-- Alasan Dispensasi -->
                <div class="mb-3">
                    <label for="alasan" class="form-label">Alasan Dispensasi</label>
                    <textarea name="alasan" id="alasan" class="form-control" rows="3" placeholder="Masukkan alasan dispensasi" required></textarea>
                </div>
                
                <!-- Tujuan -->
                <div class="mb-3">
                    <label for="tujuan" class="form-label">Tujuan</label>
                    <textarea name="tujuan" id="tujuan" class="form-control" rows="3" placeholder="Masukkan tujuan dispensasi" required></textarea>
                </div>

                <!-- Tombol Submit -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Buat Surat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
