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
        return view('tracking.index', compact('surat','tracking'));
    }

    public function store(Request $request)
    {
        // Validate and store the data
        $validatedData = $request->validate([
            'status_surat' => 'required',
            'id_surat' => 'required',
            'lokasi' => 'required',
        ]);

        // Create a new tracking record
        $tracking = new Tracking();
        $tracking->status_surat = $validatedData['status_surat'];
        $tracking->id_surat = $validatedData['id_surat'];
        $tracking->lokasi = $validatedData['lokasi'];
        $tracking->tanggal_tracking = now(); // Set the current date and time
        $tracking->save();

        return redirect()->back()->with('success', 'Tracking created successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate and update the data
        $validatedData = $request->validate([
            'status_surat' => 'required',
            'lokasi' => 'required',
        ]);

        $tracking = Tracking::findOrFail($id);
        $tracking->status_surat = $validatedData['status_surat'];
        $tracking->lokasi = $validatedData['lokasi'];
        $tracking->tanggal_tracking = now(); // Update the date and time
        $tracking->save();

        return redirect()->route('tracking.index', ['surat' => $tracking->id_surat])->with('success', 'Tracking updated successfully.');
    }

    public function destroy($id)
    {
        $tracking = Tracking::findOrFail($id);
        $tracking->delete();

        return redirect()->back()->with('success', 'Tracking deleted successfully.');
    }

    public function history(Request $request)
    {
        $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $search = $request->input('search');
        $surat = Surat::with(['trackings' => function($query) {
            $query->orderBy('tanggal_tracking', 'asc');
        }])->where('no_surat', $search)->first();

        if (!$surat) {
            return back()->with('error', 'Surat tidak ditemukan');
        }

        $items = $surat->trackings->map(function ($item) {
            return [
                'status' => $item->status_surat,
                'location' => $item->lokasi,
                'date' => $item->tanggal_tracking ? \Carbon\Carbon::parse($item->tanggal_tracking)->format('d M Y H:i') : '-',
                'completed' => true,
                'current' => $item->status_surat === 'sedang dikirim'
            ];
        });

        return view('tracking.cek_tracking', [
            'surat' => $surat,
            'items' => $items,
        ]);
    }
}