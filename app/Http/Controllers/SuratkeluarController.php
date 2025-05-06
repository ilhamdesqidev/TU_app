<?php
namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuratKeluarExport;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $suratKeluars = SuratKeluar::latest()->paginate(10);
        return view('superadmin.arsip.surat_keluar.index', compact('suratKeluars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'penerima' => 'required',
            'tanggal_pengiriman' => 'required|date',
            'perihal' => 'required',
            'isi_surat' => 'required',
        ]);

        SuratKeluar::create($request->all());

        return redirect()->back()->with('success', 'Surat berhasil ditambahkan!');
    }

    public function show($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return response()->json($surat);
    }
    
    public function edit($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return response()->json($surat);
    }
    
    public function update(Request $request, $id)
    {
        $surat = SuratMasuk::findOrFail($id);
        $surat->update($request->all());
        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }
    
    public function destroy($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        $surat->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
    
    public function download($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return response()->download(storage_path("app/public/{$surat->file_path}"));
    }
}    