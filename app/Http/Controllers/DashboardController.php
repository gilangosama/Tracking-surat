<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Tracking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $role = auth()->user()->role;
        if ('admin' == $role) { 
            $suratTracking = Surat::with('lastTracking')->get();
            $suratMasuk = Surat::where('jenis_surat', 'masuk')->count();
            $suratKeluar = Surat::where('jenis_surat', 'keluar')->count();
            $suratSelesai = Tracking::where('status_surat', 'sudah diterima')->count();
            // dd($suratMasuk);
            return view('dashboard', compact('suratTracking', 'suratMasuk', 'suratKeluar', 'suratSelesai'));
        } else {
            $suratTracking = Surat::with('lastTracking')->where('id_user', auth()->user()->id_user)->get();
            $suratMasuk = Surat::where('jenis_surat', 'masuk')->where('id_user', auth()->user()->id_user)->count();
            $suratKeluar = Surat::where('jenis_surat', 'keluar')->where('id_user', auth()->user()->id_user)->count();
            $suratSelesai = Surat::with('trakingStatus')->where('id_user', auth()->user()->id_user)->count();
            return view('dashboard', compact('suratTracking', 'suratMasuk', 'suratKeluar', 'suratSelesai'));
        }
    }
}
