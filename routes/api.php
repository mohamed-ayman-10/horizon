<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// Auth
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/user-update', [AuthController::class, 'updateUser']);
});

// Home

Route::get('slider', [HomeController::class, 'All_Slider']);
Route::get('about', [HomeController::class, 'about']);


// Categories
Route::get('categories', [HomeController::class, 'category']);
Route::get('category/{id}', [HomeController::class, 'findCategory']);


// Products
Route::get('products', [HomeController::class, 'products']);
Route::get('productWithCategory', [HomeController::class, 'productWithCategory']);
Route::get('productWithCategory/{id}', [HomeController::class, 'productWithCategoryId']);
Route::post('product', [HomeController::class, 'getProductById']);

// Auth Vendor
Route::prefix('vendor/auth')->controller(\App\Http\Controllers\Api\Vendor\AuthController::class)
    ->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');
        Route::get('/user-profile', 'userProfile');
        Route::post('/vendor-update', 'updateVendor');
    });


// PaymentMyfatoorah
//Route::get('callback', [\App\Http\Controllers\MyFatoorahController::class, 'callback`']);
//Route::post('callback', [\App\Http\Controllers\MyFatoorahController::class, 'getPayLoadData`']);

Route::post('', [\App\Http\Controllers\admin\OrderController::class, 'kk']);
Route::middleware('jwt.verify')->group(function () {

    Route::prefix('vendor/products')->controller(\App\Http\Controllers\Api\Vendor\ProductController::class)
        ->group(function () {
            Route::post('/', 'show');
            Route::post('/create', 'store');
            Route::post('{id}/update', 'update');
            Route::post('{id}/delete', 'destroy');
            Route::post('/get', 'getProductById');
        });


    // Cart
    Route::prefix('cart')->controller(CardController::class)->group(function () {
        Route::post('/', 'my_card');
        Route::post('total', 'get_total');
        Route::post('add', 'add_to_card');
        Route::post('update', 'update_quantity_product_in_my_card');
        Route::post('delete_product/{id}', 'delete_product_in_my_card');
    });

    // Payments
    Route::get('callback', [PaymentController::class, 'callback'])->name('callback');
    Route::post('/payment', [PaymentController::class, 'payment'])->name('payment');

    // Order
    Route::controller(OrderController::class)->prefix('order')->group(function () {
        Route::post('store', 'store');
    });
    Route::post('userOrder', [CardController::class, 'userOrder']);

    // Order Vendor
    Route::controller(\App\Http\Controllers\Api\Vendor\OrderController::class)->prefix('vendor/order')->group(function () {
        Route::post('', 'orders');
        Route::post('orderByProductId/{product_id}', 'orderByProductId');
    });
});

// Governorates
Route::get('governorates', function () {
    $governorates = \App\Models\Governorate::all();
    return \App\Traits\GeneralApi::returnData('201', 'Success', $governorates);
});


// Sections
Route::controller(SectionController::class)->prefix('section')->group(function () {
    Route::post('offers', 'offers');
    Route::post('weeklyOffers', 'weeklyOffers');
});
