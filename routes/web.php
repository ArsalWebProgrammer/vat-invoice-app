<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/invoice/form', [InvoiceController::class, 'showForm']);
Route::post('/invoice/generate', [InvoiceController::class, 'generateInvoice'])->name('generate.invoice');

