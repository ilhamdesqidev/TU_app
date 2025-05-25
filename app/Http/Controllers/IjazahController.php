<?php

namespace App\Http\Controllers;

use App\Models\Ijazah;
use App\Models\Klapper;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
 
class IjazahController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter');

        $query = Ijazah::query()->with('siswa', 'klapper');

        if ($filter && $filter !== 'all') {
            if (str_starts_with($filter, 'klapper-')) {
                $klapperId = explode('-', $filter)[1] ?? null;
                $query->where('klapper_id', $klapperId);
            }
        }

        // Pencarian berdasarkan nama atau NIS
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_siswa', 'like', "%{$searchTerm}%")
                ->orWhere('nis', 'like', "%{$searchTerm}%")
                ->orWhere('nomor_ijazah', 'like', "%{$searchTerm}%");
            });
        }

        $ijazahs = $query->latest()->paginate(10);

        // Ambil daftar klapper dan jumlah ijazah terkait untuk menu filter
        $availableKlappers = Klapper::withCount('ijazahs')->get();
        return view('superadmin.arsip.ijazah.index', compact('ijazahs', 'availableKlappers'));
    }

    public function create()
    {
        $klappers = Klapper::whereHas('siswas', function($query) {
            $query->where('status', 1); // Hanya klapper dengan siswa yang sudah lulus
        })->get();
        
        return view('ijazah.create', compact('klappers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'klapper_id' => 'required|exists:klappers,id',
            'siswa_id' => 'required|exists:siswas,id',
            'nomor_ijazah' => 'required|unique:ijazahs'
        ]);

        $siswa = Siswa::findOrFail($request->siswa_id);

        Ijazah::create([
            'klapper_id' => $request->klapper_id,
            'siswa_id' => $request->siswa_id,
            'nama_siswa' => $siswa->nama_siswa,
            'nis' => $siswa->nis,
            'jurusan' => $siswa->jurusan,
            'tanggal_lulus' => $siswa->tanggal_lulus ?? now(),
            'nomor_ijazah' => $request->nomor_ijazah
        ]);

        return redirect()->route('ijazah.index')->with('success', 'Data ijazah berhasil ditambahkan');
    }

    // Method lainnya (show, edit, update, destroy) bisa disesuaikan kebutuhan

public function download($id)
{
    $ijazah = Ijazah::findOrFail($id);
    
    // Debug: Cek apakah file_path ada
    if (!$ijazah->file_path) {
        abort(404, 'File path tidak ditemukan di database');
    }

    // Debug: Cek apakah file ada di storage
    if (!Storage::disk('public')->exists($ijazah->file_path)) {
        \Log::error("File tidak ditemukan di storage: " . $ijazah->file_path);
        abort(404, 'File tidak ditemukan di storage');
    }

    // Dapatkan path lengkap
    $fullPath = storage_path('app/public/' . $ijazah->file_path);
    
    // Debug: Cek path lengkap
    if (!file_exists($fullPath)) {
        \Log::error("File tidak ditemukan di path: " . $fullPath);
        abort(404, 'File tidak ditemukan di path sistem');
    }

    return response()->download($fullPath);
}
    
    public function upload(Request $request, $id)
{
    $request->validate([
        'file_ijazah' => 'required|mimes:pdf|max:5120' // 5MB
    ]);

    $ijazah = Ijazah::findOrFail($id);

    // Hapus file lama jika ada
    if ($ijazah->file_path && Storage::exists('public/' . $ijazah->file_path)) {
        Storage::delete('public/' . $ijazah->file_path);
    }

    // Simpan file baru
    $file = $request->file('file_ijazah');
    $filename = 'ijazah_' . $ijazah->nomor_ijazah . '_' . time() . '.' . $file->getClientOriginalExtension();
    $path = $file->storeAs('ijazah_files', $filename, 'public');

    // Update database
    $ijazah->update([
        'file_path' => $path
    ]);

    return back()->with('success', 'File ijazah berhasil diupload!');
}
}