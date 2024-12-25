<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LampiranController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistributionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ActivityLogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function(){
    Route::get('/tracking/{surat}', [TrackingController::class, 'index'])->name('tracking');
    Route::post('/store/tracking', [TrackingController::class, 'store'])->name('tracking.store');
    Route::post('/history/tracking', [TrackingController::class, 'history'])->name('history-track'); // Ensure this is POST
    Route::put('/update/tracking', [TrackingController::class, 'update'])->name('update-tracking');
    Route::delete('/delete/tracking', [TrackingController::class, 'delete'])->name('delete-tracking');
});

Route::middleware('auth')->group(function(){
    Route::get('/surat/{surat}/lampiran', [LampiranController::class, 'index'])->name('surat.lampiran');
    Route::post('/lampiran/store', [LampiranController::class, 'store'])->name('lampiran.store');
    Route::delete('/lampiran/{lampiran}', [LampiranController::class, 'destroy'])->name('lampiran.destroy');
    Route::get('/lampiran/{lampiran}/download', [LampiranController::class, 'downloadLampiran'])->name('lampiran.download');
});
Route::middleware('auth')->group(function(){
    Route::post('/surat/distribution', [DistributionController::class, 'store'])->name('distribution.store');
});
Route::middleware('auth')->group(function () {
    Route::get('/surat-masuk', [SuratController::class, 'suratMasuk'])->name('surat.masuk');
    Route::get('/surat-keluar', [SuratController::class, 'suratKeluar'])->name('surat.keluar');
    Route::post('/surat', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/surat/{surat}/show', [SuratController::class, 'show'])->name('surat.show');
    Route::get('/surat/{surat}/edit', [SuratController::class, 'edit'])->name('surat.edit');
    Route::put('/surat/{surat}', [SuratController::class, 'update'])->name('surat.update'); // Add this line
    Route::delete('/surat/{surat}', [SuratController::class, 'destroy'])->name('surat.delete');
    Route::get('/surat/{surat}/download', [SuratController::class, 'download'])->name('surat.download');
    Route::get('/surat/{surat}/preview', [SuratController::class, 'preview'])->name('surat.preview');
});

Route::middleware('auth')->group(function () {
    Route::get('/create-surat', function() {
        return view('surat.create');
    })->name('create.surat');
    Route::get('/cek-track', function() {
        return view('tracking.cek_tracking');
    })->name('cek.track');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifikasi');
    Route::patch('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.markAsRead');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
Route::post('/laporan/download', [LaporanController::class, 'downloadPDF'])->name('laporan.download');

Route::get('storage/lampiran/{filename}', function ($filename) {
    $path = storage_path('app/public/lampiran/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }
    
    return response()->file($path);
})->where('filename', '.*');

Route::post('/surat/{surat}/send-draft', [SuratController::class, 'sendDraft'])->name('surat.send-draft');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/activity', [ActivityLogController::class, 'index'])->name('activity.index');
    Route::get('/activity/download', [ActivityLogController::class, 'downloadPDF'])->name('activity.download');
});

require __DIR__.'/auth.php';
