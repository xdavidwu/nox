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
    return redirect()->route('map');
})->name('home');

Route::get('/raw', 'RawController@search')->name('data');

Route::get('/canvas', function () {
    return view('canvas');
})->name('map');

Route::get('/grafana', function () {
    return view('grafana');
})->name('charts');
