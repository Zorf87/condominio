<?php

use App\Http\Controllers\AnagraficheController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');

    Route::resource('anagrafiche', AnagraficheController::class)->parameters(['anagrafiche' => 'anagrafica']);

    Route::inertia('letture', 'Letture')->name('letture');
});

require __DIR__ . '/settings.php';
