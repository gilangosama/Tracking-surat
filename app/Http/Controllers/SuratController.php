<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Tracking;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    // public function masuk()
    // {
    //     $suratMasuk = Surat::where('user_id', auth()->id())
    //         ->where('jenis_surat', 'masuk')
    //         ->latest()
    //         ->get();

    //     return view('surat.masuk', compact('suratMasuk'));
    // }

    // public function keluar()
    // {
    //     $suratKeluar = Surat::where('user_id', auth()->id())
    //         ->where('jenis_surat', 'keluar')
    //         ->latest()
    //         ->get();

    //     return view('surat.keluar', compact('suratKeluar'));
    // }

    public function store(Request $request)
    {
        $request->validate([
            'no_surat' => 'required|string',
            'jenis_surat' => 'required|in:masuk,keluar',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required|string',
            'nomor_pengirim' => 'required|string',
            'penerima' => 'required|string',
            'nomor_penerima' => 'required|string',
            'alamat_penerima' => 'required|string',
            'path' => 'required|mimes:pdf,doc,docx|max:2048',
            'perihal' => 'required|string',
        ], [
            'path.mimes' => 'File harus berupa PDF atau Word (.doc, .docx).',
            'path.required' => 'File surat harus diunggah.',
            'path.max' => 'Ukuran file maximal 2MB.'
        ]);

        if ($request->hasFile('path')) {
            // Tentukan nama file yang akan disimpan
            $fileName = 'surat_' . time() . '.' . $request->file('path')->getClientOriginalExtension();
            $filePath = $request->file('path')->storeAs('uploads/surat', $fileName);
        }
        
        // Generate unique 10-digit random ID
        // do {
        //     $randomId = random_int(1000000000, 9999999999); // 10 digit
        // } while (Surat::where('id', $randomId)->exists());
        // dd($request, $filePath, );

        $surat = Surat::create([
            'id_admin' => Auth::user()->id_admin,
            'no_surat' => $request->no_surat,
            'jenis_surat' => $request->jenis_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'pengirim' => $request->pengirim,
            'no_pengirim' => $request->nomor_pengirim,
            'penerima' => $request->penerima,
            'no_penerima' => $request->nomor_penerima,
            'alamat_penerima' => $request->alamat_penerima,
            'path' => $filePath,
            'perihal' => $request->perihal,
            'lampiran' => $request->lampiran
        ]);

        Tracking::create([
            'id_surat' => $surat->id_surat,
            'lokasi' => 'post office',
            'status_surat' => 'diproses',
            'tanggal_tracking' => Carbon::now()
        ]);

        ActivityLog::create([
            'id_user' => Auth::user()->id_user,
            'id_admin' => Auth::user()->id_admin,
            'aksi' => 'melakukan input surat',
            'deskripsi' => 'Melakukan input surat yang akan di kirim.' 
        ]);
        

        return redirect()->back()->with('success', 'Surat berhasil dikirim!');
    }

    public function suratMasuk(){
        $suratMasuk = Surat::where('jenis_surat', 'masuk')->get();
        // dd($suratMasuk);

        return view('surat.masuk', compact('suratMasuk'));
    }
    public function suratKeluar(){
        $suratKeluar = Surat::with('admin')->where('jenis_surat', 'keluar')->get();
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