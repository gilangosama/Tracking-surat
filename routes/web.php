<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SuratController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/create-surat', function() {
        return view('surat.create');
    })->name('create.surat');
    
    Route::get('/cek-track', function() {
        return view('tracking.index');
    })->name('cek.track');
    
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifikasi');
    Route::patch('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.markAsRead');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/surat-masuk', [SuratController::class, 'masuk'])->name('surat.masuk');
    Route::get('/surat-keluar', [SuratController::class, 'keluar'])->name('surat.keluar');
    Route::post('/surat', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/surat/{surat}/download', [SuratController::class, 'download'])->name('surat.download');
    Route::get('/surat/{surat}/preview', [SuratController::class, 'preview'])->name('surat.preview');
    Route::delete('/surat/{surat}', [SuratController::class, 'destroy'])->name('surat.destroy');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';
