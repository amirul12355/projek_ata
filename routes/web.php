<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RekodAsetController;
use App\Http\Controllers\ATATController;
use App\Http\Controllers\ATABController;


Route::get('login', function() {
    return view('auth.login');
})->name('login');

Route::post('/user/store', [UserController::class, 'store']);

Route::post('login', [LoginController::class, 'login'])->name('login.submit');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function() {
        return 'Welcome to the dashboard!';
    })->name('dashboard');

    Route::get('/kpt-homepage', function () {
        return view('homepages.kpt');
    })->name('kpt.homepage');

    Route::get('/puo-homepage', function () {
        return view('homepages.puo');
    })->name('puo.homepage');

    Route::get('/kkss-homepage', function () {
        return view('homepages.kkss');
    })->name('kkss.homepage');

    });

   Route::middleware('auth')->prefix('admin')->group(function () {
       Route::resource('users', UserController::class); // Mengurus pengguna
   });

   Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    
    // Papar borang tambah pengguna
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    
    // Simpan pengguna baru
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    
    // Papar borang edit pengguna
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    
    // Kemaskini pengguna
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    
    // Padam pengguna
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Route untuk paparan utama rekod
Route::get('/rekodATA', [RekodAsetController::class, 'index'])->name('rekodATA.index');

// Route untuk halaman tambah rekod baru
Route::get('/rekodATA/create', [RekodAsetController::class, 'create'])->name('rekodATA.create');

// Route untuk menyimpan rekod baru
Route::post('/rekodATA', [RekodAsetController::class, 'store'])->name('rekodATA.store');

// Route untuk eksport rekod ke Excel
Route::get('/rekodATA/export/excel', [RekodAsetController::class, 'exportExcel'])->name('rekodATA.export.excel');

// Route untuk eksport rekod ke PDF
Route::get('/rekodATA/export/pdf', [RekodAsetController::class, 'exportPdf'])->name('rekodATA.export.pdf');

Route::post('/rekodATA/import/excel', [RekodAsetController::class, 'importExcel'])->name('rekodATA.import.excel');

Route::get('/rekodATA/download/template', [RekodAsetController::class, 'downloadTemplate'])->name('rekodATA.download.template');




Route::get('/atat', [AtatController::class, 'index'])->name('atat.index');
Route::post('/atat', [AtatController::class, 'store'])->name('atat.store');
Route::get('/atat/{id}/edit', [AtatController::class, 'edit'])->name('atat.edit');
Route::put('/atat/{id}', [AtatController::class, 'update'])->name('atat.update');
Route::delete('/atat/{id}', [AtatController::class, 'destroy'])->name('atat.destroy');


Route::resource('atab', AtabController::class);


