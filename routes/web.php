<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OfficeRegistration;
use App\Http\Controllers\PredefinedController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::group(['middleware' => 'guest'], function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/', 'index')->name('login');
        Route::post('/', 'login')->name('login.post');
        Route::get('/forgot-password', 'forgotPassword')->name('forgotPassword');
        Route::get('/success', 'success')->name('success');
        Route::post('/forgot-password', 'sendResetLinkEmail')->name('sendResetLinkEmail');
    });
});
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Route::group(['middleware' => 'auth', 'hasDefaultPassword'], function () {
    Route::get('/change-default-password', [DashboardController::class, 'changeDefaultPassword'])->name('default.changePassword');
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/headquarter', 'headquarter')->name('headquarter.dashboard')->middleware('user-access:headquarter');
        Route::get('/region', 'region')->name('region.dashboard')->middleware('user-access:region');
        Route::get('/parish', 'parish')->name('parish.dashboard')->middleware('user-access:parish');
        Route::get('/local-church', 'localChurch')->name('localChurch.dashboard')->middleware('user-access:local church');
        Route::get('/profile', 'profile')->name('profile');
        Route::put('/profile/change-profile-picture', 'changeProfilePicture')->name('changeProfilePicture');
        Route::put('/change-password', 'changePassword')->name('changePassword');
        Route::put('/change-personal-details', 'changePersonalDetails')->name('changePersonalDetails');
    });
    // Roles and Permissions
    Route::controller(RolesController::class)->group(function () {
        Route::get('/roles-and-permissions', 'index')->name('rolesAndPermissions');
        Route::post('/roles-and-permissions', 'store');
        Route::delete('/roles-and-permissions/{id}', 'destroy')->name('rolesAndPermissions.destroy');
    });
    //   End Roles and Permissions
    // Office Registration
    Route::controller(OfficeRegistration::class)->prefix('office')->name('office.')->group(function () {
        // Region CRUD
        Route::get('/region', 'region')->name('region');
        Route::post('/region', 'storeRegion')->name('storeRegion');
        Route::put('/region/{id}', 'updateRegion')->name('updateRegion');
        Route::delete('/region/{id}', 'destroyRegion')->name('destroyRegion');
        // Region CRUD End

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
    // User Registration
    Route::controller(UsersController::class)->middleware('user-access:headquarter')->prefix('hq')->name('users.')->group(function () {
        // Headquarter User Registration
        Route::prefix('headquarter-users')->name('headquarter.')->group(function () {
            Route::get('/', 'headquarterUsers')->name('index');
            Route::post('/', 'storeHeadquarterUser')->name('store');
            Route::put('/{id}', 'updateHeadquarterUser')->name('update');
            Route::delete('/{id}', 'destroyHeadquarterUser')->name('destroy');
        });
        // Headquarter User Registration End

        // Region User Registration
        Route::prefix('region-users')->name('region.')->group(function () {
            Route::get('/', 'regionUsers')->name('index');
            Route::post('/', 'storeRegionUser')->name('store');
            Route::put('/{id}', 'updateRegionUser')->name('update');
            Route::delete('/{id}', 'destroyRegionUser')->name('destroy');
        });

        // Parish User Registration
        Route::prefix('parish-users')->name('parish.')->group(function () {
            Route::get('/', 'parishUsers')->name('index');
            Route::post('/', 'storeParishUser')->name('store');
            Route::put('/{id}', 'updateParishUser')->name('update');
            Route::delete('/{id}', 'destroyParishUser')->name('destroy');
        });

        // Local Church User Registration
        Route::prefix('localChurch-users')->name('localChurch.')->group(function () {
            Route::get('/', 'localChurchUsers')->name('index');
            Route::post('/', 'storeLocalChurchUser')->name('store');
            Route::put('/{id}', 'updateLocalChurchUser')->name('update');
            Route::delete('/{id}', 'destroyLocalChurchUser')->name('destroy');
        });

    });

    Route::controller(PredefinedController::class)->prefix('predefined')->name('predefined.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/second', 'second')->name('second');
        Route::get('/third', 'third')->name('third');
        Route::get('/fourth', 'fourth')->name('fourth');
        // Ministry CRUD
        Route::post('/ministry', 'storeMinistry')->name('storeMinistry');
        Route::put('/ministry/{id}', 'updateMinistry')->name('updateMinistry');
        Route::delete('/ministry/{id}', 'destroyMinistry')->name('destroyMinistry');
        // Ministry CRUD End

        // Education CRUD
        Route::post('/education', 'storeEducation')->name('storeEducation');
        Route::put('/education/{id}', 'updateEducation')->name('updateEducation');
        Route::delete('/education/{id}', 'destroyEducation')->name('destroyEducation');
        // Education CRUD End

        // Education CRUD
        Route::post('/children-education', 'storeChildrenEducation')->name('storeChildrenEducation');
        Route::put('/children-education/{id}', 'updateChildrenEducation')->name('updateChildrenEducation');
        Route::delete('/children-education/{id}', 'destroyChildrenEducation')->name('destroyChildrenEducation');
        // Education CRUD End

        // Medical Insurance CRUD
        Route::post('/medical-insurance', 'storeMedicalInsurance')->name('storeMedicalInsurance');
        Route::put('/medical-insurance/{id}', 'updateMedicalInsurance')->name('updateMedicalInsurance');
        Route::delete('/medical-insurance/{id}', 'destroyMedicalInsurance')->name('destroyMedicalInsurance');

        // Saving Type CRUD
        Route::post('/saving-type', 'storeSavingType')->name('storeSavingType');
        Route::put('/saving-type/{id}', 'updateSavingType')->name('updateSavingType');
        Route::delete('/saving-type/{id}', 'destroySavingType')->name('destroySavingType');

        // Relation CRUD
        Route::post('/relation', 'storeRelation')->name('storeRelation');
        Route::put('/relation/{id}', 'updateRelation')->name('updateRelation');
        Route::delete('/relation/{id}', 'destroyRelation')->name('destroyRelation');

        // Field CRUD

        Route::post('/field', 'storeField')->name('storeField');
        Route::put('/field/{id}', 'updateField')->name('updateField');
        Route::delete('/field/{id}', 'destroyField')->name('destroyField');

        // Status CRUD
        Route::post('/status', 'storeStatus')->name('storeStatus');
        Route::put('/status/{id}', 'updateStatus')->name('updateStatus');
        Route::delete('/status/{id}', 'destroyStatus')->name('destroyStatus');

        // Marital Status CRUD
        Route::post('/marital-status', 'storeMaritalStatus')->name('storeMaritalStatus');
        Route::put('/marital-status/{id}', 'updateMaritalStatus')->name('updateMaritalStatus');
        Route::delete('/marital-status/{id}', 'destroyMaritalStatus')->name('destroyMaritalStatus');

        // Service CRUD
        Route::post('/service', 'storeService')->name('storeService');
        Route::put('/service/{id}', 'updateService')->name('updateService');
        Route::delete('/service/{id}', 'destroyService')->name('destroyService');

        // Religion CRUD
        Route::post('/religion', 'storeReligion')->name('storeReligion');
        Route::put('/religion/{id}', 'updateReligion')->name('updateReligion');
        Route::delete('/religion/{id}', 'destroyReligion')->name('destroyReligion');

        // Calling CRUD
        Route::post('/calling', 'storeCalling')->name('storeCalling');
        Route::put('/calling/{id}', 'updateCalling')->name('updateCalling');
        Route::delete('/calling/{id}', 'destroyCalling')->name('destroyCalling');

        // Step CRUD
        Route::post('/step', 'storeStep')->name('storeStep');
        Route::put('/step/{id}', 'updateStep')->name('updateStep');
        Route::delete('/step/{id}', 'destroyStep')->name('destroyStep');

        // Commission CRUD
        Route::post('/commission', 'storeCommission')->name('storeCommission');
        Route::put('/commission/{id}', 'updateCommission')->name('updateCommission');
        Route::delete('/commission/{id}', 'destroyCommission')->name('destroyCommission');

    });

    // logout
    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');
    Route::get('/403', function () {
        return view('errors.403');
    })->name('403');
});
