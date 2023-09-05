<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfficeRegistration;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(OfficeRegistration::class)->prefix('office')->name('office.')->group(function () {

    // get districts
    Route::get('/get-districts/{province}', 'getDistricts')->name('getDistricts');
    // get sectors
    Route::get('/get-sectors/{district}', 'getSectors')->name('getSectors');
    // get cells
    Route::get('/get-cells/{sector}', 'getCells')->name('getCells');
    // get villages
    Route::get('/get-villages/{cell}', 'getVillages')->name('getVillages');
    // getParishes
    Route::get('/parishesApi', 'parishesApi')->name('parishesApi');
    Route::get('/get-parishes/{parish}', 'getParishes')->name('getParishes');
    // getChurches
    Route::get('/get-churches/{church}', 'getChurches')->name('getChurches');

    Route::get('/localChurchApi', 'localChurchApi')->name('localChurchApi');

});
Route::controller(UsersController::class)->prefix('users')->name('users.')->group(function () {

    // get all parish users
    Route::get('/get-parish-users', 'parishUsersApi')->name('parishUsersApi');
    Route::get('/get-parish-users/{id}', 'singleParishUsersApi')->name('singleParishUsersApi');
    // get all local church users
    Route::get('/get-local-church-users', 'localChurchUsersApi')->name('localChurchUsersApi');
    Route::get('/get-local-church-users/{id}', 'singleLocalChurchUsersApi')->name('singleLocalChurchUsersApi');

});

