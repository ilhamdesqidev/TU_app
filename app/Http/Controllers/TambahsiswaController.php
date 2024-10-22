<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klapper;

class TambahsiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'nis' => 'required|string|max:255',
            'nama_siswa' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255',
            'tempat_tanggal_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|string|max:255',
            'nama_orang_tua' => 'required|string|max:255',
            'tanggal_masuk' => 'required|string|max:255',
            'tanggal_naik_kelas_xi' => 'nullable|string|max:255',
            'tanggal_naik_kelas_xii' => 'nullable|string|max:255',
            'tanggal_lulus' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        Klapper::create($request->all());

        return redirect()->route('klappers.show')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
