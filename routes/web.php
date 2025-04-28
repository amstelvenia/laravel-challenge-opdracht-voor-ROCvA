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
    Route::get('/beheer', [WoningenController::class, 'user'])->name('beheer');
    Route::get('/model_has_roles', [WoningenController::class, 'model_has_roles'])->name('model_has_roles');
    Route::get('/roles', [WoningenController::class, 'roles'])->name('roles');
    Route::post('/store', [WoningenController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [WoningenController::class, 'edit'])->name('woningen.edit')->middleware(['auth', 'role:admin']);
    Route::post('/update/{id}', [WoningenController::class, 'update']);
    Route::get('/show/{id}',  [WoningenController::class, 'show']);
    Route::post('/destroy/{id}',  [WoningenController::class, 'destroy']);
    Route::get('/create', [WoningenController::class, 'create'])->middleware('role:admin');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
