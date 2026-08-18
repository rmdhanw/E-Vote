<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/hasil', [AdminController::class, 'hasil'])->name('admin.hasil');
    Route::get('/admin/hasil/export', [AdminController::class, 'exportCsv'])->name('admin.hasil.export');
    Route::delete('/admin/hasil/reset', [AdminController::class, 'resetHasil'])->name('admin.hasil.reset');

    Route::get('/admin/kandidat', [CandidateController::class, 'index'])->name('admin.kandidat');
    Route::post('/admin/kandidat', [CandidateController::class, 'store'])->name('admin.kandidat.store');
    Route::delete('/admin/kandidat/{candidate}', [CandidateController::class, 'destroy'])->name('admin.kandidat.destroy');

    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/pemilihan', [VoteController::class, 'index'])->name('pemilihan');
    Route::post('/pemilihan', [VoteController::class, 'store'])->name('pemilihan.store');
    Route::get('/pemilihan/sukses', [VoteController::class, 'sukses'])->name('pemilihan.sukses');
});
