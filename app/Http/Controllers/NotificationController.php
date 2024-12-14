<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\SuratNotification;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifikasi.index', [
            'notifications' => auth()->user()->notifications()->latest()->get()
        ]);
    }

    public function markAsRead($id)
    {
        auth()->user()->notifications()->findOrFail($id)->markAsRead();
        return back();
    }

    public function sendSuratNotification()
    {
        auth()->user()->notify(new SuratNotification([
            'title' => 'Surat Telah Diterima',
            'message' => 'Surat Anda telah diterima di Post Center Bandung',
            'type' => 'received'
        ]));
        return back();
    }
}
