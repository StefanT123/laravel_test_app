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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('/admin', 'UsersController@adminView')->name('admin');
Route::get('/admin/user/create', 'UsersController@createUserView');
Route::post('/register', 'UsersController@createUser');
Route::get('/admin/users', 'UsersController@showAllUsers');
Route::get('/admin/users/{id}', 'UsersController@showUser');
Route::get('/admin/users/delete/{id}', 'UsersController@deleteUser')->name('user.delete');
Route::get('/admin/users/edit/{id}', 'UsersController@editUser')->name('user.edit');
Route::post('/users/update/{id}', 'UsersController@update')->name('user.update');

Route::get('/pages', 'PagesController@index');
Route::get('/pages/{slug}', [
	'uses' => 'PagesController@getPage'
	])->where('slug', '([A-Za-z0-9\-\/]+)');
Route::get('/admin/page/create', 'PagesController@createPageView');
Route::post('/page/store', 'PagesController@create');
Route::get('/admin/page/edit/{id}', 'PagesController@editPage')->name('page.edit');
Route::post('/pages/update/{id}', 'PagesController@update')->name('page.update');
Route::get('/admin/page/delete/{id}', 'PagesController@deletePage')->name('page.delete');

Route::get('/vue/modules', 'ModulesController@allVue');

Route::get('/modules', 'ModulesController@index');
Route::get('/admin/modules/create', 'ModulesController@create');
Route::post('/module/store', 'ModulesController@store');
Route::get('/module/{slug}', 'ModulesController@showModule');
Route::get('/admin/module/delete/{id}', 'ModulesController@delete')->name('module.delete');
Route::get('/admin/module/edit/{id}', 'ModulesController@edit')->name('module.edit');
Route::post('/admin/module/update/{id}', 'ModulesController@update')->name('module.update');

Route::get('/vue/lessons', 'LessonsController@allVue');

Route::get('/lessons', 'LessonsController@index');
Route::get('/admin/lessons/create', 'LessonsController@create');
Route::post('/lesson/store', 'LessonsController@store');
Route::get('/lesson/{slug}', 'LessonsController@showLesson');
Route::get('/admin/lesson/delete/{id}', 'LessonsController@delete')->name('lesson.delete');
Route::get('/admin/lesson/edit/{id}', 'LessonsController@edit')->name('lesson.edit');
Route::post('/admin/lesson/update/{id}', 'LessonsController@update')->name('lesson.update');

Route::get('/sessions', 'SessionsController@index');
Route::get('/admin/sessions/create', 'SessionsController@create');
Route::post('/session/store', 'SessionsController@store');
Route::get('/session/{slug}', 'SessionsController@showSession')->name('session.single');
Route::post('/session/completed', 'SessionsController@completed');
Route::get('/admin/session/delete/{id}', 'SessionsController@delete')->name('session.delete');
Route::get('/admin/session/edit/{id}', 'SessionsController@edit')->name('session.edit');
Route::post('/admin/session/update/{id}', 'SessionsController@update')->name('session.update');


Route::resource('users', 'UserController');
