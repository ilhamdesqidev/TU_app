@extends('main')
@section('content')
<!-- Import CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<div class="container mt-5 mb-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h2><i class="fas fa-user-graduate mr-2"></i> Profil Siswa</h2>
            <p class="mb-0">Detail informasi lengkap siswa</p>
        </div>
        
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <div class="mb-4 border p-2">
                        @if ($siswa->foto)
                            <img src="{{ asset('image/' . $siswa->foto) }}" alt="Foto {{ $siswa->nama_siswa }}" class="img-thumbnail" width="180px" height="240px" style="width: 3x4; height: auto;">
                        @else
                            <img src="{{ asset('image/default.jpg') }}" alt="Foto Default" class="img-thumbnail" width="180px" height="240px" style="width: 3x4; height: auto;">
                        @endif
                    </div>
                    
                    <div class="border p-3 bg-light mb-3">
                        <h4 class="mb-2">{{ $siswa->nama_siswa }}</h4>
                        <p class="mb-1"><i class="fas fa-id-card mr-2 text-primary"></i> {{ $siswa->nis }}</p>
                        <p class="mb-1"><i class="fas fa-graduation-cap mr-2 text-primary"></i> {{ $siswa->kelas }} {{ $siswa->jurusan }}</p>
                    </div>
                    
                    <div class="mt-4">
                        @if ($siswa->status != 1 && $siswa->status != 2)
                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-success m-1">
                                <i class="fas fa-edit"></i> Edit Data
                            </a>
                        @endif
                        
                        <a href="{{ route('klapper.siswa', $siswa->klapper_id) }}" class="btn btn-danger m-1">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true">
                                <i class="fas fa-user mr-2"></i> Data Pribadi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="academic-tab" data-toggle="tab" href="#academic" role="tab" aria-controls="academic" aria-selected="false">
                                <i class="fas fa-book mr-2"></i> Data Akademik
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="family-tab" data-toggle="tab" href="#family" role="tab" aria-controls="family" aria-selected="false">
                                <i class="fas fa-users mr-2"></i> Data Keluarga
                            </a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="myTabContent">
                        <!-- Data Pribadi -->
                        <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="bg-light" width="40%"><i class="fas fa-user mr-2 text-primary"></i> Nama Lengkap</th>
                                            <td>{{ $siswa->nama_siswa }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-id-card mr-2 text-primary"></i> NIS</th>
                                            <td>{{ $siswa->nis }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-id-badge mr-2 text-primary"></i> NISN</th>
                                            <td>{{ $siswa->nisn }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-map-marker-alt mr-2 text-primary"></i> Tempat Lahir</th>
                                            <td>{{ $siswa->tempat_lahir }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-calendar-day mr-2 text-primary"></i> Tanggal Lahir</th>
                                            <td>{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM YYYY') }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-venus-mars mr-2 text-primary"></i> Jenis Kelamin</th>
                                            <td>{{ $siswa->gender }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Data Akademik -->
                        <div class="tab-pane fade" id="academic" role="tabpanel" aria-labelledby="academic-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="bg-light" width="40%"><i class="fas fa-chalkboard mr-2 text-primary"></i> Kelas</th>
                                            <td>{{ $siswa->kelas }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-microscope mr-2 text-primary"></i> Jurusan</th>
                                            <td>{{ $siswa->jurusan }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-door-open mr-2 text-primary"></i> Tanggal Masuk</th>
                                            <td>{{ \Carbon\Carbon::parse($siswa->tanggal_masuk)->isoFormat('D MMMM YYYY') }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-level-up-alt mr-2 text-primary"></i> Naik Kelas XI</th>
                                            <td>{{ $siswa->tanggal_naik_kelas_xi ? \Carbon\Carbon::parse($siswa->tanggal_naik_kelas_xi)->isoFormat('D MMMM YYYY') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-level-up-alt mr-2 text-primary"></i> Naik Kelas XII</th>
                                            <td>{{ $siswa->tanggal_naik_kelas_xii ? \Carbon\Carbon::parse($siswa->tanggal_naik_kelas_xii)->isoFormat('D MMMM YYYY') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-medal mr-2 text-primary"></i> Tanggal Lulus</th>
                                            <td>{{ $siswa->tanggal_lulus ? \Carbon\Carbon::parse($siswa->tanggal_lulus)->isoFormat('D MMMM YYYY') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-door-closed mr-2 text-primary"></i> Tanggal Keluar</th>
                                            <td>{{ $siswa->tanggal_keluar ? \Carbon\Carbon::parse($siswa->tanggal_keluar)->isoFormat('D MMMM YYYY') : '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Data Keluarga -->
                        <div class="tab-pane fade" id="family" role="tabpanel" aria-labelledby="family-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="bg-light" width="40%"><i class="fas fa-female mr-2 text-primary"></i> Nama Ibu</th>
                                            <td>{{ $siswa->nama_ibu }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-male mr-2 text-primary"></i> Nama Ayah</th>
                                            <td>{{ $siswa->nama_ayah }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer text-center p-3 bg-light">
            <small class="text-muted">
                <i class="fas fa-info-circle mr-1"></i> Terakhir diperbarui: {{ now()->isoFormat('D MMMM YYYY') }}
            </small>
        </div>
    </div>
</div>

<!-- Import JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
@endsection