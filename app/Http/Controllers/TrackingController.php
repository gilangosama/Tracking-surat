<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Tracking;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index($surat)
    {   
        $tracking = Tracking::where('id_surat', $surat)->get();
        // dd($tracking);
        return view('tracking.index', compact('tracking'));
    }

    public function create()
    {
        return view('tracking.create');
    }

    public function store(Request $request)
    {
        // Validate and store the data
        $validatedData = $request->validate([
            'field1' => 'required',
            'field2' => 'required',
        ]);

        // Create a new tracking record
        $tracking = new Tracking();
        $tracking->field1 = $validatedData['field1'];
        $tracking->field2 = $validatedData['field2'];
        $tracking->save();

        return redirect()->route('tracking.index')->with('success', 'Tracking created successfully.');
    }

    public function show($id)
    {
        $tracking = Tracking::findOrFail($id);
        return view('tracking.show', compact('tracking'));
    }

    public function edit($id)
    {
        $tracking = Tracking::findOrFail($id);
        return view('tracking.edit', compact('tracking'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the data
        $validatedData = $request->validate([
            'field1' => 'required',
            'field2' => 'required',
        ]);

        $tracking = Tracking::findOrFail($id);
        $tracking->field1 = $validatedData['field1'];
        $tracking->field2 = $validatedData['field2'];
        $tracking->save();

        return redirect()->route('tracking.index')->with('success', 'Tracking updated successfully.');
    }

    public function destroy($id)
    {
        $tracking = Tracking::findOrFail($id);
        $tracking->delete();

        return redirect()->route('tracking.index')->with('success', 'Tracking deleted successfully.');
    }

    public function history(Request $request)
    {
         // Validasi input
        $request->validate([
            'search' => 'required|string|max:255',
        ]);

        // Cari surat berdasarkan nomor surat
        $search = $request->input('search');
        $surat = Surat::with('trackings') // Ambil relasi tracking
            ->where('no_surat', $search)
            ->first();

        // dd($surat->trackings);

        // Jika surat tidak ditemukan, kembali dengan pesan error
        if (!$surat) {
            return redirect()->back()->with('error', 'Surat tidak ditemukan.');
        }

        // Format data tracking untuk ditampilkan di view
        $items = $surat->trackings->map(function ($item) {
            return [
                'status' => $item->status_surat,
                'location' => $item->lokasi,
                'date' => $item->tanggal_tracking ? $item->tanggal_tracking->format('d M Y') : '-',
                'completed' => $item->status_surat === 'Di Post' || $item->status_surat === 'Kota Transit',
            ];
        });

        // Kembalikan view dengan data surat dan tracking
        return view('history-track', [
            'surat' => $surat,
            'items' => $items,
        ]);
    }
}