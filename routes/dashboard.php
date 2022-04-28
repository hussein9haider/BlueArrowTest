<?php

use Illuminate\Support\Facades\Route;

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

Route::group([
		'prefix' => LaravelLocalization::setLocale(),
		'middleware' => ['localeSessionRedirect','localizationRedirect','localeViewPath']
   ],function(){ 

	Route::group(['middleware' => ['guest:admin']],function (){
		Route::get('login/admin', 'AuthController@showAdminLoginForm')->name('dashboard.login.show');
		Route::post('login/admins', 'AuthController@adminLogin')->name('dashboard.login');

		Route::get('register/admin', 'AuthController@showAdminRegisterForm')->name('dashboard.register.show');
		Route::post('register/admins', 'AuthController@adminRegister')->name('dashboard.register');
	});
	Route::group(['middleware'=>['auth:admin']],function (){ 
		Route::get('/', function(){ 
			return redirect('dashboard');
		});
	});
	Route::group(['prefix' => 'dashboard','middleware'=>['auth:admin']],function (){ 
		Route::get('/','DashboardController@index')->name('dashboard');


		Route::group(['prefix' => 'notes'],function (){ 
			Route::get('/create','NoteController@create')->name('dashboard.notes.create');
			Route::get('/show/{hash}/{id}','NoteController@show')->name('dashboard.notes.show');
			Route::post('/store','NoteController@store')->name('dashboard.notes.store');
			Route::get('/delete/{id}','NoteController@delete')->name('dashboard.notes.delete');
		});
	});

	Route::group(['prefix' => 'dashboard'],function (){ 
		Route::group(['prefix' => 'notes'],function (){ 
			Route::get('/show/{hash}/{id}','NoteController@show')->name('dashboard.notes.show');
		});
	});
});