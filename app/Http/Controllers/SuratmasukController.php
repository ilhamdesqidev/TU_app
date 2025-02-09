<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;

class SuratmasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratmasuk = SuratMasuk::all();
        return view('superadmin.arsip.surat_masuk.index',compact('suratmasuk')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:surat_masuk',
            'tanggal_surat' => 'required|date',
            'tanggal_terima' => 'required|date',
            'asal_surat' => 'required|string',
            'perihal' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('surat_masuk', 'public');
        }

        SuratMasuk::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_terima' => $request->tanggal_terima,
            'asal_surat' => $request->asal_surat,
            'perihal' => $request->perihal,
            'file' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Surat masuk berhasil ditambahkan!');
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
    public function destroy(SuratMasuk $suratMasuk)
    {
        if ($suratMasuk->file) {
            Storage::disk('public')->delete($suratMasuk->file);
        }

        $suratMasuk->delete();
        return redirect()->route('arsip.surat_masuk.index')->with('success', 'Surat berhasil dihapus');
    }
}