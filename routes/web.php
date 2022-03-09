<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('notes', 'NoteController')->middleware('auth');
Route::get('shareNote/{code}', 'NoteController@shareNote');
// download image
Route::get('/download/{fileName}', 'FileController@download');

// report
Route::get('reports', 'ReportController@index')->name('reports');
