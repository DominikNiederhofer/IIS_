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
Route::get('/teacher', 'CoursesController@teacher_index')->name('teacher');
Route::get('/teacher/{course_id}', 'CoursesController@teacher_show')->name('teacher_show');
    

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

Route::post('{id}/terms/valuate{term_id}', 'TermsController@valuate')->name('terms_valuate');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
