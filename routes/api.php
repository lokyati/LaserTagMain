<?php

use Illuminate\Http\Request;
use Carbon\Carbon;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/profile', function (Request $request){
	return $request->user();
});

Route::resource('reservations','ReservationsController');
//Route::resource('restoday','ReservationsController@reservationsToday');
Route::resource('Reservedhours','reservedHourController');
Route::resource('allpackage','PackageController');
//Route::resource('alluser','AdminController@allUser');
Route::resource('loggedinusers','LoggedInUsersController');

Route::post('createReservation','ReservationsController@create');
//Route::post('PckgCreate','PackageController@create');
