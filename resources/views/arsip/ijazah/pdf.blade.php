<!DOCTYPE html>
<html>
<head>
    <title>Ijazah {{ $ijazah->nama_siswa }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { margin: 0 auto; width: 80%; }
        .footer { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>IJAZAH SEKOLAH MENENGAH KEJURUAN</h2>
        <h3>SMK AMALIAH 1 CIBINONG</h3>
    </div>
    
    <div class="content">
        <p>Diberikan kepada:</p>
        <h4>{{ $ijazah->nama_siswa }}</h4>
        <p>NIS: {{ $ijazah->nis }}</p>
        <p>Jurusan: {{ strtoupper($ijazah->jurusan) }}</p>
        <p>Tahun Ajaran: {{ $ijazah->klapper->tahun_ajaran }}</p>
        <p>Nomor Ijazah: {{ $ijazah->nomor_ijazah }}</p>
    </div>
    
    <div class="footer">
        <p>Cibinong, {{ $ijazah->tanggal_lulus->format('d F Y') }}</p>
        <p>Kepala Sekolah</p>
        <br><br><br>
        <p>(__________________________)</p>
    </div>
</body>
</html>