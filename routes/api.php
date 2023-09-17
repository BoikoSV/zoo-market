<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('shipping')->group(function (){
    Route::get('/', [\App\Http\Controllers\ShippingController::class, 'index']);
    Route::get('/get-price/{company}', [\App\Http\Controllers\ShippingController::class, 'getPrice']);
});
