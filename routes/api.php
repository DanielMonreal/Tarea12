<?php

use App\Http\Controllers\Api\serieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/Series', [serieController::class, 'index']);

Route::get('/Series/{id}', [serieController::class, 'show']);

Route::post('/Series', [serieController::class, 'store']);

Route::put('/Series/{id}', [serieController::class, 'update']);

Route::patch('/Series/{id}', [serieController::class, 'updatePartial']);

Route::delete('/Series/{id}', [serieController::class, 'destroy']);