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

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('login', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth'], function() {

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/courses', 'CoursesController@index')->name('courses');
	Route::get('/teacher/{course_id}', 'CoursesController@teacher_show')->name('teacher_show');
	    
	Route::get('/exams', 'ExamsController@index')->name('exams');

	Route::get('/exams/create', 'ExamsController@create')->name('exams.create');

	Route::get('logout', 'Auth\LoginController@logout');

	Route::post('logout', 'Auth\LoginController@logout')->name('logout');


	Route::resource('users', 'UsersController');
	Route::resource('roles', 'RolesController');
	Route::resource('courses', 'CoursesController');
	Route::resource('evaluations', 'EvaluationsController');
	Route::resource('exams', 'ExamsController');

	Route::resource('questions', 'QuestionsController');
	Route::resource('terms', 'TermsController');


	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('courses/{course}', 'CoursesController@show')->name('course_show');
	Route::get('{id}courses/edit','CoursesController@edit')->name('courses_edit')->middleware('role:admin');
	Route::put('{id}courses/update', 'CoursesController@update')->name('courses_update')->middleware('role:admin');

	Route::get('courses/create', 'CoursesController@create')->name('courses_create')->middleware('role:admin');
	Route::post('courses/store', 'CoursesController@store')->name('courses_store')->middleware('role:admin');

	Route::post('{id}/terms/register{term_id}', 'TermsController@register')->name('terms_register')->middleware('role:student');
	Route::post('{id}/terms/unregister{term_id}', 'TermsController@unregister')->name('terms_unregister')->middleware('role:student');

	Route::get('valuate/index{id}', 'EvaluationsController@index')->name('terms_valuate')->middleware('role:teacher');

	Route::get('{id}valuate/show', 'EvaluationsController@show')->name('valuate_show')->middleware('role:student');

	Route::get('{id}valuate/edit', 'EvaluationsController@edit')->name('valuate_edit')->middleware('role:teacher');
	Route::put('{id}valuate/{id2}update', 'EvaluationsController@update')->name('valuate_update')->middleware('role:teacher');

	Route::get('valuate/create{id}{id2}', 'EvaluationsController@create')->name('valuate_create')->middleware('role:teacher');
	Route::post('{id}{id2}valuate/create', 'EvaluationsController@store')->name('valuate_store')->middleware('role:teacher');

	Route::get('questions/create', 'QuestionsController@create')->name('questions_create')->middleware('role:teacher');
	Route::post('valuate/create', 'QuestionsController@store')->name('questions_store')->middleware('role:teacher');

	Route::get('{id}/exams/create', 'ExamsController@create')->name('exams_create')->middleware('role:teacher');
	Route::post('{id}/exams/create', 'ExamsController@store')->name('exams_store')->middleware('role:teacher');

	Route::get('{id}{id2}/terms/create', 'TermsController@create')->name('terms_create')->middleware('role:teacher');
	Route::post('{id}{id2}/terms/create', 'TermsController@store')->name('terms_store')->middleware('role:teacher');

	Route::get('users/{user}', 'UsersController@show')->name('user_show')->middleware('role:admin');
	Route::get('users/create', 'UsersController@create')->name('user/create')->middleware('role:admin');
	Route::post('users/create', 'UsersController@store')->middleware('role:admin');

	Route::get('users/{id}/add', 'UsersController@add_course')->middleware('role:admin');
	Route::post('users/{id}/add', 'UsersController@store_course')->name('course_user_add')->middleware('role:admin');

	Route::get('users/create', 'UsersController@create')->name('user/create')->middleware('role:admin');
	Route::post('users/create', 'UsersController@store')->middleware('role:admin');

	Route::get('edit_user/{id}','UsersController@edit')->middleware('role:admin');
	Route::put('users/{id}','UsersController@update')->middleware('role:admin');

	Route::delete('users/{course}/{id}', 'UsersController@destroy_course')->name('course_user_destroy')->middleware('role:admin');
	Route::get('delete_user/{id}','UsersController@destroy')->middleware('role:admin');
	Route::delete('courses/{course_id}','CoursesController@destroy')->name('courses_destroy')->middleware('role:admin');
	Route::delete('terms/{term_id}', 'TermsController@destroy')->name('terms_destroy')->middleware('role:teacher');
	Route::delete('exams/{exam}', 'ExamsController@destroy')->name('exams_destroy')->middleware('role:teacher');

	//Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');
});