<?php

use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.landing');
});
Auth::routes();


//Admin Authentication Routes
Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/register', 'Auth\AdminRegisterController@showAdminRegisterForm')->name('admin.register');
    Route::post('/register','Auth\AdminRegisterController@createAdmin')->name('admin.register.submit');
    Route::get('/dashboard','AdminController@index')->name('admin.dashboard');
    Route::get('/users', 'AdminController@users')->name('admin.users');
    Route::get('/reservations','AdminController@reservations')->name('admin.reservations');
    Route::get('/packages','AdminController@packages')->name('admin.packages');
});

//User Authentication Routes
Route::get('/profil','UserController@index')->name('profil');
Route::get('/home','UserController@home')->name('home');
Route::post('/loginuser/{id}','LoggedInUsersController@create');
Route::post('updateloginuser/{id}','LoggedInUsersController@update');

/*UserController*/
Route::get('profile','UserController@profile');
Route::get('data/{id}','UserController@data');
Route::post('BPupdate/{id}','UserController@update');
Route::post('ProfileUpdate/{id}','UserController@profileupdate');
Route::post('userRankUpdate/{id}','UserController@rankupdate');
Route::post('userBonusUpdate/{id}','UserController@bonusupdate');
Route::get('alluser','AdminController@allUser');

/*UserStatController*/
Route::get('userstat/{id}','UserStatController@show');
Route::post('statUpdate/{id}','UserStatController@update');

/*PackageController*/
Route::get('package/{id}','PackageController@show'); 
Route::get('allpackage','PackageController@index'); 
Route::post('PckgPopUpdate/{id}','PackageController@PopUpdate');
Route::post('PckgUpdate/{id}','PackageController@PckgUpdate');
Route::delete('PckgDelete/{id}','PackageController@destroy');
Route::post('PckgCreate','PackageController@create');


/*MatchesController*/
Route::post('matchUpdate/{id}','MatchesController@update');
Route::post('simulation','MatchesController@create');
Route::get('matches/{id}','MatchesController@showByUser');

/*ReservationsController*/
Route::get('restoday','ReservationsController@reservationsToday');
Route::get('reservation/{id}','ReservationsController@showByUser');
Route::delete('deleteReservedHour/{id}','reservedHourController@destroy');
Route::get('rank/','RankController@index');

//Test Route
Route::get('/calendar', function () {
    return view('calendar');
});
Route::get('/package', function () {
    return view('package');
});
Route::get('/simulator', function () {
    return view('simulator');
});
Route::get('/about',function(){
    return view('userAbout');
});
Route::get('/contact',function(){
    return view('userContact');
});
//Password Reset Routes
//Route::get('/password/reset/{token}', 'ResetController@showResetForm');
//Route::get('/email', 'Auth\ResetPasswordController@getEmailForm');
//Route::post('password/email', 'Auth\ResetPasswordController@sendResetLinkEmail');
//Route::post('password/reset', 'ResetController@reset');

//Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');


//Navbar Routes

/*Route::get('/email', function () {
    return view('auth.passwords.reset');
});



Route::get('/email', function () {
    return view('auth.passwords.email')->name('passwords.email');
});*/
