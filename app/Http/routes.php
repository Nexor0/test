<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get(
    '/',
    function () {
        return view('home');
    }
);

Route::get(
    'users/profile',
    array('as' => 'users/profile', 'uses' => 'UsersController@profile')
);

Route::get(
    'users/list',
    array('as' => 'users/list', 'uses' => 'UsersController@usersList')
);

Route::post(
    'users/saveKey',
    array('as' => 'users/saveKey', 'uses' => 'UsersController@saveKey')
);

Route::post(
    'users/setPhone',
    array('as' => 'users/setPhone', 'uses' => 'UsersController@setPhone')
);

Route::post(
    'users/checkKey',
    array('as' => 'users/checkKey', 'uses' => 'UsersController@checkKey')
);

Route::post(
    'users/saveProfile',
    array('as' => 'users/saveProfile', 'uses' => 'UsersController@saveProfile')
);

Route::get(
    'logout',
    function () {
        Auth::logout();
        return redirect('/');
    }
);
