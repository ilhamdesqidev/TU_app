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
            'kategori' => 'required',
            'status' => 'required',
            'perihal' => 'required',
            'isi_surat' => 'required',
            'penandatangan' => 'required',
            'metode_pengiriman' => 'required',
        ]);

        SuratKeluar::create($request->all());

        return redirect()->back()->with('success', 'Surat berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        SuratKeluar::destroy($id);
        return redirect()->back()->with('success', 'Surat berhasil dihapus!');
    }
}   