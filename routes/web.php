<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', function () {
    return redirect()->route('admin.index');
});

Route::get('reset', function (){
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    return "Done";
});

Route::get('migrate', function () {
    Artisan::call('migrate');
    return "Migration Done";
});

Route::get('seed', function () {
    Artisan::call('db:seed');
    return "seed Done";
});
