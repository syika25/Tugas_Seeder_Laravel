<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

// Route root redirect ke beranda
Route::get('/', function () {
    return view('pages.beranda');
});

Route::get('/beranda', function () {
    return view('pages.beranda');
});

Route::get('/dosen', function () {
    return view('pages.dosen');
});

Route::get('/jadwal', function () {
    return view('pages.jadwal');
});

Route::get('/mata_kuliah', function () {
    return view('pages.mata_kuliah');
});

Route::get('/krs', function () {
    return view('pages.krs');
});

Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');

//Detail data
Route::get('/mahasiswa/{npm}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');

//Edit data
Route::get('/mahasiswa/{npm}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');

//Update data
Route::put('/mahasiswa/{npm}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');

//Delete data
Route::delete('/mahasiswa/{npm}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
