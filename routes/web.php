<?php

use App\Http\Controllers\AnagraficheController;
use App\Http\Controllers\LettureController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');

    Route::resource('anagrafiche', AnagraficheController::class)->parameters(['anagrafiche' => 'anagrafica']);

    Route::resource('letture', LettureController::class)->parameters(['letture' => 'lettura']);
});

require __DIR__ . '/settings.php';
