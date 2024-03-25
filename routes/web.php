<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\V1\EventController;
use App\Http\Controllers\V1\EventSaleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [EventController::class, 'index']);

    Route::resource('events', EventController::class);

    Route::resource('event_sales', EventSaleController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
