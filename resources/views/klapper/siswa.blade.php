@extends('main')
<link rel="stylesheet" href="/asset/css/siswa.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
@section('content')
    <section class="home">
</body>
<div class="detail-container">
    
    
    
    <!-- Daftar siswa terkait klapper -->
    <h1>Data Siswa</h1>

    <form action="{{ route('klapper.show', $klapper->id) }}" method="GET" style="margin-bottom: 20px;">
        <div style="display: flex; gap: 10px; align-items: center;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama atau Jurusan" class="search-input">
            <button type="submit" class="btn-search"><i class="fas fa-search"></i> Cari</button>

            <select name="amaliah" onchange="this.form.submit()" class="form-select" style="width: 200px;">
                <option value="" {{ request('amaliah') == '' ? 'selected' : '' }}>Semua</option>
                <option value="1" {{ request('amaliah') == '1' ? 'selected' : '' }}>SMK Amaliah 1</option>
                <option value="2" {{ request('amaliah') == '2' ? 'selected' : '' }}>SMK Amaliah 2</option>
            </select>
        </div>
    </form>
    
    <div style="display: flex; justify-content: flex-end; gap:10px;">
                <a href="{{ route('siswa.create', $klapper->id) }}" class="btn-lulus"><i class='bx bx-plus-circle'></i></a>

    <!-- Button to trigger the modal -->
    <button type="button" class="btn-lulus" data-bs-toggle="modal" data-bs-target="#tanggalLulusModal">
    Luluskan Semua Pelajar
</button>

<!-- Modal -->
<div class="modal fade" id="tanggalLulusModal" tabindex="-1" aria-labelledby="tanggalLulusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('klapper.lulusSemua', $klapper->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tanggalLulusModalLabel">Masukkan Tanggal Lulus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="tanggal_lulus" class="form-label">Tanggal Lulus:</label>
                    <input type="date" name="tanggal_lulus" id="tanggal_lulus" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Luluskan Semua</button>
                </div>
            </form>
        </div>
    </div>
</div>


    
<!-- Button to trigger modal for Naik Kelas XI -->
<button type="button" class="btn-lulus" data-bs-toggle="modal" data-bs-target="#naikKelasXIModal">
    Naik Kelas XI
</button>

<!-- Modal for Naik Kelas XI -->
<div class="modal fade" id="naikKelasXIModal" tabindex="-1" aria-labelledby="naikKelasXIModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('klapper.naikKelasXI', $klapper->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="naikKelasXIModalLabel">Masukkan Tanggal Naik Kelas XI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="tanggal_naik_kelas_xi" class="form-label">Tanggal:</label>
                    <input type="date" name="tanggal_naik_kelas_xi" id="tanggal_naik_kelas_xi" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Button to trigger modal for Naik Kelas XII -->
<button type="button" class="btn-lulus" data-bs-toggle="modal" data-bs-target="#naikKelasXIIModal">
    Naik Kelas XII
</button>

<!-- Modal for Naik Kelas XII -->
<div class="modal fade" id="naikKelasXIIModal" tabindex="-1" aria-labelledby="naikKelasXIIModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('klapper.naikKelasXII', $klapper->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="naikKelasXIIModalLabel">Masukkan Tanggal Naik Kelas XII</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="tanggal_naik_kelas_xii" class="form-label">Tanggal:</label>
                    <input type="date" name="tanggal_naik_kelas_xii" id="tanggal_naik_kelas_xii" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

    </div>

    
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th style="width: 50px; text-align: center;">NO</th>
            <th style="width: 350px;">Nama</th>
            <th>NIS</th>
            <th>Jurusan</th>
            <th>kelas</th>
            <th>status</th>
            <th>Aksi</th>

            @php 
            $filteredSiswas = $klapper->siswas->filter(function ($siswa) {
                $amaliah = request('amaliah');
                $jurusanAmaliah1 = ['pplg', 'tjkt', 'an'];
                $jurusanAmaliah2 = ['dpb', 'lps', 'akl', 'mp', 'br'];

                if ($amaliah == '1') {
                    return in_array(strtolower($siswa->jurusan), $jurusanAmaliah1);
                } elseif ($amaliah == '2') {
                    return in_array(strtolower($siswa->jurusan), $jurusanAmaliah2);
                }
                return true; // Jika tidak ada filter, tampilkan semua
            });
            @endphp

        </tr>
        @foreach ($filteredSiswas as $siswa)
        <tr>
            <td style="text-align: center;">
                {{ $loop->iteration }}
            </td>
            <td style="text-align: left;">{{ $siswa->nama_siswa }}</td>
            <td>{{ $siswa->nis }}</td>
            <td>{{ strtoupper($siswa->jurusan) }}</td>
            <td>{{ $siswa->kelas }}</td>
            <td>
                @if($siswa->status == 0)
                <span class="badge badge-secondary">
                    <i class="fas fa-user-graduate"></i> Pelajar
                </span>
                @elseif($siswa->status == 1)
                <span class="badge badge-success">
                    <i class="fas fa-graduation-cap"></i> Lulus
                </span>
                @else
                <span class="badge badge-danger">
                    <i class="fas fa-arrow-right-from-bracket"></i> Keluar
                </span>
                @endif
            </td>
            <td>
                <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-success">
                    <i class="fa-solid fa-folder-open"></i>
                </a>
                
                @if($siswa->status == 0) <!-- Tampilkan tombol "Keluar" hanya jika statusnya Pelajar -->
                    <a href="{{ route('klapper.keluar', $siswa->id) }}" class="btn btn-danger">
                        <i class="fas fa-arrow-right-from-bracket"></i>
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
