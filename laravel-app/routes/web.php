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
	if(Auth::check())
		return redirect()->route('home');

    return view('welcome');
})->name('main');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {

	Route::get('problem', 'ProblemController@index')->name('problem.index');
	Route::get('problem/{id}', 'ProblemController@show')->name('problem.show');
	Route::get('problem/submit/{problem_id}', 'ProblemController@formSubmit')->name('problem.form.submit');

	Route::post('submit/{problem_id}', 'SubmissionController@submit')->name('submission.upload');


	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');


	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::group(['middleware' => 'admin'], function () {
	//Route::resource('user', 'UserController', ['except' => ['show']]);

	Route::get('user/index', 'UserController@index')->name('user.index');
	Route::get('user/create', 'UserController@create')->name('user.create');
	Route::get('user/multi-create', 'UserController@createMulti')->name('user.create.multi');
	Route::post('user', 'UserController@store')->name('user.store');
	Route::post('users', 'UserController@storeMulti')->name('user.store.multi');
	Route::get('user/edit/{user_id}', 'UserController@edit')->name('user.edit');
	Route::put('user/{user}', 'UserController@update')->name('user.update');
	Route::get('user/delete/{user_id}', 'UserController@destroy')->name('user.destroy');
	
});

