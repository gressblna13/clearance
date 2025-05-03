<?php

use App\Http\Controllers\ClearanceController;

Route::get('/', [ClearanceController::class, 'index']);
Route::post('/submit-clearance', [ClearanceController::class, 'store'])->name('clearance.store');
Route::get('/riwayat', [ClearanceController::class, 'showHistory'])->name('clearance.history');
