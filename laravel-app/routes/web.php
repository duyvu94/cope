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
		return redirect()->route('/home');

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::redirect('/', '/home');

	Route::get('problem', 'ProblemController@index')->name('problem.index');
	Route::get('problem/{id}', 'ProblemController@show')->name('problem.show');
	Route::get('problem/submit/{problem_id}', 'ProblemController@formSubmit')->name('problem.form.submit');

	Route::post('submit/{problem_id}', 'SubmissionController@submit')->name('submission.upload');


	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');


	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::group(['middleware' => 'admin'], function () {
	//Route::resource('user', 'UserController', ['except' => ['show']]);

	Route::get('user/index', 'UserController@index')->name('user.index');
	Route::get('user/update', 'UserController@update')->name('user.update');
	Route::get('user/create', 'UserController@create')->name('user.create');
	
});

