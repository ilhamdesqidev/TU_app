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
        DB::table('show')->insert([
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
            'foto' => $request->foto,
        ]);

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
    // $data_siswa = DB::table('data_siswa')->where('id', $iddetail_siswa)->first();
    // return view('admin.klapper.detail_siswa', compact('data_siswa'));
        // $show = show::findOrFail($id); // Mengambil data berdasarkan ID
        // return view('show', compact('show')); // Tampilkan di view 'show'
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
