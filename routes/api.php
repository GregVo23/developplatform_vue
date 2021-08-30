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
    Route::get('/demandes', [App\Http\Controllers\Api\ProjectApiController::class, 'myProjects'])->name('projects.mine');
    Route::get('/projet/{id}', [App\Http\Controllers\Api\ProjectApiController::class, 'show'])->name('projects.show');
    Route::get('/nouveau', [App\Http\Controllers\Api\ProjectApiController::class, 'create'])->name('project.create');
    Route::post('/store', [App\Http\Controllers\Api\ProjectApiController::class, 'store'])->name('project.store');
    
    /*  OFFERS  */
    Route::get('/projet/offre', [App\Http\Controllers\Api\ProjectApiController::class, 'myOffers'])->name('project.offers');
    Route::post('/projet/accepter/{id}', [App\Http\Controllers\Api\ProjectApiController::class, 'accept'])->name('project.accept');
    Route::post('/projet/offre/{id}', [App\Http\Controllers\Api\ProjectApiController::class, 'offer'])->name('project.offer');

    /*  FAVORITES  */
    Route::get('/favoris', [App\Http\Controllers\Api\FavoriteApiController::class, 'index'])->name('favorite.index');
    Route::post('/favoris/{id}', [App\Http\Controllers\Api\FavoriteApiController::class, 'add'])->name('favorite.add');
    Route::post('/favoris/supprimer/{id}', [App\Http\Controllers\Api\FavoriteApiController::class, 'delete'])->name('favorite.delete');

    /*  USER PROFILE  */
    Route::get('/profil', [App\Http\Controllers\Api\UserApiController::class, 'show'])->name('user.show');

    /*  SUBSCRIPTION  */
    Route::get('/abonnement', [App\Http\Controllers\Api\SubscriptionApiController::class, 'index'])->name('subscription.index');
    Route::post('/abonnement', [App\Http\Controllers\Api\SubscriptionApiController::class, 'subscribe'])->name('subscription.subscribe');

    /*  OTHERS  */
    Route::get('/accueil');    
    Route::get('/subcategories/{id}', [App\Http\Controllers\Api\SubCategoryApiController::class, 'subcategories'])->name('subcategories');
});


