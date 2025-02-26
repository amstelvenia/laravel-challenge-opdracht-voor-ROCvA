<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WoningenController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('woningen', [WoningenController::class, 'index']);
