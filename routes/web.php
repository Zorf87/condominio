<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::inertia('anagrafiche', 'Anagrafiche')->name('anagrafiche');
});

require __DIR__ . '/settings.php';
