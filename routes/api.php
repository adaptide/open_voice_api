<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RecordingController;
use App\Http\Controllers\TextController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    include 'api/auth.php';

    Route::get('/texts', TextController::class);

    Route::post('/recording', [RecordingController::class, 'store']);
    Route::get('/recording', [RecordingController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/organizations', OrganizationController::class);
        Route::get('/projects', [ProjectController::class, 'index']);
        Route::get('/projects/{project:id}', [ProjectController::class, 'show']);
    });
});
