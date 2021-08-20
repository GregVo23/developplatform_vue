<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


/*  NON PROTECTED ROUTES  */
Route::post('/connect', [App\Http\Controllers\Api\AuthController::class, 'login']);


/*  PROTECTED ROUTES  */
Route::group(['middleware' => 'auth:sanctum'], function(){

    /*  CONNECTED USER  */
    Route::get('/user', function (Request $request) { return $request->user(); })->name('user');

    /*  PROJECTS  */
    Route::get('/projets', [App\Http\Controllers\Api\ProjectApiController::class, 'index'])->name('projects.index');
    Route::get('/projet/nouveau', [App\Http\Controllers\Api\ProjectApiController::class, 'create'])->name('project.create');

    /*  FAVORITES  */
    Route::get('/favoris', [App\Http\Controllers\Api\FavoriteApiController::class, 'index'])->name('favorite.index');
    Route::post('/favoris/{id}', [App\Http\Controllers\Api\FavoriteApiController::class, 'add'])->name('favorite.add');
    Route::post('/favoris/supprimer/{id}', [App\Http\Controllers\Api\FavoriteApiController::class, 'delete'])->name('favorite.delete');

    /*  FAVORITE  */
    Route::get('/subcategories', [App\Http\Controllers\Api\SubCategoryApiController::class, 'index'])->name('subcategories.index');

    /*  OTHERS  */
    Route::get('/home');
    Route::get('/offres');
    Route::get('/rechercher');
    Route::get('/profil', [App\Http\Controllers\Api\UserApiController::class, 'show'])->name('user.show');
});


