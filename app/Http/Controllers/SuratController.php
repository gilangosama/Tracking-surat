<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Tracking;
use App\Models\ActivityLog;
use App\Models\Lampiran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'no_surat' => 'required|string|unique:surats',
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
            'path.max' => 'Ukuran file maximal 2MB.',
            'unique' => 'Nomor surat sudah ada.'
        ]);

        if ($request->hasFile('path')) {
            // Tentukan nama file yang akan disimpan
            $fileName = 'surat_' . time() . '.' . $request->file('path')->getClientOriginalExtension();
            $filePath = $request->file('path')->storeAs('uploads/surat', $fileName);
        }

        $surat = Surat::create([
            'id_user' => Auth::user()->id_user,
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
        
        if ($surat->jenis_surat == 'masuk') {
            return redirect()->route('surat.masuk')->with('success', 'Surat berhasil diperbarui!');
        }
        return redirect()->route('surat.keluar')->with('success', 'Surat berhasil diperbarui!');
    }

    public function suratMasuk(){
        $role = auth()->user()->role;
        if ('admin' == $role) {
            $suratMasuk = Surat::with('user')->where('jenis_surat', 'masuk')->get();
            return view('surat.masuk', compact('suratMasuk'));
        } else {
            $suratMasuk = Surat::with('user')->where('jenis_surat', 'masuk')->where('id_user', auth()->user()->id_user)->get();
            return view('surat.masuk', compact('suratMasuk'));
        }
    }
    public function suratKeluar(){
        $role = auth()->user()->role;
        if ('admin' == $role) {
            $suratKeluar = Surat::with('user')->where('jenis_surat', 'keluar')->get();
            return view('surat.keluar', compact('suratKeluar'));
        } else {
            $suratKeluar = Surat::with('user')->where('jenis_surat', 'keluar')->where('id_user', auth()->user()->id_user)->get();
            return view('surat.keluar', compact('suratKeluar'));
        }
    }

    public function download(Surat $surat)
    {
        // Pastikan file ada
        if (!Storage::exists($surat->path)) {
            return back()->with('error', 'File tidak ditemukan');
        }

        return Storage::download($surat->path);
    }

    public function preview(Surat $surat)
    {
        // Pastikan file ada
        if (!Storage::exists($surat->path)) {
            return back()->with('error', 'File tidak ditemukan');
        }

        return response()->file(storage_path('app/' . $surat->path));
    }

    public function destroy(Surat $surat)
    {
        Storage::delete($surat->path);
        $surat->delete();

        return back()->with('success', 'Surat berhasil dihapus');
    }

    public function show(Surat $surat)
    {
        return view('surat.show', compact('surat'));
    }

    public function storeLampiran(Request $request, Surat $surat)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'lampiran_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads/lampiran', $fileName);

            Lampiran::create([
                'id_surat' => $surat->id_surat,
                'nama_file' => $file->getClientOriginalName(),
                'path' => $filePath
            ]);

            return redirect()->back()->with('success', 'Lampiran berhasil ditambahkan');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah lampiran');
    }



    public function destroyLampiran(Lampiran $lampiran)
    {
        Storage::delete($lampiran->path);
        $lampiran->delete();

        return back()->with('success', 'Lampiran berhasil dihapus');
    }

    public function edit(Surat $surat)
    {
        return view('surat.create', compact('surat'));
    }

    public function update(Request $request, Surat $surat)
    {
        $request->validate([
            'no_surat' => 'required|string|unique:surats,no_surat,' . $surat->id_surat . ',id_surat',
            'jenis_surat' => 'required|in:masuk,keluar',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required|string',
            'nomor_pengirim' => 'required|string',
            'penerima' => 'required|string',
            'nomor_penerima' => 'required|string',
            'alamat_penerima' => 'required|string',
            'path' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'perihal' => 'required|string',
        ], [
            'path.mimes' => 'File harus berupa PDF atau Word (.doc, .docx).',
            'path.max' => 'Ukuran file maximal 2MB.',
            'unique' => 'Nomor surat sudah ada.'
        ]);

        if ($request->hasFile('path')) {
            // Hapus file lama
            Storage::delete($surat->path);

            // Tentukan nama file yang akan disimpan
            $fileName = 'surat_' . time() . '.' . $request->file('path')->getClientOriginalExtension();
            $filePath = $request->file('path')->storeAs('uploads/surat', $fileName);
            $surat->path = $filePath;
        }

        $surat->update([
            'no_surat' => $request->no_surat,
            'jenis_surat' => $request->jenis_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'pengirim' => $request->pengirim,
            'no_pengirim' => $request->nomor_pengirim,
            'penerima' => $request->penerima,
            'no_penerima' => $request->nomor_penerima,
            'alamat_penerima' => $request->alamat_penerima,
            'perihal' => $request->perihal,
            'lampiran' => $request->lampiran
        ]);
        
        if ($surat->jenis_surat == 'masuk') {
            return redirect()->route('surat.masuk')->with('success', 'Surat berhasil diperbarui!');
        }
        return redirect()->route('surat.keluar')->with('success', 'Surat berhasil diperbarui!');
    }

}