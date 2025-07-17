<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\ReviewController;
// use App\Http\Controllers\Api\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('products',[ApiController::class, 'displayProduct']);

Route::Post('store',[ApiController::class, 'uploadProduct'])->middleware('auth:sanctum');
Route::get('users',[ApiController::class, 'displayUsers']);
Route::Delete('delete.product/{id}', [ApiController::class, 'deleteProduct']);

Route::Put('update/{id}',[ApiController::class,'updateProduct'])->middleware('auth:sanctum');

Route::Post('review/{id}', [ReviewController::class, 'createReview']);
Route::get('product/review/{id}', [ReviewController::class, 'viewReview']);
Route::Post('login', [ApiController::class, 'login']);
Route::get('register',[ApiController::class, 'register']);
Route::Post('logout', [ApiController::class, 'logout']);
Route::get('product/{product}',[ApiController::class, 'showProduct']);

