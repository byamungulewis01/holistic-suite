<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalChurch\FriendResource;
use App\Http\Controllers\LocalChurch\MemberResource;
use App\Http\Controllers\LocalChurch\GroupController;
use App\Http\Controllers\LocalChurch\ChildrenResource;
use App\Http\Controllers\LocalChurch\PenitentResource;
use App\Http\Controllers\LocalChurch\TeenagerResource;
use App\Http\Controllers\LocalChurch\CallingController;
use App\Http\Controllers\LocalChurch\ClassStepController;
use App\Http\Controllers\LocalChurch\CommissionController;
use App\Http\Controllers\LocalChurch\SundaySchoolController;
use App\Http\Controllers\LocalChurch\OnlineServiceController;

 Route::group(['middleware' => 'auth'], function () {
    // Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
    Route::resource('member', MemberResource::class)->name('*', 'member');
    Route::resource('children', ChildrenResource::class)->name('*', 'children');
    Route::resource('penitent', PenitentResource::class)->name('*', 'penitent');
    Route::resource('teenager', TeenagerResource::class)->name('*', 'teenager');
    Route::resource('friend', FriendResource::class)->name('*', 'friend');

    Route::get('penitentApi', [PenitentResource::class,'penitentApi'])->name('penitentApi');
    Route::get('teenagerApi', [TeenagerResource::class,'teenagerApi'])->name('teenagerApi');
    Route::get('friendApi', [FriendResource::class,'friendApi'])->name('friendApi');


    Route::controller(MemberResource::class)->prefix('memberProfile')->name('memberProfile.')->group(function () {
        Route::post('/childPrayer{id}', 'storeChildPrayer')->name('storeChildPrayer');
        Route::put('/childPrayer/{id}', 'updateChildPrayer')->name('updateChildPrayer');

        Route::post('/baptism{id}', 'storeBaptism')->name('storeBaptism');
        Route::put('/baptism/{id}', 'updateBaptism')->name('updateBaptism');

        Route::post('/mariage{id}', 'storeMarriage')->name('storeMarriage');
        Route::put('/mariage/{id}', 'updateMarriage')->name('updateMarriage');

        Route::post('/createFamily/{id}', 'storeFamily')->name('storeFamily');
        Route::post('/assignMember/{id}', 'assignMember')->name('assignMember');
        Route::get('/addChild/{id}', 'addChild')->name('addChild');
        Route::delete('/destroyChild/{id}', 'destroyChild')->name('destroyChild');
    });
    Route::controller(ChildrenResource::class)->prefix('childProfile')->name('childProfile.')->group(function () {
        Route::post('/assignMember/{id}', 'assignMember')->name('assignMember');
    });

    Route::controller(CallingController::class)->prefix('calling')->name('calling.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/search', 'search')->name('search');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');

        Route::get('/sunday-school', 'sundaySchool')->name('sundaySchool');
        Route::post('/sunday-school', 'sundaySchoolStore')->name('sundaySchoolStore');
        Route::put('/sunday-school/{id}', 'sundaySchoolUpdate')->name('sundaySchoolUpdate');
        Route::delete('/sunday-school/{id}', 'sundaySchoolDestroy')->name('sundaySchoolDestroy');
    });
    Route::controller(ClassStepController::class)->prefix('class-step')->name('step.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::get('/members/{id}', 'members')->name('members');
        Route::post('/new-believer/{id}', 'newBeliever')->name('newBeliever');
        Route::delete('/new-believer/{id}', 'destroyBeliever')->name('destroyBeliever');
        Route::put('/new-believer/{id}', 'completion')->name('completion');
        Route::post('/new-member/{id}', 'newMember')->name('newMember');
        Route::delete('/new-member/{id}', 'destroyMember')->name('destroyMember');
        Route::get('/class-schedule/{id}', 'schedule')->name('schedule');
        Route::post('/class-schedule/{id}', 'scheduleStore')->name('scheduleStore');
        Route::put('/class-schedule/{id}', 'scheduleUpdate')->name('scheduleUpdate');
        Route::delete('/class-schedule/{id}', 'scheduleDestroy')->name('scheduleDestroy');
    });
    Route::controller(GroupController::class)->prefix('group')->name('group.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');

        Route::get('/members/{id}', 'members')->name('members');
        Route::post('/group-member/{id}', 'storeGroupMember')->name('storeGroupMember');
        Route::delete('/group-member/{id}', 'destroyGroupMember')->name('destroyGroupMember');
        Route::post('/group-leader/{id}', 'storeGroupLeader')->name('storeGroupLeader');
        Route::put('/group-leader/{id}', 'removeGroupLeader')->name('removeGroupLeader');

    });
    Route::controller(CommissionController::class)->prefix('commission')->name('commission.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');

        Route::get('/members/{id}', 'members')->name('members');
        Route::post('/members/{id}', 'StoreMember')->name('StoreMember');
        Route::put('/members/{id}', 'editMember')->name('editMember');
        Route::delete('/members/{id}', 'destroyMember')->name('destroyMember');

    });

    // sunday school

    Route::controller(SundaySchoolController::class)->prefix('sunday-school')->name('sundaySchool.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');

        Route::get('/members/{id}', 'members')->name('members');
        Route::post('/members/{id}', 'storeMember')->name('storeMember');
        Route::delete('/members/{id}', 'destroyMember')->name('destroyMember');
        Route::get('/add-child/{id}', 'addChild')->name('addChild');
        Route::put('/changeLevel/{id}', 'changeLevel')->name('changeLevel');

    });

    Route::controller(OnlineServiceController::class)->prefix('online-service')->name('onlineService.')->group(function () {
        Route::get('/moving', 'moving')->name('moving');
        Route::put('/moving/{id}', 'aprooveMoving')->name('aprooveMoving');
        Route::put('/rejectMoving/{id}', 'rejectMoving')->name('rejectMoving');
    });


 });
