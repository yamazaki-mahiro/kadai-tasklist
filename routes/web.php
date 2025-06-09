<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [TasksController::class, 'index']);
Route::resource('tasks', TasksController::class);


// Route::get('tasks/{id}', [TasksController::class, 'show'])->name('task.show');
// Route::post('tasks', [TasksController::class, 'store'])->name('task.store');
// Route::put('tasks/{id}', [TasksController::class, 'update'])->name('task.update');
// Route::delete('tasks/{id}', [TasksController::class, 'destroy'])->name('task.destroy');

// // index: showの補助ページ
// Route::get('tasks', [TasksController::class, 'index'])->name('task.index');
// // create: 新規作成用のフォームページ
// Route::get('tasks/create', [TasksController::class, 'create'])->name('task.create');
// // edit: 更新用のフォームページ
// Route::get('tasks/{id}/edit', [TasksController::class, 'edit'])->name('task.edit');