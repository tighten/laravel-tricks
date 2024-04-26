<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrickController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TrickController::class, 'index'])->name('tricks.index');

Route::middleware('auth')->group(function () {
    Route::get('tricks/create', [TrickController::class, 'create'])->name('tricks.create');
    Route::post('tricks', [TrickController::class, 'store'])->name('tricks.store');
    Route::get('tricks/{trick}/edit', [TrickController::class, 'edit'])->name('tricks.edit');
    Route::put('tricks/{trick}', [TrickController::class, 'update'])->name('tricks.update');
    Route::delete('tricks/{trick}', [TrickController::class, 'destroy'])->name('tricks.destroy');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('tricks/{trick}', [TrickController::class, 'show'])->name('tricks.show');

require __DIR__ . '/auth.php';
