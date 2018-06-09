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

Route::get('/', 'SpaController@index');
Route::get('/curso/{any}', 'SpaController@index');
Route::get('/curso/video/{any}', 'SpaController@index');
Route::get('/cursos', 'SpaController@index');
Route::get('/categoria/{any}', 'SpaController@index');
Route::get('/about', 'SpaController@index');

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

        Route::get('categories', ['as'=> 'admin.categories.index', 'uses' => 'CategoriesController@index']);
        Route::post('categories', ['as'=> 'admin.categories.store', 'uses' => 'CategoriesController@store']);
        Route::get('categories/create', ['as'=> 'admin.categories.create', 'uses' => 'CategoriesController@create']);
        Route::put('categories/{categories}', ['as'=> 'admin.categories.update', 'uses' => 'CategoriesController@update']);
        Route::patch('categories/{categories}', ['as'=> 'admin.categories.update', 'uses' => 'CategoriesController@update']);
        Route::delete('categories/{categories}', ['as'=> 'admin.categories.destroy', 'uses' => 'CategoriesController@destroy']);
        Route::get('categories/{categories}', ['as'=> 'admin.categories.show', 'uses' => 'CategoriesController@show']);
        Route::get('categories/{categories}/edit', ['as'=> 'admin.categories.edit', 'uses' => 'CategoriesController@edit']);

        Route::get('users', ['as'=> 'admin.users.index', 'uses' => 'UserController@index']);
        Route::post('users', ['as'=> 'admin.users.store', 'uses' => 'UserController@store']);
        Route::get('users/create', ['as'=> 'admin.users.create', 'uses' => 'UserController@create']);
        Route::put('users/{users}', ['as'=> 'admin.users.update', 'uses' => 'UserController@update']);
        Route::patch('users/{users}', ['as'=> 'admin.users.update', 'uses' => 'UserController@update']);
        Route::delete('users/{users}', ['as'=> 'admin.users.destroy', 'uses' => 'UserController@destroy']);
        Route::get('users/{users}', ['as'=> 'admin.users.show', 'uses' => 'UserController@ show']);
        Route::get('users/{users}/edit', ['as'=> 'admin.users.edit', 'uses' => 'UserController@edit']);
    });

Route::group([
    'prefix'    =>  'data',
    'namespace' =>  'Data',],
    function () {
        Route::get('/user', 'UserController@getUser');
        Route::get('/cursos/top', 'CursoController@getTopCursos');
        Route::get('/categorias', 'CategoriaController@getCategorias');
        Route::get('/cursos/ver/{id}', 'CursoController@verCurso');
        Route::get('/videos/{id}', 'VideoController@verVideo');
        Route::get('/cursos/all', 'CursoController@getAllCursos');
        Route::get('/categoria/{id}', 'CursoController@getCategoria');
        Route::get('/user/puede/ver/{id}', 'UserController@puedeVer');
    });

Route::group([
    'prefix'    =>  'data',
    'namespace' =>  'Data',
    'middleware' => 'auth'],
    function () {
        Route::post('/comentario/{id}', 'VideoController@comentar');
        Route::get('/carrito', 'CarritoController@getCarrito');
        Route::get('/carrito/add/{id}', 'CarritoController@add');
        Route::get('/carrito/remove/{id}', 'CarritoController@remove');
    });


