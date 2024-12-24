<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\Distribution;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    public function store(Request $request)
    {
        // Validate and store the data
        $validatedData = $request->validate([
            'id_surat' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
        ]);

        // Update or Create a new distribution record
        $distribution = Distribution::updateOrCreate(
            ['id_surat' => $validatedData['id_surat']],
            [
                'tanggal_terima' => $validatedData['tanggal'],
                'keterangan' => $validatedData['keterangan'],
            ]
        );

        // Update or Create a new tracking record
        $tracking = Tracking::updateOrCreate(
            ['id_surat' => $validatedData['id_surat'], 'status_surat' => 'sudah diterima'],
            [
                'lokasi' => 'kota tujuan',
                'tanggal_tracking' => now(),
            ]
        );

        return back()->with('success', 'Distribution created successfully.');
    }
}
