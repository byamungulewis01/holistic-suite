<?php

use App\Http\Controllers\CertificateController;
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
        Route::get('/holy-communion-list', 'holyCommunionList')->name('holyCommunionList');
        Route::post('/holy-communion', 'storeHolyCommunion')->name('storeHolyCommunion');
        Route::delete('/holy-communion/{id}', 'destroyHolyCommunion')->name('destroyHolyCommunion');
        // prayer request
        Route::get('/prayer-request', 'prayerRequest')->name('prayerRequest');
        Route::get('/prayer-request-list', 'prayerRequestList')->name('prayerRequestList');
        Route::post('/prayer-request', 'storePrayerRequest')->name('storePrayerRequest');
        Route::delete('/prayer-request/{id}', 'destroyPrayerRequest')->name('destroyPrayerRequest');
        // wedding project
        Route::get('/wedding-project', 'weddingProject')->name('weddingProject');
        Route::get('/wedding-project-list', 'weddingProjectList')->name('weddingProjectList');
        Route::post('/wedding-project', 'storeWeddingProject')->name('storeWeddingProject');
        Route::delete('/wedding-project/{id}', 'destroyWeddingProject')->name('destroyWeddingProject');
    });
    Route::controller(RecommandationController::class)->name('recommandation.')->prefix('recommandation')->group(function () {
        // transfer
        Route::get('/transfer', 'transfer')->name('transfer');
        Route::get('/transferList', 'transferList')->name('transferList');
        Route::post('/transfer', 'storeTransfer')->name('storeTransfer');
        Route::delete('/transfer/{id}', 'destroyTransfer')->name('destroyTransfer');
        Route::get('/transferCert/{id}', 'transferCert')->name('transferCert');

        Route::get('/assembly-proof', 'assemblyProof')->name('assemblyProof');
        Route::get('/assembly-proof-list', 'assemblyProofList')->name('assemblyProofList');
        Route::post('/assembly-proof', 'storeAssemblyProof')->name('storeAssemblyProof');
        Route::delete('/assembly-proof', 'destroyAssemblyProof')->name('destroyAssemblyProof');
        Route::get('/assembly-proof/{id}', 'assemblyProofCert')->name('assemblyProofCert');


        Route::get('/member-proof', 'memberProof')->name('memberProof');
        Route::get('/member-proof-list', 'memberProofList')->name('memberProofList');
        Route::post('/member-proof', 'storeMemberProof')->name('storeMemberProof');
        Route::delete('/member-proof', 'destroyMemberProof')->name('destroyMemberProof');
        Route::get('/member-proof/{id}', 'memberProofCert')->name('memberProofCert');

    });
    Route::controller(CertificateController::class)->name('certificate.')->prefix('certificate')->group(function () {
        Route::get('/transferCert/{id}', 'transferCert')->name('transferCert');
        Route::get('/assembly-proof/{id}', 'assemblyProofCert')->name('assemblyProofCert');
        Route::get('/member-proof/{id}', 'memberProofCert')->name('memberProofCert');
    });
    Route::controller(RequestController::class)->name('request.')->prefix('request')->group(function () {
        Route::get('/suggestion', 'suggestion')->name('suggestion');
        Route::get('/suggestion/list', 'suggestionList')->name('suggestionList');
        Route::post('/suggestion', 'storeSuggestion')->name('storeSuggestion');
        Route::delete('/suggestion/{id}', 'destroySuggestion')->name('destroySuggestion');
        // praiseRequest
        Route::get('/praise-request', 'praiseRequest')->name('praiseRequest');
        Route::get('/praise-request-list', 'praiseRequestList')->name('praiseRequestList');
        Route::post('/praise-request', 'storePraiseRequest')->name('storePraiseRequest');
        Route::delete('/praise-request/{id}', 'destroyPraiseRequest')->name('destroyPraiseRequest');
        // preachRequest
        Route::get('/preach-request', 'preachRequest')->name('preachRequest');
        Route::get('/preach-request-list', 'preachRequestList')->name('preachRequestList');
        Route::post('/preach-request', 'storePreachRequest')->name('storePreachRequest');
        Route::delete('/preach-request/{id}', 'destroyPreachRequest')->name('destroyPreachRequest');

        // preach on social media
        Route::get('/socialMedia-preach', 'socialMediaPreach')->name('socialMediaPreach');
        Route::get('/socialMedia-preach-list', 'socialMediaPreachList')->name('socialMediaPreachList');
        Route::post('/socialMedia-preach', 'storeSocialMediaPreach')->name('storeSocialMediaPreach');
        Route::delete('/socialMedia-preach/{id}', 'destroySocialMediaPreach')->name('destroySocialMediaPreach');
        // choir moving
        Route::get('/choirMove-request', 'choirMove')->name('choirMove');
        Route::get('/choirMove-request-list', 'choirMoveList')->name('choirMoveList');
        Route::post('/choirMove-request', 'storeChoirMove')->name('storeChoirMove');
        Route::delete('/choirMove-request/{id}', 'destroyChoirMove')->name('destroyChoirMove');

        // Meeting with leaders requesu
        Route::get('/leaderMeet-request', 'leaderMeetRequest')->name('leaderMeetRequest');
        Route::get('/leaderMeet-request-list', 'leaderMeetRequestList')->name('leaderMeetRequestList');
        Route::post('/leaderMeet-request', 'storeLeaderMeetRequest')->name('storeLeaderMeetRequest');
        Route::delete('/leaderMeet-request/{id}', 'destroyLeaderMeetRequest')->name('destroyLeaderMeetRequest');


    });

    Route::get('/logout', function () {
        auth()->guard('member')->logout();
        return redirect()->route('member.login');
    })->name('logout');
 });
