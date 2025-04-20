<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/pdf/generate/timesheet/{user}', [PdfController::class,'TimesheetRecords'])->name('pdf.example');

Route::get('/carnet/asistencia/{user}', [PdfController::class,'carnet'])->name('carnet.asistencia');
