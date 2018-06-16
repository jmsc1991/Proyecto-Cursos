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

Route::get('/', 'SpaController@index')->name('home');
Route::get('/curso/{any}', 'SpaController@index');
Route::get('/curso/video/{any}', 'SpaController@index');
Route::get('/cursos', 'SpaController@index');
Route::get('/categoria/{any}', 'SpaController@index');
Route::get('/about', 'SpaController@index');
Route::get('/carrito', 'SpaController@index');
Route::get('/perfil', 'SpaController@index');
Route::get('/vip', 'SpaController@index');

Auth::routes();

Route::group([
    'prefix'    =>  'admin',
    'namespace' =>  'Admin',
    'middleware' => ['auth','role:admin|teacher']],
    function () {
        Route::get('/', 'AdminController@index')->name('dashboard');

        Route::group(['middleware' => 'role:admin'], function() {
            Route::get('users', ['as'=> 'admin.users.index', 'uses' => 'UserController@index']);
            Route::post('users', ['as'=> 'admin.users.store', 'uses' => 'UserController@store']);
            Route::get('users/create', ['as'=> 'admin.users.create', 'uses' => 'UserController@create']);
            Route::put('users/{users}', ['as'=> 'admin.users.update', 'uses' => 'UserController@update']);
            Route::patch('users/{users}', ['as'=> 'admin.users.update', 'uses' => 'UserController@update']);
            Route::delete('users/{users}', ['as'=> 'admin.users.destroy', 'uses' => 'UserController@destroy']);
            Route::get('users/{users}', ['as'=> 'admin.users.show', 'uses' => 'UserController@show']);
            Route::get('users/{users}/edit', ['as'=> 'admin.users.edit', 'uses' => 'UserController@edit']);

            Route::get('comments',['as' => 'admin.comments.index', 'uses' => 'CommentController@index']);
            Route::get('comments/{comments}', ['as'=> 'admin.comments.show', 'uses' => 'CommentController@show']);
            Route::delete('comments/{comments}',['as' => 'admin.comments.destroy', 'uses' => 'CommentController@destroy']);

            Route::get('categories', ['as'=> 'admin.categories.index', 'uses' => 'CategoriesController@index']);
            Route::post('categories', ['as'=> 'admin.categories.store', 'uses' => 'CategoriesController@store']);
            Route::get('categories/create', ['as'=> 'admin.categories.create', 'uses' => 'CategoriesController@create']);
            Route::put('categories/{categories}', ['as'=> 'admin.categories.update', 'uses' => 'CategoriesController@update']);
            Route::patch('categories/{categories}', ['as'=> 'admin.categories.update', 'uses' => 'CategoriesController@update']);
            Route::delete('categories/{categories}', ['as'=> 'admin.categories.destroy', 'uses' => 'CategoriesController@destroy']);
            Route::get('categories/{categories}', ['as'=> 'admin.categories.show', 'uses' => 'CategoriesController@show']);
            Route::get('categories/{categories}/edit', ['as'=> 'admin.categories.edit', 'uses' => 'CategoriesController@edit']);
        });

        Route::get('courses', ['as'=> 'admin.courses.index', 'uses' => 'CourseController@index']);
        Route::post('courses', ['as'=> 'admin.courses.store', 'uses' => 'CourseController@store']);
        Route::get('courses/create', ['as'=> 'admin.courses.create', 'uses' => 'CourseController@create']);
        Route::put('courses/{courses}', ['as'=> 'admin.courses.update', 'uses' => 'CourseController@update']);
        Route::patch('courses/{courses}', ['as'=> 'admin.courses.update', 'uses' => 'CourseController@update']);
        Route::delete('courses/{courses}', ['as'=> 'admin.courses.destroy', 'uses' => 'CourseController@destroy']);
        Route::get('courses/{courses}', ['as'=> 'admin.courses.show', 'uses' => 'CourseController@show']);
        Route::get('courses/{courses}/edit', ['as'=> 'admin.courses.edit', 'uses' => 'CourseController@edit']);

        Route::get('videos',['as' => 'admin.videos.index', 'uses' => 'VideoController@index']);
        Route::post('videos', ['as'=> 'admin.videos.store', 'uses' => 'VideoController@store']);
        Route::get('videos/create', ['as'=> 'admin.videos.create', 'uses' => 'VideoController@create']);
        Route::put('videos/{videos}', ['as'=> 'admin.videos.update', 'uses' => 'VideoController@update']);
        Route::patch('videos/{videos}', ['as'=> 'admin.videos.update', 'uses' => 'VideoController@update']);
        Route::get('videos/{videos}', ['as'=> 'admin.videos.show', 'uses' => 'VideoController@show']);
        Route::get('videos/{videos}/edit', ['as'=> 'admin.videos.edit', 'uses' => 'VideoController@edit']);
        Route::delete('videos/{videos}',['as' => 'admin.videos.destroy', 'uses' => 'VideoController@destroy']);
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
        Route::get('/user/puede/ver/video/{id}', 'UserController@puedeVerVideo');
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
        Route::get('/carrito/ver', 'CarritoController@ver');
        Route::get('/carrito/comprar', 'CarritoController@comprar');
        Route::get('/carrito/comprar/vip', 'CarritoController@comprarVip');
        Route::get('/user/cursos', 'UserController@getCursos');
    });


