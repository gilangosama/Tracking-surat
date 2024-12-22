<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index($surat)
    {   
        $tracking = Tracking::where('id_surat', $surat);
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
}