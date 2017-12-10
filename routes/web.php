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

Route::get('/', 'PagesController@getIndex');
Route::get('getword', ['as' => 'practice.getword', 'uses' => 'PhpWordController@getword']);

Auth::routes();

Route::resource('category', 'CategoryController');
Route::resource('question', 'QuestionController');
Route::resource('exam', 'ExamController');
Route::put('release/{release}/{type}', ['as' => 'exam.release', 'uses' => 'ExamController@release']);
Route::get('practice/{practice}', ['as' => 'practice.show', 'uses' => 'PracticeController@show']);
Route::get('practice', ['as' => 'practice.index', 'uses' => 'PracticeController@index']);



