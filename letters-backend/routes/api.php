<?php

use App\Http\Controllers\PhonemeActivityController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('phoneme-activity/{id}', [PhonemeActivityController::class, 'show']);
Route::get('phoneme-activity/next/{id}', [PhonemeActivityController::class, 'next']);
Route::get('phoneme-activity/prev/{id}', [PhonemeActivityController::class, 'prev']);
Route::put('phoneme-activity/{id}', [PhonemeActivityController::class, 'update']);
// Route::delete('phoneme-activity/{id}', [PhonemeActivityController::class, 'softDelete']);