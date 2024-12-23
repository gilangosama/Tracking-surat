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

        $tracking = Tracking::create(
            [
                'id_surat' => $validatedData['id_surat'],
                'lokasi' => 'kota tujuan',
                'status_surat' => 'sudah diterima',
                'tanggal_tracking' => now(),
            ]
        );

        // dd($distribution, $tracking);
        return back()->with('success', 'Distribution created successfully.');
    }
}
