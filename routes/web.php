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

Route::get('/note/create', 'NoteController@create')->name('note-create');
Route::post('/note/create-appln', 'NoteController@create_appln');
Route::get('/user/notes', 'NoteController@list_my_notes');
Route::get('/note/list', 'NoteController@list_notes');
Route::get('/note/{slug}', 'NoteController@note_page');
Route::post('/note/comment-appln', 'NoteController@comment_appln');


