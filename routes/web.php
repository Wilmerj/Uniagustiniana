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
Route::get('/', 'HomeController@index');
Auth::routes();
Route::get('/encuesta', 'EncuestaController@encuesta')->name('encuesta');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/comunidad', 'ComunidadController@index')->name('comunidad');
Route::get('/cursos', 'CursosController@index')->name('cursos');
Route::get('/chat', 'ChatController@index')->name('chat');

