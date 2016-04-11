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

Route::group(['middleware' => ['web']], function () {
  Route::get('/', function () {
      return view('auth.login');
  })->middleware('guest');
  
  Route::get('/home', 'HomeController@index');
  
  
  /*CHALLENGES*/
  Route::get('/challenges', 'ChallengesController@index');
  Route::get('/challenges/new', 'ChallengesController@create');
  Route::get('/challenge/{challenge}', 'ChallengesController@detail');
  
  Route::get('/test', function () {
      return view('layouts.main');
  });
    
    
  Route::auth();
});
