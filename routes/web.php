<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController1;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'admin'])->group(function () {
 
    // Admin Dashboard
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
 
    // List Products
    Route::get('/admin/todo', [TodoController1::class, 'index'])->name('admin.todo.index');

    // Show Create Product Form
    Route::get('/admin/todo/create', [TodoController1::class, 'create'])->name('admin.todo.create');

    // Save New Product
    Route::post('/admin/todo/save', [TodoController1::class, 'save'])->name('admin.todo.save');

    // Show Edit Product Form
    Route::get('/admin/todo/edit/{key}', [TodoController1::class, 'edit'])->name('admin.todo.edit');

    // Update Product
    Route::put('/admin/todo/update/{key}', [TodoController1::class, 'update'])->name('admin.todo.update');

    // Delete Product
    Route::get('/admin/todo/delete/{key}', [TodoController1::class, 'delete'])->name('admin.todo.delete');
});


require __DIR__.'/auth.php';
//Route::get('admin/dashboard', [HomeController::class, 'index']);
//Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);