<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WoningenController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/woningen', [WoningenController::class, 'index'])->name('woningen');
    Route::post('/store', [WoningenController::class, 'store'])->name('store');
    Route::get('/create', [WoningenController::class, 'create']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
