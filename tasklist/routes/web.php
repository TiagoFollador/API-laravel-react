<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/', 'as' => 'tasks'], function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
});
