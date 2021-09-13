<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/question',\App\Http\Controllers\QuestionController::class);
Route::apiResource('/category',\App\Http\Controllers\CategoryController::class);
Route::apiResource('/question/{question}/reply',\App\Http\Controllers\ReplyController::class);
