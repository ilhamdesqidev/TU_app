<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Klapper;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung hanya siswa aktif (status = 2)
        $jumlahSiswaAktif = Siswa::where('status', 2)->count();
        $jumlahAngkatan = Klapper::count();

        return view('welcome', [
            'jumlahSiswaAktif' => $jumlahSiswaAktif,
            'jumlahAngkatan' => $jumlahAngkatan
        ]);
    }
}