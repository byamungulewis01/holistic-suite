<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Parish\UsersController;
use App\Http\Controllers\Parish\OfficeRegistration;

 Route::group(['middleware' => 'auth'], function () {
    // Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

    Route::controller(UsersController::class)->group(function () {
        // Parish User Registration
        Route::prefix('parish-users')->name('parishUser.')->group(function () {
            Route::get('/', 'parishUsers')->name('index');
            Route::post('/', 'storeParishUser')->name('store');
            Route::put('/{id}', 'updateParishUser')->name('update');
            Route::delete('/{id}', 'destroyParishUser')->name('destroy');
        });

        // Local Church User Registration
        Route::prefix('localChurch-users')->name('localChurchUser.')->group(function () {
            Route::get('/', 'localChurchUsers')->name('index');
            Route::post('/', 'storeLocalChurchUser')->name('store');
            Route::put('/{id}', 'updateLocalChurchUser')->name('update');
            Route::delete('/{id}', 'destroyLocalChurchUser')->name('destroy');
        });
    });
        // Office Registration
        Route::controller(OfficeRegistration::class)->prefix('office')->name('office.')->group(function () {
            // Local Church CRUD
            Route::get('/local-church', 'localChurch')->name('localChurch');
            Route::post('/local-church', 'storeLocalChurch')->name('storeLocalChurch');
            Route::put('/local-church/{id}', 'updateLocalChurch')->name('updateLocalChurch');
            Route::delete('/local-church/{id}', 'destroyLocalChurch')->name('destroyLocalChurch');

        });
 });
