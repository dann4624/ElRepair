<?php

use App\Http\Controllers\AddresseController;
use App\Http\Controllers\AfhentningstypeController;
use App\Http\Controllers\ApitokenController;
use App\Http\Controllers\ByController;
use App\Http\Controllers\FabrikantController;
use App\Http\Controllers\KundeAddresseController;
use App\Http\Controllers\KundeController;
use App\Http\Controllers\MedarbejderController;
use App\Http\Controllers\ProduktController;
use App\Http\Controllers\ProduktmodelController;
use App\Http\Controllers\ProdukttypeController;
use App\Http\Controllers\SagController;
use App\Http\Controllers\SagstypeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TokentargetController;
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

// Default Laravel User Authentican Path
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Root af Website: http://elrepair.semeicardia.online/api <-- /api bliver automatisk tilføjet af Laravel
Route::get('/', [TestController::class, 'index']);

// Middleware til API Bearer Token Authentication
Route::group(['middleware' => 'api_token'], function($router) {
    /*
     * API Token Endpoins
     */
    Route::get('/tokens', [ApitokenController::class, 'index']);
    Route::post('/tokens', [ApitokenController::class, 'store']);
    Route::post('/tokens/new', [ApitokenController::class, 'new_token']);
    Route::put('/tokens/{id}', [ApitokenController::class, 'update']);
    Route::get('/tokens/{id}', [ApitokenController::class, 'show']);
    Route::delete('/tokens/{id}', [ApitokenController::class, 'destroy']);

    /*
     * API Target Endpoins
     */
    Route::get('/targets', [TokentargetController::class, 'index']);
    Route::post('/targets', [TokentargetController::class, 'store']);
    Route::put('/targets/{id}', [TokentargetController::class, 'update']);
    Route::get('/targets/{id}', [TokentargetController::class, 'show']);
    Route::delete('/targets/{id}', [TokentargetController::class, 'destroy']);

    /*
     * Kunde Endpoins
     */
    Route::get('/kunder', [KundeController::class, 'index']);
    Route::post('/kunder', [KundeController::class, 'store']);
    Route::post('/kunder/login', [KundeController::class, 'check_login']);
    Route::get('/kunder/{id}', [KundeController::class, 'show']);
    Route::get('/kunder/{id}/sager', [KundeController::class, 'kundeSager']);
    Route::put('/kunder/{id}', [KundeController::class, 'update']);
    Route::put('/kunder/{id}/navn', [KundeController::class, 'navn']);
    Route::put('/kunder/{id}/password', [KundeController::class, 'password']);
    Route::delete('/kunder/{id}', [KundeController::class, 'destroy']);

    // Kunde Addresse Endpoints
    Route::get('/kunder/{id}/addresse', [KundeAddresseController::class, 'foretrukken']);
    Route::get('/kunder/{id}/addresser', [KundeAddresseController::class, 'index']);
    Route::post('/kunder/{id}/addresser', [KundeAddresseController::class, 'add']);
    Route::post('/kunder/{id}/addresser/{addresse_id}', [KundeAddresseController::class, 'existing']);
    Route::delete('/kunder/{id}/addresser/{addresse_id}/fjern/{delete?}', [KundeAddresseController::class, 'remove']);
    Route::put('/kunder/{id}/addresser/{addresse_id}/foretrukken', [KundeAddresseController::class, 'setForetrukken']);
    Route::delete('/kunder/{id}/addresser/{addresse_id}/foretrukken', [KundeAddresseController::class, 'removeForetrukken']);

    /*
     * Addresse Endpoins
     */
    Route::get('/addresser', [AddresseController::class, 'index']);
    Route::post('/addresser', [AddresseController::class, 'store']);
    Route::get('/addresser/{id}', [AddresseController::class, 'show']);
    Route::put('/addresser/{id}', [AddresseController::class, 'update']);
    Route::put('/addresser/{id}/foretrukken', [AddresseController::class, 'foretrukken']);
    Route::delete('/addresser/{id}', [AddresseController::class, 'destroy']);

    /*
     * By Endpoins
     */
    Route::get('/byer', [ByController::class, 'index']);
    Route::get('/byer/{id}', [ByController::class, 'show']);

    /*
     * Produkt Endpoins
     */
    Route::get('/produkter', [ProduktController::class, 'index']);
    Route::post('/produkter', [ProduktController::class, 'store']);
    Route::get('/produkter/{id}', [ProduktController::class, 'show']);
    Route::put('/produkter/{id}', [ProduktController::class, 'update']);
    Route::delete('/produkter/{id}', [ProduktController::class, 'destroy']);

    /*
     * Model Endpoins
     */
    Route::get('/modeller', [ProduktmodelController::class, 'index']);
    Route::post('/modeller', [ProduktmodelController::class, 'store']);
    Route::get('/modeller/{id}', [ProduktmodelController::class, 'show']);
    Route::put('/modeller/{id}', [ProduktmodelController::class, 'update']);
    Route::delete('/modeller/{id}', [ProduktmodelController::class, 'destroy']);

    /*
     * Produkt Type Endpoins
     */
    Route::get('/produkttyper', [ProduktTypeController::class, 'index']);
    Route::post('/produkttyper', [ProduktTypeController::class, 'store']);
    Route::get('/produkttyper/{id}', [ProduktTypeController::class, 'show']);
    Route::put('/produkttyper/{id}', [ProduktTypeController::class, 'update']);
    Route::delete('/produkttyper/{id}', [ProduktTypeController::class, 'destroy']);

    /*
     * Fabrikant Endpoins
     */
    Route::get('/fabrikanter', [FabrikantController::class, 'index']);
    Route::post('/fabrikanter', [FabrikantController::class, 'store']);
    Route::get('/fabrikanter/{id}', [FabrikantController::class, 'show']);
    Route::put('/fabrikanter/{id}', [FabrikantController::class, 'update']);
    Route::delete('/fabrikanter/{id}', [FabrikantController::class, 'destroy']);

    /*
     * Sag Endpoins
     */
    Route::get('/sager', [SagController::class, 'index']);
    Route::post('/sager', [SagController::class, 'store']);
    Route::get('/sager/{id}', [SagController::class, 'show']);
    Route::put('/sager/{id}', [SagController::class, 'update']);

    Route::delete('/sager/{id}', [SagController::class, 'destroy']);

    // Chip Relateret Endpoints
    Route::get('/sager/chip/{chip_id}', [SagController::class, 'byChip']);
    Route::post('/sager/{id}/chip/{chip_id}', [SagController::class, 'addChip']);
    Route::put('/sager/{id}/chip/{chip_id}', [SagController::class, 'updateChip']);
    Route::delete('/sager/{id}/chip', [SagController::class, 'removeChip']);

    // Status Relateret Endpoints
    Route::get('/sager/{id}/status', [SagController::class, 'getStatus']);
    Route::put('/sager/{id}/status/{status_id}', [SagController::class, 'updateStatus']);

    /*
     * Sagstype Endpoins
     */
    Route::get('/sagstyper', [SagstypeController::class, 'index']);
    Route::post('/sagstyper', [SagstypeController::class, 'store']);
    Route::get('/sagstyper/{id}', [SagstypeController::class, 'show']);
    Route::put('/sagstyper/{id}', [SagstypeController::class, 'update']);
    Route::delete('/sagstyper/{id}', [SagstypeController::class, 'destroy']);

    /*
     * Afhentningstype Endpoins
     */
    Route::get('/afhentningstyper', [AfhentningstypeController::class, 'index']);
    Route::post('/afhentningstyper', [AfhentningstypeController::class, 'store']);
    Route::get('/afhentningstyper/{id}', [AfhentningstypeController::class, 'show']);
    Route::put('/afhentningstyper/{id}', [AfhentningstypeController::class, 'update']);
    Route::delete('/afhentningstyper/{id}', [AfhentningstypeController::class, 'destroy']);

    /*
     * Status Endpoins
     */
    Route::get('/statuser', [StatusController::class, 'index']);
    Route::post('/statuser', [StatusController::class, 'store']);
    Route::get('/statuser/{id}', [StatusController::class, 'show']);
    Route::put('/statuser/{id}', [StatusController::class, 'update']);
    Route::delete('/statuser/{id}', [StatusController::class, 'destroy']);

    /*
     * Medarbejder Endpoins
     */
    Route::get('/medarbejdere', [MedarbejderController::class, 'index']);
    Route::post('/medarbejdere', [MedarbejderController::class, 'store']);
    Route::post('/medarbejdere/login', [MedarbejderController::class, 'check_login']);
    Route::get('/medarbejdere/{id}', [MedarbejderController::class, 'show']);
    Route::get('/medarbejdere/{id}/sager', [MedarbejderController::class, 'medarbejderSager']);
    Route::put('/medarbejdere/{id}', [MedarbejderController::class, 'update']);
    Route::put('/medarbejdere/{id}/navn', [MedarbejderController::class, 'navn']);
    Route::put('/medarbejdere/{id}/password', [MedarbejderController::class, 'password']);
    Route::delete('/medarbejdere/{id}', [MedarbejderController::class, 'destroy']);
});



