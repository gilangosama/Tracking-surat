<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Tracking;
use Illuminate\Http\Request;
use PDF; // Pastikan sudah install package barryvdh/laravel-dompdf

class LaporanController extends Controller
{
    public function index()
    {
        $suratMasuk = Surat::where('jenis_surat', 'masuk')->get();
        $suratKeluar = Surat::where('jenis_surat', 'keluar')->get();
        $suratSelesai = Tracking::where('status_surat', 'sudah diterima')->get();
        
        return view('laporan.index', compact('suratMasuk', 'suratKeluar', 'suratSelesai'));
    }

    public function downloadPDF(Request $request)
    {
        $jenisSurat = $request->jenis_surat;
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalAkhir = $request->tanggal_akhir;

        $query = Surat::with(['user', 'lastTracking']);

        if ($jenisSurat) {
            $query->where('jenis_surat', $jenisSurat);
        }

        if ($tanggalMulai && $tanggalAkhir) {
            $query->whereBetween('tanggal_surat', [$tanggalMulai, $tanggalAkhir]);
        }

        $suratList = $query->get();

        $pdf = PDF::loadView('laporan.pdf', [
            'suratList' => $suratList,
            'jenisSurat' => $jenisSurat,
            'tanggalMulai' => $tanggalMulai,
            'tanggalAkhir' => $tanggalAkhir
        ]);

        return $pdf->download('laporan-surat.pdf');
    }
}
