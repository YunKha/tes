<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TicketController;
use Illuminate\Support\Facades\Route;

// Public API routes
Route::post('/login', [AuthController::class , 'login']);

// Protected API routes (require Sanctum token)
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class , 'logout']);
    Route::get('/profile', [AuthController::class , 'profile']);
    Route::post('/profile', [AuthController::class , 'updateProfile']);

    // Tickets
    Route::get('/tickets/available', [TicketController::class , 'available']);
    Route::post('/tickets/{id}/take', [TicketController::class , 'take']);
    Route::get('/tickets/my-jobs', [TicketController::class , 'myJobs']);
    Route::post('/tickets/{id}/complete', [TicketController::class , 'complete']);
    Route::get('/tickets/history', [TicketController::class , 'history']);
    Route::get('/tickets/{id}', [TicketController::class , 'show']);
});
