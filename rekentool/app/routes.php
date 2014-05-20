<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::resource('/', 'LoonController');

Route::get('calculate', array(
    'uses' => 'LoonController@calculate',
    'as' => 'loon.calculate'
));

Route::controller('/', 'LoonController');

// Route::get('/', array(
//     'uses' =>'LoonController@postChangeLanguage',
//     'as' => 'loon.language'
// ));
