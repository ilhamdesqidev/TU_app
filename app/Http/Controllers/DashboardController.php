<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\Klapper;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Siswa::where('status', 0)->count();
        $jumlahAngkatan = Klapper::count();

        return view('welcome', compact('jumlahSiswa', 'jumlahAngkatan'));
    }
}
