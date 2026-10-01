<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\TodoController;

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::post('/todos/data', [TodoController::class, 'data'])->name('todos.data');
Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::get('/todos/{id}/edit', [TodoController::class, 'edit'])->name('todos.edit');
Route::patch('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
Route::get('/todos/{id}/status', [TodoController::class, 'updateStatus'])->name('todos.status');
Route::post('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
