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

//Route::get( '/calculate', [ 'as' => 'loon.calculate', 'uses' => 'LoonController@calculate' ] );

Route::get('calculate', array(
    'uses' => 'LoonController@calculate',
    'as' => 'loon.calculate'
    ));