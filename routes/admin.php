<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::post('/signin', 'AdminController@authAdmin');
Route::get('/signout', 'AdminController@logoutAdmin');

Route::get('/{any}', function () {
    return view('admin.app');
});


