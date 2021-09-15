<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/question',\App\Http\Controllers\QuestionController::class);
Route::apiResource('/category',\App\Http\Controllers\CategoryController::class);
Route::apiResource('/question/{question}/reply',\App\Http\Controllers\ReplyController::class);

Route::post('/like/{reply}',[\App\Http\Controllers\LikeController::class, 'likeIt']);
Route::delete('/like/{reply}',[\App\Http\Controllers\LikeController::class, 'unlikeIt']);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login',[\App\Http\Controllers\AuthController::class,'login']);
    Route::post('logout',[\App\Http\Controllers\AuthController::class,'logout']);
    Route::post('refresh',[\App\Http\Controllers\AuthController::class,'refresh']);
    Route::post('me',[\App\Http\Controllers\AuthController::class,'me']);

});
