<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    // Tampilkan semua angkatan
    public function index()
    {
        $angkatans = Angkatan::all();
        return view('angkatan.index', compact('angkatans'));
    }

    // Tampilkan form tambah angkatan
    public function create()
    {
        return view('angkatan.create');
    }

    // Simpan data angkatan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:angkatans,nama',
        ]);

        Angkatan::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('angkatan.index')->with('success', 'Angkatan berhasil ditambahkan');
    }
}




