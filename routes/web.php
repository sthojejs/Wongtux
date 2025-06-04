<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/data', [DashboardController::class, 'chartData']);
    Route::get('/dashboard/stok-kategori', [DashboardController::class, 'stokPerKategori']);

   
    Route::resource('kategori', KategoriController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('barang', BarangController::class)->except(['show']);
    Route::resource('transaksi', TransaksiController::class);
    Route::post('/barang/import', [BarangController::class, 'import'])->name('barang.import')->middleware('auth');
    Route::get('/barang/template-excel', [App\Http\Controllers\BarangController::class, 'downloadTemplate'])->name('barang.template')->middleware('auth');

    Route::get('/barang/{id}/stok', function ($id) {
    $barang = \App\Models\Barang::find($id);
    return response()->json(['stok' => $barang->stok ?? 0]);
});

    
    Route::prefix('laporan')->group(function () {
        Route::get('/stok', [LaporanController::class, 'stok'])->name('laporan.stok');
        Route::get('/transaksi', [LaporanController::class, 'transaksi'])->name('laporan.transaksi');
        Route::get('/stok/pdf', [LaporanController::class, 'exportStokPDF'])->name('laporan.stok.pdf');
        Route::get('/stok/excel', [LaporanController::class, 'exportStokExcel'])->name('laporan.stok.excel');
        Route::get('/transaksi/pdf', [LaporanController::class, 'exportTransaksiPDF'])->name('laporan.transaksi.pdf');
        Route::get('/transaksi/excel', [LaporanController::class, 'exportTransaksiExcel'])->name('laporan.transaksi.excel');
    });
});

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::get('/profile/password', [PasswordController::class, 'edit'])->name('password.edit')->middleware('auth');
Route::post('/profile/password', [PasswordController::class, 'update'])->name('password.update')->middleware('auth');