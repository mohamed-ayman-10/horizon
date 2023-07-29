<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Vendor" middleware group. Now create something great!
|
*/

// Auth

Route::controller('AuthController')->middleware('guest:vendor')->name('auth.')->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('postLogin', 'postLogin')->name('postLogin');
    Route::get('register', 'register')->name('register');
    Route::get('phone_verified', 'phone_verified')->name('phone_verified');
    Route::post('postRegister', 'postRegister')->name('postRegister');
    Route::post('/verified/vendor', [\App\Http\Controllers\ProfileController::class, 'verified_vendor'])->name('verified_vendor');
    Route::get('page/verified/{id}', [\App\Http\Controllers\ProfileController::class, 'get_page_verified'])->name('get_page_verified');
});

Route::get('/', function () {
    return view('vendor.index');
})->name('index')->middleware('auth:vendor');





Route::middleware('auth:vendor')->group(function () {
    // Logout
    Route::get('logout', 'AuthController@logout')->name('logout');

    // Categories
    Route::prefix('categories')->name('category.')->controller('CategoryController')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::get('/{id}/destroy', 'destroy')->name('destroy');
    });

    // Products
    Route::prefix('products')->name('product.')->controller('ProductController')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::get('/{id}/destroy', 'destroy')->name('destroy');
        Route::get('{id}/images', 'images')->name('images');
        Route::post('{id}/updateImage', 'updateImage')->name('updateImage');
        Route::post('/storeImages', 'storeImages')->name('storeImages');
        Route::get('{id}/destroyImage', 'destroyImage')->name('destroyImage');
    });

    //Profile
    Route::get('profile/{id}', [\App\Http\Controllers\ProfileController::class, 'show_profile_vendor'])->name('show_profile');
    Route::post('/update/vendor', [\App\Http\Controllers\AdminVendorController::class, 'update_vendor'])->name('update_vendor');
});
