<?php

use App\Http\Controllers\QRController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/qr', [QRController::class, 'generate'])->name('qr.generate');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
