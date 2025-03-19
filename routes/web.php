<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WoningenController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/woningen');
    } else {
        return redirect('/login');
    }
});

Route::middleware('auth')->group(function () {
    Route::get('/woningen', [WoningenController::class, 'index'])->name('woningen');
    Route::post('/store', [WoningenController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [WoningenController::class, 'edit'])->name('woningen.edit');
    Route::post('/update/{id}', [WoningenController::class, 'update']);
    Route::post('/destroy/{id}',  [WoningenController::class, 'destroy']);
    Route::get('/create', [WoningenController::class, 'create']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
