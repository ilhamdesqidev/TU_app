<?php

namespace App\Http\Controllers;

use App\Models\Ijazah;
use App\Models\Klapper;
use App\Models\Siswa;
use App\Models\Angkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IjazahController extends Controller
{
    // 1. Listing + search global
    public function index(Request $req)
    {
        $q = $req->input('q');
        $ijazahs = Ijazah::with('siswa.klapper')
            ->when($q, fn($qb) => $qb->whereHas('siswa', fn($q2) => 
                 $q2->where('nama_siswa','like',"%{$q}%")))
            ->paginate(20);
        return view('superadmin.arsip.ijazah.index', compact('ijazahs','q'));
    }

    // 2. Listing per angkatan
    public function perAngkatan(Klapper $klapper)
    {
        // ambil siswa pada klapper tersebut dengan ijazah
        $siswa = $klapper->siswa()->with('ijazah')->get();
        return view('ijazah.per-angkatan', compact('klapper','siswa'));
    }

    // 3. Show form create
    public function create(Angkatan $angkatan)
    {

        // Contoh ambil siswa dari angkatan terkait yang belum punya ijazah
        $siswaList = Siswa::where('angkatan_id', $angkatan->id)->doesntHave('ijazah')->orderBy('nama_siswa')->get();
        $klapper = Klapper::where('angkatan_id', $angkatan->id)->first();
        return view('superadmin.arsip.ijazah.create', compact('angkatan', 'siswaList', 'klapper'));
    }
    // 4. Simpan
    public function store(Request $req)
    {
        $data = $req->validate([
            'siswa_id'=>'required|exists:siswa,id',
            'nomor_ijazah'=>'required|unique:ijazahs',
            'tgl_terbit'=>'required|date',
            'file'=>'required|file|mimes:pdf,jpg,png|max:2048',
        ]);
        $data['file_path'] = $req->file('file')->store('ijazah');
        Ijazah::create($data);
        return redirect()->route('ijazah.index')->with('success','Ijazah tersimpan.');
    }

    // 5. Edit
    public function edit(Ijazah $ijazah)
    {
        return view('ijazah.edit', compact('ijazah'));
    }

    public function update(Request $req, Ijazah $ijazah)
    {
        $data = $req->validate([
            'nomor_ijazah'=>"required|unique:ijazahs,nomor_ijazah,{$ijazah->id}",
            'tgl_terbit'=>'required|date',
            'file'=>'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);
        if($req->hasFile('file')){
            // hapus lama
            Storage::delete($ijazah->file_path);
            $data['file_path'] = $req->file('file')->store('ijazah');
        }
        $ijazah->update($data);
        return back()->with('success','Ijazah diperbarui.');
    }

    public function destroy(Ijazah $ijazah)
    {
        Storage::delete($ijazah->file_path);
        $ijazah->delete();
        return back()->with('success','Ijazah dihapus.');
    }

    public function show(Ijazah $ijazah)
    {
        $ijazah->load('siswa.klapper'); // memastikan eager loading
        $klapper = optional($ijazah->siswa)->klapper;
    
        return view('superadmin.arsip.ijazah.show', compact('ijazah', 'klapper'));
    }
    

    
}
