@extends('main')
@section('content')
<head>
    <!-- Tambahkan link Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .detail-card {
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }
        .detail-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .detail-photo {
            width: 100%;
            max-width: 150px;
            border-radius: 8px;
            margin: auto;
        }
        .detail-content {
            flex-grow: 1;
        }
        .detail-item {
            display: flex;
            padding: 8px 0;
            justify-self: star;
            border-bottom: 1px solid #e0e0e0;
        }
        .detail-nama {
            font-weight: bold;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #555;
        }
        .text-shadow {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        .fs-custom {
            font-size: 2rem;
        }
    </style>
</head>
<div class="container">
    <div class="card detail-card">
        <div class="detail-header">
            <h2>Profil Siswa</h2>
        </div>
        
        <div class="row">
            <!-- Kolom untuk Foto -->
            <div class="col-md-4 text-center">
                @if ($data_siswa->foto)
                    <img src="{{ asset('image/' . $data_siswa->foto) }}" alt="Foto {{ $data_siswa->nama_siswa }}" class="detail-photo">
                @else
                    <p>Tidak ada foto</p>
                @endif
                <div class="btn-container">
                <a href="{{ url('klapper/tambahdataklapper') }}" class="btn-add">
                <i class="fas fa-plus"></i> edit data
                </a>
                </div>
                <div class="btn-container">
                <a href="{{ url('klapper/tambahdataklapper') }}" class="btn-add">
                <i class="fas fa-plus"></i> lulus
                </a>
                </div>

            </div>

            <!-- Kolom untuk Detail Siswa -->
            <div class="col-md-8">
                <div class="detail-content">
                    <div class="detail-nama pb-2">
                        <span class="display-4 text-shadow fs-custom">{{ $data_siswa->nama_siswa }}</span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">NIS:</span>
                        <span>{{ $data_siswa->nis }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tempat Lahir</span>
                        <span>{{ $data_siswa->tempat_lahir }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tanggal Lahir</span>
                        <span>{{ $data_siswa->tanggal_lahir }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Jenis Kelamin</span>
                        <span>{{ $data_siswa->gender }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Kelas</span>
                        <span>{{ $data_siswa->kelas }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Jurusan</span>
                        <span>{{ $data_siswa->jurusan }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Angkatan</span>
                        <span>{{ $data_siswa->angkatan }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Nama Orang Tua</span>
                        <span>{{ $data_siswa->nama_orang_tua }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tanggal Masuk</span>
                        <span>{{ $data_siswa->tanggal_masuk }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Naik Kelas XI</span>
                        <span>{{ $data_siswa->tanggal_naik_kelas_xi }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Naik Kelas XII</span>
                        <span>{{ $data_siswa->tanggal_naik_kelas_xii }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tanggal Lulus</span>
                        <span>{{ $data_siswa->tanggal_lulus }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
