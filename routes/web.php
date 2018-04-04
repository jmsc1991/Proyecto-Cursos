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

Route::group([
    'prefix'    =>  'admin',
    'namespace' =>  'Admin',
    'middleware' => 'auth'],
    function () {
        Route::get('/', 'AdminController@index')->name('dashboard');

        Route::get('courses', ['as'=> 'admin.courses.index', 'uses' => 'CourseController@index']);
        Route::post('courses', ['as'=> 'admin.courses.store', 'uses' => 'CourseController@store']);
        Route::get('courses/create', ['as'=> 'admin.courses.create', 'uses' => 'CourseController@create']);
        Route::put('courses/{courses}', ['as'=> 'admin.courses.update', 'uses' => 'CourseController@update']);
        Route::patch('courses/{courses}', ['as'=> 'admin.courses.update', 'uses' => 'CourseController@update']);
        Route::delete('courses/{courses}', ['as'=> 'admin.courses.destroy', 'uses' => 'CourseController@destroy']);
        Route::get('courses/{courses}', ['as'=> 'admin.courses.show', 'uses' => 'CourseController@show']);
        Route::get('courses/{courses}/edit', ['as'=> 'admin.courses.edit', 'uses' => 'CourseController@edit']);
    });
