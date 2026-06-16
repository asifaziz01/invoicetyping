<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [InvoiceController::class, 'form'])->name('invoice.form');
Route::post('/generate', [InvoiceController::class, 'generate'])->name('invoice.generate');