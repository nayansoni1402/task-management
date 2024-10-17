<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
       return redirect()->route('tasks.index');
});

Route::fallback(function () {
    return view('404');
    // return redirect()->route('tasks.index');
});
Route::get('/dashboard', function () {
    return redirect()->route('tasks.index');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
});


Route::get('/login-as-user/{userId}', [TaskController::class, 'loginAsUser'])->name('loginAsUser');


require __DIR__.'/auth.php';