<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klapper;
use DB;

class KlapperController extends Controller
{
    public function index()
    {
        $klapper = DB::table('klapper')->get();
        return view('klapper', ['klapper' => $klapper]);
    }

    public function create()
    {
        return view('admin.klapper.tambahdataklapper');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'nama_buku' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:255',
        ]);

    
        DB::table('klapper')->insert([
            'nama_buku' => $request->nama_buku,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return redirect('klapper')->with('status', 'Data berhasil ditambah!');
    }

    public function show($id)
    {
        
        $klapper = Klapper::findOrFail($id);
        return view('show', compact('klapper')); 
    }

    public function delete($id)
    {
                                                
        $klapper = Klapper::findOrFail($id);
        $klapper->delete();

        return redirect('klapper')->with('status', 'Data berhasil dihapus!');
    }
}
