<?php

use App\Http\Controllers\RecordingController;
use App\Http\Controllers\TextController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    include 'api/auth.php';
    Route::get('/texts', [TextController::class, 'index']);
    Route::post('/recording', RecordingController::class);
    // Route::apiResource('/texts', TextController::class);
    // Route::middleware('auth:sanctum')->group(function () {
    // Route::apiResource('/organizations', OrganizationController::class);
    // Route::apiResource('/projects', ProjectController::class);
    // Route::apiResource('/texts', TextController::class);
    // Route::apiResource('/recordings', RecordingController::class);
    // });
});
