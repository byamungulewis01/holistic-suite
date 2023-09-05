<?php

use App\Http\Controllers\Member\AuthenticationController;
use App\Http\Controllers\Member\HomeController;
use App\Http\Controllers\Member\MemberStepController;
use App\Http\Controllers\Member\ProfileController;
use App\Http\Controllers\Member\RecommandationController;
use App\Http\Controllers\Member\RequestController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {
    Route::controller(AuthenticationController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginAuth')->name('login');
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'registerAuth')->name('register');
        Route::get('/forgot-password', 'forgotPassword')->name('forgotPassword');
        Route::post('/forgot-password', 'forgotPasswordAuth')->name('forgotPasswordAuth');
        Route::get('/verify/{id}', 'verify')->name('verify');
        Route::put('/verify/{id}', 'verifyAuth')->name('verify');
        Route::get('/success', 'success')->name('success');
    });
});


 Route::group(['middleware' => 'member'], function () {
    // Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'home')->name('home');
        Route::get('/profile', 'profile')->name('profile');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/change-profile', 'profile')->name('memberProfile');
        Route::put('/profile/change-profile-picture', 'changeProfilePicture')->name('changeProfilePicture');
        Route::put('/change-password', 'changePassword')->name('changePassword');
        Route::put('/change-personal-details', 'changePersonalDetails')->name('changePersonalDetails');
    });



    Route::controller(MemberStepController::class)->name('memberStep.')->prefix('memberStep')->group(function () {
        Route::get('/child-prays', 'childrenPrays')->name('childrenPrays');
        Route::get('/child-prays-list', 'childrenPraysList')->name('childrenPraysList');
        Route::post('/child-prays', 'storeChildrenPrays')->name('storeChildrenPrays');
        Route::delete('/child-prays/{id}', 'destroyChildrenPrays')->name('destroyChildrenPrays');
        // Apply for a Funeral
        Route::get('/funeral', 'funeral')->name('funeral');
        Route::get('/funeralList', 'funeralList')->name('funeralList');
        Route::post('/funeral', 'storeFuneral')->name('storeFuneral');
        Route::delete('/funeral/{id}', 'destroyFuneral')->name('destroyFuneral');
        // holy Communion
        Route::get('/holy-communion', 'holyCommunion')->name('holyCommunion');
        Route::post('/holy-communion', 'storeHolyCommunion')->name('storeHolyCommunion');
        // prayer request
        Route::get('/prayer-request', 'prayerRequest')->name('prayerRequest');
        Route::post('/prayer-request', 'storePrayerRequest')->name('storePrayerRequest');
        // wedding project
        Route::get('/wedding-project', 'weddingProject')->name('weddingProject');
        Route::get('/wedding-project-list', 'weddingProjectList')->name('weddingProjectList');
        Route::post('/wedding-project', 'storeWeddingProject')->name('storeWeddingProject');
    });


    Route::controller(RecommandationController::class)->name('recommandation.')->prefix('recommandation')->group(function () {
        Route::get('/moving', 'moving')->name('moving');
        Route::post('/moving', 'storeMoving')->name('storeMoving');
        Route::put('/moving/{id}', 'updateMoving')->name('updateMoving');
        Route::delete('/moving/{id}', 'destroyMoving')->name('destroyMoving');

        // transfer
        Route::get('/transfer', 'transfer')->name('transfer');
        Route::get('/transferList', 'transferList')->name('transferList');
        Route::post('/transfer', 'storeTransfer')->name('storeTransfer');
        Route::delete('/transfer/{id}', 'destroyTransfer')->name('destroyTransfer');



        Route::get('/guterana', 'guterana')->name('guterana');
        Route::get('/gusaba-akazi', 'gusabaAkazi')->name('gusabaAkazi');

    });
    Route::controller(RequestController::class)->name('request.')->prefix('request')->group(function () {
        Route::get('/suggestion', 'suggestion')->name('suggestion');
        Route::get('/suggestion/list', 'suggestionList')->name('suggestionList');
        Route::post('/suggestion', 'storeSuggestion')->name('storeSuggestion');
        // praiseRequest
        Route::get('/praise-request', 'praiseRequest')->name('praiseRequest');
        Route::post('/praise-request', 'storePraiseRequest')->name('storePraiseRequest');
        // preachRequest
        Route::get('/preach-request', 'preachRequest')->name('preachRequest');
        Route::post('/preach-request', 'storePreachRequest')->name('storePreachRequest');

        // preach on social media
        Route::get('/socialMedia-preach', 'socialMediaPreach')->name('socialMediaPreach');
        Route::post('/socialMedia-preach', 'storeSocialMediaPreach')->name('storeSocialMediaPreach');
        // choir moving
        Route::get('/choirMove-request', 'choirMove')->name('choirMove');
        Route::post('/choirMove-request', 'storeChoirMove')->name('storeChoirMove');

        // Meeting with leaders requesu
        Route::get('/leaderMeet-request', 'leaderMeetRequest')->name('leaderMeetRequest');
        Route::post('/leaderMeet-request', 'storeLeaderMeetRequest')->name('storeLeaderMeetRequest');




    });

    Route::get('/logout', function () {
        auth()->guard('member')->logout();
        return redirect()->route('member.login');
    })->name('logout');
 });
