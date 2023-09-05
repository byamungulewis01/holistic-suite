<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Region\UsersController;
use App\Http\Controllers\Region\OfficeRegistration;

 Route::group(['middleware' => 'auth'], function () {
    // Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

    Route::controller(UsersController::class)->group(function () {
        // Region User Registration
        Route::prefix('region-users')->name('regionUser.')->group(function () {
            Route::get('/', 'regionUsers')->name('index');
            Route::post('/', 'storeRegionUser')->name('store');
            Route::put('/{id}', 'updateRegionUser')->name('update');
            Route::delete('/{id}', 'destroyRegionUser')->name('destroy');
        });

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
        // Parish CRUD
        Route::get('/parish', 'parish')->name('parish');
        Route::post('/parish', 'storeParish')->name('storeParish');
        Route::put('/parish/{id}', 'updateParish')->name('updateParish');
        Route::delete('/parish/{id}', 'destroyParish')->name('destroyParish');
        // Parish CRUD End

        // Local Church CRUD
        Route::get('/local-church', 'localChurch')->name('localChurch');
        Route::post('/local-church', 'storeLocalChurch')->name('storeLocalChurch');
        Route::put('/local-church/{id}', 'updateLocalChurch')->name('updateLocalChurch');
        Route::delete('/local-church/{id}', 'destroyLocalChurch')->name('destroyLocalChurch');

    });
 });
