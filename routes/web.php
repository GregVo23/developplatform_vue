<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [App\Http\Controllers\ProjectController::class, 'welcome'])->name('welcome');
Route::get('/prestataire', [App\Http\Controllers\ProjectController::class, 'maker'])->name('maker');
Route::get('/demandeur', [App\Http\Controllers\ProjectController::class, 'customer'])->name('customer');

// Where connected
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';

// Logout
Route::post('/logout', [App\Http\Controllers\UserController::class, 'logout'])->middleware(['auth','verified'])->name('logout');

// Contact Form
Route::post('/', [App\Http\Controllers\ContactController::class, 'contact'])->name('contact');

// Redirections
Route::get('/{any}', function () {
    return view('dashboard');
})->where('any', '.*')->middleware(['auth','verified']);