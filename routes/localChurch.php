<?php

use App\Http\Controllers\LocalChurch\DisciplineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalChurch\FriendResource;
use App\Http\Controllers\LocalChurch\MemberResource;
use App\Http\Controllers\LocalChurch\GroupController;
use App\Http\Controllers\LocalChurch\ChildrenResource;
use App\Http\Controllers\LocalChurch\PenitentResource;
use App\Http\Controllers\LocalChurch\TeenagerResource;
use App\Http\Controllers\LocalChurch\CallingController;
use App\Http\Controllers\LocalChurch\RequestController;
use App\Http\Controllers\LocalChurch\ClassStepController;
use App\Http\Controllers\LocalChurch\CommissionController;
use App\Http\Controllers\LocalChurch\MemberStepController;
use App\Http\Controllers\LocalChurch\SundaySchoolController;

use App\Http\Controllers\LocalChurch\RecommandationController;
use App\Http\Controllers\LocalChurch\ReportsController;
use App\Http\Controllers\LocalChurch\SettingController;

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
    Route::controller(DisciplineController::class)->prefix('discipline')->name('discipline.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'remove')->name('remove');
        Route::get('/calling', 'calling')->name('calling');
        Route::post('/calling', 'storeCalling')->name('storeCalling');
        Route::get('/search', 'search')->name('search');
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

    Route::controller(MemberStepController::class)->name('memberStep.')->prefix('memberStep')->group(function () {

        Route::get('/child-prays-list', 'childrenPraysList')->name('childrenPraysList');
        Route::put('/child-prays/approve/{id}', 'childrenPraysApprove')->name('childrenPraysApprove');
        Route::put('/child-prays/reject/{id}', 'childrenPraysReject')->name('childrenPraysReject');

        // Apply for a Funeral

        Route::get('/funeralList', 'funeralList')->name('funeralList');
        Route::put('/funeralList/approve/{id}', 'funeralApprove')->name('funeralApprove');
        Route::put('/funeralList/reject/{id}', 'funeralReject')->name('funeralReject');

        // holy Communion
        Route::get('/holy-communion-list', 'holyCommunionList')->name('holyCommunionList');
        Route::put('/holy-communion/approve/{id}', 'holyCommunionApprove')->name('holyCommunionApprove');
        Route::put('/holy-communion/reject/{id}', 'holyCommunionReject')->name('holyCommunionReject');

        // prayer request

        Route::get('/prayer-request-list', 'prayerRequestList')->name('prayerRequestList');
        Route::put('/prayer-request/approve/{id}', 'prayerRequestApprove')->name('prayerRequestApprove');
        Route::put('/prayer-request/reject/{id}', 'prayerRequestReject')->name('prayerRequestReject');

        // wedding project

        Route::get('/wedding-project-list', 'weddingProjectList')->name('weddingProjectList');
        Route::put('/wedding-project/approve/{id}', 'weddingProjectApprove')->name('weddingProjectApprove');
        Route::put('/wedding-project/reject/{id}', 'weddingProjectReject')->name('weddingProjectReject');

    });
    Route::controller(RecommandationController::class)->name('recommandation.')->prefix('recommandation')->group(function () {

        // transfer
        Route::get('/transferList', 'transferList')->name('transferList');
        Route::put('/transfer/approve/{id}', 'transferApprove')->name('transferApprove');
        Route::put('/transfer/reject/{id}', 'transferReject')->name('transferReject');


        Route::get('/assembly-proof-list', 'assemblyProofList')->name('assemblyProofList');
        Route::put('/assembly-proof/approve/{id}', 'assemblyProofApprove')->name('assemblyProofApprove');
        Route::put('/assembly-proof/reject/{id}', 'assemblyProofReject')->name('assemblyProofReject');


        Route::get('/member-proof-list', 'memberProofList')->name('memberProofList');
        Route::put('/member-proof/approve/{id}', 'memberProofAppove')->name('memberProofAppove');
        Route::put('/member-proof/reject/{id}', 'memberProofReject')->name('memberProofReject');

    });
    Route::controller(RequestController::class)->name('request.')->prefix('request')->group(function () {

        Route::get('/suggestion/list', 'suggestionList')->name('suggestionList');
        Route::put('/suggestion/reply/{id}', 'suggestionReply')->name('suggestionReply');

        Route::get('/praise-request-list', 'praiseRequestList')->name('praiseRequestList');
        Route::put('/praise-request/approve/{id}', 'praiseRequestApprove')->name('praiseRequestApprove');
        Route::put('/praise-request/reject/{id}', 'praiseRequestReject')->name('praiseRequestReject');


        Route::get('/preach-request-list', 'preachRequestList')->name('preachRequestList');
        Route::put('/preach-request/approve/{id}', 'preachRequestApprove')->name('preachRequestApprove');
        Route::put('/preach-request/reject/{id}', 'preachRequestReject')->name('preachRequestReject');

        Route::get('/socialMedia-preach-list', 'socialMediaPreachList')->name('socialMediaPreachList');
        Route::put('/socialMedia-preach/approve/{id}', 'socialMediaPreachApprove')->name('socialMediaPreachApprove');
        Route::put('/socialMedia-preach/reject/{id}', 'socialMediaPreachReject')->name('socialMediaPreachReject');

        Route::get('/choirMove-request-list', 'choirMoveList')->name('choirMoveList');
        Route::put('/choirMove-request/approve/{id}', 'choirMoveApprove')->name('choirMoveApprove');
        Route::put('/choirMove-request/reject/{id}', 'choirMoveReject')->name('choirMoveReject');

        Route::get('/leaderMeet-request-list', 'leaderMeetRequestList')->name('leaderMeetRequestList');
        Route::put('/leaderMeet-request/approve/{id}', 'leaderMeetRequestApprove')->name('leaderMeetRequestApprove');
        Route::put('/leaderMeet-request/reject/{id}', 'leaderMeetRequestReject')->name('leaderMeetRequestReject');
    });

    Route::controller(SettingController::class)->name('setting.')->prefix('setting')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/setWeddingPrice', 'setWeddingPrice')->name('setWeddingPrice');
    });
    Route::controller(ReportsController::class)->name('report.')->prefix('report')->group(function () {
        Route::get('/members', 'members')->name('members');
        Route::get('/genderAndAge', 'genderAndAge')->name('genderAndAge');
        Route::get('/educationLevel', 'educationLevel')->name('educationLevel');
        Route::get('/socialSecurity', 'socialSecurity')->name('socialSecurity');
        Route::get('/savingType', 'savingType')->name('savingType');
    });


 });
