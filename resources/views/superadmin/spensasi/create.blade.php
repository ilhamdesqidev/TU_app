@extends('main')
@section('content')
<div class="container">
    <h1>Buat Surat Spensasi Baru</h1>

    <form action="{{ route('superadmin.spensasi.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Pilih Siswa (Live Search) -->
            <div class="col-md-6">
                <div class="form-group position-relative">
                    <label for="nama_siswa">Pilih Siswa:</label>
                    <input type="text" id="nama_siswa" class="form-control" placeholder="Ketik nama siswa..." autocomplete="off">
                    <ul id="siswa-list" class="list-group position-absolute w-100" style="display: none; z-index: 10;"></ul>
                </div>
            </div>
        </div>

        <!-- Daftar siswa yang dipilih -->
        <div class="form-group mt-3">
            <label>Siswa yang Dipilih:</label>
            <div id="selected-siswa" class="border p-2 rounded bg-light">
                <p class="text-muted">Belum ada siswa yang dipilih.</p>
            </div>
        </div>

        <!-- Hidden input untuk menyimpan data siswa -->
        <input type="hidden" name="siswa_terpilih" id="siswa_terpilih">

        <!-- Kelas (Readonly) -->
        <div class="col-md-6">
    <div class="form-group">
        <label for="kelas">Kelas</label>
        <input type="text" id="kelas" name="kelas" class="form-control" readonly required>
    </div>
</div>


        <!-- Kategori Spensasi -->
        <div class="form-group">
            <label for="kategori_spensasi">Kategori Spensasi</label>
            <select name="kategori_spensasi" class="form-control" required>
                @foreach($kategoriSpensasi as $key => $label)
                    <option value="{{ $key }}" {{ old('kategori_spensasi') == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal dan Jam Mulai -->
        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai Spensasi</label>
            <input type="date" name="tanggal_mulai" class="form-control" required value="{{ old('tanggal_mulai') }}">
        </div>

        <div class="form-group">
            <label for="jam_mulai_spensasi">Jam Mulai Spensasi</label>
            <input type="time" name="jam_mulai_spensasi" class="form-control" required value="{{ old('jam_mulai_spensasi') }}">
        </div>

        <!-- Tanggal dan Jam Selesai -->
        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai Spensasi</label>
            <input type="date" name="tanggal_selesai" class="form-control" required value="{{ old('tanggal_selesai') }}">
        </div>

        <div class="form-group">
            <label for="jam_selesai_spensasi">Jam Selesai Spensasi</label>
            <input type="time" name="jam_selesai_spensasi" class="form-control" required value="{{ old('jam_selesai_spensasi') }}">
        </div>


        <!-- Detail Spensasi -->
        <div class="form-group">
            <label for="detail_spensasi">Detail Spensasi</label>
            <textarea name="detail_spensasi" class="form-control" rows="4" required>{{ old('detail_spensasi') }}</textarea>
        </div>

        <!-- Tanggal Spensasi -->
        <div class="form-group">
            <label for="tanggal_spensasi">Tanggal Spensasi</label>
            <input type="date" name="tanggal_spensasi" class="form-control" required value="{{ old('tanggal_spensasi') ?? date('Y-m-d') }}">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-block">Simpan Surat Spensasi</button>
    </form>
</div>

<style>
    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: bold;
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: 600;
        color: #444;
    }

    input, select, textarea {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 10px;
        font-size: 16px;
    }

    #siswa-list {
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ddd;
        background: white;
    }

    .list-group-item {
        cursor: pointer;
        padding: 10px;
    }

    .list-group-item:hover {
        background: #f1f1f1;
    }

    .btn-primary {
        width: 100%;
        padding: 12px;
        font-size: 18px;
        border-radius: 5px;
    }

    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        h1 {
            font-size: 24px;
        }

        .btn-primary {
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 15px;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function () {
       var siswaTerpilih = []; // Array untuk menyimpan siswa yang dipilih

       $('#nama_siswa').on('keyup', function () {
           var query = $(this).val();
           if (query.length >= 3) {
               $.ajax({
                   url: {!! json_encode(route("superadmin.spensasi.searchSiswa")) !!},
                   type: 'GET',
                   data: { query: query },
                   success: function (data) {
                       var siswaList = $('#siswa-list');
                       siswaList.empty();
                       if (data.length > 0) {
                           siswaList.show();
                           data.forEach(function (siswa) {
                               siswaList.append(
                                   '<li class="list-group-item list-group-item-action" data-nama="' + siswa.nama_siswa + '" data-kelas="' + siswa.kelas + '" data-jurusan="' + siswa.jurusan + '">' +
                                       siswa.nama_siswa + ' (' + siswa.kelas + ' - ' + siswa.jurusan + ')' +
                                   '</li>'
                               );
                           });
                       } else {
                           siswaList.hide();
                       }
                   }
               });
           } else {
               $('#siswa-list').hide();
           }
       });

       $(document).on('click', '#siswa-list li', function () {
           var namaSiswa = $(this).data('nama');
           var kelasSiswa = $(this).data('kelas');
           var jurusanSiswa = $(this).data('jurusan');

           // Cek apakah siswa sudah dipilih sebelumnya
           if (!siswaTerpilih.some(siswa => siswa.nama === namaSiswa)) {
               siswaTerpilih.push({ nama: namaSiswa, kelas: kelasSiswa, jurusan: jurusanSiswa });
               updateSelectedSiswa();
           }

           $('#nama_siswa').val('');
           $('#siswa-list').hide();
       });

       $(document).on('click', '.remove-siswa', function () {
           var nama = $(this).data('nama');
           siswaTerpilih = siswaTerpilih.filter(siswa => siswa.nama !== nama);
           updateSelectedSiswa();
       });

       function updateSelectedSiswa() {
           var container = $('#selected-siswa');
           container.empty();

           if (siswaTerpilih.length === 0) {
               container.html('<p class="text-muted">Belum ada siswa yang dipilih.</p>');
               $('#kelas').val('');
           } else {
               siswaTerpilih.forEach(siswa => {
                   container.append(
                       '<div class="p-2 border rounded mb-2 d-flex justify-content-between">' +
                           '<span>' + siswa.nama + ' (' + siswa.kelas + ' - ' + siswa.jurusan + ')</span>' +
                           '<button class="btn btn-danger btn-sm remove-siswa" data-nama="' + siswa.nama + '">Hapus</button>' +
                       '</div>'
                   );
               });

               // Menggabungkan kelas dan jurusan dari semua siswa yang dipilih
               var kelasSet = [...new Set(siswaTerpilih.map(s => s.kelas))].join(', ');
               var jurusanSet = [...new Set(siswaTerpilih.map(s => s.jurusan))].join(', ');
               
               $('#kelas').val(kelasSet + ' - ' + jurusanSet);
           }

           $('#siswa_terpilih').val(JSON.stringify(siswaTerpilih));
       }
   });
</script>


@endsection
