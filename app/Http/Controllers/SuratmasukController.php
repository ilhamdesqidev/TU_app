<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\Disposisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    public function index()
    {
        $query = SuratMasuk::query();

        // Filter pencarian
        if (request('search')) {
            $query->where(function($q) {
                $q->where('nomor_surat', 'like', '%'.request('search').'%')
                  ->orWhere('pengirim', 'like', '%'.request('search').'%')
                  ->orWhere('perihal', 'like', '%'.request('search').'%');
            });
        }

        // Filter kategori
        if (request('kategori')) {
            $query->where('kategori', request('kategori'));
        }

        // Filter status
        if (request('status')) {
            $query->where('status', request('status'));
        }

        // Filter tanggal
        if (request('start_date') && request('end_date')) {
            $query->whereBetween('tanggal_diterima', [
                request('start_date'),
                request('end_date')
            ]);
        }

        $suratMasuks = $query->with('disposisi')->orderBy('tanggal_diterima', 'desc')->paginate(10);
        
        return view('arsip.surat_masuk.index', compact('suratMasuks'));
    }

    public function create()
    {
        return view('arsip.surat_masuk.modals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|unique:surat_masuks|max:100',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required|max:100',
            'tanggal_diterima' => 'required|date',
            'perihal' => 'required|max:255',
            'isi_surat' => 'nullable',
            'kategori' => 'required|in:penting,segera,biasa',
            'status' => 'required|in:belum_diproses,sedang_diproses,selesai',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
        ]);

        $data = $request->except('lampiran');

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('lampiran_surat_masuk', $fileName, 'public');
            
            $data['lampiran_path'] = '/storage/'.$filePath;
            $data['lampiran_nama'] = $file->getClientOriginalName();
            $data['lampiran_tipe'] = $file->getClientOriginalExtension();
            $data['lampiran_size'] = $file->getSize();
        }

        SuratMasuk::create($data);

        return redirect()->route('surat_masuk.index')
            ->with('success', 'Surat masuk berhasil ditambahkan');
    }

    public function show(SuratMasuk $suratMasuk)
    {
        return view('arsip.surat_masuk.modals.show', compact('suratMasuk'));
    }

    public function edit(SuratMasuk $suratMasuk)
    {
        return view('arsip.surat_masuk.modals.edit', compact('suratMasuk'));
    }

    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|max:100|unique:surat_masuks,nomor_surat,'.$suratMasuk->id,
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required|max:100',
            'tanggal_diterima' => 'required|date',
            'perihal' => 'required|max:255',
            'isi_surat' => 'nullable',
            'kategori' => 'required|in:penting,segera,biasa',
            'status' => 'required|in:belum_diproses,sedang_diproses,selesai',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
        ]);

        $data = $request->except('lampiran');

        if ($request->hasFile('lampiran')) {
            // Hapus file lama jika ada
            if ($suratMasuk->lampiran_path && Storage::exists(str_replace('/storage/', 'public/', $suratMasuk->lampiran_path))) {
                Storage::delete(str_replace('/storage/', 'public/', $suratMasuk->lampiran_path));
            }

            $file = $request->file('lampiran');
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('lampiran_surat_masuk', $fileName, 'public');
            
            $data['lampiran_path'] = '/storage/'.$filePath;
            $data['lampiran_nama'] = $file->getClientOriginalName();
            $data['lampiran_tipe'] = $file->getClientOriginalExtension();
            $data['lampiran_size'] = $file->getSize();
        }

        $suratMasuk->update($data);

        return redirect()->route('surat_masuk.index')
            ->with('success', 'Surat masuk berhasil diperbarui');
    }

    public function destroy(SuratMasuk $suratMasuk)
    {
        // Hapus file lampiran jika ada
        if ($suratMasuk->lampiran_path && Storage::exists(str_replace('/storage/', 'public/', $suratMasuk->lampiran_path))) {
            Storage::delete(str_replace('/storage/', 'public/', $suratMasuk->lampiran_path));
        }

        // Hapus disposisi terkait jika ada
        if ($suratMasuk->disposisi) {
            $suratMasuk->disposisi()->delete();
        }

        $suratMasuk->delete();

        return redirect()->route('surat_masuk.index')
            ->with('success', 'Surat masuk berhasil dihapus');
    }

    public function disposisi(SuratMasuk $suratMasuk)
    {
        return view('arsip.surat_masuk.modals.disposisi', compact('suratMasuk'));
    }

    public function storeDisposisi(Request $request, SuratMasuk $suratMasuk)
    {
        $validated = $request->validate([
            'tujuan_disposisi' => 'required|in:kepala_bagian,sekretaris,staff_admin,wadir,direktur',
            'catatan_disposisi' => 'required|string|max:500',
            'tenggat_waktu' => 'required|date|after_or_equal:today',
            'prioritas_disposisi' => 'required|in:tinggi,sedang,rendah'
        ]);

        // Update status surat menjadi sedang diproses
        $suratMasuk->update(['status' => 'sedang_diproses']);

        // Buat disposisi
        $suratMasuk->disposisi()->create($validated);

        return redirect()->route('surat_masuk.index')
            ->with('success', 'Disposisi berhasil dibuat');
    }

    public function print($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return view('arsip.surat_masuk.print', compact('surat'));
    }

    public function export()
    {
        $suratMasuks = SuratMasuk::all();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="Data-Surat-Masuk-'.date('Y-m-d').'.csv"',
        ];

        $callback = function() use ($suratMasuks) {
            $file = fopen('php://output', 'w');
            
            // Header CSV
            fputcsv($file, [
                'No', 'Nomor Surat', 'Tanggal Surat', 'Tanggal Diterima',
                'Pengirim', 'Perihal', 'Kategori', 'Status', 'Lampiran'
            ]);

            // Data
            foreach ($suratMasuks as $index => $surat) {
                fputcsv($file, [
                    $index + 1,
                    $surat->nomor_surat,
                    $surat->tanggal_surat->format('d/m/Y'),
                    $surat->tanggal_diterima->format('d/m/Y'),
                    $surat->pengirim,
                    $surat->perihal,
                    ucfirst($surat->kategori),
                    str_replace('_', ' ', ucfirst($surat->status)),
                    $surat->lampiran_nama ?: '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function downloadLampiran(SuratMasuk $suratMasuk)
    {
        if (!$suratMasuk->lampiran_path) {
            return back()->with('error', 'Tidak ada lampiran untuk surat ini');
        }

        $filePath = str_replace('/storage/', 'public/', $suratMasuk->lampiran_path);
        
        if (!Storage::exists($filePath)) {
            return back()->with('error', 'File lampiran tidak ditemukan');
        }

        return Storage::download($filePath, $suratMasuk->lampiran_nama);
    }
}