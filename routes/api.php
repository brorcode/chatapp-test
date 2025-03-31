<?php

use App\Http\Controllers\Api\v1\ChatController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
    Route::group(['prefix' => 'chats', 'as' => 'chats.'], function () {
        Route::get('/', [ChatController::class, 'index'])->name('index');
    });
});
