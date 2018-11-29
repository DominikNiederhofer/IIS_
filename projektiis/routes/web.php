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

Route::post('{id}/terms/register{term_id}', 'TermsController@register')->name('terms_register');
Route::post('{id}/terms/unregister{term_id}', 'TermsController@unregister')->name('terms_unregister');


Route::get('questions/create', 'QuestionsController@create')->name('questions_create');
Route::post('valuate/create', 'QuestionsController@store')->name('questions_store');


Route::get('valuate/create', 'EvaluationsController@create')->name('valuate_create');
Route::post('valuate/create', 'EvaluationsController@store')->name('valuate_store');

Route::get('{id}/exams/create', 'ExamsController@create')->name('exams_create');
Route::post('{id}/exams/create', 'ExamsController@store')->name('exams_store');

Route::get('{id}/terms/create', 'TermsController@create')->name('terms_create');
Route::post('{id}/terms/create', 'TermsController@store')->name('terms_store');


Route::delete('terms/{term_id}', 'TermsController@destroy')->name('terms_destroy');

Route::get('{id}/terms/valuate{term_id}', 'EvaluationsController@index')->name('terms_valuate');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
