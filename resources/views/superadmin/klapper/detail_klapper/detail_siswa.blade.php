@extends('main')
<link rel="stylesheet" href="/asset/css/detailsiswa.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@section('content')
<div class="container">
    <div class="card detail-card">
        <div class="detail-header">
            <h2>Profil Siswa</h2>
        </div>
        <div class="row">
            <!-- Kolom untuk Foto -->
            <div class="col-md-4 text-center">
                @if ($siswa->foto)
                    <img src="{{ asset('image/' . $siswa->foto) }}" alt="Foto {{ $siswa->nama_siswa }}" class="detail-photo">
                @else
                    <p>Tidak ada foto</p>
                @endif
                <div class="btn-container">
                    @if ($siswa->status != 1 && $siswa->status != 2) <!-- Tampilkan tombol edit hanya jika status siswa bukan Lulus (1) atau Keluar (2) -->
                        <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn-add">
                            <i class="fas fa-edit"></i> Edit Data 
                        </a>
                    @endif
                </div>
                <div class="btn-container">
                    <a href="{{ route('klapper.siswa', $siswa->klapper_id) }}" class="back-link">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Kolom untuk Detail Siswa -->
            <div class="col-md-8">
                <div class="detail-content">
                    <div class="detail-nama pb-2">
                        <span class="display-4 text-shadow fs-custom">{{ $siswa->nama_siswa }}</span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">NIS:</span>
                        <span>{{ $siswa->nis }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">NISN:</span>
                        <span>{{ $siswa->nisn }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tempat,Tanggal Lahir:</span>
                        <span> {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM YYYY') }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Jenis Kelamin:</span>
                        <span>{{ $siswa->gender }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Kelas:</span>
                        <span>{{ $siswa->kelas }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Jurusan:</span>
                        <span>{{ $siswa->jurusan }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Nama Orang Tua:</span>
                        <span>{{ $siswa->nama_orang_tua }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tanggal Masuk:</span>
                        <span>{{ $siswa->tanggal_masuk }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Naik Kelas XI:</span>
                        <span>
                            @if ($siswa->tanggal_naik_kelas_xi)
                                {{ \Carbon\Carbon::parse($siswa->tanggal_naik_kelas_xi)->Isoformat('D MMMM YYYY') }}
                            @else
                                - (Belum Naik Kelas XI)
                            @endif
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Naik Kelas XII:</span>
                        <span>
                            @if ($siswa->tanggal_naik_kelas_xii)
                                {{ \Carbon\Carbon::parse($siswa->tanggal_naik_kelas_xii)->Isoformat('D MMMM YYYY') }}
                            @else
                                - (Belum Naik Kelas XII)
                            @endif
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tanggal Lulus:</span>
                        <span>
                            @if ($siswa->tanggal_lulus)
                                {{ \Carbon\Carbon::parse($siswa->tanggal_lulus)->Isoformat('D MMMM YYYY') }}
                            @else
                                - (Belum Lulus)
                            @endif
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tanggal Keluar:</span>
                        <span>
                            @if ($siswa->tanggal_keluar)
                                {{ \Carbon\Carbon::parse($siswa->tanggal_keluar)->Isoformat('D MMMM YYYY') }}
                            @else
                                - (Tidak Keluar Sekolah)
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
