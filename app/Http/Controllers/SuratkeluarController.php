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
    // Validasi input
    $request->validate([
        'nomor_surat' => 'required',
        'tanggal_surat' => 'required|date',
        'penerima' => 'required',
        'tanggal_pengiriman' => 'nullable|date',
        'perihal' => 'required',
        'isi_surat' => 'nullable',
        'lampiran.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png'
    ]);

    // Inisialisasi array data dengan field dari request
    $data = $request->only([
        'nomor_surat',
        'tanggal_surat',
        'penerima',
        'tanggal_pengiriman',
        'perihal',
        'isi_surat',
        'kategori',
        'status',
    ]);

    // Menangani lampiran
    $lampiran = [];
    if ($request->hasFile('lampiran')) {
        foreach ($request->file('lampiran') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('lampiran_surat_keluar', $filename, 'public');
            
            $lampiran[] = [
                'nama' => $file->getClientOriginalName(),
                'path' => $path,
                'tipe' => $file->getClientOriginalExtension(),
                'ukuran' => $file->getSize()
            ];
        }
        $data['lampiran'] = $lampiran;
    }

    // Simpan data
    $surat = SuratKeluar::create($data);

    return redirect()->route('surat_keluar.index')->with('success', 'Surat keluar berhasil ditambahkan.');
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