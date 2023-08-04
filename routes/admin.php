<?php

use App\Http\Controllers\Admin\AllProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DeleviryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductSectionController;
use App\Http\Controllers\Admin\ReceiveController;
use App\Http\Controllers\Admin\TechnicalSupportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/

// Auth
Route::controller('AuthController')->middleware('guest:admin')->name('auth.')->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('postLogin', 'postLogin')->name('postLogin');
    Route::get('register', 'register')->name('register');
    Route::post('postRegister', 'postRegister')->name('postRegister');
});

// Roles
Route::group(['middleware' => ['auth:admin']], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('admins', 'AdminController');
});

// Orders
Route::controller(OrderController::class)->name('order.')->middleware('auth:admin')->prefix('order')->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('user/{id}', 'showUser')->name('showUser');
    Route::get('vendor/{id}', 'showVendor')->name('showVendor');
    Route::get('product/{id}', 'showProduct')->name('showProduct');
    Route::get('more/{id}', 'more')->name('more');
    Route::post('sendOrder', 'sendOrder')->name('sendOrder');
    Route::post('statusSendOrder', 'statusSendOrder')->name('statusSendOrder');
    // Receive
    Route::controller(ReceiveController::class)->prefix('receives')->group(function () {
        Route::get('', 'index')->name('receive.index');
        Route::get('complete/{order_id}', 'complete')->name('receive.complete');
        Route::get('receive', 'receive')->name('receive');
        Route::post('', 'postReceive')->name('postReceive');
    });
    // Deleviry
    Route::controller(DeleviryController::class)->prefix('delivery')->group(function () {
        Route::get('', 'index')->name('delivery.index');
        Route::get('complete/{order_id}', 'complete')->name('delivery.complete');
        Route::get('deliveries', 'delivery')->name('delivery');
        Route::post('deliveries', 'postDelivery')->name('postDelivery');
    });
});


// Dashboard
Route::get('/', 'DashboardController@index')->name('index')->middleware('auth:admin');
// Notifications
Route::get('notifications', 'DashboardController@notifications')->name('notifications')->middleware('auth:admin');
Route::post('/redNotifications/{id}', 'DashboardController@readNotifications')->name('redNotifications')->middleware('auth:admin');
Route::get('/markAllAsRead', 'DashboardController@markAllAsRead')->name('markAllAsRead')->middleware('auth:admin');
Route::get('/deleteNotification/{id}', 'DashboardController@deleteNotification')->name('deleteNotification')->middleware('auth:admin');

Route::middleware('auth:admin')->group(function () {
    // Logout
    Route::get('logout', 'AuthController@logout')->name('logout');
});


