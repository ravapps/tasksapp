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
Route::resource('tasks','TaskController');

Route::get('tasks/{id}/{slug?}', [ 'uses'=>'TaskController@edit']);

Route::post('task-sortable','TaskController@sort');

Route::get('/', function () {
    return redirect()->route('tasks.index');
    //return view('welcome');
});
