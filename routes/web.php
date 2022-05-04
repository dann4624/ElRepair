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

// Root af Website: http://elrepair.semeicardia.online
Route::get('/', function () {
    return "Requires '/api/'; EG: ".$_SERVER['SERVER_NAME']."/api/";
});


/*
 * Artisan Endpoins
 */

// Endpoint til at ryde indholds cache
Route::get('/artisan/cache/clear', function() {
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    echo "Cleared Cache";
});

// Endpoint til at cache indhold
Route::get('/artisan/cache/all', function() {
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:cache');
    echo "ReCached";
});

// Endpoint til at generere Swagger dokument
Route::get('/artisan/swagger', function() {
    Artisan::call('l5-swagger:generate');
    echo "ReCached";
});
