<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

Route::apiResource('todo-lists', TodoListController::class);
Route::apiResource('todos', TodoController::class);
