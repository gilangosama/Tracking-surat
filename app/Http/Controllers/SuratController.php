<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function masuk()
    {
        $suratMasuk = Surat::where('user_id', auth()->id())
            ->where('jenis', 'masuk')
            ->latest()
            ->get();

        return view('surat.masuk', compact('suratMasuk'));
    }

    public function keluar()
    {
        $suratKeluar = Surat::where('user_id', auth()->id())
            ->where('jenis', 'keluar')
            ->latest()
            ->get();

        return view('surat.keluar', compact('suratKeluar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string',
            'jenis' => 'required|in:masuk,keluar',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required|string',
            'nomor_pengirim' => 'required|string',
            'penerima' => 'required|string',
            'nomor_penerima' => 'required|string',
            'alamat_penerima' => 'required|string',
            'path' => 'required|string',
            'perihal' => 'required|string',
        ]);
        // dd($request);

        Surat::create([
            'user_id' => Auth::id(),
            'nomor_surat' => $request->nomor_surat,
            'jenis' => $request->jenis,
            'tanggal_surat' => $request->tanggal_surat,
            'pengirim' => $request->pengirim,
            'nomor_pengirim' => $request->nomor_pengirim,
            'penerima' => $request->penerima,
            'nomor_penerima' => $request->nomor_penerima,
            'alamat_penerima' => $request->alamat_penerima,
            'path' => $request->path,
            'perihal' => $request->perihal,
        ]);

        return redirect()->back()->with('success', 'Surat berhasil dikirim!');
    }

    public function suratMasuk(){
        $suratMasuk = Surat::where('jenis', 'masuk')->get();
        // dd($suratMasuk);

        return view('surat.masuk', compact('suratMasuk'));
    }
    public function suratKeluar(){
        $suratKeluar = Surat::where('jenis', 'keluar')->get();
        // dd($suratKeluar);

        return view('surat.keluar', compact('suratKeluar'));
    }

    public function download(Surat $surat)
    {
        return Storage::download($surat->path, $surat->nama_file);
    }

    public function preview(Surat $surat)
    {
        return response()->file(Storage::path($surat->path));
    }

    public function destroy(Surat $surat)
    {
        Storage::delete($surat->path);
        $surat->delete();

        return back()->with('success', 'Surat berhasil dihapus');
    }


} 