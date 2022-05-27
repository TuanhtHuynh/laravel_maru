<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TopbarController;
use App\Http\Controllers\UploadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::post('logout', [AuthController::class, 'logout']);
// });
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('upload', [UploadController::class, 'handle']);
    Route::post('ck_upload', [UploadController::class, 'ckeditorUpload']);
});


// Route::group(['prefix' => 'productAdmin', 'middleware' => ['auth:sanctum']], function () {
//     Route::post('add', [ProductController::class, 'addProduct']);
//     Route::get('edit/{id}', [ProductController::class, 'edit']);
// });

// Route::group(['prefix' => 'categoryAdmin', 'middleware' => ['auth:sanctum']], function () {
//     Route::delete('deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);
//     Route::post('addCategory', [CategoryController::class, 'addCategory']);
//     Route::put('updateCategory', [CategoryController::class, 'updateCategory']);
// });

// Route::group(['prefix' => 'authorization', 'middleware' => ['auth:sanctum']], function () {
//     Route::post('logout', [AuthController::class, 'logout']);
// });
Route::prefix('hp')->group(function () {
    Route::get('get', [MenuController::class, 'getHp']);
    Route::get('getproduct', [ProductController::class, 'getHp']);
});

Route::prefix('category')->group(function () {
    Route::get('get', [CategoryController::class, 'getCategories']);
    Route::get('getCategoryById/{id}', [CategoryController::class, 'getCategoryById']);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::delete('deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);
        Route::post('addCategory', [CategoryController::class, 'addCategory']);
        Route::put('updateCategory', [CategoryController::class, 'updateCategory']);
    });
});
Route::prefix('product')->group(function () {
    Route::get('get', [ProductController::class, 'get']);
    Route::get('getall', [ProductController::class, 'getAll']);
    Route::get('getproduct/{category_slug}/{product_slug}', [ProductController::class, 'getProductDetail_BySlug']);
    Route::get('getbycategory', [ProductController::class, 'getByCategory']);
    Route::get('getlast', [ProductController::class, 'getLastDiscount']);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('add', [ProductController::class, 'addProduct']);
        Route::get('edit/{id}', [ProductController::class, 'edit']);
        Route::put('edit/{id}', [ProductController::class, 'updateProduct']);
    });
});
Route::prefix('menu')->group(function () {
    Route::get('get', [MenuController::class, 'getAllMenus']);
    Route::get('getmenus', 'App\Http\Controllers\MenuController@getMenus');
    Route::get('getsubmenus', 'App\Http\Controllers\MenuController@getSubMenus');
    Route::get('getMenulevel2s', 'App\Http\Controllers\MenuController@getMenulevel2s');
});




Route::prefix('topbar')->group(function () {
    Route::get('gettopbar', [TopbarController::class, 'getTopbarImage']);
});
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
