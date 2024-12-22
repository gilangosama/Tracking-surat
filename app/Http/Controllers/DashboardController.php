<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Tracking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $suratTracking = Surat::with('lastTracking')->get();

        $suratMasuk = Surat::where('jenis_surat', 'masuk')->count();
        $suratKeluar = Surat::where('jenis_surat', 'keluar')->count();
        $suratSelesai = Tracking::where('status_surat', 'sudah_diterima')->count();
        // dd($suratMasuk);
        return view('dashboard', compact('suratTracking', 'suratMasuk', 'suratKeluar', 'suratSelesai'));
    }
}
