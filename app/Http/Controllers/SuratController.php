<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
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
            'file' => 'required|mimes:pdf,doc,docx|max:10240'
        ]);

        $file = $request->file('file');
        $path = $file->store('surat');

        Surat::create([
            'user_id' => auth()->id(),
            'nama_file' => $file->getClientOriginalName(),
            'path' => $path,
            'jenis' => 'masuk'
        ]);

        return response()->json(['success' => true]);
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