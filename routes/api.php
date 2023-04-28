<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MovieController;

Route::post('/login', 'App\Http\Controllers\Api\AuthController@login');
Route::post('/logout', 'App\Http\Controllers\Api\AuthController@logout');

Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::get('/movies', [MovieController::class, 'index']);
Route::put('/movies/{id}', [MovieController::class, 'update'])->middleware('auth:api');
Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->middleware('auth:api');
Route::post('/movies', [MovieController::class, 'store'])->middleware('auth:api');

