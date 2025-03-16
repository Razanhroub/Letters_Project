<?php

use App\Http\Controllers\PhonemeActivityController;
use App\Http\Controllers\PhonemeCharacteristicController;
use App\Http\Controllers\PhonemeContextualFeatureController;
use App\Http\Controllers\PhonemeDeletionController;
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
// Phoneme Activities Routes
Route::get('phoneme-activities', [PhonemeActivityController::class, 'index']);
Route::get('phoneme-activities/next/{id}', [PhonemeActivityController::class, 'next']);
Route::get('phoneme-activities/prev/{id}', [PhonemeActivityController::class, 'prev']);
Route::put('phoneme-activities/{id}', [PhonemeActivityController::class, 'update']);
Route::delete('phoneme-activities/{id}', [PhonemeActivityController::class, 'destroy']);

// Phoneme Characteristics Routes   
Route::get('phoneme-characteristics', [PhonemeCharacteristicController::class, 'index']);
Route::get('phoneme-characteristics/next/{id}', [PhonemeCharacteristicController::class, 'next']);
Route::get('phoneme-characteristics/prev/{id}', [PhonemeCharacteristicController::class, 'prev']);
Route::put('phoneme-characteristics/{id}', [PhonemeCharacteristicController::class, 'update']);
Route::delete('phoneme-characteristics/{id}', [PhonemeCharacteristicController::class, 'destroy']);

// Phoneme PhonemeContextualFeatureController 
Route::prefix('phoneme-contextuals')->group(function () {
    Route::get('/', [PhonemeContextualFeatureController::class, 'index']); // Get all active phoneme contextual features
    Route::get('/next/{id}', [PhonemeContextualFeatureController::class, 'next']); // Get next feature
    Route::get('/prev/{id}', [PhonemeContextualFeatureController::class, 'prev']); // Get previous feature
    Route::put('/{id}', [PhonemeContextualFeatureController::class, 'update']); // Update feature
    Route::delete('/{id}', [PhonemeContextualFeatureController::class, 'destroy']); // Soft delete feature
});

// Phoneme Deletions Routes
Route::get('phoneme-deletions', [PhonemeDeletionController::class, 'index']);
Route::get('phoneme-deletions/next/{id}', [PhonemeDeletionController::class, 'next']);
Route::get('phoneme-deletions/prev/{id}', [PhonemeDeletionController::class, 'prev']);
Route::put('phoneme-deletions/{id}', [PhonemeDeletionController::class, 'update']);
Route::delete('phoneme-deletions/{id}', [PhonemeDeletionController::class, 'destroy']);
