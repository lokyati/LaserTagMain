<?php

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
    Route::post('/register', 'Auth\AdminRegisterController@createAdmin')->name('admin.register.submit');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
});

//User Authentication Routes
Route::get('/profil', 'UserController@index')->name('profil');
Route::get('/home', 'UserController@home')->name('home');
Route::get('profile', 'UserController@profile');
Route::get('data/{id}', 'UserController@data');

//Test Route
Route::get('/calendar', function () {
    return view('calendar');
});

//Reservation data
/*Route::get('/reservation/{selectedmonth}/{selectedday}',function($month, $day){
	return App\Reservations::where('selectedmonth', $month)
							->where('selectedday', $day)
							->first();
});
Route::get('show/{day}', 'ReservationsController@show');
Route::get('/show/{day}', function ($day) {
    return App\Reservations::where('day', $day)->firstOrFail($day);
});*/

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
