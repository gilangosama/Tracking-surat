<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use PDF;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activities = ActivityLog::with(['user'])->orderBy('created_at', 'desc')->get();
        return view('activity.index', compact('activities'));
    }

    public function downloadPDF(Request $request)
    {
        $query = ActivityLog::with(['user']);

        // Filter berdasarkan tanggal jika ada
        if ($request->tanggal_mulai && $request->tanggal_akhir) {
            $query->whereBetween('created_at', [
                $request->tanggal_mulai . ' 00:00:00', 
                $request->tanggal_akhir . ' 23:59:59'
            ]);
        }

        $activities = $query->orderBy('created_at', 'desc')->get();

        $pdf = PDF::loadView('activity.pdf', compact('activities'));
        return $pdf->download('activity-log.pdf');
    }
} 