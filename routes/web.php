<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Homepage
Route::get('/', [App\Http\Controllers\ProjectController::class, 'welcome'])->name('welcome');

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