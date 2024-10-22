<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klapper; // Perbaiki ini dengan 'App', bukan 'app'
use DB;

class KlapperController extends Controller
{
    public function index()
    {
        $klapper = DB::table('klapper')->get();
        return view('klapper', ['klapper' => $klapper]);
    }

    public function create()
    {
        return view('admin.klapper.tambah_buku');
    }

    public function store(Request $request)
    {
        DB::table('klapper')->insert([
            'nama_buku' => $request->nama_buku,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return redirect('klapper')->with('status', 'Data berhasil ditambah!');
    }

    public function show($id)
    {
        $klapper = Klapper::findOrFail($id); // Mengambil data berdasarkan ID
        return view('admin.klapper.show', compact('klapper')); // Tampilkan di view 'show'
    }

    public function delete($id)
    {
        DB::table('klapper')->where('id', $id)->delete();
        return redirect('klapper')->with('status', 'Data berhasil dihapus!');
    }
}
