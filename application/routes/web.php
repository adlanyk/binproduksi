<?php

use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BinController;

// Route::get('/', function () {
//     return redirect('admin');
// });


Route::get('/', [BinController::class, 'index'])->name('bins.index');
Route::post('/bin/{bin}/update-item', [BinController::class, 'updateItem'])->name('bins.update-item');
Route::post('/bin/{bin}/clear', [BinController::class, 'clearItem'])->name('bins.clear');
