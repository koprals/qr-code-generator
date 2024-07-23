<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\QrCodeScanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [QrCodeController::class, 'scan']);
Route::get('/generate-qr-codes', [QrCodeController::class, 'generateQrCodes']);
Route::get('/scan-qr-code/{code}', [QrCodeScanController::class, 'scanQrCode']);
Route::get('/show', [QrCodeController::class, 'show']);
