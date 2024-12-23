<?php

namespace App\Http\Controllers;

use App\Models\Lampiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LampiranController extends Controller
{
    public function index($surat)
    {   
        $id_surat = $surat;
        $lampirans = Lampiran::where('id_surat', $surat)->get();
        return view('surat.lampiran', compact('surat', 'lampirans' ,'id_surat'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_surat' => 'required',
            'nama_file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('nama_file')) {
            $file = $request->file('nama_file');

            // Ambil nama file asli
            $originalName = $file->getClientOriginalName();

            // Simpan file ke folder 'lampirans' di storage/public dengan nama asli
            $filePath = $file->storeAs('lampirans', $originalName, 'public');

            // Simpan data ke database
            $lampiran = new Lampiran();
            $lampiran->id_surat = $validatedData['id_surat'];
            $lampiran->nama_file = $filePath; // Path ke file yang disimpan
            $lampiran->save();

            return redirect()->back()->with('success', 'Lampiran created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload file.');
    }

    public function destroy($id)
    {
        $lampiran = Lampiran::findOrFail($id);

        // Hapus file dari storage
        if (\Storage::disk('public')->exists($lampiran->nama_file)) {
            \Storage::disk('public')->delete($lampiran->nama_file);
        }

        // Hapus data dari database
        $lampiran->delete();

        return redirect()->back()->with('success', 'Lampiran deleted successfully.');
    }

    public function downloadLampiran($idLampiran)
    {
        $idLampiran = Lampiran::findOrFail($idLampiran);
        $nama_file = $idLampiran->nama_file;
        if (Storage::disk('public')->exists($nama_file)) {
            return Storage::disk('public')->download($nama_file);
        }

        return redirect()->back()->with('error', 'File not found.');
    }
}
