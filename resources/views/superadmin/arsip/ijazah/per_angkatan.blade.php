<h2>Arsip Ijazah - {{ $klapper->nama_buku }}</h2>

<table>
    <thead>
        <tr>
            <th>NIS</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Kelas</th>
            <th>Tanggal Lulus</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ijazahs as $siswa)
        <tr>
            <td>{{ $siswa->nis }}</td>
            <td>{{ $siswa->nama_siswa }}</td>
            <td>{{ strtoupper($siswa->jurusan) }}</td>
            <td>{{ $siswa->kelas }}</td>
            <td>{{ $siswa->tanggal_lulus }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
