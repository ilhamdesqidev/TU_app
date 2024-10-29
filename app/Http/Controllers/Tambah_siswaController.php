<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tambah_siswa; // Perbaiki ini dengan 'App', bukan 'app'
use DB;

class Tambah_siswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $show = DB::table('show')->get();
        return view('show', ['show' => $show]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.klapper.tambah_siswa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nis' => 'required',
        'nama_siswa' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'gender' => 'required',
        'kelas' => 'required',
        'jurusan' => 'required',
        'angkatan' => 'required',
        'nama_orang_tua' => 'required',
        'tanggal_masuk' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk foto jika ada
    ]);

    // Siapkan data untuk disimpan
    $showData = [
        'nis' => $request->nis,
        'nama_siswa' => $request->nama_siswa,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'gender' => $request->gender,
        'kelas' => $request->kelas,
        'jurusan' => $request->jurusan,
        'angkatan' => $request->angkatan,
        'nama_orang_tua' => $request->nama_orang_tua,
        'tanggal_masuk' => $request->tanggal_masuk,
        'tanggal_naik_kelas_xi' => $request->tanggal_naik_kelas_xi,
        'tanggal_naik_kelas_xii' => $request->tanggal_naik_kelas_xii,
        'tanggal_lulus' => $request->tanggal_lulus,
    ];

    // Cek apakah ada file foto yang di-upload
    if ($request->hasFile('foto')) {
        $foto_file = $request->file('foto');
        $foto_nama = $foto_file->getClientOriginalName();
        $foto_file->move(public_path('image'), $foto_nama);
        $showData['foto'] = $foto_nama; // Tambahkan nama file ke data
    }

    // Simpan data ke database
    DB::table('show')->insert($showData);

    return redirect('show')->with('status', 'Data berhasil ditambah!');
}

    /**
     * Display the specified resource.
     */
    public function detail_siswa($iddetail_siswa)
{
    $data_siswa = DB::table('show')->where('id', $iddetail_siswa)->first();

    if (!$data_siswa) {
        return redirect('show')->with('error', 'Data tidak ditemukan!');
    }

    return view('admin.klapper.detail_siswa', compact('data_siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data_siswa = DB::table('show')->where('id', $id)->first();
        return view('admin.klapper.editdata_siswa', compact('data_siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    DB::table('show')->where('id', $id)->update([
        'nis' => $request->nis,
        'nama_siswa' => $request->nama_siswa,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'gender' => $request->gender,
        'kelas' => $request->kelas,
        'jurusan' => $request->jurusan,
        'angkatan' => $request->angkatan,
        'nama_orang_tua' => $request->nama_orang_tua,
        'tanggal_masuk' => $request->tanggal_masuk,
    ]);

    return redirect('show')->with('status', 'Data berhasil diperbarui!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete($id)
    {
        DB::table('show')->where('id', $id)->delete();
        return redirect('show')->with('status', 'Data berhasil dihapus!');
    }
}
