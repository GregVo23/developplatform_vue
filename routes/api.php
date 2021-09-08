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
    Route::post('/projet/{id}', [App\Http\Controllers\Api\ProjectApiController::class, 'destroy'])->name('project.destroy');
    
    /*  MY OFFERS  */
    Route::post('/projet/accepter/{id}', [App\Http\Controllers\Api\ProjectApiController::class, 'accept'])->name('project.accept');
    Route::post('/projet/offre/{id}', [App\Http\Controllers\Api\ProjectApiController::class, 'offer'])->name('project.offer');
    Route::post('/projet/annuler/{id}', [App\Http\Controllers\Api\ProjectApiController::class, 'cancel'])->name('project.offer.cancel');
    
    /*  PROPOSAL  */
    Route::get('/offres', [App\Http\Controllers\Api\ProjectApiController::class, 'showProposal'])->name('project.proposal');
    Route::post('/offres/accepter/{id}', [App\Http\Controllers\Api\ProjectApiController::class, 'acceptProposal'])->name('offers.accept');
    Route::post('/offres/refuser/{id}', [App\Http\Controllers\Api\ProjectApiController::class, 'refuseProposal'])->name('offers.accept');

    /*  FAVORITES  */
    Route::get('/favoris', [App\Http\Controllers\Api\FavoriteApiController::class, 'index'])->name('favorite.index');
    Route::post('/favoris/{id}', [App\Http\Controllers\Api\FavoriteApiController::class, 'add'])->name('favorite.add');
    Route::post('/favoris/supprimer/{id}', [App\Http\Controllers\Api\FavoriteApiController::class, 'delete'])->name('favorite.delete');

    /*  USER PROFILE  */
    Route::post('/avatar/{id}', [App\Http\Controllers\Api\UserApiController::class, 'saveAvatar'])->name('user.avatar');
    Route::get('/profil', [App\Http\Controllers\Api\UserApiController::class, 'show'])->name('user.show');
    Route::delete('/profil/{id}', [App\Http\Controllers\Api\UserApiController::class, 'destroy'])->name('user.destroy');

    /*  SUBSCRIPTION  */
    Route::get('/abonnement', [App\Http\Controllers\Api\SubscriptionApiController::class, 'index'])->name('subscription.index');
    Route::post('/abonnement', [App\Http\Controllers\Api\SubscriptionApiController::class, 'subscribe'])->name('subscription.subscribe');

    /*  OTHERS  */
    Route::get('/accueil');    
    Route::get('/subcategories/{id}', [App\Http\Controllers\Api\SubCategoryApiController::class, 'subcategories'])->name('subcategories');
});


