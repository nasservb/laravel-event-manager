<?php

use
    Illuminate\Http\Request;
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


/**
 * api route without login
 */

    Route::post('/auth/login', 'AuthApi@login');

    Route::post('/auth/register', 'AuthApi@register');

    Route::post('/auth/sendSms','AuthApi@sendSmsToMobile');

    Route::post('/auth/verifySms','AuthApi@verifySms');

    Route::post('/auth/forget', 'AuthApi@forget');


/**
 * api route with login
 */
Route::middleware(['auth:api'])->group( function () {

    /** create event */
    Route::post('/event/create','EventApi@create');
    /** list events */
    Route::get('/event/','EventApi@index');
    /** view specific event status  */
    Route::get('/event/{event}/','EventApi@view');




    /** get invite list for user */
    Route::get('invite/','InviteApi@inviteList');

    /** send invitation to specific user by mobile or email  */
    Route::post('/invite/{event}/send/','InviteApi@invite');

    /** get invitation status report */
    Route::get('/invite/{invite}/view/','InviteApi@view');

    /** accept invitation */
    Route::post('/invite/{invite}/accept/','InviteApi@accept');





    /** show profile info */
    Route::get('/profile', 'ProfileApi@show' );
    /** update profile info */
    Route::post('/profile/', 'ProfileApi@update' );

});
