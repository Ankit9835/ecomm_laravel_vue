<?php

use App\Http\Controllers\AuthController;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/signup', [App\Http\Controllers\AuthController::class, 'signup']);
    Route::post('refresh', 'AuthController@refresh');
    Route::post('/me', [App\Http\Controllers\AuthController::class, 'me']);

});

Route::apiResource('/category', App\Http\Controllers\Api\CategoryController::class);
Route::get('/fetch/data/{id}',[App\Http\Controllers\Api\CategoryController::class, 'fetchData']);


// subcategory
Route::apiResource('/subcategory', App\Http\Controllers\Api\SubCategoryController::class);

// subsubcategory
Route::apiResource('/sub-subcategory', App\Http\Controllers\Api\Sub_SubCategoryController::class);


// brand
Route::apiResource('/brand', App\Http\Controllers\Api\BrandController::class);
Route::get('/category/subcategory/ajax/{id}',[App\Http\Controllers\Api\Sub_SubCategoryController::class, 'fetchData']);

// product
Route::apiResource('/product', App\Http\Controllers\Api\ProductsController::class);
Route::get('/subcategory/sub-sub-category/{sub_categoryid}/{category_id}',[App\Http\Controllers\Api\ProductController::class, 'fetchData']);