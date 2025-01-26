<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spensasi;

class SpensasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->input('status', 'semua');
        
        $query = Spensasi::query();
        
        if ($status !== 'semua') {
            $query->where('status', $status);
        }
        
        $surat = $query->paginate(10);
        return view('superadmin.spensasi.index',  compact('surat', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriSpensasi = [
            'keluar' => 'keluar',
            'sakit' => 'sakit',
            'pulang' => 'pulang',
        ];
        
        return view('superadmin.spensasi.create', compact('kategoriSpensasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'kategori_spensasi' => 'required|in:keluar,sakit,pulang',
            'jam_pelajaran' => 'nullable|string|max:100',
            'detail_spensasi' => 'required|string',
            'tanggal_spensasi' => 'required|date'
        ]);

        $validatedData['status'] = 'menunggu';

        Spensasi::create($validatedData);

        return redirect()->route('superadmin.spensasi.index')
            ->with('sukses', 'Surat spensasi berhasil dibuat');
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
        $surat = Spensasi::findOrFail($id); // Ambil data surat berdasarkan ID

        if ($surat->status !== 'menunggu') {
            return redirect()->back()->with('error', 'Hanya surat dengan status menunggu yang bisa diedit');
        }

        $kategoriSpensasi = [
            'keluar' => 'keluar',
            'sakit' => 'sakit',
            'pulang' => 'pulang',
        ];

        return view('superadmin.spensasi.edit', compact('surat', 'kategoriSpensasi'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $surat = Spensasi::findOrFail($id); // Ambil data surat berdasarkan ID

        if ($surat->status !== 'menunggu') {
            return redirect()->back()->with('error', 'Hanya surat dengan status menunggu yang bisa diupdate');
        }

        $validatedData = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'kategori_spensasi' => 'required|in:keluar,sakit,pulang',
            'jam_pelajaran' => 'nullable|string|max:100',
            'detail_spensasi' => 'required|string',
            'tanggal_spensasi' => 'required|date'
        ]);

        $surat->update($validatedData);

        return redirect()->route('superadmin.spensasi.index')
            ->with('sukses', 'Surat spensasi berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $surat = Spensasi::findOrFail($id); // Ambil data surat berdasarkan ID

        if ($surat->status !== 'menunggu') {
            return redirect()->back()->with('error', 'Hanya surat dengan status menunggu yang bisa dihapus');
        }

        $surat->delete();

        return redirect()->route('superadmin.spensasi.index')
            ->with('sukses', 'Surat spensasi berhasil dihapus');
    }
}