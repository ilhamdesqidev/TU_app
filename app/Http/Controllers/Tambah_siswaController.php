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
            'nama_buku' => $request->nama_buku,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return redirect('show')->with('status', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show = show::findOrFail($id); // Mengambil data berdasarkan ID
        return view('show', compact('show')); // Tampilkan di view 'show'
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
