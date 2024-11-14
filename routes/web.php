<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomepageController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PendaftaranController;
use App\Models\Pendaftaran;

// Route::get('/', function () {
//     return view('app_homepage'); // asalnya welcome
// });

Route::resource('/', HomepageController::class); //di ganti jadi ini veris resource

Route::get('/dashboard', function () {
    return view('app_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('logout', function(){
    Auth::logout();
    return redirect('/');
});

Route::middleware([Authenticate::class])->group(function(){
    // Route::resource('pendaftaran', PendaftaranController::class);

    Route::resource('peserta', PesertaController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('skema', SkemaController::class);
    Route::resource('transaksi', TransaksiController::class);
});

    // Route::get('pendaftaran/{jadwal_id}', [PendaftaranController::class, 'create'])->middleware(['auth', 'verified', 'role:user'])->name('pendaftaran.create');

    Route::get('admin', function(){
        return '<h1>Hello Admin</h1>';
    })->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');
    
    Route::get('user', function(){
        return '<h1>Hello User</h1>';
    })->middleware(['auth', 'verified', 'role:user'])->name('dashboard');
    
    // Route::get('pendaftaran/{jadwal_id}', function(){
    //     return '<h1>Hello User</h1>';
    // })->middleware(['auth', 'verified', 'role:user'])->name('dashboard');

    Route::get('/pendaftaran/{jadwal_id}', [
        PendaftaranController::class, 'create'
        ])->middleware(['auth', 'verified', 'role:user'])->name('pendaftaran.create');
        // Route::get('/pendaftaran/{jadwal_id}', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');

        Route::get('/pendaftaran/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
        Route::patch('/pendaftaran/update', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
        Route::delete('/pendaftaran/destroy', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');



// role admin:
// - UserController : bisa lihat, tambah, edit, hapus 
// - PendafatranController : bisa lihat, tambah, edit, hapus 
// - SkemaController : bisa lihat, tambah, edit, hapus 
// - JadwalController : bisa lihat, tambah, edit, hapus 
// - TransaksiController : bisa lihat, tambah, edit, hapus 
// - PesertaController : bisa lihat, tambah, edit, hapus 
// role user:
// - UserController : bisa lihat, tambah, edit 
// - PendafatranController : bisa lihat, tambah 
// - SkemaController : bisa lihat 
// - JadwalController : bisa lihat 
// - TransaksiController : bisa lihat, tambah 
// - PesertaController : bisa lihat, tambah 

// Route::middleware([Authenticate::class])->group(function(){
    // Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    //     // Route untuk UserController (akses penuh untuk admin)
    //     // Route::resource('user', UserController::class)->middleware('can:lihat-akun');
    
    //     // Route untuk PendaftaranController
    //     Route::resource('pendaftaran', PendaftaranController::class)->only(['index', 'store', 'edit'])
    //         ->middleware('can:lihat-pendaftaran');   
    
    //     // Route untuk SkemaController (akses penuh untuk admin)
    //     Route::resource('skema', SkemaController::class)->middleware('can:lihat-skema');
    
    //     // Route untuk JadwalController
    //     Route::resource('jadwal', JadwalController::class)->middleware('can:lihat-jadwal');
    
    //     // Route untuk TransaksiController
    //     Route::resource('transaksi', TransaksiController::class)->middleware('can:lihat-transaksi');
    
    //     // Route untuk PesertaController
    //     Route::resource('peserta', PesertaController::class)->middleware('can:lihat-peserta');
    // });
    

// Group route untuk role user
// Route::middleware(['auth', 'verified', 'role:user'])->group(function() {
//     // UserController: hanya bisa lihat, tambah, edit
//     // Route::resource('user', UserController::class)->except(['destroy']);

//     // PendaftaranController: hanya bisa lihat, tambah
//     Route::resource('pendaftaran', PendaftaranController::class)->only(['index', 'create', 'store']);
//     // Route::post('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendafatran.index');
//             // Route::get('/pendaftaran/{jadwal_id}', [PendaftaranController::class, 'create'])->name('pendafataran.create')->middleware('can:tambah-pendaftaran');;
//             // Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendafatran.store'); 

//     // SkemaController: hanya bisa lihat
//     Route::resource('skema', SkemaController::class)->only(['index', 'show']);

//     // JadwalController: hanya bisa lihat
//     Route::resource('jadwal', JadwalController::class)->only(['index', 'show']);

//     // TransaksiController: hanya bisa lihat, tambah
//     Route::resource('transaksi', TransaksiController::class)->only(['index', 'create', 'store']);

//     // PesertaController: hanya bisa lihat, tambah
//     Route::resource('peserta', PesertaController::class)->only(['index', 'create', 'store']);
// });



// jika ingin bisa di akses keduanya maka menggunakan sintak ini 'role:user|admin'
// Route::get('user', function(){
//     return '<h1>Hello User</h1>';
// })->middleware(['auth', 'verified', 'role:user|admin'])->name('dashboard');

// Route::middleware(IsUse)

require __DIR__.'/auth.php';
