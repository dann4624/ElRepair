<?php

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
Route::get('/artisan/cache/clear', function() {
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    echo "Cleared Cache";
});

Route::get('/artisan/cache/all', function() {
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:cache');
    echo "ReCached";
});

Route::get('/artisan/swagger', function() {
    Artisan::call('l5-swagger:generate');
    echo "ReCached";
});

Route::get('/', function () {
    return "Requires '/api/'; EG: ".$_SERVER['SERVER_NAME']."/api/";
});