Route::middleware('auth:admin')->group(function () {
    Route::post('/product/publishSelected', [\App\Http\Controllers\AdminVendorController::class, 'publishSelected'])->name('publishSelected');
    Route::get('profile/{id}', [\App\Http\Controllers\ProfileController::class, 'show_profile_admin'])->name('show_profile');
    Route::post('/profile', [\App\Http\Controllers\ProfileController::class, 'save_profile_admin'])->name('save_profile');
    Route::get('/vendor', [\App\Http\Controllers\AdminVendorController::class, 'show_vendor'])->name('show_vendor');
    Route::get('/vendor/{id}', [\App\Http\Controllers\AdminVendorController::class, 'show_product_vendor'])->name('show_product_vendor');
    Route::get('/product/sharing/{id}', [\App\Http\Controllers\AdminVendorController::class, 'sharing_product_vendor'])->name('sharing_product_vendor');
    Route::get('/product/unsharing/{id}/{boolean}', [\App\Http\Controllers\AdminVendorController::class, 'unsharing_product_vendor'])->name('unsharing_product_vendor');
    Route::post('/add/percentage/product', [\App\Http\Controllers\AdminVendorController::class, 'add_percentage_product'])->name('add_percentage_product');
    Route::get('/all/product/unsharing', [\App\Http\Controllers\AdminVendorController::class, 'all_product_unsharing'])->name('all_product_unsharing');
    Route::get('get/vendor/{id}', [\App\Http\Controllers\AdminVendorController::class, 'get_vendor'])->name('get_vendor');
    Route::post('/update/vendor', [\App\Http\Controllers\AdminVendorController::class, 'update_vendor'])->name('update_vendor');
    Route::post('/save/vendor', [\App\Http\Controllers\AdminVendorController::class, 'save_vendor'])->name('save_vendor');
    Route::get('delete/vendor/{id}', [\App\Http\Controllers\AdminVendorController::class, 'delete_vendor'])->name('delete_vendor');
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('get_home');
    Route::post('/home', [\App\Http\Controllers\HomeController::class, 'update'])->name('update_home');
    Route::get('all_product', [\App\Http\Controllers\Admin\ProductController::class, 'All_product'])->name('all_products');
    Route::get('show/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'show'])->name('show');
});

//Slider
Route::middleware('auth:admin')->group(function () {
    Route::get('home/slider', [\App\Http\Controllers\Admin\SliderController::class, 'index'])->name('get_slider');
    Route::post('save/slider', [\App\Http\Controllers\Admin\SliderController::class, 'create'])->name('create_slider');
    Route::post('update/slider', [\App\Http\Controllers\Admin\SliderController::class, 'update'])->name('update_slider');
    Route::get('delete/slider/{id}', [\App\Http\Controllers\Admin\SliderController::class, 'delete'])->name('delete_slider');
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
})->middleware('auth:admin');

// Categories
Route::middleware('auth:admin')->prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('/');
    Route::post('create/', [CategoryController::class, 'store'])->name('create');
    Route::post('update/', [CategoryController::class, 'update'])->name('update');
    Route::get('delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});

//User
Route::middleware('auth:admin')->controller(\App\Http\Controllers\Admin\UserController::class)->group(function () {
    Route::get('user/', 'index')->name('get_user');
    Route::post('store/user', 'store')->name('user_save');
    Route::post('update/user', 'update')->name('user_update');
    Route::get('delete/user/{id}', 'delete_user')->name('delete_user');
});


Route::prefix('section')->name('section.')->middleware('auth:admin')->group(function () {
    // Offers
    Route::namespace('Sections')->controller('OfferController')->prefix('offer')->name('offer.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });

    // Weekly Offers
    Route::namespace('Sections')->controller('WeeklyOfferController')->prefix('weeklyOffer')->name('weeklyOffer.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });

    // First Category
    Route::namespace('Sections')->controller('FristCategoryController')->prefix('fristCategory')->name('fristCategory.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });

    // Last Category
    Route::namespace('Sections')->controller('LastCategoryController')->prefix('lastCategory')->name('lastCategory.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });

    // First Product
    Route::namespace('Sections')->controller('FirstProductController')->prefix('firstProduct')->name('firstProduct.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });

    // Last Product
    Route::namespace('Sections')->controller('LastProductController')->prefix('lastProduct')->name('lastProduct.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });
});

// Vendor Notifications
Route::controller('VendorNotificationController')->middleware('auth:admin')->prefix('vendorNotification')->name('vendorNotification.')->group(function () {
    Route::get('', 'index')->name('index');
    Route::post('store', 'store')->name('store');
    Route::post('update', 'update')->name('update');
    Route::get('show/{id}', 'show')->name('show');
    Route::get('destroy/{id}', 'destroy')->name('destroy');
});

// Vendor Messages
Route::controller('VendorMessageController')->middleware('auth:admin')->prefix('vendorMessage')->name('vendorMessage.')->group(function () {
    Route::get('', 'index')->name('index');
    Route::post('store', 'store')->name('store');
    Route::post('update', 'update')->name('update');
    Route::get('show/{id}', 'show')->name('show');
    Route::get('destroy/{id}', 'destroy')->name('destroy');
});


// Product Section
Route::prefix('product_section')->middleware('auth:admin')->group(function () {
    Route::resource('product_section', ProductSectionController::class);
    Route::resource('all_product_section', AllProductController::class);
    Route::get('search', [AllProductController::class, 'search'])->name('search');
});

// Technical Support
Route::prefix('technical_support')->middleware('auth:admin')->name('technical_support.')->controller(TechnicalSupportController::class)->group(function () {
    Route::get('orders', 'orders')->name('orders');
    Route::post('search_orders', 'SearchOrders')->name('search_orders');

    Route::get('vendors', 'vendors')->name('vendors');
    Route::post('search_vendors', 'SearchVendors')->name('search_vendors');
});
